<?php
class AccessInformation{
    private $conn;
    private $SchemaEnum;
    private $DataTypeEnum;
    private $strConn     =  "Provider=Microsoft.ACE.OLEDB.12.0;Data Source=";
    private $strUser     =  "";
    private $strPassword =  "";
    public function __construct($banco, $user, $password){
        try{
            $this->conn = new COM("ADODB.Connection");
            $this->setBanco($banco, $user, $password);
            $this->conn->Open($this->strConn, $this->strUser, $this->strPassword);
            return "Connectado";
        }catch(AError $e){
            $this->conn->Close();
            return "{\"code\":" + $e->HResult + ", \"message\":\"" + $e->Message + "\", \"target\": \"" + $e->TargetSite + "\", \"trace\": \"" + $e->StackTrace + "\"}";
        }

    }
    private function setBanco($banco, $user, $password){
        if(!strpos($banco, "\\") && !strpos($banco, "/")){
            $this->strUser = $user;
            $this->strPassword = $password;

            $this->conn->Open("DSN=" . $banco, $user, $password);
            $banco = $this->conn->DefaultDatabase;
            $this->conn->Close();
        }

        $this->strConn .= "\"" . $banco . "\"";
        $this->strConn .= ";Persist Security Info=False;";

        if(!empty($user))
        {
            $this->strUser  = "";
            $this->strConn .= "User ID=". $user .";";
        }
        if(!empty($password))
        {
            $this->strPassword = "";
            $this->strConn    .= "Jet OLEDB:Database Password='". $password ."';";
        }
    }
    public function tablesInfo($tipo = "TABLE", $bol_serialize = false){
        try{
            $catalog = new COM("ADOX.Catalog");
            $catalog->ActiveConnection = $this->conn;
            $tables = $catalog->Tables;
            $resp = $this->serializeTables($tables, $tipo, $bol_serialize);
            return $resp;
        }catch(AError $e){
            $this->conn->Close();
            return "{\"code\":" + $e->HResult + ", \"message\":\"" + $e->Message + "\", \"target\": \"" + $e->TargetSite + "\", \"trace\": \"" + $e->StackTrace + "\"}";
        }
    }
    public function columnsInfo($tableName, $bol_serialize){
        try
        {
            $catalog = new COM("ADOX.Catalog");
            $catalog->ActiveConnection = $this->conn;
            $table = $catalog->Tables[$tableName];
            $resp = $this->serializeColumns($table, $bol_serialize);
            return $resp;
        }
        catch (AError $e)
        {
            $this->conn->Close();
            return "{\"code\":" + $e->HResult + ", \"message\":\"" + $e->Message + "\", \"target\": \"" + $e->TargetSite + "\", \"trace\": \"" + $e->StackTrace + "\"}";
        }
    }
    public function indexesInfo($tableName, $bol_serialize){
        try
        {
            $catalog = new COM("ADOX.Catalog");
            $catalog->ActiveConnection = $this->conn;
            $table = $catalog->Tables[$tableName];
            $resp = $this->serializeIndexes($table, $bol_serialize);
            return $resp;
        }
        catch(AError $e)
        {
            $this->conn->Close();
            return "{\"code\":" + $e->HResult + ", \"message\":\"" + $e->Message + "\", \"target\": \"" + $e->TargetSite + "\", \"trace\": \"" + $e->StackTrace + "\"}";
        }
    }
    public function relationsInfo($tableName, $bol_serialize){
        try
        {
            $catalog = new COM("ADOX.Catalog");
            $catalog->ActiveConnection = $this->conn;
            $table = $catalog->Tables[$tableName];
            $resp = $this->serializeRelations($table, $bol_serialize);
            return $resp;
        }
        catch(AError $e)
        {
            $this->conn->Close();
            return "{\"code\":" + $e->HResult + ", \"message\":\"" + $e->Message + "\", \"target\": \"" + $e->TargetSite + "\", \"trace\": \"" + $e->StackTrace + "\"}";
        }
    }
    public function relationsInfoAll($bol_serialize){
        try
        {
            $catalog = new COM("ADOX.Catalog");
            $catalog->ActiveConnection = $this->conn;
            $tables = $catalog->Tables;
            $resp = $this->serializeRelationsAll($tables, $bol_serialize);
            return $resp;
        }
        catch(AError $e)
        {
            $this->conn->Close();
            return "{\"code\":" + $e->HResult + ", \"message\":\"" + $e->Message + "\", \"target\": \"" + $e->TargetSite + "\", \"trace\": \"" + $e->StackTrace + "\"}";
        }
    }
    private function serializeTables($tables, $tipo, $bol_serialize){
        $list = array();
        $i = 0;
        foreach ($tables as $table) {
            $isTipo = false;
            if(substr($tipo, 0, 1) == "!"){
                $isTipo = ($table->Type != substr($tipo, 1));
            }else{
                $isTipo = ($table->Type == $tipo);
            }
            if(empty($tipo) || $isTipo){
                $dic = array();
                if($table->Type == "LINK"){
                    $file = $table->Properties["Jet OLEDB:Link Datasource"]->Value . "\\" . $table->Properties["Jet OLEDB:Remote Table Name"]->Value;
                    $file = str_replace("#", ".", $file);
                    $file = str_replace("\\", "/", $file);
                    if(!file_exists($file)){
                        $dic["id"] = $i++;
                        $dic["name"] = utf8_encode($table->Name);
                        $dic["data_created"] = (string) $table->DateCreated;
                        $dic["last_updated"] = (string) $table->DateModified;
                        $dic["type"] = $table->Type;
                        $dic["Error"] = "Missing Linked Table";
                        array_push($list, $dic);
                        continue;
                    }
                }
                $dic["id"] = $i++;
                $dic["name"] = utf8_encode($table->Name);
                $dic["data_created"] = (string) $table->DateCreated;
                $dic["last_updated"] = (string) $table->DateModified;
                $dic["fields"] = $table->Columns->Count;
                $dic["indexes"] = $table->Indexes->Count;
                $dic["attribute"] = $this->defTableAttribute($table);
                $dic["type"] = $table->Type;
                array_push($list, $dic);

            }
        }
        if($bol_serialize)
        {
            $list = json_encode($list);
        }
        return $list;
    }
    private function serializeColumns($table, $bol_serialize){
        $list = array();
        $antTable = "";
        $tbFields;
        $rs;
        $columns = $table->Columns;
        $tbFields = $this->getColumns($table->Name);
        $posicoes = $this->getColumnsIndex($tbFields);
        foreach ($tbFields as $field) {
            $dic = array();
            $column = $table->columns[$field->Name];
            $dic["name"] = utf8_encode($column->Name);
            $dic["allow_zero_length"] = $column->Properties["Jet OLEDB:Allow Zero Length"]->Value;
            $dic["default_value"] = $column->Properties["Default"]->Value;
            $dic["ordinal_position"] = $posicoes[$column->name];
            $dic["attributes"] = $this->defColumnAttribute($column, $tbFields);
            if($column->Attributes == 2){
                $dic["required"] = false;
            }else{
                $dic["required"] = true;
            }
            $dic["size"] = $tbFields[$column->Name]->DefinedSize;
            $dic["type"] = $this->getDataType((int)$column->Type);
            $dic["collating_order"] = $tbFields[$column->Name]->Properties["COLLATINGSEQUENCE"]->Value;
            if ((Boolean)$column->Properties["AutoIncrement"]->Value)
            {
                $dic["auto_incr_field"] = "S";
            }
            else
            {
                $dic["auto_incr_field"] = "N";
            }
            $dic["decimal"] = $tbFields[$column->Name]->NumericScale;
            $dic["unicode"] = $column->Properties["Jet OLEDB:Compressed UNICODE Strings"]->Value;
            array_push($list, $dic);
        }
        if($bol_serialize)
        {
            $list = json_encode($list);
        }
        return $list;
    }
    private function serializeIndexes($table, $bol_serialize){
        $list = array();
        foreach ($table->Indexes as $index)
        {
            $dic = array();
            $dic["name"]  = utf8_encode($index->Name);
            $dic["clustered"] = $index->Clustered;
            $indFields = "";
            $dic["foreign"] = false;
            foreach ($index->Columns as $col)
            {
                $keys = $table->Keys;
                foreach ($keys as $key)
                {
                    if ($key->Type == 2)
                    {
                        try
                        {
                            $colKey = $key->Columns[$col->Name];
                            $dic["foreign"] = true;
                            break;
                        }
                        catch(Exception $e){
                        }
                    }
                }
                $indFields .= ("+" . $col->Name);
            }
            $dic["fields"] = utf8_encode($indFields);
            $dic["ignore_nulls"] = $index->IndexNulls;
            $dic["primary"] = $index->PrimaryKey;
            $dic["required"] = $index->IndexNulls;
            $dic["unique"] = $index->Unique;
            $dic["table"] = utf8_encode($table->Name);
            array_push($list, $dic);
        }
        if($bol_serialize)
        {
            $list = json_encode($list);
        }
        return $list;
    }
    private function serializeRelations($table, $bol_serialize){
        $list = array();
        $keys = $table->Keys;
        if ($keys->Count == 0)
        {
            return "[]";
        }
        foreach ($keys as $key)
        {
            if ($key->Type == 2)
            {
                $dic = array();
                $dic["name"] = utf8_encode($key->Name);
                $dic["table"] = utf8_encode($table->Name);
                $dic["foreign_table"] = utf8_encode($key->RelatedTable);
                if ($key->Type == 3)
                {
                    $dic["attributes"] = 1;
                }
                else if ($key->DeleteRule == 1)
                {
                    $dic["attributes"] = 4096;
                }
                else if ($key->UpdateRule == 1)
                {
                    $dic["attributes"] = 256;
                }
                else
                {
                    $dic["attributes"] = 0;
                }
                foreach ($key->Columns as $column)
                {
                    $dicCol = array();
                    $dicCol["name"] = utf8_encode($column->Name);
                    $dicCol["foreign_name"] = utf8_encode($column->RelatedColumn);
                    $dic["fields"] = $dicCol;
                }
                array_push($list, $dic);
            }
        }
        if($bol_serialize)
        {
            $list = json_encode($list);
        }
        return $list;
    }
    private function serializeRelationsAll($tables, $bol_serialize){
        $list = array();
        foreach ($tables as $table) {
            $keys = $table->Keys;
            foreach ($keys as $key)
            {
                if ($key->Type == 2)
                {
                    $dic = array();
                    $dic["name"] = utf8_encode($key->Name);
                    $dic["table"] = utf8_encode($table->Name);
                    $dic["foreign_table"] = utf8_encode($key->RelatedTable);
                    if ($key->Type == 3)
                    {
                        $dic["attributes"] = 1;
                    }
                    else if ($key->DeleteRule == 1)
                    {
                        $dic["attributes"] = 4096;
                    }
                    else if ($key->UpdateRule == 1)
                    {
                        $dic["attributes"] = 256;
                    }
                    else
                    {
                        $dic["attributes"] = 0;
                    }
                    foreach ($key->Columns as $column)
                    {
                        $dicCol = array();
                        $dicCol["name"] = utf8_encode($column->Name);
                        $dicCol["foreign_name"] = utf8_encode($column->RelatedColumn);
                        $dic["fields"] = $dicCol;
                    }
                    array_push($list, $dic);
                }
            }
        }
        if($bol_serialize)
        {
            $list = json_encode($list);
        }
        return $list;
    }
    private function defColumnAttribute($column, $fields){
        if ((Boolean)$column->Properties["AutoIncrement"]->Value)
        {
            return 16;
        }
        else if ($column->Attributes == 1)
        {
            return 1;
        }
        else if ((Boolean)$column->Properties["Jet OLEDB:Hyperlink"]->Value)
        {
            return 32768;
        }
        else if ($fields[$column->Name]->Attributes == 4)
        {
            return 32;
        }
        else if ($column->Attributes != 1)
        {
            return 2;
        }
        return 0;
    }
    private function getColumns($tableName){
        $rs = new COM("ADODB.Recordset");
        $sql = "SELECT TOP 1 * FROM [$tableName]";
        $rs->Open($sql, $this->conn);
        return $rs->Fields;
    }
    private function getColumnsIndex($fields){
        $resp = array();
        $quant = $fields->Count;
        $x = 1;
        for($i = 0; $i < $quant; $i++){
            $resp[$fields[$i]->Name] = $x++;
        }
        return $resp;
    }
    private function getDataType($type){
        $strTipo;
        switch ($type)
        {
            case 202:
                $strTipo = "text";
                break;
            case 20:
                $strTipo = "big_int";
                break;
            case 17:
                $strTipo = "byte";
                break;
            case 130:
                $strTipo = "char";
                break;
            case 204:
                $strTipo = "binary";
                break;
            case 11:
                $strTipo = "boolean";
                break;
            case 6:
                $strTipo = "char";
                break;
            case 7:
                $strTipo = "date";
                break;
            case 131:
                $strTipo = "decimal";
                break;
            case 5:
                $strTipo = "double";
                break;
            case 72:
                $strTipo = "guid";
                break;
            case 2:
                $strTipo = "integer";
                break;
            case 3:
                $strTipo = "long";
                break;
            case 205:
                $strTipo = "long_binary";
                break;
            case 203:
                $strTipo = "memo";
                break;
            case 139:
                $strTipo = "numeric";
                break;
            case 4:
                $strTipo = "single";
                break;
            case 134:
                $strTipo = "time";
                break;
            case 135:
                $strTipo = "timestamp";
                break;
            default:
                $strTipo = "Undefened";
                break;
        }
        return $strTipo;
    }
    private function defTableAttribute($table){
        if ($table->Properties["Jet OLEDB:Exclusive Link"]->Value)
        {
            return 65537;
        }
        elseif($table->Properties["Jet OLEDB:Cache Link Name/Password"]->Value)
        {
            return 131073;
        }
        else if ($table->Type == "LINK")
        {
            return 1073741825;
        }
        else if ($table->Type == "PASS-THROUGH")
        {
            return 536870913;
        }
        else
        {
            return 0;
        }
    }
    public function close(){
        $this->conn->Close();
    }
}
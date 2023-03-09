<?php
/* Classes ancestrais */
nm_load_class('xmlparser', 'XmlparserIni');

/* Definicao da classe */
class nmXmlparserIniDatatype extends nmXmlparserIni
{
    /**
     * Valores default.
     *
     * Array com valores default do banco de dados.
     *
     * @access  protected
     * @var     array
     */
    var $default;

    /* ----- Construtor e Destrutor ------------------------------------ */

    /**
     * Construtor da classe.
     *
     * Seta o elemento raiz do XML.
     *
     * @access  public
     * @param   string  $v_str_dbms  Banco de dados.
     * @global  array   $nm_config   Array com configuracao do ScriptCase.
     */
    function __construct($v_str_dbms)
    {
        global $nm_config;
        $this->SetRoot('database');
        $this->SetDir($nm_config['path_scriptcase'] . 'type/');
        $this->SetFile($v_str_dbms);
    } // nmXmlparserIniDatatype

    /* ----- Metodos Protegidos ---------------------------------------- */

    /**
     * Normaliza estrutura de dados.
     *
     * Normaliza estrutura retornada pelo EZXML para uso no sistema.
     *
     * @access  protected
     * @param   array      $v_arr_ezxml  Array do EZXML.
     * @return  array      $arr_xml      Array do ScriptCase.
     */
    function Normalize($v_arr_ezxml)
    {
        /* Inicia estrutura do XML */
        $arr_def = array();
        $arr_xml = array('dbms' => '', 'datatypes' => array(), 'default' => $arr_def);
        /* Carrega dados do XML */
        if (isset($v_arr_ezxml['database']['children']) && is_array($v_arr_ezxml['database']['children']))
        {
            foreach ($v_arr_ezxml['database']['children'] as $arr_db_node)
            {
                $str_tag_base = key($arr_db_node);
                if ('datatypes' == $str_tag_base)
                {
                    $arr_datatypes = array();
                    foreach ($arr_db_node[$str_tag_base]['children'] as $arr_dtype_node)
                    {
                        $arr_type = array();
                        foreach ($arr_dtype_node['type']['children'] as $arr_type_node)
                        {
                            $str_tag_type            = key($arr_type_node);
                            $arr_type[$str_tag_type] = $this->HandleCharsBack($arr_type_node[$str_tag_type]['content']);
                        }
                        $arr_datatypes[$arr_type['db']] = $arr_type['nm'];
                        if ('yes' == $arr_type['standard'])
                        {
                            $arr_def[$arr_type['nm']] = $arr_type['db'];
                        }
                    }
                    $arr_xml['datatypes'] = $arr_datatypes;
                }
                else
                {
                    $arr_xml[$str_tag_base] = $this->HandleCharsBack($arr_db_node[$str_tag_base]['content']);
                }
            }
        }
        $arr_xml['default'] = $arr_def;
        return $arr_xml;
    } // Normalize

    /* ----- Metodos Publicos ------------------------------------------ */

    /**
     * Cria string XML.
     *
     * Cria string XML a partir dos dados atuais.
     *
     * @access  public
     * @return  string  $str_xml  String do XML.
     */
    function Create()
    {
        $str_xml   = "<?xml version=\"1.0\" encoding=\"iso-8859-1\" ?>\n";
        $str_xml  .= "<database>\n";
        $str_xml  .= " <dbms>" . $this->HandleChars($this->GetTag('dbms')) . "</dbms>\n";
        $str_xml  .= " <datatypes>\n";
        $arr_types = $this->GetTag('datatypes');
        $arr_def   = $this->GetTag('default');
        if (!empty($arr_type))
        {
            foreach ($arr_types as $str_data_db => $str_data_nm)
            {
                $str_def  = (isset($arr_def[$str_data_nm])) ? 'yes' : 'no';
                $str_xml .= "  <type>\n";
                $str_xml .= "   <nm>"       . $this->HandleChars($str_data_nm) . "</nm>\n";
                $str_xml .= "   <db>"       . $this->HandleChars($str_data_db) . "</db>\n";
                $str_xml .= "   <standard>" . $this->HandleChars($str_def)     . "</standard>\n";
                $str_xml .= "  </type>\n";
            }
        }
        $str_xml .= " </datatypes>\n";
        $str_xml .= '</database>';
        return $str_xml;
    } // Create
}
/*
*/
?>
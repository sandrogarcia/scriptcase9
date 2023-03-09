<?php
/* Classes ancestrais */
nm_load_class('xmlparser', 'XmlparserIni');

/* Definicao da classe */
class nmXmlparserIniDefinition extends nmXmlparserIni
{


    var $erros;
    var $teste;
    var $table;
    var $fields;
    var $subtypes;
    var $indexes;
    var $index;
    var $fields_in;
    var $tipo;
    /* ----- Construtor e Destrutor ------------------------------------ */

    /**
     * Construtor da classe.
     *
     * Seta o elemento raiz do XML.
     *
     * @access  public
     * @param   string  $v_str_group  Grupo de trabalho do ScriptCase.
     * @global  array   $nm_config    Array com configuracao do ScriptCase.
     */
    function __construct($v_str_group, $v_str_file = 'dbmanager')
    {
        global $nm_config;
        if (!@is_dir($nm_config['path_grp'] . $v_str_group . '/def/'))
        {
            nm_dir_create($nm_config['path_grp'] . $v_str_group . '/def/');
        }
        $this->SetRoot('database');
        $this->SetDir($nm_config['path_grp'] . $v_str_group . '/def/');
        $this->SetFile($v_str_file);
    } // nmXmlparserIniDefinition

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
        $str_xml  = "<?xml version=\"1.0\" encoding=\"iso-8859-1\" ?>\n";
        $str_xml .= "<database>\n";
        $arr_xml  = $this->GetTag('database');
        $str_xml .= "<desc>"        . $this->HandleChars($this->GetTag('desc'))        . "</desc>\n";
        $str_xml .= "<user>"        . $this->HandleChars($this->GetTag('user'))        . "</user>\n";
        $str_xml .= "<dbms>"        . $this->HandleChars($this->GetTag('dbms'))        . "</dbms>\n";
        $str_xml .= "<dt_created>"  . $this->HandleChars($this->GetTag('dt_created'))  . "</dt_created>\n";
        $str_xml .= "<dt_modified>" . $this->HandleChars($this->GetTag('dt_modified')) . "</dt_modified>\n";

        if (!empty($arr_xml))
        {
            $arr_ord  = array_keys($arr_xml);
            $arr_sort = array();
            natcasesort($arr_ord);
            foreach ($arr_ord as $str_table)
            {
                $arr_sort[$str_table] = $arr_xml[$str_table];
            }
            $arr_xml = $arr_sort;
            foreach ($arr_xml as $str_table => $arr_table)
            {
                $str_xml .= "<tb name=\"" . $this->HandleChars($str_table) . "\">\n";
                $str_xml .= "<fds>\n";
                foreach ($arr_table['fields'] as $str_field => $arr_field)
                {
                    $str_xml .= "<fd name=\"" . $this->HandleChars($str_field) . "\">\n";
                    foreach ($arr_field as $str_tag => $mix_val)
                    {
                        $str_tag  = strtolower($str_tag);
                        if ('subtypes' == $str_tag)
                        {
                            if(is_array($mix_val))
                            {
                                foreach ($mix_val as $str_sub_dbms => $str_sub_type)
                                {
                                     $str_xml .= "<stp name=\"$str_sub_dbms\">" . $this->HandleChars($str_sub_type);                                     $str_xml .= "</stp>\n";
                                }
                            }
                        }

                        if($mix_val!="")
                        {
                            if('size' == $str_tag)
                            {
                                $str_xml .= "<s>" . $this->HandleChars($mix_val) . "</s>\n";
                            }elseif('default' == $str_tag)
                            {
                                $str_xml .= "<d>" . $this->HandleChars($mix_val) . "</d>\n";
                            }elseif('attrib' == $str_tag)
                            {
                                $str_xml .= "<a>" . $this->HandleChars($mix_val) . "</a>\n";
                            }elseif('null' == $str_tag)
                            {
                                $str_xml .= "<n>" . $this->HandleChars($mix_val) . "</n>\n";
                            }elseif('extra' == $str_tag)
                            {
                                $str_xml .= "<e>" . $this->HandleChars($mix_val) . "</e>\n";
                            }elseif('f_desc' == $str_tag)
                            {
                                $str_xml .= "<f_desc>" . $this->HandleChars($mix_val) . "</f_desc>\n";
                            }
                        }
                    }
                    $str_xml .= "</fd>\n";
                }
                $str_xml .= "</fds>\n";
                $str_xml .= "<ids>\n";
                if (isset($arr_table['indexes']))
                {
                    $arr_ord  = array_keys($arr_table['indexes']);
                    natcasesort($arr_ord);
                    $arr_sort = array();
                    foreach ($arr_ord as $str_index)
                    {
                        $arr_sort[$str_index] = $arr_table['indexes'][$str_index];
                    }
                    $arr_table['indexes'] = $arr_sort;
                    foreach ($arr_table['indexes'] as $str_field => $arr_field)
                    {
                        $str_xml .= "<id name=\"" . $this->HandleChars($str_field) . "\">\n";
                        foreach ($arr_field as $str_tag => $str_val)
                        {
                            if ('type' == $str_tag)
                            {
                                $str_tag  = strtolower($str_tag);
                                $str_xml .= "<type>" . $this->HandleChars($str_val) . "</type>\n";
                            }elseif ('table' == $str_tag)
                            {
                                $str_tag  = strtolower($str_tag);
                                $str_xml .= "<tb_r>" . $this->HandleChars($str_val) . "</tb_r>\n";
                            }
                            else
                            {
                                $str_xml .= "<fds_id>\n";
                                foreach ($str_val as $str_index_field => $str_index_refer)
                                {
                                    $str_xml .= "<fd_id ref=\"" . $this->HandleChars($str_index_refer) . "\">" . $this->HandleChars($str_index_field) . "</fd_id>\n";
                                }
                                $str_xml .= "</fds_id>\n";
                            }
                        }
                        $str_xml .= "</id>\n";
                    }
                }
                $str_xml .= "</ids>\n";
                if(!isset($arr_table['desc']))
                {
                    $arr_table['desc'] = "";
                }
                $str_xml .= "<d_tb>" . $this->HandleChars($arr_table['desc']) . "</d_tb>\n";
                $str_xml .= "<tbtp";
                if (isset($arr_table['info']) && count($arr_table['info'])>0)
                {

                    $arr_ord  = array_keys($arr_table['info']);
                    natcasesort($arr_ord);
                    $arr_sort = array();
                    foreach ($arr_ord as $str_index)
                    {
                        $arr_sort[$str_index] = $arr_table['info'][$str_index];
                    }
                    $arr_table['info'] = $arr_sort;
                    foreach ($arr_table['info'] as $str_dbms => $arr_dbms)
                    {
                        $str_xml .= " name=\"$str_dbms\">";
                        foreach ($arr_dbms as $str_tag => $str_val)
                        {
                                $str_xml .= $this->HandleChars($str_val);
                        }
                    }
                }else
                {
                    $str_xml .= " name=\"\">";
                }
                $str_xml .= "</tbtp>\n";
                $str_xml .= "</tb>\n";
            }
        }
        $str_xml .= "</database>";
        return $str_xml;
    } // Create
}
?>
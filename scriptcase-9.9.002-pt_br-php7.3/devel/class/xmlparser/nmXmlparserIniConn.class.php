<?php
/* Classes ancestrais */
nm_load_class('xmlparser', 'XmlparserIni');

/* Definicao da classe */
class nmXmlparserIniConn extends nmXmlparserIni
{
    var $conn_data;
    var $conn_filt;
    var $conn_name;

    /* ----- Construtor e Destrutor ------------------------------------ */

    /**
     * Construtor da classe.
     *
     * Seta o nome e o caminho do arquivo de inicializacao.
     *
     * @access  public
     * @param   string  $v_str_path  Caminho do arquivo de configuracao.
     * @global  array   $nm_config   Array com configuracao do ScriptCase.
     */
    function __construct($v_str_path = '')
    {
        global $nm_config;
        $this->SetRoot('connections');
        if ('' != $v_str_path)
        {
            $this->SetDir($v_str_path);
        }
        else
        {
            $this->SetDir($nm_config['path_scriptcase']);
        }
        $this->SetFile('connection');
    } // nmXmlparserIniConn

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
        $arr_xml = array('connections' => array());
        /* Carrega dados do XML */
        if (isset($v_arr_ezxml['connections']['children']) && is_array($v_arr_ezxml['connections']['children']))
        {
            /* Recupera conexoes */
            foreach ($v_arr_ezxml['connections']['children'] as $arr_nodes)
            {
                /* Inicializa nome e estrutura da conexao */
                $str_name = $arr_nodes['connection']['attributes']['name'];
                $arr_data = array('dbms'       => '',
                                  'host'       => '',
                                  'user'       => '',
                                  'pass'       => '',
                                  'base'       => '',
                                  'decimal'    => '.',
                                  'repository' => '',
                                  'filters'    => array('show_table'     => 'Y',
                                                        'show_view'      => 'Y',
                                                        'show_system'    => 'N',
                                                        'show_procedure' => 'N',
                                                        'list'           => array()
                                                       )
                                 );
                /* Percorre os dados da conexao */
                foreach ($arr_nodes['connection']['children'] as $arr_conn)
                {
                    $str_key = key($arr_conn);
                    /* Armazena dados da conexao */
                    if ('filters' != $str_key)
                    {
                        $arr_data[$str_key] = $arr_conn[$str_key]['content'];
                    }
                    /* Recupera os filtros */
                    else
                    {
                        /* Percorre os filtros */
                        foreach ($arr_conn['filters']['children'] as $arr_filter)
                        {
                            /* Armazena os dados dos filtros */
                            $str_key = key($arr_filter);
                            if ('filter_list' != $str_key)
                            {
                                $arr_data['filters'][$str_key] = $arr_filter[$str_key]['content'];
                            }
                            /* Recupera as regras dos filtros */
                            elseif (!empty($arr_filter['filter_list']['children']))
                            {
                                foreach ($arr_filter['filter_list']['children'] as $arr_filter_list)
                                {
                                    $arr_rule = array();
                                    foreach ($arr_filter_list['filter_item']['children'] as $arr_filter_data)
                                    {
                                        $str_key = key($arr_filter_data);
                                        $arr_rule[$str_key] = $arr_filter_data[$str_key]['content'];
                                    }
                                    $arr_data['filters']['list'][] = $arr_rule;
                                }
                            }
                        }
                    }
                }
                $arr_xml['connections'][$str_name] = $arr_data;
            }
        }
        return $arr_xml;
    } // Normalize

    /**
     * Organiza as conexoes.
     *
     * Organiza a lista de conexoes de maneira alfabetica.
     *
     * @access  protected
     */
    function SortConnections()
    {
        $arr_conn = $this->GetTag('connections');
        $arr_keys = array_keys($arr_conn);
        $arr_sort = array();
        natcasesort($arr_keys);
        foreach ($arr_keys as $str_key)
        {
            $arr_sort[$str_key] = $arr_conn[$str_key];
        }
        $this->SetTag('connections', $arr_sort);
    } // SortConnections

    /* ----- Metodos Publicos ------------------------------------------ */

    /**
     * Adiciona uma conexao.
     *
     * Adiciona uma conexao a lista de conexoes carregada.
     *
     * @access  public
     * @param   string  $v_str_conn  Nome da conexao.
     * @param   array   $v_arr_data  Dados da conexao.
     */
    function AddConnection($v_str_conn, $v_arr_data)
    {
        $arr_conn = $this->GetTag('connections');
        $arr_conn[$v_str_conn] = $v_arr_data;
        if (!isset($arr_conn[$v_str_conn]['repository']))
        {
            $arr_conn[$v_str_conn]['repository'] = '';
        }
        if (!isset($arr_conn[$v_str_conn]['filters']))
        {
            $arr_conn[$v_str_conn]['filters'] = array('show_table'     => 'Y',
                                                      'show_view'      => 'Y',
                                                      'show_system'    => 'N',
                                                      'show_procedure' => 'N',
                                                      'list'           => array()
                                                     );
        }
        $this->SetTag('connections', $arr_conn);
        $this->SortConnections();
    } // AddConnection

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
        $arr_conn = $this->GetTag('connections');
        $str_xml  = "<?xml version=\"1.0\" encoding=\"iso-8859-1\" ?>\n";
        $str_xml .= "<connections>\n";
        foreach ($arr_conn as $str_conn => $arr_data)
        {
            if ('netmake' != strtolower($str_conn))
            {
                if (!isset($arr_data['decimal']))
                {
                    $arr_data['decimal'] = '.';
                }
                $str_xml .= " <connection name=\"" . $this->HandleChars($str_conn)                              . "\">\n";
                $str_xml .= "  <dbms>"             . $this->HandleChars($arr_data['dbms'])                      . "</dbms>\n";
                $str_xml .= "  <host>"             . $this->HandleChars($arr_data['host'])                      . "</host>\n";
                $str_xml .= "  <user>"             . $this->HandleChars($arr_data['user'])                      . "</user>\n";
                $str_xml .= "  <pass>"             . $this->HandleChars($arr_data['pass'])                      . "</pass>\n";
                $str_xml .= "  <base>"             . $this->HandleChars($arr_data['base'])                      . "</base>\n";
                $str_xml .= "  <decimal>"          . $this->HandleChars($arr_data['decimal'])                   . "</decimal>\n";
                $str_xml .= "  <repository>"       . $this->HandleChars($arr_data['repository'])                . "</repository>\n";
                $str_xml .= "  <filters>\n";
                $str_xml .= "   <show_table>"      . $this->HandleChars($arr_data['filters']['show_table'])     . "</show_table>\n";
                $str_xml .= "   <show_view>"       . $this->HandleChars($arr_data['filters']['show_view'])      . "</show_view>\n";
                $str_xml .= "   <show_system>"     . $this->HandleChars($arr_data['filters']['show_system'])    . "</show_system>\n";
                $str_xml .= "   <show_procedure>"  . $this->HandleChars($arr_data['filters']['show_procedure']) . "</show_procedure>\n";
                $str_xml .= "   <filter_list>\n";
                if (!empty($arr_data['filters']['list']))
                {
                    foreach ($arr_data['filters']['list'] as $arr_item)
                    {
                        $str_xml .= "   <filter_item>\n";
                        $str_xml .= "    <filter_table>" . $this->HandleChars($arr_item['filter_table']) . "</filter_table>\n";
                        $str_xml .= "    <filter_owner>" . $this->HandleChars($arr_item['filter_owner']) . "</filter_owner>\n";
                        $str_xml .= "    <filter_show>"  . $this->HandleChars($arr_item['filter_show'])  . "</filter_show>\n";
                        $str_xml .= "   </filter_item>\n";
                    }
                }
                $str_xml .= "   </filter_list>\n";
                $str_xml .= "  </filters>\n";
                $str_xml .= " </connection>\n";
            }
        }
        $str_xml .= "</connections>\n";
        return $str_xml;
    } // Create
}

?>
<?php
/* Classes ancestrais */
nm_load_class('xmlparser', 'Xmlparser');

/* Definicao da classe */
class nmXmlparserRSS extends nmXmlparser
{
    /* ----- Construtor e Destrutor ------------------------------------ */

    /**
     * Construtor da classe.
     *
     * Seta o elemento raiz do XML.
     *
     * @access  public
     */
    function __construct()
    {
        $this->SetRoot('rss');
    } // nmXmlparserRSS

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
        $arr_xml = $this->LoadDefaults();

        /* Carrega dados do XML */
        if (isset($v_arr_ezxml['rss']['children']) && is_array($v_arr_ezxml['rss']['children']))
        {
            foreach ($v_arr_ezxml['rss']['children'] as $key => $arr_nodes)
            {
                $str_node = key($arr_nodes);
	            if (isset($arr_nodes[$str_node]['children']))
					$arr_xml['rss'][strtolower($str_node)] = $this->ChildrenProcess($arr_nodes[$str_node]['children']);
				else
				{
					$str_content	= $this->HandleCharsBack($arr_nodes[$str_node]['content']);
					if (!is_utf8($str_content))
					{
						$str_content = mb_convert_encoding($str_content, "UTF-8");
					}

					$arr_xml['rss'][strtolower($str_node)] = $str_content;
				}
            }
        }

        return $arr_xml;
    } // Normalize

    function NormalizeSimpleXML($v_str_xml)
    {
        /* Inicia estrutura do XML */
        $arr_xml = $this->LoadDefaults();

		if (is_utf8($v_str_xml))
		{
			$v_str_xml = utf8_decode($v_str_xml);
		}
		$v_str_xml = str_replace('&', htmlentities('&'),  $v_str_xml);

        /* Carrega dados do XML */
        $obj_xml = simplexml_load_string(trim($v_str_xml));
        if ($obj_xml)
        {
            $cont_item = 0;

	        foreach ($obj_xml as $k => $v)
	        {
	            if ($k == 'channel')
	            {
    	            $arr_xml['rss']['channel'] = array();

    	            foreach ($v as $i_channel => $v_channel)
    	            {
    	                switch ($i_channel)
    	                {
    	                    case 'item':
    	                       $arr_xml['rss']['channel']['item'][$cont_item] = array();

    	                       foreach ($v_channel as $i_item => $v_item)
    	                       {
    	                           $arr_xml['rss']['channel']['item'][$cont_item][strtolower((string) $i_item)] = $this->NodeStrValid((string) $v_item);
    	                       }

    	                       ksort($arr_xml['rss']['channel']['item'][$cont_item]);

    	                       $cont_item++;
    	                       break;

    	                    default:
    	                       $arr_xml['rss']['channel'][strtolower((string)$i_channel)] = $this->NodeStrValid((string) $v_channel);
    	                       break;
    	                }
    	            }

    	            ksort($arr_xml['rss']['channel']);
	            }
	        }
        }

        ksort($arr_xml);

        return $arr_xml;
    } // NormalizeSimpleXML

    function NodeStrValid($str)
    {
       $str = $this->HandleCharsBack((string) $str);
       if (!is_utf8($str))
       {
          $str = mb_convert_encoding($str, "UTF-8");
       }
       return $str;

    }//NodeStrValid


    function LoadDefaults()
    {
        /* Inicia estrutura do XML */
        $arr_xml['rss'] = array();

        return $arr_xml;

    }//LoadDefaults

    function ChildrenProcess($arr_nodes)
    {
        foreach ($arr_nodes as $arr_button_nodes)
        {
            $str_node = key($arr_button_nodes);
            if (isset($arr_button_nodes[$str_node]['children']))
            {
        		$key_str_node = $str_node;

            	if ($key_str_node != "item")
					$arr_list[$key_str_node]	= $this->ChildrenProcess($arr_button_nodes[$str_node]['children']);
				else
					$arr_list[$key_str_node][]	= $this->ChildrenProcess($arr_button_nodes[$str_node]['children']);
			}
			else
			{
				$str_content = $this->HandleCharsBack($arr_button_nodes[$str_node]['content']);

				if (!is_utf8($str_content))
					$str_content = mb_convert_encoding($str_content, "UTF-8");

            	$arr_list[strtolower($str_node)] = $str_content;
            }
        }
        ksort($arr_list);
        return $arr_list;
	}

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
    } // Create

}

?>
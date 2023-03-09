<?php
/* Classes ancestrais */
nm_load_class('xmlparser', 'XmlparserIni');

/* Definicao da classe */
class nmXmlparserIniLookup extends nmXmlparserIni
{

    var $erros;    //array que guarda erros no leitura do xml pelo expat
    var $arr_xml; //array xml tratado pelo expat
    var $teste;     //dados
    var $lang;
    var $cont;
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
        $this->SetRoot('lookup_def');
    } // nmXmlparserIniLookup

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
        $arr_xml = array('lookup_title' => array(), 'item_list' => array());
        if (isset($v_arr_ezxml['lookup_def']['children']))
        {
            foreach ($v_arr_ezxml['lookup_def']['children'] as $arr_lkp_node)
            {
                $str_key           = key($arr_lkp_node);
                $arr_xml[$str_key] = array();
                if (('lookup_title' == $str_key) &&
                    (isset($arr_lkp_node[$str_key]['children'])))
                {
                    foreach ($arr_lkp_node[$str_key]['children'] as $arr_tit_node)
                    {
                        $str_lang  = $arr_tit_node['title']['attributes']['lang'];
                        $str_title = $arr_tit_node['title']['content'];
                        $arr_xml[$str_key][$str_lang] = $str_title;
                    }
                }
                elseif (('item_list' == $str_key) &&
                        (isset($arr_lkp_node[$str_key]['children'])))
                {
                    foreach ($arr_lkp_node[$str_key]['children'] as $arr_list_node)
                    {
                        if (isset($arr_list_node['lookup_item']['children']))
                        {
                            $arr_item = array();
                            foreach ($arr_list_node['lookup_item']['children'] as $arr_item_node)
                            {
                                $str_tag = key($arr_item_node);
                                $str_val = $arr_item_node[$str_tag]['content'];
                                $arr_item[$str_tag] = $str_val;
                            }
                            $arr_xml[$str_key][] = $arr_item;
                        }
                    }
                }
            }
        }

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
        $str_xml  = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?>\n";
        $str_xml .= "<lookup_def>\n";
        $str_xml .= " <lookup_title>\n";
        foreach ($this->GetTag('lookup_title') as $str_lang => $str_title)
        {
            $str_xml .= "  <title lang=\"" . $this->HandleChars($str_lang) . "\">" . $this->HandleChars($str_title) . "</title>\n";
        }
        $str_xml .= " </lookup_title>\n";
        $str_xml .= " <item_list>\n";
        foreach ($this->GetTag('item_list') as $arr_lookup)
        {
            $str_xml .= "  <lookup_item>\n";
            $str_xml .= "   <label>"     . $this->HandleChars($arr_lookup['label'])     . "</label>\n";
            $str_xml .= "   <value_on>"  . $this->HandleChars($arr_lookup['value_on'])  . "</value_on>\n";
            $str_xml .= "   <value_off>" . $this->HandleChars($arr_lookup['value_off']) . "</value_off>\n";
            $str_xml .= "   <pos_init>"  . $this->HandleChars($arr_lookup['pos_init'])  . "</pos_init>\n";
            $str_xml .= "   <pos_size>"  . $this->HandleChars($arr_lookup['pos_size'])  . "</pos_size>\n";
            $str_xml .= "  </lookup_item>\n";
        }
        $str_xml .= " </item_list>\n";
        $str_xml .= "</lookup_def>";
        return $str_xml;
    } // Create

    function NormalizeSimpleXML($v_str_xml)
    {
        /* Inicia estrutura do XML */
        $arr_xml = $this->LoadDefaults();

		if (strpos($v_str_xml, "encoding=\"iso-8859-1\"") !== false)
		{
			$v_str_xml = str_replace("encoding=\"iso-8859-1\"", "encoding=\"UTF-8\"", $v_str_xml);
		}

		$v_str_xml = str_replace('&', htmlentities('&'),  $v_str_xml);

        /* Carrega dados do XML */
        $obj_xml = simplexml_load_string($v_str_xml);
        if ($obj_xml)
        {
            $this->cont = 0;

	        foreach ($obj_xml as $k => $v)
	        {
	            $k = $this->GetXmlString($k);
	            $arr_xml[$k] = array();

	            switch($k)
	            {
	                case 'lookup_title':

	                   foreach ($v->title as $arr_title)
	                   {
    	                   $arr_xml[$k][(string)$arr_title->attributes()->lang] = $this->HandleCharsBack((string)$arr_title);
	                   }
	                   break;

	                case 'item_list':

	                   foreach ($v->lookup_item as $index => $lookup)
	                   {
	                       $arr_xml[$k][$this->cont] = array();

	                       foreach ($lookup as $k_lookup => $v_lookup)
	                       {
	                           $arr_xml[$k][$this->cont][$k_lookup] = $this->HandleCharsBack((string)$v_lookup);
	                       }

	                       $this->cont++;
	                   }
	            }
	        }
        }
        return $arr_xml;
    } // NormalizeSimpleXML

    function LoadDefaults()
    {
        /* Inicia estrutura do XML */
        $arr_xml['lookup_title'] = array();
        $arr_xml['item_list']    = array();

        return $arr_xml;

    }//LoadDefaults
}

?>
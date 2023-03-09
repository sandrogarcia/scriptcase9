<?php
/* Classes ancestrais */
nm_load_class('xmlparser', 'XmlparserIni');

/* Definicao da classe */
class nmXmlparserIniChart extends nmXmlparserIni
{
    var $in_chart;
    var $tag;

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
        $this->SetRoot('chart');
    } // nmXmlparserIniChart

    /* ----- Metodos Protegidos ---------------------------------------- */

    function ExpatData($v_res_parser, $v_str_data)
    {
        if ('' != $this->tag && 'chart' != $this->tag && $this->in_chart)
        {
        	//protege para ler somente as tags que existem na definicao inicial
        	if(isset($this->arr_xml['chart'][$this->tag]))
        	{
        		$this->arr_xml['chart'][$this->tag] .= $v_str_data;
        	}
        }
    } // ExpatData

    function ExpatEnd($v_res_parser, $v_str_tag)
    {
        if ('chart' == $this->tag)
        {
            $this->in_chart = FALSE;
        }
        $this->tag = '';
    } // ExpatEnd

    function ExpatStart($v_res_parser, $v_str_tag, $v_arr_attr)
    {
        $this->tag = strtolower($v_str_tag);
        if ('chart' == $this->tag)
        {
            $this->in_chart = TRUE;
        }
        elseif ($this->in_chart)
        {
        	//protege para ler somente as tags que existem na definicao inicial
        	if(isset($this->arr_xml['chart'][$this->tag]))
        	{
        		$this->arr_xml['chart'][$this->tag] = '';
        	}
        }
    } // ExpatStart

    /**
     * Normaliza estrutura de dados.
     *
     * Normaliza estrutura retornada pelo EZXML para uso no sistema.
     *
     * @access  protected
     * @param   string     $v_str_xml  String do XML.
     * @return  array      $arr_xml    Array do ScriptCase.
     */
    function NormalizeExpat($v_str_xml)
    {
    	/* Inicia estrutura do XML */
        $this->arr_xml = $this->LoadDefaults();

		if (strpos($v_str_xml, "encoding=\"iso-8859-1\"") !== false)
		{
			$v_str_xml = str_replace("encoding=\"iso-8859-1\"", "encoding=\"UTF-8\"", $v_str_xml);
		}

        /* Carrega dados do XML */
        $this->parser    = xml_parser_create();
        $this->in_chart = FALSE;
        $this->tag       = '';
        xml_set_object($this->parser, $this);
        xml_set_element_handler($this->parser, "ExpatStart", "ExpatEnd");
        xml_set_character_data_handler($this->parser, "ExpatData");
        xml_parse($this->parser, $v_str_xml, TRUE);
        xml_parser_free($this->parser);
        return $this->arr_xml;
    } // NormalizeExpat

    function NormalizeSimpleXML($v_str_xml)
    {
    	/* Inicia estrutura do XML */
        $arr_xml = $this->LoadDefaults();

		if (strpos($v_str_xml, "encoding=\"iso-8859-1\"") !== false)
		{
			$v_str_xml = str_replace("encoding=\"iso-8859-1\"", "encoding=\"UTF-8\"", $v_str_xml);
		}

		/* Carrega dados do XML */
        $obj_xml = simplexml_load_string($v_str_xml);
        if ($obj_xml)
        {
	        foreach ($obj_xml as $k => $v)
	        {
	        	//so entra na leitura do xml, quem existir no xml default
	        	if(isset($arr_xml['chart'][$k]))
	        	{
	        		$arr_xml['chart'][$k] = $this->HandleCharsBack((string)$v);
	        	}
	        }
        }

        return $arr_xml;
    } // NormalizeSimpleXML

    function LoadDefaults()
    {
        $arr_xml = array('chart' => array(
                                            'css_chart_settings_info_name'           => '',
                                            'css_chart_settings_chart_type'          => '',
                                            'css_chart_margin_top'                   => '',
                                            'css_chart_margin_right'                 => '',
                                            'css_chart_margin_bottom'                => '',
                                            'css_chart_margin_left'                  => '',
                                            'css_chart_margin_canvas'                => '',
                                            'css_chart_margin_value'                 => '',
                                            'css_chart_font_color'                   => '',
                                            'css_chart_font_size'                    => '',
                                            'css_chart_background_color'             => '',
                                            'css_chart_background_lines'             => '',
                                            'css_chart_background_line_color'        => '',
                                            'css_chart_background_canvas_color'      => '',
                                            'css_chart_background_pallete_color'     => '',
                                            'css_chart_border_show'                  => '',
                                            'css_chart_border_thickness'             => '',
                                            'css_chart_border_color'                 => '',
                                            'css_chart_border_dashed'                => '',
                                            'css_chart_shadow_show'                  => '',
                                            'css_chart_shadow_3d_lighting'           => '',
                                            'css_chart_others_menu_exp'              => '',
                                               ));

        return $arr_xml;
    } // LoadDefaults

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
		$arr_defaults = $this->LoadDefaults();
        $str_xml  = "<?xml version=\"1.0\" encoding=\"iso-8859-1\" ?>\r\n";
        $str_xml .= "<chart>\r\n";
        foreach ($this->GetTag('chart') as $str_tag => $str_val)
        {
		    if(isset($arr_defaults['chart'][$str_tag]))
			{
				$str_xml .= " <". $str_tag .">" . $this->HandleChars($str_val) . "</". $str_tag .">\r\n";
			}
        }
        $str_xml .= "</chart>";
        return $str_xml;
    } // Create
}

?>
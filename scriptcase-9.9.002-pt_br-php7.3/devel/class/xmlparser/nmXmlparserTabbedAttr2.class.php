<?php
/* Classes ancestrais */
nm_load_class('xmlparser', 'Xmlparser');

/* Definicao da classe */
class nmXmlparserTabbedAttr2 extends nmXmlparser
{
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
         $this->str_id = "Aba_attr2";
		 $this->StartDefault();
    } // nmXmlparserTabbedAttr1

    /**
     * Verifica as variaveis da aplicacao de abas.
     *
     * @access  public
     * @param   array   $v_arr_vars  Lista de variaveis.
     */
    function CheckVars($v_arr_vars)
    {
        $arr_used = array();
        foreach ($v_arr_vars as $str_var)
        {
           // $str_var = strtolower($str_var);
            if (!isset($this->data['var_list'][$str_var]))
            {
                $this->data['var_list'][$str_var] = array('nome'     => $str_var,
                                                          'origem'   => 'GP',
                                                          'opcional' => 'N',
                                                          'tipo'     => 'I');
            }
            $arr_used[] = $str_var;
        }

        if (isset($this->data['var_list']) &&  is_array($this->data['var_list']))
        {
	        foreach ($this->data['var_list'] as $str_var => $arr_var)
	        {
	            if (!in_array($str_var, $arr_used))
	            {
	                unset($this->data['var_list'][$str_var]);
	            }
	        }
        }
    } // CheckVars

    /**
     * Define variaveis.
     *
     * Define as variaveis que entram no comando select.
     *
     * @access  public
     * @param   string   $v_str_sql    Comando SQL.
     * @param   boolean  $v_bol_strip  Retirar comentarios PHP.
     * @return  array    $arr_list     Lista de variaveis.
     */
    public static function RetrieveVarList($v_str_sql)
    {
		global $nm_config;

        preg_match_all($nm_config['ereg_global'], $v_str_sql, $arr_match);
        $arr_list  = array();
        $arr_match = array_unique($arr_match[0]);
        foreach ($arr_match as $str_var)
        {
/*            $str_var = strtolower(substr(substr($str_var, 0, -1), 1)); */
            $str_var = substr(substr($str_var, 0, -1), 1);
            if (!in_array($str_var, $arr_list))
            {
                $arr_list[] = $str_var;
            }
        }
        return $arr_list;
    } // RetrieveVarList

   /**
     * Define variaveis.
     *
     * Define as variaveis de cabecalho.
     *
     * @access  public
     * @param   string  $v_str_head   Dados do cabecalho.
     * @param   string  $v_str_other  Dados dos outros cabecalhos.
     */
    function SetHeader($v_str_head, $v_str_other)
    {
    } // SetHeader
}

?>
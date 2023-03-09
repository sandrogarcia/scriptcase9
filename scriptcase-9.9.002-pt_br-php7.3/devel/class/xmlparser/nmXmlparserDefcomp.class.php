<?php
/* Classes ancestrais */
nm_load_class('xmlparser', 'Xmlparser');

/* Definicao da classe */
class nmXmlparserDefcomp extends nmXmlparser
{
    /**
     * Modulo do complemento.
     *
     * Modulo de edicao da aplicacao para uso do complemento.
     *
     * @access  protected
     * @var     string
     */
    var $mod;

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
        $this->str_id = "Cmp_defc";
		$this->StartDefault();
    } // nmXmlparserDefcomp

	/**
     * Recupera o modulo do complemento.
     *
     * Retorna o modulo do complemento a ser usado.
     *
     * @access  protected
     * @return  string     $str_result  Modulo do complemento.
     */
    function GetMod()
    {
        return $this->mod;
    } // GetMod

    /**
     * Seta o modulo do complemento.
     *
     * Armazena o modulo do complemento a ser usado.
     *
     * @access  protected
     * @param   string     $v_str_mod  Modulo do complemento.
     */
    function SetMod($v_str_mod)
    {
        $this->mod = $v_str_mod;
    } // SetMod
}

?>
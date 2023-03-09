<?php
/* Classes ancestrais */
nm_load_class('xmlparser', 'Xmlparser');

/* Definicao da classe */
class nmXmlparserFieldAjaxDados extends nmXmlparser
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
        $this->str_id = "Cmp_ajax";
		$this->StartDefault();
    } // nmXmlparserFieldAjaxDados

}
?>
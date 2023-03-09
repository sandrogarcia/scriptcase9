<?php
/* Classes ancestrais */
nm_load_class('xmlparser', 'Xmlparser');

/* Definicao da classe */
class nmXmlparserDataDicFieldAttr1 extends nmXmlparser
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
		$this->str_id = "DataDicFieldAttr1";
		$this->StartDefault();
    } // nmXmlparserDataDicFieldAttr1
}
?>
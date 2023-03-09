<?php
/* Classes ancestrais */
nm_load_class('xmlparser', 'Xmlparser');

/* Definicao da classe */
class nmXmlparserFieldAttr5 extends nmXmlparser
{
    /**
     * Construtor da classe.
     *
     * Seta o elemento raiz do XML.
     *
     * @access  public
     */
    function __construct()
    {
        $this->str_id = "Cmp_attr5";
		$this->StartDefault();
    } // nmXmlparserFieldAttr5
}
?>
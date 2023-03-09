<?php
/* Classes ancestrais */
nm_load_class('xmlparser', 'Xmlparser');

/* Definicao da classe */
class nmXmlparserApplicationAttr1 extends nmXmlparser
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
		$this->str_id = "Apl_attr1";
		$this->StartDefault();
    } // nmXmlparserApplicationAttr1
}

?>
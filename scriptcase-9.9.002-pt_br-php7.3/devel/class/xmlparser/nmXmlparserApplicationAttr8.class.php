<?php
/* Classes ancestrais */
nm_load_class('xmlparser', 'Xmlparser');

/* Definicao da classe */
class nmXmlparserApplicationAttr8 extends nmXmlparser
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
        $this->str_id = "Apl_attr8";
		$this->StartDefault();
    } // nmXmlparserApplicationAttr8
}

?>
<?php
/* Classes ancestrais */
nm_load_class('xmlparser', 'Xmlparser');

/* Definicao da classe */
class nmXmlparserTabbedAttr4 extends nmXmlparser
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
        $this->str_id = "Aba_attr4";
		$this->StartDefault();
    } // nmXmlparserTabbedAttr1
}

?>
<?php
/* Classes ancestrais */
nm_load_class('xmlparser', 'XmlparserIni');

/* Definicao da classe */
class nmXmlparserIniSchemaChart extends nmXmlparserIni
{
    var $in_schema;
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
		$this->str_id = "IniSchemaChart";
        $this->SetRoot('schema');
		$this->StartDefault();
    } // nmXmlparserIniSchema
}
?>
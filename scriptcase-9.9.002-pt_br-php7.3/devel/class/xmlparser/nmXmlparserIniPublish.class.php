<?php
/* Classes ancestrais */
nm_load_class('xmlparser', 'XmlparserIni');

/* Definicao da classe */
class nmXmlparserIniPublish extends nmXmlparserIni
{
    /* ----- Construtor e Destrutor ------------------------------------ */
    /* ----- Construtor e Destrutor ------------------------------------ */

    /**
     * Construtor da classe.
     *
     * Seta o elemento raiz do XML.
     *
     * @access  public
     */
    function __construct($cod_prj = '')
    {
        global $nm_config;
        $this->SetDir($nm_config['path_scriptcase']);
        $this->SetFile('publish');

		$this->str_id = "IniPublish";
		$this->StartDefault();
    } // nmXmlparserIniPublish
}
?>
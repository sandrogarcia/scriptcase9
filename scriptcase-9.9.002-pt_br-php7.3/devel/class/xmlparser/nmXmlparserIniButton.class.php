<?php
/* Classes ancestrais */
nm_load_class('xmlparser', 'XmlparserIni');

/* Definicao da classe */
class nmXmlparserIniButton extends nmXmlparserIni
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
        $this->SetRoot('button');
        $this->SetFile('button');

		$this->str_id = "IniButton";
		$this->StartDefault();
    } // nmXmlparserIniButton

    function HandleExceptions($v_arr_unserialize, $v_arr_default = array())
    {
    	return $v_arr_unserialize;
    } // HandleExceptions
}

?>
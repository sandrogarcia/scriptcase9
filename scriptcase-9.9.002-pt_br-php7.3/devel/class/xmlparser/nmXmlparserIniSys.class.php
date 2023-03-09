<?php
/* Classes ancestrais */
nm_load_class('xmlparser', 'XmlparserIni');

/* Definicao da classe */
class nmXmlparserIniSys extends nmXmlparserIni
{
    /* ----- Construtor e Destrutor ------------------------------------ */

    /**
     * Construtor da classe.
     *
     * Seta o nome e o caminho do arquivo de inicializacao.
     *
     * @access  public
     * @param   string  $v_str_path  Caminho para o arquivo de configuracao.
     * @global  array   $nm_config   Array com configuracao do ScriptCase.
     */
    function __construct($v_str_path = '')
    {
        global $nm_config;

        $this->SetRoot('inifile');

        if ('' != $v_str_path)
        {
            $this->SetDir($v_str_path);
        }
        else
        {
        	$this->SetDir($nm_config['path_scriptcase']);
        }

		$this->SetExtension('config.php');

        $this->SetFile('scriptcase');

		$this->str_id = "IniSys";
		$this->StartDefault();
    } // nmXmlparserIniSys

	 /**
     * Carrega arquivo ini.
     *
     * Carrega o conteudo do arquivo de inicializacao.
     *
     * @access  public
     */
    function Load()
    {
        $this->CheckExtension();
        $str_data = '';
        if (is_file($this->GetFilename($this->GetExtension())))
        {
            $str_data = substr(file_get_contents($this->GetFilename($this->GetExtension())), 8, -5);
        }
        $this->Handle($str_data);
    } // Load

	/**
     * Salva arquivo ini.
     *
     * Verifica se o arquivo de inicializacao existe e salva
     * o seu conteudo.
     *
     * @access  public
     */
    function Save()
    {
		$bol_return = false;

        $this->CheckExtension();

        return file_put_contents($this->GetFilename($this->GetExtension()), "<?php /*" . $this->Create() . "*/ ?>");
    } // Save
}

?>
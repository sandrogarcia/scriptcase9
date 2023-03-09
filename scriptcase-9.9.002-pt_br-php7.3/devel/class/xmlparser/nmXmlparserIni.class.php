<?php
/* Classes ancestrais */
nm_load_class('xmlparser', 'Xmlparser');

/* Definicao da classe */
class nmXmlparserIni extends nmXmlparser
{
    /**
     * Diretorio do arquivo ini.
     *
     * Caminho onde esta gravado o arquivo de inicializacao.
     *
     * @access  protected
     * @var     string
     */
    var $dir;

    /**
     * Extensao do arquivo ini.
     *
     * Extensao que ser ausada na gravacao do arquivo de inicializacao.
     *
     * @access  protected
     * @var     string
     */
    var $extension;

    /**
     * Arquivo ini.
     *
     * Nome do arquivo de inicializacao.
     *
     * @access  protected
     * @var     string
     */
    var $file;

    /* ----- Getters & Setters ----------------------------------------- */

    /**
     * Recupera diretorio.
     *
     * Recupera diretorio do arquivo de inicializacao.
     *
     * @access  protected
     * @return  string     $str_result  Diretorio do arquivo.
     */
    function GetDir()
    {
        return $this->dir;
    } // GetDir

    /**
     * Recupera extensao.
     *
     * Recupera a extensao do arquivo de inicializacao.
     *
     * @access  protected
     * @return  string     $str_result  Extensao do arquivo.
     */
    function GetExtension()
    {
        return $this->extension;
    } // GetExtension

    /**
     * Recupera arquivo.
     *
     * Recupera nome do arquivo de inicializacao.
     *
     * @access  protected
     * @return  string     $str_result  Nome do arquivo.
     */
    function GetFile()
    {
        return $this->file;
    } // GetFile

    /**
     * Seta diretorio.
     *
     * Armazena diretorio do arquivo de inicializacao.
     *
     * @access  public
     * @param   string  $v_str_dir  Diretorio do arquivo.
     */
    function SetDir($v_str_dir)
    {
        if (!empty($v_str_dir) && @is_dir($v_str_dir))
        {
            $this->dir = nm_dir_normalize($v_str_dir);
        }
    } // SetDir

    /**
     * Seta extensao.
     *
     * Armazena a extensao do arquivo de inicializacao.
     *
     * @access  pub'lic
     * @param   string  $v_str_extension  Extensao do arquivo.
     */
    function SetExtension($v_str_extension)
    {
        $this->extension = $v_str_extension;
    } // SetExtension

    /**
     * Seta arquivo.
     *
     * Armazena nome do arquivo de inicializacao.
     *
     * @access  public
     * @param   string  $v_str_file  Nome do arquivo.
     */
    function SetFile($v_str_file)
    {
            if ('' != $v_str_file)
        {
            $this->file = $v_str_file;
        }
    } // SetFile

    /**
     * Verifica extensao.
     *
     * Verifica se a extensao do arquivo de inicializacao ja foi definida, caso
     * nao tenha sido, define como .ini
     *
     * @access  protected
     */
    function CheckExtension()
    {
        $str_ext = $this->GetExtension();
        if ((null == $str_ext) || ('' == $str_ext))
        {
            $this->SetExtension('ini');
        }
    } // CheckExtension

    /**
     * Recupera nome do arquivo.
     *
     * Retorna o caminho completo do arquivo.
     *
     * @access  protected
     * @param   string     $v_str_type  Tipo do arquivo.
     * @return  string     $str_result  Caminho completo do arquivo.
     */
    function GetFilename($v_str_type)
    {
        return $this->GetDir() . $this->GetFile() . '.' . $v_str_type;
    } // GetFilename

    /* ----- Metodos Publicos ------------------------------------------ */

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
            $str_data = file_get_contents($this->GetFilename($this->GetExtension()));
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
        $this->CheckExtension();

        file_put_contents($this->GetFilename($this->GetExtension()), $this->Create());

        return FALSE;
    } // Save

    /**
     * Verifica arquivo de inicializacao.
     *
     * Verifica se o arquivo de inicializacao existe.
     *
     * @access  public
     * @return  boolean  $bol_result  TRUE se o arquivo existir, caso contrario
     *                                FALSE.
     */
    function Verify()
    {
		$this->CheckExtension();
		return @is_file($this->GetFilename($this->GetExtension()));
    } // Verify
}

?>
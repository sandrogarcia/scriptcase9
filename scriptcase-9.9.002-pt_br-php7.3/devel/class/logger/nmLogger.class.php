<?php
/* Definicao da classe */
class nmLogger
{
    /**
     * Acao executada.
     *
     * @access  private
     * @var     string
     */
    var $action;

    /**
     * Data e hora da entrada do log.
     *
     * @access  private
     * @var     string
     */
    var $datetime;

    /**
     * Informacoes adicionais da acao executada.
     *
     * @access  private
     * @var     string
     */
    var $extra;

    /**
     * IP do usuario responsavel pelas acoes.
     *
     * @access  private
     * @var     string
     */
    var $ip;

    /**
     * Usuario responsavel pelas acoes.
     *
     * @access  private
     * @var     string
     */
    var $login;

    /**
     * Metodo utilizado para fazer o log.
     *
     * @access  private
     * @var     string
     */
    var $method;

    /**
     * Diretorio utilizado para fazer o log.
     *
     * @access  private
     * @var     string
     */
    var $path;

    /**
     * Flag indicativa de logger ativo.
     *
     * @access  private
     * @var     boolean
     */
    var $started;

    /**
     * Tipo de acao.
     *
     * @access  private
     * @var     string
     */
    var $type;

    /* ----- Construtor e Destrutor ------------------------------------ */

    /**
     * Construtor da classe.
     *
     * Seta o nome da pagina a ser exibida.
     *
     * @access  public
     */
    function __construct()
    {
        $this->Stop();
        $this->SetMethod('file');
        $this->SetPath('iface');
    } // nmLogger

    /* ----- Getters & Setters ----------------------------------------- */

    /**
     * Recupera a acao executada.
     *
     * Recupera a acao executada pelo usuario.
     *
     * @access  private
     * @return  string   $str_result  Acao executada.
     */
    function GetAction()
    {
        return $this->action;
    } // GetAction

    /**
     * Recupera a data e hora da entrada.
     *
     * Recupera a data e hora de entrada do log.
     *
     * @access  private
     * @return  string   $str_result  Data e hora da entrada.
     */
    function GetDateTime()
    {
        return $this->datetime;
    } // GetDateTime

    /**
     * Recupera as informacoes adicionais da acao executada.
     *
     * Recupera as informacoes adicionais da acao executada pelo usuario.
     *
     * @access  private
     * @return  string   $str_result  Informacoes adicionais da acao executada.
     */
    function GetExtra()
    {
        return $this->extra;
    } // GetExtra

    /**
     * Recupera IP.
     *
     * Recupera o IP do usuario ativo.
     *
     * @access  private
     * @return  string   $str_result  IP do usuario.
     */
    function GetIp()
    {
        return $this->ip;
    } // GetIp

    /**
     * Recupera login.
     *
     * Recupera o login do usuario ativo.
     *
     * @access  private
     * @return  string   $str_result  Login do usuario.
     */
    function GetLogin()
    {
        return $this->login;
    } // GetLogin

    /**
     * Recupera metodo de log.
     *
     * Recupera o metodo usado para fazer o log.
     *
     * @access  private
     * @return  string   $str_result  Metodo do log.
     */
    function GetMethod()
    {
        return $this->method;
    } // GetMethod

    /**
     * Recupera diretorio de log.
     *
     * Recupera o diretorio usado para fazer o log.
     *
     * @access  private
     * @return  string   $str_result  Metodo do log.
     */
    function GetPath()
    {
        return $this->path;
    } // GetPath

    /**
     * Recupera o tipo da acao executada.
     *
     * Recupera o tipo da acao executada pelo usuario.
     *
     * @access  private
     * @return  string   $str_result  Tipo da acao executada.
     */
    function GetType()
    {
        return $this->type;
    } // GetType

    /**
     * Verifica se o logger esta iniciado.
     *
     * @access  public
     */
    function IsStarted()
    {
        return $this->started;
    } // IsStarted

    /**
     * Seta oa acao executada.
     *
     * Armazena a acao executada pelo usuario.
     *
     * @access  private
     * @param   string   $v_str_action  Acao executada.
     */
    function SetAction($v_str_action)
    {
        $this->action = $v_str_action;
    } // SetAction

    /**
     * Seta a data e hora da entrada.
     *
     * Armazena a data e hora de entrada do log.
     *
     * @access  private
     */
    function SetDateTime()
    {
        $this->datetime = date('YmdHisu');
    } // SetDateTime

    /**
     * Recupera as informacoes adicionais da acao executada.
     *
     * Recupera as informacoes adicionais da acao executada pelo usuario.
     *
     * @access  private
     * @param   mixed    $v_mix_extra  Informacoes adicionais da acao executada.
     */
    function SetExtra($v_mix_extra)
    {
        $this->extra = is_array($v_mix_extra)
                     ? implode('_._', $v_mix_extra) : $v_mix_extra;
    } // SetExtra

    /**
     * Seta IP.
     *
     * Armazena o IP do usuario ativo.
     *
     * @access  private
     * @param   string   $v_str_ip  IP do usuario.
     */
    function SetIp($v_str_ip)
    {
        $this->ip = $v_str_ip;
    } // SetIp

    /**
     * Seta login.
     *
     * Armazena o login do usuario ativo.
     *
     * @access  private
     * @param   string   $v_str_login  Login do usuario.
     */
    function SetLogin($v_str_login)
    {
        $this->login = $v_str_login;
    } // SetLogin

    /**
     * Seta metodo de log.
     *
     * Armazena o metodo usado para fazer o log.
     *
     * @access  private
     * @param   string   $v_str_method  Metodo do log.
     */
    function SetMethod($v_str_method)
    {
        $this->method = in_array($v_str_method, array('db', 'file'))
                      ? $v_str_method : 'file';
    } // SetMethod

    /**
     * Seta diretorio
     *
     * Armazena o dioretorio usado para fazer o log.
     *
     * @access  private
     * @param   string   $v_str_path  Metodo do log.
     */
    function SetPath($v_str_path)
    {
        $this->path = $v_str_path;
    } // SetPath

    /**
     * Seta o tipo da acao executada.
     *
     * Armazena o tipo da acao executada pelo usuario.
     *
     * @access  private
     * @param   string   $v_str_type  Tipo da acao executada.
     */
    function SetType($v_str_type)
    {
        $this->type = $v_str_type;
    } // SetType

    /**
     * Inicia o logger.
     *
     * @access  private
     */
    function Start()
    {
        $this->started = TRUE;
    } // Start

    /**
     * Para o logger.
     *
     * @access  private
     */
    function Stop()
    {
        $this->started = FALSE;
    } // Stop

    /* ----- Metodos Privados ------------------------------------------ */

    /**
     * Inicializa o logger.
     *
     * @access  private
     */
    function InitLogger()
    {
        $this->Start();
        $str_ip = isset($_SERVER['REMOTE_ADDR'])
                ? $_SERVER['REMOTE_ADDR']
                : '---.---.---.---';
        $this->SetIp($str_ip);
        $this->SetLogin($_SESSION['nm_session']['user']['login']);
    } // InitLogger

    /**
     * Realiza o log em banco de dados.
     *
     * @access  private
     */
    function LogEntryDb()
    {
    } // LogEntryDb

    /**
     * Realiza o log em arquivo.
     *
     * @access  private
     */
    function LogEntryFile($str_path = '', $path_log = '')
    {
		if(empty($str_path))
		{
			$str_path = $this->GetPath();
		}

		$str_action = $this->GetAction();
		if($str_path == 'total')
		{
			//filtra alguns arquivos
			if(
				strpos($str_action, ".js") !== false ||
				strpos($str_action, "page_header") !== false ||
				strpos($str_action, "page_footer") !== false ||
				strpos($str_action, "body_block_") !== false
			)
			return false;
		}

		$str_log = $this->GetLogin()    . '_:_'
				 . $this->GetIp()       . '_:_'
				 . $this->GetDateTime() . '_:_'
				 . $this->GetType()     . '_:_'
				 . $str_action          . '_:_'
				 . $this->GetExtra() . "\r\n";
		file_put_contents($path_log . $str_path . '/log_' . date('Ymd') . '.log', $str_log, FILE_APPEND);

    } // LogEntryFile

    /* ----- Metodos Publicos ------------------------------------------ */

    /**
     * Cria uma entrada no log.
     *
     * @access  public
     */
    function Log($v_str_type, $v_str_action, $v_str_extra = '', $str_path = '', $path_log = '')
    {
        $this->SetDateTime();
        $this->SetType($v_str_type);
        $this->SetAction($v_str_action);
        $this->SetExtra($v_str_extra);
		switch ($this->GetMethod())
		{
            case 'db':
                $this->LogEntryDb();
            break;
            case 'file':
                $this->LogEntryFile($str_path, $path_log);
            break;
        }
    } // Log
}

?>
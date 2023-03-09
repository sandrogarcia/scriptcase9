<?php
/* Definicao da classe */
class nmBrowser
{
    /**
     * Agente.
     *
     * Navegador utilizado pelo usuario.
     *
     * @access  private
     * @var     string
     */
    var $agent;

    /**
     * Plataforma.
     *
     * Sistema operacional utilizado pelo usuario.
     *
     * @access  private
     * @var     string
     */
    var $platform;

    /**
     * Propriedades.
     *
     * Lista de propriedades do navegador do usuario.
     *
     * @access  private
     * @var     array
     */
    var $properties;

    /**
     * Versão do agente.
     *
     * Versão do navegador utilizado pelo usuario.
     *
     * @access  private
     * @var     float
     */
    var $version;

    /* ----- Construtor e Destrutor ------------------------------------ */

    /**
     * Construtor da classe.
     *
     * Seta as informacoes a respeito do navegador e sistema operacional
     * utilizados pelo usuario.
     *
     * @access  public
     */
    function __construct()
    {
        $this->DetectAgent();
        $this->DetectPlatform();
        $this->SetProperties();
    } // nmBrowser

    /* ----- Getters & Setters ----------------------------------------- */

    /**
     * Recupera agente.
     *
     * Recupera o tipo do navegador utilizado pelo usuario.
     *
     * @access  private
     * @return  string   $str_result  Tipo do navegador.
     */
    function GetAgent()
    {
        return $this->agent;
    } // GetAgent

    function GetJsSelectChar($v_str_space = FALSE)
    {
    	if ($v_str_space)
    	{
	    	return ('MOZILLA' == $this->GetAgent()) ? '.' : ' ';
    	}
    	else
    	{
	    	return ('MOZILLA' == $this->GetAgent()) ? '.' : '&nbsp;';
    	}
    } // GetJsSelectChar

    /**
     * Recupera plataforma.
     *
     * Recupera o sistema operacional utilizado pelo usuario.
     *
     * @access  private
     * @return  string   $str_result  Sistema operacional.
     */
    function GetPlatform()
    {
        return $this->platform;
    } // GetPlatform

    /**
     * Recupera propriedade.
     *
     * Recupera o valor de uma propriedade do navegador do usuario.
     *
     * @access  private
     * @param   string   $v_str_prop  Nome da propriedade.
     * @return  string   $bol_result  Valor da propriedade.
     */
    function GetProperty($v_str_prop)
    {
        return isset($this->properties[$v_str_prop]) &&
               $this->properties[$v_str_prop];
    } // GetProperty

    /**
     * Recupera versao do agente.
     *
     * Recupera a versao do navegador utilizado pelo usuario.
     *
     * @access  private
     * @return  float    $flo_result  Versao do navegador.
     */
    function GetVersion()
    {
        return $this->version;
    } // GetVersion

    /**
     * Seta agente.
     *
     * Armazena o tipo do navegador utilizado pelo usuario.
     *
     * @access  private
     * @param   string   $v_str_agent  Tipo do navegador.
     */
    function SetAgent($v_str_agent)
    {
        $this->agent = $v_str_agent;
    } // SetAgent

    /**
     * Seta plataforma.
     *
     * Armazena o sistema operacional utilizado pelo usuario.
     *
     * @access  private
     * @param   string   $v_str_platform  Sistema operacional.
     */
    function SetPlatform($v_str_platform)
    {
        $this->platform = $v_str_platform;
    } // SetPlatform

    /**
     * Seta propriedade.
     *
     * Armazena o valor de uma propriedade do navegador do usuario.
     *
     * @access  private
     * @param   string   $v_str_prop  Propriedade do navegador.
     * @param   boolean  $v_bol_val   Valor da propriedade.
     */
    function SetProperty($v_str_prop, $v_bol_val)
    {
        $this->properties[$v_str_prop] = $v_bol_val;
    } // SetProperty

    /**
     * Seta versao do agente.
     *
     * Armazena a versao do navegador utilizado pelo usuario.
     *
     * @access  private
     * @param   string   $v_str_version  Versao do navegador.
     */
    function SetVersion($v_str_version)
    {
        $this->version = (float) $v_str_version;
    } // SetVersion

    /* ----- Metodos Privados ------------------------------------------ */

    /**
     * Detecta o agente.
     *
     * Verifica qual o navegador e sua versao utilizado pelo usuario.
     *
     * @access  private
     */
    function DetectAgent()
    {
        $str_agent = isset($_SERVER['HTTP_USER_AGENT'])
                   ? $_SERVER['HTTP_USER_AGENT'] : '';

        $this->SetVersion('0');

        if (strpos($str_agent, 'Chrome') !== FALSE)
        {
            $this->SetAgent('CHROME');
            if (preg_match('/Chrome\/([0-9]{1}.[0-9]{1,2}.[0-9]{1,3}.[0-9]{1,4})/', $str_agent, $arr_info))
                $this->SetVersion($arr_info[1]);
        }
        elseif (strpos($str_agent, 'Opera') !== FALSE)
        {
            $this->SetAgent('OPERA');
            if (preg_match('/Opera ([0-9].[0-9]{1,2})/', $str_agent, $arr_info))
                $this->SetVersion($arr_info[1]);
        }
        elseif (strpos($str_agent, 'MSIE') !== FALSE)
        {
            $this->SetAgent('IE');
            if (preg_match('/MSIE ([0-9].[0-9]{1,2})/', $str_agent, $arr_info))
                $this->SetVersion($arr_info[1]);
        }
        elseif (strpos($str_agent, 'Konqueror') !== FALSE)
        {
            $this->SetAgent('KONQUEROR');
            if (preg_match('/Konqueror\/([0-9].[0-9]{1,2})/', $str_agent, $arr_info))
                $this->SetVersion($arr_info[1]);
        }
        elseif (strpos($str_agent, 'Mozilla') !== FALSE)
        {
            $this->SetAgent('MOZILLA');
            if (preg_match('/Mozilla\/([0-9].[0-9]{1,2})/', $str_agent, $arr_info))
                $this->SetVersion($arr_info[1]);
        }
        elseif (strpos($str_agent, 'Netscape') !== FALSE)
        {
            $this->SetAgent('NETSCAPE');
            if (preg_match('/Netscape\/([0-9].[0-9]{1,2})/', $str_agent, $arr_info))
                $this->SetVersion($arr_info[1]);
        }
        else
        {
            $this->SetAgent('OTHER');
            $this->SetVersion('0');
        }

    } // DetectBrowser

    /**
     * Detecta a plataforma.
     *
     * Verifica qual o sistema operacional utilizado pelo usuario.
     *
     * @access  private
     */
    function DetectPlatform()
    {
        $str_platform = isset($_SERVER['HTTP_USER_AGENT'])
                      ? $_SERVER['HTTP_USER_AGENT'] : '';
        if (strstr($str_platform, 'Win'))
        {
            $this->SetPlatform('WIN');
        }
        elseif (strstr($str_platform, 'Mac'))
        {
            $this->SetPlatform('MAC');
        }
        elseif (strstr($str_platform, 'Linux'))
        {
            $this->SetPlatform('LINUX');
        }
        elseif (strstr($str_platform, 'Unix'))
        {
            $this->SetPlatform('UNIX');
        }
        elseif (strstr($str_platform, 'FreeBSD'))
        {
            $this->SetPlatform('FREEBSD');
        }
        elseif (strstr($str_platform, 'SunOS'))
        {
            $this->SetPlatform('SUNOS');
        }
        elseif (strstr($str_platform, 'Irix'))
        {
            $this->SetPlatform('IRIX');
        }
        elseif (strstr($str_platform, 'BeOS'))
        {
            $this->SetPlatform('BEOS');
        }
        elseif (strstr($str_platform, 'OS/2'))
        {
            $this->SetPlatform('OS2');
        }
        elseif (strstr($str_platform, 'AIX'))
        {
            $this->SetPlatform('AIX');
        }
        else
        {
            $this->SetPlatform('OTHER');
        }
    } // DetectPlatform

    /**
     * Seta as propriedades.
     *
     * Determina as caracteristicas do navegador utilizado pelo usuario.
     *
     * @access  private
     */
    function SetProperties()
    {
        /* coolmenujs */
        $this->SetProperty('coolmenujs', TRUE);
        /* doctype */
        if (('IE' == $this->GetAgent() && 5 <= $this->GetVersion()) ||
            ('CHROME' == $this->GetAgent()))
        {
            $this->SetProperty('doctype', TRUE);
        }
        else
        {
            $this->SetProperty('doctype', FALSE);
        }
        /* doubleclick */
        if (('IE' == $this->GetAgent() && 5 <= $this->GetVersion()) ||
            ('CHROME'  == $this->GetAgent()))
        {
            $this->SetProperty('doubleclick', TRUE);
        }
        else
        {
            $this->SetProperty('doubleclick', FALSE);
        }
        /* iframe */
        $this->SetProperty('iframe', TRUE);
        /* innerhtml */
        if (('IE'      == $this->GetAgent() && 5 <= $this->GetVersion()) ||
            ('MOZILLA' == $this->GetAgent() && 5 <= $this->GetVersion()) ||
            ('CHROME'  == $this->GetAgent()))
        {
            $this->SetProperty('innerhtml', TRUE);
        }
        else
        {
            $this->SetProperty('innerhtml', FALSE);
        }
        /* style.display */
        if (('IE'      == $this->GetAgent() && 5 <= $this->GetVersion()) ||
            ('MOZILLA' == $this->GetAgent() && 5 <= $this->GetVersion()) ||
            ('CHROME'  == $this->GetAgent()))
        {
            $this->SetProperty('style.display', TRUE);
        }
        else
        {
            $this->SetProperty('style.display', FALSE);
        }
    } // SetProperties

    /* ----- Metodos Publicos ------------------------------------------ */

    /**
     * Retorna valor da propriedade.
     *
     * Verifica se o navegador do usuario tem suporte a determinada propriedade.
     *
     * @access  public
     * @param   string   $v_str_prop  Propriedade do navegador.
     * @return  boolean  $bol_result  TRUE se o navegador possui a propriedade,
     *                                caso contrario FALSE.
     */
    function HasProperty($v_str_prop)
    {
        return $this->GetProperty($v_str_prop);
    } // HasProperty
}

?>
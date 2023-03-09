<?php
/* Definicao da classe */
class nmError
{
    /**
     * Status do erro.
     *
     * Flag para indicar o status do erro.
     *
     * @access  private
     * @var     string
     */
    var $status;

    /* ----- Construtor e Destrutor ------------------------------------ */

    /**
     * Construtor da classe.
     *
     * Inicializa o objeto de exibicao de erro.
     *
     * @access  public
     */
    function __construct()
    {
        $this->SetStatus('ok');
    } // nmError

    /* ----- Getters & Setters ----------------------------------------- */

    /**
     * Recupera status.
     *
     * Recupera a flag de status do erro.
     *
     * @access  private
     * @return  string   $str_result  Status do erro.
     */
    function GetStatus()
    {
        return $this->status;
    } // GetStatus

    /**
     * Seta status.
     *
     * Armazena a flag de status do erro.
     *
     * @access  private
     * @param   string   $v_str_status  Status do erro.
     */
    function SetStatus($v_str_status)
    {
        $this->status = ('ok' != $v_str_status) ? 'error' : 'ok';
    } // SetStatus

    /* ----- Metodos Publicos ------------------------------------------ */

    /**
     * Exibe uma lista de erros.
     *
     * Exibe um erro na pagina com titulo e uma listagem de erros.
     *
     * @access  public
     * @param   string   $v_str_tit    Titulo do erro.
     * @param   array    $v_arr_list   Lista de erros.
     * @param   boolean  $v_bol_lang   Flag para uso de lang.
     * @global  object   $nm_template  Objeto para exibicao de templates.
     */
    function DisplayErrorList($v_str_tit, $v_arr_list, $v_bol_lang = TRUE, $v_bol_floating = FALSE)
    {
        global $nm_template;
        if ($nm_template->IsOk())
        {
            $nm_template->SetVar('error_title',     $v_str_tit);
            $nm_template->SetVar('error_list',      $v_arr_list);
            $nm_template->SetVar('error_lang',      $v_bol_lang);
            $nm_template->SetVar('v_bol_floating',  $v_bol_floating);
            $nm_template->Display('body_edit_errors');
        }
        else
        {
            echo '<br /><span style="font-weight: bold">' . $v_str_tit
                 . '</span><br /><br />';
            foreach ($v_arr_list as $str_title => $str_msg)
            {
                echo '<span style="font-weight: bold">' . $str_title
                     . '</span>: ';
                if ($v_bol_lang)
                {
                    echo nm_get_text_lang("['" . $str_msg . "']");
                }
                else
                {
                    echo $str_msg;
                }
                echo '<br />';
            }
        }
    } // DisplayErrorList

    /**
     * Exibe uma mensagem de erro.
     *
     * Exibe um erro na pagina com titulo e sua mensagem.
     *
     * @access  public
     * @param   string   $v_str_tit    Titulo do erro.
     * @param   string   $v_str_msg    Mensagem de erro.
     * @param   boolean  $v_bol_lang   Flag para uso de lang.
     * @global  object   $nm_template  Objeto para exibicao de templates.
     */
    function DisplayErrorMsg($v_str_tit, $v_str_msg, $v_bol_lang = FALSE)
    {
        global $nm_template;
        if ($nm_template->IsOk())
        {
            $nm_template->SetVar('error_title', $v_str_tit);
            $nm_template->SetVar('error_msg',   $v_str_msg);
            $nm_template->SetVar('error_lang',  $v_bol_lang);
            $nm_template->Display('body_error');
        }
        else
        {
            echo '<br /><span style="font-weight: bold">' . $v_str_tit
                 . '</span><br /><br />';
            if ($v_bol_lang)
            {
                echo nm_get_text_lang("['" . $v_str_msg . "']");
            }
            else
            {
                echo $v_str_msg;
            }
        }
    } // DisplayErrorMsg

    /**
     * Verifica o status do erro.
     *
     * Checa se o erro foi corretamente inicializado.
     *
     * @access  public
     * @return  boolean  $bol_result  TRUE se o erro foi inicializado
     *                                corretamente, caso contrario FALSE.
     */
    function IsOk()
    {
        return 'ok' == $this->GetStatus();
    } // IsOk
}

?>
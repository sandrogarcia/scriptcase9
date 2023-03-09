<?php
/* Classes ancestrais */
nm_load_class('xmlparser', 'Xmlparser');

/* Definicao da classe */
class nmXmlparserApplicationVars extends nmXmlparser
{

    var $titulos = array();

    /**
     * Construtor da classe.
     *
     * Seta o elemento raiz do XML.
     *
     * @access  public
     */
    function __construct()
    {
        $this->str_id = "Apl_vars";
        $this->StartDefault();
        $this->InitChanged();
    } // nmXmlparserApplicationVars

    function Create()
    {
        if($this->str_id != '')
        {
            $arr_vars         = $this->GetData();
            $arr_save['vars'] = array();

            if(isset($arr_vars['vars']))
            {
                foreach($arr_vars['vars'] as $str_var=>$arr_var)
                {
                    if(!empty($str_var) && !$this->IsEmpty($arr_var))
                    {
                        $arr_save['vars'][$str_var] = $arr_var;
                    }
                }
            }
            return serialize($arr_save);
        }
    }

    /**
     * Limpa variavel.
     *
     * Remove dados desnecessarios da variavel.
     *
     * @access  protected
     * @param   array      $r_arr_var  Dados da variavel.
     */
    function Clear(&$r_arr_var)
    {
        /* Lista de campos */
        $r_arr_var['aca_campos'] = (isset($r_arr_var['aca_campos']) && is_array($r_arr_var['aca_campos'])) ? array_unique($r_arr_var['aca_campos']) : array();
        $r_arr_var['atu_campos'] = (isset($r_arr_var['atu_campos']) && is_array($r_arr_var['atu_campos'])) ? array_unique($r_arr_var['atu_campos']) : array();
        $r_arr_var['atu_campos_upd'] = (isset($r_arr_var['atu_campos_upd']) && is_array($r_arr_var['atu_campos_upd'])) ? array_unique($r_arr_var['atu_campos_upd']) : array();
        $r_arr_var['con_campos'] = (isset($r_arr_var['con_campos']) && is_array($r_arr_var['con_campos'])) ? array_unique($r_arr_var['con_campos']) : array();
        $r_arr_var['dir_campos'] = (isset($r_arr_var['dir_campos']) && is_array($r_arr_var['dir_campos'])) ? array_unique($r_arr_var['dir_campos']) : array();
        $r_arr_var['for_campos'] = (isset($r_arr_var['for_campos']) && is_array($r_arr_var['for_campos'])) ? array_unique($r_arr_var['for_campos']) : array();
        $r_arr_var['ini_campos'] = (isset($r_arr_var['ini_campos']) && is_array($r_arr_var['ini_campos'])) ? array_unique($r_arr_var['ini_campos']) : array();
        $r_arr_var['mu_fields_seq'] = (isset($r_arr_var['mu_fields_seq']) && is_array($r_arr_var['mu_fields_seq'])) ? array_unique($r_arr_var['mu_fields_seq']) : array();
        $r_arr_var['upload_api_path_seq'] = (isset($r_arr_var['upload_api_path_seq']) && is_array($r_arr_var['upload_api_path_seq'])) ? array_unique($r_arr_var['upload_api_path_seq']) : array();
        $r_arr_var['upload_api_path_cache_seq'] = (isset($r_arr_var['upload_api_path_cache_seq']) && is_array($r_arr_var['upload_api_path_cache_seq'])) ? array_unique($r_arr_var['upload_api_path_cache_seq']) : array();
        $r_arr_var['lab_campos'] = (isset($r_arr_var['lab_campos']) && is_array($r_arr_var['lab_campos'])) ? array_unique($r_arr_var['lab_campos']) : array();
        $r_arr_var['label_watermarked_campos'] = (isset($r_arr_var['label_watermarked_campos']) && is_array($r_arr_var['label_watermarked_campos'])) ? array_unique($r_arr_var['label_watermarked_campos']) : array();
        $r_arr_var['label_filtro_watermarked_campos'] = (isset($r_arr_var['label_filtro_watermarked_campos']) && is_array($r_arr_var['label_filtro_watermarked_campos'])) ? array_unique($r_arr_var['label_filtro_watermarked_campos']) : array();
        $r_arr_var['lkp_campos'] = (isset($r_arr_var['lkp_campos']) && is_array($r_arr_var['lkp_campos'])) ? array_unique($r_arr_var['lkp_campos']) : array();
        $r_arr_var['pes_campos'] = (isset($r_arr_var['pes_campos']) && is_array($r_arr_var['pes_campos'])) ? array_unique($r_arr_var['pes_campos']) : array();
        $r_arr_var['group_campos']= (isset($r_arr_var['group_campos']) && is_array($r_arr_var['group_campos'])) ? array_unique($r_arr_var['group_campos']) : array();
        $r_arr_var['php_campos'] = (isset($r_arr_var['php_campos']) && is_array($r_arr_var['php_campos'])) ? array_unique($r_arr_var['php_campos']) : array();
        $r_arr_var['but_button'] = (isset($r_arr_var['but_button']) && is_array($r_arr_var['but_button'])) ? array_unique($r_arr_var['but_button']) : array();
        $r_arr_var['val_campos'] = (isset($r_arr_var['val_campos']) && is_array($r_arr_var['val_campos'])) ? array_unique($r_arr_var['val_campos']) : array();
        $r_arr_var['qbr_campos'] = (isset($r_arr_var['qbr_campos']) && is_array($r_arr_var['qbr_campos'])) ? array_unique($r_arr_var['qbr_campos']) : array();
        asort($r_arr_var['aca_campos']);
        asort($r_arr_var['atu_campos']);
        asort($r_arr_var['atu_campos_upd']);
        asort($r_arr_var['con_campos']);
        asort($r_arr_var['dir_campos']);
        asort($r_arr_var['for_campos']);
        asort($r_arr_var['ini_campos']);
        asort($r_arr_var['mu_fields_seq']);
        asort($r_arr_var['upload_api_path_seq']);
        asort($r_arr_var['upload_api_path_cache_seq']);
        asort($r_arr_var['lab_campos']);
        asort($r_arr_var['label_watermarked_campos']);
        asort($r_arr_var['label_filtro_watermarked_campos']);
        asort($r_arr_var['lkp_campos']);
        asort($r_arr_var['pes_campos']);
        asort($r_arr_var['group_campos']);
        asort($r_arr_var['php_campos']);
        asort($r_arr_var['but_button']);
        asort($r_arr_var['val_campos']);
        asort($r_arr_var['qbr_campos']);
        /* Flags */
        $r_arr_var['cabecalho']           = ('S' == strtoupper($r_arr_var['cabecalho']))                                                      ? 'S' : 'N';
        $r_arr_var['cabecalho_mobile']    = ('S' == strtoupper($r_arr_var['cabecalho_mobile']))                                                      ? 'S' : 'N';
        $r_arr_var['rodape']              = ('S' == strtoupper($r_arr_var['rodape']))                                                         ? 'S' : 'N';
        $r_arr_var['filter_save_param']   = ('S' == strtoupper($r_arr_var['filter_save_param']))                                              ? 'S' : 'N';
        $r_arr_var['grid_save_param']     = ('S' == strtoupper($r_arr_var['grid_save_param']))                                              ? 'S' : 'N';
        $r_arr_var['path_imagem']         = ('S' == strtoupper($r_arr_var['path_imagem']))                                                    ? 'S' : 'N';
        $r_arr_var['select']              = ('S' == strtoupper($r_arr_var['select']))                                                         ? 'S' : 'N';
        $r_arr_var['acao']                = ('S' == strtoupper($r_arr_var['acao'])               && !empty($r_arr_var['aca_campos']))         ? 'S' : 'N';
        $r_arr_var['atualizacao']         = ('S' == strtoupper($r_arr_var['atualizacao'])        && !empty($r_arr_var['atu_campos']))         ? 'S' : 'N';
        $r_arr_var['atualizacao_upd']     = ('S' == strtoupper($r_arr_var['atualizacao_upd'])    && !empty($r_arr_var['atu_campos_upd']))     ? 'S' : 'N';
        $r_arr_var['consulta']            = ('S' == strtoupper($r_arr_var['consulta'])           && !empty($r_arr_var['con_campos']))         ? 'S' : 'N';
        $r_arr_var['formulario']          = ('S' == strtoupper($r_arr_var['formulario'])         && !empty($r_arr_var['for_campos']))         ? 'S' : 'N';
        $r_arr_var['inicial']             = ('S' == strtoupper($r_arr_var['inicial'])            && !empty($r_arr_var['ini_campos']))         ? 'S' : 'N';
        $r_arr_var['val_inicial_filtro']             = ('S' == strtoupper($r_arr_var['val_inicial_filtro'])            && !empty($r_arr_var['val_inicial_filtro_campos']))         ? 'S' : 'N';
        $r_arr_var['mu_fields_vars']      = ('S' == strtoupper($r_arr_var['mu_fields_vars'])     && !empty($r_arr_var['mu_fields_seq']))      ? 'S' : 'N';
        $r_arr_var['upload_api_path']      = (is_string($r_arr_var['upload_api_path']) && 'S' == strtoupper($r_arr_var['upload_api_path'])     && !empty($r_arr_var['upload_api_path_seq']))      ? 'S' : 'N';
        $r_arr_var['upload_api_path_cache']      = (is_string($r_arr_var['upload_api_path_cache']) && 'S' == strtoupper($r_arr_var['upload_api_path_cache'])     && !empty($r_arr_var['upload_api_path_cache_seq']))      ? 'S' : 'N';
        $r_arr_var['label']               = ('S' == strtoupper($r_arr_var['label'])              && !empty($r_arr_var['lab_campos']))         ? 'S' : 'N';
        $r_arr_var['label_watermarked']               = ('S' == strtoupper($r_arr_var['label_watermarked'])              && !empty($r_arr_var['label_watermarked_campos']))         ? 'S' : 'N';
        $r_arr_var['label_filtro_watermarked']               = ('S' == strtoupper($r_arr_var['label_filtro_watermarked'])              && !empty($r_arr_var['label_filtro_watermarked_campos']))         ? 'S' : 'N';
        $r_arr_var['lkpdesc']             = ('S' == strtoupper($r_arr_var['lkpdesc'])            && !empty($r_arr_var['lkp_campos']))         ? 'S' : 'N';
        $r_arr_var['pesquisa']            = ('S' == strtoupper($r_arr_var['pesquisa'])           && !empty($r_arr_var['pes_campos']))         ? 'S' : 'N';
        $r_arr_var['group']               = ('S' == strtoupper($r_arr_var['group'])              && !empty($r_arr_var['group_campos']))       ? 'S' : 'N';
        $r_arr_var['php']                 = ('S' == strtoupper($r_arr_var['php'])                && !empty($r_arr_var['php_campos']))         ? 'S' : 'N';
        $r_arr_var['but']                 = ('S' == strtoupper($r_arr_var['but'])                && !empty($r_arr_var['but_button']))         ? 'S' : 'N';
        $r_arr_var['subdir']              = ('S' == strtoupper($r_arr_var['subdir'])             && !empty($r_arr_var['dir_campos']))         ? 'S' : 'N';
        $r_arr_var['valida']              = ('S' == strtoupper($r_arr_var['valida'])             && !empty($r_arr_var['val_campos']))         ? 'S' : 'N';
        $r_arr_var['quebra']              = ('S' == strtoupper($r_arr_var['quebra'])             && !empty($r_arr_var['qbr_campos']))         ? 'S' : 'N';
        $r_arr_var['paypal_invoice']      = ('S' == strtoupper($r_arr_var['paypal_invoice'])     && !empty($r_arr_var['paypal_invoice']))     ? 'S' : 'N';
        $r_arr_var['paypal_custom']       = ('S' == strtoupper($r_arr_var['paypal_custom'])      && !empty($r_arr_var['paypal_custom']))      ? 'S' : 'N';
        $r_arr_var['paypal_description']  = ('S' == strtoupper($r_arr_var['paypal_description']) && !empty($r_arr_var['paypal_description'])) ? 'S' : 'N';
        $r_arr_var['paypal_amount']       = ('S' == strtoupper($r_arr_var['paypal_amount'])      && !empty($r_arr_var['paypal_amount']))      ? 'S' : 'N';
        $r_arr_var['titulo']              = ('S' == strtoupper($r_arr_var['titulo'])             && !empty($r_arr_var['titulo']))             ? 'S' : 'N';
        $r_arr_var['dashboard_filter']    = ('S' == strtoupper($r_arr_var['dashboard_filter']))                                               ? 'S' : 'N';
        $r_arr_var['dashboard_idx_title'] = ('S' == strtoupper($r_arr_var['dashboard_idx_title']))                                            ? 'S' : 'N';
        $r_arr_var['exportemail_to']      = ('S' == strtoupper($r_arr_var['exportemail_to'])     && !empty($r_arr_var['exportemail_to']))     ? 'S' : 'N';
        $r_arr_var['exportemail_cc']      = ('S' == strtoupper($r_arr_var['exportemail_cc'])     && !empty($r_arr_var['exportemail_cc']))     ? 'S' : 'N';
        $r_arr_var['exportemail_bcc']     = ('S' == strtoupper($r_arr_var['exportemail_bcc'])    && !empty($r_arr_var['exportemail_bcc']))    ? 'S' : 'N';
        $r_arr_var['exportemail_subject'] = ('S' == strtoupper($r_arr_var['exportemail_subject']) && !empty($r_arr_var['exportemail_subject']))? 'S' : 'N';
        $r_arr_var['exportemail_email']   = ('S' == strtoupper($r_arr_var['exportemail_subject']) && !empty($r_arr_var['exportemail_subject']))? 'S' : 'N';
        $r_arr_var['recaptcha_site_key']  = ('S' == strtoupper($r_arr_var['recaptcha_site_key'])  && !empty($r_arr_var['recaptcha_site_key'])) ? 'S' : 'N';
        $r_arr_var['recaptcha_secret_key']= ('S' == strtoupper($r_arr_var['recaptcha_secret_key']) && !empty($r_arr_var['recaptcha_secret_key']))? 'S' : 'N';
        $r_arr_var['captcha_list_char']   = ('S' == strtoupper($r_arr_var['captcha_list_char'])   && !empty($r_arr_var['captcha_list_char'])) ? 'S' : 'N';
        $r_arr_var['captcha_msg_label']   = ('S' == strtoupper($r_arr_var['captcha_msg_label'])   && !empty($r_arr_var['captcha_msg_label'])) ? 'S' : 'N';
        $r_arr_var['captcha_msg_erro']    = ('S' == strtoupper($r_arr_var['captcha_msg_erro'])    && !empty($r_arr_var['captcha_msg_erro']))  ? 'S' : 'N';

        $r_arr_var['summary_export_pdf_pwd_pwd']    = ('S' == strtoupper($r_arr_var['summary_export_pdf_pwd_pwd'])    && !empty($r_arr_var['summary_export_pdf_pwd_pwd']))  ? 'S' : 'N';
        $r_arr_var['summary_export_word_pwd_pwd']    = ('S' == strtoupper($r_arr_var['summary_export_word_pwd_pwd'])    && !empty($r_arr_var['summary_export_word_pwd_pwd']))  ? 'S' : 'N';
        $r_arr_var['summary_export_csv_pwd_pwd']    = ('S' == strtoupper($r_arr_var['summary_export_csv_pwd_pwd'])    && !empty($r_arr_var['summary_export_csv_pwd_pwd']))  ? 'S' : 'N';
        $r_arr_var['summary_export_xls_pwd_pwd']    = ('S' == strtoupper($r_arr_var['summary_export_xls_pwd_pwd'])    && !empty($r_arr_var['summary_export_xls_pwd_pwd']))  ? 'S' : 'N';
        $r_arr_var['summary_export_xml_pwd_pwd']    = ('S' == strtoupper($r_arr_var['summary_export_xml_pwd_pwd'])    && !empty($r_arr_var['summary_export_xml_pwd_pwd']))  ? 'S' : 'N';
    } // Clear

    /**
     * Cria uma variavel.
     *
     * Cria uma nova variavel para um modulo.
     *
     * @access  protected
     * @param   string     $v_str_mod  Modulo da variavel.
     * @param   integer    $v_int_seq  Sequencial do campo.
     * @return  array      $arr_var    Dados da variavel.
     */
    function CreateVar($v_str_mod, $v_int_seq = 0, $v_str_comp = "")
    {
        /* Inicializa variavel vazia */
        $arr_var = array('select'       => 'N',
            'consulta'     => 'N',
            'con_campos'   => array(),
            'pesquisa'     => 'N',
            'pes_campos'   => array(),
            'group'        => 'N',
            'group_campos' => array(),
            'formulario'   => 'N',
            'for_campos'   => array(),
            'atualizacao'  => 'N',
            'atu_campos'   => array(),
            'atualizacao_upd'  => 'N',
            'atu_campos_upd'   => array(),
            'substituicao' => '',
            'origem'       => 'GP',
            'subst_campo'  => '',
            'subst_table'  => '',
            'label'        => 'N',
            'lab_campos'   => array(),
            'label_watermarked'        => 'N',
            'label_watermarked_campos'   => array(),
            'label_filtro_watermarked'        => 'N',
            'label_filtro_watermarked_campos'   => array(),
            'path_imagem'  => 'N',
            'php'          => 'N',
            'php_campos'   => array(),
            'but'   		=> 'N',
            'but_button'   => array(),
            'valida'       => 'N',
            'val_campos'   => array(),
            'acao'         => 'N',
            'aca_campos'   => array(),
            'cabecalho'    => 'N',
            'cabecalho_mobile'    => 'N',
            'rodape'       => 'N',
            'filter_save_param'=> 'N',
            'grid_save_param'=> 'N',
            'subdir'       => 'N',
            'dir_campos'   => array(),
            'inicial'      => 'N',
            'ini_campos'   => array(),
            'val_inicial_filtro'      => 'N',
            'val_inicial_filtro_campos'   => array(),
            'lkpdesc'      => 'N',
            'lkp_campos'   => array(),
            'quebra'       => 'N',
            'qbr_campos'   => array(),
            'opcional'     => 'N',
            'tipo'         => 'I',
            'paypal_invoice'      => 'N',
            'paypal_custom'       => 'N',
            'paypal_description'  => 'N',
            'paypal_amount'       => 'N',
            'mu_fields_vars'      => 'N',
            'mu_fields_seq'       => array(),
            'upload_api_path_seq'       => array(),
            'upload_api_path'       => 'N',
            'upload_api_path_cache_seq'       => array(),
            'upload_api_path_cache'       => 'N',
            'titulo'              => 'N',
            'dashboard_filter'    => 'N',
            'dashboard_idx_title' => 'N',
            'exportemail_to' => 'N',
            'exportemail_cc' => 'N',
            'exportemail_bcc' => 'N',
            'exportemail_subject' => 'N',
            'exportemail_email' => 'N',
            'recaptcha_site_key' => 'N',
            'recaptcha_secret_key' => 'N',
            'captcha_list_char' => 'N',
            'captcha_msg_label' => 'N',
            'captcha_msg_erro' => 'N',
            'summary_export_pdf_pwd_pwd' => 'N',
            'summary_export_word_pwd_pwd' => 'N',
            'summary_export_csv_pwd_pwd' => 'N',
            'summary_export_xls_pwd_pwd' => 'N',
            'summary_export_xml_pwd_pwd' => 'N',
		);
        /* Define modulo */
        switch ($v_str_mod)
        {
            /* Acao SQL */
            case 'acao':
                $arr_var[$v_str_mod]   = 'S';
                $arr_var['aca_campos'] = array($v_int_seq);
                break;
            /* Atualizacao de campo */
            case 'atualizacao':
                $arr_var[$v_str_mod]   = 'S';
                $arr_var['atu_campos'] = array($v_int_seq);
                break;
            /* Atualizacao de campo */
            case 'atualizacao_upd':
                $arr_var[$v_str_mod]   = 'S';
                $arr_var['atu_campos_upd'] = array($v_int_seq);
                break;
            /* Parametros para salvar filtro */
            case 'filter_save_param':
                $arr_var[$v_str_mod] = 'S';
                break;
            case 'grid_save_param':
                $arr_var[$v_str_mod] = 'S';
                break;
            /* Cabecalho */
            case 'cabecalho':
                $arr_var[$v_str_mod] = 'S';
                break;
            case 'cabecalho_mobile':
                $arr_var[$v_str_mod] = 'S';
                break;
            /* Rodape */
            case 'rodape':
                $arr_var[$v_str_mod] = 'S';
                break;
            /* Lookup de consulta */
            case 'consulta':
                $arr_var[$v_str_mod]   = 'S';
                $arr_var['con_campos'] = array($v_int_seq);
                break;
            /* Lookup de edicao */
            case 'formulario':
                $arr_var[$v_str_mod]   = 'S';
                $arr_var['for_campos'] = array($v_int_seq);
                break;
            /* Valor inicial */
            case 'inicial':
                $arr_var[$v_str_mod]   = 'S';
                $arr_var['ini_campos'] = array($v_int_seq);
                break;
            case 'val_inicial_filtro':
                $arr_var[$v_str_mod]   = 'S';
                $arr_var['val_inicial_filtro_campos'] = array($v_int_seq);
                break;
            /* Label de campo */
            case 'label':
                $arr_var[$v_str_mod]   = 'S';
                $arr_var['lab_campos'] = array($v_int_seq);
                break;
            case 'label_watermarked':
                $arr_var[$v_str_mod]   = 'S';
                $arr_var['label_watermarked_campos'] = array($v_int_seq);
                break;
            case 'label_filtro_watermarked':
                $arr_var[$v_str_mod]   = 'S';
                $arr_var['label_filtro_watermarked_campos'] = array($v_int_seq);
                break;
            /* Lookup de descricao */
            case 'lkpdesc':
                $arr_var[$v_str_mod]   = 'S';
                $arr_var['lkp_campos'] = array($v_int_seq);
                break;
            /* Comando path_imagem */
            case 'path_imagem':
                $arr_var[$v_str_mod] = 'S';
                break;
            /* Lookup de filtro */
            case 'pesquisa':
                $arr_var[$v_str_mod]   = 'S';
                $arr_var['pes_campos'] = array($v_int_seq);
                break;
            /* Lookup de quebra */
            case 'group':
                $arr_var[$v_str_mod]   = 'S';
                $arr_var['group_campos'] = array($v_int_seq . "__NM__" . $v_str_comp);
                break;
            /* Formula PHP */
            case 'php':
                $arr_var[$v_str_mod]   = 'S';
                $arr_var['php_campos'] = array($v_int_seq);
                break;
            /* Codigo Botao */
            case 'but':
                $arr_var[$v_str_mod]   = 'S';
                $arr_var['but_button'] = array($v_int_seq);
                break;
            /* Comando select */
            case 'select':
                $arr_var[$v_str_mod] = 'S';
                break;
            /* Subdiretorio */
            case 'subdir':
                $arr_var[$v_str_mod]   = 'S';
                $arr_var['dir_campos'] = array($v_int_seq);
                break;
            /* Variavel de substituicao para campos */
            case 'subst_campo':
                $arr_var[$v_str_mod] = $v_int_seq;
                break;
            case 'subst_table':
                $arr_var[$v_str_mod] = $v_int_seq;
                break;
            /* Variavel de substituicao para tabela */
            case 'substituicao':
                $arr_var['subst_table'] = $v_int_seq;
                break;
            /* Regra de validacao */
            case 'valida':
                $arr_var[$v_str_mod]   = 'S';
                $arr_var['val_campos'] = array($v_int_seq);
                break;
            case 'quebra':
                $arr_var[$v_str_mod]   = 'S';
                $arr_var['qbr_campos'] = array($v_int_seq);
                break;
            case 'paypal_invoice':
            case 'paypal_custom':
            case 'paypal_description':
            case 'paypal_amount':
            case 'exportemail_to':
            case 'exportemail_cc':
            case 'exportemail_bcc':
            case 'exportemail_subject':
            case 'exportemail_email':
            case 'recaptcha_site_key':
            case 'recaptcha_secret_key':
            case 'captcha_list_char':
            case 'captcha_msg_label':
            case 'captcha_msg_erro':
            case 'summary_export_pdf_pwd_pwd':
            case 'summary_export_word_pwd_pwd':
            case 'summary_export_csv_pwd_pwd':
            case 'summary_export_xls_pwd_pwd':
            case 'summary_export_xml_pwd_pwd':
                $arr_var[$v_str_mod] = 'S';
                break;
            case 'titulo':
                $arr_var[$v_str_mod] = 'S';
                break;
            case 'mu_fields_vars':
                $arr_var[$v_str_mod] = 'S';
                $arr_var['mu_fields_seq'] = array($v_int_seq);
                break;
            case 'upload_api_path':
                $arr_var[$v_str_mod] = 'S';
                $arr_var['upload_api_path_seq'] = array($v_int_seq);
                break;
            case 'upload_api_path_cache':
                $arr_var[$v_str_mod] = 'S';
                $arr_var['upload_api_path_cache_seq'] = array($v_int_seq);
                break;
            case 'dashboard_filter':
                $arr_var[$v_str_mod] = 'S';
                break;
            case 'dashboard_idx_title':
                $arr_var[$v_str_mod] = 'S';
                break;
        }
        return $arr_var;
    } // CreateVar

    /**
     * Verifica se variavel e vazia.
     *
     * Verifica se a variavel esta sendo usada em algum modulo da aplicacao.
     *
     * @access  protected
     * @param   array      $v_arr_var  Dados da variavel.
     * @return  boolean    $bol_empty  TRUE se a variavel nao estiver sendo
     *                                 utilizada, caso contrario FALSE.
     */
    function IsEmpty($v_arr_var)
    {
        $bol_empty = TRUE;
        if ('S' == $v_arr_var['select'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['consulta'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['pesquisa'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['formulario'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['atualizacao'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['atualizacao_upd'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['label'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['lkpdesc'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['path_imagem'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['php'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['but'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['valida'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['acao'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['filter_save_param'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['grid_save_param'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['cabecalho'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['cabecalho_mobile'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['rodape'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['subdir'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['inicial'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['mu_fields_vars'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['quebra'])
        {
            $bol_empty = FALSE;
        }
        elseif ('' != $v_arr_var['substituicao'])
        {
            $bol_empty = FALSE;
        }
        elseif ('' != $v_arr_var['subst_campo'])
        {
            $bol_empty = FALSE;
        }
        elseif ('' != $v_arr_var['subst_table'])
        {
            $bol_empty = FALSE;
        }
        elseif ('' != $v_arr_var['paypal_invoice'])
        {
            $bol_empty = FALSE;
        }
        elseif ('' != $v_arr_var['paypal_custom'])
        {
            $bol_empty = FALSE;
        }
        elseif ('' != $v_arr_var['paypal_description'])
        {
            $bol_empty = FALSE;
        }
        elseif ('' != $v_arr_var['paypal_amount'])
        {
            $bol_empty = FALSE;
        }
        elseif ('' != $v_arr_var['titulo'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['dashboard_filter'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['dashboard_idx_title'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['exportemail_to'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['summary_export_pdf_pwd_pwd'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['summary_export_word_pwd_pwd'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['summary_export_csv_pwd_pwd'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['summary_export_xls_pwd_pwd'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['summary_export_xml_pwd_pwd'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['exportemail_cc'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['exportemail_bcc'])
        {
            $bol_empty = FALSE;
        }
         elseif ('S' == $v_arr_var['exportemail_subject'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['exportemail_email'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['recaptcha_site_key'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['recaptcha_secret_key'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['captcha_list_char'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['captcha_msg_label'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['captcha_msg_erro'])
        {
            $bol_empty = FALSE;
        }
        elseif ('S' == $v_arr_var['group'])
        {
            $bol_empty = FALSE;
        }
        return $bol_empty;
    } // IsEmpty

    /**
     * Remove um campo.
     *
     * Remove um campo das informacoes de variaveis.
     *
     * @access  public
     * @param   integer  $v_int_seq    Sequencial do campo.
     * @return  boolean  $bol_changed  Flag de mudanca dos dados.
     */
    function RemoveField($v_int_seq)
    {
        $bol_changed = FALSE;
        $arr_list    = $this->GetTag('vars');
        foreach ($arr_list as $str_var => $arr_var)
        {
            foreach ($arr_var['con_campos'] as $int_index => $int_field)
            {
                if ($int_field == $v_int_seq)
                {
                    unset($arr_list[$str_var]['con_campos'][$int_index]);
                    $bol_changed = TRUE;
                }
            }
            foreach ($arr_var['pes_campos'] as $int_index => $int_field)
            {
                if ($int_field == $v_int_seq)
                {
                    unset($arr_list[$str_var]['pes_campos'][$int_index]);
                    $bol_changed = TRUE;
                }
            }
            foreach ($arr_var['group_campos'] as $int_index => $int_field)
            {
                if ($int_field == $v_int_seq)
                {
                    unset($arr_list[$str_var]['group_campos'][$int_index]);
                    $bol_changed = TRUE;
                }
            }
            foreach ($arr_var['for_campos'] as $int_index => $int_field)
            {
                if ($int_field == $v_int_seq)
                {
                    unset($arr_list[$str_var]['for_campos'][$int_index]);
                    $bol_changed = TRUE;
                }
            }
            foreach ($arr_var['atu_campos'] as $int_index => $int_field)
            {
                if ($int_field == $v_int_seq)
                {
                    unset($arr_list[$str_var]['atu_campos'][$int_index]);
                    $bol_changed = TRUE;
                }
            }
            foreach ($arr_var['atu_campos_upd'] as $int_index => $int_field)
            {
                if ($int_field == $v_int_seq)
                {
                    unset($arr_list[$str_var]['atu_campos_upd'][$int_index]);
                    $bol_changed = TRUE;
                }
            }
            foreach ($arr_var['lab_campos'] as $int_index => $int_field)
            {
                if ($int_field == $v_int_seq)
                {
                    unset($arr_list[$str_var]['lab_campos'][$int_index]);
                    $bol_changed = TRUE;
                }
            }
            foreach ($arr_var['label_watermarked_campos'] as $int_index => $int_field)
            {
                if ($int_field == $v_int_seq)
                {
                    unset($arr_list[$str_var]['label_watermarked_campos'][$int_index]);
                    $bol_changed = TRUE;
                }
            }
            foreach ($arr_var['label_filtro_watermarked_campos'] as $int_index => $int_field)
            {
                if ($int_field == $v_int_seq)
                {
                    unset($arr_list[$str_var]['label_filtro_watermarked_campos'][$int_index]);
                    $bol_changed = TRUE;
                }
            }
            foreach ($arr_var['php_campos'] as $int_index => $int_field)
            {
                if ($int_field == $v_int_seq)
                {
                    unset($arr_list[$str_var]['php_campos'][$int_index]);
                    $bol_changed = TRUE;
                }
            }
            foreach ($arr_var['but_button'] as $int_index => $int_field)
            {
                if ($int_field == $v_int_seq)
                {
                    unset($arr_list[$str_var]['but_button'][$int_index]);
                    $bol_changed = TRUE;
                }
            }
            foreach ($arr_var['val_campos'] as $int_index => $int_field)
            {
                if ($int_field == $v_int_seq)
                {
                    unset($arr_list[$str_var]['val_campos'][$int_index]);
                    $bol_changed = TRUE;
                }
            }
            foreach ($arr_var['aca_campos'] as $int_index => $int_field)
            {
                if ($int_field == $v_int_seq)
                {
                    unset($arr_list[$str_var]['aca_campos'][$int_index]);
                    $bol_changed = TRUE;
                }
            }
            foreach ($arr_var['dir_campos'] as $int_index => $int_field)
            {
                if ($int_field == $v_int_seq)
                {
                    unset($arr_list[$str_var]['dir_campos'][$int_index]);
                    $bol_changed = TRUE;
                }
            }
            foreach ($arr_var['ini_campos'] as $int_index => $int_field)
            {
                if ($int_field == $v_int_seq)
                {
                    unset($arr_list[$str_var]['ini_campos'][$int_index]);
                    $bol_changed = TRUE;
                }
            }
            if(isset($arr_var['mu_fields_seq']))
            {
                foreach ($arr_var['mu_fields_seq'] as $int_index => $int_field)
                {
                    if ($int_field == $v_int_seq)
                    {
                        unset($arr_list[$str_var]['mu_fields_seq'][$int_index]);
                        $bol_changed = TRUE;
                    }
                }
            }
            if(isset($arr_var['upload_api_path_seq']))
            {
                foreach ($arr_var['upload_api_path_seq'] as $int_index => $int_field)
                {
                    if ($int_field == $v_int_seq)
                    {
                        unset($arr_list[$str_var]['upload_api_path_seq'][$int_index]);
                        $bol_changed = TRUE;
                    }
                }
            }
            if(isset($arr_var['upload_api_path_cache_seq']))
            {
                foreach ($arr_var['upload_api_path_cache_seq'] as $int_index => $int_field)
                {
                    if ($int_field == $v_int_seq)
                    {
                        unset($arr_list[$str_var]['upload_api_path_cache_seq'][$int_index]);
                        $bol_changed = TRUE;
                    }
                }
            }
            foreach ($arr_var['lkp_campos'] as $int_index => $int_field)
            {
                if ($int_field == $v_int_seq)
                {
                    unset($arr_list[$str_var]['lkp_campos'][$int_index]);
                    $bol_changed = TRUE;
                }
            }
            foreach ($arr_var['qbr_campos'] as $int_index => $int_field)
            {
                if ($int_field == $v_int_seq)
                {
                    unset($arr_list[$str_var]['qbr_campos'][$int_index]);
                    $bol_changed = TRUE;
                }
            }
            $this->Clear($arr_var);
        }
        $this->SetTag('vars', $arr_list);
        return $bol_changed;
    } // RemoveField

    /**
     * Substitui as variaveis por valores fixos para execucao do SQL.
     *
     * @access  public
     * @param   string  $v_str_sql  Comando SQL que tera as variaveis sibstituidas.
     * @return  string  Comando SQL sem as variaveis para execucao no banco.
     */
    public static function ReplaceVars($v_str_sql)
    {
        $arr_vars = nmXmlparserApplicationVars::RetrieveVarList($v_str_sql);

        if (empty($arr_vars))
        {
            return $v_str_sql;
        }
        else
        {
            foreach ($arr_vars as $str_var)
            {
                $v_str_sql = str_replace('[' . $str_var . ']', '0', $v_str_sql);
            }
        }
        return $v_str_sql;
    } // RemoveVars

    /**
     * Define variaveis.
     *
     * Define as variaveis que entram no comando select.
     *
     * @access  public
     * @param   string   $v_str_sql    Comando SQL.
     * @param   boolean  $v_bol_strip  Retirar comentarios PHP.
     * @return  array    $arr_list     Lista de variaveis.
     */
    public static function RetrieveVarList($v_str_sql, $bol_remove_comments = false)
    {
        $arr_list = array();

        $arr_found = array();

        if($bol_remove_comments)
        {
            $v_str_sql = preg_replace('/\?>(.*?)<\?[php]*/s',  '', $v_str_sql);

            $v_str_sql = preg_replace('!/\*.*?\*/!s', '', $v_str_sql);
            $v_str_sql = preg_replace('![ \t]*//.*[ \t]*[\r\n]!', '', $v_str_sql);

            $v_str_sql = nm_replace_preg_functions($v_str_sql);

            scRemoveComments($v_str_sql);
        }

        //deixando igual ao gerador
        sc_preg_match_global($v_str_sql, $arr_found, "", "");

        if(!empty($arr_found))
        {
            $arr_match = array_unique($arr_found[0]);

            foreach ($arr_match as $str_var)
            {
                $str_var = substr(substr($str_var, 0, -1), 1);
                if (!in_array($str_var, $arr_list))
                {
                    $arr_list[] = $str_var;
                }
            }
        }
        return $arr_list;
    } // RetrieveVarList

    /**
     * Recupera informacoes para montar os SQLs.
     *
     * @access  public
     * @return  array   $arr_info  Informacoes dos campos.
     */
    function SqlInfo()
    {
        $arr_info = array('app'  => array(),
            'fld'  => array(),
            'seq'  => array(),
            'evt'  => array(),
            'nevt' => array(),
            'btn'  => array(),
            'nbtn' => array());

        foreach ($this->GetTag('vars') as $str_var => $arr_var)
        {
            /* Aplicacao */
            if ('S' == $arr_var['cabecalho'])
            {
                $arr_info['app'][] = 'Cabecalho_Detalhe';
                $arr_info['app'][] = 'Cabecalho_Edit';
                $arr_info['app'][] = 'Cabecalho_Grid';
                $arr_info['app'][] = 'Cabecalho_Pesq';
                $arr_info['app'][] = 'cab_summary_var';
            }
            if ('S' == $arr_var['cabecalho_mobile'])
            {
                $arr_info['app'][] = 'cabecalho_grid_mobile';
            }
            if ('S' == $arr_var['rodape'])
            {
                $arr_info['app'][] = 'rod_grid_var';
                $arr_info['app'][] = 'rod_filter_var';
                $arr_info['app'][] = 'rod_summary_var';
            }
            if ('S' == $arr_var['path_imagem'])
            {
                $arr_info['app'][] = 'Imagem_Path';
            }
            if ('S' == $arr_var['filter_save_param'])
            {
                $arr_info['app'][] = 'Attr2';
            }
            if ('S' == $arr_var['grid_save_param'])
            {
                $arr_info['app'][] = 'Attr2';
            }
            if ('S' == $arr_var['select'])
            {
                $arr_info['app'][] = 'ComandoSelect';
                $arr_info['app'][] = 'Attr1';
            }
            if ('' != $arr_var['subst_table'])
            {
                $arr_info['app'][] = 'tab_subst_var';
            }
            if ('' != $arr_var['subst_campo'])
            {
                $arr_info['app'][] = 'fld_subst_var';
            }
            if ('S' == $arr_var['dashboard_filter'])
            {
                $arr_info['app'][] = 'Attr3';
            }
            if ('S' == $arr_var['dashboard_idx_title'])
            {
                $arr_info['app'][] = 'Attr3';
            }
            /* Campos */
            if ('S' == $arr_var['inicial'])
            {
                $arr_info['fld'][] = 'Val_Inicial';
                $arr_info['seq']   = array_merge($arr_info['seq'], $arr_var['ini_campos']);
            }
            if ('S' == $arr_var['val_inicial_filtro'])
            {
                $arr_info['fld'][] = 'val_inicial_filtro';
                $arr_info['seq']   = array_merge($arr_info['seq'], $arr_var['val_inicial_filtro_campos']);
            }
            if ('S' == $arr_var['mu_fields_vars'])
            {
                $arr_info['fld'][] = 'mu_fields_default_val';
                $arr_info['seq']   = array_merge($arr_info['seq'], $arr_var['mu_fields_seq']);
            }
            if ('S' == $arr_var['upload_api_path'])
            {
                $arr_info['fld'][] = 'upload_api_path';
                $arr_info['seq']   = array_merge($arr_info['seq'], $arr_var['upload_api_path_seq']);
            }
            if ('S' == $arr_var['upload_api_path_cache'])
            {
                $arr_info['fld'][] = 'upload_api_path_cache';
                $arr_info['seq']   = array_merge($arr_info['seq'], $arr_var['upload_api_path_cache_seq']);
            }
            if ('S' == $arr_var['label'])
            {
                $arr_info['fld'][] = 'Label';
                $arr_info['seq']   = array_merge($arr_info['seq'], $arr_var['lab_campos']);
            }
            if ('S' == $arr_var['label_watermarked'])
            {
                $arr_info['fld'][] = 'Attr1';
                $arr_info['seq']   = array_merge($arr_info['seq'], $arr_var['label_watermarked_campos']);
            }
            if ('S' == $arr_var['label_filtro_watermarked'])
            {
                $arr_info['fld'][] = 'Attr1';
                $arr_info['seq']   = array_merge($arr_info['seq'], $arr_var['label_filtro_watermarked_campos']);
            }
            if ('S' == $arr_var['php'])
            {
                $arr_info['evt'][] = 'Codigo';
                $arr_info['nevt']   = array_merge($arr_info['nevt'], $arr_var['php_campos']);
            }
            if ('S' == $arr_var['but'])
            {
                $arr_info['btn'][] = 'Button';
                $arr_info['nbtn']   = array_merge($arr_info['nbtn'], $arr_var['but_button']);
            }
            if ('S' == $arr_var['acao'])
            {
                $arr_info['fld'][] = 'Attr1';
                $arr_info['seq']   = array_merge($arr_info['seq'], $arr_var['aca_campos']);
            }
            if ('S' == $arr_var['subdir'])
            {
                $arr_info['fld'][] = 'Attr1';
                $arr_info['seq']   = array_merge($arr_info['seq'], $arr_var['dir_campos']);
            }
            if ('S' == $arr_var['atualizacao'])
            {
                $arr_info['fld'][] = 'Attr1';
                $arr_info['seq']   = array_merge($arr_info['seq'], $arr_var['atu_campos']);
            }
            if ('S' == $arr_var['atualizacao_upd'])
            {
                $arr_info['fld'][] = 'Attr1';
                $arr_info['seq']   = array_merge($arr_info['seq'], $arr_var['atu_campos_upd']);
            }
            if ('S' == $arr_var['valida'])
            {
                $arr_info['fld'][] = 'Attr1';
                $arr_info['seq']   = array_merge($arr_info['seq'], $arr_var['val_campos']);
            }
            if ('S' == $arr_var['formulario'])
            {
                $arr_info['fld'][] = 'Def_Complemento';
                $arr_info['seq']   = array_merge($arr_info['seq'], $arr_var['for_campos']);
            }
            if ('S' == $arr_var['consulta'])
            {
                $arr_info['fld'][] = 'Def_Complemento_Cons';
                $arr_info['seq']   = array_merge($arr_info['seq'], $arr_var['con_campos']);
            }
            if ('S' == $arr_var['pesquisa'])
            {
                $arr_info['fld'][] = 'Def_Complemento_Pesq';
                $arr_info['seq']   = array_merge($arr_info['seq'], $arr_var['pes_campos']);
            }
            if ('S' == $arr_var['group'])
            {
                $has_lookup = false;
                foreach($arr_var['group_campos'] as $group)
                {
                    $seq = $group;

                    if(strpos($seq, "__NM__") !== false)
                    {
                        list($seq, $quebra, $cont) = explode("__NM__", $seq);

                        if(!empty($seq))
                        {
                            $has_lookup = true;
                            $seq = array($seq);
                        }
                    }
                    if(is_array($seq))
                    {
                        $arr_info['seq']   = array_merge($arr_info['seq'], $seq);
                    }
                }

                if($has_lookup)
                {
                    $arr_info['fld'][] = 'Attr4';
                }
            }
            if ('S' == $arr_var['lkpdesc'])
            {
                $arr_info['fld'][] = 'Attr1';
                $arr_info['seq']   = array_merge($arr_info['seq'], $arr_var['lkp_campos']);
            }
            if ('S' == $arr_var['paypal_invoice'])
            {
                $arr_info['app'][] = 'Attr1';
            }
            if ('S' == $arr_var['paypal_custom'])
            {
                $arr_info['app'][] = 'Attr1';
            }
            if ('S' == $arr_var['paypal_description'])
            {
                $arr_info['app'][] = 'Attr1';
            }
            if ('S' == $arr_var['paypal_amount'])
            {
                $arr_info['app'][] = 'Attr1';
            }
            if ('S' == $arr_var['exportemail_to'])
            {
                $arr_info['app'][] = 'Attr4';
            }
            if ('S' == $arr_var['exportemail_cc'])
            {
                $arr_info['app'][] = 'Attr4';
            }
            if ('S' == $arr_var['exportemail_bcc'])
            {
                $arr_info['app'][] = 'Attr4';
            }
            if ('S' == $arr_var['exportemail_subject'])
            {
                $arr_info['app'][] = 'Attr4';
            }
            if ('S' == $arr_var['exportemail_email'])
            {
                $arr_info['app'][] = 'Attr4';
            }
            if ('S' == $arr_var['recaptcha_site_key'])
            {
                $arr_info['app'][] = 'Attr1';
            }
            if ('S' == $arr_var['recaptcha_secret_key'])
            {
                $arr_info['app'][] = 'Attr1';
            }
            if ('S' == $arr_var['captcha_list_char'])
            {
                $arr_info['app'][] = 'Attr1';
            }
            if ('S' == $arr_var['captcha_msg_label'])
            {
                $arr_info['app'][] = 'Attr1';
            }
            if ('S' == $arr_var['captcha_msg_erro'])
            {
                $arr_info['app'][] = 'Attr1';
            }
            if ('S' == $arr_var['summary_export_pdf_pwd_pwd'])
            {
                $arr_info['app'][] = 'Attr1';
            }
            if ('S' == $arr_var['summary_export_word_pwd_pwd'])
            {
                $arr_info['app'][] = 'Attr1';
            }
            if ('S' == $arr_var['summary_export_csv_pwd_pwd'])
            {
                $arr_info['app'][] = 'Attr1';
            }
            if ('S' == $arr_var['summary_export_xls_pwd_pwd'])
            {
                $arr_info['app'][] = 'Attr1';
            }
            if ('S' == $arr_var['summary_export_xml_pwd_pwd'])
            {
                $arr_info['app'][] = 'Attr1';
            }
            if (isset($arr_var['titulo']) && 'S' == $arr_var['titulo'])
            {
                $arr_info['app'][] = 'Titulo_Insert';
                $arr_info['app'][] = 'Titulo_Update';
                $arr_info['app'][] = 'Titulo_Detalhe';
                $arr_info['app'][] = 'Titulo_Pesq';
                $arr_info['app'][] = 'Titulo_Grid';
                $arr_info['app'][] = 'cab_summary_tit';
            }
        }
        $arr_info['app'] = array_unique($arr_info['app']);
        $arr_info['fld'] = array_unique($arr_info['fld']);
        $arr_info['seq'] = array_unique($arr_info['seq']);
        sort($arr_info['app']);
        sort($arr_info['fld']);
        sort($arr_info['seq']);
        return $arr_info;
    } // SqlInfo

    /**
     * Compara as informacoes das variaveis.
     *
     * @access  public
     * @param   array   $v_arr_info  Informacoes do banco de dados.
     */
    function CompareVars($v_arr_info)
    {
        $arr_var = array();
        /* Recupera informacoes armazenadas em aplicacoes */
        foreach ($v_arr_info['app'] as $str_field => $arr_list)
        {
            foreach ($arr_list as $mix_key => $str_var)
            {
                if (!is_array($str_var) && !isset($arr_var[$str_var]) && $str_field != 'fld_subst_var' && $str_field != 'tab_subst_var')
                {
                    $arr_var[$str_var] = $this->CreateVar('');
                }
                switch ($str_field)
                {
                    case 'Cabecalho_Detalhe':
                    case 'Cabecalho_Edit':
                    case 'Cabecalho_Grid':
                    case 'Cabecalho_Pesq':
                    case 'cab_summary_var':
                        $arr_var[$str_var]['cabecalho'] = 'S';
                        break;
                    case 'cabecalho_grid_mobile':
                        $arr_var[$str_var]['cabecalho_mobile'] = 'S';
                        break;
                    case 'rod_grid_var':
                    case 'rod_filter_var':
                    case 'rod_summary_var':
                        $arr_var[$str_var]['rodape'] = 'S';
                        break;
                    case 'ComandoSelect':
                        $arr_var[$str_var]['select'] = 'S';
                        break;
                    case 'Imagem_Path':
                        $arr_var[$str_var]['path_imagem'] = 'S';
                        break;
                    case 'btn_salvar_lista':
                        $arr_var[$str_var]['filter_save_param'] = 'S';
                        break;
                    case 'save_grid':
                        $arr_var[$str_var]['grid_save_param'] = 'S';
                        break;
                    case 'tab_subst_var':
                        if(!isset($arr_var[$mix_key]))
                        {
                            $arr_var[$mix_key] = $this->CreateVar('');
                        }

                        $arr_var[$mix_key]['subst_table'] = $str_var;
                        break;
                    case 'fld_subst_var':

                        if(!isset($arr_var[$mix_key]))
                        {
                            $arr_var[$mix_key] = $this->CreateVar('');
                        }

                        $arr_var[$mix_key]['subst_campo'] = $str_var;
                        break;
                    case 'paypal_invoice':
                    case 'paypal_custom':
                    case 'paypal_description':
                    case 'paypal_amount':
                    case 'exportemail_to':
                    case 'exportemail_cc':
                    case 'exportemail_bcc':
                    case 'exportemail_subject':
                    case 'exportemail_email':
                    case 'recaptcha_site_key':
                    case 'recaptcha_secret_key':
                    case 'captcha_list_char':
                    case 'captcha_msg_label':
                    case 'captcha_msg_erro':
                    case 'summary_export_pdf_pwd_pwd':
                    case 'summary_export_word_pwd_pwd':
                    case 'summary_export_csv_pwd_pwd':
                    case 'summary_export_xls_pwd_pwd':
                    case 'summary_export_xml_pwd_pwd':
                        $arr_var[$str_var][$str_field] = 'S';
                        break;

                    case 'Titulo_Insert':
                    case 'Titulo_Update':
                    case 'Titulo_Detalhe':
                    case 'Titulo_Pesq':
                    case 'Titulo_Grid':
                    case 'cab_summary_tit':
                        $arr_var[$str_var]['titulo'] = 'S';
                        break;

                    case 'dashboard_filter':
                        $arr_var[$str_var][$str_field] = 'S';
                        break;

                    case 'dashboard_idx_title':
                        $arr_var[$str_var][$str_field] = 'S';
                        break;
                }
            }
        }
        /* Recupera informacoes armazenadas em campos */
        foreach ($v_arr_info['fld'] as $int_seq => $arr_info)
        {
            foreach ($arr_info as $str_field => $arr_list)
            {
                foreach ($arr_list as $mix_key => $str_var)
                {
                    if ($str_field != 'Def_Complemento_Group' && !isset($arr_var[$str_var]))
                    {
                        $arr_var[$str_var] = $this->CreateVar('');
                    }
                    switch ($str_field)
                    {
                        case 'Def_Complemento':
                            $arr_var[$str_var]['formulario'] = 'S';
                            if (!in_array($int_seq, $arr_var[$str_var]['for_campos']))
                            {
                                $arr_var[$str_var]['for_campos'][] = $int_seq;
                            }
                            break;
                        case 'Def_Complemento_Cons':
                            $arr_var[$str_var]['consulta'] = 'S';
                            if (!in_array($int_seq, $arr_var[$str_var]['con_campos']))
                            {
                                $arr_var[$str_var]['con_campos'][] = $int_seq;
                            }
                            break;
                        case 'Def_Complemento_Pesq':
                            $arr_var[$str_var]['pesquisa'] = 'S';
                            if (!in_array($int_seq, $arr_var[$str_var]['pes_campos']))
                            {
                                $arr_var[$str_var]['pes_campos'][] = $int_seq;
                            }
                            break;
                        case 'Def_Complemento_Group':

                            foreach($str_var as $cont => $arr_variavel)
                            {
                                foreach($arr_variavel as $variavel)
                                {
                                    if(!isset($arr_var[$variavel]['group_campos']))
                                    {
                                        $arr_var[$variavel]['group_campos'] = array();
                                    }

                                    $arr_var[$variavel]['group'] = 'S';
                                    if (!in_array($int_seq . "__NM__" . $mix_key ."__NM__" . $cont, $arr_var[$variavel]['group_campos']))
                                    {
                                        $arr_var[$variavel]['group_campos'][] = $int_seq . "__NM__" . $mix_key ."__NM__" . $cont;
                                    }
                                }
                            }
                            break;
                        case 'Formula':
                            $arr_var[$str_var]['php'] = 'S';
                            if (!in_array($int_seq, $arr_var[$str_var]['php_campos']))
                            {
                                $arr_var[$str_var]['php_campos'][] = $int_seq;
                            }
                            break;
                        case 'Button':
                            $arr_var[$str_var]['but'] = 'S';
                            if (!in_array($int_seq, $arr_var[$str_var]['but_button']))
                            {
                                $arr_var[$str_var]['but_button'][] = $int_seq;
                            }
                            break;
                        case 'Label':
                            $arr_var[$str_var]['label'] = 'S';
                            if (!in_array($int_seq, $arr_var[$str_var]['lab_campos']))
                            {
                                $arr_var[$str_var]['lab_campos'][] = $int_seq;
                            }
                            break;
                        case 'Val_Inicial':
                            $arr_var[$str_var]['inicial'] = 'S';
                            if (!in_array($int_seq, $arr_var[$str_var]['ini_campos']))
                            {
                                $arr_var[$str_var]['ini_campos'][] = $int_seq;
                            }
                            break;
                        case 'val_inicial_filtro':
                            $arr_var[$str_var]['val_inicial_filtro'] = 'S';
                            if (!in_array($int_seq, $arr_var[$str_var]['val_inicial_filtro_campos']))
                            {
                                $arr_var[$str_var]['val_inicial_filtro_campos'][] = $int_seq;
                            }
                            break;
                        case 'mu_fields_default_val':
                            $arr_var[$str_var]['mu_fields_vars'] = 'S';
                            if (!in_array($int_seq, $arr_var[$str_var]['mu_fields_seq']))
                            {
                                $arr_var[$str_var]['mu_fields_seq'][] = $int_seq;
                            }
                        case 'upload_api_path':
                            $arr_var[$str_var]['upload_api_path'] = 'S';
                            if (!in_array($int_seq, $arr_var[$str_var]['upload_api_path_seq']))
                            {
                                $arr_var[$str_var]['upload_api_path_seq'][] = $int_seq;
                            }
                            break;
                        case 'upload_api_path_cache':
                            $arr_var[$str_var]['upload_api_path_cache'] = 'S';
                            if (!in_array($int_seq, $arr_var[$str_var]['upload_api_path_cache_seq']))
                            {
                                $arr_var[$str_var]['upload_api_path_cache_seq'][] = $int_seq;
                            }
                            break;
                        case 'label_watermarked':
                            $arr_var[$str_var]['label_watermarked'] = 'S';
                            if (!in_array($int_seq, $arr_var[$str_var]['label_watermarked_campos']))
                            {
                                $arr_var[$str_var]['label_watermarked_campos'][] = $int_seq;
                            }
                            break;
                        case 'label_filtro_watermarked':
                            $arr_var[$str_var]['label_filtro_watermarked'] = 'S';
                            if (!in_array($int_seq, $arr_var[$str_var]['label_filtro_watermarked_campos']))
                            {
                                $arr_var[$str_var]['label_filtro_watermarked_campos'][] = $int_seq;
                            }
                            break;
                        case 'acaosql_comando':
                            $arr_var[$str_var]['acao'] = 'S';
                            if (!in_array($int_seq, $arr_var[$str_var]['aca_campos']))
                            {
                                $arr_var[$str_var]['aca_campos'][] = $int_seq;
                            }
                            break;
                        case 'banco_val_valor':
                            $arr_var[$str_var]['atualizacao'] = 'S';
                            if (!in_array($int_seq, $arr_var[$str_var]['atu_campos']))
                            {
                                $arr_var[$str_var]['atu_campos'][] = $int_seq;
                            }
                            break;
                        case 'banco_val_valor_upd':
                            $arr_var[$str_var]['atualizacao_upd'] = 'S';
                            if (!in_array($int_seq, $arr_var[$str_var]['atu_campos_upd']))
                            {
                                $arr_var[$str_var]['atu_campos_upd'][] = $int_seq;
                            }
                            break;
                        case 'lookup_consulta':
                            $arr_var[$str_var]['lkpdesc'] = 'S';
                            if (!in_array($int_seq, $arr_var[$str_var]['lkp_campos']))
                            {
                                $arr_var[$str_var]['lkp_campos'][] = $int_seq;
                            }
                            break;
                        case 'path_sub':
                            $arr_var[$str_var]['subdir'] = 'S';
                            if (!in_array($int_seq, $arr_var[$str_var]['dir_campos']))
                            {
                                $arr_var[$str_var]['dir_campos'][] = $int_seq;
                            }
                            break;
                        case 'valida_condicao':
                            $arr_var[$str_var]['valida'] = 'S';
                            if (!in_array($int_seq, $arr_var[$str_var]['val_campos']))
                            {
                                $arr_var[$str_var]['val_campos'][] = $int_seq;
                            }
                            break;
                    }
                }
            }
        }

        /* Recupera informacoes armazenadas em eventos */
        foreach ($v_arr_info['evt'] as $int_seq => $arr_info)
        {
            foreach ($arr_info as $str_field => $arr_list)
            {
                foreach ($arr_list as $mix_key => $str_var)
                {
                    if (!isset($arr_var[$str_var]))
                    {
                        $arr_var[$str_var] = $this->CreateVar('');
                    }
                    switch ($str_field)
                    {
                        case 'Codigo':
                            $arr_var[$str_var]['php'] = 'S';
                            if (!in_array($int_seq, $arr_var[$str_var]['php_campos']))
                            {
                                $arr_var[$str_var]['php_campos'][] = $int_seq;
                            }
                            break;
                    }
                }
            }
        }

        /* Recupera informacoes armazenadas em botoes */
        foreach ($v_arr_info['btn'] as $int_seq => $arr_info)
        {
            foreach ($arr_info as $str_field => $arr_list)
            {
                foreach ($arr_list as $mix_key => $str_var)
                {
                    if (!isset($arr_var[$str_var]))
                    {
                        $arr_var[$str_var] = $this->CreateVar('');
                    }
                    switch ($str_field)
                    {
                        case 'Button':
                            $arr_var[$str_var]['but'] = 'S';
                            if (!in_array($int_seq, $arr_var[$str_var]['but_button']))
                            {
                                $arr_var[$str_var]['but_button'][] = $int_seq;
                            }
                            break;
                    }
                }
            }
        }

        /* Recupera informacoes gerais */
        $arr_old = $this->GetTag('vars');
        foreach ($arr_var as $str_var => $arr_data)
        {
            if (isset($arr_old[$str_var]))
            {
                $arr_var[$str_var]['origem']   = $arr_old[$str_var]['origem'];
                $arr_var[$str_var]['opcional'] = $arr_old[$str_var]['opcional'];
                $arr_var[$str_var]['tipo']     = $arr_old[$str_var]['tipo'];
            }
        }
        /* Compara variaveis */
        $bol_equal = TRUE;
        foreach ($arr_var as $str_var => $arr_data)
        {
            if (!isset($arr_old[$str_var]))
            {
                $bol_equal = FALSE;
            }
            elseif ($bol_equal)
            {
                if (!$this->AreEqual($arr_old[$str_var], $arr_data))
                {
                    $bol_equal = FALSE;
                }
            }
        }
        /* Verifica se existem variaveis a mais */
        if ($bol_equal)
        {
            foreach ($arr_old as $str_var => $arr_data)
            {
                if (!isset($arr_var[$str_var]))
                {
                    $bol_equal = FALSE;
                }
            }
        }
        if ($bol_equal)
        {
            return FALSE;
        }
        else
        {
            return $arr_var;
        }
    } // CompareVars

    /**
     * Verifica se duas variaveis sao iguais.
     *
     * @access  public
     * @param   array    $v_arr_var1   Variavel 1.
     * @param   array    $v_arr_var2   Variavel 2.
     * @return  boolean  $bol_equal    TRUE se as variaveis forem iguais,
     *                                 caso contrario FALSE.
     */
    function AreEqual($v_arr_var1, $v_arr_var2)
    {
        if(!isset($v_arr_var1['cabecalho_mobile']))
        {
            $v_arr_var1['cabecalho_mobile'] = "";
        }
        if(!isset($v_arr_var2['cabecalho_mobile']))
        {
            $v_arr_var2['cabecalho_mobile'] = "";
        }

        $bol_equal = TRUE;
        if ($v_arr_var1['filter_save_param'] != $v_arr_var2['filter_save_param'])
        {
            $bol_equal = FALSE;
        }
/* PHP 8.0 */
/*        if ($v_arr_var1['grid_save_param'] != $v_arr_var2['grid_save_param'])  */
        if (!isset($v_arr_var1['grid_save_param']) || !isset($v_arr_var2['grid_save_param']) || $v_arr_var1['grid_save_param'] != $v_arr_var2['grid_save_param'])
/*------*/
        {
            $bol_equal = FALSE;
        }
        if ($v_arr_var1['cabecalho'] != $v_arr_var2['cabecalho'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['cabecalho_mobile'] != $v_arr_var2['cabecalho_mobile'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['rodape'] != $v_arr_var2['rodape'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['path_imagem'] != $v_arr_var2['path_imagem'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['select'] != $v_arr_var2['select'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['substituicao'] != $v_arr_var2['substituicao'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['inicial'] != $v_arr_var2['inicial'])
        {
            $bol_equal = FALSE;
        }
        elseif ('S' == $v_arr_var1['inicial'] && !$this->AreEqualArrays($v_arr_var1['ini_campos'], $v_arr_var2['ini_campos']))
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['val_inicial_filtro'] != $v_arr_var2['val_inicial_filtro'])
        {
            $bol_equal = FALSE;
        }
        elseif ('S' == $v_arr_var1['val_inicial_filtro'] && !$this->AreEqualArrays($v_arr_var1['val_inicial_filtro_campos'], $v_arr_var2['val_inicial_filtro_campos']))
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['mu_fields_vars'] != $v_arr_var2['mu_fields_vars'])
        {
            $bol_equal = FALSE;
        }

        elseif ('S' == $v_arr_var1['mu_fields_vars'] && !$this->AreEqualArrays($v_arr_var1['mu_fields_seq'], $v_arr_var2['mu_fields_seq']))
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['label'] != $v_arr_var2['label'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['upload_api_path'] != $v_arr_var2['upload_api_path'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['upload_api_path_cache'] != $v_arr_var2['upload_api_path_cache'])
        {
            $bol_equal = FALSE;
        }
        elseif ('S' == $v_arr_var1['label'] && !$this->AreEqualArrays($v_arr_var1['lab_campos'], $v_arr_var2['lab_campos']))
        {
            $bol_equal = FALSE;
        }
        elseif ('S' == $v_arr_var1['label_watermarked'] && !$this->AreEqualArrays($v_arr_var1['label_watermarked_campos'], $v_arr_var2['label_watermarked_campos']))
        {
            $bol_equal = FALSE;
        }
        elseif ('S' == $v_arr_var1['label_filtro_watermarked'] && !$this->AreEqualArrays($v_arr_var1['label_filtro_watermarked_campos'], $v_arr_var2['label_filtro_watermarked_campos']))
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['php'] != $v_arr_var2['php'])
        {
            $bol_equal = FALSE;
        }
        elseif ('S' == $v_arr_var1['php'] && !$this->AreEqualArrays($v_arr_var1['php_campos'], $v_arr_var2['php_campos']))
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['but'] != $v_arr_var2['but'])
        {
            $bol_equal = FALSE;
        }
        elseif ('S' == $v_arr_var1['but'] && !$this->AreEqualArrays($v_arr_var1['but_button'], $v_arr_var2['but_button']))
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['acao'] != $v_arr_var2['acao'])
        {
            $bol_equal = FALSE;
        }
        elseif ('S' == $v_arr_var1['acao'] && !$this->AreEqualArrays($v_arr_var1['aca_campos'], $v_arr_var2['aca_campos']))
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['subdir'] != $v_arr_var2['subdir'])
        {
            $bol_equal = FALSE;
        }
        elseif ('S' == $v_arr_var1['subdir'] && !$this->AreEqualArrays($v_arr_var1['dir_campos'], $v_arr_var2['dir_campos']))
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['atualizacao'] != $v_arr_var2['atualizacao'])
        {
            $bol_equal = FALSE;
        }
        elseif ('S' == $v_arr_var1['atualizacao'] && !$this->AreEqualArrays($v_arr_var1['atu_campos'], $v_arr_var2['atu_campos']))
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['atualizacao_upd'] != $v_arr_var2['atualizacao_upd'])
        {
            $bol_equal = FALSE;
        }
        elseif ('S' == $v_arr_var1['atualizacao_upd'] && !$this->AreEqualArrays($v_arr_var1['atu_campos_upd'], $v_arr_var2['atu_campos_upd']))
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['valida'] != $v_arr_var2['valida'])
        {
            $bol_equal = FALSE;
        }
        elseif ('S' == $v_arr_var1['valida'] && !$this->AreEqualArrays($v_arr_var1['val_campos'], $v_arr_var2['val_campos']))
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['consulta'] != $v_arr_var2['consulta'])
        {
            $bol_equal = FALSE;
        }
        elseif ('S' == $v_arr_var1['consulta'] && !$this->AreEqualArrays($v_arr_var1['con_campos'], $v_arr_var2['con_campos']))
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['formulario'] != $v_arr_var2['formulario'])
        {
            $bol_equal = FALSE;
        }
        elseif ('S' == $v_arr_var1['formulario'] && !$this->AreEqualArrays($v_arr_var1['for_campos'], $v_arr_var2['for_campos']))
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['pesquisa'] != $v_arr_var2['pesquisa'])
        {
            $bol_equal = FALSE;
        }
        elseif ('S' == $v_arr_var1['pesquisa'] && !$this->AreEqualArrays($v_arr_var1['pes_campos'], $v_arr_var2['pes_campos']))
        {
            $bol_equal = FALSE;
        }
        elseif ('S' == $v_arr_var1['group'] && !$this->AreEqualArrays($v_arr_var1['group_campos'], $v_arr_var2['group_campos']))
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['lkpdesc'] != $v_arr_var2['lkpdesc'])
        {
            $bol_equal = FALSE;
        }
        elseif ('S' == $v_arr_var1['lkpdesc'] && !$this->AreEqualArrays($v_arr_var1['lkp_campos'], $v_arr_var2['lkp_campos']))
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['paypal_invoice'] != $v_arr_var2['paypal_invoice'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['paypal_custom'] != $v_arr_var2['paypal_custom'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['paypal_description'] != $v_arr_var2['paypal_description'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['paypal_amount'] != $v_arr_var2['paypal_amount'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['titulo'] != $v_arr_var2['titulo'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['dashboard_filter'] != $v_arr_var2['dashboard_filter'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['dashboard_idx_title'] != $v_arr_var2['dashboard_idx_title'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['exportemail_to'] != $v_arr_var2['exportemail_to'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['exportemail_cc'] != $v_arr_var2['exportemail_cc'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['exportemail_bcc'] != $v_arr_var2['exportemail_bcc'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['exportemail_subject'] != $v_arr_var2['exportemail_subject'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['exportemail_email'] != $v_arr_var2['exportemail_email'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['recaptcha_site_key'] != $v_arr_var2['recaptcha_site_key'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['recaptcha_secret_key'] != $v_arr_var2['recaptcha_secret_key'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['captcha_list_char'] != $v_arr_var2['captcha_list_char'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['captcha_msg_label'] != $v_arr_var2['captcha_msg_label'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['captcha_msg_erro'] != $v_arr_var2['captcha_msg_erro'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['summary_export_pdf_pwd_pwd'] != $v_arr_var2['summary_export_pdf_pwd_pwd'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['summary_export_word_pwd_pwd'] != $v_arr_var2['summary_export_word_pwd_pwd'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['summary_export_csv_pwd_pwd'] != $v_arr_var2['summary_export_csv_pwd_pwd'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['summary_export_xls_pwd_pwd'] != $v_arr_var2['summary_export_xls_pwd_pwd'])
        {
            $bol_equal = FALSE;
        }
        elseif ($v_arr_var1['summary_export_xml_pwd_pwd'] != $v_arr_var2['summary_export_xml_pwd_pwd'])
        {
            $bol_equal = FALSE;
        }
        return $bol_equal;
    } // AreEqual

    /**
     * Compara os elementos de dois arrays.
     *
     * @access  public
     * @param   array    $v_arr_1  Primeiro array.
     * @param   array    $v_arr_2  Segundo array.
     * @return  boolean
     */
    function AreEqualArrays($v_arr_1, $v_arr_2)
    {
        foreach ($v_arr_1 as $mix_key)
        {
            if (!in_array($mix_key, $v_arr_2))
            {
                return FALSE;
            }
        }
        foreach ($v_arr_2 as $mix_key)
        {
            if (!in_array($mix_key, $v_arr_1))
            {
                return FALSE;
            }
        }
        return TRUE;
    } // AreEqualArrays

    function SetDashboardFilter($v_str_filter)
    {
        $arr_list = self::RetrieveVarList($v_str_filter);
        $arr_vars = $this->GetTag('vars');

        foreach ($arr_vars as $str_var => $arr_var)
        {
            /* Variavel utilizada */
            if (in_array($str_var, $arr_list))
            {
                if ('N' == $arr_vars[$str_var]['dashboard_filter'])
                {
                    $this->Changed();
                }
                $arr_vars[$str_var]['dashboard_filter'] = 'S';
                $int_pos = array_search($str_var, $arr_list);
                unset($arr_list[$int_pos]);
            }
            /* Variavel nao utilizada */
            else
            {
                if ('S' == $arr_vars[$str_var]['dashboard_filter'])
                {
                    $this->Changed();
                    $arr_vars[$str_var]['dashboard_filter'] = 'N';
                }
            }
        }
        if (!empty($arr_list))
        {
            foreach ($arr_list as $str_var)
            {
                $this->Changed();
                $arr_vars[$str_var] = $this->CreateVar('dashboard_filter');
            }
        }

        $this->SetTag('vars', $arr_vars);
    } // SetDashboardFilter

    function SetDashboardIndexTitle($v_str_title)
    {
        $arr_list = self::RetrieveVarList($v_str_title);
        $arr_vars = $this->GetTag('vars');

        foreach ($arr_vars as $str_var => $arr_var)
        {
            /* Variavel utilizada */
            if (in_array($str_var, $arr_list))
            {
                if ('N' == $arr_vars[$str_var]['dashboard_idx_title'])
                {
                    $this->Changed();
                }
                $arr_vars[$str_var]['dashboard_idx_title'] = 'S';
                $int_pos = array_search($str_var, $arr_list);
                unset($arr_list[$int_pos]);
            }
            /* Variavel nao utilizada */
            else
            {
                if ('S' == $arr_vars[$str_var]['dashboard_idx_title'])
                {
                    $this->Changed();
                    $arr_vars[$str_var]['dashboard_idx_title'] = 'N';
                }
            }
        }
        if (!empty($arr_list))
        {
            foreach ($arr_list as $str_var)
            {
                $this->Changed();
                $arr_vars[$str_var] = $this->CreateVar('dashboard_idx_title');
            }
        }

        $this->SetTag('vars', $arr_vars);
    } // SetDashboardIndexTitle

    /**
     * Define variaveis.
     *
     * Define as variaveis de cabecalho.
     *
     * @access  public
     * @param   string  $v_str_head   Dados do cabecalho.
     * @param   string  $v_str_other  Dados dos outros cabecalhos.
     */
    function SetHeader($v_str_head, $v_str_other, $header_type = "cabecalho")
    {
        $arr_list  = self::RetrieveVarList($v_str_head);
        $arr_other = self::RetrieveVarList($v_str_other);
        $arr_vars  = $this->GetTag('vars');

        foreach ($arr_vars as $str_var => $arr_var)
        {
            /* Variavel utilizada */
            if (in_array($str_var, $arr_list))
            {
                if ('N' == $arr_vars[$str_var][ $header_type ])
                {
                    $this->Changed();
                }
                $arr_vars[$str_var][ $header_type ] = 'S';
                $int_pos = array_search($str_var, $arr_list);
                unset($arr_list[$int_pos]);
            }
            /* Variavel nao utilizada */
            else
            {
                if (('S' == $arr_vars[$str_var][ $header_type ]))
                {
                    $this->Changed();
                    $arr_vars[$str_var][ $header_type ] = 'N';
                }
            }
        }
        if (!empty($arr_list))
        {
            foreach ($arr_list as $str_var)
            {
                $this->Changed();
                $arr_vars[$str_var] = $this->CreateVar( $header_type );
            }
        }

        $this->SetTag('vars', $arr_vars);
    } // SetHeader

    /**
     * Define variaveis.
     *
     * Define as variaveis de titulo.
     *
     * @access  public
     * @param   string  $v_str_head   Dados do cabecalho.
     * @param   string  $v_str_other  Dados dos outros cabecalhos.
     */
    function SetTitulos($v_str_titulo)
    {
        $arr_list  = self::RetrieveVarList($v_str_titulo);
        $arr_vars  = $this->GetTag('vars');

        foreach ($arr_vars as $str_var => $arr_var)
        {
            /* Variavel utilizada */
            if (in_array($str_var, $arr_list))
            {
                if ('N' == $arr_vars[$str_var]['titulo'])
                {
                    $this->Changed();
                }
                $arr_vars[$str_var]['titulo'] = 'S';
                $int_pos = array_search($str_var, $arr_list);
                unset($arr_list[$int_pos]);
            }
            /* Variavel nao utilizada */
            elseif ('S' == $arr_vars[$str_var]['titulo'] && !in_array($str_var, $this->titulos))
            {
                $this->Changed();
                $this->titulos[] = $str_var;
                $arr_vars[$str_var]['titulo'] = 'N';
            }
        }
        if (!empty($arr_list))
        {
            foreach ($arr_list as $str_var)
            {
                $this->Changed();
                $this->titulos[] = $str_var;
                $arr_vars[$str_var] = $this->CreateVar('titulo');
            }
        }
        $this->SetTag('vars', $arr_vars);
    } // SetTitulos

    /**
     * Define variaveis.
     *
     * Define as variaveis do rodape.
     *
     * @access  public
     * @param   string  $v_str_foot   Dados do rodape.
     * @param   string  $v_str_other  Dados dos outros rodapes.
     */
    function SetFooter($v_str_foot, $v_str_other)
    {
        $arr_list  = self::RetrieveVarList($v_str_foot);
        $arr_other = self::RetrieveVarList($v_str_other);
        $arr_vars  = $this->GetTag('vars');
        foreach ($arr_vars as $str_var => $arr_var)
        {
            /* Variavel utilizada */
            if (in_array($str_var, $arr_list))
            {
                if ('N' == $arr_vars[$str_var]['rodape'])
                {
                    $this->Changed();
                }
                $arr_vars[$str_var]['rodape'] = 'S';
                $int_pos = array_search($str_var, $arr_list);
                unset($arr_list[$int_pos]);
            }
            /* Variavel nao utilizada */
            else
            {
                if (('S' == $arr_vars[$str_var]['rodape']))
                {
                    $this->Changed();
                    $arr_vars[$str_var]['rodape'] = 'N';
                }
            }
        }
        if (!empty($arr_list))
        {
            foreach ($arr_list as $str_var)
            {
                $this->Changed();
                $arr_vars[$str_var] = $this->CreateVar('rodape');
            }
        }

        $this->SetTag('vars', $arr_vars);
    } // SetFooter

    /**
     * Define variaveis.
     *
     * Define as variaveis de regras do filtro.
     *
     * @access  public
     * @param   string  $v_str_head   Dados do cabecalho.
     * @param   string  $v_str_other  Dados dos outros cabecalhos.
     */
    function SetFilterSaveParam($v_str_param)
    {
        $arr_list  = self::RetrieveVarList($v_str_param);

        $arr_vars  = $this->GetTag('vars');
        foreach ($arr_vars as $str_var => $arr_var)
        {
            /* Variavel utilizada */
            if (in_array($str_var, $arr_list))
            {
                if ('N' == $arr_vars[$str_var]['filter_save_param'])
                {
                    $this->Changed();
                }
                $arr_vars[$str_var]['filter_save_param'] = 'S';
                $int_pos = array_search($str_var, $arr_list);
                unset($arr_list[$int_pos]);
            }
            /* Variavel nao utilizada */
            else
            {
                if (('S' == $arr_vars[$str_var]['filter_save_param']) && !in_array($str_var, $arr_list))
                {
                    $this->Changed();
                    $arr_vars[$str_var]['filter_save_param'] = 'N';
                }
            }
        }
        if (!empty($arr_list))
        {
            foreach ($arr_list as $str_var)
            {
                $this->Changed();
                $arr_vars[$str_var] = $this->CreateVar('filter_save_param');
            }
        }
        $this->SetTag('vars', $arr_vars);
    } // SetFilterSaveParam

    /**
     * Define variaveis.
     *
     * Define as variaveis de regras do filtro.
     *
     * @access  public
     * @param   string  $v_str_head   Dados do cabecalho.
     * @param   string  $v_str_other  Dados dos outros cabecalhos.
     */
    function SetGridSaveParam($v_str_param)
    {
        $arr_list  = self::RetrieveVarList($v_str_param);

        $arr_vars  = $this->GetTag('vars');
        foreach ($arr_vars as $str_var => $arr_var)
        {
            /* Variavel utilizada */
            if (in_array($str_var, $arr_list))
            {
                if ('N' == $arr_vars[$str_var]['grid_save_param'])
                {
                    $this->Changed();
                }
                $arr_vars[$str_var]['grid_save_param'] = 'S';
                $int_pos = array_search($str_var, $arr_list);
                unset($arr_list[$int_pos]);
            }
            /* Variavel nao utilizada */
            else
            {
                if (('S' == $arr_vars[$str_var]['grid_save_param']) && !in_array($str_var, $arr_list))
                {
                    $this->Changed();
                    $arr_vars[$str_var]['grid_save_param'] = 'N';
                }
            }
        }
        if (!empty($arr_list))
        {
            foreach ($arr_list as $str_var)
            {
                $this->Changed();
                $arr_vars[$str_var] = $this->CreateVar('grid_save_param');
            }
        }
        $this->SetTag('vars', $arr_vars);
    } // SetGridSaveParam

    /**
     * Define variaveis.
     *
     * Define as variaveis que entram na quebra
     *
     * @access  public
     * @param   string   $v_str_sql  Formula PHP.
     * @param   integer  $v_int_seq  Sequencial do campo.
     */
    function SetGroup($v_str_group, $v_int_seq)
    {
        $arr_list = self::RetrieveVarList($v_str_group);
        $arr_vars = $this->GetTag('vars');
        foreach ($arr_vars as $str_var => $arr_var)
        {
            /* Variavel utilizada */
            if (in_array($str_var, $arr_list))
            {
                if ('N' == $arr_vars[$str_var]['quebra'])
                {
                    $this->Changed();
                }
                if (!in_array($v_int_seq, $arr_vars[$str_var]['qbr_campos']))
                {
                    $this->Changed();
                    array_push($arr_vars[$str_var]['qbr_campos'], $v_int_seq);
                }
                $arr_vars[$str_var]['quebra'] = 'S';
                $int_pos = array_search($str_var, $arr_list);
                unset($arr_list[$int_pos]);
            }
            /* Variavel nao utilizada */
            else
            {
                if (is_array($arr_vars[$str_var]['qbr_campos']) && in_array($v_int_seq, $arr_vars[$str_var]['qbr_campos']))
                {
                    $this->Changed();
                    $int_pos = array_search($v_int_seq, $arr_vars[$str_var]['qbr_campos']);
                    unset($arr_vars[$str_var]['qbr_campos'][$int_pos]);
                }
                if (('S' == $arr_vars[$str_var]['php']) && empty($arr_vars[$str_var]['qbr_campos']))
                {
                    $this->Changed();
                    $arr_vars[$str_var]['quebra'] = 'N';
                }
            }
            if(isset($arr_vars[$str_var]['qbr_campos'])) asort($arr_vars[$str_var]['qbr_campos']);
        }
        if (!empty($arr_list))
        {
            foreach ($arr_list as $str_var)
            {
                $this->Changed();
                $arr_vars[$str_var] = $this->CreateVar('quebra', $v_int_seq);
            }
        }
        $this->SetTag('vars', $arr_vars);
    } // SetGroup

    /**
     * Define variaveis.
     *
     * Define a variavel de caminho de imagens.
     *
     * @access  public
     * @param   string   $v_str_var  Nome da variavel.
     */
    function SetImagePath($v_str_var)
    {
        $arr_list = self::RetrieveVarList($v_str_var);
        if (empty($arr_list) || (1 < sizeof($arr_list)))
        {
            $v_str_var = '';
        }
        else
        {
            $v_str_var = $arr_list[0];
        }
        $arr_vars = $this->GetTag('vars');
        $bol_used = FALSE;
        foreach ($arr_vars as $str_var => $arr_var)
        {
            /* Variavel utilizada */
            if ($str_var == $v_str_var)
            {
                if ('N' == $arr_vars[$str_var]['path_imagem'])
                {
                    $this->Changed();
                }
                $arr_vars[$str_var]['path_imagem'] = 'S';
                $bol_used                          = TRUE;
            }
            /* Variavel nao utilizada */
            else
            {
                if ('S' == $arr_vars[$str_var]['path_imagem'])
                {
                    $this->Changed();
                }
                $arr_vars[$str_var]['path_imagem'] = 'N';
            }
        }
        if (!$bol_used)
        {
            $this->Changed();
            $arr_vars[$v_str_var] = $this->CreateVar('path_imagem');
        }
        $this->SetTag('vars', $arr_vars);
    } // SetImagePath

    /**
     * Define variaveis.
     *
     * Define as variaveis que entram no valor inicial de um campo.
     *
     * @access  public
     * @param   string   $v_str_ini  Valor inicial.
     * @param   integer  $v_int_seq  Sequencial do campo.
     */
    function SetInitialField($v_str_ini, $v_int_seq, $v_field = 'inicial', $v_field_array = 'ini_campos')
    {
        $arr_list = self::RetrieveVarList($v_str_ini);
        $arr_vars = $this->GetTag('vars');
        foreach ($arr_vars as $str_var => $arr_var)
        {
            /* Variavel utilizada */
            if (in_array($str_var, $arr_list))
            {
                if ('N' == $arr_vars[$str_var][ $v_field ])
                {
                    $this->Changed();
                }
                if (!in_array($v_int_seq, $arr_vars[$str_var][ $v_field_array]))
                {
                    $this->Changed();
                    array_push($arr_vars[$str_var][ $v_field_array ], $v_int_seq);
                }
                $arr_vars[$str_var][ $v_field ] = 'S';
                $int_pos = array_search($str_var, $arr_list);
                unset($arr_list[$int_pos]);
            }
            /* Variavel nao utilizada */
            else
            {
                if (is_array($arr_vars[$str_var][ $v_field_array ]) && in_array($v_int_seq, $arr_vars[$str_var][ $v_field_array ]))
                {
                    $this->Changed();
                    $int_pos = array_search($v_int_seq, $arr_vars[$str_var][ $v_field_array ]);
                    unset($arr_vars[$str_var][ $v_field_array ][$int_pos]);
                }
                if (('S' == $arr_vars[$str_var][ $v_field ]) && empty($arr_vars[$str_var][ $v_field_array ]))
                {
                    $this->Changed();
                    $arr_vars[$str_var][ $v_field ] = 'N';
                }
            }
            if(isset($arr_vars[$str_var][ $v_field_array ])) asort($arr_vars[$str_var][ $v_field_array ]);
        }
        if (!empty($arr_list))
        {
            foreach ($arr_list as $str_var)
            {
                $this->Changed();
                $arr_vars[$str_var] = $this->CreateVar($v_field, $v_int_seq);
            }
        }
        $this->SetTag('vars', $arr_vars);
    } // SetInitialField

    /**
     * Define variaveis.
     *
     * Define as variaveis que entram no valor inicial de um campo.
     *
     * @access  public
     * @param   string   $v_str_ini  Valor inicial.
     * @param   integer  $v_int_seq  Sequencial do campo.
     */
    function SetMuFields($v_str_ini, $v_int_seq)
    {
        $arr_list = self::RetrieveVarList($v_str_ini);
        $arr_vars = $this->GetTag('vars');
        foreach ($arr_vars as $str_var => $arr_var)
        {
            /* Variavel utilizada */
            if (in_array($str_var, $arr_list))
            {

                if ('N' == $arr_vars[$str_var]['mu_fields_vars'])
                {
                    $this->Changed();
                }
                if (!in_array($v_int_seq, $arr_vars[$str_var]['mu_fields_seq']))
                {
                    $this->Changed();
                    array_push($arr_vars[$str_var]['mu_fields_seq'], $v_int_seq);
                }
                $arr_vars[$str_var]['mu_fields_vars'] = 'S';
                $int_pos = array_search($str_var, $arr_list);
                unset($arr_list[$int_pos]);
            }
            /* Variavel nao utilizada */
            else
            {
                if (is_array($arr_vars[$str_var]['mu_fields_seq']) && in_array($v_int_seq, $arr_vars[$str_var]['mu_fields_seq']))
                {
                    $this->Changed();
                    $int_pos = array_search($v_int_seq, $arr_vars[$str_var]['mu_fields_seq']);
                    unset($arr_vars[$str_var]['mu_fields_seq'][$int_pos]);
                }
                if (('S' == $arr_vars[$str_var]['mu_fields_vars']) && empty($arr_vars[$str_var]['mu_fields_seq']))
                {
                    $this->Changed();
                    $arr_vars[$str_var]['mu_fields_vars'] = 'N';
                }
            }
            if(isset($arr_vars[$str_var]['mu_fields_seq'])) asort($arr_vars[$str_var]['mu_fields_seq']);
        }
        if (!empty($arr_list))
        {
            foreach ($arr_list as $str_var)
            {
                $this->Changed();
                $arr_vars[$str_var] = $this->CreateVar('mu_fields_vars', $v_int_seq);
            }
        }
        $this->SetTag('vars', $arr_vars);
    } // SetMuFields

    /**
     * Define variaveis.
     *
     * Define as variaveis que entram no label de um campo.
     *
     * @access  public
     * @param   string   $v_str_sql  Comando SQL.
     * @param   integer  $v_int_seq  Sequencial do campo.
     */
    function SetLabelField($v_str_sql, $v_int_seq)
    {
        $arr_list = self::RetrieveVarList($v_str_sql);

        $arr_vars = $this->GetTag('vars');

        foreach ($arr_vars as $str_var => $arr_var)
        {
            /* Variavel utilizada */
            if (in_array($str_var, $arr_list))
            {
                if ('N' == $arr_vars[$str_var]['label'])
                {
                    $this->Changed();
                }
                if (!in_array($v_int_seq, $arr_vars[$str_var]['lab_campos']))
                {
                    $this->Changed();
                    array_push($arr_vars[$str_var]['lab_campos'], $v_int_seq);
                }
                $arr_vars[$str_var]['label'] = 'S';
                $int_pos = array_search($str_var, $arr_list);
                unset($arr_list[$int_pos]);
            }
            /* Variavel nao utilizada */
            else
            {
                if (is_array($arr_vars[$str_var]['lab_campos']) && in_array($v_int_seq, $arr_vars[$str_var]['lab_campos']))
                {
                    $this->Changed();
                    $int_pos = array_search($v_int_seq, $arr_vars[$str_var]['lab_campos']);
                    unset($arr_vars[$str_var]['lab_campos'][$int_pos]);
                }
                if (('S' == $arr_vars[$str_var]['label']) && empty($arr_vars[$str_var]['lab_campos']))
                {
                    $this->Changed();
                    $arr_vars[$str_var]['label'] = 'N';
                }
            }
            if(isset($arr_vars[$str_var]['lab_campos'])) asort($arr_vars[$str_var]['lab_campos']);
        }
        if (!empty($arr_list))
        {
            foreach ($arr_list as $str_var)
            {
                $this->Changed();
                $arr_vars[$str_var] = $this->CreateVar('label', $v_int_seq);
            }
        }

        $this->SetTag('vars', $arr_vars);
    }

    function SetUploadPath($v_str_sql, $v_int_seq)
    {
        $arr_list = self::RetrieveVarList($v_str_sql);

        $arr_vars = $this->GetTag('vars');

        foreach ($arr_vars as $str_var => $arr_var)
        {
            /* Variavel utilizada */
            if (in_array($str_var, $arr_list))
            {
                if ('N' == $arr_vars[$str_var]['upload_api_path'])
                {
                    $this->Changed();
                }
                if (!in_array($v_int_seq, $arr_vars[$str_var]['upload_api_path_seq']))
                {
                    $this->Changed();
                    array_push($arr_vars[$str_var]['upload_api_path_seq'], $v_int_seq);
                }
                $arr_vars[$str_var]['upload_api_path'] = 'S';
                $int_pos = array_search($str_var, $arr_list);
                unset($arr_list[$int_pos]);
            }
            /* Variavel nao utilizada */
            else
            {
                if (is_array($arr_vars[$str_var]['upload_api_path_seq']) && in_array($v_int_seq, $arr_vars[$str_var]['upload_api_path_seq']))
                {
                    $this->Changed();
                    $int_pos = array_search($v_int_seq, $arr_vars[$str_var]['upload_api_path_seq']);
                    unset($arr_vars[$str_var]['upload_api_path_seq'][$int_pos]);
                }
                if (('S' == $arr_vars[$str_var]['upload_api_path']) && empty($arr_vars[$str_var]['upload_api_path_seq']))
                {
                    $this->Changed();
                    $arr_vars[$str_var]['upload_api_path'] = 'N';
                }
            }
            if(isset($arr_vars[$str_var]['upload_api_path'])) asort($arr_vars[$str_var]['upload_api_path_seq']);
        }
        if (!empty($arr_list))
        {
            foreach ($arr_list as $str_var)
            {
                $this->Changed();
                $arr_vars[$str_var] = $this->CreateVar('upload_api_path', $v_int_seq);
            }
        }
        $this->SetTag('vars', $arr_vars);
    }

    function SetUploadPathCache($v_str_sql, $v_int_seq)
    {
        $arr_list = self::RetrieveVarList($v_str_sql);

        $arr_vars = $this->GetTag('vars');

        foreach ($arr_vars as $str_var => $arr_var)
        {
            /* Variavel utilizada */
            if (in_array($str_var, $arr_list))
            {
                if ('N' == $arr_vars[$str_var]['upload_api_path_cache'])
                {
                    $this->Changed();
                }
                if (!in_array($v_int_seq, $arr_vars[$str_var]['upload_api_path_cache_seq']))
                {
                    $this->Changed();
                    array_push($arr_vars[$str_var]['upload_api_path_cache_seq'], $v_int_seq);
                }
                $arr_vars[$str_var]['upload_api_path_cache'] = 'S';
                $int_pos = array_search($str_var, $arr_list);
                unset($arr_list[$int_pos]);
            }
            /* Variavel nao utilizada */
            else
            {
                if (is_array($arr_vars[$str_var]['upload_api_path_cache_seq']) && in_array($v_int_seq, $arr_vars[$str_var]['upload_api_path_cache_seq']))
                {
                    $this->Changed();
                    $int_pos = array_search($v_int_seq, $arr_vars[$str_var]['upload_api_path_cache_seq']);
                    unset($arr_vars[$str_var]['upload_api_path_cache_seq'][$int_pos]);
                }
                if (('S' == $arr_vars[$str_var]['upload_api_path_cache']) && empty($arr_vars[$str_var]['upload_api_path_cache_seq']))
                {
                    $this->Changed();
                    $arr_vars[$str_var]['upload_api_path_cache'] = 'N';
                }
            }
            if(isset($arr_vars[$str_var]['upload_api_path_cache'])) asort($arr_vars[$str_var]['upload_api_path_cache_seq']);
        }
        if (!empty($arr_list))
        {
            foreach ($arr_list as $str_var)
            {
                $this->Changed();
                $arr_vars[$str_var] = $this->CreateVar('upload_api_path_cache', $v_int_seq);
            }
        }
        $this->SetTag('vars', $arr_vars);
    }

    function SetLabelWatermarkField($v_str_sql, $v_int_seq)
    {
        $arr_list = self::RetrieveVarList($v_str_sql);

        $arr_vars = $this->GetTag('vars');

        foreach ($arr_vars as $str_var => $arr_var)
        {
            /* Variavel utilizada */
            if (in_array($str_var, $arr_list))
            {
                if ('N' == $arr_vars[$str_var]['label_watermarked'])
                {
                    $this->Changed();
                }
                if (!in_array($v_int_seq, $arr_vars[$str_var]['label_watermarked_campos']))
                {
                    $this->Changed();
                    array_push($arr_vars[$str_var]['label_watermarked_campos'], $v_int_seq);
                }
                $arr_vars[$str_var]['label_watermarked'] = 'S';
                $int_pos = array_search($str_var, $arr_list);
                unset($arr_list[$int_pos]);
            }
            /* Variavel nao utilizada */
            else
            {
                if (is_array($arr_vars[$str_var]['label_watermarked_campos']) && in_array($v_int_seq, $arr_vars[$str_var]['label_watermarked_campos']))
                {
                    $this->Changed();
                    $int_pos = array_search($v_int_seq, $arr_vars[$str_var]['label_watermarked_campos']);
                    unset($arr_vars[$str_var]['label_watermarked_campos'][$int_pos]);
                }
                if (('S' == $arr_vars[$str_var]['label_watermarked']) && empty($arr_vars[$str_var]['label_watermarked_campos']))
                {
                    $this->Changed();
                    $arr_vars[$str_var]['label_watermarked'] = 'N';
                }
            }
            if(isset($arr_vars[$str_var]['label_watermarked_campos'])) asort($arr_vars[$str_var]['label_watermarked_campos']);
        }
        if (!empty($arr_list))
        {
            foreach ($arr_list as $str_var)
            {
                $this->Changed();
                $arr_vars[$str_var] = $this->CreateVar('label_watermarked', $v_int_seq);
            }
        }

        $this->SetTag('vars', $arr_vars);
    }

    function SetLabelFilterWatermarkField($v_str_sql, $v_int_seq)
    {
        $arr_list = self::RetrieveVarList($v_str_sql);

        $arr_vars = $this->GetTag('vars');

        foreach ($arr_vars as $str_var => $arr_var)
        {
            /* Variavel utilizada */
            if (in_array($str_var, $arr_list))
            {
                if ('N' == $arr_vars[$str_var]['label_filtro_watermarked'])
                {
                    $this->Changed();
                }
                if (!in_array($v_int_seq, $arr_vars[$str_var]['label_filtro_watermarked_campos']))
                {
                    $this->Changed();
                    array_push($arr_vars[$str_var]['label_filtro_watermarked_campos'], $v_int_seq);
                }
                $arr_vars[$str_var]['label_filtro_watermarked'] = 'S';
                $int_pos = array_search($str_var, $arr_list);
                unset($arr_list[$int_pos]);
            }
            /* Variavel nao utilizada */
            else
            {
                if (is_array($arr_vars[$str_var]['label_filtro_watermarked_campos']) && in_array($v_int_seq, $arr_vars[$str_var]['label_filtro_watermarked_campos']))
                {
                    $this->Changed();
                    $int_pos = array_search($v_int_seq, $arr_vars[$str_var]['label_filtro_watermarked_campos']);
                    unset($arr_vars[$str_var]['label_filtro_watermarked_campos'][$int_pos]);
                }
                if (('S' == $arr_vars[$str_var]['label_filtro_watermarked']) && empty($arr_vars[$str_var]['label_filtro_watermarked_campos']))
                {
                    $this->Changed();
                    $arr_vars[$str_var]['label_filtro_watermarked'] = 'N';
                }
            }
            if(isset($arr_vars[$str_var]['label_filtro_watermarked_campos'])) asort($arr_vars[$str_var]['label_filtro_watermarked_campos']);
        }
        if (!empty($arr_list))
        {
            foreach ($arr_list as $str_var)
            {
                $this->Changed();
                $arr_vars[$str_var] = $this->CreateVar('label_filtro_watermarked', $v_int_seq);
            }
        }

        $this->SetTag('vars', $arr_vars);
    } // SetLabelField

    /**
     * Define variaveis.
     *
     * Define as variaveis que entram no lookup de um campo.
     *
     * @access  public
     * @param   string   $v_str_sql  Comando SQL.
     * @param   string   $v_str_mod  Modulo do lookup.
     * @param   integer  $v_int_seq  Sequencial do campo.
     */
    function SetLookupField($v_str_sql, $v_str_mod, $v_int_seq, $v_str_comp="")
    {
        $arr_list = self::RetrieveVarList($v_str_sql);
        $arr_vars = $this->GetTag('vars');

        switch($v_str_mod)
        {
            case 'desc':
                $str_flag  = 'lkpdesc';
                $str_array = 'lkp_campos';
                break;
            case 'cons':
                $str_flag  = 'consulta';
                $str_array = 'con_campos';
                break;
            case 'pesq':
                $str_flag  = 'pesquisa';
                $str_array = 'pes_campos';
                break;
            case 'group':
                $str_flag  = 'group';
                $str_array = 'group_campos';
                break;
            default:
                $str_flag  = 'formulario';
                $str_array = 'for_campos';
                break;

        }

        foreach ($arr_vars as $str_var => $arr_var)
        {
            $v_int_seq_index = $v_int_seq;
            if($v_str_mod == 'group')
            {
                $v_int_seq_index = $v_int_seq . "__NM__" . $v_str_comp;
            }

            /* Variavel utilizada */
            if (in_array($str_var, $arr_list))
            {
                if ('N' == $arr_vars[$str_var][$str_flag])
                {
                    $this->Changed();
                }
                if (!in_array($v_int_seq_index, $arr_vars[$str_var][$str_array]))
                {
                    $this->Changed();
                    array_push($arr_vars[$str_var][$str_array], $v_int_seq_index);
                }
                $arr_vars[$str_var][$str_flag] = 'S';
                $int_pos = array_search($str_var, $arr_list);
                unset($arr_list[$int_pos]);
            }
            /* Variavel nao utilizada */
            else
            {
                if (is_array($arr_vars[$str_var][$str_array]) && in_array($v_int_seq_index, $arr_vars[$str_var][$str_array]))
                {
                    $this->Changed();
                    $int_pos = array_search($v_int_seq_index, $arr_vars[$str_var][$str_array]);
                    unset($arr_vars[$str_var][$str_array][$int_pos]);
                }
                if (('S' == $arr_vars[$str_var][$str_flag]) && empty($arr_vars[$str_var][$str_array]))
                {
                    $this->Changed();
                    $arr_vars[$str_var][$str_flag] = 'N';
                }
            }
            if(isset($arr_vars[$str_var][$str_array])) asort($arr_vars[$str_var][$str_array]);
        }
        if (!empty($arr_list))
        {
            foreach ($arr_list as $str_var)
            {
                $this->Changed();
                $arr_vars[$str_var] = $this->CreateVar($str_flag, $v_int_seq, $v_str_comp);
            }
        }

        $this->SetTag('vars', $arr_vars);
    } // SetLookupField

    /**
     * Define variaveis.
     *
     * Define as variaveis que entram em uma formula PHP.
     *
     * @access  public
     * @param   string   $v_str_sql  Formula PHP.
     * @param   integer  $v_int_seq  Sequencial do campo.
     */
    function SetPhpField($v_str_php, $v_int_seq)
    {
        $v_str_php = preg_replace('/\?>(.*?)<\?[php]*/s',  '', $v_str_php);

        $v_str_php = preg_replace('!/\*.*?\*/!s', '', $v_str_php);
        $v_str_php = preg_replace('![ \t]*//.*[ \t]*[\r\n]!', '', $v_str_php);

        $v_str_php = nm_replace_preg_functions($v_str_php);

        scRemoveComments($v_str_php);

        $arr_list = self::RetrieveVarList($v_str_php);

        $arr_vars = $this->GetTag('vars');
        foreach ($arr_vars as $str_var => $arr_var)
        {
            /* Variavel utilizada */
            if (in_array($str_var, $arr_list))
            {
                if ('N' == $arr_vars[$str_var]['php'])
                {
                    $this->Changed();
                }
                if (!in_array($v_int_seq, $arr_vars[$str_var]['php_campos']))
                {
                    $this->Changed();
                    array_push($arr_vars[$str_var]['php_campos'], $v_int_seq);
                }
                $arr_vars[$str_var]['php'] = 'S';
                $int_pos = array_search($str_var, $arr_list);
                unset($arr_list[$int_pos]);
            }
            /* Variavel nao utilizada */
            else
            {
                if (is_array($arr_vars[$str_var]['php_campos']) && in_array($v_int_seq, $arr_vars[$str_var]['php_campos']))
                {
                    $this->Changed();
                    $int_pos = array_search($v_int_seq, $arr_vars[$str_var]['php_campos']);
                    unset($arr_vars[$str_var]['php_campos'][$int_pos]);
                }
                if (('S' == $arr_vars[$str_var]['php']) && empty($arr_vars[$str_var]['php_campos']))
                {
                    $this->Changed();
                    $arr_vars[$str_var]['php'] = 'N';
                }
            }
            if(isset($arr_vars[$str_var]['php_campos'])) asort($arr_vars[$str_var]['php_campos']);
        }
        if (!empty($arr_list))
        {
            foreach ($arr_list as $str_var)
            {
                $this->Changed();
                $arr_vars[$str_var] = $this->CreateVar('php', $v_int_seq);
            }
        }
        $this->SetTag('vars', $arr_vars);
    } // SetPhpField

    /**
     * Define variaveis.
     *
     * Define as variaveis que entram em uma formula PHP do botao.
     *
     * @access  public
     * @param   string   $v_str_sql  Formula PHP.
     * @param   integer  $v_int_seq  Sequencial do campo.
     */
    function SetPhpButton($v_str_php, $v_int_seq)
    {
        $v_str_php = preg_replace('/\?>(.*?)<\?[php]*/s',  '', $v_str_php);

        $v_str_php = preg_replace('!/\*.*?\*/!s', '', $v_str_php);
        $v_str_php = preg_replace('![ \t]*//.*[ \t]*[\r\n]!', '', $v_str_php);

        $v_str_php = nm_replace_preg_functions($v_str_php);

        scRemoveComments($v_str_php);

        $arr_list = self::RetrieveVarList($v_str_php);

        $arr_vars = $this->GetTag('vars');
        foreach ($arr_vars as $str_var => $arr_var)
        {
            if (!isset($arr_vars[$str_var]['but_button']))
            {
                $arr_vars[$str_var]['but'] = 'N';
                $arr_vars[$str_var]['but_button'] = array();
            }

            /* Variavel utilizada */
            if (in_array($str_var, $arr_list))
            {
                if ('N' == $arr_vars[$str_var]['but'])
                {
                    $this->Changed();
                }
                if (!in_array($v_int_seq, $arr_vars[$str_var]['but_button']))
                {
                    $this->Changed();
                    array_push($arr_vars[$str_var]['but_button'], $v_int_seq);
                }
                $arr_vars[$str_var]['but'] = 'S';
                $int_pos = array_search($str_var, $arr_list);
                unset($arr_list[$int_pos]);
            }
            /* Variavel nao utilizada */
            else
            {
                if (is_array($arr_vars[$str_var]['but_button']) && in_array($v_int_seq, $arr_vars[$str_var]['but_button']))
                {
                    $this->Changed();
                    $int_pos = array_search($v_int_seq, $arr_vars[$str_var]['but_button']);
                    unset($arr_vars[$str_var]['but_button'][$int_pos]);
                }
                if (('S' == $arr_vars[$str_var]['but']) && empty($arr_vars[$str_var]['but_button']))
                {
                    $this->Changed();
                    $arr_vars[$str_var]['but'] = 'N';
                }
            }
            if(isset($arr_vars[$str_var]['but_button'])) asort($arr_vars[$str_var]['but_button']);
        }
        if (!empty($arr_list))
        {
            foreach ($arr_list as $str_var)
            {
                $this->Changed();
                $arr_vars[$str_var] = $this->CreateVar('but', $v_int_seq);
            }
        }
        $this->SetTag('vars', $arr_vars);
    } // SetPhpButton

    /**
     * Define variaveis.
     *
     * Define as variaveis que entram em uma regra de validacao.
     *
     * @access  public
     * @param   string   $v_str_val  Regra de validacao.
     * @param   integer  $v_int_seq  Sequencial do campo.
     */
    function SetSqlactionField($v_str_val, $v_int_seq)
    {
        $arr_list = self::RetrieveVarList($v_str_val);
        $arr_vars = $this->GetTag('vars');
        foreach ($arr_vars as $str_var => $arr_var)
        {
            /* Variavel utilizada */
            if (in_array($str_var, $arr_list))
            {
                if ('N' == $arr_vars[$str_var]['acao'])
                {
                    $this->Changed();
                }
                if (!in_array($v_int_seq, $arr_vars[$str_var]['aca_campos']))
                {
                    $this->Changed();
                    array_push($arr_vars[$str_var]['aca_campos'], $v_int_seq);
                }
                $arr_vars[$str_var]['acao'] = 'S';
                $int_pos = array_search($str_var, $arr_list);
                unset($arr_list[$int_pos]);
            }
            /* Variavel nao utilizada */
            else
            {
                if (in_array($v_int_seq, $arr_vars[$str_var]['aca_campos']))
                {
                    $this->Changed();
                    $int_pos = array_search($v_int_seq, $arr_vars[$str_var]['aca_campos']);
                    unset($arr_vars[$str_var]['aca_campos'][$int_pos]);
                }
                if (('S' == $arr_vars[$str_var]['acao']) && empty($arr_vars[$str_var]['aca_campos']))
                {
                    $this->Changed();
                    $arr_vars[$str_var]['acao'] = 'N';
                }
            }
            if(isset($arr_vars[$str_var]['aca_campos'])) asort($arr_vars[$str_var]['aca_campos']);
        }
        if (!empty($arr_list))
        {
            foreach ($arr_list as $str_var)
            {
                $this->Changed();
                $arr_vars[$str_var] = $this->CreateVar('acao', $v_int_seq);
            }
        }
        $this->SetTag('vars', $arr_vars);
    } // SetSqlactionField

    /**
     * Define variaveis.
     *
     * Define as variaveis que entram no comando select.
     *
     * @access  public
     * @param   string  $v_str_sql  Comando SQL.
     */
    function SetSqlCommand($v_str_sql)
    {
        $arr_list = self::RetrieveVarList($v_str_sql);
        $arr_vars = $this->GetTag('vars');
        foreach ($arr_vars as $str_var => $arr_var)
        {
            /* Variavel utilizada */
            if (in_array($str_var, $arr_list))
            {
                if ('N' == $arr_vars[$str_var]['select'])
                {
                    $this->Changed();
                }
                $arr_vars[$str_var]['select'] = 'S';
                $int_pos = array_search($str_var, $arr_list);
                unset($arr_list[$int_pos]);
            }
            /* Variavel nao utilizada */
            else
            {
                if ('S' == $arr_vars[$str_var]['select'])
                {
                    $this->Changed();
                }
                $arr_vars[$str_var]['select'] = 'N';
            }
        }
        if (!empty($arr_list))
        {
            foreach ($arr_list as $str_var)
            {
                $this->Changed();
                $arr_vars[$str_var] = $this->CreateVar('select');
            }
        }
        $this->SetTag('vars', $arr_vars);
    } // SetSqlCommand

    /**
     * Define variaveis.
     *
     * Define as variaveis que entram no comando select.
     *
     * @access  public
     * @param   string  $v_str_sql  Comando SQL.
     */
    function SetAppField($field_name, $field_value)
    {
        $arr_list = self::RetrieveVarList($field_value);
        $arr_vars = $this->GetTag('vars');
        foreach ($arr_vars as $str_var => $arr_var)
        {
            /* Variavel utilizada */
            if (in_array($str_var, $arr_list))
            {
                if ('N' == $arr_vars[$str_var][$field_name])
                {
                    $this->Changed();
                }
                $arr_vars[$str_var][$field_name] = 'S';
                $int_pos = array_search($str_var, $arr_list);
                unset($arr_list[$int_pos]);
            }
            /* Variavel nao utilizada */
            else
            {
                if ('S' == $arr_vars[$str_var][$field_name])
                {
                    $this->Changed();
                }
                $arr_vars[$str_var][$field_name] = 'N';
            }
        }
        if (!empty($arr_list))
        {
            foreach ($arr_list as $str_var)
            {
                $this->Changed();
                $arr_vars[$str_var] = $this->CreateVar($field_name);
            }
        }
        $this->SetTag('vars', $arr_vars);
    } // SetAppField

    /**
     * Define variaveis.
     *
     * Define as variaveis que entram em um subdiretorio.
     *
     * @access  public
     * @param   string   $v_str_dir  Subdiretorio.
     * @param   integer  $v_int_seq  Sequencial do campo.
     */
    function SetSubdirField($v_str_dir, $v_int_seq)
    {
        $arr_list = self::RetrieveVarList($v_str_dir);
        $arr_vars = $this->GetTag('vars');
        foreach ($arr_vars as $str_var => $arr_var)
        {
            /* Variavel utilizada */
            if (in_array($str_var, $arr_list))
            {
                if ('N' == $arr_vars[$str_var]['subdir'])
                {
                    $this->Changed();
                }
                if (!in_array($v_int_seq, $arr_vars[$str_var]['dir_campos']))
                {
                    $this->Changed();
                    array_push($arr_vars[$str_var]['dir_campos'], $v_int_seq);
                }
                $arr_vars[$str_var]['subdir'] = 'S';
                $int_pos = array_search($str_var, $arr_list);
                unset($arr_list[$int_pos]);
            }
            /* Variavel nao utilizada */
            else
            {
                if (in_array($v_int_seq, $arr_vars[$str_var]['dir_campos']))
                {
                    $this->Changed();
                    $int_pos = array_search($v_int_seq, $arr_vars[$str_var]['dir_campos']);
                    unset($arr_vars[$str_var]['dir_campos'][$int_pos]);
                }
                if (('S' == $arr_vars[$str_var]['subdir']) && empty($arr_vars[$str_var]['dir_campos']))
                {
                    $this->Changed();
                    $arr_vars[$str_var]['subdir'] = 'N';
                }
            }
            if(isset($arr_vars[$str_var]['dir_campos'])) asort($arr_vars[$str_var]['dir_campos']);
        }
        if (!empty($arr_list))
        {
            foreach ($arr_list as $str_var)
            {
                $this->Changed();
                $arr_vars[$str_var] = $this->CreateVar('subdir', $v_int_seq);
            }
        }
        $this->SetTag('vars', $arr_vars);
    } // SetSubdirField

    /**
     * Define variaveis.
     *
     * Define a variavel de substituicao de campos.
     *
     * @access  public
     * @param   array   $v_arr_var  Array das variaveis.
     */
    function SetSubstField($v_arr_var)
    {
        foreach ($v_arr_var as $str_var => $str_val)
        {
            $arr_list = self::RetrieveVarList('[' . $str_var . ']');
            if (empty($arr_list) || (1 < sizeof($arr_list)))
            {
                unset($v_arr_var[$str_var]);
            }
        }
        $arr_vars = $this->GetTag('vars');
        foreach ($arr_vars as $str_var => $arr_var)
        {
            /* Variavel utilizada */
            if (in_array($str_var, array_keys($v_arr_var)))
            {
                if ('' == $arr_vars[$str_var]['subst_campo'])
                {
                    $this->Changed();
                }
                $arr_vars[$str_var]['subst_campo'] = $v_arr_var[$str_var];
                unset($v_arr_var[$str_var]);
            }
            /* Variavel nao utilizada */
            else
            {
                if ('' != $arr_vars[$str_var]['subst_campo'])
                {
                    $this->Changed();
                }
                $arr_vars[$str_var]['subst_campo'] = '';
            }
        }
        if (!empty($v_arr_var))
        {
            $this->Changed();
            foreach ($v_arr_var as $str_var => $str_val)
            {
                $arr_vars[$str_var] = $this->CreateVar('subst_campo', $str_val);
            }
        }
        $this->SetTag('vars', $arr_vars);
    } // SetSubstField

    /**
     * Define variaveis.
     *
     * Define a variavel de substituicao de tabela.
     *
     * @access  public
     * @param   string   $v_str_var  Nome da variavel.
     * @param   integer  $v_str_tab  Parte do nome da tabela.
     */
    function SetSubstTable($v_str_var, $v_str_tab)
    {
        $arr_list = self::RetrieveVarList('[' . $v_str_var . ']');
        if (empty($arr_list) || (1 < sizeof($arr_list)))
        {
            $v_str_var = '';
        }
        else
        {
            $v_str_var = $arr_list[0];
        }
        $arr_vars = $this->GetTag('vars');
        $bol_used = FALSE;
        foreach ($arr_vars as $str_var => $arr_var)
        {
            /* Variavel utilizada */
            if ($str_var == $v_str_var)
            {
                if ((''         == $arr_vars[$str_var]['subst_table']) ||
                    ($v_str_tab != $arr_vars[$str_var]['subst_table']))
                {
                    $this->Changed();
                }
                $arr_vars[$str_var]['subst_table'] = $v_str_tab;
                $bol_used                           = TRUE;
            }
            /* Variavel nao utilizada */
            else
            {
                if ('' != $arr_vars[$str_var]['subst_table'])
                {
                    $this->Changed();
                }
                $arr_vars[$str_var]['subst_table'] = '';
            }
        }
        if (!$bol_used)
        {
            $this->Changed();
            $arr_vars[$v_str_var] = $this->CreateVar('subst_table', $v_str_tab);
        }
        $this->SetTag('vars', $arr_vars);
    } // SetSubstTable

    /**
     * Define variaveis.
     *
     * Define a variavel de atualizacao de campos.
     *
     * @access  public
     * @param   string   $v_str_var  Nome da variavel.
     * @param   integer  $v_int_seq  Sequencial do campo.
     */
    function SetUpdateField($v_str_var, $v_int_seq, $insert_update = "insert")
    {
        $arr_list = self::RetrieveVarList($v_str_var);
        if (empty($arr_list) || (1 < sizeof($arr_list)))
        {
            $v_str_var = '';
        }
        else
        {
            $v_str_var = $arr_list[0];
        }
        $arr_vars = $this->GetTag('vars');
        $bol_used = FALSE;
        foreach ($arr_vars as $str_var => $arr_var)
        {
            /* Variavel utilizada */
            if ($str_var == $v_str_var)
            {
                if($insert_update=="insert")
                {
                    //insert
                    if ('N' == $arr_vars[$str_var]['atualizacao'])
                    {
                        $this->Changed();
                    }
                    if (!in_array($v_int_seq, $arr_vars[$str_var]['atu_campos']))
                    {
                        $this->Changed();
                        array_push($arr_vars[$str_var]['atu_campos'], $v_int_seq);
                    }
                    $arr_vars[$str_var]['atualizacao'] = 'S';
                    $bol_used                          = TRUE;
                }else
                {
                    //update
                    if ('N' == $arr_vars[$str_var]['atualizacao_upd'])
                    {
                        $this->Changed();
                    }
                    if (!in_array($v_int_seq, $arr_vars[$str_var]['atu_campos_upd']))
                    {
                        $this->Changed();
                        array_push($arr_vars[$str_var]['atu_campos_upd'], $v_int_seq);
                    }
                    $arr_vars[$str_var]['atualizacao_upd'] = 'S';
                    $bol_used                          = TRUE;
                }
            }
            /* Variavel nao utilizada */
            else
            {
                if($insert_update=="insert")
                {
                    //insert
                    if (in_array($v_int_seq, $arr_vars[$str_var]['atu_campos']))
                    {
                        $this->Changed();
                        $int_pos = array_search($v_int_seq, $arr_vars[$str_var]['atu_campos']);
                        unset($arr_vars[$str_var]['atu_campos'][$int_pos]);
                    }
                    if (('S' == $arr_vars[$str_var]['atualizacao']) && empty($arr_vars[$str_var]['atu_campos']))
                    {
                        $this->Changed();
                        $arr_vars[$str_var]['atualizacao'] = 'N';
                    }
                }else
                {
                    //update
                    if (in_array($v_int_seq, $arr_vars[$str_var]['atu_campos_upd']))
                    {
                        $this->Changed();
                        $int_pos = array_search($v_int_seq, $arr_vars[$str_var]['atu_campos_upd']);
                        unset($arr_vars[$str_var]['atu_campos_upd'][$int_pos]);
                    }
                    if (('S' == $arr_vars[$str_var]['atualizacao_upd']) && empty($arr_vars[$str_var]['atu_campos_upd']))
                    {
                        $this->Changed();
                        $arr_vars[$str_var]['atualizacao_upd'] = 'N';
                    }
                }
            }
            if($insert_update=="insert")
            {
                if(isset($arr_vars[$str_var]['atu_campos'])) asort($arr_vars[$str_var]['atu_campos']);
            }else
            {
                if(isset($arr_vars[$str_var]['atu_campos_upd'])) asort($arr_vars[$str_var]['atu_campos_upd']);
            }
        }
        if (!$bol_used)
        {
            $this->Changed();
            if($insert_update=="insert")
            {
                $arr_vars[$v_str_var] = $this->CreateVar('atualizacao', $v_int_seq);
            }else
            {
                $arr_vars[$v_str_var] = $this->CreateVar('atualizacao_upd', $v_int_seq);
            }
        }
        $this->SetTag('vars', $arr_vars);
    } // SetUpdateField

    /**
     * Define variaveis.
     *
     * Define as variaveis que entram em uma regra de validacao.
     *
     * @access  public
     * @param   string   $v_str_val  Regra de validacao.
     * @param   integer  $v_int_seq  Sequencial do campo.
     */
    function SetValidationField($v_str_val, $v_int_seq)
    {
        $arr_list = self::RetrieveVarList($v_str_val);
        $arr_vars = $this->GetTag('vars');
        foreach ($arr_vars as $str_var => $arr_var)
        {
            /* Variavel utilizada */
            if (in_array($str_var, $arr_list))
            {
                if ('N' == $arr_vars[$str_var]['valida'])
                {
                    $this->Changed();
                }
                if (!in_array($v_int_seq, $arr_vars[$str_var]['val_campos']))
                {
                    $this->Changed();
                    array_push($arr_vars[$str_var]['val_campos'], $v_int_seq);
                }
                $arr_vars[$str_var]['valida'] = 'S';
                $int_pos = array_search($str_var, $arr_list);
                unset($arr_list[$int_pos]);
            }
            /* Variavel nao utilizada */
            else
            {
                if (in_array($v_int_seq, $arr_vars[$str_var]['val_campos']))
                {
                    $this->Changed();
                    $int_pos = array_search($v_int_seq, $arr_vars[$str_var]['val_campos']);
                    unset($arr_vars[$str_var]['val_campos'][$int_pos]);
                }
                if (('S' == $arr_vars[$str_var]['valida']) && empty($arr_vars[$str_var]['val_campos']))
                {
                    $this->Changed();
                    $arr_vars[$str_var]['valida'] = 'N';
                }
            }
            if(isset($arr_vars[$str_var]['val_campos'])) asort($arr_vars[$str_var]['val_campos']);
        }
        if (!empty($arr_list))
        {
            foreach ($arr_list as $str_var)
            {
                $this->Changed();
                $arr_vars[$str_var] = $this->CreateVar('valida', $v_int_seq);
            }
        }
        $this->SetTag('vars', $arr_vars);
    } // SetValidationField
}

?>
<?php
/**
 * Classe PageAppActionbar.
 */

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}

/* Classes ancestrais */
nm_load_class('page', 'Page');

/* Definicao da classe */
class nmPageAppActionbar extends nmPage
{
    /**
     * Aplicacao normal.
     *
     * Objeto para manipulacao da aplicacao normal.
     *
     * @access  protected
     * @var     object
     */
    var $app;

    /**
     * Eventos.
     *
     * Objeto para manipulacao de eventos.
     *
     * @access  protected
     * @var     object
     */
    var $evt;

    /**
     * Lista de campos escondidos.
     *
     * Lista de campos escondidos do formulario.
     *
     * @access  protected
     * @var     array
     */
    var $hidden = [];

    /**
     * Lista de erros.
     *
     * Lista de erros encontrados no formulario.
     *
     * @access  protected
     * @var     array
     */
    var $errors = [];

    /**
     * Flag para redirectionamento.
     *
     * @access  protected
     * @var     string
     */
    var $redirect_to = '';

    /**
     * Paramaetros para redirectionamento.
     *
     * @access  protected
     * @var     array
     */
    var $redirect_param = [];

    /**
     * Lista de botoes ajax a aserem removidos.
     *
     * @access  protected
     * @var     array
     */
    var $remove_ajax = [];

    /**
     * Lista de links a serem removidos.
     *
     * @access  protected
     * @var     array
     */
    var $remove_link = [];

    /**
     * Passo de exibicao da edicao/criacao de actionbar.
     *
     * Passo de exibicao do processo de edicao/criacao de actionbar.
     *
     * @access  protected
     * @var     string
     */
    var $step_display;

    /**
     * Passo de processamento da edicao/criacao de actionbar.
     *
     * Passo de processamento do processo de edicao/criacao de actionbar.
     *
     * @access  protected
     * @var     string
     */
    var $step_process;

    /**
     * Opcao do passo de processamento da edicao/criacao de actionbar.
     *
     * Opcao do passo de processamento do processo de edicao/criacao de actionbar.
     *
     * @access  protected
     * @var     string
     */
    var $step_option;

    /**
     * Flag para indicar salva de dados da actionbar.
     *
     * @access  protected
     * @var     boolean
     */
    var $save_app = false;

    /* ----- Construtor e Destrutor ------------------------------------ */

    /**
     * Construtor da classe.
     */
    function __construct()
    {
        $this->RunAjax();
        $this->SetBody('nmPage');
        $this->SetMargin(5);
        $this->SetPage('AppActionbar');
        $this->SetPageCode(NM_PAGE_COD_APP_ACTIONBAR);
        $this->CheckLogin();
        $this->SetPageSubtitle('');
        $this->SetScroll('auto');
    } // nmPageAppLink

    /* ----- Metodos --------------------------------------------------- */

    /**
     * Exibe o conteudo.
     */
    function DisplayContent()
    {
        $this->PrepareObjects();
        $this->ValidateForm();
        $this->DisplayStep();
        $this->DisplayVersionWarning();
    } // DisplayContent

    /**
     * Retorna a URL do manual para Action Bar.
     *
     * @access  protected
     * @return  string     $str_result  URL do manual.
     */
    function FetchManualUrl()
    {
        global $nm_config;
        include($nm_config['path_lib'] . 'sc_manual.inc.php');

        $str_link = 'action_bar';

        $this->showPageDesenv($str_link);

        return $str_link;
    } // FetchManualUrl

    /**
     * Exibe os erros encontrados no formulario.
     */
    function DisplayErrors()
    {
        global $nm_error;

        $nm_error->DisplayErrorList(nm_get_text_lang("['err_form']"), $this->errors, false);
    } // DisplayErrors

    /**
     * Exibe o passa atual do formulario de actionbar.
     */
    function DisplayStep()
    {
        global $nm_template, $nm_config;

        if (!isset($_SESSION['nm_session']['actionbar_button']['state_labels_with_error'])) {
            $_SESSION['nm_session']['actionbar_button']['state_labels_with_error'] = [];
        }

        $str_link = $this->FetchManualUrl();
        $dest  = nm_verify_doc_url($this->getManual($str_link, $_SESSION['nm_session']['app']['type']));
        $this->showPageDesenv($str_link);
        $this->showPageDesenv($this->step_display);
        $nm_template->SetVar('str_js_help',"nm_window_manual('".$dest."'); return false;");

        $nm_template->SetVar('actionbar_step', $this->step_display);
        $nm_template->SetVar('modified_function', '');
        $nm_template->SetVar('save_function', '');
        $nm_template->SetVar('has_feature', $nm_config['flag_versao']['actiobar_grid']['has']);
        $nm_template->SetVar('state_labels_with_error', $_SESSION['nm_session']['actionbar_button']['state_labels_with_error']);

        if ($this->RedirectActionBar()) {
            return;
        }

        switch ($this->step_display) {
            case 'button_general':
                $this->DisplayStep_ButtonGeneral();
                break;
            case 'button_visual':
                $this->DisplayStep_ButtonVisual();
                break;
            case 'bar_visual':
                $this->DisplayStep_BarVisual();
                break;
            case 'list':
            default:
                $this->DisplayStep_ButtonList();
        }

        $this->MenuStatus();
        $this->GenerateApp();
    } // DisplayStep

    /**
     * Exibe a lista de botoes da actionbar da aplicacao.
     */
    function DisplayStep_ButtonList()
    {
        global $nm_template;

        $nm_template->SetVar('actionbar_list', $this->app->GetData('actionbar_grid'));
        $nm_template->SetVar('actionbar_order', $this->app->GetData('actionbar_grid_order'));

        $nm_template->SetVar('displayed_buttons', [/*'buttonGeneralSave', */'buttonGeneralNew', 'buttonBarVisual']);
        $nm_template->SetVar('save_function', 'scActionBarClick_menuSaveList');

        $this->AddHiddenFields();

        $nm_template->Display('body_actionbar_ini');
        $nm_template->Display('body_actionbar_list');
        $nm_template->Display('body_actionbar_end');
    } // DisplayStep_ButtonList

    /**
     * Exibe formulario geral de botao.
     */
    function DisplayStep_ButtonGeneral()
    {
        global $nm_template;

        $nm_template->SetVar('button_label', $_SESSION['nm_session']['actionbar_button']['label']);
        $nm_template->SetVar('button_type', $_SESSION['nm_session']['actionbar_button']['type']);

        $nm_template->SetVar('displayed_buttons', ['buttonGeneralBack', 'buttonGeneralNext']);

        $this->AddHiddenFields();

        $nm_template->Display('body_actionbar_ini');
        $nm_template->Display('body_actionbar_general');
        $nm_template->Display('body_actionbar_end');
    } // DisplayStep_ButtonGeneral

    /**
     * Exibe formulario de visual de botao.
     */
    function DisplayStep_ButtonVisual()
    {
        global $nm_template;

        $nm_template->SetVar('form_step', $_SESSION['nm_session']['actionbar_button']['form_step']);
        $nm_template->SetVar('button_type', $_SESSION['nm_session']['actionbar_button']['type']);
        $nm_template->SetVar('button_display', $_SESSION['nm_session']['actionbar_button']['display']);
        $nm_template->SetVar('button_states', $_SESSION['nm_session']['actionbar_button']['states']);
        $nm_template->SetVar('state_labels_with_error', $_SESSION['nm_session']['actionbar_button']['state_labels_with_error']);

        if ('create' == $_SESSION['nm_session']['actionbar_button']['form_step']) {
            if ('link' == $_SESSION['nm_session']['actionbar_button']['type']) {
                $nm_template->SetVar('displayed_buttons', ['buttonVisualBackNext', 'buttonVisualNextLink']);
            } else {
                $nm_template->SetVar('displayed_buttons', ['buttonVisualBackNext', 'buttonVisualNextAjax']);
            }
        } else {
            $nm_template->SetVar('displayed_buttons', ['buttonVisualBackEdit', 'buttonVisualSave']);
            $nm_template->SetVar('modified_function', 'nm_form_modified();');
            $nm_template->SetVar('save_function', 'scActionBarClick_buttonVisualSave');
        }

        $this->AddHiddenFields();

        $nm_template->Display('body_app_select_image');
        $nm_template->Display('body_actionbar_ini');
        $nm_template->Display('body_actionbar_visual');
        $nm_template->Display('body_actionbar_end');
    } // DisplayStep_ButtonVisual

    /**
     * Exibe formulario de visual de botao.
     */
    function DisplayStep_BarVisual()
    {
        global $nm_template;

        $nm_template->SetVar('bar_visual', $_SESSION['nm_session']['actionbar_button']['bar_visual']);

        $nm_template->SetVar('displayed_buttons', ['buttonBarVisualBack', 'buttonBarVisualSave']);
        $nm_template->SetVar('modified_function', 'nm_form_modified();');
        $nm_template->SetVar('save_function', 'scActionBarClick_buttonBarVisualSave');

        $this->AddHiddenFields();

        $nm_template->Display('body_actionbar_ini');
        $nm_template->Display('body_actionbar_visual_bar');
        $nm_template->Display('body_actionbar_end');
    } // DisplayStep_BarVisual

    function DisplayVersionWarning()
    {
        global $nm_config, $nm_template;

        if (!$nm_config['flag_versao']['actiobar_grid']['has']) {
            $nm_template->Display('body_actionbar_no_permission');
        }
    } // DisplayVersionWarning

    /**
     * Adiciona campos escondidos no form.
     */
    function AddHiddenFields()
    {
        global $nm_config, $nm_template;

        if (!empty($this->errors)) {
            $modified = 'Y';
        } else {
            $modified = 'N';
        }

        $this->AddHidden('form_edit', $nm_config['form_valid']);
        $this->AddHidden('form_modified', $modified);
        $this->AddHidden('form_option', '');
        $this->AddHidden('field_fld_section', '');
        $this->AddHidden('field_xml_fld_tag_redir', '');
        $this->AddHidden('field_xml_fld_campo_redir', '');
        $this->AddHidden('redirect_to', '');
        $this->AddHidden('redirect_param', '');
        $this->AddHidden('redirect_sec_id', '');
        $this->AddHidden('str_abanumber', $_SESSION['nm_session']['control_abas']['frm_atual']);

        $nm_template->SetVar('form_hidden', $this->GetHidden());
    } // AddHiddenFields

    /**
     * Adiciona um campo escondido com determinado valor ao formulario.
     */
    function AddHidden($field, $value) {
        $this->hidden[$field] = $value;
    } // AddHidden

    /**
     * Retorna lista de campos escondidos.
     */
    function GetHidden()
    {
        return $this->hidden;
    } // GetHidden

    /**
     * Define funcoes Javascript da pagina.
     */
    function PageJavascript()
    {
        global $nm_config;

        $buttonRemove = nm_get_text_lang("['actionbar_confirm_button_remove']");
        $onlyState = nm_get_text_lang("['actionbar_error_only_state']");
        $hasActionBar = $nm_config['flag_versao']['actiobar_grid']['has'] ? 'true' : 'false';

        $deleteLabel = nm_get_text_lang("['actionbar_option_delete']");

        $confirmMessage = conv_utf8_all(html_entity_decode(nm_get_text_lang("['edit_confirm']")));

        $jsCode = <<<EOT
var stateAddOnChangeFunction = function() {};

$(function() {
    if ({$hasActionBar}) {
        $("#sc-actionbar-item-list").sortable({
            change: function(event, ui) {
                nm_form_modified();
            }
        });
    }

    $("#sc-input-actionbar-display").on("change", function() {
        scActionBar_changeDisplay();
    });

    let buttonList = $(".sc-state-item"), i;
    for (i = 0; i < buttonList.length; i++) {
        scActionBarFA_addIconPicker($(buttonList[i]).find(".iconpicker-input"));
        scActionBarColor_addColorPicker($(buttonList[i]).find(".sc-fa-color"));
    }

    let barColorList = $(".sc-bar-color");
    for (i = 0; i < barColorList.length; i++) {
        scActionBarColor_addColorPicker($(barColorList[i]).find(".sc-fa-color"));
    }
});

function nm_form_modified()
{
    \$(document.form_edit.form_modified).val("Y");
}

function nm_form_unmodified()
{
    \$(document.form_edit.form_modified).val("N");
}

function nm_confirm_save()
{
    \$(document.form_edit.force_save).val("Y");
}

function is_form_modified()
{
    return "Y" == \$(document.form_edit.form_modified).val();
}

function checkModifiedButtonList()
{
    if (!is_form_modified()) {
        return false;
    } else {
        let confirmResponse = confirm("{$confirmMessage}");

        if (confirmResponse) {
            return true;
        } else {
            nm_form_unmodified();
            return false;
        }
    }

    return true;
}

function nm_edit_save(str_section, mix_param, str_fld_section, str_xml_fld_tag, str_xml_fld_campo, str_sec_id)
{
    document.form_edit.field_fld_section.value = str_fld_section;
    document.form_edit.redirect_sec_id.value = str_sec_id;
    document.form_edit.redirect_to.value = str_section;
    document.form_edit.redirect_param.value = mix_param;
    if (str_xml_fld_tag != null) document.form_edit.field_xml_fld_tag_redir.value = str_xml_fld_tag;
    if (str_xml_fld_campo != null) document.form_edit.field_xml_fld_campo_redir.value = str_xml_fld_campo;
    nm_send_form("save");
}

function nm_send_form(str_option)
{
    document.form_edit.form_option.value = str_option;
    document.form_edit.form_modified.value = "N";
    if ("function" == typeof actionbarSaveFunction) {
        actionbarSaveFunction();
    }
}

function scActionBarPost(step, option)
{
    \$("#sc-input-actionbar-step").val(step);
    \$("#sc-input-actionbar-option").val(option);
    document.form_edit.submit();
}

function scActionBar_changeDisplay()
{
    let buttonDisplay = $("#sc-input-actionbar-display").val();
    $(".sc-button-data").hide();
    $(".sc-button-data-" + buttonDisplay).show();
}

function scActionBarClick_buttonGeneralNew()
{
    if (checkModifiedButtonList()) {
        scActionBarGeneralPrepareSave();
    }
    scActionBarPost('button_general', 'new');
}

function scActionBarClick_buttonBarVisual()
{
    if (checkModifiedButtonList()) {
        scActionBarGeneralPrepareSave();
    }
    scActionBarPost('bar_visual', 'edit');
}

function scActionBarClick_buttonBarVisualBack()
{
    if (!is_form_modified()) {
        scActionBarPost('bar_visual', 'back');
    } else {
        let confirmResponse = confirm("{$confirmMessage}");

        if (confirmResponse) {
            scActionBarClick_buttonBarVisualSave();
        } else {
            nm_form_unmodified();
            scActionBarPost('bar_visual', 'back');
        }
    }
}

function scActionBarClick_buttonBarVisualSave()
{
    scActionBarPost('bar_visual', 'save');
}

function scActionBarClick_buttonGeneralBack()
{
    scActionBarPost('button_general', 'back');
}

function scActionBarClick_buttonGeneralNext()
{
    scActionBarPost('button_general', 'next');
}

function scActionBarClick_buttonVisualNextLink()
{
    scActionBarPost('button_visual', 'next_link');
}

function scActionBarClick_buttonVisualBackNext()
{
    scActionBarPost('button_visual', 'back_next');
}

function scActionBarClick_buttonVisualNextAjax()
{
    scActionBarPost('button_visual', 'next_ajax');
}

function scActionBarClick_buttonVisualEdit(button)
{
    \$("#sc-input-actionbar-button-name").val(button);
    scActionBarPost('button_visual', 'edit');
}

function scActionBarClick_buttonVisualBackEdit()
{
    if (!is_form_modified()) {
        scActionBarPost('button_visual', 'back_edit');
    } else {
        let confirmResponse = confirm("{$confirmMessage}");

        if (confirmResponse) {
            scActionBarClick_buttonVisualSave();
        } else {
            nm_form_unmodified();
            scActionBarPost('button_visual', 'back_edit');
        }
    }
}

function scActionBarClick_buttonVisualSave()
{
    scActionBarPost('button_visual', 'save');
}

function scActionBarClick_menuSaveList()
{
    scActionBarGeneralPrepareSave();
    scActionBarPost('list', 'save');
}

function scActionBarClick_scMenuOption(menuOption)
{
    \$("#sc-input-actionbar-scmenuoption").val(menuOption);
}

function scActionBarClick_remove(button)
{
    if (confirm("{$buttonRemove}: " + button + "?")) {
        \$("#sc-actionbar-item-list-" + button).remove();
        nm_form_modified();
    }
}

function scActionBarClick_linkEdit(button)
{
    \$("#sc-input-actionbar-button-name").val(button);
    scActionBarPost('link', 'edit');
}

function scActionBarClick_linkProperties(button)
{
    \$("#sc-input-actionbar-button-name").val(button);
    scActionBarPost('link', 'prop');
}

function scActionBarClick_ajaxEdit(button)
{
    \$("#sc-input-actionbar-button-name").val(button);
    scActionBarPost('ajax', 'edit');
}

function scActionBarClick_stateAdd()
{
    let html, lastStateId = parseInt($($(".sc-state-item").last()).attr("id").substr(14)) + 1;

    html = '<tr id="sc-state-item-' + lastStateId + '" class="sc-state-item">';

    html += '<td class="nmLineV3">';
    html += '<div class="ui input iconpicker-container">';
    html += '<input type="text" name="state_label[]" value="state' + (lastStateId + 1) + '" />';
    html += '</div>';
    html += '</td>';

    html += '<td class="nmLineV3 sc-button-data sc-button-data-fa">';
    html += '<div class="ui input iconpicker-container">';
    html += '<input class="form_edit_toolbar fa_field icp icp-auto iconpicker-element iconpicker-input" data-row-number="' + lastStateId + '" type="text" name="state_fa_icon[]" value="" />';
    html += '<span class="nmText fa_field" style="white-space: nowrap">';
    html += "<i class=\"sc-fa-icon-preview\" onclick=\"scActionBarFA_iconClick('" + lastStateId + "');\"></i>";
    html += '</span>';
    html += '</div>';
    html += '</td>';

    html += '<td class="nmLineV3 sc-button-data sc-button-data-fa">';
    html += '<div class="ui input">';
    html += '<input class="sc-fa-color" id="sc-state-color-' + lastStateId + '" data-row-number="' + lastStateId + '" type="text" name="state_fa_color[]" value="" />';
    html += '<span class="nmText fa_field" style="white-space: nowrap">';
    html += "<button class=\"sc-color-position\" style=\"background-color: \" onClick=\"scActionBarClick_colorPickerClick('#sc-state-color-" + lastStateId + "'); return false;\"></button>";
    html += '</span>';
    html += '</div>';
    html += '</td>';

    html += '<td class="nmLineV3 sc-button-data sc-button-data-fa">';
    html += '<div class="ui input">';
    html += '<input class="sc-fa-color" id="sc-state-hover-' + lastStateId + '" data-row-number="' + lastStateId + '" type="text" name="state_fa_hover[]" value="" />';
    html += '<span class="nmText fa_field" style="white-space: nowrap">';
    html += "<button class=\"sc-color-position\" style=\"background-color: \" onClick=\"scActionBarClick_colorPickerClick('#sc-state-hover-" + lastStateId + "'); return false;\"></button>";
    html += '</span>';
    html += '</div>';
    html += '</td>';

    html += '<td class="nmLineV3 sc-button-data sc-button-data-fa">';
    html += '<div class="ui input">';
    html += '<input class="sc-fa-color" id="sc-state-active-' + lastStateId + '" data-row-number="' + lastStateId + '" type="text" name="state_fa_active[]" value="" />';
    html += '<span class="nmText fa_field" style="white-space: nowrap">';
    html += "<button class=\"sc-color-position\" style=\"background-color: \" onClick=\"scActionBarClick_colorPickerClick('#sc-state-active-" + lastStateId + "'); return false;\"></button>";
    html += '</span>';
    html += '</div>';
    html += '</td>';

    html += '<td class="nmLineV3 sc-button-data sc-button-data-img">';
    html += '<div class="ui input">';
    html += '<input type="text" id="sc-state-img-' + lastStateId + '" name="state_img_icon[]" value="" />';
    html += '<span class="nmText fa_field" style="white-space: nowrap">';
    html += "<img src=\"{$nm_config['url_img']}background.png\" class=\"sc-icon-position sc-img-picker\" onClick=\"scActionBarImg_iconClick('" + lastStateId + "');\" />";
    html += '</span>';
    html += '</div>';
    html += '</td>';

    html += '<td class="nmLineV3 sc-button-data sc-button-data-text">';
    html += '<div class="ui input">';
    html += '<input type="text" name="state_txt_label[]" value="" />';
    html += '</div>';
    html += '</td>';

    html += '<td class="nmLineV3">';
    html += '<div class="ui input">';
    html += '<input type="text" name="state_hint[]" value="" />';
    html += '</div>';
    html += '</td>';

    html += '<td class="nmLineV3" style="text-align: center">';
    html += "<a href=\"javascript:scActionBarClick_stateRemove('" + lastStateId + "');\"><span class=\"topicMenu\">{$deleteLabel}</span></a>";
    html += '</td>';

    html += '</tr>';

    $("#sc-states").append(html);
    scActionBarFA_addIconPicker($("#sc-state-item-" + lastStateId).find(".iconpicker-input"));
    scActionBarColor_addColorPicker($("#sc-state-item-" + lastStateId).find(".sc-fa-color"));
    scActionBar_changeDisplay();
    stateAddOnChangeFunction();
}

function scActionBarClick_stateRemove(stateId)
{
    let stateList = $(".sc-state-item");

    if (1 == stateList.length) {
        alert("{$onlyState}");
        return;
    }

    $("#sc-state-item-" + stateId).remove();
    stateAddOnChangeFunction();
}

function scActionBarGeneralPrepareSave()
{
    let actionList = \$(".sc-actionbar-item"), actionNames = new Array(), i;

    for (i = 0; i < actionList.length; i++) {
        actionNames.push(\$(actionList[i]).data("actionName"));
    }

    \$("#sc-input-actionbar-order").val(actionNames.join("_#SC#_"));
}

function scActionBarFA_addIconPicker(jqueryObject)
{
    jqueryObject.iconpicker({
        hideOnSelect: true,
        collision: true
    }).on("iconpickerSelected", function() {
        scActionBarFA_updateIcon($(this).data("rowNumber"));
        jqueryObject.trigger("change");
    });
}

function scActionBarFA_updateIcon(buttonRow)
{
    let thisRow = $("#sc-state-item-" + buttonRow), iconVal, iconColor;
    iconVal = thisRow.find(".iconpicker-input").val();
    iconColor = thisRow.find(".sc-fa-color").val();
    thisRow.find(".sc-fa-icon-preview").attr("class", "sc-icon-position sc-fa-icon-preview " + iconVal).css({color: iconColor});
}

function scActionBarFA_iconClick(buttonRow)
{
    $("#sc-state-item-" + buttonRow).find(".iconpicker-input").focus();
}

function scActionBarColor_addColorPicker(jqueryObject)
{
    jqueryObject.ColorPicker({
        onBeforeShow: function () {
            jqueryObject.ColorPickerSetColor(jqueryObject.val());
        },
        onSubmit: function(hsb, hex, rgb, el) {
            $(el).val("#" + hex);
            $(el).ColorPickerHide();
            $(el).parent().find("button").css("backgroundColor", "#" + hex);
            scActionBarFA_updateIcon($(el).data("rowNumber"));
            $(el).trigger("change");
        }
    });
}

function scActionBarClick_colorPickerClick(selector)
{
    $(selector).focus();
    $(selector).ColorPickerShow();
}

function scActionBarImg_iconClick(buttonRow)
{
    nm_window_image_toolbar("sc-state-img-" + buttonRow, "");
}

function blockUiAppForImage(str_folder, str_form, str_field, str_val, str_cback, str_index, isChild)
{
    var module = '&module=app';
    $('#iframe_choose_image_{$_SESSION['nm_session']['control_abas']['frm_atual']}').attr('src', '{$nm_config['url_iface']}images_manager.php?fld=' + str_folder + '&form=' + str_form + '&field=' + str_field + '&image=' + str_val + '&fn_cback=' + str_cback + str_index + module + '&isChild=' + isChild);
    $.blockUI({
        message: $('#div_choose_image_{$_SESSION['nm_session']['control_abas']['frm_atual']}'),
        css: {
            width: '92%',
            width: '-webkit-calc(100% - 62px)',
            width: '-moz-calc(100% - 62px)',
            width: 'calc(100% - 62px)',
            height: '98%',
            height: '-webkit-calc(100% - 62px)',
            height: '-moz-calc(100% - 62px)',
            height: 'calc(100% - 62px)',
            left :'0px',
            top: '0px',
            margin: '30px'
        },
        baseZ:1060
    });
    $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI);
}

EOT;
        $this->AddJavascript($jsCode);
    } // PageJavascript

    /**
     * Define arquivos JS da pagina.
     */
    function PageJs()
    {
        $this->AddJs('devel', 'window.js');
        $this->AddJs('devel', 'ajax.js');
        $this->AddJs('devel', 'random.js');
        $this->AddJs('third', 'jquery_plugin/malsup-blockui/jquery.blockUI.js');
        $this->AddJs('third', 'semantic-ui/semantic.min.js');
		$this->AddJs('third', 'jquery_plugin/colorpicker/js/colorpicker.js');
        $this->AddJs('thirddevel', 'bootstrap_plugin/fontawesome-iconpicker-3.0.0/dist/js/fontawesome-iconpicker.min.js');
    } // PageJs

    /**
     * Define folhas de estilo da pagina.
     */
    function PageStyleCss()
    {
        $this->AddStyleCss('third', 'font-awesome/css/font-awesome.min.css');
        $this->AddStyleCssAfterScCss('third', 'semantic-ui/semantic.min.css');
        $this->AddStyleCssAfterScCss('third', 'font-awesome/css/all.css');
        $this->AddStyleCssAfterScCss('thirddevel', 'bootstrap_plugin/fontawesome-iconpicker-3.0.0/dist/css/fontawesome-iconpicker.min.css');
		$this->AddStyleCssAfterScCss('third', 'jquery_plugin/colorpicker/css/colorpicker.css');
    } // pagestyle

    /**
     * Prepara objetos usados pela pagina.
     */
    function PrepareObjects()
    {
        /* Carrega classes auxiliares */
        nm_load_class('interface', 'Application');
        nm_load_class('interface', 'Event');

        /* Instancia objetos */
        $this->app = new nmApplication();
        $this->evt = new nmEvent();

        /* Carrega aplicacao */
        $this->app->SetApplication(
            $_SESSION['nm_session']['user']['cod_grp'],
            $_SESSION['nm_session']['app']['cod'],
            $_SESSION['nm_session']['user']['cod_ver']
        );

        /* Carreda dados da aplicacao */
        $this->app->SetCodField('Cod_Apl');
        $this->app->SetFields(
            [
                'actionbar' => [
                    'actionbar_grid',
                    'actionbar_grid_order'
                ]
            ]
        );
        $this->app->RetrieveData();

        /* Carrega evento */
        $this->evt->SetApplication(
            $_SESSION['nm_session']['user']['cod_grp'],
            $_SESSION['nm_session']['app']['cod'],
            $_SESSION['nm_session']['user']['cod_ver']
        );
        $this->evt->SetData("Tipo", "A");

        $_SESSION['nm_session']['actionbar_button']['state_labels_with_error'] = [];
    } // PrepareObjects

    /**
     * Cria evento ajax ligado a um botao da actionbar.
     */
    function CreateAjaxEvent($buttonName)
    {
        $this->evt->SetData("Parms", '');
        $this->evt->SetData("Nome", 'actbtn_' . $buttonName . '_onClick');

        $this->evt->SaveData();
    } // CreateAjaxEvent

    /**
     * Processa o passo do form enviado.
     */
    function ProcessStep()
    {
        switch ($this->step_process) {
            case 'list':
                if ('save' == $this->step_option) {
                    $this->ProcessStep_SaveGeneral();
                }
                break;
            case 'button_general':
                if ('new' == $this->step_option) {
                    if ($this->IsFormModified()) {
                        $this->ProcessStep_SaveGeneral();
                    } else {
                        $this->ProcessStep_ButtonGeneralNew();
                    }
                } elseif ('back' == $this->step_option) {
                    $this->ProcessStep_ButtonGeneralBack();
                } elseif ('next' == $this->step_option) {
                    $this->ProcessStep_ButtonGeneralNext();
                }
                break;
            case 'button_visual':
                if ('back_next' == $this->step_option) {
                    $this->ProcessStep_ButtonVisualBackNext();
                } elseif ('next_link' == $this->step_option) {
                    $this->ProcessStep_ButtonVisualNext('link');
                } elseif ('next_ajax' == $this->step_option) {
                    $this->ProcessStep_ButtonVisualNext('ajax');
                } elseif ('edit' == $this->step_option) {
                    $this->ProcessStep_ButtonVisualEdit();
                } elseif ('back_edit' == $this->step_option) {
                    $this->ProcessStep_ButtonVisualBackEdit();
                } elseif ('save' == $this->step_option) {
                    $this->ProcessStep_ButtonVisualSave();
                }
                break;
            case 'link':
                if ('edit' == $this->step_option) {
                    $this->ProcessStep_LinkEdit();
                } elseif ('prop' == $this->step_option) {
                    $this->ProcessStep_LinkProperties();
                }
                break;
            case 'ajax':
                if ('edit' == $this->step_option) {
                    $this->ProcessStep_AjaxEdit();
                }
                break;
            case 'bar_visual':
                if ('edit' == $this->step_option) {
                    if ($this->IsFormModified()) {
                        $this->ProcessStep_SaveGeneral();
                    } else {
                        $this->ProcessStep_BarVisualEdit();
                    }
                } elseif ('back' == $this->step_option) {
                    $this->ProcessStep_BarVisualBack();
                } elseif ('save' == $this->step_option) {
                    $this->ProcessStep_BarVisualSave();
                }
                break;
        }
    } // ProcessStep

    /**
     * Prepara formulario geral de novo botao para exibicao de um novo botao.
     */
    function ProcessStep_ButtonGeneralNew()
    {
        $_SESSION['nm_session']['actionbar_button'] = [
            'label' => '',
            'type' => 'link',
            'in_use' => 'S',
            'display' => 'fa',
            'states' => [
                0 => [
                    'label' => 'state1',
                    'fa_icon' => '',
                    'fa_color' => '',
                    'fa_hover' => '',
                    'fa_active' => '',
                    'img_icon' => '',
                    'txt_label' => '',
                    'hint' => ''
                ]
            ]
        ];

        $this->step_display = 'button_general';
    } // ProcessStep_ButtonGeneralNew

    /**
     * Realiza volta da criacao de um botao.
     */
    function ProcessStep_ButtonGeneralBack()
    {
        $this->step_display = 'list';
    } // ProcessStep_ButtonGeneralBack

    /**
     * Processa dados gerais do formulario de botao da actionbar.
     */
    function ProcessStep_ButtonGeneralNext()
    {
        $this->FormValidate_buttonLabel();
        $this->FormValidate_buttonType();

        if (empty($this->errors)) {
            $_SESSION['nm_session']['actionbar_button']['form_step'] = 'create';

            $this->step_display = 'button_visual';
        } else {
            $this->step_display = 'button_general';
        }
    } // ProcessStep_ButtonGeneralNext

    /**
     * Processa volta da configuracao de visual em processo de criacao de botao.
     */
    function ProcessStep_ButtonVisualBackNext()
    {
        $this->step_display = 'button_general';
    } // ProcessStep_ButtonVisualBackNext

    /**
     * Processa os dados de visualizacao do botao na criacao.
     */
    function ProcessStep_ButtonVisualNext($buttonType)
    {
        $this->FormValidate_buttonDisplay();
        $this->FormValidate_buttonStates();

        $actionOrder = $this->app->GetData('actionbar_grid_order');
        $actionInfo = $this->app->GetData('actionbar_grid');

        $actionOrder[] = $_SESSION['nm_session']['actionbar_button']['label'];
        $actionInfo[ $_SESSION['nm_session']['actionbar_button']['label'] ] = [
            'type' => $_SESSION['nm_session']['actionbar_button']['type'],
            'display' => $_SESSION['nm_session']['actionbar_button']['display'],
            'in_use' => 'S',
            'states' => $_SESSION['nm_session']['actionbar_button']['states'],
        ];

        $this->app->SetData('actionbar_grid', $actionInfo);
        $this->app->SetData('actionbar_grid_order', $actionOrder);

        if (empty($this->errors)) {
            $this->save_app = true;

            if ('link' == $buttonType) {
                $this->redirect_to = 'link_create';
            } elseif ('ajax' == $buttonType) {
                $this->CreateAjaxEvent($_SESSION['nm_session']['actionbar_button']['label']);
                $this->EventListUpdate();
                $this->redirect_to = 'ajax_edit';
            }

            $this->redirect_param = [
                'button_name' => $_SESSION['nm_session']['actionbar_button']['label']
            ];
        } else {
            $this->step_display = 'button_visual';
        }
    } // ProcessStep_ButtonVisualNext

    /**
     * Exibe o formulario de edicao de visual de botao.
     */
    function ProcessStep_ButtonVisualEdit()
    {
        $actionInfo = $this->app->GetData('actionbar_grid');
        $buttonName = $this->GetArg('button_name');

        $_SESSION['nm_session']['actionbar_button']['label'] = $buttonName;
        $_SESSION['nm_session']['actionbar_button']['type'] = $actionInfo[$buttonName]['type'];
        $_SESSION['nm_session']['actionbar_button']['display'] = $actionInfo[$buttonName]['display'];
        $_SESSION['nm_session']['actionbar_button']['states'] = $actionInfo[$buttonName]['states'];

        $_SESSION['nm_session']['actionbar_button']['form_step'] = 'edit';

        $this->step_display = 'button_visual';
    } // ProcessStep_ButtonVisualEdit

    /**
     * Processa volta da edicao de visual do botao.
     */
    function ProcessStep_ButtonVisualBackEdit()
    {
        $this->step_display = 'list';
    } // ProcessStep_ButtonVisualBackEdit

    /**
     * Processa os dados de visualizacao do botao na edicao.
     */
    function ProcessStep_ButtonVisualSave()
    {
        $this->FormValidate_buttonDisplay();
        $this->FormValidate_buttonStates();

        $actionInfo = $this->app->GetData('actionbar_grid');

        $actionInfo[ $_SESSION['nm_session']['actionbar_button']['label'] ]['display'] = $_SESSION['nm_session']['actionbar_button']['display'];
        $actionInfo[ $_SESSION['nm_session']['actionbar_button']['label'] ]['states'] = $_SESSION['nm_session']['actionbar_button']['states'];

        $this->app->SetData('actionbar_grid', $actionInfo);

        if (empty($this->errors)) {
            $this->save_app = true;

            $this->step_display = 'list';
        } else {
            $this->step_display = 'button_visual';
        }
    } // ProcessStep_ButtonVisualSave

    /**
     * Prepara edicao de link do botao.
     */
    function ProcessStep_LinkEdit()
    {
        $this->redirect_to = 'link_edit';
        $this->redirect_param = [
            'button_name' => $this->GetArg('button_name')
        ];
    } // ProcessStep_LinkEdit

    /**
     * Prepara edicao das propriedades do link do botao.
     */
    function ProcessStep_LinkProperties()
    {
        $this->redirect_to = 'link_properties';
        $this->redirect_param = [
            'button_name' => $this->GetArg('button_name')
        ];
    } // ProcessStep_LinkProperties

    /**
     * Prepara edicao do conteudo ajax do botao.
     */
    function ProcessStep_AjaxEdit()
    {
        $this->redirect_to = 'ajax_edit';
        $this->redirect_param = [
            'button_name' => $this->GetArg('button_name')
        ];
    } // ProcessStep_AjaxEdit

    /**
     * Prepara edicao do visual da barra.
     */
    function ProcessStep_BarVisualEdit()
    {
        $_SESSION['nm_session']['actionbar_button']['bar_visual'] = $this->app->GetData('actionbar_grid_visual');

        $this->step_display = 'bar_visual';
    } // ProcessStep_BarVisualEdit

    /**
     * Processa volta da configuracao de visual da actionbar.
     */
    function ProcessStep_BarVisualBack()
    {
        $this->step_display = 'list';
    } // ProcessStep_BarVisualBack

    /**
     * Salva as informacoes do visual da barra.
     */
    function ProcessStep_BarVisualSave()
    {
        $this->FormValidate_barVisualPadding();
        $this->FormValidate_barVisualFaSize();
        $this->FormValidate_barVisualFaColor();
        $this->FormValidate_barVisualFaHover();
        $this->FormValidate_barVisualFaActive();
        $this->FormValidate_barVisualLinkColor();
        $this->FormValidate_barVisualLinkHoverColor();
        $this->FormValidate_barVisualLinkActiveColor();
        $this->FormValidate_barVisualValign();
        $this->FormValidate_barVisualOverwrite();

        $this->save_app = true;

        $this->step_display = 'list';
    } // ProcessStep_BarVisualSave

    /**
     * Salva as informacoes gerais da actionbar.
     */
    function ProcessStep_SaveGeneral()
    {
        $this->FormValidate_order();
        $this->FormValidate_inUse();

        $this->RemoveButtonAjax();
        $this->RemoveButtonLink();

        $this->save_app = true;

        if ('button_general' == $this->step_process && 'new' == $this->step_option) {
            $this->ProcessStep_ButtonGeneralNew();
        } elseif ('bar_visual' == $this->step_process && 'edit' == $this->step_option) {
            $this->ProcessStep_BarVisualEdit();
        } else {
            $this->step_display = 'list';
        }
    } // ProcessStep_SaveGeneral

    /**
     * Valida o label de um botao.
     */
    function FormValidate_buttonLabel()
    {
        $buttonLabel = $this->GetArg('button_label');
        $errorIndex = nm_get_text_lang("['actionbar_label']");

        if ('' == $buttonLabel) {
            $this->errors[$errorIndex] = nm_get_text_lang("['actionbar_error_label_empty']");
        } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $buttonLabel)) {
            $this->errors[$errorIndex] = nm_get_text_lang("['actionbar_error_label_chars']");
        } elseif (in_array($buttonLabel, $this->app->GetData('actionbar_grid_order'))) {
            $this->errors[$errorIndex] = nm_get_text_lang("['actionbar_error_label_exists']");
        }

        $_SESSION['nm_session']['actionbar_button']['label'] = $buttonLabel;
    } // FormValidate_buttonLabel

    /**
     * Valida o tipo de um botao.
     */
    function FormValidate_buttonType()
    {
        $buttonType = $this->GetArg('button_type');

        $_SESSION['nm_session']['actionbar_button']['type'] = $buttonType;
    } // FormValidate_buttonType

    /**
     * Valida o tipo de display de um botao.
     */
    function FormValidate_buttonDisplay()
    {
        $buttonDisplay = $this->GetArg('button_display');

        $_SESSION['nm_session']['actionbar_button']['display'] = $buttonDisplay;
    } // FormValidate_buttonDisplay

    /**
     * Valida o tipo de display de um botao.
     */
    function FormValidate_buttonStates()
    {
        $buttonDisplay = $this->GetArg('button_display');

        $stateLabels = $this->GetArg('state_label');
        $stateFaIcon = $this->GetArg('state_fa_icon');
        $stateFaColor = $this->GetArg('state_fa_color');
        $stateFaHover = $this->GetArg('state_fa_hover');
        $stateFaActive = $this->GetArg('state_fa_active');
        $stateImgIcon = $this->GetArg('state_img_icon');
        $stateTxtLabel = $this->GetArg('state_txt_label');
        $stateHint = $this->GetArg('state_hint');

        $hasEmptyStateLabel = false;
        $hasInvalidStateLabel = false;
        $hasUsedStateLabel = false;
        $hasEmptyFaIcon = false;
        $hasEmptyImg = false;
        $hasEmptyTxt = false;

        $stateLabelsWithError = [];
        $stateLabelsUsed = [];

        $stateList = [];
        foreach ($stateLabels as $i => $stateLabelText) {
            $stateList[] = [
                'label' => $stateLabelText,
                'fa_icon' => $stateFaIcon[$i],
                'fa_color' => $stateFaColor[$i],
                'fa_hover' => $stateFaHover[$i],
                'fa_active' => $stateFaActive[$i],
                'img_icon' => $stateImgIcon[$i],
                'txt_label' => $stateTxtLabel[$i],
                'hint' => $stateHint[$i],
            ];

            if ('' == $stateLabelText) {
                $hasEmptyStateLabel = true;
                $stateLabelsWithError[] = $i;
            } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $stateLabelText)) {
                $hasInvalidStateLabel = true;
                $stateLabelsWithError[] = $i;
            } elseif (in_array($stateLabelText, $stateLabelsUsed)) {
                $hasUsedStateLabel = true;
                $stateLabelsWithError[] = $i;
            } elseif ('fa' == $buttonDisplay && '' == $stateFaIcon[$i]) {
                $hasEmptyFaIcon = true;
            } elseif ('img' == $buttonDisplay && '' == $stateImgIcon[$i]) {
                $hasEmptyImg = true;
            } elseif ('text' == $buttonDisplay && '' == $stateTxtLabel[$i]) {
                $hasEmptyTxt = true;
            }

            $stateLabelsUsed[] = $stateLabelText;
        }

        $errorIndex = nm_get_text_lang("['actionbar_state']");
        if ($hasEmptyStateLabel) {
            $this->errors[$errorIndex] = nm_get_text_lang("['actionbar_error_state_label_empty']");
        } elseif ($hasInvalidStateLabel) {
            $this->errors[$errorIndex] = nm_get_text_lang("['actionbar_error_state_label_chars']");
        } elseif ($hasUsedStateLabel) {
            $this->errors[$errorIndex] = nm_get_text_lang("['actionbar_error_state_label_exists']");
        } elseif ($hasEmptyFaIcon) {
            $this->errors[$errorIndex] = nm_get_text_lang("['actionbar_error_state_fa_empty']");
        } elseif ($hasEmptyImg) {
            $this->errors[$errorIndex] = nm_get_text_lang("['actionbar_error_state_img_empty']");
        } elseif ($hasEmptyTxt) {
            $this->errors[$errorIndex] = nm_get_text_lang("['actionbar_error_state_txt_empty']");
        }

        $_SESSION['nm_session']['actionbar_button']['states'] = $stateList;
        $_SESSION['nm_session']['actionbar_button']['state_labels_with_error'] = $stateLabelsWithError;
    } // FormValidate_buttonStates

    /**
     * Valida a ordem dos botoes.
     */
    function FormValidate_order()
    {
        $actionOrder = explode('_#SC#_', $this->GetArg('actionbar_order'));

        $actionInfo = $this->app->GetData('actionbar_grid');
        foreach ($actionInfo as $buttonName => $buttonInfo) {
            if (!in_array($buttonName, $actionOrder)) {
                unset($actionInfo[$buttonName]);
                if ('link' == $buttonInfo['type']) {
                    $this->remove_link[] = $buttonName;
                }
                if ('ajax' == $buttonInfo['type']) {
                    $this->remove_ajax[] = $buttonName;
                }
            }
        }

        $this->app->SetData('actionbar_grid_order', $actionOrder);
        $this->app->SetData('actionbar_grid', $actionInfo);
    } // FormValidate_order

    /**
     * Valida a flag de em uso dos botoes.
     */
    function FormValidate_inUse()
    {
        $actionInUse = $this->GetArg('actionbar_in_use');

        $actionInfo = $this->app->GetData('actionbar_grid');
        foreach ($actionInfo as $buttonName => $buttonInfo) {
            if (isset($actionInUse[$buttonName]) && 'S' == $actionInUse[$buttonName]) {
                $actionInfo[$buttonName]['in_use'] = 'S';
            } else {
                $actionInfo[$buttonName]['in_use'] = 'N';
            }
        }

        $this->app->SetData('actionbar_grid', $actionInfo);
    } // FormValidate_inUse

    /**
     * Valida o padding do visual da actionbar.
     */
    function FormValidate_barVisualPadding()
    {
        $padding = $this->GetArg('padding');

        $actionVisual = $this->app->GetData('actionbar_grid_visual');
        $actionVisual['padding'] = $padding;

        $this->app->SetData('actionbar_grid_visual', $actionVisual);

        $_SESSION['nm_session']['actionbar_button']['bar_visual']['padding'] = $padding;
    } // FormValidate_barVisualPadding

    /**
     * Valida o tamanho do icone Font Awesome do visual da actionbar.
     */
    function FormValidate_barVisualFaSize()
    {
        $fa_size = $this->GetArg('fa_size');

        $actionVisual = $this->app->GetData('actionbar_grid_visual');
        $actionVisual['fa_size'] = $fa_size;

        $this->app->SetData('actionbar_grid_visual', $actionVisual);

        $_SESSION['nm_session']['actionbar_button']['bar_visual']['fa_size'] = $fa_size;
    } // FormValidate_barVisualFaSize

    /**
     * Valida a cor do icone Font Awesome do visual da actionbar.
     */
    function FormValidate_barVisualFaColor()
    {
        $fa_color = $this->GetArg('fa_color');

        $actionVisual = $this->app->GetData('actionbar_grid_visual');
        $actionVisual['fa_color'] = $fa_color;

        $this->app->SetData('actionbar_grid_visual', $actionVisual);

        $_SESSION['nm_session']['actionbar_button']['bar_visual']['fa_color'] = $fa_color;
    } // FormValidate_barVisualFaColor

    /**
     * Valida a cor do hover icone Font Awesome do visual da actionbar.
     */
    function FormValidate_barVisualFaHover()
    {
        $fa_hover = $this->GetArg('fa_hover');

        $actionVisual = $this->app->GetData('actionbar_grid_visual');
        $actionVisual['fa_hover'] = $fa_hover;

        $this->app->SetData('actionbar_grid_visual', $actionVisual);

        $_SESSION['nm_session']['actionbar_button']['bar_visual']['fa_hover'] = $fa_hover;
    } // FormValidate_barVisualFaHover

    /**
     * Valida a cor do active do icone Font Awesome do visual da actionbar.
     */
    function FormValidate_barVisualFaActive()
    {
        $fa_active = $this->GetArg('fa_active');

        $actionVisual = $this->app->GetData('actionbar_grid_visual');
        $actionVisual['fa_active'] = $fa_active;

        $this->app->SetData('actionbar_grid_visual', $actionVisual);

        $_SESSION['nm_session']['actionbar_button']['bar_visual']['fa_active'] = $fa_active;
    } // FormValidate_barVisualFaColor

    /**
     * Valida a cor do link de texto da actionbar.
     */
    function FormValidate_barVisualLinkColor()
    {
        $link_color = $this->GetArg('link_color');

        $actionVisual = $this->app->GetData('actionbar_grid_visual');
        $actionVisual['link_color'] = $link_color;

        $this->app->SetData('actionbar_grid_visual', $actionVisual);

        $_SESSION['nm_session']['actionbar_button']['bar_visual']['link_color'] = $link_color;
    } // FormValidate_barVisualLinkColor

    /**
     * Valida a cor do link:hover de texto da actionbar.
     */
    function FormValidate_barVisualLinkHoverColor()
    {
        $link_hover = $this->GetArg('link_hover');

        $actionVisual = $this->app->GetData('actionbar_grid_visual');
        $actionVisual['link_hover'] = $link_hover;

        $this->app->SetData('actionbar_grid_visual', $actionVisual);

        $_SESSION['nm_session']['actionbar_button']['bar_visual']['link_hover'] = $link_hover;
    } // FormValidate_barVisualLinkHoverColor

    /**
     * Valida a cor do link:active de texto da actionbar.
     */
    function FormValidate_barVisualLinkActiveColor()
    {
        $link_active = $this->GetArg('link_active');

        $actionVisual = $this->app->GetData('actionbar_grid_visual');
        $actionVisual['link_active'] = $link_active;

        $this->app->SetData('actionbar_grid_visual', $actionVisual);

        $_SESSION['nm_session']['actionbar_button']['bar_visual']['link_active'] = $link_active;
    } // FormValidate_barVisualLinkActiveColor

    /**
     * Valida o padding do visual da actionbar.
     */
    function FormValidate_barVisualValign()
    {
        $valign = $this->GetArg('valign');

        $actionVisual = $this->app->GetData('actionbar_grid_visual');
        if (isset($valign) && in_array($valign, array('top', 'middle', 'bottom'))) {
            $actionVisual['valign'] = $valign;
        } else {
            $actionVisual['valign'] = 'top';
        }

        $this->app->SetData('actionbar_grid_visual', $actionVisual);

        $_SESSION['nm_session']['actionbar_button']['bar_visual']['valign'] = $valign;
    } // FormValidate_barVisualValign

    /**
     * Valida o padding do visual da actionbar.
     */
    function FormValidate_barVisualOverwrite()
    {
        $overwrite_sc_buttons = $this->GetArg('overwrite_sc_buttons');

        $actionVisual = $this->app->GetData('actionbar_grid_visual');
        if (isset($overwrite_sc_buttons) && 'S' == $overwrite_sc_buttons) {
            $actionVisual['overwrite_sc_buttons'] = 'S';
        } else {
            $actionVisual['overwrite_sc_buttons'] = 'N';
        }

        $this->app->SetData('actionbar_grid_visual', $actionVisual);

        $_SESSION['nm_session']['actionbar_button']['bar_visual']['overwrite_sc_buttons'] = $overwrite_sc_buttons;
    } // FormValidate_barVisualOverwrite

    /**
     * Redireciona formulario.
     */
    function RedirectActionBar()
    {
        global $nm_template;

        switch ($this->redirect_to) {
            case 'ajax_edit':
                $nm_template->SetVar('event_name', 'actbtn_' . $this->redirect_param['button_name'] . '_onClick');
                $nm_template->Display('body_actionbar_redirect_ajax_edit');
                return true;

            case 'link_create':
                $nm_template->SetVar('button_name', $this->redirect_param['button_name']);
                $nm_template->Display('body_actionbar_redirect_link_new');
                return true;

            case 'link_edit':
                $nm_template->SetVar('button_name', $this->redirect_param['button_name']);
                $nm_template->SetVar('link_option', 'edit');
                $nm_template->Display('body_actionbar_redirect_link_edit');
                return true;

            case 'link_properties':
                $nm_template->SetVar('button_name', $this->redirect_param['button_name']);
                $nm_template->SetVar('link_option', 'prop');
                $nm_template->Display('body_actionbar_redirect_link_edit');
                return true;
        }

        return false;
    } // RedirectActionBar

    /**
     * Verifica se o codigo da aplicacao vai ser gerado.
     */
    function GenerateApp()
    {
        global $nm_template, $nm_config;

        if ('generate' == $this->GetArg('sc_menu_option')) {
            $_SESSION['nm_session']['compile_apps_ajax'] = protectAjaxChar($_SESSION['nm_session']['app']['cod']) . '#@#' . $_SESSION['nm_session']['app']['type'] . '#@#' . protectAjaxChar($_SESSION['nm_session']['app']['friendly_name']);
            $nm_template->Display('body_generate_app');
        } elseif ('run' == $this->GetArg('sc_menu_option') || 'build' == $this->GetArg('sc_menu_option')) {
            $nm_template->SetVar('cod_app', $_SESSION['nm_session']['app']['cod']);
            $nm_template->SetVar('friendly_name', $_SESSION['nm_session']['app']['friendly_name']);
            $nm_template->SetVar('type', $_SESSION['nm_session']['app']['type']);
            $nm_template->SetVar('target', 'nmWinGenExecV7_' . $nm_config['win_name']);
            $nm_template->Display('body_generate_code');
        }
    } // GenerateApp

    /**
     * Atualiza status da aplicacao no menu principal do Scriptcase.
     */
    function MenuStatus()
    {
        global $nm_template;

        /* Status do menu */
        $nm_template->SetVar('toolbar_object', 'parent.parent');
        $nm_template->SetVar('toolbar_grpcod', $_SESSION['nm_session']['user']['cod_grp']);
        $nm_template->SetVar('toolbar_appcod', $_SESSION['nm_session']['app']['cod']);
        $nm_template->SetVar('toolbar_appfriendly_name', $_SESSION['nm_session']['app']['friendly_name']);
        $nm_template->SetVar('toolbar_apptyp', $_SESSION['nm_session']['app']['type']);
        $nm_template->SetVar('toolbar_codver', $_SESSION['nm_session']['user']['cod_ver']);
        $nm_template->SetVar('toolbar_desver', $_SESSION['nm_session']['user']['des_ver']);
        $nm_template->SetVar('toolbar_appseq', '');
        $nm_template->SetVar('toolbar_other', '');
        $nm_template->SetVar('toolbar_atz_fld', 'app');

        $nm_template->Display('body_toolbar_data');
    } // MenuStatus

    /**
     * Atualiza lista de eventos ajax no menu lateral.
     */
    function EventListUpdate()
    {
        global $nm_config;

        $eventList = $this->evt->RetrieveList('A');
        $menuLevel = 'events_tit_ajax';

        nm_menu_remove_all_childs($menuLevel, 'new_events_tit_ajax');

        foreach ($eventList as $eventId => $eventData) {
            $null = (trim($eventData['codigo']) <> '') ? '' : '_null';

            if ('actbtn_' == substr($eventData['nome'], 0, 7)) {
                $title = $eventData['nome'];
            } else {
                $title = $eventData['nome'] . "&nbsp;<a class='extra_button' title='" . nm_get_text_lang("['button_delete']") . "' href=\"javascript:nm_ajax_get_delete_event_menu('events_ajax_" . $eventId . "', '" . $eventData['nome'] . "', 'A', 'events_ajax')\"><img src=" . $nm_config['url_img'] . "menu_tree_fld_trash_default.png border='0'/></a>";
            }

            $href = "javascript: nm_event_edit('A', '" . $eventData['nome'] . "', '" . $eventData['nome'] . "') ";
            $img = "menu_tree_event" . $null . ".png";

            nm_add_item_treemenu('events_ajax_' . $eventId, $menuLevel, $title, $href, $img, true, 'penult', false);
        }
    } // EventListUpdate

    /**
     * Remove eventos ajax ligados a botoes da actionbar.
     */
    function RemoveButtonAjax()
    {
        if (empty($this->remove_ajax)) {
            return;
        }

        foreach ($this->remove_ajax as $buttonName) {
            $this->evt->Remove('actbtn_' . $buttonName . '_onClick');
            $this->app->RemoveFromVars('actbtn_' . $buttonName . '_onClick');
        }

        $this->EventListUpdate();
    } // RemoveButtonAjax

    /**
     * Remove links ligados a botoes da actionbar.
     */
    function RemoveButtonLink()
    {
        if (empty($this->remove_link)) {
            return;
        }

        $linkList = $this->app->GetData('ligacoes');
        $linksChanged = false;

        foreach ($linkList as $i => $linkData) {
            if ('T' == $linkData['liga_tipo']) {
                $buttonName = substr($linkData['liga_id'], 7);
                if (in_array($buttonName, $this->remove_link)) {
                    unset($linkList[$i]);
                    $linksChanged = true;
                }
            }
        }

        if ($linksChanged) {
            sort($linkList);
            $this->app->SetData('ligacoes', $linkList);
        }
    } // RemoveButtonLink

    /**
     * Executa rotinas ajax.
     */
    function RunAjax()
    {
        if (isset($_GET['ajax']) && $_GET['ajax'] == 'nm') {
            if (isset($_GET['ajax_NOMEDAFUNCAO'])) {
                $this->RunAjax_NOMEDAFUNCAO();
            }

            exit;
        }
    } // RunAjax

    /**
     * Define o passo de processamento.
     */
    function SetProcessStep()
    {
        $this->step_process = $this->GetArg('step');
        $this->step_option = $this->GetArg('option');
    } // SetProcessStep

    /**
     * Atualiza as informacoes da actionbar.
     */
    function UpdateActionBar()
    {
        if (!empty($this->errors)) {
            $this->DisplayErrors();
        } else {
            $this->CheckAppData();
            if ($this->save_app) {
                $this->app->SaveData('save');
            }

            $this->CheckRedirect();
        }
    } // UpdateActionBar

    /**
     * Valida o formulario.
     */
    function ValidateForm()
    {
        if (!$this->FormSent('actionbar')) {
            $this->step_display = 'list';
            return;
        }

        $this->SetProcessStep();
        $this->ProcessStep();
        $this->UpdateActionBar();
    } // ValidateForm

    /**
     * Verifica se o formulario foi modificado.
     */
    function IsFormModified()
    {
        return 'Y' == $this->GetArg('form_modified');
    } // IsFormModified

    /**
     * Verifica dados basicos de integridade das informacoes da actionbar antes de salvar.
     */
    function CheckAppData()
    {
        $actionBarInfo = $this->app->GetData('actionbar_grid');
        $actionBarOrder = $this->app->GetData('actionbar_grid_order');

        if (count($actionBarInfo) != count($actionBarOrder)) {
            $this->save_app = false;
        } elseif (count($actionBarInfo) < 2) {
            $this->save_app = false;
        } else {
            $sameIndexes = true;
            $hasDetail = false;
            $hasAppEdit = false;
            foreach ($actionBarInfo as $buttonName => $buttonData) {
                if (!in_array($buttonName, $actionBarOrder)) {
                    $sameIndexes = false;
                }
                if ('__sc_detail' == $buttonName) {
                    $hasDetail = true;
                }
                if ('__sc_app_edit' == $buttonName) {
                    $hasAppEdit = true;
                }
            }
            if (!$sameIndexes || !$hasDetail || !$hasAppEdit) {
                $this->save_app = false;
            }
        }
    } // CheckAppData
}

?>
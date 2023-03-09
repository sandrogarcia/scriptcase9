<?php
/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}
?>
<style>
    [data-modal] {
        --spacing: .5rem;
    }

    [data-modal] [data-role="icon"] {
        margin-right: var(--spacing);
    }

    [data-modal] label[data-role="accessibility"] {
        text-indent: -99999px;
    }

    [data-modal] [data-scrolling] {
        max-height: var(--max-height);
        margin-bottom: calc(var(--spacing) * 2);
        overflow-y: auto;
    }

    [data-modal] .most-important {
        font-weight: bold;
        font-size: 14px;
    }

    [data-modal] .most-important > [data-modal="project-name"] {
        margin-top: calc(var(--spacing) * 1.25);
        color: #d40505;
        font-size: 1.25rem;
        display: block;
    }
    *{
        font-family: Lato,'Helvetica Neue',Arial,Helvetica,sans-serif;
    }
    .header span {
        font-size: 1.42857143rem;
        line-height: 1.28571429em;
        font-weight: 700;
    }
    #id_prj_de_title
    {
        font-size: 1.25rem;
        font-weight: 900;
    }
    .ui.compact.table th {
        padding-left: .7em;
        padding-right: .7em;
        font-size: 14px;
        font-weight: 700;
    }
    .ui.compact.table td {
        padding: .5em .7em;
        font-size: 14px;
    }
    #id_ver p{
        font-size: 14px;
    }
    .button
    {
        letter-spacing: 0px !important;
    }
    .sticky {
        position: sticky;
        top: 0;
        left: 0;
        z-index: 9999;
    }

    thead.sticky th {
        /*fix: comportamento inesperado que colapsa as
        border-top dos th's ao colidirem com as bordas dos td's
        quando o thead utiliza o position sticky;*/
        border-top: 1px solid rgba(34,36,38,.1);
    }
</style>
<div class="ui modal" id="id_prj_del" data-modal="">
    <i class="close icon"></i>
    <div class="header">
        <i class="fa fa-exclamation-triangle" data-role="icon"></i>
        <span><?php echo nm_get_text_lang("['delete_confirmation']", "ProjDel"); ?></span>
    </div>
    <div class="content">

        <p class="most-important">
            <?php echo nm_get_text_lang("['prj_del_confirm']", "ProjDel"); ?>
            <strong data-modal="project-name"><i class="fa fa-folder-open" data-role="icon"></i><span id="id_prj_de_title"></span></strong>
        </p>
        <div id="id_ver">
            <p><?php echo nm_get_text_lang("['prj_del_versions']", "ProjDel"); ?></p>

            <div data-scrolling style="--max-height: 200px;">
                <table class="ui compact celled table" data-table="project-versions">
                    <thead class="sticky">
                        <tr>
                            <th>
                                <div class='ui fitted checkbox'>
                                    <input id="check_all" type="checkbox" onclick="delPrjCheck()">
                                    <label></label>
                                </div>
                            </th>
                            <th><?php echo nm_get_text_lang("['prj_lbl_versao']", "ProjDel"); ?></th>
                            <th><?php echo nm_get_text_lang("['prj_lbl_desc']", "ProjDel"); ?></th>
                        </tr>
                    </thead>
                    <tbody id="id_ver_list">

                    </tbody>
                </table>
            </div>
        </div>

        <div class="ui bottom warning message">
            <i class="icon info"></i><?php echo nm_get_text_lang("['prj_del_backup']", "ProjDel"); ?>
        </div>
    </div>
    <div class="actions">
        <div class="ui gray basic button" tabindex="0" onclick="$('#id_prj_del').modal('hide');"><?php echo nm_get_text_lang("['button_cancel']", "ProjDel"); ?></div>
        <div class='ui button red ' tabindex="1" onclick="" id="id_btn_del"><i class="fa fa-trash-o" data-role="icon"></i><?php echo nm_get_text_lang("['button_delete_prj']", "ProjDel"); ?></div>
        <div class='ui button blue' tabindex="2" style="float:left;" id="id_btn_versions" onclick="$('#id_prj_del').modal('hide');nm_exec_menu('prj_version_history');"><?php echo nm_get_text_lang("['button_open_versions']", "ProjDel"); ?></div>
    </div>
</div>
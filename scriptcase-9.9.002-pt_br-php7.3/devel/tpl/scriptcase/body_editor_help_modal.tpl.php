<?php
/**
 * Template scriptcase.
 *
 * Modal de alerta para extensões não suportadas.
 *
 * @package     Template
 * @subpackage  Scriptcase
 * @creation    23/03/2018
 * @copyright   NetMake Solucoes em Informatica
 * @author      Henrique Barros <h.barros@scriptcase.net>
 *
 * $Id: body_unsupported_extension.tpl.php,v 1.4 2018-03-23 14:11:55 henrique Exp $
 */

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}
?>
<div class="header">
    <?php echo nm_get_text_lang("['codemirror']['help']"); ?>
</div>
<div class="content">
	<div class="description" style="font-size: 16px;">
        <h1><i class="fa fa-question" id="cogs"></i></h1>
        <table class='nmTable table_help'>
            <tr>
                <td>CTRL + SPACE</td>
                <td><?php echo nm_get_text_lang("['help']['autocomplete_macros']"); ?></td>
            </tr>
            <tr>
                <td>F11</td>
                <td><?php echo nm_get_text_lang("['help']['fullscreen']"); ?></td>
            </tr>
            <tr>
                <td>Ctrl-F</td>
                <td><?php echo nm_get_text_lang("['help']['search']"); ?></td>
            </tr>
            <tr>
                <td>Ctrl-G</td>
                <td><?php echo nm_get_text_lang("['help']['findNext']"); ?></td>
            </tr>
            <tr>
                <td>Shift-Ctrl-G</td>
                <td><?php echo nm_get_text_lang("['help']['findPrevious']"); ?></td>
            </tr>
            <tr>
                <td>Shift-Ctrl-F</td>
                <td><?php echo nm_get_text_lang("['help']['replace']"); ?></td>
            </tr>
            <tr>
                <td>Shift-Ctrl-R</td>
                <td><?php echo nm_get_text_lang("['help']['replaceAll']"); ?></td>
            </tr>
        </table>
	</div>
    <div id="unsupported-ext-name"></div>
    <div id="button_holder">
        <input type="button" name="OK" value="OK" onclick="$('#div_help_modal').modal('hide');" class="ui primary button">
    </div>
</div>
<style>
    #div_help_modal {
        width: 450px;
        margin-left: -225px;
        margin: 0 0 0 -225px;
        color: #31708f;
    }
    #div_help_modal p {
        font-size: 13px;
        text-align: center;
    }
    #div_help_modal h3 {
        color: #ec5454;
        text-align: center;
    }
    #div_help_modal #button_holder {
        text-align: center;
    }
    #div_help_modal #consider_disable {
        font-weight: bold;
        text-align: center;
    }
    #div_help_modal #unsupported-ext-name {
        margin-top: 20px;
        font-size: 14px;
        color: #333333;
        text-align: center;
        font-weight: bold;
    }
    #div_help_modal h1 {
        height: 80px;
        position: relative;
    }
    #div_help_modal #cogs:before {
        color: #3f9482;
        font-size: 50px;
        position: absolute;
        left: 50%;
        margin-left: -26px;
        top: 25px;
    }

    #div_help_modal #blocked:before {
        color: #ec5454;
        font-size: 100px;
        position: absolute;
        font-weight: lighter;
        left: 50%;
        margin-left: -40px;
        top: 0px;
    }

    #div_help_modal input {
        margin-top: 40px;
    }
</style>
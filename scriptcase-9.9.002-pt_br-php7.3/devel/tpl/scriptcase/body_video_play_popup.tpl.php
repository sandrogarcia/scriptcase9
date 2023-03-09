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
<!--<div class="header">-->
	<?php //echo nm_get_text_lang("['warning_title']"); ?>
<!--    Titulo do vídeo-->
<!--</div>-->
<div class="content">
    <iframe src="" type="text/html" frameborder="0" style="width: 100%; height: 100%" allowfullscreen></iframe>
</div>
<style>
    #video_play_popup {
        width: 70%;
        height: 70%;
        color: #31708f;
        margin-left: 50%;
        transform: translateX(-125%);
    }
    #video_play_popup p {
        font-size: 13px;
        text-align: center;
    }
    #video_play_popup h3 {
        color: #ec5454;
        text-align: center;
    }
    #video_play_popup #button_holder {
        text-align: center;
    }
    #video_play_popup #consider_disable {
        font-weight: bold;
        text-align: center;
    }
    #video_play_popup #unsupported-ext-name {
        margin-top: 20px;
        font-size: 14px;
        color: #333333;
        text-align: center;
        font-weight: bold;
    }
    #video_play_popup h1 {
        height: 80px;
        position: relative;
    }

    #video_play_popup input {
        margin-top: 40px;
    }

    #video_play_popup .content {
        padding: 0;
    }
</style>
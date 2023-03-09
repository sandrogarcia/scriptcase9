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

$arr_about = $this->GetVar('arr_about');

$dateStr = $arr_about['expire_raw'];
$format = 'd/m/Y';
$expDate = DateTime::createFromFormat($format, $dateStr);
$curDate = new DateTime('now');
$diff = $curDate->diff($expDate);
$neg = ($diff->invert) ? '-' : '';
$diff = intval($neg.$diff->format('%a'));
$expired = false;
if ($diff <= 0) {
    $expired = true;
}
$serial_code = ($expired) ? '?str_lic='.$arr_about['serial'] : '?str_lic='.$arr_about['serial'].'&client=true';
?>

        <i class="close icon"></i>
        <div class="header" style="border: none;background: linear-gradient( to right, #dd2476, #ff512f );color:white">
            <?php echo nm_get_text_lang("['9427_popup']['header']"); ?>
        </div>
        <div class="ui secondary pointing menu" style="justify-content: center;">
            <a class="item active" id="0">
                <?php echo nm_get_text_lang("['9427_popup']['json_export']"); ?>
            </a>
            <a class="item" id="1">
                <?php echo nm_get_text_lang("['9427_popup']['grid_form_integration']"); ?>
            </a>
            <a class="item" id="2">
                <?php echo nm_get_text_lang("['9427_popup']['click_run']"); ?>
            </a>
            <a class="item" id="3">
                <?php echo nm_get_text_lang("['9427_popup']['proj_creation']"); ?>
            </a>
            <a class="item" id="4">
                <?php echo nm_get_text_lang("['9427_popup']['excel_optimization']"); ?>
            </a>
        </div>
        <div class="image content" style="height: 60vh; overflow:auto">
            <div class="description" style="width: 100%">
                <div class="content-item" style="">
                    <h2><?php echo nm_get_text_lang("['9427_popup']['json_export_title']"); ?></h2>
                    <p><?php echo nm_get_text_lang("['9427_popup']['json_export_desc']"); ?></p>
                    <a href="https://www.scriptcase.net/lp/scriptcase-94/<?php echo $serial_code; ?>" target="_blank">
                        <video poster="" width="100%" height="auto" autoplay="" loop="true" muted="muted">
                            <source src="<?php echo $nm_config['url_scriptcase']; ?>/img/top/json.mp4" type="video/mp4" />
                            <?php echo nm_get_text_lang("['9427_popup']['video_error']"); ?>
                        </video>
                    </a>
                </div>
                <div class="content-item" style="display: none;">
                    <h2><?php echo nm_get_text_lang("['9427_popup']['grid_form_integration_title']"); ?></h2>
                    <p><?php echo nm_get_text_lang("['9427_popup']['grid_form_integration_desc']"); ?></p>
                    <a href="https://www.scriptcase.net/lp/scriptcase-94/<?php echo $serial_code; ?>" target="_blank">
                        <video width="100%" height="auto" autoplay="" loop="true" muted="muted">
                            <source src="<?php echo $nm_config['url_scriptcase']; ?>/img/top/consulta_form.mp4" type="video/mp4" />
                            <?php echo nm_get_text_lang("['9427_popup']['video_error']"); ?>
                        </video>
                    </a>
                </div>
                <div class="content-item" style="display: none;">
                    <h2><?php echo nm_get_text_lang("['9427_popup']['click_run_title']"); ?></h2>
                    <p><?php echo nm_get_text_lang("['9427_popup']['click_run_desc']"); ?></p>
                    <div class="ui small">
                        <a href="https://www.scriptcase.net/lp/scriptcase-94/<?php echo $serial_code; ?>" target="_blank">
                            <img class="ui fluid image" src="<?php echo $nm_config['url_scriptcase']; ?>/img/top/click_run.png" alt="" />
                        </a>
                    </div>
                </div>
                <div class="content-item" style="display: none;">
                    <h2><?php echo nm_get_text_lang("['9427_popup']['proj_creation_title']"); ?></h2>
                    <p><?php echo nm_get_text_lang("['9427_popup']['proj_creation_desc']"); ?></p>
                    <p>
                        <small><?php echo nm_get_text_lang("['9427_popup']['proj_creation_point1']"); ?></small>
                        <small class="pl-3"><?php echo nm_get_text_lang("['9427_popup']['proj_creation_point2']"); ?></small>
                        <br>
                        <small class="pl-3"><?php echo nm_get_text_lang("['9427_popup']['proj_creation_point3']"); ?></small>
                        <small><?php echo nm_get_text_lang("['9427_popup']['proj_creation_point4']"); ?></small>
                    </p>
                    <div class="ui small">
                        <a href="https://www.scriptcase.net/lp/scriptcase-94/<?php echo $serial_code; ?>" target="_blank">
                            <img class="ui fluid image" src="<?php echo $nm_config['url_scriptcase']; ?>/img/top/create_proj.png" alt="" />
                        </a>
                    </div>
                </div>
                <div class="content-item" style="display: none;">
                    <h2><?php echo nm_get_text_lang("['9427_popup']['excel_optimization_title']"); ?></h2>
                    <p><?php echo nm_get_text_lang("['9427_popup']['excel_optimization_desc']"); ?></p>
                    <div class="ui small">
                        <a href="https://www.scriptcase.net/lp/scriptcase-94/<?php echo $serial_code; ?>" target="_blank">
                            <img class="ui fluid image" src="<?php echo $nm_config['url_scriptcase']; ?>/img/top/excel_export.jpg" alt="" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="actions" style="text-align:center;border:none;">
            <div id="sc-ui-popup-9-4-button" class="ui button approve primary" style="background: linear-gradient( to right, #ff512f, #dd2476) !important;padding: 15px 20px;">
                <a href="https://www.scriptcase.net/lp/scriptcase-94/<?php echo $serial_code; ?>" target="_blank" style="color: white;">
                    <?php echo nm_get_text_lang("['9427_popup']['learn_more']"); ?>
                </a>
            </div>
        </div>

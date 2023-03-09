<?php

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}

$actionBarList = $this->GetVar('actionbar_list');
$actionBarOrder = $this->GetVar('actionbar_order');
$hasFeature = $this->GetVar('has_feature');

?>
<style>
    .sc-actionbar-item {
        cursor: move;
    }
</style>

<input type="hidden" name="actionbar_list" id="sc-input-actionbar-list" />
<input type="hidden" name="actionbar_order" id="sc-input-actionbar-order" />

<h2 class="ui header"><?php echo nm_get_text_lang("['actionbar_buttons']") ?></h2>
<table class="ui blue structured celled table" style="width: 800px">
    <thead>
    <tr>
        <td class="nmTitle" colspan="5"><?php echo nm_get_text_lang("['actionbar_button_list']") ?></td>
    </tr>
    <tr>
        <td class="nmPageTitle"></td>
        <td class="nmPageTitle">ID</td>
        <td class="nmPageTitle"><?php echo nm_get_text_lang("['actionbar_type']") ?></td>
        <td class="nmPageTitle"><?php echo nm_get_text_lang("['actionbar_in_use']") ?></td>
        <td class="nmPageTitle"></td>
    </tr>
    <tr>
        <td class="nmPageTitle" style="width: 800px; text-align: left" colspan="5"><?php echo nm_get_text_lang("['actionbar_bar_left']") ?></td>
    </tr>
    </thead>
    <tbody id="sc-actionbar-item-list">
<?php
foreach ($actionBarOrder as $actionName) {
    if ('__sc_sep' == $actionName) {
?>
    <tr class="sc-actionbar-item" id="sc-actionbar-item-list-<?php echo $actionName; ?>" data-action-name="<?php echo $actionName; ?>" data-action-type="<?php echo $actionBarList[$actionName]['type']; ?>">
        <td class="nmPageTitle" style="width: 800px; text-align: left" colspan="5"><?php echo nm_get_text_lang("['actionbar_bar_right']") ?></td>
    </tr>
<?php
    } else {
        $canEditVisual = false;
        $canDelete = false;
        $showOnUse = false;
        if ('__sc_detail' == $actionName) {
            $actionLabel = nm_get_text_lang("['actionbar_type_detail']");
            $actionType = $actionLabel;
        } elseif ('__sc_app_edit' == $actionName) {
            $actionLabel = nm_get_text_lang("['actionbar_type_link_app']");
            $actionType = $actionLabel;
        } else {
            $actionLabel = $actionName;
            $actionType = 'ajax' == $actionBarList[$actionName]['type'] ? 'Ajax' : nm_get_text_lang("['actionbar_option_Link']");
            $canEditVisual = true;
            $canDelete = true;
            $showOnUse = $hasFeature;
        }
        ?>
    <tr class="sc-actionbar-item" id="sc-actionbar-item-list-<?php echo $actionName; ?>" data-action-name="<?php echo $actionName; ?>" data-action-type="<?php echo $actionBarList[$actionName]['type']; ?>">
        <td class="nmLineV3" style="background-color: #fff; width: 25px; text-align: center"><span class="ui-icon ui-icon-arrowthick-2-n-s sc-actionbar-list-move"></span></td>
        <td class="nmLineV3" style="background-color: #fff; width: 335px;"><?php echo $actionLabel; ?></td>
        <td class="nmLineV3" style="background-color: #fff; width: 190px;"><?php echo $actionType; ?></td>
        <td class="nmLineV3" style="background-color: #fff; width: 60px; text-align: center">
<?php
        if ($showOnUse) {
?>
            <input type="checkbox" name="actionbar_in_use[<?php echo $actionName; ?>]" value="S" <?php if ('S' == $actionBarList[$actionName]['in_use']) { echo ' checked="checked"'; } ?> onClick="nm_form_modified()" />
<?php
        } else {
?>
            <input type="hidden" name="actionbar_in_use[<?php echo $actionName; ?>]" value="S" />
<?php
        }
?>
        </td>
        <td class="nmLineV3" style="background-color: #fff; width: 215px; text-align: right; white-space: nowrap">
<?php
        if ($hasFeature) {
            if ('link' == $actionBarList[$actionName]['type']) {
?>
            <a href="javascript:scActionBarClick_linkProperties('<?php echo $actionName; ?>');" title="<?php echo nm_get_text_lang("['actionbar_hint_edit_prop']") ?>">
                <span class="topicMenu"><?php echo nm_get_text_lang("['actionbar_option_prop']") ?></span>
            </a>
            <span class="topicMenu">|</span>
            <a href="javascript:scActionBarClick_linkEdit('<?php echo $actionName; ?>');" title="<?php echo nm_get_text_lang("['actionbar_hint_edit_link']") ?>">
                <span class="topicMenu"><?php echo nm_get_text_lang("['actionbar_option_Link']") ?></span>
            </a>
            <span class="topicMenu">|</span>
<?php
            } elseif ('ajax' == $actionBarList[$actionName]['type']) {
?>
            <a href="javascript:scActionBarClick_ajaxEdit('<?php echo $actionName; ?>');" title="<?php echo nm_get_text_lang("['actionbar_hint_edit_ajax']") ?>">
                <span class="topicMenu">Ajax</span>
            </a>
            <span class="topicMenu">|</span>
<?php
            }
            if ($canEditVisual) {
?>
            <a href="javascript:scActionBarClick_buttonVisualEdit('<?php echo $actionName; ?>');" title="<?php echo nm_get_text_lang("['actionbar_hint_edit_visual']") ?>">
                <span class="topicMenu"><?php echo nm_get_text_lang("['actionbar_option_visual']") ?></span>
            </a>
            <span class="topicMenu">|</span>
<?php
            }
            if ($canDelete) {
?>
            <a href="javascript:scActionBarClick_remove('<?php echo $actionName; ?>');" title="<?php echo nm_get_text_lang("['actionbar_hint_remove_button']") ?>">
                <span class="topicMenu"><?php echo nm_get_text_lang("['actionbar_option_delete']") ?></span>
            </a>
<?php
            }
        }
?>
        </td>
    </tr>
<?php
    }
}
?>
    </tbody>
</table>
<?php
/*
<h4>Notas temporarias para testes</h4>
<p>
Ao usar botoes ajax, 2 macros estao disponiveis:
</p>
<p>
<b>sc_actionbar_state(labelBotao, labelNovoEstado)</b>: faz o botao "labelBotao" mudar para o estado "labelNovoEstado". Pode ser usada no evento OnRecord e no evento do proprio botao ajax.
</p>
<p>
<b>sc_actionbar_clicked_state()</b>: retorna para o desenvolvedor o estado que o botao estava ao ser clicado. So pode ser usada no evento do proprio botao ajax.
</p>
<p>
<b>sc_actionbar_enable(labelBotao)</b>: habilita o botao "labelBotao" para uso. Pode ser usada no evento OnRecord e no evento do proprio botao ajax.
</p>
<p>
<b>sc_actionbar_disable(labelBotao)</b>: desabilita o botao "labelBotao" para uso. Pode ser usada no evento OnRecord e no evento do proprio botao ajax.
</p>
<p>
<b>sc_actionbar_show(labelBotao)</b>: exibe o botao "labelBotao" para uso. Pode ser usada no evento OnRecord e no evento do proprio botao ajax.
</p>
<p>
<b>sc_actionbar_hide(labelBotao)</b>: esconde o botao "labelBotao" para uso. Pode ser usada no evento OnRecord e no evento do proprio botao ajax.
</p>
*/
?>
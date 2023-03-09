<?php

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}

$modifiedFunction = $this->GetVar('modified_function');

$stateLabelsWithError = $this->GetVar('state_labels_with_error');

$formStep = $this->GetVar('form_step');
$buttonType = $this->GetVar('button_type');
$buttonDisplay = $this->GetVar('button_display');
$buttonStates = $this->GetVar('button_states');

$faDisplay = '';
$imgDisplay = ' style="display: none"';
$textDisplay = ' style="display: none"';
if ('img' == $buttonDisplay) {
    $faDisplay = ' style="display: none"';
    $imgDisplay = '';
} elseif ('text' == $buttonDisplay) {
    $faDisplay = ' style="display: none"';
    $textDisplay = '';
}

if ('' != $modifiedFunction) {
?>
<script>
stateAddOnChangeFunction = <?php echo substr($modifiedFunction, 0, -3) ?>;
</script>
<?php
}

?>
<style>
    .sc-button-new-label {
        display: inline-block;
        padding: 5px;
        width: 150px;
    }
    .sc-button-new-data {
        display: inline-block;
        padding: 5px;
        width: 400px;
    }
    .iconpicker-container {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }
    .sc-icon-position {
        position: absolute;
        right: 5px;
        top: 7px;
        font-size: 18px;
        cursor: pointer;
        background-color: #fff;
    }
    .sc-color-position {
        position: absolute;
        right: 5px;
        top: 7px;
        font-size: 18px;
        cursor: pointer;
        background-color: #fff;
        width: 20px;
        height: 20px;
        border: 1px outset #666;
    }
    .sc-fa-color {
        width: 125px;
    }
</style>

<h2 class="ui header"><?php echo nm_get_text_lang("['actionbar_visual']") ?></h2>
<table class="ui blue structured celled table" style="width: 800px">
    <thead>
    <tr>
        <td class="nmTitle"><?php echo nm_get_text_lang("['actionbar_visual_states']") ?></td>
    </tr>
    <tr>
        <td>
            <div>
                <span class="sc-button-new-label"><?php echo nm_get_text_lang("['actionbar_visual_display_type']") ?></span>
                <span class="sc-button-new-data">
                    <select name="button_display" class="nmInput" style="width: 100%" id="sc-input-actionbar-display" onChange="<?php echo $modifiedFunction; ?>">
                        <option value="fa" <?php if ('fa' == $buttonDisplay) { echo 'selected="selected"'; } ?>>FontAwesome</option>
                        <option value="img" <?php if ('img' == $buttonDisplay) { echo 'selected="selected"'; } ?>><?php echo nm_get_text_lang("['actionbar_visual_display_type_img']") ?></option>
                        <option value="text" <?php if ('text' == $buttonDisplay) { echo 'selected="selected"'; } ?>><?php echo nm_get_text_lang("['actionbar_visual_display_type_txt']") ?></option>
                    </select>
                </span>
            </div>
            <table id="sc-states" class="ui blue structured celled table">
                <tr>
                    <td class="nmPageTitle">ID</td>
                    <td class="nmPageTitle sc-button-data sc-button-data-fa" <?php echo $faDisplay; ?>>FontAwesome</td>
                    <td class="nmPageTitle sc-button-data sc-button-data-fa" <?php echo $faDisplay; ?>><?php echo nm_get_text_lang("['actionbar_visual_display_color']") ?></td>
                    <td class="nmPageTitle sc-button-data sc-button-data-fa" <?php echo $faDisplay; ?>><?php echo nm_get_text_lang("['actionbar_visual_display_color']") ?> (Hover)</td>
                    <td class="nmPageTitle sc-button-data sc-button-data-fa" <?php echo $faDisplay; ?>><?php echo nm_get_text_lang("['actionbar_visual_display_color']") ?> (Active)</td>
                    <td class="nmPageTitle sc-button-data sc-button-data-img" <?php echo $imgDisplay; ?>><?php echo nm_get_text_lang("['actionbar_visual_display_type_img']") ?></td>
                    <td class="nmPageTitle sc-button-data sc-button-data-text" <?php echo $textDisplay; ?>><?php echo nm_get_text_lang("['actionbar_visual_display_type_txt']") ?></td>
                    <td class="nmPageTitle"><?php echo nm_get_text_lang("['actionbar_visual_display_hint']") ?></td>
                    <td class="nmPageTitle"></td>
                </tr>
<?php
$count = 0;
foreach ($buttonStates as $stateInfo) {
    if ('create' == $formStep) {
        $labelInput = '<div class="ui input">';
        $labelInput .= '<input type="text" name="state_label[]" value="' . $stateInfo['label'] . '" />';
        $labelInput .= '</div>';
    } elseif (in_array($count, $stateLabelsWithError)) {
        $labelInput = '<div class="ui input">';
        $labelInput .= '<input type="text" name="state_label[]" value="' . $stateInfo['label'] . '" onChange="' . $modifiedFunction . '" />';
        $labelInput .= '</div>';
    } else {
        $labelInput = '<input type="hidden" name="state_label[]" value="' . $stateInfo['label'] . '" />' . $stateInfo['label'];
    }
    if ('' != $stateInfo['fa_color']) {
        $faIconColor = $stateInfo['fa_color'];
    } else {
        $faIconColor = '#2185D0';
    }
    if (!isset($stateInfo['fa_hover'])) {
        $stateInfo['fa_hover'] = '';
    }
    if (!isset($stateInfo['fa_active'])) {
        $stateInfo['fa_active'] = '';
    }
?>
                <tr id="sc-state-item-<?php echo $count; ?>" class="sc-state-item">
                    <td class="nmLineV3"><?php echo $labelInput; ?></td>
                    <td class="nmLineV3 sc-button-data sc-button-data-fa" <?php echo $faDisplay; ?>>
                        <div class="ui input iconpicker-container">
                            <input class="form_edit_toolbar fa_field icp icp-auto iconpicker-element iconpicker-input" data-row-number="<?php echo $count; ?>" type="text" name="state_fa_icon[]" value="<?php echo $stateInfo['fa_icon']; ?>" onChange="<?php echo $modifiedFunction; ?>" />
                            <span class="nmText fa_field" style="white-space: nowrap">
                                <i class="sc-icon-position sc-fa-icon-preview <?php echo $stateInfo['fa_icon']; ?>" style="color: <?php echo $faIconColor; ?>" onclick="scActionBarFA_iconClick('<?php echo $count; ?>');"></i>
                            </span>
                        </div>
                    </td>
                    <td class="nmLineV3 sc-button-data sc-button-data-fa" <?php echo $faDisplay; ?>>
                        <div class="ui input">
                            <input class="sc-fa-color" id="sc-state-color-<?php echo $count; ?>" type="text" name="state_fa_color[]" data-row-number="<?php echo $count; ?>" value="<?php echo $stateInfo['fa_color']; ?>" onChange="<?php echo $modifiedFunction; ?>" />
                            <span class="nmText fa_field" style="white-space: nowrap">
                                <button class="sc-color-position" style="background-color: <?php echo $stateInfo['fa_color']; ?>" onClick="scActionBarClick_colorPickerClick('#sc-state-color-<?php echo $count; ?>'); return false;"></button>
                            </span>
                        </div>
                    </td>
                    <td class="nmLineV3 sc-button-data sc-button-data-fa" <?php echo $faDisplay; ?>>
                        <div class="ui input">
                            <input class="sc-fa-color" id="sc-state-hover-<?php echo $count; ?>" type="text" name="state_fa_hover[]" data-row-number="<?php echo $count; ?>" value="<?php echo $stateInfo['fa_hover']; ?>" onChange="<?php echo $modifiedFunction; ?>" />
                            <span class="nmText fa_field" style="white-space: nowrap">
                                <button class="sc-color-position" style="background-color: <?php echo $stateInfo['fa_hover']; ?>" onClick="scActionBarClick_colorPickerClick('#sc-state-hover-<?php echo $count; ?>'); return false;"></button>
                            </span>
                        </div>
                    </td>
                    <td class="nmLineV3 sc-button-data sc-button-data-fa" <?php echo $faDisplay; ?>>
                        <div class="ui input">
                            <input class="sc-fa-color" id="sc-state-active-<?php echo $count; ?>" type="text" name="state_fa_active[]" data-row-number="<?php echo $count; ?>" value="<?php echo $stateInfo['fa_active']; ?>" onChange="<?php echo $modifiedFunction; ?>" />
                            <span class="nmText fa_field" style="white-space: nowrap">
                                <button class="sc-color-position" style="background-color: <?php echo $stateInfo['fa_active']; ?>" onClick="scActionBarClick_colorPickerClick('#sc-state-active-<?php echo $count; ?>'); return false;"></button>
                            </span>
                        </div>
                    </td>
                    <td class="nmLineV3 sc-button-data sc-button-data-img" <?php echo $imgDisplay; ?>>
                        <div class="ui input">
                            <input type="text" id="sc-state-img-<?php echo $count; ?>" name="state_img_icon[]" value="<?php echo $stateInfo['img_icon']; ?>" onChange="<?php echo $modifiedFunction; ?>" />
                            <span class="nmText fa_field" style="white-space: nowrap">
                                <img src="<?php echo $nm_config['url_img']; ?>background.png" class="sc-icon-position sc-img-picker" onClick="scActionBarImg_iconClick('<?php echo $count; ?>');" />
                            </span>
                        </div>
                    </td>
                    <td class="nmLineV3 sc-button-data sc-button-data-text" <?php echo $textDisplay; ?>>
                        <div class="ui input">
                            <input type="text" name="state_txt_label[]" value="<?php echo $stateInfo['txt_label']; ?>" onChange="<?php echo $modifiedFunction; ?>" />
                        </div>
                    </td>
                    <td class="nmLineV3">
                        <div class="ui input">
                            <input type="text" name="state_hint[]" value="<?php echo $stateInfo['hint']; ?>" onChange="<?php echo $modifiedFunction; ?>" />
                        </div>
                    </td>
                    <td class="nmLineV3" style="text-align: center">
                        <a href="javascript:scActionBarClick_stateRemove('<?php echo $count; ?>');">
                            <span class="topicMenu"><?php echo nm_get_text_lang("['actionbar_option_delete']") ?></span>
                        </a>
                    </td>
                </tr>
<?php
    $count++;
}
?>
            </table>
<?php
if ('ajax' == $buttonType) {
?>
            <input type="button" value="<?php echo nm_get_text_lang("['actionbar_button_add_state']") ?>" class="ui button primary mini" onClick="scActionBarClick_stateAdd()" />
<?php
}
?>
        </td>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>

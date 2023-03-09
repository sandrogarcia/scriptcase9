<?php

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}

$bar_visual = $this->GetVar('bar_visual');

if (!isset($bar_visual['fa_hover'])) {
    $bar_visual['fa_hover'] = '';
}
if (!isset($bar_visual['fa_active'])) {
    $bar_visual['fa_active'] = '';
}

?>
<style>
    .sc-color-position {
        position: absolute;
        right: 5px;
        top: 5px;
        font-size: 18px;
        cursor: pointer;
        background-color: #fff;
        width: 20px;
        height: 20px;
        border: 1px outset #666;
    }
</style>

<h2 class="ui header"><?php echo nm_get_text_lang("['actionbar_bar_visual']") ?></h2>
<table class="ui blue structured celled table" style="width: 800px">
    <thead>
    <tr>
        <td class="nmTitle" colspan="3"><?php echo nm_get_text_lang("['actionbar_bar_visual']") ?></td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="nmLineV3">
            <?php echo nm_get_text_lang("['actionbar_bar_visual_padding_label']") ?>
        </td>
        <td class="nmLineV3">
            <div class="ui input">
                <input class="nmInput" type="text" name="padding" value="<?php echo $bar_visual['padding']; ?>" onChange="nm_form_modified()" />
            </div>
        </td>
        <td class="nmLineV3">
            <?php echo nm_get_text_lang("['actionbar_bar_visual_padding_help']") ?>
        </td>
    </tr>
    <tr>
        <td class="nmLineV3">
            <?php echo nm_get_text_lang("['actionbar_bar_visual_fa_size_label']") ?>
        </td>
        <td class="nmLineV3">
            <div class="ui input">
                <input class="nmInput" type="text" name="fa_size" value="<?php echo $bar_visual['fa_size']; ?>" onChange="nm_form_modified()" />
            </div>
        </td>
        <td class="nmLineV3">
            <?php echo nm_get_text_lang("['actionbar_bar_visual_fa_size_help']") ?>
        </td>
    </tr>
    <tr class="sc-bar-color">
        <td class="nmLineV3">
            <?php echo nm_get_text_lang("['actionbar_bar_visual_fa_color_label']") ?>
        </td>
        <td class="nmLineV3">
            <div class="ui input">
                <input class="nmInput sc-fa-color" type="text" id="sc-input-fa-color" name="fa_color" value="<?php echo $bar_visual['fa_color']; ?>" onChange="nm_form_modified()" />
                <span class="nmText fa_field" style="white-space: nowrap">
                    <button class="sc-color-position" style="background-color: <?php echo $bar_visual['fa_color']; ?>" onClick="scActionBarClick_colorPickerClick('#sc-input-fa-color'); return false;"></button>
                </span>
            </div>
        </td>
        <td class="nmLineV3">
            <?php echo nm_get_text_lang("['actionbar_bar_visual_fa_color_help']") ?>
        </td>
    </tr>
    <tr class="sc-bar-color">
        <td class="nmLineV3">
            <?php echo nm_get_text_lang("['actionbar_bar_visual_fa_color_label']") ?> (Hover)
        </td>
        <td class="nmLineV3">
            <div class="ui input">
                <input class="nmInput sc-fa-color" type="text" id="sc-input-fa-hover" name="fa_hover" value="<?php echo $bar_visual['fa_hover']; ?>" onChange="nm_form_modified()" />
                <span class="nmText fa_field" style="white-space: nowrap">
                    <button class="sc-color-position" style="background-color: <?php echo $bar_visual['fa_hover']; ?>" onClick="scActionBarClick_colorPickerClick('#sc-input-fa-hover'); return false;"></button>
                </span>
            </div>
        </td>
        <td class="nmLineV3">
            <?php echo nm_get_text_lang("['actionbar_bar_visual_fa_hover_help']") ?>
        </td>
    </tr>
    <tr class="sc-bar-color">
        <td class="nmLineV3">
            <?php echo nm_get_text_lang("['actionbar_bar_visual_fa_color_label']") ?> (Active)
        </td>
        <td class="nmLineV3">
            <div class="ui input">
                <input class="nmInput sc-fa-color" type="text" id="sc-input-fa-active" name="fa_active" value="<?php echo $bar_visual['fa_active']; ?>" onChange="nm_form_modified()" />
                <span class="nmText fa_field" style="white-space: nowrap">
                    <button class="sc-color-position" style="background-color: <?php echo $bar_visual['fa_active']; ?>" onClick="scActionBarClick_colorPickerClick('#sc-input-fa-active'); return false;"></button>
                </span>
            </div>
        </td>
        <td class="nmLineV3">
            <?php echo nm_get_text_lang("['actionbar_bar_visual_fa_active_help']") ?>
        </td>
    </tr>
    <tr class="sc-bar-color">
        <td class="nmLineV3">
            <?php echo nm_get_text_lang("['actionbar_bar_visual_link_color_label']") ?>
        </td>
        <td class="nmLineV3">
            <div class="ui input">
                <input class="nmInput sc-fa-color" type="text" id="sc-input-link-color" name="link_color" value="<?php echo $bar_visual['link_color']; ?>" onChange="nm_form_modified()" />
                <span class="nmText fa_field" style="white-space: nowrap">
                    <button class="sc-color-position" style="background-color: <?php echo $bar_visual['link_color']; ?>" onClick="scActionBarClick_colorPickerClick('#sc-input-link-color'); return false;"></button>
                </span>
            </div>
        </td>
        <td class="nmLineV3">
            <?php echo nm_get_text_lang("['actionbar_bar_visual_link_color_help']") ?>
        </td>
    </tr>
    <tr class="sc-bar-color">
        <td class="nmLineV3">
            <?php echo nm_get_text_lang("['actionbar_bar_visual_link_hover_label']") ?>
        </td>
        <td class="nmLineV3">
            <div class="ui input">
                <input class="nmInput sc-fa-color" type="text" id="sc-input-link-hover" name="link_hover" value="<?php echo $bar_visual['link_hover']; ?>" onChange="nm_form_modified()" />
                <span class="nmText fa_field" style="white-space: nowrap">
                    <button class="sc-color-position" style="background-color: <?php echo $bar_visual['link_hover']; ?>" onClick="scActionBarClick_colorPickerClick('#sc-input-link-hover'); return false;"></button>
                </span>
            </div>
        </td>
        <td class="nmLineV3">
            <?php echo nm_get_text_lang("['actionbar_bar_visual_link_hover_help']") ?>
        </td>
    </tr>
    <tr class="sc-bar-color">
        <td class="nmLineV3">
            <?php echo nm_get_text_lang("['actionbar_bar_visual_link_active_label']") ?>
        </td>
        <td class="nmLineV3">
            <div class="ui input">
                <input class="nmInput sc-fa-color" type="text" id="sc-input-link-active" name="link_active" value="<?php echo $bar_visual['link_active']; ?>" onChange="nm_form_modified()" />
                <span class="nmText fa_field" style="white-space: nowrap">
                    <button class="sc-color-position" style="background-color: <?php echo $bar_visual['link_active']; ?>" onClick="scActionBarClick_colorPickerClick('#sc-input-link-active'); return false;"></button>
                </span>
            </div>
        </td>
        <td class="nmLineV3">
            <?php echo nm_get_text_lang("['actionbar_bar_visual_link_active_help']") ?>
        </td>
    </tr>
    <tr>
        <td class="nmLineV3">
            <?php echo nm_get_text_lang("['actionbar_bar_visual_valign_label']") ?>
        </td>
        <td class="nmLineV3">
            <div class="ui input">
<?php
if (!isset($bar_visual['valign']) || !in_array($bar_visual['valign'], array('top', 'middle', 'bottom'))) {
    $bar_visual['valign'] = 'top';
}
?>
                <select class="nmInput" name="valign" onChange="nm_form_modified()">
                    <option value="top" <?php if ('top' == $bar_visual['valign']) { echo 'selected="selected"'; } ?>><?php echo nm_get_text_lang("['align_top']") ?></option>
                    <option value="middle" <?php if ('middle' == $bar_visual['valign']) { echo 'selected="selected"'; } ?>><?php echo nm_get_text_lang("['align_mid']") ?></option>
                    <option value="bottom" <?php if ('bottom' == $bar_visual['valign']) { echo 'selected="selected"'; } ?>><?php echo nm_get_text_lang("['align_bot']") ?></option>
                </select>
            </div>
        </td>
        <td class="nmLineV3">
            <?php echo nm_get_text_lang("['actionbar_bar_visual_valign_help']") ?>
        </td>
    </tr>
    <tr>
        <td class="nmLineV3">
            <?php echo nm_get_text_lang("['actionbar_bar_visual_overwrite_label']") ?>
        </td>
        <td class="nmLineV3">
            <div class="ui input">
                <input class="nmInput" type="checkbox" name="overwrite_sc_buttons" value="S" <?php if ('S' == $bar_visual['overwrite_sc_buttons']) { echo 'checked="checked"'; } ?> onClick="nm_form_modified()" />
            </div>
        </td>
        <td class="nmLineV3">
            <?php echo nm_get_text_lang("['actionbar_bar_visual_overwrite_help']") ?>
        </td>
    </tr>
    </tbody>
</table>

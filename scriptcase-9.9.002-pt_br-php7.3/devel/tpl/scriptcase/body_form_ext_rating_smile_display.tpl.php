<?php
$arr_data  = $this->GetVar('field_data');
$str_class = ($arr_data['error']) ? 'nmErrorMsg' : $arr_data['class'];
$str_style = (isset($arr_data['jstype']) && in_array($arr_data['jstype'], array('numeroedt', 'numeroedtvg', 'valor', 'valorvg'))) ? ' style="text-align: right"' : '';
$str_min   = (isset($arr_data['minimal']) && '' != $arr_data['minimal']) ? ', ' . $arr_data['minimal'] : '';
$upgrade_no_permission  = isset($arr_data['upgrade_no_permission'])? $arr_data['upgrade_no_permission'] : false;
$label_new_opt  = isset($arr_data['label_new_opt'])? $arr_data['label_new_opt'] : false;
$disableInput = $upgrade_no_permission ? 'disabled="disabled"' : '';
if(!isset($arr_data['on_focus']))
{
    $arr_data['on_focus'] = '';
}
if(!isset($arr_data['size'])) {
    $arr_data['size'] = '';
}
?>
    <tr class="nmTrAttr nmTrHover <?php echo isset($arr_data['tr_class']) ? $arr_data['tr_class'] : ''; ?>" id="id_tr_<?php echo $arr_data['name']; ?>" <?php echo $arr_data['tr_style']; ?>>
        <td class="nmAttrTitle <?php echo $str_class; ?>" style="text-align: right; vertical-align: top">
            <span id='id_title_<?php echo $arr_data['name']; ?>'><?php echo $arr_data['title']; ?></span>
            <a name="anchor_<?php echo $arr_data['name']; ?>"></a>
            <?php if ($upgrade_no_permission) {?>
                <small class="upgradeOnlyInfo"><?php echo nm_get_text_lang("['upgrade_only_feature']"); ?></small>
            <?php } else if ($label_new_opt) { ?>
                <span class="field-new-sticker"><?php echo nm_get_text_lang("['menu_new_label']", 'Menu'); ?></span>
            <?php } ?>
        </td>

        <td class="<?php echo $str_class; ?>" style="text-align: right; vertical-align: top;">&nbsp;</td>

        <td class="nmAttrValue <?php echo $str_class; ?>" style="text-align: left; vertical-align: top; white-space: nowrap">
            <table class="sc-smile-table">
                <tr>
                    <td><input type="radio" class="nmInput" name="<?php echo $arr_data['name']; ?>" value="r" <?php if ('r' == $arr_data['value']) { echo 'checked="checked"'; }?> onClick="<?php echo $nm_config['form_modif2'] ?>" <?php echo $disableInput; ?> /></td>
                    <td>
                        <i class="sc-smile-item far fa-angry"></i>
                        <i class="sc-smile-item far fa-frown"></i>
                        <i class="sc-smile-item far fa-meh"></i>
                        <i class="sc-smile-item far fa-smile"></i>
                        <i class="sc-smile-item far fa-laugh-beam"></i>
                    </td>
                </tr>
                <tr>
                    <td><input type="radio" class="nmInput" name="<?php echo $arr_data['name']; ?>" value="s" <?php if ('s' == $arr_data['value']) { echo 'checked="checked"'; }?> onClick="<?php echo $nm_config['form_modif2'] ?>" <?php echo $disableInput; ?> /></td>
                    <td>
                        <i class="sc-smile-item fas fa-angry"></i>
                        <i class="sc-smile-item fas fa-frown"></i>
                        <i class="sc-smile-item fas fa-meh"></i>
                        <i class="sc-smile-item fas fa-smile"></i>
                        <i class="sc-smile-item fas fa-laugh-beam"></i>
                    </td>
                </tr>
            </table>
        </td>

        <td class="<?php echo $str_class; ?>" style="text-align: right; vertical-align: top;">&nbsp;</td>

        <td class="nmLineDesc" style="text-align: left; vertical-align: top">
            <span id='id_desc_<?php echo $arr_data['name']; ?>'><?php echo $arr_data['desc']; ?></span>
            <span id="id_obs_<?php echo $arr_data['name']; ?>"<?php echo $arr_data['tr_display']; ?>><?php echo $arr_data['tr_obs']; ?></span>
        </td>
    </tr>

    <tr class="nmTrAttr nmTrHover <?php echo $str_class; ?>" id='tr_lang_label_<?php echo $arr_data['name']; ?>' style="display:none">
        <td class="nmAttrTitle"></td>
        <td></td>
        <td id='td_lang_label_<?php echo $arr_data['name']; ?>' colspan=4 class="<?php echo $str_class; ?>">
        </td>
    </tr>
<?php
if(isset($arr_data['help']))
{
    ?>
    <tr class="nmTrAttr nmTrHover <?php echo $str_class; ?>" id='tr_lang_label_help_<?php echo $arr_data['name']; ?>'>
        <td class="nmAttrTitle"></td>
        <td></td>
        <td id='td_lang_label_help_<?php echo $arr_data['name']; ?>' colspan=4 class="<?php echo $str_class; ?>">
            <?php echo $arr_data['help']; ?>
        </td>
    </tr>
    <?php
}
?>
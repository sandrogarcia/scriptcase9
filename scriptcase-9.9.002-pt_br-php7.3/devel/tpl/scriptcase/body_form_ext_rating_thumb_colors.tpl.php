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
<script type="text/javascript">
$(function() {
    let i, colorPickerList = $(".sc-rating-color-picker"), colorPickerObject;
    for (i = 0; i < colorPickerList.length; i++) {
        addColorPicker($(colorPickerList[i]));
    }
});
function addColorPicker(jqueryObject) {
    jqueryObject.ColorPicker({
        onBeforeShow: function () {
            jqueryObject.ColorPickerSetColor(jqueryObject.val());
        },
        onSubmit: function(hsb, hex, rgb, el) {
            $(el).val("#" + hex);
            $(el).ColorPickerHide();
            $(el).parent().find("button").css("backgroundColor", "#" + hex);
            $(el).parent().parent().find("i").css("color", "#" + hex);
            $(el).trigger("change");
        }
    });
}
</script>

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
                    <td></td>
                    <td><?php echo nm_get_text_lang("['rating_color']"); ?></td>
                </tr>
                <tr>
                    <td>
                        <i class="sc-smile-item far fa-thumbs-up" style="color: <?php echo $arr_data['value'][0]; ?>"></i>
                        <i class="sc-smile-item fas fa-thumbs-up" style="color: <?php echo $arr_data['value'][0]; ?>"></i>
                    </td>
                    <td><input type="text" class="sc-smile-input sc-rating-color-picker nmInput" name="<?php echo $arr_data['name']; ?>[]" value="<?php echo $arr_data['value'][0]; ?>" onChange="<?php echo $nm_config['form_modif2'] ?>" <?php echo $disableInput; ?> /></td>
                </tr>
                <tr>
                    <td>
                        <i class="sc-smile-item far fa-thumbs-down" style="color: <?php echo $arr_data['value'][1]; ?>"></i>
                        <i class="sc-smile-item fas fa-thumbs-down" style="color: <?php echo $arr_data['value'][1]; ?>"></i>
                    </td>
                    <td><input type="text" class="sc-smile-input sc-rating-color-picker nmInput" name="<?php echo $arr_data['name']; ?>[]" value="<?php echo $arr_data['value'][1]; ?>" onChange="<?php echo $nm_config['form_modif2'] ?>" <?php echo $disableInput; ?> /></td>
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
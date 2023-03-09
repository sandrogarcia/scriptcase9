<?php
$arr_data = $this->GetVar('field_data');
$str_class = ($arr_data['error']) ? 'nmErrorMsg' : $arr_data['class'];
if (!isset($arr_data['colspan']) || !$arr_data['colspan']) {
    $bol_colspan = FALSE;
    $str_colspan = '';
} else {
    $bol_colspan = TRUE;
    $str_colspan = ' colspan="3"';
}
$upgrade_no_permission  = isset($arr_data['upgrade_no_permission'])? $arr_data['upgrade_no_permission'] : false;
$label_new_opt  = isset($arr_data['label_new_opt'])? $arr_data['label_new_opt'] : false;
?>
<tr class="nmTrAttr nmTrHover"
    id="id_tr_<?php echo $arr_data['name']; ?>" <?php echo $arr_data['tr_display']; ?> <?php echo $arr_data['tr_style']; ?>>
    <td class="nmAttrTitle <?php echo $str_class; ?>"
        style="text-align: right; vertical-align: top;"><?php echo $arr_data['title']; ?><a
                name="anchor_<?php echo $arr_data['name']; ?>"></a>
        <?php if ($upgrade_no_permission) { ?>
            <small class="upgradeOnlyInfo"><?php echo nm_get_text_lang("['upgrade_only_feature']"); ?></small>
        <?php } else if ($label_new_opt) { ?>
            <span class="field-new-sticker"><?php echo nm_get_text_lang("['menu_new_label']", 'Menu'); ?></span>
        <?php } ?>
    </td>
    <td class="<?php echo $str_class; ?>" style="text-align: right; vertical-align: top;">&nbsp;</td>
    <td class="<?php echo $str_class; ?>"
        style="text-align: left; vertical-align: top; white-space: nowrap"<?php echo $str_colspan; ?>>
        <div id="id_objeto_<?php echo (isset($arr_data['name'])?$arr_data['name']:''); ?>" style="display: <?php if (isset($arr_data['readonly']) && $arr_data['readonly'] == "S") {
            echo "none";
        } ?>">
      <textarea name="<?php echo $arr_data['name']; ?>" id="<?php echo $arr_data['name']; ?>"
                cols="<?php echo $arr_data['cols']; ?>" rows="<?php echo $arr_data['rows']; ?>" class="nmInput"
                onChange="<?php echo $nm_config['form_modif2'] . $arr_data['on_change']; ?>"
                onblur="nm_translate_lang_label('<?php echo $arr_data['name']; ?>', $('#<?php echo $arr_data['name']; ?>').val());"><?php echo nm_string_form($arr_data['value']); ?></textarea> <?php echo $arr_data['link_icon']; ?>

            <?php
            if (isset($arr_data['help_data'])) {
                ?>
                <div id="id_help_<?php echo $arr_data['name']; ?>"><?php echo $arr_data['help_data']; ?></div>
                <?php
            }
            ?>
        </div>
        <div id="id_readonly_<?php echo (isset($arr_data['name'])?$arr_data['name']:''); ?>" style="display: <?php if (isset($arr_data['readonly']) && $arr_data['readonly'] == "N") {
            echo "none";
        } ?>">
            <?php echo nm_string_form((isset($arr_data['readonly_value'])?$arr_data['readonly_value']:'')); ?>
        </div>
    </td>
    <?php
    if (!$bol_colspan) {
        ?>
        <td class="<?php echo $str_class; ?>" style="text-align: right; vertical-align: top;">&nbsp;</td>
        <td class="nmLineDesc" style="text-align: left; vertical-align: top;"><?php echo $arr_data['desc']; ?></td>
        <?php
    }
    ?>
</tr>

<?php

if (isset($arr_data['edit_area']) && $arr_data['edit_area']) {
    ?>
    <script language="javascript" type="text/javascript"
            src="<?php echo $nm_config['url_js_thirddevel']; ?>edit_area/edit_area_full.js"></script>
    <?php
}
?>

<tr class="nmTrAttr nmTrHover <?php echo $str_class; ?>" id='tr_lang_label_<?php echo $arr_data['name']; ?>'
    style="display:none">
    <td class="nmAttrTitle"></td>
    <td></td>
    <td id='td_lang_label_<?php echo $arr_data['name']; ?>' colspan=4 class="<?php echo $str_class; ?>">
    </td>
</tr>
<?php

$arr_data  = $this->GetVar('field_data');
$str_class = (isset($arr_data['error']) && $arr_data['error']) ? 'nmErrorMsg' : $arr_data['class'];
$language_translated = (isset($arr_data['language-translated']) && $arr_data['language-translated'] === true) ? 'language-translated' : '';
$upgrade_no_permission  = isset($arr_data['upgrade_no_permission'])? $arr_data['upgrade_no_permission'] : false;
$label_new_opt  = isset($arr_data['label_new_opt'])? $arr_data['label_new_opt'] : false;
$hideOnDisplay = isset($arr_data['hide_on_display']) ? $arr_data['hide_on_display'] : false;

if(!isset($arr_data['on_focus']))
{
    $arr_data['on_focus'] = '';
}

$onClick = $nm_config['form_modif2'];

if ($hideOnDisplay) {
?>
    <script>
        $(function() {
            $("#id_tr_<?php echo $arr_data['name']; ?>").hide();
        });
    </script>
<?php
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
            <style>
                .order-icon {
                    padding: 5px 1px;
                    margin: 5px 1px;
                    width: 16px;
                    height: 16px;
                    font-size: 13px;
                }
            </style>
            <div style="display: flex; flex-direction: row; justify-content: space-between">
                <div style="flex-grow: 1">
                    <input type="radio" name="<?php echo $arr_data['name']; ?>" value="alpha" <?php if ('alpha' == $arr_data['value']) { echo 'checked'; } ?> <?php if (isset($arr_data['disabled']) || $upgrade_no_permission) { echo 'disabled'; } ?> onclick="<?php echo $onClick; ?>" />
                    <span class="fas fa-sort-alpha-down order-icon"></span>
                    <span class="fas fa-sort-alpha-down-alt order-icon"></span>
                </div>
                <div style="flex-grow: 1">
                    <input type="radio" name="<?php echo $arr_data['name']; ?>" value="numeric" <?php if ('numeric' == $arr_data['value']) { echo 'checked'; } ?> <?php if (isset($arr_data['disabled']) || $upgrade_no_permission) { echo 'disabled'; } ?> onclick="<?php echo $onClick; ?>" />
                    <span class="fas fa-sort-numeric-down order-icon"></span>
                    <span class="fas fa-sort-numeric-down-alt order-icon"></span>
                </div>
            </div>
            <div style="display: flex; flex-direction: row; justify-content: space-between">
                <div style="flex-grow: 1">
                    <input type="radio" name="<?php echo $arr_data['name']; ?>" value="bar" <?php if ('bar' == $arr_data['value']) { echo 'checked'; } ?> <?php if (isset($arr_data['disabled']) || $upgrade_no_permission) { echo 'disabled'; } ?> onclick="<?php echo $onClick; ?>" />
                    <span class="fas fa-sort-amount-down-alt order-icon"></span>
                    <span class="fas fa-sort-amount-down order-icon"></span>
                </div>
                <div style="flex-grow: 1">
                    <input type="radio" name="<?php echo $arr_data['name']; ?>" value="arrow" <?php if ('arrow' == $arr_data['value']) { echo 'checked'; } ?> <?php if (isset($arr_data['disabled']) || $upgrade_no_permission) { echo 'disabled'; } ?> onclick="<?php echo $onClick; ?>" />
                    <span class="fas fa-sort-up order-icon"></span>
                    <span class="fas fa-sort-down order-icon"></span>
                </div>
            </div>
            <div style="display: flex; flex-direction: row; justify-content: space-between">
                <div style="flex-grow: 1">
                    <input type="radio" name="<?php echo $arr_data['name']; ?>" value="longarrow" <?php if ('longarrow' == $arr_data['value']) { echo 'checked'; } ?> <?php if (isset($arr_data['disabled']) || $upgrade_no_permission) { echo 'disabled'; } ?> onclick="<?php echo $onClick; ?>" />
                    <span class="fas fa-long-arrow-alt-up order-icon"></span>
                    <span class="fas fa-long-arrow-alt-down order-icon"></span>
                </div>
                <div style="flex-grow: 1">
                    <input type="radio" name="<?php echo $arr_data['name']; ?>" value="arrow2" <?php if ('arrow2' == $arr_data['value']) { echo 'checked'; } ?> <?php if (isset($arr_data['disabled']) || $upgrade_no_permission) { echo 'disabled'; } ?> onclick="<?php echo $onClick; ?>" />
                    <span class="fas fa-arrow-up order-icon"></span>
                    <span class="fas fa-arrow-down order-icon"></span>
                </div>
            </div>
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
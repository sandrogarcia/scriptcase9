<?php
$arr_data = $this->GetVar('field_data');
$str_class = ($arr_data['error']) ? 'nmErrorMsg' : $arr_data['class'];
$upgrade_no_permission  = isset($arr_data['upgrade_no_permission'])? $arr_data['upgrade_no_permission'] : false;
$label_new_opt  = isset($arr_data['label_new_opt'])? $arr_data['label_new_opt'] : false;
?>
<tr class="nmTrAttr nmTrHover <?php echo isset($arr_data['tr_class']) ? $arr_data['tr_class'] : ''; ?>" id="id_tr_<?php echo $arr_data['name']; ?>" <?php echo $arr_data['tr_style']; ?>>
    <td class="nmAttrTitle <?php echo $str_class; ?>"
        style="text-align: right; vertical-align: top"><?php echo $arr_data['title']; ?><a
            name="anchor_<?php echo $arr_data['name']; ?>"></a>
        <?php if ($upgrade_no_permission) {?>
            <small class="upgradeOnlyInfo"><?php echo nm_get_text_lang("['upgrade_only_feature']"); ?></small>
        <?php } else if ($label_new_opt) { ?>
            <span class="field-new-sticker"><?php echo nm_get_text_lang("['menu_new_label']", 'Menu'); ?></span>
        <?php } ?>

    </td>
    <td class="<?php echo $str_class; ?>" style="text-align: right; vertical-align: top;">&nbsp;</td>
    <td class="nmAttrValue <?php echo $str_class; ?>" style="text-align: left; vertical-align: top; white-space: nowrap">
        <?php
        if (is_array($arr_data['options']))
        {
            foreach ($arr_data['options'] as $str_option => $str_value) {
                $str_op_value = ('I' == $arr_data['op_value']) ? $str_option : $str_value;
                if ($arr_data['value'] == $str_op_value) {
                    $str_checked = ' checked="checked"';
                    if ('' != $arr_data['on_click']) {
                        $str_checked .= ' onClick="' . $arr_data['on_click'] . '"';
                    }
                } else {
                    $str_checked = ' onClick="' . $nm_config['form_modif2'];
                    if ('' != $arr_data['on_click']) {
                        $str_checked .= '; ' . $arr_data['on_click'];
                    }
                    $str_checked .= '"';
                }
                $str_id_random = nm_id_random('rad_' . $arr_data['name']);
                ?>
                <input type="radio" name="<?php echo $arr_data['name']; ?>"
                       value="<?php echo nm_string_form($str_op_value); ?>"<?php echo $str_checked; ?>
                       id="<?php echo $str_id_random; ?>" <?php if (isset($arr_data['disabled'])) {echo $arr_data['disabled'];}; ?> class="nm-radio-button"/> <label
                    for="<?php echo $str_id_random; ?>"><span></span><?php echo $str_value; ?></label>
            <?php
                echo (isset($arr_data['one_by_line']) ? "<br/>" : "");
            }
        }
        else
        {
            $str_id_random = nm_id_random('rad_' . $arr_data['name']);
            $str_checked = ' checked="checked" ';
            $str_OnClick = ' onClick="nmiCheckToggle(this);';
            if ('' != $arr_data['on_click']) {
                $str_OnClick .= $arr_data['on_click'];
                $debug = $arr_data['on_click'];
            }
            $str_OnClick .= '"';
            $label = '';
            if ($arr_data['value'] == 'S') {
                $value = 'S';
                $icheck_class = 'icheck-checked';
                $label = "&#10004";
//                $label = nm_get_text_lang("['option_yes']");
            } else {
                $value = 'N';
                $icheck_class = '';
//                $label = nm_get_text_lang("['option_no']");
            }
        ?>
            <style>
                .icheck {
                    border-color: #d1dde2!important;
                    background-color: #eff3f5!important;
                }

                .icheck.icheck-checked {
                    border-color: #1fb6ff!important;
                    box-shadow: #1fb6ff 0px 0px 0px 16px inset!important;
                    background-color: #1fb6ff!important;
                    transition: border 0.4s, box-shadow 0.4s, background-color 1.2s!important;
                    border-color: #1fb6ff!important;
                }

                .icheck.disabled {
                    opacity: 0.3;
                }
            </style>
            <input class="sc_icheck" type="radio" name="<?=$arr_data['name'];?>" value="<?=$value;?>"<?=$str_checked;?> id="<?=$str_id_random;?>" />
            <span name="check_<?=$arr_data['name'];?>"  id="check_<?=$arr_data['name'];?>" class="icheck <?=$icheck_class;?> <?php if (isset($arr_data['disabled'])) {echo $arr_data['disabled'];}; ?>" <?=$str_OnClick;?>><small class="jack"></small><span class="infolabel"><?=$label;?></span></span>
            <?php
                /** em Desenv onclick Show **/
                if ($nm_config['em_desenv'] && isset($debug) && !empty($debug)) {
                    echo "<p style='color:red; white-space: pre-wrap; word-wrap: normal; word-break: break-all; max-width: 400px;'>".$debug."</p>";
                }
                /** em Desenv onclick Show **/
        }
        if (isset($arr_data['disabled']) && 'disabled' == $arr_data['disabled']) {
?>
<script type="text/javascript">
$(function() {
    nmCheckboxDisable('<?=$arr_data['name'];?>')
});
</script>
<?php
        }
?>
    </td>
    <td class="<?php echo $str_class; ?>" style="text-align: right; vertical-align: top;">&nbsp;</td>
    <td class="nmLineDesc" style="text-align: left; vertical-align: top"><?php echo $arr_data['desc']; ?><span
            id="id_obs_<?php echo $arr_data['name']; ?>"<?php echo $arr_data['tr_display']; ?>><?php echo $arr_data['tr_obs']; ?></span>
    </td>
</tr>
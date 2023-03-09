<?php
$arr_data  = $this->GetVar('field_data');
$upgrade_no_permission  = isset($arr_data['upgrade_no_permission'])? $arr_data['upgrade_no_permission'] : false;
$label_new_opt  = isset($arr_data['label_new_opt'])? $arr_data['label_new_opt'] : false;
$str_class = (isset($arr_data['error']) && $arr_data['error'])           ? 'nmErrorMsg' : (isset($arr_data['class'])?$arr_data['class']:"");
$str_mult  = ('N' == $arr_data['multiple']) ? ''           : ' multiple="multiple"';
/* PHP 8.0
$new_opt            = ($arr_data['new_options']) ?: [];
$unavailable_opt    = ($arr_data['unavailable_options']) ?: [];  */
$new_opt            = (isset($arr_data['new_options']) && $arr_data['new_options']) ?$arr_data['new_options']: [];
$unavailable_opt    = (isset($arr_data['unavailable_options']) && $arr_data['unavailable_options']) ?$arr_data['unavailable_options']: [];
if(!is_array($new_opt))
{
    $new_opt = [$new_opt];
}
if(!is_array($unavailable_opt))
{
    $unavailable_opt = [$unavailable_opt];
}
/*------*/

$changeEvt = $nm_config['form_modif2'] . '; ' . $arr_data['on_change'];
if (!empty($unavailable_opt)) {
    $changeEvt = $nm_config['form_modif2'] . '; check_permission_select(this, function(e) { ' . $arr_data['on_change'] . ' })';
}
?>
 <tr class="nmTrAttr nmTrHover <?php echo isset($arr_data['tr_class']) ? $arr_data['tr_class'] : ''; ?>" id="id_tr_<?php echo $arr_data['name']; ?>" <?php echo (isset($arr_data['tr_style'])?$arr_data['tr_style']:""); ?>>
  <td class="nmAttrTitle <?php echo $str_class; ?>" style="text-align: right; vertical-align: top; ">
      <?php echo $arr_data['title']; ?>
      <a name="anchor_<?php echo $arr_data['name']; ?>"></a>
      <?php if ($upgrade_no_permission) {?>
        <small class="upgradeOnlyInfo"><?php echo nm_get_text_lang("['upgrade_only_feature']"); ?></small>
      <?php } else if ($label_new_opt) { ?>
          <span class="field-new-sticker"><?php echo nm_get_text_lang("['menu_new_label']", 'Menu'); ?></span>
      <?php } ?>
  </td>
  <td class="<?php echo $str_class; ?>" style="text-align: right; vertical-align: top;">&nbsp;</td>
  <td class="nmAttrValue <?php echo $str_class; ?>" style="text-align: left; vertical-align: top" id="id_td_obj_<?php echo $arr_data['name']; ?>">

  <?php

  if (!in_array($_SESSION['nm_session']['app']['type'], array(NM_APP_TYPE_MENU, NM_APP_TYPE_MENUTREE, NM_APP_TYPE_TABBED, NM_APP_TYPE_BLANK)) &&
      isset($arr_data['msg_conn_not_exist']) && $arr_data['msg_conn_not_exist'] == 'S')
  {
  ?>
  <script language="javascript">
  	setTimeout(function (){parent.ConnNotExist();}, 100);
  </script>
  <?php
  }
  ?>

  <span id="span_sel_<?php echo $arr_data['name']; ?>">
  <?php if ($upgrade_no_permission) {?>
    <input type="hidden" name="<?php echo $arr_data['name']; ?>"  value="<?php echo $arr_data['value']; ?>"/>
  <?php }?>
  <select
          name="<?php echo $arr_data['name']; ?>"
          id="id_<?php echo $arr_data['name']; ?>"
          size="<?php echo $arr_data['size']; ?>"<?php echo $str_mult; ?>
          class="nmInput <?php if ($upgrade_no_permission) {echo 'upgradeDisabled';}; ?>"
          onChange="<?php echo $changeEvt; ?>"
      <?php
      if (isset($arr_data['disabled'])) {
          echo $arr_data['disabled'];
      };
      ?>
      <?php
      if ($upgrade_no_permission) {
          echo ' disabled';
      }; ?>>

<?php
foreach ($arr_data['options'] as $str_option => $str_value)
{
    $str_op_value = ('I' == $arr_data['op_value']) ? $str_option : $str_value;
    $optionStatus = ' option-status="" ';
	$str_selected = '';
	$exibir = (isset($arr_data['opt_visible'][$str_op_value]) && !$arr_data['opt_visible'][$str_op_value]) ? " style='display:none' " : "";
	if(empty($exibir))
	{
	    if ('IG' == $arr_data['val_mode'])
	    {
	        $str_selected = ($arr_data['value'] == $str_op_value) ? ' selected="selected"' : '';
	    }
	    else
	    {
	        $str_selected = ($arr_data['value'] === $str_op_value) ? ' selected="selected"' : '';
	    }
	}

    $style_opt = (isset($arr_data['mark_value'])  && in_array($str_op_value,$arr_data['mark_value'])? "style='background-color: #28ab5f;color: white;'" : '');
    if (in_array($str_op_value, $unavailable_opt)) {
        $style_opt = ' style="color: #008000;" ';
        $optionStatus = ' option-status="unavailableOption" ';
        $str_selected = '';
    } elseif (in_array($str_op_value, $new_opt)) {
        $style_opt = ' style="color: #008000;" ';
    }

?>
    <option <?php echo $exibir; ?> <?php  echo $style_opt;  ?> <?php  echo $optionStatus;  ?> id="opt_<?php echo $arr_data['name']; ?>_<?php echo nm_string_form($str_op_value); ?>" value="<?php echo nm_string_form($str_op_value); ?>"<?php echo $str_selected; ?>><?php echo $str_value; ?></option>
<?php
}
?>
   </select><?php echo (isset($arr_data['link_icon'])?$arr_data['link_icon']:""); ?>
  </span>
  </td>
  <td class="<?php echo $str_class; ?>" style="text-align: right; vertical-align: top;">&nbsp;</td>
  <td class="nmLineDesc" style="text-align: left; vertical-align: top"><span id='id_desc_<?php echo $arr_data['name']; ?>'><?php echo (isset($arr_data['desc'])?$arr_data['desc']:""); ?></span><span id="id_obs_<?php echo $arr_data['name']; ?>"<?php echo (isset($arr_data['tr_display'])?$arr_data['tr_display']:""); ?>><?php echo (isset($arr_data['tr_obs'])?$arr_data['tr_obs']:""); ?></span></td>
 </tr>
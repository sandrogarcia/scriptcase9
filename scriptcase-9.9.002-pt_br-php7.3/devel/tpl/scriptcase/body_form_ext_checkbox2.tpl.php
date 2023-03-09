<?php
$arr_data  = $this->GetVar('field_data');
$str_class = ($arr_data['error']) ? 'nmErrorMsg' : $arr_data['class'];
$cols_chk  = $arr_data['cols_chk'];
$td_width  = round(100 / $cols_chk, 2) . "%";
$label_new_opt  = isset($arr_data['label_new_opt'])? $arr_data['label_new_opt'] : false;
$upgrade_no_permission  = isset($arr_data['upgrade_no_permission'])? $arr_data['upgrade_no_permission'] : false;
?>
 <tr class="nmTrAttr nmTrHover" id="id_tr_<?php echo $arr_data['name']; ?>" <?php echo $arr_data['tr_style']; ?>>
  <td class="nmAttrTitle <?php echo $str_class; ?>" style="text-align: right; vertical-align: top">
      <?php echo $arr_data['title']; ?>
      <a name="anchor_<?php echo $arr_data['name']; ?>"></a>
      <?php if ($upgrade_no_permission) {?>
          <small class="upgradeOnlyInfo"><?php echo nm_get_text_lang("['upgrade_only_feature']"); ?></small>
      <?php } else if ($label_new_opt) { ?>
          <span class="field-new-sticker"><?php echo nm_get_text_lang("['menu_new_label']", 'Menu'); ?></span>
      <?php } ?>
  </td>
  <td class="<?php echo $str_class; ?>" style="text-align: right; vertical-align: top;">&nbsp;</td>
  <td class="<?php echo $str_class; ?>" style="text-align: left; vertical-align: top; white-space: nowrap">
  <table width="100%">
<?php

$i = 0;
foreach ($arr_data['checkboxes'] as $str_file => $checked)
{
	$str_checked = ($checked['checked']) ? ' checked' : '';
	$str_id_random = $arr_data['name'] . "_" . $str_file;
	$str_label = (isset($checked['label']) && trim($checked['label']) != '') ? $checked['label'] : $str_file;
	$str_onclick = (isset($checked['on_click']) && trim($checked['on_click']) != '') ? ' onclick="'.$checked['on_click'].'" ' : '';
	$str_disabled = (isset($checked['disabled']) && $checked['disabled']) ? ' disabled ' : '';
	$str_tit_boll_red = (isset($checked['tit_boll_red'])) ? $checked['tit_boll_red'] : '';
	$str_tit_boll_green = (isset($checked['tit_boll_green'])) ? $checked['tit_boll_green'] : '';
	$str_vis_boll_red = (isset($checked['vis_boll_red'])) ? $checked['vis_boll_red'] : 'none';
	$str_vis_boll_green = (isset($checked['vis_boll_green'])) ? $checked['vis_boll_green'] : 'none';

	if ($i == 0)
	{
?>
	<tr>
<?php
	}
	$i++
?>
	<td width="20px">
   		<input type="checkbox" <?php echo $str_disabled . $str_onclick; ?> name="<?php echo $arr_data['name']; ?>[]" value="<?php echo $str_file; ?>"<?php echo $str_checked; ?>  id="<?php echo $str_id_random; ?>" />
   	</td>
	<td valign="middle"  width="12px">
		<img style="display:<?php echo $str_vis_boll_red; ?>"   title='<?php echo $str_tit_boll_red; ?>' src='<?php echo $nm_config['url_img']; ?>boll_red.png' border='0'/>
		<img style="display:<?php echo $str_vis_boll_green; ?>" title='<?php echo $str_tit_boll_green; ?>' src='<?php echo $nm_config['url_img']; ?>boll_green.png' border='0'/>
	</td>
   	<td>
	    <span class="nmText">
	   		<label for="<?php echo $str_id_random; ?>" title="<?php echo nm_string_form($checked['hint']); ?>" ><?php echo $str_label; ?></label>
	    </span>
	</td>
<?php
	if ($i == $cols_chk)
	{
		$i = 0;
?>
	</tr>
<?php
	}
}

if ($i != $cols_chk)
{
?>
	</tr>
<?php
}
?>
    </table>

  <?php
  if (isset($arr_data['check_all']) && $arr_data['check_all'])
  {
      ?>
      <table><tr><td style="font-size:3px">&nbsp;</td></tr></table>
      <img title="<?php echo nm_get_text_lang("['check_all']"); ?>" style="cursor:pointer" src="<?php echo $nm_config['url_scriptcase_img']; ?>img_select_all.gif" border="0" onclick="$('input[name=\'<?php echo $arr_data['name']; ?>[]\']').each(function () { this.checked = 'checked'; }); $('.cls_chk_mark').attr('checked', true); <?php echo $nm_config['form_modif2']; ?> " />
      <img title="<?php echo nm_get_text_lang("['uncheck_all']"); ?>" style="cursor:pointer" src="<?php echo $nm_config['url_scriptcase_img']; ?>img_select_none.gif" border="0" onclick="$('input[name=\'<?php echo $arr_data['name']; ?>[]\']').each(function () { this.checked = ''; }); $('.cls_chk_mark').attr('checked', false); <?php echo $nm_config['form_modif2']; ?> "/>
      <table><tr><td style="font-size:3px">&nbsp;</td></tr></table>
      <?php
  }
  ?>

  </td>
  <td class="<?php echo $str_class; ?>" style="text-align: right; vertical-align: top;">&nbsp;</td>
  <td class="nmLineDesc" style="text-align: left; vertical-align: top">
  	<?php
  		echo $arr_data['desc'];

  		if (isset($arr_data['msg_empty_chk']) && trim($arr_data['msg_empty_chk']) != '')
  		{
	  		echo "<br><div style='position:relative'><div class='nmRound6px' style='border:2px solid #C3C3C3; background-color:#FFE2E1;position:absolute; top:10px; left: 0px; width:230px; height:38px'>";
	  		echo " <div style='margin-top: 3px; margin-left:3px'>". $arr_data['msg_empty_chk'] ."</div>";
	  		echo "</div></div>";
  		}
  	?>
  	<span id="id_obs_<?php echo $arr_data['name']; ?>"<?php echo $arr_data['tr_display']; ?>><?php echo $arr_data['tr_obs']; ?></span></td>
 </tr>
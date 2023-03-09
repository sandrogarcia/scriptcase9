<?php
$arr_data   = $this->GetVar('field_data');
$str_class  = ($arr_data['error']) ? 'nmErrorMsg' : $arr_data['class'];
$expand     = (isset($arr_data['colspan']) && $arr_data['colspan'] == 5);
?>
<tr id="id_tr_<?php echo $arr_data['name']; ?>" <?php echo $arr_data['tr_style']; ?>>
  <?php if(!$arr_data['no_title']) { ?>
  <td class="<?php echo $str_class; ?>" style="text-align: right; vertical-align: top">
	<span id='id_title_<?php echo $arr_data['name']; ?>'><?php echo $arr_data['title']; ?></span>
	<a name="anchor_<?php echo $arr_data['name']; ?>"></a>
  </td>
  <?php } else { ?>
    <td></td>
  <?php }?>
  <td class="<?php echo $str_class; ?>" style="text-align: right; vertical-align: top;">&nbsp;</td>

  <td class="<?php echo $str_class; ?>" style="text-align: left; vertical-align: top; white-space: nowrap">
  <?php
  	foreach ($arr_data['checkboxes'] as $str_file => $checked)
	{
	    $str_checked = ($checked['checked']) ? ' checked' : '';
	    $str_id_random = $arr_data['name'] . "_" . $str_file;
	    $str_label = (isset($checked['label']) && trim($checked['label']) != '') ? $checked['label'] : $str_file;
	    $str_onclick = (isset($checked['on_click']) && trim($checked['on_click']) != '') ? ' onclick="'.$checked['on_click'].'" ' : '';
	    $str_disabled = (isset($checked['disabled']) && $checked['disabled']) ? ' disabled ' : '';
	    ?>
		<input class="cls_chk_mark" type="checkbox" <?php echo $str_disabled . $str_onclick; ?> name="<?php echo $arr_data['name']; ?>[]" value="<?php echo $str_file; ?>"<?php echo $str_checked; ?>  id="<?php echo $str_id_random; ?>" />
		<label for="<?php echo $str_id_random; ?>" title="<?php echo nm_string_form($checked['hint']); ?>" ><?php echo $str_label; ?></label>
	    <?php
	}
  	?>
  </td>
    <td class="<?php echo $str_class; ?>" style="text-align: right; vertical-align: top;">&nbsp;</td>

  <td class="nmLineDesc" style="text-align: left; vertical-align: top">
	<span id='id_desc_<?php echo $arr_data['name']; ?>'><?php echo $arr_data['desc']; ?></span>
	<span id="id_obs_<?php echo $arr_data['name']; ?>"<?php echo $arr_data['tr_display']; ?>><?php echo $arr_data['tr_obs']; ?></span>
  </td>
 </tr>
<?php
$arr_data  = $this->GetVar('field_data');
$str_class = ($arr_data['error']) ? 'nmErrorMsg' : $arr_data['class'];
$cols_chk  = $arr_data['cols_chk'];
$td_width  = round(100 / $cols_chk, 2) . "%";

?>
 <tr id="id_tr_<?php echo $arr_data['name']; ?>">
  <td colspan="5" class="<?php echo $str_class; ?>" style="text-align: left; vertical-align: top; white-space: nowrap">
<?php

	if (count($arr_data['checkboxes']) > 0)
	{

?>
  <table width="100%">
<?php

	$i = 0;
	foreach ($arr_data['checkboxes'] as $str_file => $checked)
	{
		$str_checked = ($checked['checked']) ? ' checked' : '';
		$str_id_random = nm_id_random('rad_' . $arr_data['name']);

		if ($i == 0)
		{
?>
	<tr>
<?php
		}
		$i++;
		if (isset($checked['value']))
		{
			$str_value = $checked['value'];
		}
		else
		{
			$str_value = $str_file;
		}

?>
	<td width="<?php echo $td_width; ?>">
	    <span class="nmText">
   		    <input type="checkbox" name="<?php echo $arr_data['name']; ?>[]" value="<?php echo $str_file; ?>"<?php echo $str_checked; ?>  id="<?php echo $str_id_random; ?>" onclick="<?php echo $nm_config['form_modif2']; ?>" /> <label for="<?php echo (isset($arr_data['chk_not_label_click']) && $arr_data['chk_not_label_click']) ? '' : $str_id_random; ?>" title="<?php echo nm_string_form($checked['hint']); ?>" ><?php echo $str_value; ?></label>
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
}
else
{
	if (isset($arr_data['msg_without_itens']))
	{
		echo $arr_data['msg_without_itens'];
	}
}
?>
  </td>
 </tr>
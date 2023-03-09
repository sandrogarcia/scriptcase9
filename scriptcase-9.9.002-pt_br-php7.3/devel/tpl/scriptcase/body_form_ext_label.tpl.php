<?php
$arr_data  = $this->GetVar('field_data');
$str_class = ($arr_data['error']) ? 'nmErrorMsg' : $arr_data['class'];
?>
 <tr class="nmTrAttr nmTrHover" id="id_tr_<?php echo $arr_data['name']; ?>"<?php echo $arr_data['tr_display']; ?>>
  <td class="nmAttrTitle <?php echo $str_class; ?>" style="text-align: right; vertical-align: top"><?php echo $arr_data['title']; ?><a name="anchor_<?php echo $arr_data['name']; ?>"></a></td>
  <td class="<?php echo $str_class; ?>" style="text-align: right; vertical-align: top;">&nbsp;</td>
  <td class="nmAttrValue <?php echo $str_class; ?>" style="text-align: left; vertical-align: top"><?php echo $arr_data['value']; ?></td>
  <td class="<?php echo $str_class; ?>" style="text-align: right; vertical-align: top;">&nbsp;</td>
  <td class="nmLineDesc" style="text-align: left; vertical-align: top"><?php echo $arr_data['desc']; ?></td>
 </tr>
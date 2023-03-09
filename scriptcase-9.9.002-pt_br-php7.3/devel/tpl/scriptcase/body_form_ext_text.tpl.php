<?php
$arr_data  = $this->GetVar('field_data');
$str_class = ($arr_data['error']) ? 'nmErrorMsg' : $arr_data['class'];
/* PHP 8.0
$language_translated = ($arr_data['language-translated'] === true) ? 'language-translated' : '';    */
$language_translated = (isset($arr_data['language-translated']) && $arr_data['language-translated'] === true) ? 'language-translated' : '';
/*------*/
$str_style = (isset($arr_data['jstype']) && in_array($arr_data['jstype'], array('numeroedt', 'numeroedtvg', 'valor', 'valorvg'))) ? ' style="text-align: right"' : '';
$str_min   = (isset($arr_data['minimal']) && '' != $arr_data['minimal']) ? ', ' . $arr_data['minimal'] : '';
$upgrade_no_permission  = isset($arr_data['upgrade_no_permission'])? $arr_data['upgrade_no_permission'] : false;
$label_new_opt  = isset($arr_data['label_new_opt'])? $arr_data['label_new_opt'] : false;
if(!isset($arr_data['on_focus']))
{
    $arr_data['on_focus'] = '';
}
/* PHP 8.0 */
if(!isset($arr_data['size'])) {
    $arr_data['size'] = '';
}
/*------*/
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
  	<input type="text" id="id_<?php echo $arr_data['name']; ?>" <?php echo (isset($arr_data['length']) && $arr_data['length'] > 0) ? "maxlength='".$arr_data['length']."'" : ''; ?> name="<?php echo $arr_data['name']; ?>" <?php if (isset($arr_data['disabled']) || $upgrade_no_permission) {echo 'disabled'/*$arr_data['disabled']*/;}; ?> value="<?php echo nm_string_form($arr_data['value']); ?>" size="<?php echo $arr_data['size']; ?>" class="nmInput"<?php echo $str_style; ?> onChange="<?php echo $nm_config['form_modif2'] . $arr_data['on_change']; ?>" onFocus="<?php echo $arr_data['on_focus']; ?>" <?php echo $language_translated; ?> />
  	<?php echo $arr_data['link_icon']; ?>
	<?php
		if (isset($arr_data['hid_extra']) && $arr_data['hid_extra'])
		{
		?>
			<input type="hidden"  name="hid_<?php echo $arr_data['name']; ?>_extra" id="hid_<?php echo $arr_data['name']; ?>_extra" value="<?php echo nm_string_form($arr_data['value']); ?>" />
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
<?php
$arr_data   = $this->GetVar('field_data');
$str_class  = isset($arr_data['error']) ? 'nmErrorMsg' : ($arr_data['class']?? '');
$height_div = isset($arr_data['height_div']) ? $arr_data['height_div'] : "100";
$prestyled = isset($arr_data['prestyled']) ? $arr_data['prestyled'] : true;
$use_bg = isset($arr_data['use_bg']) ? $arr_data['use_bg'] : false;
$expand     = (isset($arr_data['colspan']) && $arr_data['colspan'] == 5);
$addDisabled  = $this->GetVar("addDisabled");
?>

 <tr class="nmTrAttr nmTrHover" id="id_tr_<?php echo $arr_data['name']; ?>" <?php echo $arr_data['tr_style'] ?? ''; ?>>
 <?php
  if ($expand)
  {
  ?>
	<td class="nmAttrTitle" colspan="5">
		<center>
		    <table><tr><td style="font-size:3px">&nbsp;</td></tr></table>
			<table>
			<tr>
			<td align="left">
		    <?php if (count($arr_data['checkboxes']) > 4) {echo "<div style='height:". $height_div ."px; width:250px; overflow:auto; border:1px solid #7f9db9'>";} ?>
			<table>
  <?php
  }
  else
  {
 ?>
  <td class="<?php echo $str_class; ?>" style="text-align: right; vertical-align: top;<?php echo isset($arr_data['noTitle']) && $arr_data['noTitle']? "display:none;" : '' ?>"><?php echo $arr_data['title']; ?><a name="anchor_<?php echo $arr_data['name']; ?>"></a></td>
  <td class="<?php echo $str_class; ?>" style="text-align: right; vertical-align: top;">&nbsp;</td>
  <td class="<?php echo $str_class; ?>" style="text-align: left; vertical-align: top; white-space: nowrap">
  <?php echo ($prestyled) ? "<div style='height:". $height_div ."px; width:220px; overflow:auto; border:1px solid #7f9db9'>" : "<div style='height:". $height_div ."px; width:220px;'>"; ?>
  <table width="100%">
 <?php
  }


if(isset($arr_data['checkboxes']) && is_array($arr_data['checkboxes']))
{
    foreach ($arr_data['checkboxes'] as $str_file => $checked)
    {
        $str_checked = ($checked['checked']) ? ' checked' : '';
        $str_id_random = $arr_data['name'] . "_" . $str_file;
        $str_label = (isset($checked['label']) && trim($checked['label']) != '') ? $checked['label'] : $str_file;
        $str_onclick = ' onclick="' . $nm_config['form_modif2'] . '; ';
        $str_onclick .= (isset($checked['on_click']) && trim($checked['on_click']) != '') ? str_replace('"', '\'', $checked['on_click']) . ';" ' : '" ';
        $str_disabled = (isset($checked['disabled']) && $checked['disabled']) ? ' disabled ' : '';
        $str_disabled .= $addDisabled;

    ?>
        <tr>
            <td>
                <div style="display: flex; margin: 2px 20px 2px 2px">
                    <input class="cls_chk_mark chk_new" type="checkbox" <?php echo $str_disabled . $str_onclick; ?> name="<?php echo $arr_data['name']; ?>[]" value="<?php echo $str_file; ?>"<?php echo $str_checked; ?>  id="<?php echo $str_id_random; ?>" />

                    <label class="chk_new <?php echo ($use_bg) ? '' : 'no-bg'; ?>" for="<?php echo $str_id_random; ?>" title="<?php echo nm_string_form($checked['hint']); ?>" ><?php echo $str_label; ?></label>
                </div>
            </td>
        </tr>
    <?php
    }
}
?>
    </table>
    <?php echo "</div>"; ?>

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


 <?php
  if ($expand)
  {
  ?>
 	</td>
 	</tr>
 	</table>
  </td>
  <?php
  }
  else
  {
  ?>
  </td>
  <td class="<?php echo $str_class; ?>" style="text-align: right; vertical-align: top;">&nbsp;</td>
  <td class="nmLineDesc" style="text-align: left; vertical-align: top">
  	<?php
  		echo $arr_data['desc'] ?? '';
  	?>
  	<span id="id_obs_<?php echo $arr_data['name']; ?>"<?php echo (isset($arr_data['tr_display'])?$arr_data['tr_display']:""); ?>><?php echo (isset($arr_data['tr_obs']) ? $arr_data['tr_obs'] : ""); ?></span></td>
  <?php
  }
  ?>
 </tr>
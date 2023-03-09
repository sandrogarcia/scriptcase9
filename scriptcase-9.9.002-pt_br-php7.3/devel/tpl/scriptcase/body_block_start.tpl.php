<?php
$str_id                 = $this->GetVar('block_id_link');
$str_block				= $this->GetVar('block');
$str_block_name         = $this->GetVar('block_name');
if(empty($str_block_name))
{
    $str_block_name = "";
}
$str_block_status       = $this->GetVar('block_status');
$str_block_status_ini   = $this->GetVar('block_status_ini');
$table_height           = ($this->GetVar('block_table_height') != '') ? 'height: ' . $this->GetVar('block_table_height') : '';
$str_display_block      = $this->GetVar('str_display_block');
if ($str_id)
{
    $str_label_ini = <<<EOT
    <label onclick="nm_toggle_table(this, '{$str_id}');" id_for='{$str_id}' for='{$str_id}' style='cursor:pointer;' class=''>
    <img id="id_img_block_{$str_id}" src="{$nm_config['url_scriptcase_img']}img_contract.png" />
    <span id='span_tit_{$str_block}'>
EOT;
    $str_label_end = "</span></label>";
}
else
{
    $str_label_ini = '';
    $str_label_end = '';
}


if ((null != $str_block_name) && (null != $str_block_status))
{
?>
<input type="hidden" name="<?php echo $str_block_name; ?>" value="<?php echo $str_block_status; ?>" />
<input type="hidden" name="ini_<?php echo $str_block_name; ?>" value="<?php echo $str_block_status_ini; ?>" />
<?php
}

?>

<script>
    function nm_toggle_table(t, id)
    {
        if($(t).hasClass('expand'))
        {
            $('.form_tab_'+id).show();
            $('#id_img_block_'+id).attr('src', "<?php echo $nm_config['url_scriptcase_img']; ?>img_contract.png");

        }
        else
        {
            $('.form_tab_'+id).hide();
            $('#id_img_block_'+id).attr('src', "<?php echo $nm_config['url_scriptcase_img']; ?>img_expand.png");

        }
        $(t).toggleClass('expand');
    }

    <?php  if(isset($_REQUEST['field_app_section']) && $_REQUEST['field_app_section'] === 'FieldsEditionDef') { //fix pra "edição de campo" em Formulario.
                echo "$(function() { var width = ($('body').width() > $('#tb_block').width() ? $('body').width() : $('#tb_block').width()+5);";
                echo "$('#". md5($str_block_name) ."_form_tab_block').width(width); });";
    } ?>
</script>
<div class="nmTableWrap" style="display:<?php echo $str_display_block; ?>" id="id_div_<?php echo md5($str_block_name); ?>">
    <table class="nmTableStyled nmTableTitleStyled <?php echo $str_block_name; ?>_block" id="<?php echo md5($str_block_name); ?>_form_tab_block" cellpadding="0" cellspacing="0" style="border-collapse: collapse;width: 100%;padding: 0px 0px 0px 3px;" valign="middle">
        <tr class="nmBlockTitle nmBlockTitleStyled">
            <td style="text-align: left;" class='nmTitle'>
                <span class="nmTextTitle">
                    <?php echo $str_label_ini .  $this->GetVar('block_title') . $str_label_end; ?>
                </span>
            </td>

            <td style="text-align: right" class='nmTitle nmBlockTitleHelp'>
                <?php echo $this->GetVar('block_image_help'); ?>
            </td>
        </tr>
    </table>

    <table id="form_tab_<?php echo $str_block_name; ?>" cellpadding="0" cellspacing="0" class="nmTable nmTableStyled form_tab_<?php echo $str_id; ?>" style="width: 100%;<?php echo $table_height; ?>">
    <?php
    if ( !empty($this->GetVar('block_info_message')) || !empty($this->GetVar('block_danger_message')) || !empty($this->GetVar('block_sucess_message')) || !empty($this->GetVar('block_warning_message')) ) { ?>
    <tr class="nmTrAttrWarn" id='id_tr_message_<?php echo $this->GetVar('block_type'); ?>'>
        <?php
          if (!empty($this->GetVar('block_info_message'))) {
              echo '<td colspan="6" class="info-message"><span>' . $this->GetVar('block_info_message') . '</span></td>';
          } else if (!empty($this->GetVar('block_danger_message'))) {
              echo '<td colspan="6" class="danger-message"><span>' . $this->GetVar('block_danger_message') . '</span></td>';
          } else if (!empty($this->GetVar('block_sucess_message'))) {
              echo '<td colspan="6" class="success-message"><span>' . $this->GetVar('block_sucess_message') . '</span></td>';
          } else if (!empty($this->GetVar('block_warning_message'))) {
              echo '<td colspan="6" class="warning-message"><span>' . $this->GetVar('block_warning_message') . '</span></td>';
          }
        ?>
     </tr>
     <?php } ?>
<?php

$buttonName = $this->GetVar('button_name');
$linkOption = $this->GetVar('link_option');

?>
<form id='link_button' action='<?php echo $nm_config['url_iface'];?>app_link2.php' method='POST' >
    <input type='hidden' name='link_step' value='links'/>
    <input type='hidden' name='link_option' value='<?php echo $linkOption; ?>'/>
    <input type='hidden' name='link_ed_id' value='actbtn_<?php echo $buttonName; ?>'/>
    <input type='hidden' name='link_ed_type' value='action_button'/>
    <input type='hidden' name='hid_flag_link_prop_save' value='S'/>
    <input type='hidden' name='link_ed_field' value='edit'/>
    <input type='hidden' name='form_link' value='<?php echo $nm_config['form_valid']; ?>'/>
    <input type='hidden' name='has_prev_step' value='S'/>
</form>
<script type="text/javascript">
    $(function() {
        $("#link_button").submit();
    });
</script>

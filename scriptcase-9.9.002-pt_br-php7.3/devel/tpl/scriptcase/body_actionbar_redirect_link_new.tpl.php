<?php

$buttonName = $this->GetVar('button_name');

?>
<form id='link_button' action='<?php echo $nm_config['url_iface'];?>app_link2.php' method='POST' >
    <input type='hidden' name='button_name' value='<?php echo $buttonName; ?>'/>
    <input type='hidden' name='link_type' value='action_button'/>
    <input type='hidden' name='return' value='<?php echo $nm_config['url_iface'];?>button.php'/>
    <input type='hidden' name='link_step' value='type'/>
    <input type='hidden' name='link_option' value='forward'/>
    <input type='hidden' name='form_link' value='<?php echo $nm_config['form_valid']; ?>'/>
    <input type='hidden' name='link_id' value='actbtn_<?php echo $buttonName; ?>'/>
</form>
<script type="text/javascript">
$(function() {
    $("#link_button").submit();
});
</script>

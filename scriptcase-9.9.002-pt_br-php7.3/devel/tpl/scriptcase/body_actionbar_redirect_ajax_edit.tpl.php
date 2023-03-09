<?php

$eventNome = $this->GetVar('event_name');

?>
<form id="event_edit" name="form_event_edit" action="<?php echo nm_url_rand($nm_config['url_iface'] . 'event.php'); ?>" target="nmFrmRight_<?php echo $_SESSION['nm_session']['control_abas']['frm_atual']; ?>" method="POST">
    <input type="hidden" name="event_tipo" value="A" />
    <input type="hidden" name="event_nome" value="<?php echo $eventNome; ?>" />
    <input type="hidden" name="event_title" value="" />
    <input type="hidden" name="form_option" value="" />
    <input type="hidden" name="form_fld_edit" value="<?php echo $nm_config['form_valid']; ?>" />
</form>
<script type="text/javascript">
    $(function() {
        $("#event_edit").submit();
    });
</script>

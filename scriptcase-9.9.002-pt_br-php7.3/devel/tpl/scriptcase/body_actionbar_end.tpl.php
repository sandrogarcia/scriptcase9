<?php

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}

$displayedButtons = $this->GetVar('displayed_buttons');
$saveFunction = $this->GetVar('save_function');
$help_link = $this->GetVar('str_js_help');

if (!$nm_config['flag_versao']['actiobar_grid']['has']) {
    $displayedButtons = array();
}

if ('' != $saveFunction) {
?>
<script>
$(function() {
    actionbarSaveFunction = <?php echo $saveFunction; ?>;
});
</script>
<?php
}

?>
    <div id="actions" class="actions-bar">
        <div class="ui container">
            <div class="ui grid">
                <div class="centered fifteen wide column textAlign-left">
<?php
if (in_array('buttonGeneralNew', $displayedButtons)) {
?>
                    <input type="button" value="<?php echo nm_get_text_lang("['actionbar_button_create']"); ?>" class="ui button primary" onClick="scActionBarClick_buttonGeneralNew()" />
<?php
}
if (in_array('buttonBarVisual', $displayedButtons)) {
?>
                    <input type="button" value="<?php echo nm_get_text_lang("['actionbar_bar_visual']"); ?>" class="ui button" onClick="scActionBarClick_buttonBarVisual()" />
<?php
}
if (in_array('buttonGeneralSave', $displayedButtons)) {
?>
                    <input type="button" value="<?php echo nm_get_text_lang("['btn_save']"); ?>" class="ui button primary" onClick="scActionBarClick_menuSaveList()" />
<?php
}
if (in_array('buttonBarVisualBack', $displayedButtons)) {
?>
                    <input type="button" value="<?php echo nm_get_text_lang("['button_back']"); ?>" class="ui button" onClick="scActionBarClick_buttonBarVisualBack()" />
<?php
}
if (in_array('buttonBarVisualSave', $displayedButtons)) {
?>
                    <input type="button" value="<?php echo nm_get_text_lang("['btn_save']"); ?>" class="ui button primary" onClick="scActionBarClick_buttonBarVisualSave()" />
<?php
}
if (in_array('buttonGeneralBack', $displayedButtons)) {
?>
                    <input type="button" value="<?php echo nm_get_text_lang("['button_back']"); ?>" class="ui button" onClick="scActionBarClick_buttonGeneralBack()" />
<?php
}
if (in_array('buttonGeneralNext', $displayedButtons)) {
?>
                    <input type="button" value="<?php echo nm_get_text_lang("['button_forward']"); ?>" class="ui button primary" onClick="scActionBarClick_buttonGeneralNext()" />
<?php
}
if (in_array('buttonVisualBackNext', $displayedButtons)) {
?>
                    <input type="button" value="<?php echo nm_get_text_lang("['button_back']"); ?>" class="ui button" onClick="scActionBarClick_buttonVisualBackNext()" />
<?php
}
if (in_array('buttonVisualNextLink', $displayedButtons)) {
?>
                    <input type="button" value="<?php echo nm_get_text_lang("['actionbar_button_save_link']"); ?>" class="ui button primary" onClick="scActionBarClick_buttonVisualNextLink()" />
<?php
}
if (in_array('buttonVisualNextAjax', $displayedButtons)) {
?>
                    <input type="button" value="<?php echo nm_get_text_lang("['actionbar_button_save_ajax']"); ?>" class="ui button primary" onClick="scActionBarClick_buttonVisualNextAjax()" />
<?php
}
if (in_array('buttonVisualBackEdit', $displayedButtons)) {
?>
                    <input type="button" value="<?php echo nm_get_text_lang("['button_back']"); ?>" class="ui button" onClick="scActionBarClick_buttonVisualBackEdit()" />
<?php
}
if (in_array('buttonVisualSave', $displayedButtons)) {
?>
                    <input type="button" value="<?php echo nm_get_text_lang("['btn_save']"); ?>" class="ui button primary" onClick="scActionBarClick_buttonVisualSave()" />
<?php
}
?>


                    <?php
                    if($help_link != '')
                    {
                        ?>

                        <input type="button" style="float: right;" value="<?php echo nm_get_text_lang("['button_help']"); ?>" class="ui button" onClick="nm_window_manual('<?php echo $help_link; ?>');" />
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>
</form>
<div class="scroll-spacer"></div>
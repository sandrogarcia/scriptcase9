<?php

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}

$hiddenFields = $this->GetVar('form_hidden');
$actionBarStep = $this->GetVar('actionbar_step');

?>
<style>
    form {
        margin: 0;
        padding: 5px;
        min-width: 1100px;
        box-sizing: border-box;
        position: relative;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        justify-items: center;
    }
    .actions-bar {
        height:50px;
        position: fixed;
        bottom:0;
        left:0;
        width:100%;
        border-top:1px solid #D4D5D6;
        background:#F3F4F5;
        padding:7px 0;
        z-index: 10;
    }
    body {
        margin: 0 !important;
        padding: 5px;
        min-width: 1100px;
        box-sizing: border-box;
    }
    body * {
        box-sizing: border-box;
    }
</style>

<form name="form_edit" action="<?php echo nm_url_rand($nm_config['url_iface'] . 'app_actionbar.php'); ?>" method="post">
<input type="hidden" name="form_actionbar" value="Y" />
<input type="hidden" name="step" value="<?php echo $actionBarStep; ?>" id="sc-input-actionbar-step" />
<input type="hidden" name="option" value="save" id="sc-input-actionbar-option" />
<input type="hidden" name="sc_menu_option" value="save" id="sc-input-actionbar-scmenuoption" />
<input type="hidden" name="button_name" value="save" id="sc-input-actionbar-button-name" />

<input type="hidden" name="force_save" value="N" />

<?php

foreach ($hiddenFields as $field => $value) {
?>
<input type="hidden" name="<?php echo $field; ?>" value="<?php echo $value; ?>" />
<?php
}

?>

<div style="padding-bottom: 50px">

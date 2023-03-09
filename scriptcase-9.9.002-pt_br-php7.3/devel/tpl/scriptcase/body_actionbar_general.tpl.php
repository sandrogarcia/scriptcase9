<?php

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}

$buttonLabel = $this->GetVar('button_label');
$buttonType = $this->GetVar('button_type');

?>
<style>
    .sc-button-new-label {
        display: inline-block;
        padding: 5px;
        width: 150px;
    }
    .sc-button-new-data {
        display: inline-block;
        padding: 5px;
        width: 400px;
    }
</style>

<h2 class="ui header"><?php echo nm_get_text_lang("['actionbar_button_data']") ?></h2>
<table class="ui blue structured celled table" style="width: 800px">
    <thead>
    <tr>
        <td class="nmTitle"><?php echo nm_get_text_lang("['actionbar_button_data_inform']") ?></td>
    </tr>
    <tr>
        <td>
            <div>
                <span class="sc-button-new-label">ID</span>
                <span class="sc-button-new-data"><input type="text" class="nmInput" name="button_label" value="<?php echo $buttonLabel; ?>" style="width: 100%" /></span>
            </div>
            <div>
                <span class="sc-button-new-label"><?php echo nm_get_text_lang("['actionbar_type']") ?></span>
                <span class="sc-button-new-data">
                    <select name="button_type" class="nmInput" style="width: 100%">
                        <option value="link" <?php if ('link' == $buttonType) { echo 'selected="selected"'; } ?>><?php echo nm_get_text_lang("['actionbar_option_Link']") ?></option>
                        <option value="ajax" <?php if ('ajax' == $buttonType) { echo 'selected="selected"'; } ?>>Ajax</option>
                    </select>
                </span>
            </div>
        </td>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>

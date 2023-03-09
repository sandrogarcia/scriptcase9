<?php
/**
 * Template scriptcase.
 *
 * Tela para escolha do esquema
 *
 * @package     Template
 * @subpackage  Scriptcase
 * @creation    2004/09/13
 * @copyright   NetMake Solucoes em Informatica
 * @author      Diogo Silva Toscano De Brito <diogo@netmake.com.br>
 *
 * $Id: body_publish_wizard_create_dir.tpl.php,v 1.1.1.1 2011-05-12 20:31:15 diogo Exp $
 */

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}
global $nm_config;
$zip_file = $this->GetVar('zip_file');
$msgzip = nm_get_text_lang("['step_zip']");
?>
<script>
    endBackup = false;
    function tryFindZip()
    {
        $.ajax({
            url: '<?php echo $nm_config['url_js_devel_php']; ?>backupStep.php',
            async: true,
            data: 'ajax=nm&option=read_zip&file=<?php echo $zip_file; ?>',
            success: function (msg)
            {
                if(!endBackup)
                {
                    if(msg != '')
                    {
                        jsonMsg = JSON.parse(msg);

                        if(jsonMsg.msg != "")
                        {
                            $('#id_bkp_message').html("<?php echo $msgzip; ?>: " + jsonMsg.msg);
                        }
                    }
                    setTimeout(function(){

                        tryFindZip();

                    },2000);
                }
            }
        });
    }
    tryFindZip();
</script>
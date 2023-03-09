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


$lang_lib  = nm_get_text_lang("['publishwizard']['prod']");
$lang_prod = nm_get_text_lang("['publishwizard']['connections_prod']");
$lang_zip  = nm_get_text_lang("['publishwizard']['zip_prod_wait']");
$lang_tar  = nm_get_text_lang("['publishwizard']['targz']");
?>
<script>
    arr_lang = {"startedlib":"<?php echo $lang_lib; ?>", "startedprod":"<?php echo $lang_prod; ?>", "startedzip":"<?php echo $lang_zip; ?>", "startedtar":"<?php echo $lang_tar; ?>", };
    endPub = false;
    function tryFindZip()
    {
        $.ajax({
            url: '<?php echo $nm_config['url_js_devel_php']; ?>publishStep.php',
            async: true,
            data: 'ajax=nm&option=read_zip_prod&file=<?php echo $_SESSION['nm_session']['user']['cod_grp'] . '_' . $_SESSION['nm_session']['publishwizard']['tmp_pub_dir']; ?>',
            success: function (msg)
            {
                if(!endPub)
                {
                    if(msg != '')
                    {
                        jsonMsg = JSON.parse(msg);

                        if(jsonMsg.code != "")
                        {
                            $('#msg_pb').html(arr_lang[ jsonMsg.code ] + " " + jsonMsg.msg);
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
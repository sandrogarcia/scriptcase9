<?php
/**
 * Classe Bkp.
 *
 * Classe abstrata com suporte basico do backup.
 *
 * @package     Classes
 * @subpackage  Backup
 * @creation    2015/03/10
 * @copyright   NetMake Solucoes em Informatica
 * @author      Vinícius Muniz <vinicius@netmake.com.br>
 *
 */

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976)) {
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}

class nmBackupGroups extends nmBackup
{
    /**
     * Dados sobre as mudancas realizadas.
     *
     * @access  public
     * @var     array
     */

    var $grp;

    /* ----- Getters & Setters ----------------------------------------- */


    function __construct()
    {
        $this->loadClass();
    }

    function loadClass()
    {
        nm_load_class('interface', 'UserGroups');

        $this->grp = new nmUserGroups();
    }

    function doBackup($grp = '', $user = '')
    {
        if(!empty($user))
        {
            $this->grp->stFiltro = 2;
            $arr_result = $this->grp->ListUsersGroups('', $user, [], true);

            foreach($arr_result as $group_id => $trash) {
                self::doBackup($group_id);
            }
            return;
        }

        $arr_result = $this->grp->LoadBackup($grp);

        foreach($arr_result['grp'] as $k => $data)
        {
            $this->loadDependency($data);
            nmBackupView::message(nm_get_text_lang("['backup_group']") . ' ' . $data['group_name'] );
            nmBackupIO::write('grp/' .$data['groupid']. '.bkp', serialize($data));
        }

        foreach($arr_result['user_grp'] as $k => $data)
        {
            $this->loadDependency($data, 'user_grp');
            nmBackupIO::write('usr_grp/' .$data['groupid'] .'__NM__'. $data['login']. '.bkp', serialize($data));
        }
    }

    function loadDependency($arr_data, $type = '')
    {
        global $nm_config;

    }
}

?>

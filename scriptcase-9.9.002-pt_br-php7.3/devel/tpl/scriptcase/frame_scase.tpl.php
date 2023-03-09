<?php
$_SESSION['nm_session']['user']['1stlogin'] = false;
?>

<body style='margin: 0;overflow-y:hidden; min-width: 800px !important;overflow-x:auto!important;' <?php echo ($_SESSION['nm_session']['user']['keep_me_logged'] ? '' : 'onunload="nm_close_session();');?>">
<?php $url_scase_orig = nm_url_rand($nm_config['url_iface'] . 'main.php');
$url_scase = $url_scase_orig;
$style = "";
?>
<?php if(nm_fixit()): ?>
<div class="ui active inverted dimmer" id="msg-loading-sc-fix">
    <div class="sc-loader">
        <div class="spin"></div>
    </div>
    <div class="ui text big loader" style="text-align: center">
        <span style="text-align: center;"><?php echo nm_get_text_lang("['msg_run_fixs']"); ?></span>
    </div>
</div>
<?php endif; ?>
<script>
    <?php
    global $nm_config;

    $actions = getHotKeys();
    nm_load_class('interface', 'User');
    $nm_user      = nmUser::singleton();
    $user_prefs = $nm_user->GetData('Prefs');

    if($user_prefs['use_hotkeys'] == 'Y') { ?>

        document.reloadPage = function reloadPage() {
            location.reload();
        }

        document.getHotkeyList = function getHotkeyList() {
            var keys = 'esc';
            <?php
            if (!empty($actions)) {
                foreach ($actions as $action => $data) {
                    ?>
                    keys += ',<?php echo join(",", $data['keys']); ?>';
                    <?php
                }
            }
            ?>
            return keys;
        }
        document.closeTab = function closeTab() {
            var closing = nmFrmScase.$('.nmAbaAppOn').attr('data-count')
            if (closing !== undefined){
                nmFrmScase.ajax_get_close_app(parseInt(closing))
            }
        }

        document.switchTab = function switchTab(num) {
            num = (num > 0) ? num : 0
            var opening = nmFrmScase.$('#id_div_scroll li').not('[style="display: none;"], [style="cursor: pointer; display: none;"]').toArray()[num]
            var index = 0
            if (opening !== undefined){
                if (nmFrmScase.$(opening).attr('id') !== 'sys_aba_home') {
                    index = parseInt(nmFrmScase.$(opening).attr('id').replace('sys_aba_page_', ''))
                }
                nmFrmScase.ajax_get_show_app( index )
            }
        }
        document.execHotKey = function execHotKey(e, h, f) {
            switch (true) {
                <?php
                    if (!empty($actions)) {
                        $tabactions = ['nexttab', 'previoustab', 'closetab'];
                        for ($x=1;$x<31;$x++){
                            $tabactions[] = 'switchtab'.$x;
                        }
                        foreach ($actions as $action => $data) {
                            ?>
                            case (['<?php echo join("', '", $data['keys']); ?>'].indexOf(h.key) > -1):
                            <?php
                            if (!$nm_config['bol_show_91_news']) {
                            ?>
                                nmFrmScase.noPermission()
                                return false
                            <?php
                            }

                            if (!in_array($action, $tabactions)) {
                                ?>
                                nmFrmScase.nm_exec_menu('<?php echo $action; ?>');
                                break;
                            <?php
                            } else {
                                switch (true) {
                                    case ($action == 'nexttab'):
                                        ?>
                                        var on = nmFrmScase.$('#id_div_scroll li').not('[style="display: none;"], [style="cursor: pointer; display: none;"]').toArray().indexOf(nmFrmScase.$('.nmAbaAppOn')[0])
                                        var num = on+1;
                                        document.switchTab(num);
                                        break;
                                        <?php
                                        break;
                                    case ($action == 'previoustab'):
                                        ?>
                                        var on = nmFrmScase.$('#id_div_scroll li').not('[style="display: none;"], [style="cursor: pointer; display: none;"]').toArray().indexOf(nmFrmScase.$('.nmAbaAppOn')[0])
                                        var num = on-1;
                                        document.switchTab(num);
                                        break;
                                        <?php
                                        break;
                                    case ($action == 'closetab'):
                                        ?>
                                        document.closeTab();
                                        <?php if (getOS() == 'Mac') { ?>
                                            return true;
                                        <?php } ?>
                                        break;
                                        <?php
                                        break;
                                    case (substr($action, 0, 9) == 'switchtab'):
                                        ?>
                                        var num = <?php echo str_replace('switchtab', '', $action); ?>;
                                        document.switchTab(num -1);
                                        break;
                                        <?php
                                        break;
                                }
                            }
                        }
                    }

                ?>
                default:
                    return true
                    break
            }
            e.preventDefault()
            return false
        }
    <?php
    }
    ?>
    <?php if(nm_fixit()):
        $url_scase = "";
        $style = "display:none;";
    ?>
        $('#nmFrmScase').hide();
            $.ajax({
                url: '<?php echo $nm_config['url_iface']; ?>fix.php',
                async: true,
                success: function (msg)
                {
                    $('#msg-loading-sc-fix').hide();
                    $('#nmFrmScase').show();
                    //$('#mnmFrmScase').attr('src', '<?php echo $url_scase_orig; ?>');

                }
            });



    <?php endif; ?>

    $(window).resize(function(){
        $('#nmFrmScase').height('1000px');
        $('#nmFrmScase').height('100%');
    });
</script>
	<iframe id="nmFrmScase" name="nmFrmScase" src="<?php echo $url_scase_orig; ?>" style='overflow:hidden !important; width:100%; height:100%; border:0px;<?php // echo $style; ?>' frameborder="0"></iframe>
</body>
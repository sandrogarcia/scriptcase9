<?php
$arr_data  = $this->GetVar('field_data');
$str_class = ($arr_data['error']) ? 'nmErrorMsg' : $arr_data['class'];
$upgrade_no_permission  = isset($arr_data['upgrade_no_permission'])? $arr_data['upgrade_no_permission'] : false;
$label_new_opt  = isset($arr_data['label_new_opt'])? $arr_data['label_new_opt'] : false;
?>

    <tr class="nmTrAttr nmTrHover <?php echo isset($arr_data['tr_class']) ? $arr_data['tr_class'] : ''; ?>" id="id_tr_<?php echo $arr_data['name']; ?>" <?php echo $arr_data['tr_style']; ?>>
        <td class="nmAttrTitle <?php echo $str_class; ?>" style="text-align: right; vertical-align: top" colspan="5">
            <ul id="sc-actionbar-item-list">
<?php
var_dump($arr_data['action_list']);
var_dump($arr_data['action_order']);
foreach ($arr_data['action_order'] as $actionName) {
    $canDelete = false;
    if ('__sc_detail' == $actionName) {
        $actionLabel = 'Detalhe';
    } elseif ('__sc_app_edit' == $actionName) {
        $actionLabel = 'Aplicacao de edicao';
    } else {
        $actionLabel = $actionName;
        $canDelete = true;
    }
?>
                <li id="sc-actionbar-item-list-<?php echo $actionName; ?>" class="ui-state-default sc-actionbar-item" data-action-name="<?php echo $actionName; ?>" data-action-type="<?php echo $arr_data['action_list'][$actionName]['type']; ?>">
                    <span class="ui-icon ui-icon-arrowthick-2-n-s sc-actionbar-list-move"></span>
                    <span class="sc-actionbar-list-label"><?php echo $actionLabel; ?></span>
                    <span class="sc-actionbar-list-type"><?php echo $arr_data['action_list'][$actionName]['type']; ?></span>
                    <span class="sc-actionbar-list-actions">
<?php
    if ($canDelete) {
?>
                        <a href="javascript:scActionBarRemove('<?php echo $actionName; ?>');"><i class="fa fa-trash"></i></a>
<?php
    }
?>
                    </span>
                </li>
<?php
}

?>
            </ul>
            <input type="hidden" name="actionbar_list" id="sc-input-actionbar-list" />
            <input type="hidden" name="actionbar_order" id="sc-input-actionbar-order" />
            <input type="button" value="Nova acao" id="sc-button-action-new" class="small ui button primary" />
            <style>
                #sc-actionbar-item-list { list-style-type: none; margin: 0; padding: 0; width: 60%; }
                #sc-actionbar-item-list li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; cursor: move }
                #sc-actionbar-item-list li .sc-actionbar-list-move { position: absolute; margin-left: -1.3em; }
                .sc-actionbar-list-label { display: inline-block; width: 200px }
                .sc-actionbar-list-type { display: inline-block; width: 150px }
            </style>
            <script>
                $(function() {
                    $("#sc-actionbar-item-list").sortable({
                        change: function(event, ui) {
                            <?php echo $nm_config['form_modif2'] ?>
                        }
                    });
                    $("#sc-actionbar-new").modal({
                        onApprove: function () {
                            scActionBarNewOk();
                        }
                    });
                    $("#sc-button-action-new").on("click", function() {
                        scActionBarNew();
                    });
                });
            </script>
            <div id="sc-actionbar-new" class="ui tiny modal">
                <i class="close icon"></i>
                <div class="header">Nova acao</div>
                <div class="content">
                    <table>
                        <tr>
                            <td>Nome</td>
                            <td><input class="nmInput" type="text" id="sc-actionbar-new-name" /></td>
                        </tr>
                        <tr>
                            <td>Tipo</td>
                            <td>
                                <input type="radio" name="actioBarNewName" id="sc-actionbar-type-link" value="link" checked /> <label for="sc-actionbar-type-link">Link</label>
                                <br />
                                <input type="radio" name="actioBarNewName" id="sc-actionbar-type-ajax" value="ajax" /> <label for="sc-actionbar-type-ajax">Ajax</label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="actions">
                    <div class="positive ui approve button">OK</div>
                    <div class="negative ui cancel button">Cancel</div>
                </div>
            </div>
        </td>
    </tr>

    <tr class="nmTrAttr nmTrHover <?php echo $str_class; ?>" id='tr_lang_label_<?php echo $arr_data['name']; ?>' style="display:none">
        <td class="nmAttrTitle"></td>
        <td></td>
        <td id='td_lang_label_<?php echo $arr_data['name']; ?>' colspan=4 class="<?php echo $str_class; ?>">
        </td>
    </tr>

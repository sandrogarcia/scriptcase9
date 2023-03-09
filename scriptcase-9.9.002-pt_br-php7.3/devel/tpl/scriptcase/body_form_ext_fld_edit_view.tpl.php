<?php
/**
 * Template scriptcase.
 *
 * Listagem de campos para exibicao.
 *
 * @package     Template
 * @subpackage  Scriptcase
 * @creation    2003/12/09
 * @copyright   NetMake Solucoes em Informatica
 * @author      Luis Humberto Roman <romanlh@netmake.com.br>
 *
 * $Id: body_form_ext_fld_block.tpl.php,v 1.5 2011-06-15 19:09:09 diogo Exp $
 */

/* Protecao contra hacks */
if(!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}


$arr_data = $this->GetVar('field_data');
$str_class = ($arr_data['error']) ? 'nmErrorMsg' : $arr_data['class'];
$str_form_modif = ('' == $nm_config['form_modif']) ? 'null' : $nm_config['form_modif'];

?>

<tr id="id_tr_<?php echo $arr_data['name']; ?>" <?php echo $arr_data['tr_style']; ?>>
    <td class="<?php echo $str_class; ?>" style="text-align: center; vertical-align: top" colspan="5">
        <center>
            <a name="anchor_<?php echo $arr_data['name']; ?>"></a>

            <div style="margin:8px;"><?php echo nm_get_text_lang("['app_fld']['" . $arr_data['name'] . "']['desc']"); ?></div>

            <table style="border-width: 0px">
                <tr>
                    <td style="padding: 0px 10px">
                        <?php
                        $max_character = 0;
                        $base_width    = "230";

                        $str_dbl_clk = ($nm_browser->HasProperty('doubleclick'))
                            ? " onDblClick=\"nm_field_select_tab('form_edit', '" . $arr_data['name'] . "_list', '" . $arr_data['name'] . "_block', " . $str_form_modif . ")\""
                            : '';
                        ?>
                        <select id="<?php echo $arr_data['name']; ?>_list" name="<?php echo $arr_data['name']; ?>_list" size="20" multiple="multiple"
                                class="nmInput"<?php echo $str_dbl_clk; ?>
                                style="width:<?php echo $base_width; ?>px">
                            <?php
                            foreach($arr_data['fields'] as $int_seq => $arr_field)
                            {
                                $str_disabled = (!in_array($int_seq, $arr_data['grid_fields'])) ? '' : ' disabled="disabled" style="color: #C0C0C0"';
                                if (strlen($arr_field['name']) > $max_character)
                                {
                                    $max_character = strlen($arr_field['name']);
                                }
                                ?>
                                <option
                                    value="<?php echo $int_seq; ?>"<?php echo $str_disabled; ?>><?php echo $arr_field['name']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                    <td style="white-space: nowrap">
                        <a href="javascript: nm_field_select_all_tab('form_edit', '<?php echo $arr_data['name']; ?>_list', '<?php echo $arr_data['name']; ?>_block', <?php echo $str_form_modif; ?>, 0);"><img
                                src="<?php echo $nm_config['url_scriptcase_img']; ?>img_move_right_all.png"
                                style="border-width: 0px"/></a>
                        <span style="font-size: 3px"><br/><br/></span>
                        <a href="javascript: nm_field_select_tab('form_edit', '<?php echo $arr_data['name']; ?>_list', '<?php echo $arr_data['name']; ?>_block', <?php echo $str_form_modif; ?>, 0)"><img
                                src="<?php echo $nm_config['url_scriptcase_img']; ?>img_move_right.png"
                                style="border-width: 0px"/></a>
                        <span style="font-size: 3px"><br/><br/></span>
                        <a href="javascript: nm_field_remove('form_edit', '<?php echo $arr_data['name']; ?>_list', '<?php echo $arr_data['name']; ?>_block', <?php echo $str_form_modif; ?>)"><img
                                src="<?php echo $nm_config['url_scriptcase_img']; ?>img_move_left.png"
                                style="border-width: 0px"/></a>
                        <span style="font-size: 3px"><br/><br/></span>
                        <a href="javascript: nm_field_remove_all('form_edit', '<?php echo $arr_data['name']; ?>_list', '<?php echo $arr_data['name']; ?>_block', <?php echo $str_form_modif; ?>)"><img
                                src="<?php echo $nm_config['url_scriptcase_img']; ?>img_move_left_all.png"
                                style="border-width: 0px"/></a>
                    </td>
                    <td style="padding: 0px 10px">
                        <?php
                        $str_dbl_clk = ($nm_browser->HasProperty('doubleclick'))
                            ? " onDblClick=\"nm_field_remove('form_edit', '" . $arr_data['name'] . "_list', '" . $arr_data['name'] . "_block', " . $str_form_modif . ")\""
                            : '';
                        ?>
                        <select id="<?php echo $arr_data['name']; ?>_block" name="<?php echo $arr_data['name']; ?>_block" size="20" multiple="multiple"
                                class="nmInput"<?php echo $str_dbl_clk; ?> style="width:<?php echo $base_width; ?>px;">
                            <?php
                            foreach($arr_data['grid_fields'] as $int_seq)
                            {
                                if (strlen($arr_data['fields'][$int_seq]['name']) > $max_character)
                                {
                                    $max_character = strlen($arr_data['fields'][$int_seq]['name']);
                                }
                                ?>
                                <option
                                        value="<?php echo $int_seq; ?>_#fld#_<?php echo $arr_data['fields'][$int_seq]['name']; ?>"><?php echo $arr_data['fields'][$int_seq]['name']; ?></option>
                                <?php
                            }
                            ?>
                        </select>

                        <div style="font-size:6px">&nbsp;</div>
                    </td>
                    <td style="white-space: nowrap">
                        <a href="javascript: nm_field_move_up('form_edit', '<?php echo $arr_data['name']; ?>_block', <?php echo $str_form_modif; ?>, true)"><img
                                src="<?php echo $nm_config['url_scriptcase_img']; ?>img_move_up.png"
                                style="border-width: 0px"/></a>
                        <span style="font-size: 3px"><br/><br/></span>
                        <a href="javascript: nm_field_move_down('form_edit', '<?php echo $arr_data['name']; ?>_block', <?php echo $str_form_modif; ?>, true)"><img
                                src="<?php echo $nm_config['url_scriptcase_img']; ?>img_move_down.png"
                                style="border-width: 0px"/></a>
                        <br>&nbsp;
                    </td>
                </tr>
            </table>
            <input class="nmButton" type="button" value="<?php echo nm_get_text_lang("['copy_fields_form_to_grid_view']"); ?>" onclick="scCopyFieldsFormFormToGridEdit()" />
        </center>
        <?php
        if($max_character > 30)
        {
            //cada caracter, usa media de 8px, na fonte atual
            //se a largura dos 2 selects + 150 (maring e padding), for maior que a janela, assume largura da janela
            ?>
            <script>
                $(function() {

                    select_width = <?php echo ($max_character * 8); ?>;
                    if((select_width*2)+150 > $( document ).width())
                    {
                        select_width = ($( document ).width()/2)-75;
                    }
                    $('#<?php echo $arr_data['name']; ?>_list').css('width', select_width + 'px');
                    $('#<?php echo $arr_data['name']; ?>_block').css('width', select_width + 'px');
                });
            </script>
            <?php
        }
        ?>
    </td>
</tr>

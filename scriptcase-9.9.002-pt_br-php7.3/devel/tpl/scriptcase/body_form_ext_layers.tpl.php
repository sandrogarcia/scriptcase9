<?php
/**
 * Template scriptcase.
 *
 * Listagem dos dados ds blocos.
 *
 * @package     Template
 * @subpackage  Scriptcase
 * @creation    2003/12/11
 * @copyright   NetMake Solucoes em Informatica
 * @author      Luis Humberto Roman <romanlh@netmake.com.br>
 *
 * $Id: body_form_ext_block_def.tpl.php,v 1.6 2011-11-16 21:58:50 diogo Exp $
 */

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}

$arr_data     = $this->GetVar('field_data');
$str_class    = ($arr_data['error']) ? 'nmErrorMsg' : $arr_data['class'];
$str_methods  = $this->GetVar('str_methods');
$str_libs     = $this->GetVar('str_libs');
$str_sep      = $this->GetVar('str_sep');
?>

 <style>
	.borda3
	{
        border-top-color:#bfdaf2; border-top-style:solid; border-top-width:1px;
		border-bottom-color:#bfdaf2; border-bottom-style:solid; border-bottom-width:1px;
	}
    .col_group_1
    {
        background-color: #ffffff;
    }
    .col_group_2
    {
        background-color: #f0f8ff;
    }
    #tb_block td{
        padding: 4px;
    }
</style>

 <tr>
  <td class="<?php echo $str_class; ?>" style="text-align: center; vertical-align: top" colspan="5">
  <br />
   <a name="anchor_<?php echo $arr_data['name']; ?>"></a>
   <br />
   <center>

       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#idNewLayer">
           New Layer
       </button>

       <br />
       <br />

       <table id='tb_block' class="nmTable" cellpadding="0" cellspacing="0" border="0" width="60%">
        <tr class='nodrag nodrop'>
         <td class="nmTitle" style="text-align: center" colspan="5">Layers</td>
        </tr>
        <tr class='nodrag nodrop'>
         <td class="nmGroup borda3" style="text-align: left">&nbsp;</td>
         <td class="nmGroup borda3" style="text-align: left; "><?php echo nm_get_text_lang("['name']", "menu_structure"); ?></td>
         <td class="nmGroup borda3" style="text-align: left;"><?php echo nm_get_text_lang("['type']", "menu_structure"); ?></td>
         <td class="nmGroup borda3" style="text-align: center;"><?php echo nm_get_text_lang("['btn_options']"); ?></td>
        </tr>
       <?php
       if(isset($arr_data['value']) && is_array($arr_data['value']) && !empty($arr_data['value']))
       {
           foreach($arr_data['value'] as $int_block=>$layer)
           {
           ?>
               <tr tp_row="layer" id='tr_layer_<?php echo $int_block; ?>' layer='<?php echo $int_block; ?>'>
                   <td class="col_group_1" style="width: 16px" onmouseout="document.getElementById('img_move_<?php echo $int_block; ?>').style.display='';" onmouseover="document.getElementById('img_move_<?php echo $int_block; ?>').style.display='none';"><center><img id='img_move_<?php echo $int_block; ?>' src="<?php echo $nm_config['url_img']; ?>move.png" style="border-width: 0px; vertical-align: middle;" /></center></td>
                   <td class="name nmLineV3 col_group_1" style="text-align: left; white-space: nowrap;"><?php echo $layer['name']; ?></td>
                   <td class="type nmLineV3 col_group_1" style="text-align: left; width: 100px; white-space: nowrap;"><?php echo $layer['type']; ?></td>
                   <td class="nmLineV3 col_group_1" style="text-align: center; width: 100px; white-space: nowrap;"><a href="javascript:" onclick="nm_layers_edit(<?php echo $int_block; ?>);" style="cursor:pointer;"><?php echo nm_get_text_lang("['button_edit']"); ?></a> &nbsp; <a href="javascript:" onclick="nm_layers_del(<?php echo $int_block; ?>);" style="cursor:pointer;"><?php echo nm_get_text_lang("['button_delete']"); ?></a></td>
               </tr>
           <?php
           }
       }

       ?>
       </table>
	</center>
	<script language="javascript">
            var arr_json = <?php echo json_encode($arr_data['value']); ?>;

            $(document).ready(function() {
                /*
                $(".sortable").sortable({
                    axis: "y",
                    cursor: 'pointer',
                    opacity: 0.5,
                    placeholder: "row-dragging",
                    delay: 150,

                    update: function(event, ui) {
                    }

                }).disableSelection();
                */

                startSortTable();

                startColorPicker();

                $(document).on('click','.dropdown-font-family li a', function()
                {
                    $('.font-family-field', $(this).parent().parent().parent().parent()).val($(this).html());
                });
            });

            function startSortTable()
            {
                $("#tb_block").tableDnD({ onDrop: nm_form_modified });
            }

            function startColorPicker()
            {
                $('.fontcolor').colorpicker({
                    colorSelectors: {
                        'black': '#000000',
                        'white': '#ffffff',
                        'red': '#FF0000',
                        'default': '#777777',
                        'primary': '#337ab7',
                        'success': '#5cb85c',
                        'info': '#5bc0de',
                        'warning': '#f0ad4e',
                        'danger': '#d9534f'
                    }
                });
                $('.bgcolor').colorpicker({
                    colorSelectors: {
                        'black': '#000000',
                        'white': '#ffffff',
                        'red': '#FF0000',
                        'default': '#777777',
                        'primary': '#337ab7',
                        'success': '#5cb85c',
                        'info': '#5bc0de',
                        'warning': '#f0ad4e',
                        'danger': '#d9534f'
                    }
                });
            }
	</script>
      <br />
      <br />
      <input type="hidden" name="layers" id="layers" value="" />

      <div class="modal fade" id="idNewLayer" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
          <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title"><?php echo nm_get_text_lang("['var_new_layer']", "menu_structure"); ?></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <h5><?php echo nm_get_text_lang("['name']", "menu_structure"); ?></h5>
                      <p><input type="text" value="" name="new_layer_name" id="new_layer_name" class="nmInput" /></p>
                      <hr>
                      <h5><?php echo nm_get_text_lang("['type']", "menu_structure"); ?></h5>
                      <p>
                          <select class="nmInput" name="new_layer_type" id="new_layer_type">
                              <option value="menu_itens"><?php echo nm_get_text_lang("['var_type_menu_itens']", "menu_structure"); ?></option>
                              <option value="titulo"><?php echo nm_get_text_lang("['var_type_titulo']"); ?></option>
                              <option value="data"><?php echo nm_get_text_lang("['var_type_data']"); ?></option>
                              <option value="imagem"><?php echo nm_get_text_lang("['var_type_imagem']"); ?></option>
                              <option value="valor"><?php echo nm_get_text_lang("['var_type_valor']"); ?></option>
                              <option value="biblioteca"><?php echo nm_get_text_lang("['var_type_biblioteca']", "menu_structure"); ?></option>
                              <option value="metodo"><?php echo nm_get_text_lang("['var_type_metodo']", "menu_structure"); ?></option>
                              <option value="separator"><?php echo nm_get_text_lang("['var_type_espacador']", "menu_structure"); ?></option>
                          </select>
                      </p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="close ui button" data-dismiss="modal"><?php echo nm_get_text_lang("['btn_close']"); ?></button>
                      <button type="button" class="create ui positive icon button continue" onclick="nm_layers_new()"><?php echo nm_get_text_lang("['btn_save']"); ?></button>
                  </div>
              </div>
          </div>
      </div>

      <input type="hidden" value="" name="imageHidden" id="imageHidden" />

      <div class="modal fade" id="idEditLayer" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left; ">
          <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document" style="min-width: 950px; max-width: 1000px;">
              <div class="modal-content">
                  <div class="modal-header">

                      <p>
                          <h5 class="modal-title">Edit Layer</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </p>

                      <p>

                          <div class="row">
                              <div class="col-sm-1">
                                  <strong><?php echo nm_get_text_lang("['name']", "menu_structure"); ?></strong>
                              </div>
                              <div class="col-sm-3">
                                  <input class="nmInput form-control" name="name" value="">
                              </div>

                              <div class="col-sm-1">
                                  <strong><?php echo nm_get_text_lang("['type']", "menu_structure"); ?></strong>
                              </div>
                              <div class="col-sm-3">
                                  <select name="type" class="nmInput form-control" title="<?php echo nm_get_text_lang("['type']"); ?>" onchange="checkLayerType(false);">
                                      <option value="menu_itens"><?php echo nm_get_text_lang("['var_type_menu_itens']", "menu_structure"); ?></option>
                                      <option value="titulo"><?php echo nm_get_text_lang("['var_type_titulo']"); ?></option>
                                      <option value="data"><?php echo nm_get_text_lang("['var_type_data']"); ?></option>
                                      <option value="imagem"><?php echo nm_get_text_lang("['var_type_imagem']"); ?></option>
                                      <option value="valor"><?php echo nm_get_text_lang("['var_type_valor']"); ?></option>
                                      <option value="biblioteca"><?php echo nm_get_text_lang("['var_type_biblioteca']", "menu_structure"); ?></option>
                                      <option value="metodo"><?php echo nm_get_text_lang("['var_type_metodo']", "menu_structure"); ?></option>
                                      <option value="separator"><?php echo nm_get_text_lang("['var_type_espacador']", "menu_structure"); ?></option>
                                  </select>
                              </div>
                          </div>
                      </p>
                  </div>
                  <div class="modal-body">
                      <div id="id_edit_menu_items" style="display: none">
                          <input type="hidden" name="__nm_fld__menus" id="__nm_fld__menus" value="" />
                          <input type="hidden" name="menu_theme" id="menu_theme" value="scriptcase__NM__Android/Blue" />
                          <table width="100%" cellspacing="0" cellpadding="0">
                              <?php
                              $arr_data['value'] = array();
                              $arr_data['str_sep'] = $str_sep;
                              $arr_data['temas'] = array( 'scriptcase' => array('Android' => array('Blue')) );
                              $arr_data['is_tree'] = false;
                              $arr_data['menu_theme'] = "scriptcase__NM__Android/Blue";
                              $arr_data['menu_orientacao'] = "horizontal";
                              $arr_data['use_old_icons'] = "N";
                              $arr_data['css_theme'] = "";
                              $this->SetVar('field_data', $arr_data);
                              $this->Display('body_form_ext_itens_menu_new');
                              ?>
                          </table>
                      </div>
                      <div id="id_edit_others" style="display: ">
                          <p style="display: none">
                              <i class="fa fa-plus" aria-hidden="true" onclick="nm_layers_new_item();"></i> Items
                          </p>
                          <div class="">
                              <div id="idEditLayerEmptyItem" style="display: none;">
                                  <input type="hidden" value="" name="type" id="type" />
                                  <div class="row" >

                                      <div class="col-sm-1" style='width:30px;font-size: 19px;margin-top: 7px; display: none'>
                                          <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                      </div>
                                      <div class="col-sm-2 childExtra" >
                                          <strong><?php echo nm_get_text_lang("['type']"); ?></strong>
                                          <div class="input-group">
                                              <input  type="text" name="value" value="" class="nmInput FieldExtra form-control" style="display: none;" />
                                              <select name="method" class='method nmInput form-control' style="display: none">
                                                  <option></option>
                                                  <?php echo $str_methods; ?>
                                              </select>
                                              <select name="library" class='libraries nmInput form-control' style="display: none">
                                                  <option></option>
                                                  <?php echo $str_libs; ?>
                                              </select>
                                              <div name="data" class="input-group-addon dateHelp " style="display: none">
                                                  <a href="javascript: nm_window_help_date()"  class="">
                                                      <img src="<?php echo $nm_config['url_img']; ?>help.gif" style="border-width: 0px; " title="<?php echo nm_get_text_lang("['hint_icon_data']"); ?>">
                                                  </a>
                                              </div>
                                              <div name="imagem" class="input-group-addon imageUpload" style="display: none">
                                                  <a href="javascript:" onclick="nm_set_image(this);">
                                                      <img src="<?php echo $nm_config['url_img']; ?>background.png" style="border-width: 0px;" title="<?php echo nm_get_text_lang("['choose_img']"); ?>">
                                                  </a>
                                              </div>
                                          </div>
                                      </div>
                                      <div class='col-sm-2' style='' title="<?php echo nm_get_text_lang("['font-family']"); ?>">
                                          <strong><?php echo nm_get_text_lang("['font-family']"); ?></strong>
                                          <div class="input-group">
                                              <input type="text" name="font-family" class=" font-family-field form-control" aria-label="..." value="">

                                              <div class="input-group-btn dropdown">
                                                  <button type="button" class="btn btn-default dropdown-toggle" style='height: 34px;' data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="caret"></span>
                                                  </button>
                                                  <ul class="dropdown-menu dropdown-menu-right dropdown-font-family">
                                                      <li><a href='#'>Arial, Helvetica, sans-serif</a></li>
                                                      <li><a href='#'>"Times New Roman", Times, serif</a></li>
                                                      <li><a href='#'>Tahoma, Geneva, sans-serif</a></li>
                                                      <li><a href='#'>"Courier New", Courier, monospace</a></li>
                                                  </ul>
                                              </div>
                                          </div>
                                      </div>
                                      <div class='col-sm-2 ' style=''>
                                          &nbsp;
                                          <div id="fontcolor" class="input-group colorpicker-component fontcolor" title="<?php echo nm_get_text_lang("['font-color']"); ?>">
                                              <input type="text" name="color" id="color" value="" class="form-control" />
                                              <span class="input-group-addon"><i></i></span>
                                          </div>
                                      </div>
                                      <div class='col-sm-1' style=''>
                                          &nbsp;
                                          <input type="number" name="font-size" value='' style='width: 46px;' class='nmInput form-control' title="<?php echo nm_get_text_lang("['font_size']"); ?>">
                                      </div>

                                      <div class='col-sm-1' style="">
                                          &nbsp;
                                          <select name="font-weight" class='nmInput form-control' style="width: 70px;">
                                              <option></option>
                                              <option value="normal">normal</option>
                                              <option value="bold">Bold</option>
                                              <option value="100">100</option>
                                              <option value="200">200</option>
                                              <option value="300">300</option>
                                              <option value="400">400</option>
                                              <option value="500">500</option>
                                              <option value="600">600</option>
                                              <option value="700">700</option>
                                              <option value="800">800</option>
                                          </select>
                                      </div>

                                      <div class='col-sm-1' style="">
                                          &nbsp;
                                          <select name="font-style" class='nmInput form-control' style="width: 70px;">
                                              <option></option>
                                              <option value="normal">normal</option>
                                              <option value="italic">italic</option>
                                              <option value="oblique">oblique</option>
                                          </select>
                                      </div>

                                      <div class='col-sm-3 ' style=''>
                                          <strong><?php echo nm_get_text_lang("['background-color']"); ?></strong>
                                          <div id="bgcolor" data-format="alias" class="input-group colorpicker-component background-color bgcolor" style='width:110px' title="<?php echo nm_get_text_lang("['background-color']"); ?>">
                                              <input type="text" name="background-color" id="background-color" value="" class="form-control background-color-field" />
                                              <span class="input-group-addon"><i></i></span>
                                          </div>
                                      </div>
                                      <div class="col-sm-1" style="display: none">
                                          <i data-repeater-delete class='fa fa-trash' onclick="nm_layers_delete_item(this);" style='font-size:17px;margin-top: 8px;' title="<?php echo nm_get_text_lang("['button_delete']"); ?>"></i>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                  </div>
                  <div class="modal-footer">
                      <button type="button" class="close ui button" data-dismiss="modal"><?php echo nm_get_text_lang("['btn_close']"); ?></button>
                      <button type="button" class="create ui positive icon button continue" onclick="nm_layers_save();"><?php echo nm_get_text_lang("['btn_save']"); ?></button>
                  </div>
              </div>
          </div>
      </div>

  </td>
 </tr>

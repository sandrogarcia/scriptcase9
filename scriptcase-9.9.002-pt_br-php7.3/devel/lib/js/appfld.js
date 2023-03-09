function nmChangeFormatGraf(tp_formato_graf)
{
  if (tp_formato_graf == 'image')
  {
    $("#idChart_jpgraph").show();
    $("#idChart_flash").hide();


    $("#idChart_jpgraph").html(tit_graf_image);
  }
  else
  {
    $("#idChart_jpgraph").hide();
    $("#idChart_flash").show();

    $("#idChart_jpgraph").html(tit_graf_flash);
  }

  $("#id_tr_graf_option_tr_cima").show();
  $("#id_tr_graf_option").show();
  $("#id_tr_graf_show_vals_tr_cima").show();
  $("#id_tr_graf_show_vals").show();
  $("#id_tr_Graf_Largura_tr_cima").show();
  $("#id_tr_Graf_Largura").show();
  $("#id_tr_Graf_Altura_tr_cima").show();
  $("#id_tr_Graf_Altura").show();
  $("#id_tr_graf_nov_pag_tr_cima").show();
  $("#span_tit_config_graf").show();
}

function nm_toggle_graf_nov_pag(obj_sel)
{
  if(document.getElementById("id_tr_graf_qtd_cols"))
  {
    document.getElementById("id_tr_graf_qtd_cols").style.display  = "none";
    document.getElementById("id_tr_graf_only_res").style.display  = "none";
    document.getElementById("id_tr_graf_margin").style.display    = "none";
    document.getElementById("id_tr_graf_align").style.display     = "none";
    document.getElementById("id_tr_graf_valign").style.display    = "none";
    document.getElementById("id_tr_graf_antes_res").style.display = "none";
    document.getElementById("id_tr_flash_chart_standalone_config").style.display = "";
    document.getElementById("id_tr_graf_qtd_cols_tr_cima").style.display  = "none";
    document.getElementById("id_tr_graf_only_res_tr_cima").style.display  = "none";
    document.getElementById("id_tr_graf_margin_tr_cima").style.display    = "none";
    document.getElementById("id_tr_graf_align_tr_cima").style.display     = "none";
    document.getElementById("id_tr_graf_valign_tr_cima").style.display    = "none";
    document.getElementById("id_tr_graf_antes_res_tr_cima").style.display = "none";
    document.getElementById("id_tr_flash_chart_standalone_config_tr_cima").style.display = "";
  }
  if(obj_sel.value == 'X')
  {
    if(document.getElementById("id_tr_graf_qtd_cols"))
    {
      document.getElementById("id_tr_graf_qtd_cols").style.display  = "";
      document.getElementById("id_tr_graf_only_res").style.display  = "none";
      document.getElementById("id_tr_graf_margin").style.display    = "";
      document.getElementById("id_tr_graf_align").style.display     = "";
      document.getElementById("id_tr_graf_valign").style.display    = "";
      document.getElementById("id_tr_graf_antes_res").style.display = "";
      document.getElementById("id_tr_flash_chart_standalone_config").style.display = "none";

      document.getElementById("id_tr_graf_qtd_cols_tr_cima").style.display  = "";
      document.getElementById("id_tr_graf_only_res_tr_cima").style.display  = "none";
      document.getElementById("id_tr_graf_margin_tr_cima").style.display    = "";
      document.getElementById("id_tr_graf_align_tr_cima").style.display     = "";
      document.getElementById("id_tr_graf_valign_tr_cima").style.display    = "";
      document.getElementById("id_tr_graf_antes_res_tr_cima").style.display = "";
      document.getElementById("id_tr_flash_chart_standalone_config_tr_cima").style.display = "none";
    }
  }
}

function nm_schema_view_chart()
{
  if ($("#id_chartpallet").val() !== undefined){

    if ($("#id_chartpallet").val() != '' && $("#id_chartpallet").val() != '0' ){

      $("#id_grid_chart_type").val('');
      $.ajax({
        type: 'POST',
        async: false,
        url: nm_url_iface + 'app.php',
        data: 'ajax=S&option=view_chart&chartpallet=' + document.form_edit.chartpallet.value + '&schemachart=' + document.form_edit.schemachart.value + '&grid_chart_type=' + document.form_edit.grid_chart_type.value,
        success: function(html_retorno)
        {
          chart.setXMLData(html_retorno);
          chart.render("id_div_chart");
        }
      });
    }
  }
}

function nm_view_chart_type()
{
  if ($("#id_grid_chart_type").val() != ''){

    $("#id_chartpallet").val('');
    $("#id_schemachart").val('');
  }
    $.ajax({
        type: 'POST',
        async: false,
        url: nm_url_iface + 'app.php',
        data: 'ajax=S&option=view_chart_type&chartpallet=&schemachart=&grid_chart_type=' + document.form_edit.grid_chart_type.value,
        success: function(html_retorno)
        {
          chart.setXMLData(html_retorno);
          chart.render("id_div_chart");
        }
    });
}

function viewChart(str_chart, str_editor)
{
  if(str_chart != '__NEW__')
  {
    param = 'ajax=S&';
    param = param + 'option=view_chart_type&';
    param = param + 'str_chart=' + str_chart + '&';
    param = param + 'str_editor=' + str_editor;
    $.ajax({
      type: 'POST',
      url:  nm_url_iface + 'app.php',
      data: param,
      success: function(msg)
      {
        setViewChart(msg);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown)
      {
        setViewChart(errorThrown);
      }
    });
  }else
  {
    setViewChart('_@NM@_' + str_chart + '_@NM@_'  + str_editor);
  }
}

function setViewChart(str_return)
{
  str_return = str_return.split('_@NM@_');
  arr_schema = str_return[3].split('_#NM#_');
}

function nm_edit_confirm(str_section, mix_param, str_fld_section, str_no_confirm, str_fld_section, str_xml_fld_tag, str_xml_fld_campo, str_sec_id)
{
  var str_status = "N";
        if ("Y" == document.form_edit.form_modified.value)
  {
    if(auto_save == 'Y' || confirm(lang_edit_confirm))
    {
        nm_edit_save(str_section, mix_param, str_fld_section, str_no_confirm, str_fld_section, str_xml_fld_tag, str_xml_fld_campo, str_sec_id);
      str_status = "Y";
    }

    document.form_edit.form_modified.value = str_status;

  }
  return str_status;
}

function nm_translate_lang_label(str_field, str_valor)
{
    var er = /\{lang_[A-Za-z_0-9]+\}/gi;
    var lang_labels = str_valor.match(er);
    if(lang_labels == null)
    {
        $('#td_lang_label_' + str_field).html('');
        $('#td_lang_label_' + str_field).hide();
        return false;
    }
    var retorno = str_valor;
    var i = 0;
    for(i = 0; i < lang_labels.length; i++)
    {
        var er_search_lang = new RegExp(lang_labels[i]);
        var ini_lang = lang_data.search(er_search_lang);
        if(ini_lang != -1)
        {
            ini_lang += lang_labels[i].length;
            var end_lang  = lang_data.indexOf('_@NM@_', ini_lang);
            if(end_lang == -1)
            {
                    end_lang = lang_data.length;
            }
            retorno = retorno.replace(er_search_lang, "<span style='color:blue;'>" +lang_data.substring(ini_lang, end_lang) + "</span>");
        }
        else
        {
            retorno = retorno.replace(er_search_lang, "<span style='color:red;'>undefined</span>");
        }
    }
    
    if(str_field == 'fld_group_label_title')
    {
        if(retorno.indexOf('%s'))
        {
            retorno = retorno.replace("%s", $('#id_fld_group_label_field').val());
        }
    }
    document.getElementById('td_lang_label_' + str_field).innerHTML = retorno;
    //seta o display igual ao campo original, devido a linha original poder iniciar escondido
    document.getElementById('tr_lang_label_' + str_field).style.display=document.getElementById('id_tr_' + str_field).style.display;
    //return retorno;
}

function nm_defcomp_cons(obj_sel)
{
    group = false;
    if(obj_sel.name == 'Lookup_Group' || obj_sel.name == 'Lookup_SummarySearch')
    {
        group = true;
    }
    int_sel = obj_sel.selectedIndex;
    if ("N" == obj_sel.options[int_sel].value)
    {
         $("#lookup_manual").hide();
         $("#lookup_automatico").hide();

         $("#id_def_none_cons").show();
         $("#id_def_auto_cons").hide();
         $("#id_def_manu_cons").hide();
         if(!group) $("#id_def_cons").hide();
         $("#id_def_cons_original").hide();
         $("#id_def_cons_conn").hide();
    }
    else if ("A" == obj_sel.options[int_sel].value)
    {
         $("#lookup_manual").hide();
         $("#lookup_automatico").show();

         $("#id_def_none_cons").hide();
         $("#id_def_auto_cons").show();
         $("#id_def_manu_cons").hide();
         if(!group) $("#id_def_cons").show();
         $("#id_def_cons_original").show();
         $("#id_def_cons_conn").show();
    }
    else if ("M" == obj_sel.options[int_sel].value)
    {
         $("#lookup_automatico").hide();
         $("#lookup_manual").show();

         $("#id_def_none_cons").hide();
         $("#id_def_auto_cons").hide();
         $("#id_def_manu_cons").show();
         if(!group) $("#id_def_cons").show();
         $("#id_def_cons_original").show();
         $("#id_def_cons_conn").hide();
    }
}
function nm_defcomp_edit(obj_sel)
{
 int_sel = obj_sel.selectedIndex;
 nm_toggle_object("id_tr_embeed_link",     "off");
 if ("N" == obj_sel.options[int_sel].value)
 {
  nm_toggle_object("id_def_none_edit",     "on");
  nm_toggle_object("id_def_auto_edit",     "off");
  nm_toggle_object("id_def_manu_edit",     "off");
  nm_toggle_object("id_def_edit_original", "off");
  nm_toggle_object("id_def_edit_conn",     "off");
 }
 else if ("A" == obj_sel.options[int_sel].value)
 {
  nm_toggle_object("id_def_none_edit",     "off");
  nm_toggle_object("id_def_auto_edit",     "on");
  nm_toggle_object("id_def_manu_edit",     "off");
  nm_toggle_object("id_def_edit_original", "on");
  nm_toggle_object("id_def_edit_conn",     "on");
  nm_toggle_object("id_tr_embeed_link",    "on");
  if (document.form_edit.Tipo_Dado_P.value == 'CHECKBOX') 
  {
    nm_toggle_object("id_chk_opt_mark_all",     "on");
  }
 }
 else if ("M" == obj_sel.options[int_sel].value)
 {
  nm_toggle_object("id_def_none_edit",     "off");
  nm_toggle_object("id_def_auto_edit",     "off");
  nm_toggle_object("id_def_manu_edit",     "on");
  nm_toggle_object("id_def_edit_original", "on");
  nm_toggle_object("id_def_edit_conn",     "off");
  if (document.form_edit.Tipo_Dado_P.value == 'CHECKBOX') 
  {
    obj_tp = null; 
    if (document.getElementById('def_edit_type') != null) 
    {
      obj_tp = document.getElementById('def_edit_type'); 
    }
    else if (document.getElementById('def_cons_type') != null) 
    {
      obj_tp = document.getElementById('def_cons_type'); 
    }
    else if (document.getElementById('def_pesq_type') != null) 
    {
      obj_tp = document.getElementById('def_pesq_type'); 
    }
    if(obj_tp.value == 'SIMPLES')
    {
      nm_toggle_object("id_chk_opt_mark_all", "off");
    }else
    {
      nm_toggle_object("id_chk_opt_mark_all", "on");
    }
  }
 }
}

function wiz_create_select_lkp(s_display, div_ref) 
{ 
    var divr = document.getElementById('div_lookup_'+ div_ref +'_con');
    if (divr == null)
    { 
        divr = document.getElementById('div_general_con');
    } 
    var div_wiz_create = document.getElementById('id_create_select_lkp'); 
    div_wiz_create.style.display = s_display; 
    if (div_ref == 'cons') 
    { 
        dif_top = 35; 
    } 
    else 
    { 
        dif_top = 55; 
    } 
    if (s_display == '') 
    { 
        if (divr != null) 
        { 
            div_wiz_create.style.top = (divr.offsetTop + dif_top) + 'px' 
        } 
       $('#id_create_select_lkp').show();
    } 
    else 
    { 
       $('#id_create_select_lkp').hide();
    } 
} 

function ajax_get_flds(tabela, path)
{
  var div1 = document.getElementById('spn_cod_desc');
  qtd_desc = parseInt(document.form_edit.txt_qtd_desc.value);
  has_extra = document.form_edit.has_extra.value;
  document.form_edit.sel_div_info_cons_cod.disabled = true;
  for(i = 1; i <= qtd_desc + 1; i++)
  {
      if(document.form_edit.elements['sel_div_info_cons_desc_' + i] != null)
      {
          document.form_edit.elements['sel_div_tipo_desc_' + i].disabled = true;
          document.form_edit.elements['sel_div_info_cons_desc_' + i].disabled = true;
          document.form_edit.elements['info_cons_txt_desc_' + i].disabled = true;
      }
  }
  var sel_conn = document.getElementById('def_conn_lookup');
  str_conn = (sel_conn != null) ? sel_conn.value : '';
  $.ajax({
        type: 'GET',
        async: true,
        url: path,
        data: 'ajax=nm&ajax_table=' + tabela + '&ajax_page=fld&ajax_qtd_desc=' + qtd_desc + '&ajax_conn=' + str_conn + '&has_extra=' + has_extra,
        success: function(html_retorno)
        {
            ajax_set_flds(html_retorno);
        }
    });
}

function ajax_set_flds(str_retorno) 
{ 
  arr_retorno = str_retorno.split('___CREATE_'+'COMBO'+'_FIELDS___'); 
  str_retorno = arr_retorno[1];
  var div1 = document.getElementById('spn_cod_desc'); 
  div1.innerHTML = str_retorno;
  document.form_edit.sel_div_info_cons_cod.disabled = false;
  qtd_desc = parseInt(document.form_edit.txt_qtd_desc.value); 
  for(i = 1; i <= qtd_desc; i++) 
  { 
      if(document.form_edit.elements['sel_div_info_cons_desc_' + i] != null) 
      { 
          document.form_edit.elements['sel_div_tipo_desc_' + i].disabled = false;
          document.form_edit.elements['sel_div_info_cons_desc_' + i].disabled = false;
          document.form_edit.elements['info_cons_txt_desc_' + i].disabled = false;
      } 
  } 
  exibs = document.form_edit.txt_exibs.value; 
  if (exibs != '' && qtd_desc > 0) 
  { 
     arr_exb = exibs.split('_nmsp1_');  
     cod = document.form_edit.elements['sel_div_info_cons_cod']; 
     for(i = 0; i < cod.options.length; i++)   
     { 
         if (cod.options[i].value == arr_exb[0])
             { 
                 cod.options[i].selected = true; 
                 break; 
             } 
     } 
     for(i = 1; i < arr_exb.length; i++) 
     { 
         arr_fld = arr_exb[i].split('_nmsp2_');  
         tp  = document.form_edit.elements['sel_div_tipo_desc_' + i]; 
         sel = document.form_edit.elements['sel_div_info_cons_desc_' + i]; 
         txt = document.form_edit.elements['info_cons_txt_desc_' + i]; 
         if (arr_fld[0] == 'V') 
         { 
             document.getElementById('span_info_cons_desc_' + i).style.display = 'none'; 
             document.getElementById('span_info_cons_txt_desc_' + i).style.display = ''; 
             tp.options[1].selected = true; 
             txt.value = arr_fld[1]; 
         } 
         else 
         { 
             document.getElementById('span_info_cons_desc_' + i).style.display = ''; 
             document.getElementById('span_info_cons_txt_desc_' + i).style.display = 'none'; 
             tp.options[0].selected = true; 
             if (arr_exb[i] != '') 
             { 
                 for(k = 0; k < sel.options.length; k++)   
                 { 
                     if (sel.options[k].value == arr_fld[1])
                     { 
                          sel.options[k].selected = true; 
                          break; 
                      } 
                  } 
              } 
         } 
     } 
  } 
} 

function wiz_inc_desc(flag) 
{ 
    qtd = parseInt(document.form_edit.txt_qtd_desc.value);         
    def = document.form_edit.txt_def.value;         
    if (flag == '+') 
    { 
        qtd++; 
    }         
    if (flag == '-') 
    { 
        if (qtd == (def == 'cons' ? 1 : 0)) 
        { 
             return; 
        } 
        qtd--; 
    }                 
    document.form_edit.txt_qtd_desc.value = qtd; 
    url = nm_url_iface + 'wiz_tab_lig.php'; 
    if (qtd > 0) set_val_exibs(); 
    ajax_get_flds(document.form_edit.sel_div_info_cons_nometabela.value, url); 
} 

function wiz_create_select_ok(text_a, tp, fld, bln_num, turn_off_where) 
{ 
    tab  = $('[name=sel_div_info_cons_nometabela]').val();
    qtd  = $('[name=txt_qtd_desc]').val();
    cod  = $('[name=sel_div_info_cons_cod]').val();
    extra= '';
    if($('[name=sel_div_info_cons_extra]').length >=0 && $('[name=sel_div_info_cons_extra]').val() != undefined && $('[name=sel_div_info_cons_extra]').val() != '')
    {
      extra = ", " + $('[name=sel_div_info_cons_extra]').val();
    }

    if (bln_num) 
    { 
        campo_prot = '{' + fld + '}'; 
    } 
    else 
    { 
        campo_prot = "'{" + fld + "}'"; 
    } 
    if (qtd == 0) 
    { 
        if (tp == 'cons' && turn_off_where == '')
        { 
            document.form_edit.elements[text_a].value = "SELECT " + cod + extra + " \nFROM " + tab + " \nWHERE " + cod + " = "+ campo_prot +"" + " \nORDER BY " + cod;         
        } 
        else 
        { 
            document.form_edit.elements[text_a].value = "SELECT " + cod + extra + " \nFROM " + tab + " \nORDER BY " + cod;         
        } 
    } 
    else if (qtd == 1) 
    { 
        desc_cmp = $('[name=sel_div_info_cons_desc_1]').val();
        desc_txt = $('[name=info_cons_txt_desc_1]').val();
        tipo     = $('[name=sel_div_tipo_desc_1]').val();
        desc     = (tipo == 'C') ? desc_cmp : desc_txt; 
        if (tp == 'cons' && turn_off_where == '') 
        { 
            document.form_edit.elements[text_a].value = "SELECT " + desc + extra + " \nFROM " + tab + " \nWHERE " + cod + " = "+ campo_prot +"" + " \nORDER BY " + desc;         
        } 
        else 
        { 
            document.form_edit.elements[text_a].value = "SELECT " + cod + ", " + desc + extra + " \nFROM " + tab + " \nORDER BY " + desc;         
        } 
    } 
    else 
    { 
        desc = ''; 
        for (i = 1;  i <= qtd; i++) 
        { 
            desc_cmp = $('[name=sel_div_info_cons_desc_'+ i +']').val();
            desc_txt = $('[name=info_cons_txt_desc_'+ i +']').val();
            tipo     = $('[name=sel_div_tipo_desc_'+ i +']').val();
            desc     += (desc == '' ? '' : ', ') + (tipo == 'C' ? desc_cmp : desc_txt);         
        } 
        if (tp == 'cons' && turn_off_where == '')
        { 
            document.form_edit.elements[text_a].value = "SELECT sc_concat(" + desc + ")"+ extra +" \nFROM " + tab + " \nWHERE " + cod + " = "+ campo_prot +"" + " \nORDER BY " + desc; 
        } 
        else 
        { 
            document.form_edit.elements[text_a].value = "SELECT " + cod + ", sc_concat(" + desc + ")"+ extra +" \nFROM " + tab + " \nORDER BY " + desc; 
        } 
    } 
} 

function ajax_get_tables(conn, path) 
{ 
  document.form_edit.sel_div_info_cons_nometabela.disabled = true;
  $.ajax({
        type: 'GET',
        async: true,
        url: path,
        data: 'ajax=nm&ajax_conn=' + conn +'&ajax_page=fld&ajax_get_tables=S&ajax_cbo_tab=def_fld_table',
        success: function(html_retorno)
        {
            ajax_set_tables(html_retorno);
        }
    });
} 

function ajax_set_tables(str_retorno) 
{ 
   spn_table = document.getElementById('spn_tabela'); 
   spn_table.innerHTML = str_retorno; 
   path_ajax = document.form_edit.txt_path_ajax.value; 
   str_table = document.form_edit.sel_div_info_cons_nometabela.value; 
   document.form_edit.sel_div_info_cons_nometabela.disabled = false;
   wiz_inc_desc('-', 'n'); 
   document.form_edit.txt_qtd_desc.value='1'; 
   document.form_edit.txt_exibs.value='';  
   ajax_get_flds(str_table, path_ajax); 
} 

function set_val_exibs(tabela, path)
{
    qtd = parseInt($('[name=txt_qtd_desc]').val()) + 1;
    par = $('[name=sel_div_info_cons_cod]').val() + '_nmsp1_';
    for(i = 1; i < qtd; i++)
    {
        if ($('[name=sel_div_tipo_desc_'+ i +']').val() != null)
        {
            tp  = $('[name=sel_div_tipo_desc_'+ i +']').val();   
            sel  = $('[name=sel_div_info_cons_desc_'+ i +']').val();   
            txt  = $('[name=info_cons_txt_desc_'+ i +']').val();   
            par += (i > 1 ? '_nmsp1_' : '') + tp + '_nmsp2_' + (tp == 'C' ? sel : txt);
        }
    }
    document.form_edit.txt_exibs.value = par;
}

function destroyMultiselect(str_id)
{
  $('#' + str_id).multiselect('destroy');
}

function startMultiselect(str_id)
{
  $('#' + str_id).multiselect({
    enableClickableOptGroups: false,
    includeSelectAllOption: false,
    enableFiltering: false,
    maxHeight: 400,
    buttonClass: 'textflow btn btn-default',
    onDropdownShown : function(event) {
    },
    onChange: function(option, checked) {
    },
    buttonText: function(options) {
    }
  });
}

function setSimpleMultiple(id_dest, obj_sel)
{
  if(obj_sel.value=='multiplo')
  {
    $("#" + id_dest + " option[value='']").remove();
    $('#' + id_dest).attr('multiple', true);
  }
  else
  {
    $('#' + id_dest).prepend("<option value=''>"+ langNone +"</option>");
    $('#' + id_dest).attr('multiple', false);
  }
  $('#' + id_dest).multiselect('rebuild');
  //startMultiselect(id_dest);
}

function checkDefault(str_name, obj, str_display, str_val, str_group)
{
    var listNoPermission = [
        'current_week_today',
        'current_quarter_today',
        'current_year_today'
    ];
    if (!permissionString && listNoPermission.indexOf($(obj).val()) > -1) {
        $(obj).prop({'checked': false});
        nmFrmScaseRunFunc('noPermission');
    } else {
        if(obj.checked)
        {
            if (obj.value.substr(0, 7) == 'C_!NM!_') {
                translateString(str_display, function(label) {
                    $('.checkbox-inline input:checked').each(function () {
                        if ($(this).val() == obj.value) {
                            $('#'+ str_name).append("<option value='"+ obj.value +"'>" +label+ "</option>");

                            if($('#sc_fields_orderby').length)
                            {
                              $('#sc_fields_orderby').append("<li class='item' val='"+ obj.value +"'><span>" +label+ "</span><div class='button fechar margin' onclick='removeFieldOrderby(this);'>x</div></li>");
                              setListFieldHeightBasedContent();
                            }

                            if($("#default_relative_period_selected").val() != '')
                            {
                              $("#default_relative_period option[value='"+ $("#default_relative_period_selected").val() +"']").attr('selected', true);                              
                            }
                            $('#' + str_name).multiselect('rebuild');
                        }
                    })
                })
            } else {
                $('#'+ str_name).append("<option value='"+ obj.value +"'>" +str_display+ "</option>");
                if($('#sc_fields_orderby').length)
                {
                  $('#sc_fields_orderby').append("<li class='item' val='"+ obj.value +"'><span>" +str_display+ "</span><div class='button fechar margin' onclick='removeFieldOrderby(this);'>x</div></li>");
                  setListFieldHeightBasedContent();
                }
            }
        }
        else
        {
            str_val_remove = "";
            if(obj == '')
            {
              str_val_remove = str_val;
            }
            else
            {
              str_val_remove = obj.value;
            }
            $('#'+ str_name + ' option[value="'+ str_val_remove +'"]').remove();
            if($('#sc_fields_orderby').length)
            {
              $('#sc_fields_orderby [val="'+ str_val_remove +'"]').remove();
              setListFieldHeightBasedContent();
            }
        }
        $('#' + str_name).multiselect('rebuild');
    }
}

function showAddNewRange(str_group)
{
    if(has_right_91 == 0)
    {
        parent.parent.noPermission();
    }
    else
    {           
        if (!$('#id_relative_' + str_group + ' .checkbox-inline.new-period').hasClass('disabled')) {
            $('#box_new_range_' + str_group).show();
            $('#box_new_range_' + str_group + ' input[name="new_range_value"').focus();
            $('#box_new_range_' + str_group + ' input[name="new_range_label"').trigger('change');
        }
    }
    
    $('#id_new_range_include_current_' + str_group + '_button_ok').prop('disabled', true);
}

function setListFieldHeight(come_from_hidden)
{
  str_height = $(document).height();
  if(str_height > 0)
  {
    if(come_from_hidden)
    {
        str_height +=200;
    }

    $(".listitems").css("height", (str_height - 190));
    setListFieldHeightBasedContent();
  }
  else
  {
    setTimeout(function(){ setListFieldHeight(true); }, 1000);
  }
}

function setListFieldHeightBasedContent()
{
  $(".listitems").each(function() {
    if($(this).attr("id") == 'sc_fields_selected' || $(this).attr("id") == 'sc_fields_orderby')
    {
      //calcula altura do conteudo
      str_altura_necessaria = (($(this).find('> li').length + 1) * 34);
      str_altura            = $(".listitems").css("height").replace("px", "");
      if(str_altura_necessaria > str_altura)
      {
        $(".listitems").css("height", str_altura_necessaria + 33);
      }
    }
  });
}

function removeFieldOrderby(str_obj)
{
  removeFieldOrderbyId($(str_obj).parent().attr('val'));
}

function removeFieldOrderbyId(str_val)
{
  $("input[type=checkbox][value="+ str_val +"]").prop('checked', true);
  $("input[type=checkbox][value="+ str_val +"]").click();

  nm_form_modified();
}

function removeAllFieldOrderby()
{
  sc_fields_name = $( '#sc_fields_orderby' ).sortable('toArray', {attribute: 'val'});
  for(it=0; it<sc_fields_name.length; it++)
  {
    removeFieldOrderbyId( sc_fields_name[ it ] );
  }
}

function removeFieldUl(str_obj)
{

    field = $(str_obj).parent().attr('field');
    seq = $(str_obj).parent().attr('seq');
    tipo = $(str_obj).parent().attr('tipo');
    cont = $(str_obj).parent().attr('cont');

    $("input[name='searchField["+ seq +"_#NM#_"+ field +"_#NM#_"+ cont +"]']").remove();
    $(str_obj).parent().remove();

    nm_form_modified();
}

function changeNewRangeValue(str_group)
{
    if ($('#box_new_range_' + str_group + ' input[name="new_range_value"]').val().trim() !== '') {
        var valueOut = '';
        var langTimes = {
            YYYY: {
                s: '{lang_relative_period_year}',
                p: '{lang_relative_period_year_p}'
            },
            QUARTER: {
                s: '{lang_relative_period_quarter}',
                p: '{lang_relative_period_quarter_p}'
            },
            WEEK: {
                s: '{lang_relative_period_week}',
                p: '{lang_relative_period_week_p}'
            },
            MM: {
                s: '{lang_relative_period_month}',
                p: '{lang_relative_period_month_p}'
            },
            DD: {
                s: '{lang_relative_period_day}',
                p: '{lang_relative_period_day_p}'
            },
            HH: {
                s: '{lang_relative_period_hour}',
                p: '{lang_relative_period_hour_p}'
            }
        }
        var langRelative = {
            last: {
                f: {
                    s: '{lang_relative_period_last_f}',
                    p: '{lang_relative_period_last_f_p}'
                },
                m: {
                    s: '{lang_relative_period_last}',
                    p: '{lang_relative_period_last_p}'
                }
            },
            next: {
                f: {
                    s: '{lang_relative_period_next_f}',
                    p: '{lang_relative_period_next_f_p}'
                },
                m: {
                    s: '{lang_relative_period_next}',
                    p: '{lang_relative_period_next_p}'
                }
            }
        }    
        var langToDate = {
            to: {
                f: {
                    now: '{lang_relative_period_until_now_f}',
                    date: '{lang_relative_period_to_day_f}'
                },
                m: {
                    now: '{lang_relative_period_until_now}',
                    date: '{lang_relative_period_to_day}'
                }
            },
            from: {
                f: {
                    now: '{lang_relative_period_from_now_f}',
                    date: '{lang_relative_period_from_today_f}'
                },
                m: {
                    now: '{lang_relative_period_from_now}',
                    date: '{lang_relative_period_from_today}'
                }
            }
        }
        var valueRange = parseInt($('#box_new_range_' + str_group + ' input[name="new_range_value"]').val());
        valueRange = (valueRange > 1) ? valueRange : 1; 
        var valueRelative = $('#box_new_range_' + str_group + ' select[name="new_range_type"] option:checked').attr('value');
        var valueCurrent = $('#box_new_range_' + str_group + ' input[name="new_range_include_current"]').prop('checked') ? true : false;
        var plurality = (valueRange > 1) ? 'p' : 's';
        var gendered = (['HH', 'WEEK'].indexOf(str_group) > -1) ? 'f' : 'm';
        var number = (valueRange > 1) ? valueRange : '';
                    
        valueOut = langRelative[valueRelative][gendered][plurality] + ' ' + number + ' ' + langTimes[str_group][plurality];
        
        if (plurality === 'p') {
            if (valueCurrent) {
                var fromTo = (valueRelative == 'next') ? 'from' : 'to';
                if ( ['DD'].indexOf(str_group) > -1) {
                    valueOut +=  ' ' + langToDate[fromTo][gendered].date;
                } else if (['YYYY', 'QUARTER', 'WEEK', 'MM'].indexOf(str_group) > -1) {
                    valueOut +=  ' ' + langToDate[fromTo][gendered].now;
                }              
            }
        } else {
            $('#box_new_range_' + str_group + ' input[name="new_range_include_current"]').prop('checked', false);
        }
        var runChange = ($('#box_new_range_' + str_group + ' input[name="new_range_label"]').val() !== valueOut);
        
        $('#box_new_range_' + str_group + ' input[name="new_range_value"]').val(valueRange);
        $('#box_new_range_' + str_group + ' input[name="new_range_label"]').val(valueOut);
        $('#id_new_range_include_current_' + str_group + '_button_ok').prop('disabled', false);
        
        if (runChange) $('#box_new_range_' + str_group + ' input[name="new_range_label"]').trigger('change');
    } else {
        $('#box_new_range_' + str_group + ' input[name="new_range_label"]').val('');
        $('#box_new_range_' + str_group + ' input[name="new_range_label"]').trigger('change');
        $('#id_new_range_include_current_' + str_group + '_button_ok').prop('disabled', true);
    }
}

function addNewRange(str_group, bol_direct, arr_val)
{
    var loadLang = false;
    if(!bol_direct)
    {
        if($("#id_new_range_include_current_"+ str_group).prop('checked'))
        {
            str_include = "S";
        }
        else
        {
            str_include = "N";
        }

        str_label  = $("#id_new_range_label_"+ str_group).val();

        str_val = parseInt($("#id_new_range_value_"+ str_group).val(), 10);
        if(isNaN(str_val))
        {
          str_val = 0;
        }

        str_value  = "C";
        str_value += "_!NM!_" + $("#id_new_range_type_"+ str_group +" option:selected").val();
        str_value += "_!NM!_" + str_val;
        str_value += "_!NM!_" + str_label;
        str_value += "_!NM!_" + str_include;
        str_value += "_!NM!_" + str_group;

        str_id     = $("#id_new_range_type_"+ str_group +" option:selected").val() + str_val + str_include + str_group;
        loadLang = true;
    }
    else
    {
        str_label = arr_val[3];

        str_val = arr_val[2];

        str_value = arr_val.join("_!NM!_");

        str_id = arr_val[1] + arr_val[2] + arr_val[4] + arr_val[5];
    }

    if($("#" + str_id).length)
    {
        alert(new_range_already_exist);
    }
    else
    {
        $("#id_relative_" + str_group + " .new-period").before("<label class='checkbox-inline'><input type='checkbox' name='"+ $("#id_filter_relative_period").attr('name') +"' value='"+ str_value +"' onclick=\"checkDefault('default_relative_period', this, '"+ str_label +"', '" + str_group + "')\" /><span id='"+ str_id +"' title='"+ str_val +"'>"+ str_label +" <img src='"+ url_img +"icon_del_trash.png' onclick='delRange(this)' class='box_new_range_trash' border=0></span></label>");
        if (loadLang) translateLabelData(str_id);
        cancelAddNewRange(str_group);
        $("#" + str_id).parent().find("input").click();
    }
    
}

function delRange(obj)
{
    $(obj).parent().find("input").prop('checked', false);
    $(obj).parent().find("input").click();

    $(obj).parent().parent().remove();

    return false;
}

function cancelAddNewRange(str_group)
{
    $("#id_new_range_type_"+ str_group +" option:selected").prop("selected", false);
    $("#id_new_range_type_"+ str_group +" option:first").prop("selected", "selected");

    $("#id_new_range_value_"+ str_group).val('');
    $("#id_new_range_label_"+ str_group).val('');
    $("#id_new_range_include_current_"+ str_group).prop('checked', false);



    $('#box_new_range_' + str_group).hide();
}

function translateLabelData(str_id, callback)
{
    var ids = {};
    var selection = '';
    if (str_id) {
        selection = $('#' + str_id).parent().find('input');
    } else {
        selection = $('#myTabRelativeContent .checkbox-inline input[value^="C_!NM!_"]');
    }
    if (selection.length > 0) {
        selection.each(function (el) {
            var stringTranslate = $(this).prop('value').split(str_sep2)[3];
            var labelSpan = $(this).parent().find('span');
            var loader = '<div class="generic-loader" style="display: inline-block; flex-grow: 1;"><ul><li></li><li></li><li></li><li></li><li></li><li></li></ul></div>';

            labelSpan.css('white-space', 'nowrap');
            labelSpan.css('display', 'flex');
            labelSpan.css('align-items', 'center');
            ids[labelSpan.attr('id')] = stringTranslate;
            labelSpan.html(labelSpan.html().replace(stringTranslate, loader));
        });
        $.ajax({
            type: "POST",
            url: nm_url_iface + 'ajax_function.php',
            data: {
                call: 'translateMultipleStrings',
                data: {
                    'input_texts': ids,
                    'lang': 'default'
                }
            },
            complete: function (a, b) {
                if (a.responseJSON && a.responseJSON.data) {
                    for (var key in a.responseJSON.data) {
                        var label = $('#' + key).html();
                        $('#' + key).css('white-space', 'unset');
                        $('#' + key).css('display', 'inline-block');
                        $('#' + key).css('align-items', 'center');
                        $('#' + key).html(label.replace('<div class="generic-loader" style="display: inline-block; flex-grow: 1;"><ul><li></li><li></li><li></li><li></li><li></li><li></li></ul></div>', a.responseJSON.data[key].translation));
                    }
                }
            },
            dataType: 'json'
        });
    }
}

function translateString(input, callback) {
    $.ajax({
        type: "POST",
        url: nm_url_iface + 'ajax_function.php',
        data: {
            call: 'translateString',
            data: {
                'input_text': input,
                'lang': 'default'
            }
        },
        complete: function (a, b) {
            if (a.responseJSON && a.responseJSON.data) {
                callback(a.responseJSON.data.translation)
            }
        },
        dataType: 'json'
    });
}
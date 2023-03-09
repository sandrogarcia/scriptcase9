$(function() {
  // edit module
  $("#sc-id-chart-type-aux").val($("#sc-id-chart-type").val());
  $("#sc-id-chart-theme-aux").val($("#sc-id-chart-theme").val());

  scShowFieldsChart(0);
  $("#id_tr_flsh_chrt_gauge_color").hide();
  //------------- Alterar gr�fico de acordo com a tela

//    $("[id^='id_rad_flsh_chrt_valor_abrev']").click(function() {
//        $("#graf_val_abrev").val(this.value);
//    });

	$("[id^='id_rad_graf_show_vals']").click(function() {
		$("#graf_show_vals_aux").val(this.value);
    });

  $(".sc-ui-chart-tabs").mouseover(function() {
    $(this).css("cursor", "pointer");
  }).click(function() {
    scEditModule( $(this).attr("id").substr(17) );
    scShowFieldsChart(0);
	scDisplayChartInfo($(this).attr("id").substr(17));
  });

	$( "#sc-chart-new-type" ).change(function() {
        var chartId = $("#sc-id-chart-type-aux").val();
        scShowFieldsChart(chartId);
        scChartInfo();
		scDisplayChartOldFields();
    });


  $("#sc-id-chart-theme").change(function() {
	$("#sc-id-chart-theme-aux").val($("#sc-id-chart-theme").val());
	//scLoadChart();
  });

  $("#sc-id-module-tab-chart").click(function() {
    var chartId = $("#sc-id-chart-type-aux").val();
    scShowFieldsChart(chartId);
	scCheckFields();
	scDisplayChartOldFields();
	//scChartPreview();
	//scLoadChart();
  });

  // item
  $(".sc-ui-chart-item").mouseover(function() {
      if($(this).attr('id').substr(0, 13) != 'sc-ui-metric-')
      {
          $(this).css("cursor", "all-scroll");
      }

  });

     $('input[name^=chart_initial_summary]').click(function(){
         if($(this).is(':checked')) {
             $('#id_sort_metric_' + $(this).val()).show();
         }
         else
         {
             $('#id_sort_metric_' + $(this).val()).hide();
         }
         nm_form_modified();
     });
     $('input[name="chart_function[]"]').click(function()
     {
         nm_form_modified();
         var __sort = $(this).val() == 'NM_Count'? 'NM_Count' : $(this).val().split('_').join('__NM__');
         if($(this).is(':checked'))
         {
             $("input","#sc-ui-initial-metric-" + $(this).val()).attr('checked', 'checked');
             $('#id_sort_metric_' + __sort).show();
             $("#sc-ui-initial-metric-" + $(this).val()).show();
         }
         else
         {
             $("input","#sc-ui-initial-metric-" + $(this).val()).removeAttr('checked');
             if($('input[name=chart_initial_sort]:checked').val() == $('input','#id_sort_metric_' + __sort).val())
             {
                 $('#sc-id-initial-sort-fields').click();
             }
             $('#id_sort_metric_' + __sort).hide();
             $("#sc-ui-initial-metric-" + $(this).val()).hide();
         }
     });

  // filter
  $("#sc-id-filter-options").sortable({
   connectWith: ".sc-ui-filter",
   placeholder: "sc-ui-chart-placeholder"
  }).disableSelection();
  $("#sc-id-filter-selected").sortable({
   connectWith: ".sc-ui-filter",
   placeholder: "sc-ui-chart-placeholder",
   update: function(event, ui) {
    scFilterInfo();
    nm_form_modified();
   },
   receive: function(event, ui) {
    var itemId = ui.item.attr("id").substr(13);
    $("#sc-id-filter-info-" + itemId).show();
    scFilterInfo();
    nm_form_modified();
   },
   remove: function(event, ui) {
    var itemId = ui.item.attr("id").substr(13);
    $("#sc-id-filter-info-" + itemId).hide();
    scFilterInfo();
    nm_form_modified();
   }
  }).disableSelection();
  $(".sc-ui-filter-info-cond").change(function() {
   var itemSeq = $(this).attr("id").substr(23), itemVal = $(this).val();
   nm_form_modified();
   if ("betw" == itemVal) {
    $("#sc-id-filter-info-param-" + itemSeq).show();
    $("#sc-id-filter-date-info-" + itemSeq).show();
    $("#sc-id-filter-info-betw-" + itemSeq).show();
   }
   else {
    $("#sc-id-filter-info-betw-" + itemSeq).hide();
    if ("date" == $("#sc-id-filter-info-type-" + itemSeq).val()) {
     if ("eq" == itemVal || "diff" == itemVal || "lt" == itemVal || "le" == itemVal || "ge" == itemVal || "gt" == itemVal) {
      $("#sc-id-filter-date-info-" + itemSeq).show();
     }
     else {
      $("#sc-id-filter-date-info-" + itemSeq).hide();
     }
    }
    else if ("number" == $("#sc-id-filter-info-type-" + itemSeq).val()) {
     if ("null" == itemVal || "nnull" == itemVal) {
      $("#sc-id-filter-info-param-" + itemSeq).hide();
     }
     else {
      $("#sc-id-filter-info-param-" + itemSeq).show();
     }
    }
    else if ("text" == $("#sc-id-filter-info-type-" + itemSeq).val()) {
     if ("eq" == itemVal || "diff" == itemVal || "cont" == itemVal || "ncont" == itemVal || "begin" == itemVal || "in" == itemVal) {
      $("#sc-id-filter-info-param-" + itemSeq).show();
     }
     else {
      $("#sc-id-filter-info-param-" + itemSeq).hide();
     }
    }
   }
  });
  $(".sc-ui-filter-info-param").change(function() {
   nm_form_modified();
  });
  $(".sc-ui-filter-cond").click(function() {
   nm_form_modified();
  });
  $("#sc-id-record-count-label").change(function() {
   nm_form_modified();
  });
  $(".sc-ui-filter-date-format").change(function() {
   nm_form_modified();
  });
  $(".sc-ui-filter-info-dsel").change(function() {
   nm_form_modified();
  });
  $(".sc-ui-filter-info-dtext").change(function() {
   nm_form_modified();
  });

  $("input[id^='id_int_flsh_chrt_gauge_color']").change(function() {

	if ($('#id_chk_percent').is(':checked') == true){
		if ($(this).val() > 100 || $(this).val() <= 0){
			var a = $(this).offset().top - $('#div_intervalos').offset().top;
			$("#err_percent").css('margin-top', a + 20 + 'px');
			$("#err_percent").show();
		}else{
			$("#err_percent").hide();
		}
	}else{
		$("#err_percent").hide();
	}
  });

  $('#id_chk_percent').click(function() {
	if ($(this).is(':checked') == false){
		$("#err_percent").hide();
	}
  });

  $('#id_flsh_chrt_pizza_orden').change(function() {
	$("#flsh_chrt_pizza_orden_aux").val($(this).val());
  });

  $("input[id^='sc-id-filter-info-param']").each(function() {
     if ($(this).val() != ''){
		$('#sc-id-filter-op-selected').val($(this).val());
	 }
  });

  scFilterInfo();
  scChartInfo();
 });

function scCheckFields() //Verificar a marca��o de cada campo para exibir o gr�fico
{
    switch($('#sc-id-chart-type').val()) {
        case '100': //BARRA
            if ($("#id_flsh_chrt_barra_dimen").val() == '3d'){
                if ($('#id_flsh_chrt_barra_orien').val() == 'Horizontal'){
                    $("#sc-id-chart-type-aux").val('110');
                }else{
                    $("#sc-id-chart-type-aux").val('100');
                }
            }else{
                if ($('#id_flsh_chrt_barra_orien').val() == 'Horizontal'){
                    $("#sc-id-chart-type-aux").val('113');
                }else{
                    $("#sc-id-chart-type-aux").val('112');
                }
            }
            if ($("#id_flsh_chrt_barra_position_value").val() == 'dentro') {
                $("#graf_val_position").val('1');
            }else{
                $("#graf_val_position").val('0');
            }
            if ($("#id_flsh_chrt_barra_orien_value").val() == 'Horizontal'){
                $("#flsh_chrt_barra_orien_value_aux").val('0');
            }else{
                $("#flsh_chrt_barra_orien_value_aux").val('1');
            }
            if ($("#id_flsh_chrt_barra_position_value").val() == 'dentro'){
                $("#flsh_chrt_barra_position_value_aux").val('1');
            }else{
                $("#flsh_chrt_barra_position_value_aux").val('0');
            }
            $("#flsh_chrt_barra_larg_barra_aux").val($("#id_flsh_chrt_barra_larg_barra").val());
            break;
        case '101'://Pizza
            if ($("#id_flsh_chrt_pizza_forma").val() == 'Pie') {
                if ($("#id_flsh_chrt_pizza_dimen").val() == '3d'){
                    $("#sc-id-chart-type-aux").val('101');
                }else{
                    $("#sc-id-chart-type-aux").val('114');
                }
            }else{
                if ($("#id_flsh_chrt_pizza_dimen").val() == '3d'){
                    $("#sc-id-chart-type-aux").val('111');
                }else{
                    $("#sc-id-chart-type-aux").val('115');
                }
            }
            if ($("#id_flsh_chrt_pizza_valor").val() == 'Valor'){
                $("#flsh_chrt_pizza_valor_aux").val('0');
            }else{
                $("#flsh_chrt_pizza_valor_aux").val('1');
            }
			$("#flsh_chrt_pizza_orden_aux").val($("#id_flsh_chrt_pizza_orden").val());


            break;
        case '102'://Linha
            switch ($("#id_flsh_chrt_linha_forma").val()) {
                case 'Line':
                    $("#sc-id-chart-type-aux").val('102');
                    break;
                case 'Spline':
                    $("#sc-id-chart-type-aux").val('116');
                    break;
                case 'Step':
                    $("#sc-id-chart-type-aux").val('117');
                    break;
            }
            break;
        case '103'://Area
            switch ($("#id_flsh_chrt_area_forma").val()) {
                case 'Area':
                    $("#sc-id-chart-type-aux").val('103');
                    break;
                case 'Spline':
                    $("#sc-id-chart-type-aux").val('118');
                    break;
            }
            break;
        case '105':
//            if ($("#id_flsh_chrt_gauge_valor").val() == 'Valor'){
//                $("#flsh_chrt_gauge_valor_aux").val('');
//            }else{
//                $("#flsh_chrt_gauge_valor_aux").val('%');
//            }
//			$("#flsh_chrt_gauge_border_aux").val($("#id_flsh_chrt_gauge_border").val());
//                        $("#flsh_chrt_gauge_size_aux").val($("#id_flsh_chrt_gauge_size").val());

			$("#flsh_chrt_gauge_bas_color_aux").val($("#id_flsh_chrt_gauge_base").val());

			var elemento = $('[id^="id_flsh_chrt_gauge_color"]');
			var strColors = "";
			for(i=0;i<elemento.length;i++){
				strColors +=  elemento[i].value + ";";
			}

			$("#flsh_chrt_gauge_color_aux").val(strColors);

			var elemento = $('[id^="id_int_flsh_chrt_gauge_color"]');
			var strIntv = "";
			for(i=0;i<elemento.length;i++){
				strIntv +=  elemento[i].value + ";";
			}

			$("#flsh_chrt_gauge_int_color_aux").val(strIntv);

			$("#flsh_chrt_gauge_perc_aux").val($("#id_chk_percent").is(":checked"));
			$("#flsh_chart_use_interv_aux").val($("#id_chk_intervalos").is(":checked"));

            break;

        case '108':
            if ($("#id_flsh_chrt_funil_dimen").val() == '2d'){
                $("#flsh_chrt_funil_dimen_aux").val('1');
            }else{
                $("#flsh_chrt_funil_dimen_aux").val('0');
            }
            break;
        case '109':
            if ($("#id_flsh_chrt_pyramid_dimen").val() == '2d'){
                $("#flsh_chrt_pyramid_dimen_aux").val('1');
            }else{
                $("#flsh_chrt_pyramid_dimen_aux").val('0');
            }
            if ($("#id_flsh_chrt_pyramid_valor").val() == 'Valor'){
                $("#flsh_chrt_pyramid_valor_aux").val('0');
            }else{
                $("#flsh_chrt_pyramid_valor_aux").val('1');
            }
            break;
    }

    $("#baseFontSize_aux").val($("#id_graf_size_font_val").val());
    $("#graf_subtitle_val_aux").val($("#id_graf_subtitle_val").val());

	$("#chart_use_link_aux").val($("#id_chart_use_link").val());
	$("#chart_new_version_aux").val($("#id_chart_new_version").val());
	//$("#graf_show_vals_aux").val($("#id_graf_show_vals").val());
	$("#eixo_graf_tot_geral_aux").val($("#id_eixo_graf_tot_geral").val());
	$("#Graf_Largura_aux").val($("#id_Graf_Largura").val());
	$("#Graf_Altura_aux").val($("#id_Graf_Altura").val());
	$("#graf_order_val_aux").val($("#id_graf_order_val").val());

    if ($("#id_flsh_chrt_gauge_forma").val() == 'Semi'){
        $("#flsh_chrt_gauge_forma_aux").val('0');
    }else{
        $("#flsh_chrt_gauge_forma_aux").val('1');
    }

}

function scLoadChart()
{
    //viewChart($("#sc-id-chart-theme").val(),'');
    scCheckFields();
    //scChartPreview();
}

function viewChart(str_chart, str_editor)
{
    if(str_chart != '__NEW__')
    {
        param = 'ajax=true&';
        param = param + 'str_option=view_chart&';
        param = param + 'str_chart=' + str_chart + '&';
        param = param + 'str_editor=' + str_editor;
        $.ajax({
            type: 'POST',
            url:  'chart_preview.php',
            async: false,
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
        setViewChart(this.str_separ + str_chart + this.str_separ  + str_editor);
    }
}

function setViewChart(str_return)
{
    var $str_separ = '_@NM@_';
    var $str_separ1 = '_#NM#_';

    str_return = str_return.split($str_separ);
    arr_schema = str_return[3].split($str_separ1);

    changeChart(arr_schema);
}

function changeChart(arr_schema)
{
    $("#chartRightMargin_aux").val(arr_schema[3]);
    $("#chartBottomMargin_aux").val(arr_schema[4]);
    $("#chartLeftMargin_aux").val(arr_schema[5]);
    $("#canvasPadding_aux").val(arr_schema[6]);
    $("#valuePadding_aux").val(arr_schema[7]);
    $("#baseFontColor_aux").val(arr_schema[8]);
    //$("#baseFontSize_aux").val(arr_schema[9]);
    $("#bgColor_aux").val(arr_schema[10]);
    $("#numDivLines_aux").val(arr_schema[11]);
    $("#divLineColor_aux").val(arr_schema[12]);
    $("#canvasBgColor_aux").val(arr_schema[13]);
    $("#canvasBgAlpha_aux").val('50,50');
    $("#canvasBgAngle_aux").val('90');
    $("#paletteColors_aux").val(arr_schema[14]);
    $("#ShowBorder_aux").val(arr_schema[15]);
    $("#borderThickness_aux").val(arr_schema[16]);
    $("#borderColor_aux").val(arr_schema[17]);
    $("#plotBorderDashed_aux").val(arr_schema[18]);
    $("#showShadow_aux").val(arr_schema[19]);
    $("#use3DLighting_aux").val(arr_schema[20]);
}

function scEditModule(moduleId) {
    $(".sc-ui-chart-data").hide();
    $(".sc-ui-chart-data-" + moduleId).show();
    $(".sc-ui-chart-tabs").removeClass("sc-ui-chart-selector-on");
    $("#sc-id-module-tab-" + moduleId).addClass("sc-ui-chart-selector-on");
    if ("chart" == moduleId) {
      $('#id_tr_chart_analitico_sintetico').show();
      $('#id_tr_chart_tot_geral').show();
    }
    else
    {
      $('#id_tr_chart_analitico_sintetico').hide();
      $('#id_tr_chart_tot_geral').hide();
    }
}
 //=============================================================================
 //Felipe - 06/05/2014
 //Fun��o para exibir op��es de edi��o de acordo com o tipo de gr�fico
 function scShowFieldsChart(chartId) {

//  Valores padr�es, s� s�o exibidos se a aba selecionada for de gr�fico
    if (chartId == '0'){
        $('tr[id^="id_tr_graf_export"]').hide();
        $('tr[id^="id_tr_graf_size_font"]').hide();
        $('tr[id^="id_tr_flsh_chrt_valor_abrev"]').hide();
        $('tr[id^="id_tr_graf_subtitle"]').hide();
    		$('tr[id^="id_tr_chart_use_link"]').hide();
    		$('tr[id^="id_tr_chart_new_version"]').hide();
    		$('tr[id^="id_tr_graf_show_vals"]').hide();
    		$('tr[id^="id_tr_chart_display_value_except"]').hide();
    		$('tr[id^="id_tr_chart_orientacao_eixo_x"]').hide();
    		$('tr[id^="id_tr_eixo_graf_tot_geral"]').hide();
    		$('tr[id^="id_tr_Graf_Largura"]').hide();
    		$('tr[id^="id_tr_Graf_Altura"]').hide();
        $('tr[id^="id_tr_graf_order_val"]').hide();
        $('tr[id^="id_tr_chart_analitico_sintetico"]').hide();
    		$('tr[id^="id_tr_chart_tot_geral"]').hide();
    		$('tr[id^="id_tr_tooltip_expanded"]').hide();
    		$('tr[id^="id_tr_adaptive_y_axis"]').hide();
    		$('tr[id^="id_tr_chart_trendline"]').hide();
    } else {
        $('tr[id^="id_tr_graf_export"]').show();
        $('tr[id^="id_tr_graf_size_font"]').show();
        $('tr[id^="id_tr_flsh_chrt_valor_abrev"]').show();
        $('tr[id^="id_tr_graf_subtitle"]').show();
    		$('tr[id^="id_tr_chart_use_link"]').show();
    		$('tr[id^="id_tr_chart_new_version"]').show();
    		$('tr[id^="id_tr_graf_show_vals"]').show();
    		$('tr[id^="id_tr_chart_display_value_except"]').show();
    		$('tr[id^="id_tr_chart_orientacao_eixo_x"]').show();
    		$('tr[id^="id_tr_eixo_graf_tot_geral"]').show();
    		$('tr[id^="id_tr_Graf_Largura"]').show();
    		$('tr[id^="id_tr_Graf_Altura"]').show();
    		$('tr[id^="id_tr_graf_order_val"]').show();
        $('tr[id^="id_tr_chart_analitico_sintetico"]').show();
        $('tr[id^="id_tr_chart_tot_geral"]').show();
        $('tr[id^="id_tr_tooltip_expanded"]').show();
        $('tr[id^="id_tr_adaptive_y_axis"]').show();
        $('tr[id^="id_tr_chart_trendline"]').show();
        nm_change_chart_trendline($('select[name="chart_trendline"]').val());
    }
//-------------   OCUTANDO TODOS OS CAMPOS -----------------------
//  Gr�fico de Barras
    $('tr[id^="id_tr_flsh_chrt_barra"]').hide();
//  Gr�fico de Pizza
    $('tr[id^="id_tr_flsh_chrt_pizza"]').hide();
//  Gr�fico de Linha
    $('tr[id^="id_tr_flsh_chrt_linha"]').hide();
//  Gr�fico de �rea
    $('tr[id^="id_tr_flsh_chrt_area"]').hide();
//  Gr�fico de Gauge
    //$('tr[id^="id_tr_flsh_chrt_gauge"]').hide();
//  Gr�fico de Funil
    $('tr[id^="id_tr_flsh_chrt_funil"]').hide();
//  Gr�fico de Pir�mide
    $('tr[id^="id_tr_flsh_chrt_pyramid"]').hide();


//---- EXIBINDO OS CAMPOS DE ACORDO COM O GR�FICO SELECIONADO ----
    switch(chartId) {
      case '100': //BARRA
          //exibir todos os TR's que comecem com id_tr_flsh_chrt_barra
          $('tr[id^="id_tr_flsh_chrt_barra"]').show();
          break;
      case '101': //PIZZA
          $('tr[id^="id_tr_flsh_chrt_pizza"]').show();
          break;
      case '102': //LINHA
          $('tr[id^="id_tr_flsh_chrt_linha"]').show();
          break;
      case '103': //AREA
          $('tr[id^="id_tr_flsh_chrt_area"]').show();
          break;
      case '105': //GAUGE
          $('tr[id^="id_tr_flsh_chrt_gauge"]').show();
          break;
      case '108': //FUNIL
          $('tr[id^="id_tr_flsh_chrt_funil"]').show();
          break;
      case '109': //PIRAMIDE
          $('tr[id^="id_tr_flsh_chrt_pyramid"]').show();
          break;
     }
 }
 //=============================================================================



 function scFilterPostInfo(filterFields) {
  var i, seq, info, filterInfo = new Array;
  for (i = 0; i < filterFields.length; i++) {
   seq = filterFields[i].substr(13);
   info = seq + "__SC_SEP2__"
        + $("#sc-id-filter-info-type-" + seq).val() + "__SC_SEP2__"
        + $("#sc-id-filter-info-cond-" + seq).val() + "__SC_SEP2__";
   if ('date' == $("#sc-id-filter-info-type-" + seq).val()) {
    info += $("#sc-id-filter-info-dparam-" + seq).val() + "__SC_SEP2__";
    info += $("#sc-id-filter-info-dparam2-" + seq).val() + "__SC_SEP2__";
    info += $("#sc-id-filter-info-dparam3-" + seq).val() + "__SC_SEP2__";
    info += $("#sc-id-filter-info-dparam4-" + seq).val() + "__SC_SEP2__";
    info += $("#sc-id-filter-info-dparam5-" + seq).val() + "__SC_SEP2__";
    info += $("#sc-id-filter-info-dparam6-" + seq).val();
   }
   else if ('number' == $("#sc-id-filter-info-type-" + seq).val()) {
    info += $("#sc-id-filter-info-param-" + seq).val() + "__SC_SEP2__";
    info += $("#sc-id-filter-info-param2-" + seq).val() + "__SC_SEP2____SC_SEP2____SC_SEP2____SC_SEP2__";
   }
   else {
    info += $("#sc-id-filter-info-param-" + seq).val() + "__SC_SEP2____SC_SEP2____SC_SEP2____SC_SEP2____SC_SEP2__";
   }
   filterInfo.push(info);
  }
  return filterInfo.join("__SC_SEP__");
 }

  function scFilterInfo() {
  var filters = $("#sc-id-filter-selected").sortable("toArray"), i, itemSeq, itemList = new Array;
  for (i = 0; i < filters.length; i++) {
   itemSeq = parseInt(filters[i].substr(13));
   itemList.push(fieldNames[itemSeq]);
  }
  if (0 == itemList.length) {
   $("#sc-id-tab-filter-error").show();
   $("#sc-id-tab-filter-info").hide();
  }
  else {
   $("#sc-id-tab-filter-error").hide();
   $("#sc-id-tab-filter-info").html("<br />" + itemList.join(", ")).show();
  }
 }
 function scChartInfo() {
  $("#sc-id-tab-chart-info").html("<br />" + $("#sc-chart-new-type option:selected").text());
 }
 function scChartPreview() {
  $("<form action='chart_preview.php' target='ifrm_preview' method='post'></form>")
   .append("<input type='hidden' name='chart_filter' value='" + $("#sc-id-filter-selected").sortable("toArray").join("__SC_SEP__") + "' />")
   .append("<input type='hidden' name='chart_filter_param' value='" + $("#sc-id-filter-op-selected").val() + "' />")
   .append("<input type='hidden' name='chart_filter_param2' value='" + $("#sc-id-filter-op-selected").val() + "' />")
   .append("<input type='hidden' name='chart_function' value='" + scMetricPostInfo() + "' />")
   .append("<input type='hidden' name='chart_function_total' value='" + $("#sc-id-metric-total").prop("checked") + "' />")
   .append("<input type='hidden' name='chart_sc-id-chart-type-aux' value='" + $("#sc-id-chart-type-aux").val() + "' />")
   .append("<input type='hidden' name='chart_sc-id-chart-theme-aux' value='" + $("#sc-id-chart-theme-aux").val() + "' />")
   .append("<input type='hidden' name='chartTopMargin' id='chartTopMargin' value='" + $("#chartTopMargin_aux").val() + "' />")
   .append("<input type='hidden' name='chartRightMargin' id='chartRightMargin' value='" + $("#chartRightMargin_aux").val() + "' />")
   .append("<input type='hidden' name='chartBottomMargin' id='chartBottomMargin' value='" + $("#chartBottomMargin_aux").val() + "' />")
   .append("<input type='hidden' name='chartLeftMargin' id='chartLeftMargin' value='" + $("#chartLeftMargin_aux").val() + "' />")
   .append("<input type='hidden' name='canvasPadding' id='canvasPadding' value='" + $("#canvasPadding_aux").val() + "' />")
   .append("<input type='hidden' name='valuePadding' id='valuePadding' value='" + $("#valuePadding_aux").val() + "' />")
   .append("<input type='hidden' name='baseFontColor' id='baseFontColor' value='" + $("#baseFontColor_aux").val() + "' />")
   .append("<input type='hidden' name='bgColor' id='bgColor' value='" + $("#bgColor_aux").val() + "' />")
   .append("<input type='hidden' name='numDivLines' id='numDivLines' value='" + $("#numDivLines_aux").val() + "' />")
   .append("<input type='hidden' name='divLineColor' id='divLineColor' value='" + $("#divLineColor_aux").val() + "' />")
   .append("<input type='hidden' name='canvasBgColor' id='canvasBgColor' value='" + $("#canvasBgColor_aux").val() + "' />")
   .append("<input type='hidden' name='canvasBgAlpha' id='canvasBgAlpha' value='50,50'")
   .append("<input type='hidden' name='canvasBgAngle' id='canvasBgAngle' value='90'")
   .append("<input type='hidden' name='paletteColors' id='paletteColors' value='" + $("#paletteColors_aux").val() + "' />")
   .append("<input type='hidden' name='ShowBorder' id='ShowBorder' value='" + $("#ShowBorder_aux").val() + "' />")
   .append("<input type='hidden' name='borderThickness' id='borderThickness' value='" + $("#borderThickness_aux").val() + "' />")
   .append("<input type='hidden' name='borderColor' id='borderColor' value='" + $("#borderColor_aux").val() + "' />")
   .append("<input type='hidden' name='plotBorderDashed' id='plotBorderDashed' value='" + $("#plotBorderDashed_aux").val() + "' />")
   .append("<input type='hidden' name='showShadow' id='showShadow' value='" + $("#showShadow_aux").val() + "' />")
   .append("<input type='hidden' name='use3DLighting' id='use3DLighting' value='" + $("#use3DLighting_aux").val() + "' />")

   .append("<input type='hidden' name='baseFontSize' id='baseFontSize' value='" + $("#baseFontSize_aux").val() + "' />")
   .append("<input type='hidden' name='chart_graf_val_abrev' value='" + $("#graf_val_abrev").val() + "' />")
   .append("<input type='hidden' name='graf_subtitle_val' id='graf_subtitle_val' value='" + $("#graf_subtitle_val_aux").val() + "' />")

   .append("<input type='hidden' name='chart_use_link' id='chart_use_link' value='" + $("#chart_use_link_aux").val() + "' />")
   .append("<input type='hidden' name='chart_new_version' id='chart_new_version' value='" + $("#chart_new_version_aux").val() + "' />")
   .append("<input type='hidden' name='graf_show_vals' id='graf_show_vals' value='" + $("#graf_show_vals_aux").val() + "' />")
   .append("<input type='hidden' name='eixo_graf_tot_geral' id='eixo_graf_tot_geral' value='" + $("#eixo_graf_tot_geral_aux").val() + "' />")
   .append("<input type='hidden' name='Graf_Largura' id='Graf_Largura' value='" + $("#Graf_Largura_aux").val() + "' />")
   .append("<input type='hidden' name='Graf_Altura' id='Graf_Altura' value='" + $("#Graf_Altura_aux").val() + "' />")
   .append("<input type='hidden' name='graf_order_val' id='graf_order_val' value='" + $("#graf_order_val_aux").val() + "' />")

   .append("<input type='hidden' name='flsh_chrt_barra_larg_barra' id='flsh_chrt_barra_larg_barra' value='" + $("#flsh_chrt_barra_larg_barra_aux").val() + "' />")
   .append("<input type='hidden' name='flsh_chrt_barra_orien_value' id='flsh_chrt_barra_orien_value' value='" + $("#flsh_chrt_barra_orien_value_aux").val() + "' />")
   .append("<input type='hidden' name='flsh_chrt_barra_position_value' id='flsh_chrt_barra_position_value' value='" + $("#flsh_chrt_barra_position_value_aux").val() + "' />")
   .append("<input type='hidden' name='flsh_chrt_pizza_valor' id='flsh_chrt_pizza_valor' value='" + $("#flsh_chrt_pizza_valor_aux").val() + "' />")
   .append("<input type='hidden' name='flsh_chrt_pizza_orden' id='flsh_chrt_pizza_orden' value='" + $("#flsh_chrt_pizza_orden_aux").val() + "' />")
   .append("<input type='hidden' name='flsh_chrt_funil_dimen' id='flsh_chrt_funil_dimen' value='" + $("#flsh_chrt_funil_dimen_aux").val() + "' />")
   .append("<input type='hidden' name='flsh_chrt_pyramid_dimen' id='flsh_chrt_pyramid_dimen' value='" + $("#flsh_chrt_pyramid_dimen_aux").val() + "' />")
   .append("<input type='hidden' name='flsh_chrt_pyramid_valor' id='flsh_chrt_pyramid_valor' value='" + $("#flsh_chrt_pyramid_valor_aux").val() + "' />")
   .append("<input type='hidden' name='flsh_chrt_gauge_forma' id='flsh_chrt_gauge_forma' value='" + $("#flsh_chrt_gauge_forma_aux").val() + "' />")
//   .append("<input type='hidden' name='flsh_chrt_gauge_valor' id='flsh_chrt_gauge_valor' value='" + $("#flsh_chrt_gauge_valor_aux").val() + "' />")
//   .append("<input type='hidden' name='flsh_chrt_gauge_border' id='flsh_chrt_gauge_border' value='" + $("#flsh_chrt_gauge_border_aux").val() + "' />")
//   .append("<input type='hidden' name='flsh_chrt_gauge_size' id='flsh_chrt_gauge_size' value='" + $("#flsh_chrt_gauge_size_aux").val() + "' />")
   .append("<input type='hidden' name='flsh_chrt_gauge_base' id='flsh_chrt_gauge_base' value='" + $("#flsh_chrt_gauge_bas_color_aux").val() + "' />")
   .append("<input type='hidden' name='flsh_chrt_gauge_intv' id='flsh_chrt_gauge_intv' value='" + $("#flsh_chrt_gauge_int_color_aux").val() + "' />")
   .append("<input type='hidden' name='flsh_chrt_gauge_colr' id='flsh_chrt_gauge_colr' value='" + $("#flsh_chrt_gauge_color_aux").val() + "' />")
   .append("<input type='hidden' name='flsh_chrt_gauge_color' id='flsh_chrt_gauge_color' value='" + $("#flsh_chrt_gauge_color_aux").val() + "' />")
   .append("<input type='hidden' name='flsh_chrt_gauge_perc' id='flsh_chrt_gauge_perc' value='" + $("#flsh_chrt_gauge_perc_aux").val() + "' />")
   .append("<input type='hidden' name='flsh_chart_use_interv' id='flsh_chart_use_interv' value='" + $("#flsh_chart_use_interv_aux").val() + "' />")

   .appendTo("body")
   .submit()
   .remove();
 }

function scDisplayChartInfo(tabName) {
	if ("chart" != tabName) {
		$("#id_tr_flsh_chrt_gauge_color").hide();
	}
	else {
		scDisplayChartOldFields();
	}
}

function scDisplayChartOldFields() {
	scDisplayChartBarInfo();
	scDisplayChartPieInfo();
	scDisplayChartPyramidInfo();
	scDisplayChartGaugeInfo()
}

function scDisplayChartBarInfo() {
	$("#id_tr_flsh_chrt_barra_position_value").show();
	$("#id_tr_flsh_chrt_barra_larg_barra").show();
	$("#id_tr_flsh_chrt_barra_orien_value").show();
	$("#id_tr_flsh_chrt_barra_empil").show();
}

function scDisplayChartPieInfo() {
	$("#id_tr_flsh_chrt_pizza_valor").show();
}

function scDisplayChartPyramidInfo() {
	$("#id_tr_flsh_chrt_pyramid_valor").show();
}

function scDisplayChartGaugeInfo() {
	$("#id_tr_flsh_chrt_gauge_color").show();
}

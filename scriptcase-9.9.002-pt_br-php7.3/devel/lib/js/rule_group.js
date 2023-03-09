function nm_form_modified()
{
  document.form_edit.form_modified.value = 'Y';
}

function nm_edit_save(str_section, mix_param, str_fld_section)
{
 document.form_edit.field_fld_section.value = str_fld_section;
 document.form_edit.redirect_to.value      = str_section;
 document.form_edit.redirect_param.value   = mix_param;
 nm_send_form("save");
}

function nm_save_group_by(str_option)
{
	sc_group_by_fields_selected = $( "#sc_group_by_fields_selected" ).sortable( "toArray", { attribute: "field" }  );
	selected_fields = "";
	if(sc_group_by_fields_selected.length > 0)
	{
            for(it=0; it<sc_group_by_fields_selected.length; it++)
            {
                arr_field = sc_group_by_fields_selected[it].split('__NM__');
                selected_fields += sc_group_by_fields_selected[it];
                str_start = 'N';
                if($( "input[name=id_start_" + arr_field[2] + "]").prop('checked'))
                {
                    str_start = 'Y';
                }

                selected_fields += "_#NM#_start_#NM#_" + str_start;
                if(str_type == 'normal')
                {
                    selected_fields += "_#NM#_axis_#NM#_" + $( "#id_axis_"+ arr_field[2]).val();
                }
                if($( "#id_div_format_"+ arr_field[2] +"_data" ).length && $( "#id_div_format_"+ arr_field[2] +"_data" ).css('display') != 'none')
                {
                    selected_fields += "_#NM#_data";
                    $( "#id_format_"+ arr_field[2] +"_data option" ).each(function () {
                        if($(this).prop('selected'))
                        {
                            selected_fields += "_#NM#_" + $(this).val();
                        }
                    });
                }
                else if($( "#id_div_format_"+ arr_field[2] +"_option" ).length && $( "#id_div_format_"+ arr_field[2] +"_option" ).css('display') != 'none')
                {
                    selected_fields += "_#NM#_option";
                    $( "#id_format_"+ arr_field[2] +"_option option" ).each(function () {
                        if($(this).prop('selected'))
                        {
                            selected_fields += "_#NM#_" + $(this).val();
                        }
                    });
                }
                selected_fields += "_@NM@_";
            }
	}
	$("#selected_fields").val( selected_fields );

	sc_group_by_fields_selected_total = $( "#sc_group_by_fields_selected_total" ).sortable( "toArray", { attribute: "field" }  );
	selected_totals = "";
	if(sc_group_by_fields_selected_total.length > 0)
	{
            for(it=0; it<sc_group_by_fields_selected_total.length; it++)
            {
                arr_field = sc_group_by_fields_selected_total[it].split('__NM__');
                selected_totals += sc_group_by_fields_selected_total[it];
                selected_totals += "_#NM#_start_#NM#_" + $( "#id_start_"+ arr_field[2]).val();
                if($( "#id_div_format_"+ arr_field[2] +"_data" ).length && $( "#id_div_format_"+ arr_field[2] +"_data" ).css('display') != 'none')
                {
                    selected_totals += "_#NM#_data";
                    $( "#id_format_"+ arr_field[2] +"_data option" ).each(function () {
                        if($(this).prop('selected'))
                        {
                            selected_totals += "_#NM#_" + $(this).val();
                        }
                    });
                }
                else if($( "#id_div_format_"+ arr_field[2] +"_option" ).length && $( "#id_div_format_"+ arr_field[2] +"_option" ).css('display') != 'none')
                {
                    selected_totals += "_#NM#_option";
                    $( "#id_format_"+ arr_field[2] +"_option option" ).each(function () {
                        if($(this).prop('selected'))
                        {
                            selected_totals += "_#NM#_" + $(this).val();
                        }
                    });
                }
                selected_totals += "_@NM@_";
            }
	}
	$("#selected_totals").val( selected_totals );

	sc_group_by_fields_selected_resume = $( "#sc_group_by_fields_selected_resume" ).sortable( "toArray", { attribute: "field" }  );
	selected_resume = "";
	if(sc_group_by_fields_selected_resume.length > 0)
	{
		for(it=0; it<sc_group_by_fields_selected_resume.length; it++)
		{
			arr_field = sc_group_by_fields_selected_resume[it].split('__NM__');
			selected_resume += sc_group_by_fields_selected_resume[it];
			str_start = 'N';
			if($( "input[name=id_start_" + arr_field[2] + "]").prop('checked'))
			{
				str_start = 'Y';
			}
			selected_resume += "_#NM#_start_#NM#_" + str_start;

			if($( "#id_div_format_"+ arr_field[2] +"_data" ).length && $( "#id_div_format_"+ arr_field[2] +"_data" ).css('display') != 'none')
			{
				selected_resume += "_#NM#_data";
				$( "#id_format_"+ arr_field[2] +"_data option" ).each(function () {
					if($(this).prop('selected'))
					{
						selected_resume += "_#NM#_" + $(this).val();
					}
				});
			}
			else if($( "#id_div_format_"+ arr_field[2] +"_option" ).length && $( "#id_div_format_"+ arr_field[2] +"_option" ).css('display') != 'none')
			{
				selected_resume += "_#NM#_option";
				$( "#id_format_"+ arr_field[2] +"_option option" ).each(function () {
					if($(this).prop('selected'))
					{
						selected_resume += "_#NM#_" + $(this).val();
					}
				});
			}
			selected_resume += "_@NM@_";
		}
	}
	$("#selected_resume").val( selected_resume );

	/*
	inicial_total = '';
	$( "#id_campos_iniciais_total li" ).each(function () {
		inicial_total += $(this).attr('start') + $(this).attr('field') + "_@NM@_";
	});
	$("#inicial_total").val( inicial_total );

	inicial_resume = '';
	$( "#id_campos_iniciais_resume li" ).each(function () {
		inicial_resume += $(this).attr('start') + $(this).attr('field') + "_@NM@_";
	});
	$("#inicial_resume").val( inicial_resume );
	*/

	if(typeof(str_option) != 'undefined')
	{
		document.form_edit.form_option.value   = str_option;
	}

	if(str_rule_group_origem == 'group')
	{
		document.form_edit.submit();
	}
}

function selectAllFormats(id_div_pai, bol_check)
{
	$("#"+ id_div_pai +" input[type=checkbox]").prop('checked', bol_check);
	if(bol_check)
	{
		$("#"+ id_div_pai +" label").addClass('ui-state-active');
	}
	else
	{
		$("#"+ id_div_pai +" label").removeClass('ui-state-active');
	}
}

function setAxis(axi, input_id, bol_user, bol_force)
{
	id_cont = input_id.substr(12);
	id_cont = id_cont.split('_');
	id_cont = id_cont[0];

	//apenas realiza troca se o elemento clicado n for o ultimo
	if(last_li != id_cont || bol_force)
	{
		//esconde valor antigo
		$("#id_div_axis_" + id_cont + '_' + $("#id_axis_" + id_cont).val()).hide();

		//muda valor
		$("#id_axis_" + id_cont).val( axi );

		//mostra novo valor
		$("#id_div_axis_" + id_cont + '_' + $("#id_axis_" + id_cont).val()).show();

		if(bol_user)
		{
			checkAxis();
		}
	}

	nm_form_modified();
}

last_li = "";
function checkAxis()
{
	last_li = "";
	arr_y = [];
	if($( "#sc_group_by_fields_selected").find("li").length)
	{
		if($(this).length)
		{
			$( "#sc_group_by_fields_selected").children("li").each(function() {
				arr_original = $(this).attr('field').split('__NM__');

				last_li = arr_original[2];

				if($('#id_axis_' + arr_original[2]).val() == 'Y')
				{
					arr_y.push(arr_original[2]);
				}
				else
				{
					//se tiver y antes do x, converte todos para x
					for(it=0; it<arr_y.length; it++)
					{
						setAxis('X', 'id_div_axis_' + arr_y[it] + '_Y', false, false);
					}
					arr_y = [];
				}
			});
		}
	}

	//o ultimo sempre eh y
	if(last_li != "")
	{
		if($('#id_axis_' + last_li).val() == 'X')
		{
			setAxis('Y', 'id_div_axis_' + last_li + '_X', false, true);
		}

		//$('#id_div_axis_'+ last_li +'_y').css('cursor', 'default');
	}
}

function checkOptionOrder(str_id)
{
	/*
	id_div_lsita = $("#" + str_id).parent().parent().parent().attr('id');
	str_list_dest = "";
	if(id_div_lsita == 'sc_group_by_fields_selected_total')
	{
		str_list_dest = 'id_campos_iniciais_total';
	}
	else if(id_div_lsita == 'sc_group_by_fields_selected_resume')
	{
		str_list_dest = 'id_campos_iniciais_resume';
	}

	if(str_list_dest != '')
	{
		arr_options = [];
		arr_field = $("#" + str_id).parent().parent().attr('field').split('__NM__');
		$( "#" + str_id + ' option').each(function() {

			option = $(this).val();
			if($(this).prop('selected'))
			{
				bol_achou = false;
				$( "#" + str_list_dest + ' li').each(function() {
					if($(this).attr('field') == arr_field[2] + '__NM__'+ arr_field[1] + '__NM__' + option)
					{
						bol_achou = true;
					}
				});

				if(!bol_achou)
				{
					$( "#" + str_list_dest).append("<li start='Y' field='"+ arr_field[2] +"__NM__"+ arr_field[1] +"__NM__"+ option +"' class='item'><img src='"+ str_url_img +"check.png' width=12 border=0> "+ arr_field[1] +" - "+ $(this).html() +"</li>")
				}
			}
			else
			{
				$( "#" + str_list_dest + ' li').each(function() {
					if($(this).attr('field') == arr_field[2] + '__NM__'+ arr_field[1] + '__NM__' + option)
					{
						$(this).remove();
					}
				});
			}
		});
	}
	*/
}

function removeField(str_obj)
{
	/*
	id_div_lista = $(str_obj).parent().parent().attr('id');

	str_list_dest = "";
	if(id_div_lista == 'sc_group_by_fields_selected_total')
	{
		str_list_dest = 'id_campos_iniciais_total';
	}
	else if(id_div_lista == 'sc_group_by_fields_selected_resume')
	{
		str_list_dest = 'id_campos_iniciais_resume';
	}

	if(str_list_dest != '')
	{
		$(str_obj).parent().find('select').each(function () {
			if($(this).length)
			{
				str_id = $(this).attr('id');
				if(str_id.substr(0, 10) == 'id_format_')
				{
					str_field = str_id.substr(10);
					str_field = str_field.split('_');
					if(str_field[1] == 'option')
					{
						str_field = str_field[0];

						$( "#" + str_list_dest + " option" ).each(function () {
							if($(this).val().substr(1, 8) == str_field + '__NM__')
							{
								$(this).remove();
							}
						});
					}
				}
			}
		});
	}
	*/
	$('#rule_group_sc_free_group_by_use').prop('checked', true);
	$(str_obj).parent().parent().remove();

	if(str_rule_group_origem == 'chart')
	{
        checkChartDimensionTR();
        checkChartOrderOptions();
	}

	nm_form_modified();
}

$( document ).ready(function() {
	$( ".scAppDivSelectFieldsDropable" ).sortable({
	  revert: true,
	  receive: function(event, ui) {
		  $('#rule_group_sc_free_group_by_use').prop('checked', true);
			id_div_list = $(this).attr('id');
			arr_original = ui.item.attr('field').split('__NM__');

			//se for lista de quebra, exibe o campo data, se nao exibe o campo option
			str_show_div = 'option';
			str_quebra_name = $("input[name=rule_group_nome]").val();

			if(id_div_list == 'sc_group_by_fields_selected')
			{
				str_show_div = 'data';
			}
			else
			{
				str_show_div = 'option';
			}

			if($( "#" + id_div_list ).find("li[field='"+ ui.item.attr('field') +"']").length)
			{
				str_cols = '2';
				if(id_div_list == 'sc_group_by_fields_selected')
				{
					if(str_rule_group_origem == 'chart' || (str_quebra_name == 'sc_free_group_by' && str_rule_group_origem=='group' && id_div_list == 'sc_group_by_fields_selected'))
					{

					}
					else//remove start
					{
						$( "#" + id_div_list ).find("li[field='"+ ui.item.attr('field') +"']").find("#id_div_start_"+ arr_original[2]).remove();
					}

					//mostra x & y
					if($( "#" + id_div_list ).find("li[field='"+ ui.item.attr('field') +"']").find("#id_div_axis_"+ arr_original[2]).length)
					{
						$( "#" + id_div_list ).find("li[field='"+ ui.item.attr('field') +"']").find("#id_div_axis_"+ arr_original[2]).find("input").prop('id', 'id_axis_' + cont_data);
						$( "#" + id_div_list ).find("li[field='"+ ui.item.attr('field') +"']").find("#id_div_axis_"+ arr_original[2]).find("input").prop('name', 'id_axis_' + cont_data);
						$( "#" + id_div_list ).find("li[field='"+ ui.item.attr('field') +"']").find("#id_div_axis_"+ arr_original[2]).find("span").each(function() {
							$(this).prop('id', 'id_div_axis_'+ cont_data +'_' + $(this).prop('id').substr(-1, 1));
						});
						$( "#" + id_div_list ).find("li[field='"+ ui.item.attr('field') +"']").find("#id_div_axis_"+ arr_original[2]).prop('id', 'id_div_axis_' + cont_data);
					}
				}

				if(id_div_list != 'sc_group_by_fields_selected' || str_rule_group_origem == 'chart' || (str_quebra_name == 'sc_free_group_by' && str_rule_group_origem=='group' && id_div_list == 'sc_group_by_fields_selected'))
				{
					if(id_div_list != 'sc_group_by_fields_selected')
					{
						str_cols = '1';
					}

					//mostra start
					if($( "#" + id_div_list ).find("li[field='"+ ui.item.attr('field') +"']").find("#id_div_start_"+ arr_original[2]).length)
					{
						$( "#" + id_div_list ).find("li[field='"+ ui.item.attr('field') +"']").find("#id_div_start_"+ arr_original[2]).find("input").prop('name', 'id_start_' + cont_data);
						$('input[name=id_start_' + cont_data + ']').prop('checked', true);

						$( "#" + id_div_list ).find("li[field='"+ ui.item.attr('field') +"']").find("#id_div_start_"+ arr_original[2]).prop('id', 'id_div_start_' + cont_data);
					}

					//remove x & y
					$( "#" + id_div_list ).find("li[field='"+ ui.item.attr('field') +"']").find("#id_div_axis_"+ arr_original[2]).remove();
				}

				//renomeia os inputs pros novos contadores
				if($( "#" + id_div_list ).find("li[field='"+ ui.item.attr('field') +"']").find("#id_div_format_"+ arr_original[2] +"_option").length)
				{
					$( "#" + id_div_list ).find("li[field='"+ ui.item.attr('field') +"']").find("#id_div_format_"+ arr_original[2] +"_option").find("select").prop('id', 'id_format_' + cont_data + '_option');
					$( "#" + id_div_list ).find("li[field='"+ ui.item.attr('field') +"']").find("#id_div_format_"+ arr_original[2] +"_option").find("select").prop('name', 'id_format_' + cont_data + '_option');
					$( "#" + id_div_list ).find("li[field='"+ ui.item.attr('field') +"']").find("#id_div_format_"+ arr_original[2] +"_option").prop('id', 'id_div_format_' + cont_data + '_option');
				}
				if($( "#" + id_div_list ).find("li[field='"+ ui.item.attr('field') +"']").find("#id_div_format_"+ arr_original[2] +"_data").length)
				{
					$( "#" + id_div_list ).find("li[field='"+ ui.item.attr('field') +"']").find("#id_div_format_"+ arr_original[2] +"_data").find("select").prop('id', 'id_format_' + cont_data + '_data');
					$( "#" + id_div_list ).find("li[field='"+ ui.item.attr('field') +"']").find("#id_div_format_"+ arr_original[2] +"_data").find("select").prop('name', 'id_format_' + cont_data + '_data');
					$( "#" + id_div_list ).find("li[field='"+ ui.item.attr('field') +"']").find("#id_div_format_"+ arr_original[2] +"_data").prop('id', 'id_div_format_' + cont_data + '_data');
				}

				$( "#" + id_div_list ).find("li[field='"+ ui.item.attr('field') +"']").attr('field', arr_original[0] + '__NM__'+ arr_original[1] +'__NM__' + cont_data);

				//exibe apenas o combo correspondente, data ou option
				if(id_div_list == 'sc_group_by_fields_selected')
				{
					$("#id_div_axis_" + cont_data).show();
				}

				if((str_quebra_name == 'sc_free_group_by' && str_rule_group_origem=='group' && id_div_list == 'sc_group_by_fields_selected') || (id_div_list == 'sc_group_by_fields_selected_resume' || str_rule_group_origem == 'chart'))
				{
                    $("#id_div_start_" + cont_data).show();
					//checkOptionOrder("id_format_" + cont_data + '_' + str_show_div);
				}

				checkLIValue(id_div_list, arr_original, cont_data, str_show_div);

				$( "#" + id_div_list ).find("li[field='"+ arr_original[0] + '__NM__'+ arr_original[1] +'__NM__' + cont_data +"']").find('i').remove();
				$("#id_div_format_" + cont_data + '_' + str_show_div).show();
				$("#id_format_" + cont_data + '_' + str_show_div).datePicker({ 'title': str_title, 'cols': str_cols });

				if(str_rule_group_origem == 'chart')
				{
					checkChartDimensionTR();
					checkChartOrderOptions();
				}

				cont_data++;
			}

			nm_form_modified();
		},
		stop: function(ev, ui) {
			id_div_list = $(this).attr('id');
			arr_original = ui.item.attr('field').split('__NM__');
			$('#rule_group_sc_free_group_by_use').prop('checked', true);

			if(id_div_list == 'sc_group_by_fields_selected')
			{
				checkAxis();
			}
			else if(id_div_list == 'sc_group_by_fields_selected_total')
			{
				if(ui.item.attr('entra_cons').length && ui.item.attr('entra_cons') == 'N')
				{
					ui.item.addClass('');
					ui.item.append('<span class="bullet blue"></span>');
				}
			}
			// setListFieldHeightBasedContent();
			nm_form_modified();
		},
		beforeStop: function(ev, ui) {
			$('#rule_group_sc_free_group_by_use').prop('checked', true);
			id_div_list = $(this).attr('id');
			arr_original = ui.item.attr('field').split('__NM__');


            if(id_div_list == 'sc_group_by_fields_selected')
			{
				if(ui.item.data('categ') == 2 || ui.item.attr('no_selected'))
				{
					$(ui.item).remove();
				}
                //nao pode ser data, data pode se repetir, tem q ter select de opcoes e nao pode existir o campo igual
				else if($('#'+ id_div_list +' #id_div_format_'+ arr_original[2] +'_data').length == 0 && $(ui.item).find("select").length == 1 && $( "#" + id_div_list ).find("li[original='"+ ui.item.attr('original') +"']").length > 1) //se nao tiver select e for duplicado
				{
					$(ui.item).remove();
				}
			}
			else if(id_div_list == 'sc_group_by_fields_selected_total')
			{
				if( ui.item.attr('no_selected') && ui.item.attr('original') == "__NM_COUNT_NM__")
				{
					$(ui.item).remove();
				}
			}
		},
	});


	$( "#sc_group_by_fields_available li" ).draggable({
	  connectToSortable: ".scAppDivSelectFieldsDropable",
	  helper: "clone",
	  revert: "invalid",
	  start: function( event, ui ) {
		  $(".ui-draggable-dragging").width($("#sc_group_by_fields_available").width()-12);
		  $('#rule_group_sc_free_group_by_use').prop('checked', true);
	  }
	});

	//$( "#id_campos_iniciais_total, #id_campos_iniciais_resume" ).sortable();

	// setListFieldHeight(false);
});

function checkDimensionDateChange(obj_sel)
{
	if($(obj_sel).parent().parent().parent().length>=0)
	{
		arr_field = $(obj_sel).parent().parent().parent().attr('field').split('__NM__');

		$('#id_tr_dimension_' + arr_field[2] + ' td:first').html(arr_field[1] +'_'+ $(obj_sel).val());
		
	}
}

function checkChartDimensionTR()
{
	arr_li_existentes = [];

	//varre as dimensoes e adicionan na tabela de sort
	$( "#sc_group_by_fields_selected li" ).each(function (key, value) {
		if($(value).attr('field'))
		{
			arr_field = $(value).attr('field').split('__NM__');
			arr_li_existentes.push(arr_field[2]);
			if($('#id_tr_dimension_' + arr_field[2]).length <= 0)
			{
				str_extra = "";
				//se for data, procura pelo option selecionado
				if($('#id_format_'+ arr_field[2] +'_data').length >= 0 && $( '#id_format_'+ arr_field[2] +'_data option[selected=selected]').length >=0 )
				{
					str_extra = $( '#id_format_'+ arr_field[2] +'_data option[selected=selected]').attr('value');
				}				

				$('#id_table_dimension_sort').append("<tr id='id_tr_dimension_"+ arr_field[2] +"'><td>"+ arr_field[1] + '_' + str_extra + "</td><td><select name='chart_initial_sort_option["+ arr_field[2] +"]' onchange='nm_form_modified();' class='nmInput'><option value='asc' selected='selected'>"+ str_asc +"</option><option value='desc'>"+ str_desc +"</option></select></td><td><select name='chart_initial_sort["+ arr_field[2] +"]' onchange='nm_form_modified();' class='initial-sort-ul nmInput'><option value='dimension' selected='selected'>"+ str_dimension +"</option></select></td></tr>");
			}
		}
	});

	//varre table de sort e remove quem nao ta na dimensao
	$( "#id_table_dimension_sort tr" ).each(function (key, value) {
		if($(value).attr('id').substr(0, 16) == "id_tr_dimension_")
		{
			cont = $(value).attr('id').substr(16);
			if($.inArray(cont, arr_li_existentes) < 0)
			{
				$('#id_tr_dimension_' + cont).remove();
			}
		}
	});
}

function checkChartOrderOptions()
{
	//varre os options checked e adiciona na lista
	$( "#sc_group_by_fields_selected_resume ul li" ).each(function (key, value) {
		if($(this).hasClass('active'))
		{
			arr_field = $(value).parent().parent().parent().parent().parent().attr('field').split('__NM__');
			//adiciona apenas se nao tiver
			$( "select").each(function (key_sel, value_sel) {
				if(value_sel.name.substr(0, 19) == 'chart_initial_sort[')
				{
					if($(value_sel).find("option[value=metric_"+ arr_field[0] +"_"+ $(value).attr('formato') +"]").length < 1)
					{
						if(arr_field[1] == "__NM_COUNT_NM__")
						{
							arr_field[1] = $(value).parent().parent().parent().parent().parent().find(".item-title").text();
						}
						$(value_sel).append("<option value='metric_"+ arr_field[0] +"_"+ $(value).attr('formato') +"'>"+ arr_field[1] +"_"+ $(value).attr('formato') +"</option>");
					}
				}
			});
			
		}
	});

	//varre e remove quem nao for option checked
	$( ".initial-sort-ul option" ).each(function () {
		if($(this).val().substr(0, 7) == 'metric_')
		{
			bol_achou = false;
			str_val = $(this).val();
			$( "#sc_group_by_fields_selected_resume ul li" ).each(function () {
				arr_field = $(this).parent().parent().parent().parent().parent().attr('field').split('__NM__');
				if($(this).hasClass('active') && str_val == 'metric_' + arr_field[0] + '_' + $(this).attr('formato'))
				{
					bol_achou = true;
					return false;
				}
			});
			if(!bol_achou)
			{
				$(this).remove();
			}
		}
	});
}

function checkLIValue(id_div_list, arr_original, cont_data, str_show_div)
{
    if(id_div_list == 'sc_group_by_fields_selected')
    {
        //ordem para setar o marcado
        ordem_datas = [
        "YYYY",
        "QUARTER",
        "MM",
        "DD",
        "SEMIANNUAL",
        "YYYYSEMIANNUAL",
        "FOURMONTHS",
        "YYYYFOURMONTHS",
        "YYYYQUARTER",
        "BIMONTHLY",
        "YYYYBIMONTHLY",
        "YYYYMM",
        "WEEK",
        "YYYYWEEK",
        "YYYYMMDD2",
        "DAYNAME",
        "YYYYMMDDHHIISS",
        "YYYYMMDDHHII",
        "YYYYMMDDHH",
        "HHIISS",
        "HHII",
        "HH",
        ];
    }
    else
    {
        ordem_datas = [];
        $( "#id_format_" + cont_data + '_' + str_show_div + " option").each(function() {
            ordem_datas.push($(this).val());
	});
    }

    //checa se ja tem o valor pra marcar a proxima
    qtd_options = $( "#id_format_" + cont_data + '_' + str_show_div + " option").length;
    bol_found = false;
    first_val = $( "#id_format_" + arr_original[2] + '_' + str_show_div).val();
    //$( "#id_format_" + cont_data + '_' + str_show_div + " option").each(function() {
    $.each( ordem_datas, function( key, value ) {
        cur_val = value;

        //se achou no registro antgerior, marca como selecionado para checar se ja existe
        if(bol_found)
        {
            $("#id_format_" + cont_data + '_' + str_show_div + " option:selected").each(function () {
                    $(this).attr('selected', false);
            });

            $( "#id_format_" + cont_data + '_' + str_show_div +" option[value='"+ cur_val +"']" ).attr('selected', true);
            $( "#id_format_" + cont_data + '_' + str_show_div).change();

            bol_found = false;
        }

        $( "#" + id_div_list ).find("li[original='"+ arr_original[1] +"']").each(function() {
            if($(this).attr('field') != arr_original[0] + "__NM__" + arr_original[1] + "__NM__" + cont_data)
            {
                arr_interno = $(this).attr('field').split('__NM__');
                if($("#id_format_"+ arr_interno[2] +"_" + str_show_div).val() == cur_val)
                {
                    bol_found = true;
                }
            }
        });
        if(!bol_found)
        {
            return false;
        }
    });
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

		if(str_rule_group_origem == 'group')
		{
			$(".listitems").css("height", (str_height - 190));
		}
		else
		{
			$(".listitems").css("height", (str_height - 500));
		}
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
		if($(this).attr("id") != 'sc_group_by_fields_available')
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

function setListFieldWidth()
{
	// alert('OK');
	max_width = "";
	$( "#sc_group_by_fields_available li").find(".item-title").each(function(i) {
		if($(this).css('width') > max_width)
		{
			max_width = $(this).css('width');
		}
	});
	if(max_width != '')
	{
		old_width = $( "#sc_group_by_fields_available").parent().css('width');

		if(max_width.substr(-2) == 'px')
		{
			max_width = max_width.substr(0, max_width.length-2);
		}
		max_width = parseInt(max_width) + 80;

		//seta pra outras colunas
		if(old_width.substr(-2) == 'px')
		{
			old_width = old_width.substr(0, old_width.length-2);
		}
		dif_width = parseInt(old_width) - max_width;
		if(dif_width > 0)
		{
			sobra_p_cols = dif_width/3;
			$( ".col").css('width', 'calc(32% - ' + sobra_p_cols+ 'px)');
		}

		//seta pros campos disponiveis
		$( "#sc_group_by_fields_available").parent().css('width', (max_width+"px"));
	}
}
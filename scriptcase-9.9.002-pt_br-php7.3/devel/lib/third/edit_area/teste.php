<html>

	<head>
	
		<script language="javascript" type="text/javascript" src="edit_area_full.js"></script>

		<script language="javascript">
		
	    	try 		
	    	{
	        	editAreaLoader.init({ 
	        		id : 'Formula_id'		
	        		,syntax: 'php'			
	        		,start_highlight: true
	        		,allow_resize: 'no'	
	        		,allow_toggle: false
	        		,language: 'en' 
	        		,toolbar: 'select_font, |, search, highlight, go_to_line, |, undo, redo, |, help'  
	        		,macro_complete: "sc_alert__|=|__sc_alert('message')__|macro|__sc_apl_conf__|=|__sc_apl_conf(Application, Property, value)__|macro|__sc_apl_status__|=|__sc_apl_status(application, status)__|macro|__sc_begin_trans__|=|__sc_begin_trans('connection')__|macro|__sc_block_display__|=|__sc_block_display('block','on/off')__|macro|__sc_btn_delete__|=|__sc_btn_delete__|macro|__sc_btn_display__|=|__sc_btn_display('button','on/off')__|macro|__sc_btn_insert__|=|__sc_btn_insert__|macro|__sc_btn_new__|=|__sc_btn_new__|macro|__sc_btn_update__|=|__sc_btn_update__|macro|__sc_calc_dv__|=|__sc_calc_dv(dv, rest, value, module, weights,type)__|macro|__sc_commit_trans__|=|__sc_commit_trans('connection')__|macro|__sc_date__|=|__sc_date(date, format, operator, D,M,Y)__|macro|__sc_date_conv__|=|__sc_date_conv({field_date}, 'fmt_input', 'fmt_output')__|macro|__sc_date_empty__|=|__sc_date_empty({field_date})__|macro|__sc_decode__|=|__sc_decode(field/variable)__|macro|__sc_dif_date__|=|__sc_dif_date(date1, format date1, date2, format date 2)__|macro|__sc_dif_date_2__|=|__sc_dif_date_2(date1, format date1, date2, format date 2, option)__|macro|__sc_encode__|=|__sc_encode(field/variable)__|macro|__sc_error_exit__|=|__sc_error_exit(URL/Application, target)__|macro|__sc_error_message__|=|__sc_error_message('text')__|macro|__sc_exec_sql__|=|__sc_exec_sql('sql command', 'connection')__|macro|__sc_exit__|=|__sc_exit(Option)__|macro|__sc_field_display__|=|__sc_field_display({field}, on/off)__|macro|__sc_field_readonly__|=|__sc_field_readonly({field})__|macro|__sc_form_show__|=|__sc_form_show = 'on'/'off'__|macro|__sc_format_num__|=|__sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb)__|macro|__sc_image__|=|__sc_image(img1.jpg,img2.gif,...)__|macro|__sc_include__|=|__sc_include(file, source)__|macro|__sc_label__|=|__sc_label(field)__|macro|__sc_lookup__|=|__sc_lookup(dataset, 'sql command', 'connection')__|macro|__sc_mail_send__|=|__sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, cópias, tp_cópias, porta, tp_conexao, attachment)__|macro|__sc_master_value__|=|__sc_master_value('object', value)__|macro|__sc_redir__|=|__sc_redir(apl, parm1; parm2; ..., target)__|macro|__sc_reset_apl_conf__|=|__sc_reset_apl_conf(Application, Property)__|macro|__sc_reset_apl_status__|=|__sc_reset_apl_status()__|macro|__sc_reset_global__|=|__sc_reset_global([var_glo1], [var_glo2] ...)__|macro|__sc_rollback_trans__|=|__sc_rollback_trans('connection')__|macro|__sc_select__|=|__sc_select(dataset, 'sql command', 'connection')__|macro|__sc_set_global__|=|__sc_set_global([global1], [global2], ...)__|macro|__sc_site_ssl__|=|__sc_site_ssl__|macro|__sc_trunc_num__|=|__sc_trunc_num(field,  qt_dec)__|macro|__sc_url_exit__|=|__sc_url_exit(url)__|macro|__sc_warning__|=|__sc_warning = 'on'/'off'__|macro|__sc_zip_file__|=|__sc_zip_file(files, zip)"
	        		,div_editor_style: ""
	        	});
	        } catch(except){};		
		
		</script>
		
	</head>


	<body>
	

		<textarea id="Formula_id"  cols="100" rows="30"></textarea>
		
	
	</body>


</html>
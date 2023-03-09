function nm_usar_config_regional(str_value, str_origem, srt_tipo_dado) {
	
    if (str_origem === undefined || str_origem == '')
    {
        str_origem = "fld";
    }

    str_group = "";
    if($('#id_tr_group_usar_config_regional').length)
    {
        str_group = "_group";
    }
    
    //duplicado os campos em minusculo devido a duplicacao na metrica e dimensao
    //mas nao ha efeito colateral pois jquery testa
    __nm_toggle_field('Moeda_Simbolo' + str_group, str_value != 'S');
    __nm_toggle_field('Simbolo_Agr' + str_group, str_value != 'S');
    __nm_toggle_field('Simbolo_Dec' + str_group, str_value != 'S');
    __nm_toggle_field('moeda_simbolo' + str_group, str_value != 'S');
    __nm_toggle_field('simbolo_agr' + str_group, str_value != 'S');
    __nm_toggle_field('simbolo_dec' + str_group, str_value != 'S');
    __nm_toggle_field('simbolo_negativo' + str_group, str_value != 'S');
    __nm_toggle_field('formato_moeda_positivo' + str_group, str_value != 'S');
    __nm_toggle_field('formato_moeda_negativo' + str_group, str_value != 'S');
    __nm_toggle_field('formato_num_negativo' + str_group, str_value != 'S');
    __nm_toggle_field('formato_num_positivo' + str_group, str_value != 'S');
    __nm_toggle_field('MascaraGridDetalhe' + str_group, str_value != 'S');
    __nm_toggle_field('mascaragriddetalhe' + str_group, str_value != 'S');
    __nm_toggle_field('sep_data' + str_group, str_value != 'S');
    __nm_toggle_field('prim_dia_sema' + str_group, str_value != 'S');
    __nm_toggle_field('sep_hora' + str_group, str_value != 'S');
    __nm_toggle_field('Formato_Data' + str_group, str_value != 'S');
    __nm_toggle_field('formato_data' + str_group, str_value != 'S');
    __nm_toggle_field('format_data_config_reg' + str_group, str_value == 'S');
    __nm_toggle_field('qtd_decimais_sec' + str_group, str_value != 'S');
    __nm_toggle_field('simbolo_agr_pesq' + str_group, str_value != 'S');
    __nm_toggle_field('simbolo_agr_pesq_tr_cima', str_value != 'S');
    __nm_toggle_field('simbolo_dec_pesq', str_value != 'S');
    __nm_toggle_field('simbolo_dec_pesq_tr_cima', str_value != 'S');

    if(str_value == 'S') {
        __nm_toggle_field('simbolo_moeda_usuario');
        __nm_toggle_field('simbolo_moeda_usuario', str_value != 'N' );
    }
    else if($('input[name=use_simbolo_moeda]:checked').val() == 'S') {
        $('#simbolo_moeda_usuario').show();
    }
    __nm_toggle_field('format_data_config_reg_filter', str_value != 'N' );
    if(str_origem == 'app' && str_value == 'N')
    {
        //forca esconder
        if(srt_tipo_dado == 'DECIMAL' || srt_tipo_dado == 'NUMEROEDT')
        {
            __nm_toggle_field('moeda_simbolo' + str_group, false);
        }
    }
    else if(str_origem == 'fld' && str_group != '' && srt_tipo_dado.substring(0, 4) == 'DATA')
    {
        __nm_toggle_field('group_mascara_grid_detalhe', str_value != 'S');
        __nm_toggle_field('group_format_data_config_reg', str_value != 'S');
    }
}

function nm_lkp_save(str_mod, str_delim)
{
   nm_lkp_pack(str_mod, str_delim);
   nm_window_upload("lkpdef",null, true);
   document.form_edit.action            = nm_url_rand(nm_url_iface + "upload.php?mod=lkpdef&str_refresh=ok");
   document.form_edit.target            = "nmWinUploadV7_" +nm_win_name;
  $('#form_option').val(str_mod);
   document.form_edit.submit();
  }

function nm_lkpdef_load(fn_cback, obj_sel)
{
    str_sel = obj_sel.options[obj_sel.selectedIndex].value;
    if ("" != str_sel)
    {
        jsrsExecute(nm_url_rand(nm_url_iface + 'api_lkpdef.php'), fn_cback, "do_lookup", str_sel, false);
    }
    obj_sel.selectedIndex = -1;
}
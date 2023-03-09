<?php
    $def_dados = array();
    $arr_toolbars = array('flag'            => 'S',
                          'top_left'        => array(),
                          'top_right'       => array(),
                          'top_center'      => array(),
                          'bottom_left'     => array(),
                          'bottom_right'    => array(),
                          'bottom_center'   => array(),
                          'mobile_top_left'        => array(),
                          'mobile_top_right'       => array(),
                          'mobile_top_center'      => array(),
                          'mobile_bottom_left'     => array(),
                          'mobile_bottom_right'    => array(),
                          'mobile_bottom_center'   => array(),
                          'atalhos'         => array(),
                          'labels'          => array(),
                          'hints'           => array()
                           );
    $def_dados['libraries_scriptcase']  = array();
    $def_dados['libraries_sys']         = array();
    $def_dados['libraries_prj']         = array();
    $def_dados['libraries_usr']         = array();
    $def_dados['attributes']            = array();
    $def_dados['ligacoes']              = array();
    $def_dados['tot_fields_res_add']    = array();
    $def_dados['toolbars']              = $arr_toolbars;
    $def_dados['toolbars_filter']       = $arr_toolbars;
    $def_dados['toolbars_detail']       = $arr_toolbars;
    $def_dados['toolbars_detail']['top_center']   = array();
    $def_dados['toolbars_detail']['top_center'][]   = "sys_format_pdf";
    $def_dados['toolbars_detail']['top_center'][]   = "sys_format_imp";
    $def_dados['toolbars_detail']['top_center'][]   = "sys_format_sai";

    $def_dados['actionbar_grid'] = [
        '__sc_detail' => [
            'type' => 'detail',
            'display' => '',
            'in_use' => 'S',
            'states' => []
        ],
        '__sc_app_edit' => [
            'type' => 'app_edit',
            'display' => '',
            'in_use' => 'S',
            'states' => []
        ],
        '__sc_sep' => [
            'type' => 'separator',
            'display' => '',
            'in_use' => 'S',
            'states' => []
        ],
    ];
    $def_dados['actionbar_grid_order'] = ['__sc_detail', '__sc_app_edit', '__sc_sep'];
    $def_dados['actionbar_grid_visual'] = [
        'overwrite_sc_buttons' => 'N',
        'padding' => '5px',
        'fa_size' => '17',
        'fa_color' => '',
        'link_color' => '',
        'link_hover' => '',
        'link_active' => '',
        'vertical_align' => 'top',
    ];

    $def_dados['app_hotkeys'] 		        	= [];
    $def_dados['app_resume_hotkeys'] 			= [];
    $def_dados['app_filter_hotkeys'] 			= [];
    $def_dados['app_detail_hotkeys'] 			= [];
    nm_load_class('interface', 'HotkeyTemplates');
    $def_dados['app_hotkeys_schema'] 			= nmHotkeyTemplates::$empty_value;
    $def_dados['app_hotkeys_schema_detail'] 	= nmHotkeyTemplates::$empty_value;
    $def_dados['app_hotkeys_schema_resume'] 	= nmHotkeyTemplates::$empty_value;
    $def_dados['app_hotkeys_schema_filter'] 	= nmHotkeyTemplates::$empty_value;
    $def_dados['containers']            = array();
    $def_dados['group_labels']          = array();
    $def_dados['group_labels_resume']   = array();
    $def_dados['layout_resume']         = array();
    $def_dados['layout_total']          = array();
    $def_dados['dependency_new']        = array();
    $def_dados['dependency_type_criticize']        = "select";
	$def_dados['tot_cons_label']                    ='';
	$def_dados['tot_cons_linha_visu_campo_fonte']   ='';
	$def_dados['tot_cons_linha_visu_campo_size']    ='';
	$def_dados['tot_cons_linha_visu_campo_color']   ='';
	$def_dados['tot_cons_linha_visu_campo_bgcolor'] ='';
	$def_dados['tot_cons_linha_visu_campo_negrito'] ='';
	$def_dados['tot_cons_geral_linha_visu_fonte']   ='';
	$def_dados['tot_cons_geral_linha_visu_size']    ='';
	$def_dados['tot_cons_geral_linha_visu_color']   ='';
	$def_dados['tot_cons_geral_linha_visu_bgcolor'] ='';
	$def_dados['tot_cons_geral_linha_visu_negrito'] ='';
	$def_dados['tot_res_tipo']                      ='';
	$def_dados['tot_res_label']                     ='';
	$def_dados['tot_res_campo_padrao']              ='';
	$def_dados['tot_res_criar_grafico']             ='';
	$def_dados['tot_res_titulo_grafico']            ='';
	$def_dados['tot_res_formula']                   ='';
	$def_dados['tot_res_linha_visu_campo_fonte']    ='';
	$def_dados['tot_res_linha_visu_campo_size']     ='';
	$def_dados['tot_res_linha_visu_campo_color']    ='';
	$def_dados['tot_res_linha_visu_campo_bgcolor']  ='';
	$def_dados['tot_res_linha_visu_campo_negrito']  ='';
	$def_dados['tot_res_geral_linha_visu_fonte']    ='';
	$def_dados['tot_res_geral_linha_visu_size']     ='';
	$def_dados['tot_res_geral_linha_visu_color']    ='';
	$def_dados['tot_res_geral_linha_visu_bgcolor']  ='';
	$def_dados['tot_res_geral_linha_visu_negrito']  ='';
	$def_dados['tot_res_linha_visu_campo_align']    ='';
	$def_dados['tot_res_linha_visu_campo_valign']   ='';
	$def_dados['tot_res_geral_linha_visu_align']    ='';
  $def_dados['tot_res_geral_linha_visu_valign']   ='';
  $def_dados['tot_res_display_as']   ='';
	$def_dados['tot_res_display_values']   ='';
	/* LOG module*/
	$def_dados['log_schema'] = array();
	$def_dados['log_all_fields'] = 'S';
	$def_dados['log_fields'] = array();
	$def_dados['log_events'] = array();

    $def_dados['chart_static_filter'] = array();
    $def_dados['chart_static_filter_cond'] = 'and';
    $def_dados['chart_tot_geral'] = 'N';
    $def_dados['chart_trendline'] = 'N';
    $def_dados['chart_trendline_type'] = 'linear';
    $def_dados['chart_trendline_val_start'] = '';
    $def_dados['chart_trendline_val_end'] = '';
//'chart_trendline_type', 'chart_trendline_val_start','chart_trendline_val_end',
    $def_dados['chart_initial_summary'] = array();
    $def_dados['chart_initial_dimension'] = array();
    $def_dados['chart_initial_sort'] = 'dimension';
    $def_dados['chart_initial_sort_option'] = 'asc';

?>

<?php
$arr_toolbars = array('flag'            => 'S',
                        'top_left'        => array('__GRP__{lang_btns_expt}__#!NMDATA!#__name=group_1&label=%7Blang_btns_expt%7D&hint=%7Blang_btns_expt%7D&type=input&icon=scriptcase__NM__gear.png&display=text_fontawesomeicon&icon_fa=fas fa-download&&display_position=text_right__!NMFIELDS!__0=sys_format_pdf&1=sys_separator&2=sys_format_word&3=sys_format_xls&4=sys_separator&5=sys_format_xml&6=sys_format_json&7=sys_format_csv&8=sys_format_rtf&9=sys_separator&10=sys_format_imp',
                            '__SUB__sys_format_pdf',
                            '__SUB__sys_separator',
                            '__SUB__sys_format_word',
                            '__SUB__sys_format_xls',
                            '__SUB__sys_separator',
                            '__SUB__sys_format_xml',
                            '__SUB__sys_format_json',
                            '__SUB__sys_format_csv',
                            '__SUB__sys_format_rtf',
                            '__SUB__sys_separator',
                            '__SUB__sys_format_imp',
                            'sys_format_gra',
                            'sys_format_confr',
                            'sys_format_gbrl',
                            'sys_format_cons',
                            'sys_format_savegrid',
                            'sys_format_savegridsession',
                            'sys_format_reload',
                            'sys_format_sai'
                        ),
                        'top_right'       => array(),
                        'top_center'      => array(),
                        'bottom_left'     => array(),
                        'bottom_right'    => array(),
                        'bottom_center'   => array(),
                        'mobile_top_left'        => array( 'sys_format_gra',
                            'sys_format_confr',
                            'sys_format_cons',
                            'sys_format_gbrl',
                            '__GRP__{lang_btns_expt}__#!NMDATA!#__name=group_1&label=%7Blang_btns_expt%7D&hint=%7Blang_btns_expt%7D&type=input&icon=scriptcase__NM__gear.png&display=text_fontawesomeicon&icon_fa=fas fa-download&&display_position=text_right__!NMFIELDS!__0=sys_format_pdf&1=sys_separator&2=sys_format_word&3=sys_format_xls&4=sys_separator&5=sys_format_xml&6=sys_format_json&7=sys_format_csv&8=sys_format_rtf&9=sys_separator&10=sys_format_imp',
                            '__SUB__sys_format_pdf',
                            '__SUB__sys_separator',
                            '__SUB__sys_format_word',
                            '__SUB__sys_format_xls',
                            '__SUB__sys_separator',
                            '__SUB__sys_format_xml',
                            '__SUB__sys_format_json',
                            '__SUB__sys_format_csv',
                            '__SUB__sys_format_rtf',
                            '__SUB__sys_separator',
                            '__SUB__sys_format_imp',
                            '__GRP__{lang_btns_settings}__#!NMDATA!#__name=group_2&label=%7Blang_btns_settings%7D&hint=%7Blang_btns_settings%7D&type=input&icon=scriptcase__NM__gear.png&display=text_fontawesomeicon&icon_fa=fas fa-cog&&display_position=text_right__!NMFIELDS!__0=__SUB__sys_format_fil&1=__SUB__sys_format_dynamicsearch&2=__SUB__sys_separator&3=__SUB__sys_format_gbrl&4=__SUB__sys_separator&5=__SUB__sys_format_gra&6=__SUB__sys_format_confr&7=__SUB__sys_separator&8=__SUB__sys_format_cons',
                            '__SUB__sys_format_fil',
                            '__SUB__sys_format_dynamicsearch',
                            '__SUB__sys_separator',
                            '__SUB__sys_format_gbrl',
                            '__SUB__sys_separator',
                            '__SUB__sys_format_gra',
                            '__SUB__sys_format_confr',
                            '__SUB__sys_separator',
                            '__SUB__sys_format_cons',
                            '__SUB__sys_format_savegrid',
                            '__SUB__sys_format_savegridsession',
                            'sys_format_reload',
                            'sys_format_sai'),
                        'mobile_top_right'       => array(),
                        'mobile_top_center'      => array(),
                        'mobile_bottom_left'     => array(),
                        'mobile_bottom_right'    => array(),
                        'mobile_bottom_center'   => array(),
                        'atalhos'         => array(),
                        'labels'          => array(),
                        'hints'           => array()
                    );
        $def_dados = array();
        $def_dados['blocos']                 = array();
        $def_dados['blocos_filter']          = array();
        $def_dados['blocos_edit_view_use']   = 'N';
        $def_dados['blocos_edit_view']       = array();
        $def_dados['botoes']                 = array();
        $def_dados['botoes_ordem']           = array();
        $def_dados['botoes_ord_filter']      = array();
        $def_dados['botoes_resume']          = $arr_toolbars;
        $def_dados['botoes_resume_chart']    = array('top_left' => array(
    'sys_format_sort_chart',
    'sys_format_cpersonalite',
    'sys_separator',
    '__GRP__Group__#!NMDATA!#__display_type=group&display_type_css=app&name=group_2&label=&hint=&type=input&icon=&display=only_text&display_position=text_right__!NMFIELDS!__0=sys_format_chart_bar&1=sys_format_chart_line&2=sys_format_chart_area&3=sys_format_chart_pizza&4=sys_format_chart_combo&5=sys_format_chart_stack&6=sys_format_chart_type',
    '__SUB__sys_format_chart_bar',
    '__SUB__sys_format_chart_line',
    '__SUB__sys_format_chart_area',
    '__SUB__sys_format_chart_pizza',
    '__SUB__sys_format_chart_stack',
    '__SUB__sys_format_chart_combo',
    '__SUB__sys_format_chart_type',
    'sys_format_res_chart',
),

    'top_right' => array(
    '__GRP__{lang_btns_expt}__#!NMDATA!#__name=group_1&label=%7Blang_btns_expt%7D&hint=%7Blang_btns_expt%7D&type=input&icon=scriptcase__NM__gear.png&display=text_fontawesomeicon&icon_fa=fas fa-download&&display_position=text_right__!NMFIELDS!__0=sys_format_pdf&1=sys_format_imp',
    '__SUB__sys_format_pdf',
    '__SUB__sys_format_imp',
    'sys_format_fil',
    'sys_format_reload',
    'sys_format_sai',
),
    'top_center' => array(),
    'bottom_left' => array(),
    'bottom_right' => array(),
    'bottom_center' => array(),
    'mobile_top_left'        => array(
        'sys_format_sort_chart',
        'sys_format_cpersonalite',
        'sys_separator',
        '__GRP__Group__#!NMDATA!#__display_type=group&display_type_css=app&name=group_2&label=&hint=&type=input&icon=&display=only_text&display_position=text_right__!NMFIELDS!__0=sys_format_chart_bar&1=sys_format_chart_line&2=sys_format_chart_area&3=sys_format_chart_pizza&4=sys_format_chart_combo&5=sys_format_chart_stack&6=sys_format_chart_type',
        '__SUB__sys_format_chart_bar',
        '__SUB__sys_format_chart_line',
        '__SUB__sys_format_chart_area',
        '__SUB__sys_format_chart_pizza',
        '__SUB__sys_format_chart_stack',
        '__SUB__sys_format_chart_combo',
        '__SUB__sys_format_chart_type',
        'sys_format_res_chart',
    ),
    'mobile_top_right'       => array('__GRP__{lang_btns_expt}__#!NMDATA!#__name=group_1&label=%7Blang_btns_expt%7D&hint=%7Blang_btns_expt%7D&type=input&icon=scriptcase__NM__gear.png&display=text_fontawesomeicon&icon_fa=fas fa-download&&display_position=text_right__!NMFIELDS!__0=sys_format_pdf&1=sys_format_imp',
        '__SUB__sys_format_pdf',
        '__SUB__sys_format_imp',
        'sys_format_fil',
        'sys_format_reload',
        'sys_format_sai',),
    'mobile_top_center'      => array(),
    'mobile_bottom_left'     => array(),
    'mobile_bottom_right'    => array(),
    'mobile_bottom_center'   => array(),
);

        $def_dados['paginas']                = array();
        $def_dados['paginas_filter']         = array();
        $def_dados['rules_group']            = array();
        $def_dados['rules_orders']           = array();
        $def_dados['botoes_filtro']          = array();
        $def_dados['layout_pdf']             = array();
        $def_dados['save_grid']              = array();
        $def_dados['save_grid']['btn_salvar_usuario']        = 'N';
        $def_dados['save_grid']['btn_salvar_usuario_titulo'] = '{lang_srch_public}';
        $def_dados['save_grid']['btn_salvar_privado']        = 'N';
        $def_dados['save_grid']['btn_salvar_lista']          = array();
        $def_dados['initial_group_by']       = '';
        $def_dados['initial_group_by_has']   = 'N';
        $def_dados['initial_group_by_title'] = '{lang_othr_groupby_none}';
        $def_dados['use_this_groupby_dynamic_total'] = 'S';
        $def_dados['dynamic_total_start_open'] = 'S';
?>
<?php

/**
 *  ['has']      => $nm_config['has_XX']
 *  ['show_new'] => $nm_config['is_XX']
 *  ['display']  => $obj_lic->isVersionReleased('X.X.XXX')
 *
 *  para funcionalidades em testes, incluir nas flags => || $nm_config['em_desenv']
 */

// liberado para todas as versoes -----------------------------------

// uso de utf8 nativo no banco de dados
$nm_config['flag_versao']['database_utf8']['has']      = true;
$nm_config['flag_versao']['database_utf8']['show_new'] = true;
$nm_config['flag_versao']['database_utf8']['display']  = true;

// indefinida -------------------------------------------------------

// novo menu
$nm_config['flag_versao']['menu2']['has']      = $nm_config['em_desenv'];
$nm_config['flag_versao']['menu2']['show_new'] = $nm_config['em_desenv'];
$nm_config['flag_versao']['menu2']['display']  = $nm_config['em_desenv'];

// 9.9.000 ----------------------------------------------------------

// actionbar para grid
$nm_config['flag_versao']['actiobar_grid']['has']      = $nm_config['has_9_9_0'];
$nm_config['flag_versao']['actiobar_grid']['show_new'] = $nm_config['is_99'];
$nm_config['flag_versao']['actiobar_grid']['display']  = $obj_lic->isVersionReleased('9.9.000');

// chave estrangeira no dicionario de dados
$nm_config['flag_versao']['datadic_foreign_key']['has']      = $nm_config['has_9_9_0'];
$nm_config['flag_versao']['datadic_foreign_key']['show_new'] = $nm_config['is_99'];
$nm_config['flag_versao']['datadic_foreign_key']['display']  = $obj_lic->isVersionReleased('9.9.000');

// api para exportar para google sheet
$nm_config['flag_versao']['export_googlesheets']['has']      = $nm_config['has_9_9_0'];
$nm_config['flag_versao']['export_googlesheets']['show_new'] = $nm_config['is_99'];
$nm_config['flag_versao']['export_googlesheets']['display']  = $obj_lic->isVersionReleased('9.9.000');

// chave estrangeira no dicionario de dados
$nm_config['flag_versao']['macro_sc_change_css']['has']      = $nm_config['has_9_9_0'];
$nm_config['flag_versao']['macro_sc_change_css']['show_new'] = $nm_config['is_99'];
$nm_config['flag_versao']['macro_sc_change_css']['display']  = $obj_lic->isVersionReleased('9.9.000');

// campo rating smile & thumb
$nm_config['flag_versao']['rating_smile_thumb']['has']      = $nm_config['has_9_9_0'];
$nm_config['flag_versao']['rating_smile_thumb']['show_new'] = $nm_config['is_99'];
$nm_config['flag_versao']['rating_smile_thumb']['display']  = $obj_lic->isVersionReleased('9.9.000');

// subconsulta em iframe
$nm_config['flag_versao']['subcons_iframe']['has']      = $nm_config['has_9_9_0'];
$nm_config['flag_versao']['subcons_iframe']['show_new'] = $nm_config['is_99'];
$nm_config['flag_versao']['subcons_iframe']['display']  = $obj_lic->isVersionReleased('9.9.000');

// 9.7.019 ----------------------------------------------------------

// opcao de abrir links do form em uma nova janela
$nm_config['flag_versao']['form_link_open_tab_window']['has']      = $nm_config['has_9_7_19'];
$nm_config['flag_versao']['form_link_open_tab_window']['show_new'] = $nm_config['is_97'];
$nm_config['flag_versao']['form_link_open_tab_window']['display']  = $obj_lic->isVersionReleased('9.7.019');

// interface exclusiva para mobile das etapas do form wizard
$nm_config['flag_versao']['form_wizard_mobile']['has']      = $nm_config['has_9_7_19'];
$nm_config['flag_versao']['form_wizard_mobile']['show_new'] = $nm_config['is_97'];
$nm_config['flag_versao']['form_wizard_mobile']['display']  = $obj_lic->isVersionReleased('9.7.019');

// novas opcoes de configuracao da aplicacao a ser aberta por links (margem, borda)
$nm_config['flag_versao']['link_new_options']['has']      = $nm_config['has_9_7_19'];
$nm_config['flag_versao']['link_new_options']['show_new'] = $nm_config['is_97'];
$nm_config['flag_versao']['link_new_options']['display']  = $obj_lic->isVersionReleased('9.7.019');

// 9.7.017 ----------------------------------------------------------

// opcao de abrir links da grid em uma aba
$nm_config['flag_versao']['grid_link_open_tab_window']['has']      = $nm_config['has_9_7_17'];
$nm_config['flag_versao']['grid_link_open_tab_window']['show_new'] = $nm_config['is_97'];
$nm_config['flag_versao']['grid_link_open_tab_window']['display']  = $obj_lic->isVersionReleased('9.7.017');

// 9.7.016 ----------------------------------------------------------

// colunas fixas para o formulario
$nm_config['flag_versao']['form_fixed_columns']['has']      = $nm_config['has_9_7_16'];
$nm_config['flag_versao']['form_fixed_columns']['show_new'] = $nm_config['is_97'];
$nm_config['flag_versao']['form_fixed_columns']['display']  = $obj_lic->isVersionReleased('9.7.016');

// botoes de ordenacao da coluna do formulario com suporte a font awesome
$nm_config['flag_versao']['form_order_icons']['has']      = $nm_config['has_9_7_16'];
$nm_config['flag_versao']['form_order_icons']['show_new'] = $nm_config['is_97'];
$nm_config['flag_versao']['form_order_icons']['display']  = $obj_lic->isVersionReleased('9.7.016');

// escolha de campos alternativos para grid de um form grid editavel view em modal
$nm_config['flag_versao']['form_view_edit_fields']['has']      = $nm_config['has_9_7_16'];
$nm_config['flag_versao']['form_view_edit_fields']['show_new'] = $nm_config['is_97'];
$nm_config['flag_versao']['form_view_edit_fields']['display']  = $obj_lic->isVersionReleased('9.7.016');

// insercao em modal para form grid edital view
$nm_config['flag_versao']['form_view_modal_insert']['has']      = $nm_config['has_9_7_16'];
$nm_config['flag_versao']['form_view_modal_insert']['show_new'] = $nm_config['is_97'];
$nm_config['flag_versao']['form_view_modal_insert']['display']  = $obj_lic->isVersionReleased('9.7.016');

// exportacao do pdf na grid com exibicao da barra de progresso ao abrir diretamente
$nm_config['flag_versao']['grid_pdf_export_progress_bar']['has']      = $nm_config['has_9_7_16'];
$nm_config['flag_versao']['grid_pdf_export_progress_bar']['show_new'] = $nm_config['is_97'];
$nm_config['flag_versao']['grid_pdf_export_progress_bar']['display']  = $obj_lic->isVersionReleased('9.7.016');

// versao 5 do tiny mce
$nm_config['flag_versao']['tinymce_5']['has']      = $nm_config['has_9_7_16'];
$nm_config['flag_versao']['tinymce_5']['show_new'] = $nm_config['is_97'];
$nm_config['flag_versao']['tinymce_5']['display']  = $obj_lic->isVersionReleased('9.7.016');

// 9.7.011 ----------------------------------------------------------

// colunas fixas para a grid
$nm_config['flag_versao']['grid_fixed_columns']['has']      = $nm_config['has_9_7_11'];
$nm_config['flag_versao']['grid_fixed_columns']['show_new'] = $nm_config['is_97'];
$nm_config['flag_versao']['grid_fixed_columns']['display']  = $obj_lic->isVersionReleased('9.7.011');

// quebras com conteudo fixo horizontalmente para a grid
$nm_config['flag_versao']['grid_fixed_groupby']['has']      = $nm_config['has_9_7_11'];
$nm_config['flag_versao']['grid_fixed_groupby']['show_new'] = $nm_config['is_97'];
$nm_config['flag_versao']['grid_fixed_groupby']['display']  = $obj_lic->isVersionReleased('9.7.011');

// botoes de ordenacao de coluna da grid com suporte a font awesome
$nm_config['flag_versao']['grid_order_icons']['has']      = $nm_config['has_9_7_11'];
$nm_config['flag_versao']['grid_order_icons']['show_new'] = $nm_config['is_97'];
$nm_config['flag_versao']['grid_order_icons']['display']  = $obj_lic->isVersionReleased('9.7.011');

// botoes de ordenacao da coluna do resumo com suporte a font awesome
$nm_config['flag_versao']['summary_fixed_columns']['has']      = $nm_config['has_9_7_11'];
$nm_config['flag_versao']['summary_fixed_columns']['show_new'] = $nm_config['is_97'];
$nm_config['flag_versao']['summary_fixed_columns']['display']  = $obj_lic->isVersionReleased('9.7.011');

// 9.7.000 ----------------------------------------------------------

// novos tipos de graficos: scrollbar2d, overlappedbar2d, scrollcolumn2d, overlappedcolumn2d, scrollline, zoomline, scrollarea
$nm_config['flag_versao']['graficos_9_7']['has']      = $nm_config['has_97'];
$nm_config['flag_versao']['graficos_9_7']['show_new'] = $nm_config['is_97'];
$nm_config['flag_versao']['graficos_9_7']['display']  = $obj_lic->isVersionReleased('9.7.000');

// macro sc_btn_disabled para o formulario
$nm_config['flag_versao']['macro_sc_btn_disabled']['has']      = $nm_config['has_97'];
$nm_config['flag_versao']['macro_sc_btn_disabled']['show_new'] = $nm_config['is_97'];
$nm_config['flag_versao']['macro_sc_btn_disabled']['display']  = $obj_lic->isVersionReleased('9.7.000');

// macro sc_btn_label para o formulario
$nm_config['flag_versao']['macro_sc_btn_label']['has']      = $nm_config['has_97'];
$nm_config['flag_versao']['macro_sc_btn_label']['show_new'] = $nm_config['is_97'];
$nm_config['flag_versao']['macro_sc_btn_label']['display']  = $obj_lic->isVersionReleased('9.7.000');

// aplicacao de calendario com melhorias mobile
$nm_config['flag_versao']['mobile_calendar']['has']      = $nm_config['has_97'] ;
$nm_config['flag_versao']['mobile_calendar']['show_new'] = $nm_config['is_97'];
$nm_config['flag_versao']['mobile_calendar']['display']  = $obj_lic->isVersionReleased('9.7.000');

// aplicacao de formulario com melhorias mobile
$nm_config['flag_versao']['mobile_form']['has']      = $nm_config['has_97'];
$nm_config['flag_versao']['mobile_form']['show_new'] = $nm_config['is_97'];
$nm_config['flag_versao']['mobile_form']['display']  = $obj_lic->isVersionReleased('9.7.000');

// formulario com etapas
$nm_config['flag_versao']['wizard_form']['has']      = $nm_config['has_97'];
$nm_config['flag_versao']['wizard_form']['show_new'] = $nm_config['is_97'];
$nm_config['flag_versao']['wizard_form']['display']  = $obj_lic->isVersionReleased('9.7.000');

?>
<?php
        $def_dados = array();
		$def_dados['val_inicial'] = "";
		$def_dados['val_inicial_filtro'] = "";
		$def_dados['html_largura'] = "";
		$def_dados['html_linhas'] = "";
		$def_dados['pre_obrig'] = "";
		$def_dados['tam_minimo'] = "";
		$def_dados['tam_maximo'] = "";
		$def_dados['val_minimo'] = "";
		$def_dados['val_maximo'] = "";
		$def_dados['decimais'] = "";
		$def_dados['aceita_neg'] = "";
		$def_dados['formato_data'] = "";
		$def_dados['simbolo_agr'] = "";
		$def_dados['simbolo_dec'] = "";
		$def_dados['texto_transforma'] = "";
		$def_dados['read_only'] = "";
		$def_dados['soma_coluna'] = "";
		$def_dados['grupo_coluna'] = "";
		$def_dados['grupo_coluna_ord'] = "";
		$def_dados['chave_primaria'] = "";
		$def_dados['comando_select_edit'] = "";
		$def_dados['descricao_hints'] = "";
		$def_dados['char_tipo'] = "";
		$def_dados['char_image_pos'] = "";
		$def_dados['char_image_neg'] = "";
		$def_dados['char_altura'] = "";
		$def_dados['char_largura'] = "";
		$def_dados['char_icone_qtd'] = "";
		$def_dados['mascaragriddetalhe'] = "";
		$def_dados['select_search_checkbox'] = "";
		$def_dados['select_search_colunas'] = "";
		$def_dados['formata_neg'] = "";
		$def_dados['formata_moeda'] = "";
		$def_dados['liga_aplicacao'] = "";
		$def_dados['liga_campos'] = "";
		$def_dados['lookup_cons'] = "";
		$def_dados['lookup_group'] = array();
		$def_dados['def_complemento_group'] = array();
		$def_dados['lookup_pesq'] = "";
		$def_dados['lookup_edit'] = "";
$def_dados['negative_value'] = ['Z', 'N'];
		$def_dados['data_combo'] = "";
		$def_dados['formato_data_outro'] = "";
		$def_dados['busca_opcoes'] = "";
		$def_dados['url_outra_pagina'] = "";
		$def_dados['moeda_simbolo'] = "";
		$def_dados['valor_extenso'] = "";
		$def_dados['valor_extenso_tamanho'] = "";
		$def_dados['bar_code_altura'] = "";
		$def_dados['bar_code_largura'] = "";
		$def_dados['bar_code_fonte'] = "";
		$def_dados['tipo_password'] = "";
		$def_dados['imagem_altura'] = "100";
		$def_dados['imagem_largura'] = "100";
		$def_dados['texto_fonte'] = "";
		$def_dados['texto_tamanho'] = "";
		$def_dados['texto_cor'] = "";
		$def_dados['cor_fundo'] = "";
		$def_dados['texto_italico'] = "";
		$def_dados['texto_bold'] = "";
		$def_dados['texto_alinhamento'] = "";
		$def_dados['texto_formata'] = "";
		$def_dados['texto_nowrap'] = "";
		$def_dados['texto_nowrap_pdf'] = "";
		$def_dados['cons_largura'] = "";
		$def_dados['separador_string'] = "";
		$def_dados['edit_altura'] = "";
		$def_dados['edit_multiplas'] = "";
		$def_dados['calculado'] = "";
		$def_dados['texto_colunas'] = "";
		$def_dados['mostra_zeros'] = "";
		$def_dados['casas_decimais'] = "";
		$def_dados['graf_visual'] = "";
		$def_dados['xml_formatacao'] = "";
		$def_dados['data_minimo'] = "";
		$def_dados['data_maximo'] = "";
		$def_dados['graf_sumariza'] = "";
		$def_dados['graf_quebra'] = array();
		$def_dados['lookup_cons_entra'] = "";
		$def_dados['texto_valinhamento'] = "";
		$def_dados['imagem_fundo'] = "";
		$def_dados['img_outra_pagina'] = "";
		$def_dados['img_aspecto'] = "";
		$def_dados['imagem_borda'] = "";
		$def_dados['cell_height'] = "";
		$def_dados['data_minimo_opcao'] = "";
		$def_dados['data_maximo_opcao'] = "";
		$def_dados['data_minimo_exp'] = "";
		$def_dados['data_maximo_exp'] = "";
		$def_dados['titulo_alinhamento'] = "";
		$def_dados['lookup_original'] = "";
		$def_dados['permitir_valor_branco'] = "S";
		$def_dados['lookup_delimitador'] = "";
		$def_dados['quebra_sumariza'] = array();
		$def_dados['quebra_count'] = array();
		$def_dados['titulo_alinhamento_vert'] = "";
		$def_dados['busca_recarrega'] = "";
		$def_dados['liga_busca_apl'] = "";
		$def_dados['liga_busca_cmp'] = "";
		$def_dados['qtd_bytes'] = "";
		$def_dados['quebra_pagina'] = array();
		$def_dados['quebra_exibe'] = array();
		$def_dados['char_col_largura'] = "";
		$def_dados['completa_esq'] = "";
		$def_dados['campo_relacionado'] = "";
		$def_dados['doc_perm_download'] = "N";
		$def_dados['mascara_consulta'] = "";
		$def_dados['tamanho_banco'] = "";
		$def_dados['not_null'] = "N";
		$def_dados['variavel_where'] = "";
		$def_dados['fld_group_org_campos']                = array();
		$def_dados['fld_group_cols']                      = array();
		$def_dados['fld_group_exibe_label']               = array();
		$def_dados['fld_group_linha_sum_res']             = array();
		$def_dados['fld_group_msg_linha_sum']             = array();
		$def_dados['fld_group_graf_group_new_title']      = array();
		$def_dados['fld_group_graf_group_title_show_val'] = array();
		$def_dados['fld_group_quebra_pag_pdf_res']        = array();
		$def_dados['fld_group_quebra_pag_html_cons']      = array();
		$def_dados['fld_group_quebra_pag_html_res']       = array();
		$def_dados['fld_group_campos']                    = array();

		$def_dados['usar_config_regional_group']          = array();
		$def_dados['formata_moeda_group']                 = array();
		$def_dados['moeda_simbolo_group']                 = array();
		$def_dados['simbolo_agr_group']                   = array();
		$def_dados['simbolo_dec_group']                   = array();
		$def_dados['formata_neg_group']                   = array();
		$def_dados['simbolo_negativo_group']              = array();
		$def_dados['formato_moeda_positivo_group']        = array();
		$def_dados['formato_moeda_negativo_group']        = array();
		$def_dados['cor_negativo_group']                  = array();
		$def_dados['valor_extenso_group']                 = array();
		$def_dados['mostra_zeros_group']                  = array();
		$def_dados['casas_decimais_group']                = array();
		$def_dados['valor_extenso_tamanho_group']         = array();
		$def_dados['formato_num_negativo_group']          = array();
		$def_dados['texto_transforma_group']              = array();

		$def_dados['show_upload_progress']                = 'S';
		$def_dados['upload_inc_if_exist']                 = 'S';
        $def_dados['show_upload_zone']                    = 'S';
        $def_dados['upload_zone_with_fontawesome']        = 'fas fa-cloud-upload-alt';
        $def_dados['upload_zone_clickable']               = 'N';
        $def_dados['upload_api']                          = '';
        $def_dados['upload_api_path']                     = '';
        $def_dados['upload_api_path_cache']               = '';
        $def_dados['upload_api_delete']                   = 'N';
        $def_dados['upload_api_keep_file']                = 'N';
        $def_dados['mu_qtd_cols'] 			              = 1;
        $def_dados['mu_pos_order'] 			              = 'N';
        $def_dados['mu_pos_delete'] 			          = 'beside';
        $def_dados['mu_pos_on_upload'] 			          = 'above';
        $def_dados['mu_show_status'] 			          = 'img_txt';
        $def_dados['mu_table'] 			                  = '';
        $def_dados['mu_fields'] 	                      = array();
        $def_dados['ajax_dados_filter']                   = array();
        $def_dados['refined_search_type']                        = "S";
        $def_dados['refinedsearch_numero_use_range']             = "N";
        $def_dados['refinedsearch_numero_use_range_range']       = "5";
        $def_dados['refinedsearch_numero_use_range_show_values'] = "S";
        $def_dados['refinedsearch_started_opened']               = "";
        $def_dados['refinedsearch_veja_mais']                    = "S";
        $def_dados['refinedsearch_veja_mais_quantidade']         = "10";
        $def_dados['refinedsearch_dt_format']         = "";
        $def_dados['refinedsearch_sort']         = "ASC";
        $def_dados['refinedsearch_show_empty_msg']         = "{lang_refine_search_empty}";
        $def_dados['sort_field']                            = "asc";
        $def_dados['accum']                            = "N";
        $def_dados['accum_field']                            = "";
        $def_dados['resumefilter']                            = array();
        $def_dados['use_switch']                            = 'N';
        $def_dados['use_switch_filter']                            = 'N';
        $def_dados['use_range']                             = 'N';
        $def_dados['use_range_filter']                             = 'N';
        $def_dados['range_width']                             = '200';
        $def_dados['range_width_filter']                             = '200';
        $def_dados['range_increment_value']                             = '1';
        $def_dados['range_increment_value_filter']                             = '1';
        $def_dados['rating_amount']                             = '5';
        $def_dados['rating_icon']                             = 'scriptcase__NM__ico__NM__star.png';
        $def_dados['rating_icon_off']                             = 'scriptcase__NM__ico__NM__star_off.png';
        $def_dados['rating_subtitle']                             = '{lang_rating_subtitle}';
        $def_dados['rating_smile_values'] = array('1','2','3','4','5');
        $def_dados['rating_smile_display'] = 's';
        $def_dados['rating_smile_font_size'] = '30';
        $def_dados['rating_smile_padding'] = '5px';
        $def_dados['rating_smile_colors'] = array('#EB1C24', '#F99F27', '#D4C411', '#9CD43B', '#0B9E1F');
        $def_dados['rating_smile_hints'] = array('{lang_rating_verybad}', '{lang_rating_bad}', '{lang_rating_ok}', '{lang_rating_good}', '{lang_rating_excellent}');
        $def_dados['rating_thumb_values'] = array('Y','N');
        $def_dados['rating_thumb_display'] = 's';
        $def_dados['rating_thumb_font_size'] = '30';
        $def_dados['rating_thumb_padding'] = '5px';
        $def_dados['rating_thumb_colors'] = array('#3381CC', '#E33131');
        $def_dados['rating_thumb_hints'] = array('{lang_rating_like}', '{lang_rating_dislike}');
        $def_dados['rating_star_use'] = 'N';
        $def_dados['rating_star_font_size'] = '30';
        $def_dados['rating_star_padding'] = '5px';
        $def_dados['rating_star_color'] = '#F5C813';
        $def_dados['rating_star_hints'] = array();
        $def_dados['use_select_modern']                       = 'N';
        $def_dados['use_select_modern_filter']                       = 'N';
        $def_dados['autocomplete_minlength']                       = '1';
        $def_dados['select2_show_search']                       = 'S';
        $def_dados['select2_show_search_filter']                       = 'S';
        $def_dados['select2_amount_row']                       = '10';
        $def_dados['select2_amount_row_filter']                       = '10';
        $def_dados['select2_width']                       = '300';
        $def_dados['select2_width_filter']                       = '300';
        $def_dados['signature_bg_color']                      ='#FFFFFF';
        $def_dados['signature_pen_color']                      ='#000000';
        $def_dados['signature_width']                      ='500';
        $def_dados['signature_height']                      ='200';
        $def_dados['signature_legend']                      ='';
        $def_dados['label_below'] = '';
?>
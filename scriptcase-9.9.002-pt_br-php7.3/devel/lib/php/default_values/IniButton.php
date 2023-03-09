<?php
        $def_dados = array();

        /** Estilo padrao de botoes */
    	$css_btn = array();
    	$css_btn['version']                 = "10";
    	$css_btn['internal_version']        = "";

    	$css_btn['css_fonte']               = "Tahoma, Arial, sans-serif";
        $css_btn['css_fonte_size']          = "11px";
        $css_btn['css_fonte_color']         = "#000000";
        $css_btn['css_fonte_weight']        = "normal";
        $css_btn['css_background_color']    = "#EEEEEE";
        $css_btn['css_background_image']    = "";
        $css_btn['css_border_color']        = "#cdcdcd";
        $css_btn['css_border_style']        = "solid";
        $css_btn['css_border_width']        = "1px";
        $css_btn['css_line_height']         = "";
        $css_btn['css_height']              = "";
        $css_btn['css_padding']             = "4px 8px";
        $css_btn['css_textshadow']          = "";
        $css_btn['css_text_decoration']     = "none";
        $css_btn['css_border_radius']       = "4px";
        $css_btn['css_cursor']              = "";

        $def_dados['button']['css_btn_list']['default']      = $css_btn;
        $def_dados['button']['css_btn_list']['onmouseover']  = $css_btn;
        $def_dados['button']['css_btn_list']['onmousedown']  = $css_btn;
        $def_dados['button']['css_btn_list']['disabled']     = $css_btn;
        $def_dados['button']['css_btn_list']['small']        = $css_btn;

        $def_dados['button']['css_btn_list']['small']['css_fonte_size'] = "8px";
        $def_dados['button']['css_btn_list']['disabled']['css_fonte_color']     = "gray";
        $def_dados['button']['css_btn_list']['onmouseover']['css_background_color']     = "#F6F6F6";
        $def_dados['button']['css_btn_list']['onmousedown']['css_background_color']     = "#CCCCCC";

        /*
        Novo padrao de botao
        */
        nm_load_class('xmlparser', 'XmlparserIniButtonSingle');
        $obj_btn = new nmXmlparserIniButtonSingle();
        $def_dados['button']['css_btn_list_new']['default'] = $obj_btn->getData();
        $def_dados['button']['css_btn_list_new']['image']   = $obj_btn->getData();

		/** Estilo padrao de links */
		$css_link = array();
		$css_link['link_css_fonte']          = "Arial, sans-serif";
		$css_link['link_css_fonte_size']     = "12px";
		$css_link['link_css_fonte_color']    = "#0000AA";
		$css_link['link_css_decoration']     = "underline";
		$css_link['visited_css_fonte']       = "Arial, sans-serif";
		$css_link['visited_css_fonte_size']  = "12px";
		$css_link['visited_css_fonte_color'] = "#0000AA";
		$css_link['visited_css_decoration']  = "underline";
		$css_link['active_css_fonte']        = "Arial, sans-serif";
		$css_link['active_css_fonte_size']   = "12px";
		$css_link['active_css_fonte_color']  = "#0000AA";
		$css_link['active_css_decoration']   = "underline";
		$css_link['hover_css_fonte']         = "Arial, sans-serif";
		$css_link['hover_css_fonte_size']    = "12px";
		$css_link['hover_css_fonte_color']   = "#0000AA";
		$css_link['hover_css_decoration']    = "none";
		$def_dados['button']['css_link_list']['default'] = $css_link;

		/** Lista de bot�es */
		$arr_btn_list = array();
		$arr_btn_by_group['grid']	= array("bcons_inicio" => "lang_btns_frst",
											"bcons_retorna" => "lang_btns_prev",
											"bcons_avanca" => "lang_btns_next",
											"bcons_final" => "lang_btns_last",
											"birpara" => "lang_btns_jump",
											"bprint" => "lang_btns_prnt",
											"bresumo" => "lang_btns_smry",
											"bsort" => "lang_btns_sort",
											"bcolumns" => "lang_btns_clmn",
											"bgroupby" => "lang_btns_gbrl",
											"bcons_detalhes" => "lang_btns_lens",
											"bqt_linhas" => "lang_btns_rows",
											"bgraf" => "lang_btns_chrt",
											"bconf_graf" => "lang_btns_chrt_stng",
											"bqtd_bytes" => "lang_btns_qtch",
											"blink_resumogrid" => "lang_btns_smry_drll",
											"brot_resumo" => "lang_btns_smry_rtte",
											"smry_conf" => "lang_btns_smry_conf",
											"gantt_chart" => "lang_btns_chrt_gantt",
											"bcons_apply" => "lang_btns_apply",
											"bcons_cancel" => "lang_btns_cncl",
											"bmultiselect" => "lang_btns_multiselect"
											);
		$arr_btn_by_group['expemail']	= array(
											"bemailpdf"     => "lang_btns_email_pdfc",
											"bemailxml"     => "lang_btns_email_xmlf",
											"bemailjson"     => "lang_btns_email_json",
											"bemailcsv"     => "lang_btns_email_csvf",
											"bemailrtf"     => "lang_btns_email_rtff",
											"bemailxls"   => "lang_btns_email_xlsf",
											"bemaildoc"    => "lang_btns_email_word",
											"bemailimg"     => "lang_btns_email_img",
											"bemailhtml"    => "lang_btns_email_html",
											"bexportemail"	=> "lang_btns_mail"
											);
		$arr_btn_by_group['exp']	= array("bpdf" => "lang_btns_pdfc",
											"brtf" => "lang_btns_rtff",
											"bexcel" => "lang_btns_xlsf",
											"bword" => "lang_btns_word",
											"bxml" => "lang_btns_xmlf",
											"bjson" => "lang_btns_json",
											"bcsv" => "lang_btns_csvf",
								            "bimg"     => "lang_btns_img",
											"bexport" => "lang_btns_expo",
											"bexportview" => "lang_btns_expv",
											"bdownload"	=> "lang_btns_down"
											);
		$arr_btn_by_group['form']	= array("binicio" => "lang_btns_frst",
											"bretorna" => "lang_btns_prev",
											"bavanca" => "lang_btns_next",
											"bstepretorna" => "lang_btns_stepprev",
											"bstepavanca" => "lang_btns_stepnext",
											"bfinal" => "lang_btns_last",
											"bincluir" => "lang_btns_inst",
											"bexcluir" => "lang_btns_dele",
											"balterar" => "lang_btns_updt",
											"bexcluirsel" => "lang_btns_dl_sel",
											"balterarsel" => "lang_btns_sv_sel",
											"bnovo" => "lang_btns_neww",
											"bform_editar" => "lang_btns_pncl",
											"bform_captura" => "lang_btns_rtrv_grid",
											"bform_lookuplink" => "lang_btns_rtrv_form",
											"bok" => "lang_btns_cfrm",
											"bcalendario" => "lang_btns_cldr",
											"bcalculadora" => "lang_btns_calc",
											"bajaxcapt" => "lang_btns_ajax",
											"bajaxclose" => "lang_btns_ajax_close",
											"bcaptchareload" => "lang_btns_cptc_rfim",
											"bsrch_mtmf" => "lang_btns_srch_mtmf",
											"bcopy" => "lang_btns_copy");
		$arr_btn_by_group['chart']	= array("bcresumo" => "lang_btns_smry",
											"bcsort" => "lang_btns_sort",
											"bctype" => "lang_btns_ctype",
                                                                                        "bcpersonalite" => "lang_btns_ctpersonalite",
											"bchart_bar" => "lang_btns_ctbar",
											"bchart_line" => "lang_btns_ctline",
											"bchart_area" => "lang_btns_ctarea",
											"bchart_pizza" => "lang_btns_ctpizza",
											"bchart_combo" => "lang_btns_ctcombo",
											"bchart_stack" => "lang_btns_ctstack");
		
		$arr_btn_by_group['fil']	= array("bpesquisa" => "lang_btns_srch",
											"blimpar" => "lang_btns_clea",
											"bsalvar" => "lang_btns_save",
											"bedit_filter" => "lang_btns_srch_edit",
											"bquick_search" => "lang_btns_quck_srch",
											"bquick_clean" => "lang_btns_quck_clean",
											"blimparsummaryfield" => "lang_btns_clean_summary_field",
											"blimparsummaryall" => "lang_btns_clean_summary_all",
											"boksummary" => "lang_btns_ok_summary",
            );
		$arr_btn_by_group['mas']	= array("bmd_incluir" => "lang_btns_mdtl_inst",
											"bmd_excluir" => "lang_btns_mdtl_dele",
											"bmd_alterar" => "lang_btns_mdtl_updt",
											"bmd_novo" => "lang_btns_copy",
											"bmd_cancelar" => "lang_btns_mdtl_cncl",
											"bmd_edit" => "lang_btns_mdtl_edit");
		$arr_btn_by_group['oth']	= array("bhelp" => "lang_btns_help",
											"bsair" => "lang_btns_exit",
											"bvoltar" => "lang_btns_back",
											"bcancelar" => "lang_btns_cncl",
											"bzipcode" => "lang_btns_zpcd",
											"blink" => "lang_btns_iurl",
											"blanguage" => "lang_btns_lang",
											"bfieldhelp" => "lang_btns_hlpf",
											"bsrgb" => "lang_btns_srgb",
											"berrm_clse" => "lang_btns_errm_clse",
											"bemail" => "lang_btns_emai",
											"bcapture" => "lang_btns_pick",
											"bmessageclose" => "lang_btns_mess_clse",
											"bclear" => "lang_btns_clear",
											"bgooglemaps" => "lang_btns_maps",
											"byoutube" => "lang_btns_yutb",
											"bapply" => "lang_btns_apply",
											"brestore" => "lang_btns_restore",
											"bgridsave" => "lang_btns_gridsave",
											"bgridsavesession" => "lang_btns_gridsavesession",
											"bdynamicsearch" => "lang_btns_dynamicsearch",
											"bpassfld_up"      => "lang_btns_bpassfld_up",
											"bpassfld_down"    => "lang_btns_bpassfld_down",
											"bpassfld_rightall"=> "lang_btns_bpassfld_rightall",
											"bpassfld_right"   => "lang_btns_bpassfld_right",
											"bpassfld_leftall" => "lang_btns_bpassfld_leftall",
											"bpassfld_left"    => "lang_btns_bpassfld_left",
											"breload"          => "lang_btns_reload",
											);

        $arr_btn_by_group['auth']    = array("bfacebook" => "Facebook",
                                            "bgoogle"   => "Google",
                                            "bpaypal"   => "Paypal",
                                            "btwitter"  => "Twitter"
                                            );

		 $arr_btn_by_group['menu']    = array("bmenu" => "Menu",
                                            );

		 $arr_btn_by_group['calendar']    = array(
												"bcalendarimport"        => "lang_btns_import",
												"bcalendarexport"        => "lang_btns_expo",
												"bcalendarcancel"        => "lang_btns_cncl",
												"bcalendarimport_google" => "lang_btns_import_google",
												"bcalendarexport_google" => "lang_btns_export_google",
                                            );

		$arr_btn_by_group['appdiv']    = array(
												"bapply_appdiv"    => "lang_btns_apply",
												"bok_appdiv"       => "lang_btns_cfrm",
												"brestore_appdiv"  => "lang_btns_restore",
												"blimpar_appdiv"   => "lang_btns_clear",
												"bsair_appdiv"     => "lang_btns_exit",
												"bcancelar_appdiv" => "lang_btns_cncl",
												"bsalvar_appdiv" => "lang_btns_save",
												"bexcluir_appdiv" => "lang_btns_dele",
												"bedit_filter_appdiv" => "lang_btns_srch_edit",
												"bnovo_appdiv" => "lang_btns_neww",
                                           );

		$def_dados['button']['list'] = array();
		foreach ($arr_btn_by_group as $arr_btns)
		{
			foreach ($arr_btns as $btn => $lang)
			{
                if($btn == 'blimparsummaryfield')
                {
                    $def_dados['button']['list'][$btn]['type']              = "link";
					$def_dados['button']['list'][$btn]['style']             = "";
					$def_dados['button']['list'][$btn]['value']             = "{" . $lang . "}";
					$def_dados['button']['list'][$btn]['hint']              = "{" . $lang . "_hint}";
					$def_dados['button']['list'][$btn]['display']           = "only_img";
					$def_dados['button']['list'][$btn]['display_position']  = "text_right";
                }
				elseif($btn == 'blimparsummaryall' || $btn == 'boksummary')
                {
                    $def_dados['button']['list'][$btn]['type']              = "button";
					$def_dados['button']['list'][$btn]['style']             = "small";
					$def_dados['button']['list'][$btn]['value']             = "{" . $lang . "}";
					$def_dados['button']['list'][$btn]['hint']              = "{" . $lang . "_hint}";
					$def_dados['button']['list'][$btn]['display']           = "only_text";
					$def_dados['button']['list'][$btn]['display_position']  = "text_right";
                }
				elseif($btn == 'bcalendario' || $btn == 'bcalculadora' || $btn == 'bsrgbbsrgb')
				{
					$def_dados['button']['list'][$btn]['type']              = "image";
					$def_dados['button']['list'][$btn]['style']             = "";
					$def_dados['button']['list'][$btn]['value']             = "{" . $lang . "}";
					$def_dados['button']['list'][$btn]['hint']              = "{" . $lang . "_hint}";
					$def_dados['button']['list'][$btn]['display']           = "only_img";
					$def_dados['button']['list'][$btn]['display_position']  = "text_right";
				}
				elseif($btn == 'bpassfld_up' || $btn == 'bpassfld_down' || $btn == 'bpassfld_rightall' || $btn == 'bpassfld_right' || $btn == 'bpassfld_leftall' || $btn == 'bpassfld_left')
				{
					$def_dados['button']['list'][$btn]['type']              = "image";
					$def_dados['button']['list'][$btn]['style']             = "";
					$def_dados['button']['list'][$btn]['value']             = "{" . $lang . "}";
					$def_dados['button']['list'][$btn]['hint']              = "{" . $lang . "_hint}";
					$def_dados['button']['list'][$btn]['display']           = "only_img";
					$def_dados['button']['list'][$btn]['display_position']  = "text_right";
					$def_dados['button']['list'][$btn]['image_path']        = "scriptcase__NM__ico__NM__img_move_". $btn .".png";
				}
				elseif($btn == 'bmenu')
				{
					$def_dados['button']['list'][$btn]['type']              = "image";
					$def_dados['button']['list'][$btn]['style']             = "";
					$def_dados['button']['list'][$btn]['value']             = "{" . $lang . "}";
					$def_dados['button']['list'][$btn]['hint']              = "{" . $lang . "_hint}";
					$def_dados['button']['list'][$btn]['display']           = "only_img";
					$def_dados['button']['list'][$btn]['display_position']  = "text_right";
					$def_dados['button']['list'][$btn]['image_path']        = "scriptcase__NM__ico__NM__img_btn_menu.png";
				}
				else
				{
					$def_dados['button']['list'][$btn]['type']              = "button";
					$def_dados['button']['list'][$btn]['style']             = "default";
					$def_dados['button']['list'][$btn]['value']             = "{" . $lang . "}";
					$def_dados['button']['list'][$btn]['hint']              = "{" . $lang . "_hint}";
					$def_dados['button']['list'][$btn]['display']           = "only_text";
					$def_dados['button']['list'][$btn]['display_position']  = "text_right";
				}
			}
		}
?>

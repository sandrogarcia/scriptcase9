<?php

/**
 * Verifica se a barra de acoes vai ser gerada
 */
function actionBarGrid_isActive($positionGenerator)
{
    global $tem_embutida_em_linha, $embutida_em_linha_tree, $actionbar_order_left, $actionbar_order_right, $tbapl_criar_detalhe, $tem_link_apl;

    if ($tem_embutida_em_linha && 'S' == $embutida_em_linha_tree && 'left' == $positionGenerator) {
        // barra gerada por ter grid embutida em formato treeview (somente na posicao a esquerda da grid)
        return true;
    }

	if ('S' != $tbapl_criar_detalhe) {
		foreach ($actionbar_order_left as $i => $actionButtonName) {
			if ('__sc_detail' == $actionButtonName) {
				unset($actionbar_order_left[$i]);
			}
		}
		foreach ($actionbar_order_right as $i => $actionButtonName) {
			if ('__sc_detail' == $actionButtonName) {
				unset($actionbar_order_right[$i]);
			}
		}
	}

	if (!$tem_link_apl) {
		foreach ($actionbar_order_left as $i => $actionButtonName) {
			if ('__sc_app_edit' == $actionButtonName) {
				unset($actionbar_order_left[$i]);
			}
		}
		foreach ($actionbar_order_right as $i => $actionButtonName) {
			if ('__sc_app_edit' == $actionButtonName) {
				unset($actionbar_order_right[$i]);
			}
		}
	}

	if ('left' == $positionGenerator && !empty($actionbar_order_left)) {
		// barra da esquerda com botoes
		return true;
    }
	if ('right' == $positionGenerator && !empty($actionbar_order_right)) {
		// barra da direita com botoes
		return true;
	}

    return false;
} // actionBarGrid_isActive

/**
 * Gera celula da action bar na linha de labels da grid
 */
function actionBarGrid_generateLabelCell($template, $positionGenerator)
{
    global $tbapl_use_grid_fixed_columns, $apl_tem_fixed_headers, $nome_aplicacao, $tem_embutida_em_linha,
           $embutida_em_linha_tree;

    if (!actionBarGrid_isActive($positionGenerator)) {
        return;
    }

	$trMarkerIni = '';
	$trMarkerEnd = '';
    $scColActions = ' sc-col-actions';
	if ('right' == $positionGenerator) {
		$trMarkerIni = '/*SC_ACTION_TR_INI*/';
		$trMarkerEnd = '/*SC_ACTION_TR_END*/';
        $scColActions = '';
	}

    $cabIniTest = "!\$_SESSION['sc_session'][\$this->Ini->sc_page]['$nome_aplicacao']['embutida'] && \$_SESSION['sc_session'][\$this->Ini->sc_page]['$nome_aplicacao']['opcao_print'] != \"print\" && \$_SESSION['sc_session'][\$this->Ini->sc_page]['$nome_aplicacao']['opcao'] != \"pdf\"";
    if ($tem_embutida_em_linha && 'S' == $embutida_em_linha_tree && 'left' == $positionGenerator) {
        $cabIniTest = "\$_SESSION['sc_session'][\$this->Ini->sc_page]['$nome_aplicacao']['opcao_print'] != \"print\" && \$_SESSION['sc_session'][\$this->Ini->sc_page]['$nome_aplicacao']['opcao'] != \"pdf\" && \$_SESSION['sc_session'][\$this->Ini->sc_page]['$nome_aplicacao']['embutida_pdf'] != \"pdf\"";
    }

    $fixedColumnCss = '';
    $fixedColumnBackgroundCss = '';
    $fixedColumnActions = '&nbsp;';
    $fixedColumnIncrement = '';
    $fixedColumnClasses = '';
    if ($tbapl_use_grid_fixed_columns || $apl_tem_fixed_headers) {
        $fixedColumnBackgroundCss = "\$this->css_inherit_bg . ' ' . ";
    }

    if ($tbapl_use_grid_fixed_columns) {
        $fixedColumnCss = " <?php echo \$classColFld . \$classColTitle . \$classColActions ?>";
        $fixedColumnActions = "<span class=\"sc-op-fix-col sc-op-fix-col-<?php echo \$this->grid_fixed_column_no ?> sc-op-fix-col-notfixed\" data-fixcolid=\"<?php echo \$this->grid_fixed_column_no ?>\" id=\"sc-fld-fix-col-<?php echo \$this->grid_fixed_column_no ?>\"><i class=\"fas fa-thumbtack\"></i></span>";
        $fixedColumnIncrement = "    \$this->grid_fixed_column_no++;\r\n";
        $fixedColumnClasses = <<<EOT
       \$classColFld = "";
       \$classColTitle = "";
       \$classColActions = "";
       if (!\$_SESSION['sc_session'][\$this->Ini->sc_page]['$nome_aplicacao']['embutida'] && \$_SESSION['sc_session'][\$this->Ini->sc_page]['$nome_aplicacao']['opcao_print'] != 'print' && \$_SESSION['sc_session'][\$this->Ini->sc_page]['$nome_aplicacao']['opcao'] != 'pdf') {
           \$classColFld = " sc-col-fld sc-col-fld-" . \$this->grid_fixed_column_no;
           \$classColTitle = " sc-col-title";
           \$classColActions = "$scColActions";
       }

EOT;
    }

    $template->set_var(
        array(
            "NM_CSS_TIT_DATA" => "class=\"<?php echo {$fixedColumnBackgroundCss}\$this->css_scGridLabelFont ?>{$fixedColumnCss}\"",
            "NM_CAB_TITULO" => "$fixedColumnActions",
            "NM_CAB_WIDTH" => "",
            "NM_CAB_INI" => "$trMarkerIni\r\n<?php\r\n   if ($cabIniTest) {\r\n$fixedColumnClasses?>\r\n",
            "NM_CAB_FIM" => "\r\n<?php\r\n   $fixedColumnIncrement} \r\n?>\r\n$trMarkerEnd"
        )
    );
    $template->parse("handle_cabecalho", "bloco_cabecalho", true);

    $template->set_var(array("NM_CSS_TIT_DATA" => "class=\"<?php echo \$this->css_scGridLabelFont ?>\""));
} // actionBarGrid_generateLabelCell

/**
 * Gera celula da action bar no corpo da grid
 */
function actionBarGrid_generateBodyCell($template, $positionGenerator, $buttonOrder, $php_cmp)
{
    global $tab_emb, $tab_det, $tab_edit, $tbapl_use_grid_fixed_columns, $apl_tem_fixed_headers, $nome_aplicacao,
           $tem_embutida_em_linha, $embutida_em_linha_tree, $monta_links_emb, $actionbar_data, $tbapl_attr3_parms,
           $apl_tem_actionbar, $actionbar_order_left, $actionbar_order_right;

    $multiRecord = "_<?php echo \$this->SC_seq_page ?>";

    $buttonVAlign = 'top';
    if ($apl_tem_actionbar && isset($tbapl_attr3_parms['actionbar_grid_visual']['valign']) && in_array($tbapl_attr3_parms['actionbar_grid_visual']['valign'], array('top', 'middle', 'bottom'))) {
        $buttonVAlign = $tbapl_attr3_parms['actionbar_grid_visual']['valign'];
    }

    if (!actionBarGrid_isActive($positionGenerator)) {
        return;
    }

	$trMarkerIni = '';
	$trMarkerEnd = '';
	if ('right' == $positionGenerator) {
		$trMarkerIni = '/*SC_ACTION_TR_INI*/';
		$trMarkerEnd = '/*SC_ACTION_TR_END*/';

        $template->set_var("NM_CSS_GRID_DATA", "class=\"<?php echo \$this->css_line_fonf ?>\"");
	}

    if (!empty($tab_emb) || !empty($tab_det) || !empty($tab_edit) || ('left' == $positionGenerator && !empty($actionbar_order_left)) || ('right' == $positionGenerator && !empty($actionbar_order_right))) {
        $buttonOrderEdit = [];
        $buttonOrderNotEdit = [];

        if (!empty($tab_emb) && 'left' == $positionGenerator) {
            $buttonOrderEdit[] = $tab_emb;
            $buttonOrderNotEdit[] = $tab_emb;
        }

        $buttonHint = [];
        foreach ($buttonOrder as $actionbar_button_name) {
            if ('__sc_detail' == $actionbar_button_name) {
                $buttonOrderEdit[] = $tab_det;
                $buttonOrderNotEdit[] = $tab_det;
            } elseif ('__sc_app_edit' == $actionbar_button_name) {
                $buttonOrderEdit[] = $tab_edit;
            } elseif (isset($actionbar_data[$actionbar_button_name]) && 'link' == $actionbar_data[$actionbar_button_name]['type']) {
                $buttonOrderEdit[] = actionBarGrid_generateLink($actionbar_button_name, $actionbar_data[$actionbar_button_name], actionBarGrid_getLinkData($actionbar_button_name));
                $buttonOrderNotEdit[] = actionBarGrid_generateLink($actionbar_button_name, $actionbar_data[$actionbar_button_name], actionBarGrid_getLinkData($actionbar_button_name));
                $buttonHint[] = <<<EOT

<?php
              \$buttonHint = \$this->actionBar_getStateHint('{$actionbar_button_name}');
              if ('' == \$buttonHint) {
                  \$buttonHint = '{$actionbar_button_name}';
              }
?>
<script>
$(function() {
    tippy("#sc-actionbar-actbtn_{$actionbar_button_name}{$multiRecord}", {
        content: "<?php echo \$buttonHint ?>",
        theme: "light",
    });
    $("#sc-actionbar-actbtn_{$actionbar_button_name}{$multiRecord}").attr("title", "");
});
</script>

EOT;
            } elseif (isset($actionbar_data[$actionbar_button_name]) && 'ajax' == $actionbar_data[$actionbar_button_name]['type']) {
                $buttonOrderEdit[] = actionBarGrid_generateAjax($actionbar_button_name, $actionbar_data[$actionbar_button_name]);
                $buttonOrderNotEdit[] = actionBarGrid_generateAjax($actionbar_button_name, $actionbar_data[$actionbar_button_name]);
                $buttonHint[] = <<<EOT

<?php
              \$buttonHint = \$this->actionBar_getStateHint('{$actionbar_button_name}');
              if ('' == \$buttonHint) {
                  \$buttonHint = '{$actionbar_button_name}';
              }
?>
<script>
$(function() {
    tippy("#sc-actionbar-actbtn_{$actionbar_button_name}{$multiRecord}", {
        content: "<?php echo \$buttonHint ?>",
        theme: "light",
    });
    $("#sc-actionbar-actbtn_{$actionbar_button_name}{$multiRecord}").attr("title", "");
});
</script>

EOT;
            }
        }
        $buttonHint = implode("\r\n", $buttonHint);

        // fixar coluna: detalhe e link para outra aplicacao
        $fixedColumnCss = '';
        $fixedColumnBackgroundCss = '';
        $fixedColumnIncrement = '';
        if ($tbapl_use_grid_fixed_columns || $apl_tem_fixed_headers) {
            $fixedColumnBackgroundCss = "\$this->css_inherit_bg . ' ' . ";
        }
        if ($tbapl_use_grid_fixed_columns) {
            $fixedColumnCss = " sc-col-fld sc-col-fld-<?php echo \$this->grid_fixed_column_no ?>";
            $fixedColumnIncrement = "\$this->grid_fixed_column_no++;";

            $template->set_var("NM_CSS_GRID_DATA", "class=\"<?php echo {$fixedColumnBackgroundCss}\$this->css_line_fonf ?>{$fixedColumnCss}\"");
        }

        $template->set_var("NM_DAD_WIDTH", "WIDTH=\"1px\"");
        $template->set_var(
            array(
                "NM_CMP_DADO"   => "\r\n<table style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\"><tr>\r\n" . implode("\r\n", $buttonOrderEdit) . "\r\n</tr></table\r\n>",
                "NM_NOWRAP"     => "NOWRAP",
                "NM_CMP_VALIGN" => $buttonVAlign,
                "NM_CMP_ALIGN"  => "center"
            )
        );
        $template->set_var("NM_CMP_PHP", "$trMarkerIni\r\n<?php\r\n if (!\$_SESSION['sc_session'][\$this->Ini->sc_page]['$nome_aplicacao']['embutida'] && \$_SESSION['sc_session'][\$this->Ini->sc_page]['$nome_aplicacao']['opcao_print'] != \"print\" && \$_SESSION['sc_session'][\$this->Ini->sc_page]['$nome_aplicacao']['opcao'] != \"pdf\" && \$_SESSION['sc_session'][\$this->Ini->sc_page]['$nome_aplicacao']['mostra_edit'] != \"N\"){ \r\n" . $php_cmp . $buttonHint . "?>\r\n");
        $template->set_var("NM_FIM_PHP", "\r\n<?php\r\n $fixedColumnIncrement} \r\n?>\r\n$trMarkerEnd");
        $template->parse("handle_dados", "bloco_dados", true);

        $template->set_var(
            array(
                "NM_CMP_DADO"   => "\r\n<table style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\"><tr>\r\n" . implode("\r\n", $buttonOrderNotEdit) . "\r\n</tr></table>\r\n",
                "NM_NOWRAP"     => "NOWRAP",
                "NM_CMP_VALIGN" => $buttonVAlign,
                "NM_CMP_ALIGN"  => "center"
            )
        );
        $template->set_var("NM_CMP_PHP", "$trMarkerIni\r\n<?php\r\n if (!\$_SESSION['sc_session'][\$this->Ini->sc_page]['$nome_aplicacao']['embutida'] && \$_SESSION['sc_session'][\$this->Ini->sc_page]['$nome_aplicacao']['opcao_print'] != \"print\" && \$_SESSION['sc_session'][\$this->Ini->sc_page]['$nome_aplicacao']['opcao'] != \"pdf\" && \$_SESSION['sc_session'][\$this->Ini->sc_page]['$nome_aplicacao']['mostra_edit'] == \"N\"){ \r\n" . $php_cmp . $buttonHint . "?>\r\n");
        $template->set_var("NM_FIM_PHP", "\r\n<?php\r\n $fixedColumnIncrement} \r\n?>\r\n$trMarkerEnd");
        $template->parse("handle_dados", "bloco_dados", true);

        if ($tbapl_use_grid_fixed_columns) {
            $template->set_var("NM_CSS_GRID_DATA", "class=\"<?php echo \$this->css_line_fonf ?>\"");
        }
    }

    if ($tem_embutida_em_linha && $embutida_em_linha_tree == "S" && 'left' == $positionGenerator)
    {
        $template->set_var(
            [
                "NM_CMP_DADO"   => "$monta_links_emb",
                "NM_NOWRAP"     => "NOWRAP",
                "NM_CMP_VALIGN" => $buttonVAlign,
                "NM_CMP_ALIGN"  => "center"
            ]
        );
        $template->set_var("NM_CMP_PHP", "$trMarkerIni\r\n<?php\r\n if (\$_SESSION['sc_session'][\$this->Ini->sc_page]['$nome_aplicacao']['embutida'] && \$_SESSION['sc_session'][\$this->Ini->sc_page]['$nome_aplicacao']['opcao_print'] != \"print\" && \$_SESSION['sc_session'][\$this->Ini->sc_page]['$nome_aplicacao']['opcao'] != \"pdf\" && \$_SESSION['sc_session'][\$this->Ini->sc_page]['$nome_aplicacao']['embutida_pdf'] != \"pdf\"){ \r\n?>\r\n");
        $template->set_var("NM_FIM_PHP", "\r\n<?php\r\n } \r\n?>\r\n$trMarkerEnd");
        $template->parse("handle_dados", "bloco_dados", true);
    }
} // actionBarGrid_generateBodyCell

/**
 * Gera celula de um botao ajax da actionbar.
 */
function actionBarGrid_generateAjax($buttonName, $buttonData)
{
    $multiRecord = "_<?php echo \$this->SC_seq_page ?>";

    $buttonHtml = '<td style="padding: 0">';
    $buttonHtml .= '<span class="' . actionBarGrid_getDisplayClass($buttonData) . "<?php echo \$this->actionBar_getStateDisable('{$buttonName}') . \$this->actionBar_getStateHide('{$buttonName}') ?>\" id=\"sc-actionbar-actbtn_" . $buttonName . $multiRecord . "\" title=\"<?php echo \$this->actionBar_getStateHint('$buttonName') ?>\" data-actionbar-row=\"{$multiRecord}\" data-actionbar-state=\"<?php echo \$this->sc_actionbar_states['$buttonName'] ?>\">";
    $buttonHtml .= "<?php echo \$this->actionBar_displayState('$buttonName') ?>";
    $buttonHtml .= '</span>';
    $buttonHtml .= '</td>';

    return $buttonHtml;
} // actionBarGrid_generateAjax

/**
 * Gera celula de um botao link da actionbar.
 */
function actionBarGrid_generateLink($buttonName, $buttonData, $linkData)
{
    global $nome_aplicacao, $nmgp_cod_aspas, $subst_amigavel;

    $multiRecord = "_<?php echo \$this->SC_seq_page ?>";

    $linkApp = actionBarGrid_getLinkApp($linkData);
    $linkExitUrl = actionBarGrid_getLinkExitUrl($linkData);
    $linkParams = actionBarGrid_getLinkParams($linkData);
    $linkMethod = actionBarGrid_getLinkMethod($linkData);
    $linkTarget = actionBarGrid_getLinkTarget($linkData);
    $linkParam6 = actionBarGrid_getLinkParam6($linkData);
    $linkModalSize = actionBarGrid_getLinkModalSize($linkData);

    $protectApp = str_replace($subst_amigavel, "_", $linkApp);
    if (is_numeric(substr($protectApp, 0, 1))) {
        $protectApp = "_" . $protectApp;
    }

    $buttonHtml = '<td style="padding: 0">';

	$buttonHtml .= <<<EOT

<?php
            \$linkTarget = isset(\$this->Ini->sc_lig_target['{$linkData['liga_tipo']}_@scinf_{$linkData['liga_campo']}_@scinf_{$linkData['liga_apl']}']) ? \$this->Ini->sc_lig_target['{$linkData['liga_tipo']}_@scinf_{$linkData['liga_campo']}_@scinf_{$linkData['liga_apl']}'] : (isset(\$this->Ini->sc_lig_target['{$linkData['liga_tipo']}_@scinf_{$linkData['liga_campo']}']) ? \$this->Ini->sc_lig_target['{$linkData['liga_tipo']}_@scinf_{$linkData['liga_campo']}'] : null);
            if (isset(\$this->Ini->sc_lig_md5["{$linkData['liga_apl']}"]) && \$this->Ini->sc_lig_md5["{$linkData['liga_apl']}"] == "S") {
                \$Parms_Lig = "{$linkParams}";
                if (\$_SESSION['scriptcase']['proc_mobile']) {
                    \$Parms_Lig = str_replace("NM_run_iframe?#?1?@?", "", \$Parms_Lig);
                }
                if (\$_SESSION['sc_session'][\$this->Ini->sc_page]['{$nome_aplicacao}']['dashboard_info']['under_dashboard'] && isset(\$linkTarget)) {
                    if ('' != \$Parms_Lig) {
                        \$Parms_Lig .= '*scout';
                    }
                    \$Parms_Lig .= 'under_dashboard*scin1*scoutdashboard_app*scin' . \$_SESSION['sc_session'][\$this->Ini->sc_page]['{$nome_aplicacao}']['dashboard_info']['dashboard_app'] . '*scoutown_widget*scin' . \$linkTarget . '*scoutparent_widget*scin' . \$_SESSION['sc_session'][\$this->Ini->sc_page]['{$nome_aplicacao}']['dashboard_info']['own_widget'] . '*scoutcompact_mode*scin' . (\$_SESSION['sc_session'][\$this->Ini->sc_page]['{$nome_aplicacao}']['dashboard_info']['compact_mode'] ? '1' : '0') . '*scoutremove_margin*scin' . (\$_SESSION['sc_session'][\$this->Ini->sc_page]['{$nome_aplicacao}']['dashboard_info']['remove_margin'] ? '1' : '0') . '*scoutremove_border*scin' . (\$_SESSION['sc_session'][\$this->Ini->sc_page]['{$nome_aplicacao}']['dashboard_info']['remove_border'] ? '1' : '0');
                }
                \$Md5_Lig = "@SC_par@" . NM_encode_input(\$this->Ini->sc_page) . "@SC_par@{$nome_aplicacao}@SC_par@" . md5(\$Parms_Lig);
                \$_SESSION['sc_session'][\$this->Ini->sc_page]['{$nome_aplicacao}']['Lig_Md5'][md5(\$Parms_Lig)] = \$Parms_Lig;
            } else {
                \$Md5_Lig = "{$linkParams}";
            }
?>


EOT;

    // resolver $css_style
    $css_style = '';

    if ($linkData['liga_apl_tipo'] == "A" || $linkData['liga_apl_tipo'] == "C") {
        $tmplinkTarget = "<?php echo (isset(\$linkTarget) ? \$linkTarget : '" . $linkTarget . "') ?>";

        $buttonHtml .= "<a href=\"javascript: " . $linkMethod . "('sc-actionbar-actbtn_" . $buttonName . $multiRecord . "', '<?php echo \$this->Ini->link_" . $protectApp . " . " . $nmgp_cod_aspas . "', '$linkExitUrl', '\$Md5_Lig', '$tmplinkTarget'$linkParam6, 'inicio', '{$linkModalSize['height']}', '{$linkModalSize['width']}', '', '" . $linkData['liga_apl'] . "', '" . $nmgp_cod_aspas . " . \$this->SC_ancora . " . $nmgp_cod_aspas . "')\" title=\"" . actionBarGrid_getLangString_quotesProtected($buttonData['states'][0]['hint']) . "\" id=\"sc-actionbar-actbtn_" . $buttonName . $multiRecord . "\" data-actionbar-row=\"{$multiRecord}\" class=\"" . actionBarGrid_getDisplayClass($buttonData) . " " . $nmgp_cod_aspas . " . \$this->Ini->cor_link_dados . \$this->css_sep . \$this->actionBar_getStateDisable('{$buttonName}') . \$this->actionBar_getStateHide('{$buttonName}') ?>\"$css_style>";
    } elseif ($linkData['liga_apl_tipo'] == "F" || $linkData['liga_apl_tipo'] == "M" || $linkData['liga_apl_tipo'] == "MT" || $linkData['liga_apl_tipo'] == "B") {
        $tmplinkTarget = "<?php echo (isset(\$linkTarget) ? \$linkTarget : '" . $linkTarget . "') ?>";

        $buttonHtml .= "<a href=\"javascript:" . $linkMethod . "('sc-actionbar-actbtn_" . $buttonName . $multiRecord . "', '<?php echo \$this->Ini->link_" . $protectApp . " . " . $nmgp_cod_aspas . "', '$linkExitUrl', '\$Md5_Lig', '$tmplinkTarget'$linkParam6, '', '{$linkModalSize['height']}', '{$linkModalSize['width']}', '', '" . $linkData['liga_apl'] . "', '" . $nmgp_cod_aspas . " . \$this->SC_ancora . " . $nmgp_cod_aspas . "')\" title=\"" . actionBarGrid_getLangString_quotesProtected($buttonData['states'][0]['hint']) . "\" id=\"sc-actionbar-actbtn_" . $buttonName . $multiRecord . "\" data-actionbar-row=\"{$multiRecord}\" class=\"" . actionBarGrid_getDisplayClass($buttonData) . " " . $nmgp_cod_aspas . " . \$this->Ini->cor_link_dados . \$this->css_sep . \$this->actionBar_getStateDisable('{$buttonName}') . \$this->actionBar_getStateHide('{$buttonName}') ?>\"$css_style>";
    }/* elseif ($linkData['liga_apl_tipo'] == "U") {
        $monta_links_ini .= "\r\n<?php\r\n     \$nmgp_parms_url = " . $path_link . $tmp_apl . " . \"" . $nmgp_parms_url . "\"$contr_sec;\r\n ?>\r\n";
        $buttonHtml .= "<a href=\"<?php echo \$nmgp_parms_url . $nmgp_cod_aspas\" target=\"_self\" class=\"" . $nmgp_cod_aspas . " . \$this->Ini->cor_link_dados . \$this->css_sep . \$this->css_" . $nmgp_campo . "_grid_line ?>\"$css_style>$descr_lig_mult</a>" . $lig_mult_fim;
    }*/

    $buttonHtml .= "<?php echo \$this->actionBar_displayState('$buttonName') ?>";
    $buttonHtml .= '</a>';
	$buttonHtml .= '</td>';

    return $buttonHtml;
} // actionBarGrid_generateLink

/**
 * Gera conteudo html para exibicao de um botao da actionbar.
 */
function actionBarGrid_generateVisual_quotes($buttonDisplay, $buttonState, $buttonName)
{
    switch ($buttonDisplay) {
        case 'fa':
            return actionBarGrid_generateVisualFontAwesome($buttonState, $buttonName);
        case 'img':
            return actionBarGrid_generateVisualImage($buttonState);
        case 'text':
            return actionBarGrid_generateVisualText_quotes($buttonState);
    }
}

/**
 * Gera conteudo html para exibicao de um botao da actionbar.
 */
function actionBarGrid_generateVisual_quotesProtected($buttonDisplay, $buttonState, $buttonName)
{
    switch ($buttonDisplay) {
        case 'fa':
            return actionBarGrid_generateVisualFontAwesome($buttonState, $buttonName);
        case 'img':
            return actionBarGrid_generateVisualImage($buttonState);
        case 'text':
            return actionBarGrid_generateVisualText_quotesProtected($buttonState);
    }
}

/**
 * Gera conteudo html para exibicao de um botao com display font awesome.
 */
function actionBarGrid_generateVisualFontAwesome($buttonState, $buttonName)
{

    return '<i class="icon_fa sc-actb-' . $buttonName . ' sc-acts-' . $buttonState['label'] . ' ' . $buttonState['fa_icon'] . '"></i>';
} // actionBarGrid_generateVisualFontAwesome

/**
 * Gera conteudo html para exibicao de um botao com display imagem.
 */
function actionBarGrid_generateVisualImage($buttonState)
{
    global $nm_img_icone;

    $nm_img_icone[] = $buttonState['img_icon'];

    return "<img src=\"<?php echo \$this->Ini->path_icones . '/' ?>{$buttonState['img_icon']}\" style=\"border: 0; vertical-align: middle\" />";
} // actionBarGrid_generateVisualImage

/**
 * Gera conteudo html para exibicao de um botao com display texto com aspas.
 */
function actionBarGrid_generateVisualText_quotes($buttonState)
{
    return '&nbsp;' . actionBarGrid_getLangString_quotes($buttonState['txt_label']) . '&nbsp;';
} // actionBarGrid_generateVisualText

/**
 * Gera conteudo html para exibicao de um botao com display texto com aspas protegidas.
 */
function actionBarGrid_generateVisualText_quotesProtected($buttonState)
{
    return '&nbsp;' . actionBarGrid_getLangString_quotesProtected($buttonState['txt_label']) . '&nbsp;';
} // actionBarGrid_generateVisualText

/**
 * Recupera a classe css para uso no botao de acordo com o tipo de display.
 */
function actionBarGrid_getDisplayClass($buttonData)
{
    switch ($buttonData['display']) {
        case 'fa':
            return 'scButton_fontawesome sc-actionbar-fa';
        case 'img':
            return 'sc-actionbar-img';
        case 'text':
            return 'scLink_default sc-actionbar-txt';
    }
} // actionBarGrid_getDisplayClass

/**
 * Recupera string com idioma tratado com aspas.
 */
function actionBarGrid_getLangString_quotes($string)
{
    return actionBarGrid_getLangString($string, "\"");
} // actionBarGrid_getLangString_quotes

/**
 * Recupera string com idioma tratado com aspas protegidas.
 */
function actionBarGrid_getLangString_quotesProtected($string)
{
    global $nmgp_cod_aspas;

    return actionBarGrid_getLangString($string, $nmgp_cod_aspas);
} // actionBarGrid_getLangString_quotesProtected

/**
 * Recupera o hint de um botao.
 */
function actionBarGrid_getLangString($string, $quotes)
{
    global $tbapl_idioma, $apl_charset, $tbapl_atributos, $nmgp_cod_aspas;

    protect_string($string);

    sc_preg_match_local($string, $var_local, $tbapl_idioma, $apl_charset);
    if (!empty($var_local[0])) {
        $var_local = $var_local[0];
        foreach ($var_local as $cada_var_loc) {
            $nome_var = substr($cada_var_loc, 1, strlen($cada_var_loc) - 2);
            if (in_array($nome_var, $tbapl_atributos)) {
                $cmp_troca = $quotes . " . \$_SESSION['$nome_aplicacao']['" . $nome_var . "'] . " . $quotes;
                $string = str_replace($cada_var_loc, $cmp_troca, $string);
            } elseif (substr($nome_var, 0, 5) == "lang_") {
                $cmp_troca = $quotes . " . \$this->Ini->Nm_lang['" . $nome_var . "'] . " . $quotes;
                $string = str_replace($cada_var_loc, $cmp_troca, $string);
            } else {
                $cmp_troca = $quotes . " . \$this->" . strtolower($nome_var) . " . " . $quotes;
                $string = str_replace($cada_var_loc, $cmp_troca, $string);
            }
        }
    }

    sc_preg_match_global($string, $var_local, $tbapl_idioma, $apl_charset);
    if (!empty($var_local[0])) {
        $var_local = $var_local[0];
        foreach ($var_local as $cada_var_loc) {
            $cmp_troca = $quotes . " .  \$_SESSION['" . substr($cada_var_loc, 1, strlen($cada_var_loc) - 2) . "'] . " . $quotes;
            $string = str_replace($cada_var_loc, $cmp_troca, $string);
        }
    }

    return $string;
} // actionBarGrid_getLangString

/**
 * Recupera dados da ligacao de um botao da actionbar.
 */
function actionBarGrid_getLinkData($buttonName)
{
    global $tbapl_ligacoes;

    foreach ($tbapl_ligacoes as $linkData) {
        if ('actbtn_' . $buttonName == $linkData['liga_id']) {
            return $linkData;
        }
    }

    return null;
} // actionBarGrid_getLinkData

/**
 * Recupera aplicacao de destino do link.
 */
function actionBarGrid_getLinkApp($linkData)
{
    global $usa_nome_amigavel, $apl_url_amigavel;

    $linkApp = $linkData['liga_apl'];
    $linkType = $linkData['liga_apl_tipo'];

    if ($linkType == "A") {
        $linkApp .= "_aba";
    } elseif ($linkType == "C") {
        $linkApp .= "_cons";
    } elseif ($linkType == "F") {
        $linkApp .= "_edit";
    } elseif ($linkType == "B") {
        $linkApp .= "_blk";
    } elseif ($linkType == "U") {
        $exclamationPos = strpos($linkApp, "?");
        if ($exclamationPos !== false) {
            $urlParams = substr($linkApp, $exclamationPos + 1);
            $linkApp = substr($linkApp, 0, $exclamationPos);
        }
        $directory = explode("/", $linkApp);
        if (count($directory) == 0 || count($directory) > 2 || strtolower(substr($linkApp, 0, 7)) == "http://" || strtolower(substr($linkApp, 0, 8)) == "https://" || strtolower(substr($linkApp, 0, 3)) == "../") {
        } else {
            if (count($directory) == 1) {
                $appBaseName = str_replace(".php", "", $linkApp);
                $appDirName = $appBaseName;
                if ($usa_nome_amigavel) {
                    $appDirName = "\" . SC_dir_app_name('$appBaseName') . \"";
                }
                if ($apl_url_amigavel) {
                    $linkApp = $appDirName . "/";
                } else {
                    $linkApp = $appDirName . "/" . $appBaseName . ".php";
                }
            } else {
                $linkApp = $directory[0] . "/";
                $appBaseName = str_replace(".php", "", $directory[1]);
                $linkApp .= $appBaseName . "/" . $appBaseName . ".php";
            }
            $path_link = "\$this->Ini->path_link . ";
            if (!empty($urlParams)) {
                $securityControl = " . \"&script_case_init=\" . NM_encode_input(\$this->Ini->sc_page)" . (scSecurity_use_sc_session() ? " . \"&script_case_session=\" . session_id()" : "") . " . \"&nmgp_url_saida=\" . \$this->nm_location";
            } else {
                $securityControl = " . \"script_case_init=\" . NM_encode_input(\$this->Ini->sc_page)" . (scSecurity_use_sc_session() ? " . \"&script_case_session=\" . session_id()" : "") . " . \"&nmgp_url_saida=\" . \$this->nm_location";
            }
        }
        $linkApp = $nmgp_cod_aspas . $linkApp . $nmgp_cod_aspas;
        if (!empty($urlParams) || !empty($securityControl)) {
            $linkApp .= " . \"?\"";
        }
    }

    return $linkApp;
} // actionBarGrid_getLinkApp

/**
 * Recupera URL de saida de um link.
 */
function actionBarGrid_getLinkExitUrl($linkData)
{
    global $usa_nome_amigavel, $apl_url_amigavel, $nmgp_cod_aspas;

    $linkExitUrl = "\$this->nm_location";

    if (!empty($linkData['liga_url_saida'])) {
        $linkExitUrl = $linkData['liga_url_saida'];
        $directory = explode("/", $linkExitUrl);
        if ($linkExitUrl == "\$HTTP_REFERER" || $linkExitUrl == "\$_SERVER['HTTP_REFERER']") {
            $linkExitUrl = "\$HTTP_REFERER";
        }
        if (count($directory) > 2 || $linkExitUrl == "\$HTTP_REFERER") {
        } else {
            if (count($directory) == 1) {
                $linkExitUrl = str_replace(".php", "", $linkExitUrl);
                $appDirName = $linkExitUrl;
                if ($usa_nome_amigavel) {
                    $appDirName = "<?php echo SC_dir_app_name('$linkExitUrl') ?>";
                }
                if ($apl_url_amigavel) {
                    $linkExitUrl = $appDirName . "/";
                } else {
                    $linkExitUrl = $appDirName . "/" . $linkExitUrl . ".php";
                }
            } elseif (count($directory) == 2) {
                $linkExitUrl = $directory[0] . "/";
                $appBaseName = str_replace(".php", "", $directory[1]);
                $linkExitUrl .= $appBaseName . "/" . $appBaseName . ".php";
            }
            $linkExitUrl = $nmgp_cod_aspas . " . \$this->Ini->path_link . " . $nmgp_cod_aspas . $linkExitUrl;
        }
    }

    return $linkExitUrl;
} // actionBarGrid_getLinkExitUrl

/**
 * Recupera o metodo usado para enviar o link.
 */
function actionBarGrid_getLinkMethod($linkData)
{
    if ($linkData['liga_target'] == 'S') {
        return 'actionBar_linkSubmit6';
    }

    return 'actionBar_linkSubmit5';
} // actionBarGrid_getLinkMethod

/**
 * Recupera o tamanho do modal onde o link sera aberto.
 */
function actionBarGrid_getLinkModalSize($linkData)
{
    $modalHeight = 0;
    $modalWidth = 0;

    if ($linkData['liga_target'] == "M") {
        $modalHeight = (!empty($linkData['liga_modal_height'])) ? $linkData['liga_modal_height'] : "440";
        $modalWidth = (!empty($linkData['liga_modal_width'])) ? $linkData['liga_modal_width'] : "630";
    }

    return [
        'height' => $modalHeight,
        'width' => $modalWidth
    ];
} // actionBarGrid_getLinkModalSize

/**
 * Recupera o parametro 6 do link.
 */
function actionBarGrid_getLinkParam6($linkData)
{
    if ($linkData['liga_target'] == "S") {
        $temp = str_replace(".", "", $linkData['liga_tamanho']);
        $iframeHeight = ($temp > 0) ? $temp : "700px";
        $temp = str_replace(".", "", $linkData['liga_largura']);
        $iframeWidthh = ($temp > 0) ? $temp : "200px";

        if (is_numeric($iframeHeight)) {
            $iframeHeight .= "px";
        }
        if (is_numeric($iframeWidthh)) {
            $iframeWidthh .= "px";
        }

        return ", '" . $linkData['liga_posicao'] . "', '" . $iframeHeight . "', '" . $iframeWidthh . "'";
    }

    return '';
} // actionBarGrid_getLinkParam6

/**
 * Recupera dados do link a serem passados para a aplicacao de destino.
 */
function actionBarGrid_getLinkParams($linkData)
{
    global $nmgp_cod_aspas, $tbapl_procedure, $nmgp_md5;

    $nm_grid_vert = "";

    $nmgp_lig_edit_lapis = "S";
    if ($linkData['liga_mostra_edit'] == "N") {
        $nmgp_lig_edit_lapis = "N";
    }
    $nmgp_parms = "nmgp_lig_edit_lapis?#?" . $nmgp_lig_edit_lapis . "?@?";

    if ($linkData['liga_apl_tipo'] == "F" && $linkData['liga_apl_tipo_orig'] != "calendar") {
        $nmgp_parms .= "nmgp_opcao?#?igual?@?";
    }

    $nmgp_parms_url = "";

    $todo = explode("?@?", $linkData['liga_parms']);
    $ix = 0;
    while (!empty($todo[$ix])) {
        $cadapar = explode("?#?", $todo[$ix]);

        if (!empty($cadapar[2])) {
            $cadapar[2] = str_replace(".", "_", $cadapar[2]);
            if (testPhpVar($cadapar[2])) {
                $cadapar[2] = strtolower($cadapar[2]);
            }
        }

        $tmp_parm2 = $cadapar[2];

        if (!empty($nmgp_parms_url)) {
            $nmgp_parms_url .= " . " . $nmgp_cod_aspas . "&" . $nmgp_cod_aspas . " . ";
        }
        if (strtoupper($cadapar[0]) == "C") {
            protect_campo($cadapar[1]);
            $tmp_parm = strtolower($cadapar[1]);
            $tmp_parm = str_replace(".", "_", $tmp_parm);
            if (!isset($nmgp_md5[$tmp_parm])) {
                if (strtolower($geratudo) == "console_compile")
                {
                    $_SESSION['nm_session']['console']['result_comp'] = nm_get_text_lang("['generator']['gr_parm_inexist']") . "($tmp_parm).";
                    Retorna_geracao($_SESSION['scriptcase']['nm_sc_retorno_console']);
                } else {
                    echo nm_get_text_lang("['generator']['gr_parm_inexist']") .  "($tmp_parm).";
                    exit;
                }
            }
            $nmgp_parms .= $tmp_parm2 . "?#?" . $nmgp_cod_aspas . " . str_replace(" . $nmgp_cod_aspas . "'" . $nmgp_cod_aspas . ", " . $nmgp_cod_aspas . "@aspass@" . $nmgp_cod_aspas . ", \$this->" . $tmp_parm . $nm_grid_vert . ") . " . $nmgp_cod_aspas . "?@?";
            $nmgp_parms_url .= "urlencode(" . $nmgp_cod_aspas . $tmp_parm2 . $nmgp_cod_aspas . ") . " . $nmgp_cod_aspas . "=" . $nmgp_cod_aspas . " . urlencode(\$this->" . $tmp_parm . $nm_grid_vert . ")";
        }
        if (strtoupper($cadapar[0]) == "P") {
            $tmp_parm = $cadapar[1];
            $nmgp_parms .= "SC_glo_par_" . $tmp_parm2 . "?#?" . $tmp_parm . "?@?";
            $nmgp_parms_url .= "urlencode(" . $nmgp_cod_aspas . $tmp_parm2 . $nmgp_cod_aspas . ") . " . $nmgp_cod_aspas . "=" . $nmgp_cod_aspas . " . urlencode(\$" . $tmp_parm . ")";
        }
        if (strtoupper($cadapar[0]) == "V") {
            $tmp_aspas = str_replace("'", "@aspass@", $cadapar[1]);
            $nmgp_parms .= $tmp_parm2 . "?#?" . $tmp_aspas . "?@?";
            $nmgp_parms_url .= "urlencode(" . $nmgp_cod_aspas . $tmp_parm2 . $nmgp_cod_aspas . ") . " . $nmgp_cod_aspas . "=" . $nmgp_cod_aspas . " . urlencode(" . $nmgp_cod_aspas . $cadapar[1] . $nmgp_cod_aspas . ")";
        }
        $ix++;
    }

    if ($linkData['liga_apl_tipo'] == "F") {
        if (!empty($linkData['liga_form_insert'])) {
            $nmgp_parms .= "NM_btn_insert?#?" . $linkData['liga_form_insert'] . "?@?" ;
        }
        if (!empty($linkData['liga_form_update'])) {
            $nmgp_parms .= "NM_btn_update?#?" . $linkData['liga_form_update'] . "?@?" ;
        }
        if (!empty($linkData['liga_form_delete'])) {
            $nmgp_parms .= "NM_btn_delete?#?" . $linkData['liga_form_delete'] . "?@?" ;
        }
        if (!empty($linkData['liga_form_btn_nav'])) {
            $nmgp_parms .= "NM_btn_navega?#?" . $linkData['liga_form_btn_nav'] . "?@?" ;
            if (!$tbapl_procedure && $linkData['liga_form_btn_nav'] == 'S' && isset($linkData['liga_form_where']) && $linkData['liga_form_where'] == "S") {
                $nmgp_parms .= $nmgp_cod_aspas . " . str_replace(" . $nmgp_cod_aspas . "%" . $nmgp_cod_aspas . ", " . $nmgp_cod_aspas . "@percent@" . $nmgp_cod_aspas . ", \$this->sc_where_atual_f) . " . $nmgp_cod_aspas;
            }
        }
    } else {
        if ($linkData['liga_cons_mod_inicial'] == "C") {
            $nmgp_parms .=  "NMSC_inicial?#?inicio?@?";
        }
        if ($linkData['liga_cons_mod_inicial'] == "F") {
            $nmgp_parms .=  "NMSC_inicial?#?busca?@?";
        }
        if ($linkData['liga_cons_qtd_rows'] > 0) {
            $nmgp_parms .=  "NMSC_rows?#?" . $linkData['liga_cons_qtd_rows'] . "?@?";
        }
        if ($linkData['liga_cons_qtd_cols'] > 0) {
            $nmgp_parms .=  "NMSC_cols?#?" . $linkData['liga_cons_qtd_cols'] . "?@?";
        }
        if (!empty($linkData['liga_cons_paginacao'])) {
            $nmgp_parms .=  "NMSC_paginacao?#?" . $linkData['liga_cons_paginacao'] . "?@?";
        }
        if ($linkData['liga_cons_header'] == "N") {
            $nmgp_parms .=  "NMSC_cab?#?N?@?";
        }
        if ($linkData['liga_cons_btn_nav'] == "N") {
            $nmgp_parms .=  "NMSC_nav?#?N?@?";
        }
    }

    if ($linkData['liga_apl_tipo'] == "F" && $linkData['liga_close_form'] == "S" && ($linkData['liga_target'] == "O" || $linkData['liga_target'] == "M"|| $linkData['liga_target'] == "A")) {
        $nmgp_parms .= "sc_redir_atualiz?#?ok?@?";
    }
    if ($linkData['liga_apl_tipo'] == "F" && isset($linkData['link_close_after_insert']) && $linkData['link_close_after_insert'] == "S" && ($linkData['liga_target'] == "O" || $linkData['liga_target'] == "M" || $linkData['liga_target'] == "A")) {
        $nmgp_parms .= "sc_redir_insert?#?ok?@?";
    }

    if ($linkData['liga_target'] == "M") {
        $nmgp_parms .=  "NMSC_modal?#?ok?@?";
        $nmgp_parms = str_replace("?#?", "*scin", $nmgp_parms);
        $nmgp_parms = str_replace("?@?", "*scout", $nmgp_parms);
    } elseif ($linkData['liga_target'] == "S") {
        $nmgp_parms .= "NM_run_iframe?#?1?@?";
    }

    return $nmgp_parms;
} // actionBarGrid_getLinkParams

/**
 * Recupera o target do link.
 */
function actionBarGrid_getLinkTarget($linkData)
{
    global $nome_aplicacao;

    if ($linkData['liga_target'] == 'M') {
        if ($linkData['liga_apl_tipo_orig'] == 'reportpdf') {
            return 'modal_rpdf';
        } else {
            return 'modal';
        }
    } elseif ($linkData['liga_target'] == 'O' || $linkData['liga_target'] == 'A') {
        return '_blank';
    } elseif ($linkData['liga_target'] == 'P') {
        return '_parent';
    } elseif ($linkData['liga_target'] == 'S') {
        return 'nm_iframe_liga_' . $linkData['liga_posicao'] . '_' . $nome_aplicacao;
    }

    return '_self';
} // actionBarGrid_getLinkTarget

function actionBarGrid_generateClassParameters($fp)
{
    global $apl_tem_actionbar, $actionbar_data;

    if (!$apl_tem_actionbar) {
        return;
    }

    nm_imprime_2($fp, "   var \$sc_actionbar_states = array(\r\n");
    foreach ($actionbar_data as $actionbar_button_name => $actionbar_button_data) {
        if ('S' == $actionbar_button_data['in_use'] && in_array($actionbar_button_data['type'], array('ajax', 'link'))) {
            nm_imprime_2($fp, "       \"{$actionbar_button_name}\" => \"" . $actionbar_button_data['states'][0]['label'] . "\",\r\n");
        }
    }
    nm_imprime_2($fp, "   );\r\n");

    nm_imprime_2($fp, "   var \$sc_actionbar_disabled = array(\r\n");
    foreach ($actionbar_data as $actionbar_button_name => $actionbar_button_data) {
        if ('S' == $actionbar_button_data['in_use'] && in_array($actionbar_button_data['type'], array('ajax', 'link'))) {
            nm_imprime_2($fp, "       \"{$actionbar_button_name}\" => false,\r\n");
        }
    }
    nm_imprime_2($fp, "   );\r\n");

    nm_imprime_2($fp, "   var \$sc_actionbar_hidden = array(\r\n");
    foreach ($actionbar_data as $actionbar_button_name => $actionbar_button_data) {
        if ('S' == $actionbar_button_data['in_use'] && in_array($actionbar_button_data['type'], array('ajax', 'link'))) {
            nm_imprime_2($fp, "       \"{$actionbar_button_name}\" => false,\r\n");
        }
    }
    nm_imprime_2($fp, "   );\r\n");
} // actionBarGrid_generateClassParameters

function actionBarGrid_generateStateIsValidFunction($fp)
{
    global $apl_tem_actionbar, $actionbar_data;

    if (!$apl_tem_actionbar) {
        $phpCode = <<<EOT

function actionBar_isValidState(\$buttonName, \$buttonState)
{
    return false;
}


EOT;
    } else {
        $phpCode = <<<EOT

function actionBar_isValidState(\$buttonName, \$buttonState)
{
    switch (\$buttonName) {

EOT;
    foreach ($actionbar_data as $actionbar_button_name => $actionbar_button_data) {
        if ('S' == $actionbar_button_data['in_use'] && in_array($actionbar_button_data['type'], array('ajax', 'link'))) {
            $stateList = array();
            foreach ($actionbar_button_data['states'] as $stateData) {
                $stateList[] = $stateData['label'];
            }
            $stateListInArray = '"' . implode('", "', $stateList) . '"';
            $phpCode .= <<<EOT
        case '{$actionbar_button_name}':
            return in_array(\$buttonState, array({$stateListInArray}));

EOT;
        }
    }
    $phpCode .= <<<EOT
    }

    return false;
}


EOT;
    }

    nm_imprime_2($fp, $phpCode);
} // actionBarGrid_generateStateIsValidFunction

function actionBarGrid_generateStateDisplayPhpFunctions($fp)
{
    global $apl_tem_actionbar, $actionbar_data, $nmgp_cod_aspas;

    if (!$apl_tem_actionbar) {
        return;
    }

    $phpCode = <<<EOT

function actionBar_displayState(\$buttonName)
{
    switch (\$buttonName) {

EOT;
    foreach ($actionbar_data as $actionbar_button_name => $actionbar_button_data) {
        if ('S' == $actionbar_button_data['in_use'] && in_array($actionbar_button_data['type'], array('ajax', 'link'))) {
            $phpCode .= <<<EOT
        case '{$actionbar_button_name}':
            return \$this->actionBar_displayState_{$actionbar_button_name}();

EOT;
        }
    }
    $phpCode .= <<<EOT
    }
}


EOT;

    foreach ($actionbar_data as $actionbar_button_name => $actionbar_button_data) {
        if ('S' == $actionbar_button_data['in_use'] && in_array($actionbar_button_data['type'], array('ajax', 'link'))) {
            $phpCode .= <<<EOT
function actionBar_displayState_{$actionbar_button_name}()
{
    switch (\$this->sc_actionbar_states['{$actionbar_button_name}']) {

EOT;
            foreach ($actionbar_button_data['states'] as $stateData) {
                $htmlCode = str_replace(array($nmgp_cod_aspas, "\"", "<?php echo", "?>"), array("__SC_TEMP_QUOTES__", "\\\"", "\" .", ". \""), actionBarGrid_generateVisual_quotesProtected($actionbar_button_data['display'], $stateData, $actionbar_button_name));
                $htmlCode = str_replace("__SC_TEMP_QUOTES__", "\"", $htmlCode);
                $phpCode .= <<<EOT
        case '{$stateData['label']}':
            return "$htmlCode";

EOT;
            }
            $phpCode .= <<<EOT
    }
}


EOT;
        }
    }

    $phpCode .= <<<EOT
function actionBar_getStateHint(\$buttonName)
{
    switch (\$buttonName) {

EOT;
    foreach ($actionbar_data as $actionbar_button_name => $actionbar_button_data) {
        if ('S' == $actionbar_button_data['in_use'] && in_array($actionbar_button_data['type'], array('ajax', 'link'))) {
            $phpCode .= <<<EOT
        case '{$actionbar_button_name}':
            return \$this->actionBar_getStateHint_{$actionbar_button_name}();

EOT;
        }
    }
    $phpCode .= <<<EOT
    }
}


EOT;

    foreach ($actionbar_data as $actionbar_button_name => $actionbar_button_data) {
        if ('S' == $actionbar_button_data['in_use'] && in_array($actionbar_button_data['type'], array('ajax', 'link'))) {
            $phpCode .= <<<EOT
function actionBar_getStateHint_{$actionbar_button_name}()
{
    switch (\$this->sc_actionbar_states['{$actionbar_button_name}']) {

EOT;
            foreach ($actionbar_button_data['states'] as $stateData) {
                $stateHint = actionBarGrid_getLangString_quotes($stateData['hint']);
                $phpCode .= <<<EOT
        case '{$stateData['label']}':
            return "{$stateHint}";

EOT;
            }
            $phpCode .= <<<EOT
    }
}


EOT;
        }
    }

    $phpCode .= <<<EOT
function actionBar_getStateDisable(\$buttonName)
{
    if (isset(\$this->sc_actionbar_disabled[\$buttonName]) && \$this->sc_actionbar_disabled[\$buttonName]) {
        return ' disabled';
    }

    return '';
}

function actionBar_getStateHide(\$buttonName)
{
    if (isset(\$this->sc_actionbar_hidden[\$buttonName]) && \$this->sc_actionbar_hidden[\$buttonName]) {
        return ' sc-actionbar-button-hidden';
    }

    return '';
}


EOT;

    nm_imprime_2($fp, $phpCode);
} // actionBarGrid_generateStateDisplayPhpFunctions

function actionBarGrid_generateStateDisplayJsFunctions($fp)
{
    global $actionbar_data, $nmgp_cod_aspas;

    $jsCode = <<<EOT
<script>
function actionBar_displayState(buttonName, buttonState, buttonRow)
{
    let stateHtml, buttonId, stateHint;
    stateHint = actionBar_getStateHint(buttonName, buttonState);
    switch (buttonName) {

EOT;
    foreach ($actionbar_data as $actionbar_button_name => $actionbar_button_data) {
        if ('S' == $actionbar_button_data['in_use'] && in_array($actionbar_button_data['type'], array('ajax', 'link'))) {
            $jsCode .= <<<EOT
        case '{$actionbar_button_name}':
            stateHtml = actionBar_displayState_{$actionbar_button_name}(buttonState);
            buttonId = "sc-actionbar-actbtn_{$actionbar_button_name}" + buttonRow;
            break;

EOT;
        }
    }
    $jsCode .= <<<EOT
    }
    $("#" + buttonId).html(stateHtml).data("actionbarState", buttonState);
    document.querySelector("#" + buttonId)._tippy.setContent(stateHint);
}


EOT;

    foreach ($actionbar_data as $actionbar_button_name => $actionbar_button_data) {
        if ('S' == $actionbar_button_data['in_use'] && in_array($actionbar_button_data['type'], array('ajax', 'link'))) {
            $jsCode .= <<<EOT
function actionBar_displayState_{$actionbar_button_name}(buttonState)
{
    switch (buttonState) {

EOT;
            foreach ($actionbar_button_data['states'] as $stateData) {
                $htmlCode = str_replace("\"", "\\\"", actionBarGrid_generateVisual_quotesProtected($actionbar_button_data['display'], $stateData, $actionbar_button_name));
                $jsCode .= <<<EOT
        case '{$stateData['label']}':
            return "$htmlCode";

EOT;
            }
            $jsCode .= <<<EOT
    }
}


EOT;
        }
    }

    $jsCode .= <<<EOT
function actionBar_getStateHint(buttonName, buttonState)
{
    switch (buttonName) {

EOT;
    foreach ($actionbar_data as $actionbar_button_name => $actionbar_button_data) {
        if ('S' == $actionbar_button_data['in_use'] && in_array($actionbar_button_data['type'], array('ajax', 'link'))) {
            $jsCode .= <<<EOT
        case '{$actionbar_button_name}':
            return actionBar_getStateHint_{$actionbar_button_name}(buttonState);

EOT;
        }
    }
    $jsCode .= <<<EOT
    }
}


EOT;

    foreach ($actionbar_data as $actionbar_button_name => $actionbar_button_data) {
        if ('S' == $actionbar_button_data['in_use'] && in_array($actionbar_button_data['type'], array('ajax', 'link'))) {
            $jsCode .= <<<EOT
function actionBar_getStateHint_{$actionbar_button_name}(buttonState)
{
    switch (buttonState) {

EOT;
            foreach ($actionbar_button_data['states'] as $stateData) {
                $stateHint = actionBarGrid_getLangString_quotesProtected($stateData['hint']);
                $jsCode .= <<<EOT
        case '{$stateData['label']}':
            return "$stateHint";

EOT;
            }
            $jsCode .= <<<EOT
    }
}


EOT;
        }
    }

    $jsCode .= <<<EOT
function actionBar_disable(buttonName, disableButton, buttonRow)
{
    if (disableButton) {
        $("#sc-actionbar-actbtn_" + buttonName + buttonRow).addClass("disabled").on("mouseover", function() { $(this).css("cursor", "not-allowed"); });
    } else {
        $("#sc-actionbar-actbtn_" + buttonName + buttonRow).removeClass("disabled").on("mouseover", function() { $(this).css("cursor", "pointer"); });
    }
}

function actionBar_hide(buttonName, hideButton, buttonRow)
{
    if (hideButton) {
        $("#sc-actionbar-actbtn_" + buttonName + buttonRow).hide();
    } else {
        $("#sc-actionbar-actbtn_" + buttonName + buttonRow).show();
    }
}

function actionBar_linkSubmit5(link_selector, apl_lig, apl_saida, parms, target, opc, modal_h, modal_w, m_confirm, apl_name, ancor)
{
    if ($("#" + link_selector).hasClass("disabled")) {
        return;
    }

    nm_gp_submit5(apl_lig, apl_saida, parms, target, opc, modal_h, modal_w, m_confirm, apl_name, ancor);
}

function actionBar_linkSubmit6(link_obj, apl_lig, apl_saida, parms, target, pos, alt, larg, opc, modal_h, modal_w, m_confirm, apl_name, ancor)
{
    if ($("#" + link_selector).hasClass("disabled")) {
        return;
    }

    nm_gp_submit6(apl_lig, apl_saida, parms, target, pos, alt, larg, opc, modal_h, modal_w, m_confirm, apl_name, ancor);
}

</script>

EOT;

    nm_imprime($fp, $jsCode, 11);
} // actionBarGrid_generateStateDisplayJsFunctions

function actionBarGrid_generateStateCssStyles($fp)
{
    global $tbapl_attr3_parms;

    $faCssList = array();
    $faICssList = array();
    $faIHoverList = array();
    $faIActiveList = array();
    $imgCssList = array();
    $txtCssList = array();
    $linkColor = '';
    $linkHover = '';
    $linkActive = '';

    if (isset($tbapl_attr3_parms['actionbar_grid_visual']['padding']) && '' != $tbapl_attr3_parms['actionbar_grid_visual']['padding']) {
        $faCssList[] = 'padding: ' . $tbapl_attr3_parms['actionbar_grid_visual']['padding'] . ' !important;';
        $imgCssList[] = 'padding: ' . $tbapl_attr3_parms['actionbar_grid_visual']['padding'] . ' !important;';
        $txtCssList[] = 'padding: ' . $tbapl_attr3_parms['actionbar_grid_visual']['padding'] . ' !important;';
    }
    if (isset($tbapl_attr3_parms['actionbar_grid_visual']['fa_size']) && '' != $tbapl_attr3_parms['actionbar_grid_visual']['fa_size']) {
        $faCssList[] = 'font-size: ' . $tbapl_attr3_parms['actionbar_grid_visual']['fa_size'] . 'px !important;';
    }
    if (isset($tbapl_attr3_parms['actionbar_grid_visual']['fa_color']) && '' != $tbapl_attr3_parms['actionbar_grid_visual']['fa_color']) {
        $faCssList[] = 'color: ' . $tbapl_attr3_parms['actionbar_grid_visual']['fa_color'] . ' !important;';
        $faICssList[] = 'color: ' . $tbapl_attr3_parms['actionbar_grid_visual']['fa_color'] . ' !important;';
    }
    if (isset($tbapl_attr3_parms['actionbar_grid_visual']['fa_hover']) && '' != $tbapl_attr3_parms['actionbar_grid_visual']['fa_hover']) {
        $faIHoverList[] = 'color: ' . $tbapl_attr3_parms['actionbar_grid_visual']['fa_hover'] . ' !important;';
    }
    if (isset($tbapl_attr3_parms['actionbar_grid_visual']['fa_active']) && '' != $tbapl_attr3_parms['actionbar_grid_visual']['fa_active']) {
        $faIActiveList[] = 'color: ' . $tbapl_attr3_parms['actionbar_grid_visual']['fa_active'] . ' !important;';
    }
    if (isset($tbapl_attr3_parms['actionbar_grid_visual']['link_color']) && '' != $tbapl_attr3_parms['actionbar_grid_visual']['link_color']) {
        $txtCssList[] = 'color: ' . $tbapl_attr3_parms['actionbar_grid_visual']['link_color'] . ' !important;';
    }
    if (isset($tbapl_attr3_parms['actionbar_grid_visual']['link_hover']) && '' != $tbapl_attr3_parms['actionbar_grid_visual']['link_hover']) {
        $linkHover = 'color: ' . $tbapl_attr3_parms['actionbar_grid_visual']['link_hover'] . ' !important;';
    }
    if (isset($tbapl_attr3_parms['actionbar_grid_visual']['link_active']) && '' != $tbapl_attr3_parms['actionbar_grid_visual']['link_active']) {
        $linkActive = 'color: ' . $tbapl_attr3_parms['actionbar_grid_visual']['link_active'] . ' !important;';
    }

    $faCss = implode('', $faCssList);
    $faICss = implode('', $faICssList);
    $faIHover = implode('', $faIHoverList);
    $faIActive = implode('', $faIActiveList);
    $imgCss = implode('', $imgCssList);
    $txtCss = implode('', $txtCssList);

    $buttonSpecificRules = [];
    $buttonSpecificCss = [];
    foreach ($tbapl_attr3_parms['actionbar_grid'] as $buttonName => $buttonData) {
        if (!empty($buttonData['states'])) {
            $buttonSpecificRules[$buttonName] = [];

            foreach ($buttonData['states'] as $stateData) {
                $buttonSpecificRules[$buttonName][$stateData['label']] = [];

                if ('' != $stateData['fa_color']) {
                    $buttonSpecificRules[$buttonName][$stateData['label']]['basic'] = 'color: ' . $stateData['fa_color'] . ' !important;';
                }
                if (isset($stateData['fa_hover']) && '' != $stateData['fa_hover']) {
                    $buttonSpecificRules[$buttonName][$stateData['label']][':hover'] = 'color: ' . $stateData['fa_hover'] . ' !important;';
                }
                if (isset($stateData['fa_active']) && '' != $stateData['fa_active']) {
                    $buttonSpecificRules[$buttonName][$stateData['label']][':active'] = 'color: ' . $stateData['fa_active'] . ' !important;';
                }

                if (empty($buttonSpecificRules[$buttonName][$stateData['label']])) {
                    unset($buttonSpecificRules[$buttonName][$stateData['label']]);
                }
            }

            if (empty($buttonSpecificRules[$buttonName])) {
                unset($buttonSpecificRules[$buttonName]);
            }
        }
    }
    if (!empty($buttonSpecificRules)) {
        foreach ($buttonSpecificRules as $buttonName => $stateList) {
            $baseRule = '.sc-actb-' . $buttonName;
            foreach ($stateList as $stateName => $stateRules) {
                $stateRule = $baseRule . '.sc-acts-' . $stateName;
                foreach ($stateRules as $ruleName => $ruleInfo) {
                    $thisRule = $stateRule;
                    if ('basic' != $ruleName) {
                        $thisRule .= $ruleName;
                    }
                    $buttonSpecificCss[] = "{$thisRule} { {$ruleInfo} }";
                }
            }
        }
    }

    $cssCode = <<<EOT
<style>
.sc-actionbar-fa { $faCss }
.sc-actionbar-fa i { $faICss }
.sc-actionbar-fa i:hover { $faIHover }
.sc-actionbar-fa i:active { $faIActive }
.sc-actionbar-img { $imgCss }
.sc-actionbar-txt { $txtCss }
.sc-actionbar-fa.disabled {
    cursor: not-allowed !important;
    opacity: 0.44 !important;
}
.sc-actionbar-img.disabled {
    cursor: not-allowed !important;
    opacity: 0.44 !important;
}
.sc-actionbar-txt.disabled {
    cursor: not-allowed !important;
    opacity: 0.44 !important;
}
.sc-actionbar-button-hidden {
    display: none;
}
.sc-actionbar-txt:hover { $linkHover }
.sc-actionbar-txt:active { $linkActive }

EOT;

    foreach ($buttonSpecificCss as $cssRule) {
        $cssCode .= <<<EOT
$cssRule

EOT;
    }

    $cssCode .= <<<EOT
</style>

EOT;

    nm_imprime($fp, $cssCode, 11);
} // actionBarGrid_generateStateCssStyles

?>
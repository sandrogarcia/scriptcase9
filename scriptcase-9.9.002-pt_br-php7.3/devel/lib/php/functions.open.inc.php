<?php
function nm_app_icon($v_int_type)
{
	switch ($v_int_type) {
		case NM_APP_TYPE_TABBED:
			return 'tab';
			break;
		case NM_APP_TYPE_MENU:
		case NM_APP_TYPE_MENU2:
			return 'menu';
			break;
		case NM_APP_TYPE_MENUTREE:
			return 'menutree';
			break;
		case NM_APP_TYPE_FORM:
			return 'form';
			break;
		case NM_APP_TYPE_CONTROL:
		case NM_APP_TYPE_CONTROLUSR:
			return 'control';
			break;
		case NM_APP_TYPE_FILTER:
			return 'filter';
			break;
		case NM_APP_TYPE_CALENDAR:
			return 'calendar';
			break;
		case NM_APP_TYPE_REPORTPDF:
		case NM_APP_TYPE_RPDFPROC:
			return 'reportpdf';
			break;
		case NM_APP_TYPE_CONTAINER:
			return 'container';
			break;
		case NM_APP_TYPE_BLANK:
			return 'blank';
			break;
		case NM_APP_TYPE_CHART:
			return 'chart';
			break;
		case NM_APP_TYPE_GRID:
		default:
			return 'grid';
			break;
	}
} // nm_app_icon

function nm_array_knatcasesort(&$r_arr_data)
{
    if(!isset($r_arr_data) || !is_array($r_arr_data))
    {
        $r_arr_data = [];
    }

	$arr_keys = array_keys($r_arr_data);
	natcasesort($arr_keys);
	$arr_new = array();
	foreach ($arr_keys as $mix_key) {
		$arr_new[$mix_key] = $r_arr_data[$mix_key];
	}
	$r_arr_data = $arr_new;
} // nm_array_knatcasesort

function nm_array_sort($v_arr_data, $v_str_col, $v_int_sort = NM_SORT_ASC)
{
	/* Cria array da coluna */
	$arr_col = array();
	foreach ($v_arr_data as $mix_key => $mix_val) {
		$arr_col[$mix_key] = strtolower($mix_val[$v_str_col]);
	}
	/* Ordena array da coluna */
	switch ($v_int_sort) {
		case NM_SORT_DESC:
			arsort($arr_col);
			break;
		case NM_SORT_ASC:
		default:
			asort($arr_col);
			break;
	}
	/* Cria array ordenado */
	$arr_sort = array();
	foreach ($arr_col as $mix_key => $mix_val) {
		$arr_sort[$mix_key] = $v_arr_data[$mix_key];
	}
	return $arr_sort;
} // nm_array_sort

function nm_array_dif($v_arr_data1, $v_arr_data2)
{
	$bol_retorno = false;

	if (count($v_arr_data1) == count($v_arr_data2)) {
		$arr_keys1 = array_keys($v_arr_data1);
		$arr_keys2 = array_keys($v_arr_data2);

		$contador = count($arr_keys1);
		for ($cont = 0; $cont < $contador; $cont++) {
			if ($arr_keys1[$cont] != $arr_keys2[$cont]) {
				$bol_retorno = true;
				break;
			}
			if ($v_arr_data1[$arr_keys1[$cont]] != $v_arr_data2[$arr_keys2[$cont]]) {
				$bol_retorno = true;
				break;
			}
		}
	} else {
		$bol_retorno = true;
	}

	return $bol_retorno;
} // nm_array_sort

function nm_datetime_format($v_str_date, $v_str_time, $str_date_mask = "", $bol_full_year = false)
{
	$str_result = '';
	if (!empty($v_str_date)) {
		$str_result .= nm_date_format($v_str_date, $str_date_mask, $bol_full_year);
	}
	if (!empty($v_str_time)) {
		if ('' != $str_result) {
			$str_result .= ' ';
		}
		$str_result .= nm_time_format($v_str_time);
	}
	return $str_result;
} // nm_datetime_format

function nm_debug_item($v_mix_var, $v_int_level)
{
	$str_repeat = '   ';
	if (is_array($v_mix_var)) {
		foreach ($v_mix_var as $v_mix_key => $v_mix_val) {
			echo str_repeat($str_repeat, $v_int_level) . '&raquo; ' . htmlentities($v_mix_key) . ":\n";
			nm_debug_item($v_mix_val, $v_int_level + 1);
		}
	} else {
		echo str_repeat($str_repeat, $v_int_level) . '&raquo; ' . htmlentities($v_mix_var) . "\n";
	}
} // nm_debug_item

function nm_dir_copy($str_source_dir, $str_dest_dir, $verbose = false, $arr_filter = array(), &$qtdCopied = 0, $debugFile="", $debugmsg="", $debugseparator="", $debugQtd = 0)
{
	//qtd de itens
	$int_qtd = 0;
	$int_qtd_50 = 0;

	//se nao existe ele tenta criar
	nm_dir_create($str_dest_dir);

	if ($curdir = opendir($str_source_dir)) {
		while ($file = readdir($curdir)) {
			$srcfile = $str_source_dir . '/' . $file;

			if ($file != '.' && $file != '..' && (empty($arr_filter) || !in_array($srcfile, $arr_filter))) {
				$dstfile = $str_dest_dir . '/' . $file;
				if (is_file($srcfile)) {
					if (is_file($dstfile)) {
						unlink($dstfile);
					}

					if ($verbose) {
						echo "Copying '$srcfile' to '$dstfile'...";
					}

					if (copy($srcfile, $dstfile)) {
						touch($dstfile, filemtime($srcfile));
						$int_qtd++;
                        $qtdCopied++;
                        $int_qtd_50++;
						if ($verbose) {
							echo "OK\n";
						}

                        if($int_qtd_50 > 30 && !empty($debugFile))
                        {
                            $perc = floor((100*$qtdCopied)/$debugQtd);
                            if($perc>100)
                            {
                                $perc = "99";
                            }
                            file_put_contents($debugFile, $debugmsg . $debugseparator . $perc."%");

                            $int_qtd_50 = 0;
                        }
					} else {
						echo "Error: File '$srcfile' could not be copied!\n";
					}
				} else if (is_dir($srcfile)) {
                    $qtd = nm_dir_copy($srcfile, $dstfile, $verbose, $arr_filter, $qtdCopied, $debugFile, $debugmsg, $debugseparator, $debugQtd);
                    $int_qtd    += $qtd;
                    $int_qtd_50 += $qtd;

                    if($int_qtd_50 > 30 && !empty($debugFile))
                    {
                        $perc = floor((100*$qtdCopied)/$debugQtd);
                        if($perc>100)
                        {
                            $perc = "99";
                        }
                        file_put_contents($debugFile, $debugmsg . $debugseparator . $perc."%");

                        $int_qtd_50 = 0;
                    }
				}
			}
		}
		closedir($curdir);
		@clearstatcache();
	}

    if(!empty($debugFile))
    {
        $perc = floor((100*$qtdCopied)/$debugQtd);
        if($perc>100)
        {
            $perc = "99";
        }
        file_put_contents($debugFile, $debugmsg . $debugseparator . $perc."%");
    }

	return $int_qtd;
}

function nm_dir_create($v_str_dir)
{
    @clearstatcache();

	if (!is_dir($v_str_dir) && !is_file($v_str_dir)) {
		@mkdir($v_str_dir, 0755, true);
		@clearstatcache();
	}

	return is_dir($v_str_dir);
} // nm_dir_create

function nm_dir_delete($dir, $deleteOnlyArchive = '')
{
	if (is_dir($dir)) {
		$current_dir = opendir($dir);
		while (false !== ($entryname = @readdir($current_dir))) {
			if ($entryname != '.' && $entryname != '..') {
				if (is_dir($dir . '/' . $entryname)) {
					nm_dir_delete($dir . '/' . $entryname, $deleteOnlyArchive);
				} else {
					if (is_file($dir . '/' . $entryname)) {
						unlink($dir . '/' . $entryname);
					}
				}
			}
		}
		closedir($current_dir);
		if (!$deleteOnlyArchive) {
			@rmdir($dir);
		}
	}
    @clearstatcache();
} // nm_dir_delete

function all($file)
{
	return true;
}

function nm_dir_read($dir, $str_tipo = 'all', $bol_valor = true)
{
	$arr_retorno = array();
	if (is_dir($dir))
	{
		if($str_tipo == 'dir' || $str_tipo == 'file')
		{
			$str_tipo =  "is_" . $str_tipo;
		}
		else
		{
			$str_tipo =  "all";
		}

		$handle = opendir($dir);
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != ".." && $file != ".svn" && $str_tipo($dir . '/' . $file)) {
				if ($bol_valor) {
					$arr_retorno[] = $file;
				} else {
					$arr_retorno[$file] = "";
				}
			}
		}
		closedir($handle);
	}

	return $arr_retorno;
} // nm_dir_read

function nm_dir_normalize($v_str_dir)
{
	$str_dir = str_replace("\\", '/', $v_str_dir);
	if ('/' != substr($str_dir, -1)) {
		$str_dir .= '/';
	}
	return $str_dir;
} // nm_dir_normalize

function nm_dir_prepare($v_str_dir, $v_str_os)
{
	if ('win' == $v_str_os) {
		return str_replace('/', "\\", $v_str_dir);
	} else {
		return str_replace("\\", '/', $v_str_dir);
	}
} // nm_dir_prepare

function nm_dir_test($v_str_dir)
{
	if (!nm_dir_create($v_str_dir)) {
		return FALSE;
	}
	$str_file = nm_dir_normalize($v_str_dir) . 'foo.tmp';
	file_put_contents($str_file, "bar");
	if (!@is_file($str_file)) {
		return FALSE;
	}
	$arr_data = @file($str_file);
	if (!$arr_data) {
		return FALSE;
	}
	@unlink($str_file);
	return 'bar' == trim(implode('', $arr_data));
} // nm_dir_test

function nm_field_list_name($v_arr_fields, $v_arr_names)
{
	$arr_list = array();
	foreach ($v_arr_fields as $int_seq) {
		if (isset($v_arr_names[$int_seq])) {
			$arr_list[$int_seq] = $v_arr_names[$int_seq];
		}
	}
	return $arr_list;
} // nm_field_list_name

function nm_field_name($v_str_name, &$r_arr_names)
{
	$int_count = 0;
	$str_test = $v_str_name;
	while (in_array($str_test, $r_arr_names)) {
		$int_count++;
		$str_test = $v_str_name . '_' . $int_count;
	}
	$r_arr_names[] = $str_test;
	return $str_test;
} // nm_field_name

function nm_folder_recursive($v_arr_php, $v_str_parent, $v_str_prefix,
							 $v_int_level, $v_int_size, $v_int_index,
							 &$r_arr_folders)
{
	$arr_sub = array_keys($v_arr_php);
	natcasesort($arr_sub);
	foreach ($arr_sub as $int_pos => $str_folder) {
		if (0 == $v_int_level) {
			$str_sufix = '';
		} elseif (1 == $v_int_level) {
			$str_sufix = '+- ';
		} else {
			$str_sufix = '+- ';
		}
		$str_child = ('' == $v_str_parent) ? $str_folder : '/' . $str_folder;
		$str_actual = $v_str_parent . $str_child;
		$r_arr_folders[$str_actual] = $v_str_prefix . $str_sufix . $str_folder;
		if (0 == $v_int_level) {
			$str_new = ($v_int_index < ($v_int_size - 1)) ? '| &nbsp;' : '';
		} else {
			$str_new = ($v_int_index < ($v_int_size - 1))
				? '| &nbsp;' : '&nbsp; &nbsp;';
		}
		nm_folder_recursive($v_arr_php[$str_folder], $str_actual,
			$v_str_prefix . $str_new, $v_int_level + 1,
			sizeof(array_keys($v_arr_php[$str_folder])), 0,
			$r_arr_folders);
		$v_int_index++;
	}
} // nm_folder_recursive

function nm_folder_to_array($v_arr_php)
{
	$arr_folders = array();
	if (is_array($v_arr_php) && !empty($v_arr_php)) {
		nm_folder_recursive($v_arr_php, '', '', 0,
			sizeof(array_keys($v_arr_php)), 0, $arr_folders);
	} else {
		$arr_folders = array('root');
	}
	return $arr_folders;
} // nm_folder_to_array

function nm_id_random($v_str_pre)
{
	return 'id_' . $v_str_pre . '_' . substr(md5(mt_rand()), 8, 16);
} // nm_id_random

function nm_image_info($v_str_img)
{
	$arr_info = array();
	if ('' == $v_str_img) {
		return $arr_info;
	} elseif (FALSE === strpos($v_str_img, '__NM__')) {
		$arr_info['mod'] = 'sys';
		$str_img = $v_str_img;
	} else {
		$arr_tmp_list_change = explode('__NM__', $v_str_img);
		$arr_info['mod'] = $arr_tmp_list_change[0];
		if (count($arr_tmp_list_change) == 3) {
			$arr_info['group'] = $arr_tmp_list_change[1];
			$str_img = $arr_tmp_list_change[2];
		} else {
			$str_img = $arr_tmp_list_change[1];
		}
	}

	$arr_info['name'] = $str_img;
	return $arr_info;
} // nm_image_info

function nm_mktime($v_str_date, $v_str_hour)
{
	return mktime(substr($v_str_hour, 0, 2),
		substr($v_str_hour, 2, 2),
		substr($v_str_hour, 4, 2),
		substr($v_str_date, 4, 2),
		substr($v_str_date, 6, 2),
		substr($v_str_date, 0, 4));
} // nm_mktime

function nm_path_protect($v_str_path)
{
	if (FALSE === strpos($v_str_path, ' ')) {
		return $v_str_path;
	} else {
		return '"' . $v_str_path . '"';
	}
} // nm_path_protect

function nm_prune_newline($v_str_string)
{
	$v_str_string = str_replace("\r\n", "\n", $v_str_string);
	$arr_lines = explode("\n", $v_str_string);
	$arr_result = array();
	foreach ($arr_lines as $str_line) {
		$str_line = trim($str_line);
		if ('' != $str_line) {
			$arr_result[] = $str_line;
		}
	}
	return implode(' ', $arr_result);
} // nm_prune_newline

function nm_roll_dice($v_int_roll)
{
	return 0 == mt_rand(0, $v_int_roll - 1);
} // nm_roll_dice

function nm_conv_fonts($font_size)
{
	$nm_conv_fontes = array("1" => "10px",
		"2" => "12px",
		"3" => "14px",
		"4" => "18px",
		"5" => "24px",
		"6" => "32px",
		"7" => "48px",
		"+1" => "18px",
		"+2" => "24px",
		"+3" => "30px",
		"+4" => "48px",
		"+5" => "48px",
		"+6" => "48px",
		"+7" => "48px",
		"-1" => "12px",
		"-2" => "11px",
		"-3" => "10px",
		"-4" => "9px",
		"-5" => "8px",
		"-6" => "7px",
		"-7" => "6px");
	$str_font = "";
	if (isset($nm_conv_fontes[$font_size])) {
		$str_font = $nm_conv_fontes[$font_size];
	} else {
		$str_font = "12px";
	}
	return $str_font;
}

function nm_sql_is_date($v_str_type)
{
	return in_array(strtoupper($v_str_type),
		array('DATE', 'TIME', 'DATETIME', 'TIMESTAMP'));
} // nm_sql_is_date

function nm_string_form($v_str_string)
{
    if(!isset($v_str_string) || ($v_str_string!= "0" && empty($v_str_string)))
    {
        $v_str_string = "";
    }
	$str_string = str_replace('"', '&quot;', $v_str_string);
	$str_string = str_replace('<', '&lt;', $str_string);
	$str_string = str_replace('>', '&gt;', $str_string);
	return $str_string;
} // nm_string_form

function nm_time_format($v_str_time)
{
	$str_result = '';
	if ('' != trim($v_str_time)) {
		$str_result .= substr($v_str_time, 0, 2) . ':'
			. substr($v_str_time, 2, 2);
	}
	return $str_result;
} // nm_time_format

function nm_type_categories($v_arr_info)
{
	$arr_list = array();
	if(!empty($v_arr_info))
	{
		foreach ($v_arr_info as $str_type => $arr_data) {
			$str_categ = nm_type_category($str_type);
			if (!isset($arr_list[$str_categ])) {
				$arr_list[$str_categ] = array($str_type);
			} else {
				$arr_list[$str_categ][] = $str_type;
			}
		}
	}
	return $arr_list;
} // nm_type_categories

function nm_type_category($v_str_type)
{
	switch ($v_str_type) {
		/* Codigo de barra */
		case 'BAR_CODE':
		case 'BARCOD_2DE5':
		case 'BARCOD_39':
		case 'BARCOD_128':
		case 'BARCOD_EAN8':
		case 'BARCOD_EAN13':
		case 'BARCOD_UPC':
		case 'QRCODE':
			return 'barcode';
			break;
		/* Data */
		case 'DATA':
		case 'DATAHORA':
		case 'HORA':
			return 'date';
			break;
		/* Arquivos */
		case 'ARQUIVO':
		case 'DOCUMENTO':
		case 'DOCUMENTO_DB':
		case 'IMAGEM':
			return 'file';
			break;
		/* Normais */
		case 'MULTITEXTO':
		case 'TEXTO':
			return 'text';
			break;

		case 'NUMEROEDT':
		case 'DECIMAL':
		case 'VALOR':
		case 'PERCENT':
			return 'number';
			break;
		case 'PERCENT_CALC':
			return 'calculated';
			break;
		/* Selecoes */
		case 'CHECKBOX':
		case 'RADIO':
		case 'SELECT':
		case 'DUPLO_SELECT':
		case 'FIELDS_GRID':
		case 'FIELDS_ORDER':
		case 'PERFIL':
		case 'JUMP_MENU':
			return 'selection';
			break;
		/* AJAX */
		case 'TEXTO_AUTOCOMP':
		case 'NUMERO_AUTOCOMP':
			return 'ajax';
			break;
		/* Extra */
		case 'SUBSELECT':
			return 'extra';
			break;
		/* Especiais */
		default:
			return 'special';
			break;
	}
} // nm_type_category

function nm_type_split($v_str_type)
{
	switch ($v_str_type) {
		/* Formula Lookup */
		case 'FILTRO_DATA':
		case 'FILTRO_NUMEROEDT':
		case 'FILTRO_TEXTO':
		case 'FILTRO_VALOR':
			return array('FILTRO', substr($v_str_type, 7));
			break;
		/* Formula Lookup */
		case 'LOOKUP_ARQUIVO':
		case 'LOOKUP_DATA':
		case 'LOOKUP_IMAGEM':
		case 'LOOKUP_NUMEROEDT':
		case 'LOOKUP_TEXTO':
		case 'LOOKUP_VALOR':
			return array('LOOKUP', substr($v_str_type, 7));
			break;
		/* Formula PHP */
		case 'PHP_BARCOD_2DE5':
		case 'PHP_BARCOD_39':
		case 'PHP_BARCOD_128':
		case 'PHP_BARCOD_EAN13':
		case 'PHP_BARCOD_EAN8':
		case 'PHP_BARCOD_UPC':
		case 'PHP_DATA':
		case 'PHP_NUMEROEDT':
		case 'PHP_TEXTO':
		case 'PHP_VALOR':
			return array('PHP', substr($v_str_type, 4));
			break;
		/* Formula SQL */
		case 'SQL_DATA':
		case 'SQL_NUMEROEDT':
		case 'SQL_TEXTO':
		case 'SQL_VALOR':
			return array('SQL', substr($v_str_type, 4));
			break;
		/* Formula Update */
		case 'UPDATE_ARQUIVO':
		case 'UPDATE_DATA':
		case 'UPDATE_IMAGEM':
		case 'UPDATE_NUMEROEDT':
		case 'UPDATE_TEXTO':
		case 'UPDATE_VALOR':
			return array('UPDATE', substr($v_str_type, 7));
			break;
		/* Outros */
		default:
			return array($v_str_type, '');
			break;
	}
} // nm_type_split

function nm_unescape_array($v_arr_array)
{
	$arr_unescaped = array();
	foreach ($v_arr_array as $mix_key => $mix_value) {
		if (is_array($mix_value)) {
			$arr_unescaped[nm_unescape_string($mix_key)]
				= nm_unescape_array($mix_value);
		} else {
			$arr_unescaped[nm_unescape_string($mix_key)]
				= nm_unescape_string($mix_value);
		}
	}
	return $arr_unescaped;
} // nm_unescape_array

function nm_unescape_string($v_str_string)
{
	if (ini_get("magic_quotes_gpc") != false) {
		return stripslashes($v_str_string);
	} else {
		return $v_str_string;
	}
} // nm_unscape_string


function nm_var_header($v_str_file, $v_bol_show = FALSE)
{
	return nm_var_list(file_get_contents($v_str_file), $v_bol_show, TRUE);
} // nm_var_header

function nm_var_list($v_str_data, $v_bol_show = FALSE, $v_bol_case = FALSE)
{
	$arr_filt = array('NM_TAB_LAR_BOR', 'NM_TAB_COR_FUN', 'NM_TAB_COR_BOR', 'NM_TAB_CEL_SPA', 'NM_TAB_CEL_PAD', 'NM_TABELA_ALIGN',
		'NM_CAB_COR_FUN', 'NM_CAB_COR_TXT', 'NM_CAB_TXT_TIP', 'NM_CAB_TXT_TAM', 'NM_CAB_IMG_FUN', 'NM_CAB_IMG',
		'NM_ROD_COR_FUN', 'NM_ROD_COR_TXT', 'NM_ROD_TXT_TIP', 'NM_ROD_TXT_TAM', 'NM_ROD_IMG_FUN',
		'NM_TIT_COR_FUN', 'NM_TIT_COR_TXT', 'NM_TIT_TXT_TIP', 'NM_TIT_TXT_TAM', 'NM_TIT_COR_LIN',
		'NM_GRU_COR_FUN', 'NM_GRU_COR_TXT', 'NM_GRU_TXT_TIP', 'NM_GRU_TXT_TAM',
		'NM_TOT_COR_FUN', 'NM_TOT_COR_TXT', 'NM_TOT_TXT_TIP', 'NM_TOT_TXT_TAM',
		'NM_SUB_COR_FUN', 'NM_SUB_COR_TXT', 'NM_SUB_TXT_TIP', 'NM_SUB_TXT_TAM',
		'NM_DAD_COR_FUN', 'NM_DAD_COR_TXT', 'NM_DAD_TXT_TIP', 'NM_DAD_TXT_TAM', 'NM_DAD_COR_LIN', 'NM_DAD_COR_IMP', 'NM_DAD_COR_PAR');
	//$str_regex = '/\[[a-zA-Z][a-zA-Z0-9_]*\]/sm';
	$str_regex = '/\{\w+\}/smu';
	preg_match_all($str_regex, $v_str_data, $arr_match);
	$arr_list = array();
	$arr_match = array_unique($arr_match[0]);
	foreach ($arr_match as $str_var) {
		$str_var = substr(substr($str_var, 0, -1), 1);
		if (!$v_bol_case) {
			$str_var = strtolower($str_var);
		}
		if (!in_array($str_var, $arr_list)) {
			if ($v_bol_show || !in_array($str_var, $arr_filt)) {
				if ('NM_CSS_' != substr($str_var, 0, 7)) {
					$arr_list[] = $str_var;
				}
			}
		}
	}
	natcasesort($arr_list);
	return $arr_list;
} // nm_var_list

function GetImgType($type, $categ, $strLookup)
{
	$_SESSION['nm_session']['menu_tree_fld_img']['text'] 			= 'menu_tree_fld_text_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['text_area'] 		= 'menu_tree_fld_multitext_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['image'] 			= 'menu_tree_fld_image_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['file'] 			= 'menu_tree_fld_file_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['listbox'] 		= 'menu_tree_fld_listbox_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['duploselect'] 	= 'menu_tree_fld_duplo-select_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['check'] 			= 'menu_tree_fld_check_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['radio'] 			= 'menu_tree_fld_radio_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['number'] 			= 'menu_tree_fld_number_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['currency'] 		= 'menu_tree_fld_currency_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['decimal'] 		= 'menu_tree_fld_decimal_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['autocomplete'] 	= 'menu_tree_fld_autocomplete_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['youtube'] 		= 'menu_tree_fld_youtube_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['google'] 			= 'menu_tree_fld_google_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['calendar'] 		= 'menu_tree_fld_calendar_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['hora'] 			= 'menu_tree_fld_hora_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['datahora'] 		= 'menu_tree_fld_datahora_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['email'] 			= 'menu_tree_fld_email_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['cartao'] 			= 'menu_tree_fld_cartao_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['cnpj'] 			= 'menu_tree_fld_cnpj_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['qrcode'] 			= 'menu_tree_fld_qrcode_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['barcode'] 		= 'menu_tree_fld_barcode_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['tema']	 		= 'menu_tree_fld_tema_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['cep']	 			= 'menu_tree_fld_cep_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['url']	 			= 'menu_tree_fld_url_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['corhtml'] 		= 'menu_tree_fld_cor-html_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['editorhtml'] 		= 'menu_tree_fld_editor-html_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['localizacao'] 	= 'menu_tree_fld_localizacao_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['imagemhtml'] 		= 'menu_tree_fld_imagem-html_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['label'] 			= 'menu_tree_fld_label_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['cpf']	 			= 'menu_tree_fld_cpf_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['cpfecnpj'] 		= 'menu_tree_fld_cpf_cnpj_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['cep']	 			= 'menu_tree_fld_cep_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['rating']	 		= 'menu_tree_fld_rating_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['ratingsmile']	 	= 'menu_tree_fld_ratingsmile_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['ratingthumbs']	= 'menu_tree_fld_ratingthumb_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['assinatura']	 	= 'menu_tree_fld_assinatura_default.png';

	$_SESSION['nm_session']['menu_tree_fld_img']['text_d'] 			= 'menu_tree_fld_text_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['text_area_d'] 	= 'menu_tree_fld_multitext_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['image_d'] 		= 'menu_tree_fld_image_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['file_d'] 			= 'menu_tree_fld_file_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['listbox_d'] 		= 'menu_tree_fld_listbox_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['duploselect_d'] 	= 'menu_tree_fld_duplo-select_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['check_d'] 		= 'menu_tree_fld_check_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['radio_d'] 		= 'menu_tree_fld_radio_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['number_d'] 		= 'menu_tree_fld_number_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['currency_d'] 		= 'menu_tree_fld_currency_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['decimal_d'] 		= 'menu_tree_fld_decimal_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['autocomplete_d'] 	= 'menu_tree_fld_autocomplete_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['youtube_d'] 		= 'menu_tree_fld_youtube_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['google_d'] 		= 'menu_tree_fld_google_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['calendar_d'] 		= 'menu_tree_fld_calendar_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['hora_d'] 			= 'menu_tree_fld_hora_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['datahora_d'] 		= 'menu_tree_fld_datahora_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['email_d'] 		= 'menu_tree_fld_email_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['cartao_d'] 		= 'menu_tree_fld_cartao_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['cnpj_d'] 			= 'menu_tree_fld_cnpj_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['qrcode_d'] 		= 'menu_tree_fld_qrcode_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['barcode_d'] 		= 'menu_tree_fld_barcode_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['tema_d']	 		= 'menu_tree_fld_tema_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['cep_d']	 		= 'menu_tree_fld_cep_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['url_d']	 		= 'menu_tree_fld_url_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['corhtml_d'] 		= 'menu_tree_fld_cor-html_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['editorhtml_d'] 	= 'menu_tree_fld_editor-html_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['localizacao_d'] 	= 'menu_tree_fld_localizacao_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['imagemhtml_d'] 	= 'menu_tree_fld_imagem-html_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['label_d'] 		= 'menu_tree_fld_label_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['cpf_d']	 		= 'menu_tree_fld_cpf_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['cpfecnpj_d'] 		= 'menu_tree_fld_cpf_cnpj_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['cep_d']	 		= 'menu_tree_fld_cep_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['rating_d']	 	= 'menu_tree_fld_rating_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['ratingsmile_d']	= 'menu_tree_fld_ratingsmile_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['ratingthumbs_d']	= 'menu_tree_fld_ratingthumb_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['assinatura_d']	= 'menu_tree_fld_assinatura_default.png';

	$_SESSION['nm_session']['menu_tree_fld_img']['text_l'] 			= 'menu_tree_fld_text_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['text_area_l'] 	= 'menu_tree_fld_multitext_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['image_l'] 		= 'menu_tree_fld_image_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['file_l'] 			= 'menu_tree_fld_file_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['listbox_l'] 		= 'menu_tree_fld_listbox_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['duploselect_l'] 	= 'menu_tree_fld_duplo-select_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['check_l'] 		= 'menu_tree_fld_check_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['radio_l'] 		= 'menu_tree_fld_radio_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['number_l'] 		= 'menu_tree_fld_number_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['currency_l'] 		= 'menu_tree_fld_currency_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['decimal_l'] 		= 'menu_tree_fld_decimal_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['autocomplete_l'] 	= 'menu_tree_fld_autocomplete_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['youtube_l'] 		= 'menu_tree_fld_youtube_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['google_l'] 		= 'menu_tree_fld_google_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['calendar_l'] 		= 'menu_tree_fld_calendar_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['hora_l'] 			= 'menu_tree_fld_hora_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['datahora_l'] 		= 'menu_tree_fld_datahora_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['email_l'] 		= 'menu_tree_fld_email_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['cartao_l'] 		= 'menu_tree_fld_cartao_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['cnpj_l'] 			= 'menu_tree_fld_cnpj_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['qrcode_l'] 		= 'menu_tree_fld_qrcode_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['barcode_l'] 		= 'menu_tree_fld_barcode_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['tema_l']	 		= 'menu_tree_fld_tema_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['cep_l']	 		= 'menu_tree_fld_cep_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['url_l']	 		= 'menu_tree_fld_url_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['corhtml_l'] 		= 'menu_tree_fld_cor-html_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['editorhtml_l'] 	= 'menu_tree_fld_editor-html_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['localizacao_l'] 	= 'menu_tree_fld_localizacao_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['imagemhtml_l'] 	= 'menu_tree_fld_imagem-html_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['label_l'] 		= 'menu_tree_fld_label_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['cpf_l']	 		= 'menu_tree_fld_cpf_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['cpfecnpj_l'] 		= 'menu_tree_fld_cpf_cnpj_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['cep_l']	 		= 'menu_tree_fld_cep_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['rating_l']	 	= 'menu_tree_fld_rating_lookup.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['ratingsmile_l']	= 'menu_tree_fld_ratingsmile_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['ratingthumbs_l']	= 'menu_tree_fld_ratingthumb_default.png';
	$_SESSION['nm_session']['menu_tree_fld_img']['assinatura_l']	= 'menu_tree_fld_assinatura_lookup.png';

	$str_def = ($categ == 2) ? '_d' : '';
	$str_def = ($strLookup) ? '_l' : $str_def;
	$arr_img = $_SESSION['nm_session']['menu_tree_fld_img'];
	$str_img = $arr_img['text' . $str_def];

	switch (strtoupper($type)) {
		/* Inserido novos icones @Vinicius */

		case 'EMAIL':
			$str_img = $arr_img['email' . $str_def];
			break;

		case 'VALOR':
			$str_img = $arr_img['currency' . $str_def];
			break;

		case 'DECIMAL':
			$str_img = $arr_img['decimal' . $str_def];
			break;

		case 'TEXTO_AUTOCOMP':
		case 'NUMERO_AUTOCOMP':
			$str_img = $arr_img['autocomplete' . $str_def];
			break;

		case 'YOUTUBE':
			$str_img = $arr_img['youtube' . $str_def];
			break;

		case 'GOOGLEMAPS':
			$str_img = $arr_img['google' . $str_def];
			break;

		case 'ASSINATURA':
			$str_img = $arr_img['assinatura' . $str_def];
			break;

		case 'RATING':
			$str_img = $arr_img['rating' . $str_def];
			break;

		case 'RATINGSMILE':
			$str_img = $arr_img['ratingsmile' . $str_def];
			break;

		case 'RATINGTHUMBS':
			$str_img = $arr_img['ratingthumbs' . $str_def];
			break;

		case 'DATA':
			$str_img = $arr_img['calendar' . $str_def];
			break;

		case 'HORA':
			$str_img = $arr_img['hora' . $str_def];
			break;

		case 'DATAHORA':
			$str_img = $arr_img['datahora' . $str_def];
			break;

		case 'MULTITEXTO':
			$str_img = $arr_img['text_area' . $str_def];
			break;

		case 'ARQUIVO':
		case 'IMAGEM':
			$str_img = $arr_img['image' . $str_def];
			break;

		case 'DOCUMENTO_DB':
		case 'DOCUMENTO':
			$str_img = $arr_img['file' . $str_def];
			break;

		case 'SELECT':
		case 'SUBSELECT':
			$str_img = $arr_img['listbox' . $str_def];
			break;

		case 'DUPLO_SELECT':
			$str_img = $arr_img['duploselect' . $str_def];
			break;

		case 'PERFIL':
		case 'JUMP_MENU':
			$str_img = $arr_img['listbox' . $str_def];
			break;

		case 'CHECKBOX':
			$str_img = $arr_img['check' . $str_def];
			break;

		case 'RADIO':
			$str_img = $arr_img['radio' . $str_def];
			break;

		case 'NUMEROEDT':
		case '__NM_COUNT_NM__':
			$str_img = $arr_img['number' . $str_def];
			break;

		case 'QRCODE':
			$str_img = $arr_img['qrcode' . $str_def];
			break;
		case 'BAR_CODE':
		case 'BARCOD_2DE5':
		case 'BARCOD_39':
		case 'BARCOD_128':
		case 'BARCOD_EAN8':
		case 'BARCOD_EAN13':
		case 'BARCOD_UPC':
			$str_img = $arr_img['barcode' . $str_def];
			break;

		case 'TPCARTAO':
		case 'CARTAO':
			$str_img = $arr_img['cartao' . $str_def];
			break;

		case 'CIC':
			$str_img = $arr_img['cpf' . $str_def];
			break;

		case 'CNPJ':
			$str_img = $arr_img['cnpj' . $str_def];
			break;

		case 'CICCNPJ':
		case 'TPCICCNPJ':
			$str_img = $arr_img['cpfecnpj' . $str_def];
			break;

		case 'CEP':
			$str_img = $arr_img['cep' . $str_def];
			break;

		case 'URL':
			$str_img = $arr_img['url' . $str_def];
			break;

		case 'CORHTML':
			$str_img = $arr_img['corhtml' . $str_def];
			break;

		case 'EDITOR_HTML':
			$str_img = $arr_img['editorhtml' . $str_def];
			break;

		case 'LOCALE':
			$str_img = $arr_img['localizacao' . $str_def];
			break;

		case 'SCHEMA':
			$str_img = $arr_img['tema' . $str_def];
			break;

		case 'FORM_IMAGE_HTML':
			$str_img = $arr_img['imagemhtml' . $str_def];
			break;

		case 'FORM_LABEL':
			$str_img = $arr_img['label' . $str_def];
			break;

		case 'TEXTO':
		default:
			$str_img = $arr_img['text' . $str_def];
			break;
	}

	return $str_img;
}// GetImgType

function ArraySearch($str_item, $arr_array, $bol_case_sensitive = true)
{
	$bol_retorno = false;

	if (is_array($arr_array)) {
		foreach ($arr_array as $ind => $item) {
			if ($item == $str_item || (!$bol_case_sensitive && strtolower($item) == strtolower($str_item))) {
				$bol_retorno = true;
				break;
			}
		}
	}

	return $bol_retorno;
}// ArraySearch

function RemoveExtFile($str_file)
{
	if (strpos($str_file, ".") > 0) {
		$str_retorno = strrev($str_file);
		$str_retorno = substr($str_retorno, strpos($str_retorno, ".") + 1);
		$str_retorno = strrev($str_retorno);
	} else {
		$str_retorno = $str_file;
	}

	return $str_retorno;
}//RemoveExtFile

function IsFldDbNumeric($str_tipo)
{
	switch (strtoupper($str_tipo)) {
		case 'BIT':
		case 'BIGINT':
		case 'BIGSERIAL':
		case 'CURRENCY':
		case 'DECIMAL':
		case 'DOUBLE':
		case 'DOUBLE PRECISION':
		case 'FLOAT':
		case 'FLOAT4':
		case 'FLOAT8':
		case 'INT':
		case 'INT2':
		case 'INT4':
		case 'INT8':
		case 'INT64':
		case 'INTEGER':
		case 'MEDIUMINT':
		case 'MONEY':
		case 'NUMBER':
		case 'NUMERIC':
		case 'REAL':
		case 'SERIAL':
		case 'SMALLINT':
		case 'SMALLMONEY':
		case 'TINYINT':
		case 'UNKNOWN':
			$bln_retorno = true;
			break;

		default:
			$bln_retorno = false;
			break;
	}

	return $bln_retorno;
}//IsFldDbNumeric

function nm_faz_nada()
{
}

/* Adiciona Tags PHP */
function nm_add_tag_php($str_codigo, $menor = '&lt;', $maior = '&gt;')
{
	$bln_subs = false;
	$srt_cod_aux = $str_codigo;
	$srt_cod_aux = trim(trim($srt_cod_aux, "\n\r"));
	if (substr($srt_cod_aux, 0, 5) == "<?php") {
		$srt_cod_aux = substr($srt_cod_aux, 5);
		$bln_subs = true;
	}
	if (substr($srt_cod_aux, -2, 2) == "?>") {
		$srt_cod_aux = substr($srt_cod_aux, 0, strlen($srt_cod_aux) - 2);
		$bln_subs = true;
	}

	if ($bln_subs) {
		$str_codigo = $srt_cod_aux;
	}

	$arr_code = explode("\n", $str_codigo);
	$str_codigo = '';
	foreach ($arr_code as $str_code) {
		if (trim($str_code) != '' || $str_codigo != '') {
			$str_codigo .= ($str_codigo != '' ? "\n" : "") . $str_code;
		}
	}

	$str_codigo = rtrim(rtrim($str_codigo, "\n\r"));

	if ($str_codigo == '') {
		$str_codigo = $menor . "?php\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r?" . $maior;
	} else {
		$str_codigo = $menor . "?php\n\r" . $str_codigo . "\n\r?" . $maior;
	}

	return $str_codigo;
}//nm_add_tag_php

/* Remove Tags PHP */
function nm_rem_tag_php($str_codigo, $right = true)
{
	$str_codigo = trim(trim($str_codigo, "\n\r"));

	if (substr($str_codigo, 0, 5) == "<?php") {
		$str_codigo = substr($str_codigo, 5);
	}

	if (substr($str_codigo, -2, 2) == "?>") {
		$str_codigo = substr($str_codigo, 0, strlen($str_codigo) - 2);
	}

	if ($right) {
		$str_codigo = rtrim(trim($str_codigo, "\n\r"));
	} else {
		$str_codigo = trim(trim($str_codigo, "\n\r"));
	}

	return $str_codigo;

}//nm_rem_tag_php

function GetArrBtEditorHTML($tipo = 'all', $bol_new = false)
{
	$arr_bt = array();

	if(!$bol_new)
	{

		switch ($tipo) {
			case 'all': /* Todos */
				$arr_bt[1] = 'save';
				$arr_bt[2] = 'newdocument';
				$arr_bt[3] = 'bold';
				$arr_bt[4] = 'italic';
				$arr_bt[5] = 'underline';
				$arr_bt[6] = 'strikethrough';
				$arr_bt[7] = 'justifyleft';
				$arr_bt[8] = 'justifycenter';
				$arr_bt[9] = 'justifyright';
				$arr_bt[10] = 'justifyfull';
				$arr_bt[11] = 'cut';
				$arr_bt[12] = 'copy';
				$arr_bt[13] = 'paste';
				$arr_bt[14] = 'pastetext';
				$arr_bt[15] = 'pasteword';
				$arr_bt[16] = 'search';
				$arr_bt[17] = 'replace';
				$arr_bt[18] = 'bullist';
				$arr_bt[19] = 'numlist';
				$arr_bt[20] = 'outdent';
				$arr_bt[21] = 'indent';
				$arr_bt[22] = 'blockquote';
				$arr_bt[23] = 'undo';
				$arr_bt[24] = 'redo';
				$arr_bt[25] = 'link';
				$arr_bt[26] = 'unlink';
				$arr_bt[27] = 'anchor';
				$arr_bt[28] = 'image';
				$arr_bt[29] = 'cleanup';
				$arr_bt[30] = 'help';
				$arr_bt[31] = 'code';
				$arr_bt[32] = 'insertdate';
				$arr_bt[33] = 'inserttime';
				$arr_bt[34] = 'preview';
				$arr_bt[35] = 'forecolor';
				$arr_bt[36] = 'backcolor';
				$arr_bt[37] = 'tablecontrols';
				$arr_bt[38] = 'hr';
				$arr_bt[39] = 'removeformat';
				$arr_bt[40] = 'visualaid';
				$arr_bt[41] = 'sub';
				$arr_bt[42] = 'sup';
				$arr_bt[43] = 'charmap';
				$arr_bt[44] = 'emotions';
//				$arr_bt[45] = 'iespell';
				$arr_bt[46] = 'media';
				$arr_bt[47] = 'advhr';
				$arr_bt[48] = 'print';
				$arr_bt[49] = 'ltr';
				$arr_bt[50] = 'rtl';
				$arr_bt[51] = 'fullscreen';
				$arr_bt[52] = 'insertlayer';
				$arr_bt[53] = 'moveforward';
				$arr_bt[54] = 'movebackward';
				$arr_bt[55] = 'absolute';
				$arr_bt[56] = 'styleprops';
				$arr_bt[57] = 'cite';
				$arr_bt[58] = 'abbr';
				$arr_bt[59] = 'acronym';
				$arr_bt[60] = 'del';
				$arr_bt[61] = 'ins';
				$arr_bt[62] = 'attribs';
				$arr_bt[63] = 'visualchars';
				$arr_bt[64] = 'nonbreaking';
				$arr_bt[65] = 'template';
				$arr_bt[66] = 'pagebreak';
				$arr_bt[67] = 'styleselect';
				$arr_bt[68] = 'formatselect';
				$arr_bt[69] = 'fontselect';
				$arr_bt[70] = 'fontsizeselect';
//				$arr_bt[71] = 'insertfile';
				break;

			case 'inativ':        /* Inativos */
				$arr_bt[] = 'save';
				$arr_bt[] = 'newdocument';
				$arr_bt[] = 'blockquote';
				$arr_bt[] = 'media';
				$arr_bt[] = 'cite';
				$arr_bt[] = 'abbr';
				$arr_bt[] = 'acronym';
				$arr_bt[] = 'del';
				$arr_bt[] = 'ins';
				$arr_bt[] = 'attribs';
				$arr_bt[] = 'visualchars';
				$arr_bt[] = 'nonbreaking';
				$arr_bt[] = 'template';
				$arr_bt[] = 'pagebreak';
				$arr_bt[] = 'styleselect';
				break;

			case 'plugins': /* Plugins */
				$arr_bt['pastetext'] = array('plugin' => 'paste', 'img' => 'pastetext.gif');
				$arr_bt['pasteword'] = array('plugin' => 'paste', 'img' => 'pasteword.gif');
				$arr_bt['search'] = array('plugin' => 'searchreplace', 'img' => 'search.gif');
				$arr_bt['replace'] = array('plugin' => 'searchreplace', 'img' => 'replace.gif');
				$arr_bt['insertdate'] = array('plugin' => 'insertdatetime', 'img' => 'insertdate.gif');
				$arr_bt['inserttime'] = array('plugin' => 'insertdatetime', 'img' => 'inserttime.gif');
				$arr_bt['preview'] = array('plugin' => 'preview', 'img' => 'preview.gif');
				$arr_bt['tablecontrols'] = array('plugin' => 'table', 'img' => 'table.gif');
				$arr_bt['emotions'] = array('plugin' => 'emotions', 'img' => 'emotions.gif');
//				$arr_bt['iespell'] = array('plugin' => 'iespell', 'img' => 'iespell.gif');
				$arr_bt['advhr'] = array('plugin' => 'advhr', 'img' => 'advhr.gif');
				$arr_bt['print'] = array('plugin' => 'print', 'img' => 'print.gif');
				$arr_bt['ltr'] = array('plugin' => 'directionality', 'img' => 'ltr.gif');
				$arr_bt['rtl'] = array('plugin' => 'directionality', 'img' => 'rtl.gif');
				$arr_bt['fullscreen'] = array('plugin' => 'fullscreen', 'img' => 'fullscreen.gif');
				$arr_bt['insertlayer'] = array('plugin' => 'layer', 'img' => 'insert_layer.gif');
				$arr_bt['moveforward'] = array('plugin' => 'layer', 'img' => 'forward.gif');
				$arr_bt['movebackward'] = array('plugin' => 'layer', 'img' => 'backward.gif');
				$arr_bt['absolute'] = array('plugin' => 'layer', 'img' => 'absolute.gif');
				$arr_bt['styleprops'] = array('plugin' => 'style', 'img' => 'style_info.gif');
				break;
		}
	}
	else
	{
		switch ($tipo) {
			case 'all': /* Todos */

				$arr_bt[] = "newdocument";
				$arr_bt[] = "fullpage";
				$arr_bt[] = "bold";
				$arr_bt[] = "italic";
				$arr_bt[] = "underline";
				$arr_bt[] = "strikethrough";
				$arr_bt[] = "alignleft";
				$arr_bt[] = "aligncenter";
				$arr_bt[] = "alignright";
				$arr_bt[] = "alignjustify";
				$arr_bt[] = "styleselect";
				$arr_bt[] = "formatselect";
				$arr_bt[] = "fontselect";
				$arr_bt[] = "fontsizeselect";
				$arr_bt[] = "cut";
				$arr_bt[] = "copy";
				$arr_bt[] = "paste";
				$arr_bt[] = "searchreplace";
				$arr_bt[] = "bullist";
				$arr_bt[] = "numlist";
				$arr_bt[] = "outdent";
				$arr_bt[] = "indent";
				$arr_bt[] = "blockquote";
				$arr_bt[] = "undo";
				$arr_bt[] = "redo";
				$arr_bt[] = "link";
				$arr_bt[] = "unlink";
				$arr_bt[] = "anchor";
//				$arr_bt[] = "insertfile";
				$arr_bt[] = "image";
				$arr_bt[] = "media";
				$arr_bt[] = "code";
				$arr_bt[] = "insertdatetime";
				$arr_bt[] = "preview";
				$arr_bt[] = "forecolor";
				$arr_bt[] = "backcolor";
				$arr_bt[] = "table";
				$arr_bt[] = "hr";
				$arr_bt[] = "removeformat";
				$arr_bt[] = "subscript";
				$arr_bt[] = "superscript";
				$arr_bt[] = "charmap";
				$arr_bt[] = "emoticons";
				$arr_bt[] = "print";
				$arr_bt[] = "fullscreen";
				$arr_bt[] = "ltr";
				$arr_bt[] = "rtl";
				//$arr_bt[] = "spellchecker";
				$arr_bt[] = "visualchars";
				$arr_bt[] = "visualblocks";
				$arr_bt[] = "nonbreaking";
				$arr_bt[] = "template";
				$arr_bt[] = "pagebreak";
				$arr_bt[] = "restoredraft";
				$arr_bt[] = "separator";

				break;

			case 'inativ':        /* Inativos */

				break;

			case 'plugins': /* Plugins */

				break;
		}
	}

	return $arr_bt;

}//GetArrBtEditorHTML

function checkSysLangGetNewIndex()
{
	$arr_ini_conv = array();
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_ivnb';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_ivvl';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_nvlf';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_mxdg';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_intg';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_dcml';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_nnum';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_ivv2';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_minm';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_maxm';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_ivdt';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_iday';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_mnth';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_minm_date';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_maxm_date';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_ivtm';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_hour';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_mint';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_secd';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_decm';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_mxvl';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_ivdt';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_ivem';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_mslg';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_ivcr';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_msfr';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_msob';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_reqr';
	$arr_ini_conv['javascript'][] = 'nmgp_lang_js_lang_jscr_wfix';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_srch_days';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_srch_mnth';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_srch_year';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_days_sund';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_days_mond';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_days_tued';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_days_wend';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_days_thud';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_days_frid';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_days_satd';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_shrt_days_sund';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_shrt_days_mond';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_shrt_days_tued';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_shrt_days_wend';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_shrt_days_thud';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_shrt_days_frid';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_shrt_days_satd';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_mnth_janu';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_mnth_febr';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_mnth_marc';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_mnth_apri';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_mnth_mayy';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_mnth_june';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_mnth_july';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_mnth_augu';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_mnth_sept';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_mnth_octo';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_mnth_nove';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_mnth_dece';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_shrt_mnth_janu';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_shrt_mnth_febr';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_shrt_mnth_marc';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_shrt_mnth_apri';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_shrt_mnth_mayy';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_shrt_mnth_june';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_shrt_mnth_july';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_shrt_mnth_augu';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_shrt_mnth_sept';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_shrt_mnth_octo';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_shrt_mnth_nove';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_shrt_mnth_dece';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_srch_time';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_srch_mint';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_srch_scnd';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_recu_daily';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_recu_monthly';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_recu_weekly';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_recu_annual';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_peri_yes';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_peri_no';
	$arr_ini_conv['calendar'][] = 'nmgp_lang_usr_lang_per_allday';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_ordr';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_ordr_none';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_ordr_asc';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_ordr_desc';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_titl';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_type';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_bars';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_horz_bars';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_line';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_horz_line';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_nume_pies';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_prec_pies';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_squa';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_squa_horiz';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_nume_3pie';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_perc_3pie';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_puls';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_puls_horiz';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_scat';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_scat_horiz';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_wdth';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_hgth';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_mrgn';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_keep_aspc';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_fill';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_show_vals';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_angl_vals';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_show_dots';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_bkgr_colr';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_marg_colr';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_labl_colr';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_vals_colr';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_dots_type';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_sqre';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_crcl';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_trgl_uppr';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_trgl_down';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_lzng';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_star';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_gtmd';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_smzd';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_anlt';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_horz_puls';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_horz_scat';
	$arr_ini_conv['charts'][] = 'nmgp_lang_usr_lang_chrt_horz_squa';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_cndt';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_andd';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_orrr';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_exac';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_stts_with';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_like';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_dife';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_grtr';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_grtr_equl';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_less';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_less_equl';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_betw';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_betw_sevr';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_equl';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_strt';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_like';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_diff';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_grtr';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_grtr_ig';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_less';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_less_ig';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_betw';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_outo';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_andd';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_orrr';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_null';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_nnul';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_nrml';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_spec';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_tday';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_yest';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_lst7';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_lstw';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_lstw_bsnd';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_this_mnth';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_last_mnth';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_ever';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_tomw';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_nxt7';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_nx30';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_nxtw_mond_sund';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_nxtw_mond_frid';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_next_mnth';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_sett';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_quck_srch';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_butn';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_butn_exit';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_butn_save';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_butn_dele';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_butn_cncl';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_butn_clea';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_head_mesg';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_impt';
	$arr_ini_conv['search'][] = 'nmgp_lang_usr_lang_srch_all_fields';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_titl';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_type';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_colr';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_bndw';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_pper';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_letr';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_legl';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_cstm';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_errg';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_pper_hgth';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_pper_wdth';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_pper_orie';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_prtr';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_lnds';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_bkmk';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_chrt';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_wdth';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_font';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_chrt_yess';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_chrt_nooo';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_cncl';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_htlm_pdf';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_file_loct';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_clck_mesg';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_strt';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_rows';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_gnrt';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_htlm_pdfdoc_f';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_htlm_pdfdoc_e';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_fnsh';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_frmt_page';
	$arr_ini_conv['pdf'][] = 'nmgp_lang_usr_lang_pdff_wrtg';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_frst';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_prev';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_next';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_last';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_inst';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_dele';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_updt';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_neww';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_sort';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_clmn';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_save';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_clea';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_pdff';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_pdff_pb';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_xmlf';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_csvf';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_rtff';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_xlsf';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_srch';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_smry';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_smry_conf';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_smry_conf_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_prnt';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_rows';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_exit';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_errm_clse';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_errm_clse_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_smry_msge_avg';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_smry_msge_min';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_smry_msge_max';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_smry_msge_sum';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_smry_msge_cnt';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_smry_msge_dct';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_smry_msge_var';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_smry_msge_pad';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_smry_msge_wei';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_srch_mtmf';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_srch_mtmf_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_emai';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_emai_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_back';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_help';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_chrt';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_chrt_stng';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_jump';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_cfrm';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_qtch';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_chrt_stng';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_srch_edit';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_srch_edit_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_quck_srch';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_quck_srch_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_cncl';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_mdtl_inst';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_mdtl_dele';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_mdtl_updt';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_copy';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_mdtl_cncl';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_mdtl_edit';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_cldr';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_calc';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_lens';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_pncl';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_zpcd';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_iurl';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_lang';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_lens_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_pncl_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_zpcd_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_iurl_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_lang_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_mdtl_inst_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_mdtl_dele_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_mdtl_updt_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_copy_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_mdtl_cncl_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_mdtl_edit_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_cldr_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_calc_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_bndw_pdff';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_rtrn_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_clse_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_rtrn_scrp_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_view_chrt_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_chrt_stng_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_dele_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_clea_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_smry_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_smry_rtte';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_smry_rtte_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_smry_drll';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_smry_drll_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_dtai_rtrn_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_edit_1row_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_view_dtai_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_jump_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_frst_page';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_prev_page';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_next_page';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_last_page';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_frst_page_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_prev_page_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_next_page_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_last_page_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_neww_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_rows_clmn_lmit_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_rows_clmn_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_rows_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_clmn_limt_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_srch_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_pdfc_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_pick';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_pick_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_xlsf_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_xmlf_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_xlsf_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_csvf_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_rtff_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_prnt_prep_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_exit_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btnh_clmn_limtumns';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_ordr_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_smry_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_rtrn_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_frst_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_prev_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_next_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_last_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_new1_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btnh_new1s';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_updt_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_inst_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_delt_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_srch_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_rtrn_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_cncl_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_help_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_save_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_okkk_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_menu_rtrn_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_prtn_titl_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_mode_prnt_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_mess_clse';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_mess_clse_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_cncl_prnt_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_cldr_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_colr_updt_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_colr_cncl_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_chrt_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_chrt_pdff_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_chrt_gantt';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_chrt_gantt_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_grid_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_exit_appl_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_newn_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_prnt_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_slct_clmn_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_cfrm_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_clmn_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_pdfc';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_sort_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_back_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_rtrv_grid';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_rtrv_grid_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_rtrv_form';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_rtrv_form_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_srgb';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_srgb_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_expo';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_expo_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_ajax';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_ajax_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_ajax_close';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_ajax_close_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_hlpf';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_hlpf_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_cptc_rfim';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_cptc_rfim_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_expv';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_expv_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_word';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_word_hint';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_copy';
	$arr_ini_conv['btn'][] = 'nmgp_lang_usr_lang_btns_copy_hint';


	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_area';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_area_area';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_area_invi';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_area_invn';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_area_invr';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_area_shpe';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_area_spln';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_area_srbs';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_area_srgr';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_area_srst';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_area_stak';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_area_stan';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_area_stap';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_area_stay';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_bars';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_bars_2ddm';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_bars_3ddm';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_bars_3ont';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_bars_3ovr';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_bars_3oys';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_bars_bars';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_bars_cone';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_bars_cyld';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_bars_dmns';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_bars_horz';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_bars_invi';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_bars_invn';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_bars_invr';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_bars_layo';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_bars_pyrm';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_bars_shpe';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_bars_srbs';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_bars_srgr';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_bars_srst';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_bars_stan';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_bars_stap';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_bars_stay';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_bars_stck';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_bars_vrtc';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_fpie';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_fpie_2ddm';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_fpie_3ddm';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_fpie_asrt';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_fpie_axpl';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_fpie_cxpl';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_fpie_dmns';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_fpie_dnts';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_fpie_dsrt';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_fpie_dxpl';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_fpie_expl';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_fpie_fpie';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_fpie_invi';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_fpie_invn';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_fpie_invr';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_fpie_nsrt';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_fpie_shpe';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_fpie_srtn';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_fpie_fval';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_fpie_fvlv';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_fpie_fvlp';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_line';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_line_invi';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_line_invn';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_line_invr';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_line_line';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_line_shpe';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_line_spln';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_line_srbs';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_line_srgr';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_line_srst';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_line_step';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_mrks';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_mrks_invi';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_mrks_invn';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_mrks_invr';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_mrks_srbs';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_mrks_srgr';
	$arr_ini_conv['fcharts'][] = 'nmgp_lang_usr_lang_flsh_chrt_mrks_srst';

	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_dber';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_time_outt';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_errt';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_fnfd';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_unth_user';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_unth_hwto';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_type_pswd';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_none_imge';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_nfnd';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_updt';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_ukey';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_pkey';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_inst';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_inst_uniq';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_dele_nfnd';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_dele';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_nfnd_extr';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_dbas';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_glob';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_dbcn_conn';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_dbcn_data';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_dbcn_nfnd';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_dbcn_nspt';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_cmlb_nfnd';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_empt';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_remv';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_flds';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_reqd';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_size';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_nchr';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_nchr_inval';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_nchr_max';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_nchr_min';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_upld';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_ivtp';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_ivdr';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_nfdr';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_line';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_cfrm_remv';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_tmeo';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_dcmt';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_fkvi';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_dele';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_ajax_rqrd';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_ajax_data';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_ivch';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_mnch';
	$arr_ini_conv['validation'][] = 'nmgp_lang_usr_lang_errm_mxch';
	$arr_ini_conv['validation'][] = 'nmgp_lang_errm_api_nfnd';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_csvf_msg1';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_csvf_msg2';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_smry_info';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_smry_ppup_titl';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_smry_ppup_fild';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_smry_ppup_posi';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_smry_ppup_sort';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_smry_ppup_posi_labl';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_smry_ppup_posi_data';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_smry_ppup_sort_labl';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_smry_ppup_sort_vlue';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_smry_ppup_chek_tabu';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_btns_smry_msge_avg';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_btns_smry_msge_wei';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_btns_smry_msge_min';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_btns_smry_msge_max';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_btns_smry_msge_cnt';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_btns_smry_msge_dct';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_btns_smry_msge_var';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_btns_smry_msge_sdev';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_btns_smry_msge_sum';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_txto';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_untl';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_rtff_msg1';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_rtff_msg2';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_chrt_totl';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_smry_msge';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_smry_titl';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_rows';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_totl';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_xmlf_msg1';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_xmlf_msg2';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_xlsf_msg1';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_xlsf_msg2';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_zpcd';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_rtrv';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_slct';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_errm_remv_vert';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_vrtc_nshw';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_curr_page';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_full';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_prtc';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_reqr';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_bndw';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_colr';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_grid_titl';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_srch_titl';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_srch_head';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_detl_titl';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_frmu_nlin';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_frmi_titl';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_frmu_titl';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_cplt_titl';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_cplt_defn';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_prcs';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_ajax_frmu';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_show_imgg';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_msgs_totl';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_cptc_errm';
	$arr_ini_conv['others'][] = 'nmgp_lang_usr_lang_othr_cptc_lbel';

	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_opt_yes';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_opt_no';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_exit';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_error_confirm_pswd';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_ret_pass';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_error_pswd';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_syncronized_apps';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_sync_apps';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_error_old_pswd';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_new_user_sign_in';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_new_user';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_login_ok';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_send_new_pswd';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_list_users';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_send_activation_code';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_login_fail';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_log_retrieve_pswd';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_menu_security';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_list_apps_x_groups';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_list_groups';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_list_apps';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_list_users_groups';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_list_sync_apps';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_msg_upd_pswd';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_old_pswd';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_title_change_pswd';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_send_act_code';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_mail_sended_ok';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_subject_mail';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_send_pswd';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_list_apps_x_users';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_sec_users_fild_login';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_sec_users_fild_pswd';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_sec_users_fild_name';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_sec_users_fild_email';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_sec_users_fild_active';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_sec_users_fild_activation_code';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_sec_users_fild_priv_admin';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_sec_users_fild_pswd_confirm';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_send_mail_admin';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_sec_group_id';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_sec_description';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_sec_app_name';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_sec_app_description';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_sec_priv_access';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_sec_priv_insert';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_sec_priv_delete';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_sec_priv_update';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_sec_priv_export';
	$arr_ini_conv['security'][] = 'nmgp_lang_usr_lang_sec_priv_print';


	$arr_ini_conv['log'][] = 'nmgp_lang_usr_lang_log_id';
	$arr_ini_conv['log'][] = 'nmgp_lang_usr_lang_log_date_insert';
	$arr_ini_conv['log'][] = 'nmgp_lang_usr_lang_log_user';
	$arr_ini_conv['log'][] = 'nmgp_lang_usr_lang_log_ip';
	$arr_ini_conv['log'][] = 'nmgp_lang_usr_lang_log_app';
	$arr_ini_conv['log'][] = 'nmgp_lang_usr_lang_log_creator';
	$arr_ini_conv['log'][] = 'nmgp_lang_usr_lang_log_action';
	$arr_ini_conv['log'][] = 'nmgp_lang_usr_lang_log_updates';
	$arr_ini_conv['log'][] = 'nmgp_lang_usr_lang_log_title';
	$arr_ini_conv['log'][] = 'nmgp_lang_usr_lang_log_description';


	return $arr_ini_conv;
}

function remove_acentos($msg)
{
	$a = array(
		'/[AAAAA]/' => 'A',
		'/[aaaaa]/' => 'a',
		'/[EEEE]/' => 'E',
		'/[eeee]/' => 'e',
		'/[IIII]/' => 'I',
		'/[iiii]/' => 'i',
		'/[OOOOO]/' => 'O',
		'/[ooooo]/' => 'o',
		'/[UUUU]/' => 'U',
		'/[uuuu]/' => 'u',
		'/c/' => 'c',
		'/C/' => 'C');

	return preg_replace(array_keys($a), array_values($a), $msg);
}

function nm_sort_value($arr)
{
	$arr_aux = array();
	foreach ($arr as $chave => $titulo) {
		$arr_aux[remove_acentos(html_entity_decode($titulo))] = array('key' => $chave, 'title' => $titulo);
	}

	ksort($arr_aux);

	$arr_retorno = array();
	foreach ($arr_aux as $id => $arr_dados) {
		$arr_retorno[$arr_dados['key']] = $arr_dados['title'];
	}

	return $arr_retorno;
}

function nm_sort_value_by_key($arr, $key)
{
	$arr_retorno = array();
	$arr_aux = array();

	foreach ($arr as $id => $arr_dados) {
		$arr_aux[$id] = $arr_dados[$key];
	}

	$arr_aux = nm_sort_value($arr_aux);

	foreach ($arr_aux as $chave => $valor) {
		$arr_retorno[$chave] = $arr[$chave];
	}

	return $arr_retorno;
}

function getBrowser($browser = "")
{
	$u_agent = empty($browser) ? $_SERVER['HTTP_USER_AGENT'] : $browser;
	$bname = 'Unknown';
	$platform = 'Unknown';
	$version= "";

	//First get the platform?
	if (preg_match('/linux/i', $u_agent)) {
		$platform = 'linux';
	}
	elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
		$platform = 'mac';
	}
	elseif (preg_match('/windows|win32/i', $u_agent)) {
		$platform = 'windows';
	}

	// Next get the name of the useragent yes seperately and for good reason
	if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
	{
		$bname = 'Internet Explorer';
		$ub = "MSIE";
	}
	elseif(preg_match('/Firefox/i',$u_agent))
	{
		$bname = 'Mozilla Firefox';
		$ub = "Firefox";
	}
	elseif(preg_match('/Edge/i',$u_agent))
	{
		$bname = 'Microsoft Edge';
		$ub = "Edge";
	}
	elseif(preg_match('/Chrome/i',$u_agent))
	{
		$bname = 'Google Chrome';
		$ub = "Chrome";
	}
	elseif(preg_match('/Safari/i',$u_agent))
	{
		$bname = 'Apple Safari';
		$ub = "Safari";
	}
	elseif(preg_match('/Opera/i',$u_agent))
	{
		$bname = 'Opera';
		$ub = "Opera";
	}
	elseif(preg_match('/Netscape/i',$u_agent))
	{
		$bname = 'Netscape';
		$ub = "Netscape";
	}

	// finally get the correct version number
	$known = array('Version', $ub, 'other');
	$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	if (!preg_match_all($pattern, $u_agent, $matches)) {
		// we have no matching number just continue
	}

	// see how many we have
	$i = count($matches['browser']);
	if ($i != 1) {
		//we will have two since we are not using 'other' argument yet
		//see if version is before or after the name
		if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
			$version= $matches['version'][0];
		}
		else {
			$version= $matches['version'][1];
		}
	}
	else {
		$version= $matches['version'][0];
	}

	// check if we have a number
	if ($version==null || $version=="") {$version="?";}

	return array(
		'userAgent' => $u_agent,
		'name'      => $bname,
		'version'   => $version,
		'platform'  => $platform,
		'pattern'    => $pattern
	);
}

function remove_item_array_by_val(&$arr, $str_val)
{
	foreach ($arr as $id => $val) {
		if ($val == $str_val) {
			unset($arr[$id]);
		}
	}
}

function xmlspecialchars($text)
{
	return str_replace('&#039;', '&apos;', htmlspecialchars($text, ENT_QUOTES, "UTF-8"));
}

function nm_htmlentities_nospecialchars($str)
{
	$caracteres = get_html_translation_table(HTML_ENTITIES);
	$remover = get_html_translation_table(HTML_SPECIALCHARS);
	$caracteres = array_diff($caracteres, $remover);
	$str = strtr($str, $caracteres);

	return $str;
}

function is_utf8($str)
{
	$str = (String)$str;
	$c = 0;
	$b = 0;
	$bits = 0;
	$len = strlen($str);
	for ($i = 0; $i < $len; $i++) {
		$c = ord($str[$i]);
		if ($c > 128) {
			if (($c >= 254)) return false;
			elseif ($c >= 252) $bits = 6;
			elseif ($c >= 248) $bits = 5;
			elseif ($c >= 240) $bits = 4;
			elseif ($c >= 224) $bits = 3;
			elseif ($c >= 192) $bits = 2;
			else return false;
			if (($i + $bits) > $len) return false;
			while ($bits > 1) {
				$i++;
				$b = ord($str[$i]);
				if ($b < 128 || $b > 191) return false;
				$bits--;
			}
		}
	}
	return true;
}

function nm_conv_utf8($string, $str_charset = "")
{
	return conv_utf8_all($string, $str_charset);
}

function nm_dir_is_empty($folder)
{
	$files = array();
	if (is_dir($folder) && $handle = opendir($folder)) {
		$bol_empty = TRUE;
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != "..") {
				$bol_empty = FALSE;
				break;
			}
		}
		closedir($handle);
		return $bol_empty;
	} else
		return FALSE;
}

function get_microtime()
{
	$arr_tmp_list_change = explode(" ", microtime());
	list($usec, $sec) = $arr_tmp_list_change;
	return ((float)$sec);
}

function microtime_float()
{
	$arr_tmp_list_change = explode(" ", microtime());
	list($usec, $sec) = $arr_tmp_list_change;
	return ((float)$usec + (float)$sec);
}

function nm_str_replace_char_especial($subject, $needle = '_')
{
	$new_string = '';

	for ($i = 0; $i < strlen($subject); $i++) {
		$new_string .= preg_match("/[a-zA-Z0-9_]{1}/", substr($subject, $i, 1)) ? substr($subject, $i, 1) : $needle;
	}

	return $new_string;
}

function nm_compare_string($str1, $str2)
{
	return conv_utf8_all(html_entity_decode($str1)) == conv_utf8_all(html_entity_decode($str2));
}

function nm_debug_backtrace($b_exit = true, $str_file = "", $str_file_mode = "w")
{
	$r = debug_backtrace();
	$output = "";

	$output .= "<br>\r\n";

	foreach ($r as $x) {

		$output .= "file = " . $x['file'] . "<br>\r\n";
		$output .= "line = " . $x['line'] . "<br>\r\n";
		$output .= "function = " . $x['function'] . "<br>\r\n";
		$output .= "class = " . $x['class'] . "<br>\r\n----------------------------------------------------------<br>\r\n";
	}

	if (!$str_file) {
		echo $output;
	} else {
		file_put_contents($str_file, $output);
	}

	if ($b_exit) exit;
}

function nm_container_width(&$dados)
{
	$aPerc = array();
	$bProc = true;
	$iTotal = 0;

	foreach ($dados as $i => $d) {
		$dados[$i]['width_html'] = $d['width'];
		if ('%' != substr($d['width'], -1)) {
			$bProc = false;
		} else {
			$iVal = substr($d['width'], 0, -1);
			$aPerc[$i] = $iVal;
			$iTotal += $iVal;
		}
	}

	if ($iTotal < 100) {
		return;
	}

	if ($bProc) {
		foreach ($aPerc as $i => $v) {
			$dados[$i]['width_html'] = floor(99 * $v / $iTotal) . '%';
		}
	}
}

function nm_up_php_memory()
{
	$memory_limit = ini_get('memory_limit');

	if (substr($memory_limit, -1) == "M") {
		$memory_limit = substr($memory_limit, 0, -1);
	}

	$memory_limit = (int)$memory_limit;
	$new_memory_limit = 2048;

	if ($new_memory_limit > $memory_limit) {
		ini_set("memory_limit", $new_memory_limit.'M');
	}
}//nm_up_php_memory

function nm_trata_nome_tab($str_cod_apl)
{
	$str_cod_apl = str_replace(".", "_", $str_cod_apl);
	$str_cod_apl = str_replace(" ", "_", $str_cod_apl);
	$str_cod_apl = str_replace("'", "", $str_cod_apl);
	$str_cod_apl = str_replace('"', "", $str_cod_apl);
	$str_cod_apl = remove_acentos($str_cod_apl);
	$str_cod_apl = strtolower($str_cod_apl);

	return $str_cod_apl;
}

function nmAddFolderToZip($dir, $zipArchive, $ignorePath = "")
{
	$dir = str_replace("\\", "/", $dir);
	$ignorePath = str_replace("\\", "/", $ignorePath);

	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {

			//Add the directory
			$zipArchive->addEmptyDir(str_replace($ignorePath, "", $dir));

			// Loop through all the files
			while (($file = readdir($dh)) !== false) {

				if (substr($dir, -1) != "/")
					$dir .= "/";

				if (substr($ignorePath, -1) != "/")
					$ignorePath .= "/";

				//If it's a folder, run the function again!
				if (!is_file($dir . $file)) {
					// Skip parent and root directories
					if (($file != ".") && ($file != "..")) {
						nmAddFolderToZip($dir . $file, $zipArchive, $ignorePath);
					}

				} else {
					// Add the files
					$sFile = $dir . $file;

					$lst = array('bkp', 'c', 'css', 'htm', 'html', 'ihtml', 'inc', 'ini', 'js',
						'php', 'phps', 'sql', 'tpl', 'txt');

					//verifica tipo de arquivo
					$pos = strrpos($sFile, '.');
					$data = '';
					if (FALSE === $pos) {
						$data = file_get_contents($sFile);
					} else {
						$ext = strtolower(substr($sFile, $pos + 1));
						if (in_array($ext, $lst)) {
							$data = file_get_contents($sFile);
						} else {
							$fp = @fopen($sFile, 'rb');
							if ($fp) {
								$size = @filesize($sFile);
								$data = (0 == $size) ? '' : @fread($fp, $size);
								@fclose($fp);
							}
						}
					}
					$zipArchive->addFromString(str_replace($ignorePath, "", $sFile), $data);
				}
			}
		}
	}
}

function nm_err_aux($errno, $errstr, $errfile, $errline)
{
	if (isset($_SESSION['err_err'])) {
		echo "-->" . $_SESSION['err_err'] . "<br>";
	}

	nm_printr(array($errno, $errstr, $errfile, $errline));
	echo "<hr>";
}

function nm_err_generic($errno, $errstr, $errfile, $errline)
{
	$_SESSION['nm_err_num_error'] = $errno;
	$_SESSION['nm_err_str_error'] = $errstr;
	$_SESSION['nm_err_fil_error'] = $errfile;
	$_SESSION['nm_err_lin_error'] = $errline;
}

function nm_print_flush($str_string)
{
	$zlib_oc = ini_get('zlib.output_compression');
	if (strtolower($zlib_oc) == 'on' || $zlib_oc == 1 || $zlib_oc == TRUE) {
		echo "<span style='display:none'>
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
			</span>";
		echo $str_string;
		return;
	}
	ob_start();
	ob_end_flush();
	ob_flush();
	flush();

	ob_start();
	echo "<span style='display:none'>
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
		xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
	</span>";
	echo $str_string;
	ob_end_flush();
	ob_flush();
	flush();

}//nm_print_flush

/* funcoes utilizadas no dicionario de dados ---------------------------------------------------------------------------------------*/
if (!function_exists("nm_string_php")) {
	function nm_string_php($vString, $vOrigem = "gpc")
	{
		return ($vString);
	}
}
/* -----------------------------------------------------------------------------------------------------------------------------------*/

function nm_format_date_by_lang($str_data, $str_lang = 'en_us', $str_format = 'yyyymmdd')
{
	if ($str_format == 'dd/mm/yyyy') {
		$str_data = substr($str_data, 6, 4) . substr($str_data, 3, 2) . substr($str_data, 0, 2);
	}

	$str_data = str_replace("-", "", $str_data);

	$date_return = "";

	switch ($str_lang) {
		case 'pt_br':
			$date_return = substr($str_data, 6, 2) . "/" . substr($str_data, 4, 2) . "/" . substr($str_data, 0, 4);
			break;
		case 'es_es':
			$date_return = substr($str_data, 6, 2) . "/" . substr($str_data, 4, 2) . "/" . substr($str_data, 0, 4);
			break;
		case 'it_it':
			$date_return = substr($str_data, 6, 2) . "/" . substr($str_data, 4, 2) . "/" . substr($str_data, 0, 4);
			break;
		case 'fr_fr':
			$date_return = substr($str_data, 6, 2) . "/" . substr($str_data, 4, 2) . "/" . substr($str_data, 0, 4);
			break;
		case 'de_de':
			$date_return = substr($str_data, 6, 2) . "." . substr($str_data, 4, 2) . "." . substr($str_data, 0, 4);
			break;
		case 'en_us':
		default:
			$date_return = substr($str_data, 4, 2) . "/" . substr($str_data, 6, 2) . "/" . substr($str_data, 0, 4);
			break;
	}

	return $date_return;

}//nm_format_date_by_lang


function decode_unicode($str)
{
	$res = '';

	$i = 0;
	$max = strlen($str) - 6;
	while ($i <= $max) {
		$character = $str[$i];
		if ($character == '%' && $str[$i + 1] == 'u') {
			$value = hexdec(substr($str, $i + 2, 4));
			$i += 6;

			if ($value < 0x0080) // 1 byte: 0xxxxxxx
				$character = chr($value);
			else if ($value < 0x0800) // 2 bytes: 110xxxxx 10xxxxxx
				$character =
					chr((($value & 0x07c0) >> 6) | 0xc0)
					. chr(($value & 0x3f) | 0x80);
			else // 3 bytes: 1110xxxx 10xxxxxx 10xxxxxx
				$character =
					chr((($value & 0xf000) >> 12) | 0xe0)
					. chr((($value & 0x0fc0) >> 6) | 0x80)
					. chr(($value & 0x3f) | 0x80);
		} else
			$i++;

		$res .= $character;
	}

	return $res . substr($str, $i);
}

function parseLabelName($v_str_label)
{
	$v_str_label_return = $v_str_label;

	if (utf8_decode($v_str_label) == $v_str_label) {
		$arr_char_especial = array("!", "@", "#", "$", "%", "&", "*", "-", "_", "+", "=", ".");

		$v_str_label_tmp = str_replace($arr_char_especial, " ", $v_str_label);
		$v_str_label_tmp = explode(" ", $v_str_label_tmp);

		if (!is_array($v_str_label_tmp) || empty($v_str_label_tmp)) {
			$v_str_label_tmp = array($v_str_label);
		}

		$arr_label = array();
		foreach ($v_str_label_tmp as $token) {
			$str_label_token = "";
			$contador = strlen($token);
			for ($it = 0; $it < $contador; $it++) {
				if ($it == 0) {
					$str_label_token .= $token[$it];
				} else {
					//checa se a letra eh maiuscula
					//e ai checa se a anterior eh maiscula(nome propprio, ID, RG ...)
					if (strtoupper($token[$it]) == $token[$it] && isset($token[$it - 1]) && strtoupper($token[$it - 1]) == $token[$it - 1]) {
						$str_label_token .= $token[$it];
					} //checa se a letra eh maiuscula e anterior minuscula
					elseif (strtoupper($token[$it]) == $token[$it] && isset($token[$it - 1]) && strtolower($token[$it - 1]) == $token[$it - 1]) {
						//empilha o token
						$arr_label[] = $str_label_token;

						//inicializa novamente o token
						$str_label_token = $token[$it];
					} //checa se a letra eh minuscula
					elseif (strtolower($token[$it]) == $token[$it]) {
						//checa se as anteriores eram todas maiusculas para pegar a ultima maiuscula(ex: tipoRGCode, deveria ser Tipo RG Code ao invez de Tipo RGCode)
						if (isset($token[$it - 1]) && strtoupper($token[$it - 1]) == $token[$it - 1] && isset($token[$it - 2]) && strtoupper($token[$it - 2]) == $token[$it - 2]) {
							//tira o ultimo caracter pra colocar no nove token
							$str_label_token = substr($str_label_token, 0, -1);

							//empilha o token
							$arr_label[] = $str_label_token;

							//inicializa com a ultima maiuscula
							$str_label_token = $token[$it - 1];
						}

						$str_label_token .= $token[$it];
					}
				}
			}

			//restou algo no token, provavelmente a ultima palavra e chegou no fim do for
			if (!empty($str_label_token)) {
				$arr_label[] = $str_label_token;
			}
		}

		$v_str_label_return = "";
		//capitula as palavras
		foreach ($arr_label as $token) {
			//se for todo maiusculo nao faz nada, so faz se tiver caracter minusculo
			if (strtoupper($token) != $token) {
				$token = strtolower($token);
				$token[0] = strtoupper($token[0]);
			}

			$v_str_label_return .= $token . " ";
		}

		$v_str_label_return = trim($v_str_label_return);
	}

	return $v_str_label_return;
}

function getDebugBacktrace($str_nl = "<BR>")
{
	var_dump(debug_backtrace());
	$dbgTrace = debug_backtrace();
	$dbgMsg = "";
	if (!empty($dbgTrace)) {
		$dbgMsg .= $str_nl . "Debug backtrace begin:" . $str_nl;

		foreach ($dbgTrace as $dbgIndex => $dbgInfo) {
			$dbgMsg .= "\t at $dbgIndex  " . $dbgInfo['file'] . " (line {$dbgInfo['line']}) -> {$dbgInfo['function']}(" . join(",", $dbgInfo['args']) . ")" . $str_nl;
		}
		$dbgMsg .= "Debug backtrace end" . $str_nl;
	}

	return $dbgMsg;
}

function nm_menu_list()
{
	$_arr_mod = array('scriptcase', 'sys', 'grp', 'usr');
	$arr_schemas = array();
	foreach($_arr_mod as $mod)
	{
		$str_path = getPathSchemas($mod);
		if(is_dir($str_path))
        {
            $arr_themas = @scandir($str_path);
            if(is_array($arr_themas) && !empty($arr_themas))
            {
                $arr_schemas[$mod] = array_diff($arr_themas, array(".", ".."));
            }
        }
	}
	return $arr_schemas;
}

function getChartListPrj()
{
	$arr_return = array();

	//Listar todos os arquivos encontrados na pasta
	$arr_return = nm_chart_list();

	return $arr_return;
}

//grupos de css para formar o nome da tag
function getCssFirstGroup()
{
	$arr_css = array();
	$arr_css[] = 'css_schema';
	$arr_css[] = 'css_tabbed';
	$arr_css[] = 'css_grid';
	$arr_css[] = 'css_form';
	$arr_css[] = 'css_filter';
	$arr_css[] = 'css_menu';
	$arr_css[] = 'css_menunew';
	$arr_css[] = 'css_menutree';
	$arr_css[] = 'css_fielderror';
	$arr_css[] = 'css_error';
	$arr_css[] = 'css_message';
	$arr_css[] = 'css_sweetalert';
	$arr_css[] = 'css_toast';
	$arr_css[] = 'css_container';
	$arr_css[] = 'css_ajax';
	$arr_css[] = 'css_ajaxac';
	$arr_css[] = 'css_calendar';
	$arr_css[] = 'css_help';
	$arr_css[] = 'css_export';
	$arr_css[] = 'css_exportemail';
	$arr_css[] = 'css_groupbutton';
	$arr_css[] = 'css_progressbar';
	$arr_css[] = 'css_appdiv';
	$arr_css[] = 'css_others';
	$arr_css[] = 'css_refinedsearch';
	$arr_css[] = 'css_contextmenu';
	$arr_css[] = 'css_menutab';
	$arr_css[] = 'css_summarysearch';
	$arr_css[] = 'css_quicksearchdiv';

	return $arr_css;
}

//grupos de css para formar o nome da tag
function getCssSecondGroup()
{
	$arr_css = array();

	//o indice menor tem q sempre estar abaixo do indice maior caso incida alguma parte do nome
	$arr_css[] = 'active';
	$arr_css[] = 'bloco';
	$arr_css[] = 'bpassfld';
	$arr_css[] = 'breadcrumbitemhover';
	$arr_css[] = 'breadcrumbitem';
	$arr_css[] = 'breadcrumbline';
	$arr_css[] = 'btnclean';
	$arr_css[] = 'campo_impar_vert';
	$arr_css[] = 'campo_impar_highlight';
	$arr_css[] = 'campo_impar_multiplas';
	$arr_css[] = 'campo_impar_simples';
	$arr_css[] = 'campo_impar';
	$arr_css[] = 'campo_par_vert';
	$arr_css[] = 'campo_par_highlight';
	$arr_css[] = 'campo_par_multiplas';
	$arr_css[] = 'campo_par_simples';
	$arr_css[] = 'campo_par';
	$arr_css[] = 'campotag_impar_multiplas';
	$arr_css[] = 'campotag_impar_simples';
	$arr_css[] = 'campohelp_impar_multiplas';
	$arr_css[] = 'campohelp_impar_simples';
	$arr_css[] = 'campohover';
	$arr_css[] = 'campoactive';
	$arr_css[] = 'campo';
	$arr_css[] = 'captcha';
	$arr_css[] = 'categorytitle';
	$arr_css[] = 'categorymoldura';
	$arr_css[] = 'categoryitemsmoldura';
	$arr_css[] = 'categoryitemactive';
	$arr_css[] = 'categoryitem';
	$arr_css[] = 'closeicon';
	$arr_css[] = 'closeiconhover';
	$arr_css[] = 'tabscroll';
	$arr_css[] = 'collapsemo';
	$arr_css[] = 'collapse';
	$arr_css[] = 'container';
	$arr_css[] = 'content';
	$arr_css[] = 'disabled';
	$arr_css[] = 'divselecionarcampos';
	$arr_css[] = 'divselecionarcamposcampoenable';
	$arr_css[] = 'divselecionarcamposcampodisable';
	$arr_css[] = 'divselecionarcamposboxenable';
	$arr_css[] = 'divselecionarcamposboxdisable';
	$arr_css[] = 'divselecionarcamposplaceholder';
	$arr_css[] = 'div';
	$arr_css[] = 'dragndrop';
	$arr_css[] = 'dropdown';
	$arr_css[] = 'dropdownitem';
	$arr_css[] = 'dropdownitemover';
	$arr_css[] = 'dropdownitemselected';
	$arr_css[] = 'switch_input';
	$arr_css[] = 'switch_toggle';
	$arr_css[] = 'switch_on';
	$arr_css[] = 'switch_radio_input';
	$arr_css[] = 'switch_radio_toggle';
	$arr_css[] = 'switch_radio_on';
//	$arr_css[] = 'switch_off';
//	$arr_css[] = 'slide';
//	$arr_css[] = 'range';
	$arr_css[] = 'events_past';
	$arr_css[] = 'events_onday';
	$arr_css[] = 'events_future';
	$arr_css[] = 'expandmo';
	$arr_css[] = 'expand';
	$arr_css[] = 'footer';
	$arr_css[] = 'graph';
	$arr_css[] = 'header';
	$arr_css[] = 'help_impar_simples';
	$arr_css[] = 'help_impar_multiplas';
	$arr_css[] = 'help_impar_hover_multiplas';
    $arr_css[] = 'highlight_impar_simples';
    $arr_css[] = 'highlight_impar_multiplas';
	$arr_css[] = 'icon';
	$arr_css[] = 'iframe';
	$arr_css[] = 'indexmoldura';
	$arr_css[] = 'indextitle';
	$arr_css[] = 'indexdimension';
    $arr_css[] = 'indexmetricneg';
    $arr_css[] = 'indexmetricneu';
    $arr_css[] = 'indexmetricpos';
    $arr_css[] = 'indexmoldura';
    $arr_css[] = 'indexnegicon';
    $arr_css[] = 'indexnegtext';
    $arr_css[] = 'indexneuicon';
    $arr_css[] = 'indexneutext';
    $arr_css[] = 'indexposicon';
    $arr_css[] = 'indexpostext';
    $arr_css[] = 'indextitle';
	$arr_css[] = 'inactive';
	$arr_css[] = 'info';
	$arr_css[] = 'item_barhover';
	$arr_css[] = 'item_bardisabled';
	$arr_css[] = 'item_bar';
	$arr_css[] = 'item_sel';
	$arr_css[] = 'item_hover';
	$arr_css[] = 'item_selected';
	$arr_css[] = 'itemhover';
	$arr_css[] = 'item';
	$arr_css[] = 'label_vert';
	$arr_css[] = 'label_impar_hover_multiplas';
	$arr_css[] = 'label_impar_multiplas';
	$arr_css[] = 'label_impar_simples';
	$arr_css[] = 'label_impar';
	$arr_css[] = 'label_par_hover_multiplas';
	$arr_css[] = 'label_par_multiplas';
	$arr_css[] = 'label_par_simples';
	$arr_css[] = 'label_par';
	$arr_css[] = 'label_hover';
	$arr_css[] = 'labelclean';
	$arr_css[] = 'label';
	$arr_css[] = 'line_control';
	$arr_css[] = 'line';
	$arr_css[] = 'linha_impar';
	$arr_css[] = 'linha_par';
	$arr_css[] = 'linkactive';
	$arr_css[] = 'linkinactivehover';
	$arr_css[] = 'linkinactive';
	$arr_css[] = 'loading';
	$arr_css[] = 'multiselectselectall';
	$arr_css[] = 'multiselectsearch';
	$arr_css[] = 'multiselectlineselected';
	$arr_css[] = 'multiselectline';
    $arr_css[] = 'multiselectinput';
	$arr_css[] = 'multiselectdiv';
	$arr_css[] = 'multiselectcheckboxunchecked';
	$arr_css[] = 'multiselectcheckboxchecked';
	$arr_css[] = 'multiselectbuttonok';
	$arr_css[] = 'multiselectbuttonline';
	$arr_css[] = 'multiselectbuttoncancel';
	$arr_css[] = 'menuarea';
	$arr_css[] = 'menu_barhover';
	$arr_css[] = 'menu_bardisabled';
	$arr_css[] = 'menu_bar';
	$arr_css[] = 'menu_selhover';
	$arr_css[] = 'menu_seldisabled';
	$arr_css[] = 'menu_sel';
	$arr_css[] = 'modal';
	$arr_css[] = 'molduraresult';
	$arr_css[] = 'moldurapagina';
	$arr_css[] = 'moldura';
	$arr_css[] = 'monthdays';
	$arr_css[] = 'mouseclick';
	$arr_css[] = 'mouseover';

	//calendar_diogo
	$arr_css[] = 'minigridselectedday';
	$arr_css[] = 'minigridmonthdays';
	$arr_css[] = 'minigridweekdays';

	$arr_css[] = 'msg';
	$arr_css[] = 'objetodisabled_impar_multiplas';
	$arr_css[] = 'objetodisabled_impar_simples';
	$arr_css[] = 'objetoerror_impar_multiplas';
	$arr_css[] = 'objetoerror_impar_simples';
	$arr_css[] = 'objetoerror_impar';
	$arr_css[] = 'objetofocus_impar_multiplas';
	$arr_css[] = 'objetofocus_impar_simples';
	$arr_css[] = 'objetofocus_impar';
	$arr_css[] = 'objetofocus_par_multiplas';
	$arr_css[] = 'objetofocus_par_simples';
	$arr_css[] = 'objetofocus_par';
	$arr_css[] = 'objeto_impar_multiplas';
	$arr_css[] = 'objeto_impar_simples';
	$arr_css[] = 'objeto_impar';
	$arr_css[] = 'objeto_par_multiplas';
	$arr_css[] = 'objeto_par_simples';
	$arr_css[] = 'objeto_par';
	$arr_css[] = 'objeto';
	$arr_css[] = 'pagina';
	$arr_css[] = 'pgloaded';
	$arr_css[] = 'pgloading';
	$arr_css[] = 'pg';
	$arr_css[] = 'print_date';
	$arr_css[] = 'print_time';
	$arr_css[] = 'print_event';
	$arr_css[] = 'quantidade';
	$arr_css[] = 'rangevalues';
	$arr_css[] = 'rangeselected';
	$arr_css[] = 'rangeline';
	$arr_css[] = 'rangebuttonsnormal';
	$arr_css[] = 'rangebuttonshover';
	$arr_css[] = 'rangebuttonsactive';
	$arr_css[] = 'required_impar_multiplas';
	$arr_css[] = 'required_impar_simples';
	$arr_css[] = 'required_impar';
	$arr_css[] = 'required_par_multiplas';
	$arr_css[] = 'required_par_simples';
	$arr_css[] = 'required_par';
	$arr_css[] = 'result';
	$arr_css[] = 'resulttag';
	$arr_css[] = 'resume_count';
	$arr_css[] = 'resume_clickedline';
	$arr_css[] = 'resume_clickedquebrainvisivel';
	$arr_css[] = 'resume_clickedquebravisivel';
	$arr_css[] = 'resume_clickedsubtotal';
	$arr_css[] = 'resume_clickedtotal';
	$arr_css[] = 'resume_hoverlabel';
	$arr_css[] = 'resume_hoverline';
	$arr_css[] = 'resume_hoverquebrainvisivel';
	$arr_css[] = 'resume_hoverquebravisivel';
	$arr_css[] = 'resume_hoversubtotal';
	$arr_css[] = 'resume_hovertotal';
	$arr_css[] = 'resume_label';
	$arr_css[] = 'resume_linhaimpar';
	$arr_css[] = 'resume_linhapar';
	$arr_css[] = 'resume_quebrainvisivel';
	$arr_css[] = 'resume_quebravisivel';
	$arr_css[] = 'resume_subtotal';
	$arr_css[] = 'resume_total';
	$arr_css[] = 'selectedday';
	$arr_css[] = 'smry';
	$arr_css[] = 'subtotal';
	$arr_css[] = 'subline';
	$arr_css[] = 'start';
	$arr_css[] = 'tableapls';
	$arr_css[] = 'table';
	$arr_css[] = 'tablejs';
	$arr_css[] = 'tablecss';
	$arr_css[] = 'tagsclose';
	$arr_css[] = 'tagsclosehover';
	$arr_css[] = 'tagsfilter';
	$arr_css[] = 'tagsfilteraddlabel';
	$arr_css[] = 'tagsfilteraddlabeldisabled';
	$arr_css[] = 'tagsfilterlabel';
	$arr_css[] = 'tagsfilterlabelclean';
	$arr_css[] = 'tagsfilterlabelcleanhover';
	$arr_css[] = 'tagsfilterline';
	$arr_css[] = 'tagsfiltertoolbar';
	$arr_css[] = 'tagsicon';
	$arr_css[] = 'tagsiconcol';
	$arr_css[] = 'tagsiconexp';
	$arr_css[] = 'tagsitemclean';
	$arr_css[] = 'tagsitemcleanhover';
	$arr_css[] = 'tagsitemitem';
	$arr_css[] = 'tagsitemlabel';
	$arr_css[] = 'tagsitemlist';
	$arr_css[] = 'tagsline';
	$arr_css[] = 'tagssavegrid';
	$arr_css[] = 'title';
	$arr_css[] = 'toolbarnavopen';
	$arr_css[] = 'toolbarnav';
	$arr_css[] = 'toolbarinputfocus';
	$arr_css[] = 'toolbarinput';
	$arr_css[] = 'toolbar';
	$arr_css[] = 'total';
	$arr_css[] = 'toggle';
	$arr_css[] = 'upload';
	$arr_css[] = 'vejamais';
    $arr_css[] = 'wizardnav_stepnow_moldura';
    $arr_css[] = 'wizardnav_stepnow_title';
    $arr_css[] = 'wizardnav_stepnow_desc';
    $arr_css[] = 'wizardnav_stepnextothers_moldura';
    $arr_css[] = 'wizardnav_stepnextothers_title';
    $arr_css[] = 'wizardnav_stepnextothers_desc';
    $arr_css[] = 'wizardnav_stepnext_moldura';
    $arr_css[] = 'wizardnav_stepnext_title';
    $arr_css[] = 'wizardnav_stepnext_desc';
    $arr_css[] = 'wizardnav_stepdone_moldura';
    $arr_css[] = 'wizardnav_stepdone_title';
    $arr_css[] = 'wizardnav_stepdone_desc';
    $arr_css[] = 'wizardnav_moldura';
	$arr_css[] = 'weekdays';

	return $arr_css;
}

function getChartGroupOne()
{
	$arr_chart = array();
	$arr_chart[] = 'chart_settings';
	$arr_chart[] = 'chart_margin';
	$arr_chart[] = 'chart_background';
	$arr_chart[] = 'chart_font';
	$arr_chart[] = 'chart_border';
	$arr_chart[] = 'chart_shadow';
	$arr_chart[] = 'chart_others';

	return $arr_chart;
}

function getChartGroupTwo()
{
	$arr_chart = array();
	$arr_chart[] = 'mod';
	$arr_chart[] = 'name';
	$arr_chart[] = 'type';
	$arr_chart[] = 'top';
	$arr_chart[] = 'right';
	$arr_chart[] = 'bottom';
	$arr_chart[] = 'left';
	$arr_chart[] = 'canvas';
	$arr_chart[] = 'value';
	$arr_chart[] = 'color';
	$arr_chart[] = 'num_lines';
	$arr_chart[] = 'div_lin_color';
	$arr_chart[] = 'pallete_theme';
	$arr_chart[] = 'pallete_color';
	$arr_chart[] = 'font_color';
	$arr_chart[] = 'font_size';
	$arr_chart[] = 'show_border';
	$arr_chart[] = 'thickness';
	$arr_chart[] = 'border_dashed';
	$arr_chart[] = 'show';
	$arr_chart[] = '3d_lighting';
	$arr_chart[] = 'menu_export';

	return $arr_chart;
}

function unProtectAjaxCharRec($str_field)
{
	if(is_array($str_field))
	{
		foreach($str_field as $_k => $_v)
		{
			unset($str_field[ $_k ]);

			if(is_array($_v))
			{
				$str_field[ unProtectAjaxChar($_k) ] = unProtectAjaxCharRec($_v);
			}
			else
			{
				$str_field[ unProtectAjaxChar($_k) ] = unProtectAjaxChar($_v);
			}
		}
	}
	else
	{
		$str_field = unProtectAjaxChar($str_field);
	}

	return $str_field;
}

function get_nm_zend_licence_check()
{
	return true;
}

function FormatTimer($v_str_time)
{
	$int_hor = 0;
	$int_min = 0;
	// Formata tempo
	$arr_tmp_list_change = explode('.', sprintf('%.2f', $v_str_time));
	list($int_sec, $int_msec) = $arr_tmp_list_change;
	if (60 < $int_sec) {
		$int_min = floor($int_sec / 60);
		$int_sec = $int_sec - ($int_min * 60);
	}
	if (60 < $int_min) {
		$int_hor = floor($int_min / 60);
		$int_min = $int_min - ($int_hor * 60);
	}

	$int_sec = str_repeat('0', 2 - strlen($int_sec)) . $int_sec;
	$int_min = str_repeat('0', 2 - strlen($int_min)) . $int_min;
	return $int_hor . ':' . $int_min . ':' . $int_sec . ',' . $int_msec;
} // FormatTimer

  function nm_menu_remove_item($id)
  {
	  echo <<<EOT
		<script>nm_menu_remove_item('{$id}', {$_SESSION['nm_session']['control_abas']['frm_atual']});</script>
EOT;
  }

function nm_menu_add_item($data)
{
	$data = json_encode($data);
	echo <<<EOT
		<script>nm_menu_add_item({$_SESSION['nm_session']['control_abas']['frm_atual']}, {$data});</script>

EOT;
}
function nm_menu_select_item($id, $dont_bind = false)
{
	$dont_bind = $dont_bind ? 'true' : 'false';
	echo <<<EOT
		<script>nm_menu_select_item('{$id}', {$_SESSION['nm_session']['control_abas']['frm_atual']}, {$dont_bind});</script>
EOT;
}

function nm_menu_remove_all_childs($id, $avoid = '')
{
	echo <<<EOT
		<script>
			var obj = getJstree({$_SESSION['nm_session']['control_abas']['frm_atual']});
			var childs = obj.get_node('{$id}').children;
			for(i = childs.length; i != -1; i--)
			{
				if(childs[i] != '{$avoid}')
				{
					obj.delete_node(childs[i]);
				}
			}
		</script>
EOT;
}

function nm_menu_change_item($data)
{
	$id = $data['id'];
	$data = json_encode($data);
	echo <<<EOT
		<script>
			var data = {$data};
			var obj = getJstree({$_SESSION['nm_session']['control_abas']['frm_atual']});
			var childs = obj.get_node(obj.get_node('{$id}').parent).children;
			for(i = 0; i <= childs.length; i++)
			{
				if(childs[i] == '{$id}')
				{
					break;
				}
			}
			i = i == 0? 'first' : i;
			data.pos = i;

			nm_menu_remove_item('{$id}', {$_SESSION['nm_session']['control_abas']['frm_atual']});
			nm_menu_add_item({$_SESSION['nm_session']['control_abas']['frm_atual']}, data);
		</script>
EOT;
}

function nm_menu_deselect()
{
	echo <<<EOT
		<script>
			var obj = getJstree({$_SESSION['nm_session']['control_abas']['frm_atual']});
			obj.deselect_all(true);
		</script>
EOT;


}

function nm_change_item_treemenu($str_key, $str_parent, $str_title,
								 $str_href = '', $str_img = '',$selected = false, $opened=''){


	$arr = nm_add_item_treemenu($str_key, $str_parent, $str_title,
		$str_href, $str_img, false,'', $selected, $opened);

	nm_menu_change_item($arr);
}

function nm_serialize_fld_name(&$r_str_fld_name, &$r_arr_fld_name)
{
	if (!in_array($r_str_fld_name, $r_arr_fld_name))
	{
		$r_arr_fld_name[] = $r_str_fld_name;
	}
	else
	{
		$int_count = 1;
		while (1)
		{
			$str_new_name = $r_str_fld_name . '_' . $int_count;
			if (!in_array($str_new_name, $r_arr_fld_name))
			{
				$r_str_fld_name   = $str_new_name;
				$r_arr_fld_name[] = $r_str_fld_name;
				break;
			}
			$int_count++;
		}
	}
}

function nm_sec_has_priv($priv, $user = '')
{
	return nm_sec_get_priv($priv, $user) == 'S';
}

function parseOldContainerToBootstrap($arr_containers, $qtd_grid_x = 12)
{
	$arr_new_container = array();

	if(is_array($arr_containers) && !empty($arr_containers))
	{
		//box do gridstack tem 75x60
		$max_x = 0;
		foreach($arr_containers as $row => $arr_row)
		{
			if(substr($arr_row['width'], -1) == '%')
			{
				$qtd_grid_width_x = (12*(substr($arr_row['width'], 0, -1)))/100;
			}
			else
			{
				if(substr($arr_row['width'], 0,-2) == 'px')
				{
					$arr_row['width'] = substr($arr_row['width'], 0, -2);
				}
				$qtd_grid_width_x = $arr_row['width']/75;
			}

			$qtd_grid_width_x = ceil($qtd_grid_width_x);

			//retira de rows disponiveis
			if($qtd_grid_x >= $qtd_grid_width_x)
			{
				$qtd_grid_x =  $qtd_grid_x - $qtd_grid_width_x;
			}
			elseif($qtd_grid_x > 0)
			{
				$qtd_grid_width_x = $qtd_grid_x;
				$qtd_grid_x = 0;
			}
			else
			{
				//nao entra
				$qtd_grid_width_x = 0;
			}

			if(isset($arr_row['widgets']) && !empty($arr_row['widgets']))
			{
				$max_y = 0;
				foreach($arr_row['widgets'] as $id => $arr_widget)
				{
					$qtd_grid_width_y = $arr_widget['height'];
					if(substr($qtd_grid_width_y, -2) == 'px')
					{
						$qtd_grid_width_y = substr($qtd_grid_width_y, 0, -2);
					}
                    if(empty($qtd_grid_width_y))
                    {
                        $qtd_grid_width_y = 0;
                    }

					$qtd_grid_width_y = ceil($qtd_grid_width_y/60);

					$arr_new_container[] = array(
									'x'                   => $max_x,
									'y'                   => $max_y,
									'width'               => $qtd_grid_width_x,
									'height'              => $qtd_grid_width_y,
									'widgetid'            => $id,
									'widgettype'          => ($arr_widget['widgettype'] = '') ? 'link' : $arr_widget['widgettype'],
									'title'               => $arr_widget['title'],
									'link'                => $arr_widget['link'],
									'reload'              => $arr_widget['reload_time'],
									'show_header'         => isset($arr_widget['show_title'])   ? "Y" : "",
									'maximize'            => isset($arr_widget['maximizable'])  ? "Y" : "",
									'removeable'          => isset($arr_widget['removable'])    ? "Y" : "",
									'moveable'            => isset($arr_widget['movable'])      ? "Y" : "",
									'collapsible'         => isset($arr_widget['collapsible'])  ? "Y" : "",
                                    'compact_mode'        => isset($arr_widget['compact_mode']) ? "Y" : "",
                                    'remove_margin'       => isset($arr_widget['remove_margin']) ? "N" : "",
                                    'remove_border'       => isset($arr_widget['remove_border']) && $arr_widget['remove_border'] ? 'Y' : "N",
									'idx_connection'      => isset($arr_widget['idx_connection'])      ? $arr_widget['idx_connection']      : "",
									'idx_table'           => isset($arr_widget['idx_table'])           ? $arr_widget['idx_table']           : "",
									'idx_metric_field'    => isset($arr_widget['idx_metric_field'])    ? $arr_widget['idx_metric_field']    : "",
									'idx_metric_meta'     => isset($arr_widget['idx_metric_meta'])     ? $arr_widget['idx_metric_meta']     : "",
									'idx_metric_sql'      => isset($arr_widget['idx_metric_sql'])      ? $arr_widget['idx_metric_sql']      : "",
									'idx_metric_function' => isset($arr_widget['idx_metric_function']) ? $arr_widget['idx_metric_function'] : "",
									'idx_metric_display'  => isset($arr_widget['idx_metric_display'])  ? $arr_widget['idx_metric_display']  : "perc",
									'idx_period_field'    => isset($arr_widget['idx_period_field'])    ? $arr_widget['idx_period_field']    : "",
									'idx_period_meta'     => isset($arr_widget['idx_period_meta'])     ? $arr_widget['idx_period_meta']     : "",
									'idx_period_sql'      => isset($arr_widget['idx_period_sql'])      ? $arr_widget['idx_period_sql']      : "",
									'idx_period_function' => isset($arr_widget['idx_period_function']) ? $arr_widget['idx_period_function'] : "",
									);
					$max_y = $max_y + $qtd_grid_width_y;
				}
			}
			$max_x += $qtd_grid_width_x;
		}
	}
	return $arr_new_container;
}

function getRuleFields($rule_fields)
{
	$arr_fields  = array();
	if(!empty($rule_fields))
	{
		$rule_fields = explode('_@NM@_', $rule_fields);
		if(is_array($rule_fields) && !empty($rule_fields))
		{
			foreach($rule_fields as $rule_group_field)
			{
				if(!empty($rule_group_field))
				{
					$fields = explode('_#NM#_', $rule_group_field);
					if(is_array($fields) && !empty($fields))
					{
						list($seq, $field, $cont)  = explode('__NM__', $fields[0]);//campo
						unset($fields[0]);

						$arr_fields[ $cont ]['field'] = $field;
						$arr_fields[ $cont ]['seq']   = $seq;

						$arr_cont = count($fields);
						for($it=0; $it<$arr_cont; $it++)
						{
							if(isset($fields[$it]))
							{
								$opcao = $fields[$it];
								if($fields[$it] == 'start' || $fields[$it] == 'axis')
								{
									unset($fields[$it]);
									if(isset($fields[$it + 1]))
									{
										$arr_fields[ $cont ][ $opcao ] = $fields[$it + 1];
										unset($fields[$it + 1]);
									}
								}
								elseif($fields[$it] == 'data' || $fields[$it] == 'option')
								{
									unset($fields[$it]);
									if(isset($fields[$it + 1]))
									{
										$arr_fields[ $cont ][ $opcao ] = array_values($fields);
										break;
									}
								}
							}
						}
					}
				}
			}
		}
	}
	return $arr_fields;
}

function getGroupByFunctions()
{
    $arr_num_values = array();
    $arr_num_values['sum']  = array("title" => nm_get_text_lang("['button_sum_sum']"), "display_selected" => nm_get_text_lang("['button_sum_display_sum']"), "example" => "");
    $arr_num_values['max']  = array("title" => nm_get_text_lang("['button_sum_max']"), "display_selected" => nm_get_text_lang("['button_sum_display_max']"), "example" => "");
    $arr_num_values['min']  = array("title" => nm_get_text_lang("['button_sum_min']"), "display_selected" => nm_get_text_lang("['button_sum_display_min']"), "example" => "");
    $arr_num_values['avg']  = array("title" => nm_get_text_lang("['button_sum_avg']"), "display_selected" => nm_get_text_lang("['button_sum_display_avg']"), "example" => "");
    $arr_num_values['var']  = array("title" => nm_get_text_lang("['button_sum_var']"), "display_selected" => nm_get_text_lang("['button_sum_display_var']"), "example" => "");
    $arr_num_values['pad']  = array("title" => nm_get_text_lang("['button_sum_pad']"), "display_selected" => nm_get_text_lang("['button_sum_display_pad']"), "example" => "");
    if($_SESSION['nm_session']['app']['type'] != NM_APP_TYPE_CHART)
    {
        $arr_num_values['wei']  = array("title" => nm_get_text_lang("['button_sum_wei']"), "display_selected" => nm_get_text_lang("['button_sum_display_wei']"), "example" => "");
    }

    $arr_num_values['cnt'] = array("title" => nm_get_text_lang("['button_sum_cnt']"), "display_selected" => nm_get_text_lang("['button_sum_display_cnt']"), "example" => "");
    $arr_num_values['dct'] = array("title" => nm_get_text_lang("['button_sum_dct']"), "display_selected" => nm_get_text_lang("['button_sum_display_dct']"), "example" => "");

    return $arr_num_values;
}

function nm_get_extenal_libraries_options()
{
    $arr_libs = nm_get_extenal_libraries();
    $str_libs = "";

    foreach ($arr_libs as $type => $lib) {
        $str_libs_part = "<optgroup label='" . nm_get_text_lang("['mod_" . $type . "']") . "'>";
        $has_item = false;
        foreach ($lib as $l => $data) {
            $nbsp = "&nbsp;&nbsp;&nbsp;";
            $str_libs_part .= "<optgroup label='" . $nbsp . $l . "'>";
            foreach ($data as $d) {
                $_arr = explode('.', $d);
                if (!in_array(end($_arr), array('html', 'htm'))) continue;
                //$nbsp = "&nbsp;&nbsp;";
                $str_libs_part .= "<option value='" . $type . "__NM__" . $l . "__NM__" . $d . "'>" . $nbsp . $d . "</option>";
                $has_item = true;
            }
            $str_libs_part .= "</optgroup>";
        }
        $str_libs_part .= "</optgroup>";
        if ($has_item) {
            $str_libs .= $str_libs_part;
        }
    }
    return $str_libs;
}

function nm_get_files_recursive($path, $master_path)
{
    if(!is_dir( $path )) return [];
    $arr_files = array_diff(scandir($path), array('.','..'));
    $arr_return = array();
    if(count($arr_files) == 0) return $arr_return;

    foreach($arr_files as $file)
    {
        if(is_dir($path.'/'.$file))
        {
            $arr_return = array_merge($arr_return, nm_get_files_recursive($path.'/'.$file, $master_path));
        }
        else
        {
            $arr_return[] = strtr($path.'/'.$file, array($master_path => ''));
        }

    }
    return $arr_return;
}

function getRelativeOptions()
{
	$arr_filter_relative = array();

	$arr_filter_relative['YYYY'][] = 'current_year_today';
	$arr_filter_relative['YYYY'][] = 'current_year';
	$arr_filter_relative['YYYY'][] = 'last_year';
	$arr_filter_relative['YYYY'][] = 'next_year';
	$arr_filter_relative['QUARTER'][] = 'current_quarter_today';
	$arr_filter_relative['QUARTER'][] = 'current_quarter';
	$arr_filter_relative['QUARTER'][] = 'last_quarter';
	$arr_filter_relative['QUARTER'][] = 'next_quarter';
	$arr_filter_relative['MM'][] = 'este_mes_full';
	$arr_filter_relative['MM'][] = 'este_mes';
	$arr_filter_relative['MM'][] = 'ult_mes';
	$arr_filter_relative['MM'][] = 'prox_mes';
	$arr_filter_relative['MM'][] = 'last_3_months';
	$arr_filter_relative['MM'][] = 'last_3_months_current';
	$arr_filter_relative['MM'][] = 'last_3_months_today';
	$arr_filter_relative['MM'][] = 'next_3_months';
	$arr_filter_relative['MM'][] = 'next_3_months_current';
	$arr_filter_relative['MM'][] = 'next_3_months_today';
	$arr_filter_relative['MM'][] = 'last_6_months';
	$arr_filter_relative['MM'][] = 'next_6_months';
	$arr_filter_relative['MM'][] = 'last_12_months';
	$arr_filter_relative['MM'][] = 'next_12_months';
	$arr_filter_relative['MM'][] = 'last_18_months';
	$arr_filter_relative['MM'][] = 'next_18_months';
	$arr_filter_relative['MM'][] = 'last_24_months';
	$arr_filter_relative['MM'][] = 'next_24_months';
	$arr_filter_relative['WEEK'][] = 'current_week_today';
	$arr_filter_relative['WEEK'][] = 'current_week';
	$arr_filter_relative['WEEK'][] = 'last_week';
	$arr_filter_relative['WEEK'][] = 'next_week';
	$arr_filter_relative['WEEK'][] = 'prox_sem_seg_sex';
	$arr_filter_relative['WEEK'][] = 'prox_sem_seg_dom';
	$arr_filter_relative['WEEK'][] = 'sem_pas_seg_dom';
	$arr_filter_relative['WEEK'][] = 'ult_sem_com_seg_sex';
	$arr_filter_relative['DD'][] = 'hoje';
	$arr_filter_relative['DD'][] = 'ontem';
	$arr_filter_relative['DD'][] = 'amanha';
	$arr_filter_relative['DD'][] = 'ult_7_dias';
	$arr_filter_relative['DD'][] = 'prox_7_dias';
	$arr_filter_relative['DD'][] = 'prox_30_dias';
	$arr_filter_relative['DD'][] = 'last_30_dias';
	$arr_filter_relative['DD'][] = 'last_30_today';
	$arr_filter_relative['HH'][] = 'last_1hr';
	$arr_filter_relative['HH'][] = 'next_1hr';
	$arr_filter_relative['HH'][] = 'last_6hr';
	$arr_filter_relative['HH'][] = 'next_6hr';
	$arr_filter_relative['HH'][] = 'last_12hr';
	$arr_filter_relative['HH'][] = 'next_12hr';
	$arr_filter_relative['HH'][] = 'last_24hr';
	$arr_filter_relative['HH'][] = 'next_24hr';
	$arr_filter_relative['EXTRA'][] = 'todo_periodo';

	return $arr_filter_relative;
}

function getTooltipLinkHelp($drive)
{
	$str_return  = "";
	switch(nm_db_type($drive))
	{
		case 'mysql':
			if(PHP_VERSION >= "7.0.20")
			{
				$str_return = "https://help.scriptcase.net/portal/en/kb/articles/how-to-connect-to-mysql-8-0";

				if (isset($_SESSION['nm_session']['status']['lang'])) {
					switch (strtolower($_SESSION['nm_session']['status']['lang'])) {
						case 'pt_br':
							$str_return = 'https://help.scriptcase.net/portal/pt/kb/articles/como-conectar-com-o-mysql-8-0';
							break;
						case 'es_es':
							$str_return = 'https://help.scriptcase.net/portal/es/kb/articles/como-conectarse-a-mysql-8-0';
							break;

						default:
							$str_return = 'https://help.scriptcase.net/portal/en/kb/articles/how-to-connect-to-mysql-8-0';
							break;
					}
				}
			}
			else
			{
				$str_return = "https://help.scriptcase.net/portal/en/kb/articles/updating-php";

				if (isset($_SESSION['nm_session']['status']['lang'])) {
					switch (strtolower($_SESSION['nm_session']['status']['lang'])) {
						case 'pt_br':
							$str_return = 'https://help.scriptcase.net/portal/pt/kb/articles/atualizacao-do-php';
							break;
						case 'es_es':
							$str_return = 'https://help.scriptcase.net/portal/es/kb/articles/actualizando-el-php';
							break;

						default:
							$str_return = 'https://help.scriptcase.net/portal/en/kb/articles/updating-php';
							break;
					}
				}
			}
		break;
		case 'pdo_dblib':
		case 'pdo_sybase_dblib':
            if (version_compare(phpversion(), "8.0.0", ">="))
			{
				$str_return = "https://help.scriptcase.net/portal/en/kb/articles/how-to-connect-to-mysql-8-0";

				if (isset($_SESSION['nm_session']['status']['lang'])) {
					switch (strtolower($_SESSION['nm_session']['status']['lang'])) {
						case 'pt_br':
							$str_return = 'https://help.scriptcase.net/portal/pt/kb/articles/como-conectar-com-o-mysql-8-0';
							break;
						case 'es_es':
							$str_return = 'https://help.scriptcase.net/portal/es/kb/articles/como-conectarse-a-mysql-8-0';
							break;

						default:
							$str_return = 'https://help.scriptcase.net/portal/en/kb/articles/how-to-connect-to-mysql-8-0';
							break;
					}
				}
			}
		break;
	}
    return $str_return;
}

function is64()
{
	return (strstr(php_uname("m"), '64') == '64');
}

if (!function_exists('is_countable')) {
    function is_countable($var) {
        return (is_array($var) || $var instanceof Countable);
    }
}

function nm_parse_size($size) {
    $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
    $size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
    if ($unit) {
        // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
        return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
    }
    else {
        return round($size);
    }
}

function getArrBtnList($apl)
{
    $arr_btns = [];
    switch ($apl)
    {
        case 'cons':
            $arr_btns['idx_tbar_grid_navigate'] = nm_get_text_lang("['container_toolbar_form_navigate']", "App");
            $arr_btns['idx_tbar_grid_summary'] = nm_get_text_lang("['container_toolbar_chart_summary']", "App");
            $arr_btns['idx_tbar_grid_goto'] = nm_get_text_lang("['container_toolbar_form_goto']", "App");
            $arr_btns['idx_tbar_grid_rows'] = nm_get_text_lang("['container_toolbar_grid_rows']", "App");
            $arr_btns['idx_tbar_grid_lineqty'] = nm_get_text_lang("['container_toolbar_form_lineqty']", "App");
            $arr_btns['idx_tbar_grid_navpage'] = nm_get_text_lang("['container_toolbar_form_navpage']", "App");
            $arr_btns['idx_tbar_grid_conf_chart'] = nm_get_text_lang("['container_toolbar_grid_conf_chart']", "App");
            $arr_btns['idx_tbar_grid_res_settings'] = nm_get_text_lang("['container_toolbar_grid_res_settings']", "App");
            $arr_btns['idx_tbar_grid_new'] = nm_get_text_lang("['container_toolbar_grid_new']", "App");
            $arr_btns['idx_tbar_grid_qsearch'] = nm_get_text_lang("['container_toolbar_form_qsearch']", "App");
            $arr_btns['idx_tbar_grid_dynsearch'] = nm_get_text_lang("['container_toolbar_form_dynsearch']", "App");
            $arr_btns['idx_tbar_grid_filter'] = nm_get_text_lang("['container_toolbar_grid_filter']", "App");
            $arr_btns['idx_tbar_grid_sel_col'] = nm_get_text_lang("['container_toolbar_grid_sel_col']", "App");
            $arr_btns['idx_tbar_grid_sort_col'] = nm_get_text_lang("['container_toolbar_grid_sort_col']", "App");
            $arr_btns['idx_tbar_grid_sel_groupby'] = nm_get_text_lang("['container_toolbar_grid_sel_groupby']", "App");
            $arr_btns['idx_tbar_grid_chart_detail'] = nm_get_text_lang("['container_toolbar_grid_chart_detail']", "App");
            $arr_btns['idx_tbar_grid_pdf'] = 'PDF';
            $arr_btns['idx_tbar_grid_word'] = 'MS Word';
            $arr_btns['idx_tbar_grid_xls'] = 'Excel';
            $arr_btns['idx_tbar_grid_xml'] = 'XML';
            $arr_btns['idx_tbar_grid_csv'] = 'CSV';
            $arr_btns['idx_tbar_grid_rtf'] = 'RTF';
            $arr_btns['idx_tbar_grid_json'] = 'JSON';
            $arr_btns['idx_tbar_grid_print'] = nm_get_text_lang("['container_toolbar_grid_print']", "App");
            $arr_btns['idx_tbar_grid_reload'] = nm_get_text_lang("['container_toolbar_grid_reload']", "App");
            break;
    }
    return $arr_btns;
}
?>
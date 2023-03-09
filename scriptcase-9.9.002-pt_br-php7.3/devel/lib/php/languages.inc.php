<?php

/**
 * Funcoes auxiliares.
 *
 * Definicao de funcoes auxiliares genericas utilizadas no ScriptCase.
 *
 * @package     Biblioteca
 * @subpackage  PHP
 * @creation    2009/10/02
 * @copyright   NetMake Solucoes em Informatica
 * @author      Juliano Mesquita dos Santos <juliano@netmake.com.br>
 *
 * $Id: functions2.inc.php,v 1.19 2012-02-07 22:22:25 vinicius Exp $
 */

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976)) {
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'Invalid access to system file.');
}

$arr_lang_loaded = array();
$page_lang_loaded = 'general';
$force_lang = false;

function startLangs($page, $lang = '', $erase = false)
{
    global $arr_lang_loaded;
    if ($erase) {
        $arr_lang_loaded = array('general');
    }
    //echo $nm_config['path_lang'], "<br/>";
    $lang = empty($lang) ? $_SESSION['nm_session']['status']['lang'] : $lang;

    /*
        putenv('LANGUAGE=' . $lang);
        putenv('LANG=' . $lang);
        putenv('LC_ALL=' . $lang);
        putenv('LC_MESSAGES=' . $lang);
       */

// this might be useful for date functions (LC_TIME) or money formatting (LC_MONETARY), for instance
    //_setlocale(LC_ALL, $lang);
    _setlocale(LC_MESSAGES, $lang);

// here we indicate the default domain the gettext() calls will respond to
    loadPageLang($page);
    //echo "@@"._gettext("page_title") . "@@<br/>";


}

function loadPageLang($page, $leave_last = false)
{
    global $nm_config, $arr_lang_loaded, $page_lang_loaded;
    //echo "@@". $page. "@@<br/>";
    $last = '';
    $arr_lang_loaded[] = $page;
    _bindtextdomain($page, $nm_config['path_lang']);
    _bind_textdomain_codeset($page, 'UTF-8');
    _textdomain($page);

    if ($leave_last) {
        _bindtextdomain($page_lang_loaded, $nm_config['path_lang']);
        _bind_textdomain_codeset($page_lang_loaded, 'UTF-8');
        _textdomain($page_lang_loaded);
        $arr_lang_loaded[] = $page_lang_loaded;
    } else {
        $page_lang_loaded = $page;
    }
}

function nm_get_text_lang($str_indice, $str_other_local = '', $str_idioma = '', $ctest = '')
{
    global $nm_config, $page_lang_loaded, $arr_lang_loaded;

    $str_force_lang = nm_get_force_lang($str_indice);
    if ($str_force_lang != $str_indice) {
        return $str_force_lang;
    }
    if (!empty($str_other_local)) {
        loadPageLang($str_other_local, true);
    }
    // $str_indice = strtr($str_indice, array("']['"=> '_', "['" =>"", "']" => ""));
    $lang = _gettext($str_indice);
    if ($lang == $str_indice) {
        $lang = search_lang($str_indice, $str_other_local);
    }
//    if($lang == $str_indice)
    if (isset($nm_config['em_desenv']) && $nm_config['em_desenv']) {
        $file = (empty($str_other_local)) ? $page_lang_loaded : $str_other_local;
        $_SESSION['nm_session_desenv_lang'][] = $str_indice;
        $_SESSION['nm_session_desenv_lang_with_page'][] = [
            'file' => $file,
            'files_loaded' => join(' - ', $arr_lang_loaded),
            'index' => $str_indice,
            'caller' => debug_backtrace()[0],
            'lang' => $lang
        ];
    }
    if ($lang == $str_indice) {
        if ($nm_config['em_desenv'] && $_SESSION['nm_session']['lang_debug'] >= 1) return '(' . $file . ')' . str_replace('\'', '', $str_indice);
        return "";
    }


    if (isset($nm_config['em_desenv']) && $nm_config['em_desenv'] && isset($_SESSION['nm_session']['lang_debug']) && $_SESSION['nm_session']['lang_debug'] >= 3) {
        return $lang . ' -> (' . $file . ')' . str_replace('\'', '', $str_indice);
    } else {
        return $lang;
    }


}//nm_get_text_lang

function search_lang($str_indice, $str_other_local = '')
{
    global $arr_lang_loaded, $nm_lang;


    $arr_lang_loaded = array_unique($arr_lang_loaded);
    foreach (array_reverse($arr_lang_loaded) as $domain) {
        $lang = _dgettext($domain, $str_indice);
        if ($lang != $str_indice) break;
    }
    return $lang;
}

function nm_get_force_lang($str_indice)
{
    global $force_lang;
    if ($force_lang) {
        global $nm_lang;
        $fulllang = $str_indice;
        eval("\$fulllang = \$nm_lang" . $str_indice);
        if ($fulllang != $str_indice) {
            return $fulllang;
        }
    }
    return $str_indice;
}

/* Traduzir os arr_lang do array */
function nm_get_text_array_lang($arr_lang, $bln_debug)
{
    $delin = "||";

    foreach ($arr_lang as $k_lang => $v_lang) {
        if (is_array($v_lang)) {
            $arr_lang[$k_lang] = nm_get_text_array_lang($v_lang, $bln_debug);
        } else {
            if (strpos($v_lang, $delin) !== FALSE) {
                if ($bln_debug === TRUE) {
                    $arr_lang[$k_lang] = str_replace($delin, "___", $v_lang);
                } else {
                    $tmp_lang = explode($delin, $v_lang);
                    $arr_lang[$k_lang] = $tmp_lang[0];
                }
            }
        }
    }

    return $arr_lang;

}

function get_arr_lang_simple($arr_lang, $par_k)
{
    $retorno = array();

    if (is_array($arr_lang)) {
        foreach ($arr_lang as $k => $v) {
            $retorno = array_merge($retorno, get_arr_lang_simple($v, $par_k . "['$k']"));
        }
    } else {
        $retorno[$par_k] = $arr_lang;
    }

    return $retorno;

}//get_arr_lang_simple


function get_included_lang_files()
{
    $arr_includes = array();
    $arr_all_includes = get_included_files();

    foreach ($arr_all_includes as $file_include) {
        if (substr($file_include, -9, 9) == ".lang.php") {
            $arr_includes[] = str_replace("\\", "/", $file_include);
        }
    }

    return array_reverse($arr_includes);
}


$_td_stack = array(); // text domains stack

/**
 * Sets a new text domain after recording the current one
 * so it can be restored later with restore_textdomain().
 *
 * It's possible to nest calls to these two functions.
 * @param string the new text domain to set
 */
function set_textdomain($td)
{
    global $_td_stack;

    $old_td = textdomain(NULL);

    if ($old_td) {
        if (!strcmp($old_td, $td)) {
            array_push($_td_stack, false);
        } else {
            array_push($_td_stack, $old_td);
        }
    }

    textdomain($td);
}

/**
 * Restore the text domain active before the last call to
 * set_textdomain().
 */
function restore_textdomain()
{
    global $_td_stack;

    $old_td = array_pop($_td_stack);

    if ($old_td) {
        textdomain($old_td);
    }
}

?>
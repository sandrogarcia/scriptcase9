<?php
$str_subtitle = ('' != $this->GetVar('page_subtitle')) ? ' - ' . $this->GetVar('page_subtitle') : '';
$str_doctype  = $this->GetVar('doctype');
?><?php echo $str_doctype; ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
 <title>ScriptCase - <?php echo nm_get_text_lang("['page_title']") . $str_subtitle; ?></title>
 <meta http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
 <meta http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT" />
 <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
 <meta http-equiv="Cache-Control" content="max-age=15, s-maxage=0, private" />
 <meta http-equiv="Cache-Control" content="post-check=0, pre-check=0" />
 <meta http-equiv="Pragma" content="no-cache" />
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <meta name="author" content="NetMake" />
 <meta name="generator" content="ScriptCase" />

 <link rel="shortcut icon" href="<?php echo $nm_config['url_scriptcase_ico']; ?>favicon.ico" />
 <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $nm_config['url_scriptcase_ico']; ?>apple-touch-icon.png">
 <link rel="icon" type="image/png" href="<?php echo $nm_config['url_scriptcase_ico']; ?>favicon-32x32.png" sizes="32x32">
 <link rel="icon" type="image/png" href="<?php echo $nm_config['url_scriptcase_ico']; ?>favicon-16x16.png" sizes="16x16">
<?php

$arr_style_css = $this->GetVar('page_style_css');
if(is_array($arr_style_css))
{
	foreach ($arr_style_css as $arr_style_css_file)
	{
	    $str_file = $nm_config['url_js_' . $arr_style_css_file[0]] . $arr_style_css_file[1];
	?>
	<link rel="stylesheet" type="text/css" href="<?php echo $str_file; ?>" />
	 <?php
	}
}

if($this->GetVar('usar_css')=="S")
{
	?>
    <link rel="stylesheet" type="text/css" href="<?php echo $nm_config['url_scriptcase'] . 'css/'. nm_get_devel_css_js('css', 'sc_css', $nm_config['sc_scc']); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo $nm_config['url_js_third']; ?>jquery/css/smoothness/jquery-ui.css?v=9.0" />
	<?php
}
elseif($this->GetVar('nao_usar_css_sc')=="S")
{
	?>
	<link rel="stylesheet" type="text/css" href="<?php echo $nm_config['url_js_third']; ?>jquery/css/smoothness/jquery-ui.css?v=9.0" />
	<?php
}

$arr_style_css = $this->GetVar('page_style_css_after_sc_css');
if(is_array($arr_style_css))
{
	foreach ($arr_style_css as $arr_style_css_file)
	{
	    $str_file = $nm_config['url_js_' . $arr_style_css_file[0]] . $arr_style_css_file[1];
	?>
	<link rel="stylesheet" type="text/css" href="<?php echo $str_file . '?v=' .  nm_scriptcase_version(); ?>" />
	 <?php
	}
}

?>
<?php
$arr_style = $this->GetVar('page_style');
if (!empty($arr_style))
{
?>
 <style type="text/css">
<?php
    foreach ($arr_style as $str_style)
    {
        echo $str_style;
    }
?>
 </style>
<?php
}
?>
<script language="javascript" type="text/javascript" src="<?php echo $nm_config['url_js_devel']; ?><?php echo nm_get_devel_css_js('js', 'devel', 'hotkeys.inc.js'); ?>"></script>
<script language="javascript" type="text/javascript" src="<?php echo $nm_config['url_js_devel']; ?><?php echo nm_get_devel_css_js('js', 'devel', 'scriptcase91.js'); ?>"></script>
<?php
$bol_jquery = $this->GetVar('bol_jquery');
if($bol_jquery)
{
	?>
    <script language="javascript" type="text/javascript" src="<?php echo $nm_config['url_js_third']; ?>jquery/js/jquery.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo $nm_config['url_js_third']; ?>jquery/js/jquery-ui.js"></script>
	<?php
}
if($this->GetVar('page_javascriptlang') != '') {
    $str_js_jang = $this->GetVar('page_javascriptlang');
    ?>
        <script language="javascript" type="text/javascript">
            <?php echo $str_js_jang; ?>
        </script>
    <?php
}
if ($this->GetVar('page_javascriptbeforejs') != '')
{
?>
 <script language="javascript" type="text/javascript" src="<?php echo $this->GetVar('page_javascriptbeforejs'); ?>"></script>
<?php
}

$arr_js = $this->GetVar('page_js');
foreach ($arr_js as $arr_js_file)
{
    $str_file = $nm_config['url_js_' . $arr_js_file[0]] . $arr_js_file[1];
    $str_file = $arr_js_file[0] == "devlang" ? nm_url_rand($str_file) : $str_file;
?>
 <script language="javascript" type="text/javascript" src="<?php echo $str_file. '?v=' .  nm_scriptcase_version(); ?>"></script>
<?php
}

if ($this->GetVar('page_javascript') != '')
{
?>
 <script language="javascript" type="text/javascript" src="<?php echo $this->GetVar('page_javascript'). '?v=' .  nm_scriptcase_version(); ?>"></script>
<?php
}

$arr_js = $this->GetVar('page_js_after');
foreach ($arr_js as $arr_js_file)
{
    $str_file = $nm_config['url_js_' . $arr_js_file[0]] . $arr_js_file[1];
    $str_file = $arr_js_file[0] == "devlang" ? nm_url_rand($str_file) : $str_file;
?>
 <script language="javascript" type="text/javascript" src="<?php echo $str_file. '?v=' .  nm_scriptcase_version(); ?>"></script>
<?php
}
?>

</head>
<?php
$pBody = $this->GetVar('page_body');
$page_body = "";
$arr_body  = array();
if(!empty($pBody))
{
    $arr_body		= explode("|", $pBody);
    $page_body		= (isset($arr_body[0])) ? $arr_body[0] : "";
}

$str_body_options	= "";
if (is_array($arr_body) && sizeof($arr_body) > 1)
{
	foreach ($arr_body as $body_option)
	{
		$bo_tmp				 = explode("#", $body_option);
		if (is_array($bo_tmp) && sizeof($bo_tmp) > 1)
		{
			$str_body_options	.= ' ' . $bo_tmp[0] . '="' . $bo_tmp[1] . '"';
		}
	}
}

if (NM_PAGE_BODY_FRAME != $page_body)
{
    $str_class = ('' == $page_body)
               ? ''
               : ' class="' . $page_body . '"';
    $str_bgcolor = '';
    if ('nmTopBar' == $page_body)
    {
        $str_class   = 'nmPage';
    }
    $str_unload = $this->GetVar('page_unload');
    if (isset($str_unload) && (null != $str_unload) && (FALSE != $str_unload) && ('' != $str_unload))
    {
        $str_unload = ' onUnload="' . $str_unload . '"';
    }
    else
    {
        $str_unload = '';
    }
    $str_onload = $this->GetVar('page_onload');
    if (isset($str_onload) && (null != $str_onload) && (FALSE != $str_onload) && ('' != $str_onload))
    {
        $str_onload = ' onload="' . $str_onload . '"';
    }
    else
    {
        $str_onload = '';
    }

    $page_margin = !empty($this->GetVar('page_margin')) ? 'style="margin: '.$this->GetVar('page_margin').'px;"' : '';
?>
<body <?php echo $page_margin; ?> <?php echo $str_class . $str_unload . $str_onload . $str_body_options; ?> >
<?php
}
?>
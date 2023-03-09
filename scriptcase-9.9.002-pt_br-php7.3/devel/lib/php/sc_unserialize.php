<?php
/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}

function sc_unserialize($id, $charset="", $dados="", $bol_use_array = false, $bol_return_after_serialize = false)
{
	if (is_file(dirname(__FILE__) . "/default_values/" . $id . ".php"))
    {
		//IniSchema utiliza essa variavel
		$shows_only_listed = FALSE;

        include (dirname(__FILE__) . "/default_values/" . $id . ".php");

        if (!empty($dados))
        {
            if(!$bol_use_array)
            {
                $temp_dados  = unserialize($dados);
            }
            else
            {
                $temp_dados  = $dados;
            }
            if($bol_return_after_serialize)
            {
                return $temp_dados;
            }
			if(!is_array($temp_dados))
			{
				if($temp_dados === false)
				{
					file_put_contents(dirname(__FILE__) . "/unserialize/" . $id . "_" . date('YmdHisu') . ".txt", $dados);
				}
				$temp_dados = array();
			}
        }
        else
        {
            $temp_dados  = array();
        }

	    if(!is_array($temp_dados))
	    {
		    echo "<hr>ID:" . $id . "<br><pre>";
		    echo htmlentities($dados);
		    debug_print_backtrace();
		    echo "</pre>";
		    exit;
	    }
	    elseif($shows_only_listed && $id == 'IniSchema' && isset($temp_dados['schema']) && !empty($temp_dados['schema']) )
		{
			//varre pra matar lixo
			foreach($temp_dados['schema'] as $tag=>$value)
			{
				//se nao tiver no array de definicao, mata lixo
				if(!isset($def_dados['schema'][$tag]))
				{
					unset($temp_dados['schema'][$tag]);
				}
			}

			//varre valor default para inserir itens faltando no xml
			foreach($def_dados['schema'] as $tag=>$value)
			{
				//se nao tiver no array de definicao, mata lixo
				if(!isset($temp_dados['schema'][$tag]))
				{
					$temp_dados['schema'][$tag] = $def_dados['schema'][$tag];
				}
			}
		}
		elseif ($id == 'Apl_vars' && isset($temp_dados['vars']) && is_array($temp_dados['vars']) && !empty($temp_dados['vars']))
		{
			$aFixIndexes = array('con_campos'    , 'for_campos', 'atu_campos',
								 'atu_campos_upd', 'lab_campos', 'php_campos',
								 'val_campos'    , 'aca_campos', 'dir_campos',
								 'ini_campos'    , 'lkp_campos', 'qbr_campos');
			foreach ($temp_dados['vars'] as $sVarName => $aVarData)
			{
				foreach ($aFixIndexes as $sFixIndex)
				{
					if (isset($aVarData[$sFixIndex]) && !empty($aVarData[$sFixIndex]))
					{
						$aTmpArray = array();
						foreach ($aVarData[$sFixIndex] as $sIndexSeq)
						{
							$aTmpArray[] = $sIndexSeq;
						}
						$temp_dados['vars'][$sVarName][$sFixIndex] = $aTmpArray;
					}
				}
			}
		}

		foreach ($temp_dados as $tag => $val)
        {
            $def_dados[$tag] = $val;
        }

        if (!empty($charset) && $charset != "UTF-8")
        {
            $def_dados  = sc_decode_utf8($def_dados, $charset);
        }

        return $def_dados;
    }
    else
    {
        echo "Error: class do unserialize <b>". $id ."</b> not found in " . dirname(__FILE__) . "/default_values/" . $id . ".php!";
        exit;
    }
}

function sc_decode_utf8($val, $charset)
{
	global $nm_config;

    if (is_array($val))
    {
        $temp = array();
        foreach ($val as $ind => $new)
        {
            $ind = sc_decode_utf8($ind, $charset);
            $temp[$ind] = sc_decode_utf8($new, $charset);
        }
        return $temp;
    }
    elseif ($charset != "UTF-8")
    {
/*-- PHP 8.0 */
        if (!is_string($val)) {
            return $val;
        }
/*------*/
        if (in_array($charset, $nm_config['charset_iconv']) && function_exists("iconv"))
        {
	   return iconv("UTF-8", $charset . "//TRANSLIT", $val);
        }
        else
        {
	   return mb_convert_encoding($val, $charset, "UTF-8");
        }
    }
    else
    {
        return $val;
    }
}

function sc_get_serialize_str($id, $str, $str_open_tag="'", $bol_value_like = false, $random_serialized_value = false)
{
        $str_open_tag        = ($str_open_tag=='"')?"\\\"":"\"";
        $int_like_correction = $bol_value_like ? strlen($str) - 2 : strlen($str);
        $int_like_correction = $random_serialized_value ? '%' : $int_like_correction;

        return 's:'. strlen($id) .':'. $str_open_tag . $id . $str_open_tag .';s:'. $int_like_correction .':'. $str_open_tag . $str . $str_open_tag .';';
}

?>
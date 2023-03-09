<?php

	$return = true;

	if($num_versao_atual < 9400012 || empty($num_versao_atual))
	{
		if( count($scope) == 0 || in_array('scriptcase', $scope) )
		{
			if(function_exists("php_uname"))
			{
				$str_sys = strtolower(php_uname());
			}
			elseif(defined("PHP_OS"))
			{
				$str_sys = strtolower(PHP_OS);
			}

			$str_sys = trim($str_sys);

	        if(strpos(strtolower($str_sys), 'darwin') !== FALSE && strpos($str_sys, 'x86_64') !== FALSE)
			{
				global $nm_config;

				$zendid_from = $nm_config['path_thirddevel'] . 'zend/zendid.mac64';
			    $zendid_to   = $nm_config['path_thirddevel'] . 'zend/zendid';

			    if(is_file($zendid_to))
				{
				    unlink($zendid_to);
				}

				if(is_file($zendid_from) && !is_file($zendid_to))
				{
				    if (copy($zendid_from, $zendid_to))
				    {
				    	$return = true;
						@chmod($zendid_to, 0755);
				    }
				    else
				    {
				    	$return = false;
				    }
				}
			}
        }
    }

?>
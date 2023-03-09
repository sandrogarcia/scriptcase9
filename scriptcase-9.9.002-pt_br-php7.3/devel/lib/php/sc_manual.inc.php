<?php
$arrManual          = array();
$arrManual['base']  = "manual_mp/manual/" ;
$rootPath = str_replace("devel".DIRECTORY_SEPARATOR."lib".DIRECTORY_SEPARATOR."php","doc".DIRECTORY_SEPARATOR."manual_mp".DIRECTORY_SEPARATOR,__DIR__);
if (is_file($rootPath. 'components/scripts/indice.php')) {
  include($rootPath. 'components/scripts/indice.php');
}
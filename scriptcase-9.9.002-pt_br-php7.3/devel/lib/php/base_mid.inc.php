<?php

$nm_config['is_93'] = $obj_lic->isItVersion('9.3');
$nm_config['is_94'] = $obj_lic->isItVersion('9.4');
$nm_config['is_95'] = $obj_lic->isItVersion('9.5');
$nm_config['is_96'] = $obj_lic->isItVersion('9.6');
$nm_config['is_97'] = $obj_lic->isItVersion('9.7');
$nm_config['is_98'] = $obj_lic->isItVersion('9.8');
$nm_config['is_99'] = $obj_lic->isItVersion('9.9');

$nm_config['has_version_9.1.000'] = $obj_lic->hasRightToVersion('9.1.000');
$nm_config['has_92']              = $obj_lic->hasRightToVersion('9.2.000');
$nm_config['has_93']              = $obj_lic->hasRightToVersion('9.3.000');
$nm_config['has_94']              = $obj_lic->hasRightToVersion('9.4.000');
$nm_config['has_94_9']            = $obj_lic->hasRightToVersion('9.4.009');
$nm_config['has_95']              = $obj_lic->hasRightToVersion('9.5.000');
$nm_config['has_96']              = $obj_lic->hasRightToVersion('9.6.000');
$nm_config['has_97']              = $obj_lic->hasRightToVersion('9.7.000');
$nm_config['has_971']             = $obj_lic->hasRightToVersion('9.7.100');
$nm_config['has_9_7_11']          = $obj_lic->hasRightToVersion('9.7.011');
$nm_config['has_9_7_16']          = $obj_lic->hasRightToVersion('9.7.016');
$nm_config['has_9_7_17']          = $obj_lic->hasRightToVersion('9.7.017');
$nm_config['has_9_7_19']          = $obj_lic->hasRightToVersion('9.7.019');
$nm_config['has_9_9_0']           = $obj_lic->hasRightToVersion('9.9.000');

?>
<?php

if ($num_versao_atual < 9800000 || empty($num_versao_atual)) {

    nm_load_class('interface', 'Event');
    $obj_evt = new nmEvent();

    $obj_evt->fixEvtBracketsCtr();
}

$return = true;

?>
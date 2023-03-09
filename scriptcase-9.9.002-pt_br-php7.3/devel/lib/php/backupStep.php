<?php

if(isset($_REQUEST['ajax']) && $_REQUEST['ajax'] == 'nm')
{
    switch($_REQUEST['option'])
    {
        case 'read_zip':

            $arr_output = array('code' =>"", 'msg'=>"");

            if(is_file("../../../tmp/" . $_REQUEST['file']))
            {
                $arr_output['msg'] = $_REQUEST['file'] . " " . human_filesize(filesize("../../../tmp/" . $_REQUEST['file']));
            }

            echo json_encode($arr_output);
            break;
    }
}

function human_filesize($bytes, $decimals = 2) {
    $sz = 'BKMGTP';
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}

?>
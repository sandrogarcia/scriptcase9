<?php

if(isset($_REQUEST['ajax']) && $_REQUEST['ajax'] == 'nm')
{
    switch($_REQUEST['option'])
    {
        case 'read_zip_prod':

            $arr_output = array('code' =>"", 'msg'=>"");
            if(is_file("../../../tmp/" . $_REQUEST['file'] . "_status.txt"))
            {
                $str_code = file_get_contents("../../../tmp/" . $_REQUEST['file'] . "_status.txt");
                $str_msg  = "";

                if(strpos($str_code, "|||") !== false)
                {
                    list($str_code, $str_msg) = explode("|||", $str_code);
                }

                $arr_output['code'] = $str_code;
                $arr_output['msg']  = $str_msg;
            }

            if($arr_output['code'] == "startedzip")
            {
                $arr_files = scandir("../../../tmp/");
                foreach($arr_files as $file)
                {
                    if(is_file("../../../tmp/" . $file))
                    {
                        if(strpos($file, $_REQUEST['file'] . ".zip.") !== false)
                        {
                            $arr_output['msg'] = $_REQUEST['file'] . ".zip " . human_filesize(filesize("../../../tmp/" . $file));
                        }
                    }
                }
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
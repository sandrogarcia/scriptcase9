<?php

if ($num_versao_atual < 9700000 || empty($num_versao_atual)) {
    $previous_error = set_error_handler("nm_faz_nada");
    nm_load_class('interface', 'Group');
    nm_load_class('interface', 'ProjVersion');
    nm_load_class('interface', 'Application');
    nm_load_class('interface', 'Field');
    $obj_grp = new nmGroup();
    $obj_version = new nmProjVersion();
    $obj_app = new nmApplication();
    $obj_fld = new nmField();

    $arr_prjs = $obj_grp->ListData();

    foreach ($arr_prjs as $prj) {
        $prj = $prj['Cod_Prj'];

        $arr_versions = $obj_version->GetVersion($prj);
        foreach ($arr_versions as $version) {
            $arr_apps = $obj_app->RetListApp($prj, $version);
            foreach ($arr_apps as $app) {
                $bol_change = false;

                $obj_app->SetApplication($prj, $app, $version);
                $obj_app->CheckAttrN(true, array(4));
                if($obj_app->getData('Data_Inc') < 20211028) {
//20221027
                    $obj_app->attr4->SetTag('use_mobile_improvements', 'N');
                }
                $obj_app->attr4->SetTag('mobile_display_scrollup', 'S');

                $obj_app->saveAttrN(array(4 => ""));

            }
        }
    }

    set_error_handler($previous_error);
}

$return = true;

?>
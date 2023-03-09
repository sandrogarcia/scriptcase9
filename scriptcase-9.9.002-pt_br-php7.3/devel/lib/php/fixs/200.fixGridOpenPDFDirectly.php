<?php
    if($num_versao_atual < 9700016 || empty($num_versao_atual)) {
        nm_load_class('interface', 'Group');
        nm_load_class('interface', 'ProjVersion');
        nm_load_class('interface', 'Application');
        $obj_grp = new nmGroup();
        $obj_version = new nmProjVersion();
        $obj_app = new nmApplication();

        //troca nos projetos
        $arr_groups = $obj_grp->getGroupList();
        foreach ($arr_groups as $cod_prj) {
            $arr_versions = $obj_version->GetVersion($cod_prj);
            foreach ($arr_versions as $version) {
                $arr_apps = $obj_app->RetListApp($cod_prj, $version, false, array(NM_APP_TYPE_GRID));
                foreach ($arr_apps as $app) {
                    $obj_app->SetApplication($cod_prj, $app, $version);
                    $obj_app->CheckAttrN(true, array(1, 4));

                    $arr_modules_cons = explode(';', $obj_app->attr1->GetTag('modules_cons'));

                    if (!in_array('graf', $arr_modules_cons)) continue;

                    $obj_app->attr4->SetTag('Pdf_Botao_Abre', 'N');
                    $obj_app->saveAttrN(array(4 => ""));
                }
            }
        }

        $return = true;
    }
?>
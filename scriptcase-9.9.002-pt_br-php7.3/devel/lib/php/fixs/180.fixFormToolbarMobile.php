<?php
nm_load_class('interface', 'Group');
nm_load_class('interface', 'ProjVersion');
nm_load_class('interface', 'Application');
$obj_grp = new nmGroup();
$obj_version = new nmProjVersion();
$obj_app = new nmApplication();

//troca nos projetos
$arr_groups = $obj_grp->getGroupList();
foreach($arr_groups as $cod_prj)
{
    //troca default do projeto
    $def_values  = $obj_grp->GetValPadroes($cod_prj);
    $def_values[ 'def_toolbars_mobile_form' ] = $def_values[ 'def_toolbars_form' ];
    $def_values[ 'def_toolbars_mobile_form' ]['top_left'] = array();

    $obj_grp->SetData('def_toolbars_mobile_form', $def_values[ 'def_toolbars_mobile_form' ]);
    $obj_grp->AtuValPadroes($cod_prj);
    //fim troca default do projeto

    $arr_versions = $obj_version->GetVersion($cod_prj);
    foreach($arr_versions as $version)
    {
        $arr_apps = $obj_app->RetListApp($cod_prj, $version, false, array('form'));
        foreach($arr_apps as $app)
        {
            $obj_app->SetApplication($cod_prj, $app, $version);
            $obj_app->CheckAttrN(true, array(3));

            $arr_toolbar = $obj_app->attr3->GetTag('toolbars');

            $arr_toolbar['mobile_top_left'] = $arr_toolbar['top_left'];
            $arr_toolbar['mobile_top_center'] = $arr_toolbar['top_center'];
            $arr_toolbar['mobile_top_right'] = $arr_toolbar['top_right'];
            $arr_toolbar['mobile_bottom_left'] = $arr_toolbar['bottom_left'];
            $arr_toolbar['mobile_bottom_center'] = $arr_toolbar['bottom_center'];
            $arr_toolbar['mobile_bottom_right'] = $arr_toolbar['bottom_right'];

            $obj_app->attr3->SetTag('toolbars', $arr_toolbar);
            $obj_app->saveAttrN(array(3=>""));
        }
    }
}

global $nm_ini_sys;

//troca no sistema
$toolbar = $nm_ini_sys->GetTag( 'def_toolbars_form' );
$toolbar['top_left'] = array();

$nm_ini_sys->SetTag('def_toolbars_mobile_form', $toolbar);
$nm_ini_sys->Save();

$return = true;
?>
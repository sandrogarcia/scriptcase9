<?php

        function removeItemArrayToolbar(&$arr_toolbar, $arr_del_item)
        {
            foreach ($arr_del_item as $del_item) {
                foreach ($arr_toolbar as $ind => $item) {
                    if ($del_item == $item || strtolower($del_item) == strtolower($item) || strpos(strtolower($item), strtolower($del_item))!==false) {
                        unset($arr_toolbar[$ind]);
                        break;
                    }
                }
            }
        }
        
        $arr_remove = array('sys_format_nav', 'sys_format_stepret', 'sys_format_stepava', 'sys_format_ini', 'sys_format_ret', 'sys_format_ava', 'sys_format_copy', 'sys_format_rows', 'sys_GridPermiteSeq');

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

            $left   = array_unique(array_merge($def_values[ 'def_toolbars_calendar' ]['top_left'], $def_values[ 'def_toolbars_calendar' ]['bottom_left']));
            $center   = array_unique(array_merge($def_values[ 'def_toolbars_calendar' ]['top_center'], $def_values[ 'def_toolbars_calendar' ]['bottom_center']));
            $right   = array_unique(array_merge($def_values[ 'def_toolbars_calendar' ]['top_right'], $def_values[ 'def_toolbars_calendar' ]['bottom_right']));

            removeItemArrayToolbar($left, $arr_remove);
            removeItemArrayToolbar($center, $arr_remove);
            removeItemArrayToolbar($right, $arr_remove);

			$def_values[ 'def_toolbars_mobile_calendar' ]['top_left'] = $left;
			$def_values[ 'def_toolbars_mobile_calendar' ]['top_center'] = $center;
			$def_values[ 'def_toolbars_mobile_calendar' ]['top_right'] = $right;
			$def_values[ 'def_toolbars_mobile_calendar' ]['bottom_left'] = array();
			$def_values[ 'def_toolbars_mobile_calendar' ]['bottom_center'] = array();
			$def_values[ 'def_toolbars_mobile_calendar' ]['bottom_right'] = array();

			$obj_grp->SetData('def_toolbars_mobile_calendar', $def_values[ 'def_toolbars_mobile_calendar' ]);
			$obj_grp->AtuValPadroes($cod_prj);
            //fim troca default do projeto

            $arr_versions = $obj_version->GetVersion($cod_prj);
            foreach($arr_versions as $version)
            {
                $arr_apps = $obj_app->RetListApp($cod_prj, $version, false, array('calendar'));
                foreach($arr_apps as $app)
                {
                    $obj_app->SetApplication($cod_prj, $app, $version);
                    $obj_app->CheckAttrN(true, array(3));

                    $arr_toolbar = $obj_app->attr3->GetTag('toolbars');

                    $left   = array_unique(array_merge($arr_toolbar['top_left'], $arr_toolbar['bottom_left']));
                    $center = array_unique(array_merge($arr_toolbar['top_center'], $arr_toolbar['bottom_center']));
                    $right  = array_unique(array_merge($arr_toolbar['top_right'], $arr_toolbar['bottom_right']));

                    removeItemArrayToolbar($left, $arr_remove);
                    removeItemArrayToolbar($center, $arr_remove);
                    removeItemArrayToolbar($right, $arr_remove);


                    $arr_toolbar['mobile_top_left'] = $left;
					$arr_toolbar['mobile_top_center'] = $center;
					$arr_toolbar['mobile_top_right'] = $right;
					$arr_toolbar['mobile_bottom_left'] = array();
					$arr_toolbar['mobile_bottom_center'] = array();
					$arr_toolbar['mobile_bottom_right'] = array();
					
					$obj_app->attr3->SetTag('toolbars', $arr_toolbar);
					$obj_app->saveAttrN(array(3=>""));
                }
            }
        }
		
		global $nm_ini_sys;

        //troca no sistema
		$toolbar = $nm_ini_sys->GetTag( 'def_toolbars_calendar' );

        $left   = array_unique(array_merge($toolbar['top_left'], $toolbar['bottom_left']));
        $center   = array_unique(array_merge($toolbar['top_center'], $toolbar['bottom_center']));
        $right   = array_unique(array_merge($toolbar['top_right'], $toolbar['bottom_right']));

        removeItemArrayToolbar($left, $arr_remove);
        removeItemArrayToolbar($center, $arr_remove);
        removeItemArrayToolbar($right, $arr_remove);


        $toolbar_mobile['top_left'] = $left;
        $toolbar_mobile['top_center'] = $center;
        $toolbar_mobile['top_right'] = $right;
        $toolbar_mobile['bottom_left'] = array();
        $toolbar_mobile['bottom_center'] = array();
        $toolbar_mobile['bottom_right'] = array();
			
		$nm_ini_sys->SetTag('def_toolbars_mobile_calendar', $toolbar_mobile);
		$nm_ini_sys->Save();
		
		$return = true;
?>
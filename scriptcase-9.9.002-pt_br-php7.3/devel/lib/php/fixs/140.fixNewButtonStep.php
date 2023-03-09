<?php
//if($num_versao_atual < 9050003 || empty($num_versao_atual))
{
    global $nm_ini_sys;

    $arr_path   = array(
        'sys'        => $nm_config['path_sys'],
        'grp'        => $nm_config['path_grp'],
        'usr'        => $nm_config['path_usr'],
        //'scriptcase' => $nm_config['path_scriptcase'],
    );

    //le botoes
    $arr_list = array();
    foreach ($arr_path as $str_mod => $str_path)
    {
        if($str_mod == 'scriptcase' || $str_mod == 'sys')
        {
            if(is_dir($str_path . "img/btn/"))
            {
                $arr_btns = scandir($str_path . "img/btn/");
                foreach($arr_btns as $btn)
                {
                    if(is_dir($str_path . "img/btn/" . $btn) && is_file($str_path . "img/btn/" . $btn . "/button.ini"))
                    {
                        $arr_list[$str_mod . '__NM__' . $btn] = $str_path . "img/btn/" . $btn . "/button.ini";
                    }
                }
            }
        }
        else
        {
            $arr_childs = scandir($str_path);
            foreach($arr_childs as $childs)
            {
                if($childs == 'index.html')  continue;
                if(is_dir($str_path . $childs . "/img/btn/"))
                {
                    $arr_btns = scandir($str_path . $childs . "/img/btn/");
                    foreach($arr_btns as $btn)
                    {
                        if(is_dir($str_path . $childs . "/img/btn/" . $btn) && is_file($str_path . $childs . "/img/btn/" . $btn . "/button.ini"))
                        {
                            $arr_list[$str_mod . '__NM__' . $btn] = $str_path . $childs . "/img/btn/" . $btn . "/button.ini";
                        }
                    }
                }
            }
        }
    }

    //varre botoes e adiciona o novo
    if(!empty($arr_list))
    {
        $arr_btn_new = array(
            "bstepretorna"=> array('lang'=>'lang_btns_stepprev', 'from'=>'bretorna'),
            "bstepavanca"=> array('lang'=>'lang_btns_stepnext', 'from'=>'bavanca'),
            "bfilref_apply"  => array('lang'=>'lang_btns_bfilref_apply', 'from'=>'bpesquisa'),
            "bfilref_limpar" => array('lang'=>'lang_btns_bfilref_limpar', 'from'=>'blimpar'),
            "bfilref_close"  => array('lang'=>'lang_btns_bfilref_close', 'from'=>'bajaxclose'),
        );

        foreach ($arr_list as $btn_internal => $btn)
        {
            if(is_file($btn))
            {
                $v_arr_unserialize = unserialize(file_get_contents($btn));

                $bol_change = false;

                foreach ($arr_btn_new as $str_btn => $arr_btn)
                {
                    if (!isset($v_arr_unserialize['button']['list'][$str_btn]))
                    {
                        $bol_change = true;

                        $v_arr_unserialize['button']['list'][$str_btn] = $v_arr_unserialize['button']['list'][ $arr_btn['from'] ];

                        $v_arr_unserialize['button']['list'][$str_btn]['value']             = "{" . $arr_btn['lang'] . "}";
                        $v_arr_unserialize['button']['list'][$str_btn]['hint']              = "{" . $arr_btn['lang'] . "_hint}";

                        if($str_btn == 'bstepretorna' || $str_btn == 'bstepavanca')
                        {
                            $v_arr_unserialize['button']['list'][$str_btn]['type']           = "button";
                            $v_arr_unserialize['button']['list'][$str_btn]['display']        = "only_text";
                            $v_arr_unserialize['button']['list'][$str_btn]['style']          = "default";

                            if($str_btn == 'bstepretorna')
                            {
                                $v_arr_unserialize['button']['list'][$str_btn]['fontawesomeicon']= "fas fa-arrow-left";
                                $v_arr_unserialize['button']['list'][$str_btn]['fontawesomeicon_rtl']= "fas fa-arrow-right";
                            }
                            elseif($str_btn == 'bstepavanca')
                            {
                                $v_arr_unserialize['button']['list'][$str_btn]['fontawesomeicon']= "fas fa-arrow-right";
                                $v_arr_unserialize['button']['list'][$str_btn]['fontawesomeicon_rtl']= "fas fa-arrow-left";
                            }
                        }
                    }
                }

                if($bol_change)
                {
                    $v_arr_unserialize['version'] = 10;
                    file_put_contents($btn, serialize($v_arr_unserialize));
                }
            }
        }
    }

    $arr_pos        = array('top_left', 'top_center', 'top_right', 'bottom_left', 'bottom_center', 'bottom_right');
    $arr_bars       = array('def_toolbars_form', 'def_toolbars_mobile_form', );

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
        foreach($arr_bars as $bar)
        {
            if(isset($def_values[ $bar ]))
            {
                $arr_toolbar = $def_values[ $bar ];

                $test        = serialize($arr_toolbar);
                $bol_achou = false;
                if(strpos($test, 'sys_format_stepret') === false)
                {
                    foreach($arr_pos as $change)
                    {
                        if(isset($arr_toolbar[ $change ]))
                        {
                            foreach($arr_toolbar[ $change ] as $key => $btn)
                            {
                                if($btn == 'sys_format_ret')
                                {
                                    array_splice( $arr_toolbar[ $change ], ($key+1), 0, "sys_format_stepret" );
                                    $bol_achou = true;
                                    break;
                                }
                            }
                        }
                    }
                }
                if(strpos($test, 'sys_format_stepava') === false)
                {
                    foreach($arr_pos as $change)
                    {
                        if(isset($arr_toolbar[ $change ]))
                        {
                            foreach($arr_toolbar[ $change ] as $key => $btn)
                            {
                                if($btn == 'sys_format_ava')
                                {
                                    array_splice( $arr_toolbar[ $change ], ($key+1), 0, "sys_format_stepava" );
                                    $bol_achou = true;
                                    break;
                                }
                            }
                        }
                    }
                }

                if($bol_achou)
                {
                    $obj_grp->SetData($bar, $arr_toolbar);
                    $obj_grp->AtuValPadroes($cod_prj);
                }
            }
        }
        //fim troca default do projeto

        $arr_versions = $obj_version->GetVersion($cod_prj);
        foreach($arr_versions as $version)
        {
            $arr_apps = $obj_app->RetListApp($cod_prj, $version, false, array('form'));
            foreach($arr_apps as $app)
            {
                $bol_change = false;

                $obj_app->SetApplication($cod_prj, $app, $version);
                $obj_app->CheckAttrN(true, array(3));

                $arr_toolbar = $obj_app->attr3->GetTag('toolbars');
                $test        = serialize($arr_toolbar);
                $bol_achou = false;
                if(strpos($test, 'sys_format_stepret') === false)
                {
                    foreach($arr_pos as $change)
                    {
                        if(isset($arr_toolbar[ 'mobile_' . $change ]))
                        {
                            $arr_temp = $arr_toolbar[ 'mobile_' . $change ];
                            foreach($arr_temp as $key => $btn)
                            {
                                if($btn == 'sys_format_ret')
                                {
                                    array_splice( $arr_temp, ($key+1), 0, "sys_format_stepret" );
                                    $bol_achou = true;
                                    break;
                                }
                            }
                            $arr_toolbar[ 'mobile_' . $change ] = $arr_temp;
                        }
                        if(isset($arr_toolbar[ $change ]))
                        {
                            $arr_temp = $arr_toolbar[ $change ];
                            foreach($arr_temp as $key => $btn)
                            {
                                if($btn == 'sys_format_ret')
                                {
                                    array_splice( $arr_temp, ($key+1), 0, "sys_format_stepret" );
                                    $bol_achou = true;
                                    break;
                                }
                            }
                            $arr_toolbar[ $change ] = $arr_temp;
                        }
                    }
                }
                if(strpos($test, 'sys_format_stepava') === false)
                {
                    foreach($arr_pos as $change)
                    {
                        if(isset($arr_toolbar[ 'mobile_' . $change ]))
                        {
                            $arr_temp = $arr_toolbar[ 'mobile_' . $change ];
                            foreach($arr_temp as $key => $btn)
                            {
                                if($btn == 'sys_format_ret')
                                {
                                    array_splice( $arr_temp, ($key+1), 0, "sys_format_stepava" );
                                    $bol_achou = true;
                                    break;
                                }
                            }
                            $arr_toolbar[ 'mobile_' . $change ] = $arr_temp;
                        }
                        if(isset($arr_toolbar[ $change ]))
                        {
                            $arr_temp = $arr_toolbar[ $change ];
                            foreach($arr_temp as $key => $btn)
                            {
                                if($btn == 'sys_format_ava')
                                {
                                    array_splice( $arr_temp, ($key+1), 0, "sys_format_stepava" );
                                    $bol_achou = true;
                                    break;
                                }
                            }
                            $arr_toolbar[ $change ] = $arr_temp;
                        }
                    }
                }
                if($bol_achou)
                {
                    $obj_app->attr3->SetTag('toolbars', $arr_toolbar);
                    $obj_app->saveAttrN(array(3=>""));
                }
            }
        }
    }

    //troca no sistema
    foreach($arr_bars as $bar)
    {
        $bol_change  = false;
        $arr_toolbar = $nm_ini_sys->GetTag( $bar );
        $test        = serialize($arr_toolbar);
        $bol_achou = false;
        if(strpos($test, 'sys_format_stepret') === false)
        {
            foreach($arr_toolbar as $change => $arr_btns)
            {
                foreach($arr_btns as $key => $btn)
                {
                    if($btn == 'sys_format_ret')
                    {
                        array_splice( $arr_toolbar[ $change ], ($key+1), 0, "sys_format_stepret" );
                        $bol_change = true;
                        break 2;
                    }
                }
            }
        }
        if(strpos($test, 'sys_format_stepava') === false)
        {
            foreach($arr_toolbar as $change => $arr_btns)
            {
                foreach($arr_btns as $key => $btn)
                {
                    if($btn == 'sys_format_ava')
                    {
                        array_splice( $arr_toolbar[ $change ], ($key+1), 0, "sys_format_stepava" );
                        $bol_change = true;
                        break 2;
                    }
                }
            }
        }
        if($bol_change)
        {
            $nm_ini_sys->SetTag($bar, $arr_toolbar);
            $nm_ini_sys->Save();
        }
    }
}
$return = true;
    
?>
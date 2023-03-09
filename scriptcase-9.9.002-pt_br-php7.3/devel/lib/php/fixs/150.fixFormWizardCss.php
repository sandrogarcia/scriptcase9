<?php

	{
		$arr_path   = array(
							'sys'        => $nm_config['path_sys'],
	                        'grp'        => $nm_config['path_grp'],
	                        'usr'        => $nm_config['path_usr'],
	                        );

		$arr_list = array();
		foreach ($arr_path as $str_mod => $str_path)
		{
			if($str_mod == 'scriptcase' || $str_mod == 'sys')
			{
				if(is_dir($str_path . "schema/"))
				{
					$arr_schemas = array_diff(scandir($str_path. "schema/"), array('.','..', 'index.html'));
                    if(isset($arr_schemas) && is_array($arr_schemas) && !empty($arr_schemas))
                    {
                        foreach($arr_schemas as $schema)
                        {
                            if(substr($schema, -3) == 'ini')
                            {
                                $arr_list[$str_mod . '__NM__' . $schema] = $str_path . "schema/" . $schema;
                            }
                        }
					}
				}
			}
			else
			{
				$arr_childs = array_diff(scandir($str_path), array('.','..', 'index.html'));
				if(isset($arr_childs) && is_array($arr_childs) && !empty($arr_childs))
                {
                    foreach($arr_childs as $childs)
                    {
                        if(is_dir($str_path . $childs) && is_dir($str_path . $childs . "/schema/"))
                        {
                            $arr_schemas = array_diff(scandir($str_path . $childs), array('.','..', 'index.html'));
                            if(isset($arr_schemas) && is_array($arr_schemas) && !empty($arr_schemas))
                            {
                                foreach($arr_schemas as $schema)
                                {
                                    if(substr($schema, -3) == 'ini')
                                    {
                                        $arr_list[$str_mod . '__NM__' . $schema] = $str_path . $childs . "/schema/" . $schema;
                                    }
                                }
                            }
                        }
                    }
				}
			}
		}

		if(!empty($arr_list))
		{
		    foreach($arr_list as $schema)
            {
                $arr_schema = unserialize(file_get_contents($schema));

                if(!isset($arr_schema['schema']['css_form_wizardnav_moldura_background_color']))
                {
                    $arr_schema['schema']['css_form_wizardnav_stepdone_title_color']       = $arr_schema['schema']['css_form_label_impar_simples_color'];
                    $arr_schema['schema']['css_form_wizardnav_stepnow_title_color']        = $arr_schema['schema']['css_form_label_impar_simples_color'];
                    $arr_schema['schema']['css_form_wizardnav_stepnext_title_color']       = $arr_schema['schema']['css_form_label_impar_simples_color'];
                    $arr_schema['schema']['css_form_wizardnav_stepnextothers_title_color'] = $arr_schema['schema']['css_form_label_impar_simples_color'];

                    $arr_schema['schema']['css_form_wizardnav_stepdone_title_font']       = $arr_schema['schema']['css_form_label_impar_simples_font'];
                    $arr_schema['schema']['css_form_wizardnav_stepnow_title_font']        = $arr_schema['schema']['css_form_label_impar_simples_font'];
                    $arr_schema['schema']['css_form_wizardnav_stepnext_title_font']       = $arr_schema['schema']['css_form_label_impar_simples_font'];
                    $arr_schema['schema']['css_form_wizardnav_stepnextothers_title_font'] = $arr_schema['schema']['css_form_label_impar_simples_font'];

                    $arr_schema['schema']['css_form_wizardnav_stepdone_title_font_size']       = $arr_schema['schema']['css_form_label_impar_simples_font_size'];
                    $arr_schema['schema']['css_form_wizardnav_stepnow_title_font_size']        = $arr_schema['schema']['css_form_label_impar_simples_font_size'];
                    $arr_schema['schema']['css_form_wizardnav_stepnext_title_font_size']       = $arr_schema['schema']['css_form_label_impar_simples_font_size'];
                    $arr_schema['schema']['css_form_wizardnav_stepnextothers_title_font_size'] = $arr_schema['schema']['css_form_label_impar_simples_font_size'];

                    file_put_contents($schema, serialize($arr_schema));
                }
            }
		}
    }

$return = true;
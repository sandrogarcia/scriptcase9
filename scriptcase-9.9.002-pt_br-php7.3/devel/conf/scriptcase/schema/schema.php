<?php

    #   Chaging schemas settings
    #   File path: devel/conf/scriptcase/schema/schema.php
    #   Author: John L. Santos

    $path = scandir(__DIR__);

    $restrict_file      = array(".", 
                                "..", 
                                "index.html", 
                                "schema.php", 
                                "telematica_suricato.ini");

    $specific_version   = array("Sc8", 
                                "Sc9");

    $specific_theme     = array("BlueBerry", 
                                "Lemon", 
                                "Meadow", 
                                "Sc9_Rhino", 
                                "Sc8_BlueWood", 
                                "Sc7_Black", 
                                "Midnight", 
                                "Sc7_BlueSky", 
                                "Sc7_Softgray", 
                                "Sc6_Cromo", 
                                "Sc4_LigthGray", 
                                "Sc4_Musgo", 
                                "Sc4_Olive", 
                                "Sc4_Sunny", 
                                "Sc4_Money");

    foreach($path as $schema) {
        if (!in_array($schema, $restrict_file)) {

            # Schema version
            $version    = substr($schema, 0, 3);

            $content    = file_get_contents($schema);
            $un         = unserialize($content);

            # Specific versions
            //BEGIN
            if (in_array($version, $specific_version)) {
                # Eg.:
                # $un["schema"]["css_grid_label_background_color"]  = "";
                # <Apply here>

            }
            //END

            # Specific themes
            //BEGIN
            if (in_array($un["schema"]["css_schema_info_name"], $specific_theme)) {
                # Eg.:
                # $un["schema"]["css_grid_label_background_color"]  = "";
                # <Apply here>

            }
            //END

            //BEGIN
            # General themes
            # Eg.:
            # $un["schema"]["css_grid_label_background_color"]  = "";
            # <Apply here>
            $un["schema"]["css_menu_line_background_color"]             = $un["schema"]["css_menu_header_background_color"];
            $un["schema"]["css_menu_menu_bar_color"]                    = $un["schema"]["css_menu_header_color"];
            $un["schema"]["css_menu_menu_bar_background_color"]         = $un["schema"]["css_menu_header_background_color"];
            $un["schema"]["css_menu_menu_barhover_color"]               = $un["schema"]["css_menu_header_color"];
            $un["schema"]["css_menu_menu_barhover_background_color"]    = $un["schema"]["css_menu_header_background_color"];
            $un["schema"]["css_menu_menu_barhover_opacity"]             = "60";
            $un["schema"]["css_menu_menu_bardisabled_color"]            = $un["schema"]["css_menu_header_color"];
            $un["schema"]["css_menu_menu_bardisabled_background_color"] = $un["schema"]["css_menu_header_background_color"];
            $un["schema"]["css_menu_menu_bardisabled_opacity"]          = "40";
            $un["schema"]["css_menu_subline_background_color"]          = $un["schema"]["css_menu_header_background_color"];
            $un["schema"]["css_menu_item_bar_color"]                    = $un["schema"]["css_menu_header_color"];
            $un["schema"]["css_menu_item_bar_background_color"]         = $un["schema"]["css_menu_header_background_color"];
            $un["schema"]["css_menu_item_barhover_color"]               = $un["schema"]["css_menu_header_color"];
            $un["schema"]["css_menu_item_barhover_background_color"]    = $un["schema"]["css_menu_header_background_color"];
            $un["schema"]["css_menu_item_barhover_opacity"]             = "60";
            $un["schema"]["css_menu_item_bardisabled_color"]            = $un["schema"]["css_menu_header_color"];
            $un["schema"]["css_menu_item_bardisabled_background_color"] = $un["schema"]["css_menu_header_background_color"];
            $un["schema"]["css_menu_item_bardisabled_opacity"]          = "40";

            //END

            // BEGIN
            # Checks whether the theme has a light or dark background
            $color  = $un["schema"]["css_grid_pagina_background_color"];
            $color  = ($color != "" && strlen($color) >= "5") ? $color : "#FFFFFF";

            $r      = hexdec(substr($color,1,2));
            $g      = hexdec(substr($color,3,2));
            $b      = hexdec(substr($color,5,2));
            $calc   = ($r * 299 + $g * 587 + $b * 114) / 1000;


            if ($calc > 128) {
                # $un["schema"]["css_toast_table_background_color"]   = "#38485F"; //Dark

            } else {
                # $un["schema"]["css_toast_table_background_color"]   = "#FFFFFF"; //Light

            }
            // END

            # Apply changes
            //BEGIN
            $new = serialize($un);
            file_put_contents($schema, $new);

            if ($new != $content) {
                echo "Schema " . $un["schema"]["css_schema_info_name"] . " changed successfully!<br />";
            } else {
                echo "No changes to schema " . $un["schema"]["css_schema_info_name"] . ".<br />";
            }
            //END
        }
    }
?>
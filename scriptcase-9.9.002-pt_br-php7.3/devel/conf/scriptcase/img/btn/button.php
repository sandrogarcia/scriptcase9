<?php

    #   Chaging buttons settings
    #   File path: devel/conf/scriptcase/img/btn/button.php
    #   Author: John L. Santos

    $path = scandir(__DIR__);

    $restrict_file      = array(".", "..", "index.html", "button.php", "btn_menu.png");
    $specific_version   = array("scriptcase3", "scriptcase4", "scriptcase5", "scriptcase6", "scriptcase7", "scriptcase8");
    $specific_theme     = array("scriptcase9_SweetAmour", "scriptcase9_SweetBlue", "scriptcase9_Midnight", "scriptcase9_SweetCoral", "scriptcase9_SweetGoldenSand", "scriptcase9_SweetHollyhock");

    foreach ($path as $btn) {
        if (!in_array($btn, $restrict_file)) {
            $path = scandir($btn);

            # Buttons version
            $version = explode("_", $btn);
            $version = strtolower($version[0]);

            # Image path
            $image = "scriptcase__NM__btn__NM__" . $btn . "__NM__nm_" . $btn . "_";

            /*
            $properties = array('filter' => '',
                               'img_filter' => '');

            $type = 'clicked';

            function addProperties (&$ar, $properties, $type) {
               foreach ($ar as $i => $a) {
                   if ($i === $type) {
                       foreach ($properties as $ii => $p) {
                           $ar[$i][$ii] = $p;
                       }
                       print_r($ar);
                   } else if (is_array($a)) {
                       addProperties($ar[$i], $properties, $type);
                   }
               }
            }
            addProperties($ar, $properties, $type);
            */

            foreach ($path as $file) {
                if ($file == "button.ini") {
                    $content    = file_get_contents($btn . "/" . $file);
                    $un         = unserialize($content);

                    foreach ($un["button"]["list"] as $btn_key => $btn_value) {

                        if (isset($btn_value["display_position"]) && $btn_value["display_position"] != "") {
                            $btn_value["display_position_rtl"] = $btn_value["display_position"];
                            $un["button"]["list"][$btn_key] = $btn_value;
                        }

                        if (isset($btn_value["fontawesomeicon"]) && $btn_value["fontawesomeicon"] != "") {
                            $btn_value["fontawesomeicon_rtl"] = $btn_value["fontawesomeicon"];
                            $un["button"]["list"][$btn_key] = $btn_value;
                        }

                        if (isset($btn_value["image_path"]) && $btn_value["image_path"] != "") {
                            $btn_value["image_path_rtl"] = $btn_value["image_path"];
                            $un["button"]["list"][$btn_key] = $btn_value;
                        }

                        switch ($btn_key) {
                            case "bcons_inicio":
                                if (isset($un["button"]["list"]["bcons_final"]["fontawesomeicon"]) && $un["button"]["list"]["bcons_final"]["fontawesomeicon"] != "") {
                                    $un["button"]["list"][$btn_key]["fontawesomeicon_rtl"] = $un["button"]["list"]["bcons_final"]["fontawesomeicon"];
                                }
                            break;
                            case "bcons_retorna":
                                if (isset($un["button"]["list"]["bcons_avanca"]["fontawesomeicon"]) && $un["button"]["list"]["bcons_avanca"]["fontawesomeicon"] != "") {
                                    $un["button"]["list"][$btn_key]["fontawesomeicon_rtl"] = $un["button"]["list"]["bcons_avanca"]["fontawesomeicon"];
                                }
                            break;
                            case "bcons_avanca":
                                if (isset($un["button"]["list"]["bcons_retorna"]["fontawesomeicon"]) && $un["button"]["list"]["bcons_retorna"]["fontawesomeicon"] != "") {
                                    $un["button"]["list"][$btn_key]["fontawesomeicon_rtl"] = $un["button"]["list"]["bcons_retorna"]["fontawesomeicon"];
                                }
                            break;
                            case "bcons_final":
                                if (isset($un["button"]["list"]["bcons_inicio"]["fontawesomeicon"]) && $un["button"]["list"]["bcons_inicio"]["fontawesomeicon"] != "") {
                                    $un["button"]["list"][$btn_key]["fontawesomeicon_rtl"] = $un["button"]["list"]["bcons_inicio"]["fontawesomeicon"];
                                }
                            break;
                            case "binicio":
                                if (isset($un["button"]["list"]["bfinal"]["fontawesomeicon"]) && $un["button"]["list"]["bfinal"]["fontawesomeicon"] != "") {
                                    $un["button"]["list"][$btn_key]["fontawesomeicon_rtl"] = $un["button"]["list"]["bfinal"]["fontawesomeicon"];
                                }
                            break;
                            case "bretorna":
                                if (isset($un["button"]["list"]["bavanca"]["fontawesomeicon"]) && $un["button"]["list"]["bavanca"]["fontawesomeicon"] != "") {
                                    $un["button"]["list"][$btn_key]["fontawesomeicon_rtl"] = $un["button"]["list"]["bavanca"]["fontawesomeicon"];
                                }
                            break;
                            case "bavanca":
                                if (isset($un["button"]["list"]["bretorna"]["fontawesomeicon"]) && $un["button"]["list"]["bretorna"]["fontawesomeicon"] != "") {
                                    $un["button"]["list"][$btn_key]["fontawesomeicon_rtl"] = $un["button"]["list"]["bretorna"]["fontawesomeicon"];
                                }
                            break;
                            case "bfinal":
                                if (isset($un["button"]["list"]["binicio"]["fontawesomeicon"]) && $un["button"]["list"]["binicio"]["fontawesomeicon"] != "") {
                                    $un["button"]["list"][$btn_key]["fontawesomeicon_rtl"] = $un["button"]["list"]["binicio"]["fontawesomeicon"];
                                }
                            break;
                            case "bstepretorna":
                                if (isset($un["button"]["list"]["bstepavanca"]["fontawesomeicon"]) && $un["button"]["list"]["bstepavanca"]["fontawesomeicon"] != "") {
                                    $un["button"]["list"][$btn_key]["fontawesomeicon_rtl"] = $un["button"]["list"]["bstepavanca"]["fontawesomeicon"];
                                }
                            break;
                            case "bstepavanca":
                                if (isset($un["button"]["list"]["bstepretorna"]["fontawesomeicon"]) && $un["button"]["list"]["bstepretorna"]["fontawesomeicon"] != "") {
                                    $un["button"]["list"][$btn_key]["fontawesomeicon_rtl"] = $un["button"]["list"]["bstepretorna"]["fontawesomeicon"];
                                }
                            break;
                        }

                    }
                    
                    # Specific versions
                    //BEGIN
                    if (in_array($version, $specific_version)) {
                        # Eg.:
                        # $un["button"]["list"]["blimparsummaryfield"]["image_path"] = $image . "blimparsummaryfield.gif";
                        # <Apply here>

                    }
                    //END

                    # Specific themes
                    //BEGIN
                    if (in_array($btn, $specific_theme)) {
                        # Eg.:
                        # $un["button"]["list"]["blimparsummaryfield"]["image_path"] = $image . "blimparsummaryfield.gif";
                        # <Apply here>                        

                    }
                    //END

                    # General themes
                    //BEGIN
                    # Eg.:
                    # $un["button"]["list"]["blimparsummaryfield"]["image_path"] = $image . "blimparsummaryfield.gif";
                    # <Apply here>
                    //END

                    # Apply changes
                    //BEGIN
                    $new    = serialize($un);
                    $path   = __DIR__ . "/" . $btn . "/" . $file;
                    file_put_contents($path, $new);

                    if ($new != $content) {
                        echo "Button " . $btn . " changed successfully!<br />";
                    } else {
                        echo "No changes to button " . $btn . ".<br />";
                    }
                    //END
                }
            }
        }
    }
?>
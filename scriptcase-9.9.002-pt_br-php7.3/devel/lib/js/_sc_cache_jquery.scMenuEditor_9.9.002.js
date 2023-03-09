/**
 * v1.1
 */

(function($) {

    $.fn.editMenu = function(options) {
        return this.each(function() {
            $.scMenuEditor.setMenu(this, options);
        });
    } // editMenu

    $.fn.reloadFromField = function() {
        $.scMenuEditor.reloadFromField();
    } // reload

    $.scMenuEditor = {

        reloadFromField: function() {
                var $data    = $.scMenuEditorData;

                $data.itemList = new Array();
                $data.lastItem = 0;
                $data.selectedItem = "";
                $data.selectedIndex = -1;

                strVal = $('input[name="' + $data.field + '"]').val();

                if(strVal != "")
                {
                    arrVal = strVal.split("_@NM@_");
                    for (i = 0; i < arrVal.length; i++) {
                        itemData = arrVal[i].split("_!NM!_");

                        $data.itemList[i] = {
                            "id": "sc-js-menu-" + $data.field + "-item" + (i+1),
                            "sc_id":itemData[0],
                            "label":itemData[1],
                            "link":itemData[2],
                            "target":itemData[3],
                            "icon":itemData[4],
                            "hint":itemData[5],
                            "level":(itemData[6]-1),
                            "display":itemData[7],
                            "display_pos":itemData[8],
                            "icon_aba":itemData[10],
                            "icon_aba_inactive":itemData[11],
                            "icon_fa":itemData[12],
                            "icon_color":itemData[15],
                            "icon_color":itemData[16],
                            "icon_color_disabled":itemData[17],
                        }

                        if(itemData[0].substring(5) > $data.lastItem)
                        {
                            $data.lastItem = itemData[0].substring(5);
                        }
                    }
                }
                this._includeInitialItems();
                $data.menu._updateSubmitValue();
                $data.menu._updateView();
        }, // reloadFromField

        setMenu: function(elem, options) {
            var $data        = $.scMenuEditorData,
                localOptions = {
                    menu  : this,
                    target: elem,
                    uiName: "sc-js-menu-" + options.field + "-"
                };
            $.extend($.scMenuEditorData, localOptions, options);

            $data.initTheme = $('input[name="' + $data.fieldTheme + '"]').val();

            this._renderUI();
            if (0 < $data.itemList.length) {
                $("#" + $data.uiName + "example").hide();
                this._includeInitialItems();
            }
            else {
                $("#" + $data.uiName + "example").show();
                this._updateView();
            }

            this._enableForm();
        }, // setMenu

        _renderUI: function() {
            var $data = $.scMenuEditorData,
                html, tplBasic, i, iBr, $tplList, iconId;

            if ("" != $data.initTheme) {
                tplBasic = $data.initTheme.substr(0, $data.initTheme.indexOf("_"));
            }
            else {
                tplBasic = "";
            }

            html  = "<div class=\"sc-ui-menu-editor\">";

            html +=  "<div style=\"border-collapse: collapse; border-width: 0\"><div><div style=\"display: flex; flex-direction: row; justify-content: flex-start; align-items: stretch;\">";

            html +=  "<div class=\"\" style='margin-right: 10px; display: flex; flex-direction: column; justify-items: flex-start; align-items: stretch;'>";
            html +=   "<ul class=\"ui card sc-toolbar\" style='display: flex; flex-direction: row; justify-items: center; align-items: center; height: 40px; list-style: none; margin: 0px; padding: 0 10px 0 10px;'>";
            html +=    "<li id=\"" + $data.uiName + "chk-all\" style='margin-right: 10px'><input type=\"checkbox\" id=\"" + $data.uiName + "checkall\" /></li>";
            html +=    "<li id=\"" + $data.uiName + "btn-newitem\" title=\"" + $data.langNewItem + "\"><i class=\"icon plus green\"></i></li>";
            html +=    "<li id=\"" + $data.uiName + "btn-newsub\" title=\"" + $data.langNewSub + "\"><i class=\"icon level down alternate green\"></i></li>";
            html +=    "<li id=\"" + $data.uiName + "btn-remove\" title=\"" + $data.langRemove + "\"><i class=\"icon fas fa-times red\"></i></li>";
            html +=    "<li style='flex-grow: 1;'></li>";
            html +=    "<li id=\"" + $data.uiName + "btn-import\" title=\"" + $data.langImport + "\"><i class=\"icon fas fa-download\"></i></li>";
            html +=    "<li id=\"" + $data.uiName + "btn-moveup\" title=\"" + $data.langUp + "\"><i class=\"icon fas fa-chevron-up\"></i></li>";
            html +=    "<li id=\"" + $data.uiName + "btn-movedown\" title=\"" + $data.langDown + "\"><i class=\"icon fas fa-chevron-down\"></i></li>";
            html +=    "<li id=\"" + $data.uiName + "btn-moveleft\" title=\"" + $data.langLeft + "\"><i class=\"icon fas fa-chevron-left\"></i></li>";
            html +=    "<li id=\"" + $data.uiName + "btn-moveright\" title=\"" + $data.langRight + "\"><i class=\"icon fas fa-chevron-right\"></i></li>";
            html +=   "</ul>";
            html +=   "<div class=\"sc-ui-menu-itemtree\" style='padding: 10px; flex-grow: 1; height: auto;' >";
            html +=    "<ul id=\"" + $data.uiName + "itemtree\" style='max-height: 360px;'>";
            html +=    "</ul>";
            html +=   "</div>";

            html +=  "</div>";
            html +=  "<div style=\"padding: 0; flex-grow: 1; display: flex; flex-direction: row; justify-content: flex-start; align-items: stretch; margin-right: 10px;\">";

            html +=  "<div class=\"ui card form\" style='padding: 30px; flex-grow: 1;'>";
            html +=    "<h4 class=\"\" style='text-align: center;'>" + $data.langProperties  + "</h4>";
            html +=   "<div class=\"properties-form disabled-form\" style='opacity: 0.2'>";
            html +=    "<div class='sc-field-row'>";
            html +=    "<div class='ui field'><label class=\"sc-ui-menu-text\" style='display: inline-block;'>ID:</label> <span class=\"sc-ui-menu-text\" id=\"" + $data.uiName + "ipt-id\">-</span></div>";
            html +=    "</div>";
            html +=    "<div class='sc-field-row'>";
            html +=    "<div class='ui field'><label class=\"sc-ui-menu-text\">" + $data.langLabel  + "</label><div class='ui input'><input disabled type=\"text\" id=\"" + $data.uiName + "ipt-label\" /></div></div>";
            html +=    "<div class='ui field'><label class=\"sc-ui-menu-text\">" + $data.langHint   + "</label><div class='ui input'><input disabled type=\"text\" id=\"" + $data.uiName + "ipt-hint\" /></div></div>";
            html +=    "</div>";
            html +=    "<div class='sc-field-row'>";
            html +=    "<div class='ui field' style='max-width: 100%;'><label class=\"sc-ui-menu-text\">" + $data.langLink   + "</label><div class='ui input'><input disabled type=\"text\" id=\"" + $data.uiName + "ipt-link\" name=\"sc_item_link\" style='max-width: calc(100% - 35px);' /><img src=\"" + $data.iconLink + "\" id=\"" + $data.uiName + "ipt-icon-link\" class=\"sc-ui-menu-icon-link\" /></div></div>";
            html +=    "</div>";
            html +=    "<div class='sc-field-row pos-row'>";
            html +=    "<div class='ui field pos-field'><label class=\"sc-ui-menu-text\">" + $data.langDisplayPos + "</label>";
            html +=    "<select disabled id=\"" + $data.uiName + "ipt-display-pos\">";
            html +=     "<option value=\"text_right\">"   + $data.langDisplayPosTextRight   + "</option>";
            html +=     "<option value=\"img_right\">"  + $data.langDisplayPosImgRight  + "</option>";
            html +=    "</select></div>";
            displayDisplay = "";
            if($data.menuVersion == "menu2")
            {
                displayDisplay = "none";
            }
            html +=    "<div class='ui field' style='display:"+ displayDisplay +";'><label class=\"sc-ui-menu-text\">" + $data.langDisplay + "</label>";
            html +=    "<select disabled id=\"" + $data.uiName + "ipt-display\">";
            html +=     "<option value=\"text_img\">"   + $data.langImage   + "</option>";
            html +=     "<option value=\"text_fontawesomeicon\" style='" + (($data.is94) ? 'color: #008000;' : '' )  + "'>"  + $data.langFA  + "</option>";
            html +=    "</select></div>";
            html +=    "</div>";
            html +=    "<div class='sc-field-row'>";
            html +=    "<div class='ui field' style='display: none;'><label class=\"sc-ui-menu-text\">" + $data.langIcon   + "</label><div class='ui input'><input disabled onfocus=\"startFontAwesomeField(this);\" value='fas fa-cog' onchange=\"updateIconPreview($(this).val(), $(this).parent().parent().find('#icon-preview'));\" type=\"text\" id=\"" + $data.uiName + "ipt-icon-fa\" name=\"sc_item_icon_fa\" style='max-width: calc(100% - 35px);' /><a><i onclick=\"$('#" + $data.uiName + "ipt-icon-fa').focus();\" id=\"icon-preview\" class='fas fa-cog'></i></a></div></div>";
            html +=    "<div class='ui field'><label class=\"sc-ui-menu-text\">" + $data.langIcon   + "</label><div class='ui input'><input disabled type=\"text\" id=\"" + $data.uiName + "ipt-icon\" name=\"sc_item_icon\" style='max-width: calc(100% - 35px);' /><img src=\"" + $data.iconIcon2 + "\" id=\"" + $data.uiName + "ipt-icon-icon2\" class=\"sc-ui-menu-icon-link\" alt=\"" + $data.langIcon2 + "\" title=\"" + $data.langIcon2 + "\" /></div></div>";
            html +=    "<div class='ui field'><label class=\"sc-ui-menu-text\">" + $data.langTarget + "</label>";
            html +=    "<select disabled id=\"" + $data.uiName + "ipt-target\">";
            html +=     "<option value=\"_self\">"   + $data.langSelf   + "</option>";
            html +=     "<option value=\"_blank\">"  + $data.langBlank  + "</option>";
            html +=     "<option value=\"_parent\">" + $data.langParent + "</option>";
            html +=    "</select></div>";
            html +=    "</div>";
            html +=    "<div class='sc-field-row'>";
            html +=    "<div class='ui field'><label class=\"sc-ui-menu-text\">" + $data.langIconAba   + "</label><div class='ui input'><input disabled type=\"text\" id=\"" + $data.uiName + "ipt-icon-aba\" name=\"sc_item_icon_aba\" style='max-width: calc(100% - 35px);' /><img src=\"" + $data.iconIcon2 + "\" id=\"" + $data.uiName + "ipt-icon-icon3\" class=\"sc-ui-menu-icon-link\" alt=\"" + $data.langIcon2 + "\" title=\"" + $data.langIcon2 + "\" /></div></div>";
            html +=    "<div class='ui field'><label class=\"sc-ui-menu-text\">" + $data.langIconAbaInactive   + "</label><div class='ui input'><input disabled type=\"text\" id=\"" + $data.uiName + "ipt-icon-aba-inactive\" name=\"sc_item_icon_aba_inactive\" style='max-width: calc(100% - 35px);' /><img src=\"" + $data.iconIcon2 + "\" id=\"" + $data.uiName + "ipt-icon-icon4\" class=\"sc-ui-menu-icon-link\" alt=\"" + $data.langIcon2 + "\" title=\"" + $data.langIcon2 + "\" /></div></div>";
            html +=    "<div class='ui field' style='display: none;'><label class=\"sc-ui-menu-text\">" + $data.langIconColor   + "</label><div class='ui input'><input disabled type=\"text\" id=\"" + $data.uiName + "ipt-icon-color\" name=\"sc_item_icon_color\" style=\" padding-right: 35px;\"  /><i id=\"" + $data.uiName + "ipt-icon-color-preview\" class='fas fa-square' style='position: absolute; top: 9px; right: 6px; font-size: 20px;'></i></div></div>";
            html +=    "<div class='ui field' style='display: none;'><label class=\"sc-ui-menu-text\">" + $data.langIconColorHover   + "</label><div class='ui input'><input disabled type=\"text\" id=\"" + $data.uiName + "ipt-icon-color-hover\" name=\"sc_item_icon_color_hover\" style=\" padding-right: 35px;\" /><i id=\"" + $data.uiName + "ipt-icon-color-hover-preview\" class='fas fa-square' style='position: absolute; top: 9px; right: 6px; font-size: 20px;'></i></div></div>";
            html +=    "</div>";
            html +=    "<div class='sc-field-row'>";
            html +=    "<div class='ui field' style='display: none;'><label class=\"sc-ui-menu-text\">" + $data.langIconColorDisabled   + "</label><div class='ui input'><input disabled type=\"text\" id=\"" + $data.uiName + "ipt-icon-color-disabled\" name=\"sc_item_icon_color_disabled\" style=\" padding-right: 35px;\" /><i id=\"" + $data.uiName + "ipt-icon-color-disabled-preview\" class='fas fa-square' style='position: absolute; top: 9px; right: 6px; font-size: 20px;'></i></div></div>";
            html +=    "</div>";
            html +=   "</div>";
            html +=  "</div>";
            html +=  "</div>";
            html +=  "<div id='menu-right-panel' class=\"\"  style=\"padding: 0; display: flex; flex-direction: row; justify-content: flex-start; align-items: stretch;\">";
            html +=   "<div id='orientation-theme' class='ui card' style='padding: 30px; flex-grow: 1;'>";
            html +=    "<h4>" + $data.langOrientacaoMenu + "</h4>";
            html +=    "<div id=\"interface_menu_orientacao\" style=\"width:100%\">";
            html += $data.menu._getOrientacao();
            html +=    "</div>";
            html +=    "<div id='orientation-theme-list'>";
            html +=    " <h4>" + $data.langTheme + "</h4>";
            html +=    " <select size='16' id=\"" + $data.uiName + "ipt-template\">";
            html += $data.menu._getThemeOptions("scriptcase");
            html += $data.menu._getThemeOptions("sys");
            html += $data.menu._getThemeOptions("grp");
            html += $data.menu._getThemeOptions("usr");
            html +=    " </select>";
            html +=    "</div>";
            html +=  "</div>";

            html +=  "</div></div></div>";

            html += "</div>";

            html += "<div style=\"clear: both; display: none;\">" + $data.langCheckUncheck + "</div>";

            html += "<div class=\"sc-ui-menu-preview\" id=\"" + $data.uiName + "preview\" style=\"display: none\">" + $data.langPreviewMenu + "<hr class=\"sc-ui-menu-hr genericBorderColor\" /></div>";
            html += "<div class=\"sc-ui-menu-example\" id=\"" + $data.uiName + "example\" style=\"display: none\">" + $data.langExampleMenu + "<hr class=\"sc-ui-menu-hr genericBorderColor\" /></div>";
            //html += "<div class=\"sc-ui-menu-view\" id=\"" + $data.uiName + "view\"></div>";
            html += "<div class=\"scMenuHTableCssAlt\" id=\"" + $data.uiName + "view\"></div>";

            html += "<div class=\"sc-ui-menu-icons-list genericBorderColor genericTitleBackground\" id=\"" + $data.uiName + "icons-list\">";
            html +=  "<span class=\"sc-ui-menu-text sc-ui-menu-header\">" + $data.langIconList + "</span>";
            html +=  "<div class=\"sc-ui-menu-icons-display\">";
            html +=  "</div>";
            html +=  "<span class=\"sc-ui-menu-text sc-ui-menu-header\">" + $data.langIconSize + "</span>";
            html +=  "<select id=\"" + $data.uiName + "icon-size\">";
            html +=   "<option value=\"16\">16</option>";
            html +=   "<option value=\"24\">24</option>";
            html +=   "<option value=\"32\">32</option>";
            html +=  "</select>";
            html +=  "<br />";
            html +=  "<input class=\"nmButton\" type=\"button\" value=\"" + $data.langButtonOk + "\" id=\"" + $data.uiName + "btn-icon-ok\" />";
            html +=  "<input class=\"nmButton\" type=\"button\" value=\"" + $data.langButtonCancel + "\" id=\"" + $data.uiName + "btn-icon-cancel\" />";
            html += "</div>";

            $($data.target).append(html);

            if ("" != $data.initTheme) {
                $("#" + $data.uiName + "ipt-template").val($data.initTheme);
            }

            $("#interface_menu_orientacao > input").bind("click", $data.menu._changeOrientacaoMenu);
            $("#" + $data.uiName + "btn-newitem").bind("click", $data.menu._addItem);
            $("#" + $data.uiName + "btn-newsub").bind("click", $data.menu._addSubitem);
            $("#" + $data.uiName + "btn-remove").bind("click", $data.menu._removeItem);
            $("#" + $data.uiName + "btn-import").bind("click", function() { nmImportApp("checkbox", "nmReceiveApp"); });
            $("#" + $data.uiName + "btn-moveup").bind("click", $data.menu._moveUp);
            $("#" + $data.uiName + "btn-movedown").bind("click", $data.menu._moveDown);
            $("#" + $data.uiName + "btn-moveleft").bind("click", $data.menu._moveLeft);
            $("#" + $data.uiName + "btn-moveright").bind("click", $data.menu._moveRight);

            $("#" + $data.uiName + "ipt-label").bind("input", $data.menu._updateItem);
            $("#" + $data.uiName + "ipt-link").bind("change", $data.menu._updateItem);
            $("#" + $data.uiName + "ipt-hint").bind("change", $data.menu._updateItem);
            $("#" + $data.uiName + "ipt-display-pos").bind("change", $data.menu._updateItem);

            $("#" + $data.uiName + "ipt-display").bind("change", function () {
                if (!$data.has94 && ['text_fontawesomeicon', 'only_fontawesomeicon'].indexOf($(this).val()) > -1 ) {
                    $(this).val('text_img');
                    nmFrmScaseRunFunc('noPermission');
                }
                $data.menu._updateItem();
            });

            $("#" + $data.uiName + "ipt-icon-fa").bind("change", $data.menu._updateItem);
            $("#" + $data.uiName + "ipt-icon").bind("change", $data.menu._updateItem);
            $("#" + $data.uiName + "ipt-icon-aba").bind("change", $data.menu._updateItem);
            $("#" + $data.uiName + "ipt-icon-aba-inactive").bind("change", $data.menu._updateItem);
            // $("#" + $data.uiName + "ipt-icon-color").bind("change", $data.menu._updateItem);
            // $("#" + $data.uiName + "ipt-icon-color-hover").bind("change", $data.menu._updateItem);
            // $("#" + $data.uiName + "ipt-icon-color-disabled").bind("change", $data.menu._updateItem);

            // $(function() {
                $('#' + $data.uiName + 'ipt-icon-color').colorpicker().on('changeColor', function (a) {
                    $('#' + $data.uiName + 'ipt-icon-color-preview').css('color', a.color.toString());
                    $data.menu._updateItem();
                });
                $('#' + $data.uiName + 'ipt-icon-color-preview').on('click', function () {
                    $('#' + $data.uiName + 'ipt-icon-color').focus();
                });

                $('#' + $data.uiName + 'ipt-icon-color-hover').colorpicker().on('changeColor', function (a) {
                    $('#' + $data.uiName + 'ipt-icon-color-hover-preview').css('color', a.color.toString());
                    $data.menu._updateItem();
                });
                $('#' + $data.uiName + 'ipt-icon-color-hover-preview').on('click', function () {
                    $('#' + $data.uiName + 'ipt-icon-color-hover').focus();
                });

                $('#' + $data.uiName + 'ipt-icon-color-disabled').colorpicker().on('changeColor', function (a) {
                    $('#' + $data.uiName + 'ipt-icon-color-disabled-preview').css('color', a.color.toString());
                    $data.menu._updateItem();
                });
                $('#' + $data.uiName + 'ipt-icon-color-disabled-preview').on('click', function () {
                    $('#' + $data.uiName + 'ipt-icon-color-disabled').focus();
                });
            // });

            $("#" + $data.uiName + "ipt-target").bind("change", $data.menu._updateItem);
            $("#" + $data.uiName + "ipt-template").bind("click", $data.menu._applyTemplate);

            $("#" + $data.uiName + "ipt-icon-link").bind("click", function(e) { if ($(e.target).closest('.properties-form').is('.disabled-form')) { return false; } nmImportApp("radio", "sc_item_link"); });
            $("#" + $data.uiName + "ipt-icon-icon2").bind("click", function(e) { if ($(e.target).closest('.properties-form').is('.disabled-form')) { return false; } nm_window_image_new("ico","form_edit", "sc_item_icon", "scReceiveIcon"); });
            $("#" + $data.uiName + "ipt-icon-icon3").bind("click", function(e) { if ($(e.target).closest('.properties-form').is('.disabled-form')) { return false; } nm_window_image_new("ico","form_edit", "sc_item_icon_aba", "scReceiveIcon"); });
            $("#" + $data.uiName + "ipt-icon-icon4").bind("click", function(e) { if ($(e.target).closest('.properties-form').is('.disabled-form')) { return false; } nm_window_image_new("ico","form_edit", "sc_item_icon_aba_inactive", "scReceiveIcon"); });

            $("#" + $data.uiName + "btn-icon-ok").bind("click", $data.menu._iconOk);
            $("#" + $data.uiName + "btn-icon-cancel").bind("click", $data.menu._iconCancel);

            $("#" + $data.uiName + "checkall").bind("click", $data.menu._checkAll);

            $data.menu._fixSize();

            //$data.menu._preloadIcons();
        }, // _renderUI

        _fixSize: function() {
            var $data   = $.scMenuEditorData,
                $center   = $(".sc-ui-menu-itemdata"),
                $right    = $(".sc-ui-menu-style"),
//                $lastDiv  = $(".sc-ui-menu-style.lastDiv"),
                iMax;

            if ($center.height() > $right.height()) {
                iMax = $center.height() +30;
            }
            else {
                iMax = $right.height();
            }
            $center.css('height', iMax + 'px');
            $right.css('height', iMax + 'px');
            $(".sc-ui-menu-itemtree").css('height', iMax - $(".sc-ui-menu-toolbar").height() + 10 + 'px');
            $data.menu._applyTemplate('fixSize');
        }, // _fixSize

        _getIconUrl: function(iconFile) {
            var $data = $.scMenuEditorData,
                parts, iconModule, iconDir, iconName, imageSuffix;

            var iconFilePath;
            var icon_file_aux = iconFile.split('__NM__');
            switch(icon_file_aux.length) {
                case 1:
                    iconFilePath = $data.imagePath['scriptcase'] + 'ico/' + icon_file_aux[0];
                break;
                case 2:
                    iconFilePath = $data.imagePath[icon_file_aux[0]] + 'ico/' + icon_file_aux[1];
                break;
                default:
                    if (icon_file_aux.length > 3) {
                        icon_file_aux[2] = icon_file_aux[2] +'/'+ icon_file_aux[3];
                    }
                    iconFilePath = $data.imagePath[icon_file_aux[0]] + icon_file_aux[1] + '/' + icon_file_aux[2];
                break;
            }
            return iconFilePath;
        }, // _getIconUrl

        _loadIcons: function() {
            var $data = $.scMenuEditorData;

            if ($data.iconsLoaded) {
                return;
            }

            $data.iconsLoaded = true;

            for (i = 0; i < $data.iconList.length; i++) {
                iconId = $data.iconList[i].substr(0, $data.iconList[i].length - 7);
                $(".sc-ui-menu-icons-display").append("<img src=\"" + $data.menu._getIconUrl($data.iconList[i]) + "\" id=\"sc-icon-" + iconId + "\" class=\"sc-ui-menu-icons-img\">");
            }

            $(".sc-ui-menu-icons-img").bind("click", $data.menu._selectIcon);
        }, // _loadIcons

        _preloadIcons: function() {
            var $data   = $.scMenuEditorData,
                imgList = [];

            for (i = 0; i < $data.iconList.length; i++) {
                imgList.push( $("<img />").attr("src", $data.menu._getIconUrl($data.iconList[i])) );
            }
        }, // _preloadIcons

        _changeOrientacaoMenu: function() {
            var $data = $.scMenuEditorData;
            $('#interface_menu_orientacao > input').prop('checked' , false);
            $('#'+this.id).prop('checked' , true);
            if ($('#menu_orientacao').val() != $('#'+this.id).val())
            {
                $('#menu_orientacao').val($('#'+this.id).val());
                nm_form_modified();
                $data.menu._applyTemplate();
            }
        }, // _changeOrientacaoMenu

        _addItem: function() {
            var $data = $.scMenuEditorData;

            $data.menu._includeItem("item");

            $data.menu._updateSubmitValue();
            $data.menu._updateView();

            nm_form_modified();
        }, // _addItem

        _addSubitem: function() {
            var $data = $.scMenuEditorData;

            $data.menu._includeItem("sub");

            $data.menu._updateSubmitValue();
            $data.menu._updateView();

            nm_form_modified();
        }, // _addSubitem

        _importItens: function(itemString) {
            var $data = $.scMenuEditorData,
                itemList, i, itemData, appData;

            if ("" == itemString) {
                return;
            }

            itemList = itemString.split("__NM__");

            for (i = 0; i < itemList.length; i++) {
                itemData = $data.menu._newItem();
                appData  = itemList[i].split("_!NM!_");

                itemData.label = appData[1];
                itemData.link  = "" != appData[0]
                               ? appData[0] + "/" + appData[1]
                               : appData[1];

                $data.importedItem = itemData;
                $data.menu._includeItem("import");

                $("#cb-" + itemData.id).prop("checked", true);
            }

            $data.menu._updateSubmitValue();
            $data.menu._updateView();

            nm_form_modified();
        }, // _importItens

        _includeInitialItems: function() {
            var $data  = $.scMenuEditorData,
                lastId = "",
                itemData, html, i;

            $("#" + $data.uiName + "itemtree").html("");

            for (i = 0; i < $data.itemList.length; i++) {
                itemData  = $data.itemList[i];

                html = "<li class=\"sc-ui-menu-item\" id=\"" + itemData.id + "\"><input type=\"checkbox\" class=\"sc-ui-menu-item-move\" id=\"cb-" + itemData.id + "\" /> <span id=\"" + itemData.id + "-span\" style=\"padding-left: " + $data.menu._itemLabelPadding(itemData.level) + "\">" + itemData.label + "</span></li>";

                if ("" == lastId) {
                    $("#" + $data.uiName + "itemtree").append(html);
                }
                else {
                    $("#" + lastId).after(html);
                }

                lastId = itemData.id;

                $("#" + itemData.id).bind("click", $data.menu._selectItem);
            }

            $data.menu._updateSubmitValue();
            $data.menu._updateView();
        }, // _includeInitialItems

        _includeItem: function(location) {
            var $data    = $.scMenuEditorData,
                itemId   = $data.uiName + "item" + (++$data.lastItem),
                itemScId = "item_" + $data.lastItem,
                itemData = $data.menu._newItem(),
                itemPos  = 0,
                html, i;

            if ("import" == location) {
                itemData = $data.importedItem;
                location = "item";
            }
            else {
                itemData = $data.menu._newItem();

                itemData.label = "Item " + $data.lastItem;
            }

            itemData.id    = itemId;
            itemData.sc_id = itemScId;

            if ("" == $data.selectedItem) {
                itemPos = $data.itemList.length;

                $data.itemList[itemPos] = itemData;
            }
            else {
                itemPos = $data.selectedIndex + 1;

                if ("sub" == location) {
                    itemData.level = parseInt($data.itemList[ $data.selectedIndex ].level) + 1;
                }
                else {
                    itemData.level = $data.itemList[ $data.selectedIndex ].level;
                    while ($data.itemList[itemPos] && itemData.level < $data.itemList[itemPos].level) {
                        itemPos++;
                    }
                }

                $data.itemList.splice(itemPos, 0, itemData);
            }

            html = "<li class=\"sc-ui-menu-item\" id=\"" + itemId + "\"><input type=\"checkbox\" class=\"sc-ui-menu-item-move\" id=\"cb-" + itemData.id + "\" /> <span id=\"" + itemId + "-span\" style=\"padding-left: " + $data.menu._itemLabelPadding(itemData.level) + "\">" + itemData.label + "</span></li>";

            if (0 == itemPos) {
                $("#" + $data.uiName + "itemtree").append(html);
            }
            else {
                $("#" + $data.itemList[itemPos - 1].id).after(html);
            }

            $("#" + itemId).bind("click", $data.menu._selectItem);

            if ("import" != location) {
                $("#" + itemId).trigger("click");
            }
        }, // _includeItem

        _newItem: function() {
            return {
                label : "",
                level : 0,
                link  : "",
                hint  : "",
                id    : "",
                display_pos  : "text_right",
                display  : "text_img",
                icon_fa  : "fas fa-cog",
                icon  : "",
                icon_aba  : "",
                icon_aba_inactive  : "",
                icon_color  : "",
                icon_color_hover  : "",
                icon_color_disabled  : "",
                target: "_self",
                sc_id : 0
            };
        }, // _newItem

        _removeItem: function() {
            var $data         = $.scMenuEditorData,
                removeType    = $data.menu._getMoveType(),
                selectedItems = new Array(),
                itemLevel, i;

            if ("checked" == removeType) {
                selectedItems = $data.menu._getMoveItems();
            }
            else if ("" != $data.selectedItem) {
                selectedItems[0] = $data.selectedIndex;
            }

            if (0 == selectedItems.length) {
                return;
            }

            for (i = selectedItems.length - 1; i >= 0; i--) {
                itemLevel = $data.itemList[ selectedItems[i] ].level;

                $("#" + $data.itemList[ selectedItems[i] ].id).remove();
                $data.itemList.splice(selectedItems[i], 1);
            }

            $data.menu._clearForm();
            $data.menu._updateSubmitValue();
            $data.menu._updateView();

            $data.selectedIndex = -1;
            $data.selectedItem = "";

            nm_form_modified();
        }, // _removeItem

        _selectIcon: function() {
            var $data  = $.scMenuEditorData,
                itemId = $(this).attr("id");

            if ("" != $data.selectedIcon) {
                $("#" + $data.selectedIcon).removeClass("sc-ui-selected-icon");
            }

            $data.selectedIcon = itemId;

            $("#" + itemId).addClass("sc-ui-selected-icon");
        }, // _selectIcon

        _selectItem: function() {
            var $data  = $.scMenuEditorData,
                itemId = $(this).attr("id"),
                itemSel, i;


            if ("link-" == itemId.substr(0, 5)) {
                itemId = itemId.substr(5);
            }

            if ("" != $data.selectedItem) {
                $("#" + $data.selectedItem).removeClass("sc-ui-menu-itemsel");
            }

            $("#" + itemId).addClass("sc-ui-menu-itemsel");
            if ($data.selectedItem != itemId) {
                $data.modAllowed = false;
                $data.selectedItem = itemId;

                for (i = 0; i < $data.itemList.length; i++) {
                    if ($data.selectedItem == $data.itemList[i].id) {
                        $data.selectedIndex = i;
                        itemSel             = $data.itemList[i];

                        break;
                    }
                }
                $('.properties-form').removeClass('disabled-form');
                $('.properties-form').css({opacity: '1'});
                $('.properties-form').find('input, select').attr('disabled', false);

                $("#" + $data.uiName + "ipt-id").html("(" + itemSel.sc_id + ")");
                $("#" + $data.uiName + "ipt-label").val(itemSel.label);
                $("#" + $data.uiName + "ipt-link").val(itemSel.link);
                $("#" + $data.uiName + "ipt-hint").val(itemSel.hint);
                $("#" + $data.uiName + "ipt-display-pos").val(itemSel.display_pos);
                if($data.menuVersion == "menu2")
                {
                    $("#" + $data.uiName + "ipt-display").val('text_fontawesomeicon');
                }else
                {
                    $("#" + $data.uiName + "ipt-display").val(itemSel.display);
                }
                $("#" + $data.uiName + "ipt-icon-fa").val(itemSel.icon_fa);
                $("#" + $data.uiName + "ipt-icon").val(itemSel.icon);
                $("#" + $data.uiName + "ipt-icon-aba").val(itemSel.icon_aba);
                $("#" + $data.uiName + "ipt-icon-aba-inactive").val(itemSel.icon_aba_inactive);
                $("#" + $data.uiName + "ipt-target").val(itemSel.target);
                var ic = itemSel.icon_color;
                var ich = itemSel.icon_color_hover;
                var icp = itemSel.icon_color_disabled;
                if (ic != '') { $("#" + $data.uiName + "ipt-icon-color").colorpicker('setValue', ic); }
                if (ich != '') { $("#" + $data.uiName + "ipt-icon-color-hover").colorpicker('setValue', ich); }
                if (icp != '') { $("#" + $data.uiName + "ipt-icon-color-disabled").colorpicker('setValue', icp); }
                $("#" + $data.uiName + "ipt-icon-color").val(ic);
                $("#" + $data.uiName + "ipt-icon-color-hover").val(ich);
                $("#" + $data.uiName + "ipt-icon-color-disabled").val(icp);

                $("#" + $data.uiName + "ipt-icon-fa").change();
                $("#" + $data.uiName + "ipt-display").change();
                $data.modAllowed = true;
            }
            else {
                // $data.selectedItem  = "";
                // $data.selectedIndex = -1;

                // $data.menu._clearForm();
            }

            $data.menu._enableForm();
        }, // _selectItem

        _applyTemplate: function(param) {
            var $data   = $.scMenuEditorData,
                tplName = ($("#" + $data.uiName + "ipt-template").val() == null ? $("#" + $data.uiName + "ipt-template option:not([disabled]):first").val() : $("#" + $data.uiName + "ipt-template").val()),
                tplOrientation = $("#" + $data.uiName + "ipt-template option:selected").hasClass( "only_horiz" ),
                tplInfo = tplName.split("__NM__");

            if ($("#interface_menu_orientacao > input:checked").val() === 'horizontal') {
            $("#sc-js-menu-rel").attr("href", $data.urlThemes[ tplInfo[0] ] + tplInfo[1] + ".css");
            } else {
                $("#sc-js-menu-rel").attr("href", $data.urlThemes[ tplInfo[0] ] + tplInfo[1] + "_vertical.css");
            }
            $('input[name="' + $data.fieldTheme + '"]').val(tplName);
            $data.menu._checkOrientationSupport(tplOrientation);
            if (param != 'fixSize') { nm_form_modified(); }
        }, // _applyTemplate

        _checkOrientationSupport: function( boolean ) {
            if(boolean) {
                $( "#opt_horizontal" ).click();
                $( '#opt_vertical' ).attr('disabled', true);
                $( '#span_vertical' ).css('color', 'lightgray');
            } else {
                $( '#opt_vertical' ).attr('disabled', false);
                $( '#span_vertical' ).css('color', 'black');
            }
        }, // _applyTemplate

        _updateItem: function() {
            var $data = $.scMenuEditorData,
                i;

            if ("" == $data.selectedItem) {
                return;
            }

            $data.itemList[ $data.selectedIndex ].label                 = $("#" + $data.uiName + "ipt-label").val();
            $data.itemList[ $data.selectedIndex ].link                  = $("#" + $data.uiName + "ipt-link").val();
            $data.itemList[ $data.selectedIndex ].hint                  = $("#" + $data.uiName + "ipt-hint").val();
            $data.itemList[ $data.selectedIndex ].display_pos           = $("#" + $data.uiName + "ipt-display-pos").val();
            $data.itemList[ $data.selectedIndex ].display               = $("#" + $data.uiName + "ipt-display").val();
            $data.itemList[ $data.selectedIndex ].icon_fa               = $("#" + $data.uiName + "ipt-icon-fa").val();
            $data.itemList[ $data.selectedIndex ].icon                  = $("#" + $data.uiName + "ipt-icon").val();
            $data.itemList[ $data.selectedIndex ].icon_aba              = $("#" + $data.uiName + "ipt-icon-aba").val();
            $data.itemList[ $data.selectedIndex ].icon_aba_inactive     = $("#" + $data.uiName + "ipt-icon-aba-inactive").val();
            $data.itemList[ $data.selectedIndex ].icon_color            = $("#" + $data.uiName + "ipt-icon-color").val();
            $data.itemList[ $data.selectedIndex ].icon_color_hover      = $("#" + $data.uiName + "ipt-icon-color-hover").val();
            $data.itemList[ $data.selectedIndex ].icon_color_disabled   = $("#" + $data.uiName + "ipt-icon-color-disabled").val();
            $data.itemList[ $data.selectedIndex ].target                = $("#" + $data.uiName + "ipt-target").val();

            $("#" + $data.selectedItem + "-span").html($data.itemList[ $data.selectedIndex ].label);

            if (['text_fontawesomeicon', 'only_fontawesomeicon'].indexOf($data.itemList[$data.selectedIndex].display) > -1 && $data.has94) {
                $("#" + $data.uiName + "ipt-icon-fa").closest('.field').show();
                $("#" + $data.uiName + "ipt-icon-color").closest('.field').show();
                $("#" + $data.uiName + "ipt-icon-color-hover").closest('.field').show();
                $("#" + $data.uiName + "ipt-icon-color-disabled").closest('.field').show();
                $("#" + $data.uiName + "ipt-icon").closest('.field').hide();
                $("#" + $data.uiName + "ipt-icon-aba").closest('.field').hide();
                $("#" + $data.uiName + "ipt-icon-aba-inactive").closest('.field').hide();
            } else {
                $data.itemList[$data.selectedIndex].display = 'text_img';
                $("#" + $data.uiName + "ipt-icon-fa").closest('.field').hide();
                $("#" + $data.uiName + "ipt-icon-color").closest('.field').hide();
                $("#" + $data.uiName + "ipt-icon-color-hover").closest('.field').hide();
                $("#" + $data.uiName + "ipt-icon-color-disabled").closest('.field').hide();
                $("#" + $data.uiName + "ipt-icon").closest('.field').show();
                $("#" + $data.uiName + "ipt-icon-aba").closest('.field').show();
                $("#" + $data.uiName + "ipt-icon-aba-inactive").closest('.field').show();
            }

            $data.menu._updateSubmitValue();
            $data.menu._updateView();
            if ($data.modAllowed) {
                nm_form_modified();
            }
        }, // _updateItem

        _updateView: function() {
            var $data     = $.scMenuEditorData,
                html      = "<ul id=\"css3menu1\" class=\"topmenu\">",
                sample    = false,
                level     = 0,
                itemClass = " topfirst",
                last, i, iconHtml, itemList;

            $("." + $data.uiName + "menu-click").unbind("click");

            if (0 < $data.itemList.length) {
                $("#" + $data.uiName + "preview").show();
                $("#" + $data.uiName + "example").hide();
                itemList = $data.itemList;
            } else {
                $("#" + $data.uiName + "preview").hide();
                $("#" + $data.uiName + "example").show();
                itemList = $data.menu._exampleMenu();
                sample = true;
            }

            for (i = 0; i < itemList.length; i++) {
                itemList[i].level = parseInt(itemList[i].level);

                if (0 == itemList[i].level) {
                    last = itemList[i].id;
                }
            }

            for (i = 0; i < itemList.length; i++) {
                if (last == itemList[i].id) {
                    itemClass = " toplast";
                }

                htmlClass = "";
                if (0 == itemList[i].level) {
                    htmlClass = " class=\"topmenu" + itemClass;
                    if (itemList[i + 1] && itemList[i].level < itemList[i + 1].level) {
                        htmlClass += " toproot";
                    }
                    htmlClass += "\"";
                }

                html += "<li" + htmlClass + ">";

                if ("text_fontawesomeicon" == itemList[i].display) {
                    iconHtml = " <style> #link-" + itemList[i].id + " i { color: " + itemList[i].icon_color + "; } #link-" + itemList[i].id + ":hover i { color: " + itemList[i].icon_color_hover + "; } </style> ";
                    if ("" != itemList[i].icon_fa) {
                        iconHtml += " <i class=\"" + itemList[i].icon_fa + "\" ></i> ";
                    } else {
                        iconHtml += "";
                    }
                } else {
                    if ("" != itemList[i].icon) {
                        iconHtml = " <img src=\"" + $data.menu._getIconUrl(itemList[i].icon) + "\" alt=\"" + itemList[i].sc_id + "\" /> ";
                    }
                    else {
                        iconHtml = "";
                    }
                }

                if (itemList[i + 1] && itemList[i].level < itemList[i + 1].level) {
                    if ("text_right" == itemList[i].display_pos) {
                        html += "<a href=\"#\" id=\"link-" + itemList[i].id + "\" class=\"" + $data.uiName + "menu-click\"><span>" + iconHtml + itemList[i].label + "</span></a><ul>";
                    } else {
                        html += "<a href=\"#\" id=\"link-" + itemList[i].id + "\" class=\"" + $data.uiName + "menu-click\"><span>" + itemList[i].label + iconHtml + "</span></a><ul>";
                    }
                }
                else {
                    if ("text_right" == itemList[i].display_pos) {
                        html += "<a href=\"#\" id=\"link-" + itemList[i].id + "\" class=\"" + $data.uiName + "menu-click\">" + iconHtml + itemList[i].label + "</a>";
                    } else {
                        html += "<a href=\"#\" id=\"link-" + itemList[i].id + "\" class=\"" + $data.uiName + "menu-click\">" + itemList[i].label + iconHtml + "</a>";
                    }
                }

                if (itemList[i + 1] && itemList[i].level == itemList[i + 1].level) {
                    html += "</li>";
                }
                else if (itemList[i + 1] && itemList[i].level > itemList[i + 1].level) {
                    html += "</li>" + $data.menu._strRepeat("</ul></li>", itemList[i].level - itemList[i + 1].level);
                }
                else if (!itemList[i + 1] && itemList[i].level > 0) {
                    html += "</li>" + $data.menu._strRepeat("</ul></li>", itemList[i].level);
                }
                else if (!itemList[i + 1] && itemList[i].level == 0) {
                    html += "</li>";
                }

                itemClass = "";
            }

            html += "</ul>";

            $("#" + $data.uiName + "view").html(html);

            if (!sample) { $("." + $data.uiName + "menu-click").bind("click", $data.menu._selectItem); }
        }, // _updateView

        _enableForm: function() {
            var $data  = $.scMenuEditorData,
                tplOrientation = $("#" + $data.uiName + "ipt-template option:selected").hasClass( "only_horiz" ),
                status = "" == $data.selectedItem;

            // $("#" + $data.uiName + "ipt-label").prop("disabled", status);
            // $("#" + $data.uiName + "ipt-link").prop("disabled", status);
            // $("#" + $data.uiName + "ipt-hint").prop("disabled", status);
            // $("#" + $data.uiName + "ipt-icon").prop("disabled", status);
            // $("#" + $data.uiName + "ipt-icon-aba").prop("disabled", status);
            // $("#" + $data.uiName + "ipt-icon-aba-inactive").prop("disabled", status);
            // $("#" + $data.uiName + "ipt-target").prop("disabled", status);
            $data.menu._checkOrientationSupport(tplOrientation);
        }, // _enableForm

        _exampleMenu: function() {
            var exampleMenu = new Array(
                {
                    label : "Item 1",
                    level : 0,
                    link  : "#",
                    hint  : "Item 1",
                    id    : "item_1",
                    icon  : "",
                    icon_aba  : "",
                    icon_aba_inactive  : "",
                    icon_color  : "",
                    icon_color_hover  : "",
                    icon_color_disabled  : "",
                    target: "item_1",
                    sc_id : 0
                },
                {
                    label : "Item 2",
                    level : 0,
                    link  : "#",
                    hint  : "Item 2",
                    id    : "item_2",
                    icon  : "",
                    icon_aba  : "",
                    icon_aba_inactive  : "",
                    icon_color  : "",
                    icon_color_hover  : "",
                    icon_color_disabled  : "",
                    target: "item_2",
                    sc_id : 0
                },
                {
                    label : "Item 4",
                    level : 1,
                    link  : "#",
                    hint  : "Item 4",
                    id    : "item_4",
                    icon  : "",
                    icon_aba  : "",
                    icon_aba_inactive  : "",
                    icon_color  : "",
                    icon_color_hover  : "",
                    icon_color_disabled  : "",
                    target: "item_4",
                    sc_id : 0
                },
                {
                    label : "Item 5",
                    level : 1,
                    link  : "#",
                    hint  : "Item 5",
                    id    : "item_5",
                    icon  : "",
                    icon_aba  : "",
                    icon_aba_inactive  : "",
                    icon_color  : "",
                    icon_color_hover  : "",
                    icon_color_disabled  : "",
                    target: "item_5",
                    sc_id : 0
                },
                {
                    label : "Item 7",
                    level : 2,
                    link  : "#",
                    hint  : "Item 7",
                    id    : "item_7",
                    icon  : "",
                    icon_aba  : "",
                    icon_aba_inactive  : "",
                    icon_color  : "",
                    icon_color_hover  : "",
                    icon_color_disabled  : "",
                    target: "item_7",
                    sc_id : 0
                },
                {
                    label : "Item 8",
                    level : 2,
                    link  : "#",
                    hint  : "Item 8",
                    id    : "item_8",
                    icon  : "",
                    icon_aba  : "",
                    icon_aba_inactive  : "",
                    icon_color  : "",
                    icon_color_hover  : "",
                    icon_color_disabled  : "",
                    target: "item_8",
                    sc_id : 0
                },
                {
                    label : "Item 6",
                    level : 1,
                    link  : "#",
                    hint  : "Item 6",
                    id    : "item_6",
                    icon  : "",
                    icon_aba  : "",
                    icon_aba_inactive  : "",
                    icon_color  : "",
                    icon_color_hover  : "",
                    icon_color_disabled  : "",
                    target: "item_6",
                    sc_id : 0
                },
                {
                    label : "Item 3",
                    level : 0,
                    link  : "#",
                    hint  : "Item 3",
                    id    : "item_3",
                    icon  : "",
                    icon_aba  : "",
                    icon_aba_inactive  : "",
                    icon_color  : "",
                    icon_color_hover  : "",
                    icon_color_disabled  : "",
                    target: "item_3",
                    sc_id : 0
                }
            );

            return exampleMenu;
        }, // _exampleMenu

        _moveUp: function() {
            var $data         = $.scMenuEditorData,
                moveType      = $data.menu._getMoveType(),
                selectedItems = new Array();

            if ("checked" == moveType) {
                selectedItems = $data.menu._getMoveItems();
            }
            else if ("" != $data.selectedItem) {
                selectedItems[0] = $data.selectedIndex;
            }

            if (0 < selectedItems.length) {
                $data.menu._doMoveUp(moveType, selectedItems);
            }
        }, // _moveUp

        _moveDown: function() {
            var $data         = $.scMenuEditorData,
                moveType      = $data.menu._getMoveType(),
                selectedItems = new Array();

            if ("checked" == moveType) {
                selectedItems = $data.menu._getMoveItems();
            }
            else if ("" != $data.selectedItem) {
                selectedItems[0] = $data.selectedIndex;
            }

            if (0 < selectedItems.length) {
                $data.menu._doMoveDown(moveType, selectedItems);
            }
        }, // _moveDown

        _moveLeft: function() {
            var $data         = $.scMenuEditorData,
                moveType      = $data.menu._getMoveType(),
                selectedItems = new Array();

            if ("checked" == moveType) {
                selectedItems = $data.menu._getMoveItems();
            }
            else if ("" != $data.selectedItem) {
                selectedItems[0] = $data.selectedIndex;
            }

            if (0 < selectedItems.length) {
                $data.menu._doMoveLeft(moveType, selectedItems);
            }
        }, // _moveLeft

        _moveRight: function() {
            var $data         = $.scMenuEditorData,
                moveType      = $data.menu._getMoveType(),
                selectedItems = new Array();

            if ("checked" == moveType) {
                selectedItems = $data.menu._getMoveItems();
            }
            else if ("" != $data.selectedItem) {
                selectedItems[0] = $data.selectedIndex;
            }

            if (0 < selectedItems.length) {
                $data.menu._doMoveRight(moveType, selectedItems);
            }
        }, // _moveRight

        _getMoveType: function() {
            return 0 < $(".sc-ui-menu-item-move:checked").length
                   ? "checked" : "selected";
        }, // _getMoveType

        _getMoveItems: function() {
            var $data         = $.scMenuEditorData,
                $checkedItems = $(".sc-ui-menu-item-move:checked"),
                selectedItems = new Array,
                i, j, itemId;

            for (i = 0; i < $checkedItems.length; i++) {
                itemId = $($checkedItems[i]).attr("id").substr(3);

                for (j = 0; j < $data.itemList.length; j++) {
                    if (itemId == $data.itemList[j].id) {
                        selectedItems[ selectedItems.length ] = j;
                        break;
                    }
                }
            }

            return selectedItems;
        }, // _getMoveItems

        _doMoveUp: function(moveType, selectedItems) {
            var $data  = $.scMenuEditorData,
                bMoved = false,
                i, itemTree, itemData, itemId, otherId;

            if ("checkbox" == moveType) {
                $("#" + $data.selectedItem).removeClass("sc-ui-menu-itemsel");

                $data.selectedItem  = "";
                $data.selectedIndex = -1;

                $data.menu._clearForm();
                $data.menu._enableForm();
            }

            if (0 < selectedItems[0]) {
                for (i = 0; i < selectedItems.length; i++) {
                    itemData = $data.itemList[ selectedItems[i] ];
                    itemId   = itemData.id;
                    itemTree = $("#" + itemId).detach();
                    otherId  = $data.itemList[ selectedItems[i] - 1 ].id;

                    $("#" + otherId).before(itemTree);

                    $data.itemList.splice(selectedItems[i], 1);
                    $data.itemList.splice(selectedItems[i] - 1, 0, itemData);

                    if ("selected" == moveType) {
                        $data.selectedIndex--;
                    }

                    bMoved = true;
                }
            }


            if (1 == selectedItems[0]) {
                $data.menu._moveLeft();
            }

            if (bMoved) {
                $data.menu._updateSubmitValue();
                $data.menu._updateView();

                nm_form_modified();
            }
        }, // _doMoveUp

        _doMoveDown: function(moveType, selectedItems) {
            var $data  = $.scMenuEditorData,
                bMoved = false,
                i, itemTree, itemData, itemId, otherId;

            if ("checkbox" == moveType) {
                $("#" + $data.selectedItem).removeClass("sc-ui-menu-itemsel");

                $data.selectedItem  = "";
                $data.selectedIndex = -1;

                $data.menu._clearForm();
                $data.menu._enableForm();
            }

            if ($data.itemList.length - 1 > selectedItems[ selectedItems.length - 1 ]) {
                for (i = selectedItems.length - 1; i >= 0; i--) {
                    itemData = $data.itemList[ selectedItems[i] ];
                    itemId   = itemData.id;
                    itemTree = $("#" + itemId).detach();
                    otherId  = $data.itemList[ selectedItems[i] + 1 ].id;

                    $("#" + otherId).after(itemTree);

                    $data.itemList.splice(selectedItems[i], 1);
                    $data.itemList.splice(selectedItems[i] + 1, 0, itemData);

                    if ("selected" == moveType) {
                        $data.selectedIndex++;
                    }

                    bMoved = true;
                }
            }

            if (bMoved) {
                $data.menu._updateSubmitValue();
                $data.menu._updateView();

                nm_form_modified();
            }
        }, // _doMoveDown

        _doMoveLeft: function(moveType, selectedItems) {
            var $data  = $.scMenuEditorData,
                bMoved = false;

            if ("checkbox" == moveType) {
                $("#" + $data.selectedItem).removeClass("sc-ui-menu-itemsel");

                $data.selectedItem  = "";
                $data.selectedIndex = -1;

                $data.menu._clearForm();
                $data.menu._enableForm();
            }

            for (i = selectedItems.length - 1; i >= 0; i--) {
                if ($data.itemList[ selectedItems[i] ].level > 0) {
                    $data.itemList[ selectedItems[i] ].level--;
                    $("#" + $data.itemList[ selectedItems[i] ].id + "-span").css("padding-left", $data.menu._itemLabelPadding($data.itemList[ selectedItems[i] ].level));

                    bMoved = true;
                }
            }

            if (bMoved) {
                $data.menu._updateSubmitValue();
                $data.menu._updateView();

                nm_form_modified();
            }
        }, // _doMoveLeft

        _doMoveRight: function(moveType, selectedItems) {
            var $data  = $.scMenuEditorData,
                bMoved = false;

            if ("checkbox" == moveType) {
                $("#" + $data.selectedItem).removeClass("sc-ui-menu-itemsel");

                $data.selectedItem  = "";
                $data.selectedIndex = -1;

                $data.menu._clearForm();
                $data.menu._enableForm();
            }

            for (i = selectedItems.length - 1; i >= 0; i--) {
                if (0 < selectedItems[i] && $data.itemList[ selectedItems[i] ].level <= $data.itemList[ selectedItems[i] - 1 ].level) {
                    $data.itemList[ selectedItems[i] ].level++;
                    $("#" + $data.itemList[ selectedItems[i] ].id + "-span").css("padding-left", $data.menu._itemLabelPadding($data.itemList[ selectedItems[i] ].level));

                    bMoved = true;
                }
            }

            if (bMoved) {
                $data.menu._updateSubmitValue();
                $data.menu._updateView();

                nm_form_modified();
            }
        }, // _doMoveRight

        _checkAll: function() {
            var $data = $.scMenuEditorData;

            $(".sc-ui-menu-item-move").prop("checked", $("#" + $data.uiName + "checkall").prop("checked"));
        }, // _checkAll

        _openIconList: function() {
            var $data = $.scMenuEditorData,
                iconImg, iconSize, iconId;

            $data.menu._loadIcons();

            if ("" != $data.selectedIcon) {
                $("#" + $data.selectedIcon).removeClass("sc-ui-selected-icon");
                $data.selectedIcon = "";
            }

            iconImg = $("#" + $data.uiName + "ipt-icon").val();

            if ("" != iconImg) {
                iconId   = "sc-icon-" + iconImg.substr(0, iconImg.length - 7);
                iconSize = iconImg.substr(0, iconImg.length - 4).substr(iconImg.length - 6);

                $data.selectedIcon = iconId;
                $("#" + $data.selectedIcon).addClass("sc-ui-selected-icon");

                $("#" + $data.uiName + "icon-size").val(iconSize);
            }

            $("#" + $data.uiName + "icons-list").show();
        }, // _openIconList

        _iconOk: function() {
            var $data = $.scMenuEditorData,
                iconImg;

            if ("" == $data.selectedIcon) {
                return;
            }

            iconImg = $data.selectedIcon.substr(8) + "_" + $("#" + $data.uiName + "icon-size").val() + ".png";

            $("#" + $data.uiName + "ipt-icon").val(iconImg);

            $("#" + $data.uiName + "icons-list").hide();

            $data.menu._updateItem();
        }, // _iconOk

        _iconCancel: function() {
            var $data = $.scMenuEditorData;

            $data.selectedIcon = "";

            $("#" + $data.uiName + "icons-list").hide();
        }, // _iconCancel

        _clearForm: function() {
            var $data = $.scMenuEditorData;

            $("#" + $data.uiName + "ipt-id").html("");
            $("#" + $data.uiName + "ipt-label").val("");
            $("#" + $data.uiName + "ipt-link").val("");
            $("#" + $data.uiName + "ipt-hint").val("");
            $("#" + $data.uiName + "ipt-icon").val("");
            $("#" + $data.uiName + "ipt-display-pos").val("text_right");
            if($data.menuVersion == "menu2")
            {
                $("#" + $data.uiName + "ipt-display").val('text_fontawesomeicon');
            }else
            {
                $("#" + $data.uiName + "ipt-display").val("text_img");
            }
            $("#" + $data.uiName + "ipt-icon-fa").val("");
            $("#" + $data.uiName + "ipt-icon-aba").val("");
            $("#" + $data.uiName + "ipt-icon-aba-inactive").val("");
            $("#" + $data.uiName + "ipt-icon-color").val("");
            $("#" + $data.uiName + "ipt-icon-color-hover").val("");
            $("#" + $data.uiName + "ipt-icon-color-disabled").val("");
            $("#" + $data.uiName + "ipt-target").val("");
            $('.properties-form').addClass('disabled-form');
            $('.properties-form').css({opacity: '0.2'});
            $('.properties-form').find('input, select').attr('disabled', true);
        }, // _clearForm

        _updateSubmitValue: function() {
            var $data    = $.scMenuEditorData,
                itemList = new Array(),
                itemData = new Array(),
                i;

            for (i = 0; i < $data.itemList.length; i++) {
                itemData[0] = $data.itemList[i].sc_id;
                itemData[1] = $data.itemList[i].label;
                itemData[2] = $data.itemList[i].link;
                itemData[3] = $data.itemList[i].target;
                itemData[4] = $data.itemList[i].icon;
                itemData[5] = $data.itemList[i].hint;
                itemData[6] = parseInt($data.itemList[i].level) + 1;
				itemData[7] = $data.itemList[i].display;
				itemData[8] = $data.itemList[i].display_pos;
				itemData[9] = '';
				itemData[10] = $data.itemList[i].icon_aba;
				itemData[11] = $data.itemList[i].icon_aba_inactive;
				itemData[12] = $data.itemList[i].icon_fa;
				itemData[13] = '';
				itemData[14] = '';
                itemData[15] = $data.itemList[i].icon_color;
                itemData[16] = $data.itemList[i].icon_color_hover;
                itemData[17] = $data.itemList[i].icon_color_disabled;

                itemList[i] = itemData.join("_!NM!_");
            }

            $('input[name="' + $data.field + '"]').val(itemList.join("_@NM@_"));
        }, // _updateSubmitValue

        _getThemeOptions: function(moduleName) { //temas aqui!!
            var $data = $.scMenuEditorData,
                html  = "", endoptgroup = "",
                themeInfo, i;

            if (typeof $data.themeList[moduleName] !== "undefined" || typeof $data.themeListHoriz[moduleName] !== "undefined")
            {
                html += "<optgroup label=\"" + $data.langThemes[moduleName] + "\">";
                endoptgroup += "</optgroup>";
            }
            if ($data.themeList[moduleName] && $data.themeList[moduleName].length > 0)
            {
                html += "<option value=\"\" style=\"text-shadow: 0px 0px 0px black;color:darkblue;position:relative;right:15px;padding-left:10px;\" disabled>" + $data.langVertANDHoriz + "</option>";
                for (i = 0; i < $data.themeList[moduleName].length; i++) {
                    themeInfo = $data.themeList[moduleName][i].split("__NM__");
                    html += "<option value=\"" + $data.themeList[moduleName][i] + "\">" + themeInfo[1] + "</option>";
                }
            }
            if (typeof $data.themeListHoriz !== 'undefined' && typeof $data.themeListHoriz[moduleName] !== "undefined")
            {
                html += "<option value=\"\" style=\"text-shadow: 0px 0px 0px black;color:darkblue;position:relative;right:15px;padding-left:10px;\" disabled>" + $data.langOnlyHoriz + "</option>";

                for (i = 0; i < $data.themeListHoriz[moduleName].length; i++) {
                    themeInfo = $data.themeListHoriz[moduleName][i].split("__NM__");
                    html += "<option class=\"only_horiz\" value=\"" + $data.themeListHoriz[moduleName][i] + "\">" + themeInfo[1] + "</option>";
                }
            }
            html += endoptgroup;
            return html;
        },// _getThemeOptions

        _getOrientacao: function() {
            var $data = $.scMenuEditorData,
                html  = "";

            if ($data.menuOrientacao == "") { $data.menuOrientacao = 'horizontal'; }
            html += "<input id=\"opt_horizontal\" type=\"radio\" value=\"horizontal\" " + ($data.menuOrientacao == 'horizontal' ? 'checked' : '') +"><span id=\"span_horizontal\">"+$data.langHorizontal+"</span>&nbsp;&nbsp;&nbsp;";
            html += "<input id=\"opt_vertical\" type=\"radio\" value=\"vertical\" "     + ($data.menuOrientacao == 'vertical' ? 'checked' : '') +"><span id=\"span_vertical\">"+$data.langVertical+"</span><br>";
            return html;
        },// _getThemeOptions

        _itemLabelPadding: function(level) {
            return 0 == level ? "0" : (level * 10) + "px";
        }, // _itemLabelPadding

        _treeViewLabel: function(label, level) {
            var $data = $.scMenuEditorData;

            return $data.menu._strRepeat("..", level) + label;
        }, // _treeViewLabel

        _urlExists: function(testUrl) {
            var http = jQuery.ajax({
                type : "HEAD",
                url  : testUrl,
                async: false
            });
            return 404 != http.status;
        }, // _urlExists

        _strRepeat: function(s, n) {
            return new Array(n + 1).join(s);
        } // _strRepeat

    } // scMenuEditor

    $.scMenuEditorData = {
        menuVersion     : "menu",
        iconsLoaded     : false,
        itemList        : new Array(),
        importedItem    : {},
        lastItem        : 0,
        selectedItem    : "",
        selectedIndex   : -1,
        selectedIcon    : "",

        iconLink        : "",
        iconIcon1       : "",
        iconIcon2       : "",

        langNewItem     : "New item",
        langNewSub      : "New subitem",
        langRemove      : "Remove item",
        langImport      : "Import applications",
        langUp          : "Move up",
        langDown        : "Move down",
        langLeft        : "Move left",
        langRight       : "Move right",
        langLabel       : "Label",
        langLink        : "Link",
        langHint        : "Hint",
        langIcon        : "Icon",
        langIconAba     : "Tab Icon",
        langIconAbaInactive     : "Tab Icon Inactive",
        langTarget      : "Target",
        langSelf        : "This window",
        langBlank       : "Other window",
        langParent      : "Exit",
        langProperties  : "Properties",
        langTheme       : "Theme",
        langIconList    : "Icon List",
        langIconSize    : "Icon Size",
        langButtonOk    : "Select",
        langButtonCancel: "Cancel",
        langExampleMenu : "Example menu:",
        langPreviewMenu : "Preview:",
        langCheckUncheck: "Check/Uncheck All",
        langIcon1       : "Old icons",
        langIcon2       : "New icons"
    } // scMenuEditorData

}) (jQuery);
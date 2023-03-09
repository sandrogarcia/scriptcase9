
$(document).ready(function () {
    review_permissions();
    nm_toggle_menu();
    nmGetAbaSize();

    var Browser = navigator.userAgent;
    $.contextMenu({
        selector:'.nmScroll > ul > li:not(.nmSetaScrollControl)',
        leftButton: true,
        callback: function(key, options) {
            switch(key)
            {
                case 'home':
                    nm_exec_menu('home');
                    break;
                case 'close':
                    ajax_get_close_app(parseInt($(this).attr('id').split('sys_aba_page_')[1]))
                    break;
                case 'closeall':
                    nm_close_all_abas_app();
                    nm_exec_menu('home');
                    break;
                case 'closeothers':
                    var myid = parseInt($(this).attr('id').split('sys_aba_page_')[1]);
                    for(var i_aba = n_qtd_aba; i_aba > myid ;i_aba--)
                    {
                        if($('#sys_aba_page_' + i_aba).is(':visible'))
                        {
                            ajax_get_close_app(i_aba, false);
                        }
                    }
                    for (var i_aba = 1; i_aba < myid; i_aba++) {
                        ajax_get_close_app(1, false);
                    }

                    break;
            }
        },
        items: {
            "home": {name: nm_lang_context_home},
            "close": {name: nm_lang_context_close},
            "closeall": {name: nm_lang_context_close_all},
            "closeothers" : {name: nm_lang_context_close_others}
        }
    });
});



$(window).resize(function()
{
    //$('body').height($(document).height()*0.98);
    nm_adjust_screen();
});

function reloadRequired() {
    $('#action_requires_reload').modal({
        closable: false
    }).modal('show')
}

function keyBindSelector(elm) {
    $('#id_keybind_capture #key-capture-type').html('');
    $('#id_keybind_capture').modal({
        closable: false,
        onHide: function () {
            $(document).unbind('keydown.captureKey')
            $(document).unbind('keyup.releaseKey')
        }
    }).modal('show')
    //     backdrop: 'static',
    //     keyboard: false,
    //     show: true
    // });
    $(document).unbind('keydown.captureKey')
    $(document).unbind('keyup.releaseKey')
    $(document).bind('keydown.captureKey', function (e) {
        e.preventDefault()
        e.stopPropagation()
        var isMac = navigator.platform.toUpperCase().indexOf('MAC') > -1
        var sequenceDiv = $('#id_keybind_capture #key-capture-type')
        var pressedKey = keyCodes()[e.keyCode]
        var replacements = {
            'META': (isMac || true) ? '&#8984;' : 'META',//'Alt',
            'ALTGRAPH': 'ALT',
            'COMMAND': '&#8984;',
            'ARROWLEFT': '&#8592;',
            'ARROWUP': '&#8593;',
            'ARROWRIGHT': '&#8594;',
            'ARROWDOWN': '&#8595;',
            ' ': 'SPACE'
        };
        var comboKeys = ['CONTROL', 'ALT', 'SHIFT', '&#8984;', 'COMMAND', 'META', 'ALTGRAPH']
        if (pressedKey) {
            pressedKey = (replacements[pressedKey]) ? replacements[pressedKey] : pressedKey
        } else {
            pressedKey = 'CONTROL'
        }

        // var conector = (sequenceDiv.html() == '') ? '' : ' + '
        // var conector = ' + '
        var hasCtrl = (e.ctrlKey) ? 'CONTROL + ' : ''
        var hasShift = (e.shiftKey) ? 'SHIFT + ' : ''
        var hasAlt = (e.altKey) ? 'ALT + ' : ''
        var hasMeta = (e.metaKey) ? replacements['META'] + ' + ' : ''
        var sequenceString = hasMeta + hasCtrl + hasAlt + hasShift


        if (!(comboKeys.indexOf(pressedKey) > -1)) {
            // sequenceDiv.html(sequenceDiv.html() + pressedKey)
            sequenceDiv.html(sequenceString + pressedKey)
            $(elm).attr('value',sequenceDiv.html())
            $(elm).trigger('change')
            $('#id_keybind_capture').modal('hide')
            $(document).unbind('keydown.captureKey')
            $(document).unbind('keyup.releaseKey')
        } else {
            // if (!(sequenceDiv.html().indexOf(pressedKey) > -1)) {
            //     sequenceDiv.html(sequenceDiv.html() + pressedKey + conector)
            // }
            sequenceDiv.html(sequenceString)
            $(document).unbind('keyup.releaseKey')
            $(document).bind('keyup.releaseKey', function (e) {
                // var unpressedKey = e.key.toUpperCase()
                var hasCtrl = (e.ctrlKey) ? 'CONTROL + ' : ''
                var hasShift = (e.shiftKey) ? 'SHIFT + ' : ''
                var hasAlt = (e.altKey) ? 'ALT + ' : ''
                var hasMeta = (e.metaKey) ? replacements['META'] + ' + ' : ''
                var sequenceString = hasMeta + hasCtrl + hasAlt + hasShift
                // unpressedKey = (replacements[unpressedKey]) ? replacements[unpressedKey] : unpressedKey
                sequenceDiv.html(sequenceString)
                // if ((comboKeys.indexOf(unpressedKey) > -1)) {
                //     sequenceDiv.html(sequenceDiv.html().replace(unpressedKey + conector, ''))
                // }
            })
        }
        return false;
    })
}

function noPermission(version) {
    $('#id_priv_error_top p').hide();
    //versões devem ser notadas com '_' ao inves de '.' para eviter ter de escapar o seletor jquery ex: 8_1_031 ao inves de 8.1.031
    if(typeof version === 'undefined') {
        $('#sc_upd_msg_outdate').show();
    } else {
        $('#sc_upd_msg_outdate-'+version).show();
    }

    // $('#id_modal_message').html($('#id_priv_error_top').html());
    // $('.modal-header').hide();
    // $('#id_modal_message').css('text-align', 'center');
    $('#id_priv_error_top').modal('show');
}

function confirmMessage(callback, args) {
    var pane = $('#general_confirm_message');
    var custom = pane.find('#custom-message');
    var defaultMessage = pane.find('#default-message');
    if (args) {
        custom.show().attr('style', 'display: flex;');
        if (typeof(args) === typeof({})) {
            if (args.message) {
                custom.find('.message').html(args.message);
            } else {
                custom.find('.message').html(defaultMessage.find('.message').html());
            }
            if (args.title) {
                custom.find('.title').html(args.title);
            } else {
                custom.find('.title').html(defaultMessage.find('.title').html());
            }
            if (args.centerIcon && args.centerIcon!="") {
                pane.find('#center-icon').removeClass('hide');
                pane.find('#center-icon > i').addClass(args.centerIcon);
            }else {
                pane.find('#center-icon').addClass('hide');
                pane.find('#center-icon > i').removeClass().addClass('fa');
            }
            if (args.icon) {
                custom.find('.icon > i').removeClass();
                custom.find('.icon > i').addClass('fa');
                custom.find('.icon > i').addClass('confirm-icon');
                custom.find('.icon > i').addClass(args.icon);
                if (args.icon === 'none') {
                    custom.find('.icon').addClass('none');
                } else {
                    custom.find('.icon').removeClass('none');
                }
            } else {
                custom.find('.icon > i').removeClass();
                custom.find('.icon > i').addClass('fa-question-circle');
                custom.find('.icon > i').addClass('fa');
                custom.find('.icon > i').addClass('confirm-icon');
                custom.find('.icon').removeClass('none');
            }
            if (args.iconColor) {
                custom.find('.icon > i').css('color', args.iconColor);
            } else {
                custom.find('.icon > i').css('color', '#ec5454');
            }
            if (args.cancelButton && args.cancelButton === 'none') {
                pane.find('#cancel-button').hide();
            }
            else{
                pane.find('#cancel-button').show();
            }
            if (args.confirmBtnClass) {
                pane.find('#confirm-button').addClass(args.confirmBtnClass);
                pane.find('#confirm-button').removeClass('primary');
            }
            else{
                pane.find('#confirm-button').addClass('primary');
            }
            if (args.msgClass) {
                pane.find('#cmessage').removeClass().addClass(args.msgClass);
            }
            else{
                pane.find('#cmessage').removeClass().addClass('message');
            }
            if (args.titleClass) {
                pane.find('#ctitle').removeClass().addClass(args.titleClass);
            }
            else{
                pane.find('#ctitle').removeClass().addClass('title');
            }
        } else {
            custom.find('.message').html(args);
        }
        defaultMessage.hide();
    } else {
        defaultMessage.show().attr('style', 'display: flex;');
        custom.hide();
    }
    pane.find('#confirm-button').bind('click.confirm', function() {
        callback();
        $('#general_confirm_message').modal('hide');
    });
    pane.modal({
        closable: true,
        onHidden: function() {
            custom.hide();
            pane.find('#default-message').show().attr('style', 'display: flex;');
            pane.find('#confirm-button').unbind('click.confirm');
            pane.find('#cancel-button').show();
        }
    }).modal('show');
}

function showVideoPopup(url) {
    // var pane = $('#video_play_popup');
    // var frame = pane.find('iframe');
    // frame.attr('src', url);
    // pane.modal({
    //     closable: true,
    //     onHidden: function() {
    //         frame.attr('src', '');
    //     }
    // }).modal('show');

    window.open(url,'_blank')//, 'width=850,height=480,toolbar=no,location=no,menubar=no,status=no,titlebar=no,scrollbars=no,resizable=yes,top=200,left=200');
    $('#basics_container .dot_container').hide();
    if ($('.pointerBox').transition('is visible')) {
        $('.pointerBox').transition('scale out');
        $("#basics_container").popup({html: $('#getstarted_tooltip').html() });
    }
    $.ajax({
        type: "POST",
        url: '../iface/ajax_function.php',
        data: {
            call: 'disableViewingGetStarted',
            data: {}
        },
        complete: function (a, b) {
        },
        dataType: 'json'
    });
}

function errorMessage(args) {
    var pane = $('#general_error_message');
    var custom = pane.find('#custom-message');
    var defaultMessage = pane.find('#default-message');
    if (args) {
        custom.show().attr('style', 'display: flex;');
        if (typeof(args) === typeof({})) {
            if (args.message) {
                custom.find('.message').html(args.message);
            } else {
                custom.find('.message').html(defaultMessage.find('.message').html());
            }
            if (args.title) {
                custom.find('.title').html(args.title);
            } else {
                custom.find('.title').html(defaultMessage.find('.title').html());
            }
            if (args.icon) {
                custom.find('.icon > i').removeClass();
                custom.find('.icon > i').addClass('fa');
                custom.find('.icon > i').addClass('error-icon');
                custom.find('.icon > i').addClass(args.icon);
                if (args.icon === 'none') {
                    custom.find('.icon').addClass('none');
                } else {
                    custom.find('.icon').removeClass('none');
                }
            } else {
                custom.find('.icon > i').removeClass();
                custom.find('.icon > i').addClass('fa-exclamation-triangle');
                custom.find('.icon > i').addClass('fa');
                custom.find('.icon > i').addClass('error-icon');
                custom.find('.icon').removeClass('none');
            }
            if (args.iconColor) {
                custom.find('.icon > i').css('color', args.iconColor);
            } else {
                custom.find('.icon > i').css('color', '#ec5454');
            }
        } else {
            custom.find('.message').html(args);
        }
        defaultMessage.hide();
    } else {
        defaultMessage.show().attr('style', 'display: flex;');
        custom.hide();
    }
    pane.modal({
        closable: false,
        onHidden: function() {
            custom.hide();
            defaultMessage.show().attr('style', 'display: flex;');
        }
    }).modal('show');
}

function toastMessage(args) {
    var pane = $('#general_message');
    var custom = pane.find('#custom-message');
    var defaultMessage = pane.find('#default-message');
    if (args) {
        custom.show().attr('style', 'display: flex;');
        if (typeof(args) === typeof({})) {
            if (args.message) {
                custom.find('.message').html(args.message);
            } else {
                custom.find('.message').html(defaultMessage.find('.message').html());
            }
            if (args.title) {
                custom.find('.title').html(args.title);
            } else {
                custom.find('.title').html(defaultMessage.find('.title').html());
            }
            if (args.icon) {
                custom.find('.icon > i').removeClass();
                custom.find('.icon > i').addClass('fa');
                custom.find('.icon > i').addClass('message-icon');
                custom.find('.icon > i').addClass(args.icon);
                if (args.icon === 'none') {
                    custom.find('.icon').addClass('none');
                } else {
                    custom.find('.icon').removeClass('none');
                }
            } else {
                custom.find('.icon > i').removeClass();
                custom.find('.icon > i').addClass('fa-info-circle');
                custom.find('.icon > i').addClass('fa');
                custom.find('.icon > i').addClass('message-icon');
                custom.find('.icon').removeClass('none');
            }
            if (args.iconColor) {
                custom.find('.icon > i').css('color', args.iconColor);
            } else {
                custom.find('.icon > i').css('color', '#839cec');
            }
        } else {
            custom.find('.message').html(args);
        }
        defaultMessage.hide();
    } else {
        defaultMessage.show().attr('style', 'display: flex;');
        custom.hide();
    }
    pane.modal({
        closable: false,
        onHidden: function() {
            custom.hide();
            defaultMessage.show().attr('style', 'display: flex;');
        }
    }).modal('show');
}

function is_app_open() {
    nr_ifr = document.form_top.index_ifr_atual.value;
    return ("" != nmAppCod && document.getElementById("id_ifr_bottom" + nr_ifr))
}
function is_prj_open() {
    // return $('#id_toolbar_codgrp').is(':visible');
    return $('.nmProjectInfo').hasClass('active');
}

function nm_enable_menu_item(item) {
    $('#id_toolbar_' + item).removeClass("disabled");
    $('#id_menu_' + item).removeClass("disabled");
}

function nm_disable_menu_item(item) {
    $('#id_toolbar_' + item).addClass("disabled");
    $('#id_menu_' + item).addClass("disabled");
}

function nm_adjust_screen()
{
    $('#ul_generate_code').width($('.nmProjectInfo').parent('div').width() - $('.nmProjectInfo').width()*1.54 );
}

function nm_toggle_menu() {
    $('.top').removeClass('disabled');
    if (!is_prj_open()) {
        nm_disable_menu_item('home');
        nm_disable_menu_item('prj_close');
        nm_disable_menu_item('app_restore');
        nm_disable_menu_item('conn_new');
        nm_disable_menu_item('conn_edit');
        nm_disable_menu_item('conn_sql_builder');
        nm_disable_menu_item('app_new');
        nm_disable_menu_item('app_new_batch');
        nm_disable_menu_item('app_save');
        nm_disable_menu_item('app_generate');
        nm_disable_menu_item('app_run');
        nm_disable_menu_item('prj_run');
        nm_disable_menu_item('app_deploy');
        nm_disable_menu_item('app_source');
        nm_disable_menu_item('session');
        nm_disable_menu_item('prj_properties');
        nm_disable_menu_item('prj_values');
        nm_disable_menu_item('prj_version_history');
        nm_disable_menu_item('prj_version_increment');
        nm_disable_menu_item('prj_generate');
        nm_disable_menu_item('prj_deploy');
        nm_disable_menu_item('prj_api');
        nm_disable_menu_item('edithotkeytemplates');
        nm_disable_menu_item('editcodesnippets');
        nm_disable_menu_item('app_export');
        nm_disable_menu_item('app_import');
        nm_disable_menu_item('prj_delete');
        nm_disable_menu_item('reports');
        nm_disable_menu_item('reports_app');
        nm_disable_menu_item('reports_usr');
        nm_disable_menu_item('prj_diagram');
        nm_disable_menu_item('er_diagram');
        nm_disable_menu_item('prj_search');
        nm_disable_menu_item('conn_db_builder');
        nm_disable_menu_item('import_access');
        nm_disable_menu_item('import_excel');
        nm_disable_menu_item('import_csv');
        nm_disable_menu_item('data_dictionary');
        nm_disable_menu_item('edit_express');
        nm_disable_menu_item('prj_helpcase');
        nm_disable_menu_item('libs');
        nm_disable_menu_item('libraries');
        //nm_disable_menu_item('menu_prj_locales');
        nm_disable_menu_item('prj_languages');
        nm_disable_menu_item('prj_regional_settings');
        nm_disable_menu_item('themes');
        nm_disable_menu_item('buttons');
        nm_disable_menu_item('templates');
        nm_disable_menu_item('css_menus');
        nm_disable_menu_item('menu_icons');
        nm_disable_menu_item('images_manager');
        nm_disable_menu_item('chart_theme');
        nm_disable_menu_item('editor_html');
        nm_disable_menu_item('mod_security');
        nm_disable_menu_item('mod_log');
        nm_disable_menu_item('mod_log_create_edit');
        nm_disable_menu_item('mod_log_apps');
        nm_disable_menu_item('mod_log_generate_app');
    }
    if (!is_app_open()) {
        nm_disable_menu_item('app_save');
        nm_disable_menu_item('app_generate');
        nm_disable_menu_item('app_run');
        nm_disable_menu_item('app_deploy');
        nm_disable_menu_item('app_source');
    }
    review_permissions();
    nm_adjust_screen();

    if(is_app_open()) {
        $("#id_all").addClass('app-opened');
    } else {
        $("#id_all").removeClass('app-opened');
    }
}

$(".hidden-buttons .button-saveApp").click(function(){
    nm_exec_menu('app_save');
})

var waitAjax = false;
function nm_exec_menu(toolbar) {
    if ($('#id_toolbar_' + toolbar).hasClass('disabled') || $('#id_menu_' + toolbar).hasClass('disabled')) {
        return false;
    }
    else
    {
        switch(toolbar)
        {
            case 'mod_log':
            case 'reports':
            case 'menu_file':
            case 'menu_view':
            case 'menu_prj':
            case 'menu_conn':
            case 'menu_app':
            case 'menu_tool':
            case 'menu_layout':
            case 'menu_prj_locales':
            case 'menu_mod':
            case 'menu_opt':
            case 'menu_help':
                return;
        }
    }
    $('#id_top_news_message').hide(400);
    nm_open_load();
    var str_title = $('#id_toolbar_' + toolbar).attr('title');
    str_title = (str_title ? str_title : $('#id_menu_' + toolbar).attr('data-title'));
    if(waitAjax == true)
    {
        setTimeout(function(){
            nm_exec_menu(toolbar);
        }, 600);
        return;
    }

    toolbarNew = toolbar+'.png';

    switch (toolbar) {
        case 'home':
            nm_app_data(nmGrpCod, '', '', '', '', 'open_app', '', '', '', nmVersao, nmDesVer);
            ajax_get_show_app(0, 'src_main_menu');
            break;

        case 'prj_new':
            //nm_hide_toolbar();
            nmChangeTitleAbaHome(str_title);
            document.form_menu.action = nm_url_rand(nm_url_iface + "proj_new.php");
            document.form_menu.target = "nmFrmBotSys";
            ajax_get_show_app(0, 'submit_form_menu');
            break;

        case 'prj_close':
            // document.form_top.close_prj.value = 'S';
            //setTimeout(function(){
            //    document.form_top.submit();
            //}, 600);
            // nmChangeTitleAbaHome(str_title);
            // document.form_menu.action = nm_url_rand(nm_url_iface + "proj_change.php?close_prj=S");
            // document.form_menu.target = "nmFrmBotSys";
            // ajax_get_show_app(0, 'submit_form_top');
            document.form_top.close_prj.value = 'S';
            window.location = nm_url_iface + 'main.php?close_prj=S';
            // document.form_top.submit();
            $('html').removeClass('project-opened');
            break;

        case 'prj_open':
            nmChangeTitleAbaHome(str_title);
            document.form_menu.action = nm_url_rand(nm_url_iface + "proj_change.php");
            document.form_menu.target = "nmFrmBotSys";
            ajax_get_show_app(0, 'submit_form_menu');
            break;

        case 'prj_api':
            // nmChangeTitleAbaHome(str_title);
            // document.form_menu.action = nm_url_rand(nm_url_iface + "prj_api.php");
            // document.form_menu.target = "nmFrmBotSys";
            // ajax_get_show_app(0, 'submit_form_menu');
            ajax_get_create_aba('prj_api', str_title, toolbarNew, 'S');

            break;

        case 'conn_new':
            // nmChangeTitleAbaHome(str_title);
            // document.form_menu.action = nm_url_rand(nm_url_iface + "admin_sys_allconections_create_wizard.php");
            // document.form_menu.target = "nmFrmBotSys";
            // ajax_get_show_app(0, 'submit_form_menu');
            ajax_get_create_aba('admin_sys_allconections_create_wizard', str_title, toolbarNew, 'S');

            break;

        case 'conn_edit':
            ajax_get_create_aba('open_connection', str_title, toolbarNew, 'S');
            break;

        case 'conn_sql_builder':
            ajax_get_create_aba('sqlbuilder', str_title, toolbarNew);
            break;

        case 'app_new':
            nm_app_data(nmGrpCod, "", "", "", "", "wizard", "", "", "", nmVersao, nmDesVer);
            ajax_get_create_aba('src_new_app', str_title, toolbarNew, 'S');
            break;

        case 'app_new_batch':
            nm_app_data(nmGrpCod, "", "", "", "", "wizard", "", "", "", nmVersao, nmDesVer);
            ajax_get_create_aba('src_create_express', str_title, toolbarNew, 'S');
            break;

        case 'app_save':
            runCb(function() {
                document.form_top.refresh_home_open_app.value = 'S';
                nm_app_operation("save", '');
            });
            break;
        case 'app_generate':
            runCb(function () {
                document.form_top.refresh_home_open_app.value = 'S';
                nm_app_operation("generate", '');
            });
            break;
        case 'app_run':
            runCb(function (){
                nm_app_run();
                try{
                    $('#id_toolbar_app_run').tooltipster('destroy');
                    $("#id_toolbar_app_run").attr("title", nm_title_app_run);
                }catch (e){}
            });

            break;
        case 'prj_run':
            runCb(nm_prj_run);
            break;
        case 'app_deploy':
            tb_show(str_title, nm_url_rand(nm_url_iface + "publishwizard.php?pub_apl_opened=S&KeepThis=true&TB_iframe=true&width=600&height=410"), '');
            break;

        case 'webhelp':
        case 'help':
            nm_window_manual(url_doc);
            break;

        case 'exit':
            $.ajax({
                type: 'POST',
                url: nm_url_iface + 'session_close.php',
                data: 'ajax=true&option=close_session',
                success: function (msg) {
                    top.location = nm_url_rand(nm_url_iface + "login.php");
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    top.location = nm_url_rand(nm_url_iface + "login.php");
                }
            });
            break;
        case 'app_restore':
            nmChangeTitleAbaHome(str_title);
            nm_app_data(nmGrpCod, "", "", "", "", "app_restore", "", "", "", nmVersao, nmDesVer);
            ajax_get_show_app(0, 'src_restore');
            break;
        case 'prj_export':
            nmChangeTitleAbaHome(str_title);
            ajax_get_show_app(0, 'submit_form_bkp_prj');
            nmChangeTitleAbaHome(str_title);
            break;
        case 'app_export':
            document.form_menu.action = nm_url_rand(nm_url_iface + 'select_apps.php?funcao=backup');
            document.form_menu.target = "nmFrmBotSys";
            ajax_get_show_app(0, 'submit_form_menu');
            break;
        case 'prj_import':
            nmChangeTitleAbaHome(str_title);
            ajax_get_show_app(0, 'submit_form_import_prj');
            break;
        case 'app_source':
            window.open(nm_url_rand(nm_url_gen + 'nm_gp_view_source.php'), "nmWinSrcV7_" + nm_win_name, "width=620, height=440, directories=no, location=no, menubar=no, scrollbars=yes, status=no, resizable=yes, toolbar=no");
            break;
        case 'session':
            ajax_get_create_aba('session', str_title, toolbarNew);
            break;
        case 'prj_properties':
            nmChangeTitleAbaHome(str_title);
            document.form_menu.action = nm_url_rand(nm_url_iface + 'proj_edit.php');
            document.form_menu.target = "nmFrmBotSys";
            ajax_get_show_app(0, 'submit_form_menu');
            break;
        case 'prj_values':
            // nmChangeTitleAbaHome(str_title);
            // document.form_menu.action = nm_url_rand(nm_url_iface + 'proj_values.php');
            // document.form_menu.target = "nmFrmBotSys";
            // ajax_get_show_app(0, 'submit_form_menu');
            ajax_get_create_aba('proj_values', str_title, toolbarNew);

            break;
        case 'prj_version_history':
            nmChangeTitleAbaHome(str_title);
            document.form_menu.action = nm_url_rand(nm_url_iface + 'proj_view.php');
            document.form_menu.target = "nmFrmBotSys";
            ajax_get_show_app(0, 'submit_form_menu');
            break;
        case 'prj_version_increment':
            nmChangeTitleAbaHome(str_title);
            document.form_menu.action = nm_url_rand(nm_url_iface + 'proj_inc.php');
            document.form_menu.target = "nmFrmBotSys";
            ajax_get_show_app(0, 'submit_form_menu');
            break;
        case 'prj_generate':
            nm_menu_prj_generate('S');
            break;
        case 'prj_deploy':
            nmChangeTitleAbaHome(str_title);
            document.form_menu.action = nm_url_rand(nm_url_iface + 'select_apps.php?funcao=publish');
            document.form_menu.target = "nmFrmBotSys";
            ajax_get_show_app(0, 'submit_form_menu');
            break;
        case 'app_import':
            nmChangeTitleAbaHome(str_title);
            nm_app_data(nmGrpCod, "", "", "", "", "admin_serv_backup_import", "", "", "", nmVersao, nmDesVer);
            ajax_get_show_app(0, 'src_import');
            break;
        case 'prj_delete':
            delPrj('');
            break;
        case 'reports_app':
        case 'reports_usr':
            nmChangeTitleAbaHome(str_title);
            document.form_menu.action = nm_url_rand(nm_url_iface + 'proj_rel.php?rel=' + (toolbar == 'reports_app' ? 'lst_app_1' : 'res_dev_1'));
            document.form_menu.target = "nmFrmBotSys";
            ajax_get_show_app(0, 'submit_form_menu');

            break;
        case 'prj_diagram':
            obj_win = window.open(nm_url_iface + "proj_diagram.php", "nmWinSchemaV7_" + nm_win_name, "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,left=0,top=0,width=" + screen.width + ",height=" + (screen.height - 70));
            obj_win.focus();
            break;
        case 'er_diagram':
            ajax_get_create_aba('er_diagram', str_title, toolbarNew);
            break;
        case 'prj_search':
            ajax_get_create_aba('app_search', str_title, toolbarNew);
            break;
        case 'conn_db_builder':
           // nmChangeTitleAbaHome(str_title);
            nm_app_data(nmGrpCod, "", "", "", "", "dbmanager", "", "", "", nmVersao, nmDesVer);
            // document.form_menu.action = nm_url_rand(nm_url_iface + "dbmanager.php");
            // document.form_menu.target = "nmFrmBotSys";
            // ajax_get_show_app(0, 'submit_form_menu');
            ajax_get_create_aba('dbmanager', str_title, toolbarNew);

            break;
        case 'import_access':
        case 'import_excel':
        case 'import_csv':
            nmChangeTitleAbaHome(str_title);
            nm_app_data(nmGrpCod, "", "", "", "", "db_convert", "", "", "", nmVersao, nmDesVer);
            document.form_menu.action = nm_url_rand(nm_url_iface + "db_convert.php?nm_option="+toolbar);
            document.form_menu.target = "nmFrmBotSys";
            ajax_get_show_app(0, 'submit_form_menu');
            break;
        case 'data_dictionary':
            ajax_get_create_aba('datadic', str_title, toolbarNew);
            break;
        case 'edit_express':
            nmChangeTitleAbaHome(str_title);
            document.form_menu.action = nm_url_rand(nm_url_iface + 'edit_express_app.php');
            document.form_menu.target = "nmFrmBotSys";
            ajax_get_show_app(0, 'submit_form_menu');
            break;
        case 'prj_helpcase':
            ajax_get_create_aba('help_case', str_title, toolbarNew);
            break;
        case 'libs':
            ajax_get_create_aba('libs', str_title, toolbarNew);
            break;
        case 'libraries':
            ajax_get_create_aba('libraries', str_title, toolbarNew);
            break;
        case 'prj_languages':
            ajax_get_create_aba('lang', str_title, toolbarNew);
            break;
        case 'prj_regional_settings':
            ajax_get_create_aba('config_region', str_title, toolbarNew);
            break;
        case 'themes':
            //nmChangeTitleAbaHome(str_title);
            // document.form_menu.action = nm_url_rand(nm_url_iface + 'app_schema_advanced.php');
            // document.form_menu.target = "nmFrmBotSys";
            // ajax_get_create_aba('themes', 'submit_form_menu');
            ajax_get_create_aba('app_schema_advanced', str_title, toolbarNew);
            break;
        case 'buttons':
            // nmChangeTitleAbaHome(str_title);
            // document.form_menu.action = nm_url_rand(nm_url_iface + 'buttons.php?reset=1');
            // document.form_menu.target = "nmFrmBotSys";
            // ajax_get_show_app(0, 'submit_form_menu');
            ajax_get_create_aba('buttons', str_title, toolbarNew);
            break;
        case 'templates':
            // nmChangeTitleAbaHome(str_title);
            // document.form_menu.action = nm_url_rand(nm_url_iface + 'app_template.php');
            // document.form_menu.target = "nmFrmBotSys";
            // ajax_get_show_app(0, 'submit_form_menu');
            ajax_get_create_aba('app_template', str_title, toolbarNew);
            break;
        case 'css_menus':
            // nmChangeTitleAbaHome(str_title);
            // document.form_menu.action = nm_url_rand(nm_url_iface + 'theme_menu.php');
            // document.form_menu.target = "nmFrmBotSys";
            // ajax_get_show_app(0, 'submit_form_menu');
            ajax_get_create_aba('theme_menu', str_title, toolbarNew);
            break;
        case 'theme_menu2':
            // nmChangeTitleAbaHome(str_title);
            // document.form_menu.action = nm_url_rand(nm_url_iface + 'theme_menu2.php');
            // document.form_menu.target = "nmFrmBotSys";
            // ajax_get_show_app(0, 'submit_form_menu');
            ajax_get_create_aba('theme_menu2', str_title, toolbarNew);
            break;
        case 'menu_icons':
            // nmChangeTitleAbaHome(str_title);
            // document.form_menu.action = nm_url_rand(nm_url_iface + 'menu_icons.php');
            // document.form_menu.target = "nmFrmBotSys";
            // ajax_get_show_app(0, 'submit_form_menu');
            ajax_get_create_aba('menu_icons', str_title, toolbarNew);

            break;
        case 'images_manager':
            // nmChangeTitleAbaHome(str_title);
            // document.form_menu.action = nm_url_rand(nm_url_iface + 'images_manager.php');
            // document.form_menu.target = "nmFrmBotSys";
            // ajax_get_show_app(0, 'submit_form_menu');
            ajax_get_create_aba('images_manager', str_title, toolbarNew);
            break;
        case 'chart_theme':
            // nmChangeTitleAbaHome(str_title);
            // document.form_menu.action = nm_url_rand(nm_url_iface + 'chart.php');
            // document.form_menu.target = "nmFrmBotSys";
            // ajax_get_show_app(0, 'submit_form_menu');
            ajax_get_create_aba('chart', str_title, toolbarNew);

            break;
        case 'editor_html':
            // nmChangeTitleAbaHome(str_title);
            // document.form_menu.action = nm_url_rand(nm_url_iface + 'editor_html.php');
            // document.form_menu.target = "nmFrmBotSys";
            // ajax_get_show_app(0, 'submit_form_menu');
            ajax_get_create_aba('editor_html', str_title, toolbarNew);
            break;
        case 'converter_v5':
            parent.document.getElementById('nmFrmScase').setAttribute('scrolling', 'yes');
            window.location = nm_url_scase + 'devel/conversor_v5_v9/conversor.php';
            break;
        case 'converter_v6':
            parent.document.getElementById('nmFrmScase').setAttribute('scrolling', 'yes');
            window.location = nm_url_scase + 'devel/conversor_v6_v9/conversor.php';
            break;
        case 'converter_v7':
            parent.document.getElementById('nmFrmScase').setAttribute('scrolling', 'yes');
            window.location = nm_url_scase + 'devel/conversor_v7_v9/conversor.php';
            break;
        case 'converter_v8':
            parent.document.getElementById('nmFrmScase').setAttribute('scrolling', 'yes');
            window.location = nm_url_scase + 'devel/conversor_v8_v9/conversor.php';
            break;
        case 'mod_security':
            nmChangeTitleAbaHome(str_title);
            document.form_menu.action = nm_url_rand(nm_url_iface + 'security_module.php');
            document.form_menu.target = "nmFrmBotSys";
            ajax_get_show_app(0, 'submit_form_menu');
            break;
        case 'mod_log_create_edit':
        case 'mod_log_apps':
        case 'mod_log_generate_app':
            nmChangeTitleAbaHome(str_title);
            document.form_log.action = nm_url_rand(nm_url_iface + 'log.php');
            document.form_log.letsgo.value = (toolbar == 'mod_log_generate_app' ? 'create_app' : (toolbar == 'mod_log_apps' ? 'apps' : '') );
            document.form_log.target = "nmFrmBotSys";
            ajax_get_show_app(0, 'submit_form_log');
            break;
        case 'opt_settings':
            ajax_get_create_aba('admin', str_title, toolbarNew, 'S', 'N', '');
            break;
        case 'opt_my_sc':
            ajax_get_create_aba('prefs', str_title, toolbarNew)
            break;
        case 'opt_change_pswd':
            nmChangeTitleAbaHome(str_title);
            nm_app_data(nmGrpCod, "", "", "", "", "passwd", "", "", "", nmVersao, nmDesVer);
            document.form_menu.action = nm_url_rand(nm_url_iface + 'passwd.php');
            document.form_menu.target = "nmFrmBotSys";
            ajax_get_show_app(0, 'submit_form_menu');
            break;
        case 'todo':
            ajax_get_create_aba('todo', str_title, toolbarNew);
            break;
        case 'msg':
            ajax_get_create_aba('msg', str_title, toolbarNew);
            break;
        case 'edittoolbar':
            ajax_get_create_aba('edittoolbar', str_title, toolbarNew);
            break;
        case 'editkeybindings':

            nmChangeTitleAbaHome(str_title);
            document.form_menu.action = nm_url_rand(nm_url_iface + 'editkeybindings.php?reset=1');
            document.form_menu.target = "nmFrmBotSys";
            ajax_get_show_app(0, 'submit_form_menu');
            // ajax_get_create_aba('editkeybindings', str_title, toolbarNew);
            break;
        case 'edithotkeytemplates':

            nmChangeTitleAbaHome(str_title);
            document.form_menu.action = nm_url_rand(nm_url_iface + 'edithotkeytemplates.php?reset=1');
            document.form_menu.target = "nmFrmBotSys";
            ajax_get_show_app(0, 'submit_form_menu');
            // ajax_get_create_aba('edithotkeytemplates', str_title, toolbarNew);
            break;
        case 'editcodesnippets':

            nmChangeTitleAbaHome(str_title);
            document.form_menu.action = nm_url_rand(nm_url_iface + 'editcodesnippets.php?reset=1');
            document.form_menu.target = "nmFrmBotSys";
            ajax_get_show_app(0, 'submit_form_menu');
            // ajax_get_create_aba('edithotkeytemplates', str_title, toolbarNew);
            break;
        case 'support':
            window.open(nm_url_site + "support?install_problem=1", "nmWinSuporteV7_" + nm_win_name);
            break;
        case 'diagnosis':
            window.open(nm_url_rand(nm_url_scase + 'diagnosis.php'), "nmWinDiagV7_"+nm_win_name);
            break;
        case 'check_version':
            window.open(nm_url_rand(nm_url_iface + 'version_check.php'), "nmWinVersionV7_" + nm_win_name, "width=200, height=140, directories=no, location=no, menubar=no, status=no, toolbar=no");
            break;
        case 'update_version':
            ajax_get_create_aba('admin', str_title, toolbarNew, 'S', 'N', 'lic_update');
            break;
        case 'license_register':
            ajax_get_create_aba('admin', str_title, toolbarNew, 'S', 'N', 'lic_online');
            break;
        case 'about':
            window.open(nm_url_rand(nm_url_iface + 'about.php'), "nmWinAboutV7_"+nm_win_name, "width=320, height=270, directories=no, location=no, menubar=no, status=no, toolbar=no");
            break;


        case 'mod_log':
        case 'reports':
        case 'menu_file':
        case 'menu_view':
        case 'menu_prj':
        case 'menu_conn':
        case 'menu_app':
        case 'menu_tool':
        case 'menu_layout':
        case 'menu_prj_locales':
        case 'menu_mod':
        case 'menu_opt':
        case 'menu_help':
        case 'convert':
            break;

        default:
            alert(toolbar);
            break;

    }
    nm_close_load();
}

function runCb (callback) {
    callback();
}

var sc_cod_prj = "";
var sc_cod_ver = "";
var sc_versao  = "";
function nm_menu_group(str_grp, str_ver, str_dve) {

    sc_cod_prj = str_grp;
    sc_cod_ver = str_ver;
    sc_versao  = str_dve;

    $('.nmProjectInfo').removeClass('active').hide();
    nm_app_data(str_grp, '', '', '', '', '', '', '', '', str_ver, str_dve);
    document.form_group.field_group.value = str_grp;
    document.form_group.field_ver.value = str_ver;
    document.form_group.field_dve.value = str_dve;
    ajax_get_show_app(0, 'submit_form_group');
    nm_toggle_menu();
    show_prj_bar();
    nm_show_toolbar();
}

function show_prj_bar()
{
    $('.nmProjectInfo').addClass('active').show();
}

function nm_update_title() {
    if (nmVersao == '') {
        nmDesVer = '';
    }

    if (nmGrpCod == '') {
        $("#proj_container").hide();
    }
    else {
        $("#proj_container").show();
    }

    $("#id_toolbar_codgrp").html(nmGrpCod);
    //$("#id_toolbar_codgrp").data('tooltip', nmGrpCod);


    if ((null != nmDesVer && "" != nmDesVer) || nmVersao == "") {
        $("#id_toolbar_codver").html(nmDesVer);
    }
    $('#project_tooltip .project').html(nmGrpCod);
    $('#project_tooltip .version').html(nmDesVer);
    $("#proj_container").popup({html: $('#project_tooltip').html() });
}

function nm_info_update() {
    nm_toggle_menu();
    nm_update_title();
    update_ht_current();
}

function nm_app_data(str_grp, str_app, int_typ, int_seq, str_calc, str_other, str_evt, str_btn, str_rlo, str_ver, str_dve, str_appxmlfld, str_friendly_name) {
    if (str_app == '') {
        document.form_atz_toolbar.sys_toolbar_grpcod.value = str_grp;
        document.form_atz_toolbar.sys_toolbar_appcod.value = str_app;
        document.form_atz_toolbar.sys_toolbar_appfriendly_name.value = (null != str_friendly_name)? str_friendly_name : '';
        document.form_atz_toolbar.sys_toolbar_apptyp.value = int_typ;
        document.form_atz_toolbar.sys_toolbar_appseq.value = int_seq;
        document.form_atz_toolbar.sys_toolbar_appcal.value = str_calc;
        document.form_atz_toolbar.sys_toolbar_other.value = str_other;
        document.form_atz_toolbar.sys_toolbar_evt.value = str_evt;
        document.form_atz_toolbar.sys_toolbar_btn.value = str_btn;
        document.form_atz_toolbar.sys_toolbar_rlo.value = str_rlo;
        document.form_atz_toolbar.sys_toolbar_codver.value = str_ver;
        document.form_atz_toolbar.sys_toolbar_desver.value = str_dve;
        document.form_atz_toolbar.sys_toolbar_appxmlfld.value = (null != str_appxmlfld) ? str_appxmlfld : '';
    }
    nm_store_app_data(str_grp, str_app, int_typ, int_seq, str_calc, str_other, str_evt, str_btn, str_rlo, str_ver, str_dve, str_appxmlfld, str_friendly_name);
    nm_info_update();
}

function nm_app_data_title(str_grp, str_app, int_typ, int_seq, str_calc, str_other, str_evt, str_btn, str_rlo, str_ver, str_dve, str_appxmlfld, str_friendly_name) {
    nm_store_app_data(str_grp, str_app, int_typ, int_seq, str_calc, str_other, str_evt, str_btn, str_rlo, str_ver, str_dve,str_appxmlfld, str_friendly_name);
    nm_update_title();
    nm_store_app_data(str_grp, "", "", "", "", "", "", "", "", str_ver, str_dve, str_appxmlfld, str_friendly_name);
    nm_toggle_menu();
}

function nm_store_app_data(str_grp, str_app, int_typ, int_seq, str_calc, str_other, str_evt, str_btn, str_rlo, str_ver, str_dve, str_appxmlfld, str_friendly_name) {
    nmGrpCod = str_grp;
    nmVersao = str_ver;
    nmDesVer = str_dve;
    nmAppCod = str_app;
    nmAppfriendly_name = (null != str_friendly_name ? str_friendly_name : '');
    nmAppTyp = int_typ;
    nmAppSeq = int_seq;
    nmAppDel = (null != str_calc && "S" == str_calc) ? true : false;
    nmAppEvt = str_evt;
    nmAppBtn = str_btn;
    nmAppRlo = str_rlo;
    nmOther = str_other;
    nmAppXmlFld = (null != str_appxmlfld) ? str_appxmlfld : '';
}

function ajax_get_show_app(n_aba_app, n_oper) {
    nm_refresh_home(n_aba_app);
    if (n_oper == null && document.form_top.trava_abas_app.value == 'S') return;
    param = 'ajax=nm';
    param += '&ajax_show_app=' + n_aba_app;
    if (n_oper != null) {
        param += '&ajax_aba_oper=' + n_oper;
    }
    try{ $('#id_toolbar_app_run').tooltipster('hide'); }catch(e){}

    $.ajax({
        type: 'POST',
        url: nm_url_iface + 'top.php',
        data: param,
        success: function (msg) {
            ajax_set_show_app(msg);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            ajax_set_show_app(errorThrown);
        }
    });
}

function ajax_set_show_app(str_retorno) {
    arr_retorno = str_retorno.split('__|SYSTEM_ABA|__');
    for (i_aba = 1; i_aba <= arr_retorno[3]; i_aba++) {
        document.getElementById('div_frm_bot_app' + i_aba).style.display = 'none';
        document.getElementById('sys_aba_page_' + i_aba).className = '';
    }
    if (arr_retorno[1] == 0) {
        document.getElementById('div_frm_bot_sys').style.display = '';
        document.getElementById('sys_aba_home').className = 'nmAbaAppOn';
        document.getElementById('sys_aba_home').style.cursor = 'pointer';
        document.form_top.num_aba_ativa.value = '';
        document.form_top.index_ifr_atual.value = '';
        nm_app_data(document.form_atz_toolbar.sys_toolbar_grpcod.value,
            document.form_atz_toolbar.sys_toolbar_appcod.value,
            document.form_atz_toolbar.sys_toolbar_apptyp.value,
            document.form_atz_toolbar.sys_toolbar_appseq.value,
            document.form_atz_toolbar.sys_toolbar_appcal.value,
            document.form_atz_toolbar.sys_toolbar_other.value,
            document.form_atz_toolbar.sys_toolbar_evt.value,
            document.form_atz_toolbar.sys_toolbar_btn.value,
            document.form_atz_toolbar.sys_toolbar_rlo.value,
            document.form_atz_toolbar.sys_toolbar_codver.value,
            document.form_atz_toolbar.sys_toolbar_desver.value, '',
            document.form_atz_toolbar.sys_toolbar_appfriendly_name.value);
    }
    else {
        if(arr_retorno[1] == undefined)
        {
            nm_exec_menu('exit');
            return;
        }
        document.getElementById('sys_aba_page_' + arr_retorno[1]).className = 'nmAbaAppOn';
        document.getElementById('sys_aba_page_' + arr_retorno[1]).style.cursor = 'pointer';
        document.getElementById('sys_aba_home').className = '';
        document.getElementById('div_frm_bot_sys').style.display = 'none';
        document.getElementById('div_frm_bot_app' + arr_retorno[2]).style.display = '';
        eval("nmFrmBot = nmFrmBot" + parseInt(arr_retorno[2]) + ";");

        nmArrFrmBot[arr_retorno[1]] = nmFrmBot;
        document.form_top.num_aba_ativa.value = arr_retorno[1];
        document.form_top.index_ifr_atual.value = arr_retorno[2];
        nm_app_data(document.getElementById('app_toolbar_grpcod' + arr_retorno[1]).value,
            document.getElementById('app_toolbar_appcod' + arr_retorno[1]).value,
            document.getElementById('app_toolbar_apptyp' + arr_retorno[1]).value,
            document.getElementById('app_toolbar_appseq' + arr_retorno[1]).value,
            document.getElementById('app_toolbar_appcal' + arr_retorno[1]).value,
            document.getElementById('app_toolbar_other' + arr_retorno[1]).value,
            document.getElementById('app_toolbar_evt' + arr_retorno[1]).value,
            document.getElementById('app_toolbar_btn' + arr_retorno[1]).value,
            document.getElementById('app_toolbar_rlo' + arr_retorno[1]).value,
            document.getElementById('app_toolbar_codver' + arr_retorno[1]).value,
            document.getElementById('app_toolbar_desver' + arr_retorno[1]).value, '',
            document.getElementById('app_toolbar_appfriendly_name' + arr_retorno[1]).value);

        if (arr_retorno[4] == 'save') nm_exec_menu('app_save');
    }
    nm_submit(arr_retorno[4], arr_retorno[1]);
    //    atualiza status da aplica��o na tela home
    if (arr_retorno[1] == 0 && arr_retorno[5] != '') {
        arr_apls = arr_retorno[5].split(';');
        for (i_apl = 0; i_apl < arr_apls.length; i_apl++) {
            apl_status = arr_apls[i_apl].split('=');
            if (window.nmFrmBotSys && window.nmFrmBotSys.nameIfrOpenList && window.nmFrmBotSys.nameIfrOpenList.document.getElementById('spn_status_updated_' + apl_status[0])) {
                if (apl_status[1] == 1) {
                    if (window.nmFrmBotSys.nameIfrOpenList.document.getElementById('spn_status_updated_' + apl_status[0]).style.display != 'none') {
                        document.form_top.refresh_home_open_app.value = 'S';
                    }
                }
                else {
                    if (window.nmFrmBotSys.nameIfrOpenList.document.getElementById('spn_status_updated_' + apl_status[0]).style.display != '') {
                        document.form_top.refresh_home_open_app.value = 'S';
                    }
                }
            }
        }
        nm_refresh_home(arr_retorno[1]);
    }

    /* abrindo varias aplicacoes */
    if (arr_retorno[1] == 0) {
        if (window.nmFrmBotSys && window.nmFrmBotSys.nameIfrOpenList && window.nmFrmBotSys.nameIfrOpenList.document && window.nmFrmBotSys.nameIfrOpenList.document.getElementById('hid_open_apps')) {
            if (window.nmFrmBotSys.nameIfrOpenList.document.getElementById('hid_open_apps').value != '') {
                window.nmFrmBotSys.nameIfrOpenList.show_open_apps();
            }
        }
    }
    update_ht_current()
}

function update_ht_current() {
    var onTab = $('.nmAbaAppOn');
    var tabName = onTab.html().toString().replace(/(<[^>]*>)/g, '');
    var htVal = '';

    if (onTab.attr('id') === 'sys_aba_home') {
        if (tabName.indexOf('Home') > -1 ) {
            htVal = "<span class=\"currentTab\"><i class=\"fa fa-home\"></i> Home</span>";
        } else {
            htVal = "<span class=\"currentTab\"> " + tabName + "</span>";
        }
    } else {
        htVal = "<span class=\"currentTab\"><i class=\"fa fa-table\"></i> " + tabName + "</span>"
    }

    $('.hidden-tabs').html(htVal);

}

function nm_refresh_home(v_num_aba) {
    retorno = false;
    if (v_num_aba == 0 && document.getElementById('sys_aba_home_title').innerHTML.indexOf('Home') > -1 && document.form_top.refresh_home_open_app.value == 'S') {
        retorno = true;
        document.form_top.refresh_home_open_app.value = 'N';
        try {
            if (document.getElementById('id_ifr_bottom_sys') && document.getElementById('id_ifr_bottom_sys').contentWindow.document.getElementById('ifrOpenList') && document.getElementById('id_ifr_bottom_sys').contentWindow.document.getElementById('ifrOpenList').contentWindow.nm_get_ajax_list_app) {
                document.getElementById('id_ifr_bottom_sys').contentWindow.document.getElementById('ifrOpenList').contentWindow.nm_get_ajax_list_app();
            }
        }
        catch (e) {
        }
    }
    update_ht_current();
    return retorno;
}

function nm_submit(n_oper) {
    switch (n_oper) {
        case'submit_form_menu':
            document.form_menu.submit();
            break;
        case'submit_form_log':
            document.form_log.submit();
            break;
        case 'submit_form_group':
            nm_close_all_abas_app();
            document.form_group.submit();
            break;
        case 'src_lang':
            document.getElementById("id_ifr_bottom_sys").src = nm_url_rand(nm_url_iface + 'lang.php');
            break;
        case 'src_config_region':
            document.getElementById("id_ifr_bottom_sys").src = nm_url_rand(nm_url_iface + 'config_region.php');
            break;
        case 'src_help_case':
            document.getElementById("id_ifr_bottom_sys").src = nm_url_rand(nm_url_iface + 'help_case.php');
            break;
        case 'src_main_menu':
            document.form_top.refresh_home_open_app.value = 'N';
            document.getElementById("id_ifr_bottom_sys").src = nm_url_rand(nm_url_iface + 'open_app.php');
            break;
        case 'src_import':
            document.getElementById("id_ifr_bottom_sys").src = nm_url_rand(nm_url_iface + 'admin_serv_backup_import.php');
            break;
        case 'src_create_express':
            document.getElementById("id_ifr_bottom_sys").src = nm_url_rand(nm_url_iface + 'wizard.php?create_type=express');
            break;
        case 'src_restore':
            document.getElementById("id_ifr_bottom_sys").src = nm_url_rand(nm_url_iface + 'app_restore.php');
            break;
        case 'submit_form_bkp_prj':
            document.form_bkp_prj.submit();
            break;
        case 'submit_form_import_prj':
            document.form_import_prj.submit();
            break;
    }
}

function ajax_get_close_app(n_aba_app, synchronous) {
    if (document.form_top.trava_abas_app.value == 'S') return;
    if (nmArrFrmBot[n_aba_app] && nmArrFrmBot[n_aba_app].frames["nmFrmRight_" + n_aba_app]
        && nmArrFrmBot[n_aba_app].frames["nmFrmRight_" + n_aba_app].document
        && nmArrFrmBot[n_aba_app].frames["nmFrmRight_" + n_aba_app].document.form_edit
        && nmArrFrmBot[n_aba_app].frames["nmFrmRight_" + n_aba_app].document.form_edit.form_modified) {
        objFrmDoc = nmArrFrmBot[n_aba_app].frames["nmFrmRight_" + n_aba_app].document;
        if ("Y" == objFrmDoc.form_edit.form_modified.value) {
            if (arr_prefs['auto_save'] == 'Y') {
                nmArrFrmBot[n_aba_app].frames["nmFrmLeft_" + n_aba_app].nm_msg_alert_auto_save();
            }
            else if (confirm(msg_confirm_save)) {

                ajax_get_show_app(n_aba_app, 'save');
                return;
            }
        }
    }
    try{ $('#id_toolbar_app_run').tooltipster('hide'); }catch(e){}
    param = 'ajax=nm';
    param += '&ajax_close_app=' + n_aba_app;
    $.ajax({
        type: 'POST',
        async: (synchronous == undefined ? true : synchronous),
        url: nm_url_iface + 'top.php',
        data: param,
        success: function (msg) {
            ajax_set_close_app(msg);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            ajax_set_close_app(errorThrown);
        }
    });
}

function nm_close_all_abas_app() {
    for (i_aba = 1; i_aba <= n_qtd_aba; i_aba++) {
        document.getElementById('div_frm_bot_app' + i_aba).style.display = 'none';
        document.getElementById('sys_aba_page_' + i_aba).style.display = 'none';
        document.getElementById('id_ifr_bottom' + i_aba).src = 'index.html';
    }
    param = 'ajax=nm';
    param += '&ajax_close_all_abas_app=S';
    $.ajax({
        type: 'POST',
        url: nm_url_iface + 'top.php',
        data: param
    });
    try{ $('#id_toolbar_app_run').tooltipster('hide'); }catch(e){}
}

function ajax_set_close_app(str_retorno) {
    var arr_retorno = str_retorno.split('__|SYSTEM_ABA|__');
    if(document.getElementById('sys_aba_page_' + arr_retorno[4]))
    {
        document.getElementById('sys_aba_page_' + arr_retorno[4]).style.display = 'none';
    }
    if( document.getElementById('div_frm_bot_app' + arr_retorno[4]))
    {
        $('#div_frm_bot_app' + arr_retorno[4]).hide();
    }
    if(document.getElementById('id_ifr_bottom' + arr_retorno[5]))
    {
        document.getElementById('id_ifr_bottom' + arr_retorno[5]).src = 'index.html';
    }

    if (arr_retorno[1] == 0 && arr_retorno[4] == 1) {
        //nm_exec_menu('home'); //removido loop infinito em projetos sem aplicação.
        ajax_get_show_app(0);
    }
    else {
        for (var n_aba = arr_retorno[3]; n_aba < n_qtd_aba; n_aba++) {
            var n_aba_next = (parseInt(n_aba) + 1);
            nmArrFrmBot[n_aba] = nmArrFrmBot[n_aba_next];
            if(document.getElementById('sys_aba_page_title_' + n_aba_next).innerHTML == '') continue;

            document.getElementById('sys_aba_page_title_' + n_aba).innerHTML = document.getElementById('sys_aba_page_title_' + n_aba_next).innerHTML;
            document.getElementById('sys_aba_page_' + n_aba).className = '';
            document.getElementById('app_toolbar_grpcod' + n_aba).value = document.getElementById('app_toolbar_grpcod' + n_aba_next).value;
            document.getElementById('app_toolbar_appcod' + n_aba).value = document.getElementById('app_toolbar_appcod' + n_aba_next).value;
            document.getElementById('app_toolbar_appfriendly_name' + n_aba).value = document.getElementById('app_toolbar_appfriendly_name' + n_aba_next).value;
            document.getElementById('app_toolbar_apptyp' + n_aba).value = document.getElementById('app_toolbar_apptyp' + n_aba_next).value;
            document.getElementById('app_toolbar_appseq' + n_aba).value = document.getElementById('app_toolbar_appseq' + n_aba_next).value;
            document.getElementById('app_toolbar_appcal' + n_aba).value = document.getElementById('app_toolbar_appcal' + n_aba_next).value;
            document.getElementById('app_toolbar_other' + n_aba).value = document.getElementById('app_toolbar_other' + n_aba_next).value;
            document.getElementById('app_toolbar_evt' + n_aba).value = document.getElementById('app_toolbar_evt' + n_aba_next).value;
            document.getElementById('app_toolbar_btn' + n_aba).value = document.getElementById('app_toolbar_btn' + n_aba_next).value;
            document.getElementById('app_toolbar_rlo' + n_aba).value = document.getElementById('app_toolbar_rlo' + n_aba_next).value;
            document.getElementById('app_toolbar_codver' + n_aba).value = document.getElementById('app_toolbar_codver' + n_aba_next).value;
            document.getElementById('app_toolbar_desver' + n_aba).value = document.getElementById('app_toolbar_desver' + n_aba_next).value;
        }
        $('#sys_aba_page_' + arr_retorno[1]).attr('class', 'nmAbaAppOn');
        for (var kk = 1; kk <= n_qtd_aba; kk++) {
            document.getElementById('div_frm_bot_app' + kk).style.display = 'none';
        }
        if(document.getElementById('div_frm_bot_app' + arr_retorno[2]))
        {
            document.getElementById('div_frm_bot_app' + arr_retorno[2]).style.display = '';
        }
        eval("nmFrmBot = nmFrmBot" + arr_retorno[2] + ";");
        nmArrFrmBot[arr_retorno[1]] = nmFrmBot;

        document.form_top.num_aba_ativa.value = arr_retorno[1];
        document.form_top.index_ifr_atual.value = arr_retorno[2];

        if(document.getElementById('app_toolbar_grpcod' + arr_retorno[1]))
        {
            nm_app_data(document.getElementById('app_toolbar_grpcod' + arr_retorno[1]).value,
                document.getElementById('app_toolbar_appcod' + arr_retorno[1]).value,
                document.getElementById('app_toolbar_apptyp' + arr_retorno[1]).value,
                document.getElementById('app_toolbar_appseq' + arr_retorno[1]).value,
                document.getElementById('app_toolbar_appcal' + arr_retorno[1]).value,
                document.getElementById('app_toolbar_other' + arr_retorno[1]).value,
                document.getElementById('app_toolbar_evt' + arr_retorno[1]).value,
                document.getElementById('app_toolbar_btn' + arr_retorno[1]).value,
                document.getElementById('app_toolbar_rlo' + arr_retorno[1]).value,
                document.getElementById('app_toolbar_codver' + arr_retorno[1]).value,
                document.getElementById('app_toolbar_desver' + arr_retorno[1]).value, '',
                document.getElementById('app_toolbar_appfriendly_name' + arr_retorno[1]).value);
        }
    }
    update_ht_current();
}

var nmScrollInterval;
function nmScroll(id, direcao) {
    if (direcao == 'stop') {
        clearInterval(nmScrollInterval);
        return;
    }
    if (direcao == 'left') {
        nmScrollInterval = setInterval("document.getElementById('" + id + "').scrollLeft = document.getElementById('" + id + "').scrollLeft - 3;", 2);
    }
    else {
        nmScrollInterval = setInterval("document.getElementById('" + id + "').scrollLeft = document.getElementById('" + id + "').scrollLeft + 3;", 2);
    }
}

function nmChangeTitleAbaHome(str_title) {
    $('#sys_aba_home_title').html(str_title);
    update_ht_current();
}

function ajax_get_create_aba(str_aba, str_tit, str_img, str_reload, str_aux, str_open_subapp) {
    if (str_reload == null) str_reload = 'N';
    if (str_open_subapp == null) str_open_subapp = '';
    try{ $('#id_toolbar_app_run').tooltipster('hide'); }catch(e){}
    param = 'ajax=nm';
    param += '&ajax_cretate_aba=' + encodeURI(str_aba);
    param += '&ajax_cretate_aba_img=' +  encodeURI(str_img);
    param += '&ajax_cretate_aba_tit=' + encodeURI(str_tit);
    param += '&ajax_cretate_aba_reload=' + encodeURI(str_reload);
    param += '&ajax_cretate_aba_aux=' + (str_aux != null ? str_aux : '');
    param += '&ajax_str_open_subapp=' + encodeURI(str_open_subapp);
    $.ajax({
        type: 'POST',
        url: nm_url_iface + 'top.php',
        data: param,
        success: function (msg) {
            ajax_set_create_aba(msg);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            ajax_set_create_aba(errorThrown);
        }
    });
}

function ajax_set_create_aba(str_retorno) {
    arr_retorno = str_retorno.split('__|SYSTEM_ABA|__');
    document.getElementById('div_frm_bot_sys').style.display = 'none';
    document.getElementById('sys_aba_home').className = 'nmAbaAppOff';
    for (var i_aba = 1; i_aba <= n_qtd_aba; i_aba++) {
        document.getElementById('sys_aba_page_' + i_aba).className = 'nmAbaAppOff';
        document.getElementById('div_frm_bot_app' + i_aba).style.display = 'none';
    }
    document.getElementById('sys_aba_page_' + arr_retorno[1]).style.display = '';
    document.getElementById('sys_aba_page_' + arr_retorno[1]).className = 'nmAbaAppOn';
    document.getElementById('div_frm_bot_app' + arr_retorno[2]).style.display = '';
    if (arr_retorno[3] == 'S') {

        nm_url_img = nm_url_img.replace("btnnew/crystal","top");
        document.getElementById('sys_aba_page_title_' + arr_retorno[1]).innerHTML = (arr_retorno[5] != '' ? "<img class='nmAbaIcon' src='" + nm_url_img + arr_retorno[5] + "' />" : "") + arr_retorno[6].replace("'", '');

        var urlIfr = nm_url_iface;
        switch (arr_retorno[4]) {
            case '__nm_sys_aba__sqlbuilder':
                urlIfr = nm_url_rand(nm_url_compat + 'nm_isql.php');
                break;
            case '__nm_sys_aba__session':
                urlIfr = nm_url_rand(nm_url_compat + 'nm_session.php');
                break;
            case '__nm_sys_aba__datadic':
                urlIfr += nm_url_rand('data_dic.php');
                break;
            case '__nm_sys_aba__libs':
                urlIfr = nm_url_rand(nm_url_compat + 'nm_edit_php.php');
                break;
            case '__nm_sys_aba__schema':
                urlIfr += nm_url_rand('app_schema_advanced.php');
                break;
            case '__nm_sys_aba__botoes':
                urlIfr += nm_url_rand('buttons.php?reset=1');
                break;
            case '__nm_sys_aba__template':
                urlIfr += nm_url_rand('app_template.php');
                break;
            case '__nm_sys_aba__admin':
                urlIfr = nm_url_rand(nm_url_iface + "admin.php?str_sub_open=" + arr_retorno[11]);
                break;
            case '__nm_sys_aba__prj_generate':
                urlIfr += nm_url_rand('select_apps.php?funcao=compile');
                break;
            case '__nm_sys_aba__open_connection':
                if (nmParamCreateAba[0] != '') {
                    str_par = '&conn_open=S&flag_open_conn=' + escape(nmParamCreateAba[0]);
                    nmParamCreateAba[0] = '';
                    urlIfr += nm_url_rand('admin_sys_allconections_create_wizard.php?' + str_par);
                }
                else {
                    urlIfr += nm_url_rand('admin_sys_allconections_create_wizard.php?conn_open=S');
                }
                break;
            case '__nm_sys_aba__src_new_app':
                urlIfr += nm_url_rand('wizard.php?create_type=normal');
                break;
            case '__nm_sys_aba__src_create_express':
                urlIfr += nm_url_rand('wizard.php?create_type=express');
                break;
            default:
                urlIfr += nm_url_rand(arr_retorno[4].replace("__nm_sys_aba__", "") + ".php");
                break;
        }
        document.getElementById('id_ifr_bottom' + arr_retorno[2]).src = urlIfr;
    }
    eval("nmFrmBot = nmFrmBot" + parseInt(arr_retorno[2]) + ";");

    nmArrFrmBot[arr_retorno[1]] = nmFrmBot;
    document.form_top.num_aba_ativa.value = arr_retorno[1];
    document.form_top.index_ifr_atual.value = arr_retorno[2];

    document.getElementById('app_toolbar_grpcod' + arr_retorno[1]).value = arr_retorno[7];
    document.getElementById('app_toolbar_appcod' + arr_retorno[1]).value = '';
    document.getElementById('app_toolbar_appfriendly_name' + arr_retorno[1]).value = '';
    document.getElementById('app_toolbar_apptyp' + arr_retorno[1]).value = '';
    document.getElementById('app_toolbar_appseq' + arr_retorno[1]).value = '';
    document.getElementById('app_toolbar_appcal' + arr_retorno[1]).value = '';
    document.getElementById('app_toolbar_other' + arr_retorno[1]).value = arr_retorno[8];
    document.getElementById('app_toolbar_evt' + arr_retorno[1]).value = '';
    document.getElementById('app_toolbar_btn' + arr_retorno[1]).value = '';
    document.getElementById('app_toolbar_rlo' + arr_retorno[1]).value = '';
    document.getElementById('app_toolbar_codver' + arr_retorno[1]).value = arr_retorno[9];
    document.getElementById('app_toolbar_desver' + arr_retorno[1]).value = arr_retorno[10];
    document.getElementById('app_toolbar_appfriendly_name' + arr_retorno[1]).value = arr_retorno[11];
    nmAppCod = '';
    nmAppfriendly_name = '';
    nm_toggle_menu();
    update_ht_current();
}

function nmChangeTitleAbaAtual(str_title) {
    if (document.form_top.num_aba_ativa.value != '' && document.getElementById('sys_aba_page_title_' + document.form_top.num_aba_ativa.value) && str_title) {
        document.getElementById('sys_aba_page_title_' + document.form_top.num_aba_ativa.value).innerHTML = str_title;
    }
}

function show_msg_thickbox(s_msg, b_modal, n_width, n_height) {
    b_modal = b_modal ? 'true' : 'false';
    document.getElementById('spn_msg_thickbox').innerHTML = s_msg;
    tb_show('', '#TB_inline?modal=' + b_modal + '&width=' + n_width + '&height=' + n_height + '&inlineId=div_msg_thickbox', '');
}

function show_msg_blockui(s_msg) {
    $.blockUI({
        forceIframe:true,
        blockMsgClass: 'blockClass',
        message: s_msg,
        onBlock: function() {},
        css: {
            top: '40px',
            position:'fixed',
            width: '60%',
            left: '20%'
        }
    });
}

function nm_menu_prj_generate(str_reload, str_direct_app) {
    ajax_get_create_aba('prj_generate', $('#id_menu_prj_generate').attr('data-title'), '', str_reload, str_direct_app);
}

function nm_open_load(message)
{

    msg = "";
    if (message === undefined)
    {
        msg += $('#load-default-value').val();
    }
    else
    {
        msg += message;
    }

    $('#msg-loading-sc').removeClass('hide');
    setTimeout(function() { return false; }, 500);
}
function nm_close_load()
{
    setTimeout(function() { $('#msg-loading-sc').addClass('hide'); }, 500);
}

function reloadToolbar()
{
    $.ajax({
        type: 'POST',
        url: nm_url_iface + 'top.php',
        data: 'ajax_reload_toolbar=S',
        success: function (msg)
        {
            //alert(msg);
            $('#id_toolbar_menu').html(msg);
            nm_toggle_menu();
        }
    });
}

var prj_action  = "";
var prj_cod_grp = "";
var prj_versao  = "";
var prj_ver_dve = "";
function prjAction(action, cod_grp, versao, ver_dve)
{
    prj_action  = action;
    prj_cod_grp = cod_grp;
    prj_versao  = versao;
    prj_ver_dve = ver_dve;

    nm_open_load();

    $('html').addClass('project-opened');
    $('#id_top_news_message').hide(300);
    $('.nmProjectInfo').removeClass('active').hide();
    $('#project_loading').addClass('active');
    nm_has_project_action_access(cod_grp);
}

function nm_has_project_action_access(cod_grp)
{
    $.ajax({
        type: 'POST',
        url: nm_url_iface + 'open_app.php',
        data: { ajax:'nm', option:'has_project_access', grp: cod_grp.split(';').shift() },
        success: function(msg)
        {
            arr_return = msg.trim().split('__NM__');
            if (arr_return[0] == 'OK')
            {
                doPrjAction(prj_action, prj_cod_grp, prj_versao, prj_ver_dve);
            }

            nm_close_load();
        }
    });
}

function doPrjAction(action, cod_grp, versao, ver_dve)
{
    $('.nmProjectInfo').hide();
    nm_app_data(cod_grp, '', '', '', '', '', '', '', '', versao, ver_dve);
    document.form_wiz.field_group.value = cod_grp;
    document.form_wiz.field_ver.value = versao;
    document.form_wiz.field_dve.value = ver_dve;
    if(action == "compile") {
        document.form_wiz.execute_apl_initial_cod_grp.value = cod_grp;
        document.form_wiz.execute_apl_initial_versao.value = versao;
    }
    document.form_wiz.prox_passo.value = action;
    document.form_wiz.wiz_step.value = action;
    document.form_wiz.submit();
    $('.nmProjectInfo').show();
    show_prj_bar();
}

function nm_open_project(str_prj)
{
    $('html').addClass('project-opened');
    $('#id_top_news_message').hide(300);
    $('.nmProjectInfo').removeClass('active').hide();
    $('#project_loading').addClass('active');
    nm_has_project_access(str_prj);
}

function nm_has_project_access(str_prj)
{
    $.ajax({
        type: 'POST',
        url: nm_url_iface + 'open_app.php',
        data: { ajax:'nm', option:'has_project_access', grp: str_prj.split(';').shift() },
        success: function(msg)
        {
            arr_return = msg.trim().split('__NM__');
            if (arr_return[0] == 'OK')
            {
                nm_open_load();
                nm_change_proj(str_prj);
                nm_toggle_menu();
                show_prj_bar();
            }
        }
    });
}

var sc_cod_prj = "";
var sc_cod_ver = "";
var sc_versao  = "";
function nm_change_proj(str_prj)
{
    arr_proj = str_prj.split(';');
    if(arr_proj[0] != null && arr_proj[0] != '')
    {
        if (arr_proj[3] == 'S')
        {
            nm_menu_group(arr_proj[0], 0, '');
        }
        else
        {
            nm_menu_group(arr_proj[0], arr_proj[1], arr_proj[2]);
        }
    }
}

function nmShowModal(id_modal, header, content, callback)
{
    if (typeof id_modal === "undefined"){ id_modal  = "id_modal"; }
    if (typeof header   === "undefined"){ header    = ""; }
    if (typeof content  === "undefined"){ content   = ""; }
    if (typeof callback === "undefined"){ callback  = ""; }

    if(header === "")
    {
        $('#alert-modal-title').parent().hide();
    }
    else
    {
        $('#alert-modal-title').html(header);
        $('#alert-modal-title').parent().show();
    }
    if(callback === "")
    {
        $('#alert-modal-cancel-btn').html('OK');
        $('#alert-modal-confirm-btn').hide();
    }
    else
    {
        $('#alert-modal-cancel-btn').html(str_lang_cancel);
        $('#alert-modal-confirm-btn').show();
    }
    $('#alert-modal-confirm-btn').attr('onclick', callback);
    $('#alert-modal-body').html(content);
    $('#'+id_modal).modal('show');
}

function nmCloseModal(id_modal, title, content, callback)
{
    if (typeof id_modal === "undefined") { id_modal = "id_modal"; }
    $('#'+id_modal).modal('hide');
}

function openPointerBox()
{
    $('.pointerBox').transition('fly down');
}

function nm_hide_toolbar() {
    $(".item-expand a").addClass('active');
    $('.app').addClass('app-expand');
}

function nm_show_toolbar() {
    $(".item-expand a").removeClass('active');
    $('.app').removeClass('app-expand');
}
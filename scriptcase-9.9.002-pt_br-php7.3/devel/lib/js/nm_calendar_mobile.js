function closeAllModalPanes() {
    $('.modal-pane-container.active').each(function (ix,el){
        $(el).toggleModalPane(false, true);
    });
}

function isMobile() {
    var app = getAppData();
    if (app.forceMobile) {
        return true;
    }
    var check = false;
    (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
    return check;
}

function bootstrapMobile() {
    var app = getAppData();
    var cCategories = $('.scCalendarCategory');
    var cMonthPicker = $("#sc-id-month-picker");

    if (isMobile() && app.improvements) {
        var appendTo = 'body';
        var bodyClass = 'scAppCalendarPage';
        var headerClass = 'scAppCalendarHeader';
        var toolbarClass = 'scAppCalendarToolbar';
        var toolbarPaddingClass = 'scAppCalendarToolbarPadding';

        var toggleHandler = function (e) {
            $('#__mp_' + e.data.baseID).toggleModalPane(true);
            e.data.options.onOpen($('#' + e.data.baseID + '.modal-pane-content'), e.data.openButton, e.data.closeButton);
        };
        $('body').append('<div id="sc-id-custom-container"></div>');
        $('#sc-id-custom-container').append($('#sc-id-custom-summ-div, #sc-id-custom-groupby-div'));

        $('#sc-id-mobile-out').remove();
        specificStyle();
        _process(function () {}).then(function () {
            toolbarPlacement();
        });

        if (cCategories) cCategories.openInModalPane({
            holdAjax: true,
            openingButton: '#sc-mobile-menu-categories',
            paneTitleText: $('.scCalendarCategoryTitle').text(),
            onReady: function (paneContent, openButton, closeButton) {

            },
            onOpen: function (paneContent, openButton, closeButton) {
                toggleToolbar();
            },
            appendTo: appendTo,
            bodyClass: bodyClass,
            headerClass: headerClass,
            toolbarClass: toolbarClass,
            toolbarPaddingClass: toolbarPaddingClass,
            toggleHandler: toggleHandler
        });

        if (cMonthPicker) cMonthPicker.openInModalPane({
            holdAjax: true,
            openingButton: "#calendar .fc-center",
            paneTitleText: '',
            onReady: function (paneContent, openButton, closeButton) {

            },
            onOpen: function (paneContent, openButton, closeButton) {
                monthPicker_show();
            },
            appendTo: appendTo,
            bodyClass: bodyClass,
            headerClass: headerClass,
            toolbarClass: toolbarClass,
            toolbarPaddingClass: toolbarPaddingClass,
            toggleHandler: toggleHandler
        });

        applySiteScroll();

        closeAllModalPanes();
        history.pushState(null, null, ' ');
        replaceThickBox({
            appendTo: appendTo,
            bodyClass: bodyClass,
            headerClass: headerClass,
            toolbarClass: toolbarClass,
            toolbarPaddingClass: toolbarPaddingClass,
            toggleHandler: toggleHandler
        });
        handlePopState();
        _process(function () {}, 2000).then(function () {
            $('.'+toolbarClass).find('a').removeClass('selected');
        });
        if (typeof nm_cancel_new_grid === 'function' && typeof $nm_cancel_new_grid !== 'function') {
            window.$nm_cancel_new_grid = nm_cancel_new_grid;
            window.nm_cancel_new_grid = function () {
                var keep_panel = true;
                var replace_cancel_btn = true;
                var fn_action_cancel = function (a,b) {
                    if (!a) {
                        parent.close();
                    }
                };
                fn_action_cancel(keep_panel, replace_cancel_btn);
                $nm_cancel_new_grid();
            }
        }
        if (typeof nmAjaxProcOn === 'function' && typeof $nmAjaxProcOn !== 'function') {
            app.procStarted = false;
            window.$nmAjaxProcOn = nmAjaxProcOn;
            window.$nmAjaxProcOff = nmAjaxProcOff;
            window.nmAjaxProcOn = function () {
                console.log('Ajax Interception...');
                if (app.procStarted) {
                    return true;
                }
                app.procStarted = true;
                if ($('.modal-pane-container.active')[0]) {
                    if (!$('.modal-pane-container.active[nm-modalpane-holdajax]')[0]) {
                        window.history.back();
                    }
                }
                $nmAjaxProcOn();
            };
            window.nmAjaxProcOff = function () {
                if (!app.procStarted) {
                    return true;
                }
                app.procStarted = false;
                if (app.appType === 'summary') {
                    _process(function () {}).then(function () {
                        if (app.displayScrollUp) appendScrollButton();
                        appendScrollBodyEvents();
                    });
                }
                $nmAjaxProcOff();
            };
        }
    } else {
        $('body').addClass('ready');
    }
}


function handlePopState() {
    window.stateInitialCount = history.length;
    $(window).off('popstate.panelState');
    $(window).on('popstate.panelState', function(e, d) {
        // closeAllModalPanes();
        e.preventDefault();
        e.stopPropagation();
        console.log(e);
        $('.modal-pane-container.active').toggleModalPane(false, true);
        // closeAllModalPanes();
        if (e.state !== null && e.state !== '') {
            $('#' + e.state).toggleModalPane(undefined, true);
        }



        var url = location.href;
        if (false) {
            if (url.substr('#') === -1) {
                e.preventDefault();
                e.stopPropagation();
                $('.modal-pane-container.active').toggleModalPane(false, true);
                // closeAllModalPanes();
                // if (e.state !== null && e.state !== '') {
                //     // $('#' + e.state).toggleModalPane(undefined, true);
                // }
            } else {
                var bits = url.split('#');
                $('.modal-pane-container.active').toggleModalPane(false, true);
                console.log(bits[1] === '');
                if (bits[1] === '') {
                    history.replaceState(null, null, "./");
                } else {
                    console.log(bits[1]);
                    if ($('#' + bits[1])[0]) {
                        $('#' + bits[1]).toggleModalPane(undefined, true);
                        history.replaceState(null, null, "./");
                    } else {
                        history.back()
                    }
                }
            }
        }


    });
}

function replaceThickBox(data) {
    var $tb_show = function $tb_show(a, b, c) {};
    if (typeof(window.tb_show) === 'function') {
        $tb_show = window.tb_show;
    }

    window.tb_show = function tb_show(a, b, c) {
        // var $tb_remove = function $tb_remove() {};
        if (!$('#TB_iframeContent_wrapper')[0]) {
            var frameHTML = '<div id="TB_iframeContent_wrapper"><iframe frameborder="0" hspace="0" id="TB_iframeContent" name="TB_iframeContent700" onload="backed = false; TB_iframeContent700.onpopstate = function(e) { if(backed == false){ e.stopPropagation(); e.preventDefault(); backed = true; window.history.back(); } };"></iframe></div>';
            $('#TB_iframeContent_wrapper').remove();
            $('body').append(frameHTML);
            $('#TB_iframeContent_wrapper').openInModalPane({
                openingButton: false,
                isFrame: true,
                paneTitleText: '',
                appendTo: data.appendTo,
                bodyClass: data.bodyClass,
                headerClass: data.headerClass,
                toolbarClass: data.toolbarClass,
                toolbarPaddingClass: data.toolbarPaddingClass,
                toggleHandler: data.toggleHandler
            });
        }
        var tb_frame = $('#TB_iframeContent');
        var tb_frame_wrapper = $('#TB_iframeContent_wrapper');

        //tb_frame.attr('src', b);
        TB_iframeContent700.location.replace(b);
        tb_frame.css({
            'width': '100vw',
            'height': 'calc(100vh - calc(100vh - 100%) - 40px)'
        });
        tb_frame_wrapper.toggleModalPane(true, false);
        toggleToolbar(window.event, true);
        // if (typeof(window.tb_remove) === 'function') {
        //     $tb_remove = window.tb_remove;
        // }
        window.tb_remove = function tb_remove(a, b, c) {
            history.go(-1);
            // tb_frame_wrapper.toggleModalPane(true, false);
            // tb_frame_wrapper.closest('.modal-pane-wrapper').find('.close-button-box').click();
            // window.tb_remove = $tb_remove;
        };
    };
}

function toolbarPlacement() {
    var appData = getAppData();
    var app = appData.appType;

    var header = $('.fc-header-toolbar .fc-right .fc-button-group');
    var scToolbar = $('.fc-header-toolbar .fc-right');
    var scToolbarContainer = $('.fc-header-toolbar');
    var scToolbarCenter = $('.fc-header-toolbar .fc-center');

    switch (app) {
        case 'calendar':
            break;
    }

    // var menuContainer = '<div class="calendar-mobile-menu-overlay"></div><div class="calendar-mobile-menu"><div class="calendar-mobile-menu-toolbar"></div><div class="calendar-mobile-menu-items"></div></div>';
    var menuContainer = $('.calendar-mobile-menu');
    var menuButton = '<div class="fc-button-group"><button type="button" id="calendar-menu-button" class="fc-button fc-state-default"><i class="fas fa-bars"></i></button></div>';
    var closeButton = '<div class="fc-button-group"><button type="button" id="calendar-close-button" class="fc-button fc-state-default"><i class="fas fa-times"></i></button></div>';

    // $('body').append(menuContainer);
    // $('.calendar-mobile-menu-toolbar').append(header);
    header.remove();


    $('.calendar-mobile-menu-toolbar').append(closeButton);
    scToolbar.append(menuButton);
    scToolbarContainer.append(scToolbar);
    $('.calendar-mobile-menu-overlay').off('click.menuToggle');
    $('.calendar-mobile-menu-overlay').on('click.menuToggle', function (a,b) {
        toggleToolbar(a,b);
    });
    $('#calendar-menu-button').off('click.menuToggle');
    $('#calendar-menu-button').on('click.menuToggle', function (a,b) {
        toggleToolbar(a,b);
    });
    $('.calendar-mobile-menu-toolbar button').off('click.menuToggle');
    $('.calendar-mobile-menu-toolbar button').on('click.menuToggle', function (a,b) {
        toggleToolbar(a,b);
    });
    $('.calendar-mobile-menu-items > div > span').off('click.menuToggle');
    $('.calendar-mobile-menu-items > div > span').on('click.menuToggle', function (a,b) {
        toggleToolbar(a,b);
    });

    menuContainer.find('button, a').off('click.activeToggle');
    menuContainer.find('button, a').on('click.activeToggle', function (e) {
        header.find('button').removeClass('fc-state-active');
        $(e.currentTarget).addClass('fc-state-active');
    });
}



function applySiteScroll() {
    var appData = getAppData();
    var app = appData.appType;
    let event = new Event("scrollApplied");

    switch (app) {
        case 'grid':
            $('#sc_grid_toobar_top_table > tbody, #sc_grid_body, #sc_grid_toobar_bot_table > tbody').attr('data-grab2scroll', 'true');
            break;
        case 'form':
            $('.scFormToolbar.sc-toolbar-top, .scFormToolbar.sc-toolbar-bottom').attr('data-grab2scroll', 'true');
            break;
        case 'search':
            $('.scFilterToolbar').attr('data-grab2scroll', 'true');
            break;
        case 'detail':
            $('.scGridToolbar').attr('data-grab2scroll', 'true');
            break;
        case 'summary':
            $('.scGridToolbar, #summary_body > .scGridTabelaTd').attr('data-grab2scroll', 'true');
            break;
    }
    document.dispatchEvent(event);
}



function toggleToolbar(e, forceClose) {
    if (forceClose === true) {
        $('.calendar-mobile-menu-overlay').removeClass('active');
        $('.calendar-mobile-menu').removeClass('active');
    } else {
        $('.calendar-mobile-menu-overlay').toggleClass('active');
        $('.calendar-mobile-menu').toggleClass('active');
    }
    return;
    var appData = getAppData();
    if (!appData.displayOptionsButton) return false;
    var overlay = $('.overlayToolbar')[0] ? $('.overlayToolbar') : $('<div class="overlayToolbar"></div>');
    var app = appData.appType;
    var toolBarTop;
    var scToolbar;
    var scHeadOptions;
    var stState = (forceClose === undefined) ? false : forceClose;
    var body = $('body');

    switch (app) {
        case 'grid':
            toolBarTop = $('#sc_grid_toobar_top').parent();
            scToolbar = $('.scGridToolbar');
            scHeadOptions = $('#sc_grid_head').find('.headerOptions');
            break;
        case 'form':
            toolBarTop = $('.scFormToolbar').parent();
            scToolbar = $('.scFormToolbar');
            scHeadOptions = $('td.scFormHeader').find('.headerOptions');
            break;
        case 'search':
            toolBarTop = $('.scFilterToolbar').parent();
            scToolbar = $('.scFilterToolbar');
            scHeadOptions = $('.scFilterHeader').find('.headerOptions');
            break;
        case 'detail':
        case 'summary':
            toolBarTop = $('.scGridTabelaTd > .scGridToolbar').parent();
            scToolbar = $('.scGridTabelaTd > .scGridToolbar');
            scHeadOptions = $('.scGridTabelaTd > .scGridHeader').find('.headerOptions');
            break;
    }

    if (stState) {
        toolBarTop.stop().slideUp();
        overlay.stop().fadeOut(100, function () {
            $('body, html').css({'overflow': '', 'height': ''});
            // $('body, html').off("touchmove.lock");
            overlay.remove();
            scToolbar[0].scrollTo(0, 0);
        });
    } else {
        if (!$('.overlayToolbar')[0]) {
            toolBarTop.stop().slideDown();
            body.prepend(overlay);
            $('body, html').css({'overflow': 'hidden', 'height': '100vh'});
            // $('body, html').on("touchmove.lock", function (e) { e.preventDefault(); });
            overlay.stop().fadeIn();
            overlay.on('click.showToolbar', toggleToolbar);
            $('#slide_signal').stop().fadeIn(100);
            var t = setTimeout(function () {
                $('#slide_signal').stop().fadeOut(500);
            }, 4000);
            scToolbar.find('>tbody').on('scroll.removeTimeout', function () {
                clearTimeout(t);
                $('#slide_signal').stop().fadeOut(500);
                scHeadOptions.off('click.removeTimeout');
                $(this).off('scroll.removeTimeout');
            });
            scHeadOptions.on('click.removeTimeout', function () {
                clearTimeout(t);
                $('#slide_signal').stop().fadeOut(500);
                scToolbar.off('scroll.removeTimeout');
                $(this).off('click.removeTimeout');
            });
            overlay.on('click.removeTimeout', function () {
                clearTimeout(t);
                $('#slide_signal').stop().fadeOut(500);
                scToolbar.off('scroll.removeTimeout');
                scHeadOptions.off('click.removeTimeout');
                $(this).off('click.removeTimeout');
            });
        } else {
            toolBarTop.stop().slideUp();
            overlay.stop().fadeOut(100, function () {
                $('body, html').css({'overflow': '', 'height': ''});
                // $('body, html').off("touchmove.lock");
                overlay.remove();
                scToolbar[0].scrollTo(0, 0);
            });
        }
    }
}



function toolbarStylingFixes() {
    var appData = getAppData();
    var app = appData.appType;

    switch (app) {
        case 'grid':
            $('.scGridToolbarPadding').parent().css({
                'padding': 0
            });
            break;
        case 'search':
            break;
        case 'detail':
            $('.scGridToolbarPadding').parent().css({
                'padding': 0
            });
            break;
        case 'summary':
            $('.scGridToolbarPadding').parent().css({
                'padding': 0
            });
            break;
    }
}

function specificStyle() {
    var appData = getAppData();
    var app = appData.appType;

    switch (app) {
        case 'grid':
            var hH = $('#sc_grid_head');

            $('#sc_grid_body > table').parents('table, tbody, tr, td').attr('style', 'display: block !important; width: 100% !important;');
            if (appData.displayOptionsButton) {
                $('#sc_grid_head > td.scGridTabelaTd').not('.headerOptions').attr('style', 'display: block !important; width: calc(100vw - 46px) !important;');
            } else {
                $('#sc_grid_head > td.scGridTabelaTd').not('.headerOptions').attr('style', 'display: block !important; width: calc(100vw) !important;');
            }
            $('#sc_grid_head').attr('style', 'position: fixed; top: 0; z-index: 10; display: flex !important; flex-direction: row; width: 100vw !important; align-items: stretch;');
            $('#sc_grid_toobar_top').attr('style', 'display: block !important; width: 100% !important; position: relative;');
            $('#sc-id-fixedheaders-placeholder, #sc-id-fixedheaders-placeholder *').css('opacity',  'inherit');
            $('.scGridTabelaTd').css({
                'padding': '0'
            });
            $('.scGridToolbarPadding').parent().css({
                'padding': 0
            });
            $('.scGridTabelaTd').css({
                'padding': '0'
            });
            $('#sc_grid_sumario, #sc_grid_sumario > td').css({
                'display': 'block'
            });
            if (appData.toolbarOrientation == 'H') {
                $('#sc_grid_toobar_top').append('<div id="slide_signal"><div class="bnc_arrow">&#x2039;</div></div>');

                $('#sc_grid_toobar_top').find('input[type="text"]').not('#quicksearchph_top input[type="text"]').css({
                    'padding': '5px',
                    'width': '35px'
                });

                $('body #quicksearchph_top img').css({
                    'top': '60%'
                });
            } else {
                $('#sc_grid_toobar_top').css({
                    'display': 'flex',
                    'flex-direction': 'column',
                    'justify-content': 'center',
                    'justify-items': 'center',
                    'align-items': 'center',
                    'align-content': 'center',
                    'width': '100%',
                    'max-height': '80vh',
                    'overflow-x': 'hidden',
                    'overflow-y': 'auto'
                });
                $('#sc_grid_toobar_top').find('.scGridToolbarPadding, tr, td, tbody').not('.SC_SubMenuApp *').attr('width', '');
                $('#sc_grid_toobar_top').find('.scGridToolbarPadding, tr, td, tbody').not('.SC_SubMenuApp *').css({
                    'display': 'flex',
                    'flex-direction': 'column',
                    'justify-content': 'center',
                    'justify-items': 'center',
                    'align-items': 'center',
                    'align-content': 'center',
                    'width': '100%'
                });
                $('#sc_grid_toobar_top').find('a, button, input, select, span').not('.SC_SubMenuApp *').css({
                    'justify-content': 'center',
                    'justify-items': 'center',
                    'align-items': 'center',
                    'align-content': 'center',
                    'text-align': 'center',
                    'margin': '2px 0',
                    'width': '100%'
                });
                if ($('#quicksearchph_top input[type="text"]').get()[0]) {
                    $('#quicksearchph_top input[type="text"]').get()[0].style.width = 'calc(100% - 35px)';
                }
                $(".NM_toolbar_sep").replaceWith('<hr style="width: 100%; border-color: rgba(0,0,0,.2); border-width: 0 0 1px 0;" />');
            }
            if (appData.displayOptionsButton) {
                $('#sc_grid_toobar_top').parent().css({
                    'position': 'fixed',
                    'z-index': '10',
                    'top': (parseInt(hH.outerHeight()) || 0) + 'px',
                    'display' : 'none',
                    'width': '100%'
                });
                $('body').css({
                    'padding-top': (parseInt(hH.outerHeight()) || 0) + 'px',
                });
                $('#sc-id-fixedheaders-placeholder').css({
                    'margin-top': ((parseInt(hH.outerHeight()) || 0) - 1) + '.5px',
                    'z-index': '7'
                });
            } else {
                $('#sc_grid_toobar_top').parent().css({
                    'position': 'fixed',
                    'z-index': '10',
                    'top': (parseInt(hH.outerHeight()) || 0) + 'px',
                    'width': '100%'
                });
                var hT = $('#sc_grid_toobar_top').parent();
                $('body').css({
                    'padding-top': ((parseInt(hH.outerHeight()) || 0) + (parseInt(hT.outerHeight()) || 0)) + 'px',
                });
                $('#sc-id-fixedheaders-placeholder').css({
                    'margin-top': (((parseInt(hH.outerHeight()) || 0) + (parseInt(hT.outerHeight()) || 0)) - 1) + '.5px',
                    'z-index': '7'
                });
                var t = setTimeout(function() { $('#slide_signal').stop().fadeOut(500); }, 4000);
            }
            if ($('#sc_grid_toobar_bot')[0]) {
                var height = '55px';
                if (appData['navigationBarButtons'].includes('sys_format_rows')) {
                    var height = '75px';
                }
                $('body').css({
                    'padding-bottom': height
                });
            } else {
                $('body').css({
                    'padding-bottom': ''
                });
            }
            break;
        case 'search':
            var hH = $('.scFilterHeader');
            $('form[name="F1"]').css({
                'overflow-x': 'hidden',
                'width': '100%',
                'border': 'none',
                'padding': '0'
            });
            $('.scFilterBorder').css({
                'border': 'none',
                'padding': '0'
            });
            $('.scFilterBorder').parent().css({
                'border': 'none',
                'padding': '0'
            });
            $('.scFilterHeader:not(#scrolltop-button)').parent().parent().css({
                'margin': '0',
                'border': 'none',
                'width': '100%',
                'position': 'fixed',
                'z-index': '10',
                'top' : '0',
                'left' : '0',
                'display' : 'flex',
                'flex-direction' : 'row',
                'align-items': 'stretch'
            });
            $('.scFilterToolbar').parents('td, tr, tbody, table').not('.scFilterBorder > table').not('.scFilterBorder > table > tbody').css({
                'display': 'block',
                'width': '100%'
            })
            $('.scFilterToolbar').parent().css({
                'overflow-x': 'scroll',
                'overflow-y': 'visible'
            })
            $('.scFilterToolbar').css({
                'border': '0',
                'margin': '0',
                'padding': '0'
            });
            $('.scFilterLabelOdd').closest('.scFilterTable').closest('.scFilterTableTd').css({
                'padding': '20px 0'
            });
            $('.scFilterLabelOdd').closest('.scFilterTable').closest('.scFilterTableTd').find('table, tbody, tr, td').not('.scFilterBlockFont, .scFilterBlockFont *').css({
                'display': 'flex',
                'flex-direction': 'column',
                'width': '100%',
                'max-width': '100vw',
                'overflow-x': 'visible',
                'margin': '0',
                'padding': '0',
                'border': '0'
            });
            $('.scFilterLabelOdd').closest('.scFilterTable').closest('.scFilterTableTd').find('.scFilterLabelOdd, .scFilterLabelEven').parent().css({

                'margin-left': 'auto',
                'margin-right': 'auto',
                'width': '90%'
            });
            $('.scFilterTable [class*="scButton_"]').css({
                'text-align': 'center',
            });

            $(".scFilterTable .NM_toolbar_sep").replaceWith('<hr style="width: 100%; border-color: rgba(0,0,0,.2); border-width: 0 0 1px 0;" />');

            if (appData.toolbarOrientation == 'H') {
                $('.scFilterToolbar').append('<div id="slide_signal"><div class="bnc_arrow">&#x2039;</div></div>');

                $('body #quicksearchph_top img').css({
                    'top': '60%'
                });
            } else {
                'obj_barra_top';
                $('.scFilterToolbarPadding').closest('table').not('.SC_SubMenuApp *').css({
                    'display': 'block',
                    'justify-content': 'center',
                    'justify-items': 'center',
                    'align-items': 'center',
                    'align-content': 'center',
                    'width': '100%',
                    'max-height': '80vh',
                    'overflow-x': 'hidden',
                    'overflow-y': 'auto'
                });
                $('.scFilterToolbarPadding').parents('table, tbody, tr, td').not('.SC_SubMenuApp *').attr('width', '');
                $('.scFilterToolbarPadding').closest('tbody').not('.SC_SubMenuApp *').css({
                    'display': 'block',
                    'justify-content': 'center',
                    'justify-items': 'center',
                    'align-items': 'center',
                    'align-content': 'center',
                    'width': '100%'
                });
                $('.scFilterToolbarPadding').closest('tr').not('.SC_SubMenuApp *').css({
                    'display': 'block',
                    'justify-content': 'center',
                    'justify-items': 'center',
                    'align-items': 'center',
                    'align-content': 'center',
                    'width': '100%'
                });
                $('.scFilterToolbarPadding').closest('td').not('.SC_SubMenuApp *').css({
                    'display': 'flex',
                    'flex-direction': 'column',
                    'justify-content': 'center',
                    'justify-items': 'center',
                    'align-items': 'center',
                    'align-content': 'center',
                    'width': '100%'
                });
                $('.scFilterToolbarPadding').find('a, button, input, select, span').not('.SC_SubMenuApp *').css({
                    'justify-content': 'center',
                    'justify-items': 'center',
                    'align-items': 'center',
                    'align-content': 'center',
                    'text-align': 'center',
                    'margin': '2px 0',
                    'width': '100%'
                });

                $(".NM_toolbar_sep").replaceWith('<hr style="width: 100%; border-color: rgba(0,0,0,.2); border-width: 0 0 1px 0;" />');
            }


            if (appData.displayOptionsButton) {
                $('.scFilterToolbar').parent().attr('style', 'position: fixed; z-index: 10; top: ' + (parseInt(hH.outerHeight()) || 0) + 'px; display:none !important; width: 100% !important; padding: 0;');
                $('body').css({
                    'padding-top': (parseInt(hH.outerHeight()) || 0) + 'px',
                });
            } else {
                $('.scFilterHeader').parent().css({
                    'display' : 'flex',
                    'width' : '100%'
                });
                $('.scFilterToolbar').parent().attr('style', 'position: fixed; z-index: 10; top: ' + ((parseInt(hH.outerHeight()) || 0) - 1) + 'px; important; width: 100% !important; padding: 0;');
                var hT = $('.scFilterToolbar').parent();
                $('body').css({
                    'padding-top': ((parseInt(hH.outerHeight()) || 0) + (parseInt(hT.outerHeight()) || 0)) + 'px',
                });
                var t = setTimeout(function() { $('#slide_signal').stop().fadeOut(500); }, 4000);
            }
            $('.scFilterLabelOdd img, .scFilterLabelEven img').closest('tr').not('.scFilterTable > tbody > tr, .scFilterTable > tr').children('td').attr('style', '')
            $('.scFilterLabelOdd img, .scFilterLabelEven img').closest('tr').not('.scFilterTable > tbody > tr, .scFilterTable > tr').attr('style', '')

            break;
        case 'detail':
        case 'summary':
            var hH = $('.scGridTabelaTd .scGridHeader');

            if (appData.appType == 'detail') {
                $('.scGridTabela td').css({
                    'white-space': 'normal',
                    'word-break': 'break-all',
                });
                if($('#idDetailTable .scGridTabela .scGridLabelFont').width() > $('#idDetailTable .scGridTabela').width()/2)
                {
                    $('#idDetailTable .scGridTabela .scGridLabelFont').width($('#idDetailTable .scGridTabela').width()/2);
                }
                $('.scGridTabela').parent().css({
                    'width': '100%',
                    'display': 'block'
                });
            }

            $('#summary_body').parents('table, tbody, tr, td').attr('style', 'display:block !important; width: 100% !important;');
            $('#summary_body').attr('style', 'display:block !important; width: 100% !important;');
            $('#summary_body > .scGridTabelaTd').attr('style', 'display:block !important; width: 100% !important;');
            $('.scGridTabelaTd').parent('table, tbody, tr, td').attr('style', 'display:block !important; width: 100% !important;');
            $('.scGridToolbarPadding').attr('width', '');
            $('.scGridToolbarPadding').attr('aligh', '');
            $('.scGridToolbarPadding').parents('table, tbody, tr, td').attr('style', 'display:block !important; width: 100% !important; white-space: nowrap;');
            $('.scGridTabelaTd > .scGridToolbar').attr('style', 'padding: 0;');
            $('.scGridBorder').parent().css('padding', '0');
            $('.scGridTabelaTd .scGridHeader').parent().parent().css({
                position: 'fixed',
                top: 0,
                'z-index': 11,
                display: 'flex',
                'flex-direction': 'row',
                'align-items': 'stretch',
                'width': '100vw'
            });
            $('.scGridTabelaTd .scGridHeader').parent().css({
                'flex-grow': '1',
                'padding': '0'
            });
            $('.scGridToolbarPadding').parent().css({
                'padding': 0,
                'display': 'table-row'
            });
            $('#res_chart_table').closest('td').css({
                'display': 'block',
                'margin': '0',
                'border': 'none',
                'width': '100%',
                'min-width': '100vw'
            });
            $('#res_chart_table').closest('tr').css({
                'display': 'block',
                'margin': '0',
                'border': 'none',
                'width': '100%',
                'min-width': '100vw'
            });
            $('#res_chart_table').find('table, tbody, tr, td').css({
                'display': 'block',
                'margin': '0',
                'border': 'none',
                'width': '100%',
                'min-width': '100vw'
            });
            $('#res_chart_table').css({
                'display': 'block',
                'margin': '0',
                'border': 'none',
                'width': '100%',
                'min-width': '100vw'
            });

            if (appData.toolbarOrientation == 'H') {
                $('.scGridTabelaTd > .scGridToolbar').append('<div id="slide_signal"><div class="bnc_arrow">&#x2039;</div></div>');

                $('body #quicksearchph_top img').css({
                    'top': '60%'
                });
            } else {
                'obj_barra_top';
                $('.scGridToolbarPadding').closest('table').not('.SC_SubMenuApp *').css({
                    'display': 'block',
                    'justify-content': 'center',
                    'justify-items': 'center',
                    'align-items': 'center',
                    'align-content': 'center',
                    'width': '100%',
                    'max-height': '80vh',
                    'overflow-x': 'hidden',
                    'overflow-y': 'auto'
                });
                $('.scGridToolbarPadding').parents('table, tbody, tr, td').not('.SC_SubMenuApp *').attr('width', '');
                $('.scGridToolbarPadding').closest('tbody').not('.SC_SubMenuApp *').css({
                    'display': 'block',
                    'justify-content': 'center',
                    'justify-items': 'center',
                    'align-items': 'center',
                    'align-content': 'center',
                    'width': '100%'
                });
                $('.scGridToolbarPadding').closest('tr').not('.SC_SubMenuApp *').css({
                    'display': 'block',
                    'justify-content': 'center',
                    'justify-items': 'center',
                    'align-items': 'center',
                    'align-content': 'center',
                    'width': '100%'
                });
                $('.scGridToolbarPadding').closest('td').not('.SC_SubMenuApp *').css({
                    'display': 'flex',
                    'flex-direction': 'column',
                    'justify-content': 'center',
                    'justify-items': 'center',
                    'align-items': 'center',
                    'align-content': 'center',
                    'width': '100%'
                });
                $('.scGridToolbarPadding').find('a, button, input, select, span').not('.SC_SubMenuApp *').css({
                    'justify-content': 'center',
                    'justify-items': 'center',
                    'align-items': 'center',
                    'align-content': 'center',
                    'text-align': 'center',
                    'margin': '2px 0',
                    'width': '100%'
                });

                $(".NM_toolbar_sep").replaceWith('<hr style="width: 100%; border-color: rgba(0,0,0,.2); border-width: 0 0 1px 0;" />');
            }


            if (appData.displayOptionsButton) {
                $('.scGridTabelaTd > .scGridToolbar').parent().attr('style', 'position: fixed; z-index: 10; top: ' + (parseInt(hH.outerHeight()) || 0) + 'px; display:none !important; width: 100% !important; padding: 0;');
                $('body').css({
                    'padding-top': (parseInt(hH.outerHeight()) || 0) + 'px',
                });

                $('#sc-id-summary-fixedheaders-placeholder').css({
                    'margin-top': ((parseInt(hH.outerHeight()) || 0) - 2) + '.5px',
                    'z-index': '7'
                });
            } else {

                $('.scGridTabelaTd > .scGridToolbar').parent().attr('style', 'position: fixed; z-index: 10; top: ' + ((parseInt(hH.outerHeight()) || 0) - 1) + 'px; important; width: 100% !important; padding: 0;');
                var hT = $('table.scGridToolbar').parent();
                $('body').css({
                    'padding-top': ((parseInt(hH.outerHeight()) || 0) + (parseInt(hT.outerHeight()) || 0)) + 'px',
                });

                $('#sc-id-summary-fixedheaders-placeholder').css({
                    'margin-top': (((parseInt(hH.outerHeight()) || 0) + (parseInt(hT.outerHeight()) || 0)) - 2) + '.5px',
                    'z-index': '7'
                });
                var t = setTimeout(function() { $('#slide_signal').stop().fadeOut(500); }, 4000);
            }
            break;
    }
    setTimeout(function(){
        $('body').addClass('ready');
    }, 1000);
}

function getAppData() {
    var app = {};
    if ($('#sc-mobile-app-data')[0]) {
        app = JSON.parse($('#sc-mobile-app-data').val());
    }
    if (!app.langs) {
        app.langs = {};
    }
    return app;
}

function moveWithTouch(el, vertical, horizontal) {
    $(el).on("touchstart.moveWithTouch", function(e) {
        var wH = window.innerHeight;
        var sP = $(this).outerHeight() + $(this)[0].getBoundingClientRect().y;
        var margin = parseInt($(this).css('margin-top'));
        var sY = e.changedTouches[0].pageY;

        $(this).on("touchmove.moveWithTouch", function (ee) {
            var mY = ee.changedTouches[0].pageY;
            var pY = mY - sY;
            var mR = (pY + margin);
            var fH;

            fH = (mR + $(this).outerHeight() + 130);
            if (fH <= wH) {
                margin = parseInt($(this).css('margin-top'));
                mR = mR - (fH - wH);
                sY = mY;
            }
            if (mR >= 0) {
                mR = 0;
                margin = 0;
                sY = mY;
            }
            ee.preventDefault();
            $(this).css('margin-top', mR + 'px');
        });

        $(this).on("touchend.moveWithTouch", function (ee) {
            $(this).off("touchcancel.moveWithTouch");
            $(this).off("touchmove.moveWithTouch");
            $(this).off("touchend.moveWithTouch");
        });

        $(this).on("touchcancel.moveWithTouch", function (ee) {
            $(this).off("touchcancel.moveWithTouch");
            $(this).off("touchmove.moveWithTouch");
            $(this).off("touchend.moveWithTouch");
        });
    });
}



function checkScrollMobile() {
    if (typeof scSetFixedHeaders == 'function') { scSetFixedHeaders(); }
    var app = getAppData();
    if (!app.displayScrollUp) return false;
    var a = 10;
    var b = 10;
    // var pos = $('[data-scroll]').scrollTop();
    var pos = $(document).scrollTop();
    var posa = $(window).scrollLeft();
    var posb = $('[data-scroll]').not('[data-scroll="0"]').scrollLeft();
    switch (app.appType) {
        case 'grid':
            a = (parseInt($('#sc_grid_toobar_top').parent().outerHeight()) || 0);
            if ($('#TB_Interativ_Search')[0]) {
                pos = $('[data-scroll]').scrollTop();
            } else {
                pos = $(document).scrollTop();
            }
            break;
        case 'summary':
            a = (parseInt($('.scGridTabelaTd .scGridHeader').outerHeight()) || 0) + (parseInt($('#obj_barra_top').outerHeight()) || 0);
            pos = $(document).scrollTop();
            break;
        default:
            a = 50;
            break;
    }
    clearTimeout(scrolltopTimer);
    // if(pos > a ||posa > a || posb > b) {
    if(pos > a ) {
        if (!$("#scrolltop-button").hasClass('active')) {
            toggleScrollButton('show');
        }
        scrolltopTimer = setTimeout(function() { toggleScrollButton('hide'); }, 4000);
    } else {
        if ($("#scrolltop-button").hasClass('active')) {
            toggleScrollButton('hide');
        }
    }
}







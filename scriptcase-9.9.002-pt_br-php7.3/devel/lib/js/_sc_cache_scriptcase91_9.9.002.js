function protectAjaxChar(str_field)
{
    str_field = replaceAll(str_field, '#', '__HASH__');
    str_field = replaceAll(str_field, '+', '__PLUS__');
    str_field = replaceAll(str_field, '-', '__MINUS__');
    str_field = replaceAll(str_field, '.', '__DOT__');
    str_field = replaceAll(str_field, ',', '__COMMA__');
    str_field = replaceAll(str_field, '&', '__E__');
    str_field = replaceAll(str_field, '=', '__EQ__');
    str_field = replaceAll(str_field, ' ', '__SPC__');
    str_field = replaceAll(str_field, '?', '__INT__');
    return str_field;
}

function replaceAll(string, token, newtoken) {
    try {
        while (string.indexOf(token) != -1) {
            string = string.replace(token, newtoken);
        }
    } catch (e) {
        nmFrmScaseRunFunc('errorMessage');
    }
    return string;
}

function ajaxGeraLog(url_iface, str_page, str_acao)
{
    $.ajax({
        type: 'POST',
        url: url_iface + 'top.php',
        async: true,
        data: 'gera_log=true&page='+ str_page +'&acao='+str_acao,
        success: function(retorno)
        {
        }
    });
}

function getJstree(idFrame)
{
    if($.jstree && $.jstree.reference('#div_geral'))
    {
        return $.jstree.reference('#div_geral');
    }
    else if(parent.$.jstree && parent.$.jstree.reference('#div_geral'))
    {
        return parent.$.jstree.reference('#div_geral');
    }
    else if(parent.document.getElementById('id_ifr_left_'+idFrame).contentWindow.$.jstree.reference('#div_geral'))
    {
        return parent.document.getElementById('id_ifr_left_'+idFrame).contentWindow.$.jstree.reference('#div_geral');
    }
}

function nm_menu_remove_item(id, idFrame)
{
    var obj = getJstree(idFrame);
    obj.delete_node(id);
}

function nm_menu_add_item(idFrame, data)
{
    var obj = getJstree(idFrame);
    if(!obj.get_node(data.id))
    {
        if(data.pos)
        {
            obj.create_node(data.parent, data, data.pos);
        }
        else {
            obj.create_node(data.parent, data);
        }
    }
}

function nm_menu_select_item(id, idFrame)
{
    var obj = getJstree(idFrame);
    obj.deselect_all(true);
    obj.select_node(id);
    return obj.get_node(id);
}


function __nm_toggle_field(field, action)
{
    if(action !== true) {
        $('#id_tr_' + field).hide();
        $('#id_tr_' + field + '_tr_cima').hide();
        return;
    }
    $('#id_tr_' + field).show();
    $('#id_tr_' + field + '_tr_cima').show();

}
/**
 * nm_ejs - Escape Jquery Selector
 * Est� fun��o vai escapar o seletor adicionando \\ caso algum caractere especial fa�a parte do seletor.
 *
 * Caracteres especiais do seletor jQuery: ":", ".", "[" e "]"
 *
 * @param element_selector - Seletor do elemento: ID, Classe, etc.
 * @usage Exemplo: $( # + nm_ejs( "some.id" ) )
 */
function nm_ejs(element_selector)
{
    return element_selector.replace( /(:|\.|\[|\])/g, "\\\\$1" );
}

var iCheckId = iCheckValue = null;
function nmiCheckToggle(elem,bool_submit)
{
    if(!$(elem).hasClass('disabled')) {
        if ($(elem).hasClass('icheck-checked')) {
            $(elem).removeClass('icheck-checked');
            $(elem).prev('.sc_icheck').val("N");
            $(elem).children('.infolabel').html('');
        }
        else {
            $(elem).addClass('icheck-checked');
            //$(elem).prev('.sc_icheck').prop( "checked" );
            $(elem).prev('.sc_icheck').val("S");
            $(elem).children('.infolabel').html('&#10004');
        }
        iCheckId = $(elem).prev('.sc_icheck').attr("id");
        iCheckValue = $(elem).prev('.sc_icheck').val();
        if (bool_submit == undefined) {
            nm_form_modified();
        }
    }
}

nmFrmScaseRunFunc = function nmFrmScaseRunFunc(funcExecCall, args) {
    var pageRoot = window;

    while(pageRoot.parent !== pageRoot) {
        pageRoot = pageRoot.parent;
    } try {
        if (pageRoot && pageRoot.nmFrmScase && typeof (pageRoot.nmFrmScase[funcExecCall]) === 'function') {
            var a;
            if (!args) {
                a = [];
            } else {
                a = (typeof (args) === typeof ([]) && args.length !== undefined) ? args : [args];
            }
            return pageRoot.nmFrmScase[funcExecCall].apply(window, a);
        } else {
            return false;
        }
    } catch(e) {}
}

document.execOnTopFrame = function execOnTopFrame(funcExecCall, args) {
    var pageRoot = window;

    while(pageRoot.parent !== pageRoot) {
        pageRoot = pageRoot.parent
    }

    if (typeof (pageRoot.document[funcExecCall]) === 'function') {
        var a;
        if (!args) {
            a = []
        } else {
            if (typeof (args) === typeof ([])) {
                a = args
            } else {
                a = [args]
            }
        }
        return pageRoot.document[funcExecCall].apply(pageRoot, a)
    } else {
        return false
    }
}

document.hotkeyHandler = function hotkeyHandler(e,h) {
    var pageRoot = window

    if (e && e.target) {
        if (typeof (e.target.blur) === typeof (function() {})) {
            e.target.blur();
        }
    }

    while(pageRoot.parent !== pageRoot) {
        pageRoot = pageRoot.parent
    }

    if (typeof (pageRoot.document.execHotKey) === 'function') {
        var f = {

        }
        return pageRoot.document.execHotKey(e,h,f)
    } else {
        return true
    }
}

document.hotkeyHandlerSetup = function hotkeyHandlerSetup(e,t,d) {
    if (!document.alreadySetHotkey) {
        document.alreadySetHotkey = true
        var shortcuts = document.execOnTopFrame('getHotkeyList')

        hotkeys.filter = function(event, a){
            if ( $('.ui.dimmer:visible').length > 0 ) {
                return false;
            } else {
                return true;
            }
        }
        hotkeys(shortcuts, function (ee, h) {
            return d.hotkeyHandler(ee, h)
        })
    }
}

function keyCodes() {
    var KeyEvent = {
        8: 'BACKSPACE',
        9: 'TAB',
        13: 'ENTER',
        14: 'ENTER',
        19: 'PAUSE',
        20: 'CAPSLOCK',
        27: 'ESCAPE',
        32: 'SPACE',
        33: 'PAGEUP',
        34: 'PAGEDOWN',
        35: 'END',
        36: 'HOME',
        37: 'ARROWLEFT',
        38: 'ARROWUP',
        39: 'ARROWRIGHT',
        40: 'ARROWDOWN',
        45: 'INSERT',
        46: 'DELETE',
        48: '0',
        49: '1',
        50: '2',
        51: '3',
        52: '4',
        53: '5',
        54: '6',
        55: '7',
        56: '8',
        57: '9',
        65: 'A',
        66: 'B',
        67: 'C',
        68: 'D',
        69: 'E',
        70: 'F',
        71: 'G',
        72: 'H',
        73: 'I',
        74: 'J',
        75: 'K',
        76: 'L',
        77: 'M',
        78: 'N',
        79: 'O',
        80: 'P',
        81: 'Q',
        82: 'R',
        83: 'S',
        84: 'T',
        85: 'U',
        86: 'V',
        87: 'W',
        88: 'X',
        89: 'Y',
        90: 'Z',
        91: 'META',
        93: 'CONTEXTMENU',
        96: '0',
        97: '1',
        98: '2',
        99: '3',
        100: '4',
        101: '5',
        102: '6',
        103: '7',
        104: '8',
        105: '9',
        106: '*',
        107: '+',
        109: '-',
        110: '.',
        111: '/',
        112: 'F1',
        113: 'F2',
        114: 'F3',
        115: 'F4',
        116: 'F5',
        117: 'F6',
        118: 'F7',
        119: 'F8',
        120: 'F9',
        121: 'F10',
        122: 'F11',
        123: 'F12',
        124: 'F13',
        125: 'F14',
        126: 'F15',
        127: 'F16',
        128: 'F17',
        129: 'F18',
        130: 'F19',
        131: 'F20',
        132: 'F21',
        133: 'F22',
        134: 'F23',
        135: 'F24',
        144: 'NUMLOCK',
        145: 'SCROLLLOCK',
        188: ',',
        190: '.',
        224: 'META'
    };

    return KeyEvent;
}

function bootsTrapLanguageTranslated() {
    $('input[language-translated]').not('.translation-input').each(function () {
        var input = $(this);
        var container = $.parseHTML('<div class="translation translation-input-container"></div>');

        input.after(container);
        input.addClass('translation-input');
        $(container).append(input);
        $(container).append('' +
            '<div class="translation-wrapper">' +
            '<div class="translation-loader">' +
            '<ul>' +
            '<li></li>' +
            '<li></li>' +
            '<li></li>' +
            '<li></li>' +
            '<li></li>' +
            '<li></li>' +
            '</ul>' +
            '</div>' +
            '<div class="translation-output-wrapper">' +
            '<img src="" class="translation-flag" /><span class="translation-output"></span>' +
            '</div>' +
            '</div>');
        // if (input.attr('language-translated'))
        $(container).find('.translation-output-wrapper').append('' +
            '<div class="translation-other-languages">' +
            '<ul></ul>' +
            '</div>' +
            '<div class="translation-other-languages-arrow"></div>' +
            '');

        input.bind('change.translate', function () {
            if (input.val().trim() !== '') {
                $(container).find('.translation-loader').css('display', 'block');
                $.ajax({
                    type: "POST",
                    url: '../iface/ajax_function.php',
                    data: {
                        call: 'translateString',
                        data: {
                            'input_text': input.val()
                        }
                    },
                    complete: function (a, b) {

                        $(container).find('.translation-loader').css('display', 'none');

                        $(container).find('.translation-other-languages ul').html('');

                        if (a.responseJSON && a.responseJSON.data && a.responseJSON.data.translation && a.responseJSON.data.translation.default && a.responseJSON.data.translation.default.trim() !== '') {
                            $(container).find('.translation-output').html(a.responseJSON.data.translation.default);
                            $(container).find('.translation-flag').attr('src', a.responseJSON.data.locale_data.default.img);
                            $(container).find('.translation-flag').attr('title', a.responseJSON.data.locale_data.default.idioma);
                            $(container).find('.translation-output-wrapper').slideDown();
                            $(container).find('.translation-other-languages ul').append('' +
                                '<li class="language"><img src="' + a.responseJSON.data.locale_data['default'].img + '" title="' + a.responseJSON.data.locale_data['default'].idioma + '" /><span>' + a.responseJSON.data.translation['default'] + '</span></li>'
                            );
                            if (Object.keys(a.responseJSON.data.translation).length > 2) {
                                $(container).find('.translation-other-languages ul').append('' +
                                    '<li><hr /></li>'
                                );
                            }
                            for (var key in a.responseJSON.data.translation) {
                                if (key !== a.responseJSON.data.locale_data.default.reg_set_default && key !== 'default') {
                                    $(container).find('.translation-other-languages ul').append('' +
                                        '<li class="language"><img src="' + a.responseJSON.data.locale_data[key].img + '" title="' + a.responseJSON.data.locale_data[key].idioma + '" /><span>' + a.responseJSON.data.translation[key] + '</span></li>'
                                    );
                                }
                            }
                        } else {
                            $(container).find('.translation-output-wrapper').slideUp();
                        }

                    },
                    dataType: 'json'
                });
            } else {
                $(container).find('.translation-output-wrapper').slideUp();
            }
        })
        input.trigger('change.translate');
        document.form_edit.form_modified.value = 'N';

    });
}

function reloadHotkeySchemes(select) {
    var loader = $(select).parent().find('.generic-loader');
    if ($(loader).css('visibility') !== 'visible' && $(select).not(':disabled').length > 0) {
        $(loader).css('visibility', 'visible');
        $.ajax({
            type: "POST",
            url: nm_url_iface + 'ajax_function.php',
            data: {
                call: 'getHotkeyTemplateSelect',
                data: {
                    value: $(select).val(),
                    name: $(select).attr('name')
                }
            },
            complete: function (a, b) {
                if (a.responseJSON && a.responseJSON.data) {
                    $(select)[0].outerHTML = a.responseJSON.data.select_data;
                    $(loader).css('visibility', 'hidden');
                }
            },
            dataType: 'json'
        });
    }
}

document.addEventListener('DOMContentLoaded', function(e){
    document.hotkeyHandlerSetup(e,document,document);
    bootsTrapLanguageTranslated();
}, false);
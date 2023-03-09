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
    while (string.indexOf(token) != -1)
    {
        string = string.replace(token, newtoken);
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


document.hotkeyHandler = function hotkeyHandler(e,h) {
    var pageRoot = window

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
        var shortcuts = ''
        shortcuts += 'ctrl+a,'
        shortcuts += 'ctrl+b,'
        shortcuts += 'ctrl+c,'
        shortcuts += 'ctrl+d,'
        shortcuts += 'ctrl+e,'
        shortcuts += 'ctrl+f,'
        shortcuts += 'ctrl+g,'
        shortcuts += 'ctrl+h,'
        shortcuts += 'ctrl+i,'
        shortcuts += 'ctrl+j,'
        shortcuts += 'ctrl+k,'
        shortcuts += 'ctrl+l,'
        shortcuts += 'ctrl+m,'
        shortcuts += 'ctrl+n,'
        shortcuts += 'ctrl+o,'
        shortcuts += 'ctrl+p,'
        shortcuts += 'ctrl+q,'
        shortcuts += 'ctrl+r,'
        shortcuts += 'ctrl+s,'
        shortcuts += 'ctrl+t,'
        shortcuts += 'ctrl+u,'
        shortcuts += 'ctrl+v,'
        shortcuts += 'ctrl+w,'
        shortcuts += 'ctrl+x,'
        shortcuts += 'ctrl+y,'
        shortcuts += 'ctrl+z,'
        shortcuts += 'ctrl+1,'
        shortcuts += 'ctrl+2,'
        shortcuts += 'ctrl+3,'
        shortcuts += 'ctrl+4,'
        shortcuts += 'ctrl+5,'
        shortcuts += 'ctrl+6,'
        shortcuts += 'ctrl+7,'
        shortcuts += 'ctrl+8,'
        shortcuts += 'ctrl+9,'
        shortcuts += 'ctrl+0,'
        shortcuts += 'command+a,'
        shortcuts += 'command+b,'
        shortcuts += 'command+c,'
        shortcuts += 'command+d,'
        shortcuts += 'command+e,'
        shortcuts += 'command+f,'
        shortcuts += 'command+g,'
        shortcuts += 'command+h,'
        shortcuts += 'command+i,'
        shortcuts += 'command+j,'
        shortcuts += 'command+k,'
        shortcuts += 'command+l,'
        shortcuts += 'command+m,'
        shortcuts += 'command+n,'
        shortcuts += 'command+o,'
        shortcuts += 'command+p,'
        shortcuts += 'command+q,'
        shortcuts += 'command+r,'
        shortcuts += 'command+s,'
        shortcuts += 'command+t,'
        shortcuts += 'command+u,'
        shortcuts += 'command+v,'
        shortcuts += 'command+w,'
        shortcuts += 'command+x,'
        shortcuts += 'command+y,'
        shortcuts += 'command+z,'
        shortcuts += 'command+1,'
        shortcuts += 'command+2,'
        shortcuts += 'command+3,'
        shortcuts += 'command+4,'
        shortcuts += 'command+5,'
        shortcuts += 'command+6,'
        shortcuts += 'command+7,'
        shortcuts += 'command+8,'
        shortcuts += 'command+9,'
        shortcuts += 'command+0,'
        shortcuts += 'alt+1,'
        shortcuts += 'alt+2,'
        shortcuts += 'alt+3,'
        shortcuts += 'alt+4,'
        shortcuts += 'alt+5,'
        shortcuts += 'alt+6,'
        shortcuts += 'alt+7,'
        shortcuts += 'alt+8,'
        shortcuts += 'alt+9,'
        shortcuts += 'alt+pageup,'
        shortcuts += 'alt+pagedown,'
        shortcuts += 'alt+q,'
        shortcuts += 'alt+/,'
        shortcuts += 'f1,'
        shortcuts += 'f2,'
        shortcuts += 'f3,'
        shortcuts += 'f4,'
        shortcuts += 'f5,'
        shortcuts += 'f6,'
        shortcuts += 'f7,'
        shortcuts += 'f8,'
        shortcuts += 'f9,'
        shortcuts += 'f10,'
        shortcuts += 'f11,'
        shortcuts += 'f12'

        hotkeys.filter = function(event){
            return true;
        }
        hotkeys(shortcuts, function (ee, h) {
            return d.hotkeyHandler(ee, h)
        })
    }
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

    });
}

document.addEventListener('DOMContentLoaded', function(e){
    document.hotkeyHandlerSetup(e,document,document);
    bootsTrapLanguageTranslated();
}, false);

function startFontAwesomeFieldGeneric(str_id_preview, el)
{
    if(!$(el).hasClass('iconpicker-input')) {
        $(el).iconpicker({hideOnSelect: true}).on('iconpickerSelected', function(e){ updateIconPreviewGeneric(str_id_preview, $(el).val()); nm_form_modified(); }).on('iconpickerShown', function(e){ $('.iconpicker-search').focus(); });
        $(el).focus();
    }
}

function updateIconPreviewGeneric(str_id_preview, iconVal) {
    $('#' + str_id_preview).attr('class', iconVal);
}
/*var lang_toolbar_add = {$lang_toolbar_add};
var lang_toolbar_confirm_del = {$lang_toolbar_confirm_del};
var lang_toolbar_save = {$lang_toolbar_save};
*/
var color_sub = '#008000';
var str_group_buttons_display_tab = "&nbsp;&nbsp;&nbsp;";
function nm_move_field_out_sub(str_obj) {

    lastToReturn = 0;
    $('select[name=' + str_obj + '] > option').each(function (i, t) {

        if($(t).is(':selected') || lastToReturn > 0)
        {
            if (($(t).val()).substr(0, 7) == '__GRP__' || $(t).val().substr(0, 7) != '__SUB__' ) return false;

            var arr_value = $(t).val().split('__SUB__');
            str_value = arr_value[1];
            $(t).val(str_value);
            $(t).html($(t).html().split(str_group_buttons_display_tab + str_group_buttons_display_tab).join(str_group_buttons_display_tab));

            $(t).css('color', '');

            lastToReturn = i;
        }
    });
    nm_form_modified();
}
function nm_move_field_to_sub(str_obj) {
    firstToMove = true;
    $('select[name=' + str_obj + '] > option').each(function (i, t) {

        if($(t).is(':selected'))
        {
            if(firstToMove)
            {
                //test if before first is group or sub
                keyAnterior = i-1;
                val_anterior = $('select[name=' + str_obj + '] option:eq( '+ keyAnterior +' )').val();
                if (val_anterior.substr(0, 7) != '__GRP__' && val_anterior.substr(0, 7) !='__SUB__') return false;
            }

            if ($(t).val().substr(0, 7) == '__GRP__' || $(t).val().substr(0, 7) =='__SUB__' || $(t).val().substr(0, 7) =='__blc__' ) return false;

            var arr_value = $(t).val().split('_#fld#_');
            str_value = '__SUB__' + arr_value[0] + '_#fld#_' + arr_value[1];
            $(t).val(str_value);
            $(t).html($(t).html().split(str_group_buttons_display_tab).join(str_group_buttons_display_tab + str_group_buttons_display_tab));
            $(t).css('color', color_sub);
        }
    });
    nm_form_modified();
}
function nm_group_toolbar_get_name(str_obj)
{
    var str_obj = str_obj.replace('toolbars_mobile', '').replace('toolbars', '');
    var max_name = parseInt(0);
    $('select[name=toolbars_mobile' + str_obj + '] > option, select[name=toolbars' + str_obj + '] > option').each(function(i, t)
    {
        if($(t).val().substr(0, 7) == '__GRP__')
        {
            var name = $.unserialize($(t).val().substr(7).split('__#!NMDATA!#__')[1]);
            name = (name.name).split('group_')[1];
            if(max_name < parseInt(name))
            {
                max_name = parseInt(name);
            }
        }
    });
    return 'group_'+ (max_name + 1);
}

function nm_addGroup_change_display_type(str_value)
{
    if(str_value == 'list')
    {
        $('.notGroup').show();
        $('.group').hide();
    }
    else
    {
        $('.notGroup').hide();
        $('.group').show();
    }
}

function change_fa_select(el, has_94)
{
    if ($(el).val().indexOf('fontawesome') > -1) {
        if (has_94) {
            $('.fa_toggle').addClass('active');
        } else {
            nmFrmScaseRunFunc('noPermission');
            $('.fa_toggle').removeClass('active');
            $("#id_toolbar_group_display").closest('.dropdown').dropdown('set selected', ($("#id_toolbar_group_display ~ .menu .item:first").attr('data-value')));
        }
    } else {
        $('.fa_toggle').removeClass('active');
    }
}

function updateIconPreview(iconVal, iconPrev) {
    $(iconPrev).attr('class', iconVal);
}

function startFontAwesomeField(el)
{
    $('#id_toolbar_group_icon').val($('#id_toolbar_group_icon_fa').val());
    if(!$(el).hasClass('iconpicker-input')) {
        $(el).iconpicker({hideOnSelect: true, placement: 'top'}).on('iconpickerSelected', function(e){ updateIconPreview($(el).val(), $(el).parent().parent().find('#icon-preview')); $(el).change(); }).on('iconpickerShown', function(e){ $('.iconpicker-search').focus(); });
        $(el).focus();
    }
}

function nm_addGroup_toolbar(str_obj)
{
    $('input[name=obj_selected]').val(str_obj);
    $('.form_edit_toolbar').val('');
    
    $("#id_toolbar_group_display_type").val($("#id_toolbar_group_display_type ~ .menu .item:first").attr('data-value'));
    $("#id_toolbar_group_display_type").change();
    $("#id_toolbar_group_display_type_css").val($("#id_toolbar_group_display_type_css ~ .menu .item:first").attr('data-value'));
    $("#id_toolbar_group_type").val($("#id_toolbar_group_type ~ .menu .item:first").attr('data-value'));
    $("#id_toolbar_group_display").closest('.dropdown').dropdown('set selected', ($("#id_toolbar_group_display ~ .menu .item:first").attr('data-value')));
    $("#id_toolbar_group_display_position").val($("#id_toolbar_group_display_position ~ .menu .item:first").attr('data-value'));
    $('#id_toolbar_group_content_icons').closest('.ui.toggle').checkbox('uncheck');
    $('#id_toolbar_group_name').val(nm_group_toolbar_get_name(str_obj));
    $('#id_toolbar_add_save_grp').attr('onclick', 'nm_button_addGroup_toolbar()');
    $('#id_toolbar_add_save_grp').val(lang_toolbar_add);
    $('span.fa_field i').attr('class', 'fas fa-cog');
    $('#id_toolbar_group_icon_fa').val('fas fa-cog');
    // $('#id_overlay_metal').show();
    // $('#id_form_edit_toolbar').fadeIn();
    showModal();
}
function nm_cancel_window_toolbar() {
    $('#id_toolbars_group_buttons').modal('hide');
}
function nm_button_addGroup_toolbar() {
    var str_obj = $('input[name=obj_selected]').val();
    var name_grp = $('#id_toolbar_group_label').val().replace(/\"/g,'\\"');

    if($('#id_toolbar_group_display_type').val() == 'group')
    {
        name_grp = $('#id_toolbar_group_name').val();
    }

    var option_data = '__GRP__' + name_grp + '__#!NMDATA!#__'+ $('.form_edit_toolbar').serialize()
        + '_#fld#_' + name_grp;

    var ja_entrou = 0;
    $('select[name=' + str_obj + '] > option:selected').each(function (i, t) {
        if (ja_entrou == 1) return false;

        var content = "<option style='color:#008000' value='"+ option_data +"' >" +
                str_group_buttons_display_tab + name_grp + "</option>";

        if(  $(t).val().substr(0,7) == '__blc__' )
        {
            $(t).prepend().after(content);
        }
        else
        {
            $(t).prepend().before(content);
        }
        ja_entrou = 1;
    });
    if (ja_entrou == 0) {
        $('select[name=' + str_obj + ']').html(
            $('select[name=' + str_obj + ']').html() +
                "<option style='color:#008000' value='"+ option_data +"' >" +
                str_group_buttons_display_tab + name_grp + "</option>");
    }
    nm_cancel_window_toolbar();
    nm_move_field_to_sub(str_obj);
    nm_form_modified();
}
function nm_delGroup_toolbar(str_obj)
{
    if(!confirm(lang_toolbar_confirm_del))
    {
        return false;
    }

    has_deleted = false;
    pos_deleted = 0;
    $('select[name=' + str_obj + '] > option').each(function(i,t)
    {
        if ($(t).is(':selected') && $(t).val().substr(0, 7) == '__GRP__')
        {
            $(t).remove();
            has_deleted = true;
            pos_deleted = i;

            return false;
        }
    });

    if(has_deleted)
    {
        found_sub = true;

        $('select[name=' + str_obj + '] option:selected').prop("selected", false);

        $('select[name=' + str_obj + '] > option').each(function(i,t)
        {
            if(i >= pos_deleted)
            {
                if ($(t).val().substr(0, 7) == '__SUB__')
                {
                    $(t).prop('selected', true);
                }
                else
                {
                    found_sub = false;
                }
            }

            if(!found_sub)
            {
                return false;
            }
        });

        nm_move_field_out_sub(str_obj);

        $('select[name=' + str_obj + '] option:selected').prop("selected", false);
    }

    nm_form_modified();
}
function nm_editGroup_toolbar(str_obj) {
    $('input[name=obj_selected]').val(str_obj);
    var obj_selected = $('select[name=' + str_obj + '] > option:selected');
    if (obj_selected.val().substr(0, 7) != '__GRP__') return false;

    $('#id_toolbar_add_save_grp').attr('onclick', 'nm_button_saveGroup_toolbar()');
    $('#id_toolbar_add_save_grp').val(lang_toolbar_save);
    var valor = obj_selected.val().split('__#!NMDATA!#__')[1].split('_#fld#_')[0];
    obj_valor = $.unserialize(valor);

    if (obj_valor.display_type === undefined) {
        obj_valor.display_type = $('#id_toolbar_group_display_type').find("option:first-child").val();
    }
    $('#id_toolbar_group_display_type').parent().dropdown('set selected', (obj_valor.display_type || 'list'));
    $('#id_toolbar_group_display_type').change();
    $('#id_toolbar_group_display_type_css').parent().dropdown('set selected', (obj_valor.display_type_css || 'app'));
    $('#id_toolbar_group_name').val(obj_valor.name);
    $('#id_toolbar_group_content_icons').closest('.ui.toggle').checkbox((obj_valor.content_icons == 'S') ? 'check' : 'uncheck');
    $('#id_toolbar_group_label').val(prepareValues(obj_valor.label));
    $('#id_toolbar_group_hint').val(prepareValues(obj_valor.hint));
    $('#id_toolbar_group_type').parent().dropdown('set selected', obj_valor.type);
    $('#id_toolbar_group_icon').val(prepareValues(obj_valor.icon));
    $('#id_toolbar_group_icon_fa').val(prepareValues(obj_valor.icon_fa));
    updateIconPreview(obj_valor.icon_fa);
    $('#id_toolbar_group_display').parent().dropdown('set selected', obj_valor.display);
    $('#id_toolbar_group_display_position').parent().dropdown('set selected', obj_valor.display_position);

    // $('#id_overlay_metal').show();
    showModal();

}

function showModal()
{
    $('#id_toolbars_group_buttons').modal({
        closable: false,
        centered: false,
        duration: 400,
        autofocus: false,
        dimmerSettings: {
            template : {
                dimmer: function() {
                    return $('<div>').attr('class', 'ui dimmer flexed_dimmer');
                }
            }
        },
        onShow: function () {
            $('#id_toolbars_group_buttons .ui.dropdown').each(function(i,t) {
                $(t).dropdown('refresh');
                // $(t).dropdown();
            });
        },
        onVisible: function () {
            $('#id_toolbars_group_buttons .ui.dropdown').dropdown('refresh');
            // $('#id_toolbars_group_buttons .ui.dropdown').dropdown('hide');
        },
        onHide: function () {
            // $('#id_toolbars_group_buttons .ui.dropdown select').each(function(i,t) {
            //     $(t).addClass('ui');
            //     $(t).addClass('dropdown');
            //     $(t).parent().dropdown( 'destroy' ).replaceWith($(t));
            // });
        }
    }).modal('show');
}

function prepareValues(valor)
{
    return (typeof valor !== 'undefined') ? valor.replace(/\+/g," ").replace(/%2B/g,"+").replace(/\"/g,'\\"').replace(/%2F/g,"\/").replace(/%2C/g,",").replace(/%3B/g,";") : '';
    // return valor.replace(/\+/g," ").replace(/%2B/g,"+").replace(/\"/g,'\\"').replace(/%2F/g,"\/").replace(/%2C/g,",").replace(/%3B/g,";");
}

function nm_button_saveGroup_toolbar()
{
    str_obj = $('input[name=obj_selected]').val();
    $('select[name=' + str_obj + '] > option:selected').each(function(i,t)
    {
        if ($(t).val().substr(0, 7) == '__GRP__') {
            var option_data = '__GRP__' + $('#id_toolbar_group_label').val().replace(/\"/g,'\\"') + '__#!NMDATA!#__'+ $('.form_edit_toolbar').serialize()
            + '_#fld#_' + $('#id_toolbar_group_label').val();
            $(t).val(option_data);

            val_to_display = $('#id_toolbar_group_label').val();
            if($('#id_toolbar_group_display_type').val() == 'group')
            {
                val_to_display = $('#id_toolbar_group_name').val();
            }
            $(t).html(str_group_buttons_display_tab + val_to_display);
            return false;
        }
    });

    nm_cancel_window_toolbar();
    nm_form_modified();
}

(function($){
    $.unserialize = function(serializedString){
        var str = decodeURI(serializedString);
        var pairs = str.split('&');
        var obj = {}, p, idx, val;
        for (var i=0, n=pairs.length; i < n; i++) {
            p = pairs[i].split('=');
            idx = p[0];

            if (idx.indexOf("[]") == (idx.length - 2)) {
                // Eh um vetor
                var ind = idx.substring(0, idx.length-2)
                if (obj[ind] === undefined) {
                    obj[ind] = [];
                }
                obj[ind].push(p[1]);
            }
            else {
                obj[idx] = p[1];
            }
        }
        return obj;
    };
})(jQuery);
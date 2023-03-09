(function($) {

    var settings;

    $.fn.drawFields = function(options) {
        settings = $.extend({
            class: "nmLive3",
            backgroundColor: "#FFFFFF",
            debug: false,
            template: 'text',
            title: '',
            name: 'field'
        }, options);
        retorno = draw(settings);

        return this.append(retorno);
    };

    function draw(settings) {
        var elm;
        var isHidden = false;

        if(settings.name == 'Mascara_Consulta' && settings.value == false)
        {
            settings.value = '';
        }


        switch (settings.template) {

            case 'number':
            case 'text':
                settings.template = settings.template == "color_html" ? 'color' : settings.template;
                elm = create('input').attr('type', settings.template).val(settings.value);
                break;
            case 'color_html':
            case 'color':
                settings.template = settings.template == "color_html" ? 'color' : settings.template;
                settings.link_icon = '';
                elm = create('input').attr('type', settings.template).val(settings.value);
                break;
            case 'type':
                elm = create('select');
                $.each(settings.options, function (i, n) {
                    optgroup = create('optgroup').attr('label',  nm_get_text_lang("['fld_type_" + i + "']"));
                    $.each(n, function(a,b) {
                        option = create('option').text( nm_get_text_lang("['fld_type']['" + b + "']") ).val(b);
                        if (settings.value == b) {
                            option.attr('selected', 'selected');
                        }
                        optgroup.append(option);
                    });
                    elm.append(optgroup);
                });
                break;
            case 'sel_optgroup':
                elm = create('select');
                $.each(settings.options, function (i, n) {
                    optgroup = create('optgroup').attr('label',  i);
                    $.each(n, function(a,b) {
                        option = create('option').text( b ).val(b);
                        if (settings.value == b) {
                            option.attr('selected', 'selected');
                        }
                        optgroup.append(option);
                    });
                    elm.append(optgroup);
                });
                break;
            case 'prop_type':

                elm = create('select');
                $.each(settings.options, function (i, n) {
                    optgroup = create('optgroup').attr('label',  nm_get_text_lang("['fld_type_" + i + "']"));
                    $.each(n, function(a,b) {
                        option = create('option').text( b ).val(a);
                        if (settings.value == a) {
                            option.attr('selected', 'selected');
                        }
                        optgroup.append(option);
                    });
                    elm.append(optgroup);
                });

                break;
            case 'pdf_formato':
            case 'pdf_fonte_size':
            case 'sel':
                if(settings.name == 'Lookup_Cons')
                {
                    elm = create('input').attr('type', 'button').attr('class', 'nmButton').on("click", function(){nm_open_lookup() }).val("Lookup");
                    break;
                }
                elm = create('select');
                $.each(settings.options, function (i, n) {
                    option = create('option').text(n).val(i);
                    if (settings.value == i) {
                        option.attr('selected', 'selected');
                    }
                    elm.append(option);
                });
                break;
            case 'chk':
            case 'checkbox':
                elm = create('span');

                $.each(settings.options, function (i, n) {
                    option = create('input').attr('type', 'checkbox').val(i);
                    option.attr('name', settings.name);
                    option.on('click', function(){ eval(settings.on_click);} );
                    if (jQuery.inArray(i, settings.value) >= 0) {
                        option.attr('checked', 'checked');
                    }
                    elm.append(
                        create('label').append(option).append(' ' + n).css('padding-right', '3px')
                    );
                });
                break;
            case 'radio':
               // console.log(settings);
                elm = create('span');

                if( settings.options == true)
                {
                    elm.append(
                        create('input').attr('type','hidden').attr('name',settings.name)
                        .val(settings.value)
                        .addClass('sc_icheck')
                    );

                    elm.append(
                        create('span').addClass('icheck').addClass(settings.value == 'S' ? ' icheck-checked' : '')
                            .attr('onclick', 'nmiCheckToggle(this, 1);saveField("'+settings.name+ '", $(this).hasClass(\'icheck-checked\') ? \'S\' : \'N\', \''+settings.str_sub +'\');'+ settings.on_click)
                            .append('<small class="jack"></small>')
                            .append('<small class="infolabel">✔</small>')
                    );
                }
                else {
                    $.each(settings.options, function (i, n) {
                        option = create('input').attr('type', settings.template).val(i);
                        option.attr('name', settings.name);
                        option.on('click', function () {
                            eval(settings.on_click);
                        });
                        if (settings.value == i) {
                            option.attr('checked', 'checked');
                        }
                        elm.append(
                            create('label').append(option).append(' ' + n).css('padding-right', '3px')
                        );
                    });
                }
                break;

            case 'field_type':
                elm = create('span').text(settings.value);
                break;
            default:
                //console.log(settings);
            case 'info':
            case 'hidden':
                isHidden = true;
                elm = create('input').attr('type', 'hidden').val(settings.value);
                break;


        }
        elm.attr('data-str_sub', settings.str_sub);
        if (settings.template != 'radio')
        {
            elm.attr('name', settings.name);
            elm.attr('class', 'nmInput');
        }

        elm.on('change', function(){ saveField(settings.name, this.value, settings.str_sub); eval(settings.on_change);} );
        elm.on('blur', function(){ eval(settings.on_blur);} );
        elm.on('keydown', function(){ eval(settings.on_keydown);} );




        if(!isHidden) {
            return create('tr')
                .attr('id', 'id_tr_'+settings.name)
                .attr('style', (settings.tr_style != '' ? settings.tr_style.split("style='")[1].split("'")[0] : ''))
                .append(
                    create('td')
                        .attr('class', 'nmLineV3')
                        .attr('id', 'id_title_'+settings.name)
                        .text(settings.title)
                )


                .append(
                    create('td')
                        .attr('class', 'nmLineV3')
                        .append(elm)
                        .append(settings.link_icon)
                )
                .append(
                    create('td')
                        .attr('class', 'nmLineV3')
                        .html(" <i class='fa fa-question-circle nmHelpExpress' id='id_desc_" + settings.name + "' aria-hidden='true' title='"+ settings.desc +"'></i> "))
                ;
        }
        else
        {
            return elm;
        }
    }

    function create(tag){
        var elm = document.createElement(tag.toUpperCase());
        return $(elm);//.addClass('scriptcaseField-'+rulerId);
    }


}) (jQuery);
var item_selected = "";
var menuItens     = [];
var maxId         = 0;
var idPrefix      = "item";
var menuTitle     = "";

$( document ).ready(function() {

	$('.ui.dropdown').dropdown();
	$('.sc-menueditor-toolbar').hide();

	$('.sc-action').hide();
	$('.sc-action.menu').show();

	$('.sc-menueditor-sidebar.options').hide();

	$('.sc-action').click(function(){
	    addObj();
	});

	$('#item_position a').click(function(){
	    $('#item_position a').removeClass('active');
	    $(this).addClass('active');
	});

	

	$('.sc-action.remove').click(function(){
	    removeObj();
	});

	showMenuForAdd('', '', true)
});

function ID() {
	maxId++;

	return idPrefix + "_" + maxId;
}

function showMenuForAdd(strId, type, bol_show_panel)
{
	$('.sc-menueditor-toolbar-item li').hide();

	itemSelected = type;
	switch(itemSelected)
	{
		case '':
			itemSelected = 'layer';
		break;
		case 'layer':
			itemSelected = 'item';

			$('.sc-menueditor-toolbar-item #item_id').show();
			$('.sc-menueditor-toolbar-item #item_position').show();
		break;
		case 'item':
			itemSelected = 'subitem';

			$('.sc-menueditor-toolbar-item li').show();
			$('.sc-menueditor-toolbar-item #item_position').hide();			
		break;
	}

    $('.sc-action, .sc-menueditor-toolbar').hide();
    $('.sc-action.' + itemSelected).show();

    $('.sc-menueditor-toolbar-item').show();

    //$('.sc-menueditor-sidebar.options').show();

    if(itemSelected != 'layer')
    {
    	$('.sc-action.remove').show();
    }

    if(type != '')
    {
		setItensValue();
	    showItensProperly();
	}

	$("#id_buttons").show();
}

function setItensValue()
{
	strId = $(item_selected).attr('id');

	$('#item_id span').html( menuItens[ strId ].item_id );

	//position
	if(menuItens[ strId ].item_position == 'left')
	{
		$('#item_position a:first-of-type').click();
	}
	else
	{
		$('#item_position a:last-of-type').click();
	}

	$("#item_type div[data-value='"+ menuItens[ strId ].item_type +"']").click();

	$("#item_label input").val( menuItens[ strId ].item_label );
	$("#item_link input").val( menuItens[ strId ].item_link );
	$("#item_hint input").val( menuItens[ strId ].item_hint );
	$("#item_icon input").val( menuItens[ strId ].item_icon );
	$("#item_badge input").val( menuItens[ strId ].item_badge );
	$("#icon-preview").removeClass();
	$("#icon-preview").addClass( menuItens[ strId ].item_icon );

	$("#item_target div[data-value='"+ menuItens[ strId ].item_target +"']").click();

	$("#item_date_format input").val( menuItens[ strId ].item_date_format );
	$("#item_image input").val( menuItens[ strId ].item_image );
	$("#item_image_width input").val( menuItens[ strId ].item_image_width );
	$("#item_image_height input").val( menuItens[ strId ].item_image_height );
	$("#item_value input").val( menuItens[ strId ].item_value );


	$( $("#item_buttons > div") ).dropdown('clear');
	for(it=0; it<menuItens[ strId ].item_buttons.length; it++)
	{
		$("#item_buttons div[data-value='"+ menuItens[ strId ].item_buttons[it] +"']").click();
	}

	$("#item_library div[data-value='"+ menuItens[ strId ].item_library +"']").click();
	$("#item_method div[data-value='"+ menuItens[ strId ].item_method +"']").click();

	$("#item_css_align div[data-value='"+ menuItens[ strId ].item_css_align +"']").click();

	$("#item_css_color input").val( menuItens[ strId ].item_css_color );
	$("#item_css_padding input").val( menuItens[ strId ].item_css_padding );
	$("#item_css_margin input").val( menuItens[ strId ].item_css_margin );
	$("#item_css_width input").val( menuItens[ strId ].item_css_width );
	$("#item_css_height input").val( menuItens[ strId ].item_css_height );
	$("#item_css_border input").val( menuItens[ strId ].item_css_border );
	$("#item_css_background_color input").val( menuItens[ strId ].item_css_background_color );
	$("#item_css_background_image input").val( menuItens[ strId ].item_css_background_image );
	$("#item_css_background_repeat input").val( menuItens[ strId ].item_css_background_repeat );
	$("#item_css_background_position input").val( menuItens[ strId ].item_css_background_position );
}

function showItensProperly()
{
	$('#item_position').hide();
	$('#item_type').hide();

	$('.itens_link_target').hide();
	$('.itens_label_hint').hide();

	$('.iconItens').hide();

	$('#item_date_format').hide();
	$('#item_image').hide();
	$('.itens_image').hide();
	$('#item_value').hide();
	$('#item_buttons').hide();
	$('#item_library').hide();
	$('#item_method').hide();
	$('#item_buttons').hide();

	$('.cssItens').show();

	if($(item_selected).attr('data-type') == 'layer')
	{
		$('#item_position').show();
	}
	else
	{
		$('#item_type').show();

		switch($('#item_type select').val())
		{
			case 'link':
				$('.itens_link_target').show();
				$('.itens_label_hint').show();

				$('.iconItens').show();
			break;
			case 'title':
				$('.iconItens').show();
			break;
			case 'data':
				$('#item_date_format').show();
				$('.iconItens').show();
			break;
			case 'image':
				$('#item_image').show();
				$('.itens_image').show();
			break;
			case 'value':
				$('#item_value').show();
				$('.iconItens').show();
			break;
			case 'library':
				$('#item_library').show();
			break;
			case 'buttons':
				$('#item_buttons').show();
			break;
			case 'method':
				$('#item_method').show();
			break;
		}
	}
}

function selectObj(obj)
{
    item_selected = $(obj).parent();

    $('.obj').removeClass('active');
    $(obj).parent().addClass('active');

    $('.sc-menueditor-header h3').html('Configurar ' + $(obj).parent().attr('data-type'));

	showMenuForAdd($(item_selected).attr('id'), $(item_selected).attr('data-type'), true);

	$('.sc-menueditor-sidebar.options').show();
}

function saveItem()
{
	if(item_selected != '')
	{
		strId = $(item_selected).attr('id');

		menuItens[ strId ].item_position = 'left';
		if($('#item_position a:last-of-type').hasClass('active'))
		{
			menuItens[ strId ].item_position = 'right';
		}
		
		menuItens[ strId ].item_type = $("#item_type select").val();
		menuItens[ strId ].item_label = $("#item_label input").val();
		menuItens[ strId ].item_link = $("#item_link input").val();
		menuItens[ strId ].item_hint = $("#item_hint input").val();
		menuItens[ strId ].item_icon = $("#item_icon input").val();
		menuItens[ strId ].item_badge = $("#item_badge input").val();
		menuItens[ strId ].item_target = $("#item_target select").val();
		menuItens[ strId ].item_date_format = $("#item_date_format input").val();
		menuItens[ strId ].item_value = $("#item_value input").val();
		menuItens[ strId ].item_buttons = $("#item_buttons select").val();
		menuItens[ strId ].item_image = $("#item_image input").val();
		menuItens[ strId ].item_image_width = $("#item_image_width input").val();
		menuItens[ strId ].item_image_height = $("#item_image_height input").val();
		menuItens[ strId ].item_library = $("#item_library select").val();
		menuItens[ strId ].item_method = $("#item_method select").val();

		menuItens[ strId ].item_css_color = $("#item_css_color input").val();
		menuItens[ strId ].item_css_padding = $("#item_css_padding input").val();
		menuItens[ strId ].item_css_margin = $("#item_css_margin input").val();
		menuItens[ strId ].item_css_align = $("#item_css_align select").val();
		menuItens[ strId ].item_css_width = $("#item_css_width input").val();
		menuItens[ strId ].item_css_height = $("#item_css_height input").val();
		menuItens[ strId ].item_css_border = $("#item_css_border input").val();
		menuItens[ strId ].item_css_background_color = $("#item_css_background_color input").val();
		menuItens[ strId ].item_css_background_image = $("#item_css_background_image input").val();
		menuItens[ strId ].item_css_background_repeat = $("#item_css_background_repeat input").val();
		menuItens[ strId ].item_css_background_position = $("#item_css_background_position input").val();

		strAdd = "";
		if($(item_selected).attr('data-type') == 'layer')
		{
			strAdd = "Layer ";
		}
		setTxtToDisplay(strId, strAdd);
	}

	nm_form_modified();
}

function setTxtToDisplay(strId, txtAdd)
{
	strToDisplay = '';
	if(menuItens[ strId ].item_type == 'link')
	{
		strToDisplay = menuItens[ strId ].item_label;
	}
	else if(menuItens[ strId ].item_type == 'title')
	{
		strToDisplay = menuTitle;
	}
	else if(menuItens[ strId ].item_type == 'value')
	{
		strToDisplay = menuItens[ strId ].item_value;
	}
	else if(menuItens[ strId ].item_type == 'buttons')
	{
		strToDisplay = 'Buttons ' + menuItens[ strId ].item_buttons;
	}
	else if(menuItens[ strId ].item_type == 'data')
	{
		strToDisplay = menuItens[ strId ].item_date_format;
	}
	else if(menuItens[ strId ].item_type == 'image')
	{
		strToDisplay = menuItens[ strId ].item_image;

		strToDisplay = strToDisplay.split('__NM__');
		strToDisplay = strToDisplay[ strToDisplay.length-1 ];
	}
	else if(menuItens[ strId ].item_type == 'method')
	{
		strToDisplay = menuItens[ strId ].item_method;

		strToDisplay = strToDisplay.split('__NM__');
		strToDisplay = strToDisplay[ strToDisplay.length-1 ];
	}
	else if(menuItens[ strId ].item_type == 'library')
	{
		strToDisplay = menuItens[ strId ].item_library;
	}

	if(strToDisplay == '')
	{
		strToDisplay = strId;
	}

	$('#'+ strId +' > span').text( txtAdd + strToDisplay );
}

function removeObj()
{
	if(item_selected != '')
	{
	    item_selected.remove();
	}
	item_selected = "";

	showMenuForAdd('', '', true);

	$("#id_buttons").hide();

	nm_form_modified();
}

function addObj()
{
	id = ID();

	position = "";
	if(item_selected != '')
	{
	    append_to = item_selected.attr('id');

	    $('<div class="obj obj-item" data-type="item" id="'+id+'"><span onclick="selectObj(this)">'+ id +'</span></div>').appendTo(item_selected);
	}
	else
	{
		$('<div class="obj obj-menu" data-type="layer" id="'+id+'"><span onclick="selectObj(this)">Layer '+ id +'</span></div>').appendTo('.sc-menueditor-generated-menu');

		position = "left";
	}

	menuItens[ id ] = {
				'item_id':id, 
				'item_position':position, 
				'item_type':'link', 
				'item_label':'', 
				'item_link':'', 
				'item_hint':'', 
				'item_icon':'', 
				'item_badge':'',
				'item_target':'',
				'item_date_format':'', 
				'item_image':'', 
				'item_image_width':'',
				'item_image_height':'',
				'item_value':'',
				'item_buttons':'',
				'item_library':'',
				'item_method':'', 
				'item_css_color':'',
				'item_css_padding':'',
				'item_css_margin':'',
				'item_css_align':'',
				'item_css_width':'',
				'item_css_height':'',
				'item_css_border':'',
				'item_css_background_color':'',
				'item_css_background_image':'',
				'item_css_background_repeat':'',
				'item_css_background_position':'',
				'itens':[],
				};

	nm_form_modified();
}

function cancelItem()
{
	$('.sc-menueditor-sidebar.options').hide();

	$('.obj.obj-item').removeClass('active');
}

function saveMenuItens2(str_field)
{
	saveItem();

	arrMenuItens = [];

	getMenuRecursively(arrMenuItens, ".sc-menueditor-generated-menu");

	$('#' + str_field).val( JSON.stringify(arrMenuItens) );
}

function getMenuRecursively(arrMenuItens, strObj)
{
	if($(strObj + " > div").length > 0)
	{
		$(strObj + " > div").each(function ()
		{
			strId = $(this).attr('id');

			arrMenuItens.push(menuItens[strId]);

			if ($('#' + strId + " > div").length > 0) {
				getMenuRecursively(arrMenuItens[ arrMenuItens.length-1 ].itens, '#' + strId);
			}
		});
	}
}

function updateIconPreview(iconVal) {
	$('#icon-preview').attr('class', iconVal);
}
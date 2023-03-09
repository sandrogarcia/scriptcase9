function showHelp()
{
	$('.div_help').toggle(); setTimeout(function(){$('.div_help').hide();}, 13000);
}

function toggleEditor(str_option)
{
    var widthScreen = $('body').width();
   if(str_option == 'close')
   {
       document.cookie = 'sc_event_editor=closed';
       $('#id_precodes').hide();
       $('#id_close').hide();
       $('#id_open').show();
       editor.setSize(widthScreen);
       $('#id_div_code').width(widthScreen);
       savePrecodes('N');
   }
   else
   {
       document.cookie = 'sc_event_editor=opened';
       $('#id_precodes').show();
       $('#id_close').show();
       $('#id_open').hide();
       $('#id_div_code').width('70%');
       editor.setSize($('#id_div_code').width());
       savePrecodes('Y');
   }
   editor.refresh();
}

function toggleFullscreenEditing(mode)
{
    var editorDiv = $('.CodeMirror-scroll');
    if (!editorDiv.hasClass('fullscreen')) {
		toggleEditor('close');
        if (mode === 'medium') {
            parent.nm_toggle_left_layout(1);
        }
        if (mode === 'large') {
            parent.nm_toggle_left_layout(1);
            parent.parent.$(".item-expand a").addClass('active');
            parent.parent.$('.app').addClass('app-expand');
        }
        editorDiv.addClass('fullscreen');
   }
    else {
		toggleEditor('open');
        parent.nm_toggle_left_layout(0);
        parent.parent.$(".item-expand a").removeClass('active');
        parent.parent.$('.app').removeClass('app-expand');
        editorDiv.removeClass('fullscreen');
    }

}

function getPageSize()
{
    var xScroll, yScroll;
    if (window.innerHeight && window.scrollMaxY) {
        xScroll = document.body.scrollWidth;
        yScroll = window.innerHeight + window.scrollMaxY;
    } else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
        xScroll = document.body.scrollWidth;
        yScroll = document.body.scrollHeight;
    } else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
        xScroll = document.body.offsetWidth;
        yScroll = document.body.offsetHeight;
    }

    var windowWidth, windowHeight;
    if (self.innerHeight) {	// all except Explorer
        windowWidth = self.innerWidth;
        windowHeight = self.innerHeight;
    } else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
        windowWidth = document.documentElement.clientWidth;
        windowHeight = document.documentElement.clientHeight;
    } else if (document.body) { // other Explorers
        windowWidth = document.body.clientWidth;
        windowHeight = document.body.clientHeight;
    }
    // for small pages with total height less then height of the viewport
    if(yScroll < windowHeight){
    pageHeight = windowHeight;
    } else {
    pageHeight = yScroll;
    }
    return new Array(pageHeight, windowWidth);
}

function search() {
	CodeMirror.commands.find(editor);
}

function replace() {
  CodeMirror.commands.replaceAll(editor);
}

function resize()
{
	var elem = $("#id_div_code").parent();
	$('.CodeMirror').width(elem.innerWidth()-4);
	$('.CodeMirror').height(elem.height(true) );
}

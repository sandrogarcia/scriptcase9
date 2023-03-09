$('.dropdown').dropdown();
$('.tabular .item').tab();
$('.checkbox').checkbox();

$('.special.cards .image').dimmer({
	on: 'hover'
});

// Modal
// (function($){
// 	$(".modal-window .content .close").click(function(){
// 		$(this).parent().parent().removeClass('show');
// 	});

// 	$("a[data-modal]").click(function(e){
// 		e.preventDefault();

// 		var modal = $(this).attr('data-modal');
// 		$(modal).addClass('show');
// 	})
// }(jQuery));

// Help popup
// (function($){
// 	var template = '<div class="help-popup"><a href="#">?</a></div>';
// 	$(".app").append(template);
// }(jQuery));

// Card check
// (function($){
// 	$(".card-check .card").append('<i class="fa fa-check-circle" aria-hidden="true"></i>').each(function(){
// 		$(this).click(function(){
// 			$(this).toggleClass('active');
// 		})
// 	});
// }(jQuery));

// Tabs
// (function($){
// 	$(".tabs > .tab-controller .item a").click(function(e){
// 		e.preventDefault();

// 		var target = $(this).attr('data-target');

// 		$(this).parent().parent().parent().find('.tab-content').removeClass('active');
// 		$(this).parent().parent().find('.item').removeClass('active');

// 		$(this).parent().addClass('active');
// 		$("#" + target).addClass('active');
// 	})
// }(jQuery));

// Button toggle
// (function($){
// 	$(".button-toggle .button").click(function(e){
// 		e.preventDefault();

// 		$(this).parent().find('.button').removeClass('active');
// 		$(this).addClass('active');
// 	})
// }(jQuery));

// Menus
// (function($){
// 	$(".menu .item a, .pills .item a, .wizard .item a").click(function(e){
// 		e.preventDefault();

// 		$(this).parent().parent().find('.item').removeClass('active');
// 		$(this).parent().addClass('active');
// 	})
// }(jQuery));


// Show on hover
// (function($){
// 	$(".showElementOnHover").each(function(){
// 		var itemToHide = $(this).attr('data-itemtoshow');
// 		$(this).find(itemToHide).css({'visibility':'hidden'});
// 	});
// }(jQuery));


// Multiselect
/*
(function($){
	$(".multiselect").append('<ul class="a"></ul><ul class="b"></ul>');
	
	$(".multiselect ul").wrap("<div></div>");

	$(".multiselect > select.a option").each(function(){
		$(this).each(function() {
			$(".multiselect ul.a").append('<li id=""> ' + $(this).html() + '</li>');
		});
	})

	$(".multiselect > select.b option").each(function(){
		$(this).each(function() {
			$(".multiselect ul.b").append('<li id=""> ' + $(this).html() + '</li>');
		});
	})

	$(".multiselect > select.a, .multiselect > select.b").remove();

	$(".multiselect ul.a li").append('<button class="button">+</button>');
	$(".multiselect ul.b li").append('<button class="button">-</button>');

	$(".multiselect ul.a li .button").click(function(){
		$(this).parent().appendTo(".multiselect ul.b");
	});

	$(".multiselect ul.b li .button").click(function(){
		$(this).parent().appendTo(".multiselect ul.a");
	});

	$(".multiselect > div").each(function(){
		$(this).prepend('<input type="search" class="multiselect-search" placeholder="Pesquisar...">');
	});

	$(".multiselect .multiselect-search").keyup(function(){
		// Retrieve the input field text and reset the count to zero
		var filter = $(this).val(), count = 0;
		
		if(!filter){
			$(this).parent().find("li").each(function(){
				$(this).show();
				$(this).attr('style','');
				$(this).find('ul').attr('style','');
			})

			return;
		}

		var regex = new RegExp(filter, "i");
		// Loop through the comment list
		$(this).parent().find("li").each(function(){
			// $(this).removeClass('active');
			$(this).show();

			// If the list item does not contain the text phrase fade it out
			if ($(this).text().search(regex) < 0) {
				$(this).hide();

			// Show the list item if the phrase matches and increase the count by 1
			} else {
				$(this).find('ul').show();
				count++;
			}
		});
	})
	
	$(".multiselect ul.a").sortable({connectWith: [".multiselect ul.b"]});
	$(".multiselect ul.b").sortable({connectWith: [".multiselect ul.a"]});
}(jQuery));
*/










/*
$(".themes-list").prepend('<div class="theme-wrap border-2 borderStyle-dashed borderColor-smoke borderRadius-s bg-snow padding-m marginBottom-m fontSize-m color-silver"></div>');
$(".theme-wrap").append('<h2 class="fontSize-m color-silver">Temas selecionados</h2>');
$(".theme-wrap").hide();

$(".themes-list .item").click(function(){
	$(".theme-wrap").show();
	$(this).appendTo(".theme-wrap");
	$(this).addClass('marginRight-m');
});
*/




















// var i = 0;
// $(".multiselect select").parent().append('<nav class="menu multiselect-list"></nav>');
// $('.multiselect select option').each(function(){
// 	i++;
// 	$('.multiselect-list').append('<li id="item-'+i+'" class="item" value="' + $(this).val() + '">'+$(this).text()+'</li>');
// });
// $('.multiselect-list').wrapInner('<ul></ul>');
// $('.multiselect-list li').wrapInner('<a href="#"></a>');
// $('.multiselect-list li').append('<button class="button"></button>');
// $('.multiselect-list li button').append('<i class="fa fa-plus-circle" aria-hidden="true"></i>');
// $(".multiselect select").remove();

// $(".multiselect-list li button").click(function(e){
// 	e.preventDefault();
// 	$(this).parent();
// });
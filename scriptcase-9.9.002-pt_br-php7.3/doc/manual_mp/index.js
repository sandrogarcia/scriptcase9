$(document).ready(function () {
  var window_url = window.location;
  var arr_url = window_url.toString().split("/");
  var x = 0;
  var url_arr = new Array();
  for (i = 0; i < arr_url.length; i++) {
    if (arr_url[i] == "manual") {
      x = i;
    }
  }
  for (i = 0; i < x; i++) {
    if (i == 1) {
    } else {
      url_arr[i] = arr_url[i];
    }
  }
  var url_final = url_arr.join("/");

  var options = {
    shouldSort: true,
    threshold: 0.3,
    location: 0,
    distance: 100,
    maxPatternLength: 32,
    minMatchCharLength: 3,
    keys: ["titulo"],
  };
  $(".search-clear").click(function () {
    $(".search-field > input")
      .val("")
      .removeClass("will-clear")
      .focus()
      .keyup();
  });
  var fuse = "";
  fuse = new Fuse(search_content, options);
  $("#search-button").click(function (e) {
    e.preventDefault();
    $(".nav-search").toggleClass("active");
    $(".nav-search input").focus();
  });
  $(".nav-search input").keyup(function () {
    keyValue = $(this).val();

    if (keyValue !== "" && keyValue.length > 2) {
      var result = fuse.search(keyValue);
      var result_html = "";

      $.each(result, function (index, value) {
        var targetsearch = $(
          '.nav a[data-search="' + value.arquivo + '"]'
        ).attr("href");
        var targetSearch2 = $(
          '.nav a[data-search="' + value.arquivo + '"]'
        ).attr("data-path");
        if(typeof(targetSearch2) != "undefined"){
          result_html =
            result_html +
            '<div class="item"> <h5><a href="' +
            targetsearch +
            '"><em>' +
            value.titulo +
            "</em></a></h5> <p>" +
            targetSearch2 +
            "</p> </div>";
        }
      });

      $(".search-results").html(result_html);

      $(".search-value")
        .show()
        .html("Pesquisando por '" + keyValue + "'");
      $(".search-results").show();

      $(".nav-search input").addClass("will-clear");
    } else {
      $(".search-results,.search-value").hide();
      $(this).removeClass();
    }
  });

  var linkActive = document.querySelector("li.active");

  var getOffsetTop = function (elem) {
    var location = 0;
    if (elem.offsetParent) {
      while (elem) {
        location += elem.offsetTop;
        elem = elem.offsetParent;
      }
    }
    return location >= 0 ? location : 0;
  };

  var linkActive = document.querySelector("li.active");

  var getOffsetTop = function (elem) {
    var location = 0;
    if (elem.offsetParent) {
      while (elem) {
        location += elem.offsetTop;
        elem = elem.offsetParent;
      }
    }
    return location >= 0 ? location : 0;
  };

  $(".nav").animate({ scrollTop: getOffsetTop(linkActive) - 50}, 100);
  //$(".nav").animate({ scrollTop: getOffsetTop(linkActive) + 102 }, 1000);

  // function zb(t){
  //   if(null!==t){
  //     var e=Ne.querySelector("#side-doc-outline > ol > li.selected");
  //     e&&e.classList.remove("selected"),t.anchor.parentElement.classList.add("selected")
  //   }
  // }

  /*var tipoTecla="";
	$('#searchField').keypress(function(event) {
	    if (event.keyCode == 13) {
	    	tipoTecla = event.keyCode;
	        event.preventDefault();
	    }
	});*/
  
  var glo_lc_relatd_index = "";
  var url_in = window.location.href;
  $(".col-xl-6 > .item > a").each(function (lc_relatd_index) {
    var has_conn = $(this).attr("href").indexOf("05-scriptcase-connections");
    var has_conn_db = $(this).attr("href").indexOf("01-general-view-db");
    var has_conn_win = $(this).attr("href").indexOf("windows");
    var has_conn_lin = $(this).attr("href").indexOf("linux");
    var has_conn_mac = $(this).attr("href").indexOf("mac");
    var has_app_view = $(this)
      .attr("href")
      .indexOf("06-applications/01-general-view/");
    if (
      has_conn !== -1 &&
      has_conn_db === -1 &&
      has_conn_mac === -1 &&
      has_conn_lin === -1 &&
      has_conn_win === -1
    ) {
      $(this).attr("href", $(this).attr("href") + "/01-general-view");
    }
    if (lc_relatd_index > 3) {
      $(this).css("display", "none");
    }
    glo_lc_relatd_index = lc_relatd_index;
  });
  $("#seeMore").css("display", "block");
  $("#seeMore").click(function (e) {
    e.preventDefault();
    $(".col-xl-6 > .item > a").each(function () {
      $(this).css("display", "block");
    });
    $("#seeMore").css("display", "none");
  });
  if (glo_lc_relatd_index < 4) {
    $("#seeMore").css("display", "none");
  }
  function getUrlVars() {
    var vars = [],
      hash;
    var hashes = window.location.href
      .slice(window.location.href.indexOf("?") + 1)
      .split("&");
    for (var i = 0; i < hashes.length; i++) {
      hash = hashes[i].split("=");
      vars.push(hash[0]);
      vars[hash[0]] = hash[1];
    }
    return vars;
  }
  /*var menu ="";
	$('#searchField').focus();
	$('#searchField').keypress(function(e) {
    	if($(this).val().length === 0){
    		if (e.keyCode == '13') {
		        e.preventDefault();
		        return false;
	    	}else{
				menu = window.location;
			}
    	}
	});
	if(typeof getUrlVars()['search'] != 'undefined'){
		$(document).mark(decodeURI(getUrlVars()['search']));
	}
	$('#searchField').keyup(function(e){
		var jslinks = "";
		var window_url = window.location;
		var arr_url = window_url.toString().split('/');
		var x = 0;
		var y =0;
		var url_arr = new Array();
		for(i=0;i<arr_url.length;i++){

			if(arr_url[i]=='manual'){
				x=i;
			}
		}
		for(i=0;i<x;i++){
			if(i==1){
			}else{
				url_arr[i] = arr_url[i];
			}
		}
		var url_final = url_arr.join('/');
		var dados = {
			texto : $(this).val()
		}
		if($(this).val().length === 0){
			if(tipoTecla!=13){
				window.location=menu;
			}
		}else {
			$.ajax({
					type: "POST",
					url: url_final+"/components/scripts/request.php",
					data: dados,
					dataType: "json"
				})
				.done(function(data){
					if(data['error'][0] == '0' && data['error'][1] == '0' ){
						jslinks = data['main_menu'][0];
						$(".nav > ul").empty();
						$(".nav > ul").append(jslinks);
						$(".sidebar ul li a:not(.link)").click(function(e){
							e.preventDefault();
							$(this).parent().toggleClass('open');
						})
						$(".nav > ul > li > ul > li").each(function(){
							var href_anterior = $(this).find('a').attr('href');
							href_anterior = href_anterior.split('/');
							href_anterior = href_anterior.reverse();
							for(i=0;i<href_anterior.length;i++){
								if(href_anterior[i]=='manual'){
									x=i;
									break;
								}
							}
							var href_anterior_arr = new Array();
							for(i=0;i<=x;i++){
								href_anterior_arr[i] = href_anterior[i];
							}
							href_anterior = href_anterior_arr.reverse().join("/");
							$(this).find('a').attr('href',(url_final +'/'+ href_anterior) );
						})
						$(".nav > ul > li > ul > li").click(function(e){

							var url = $(this).find('a').attr('href');
							var content = $('#searchField').val();
							e.preventDefault();
							window.location=url+'?'+'search='+encodeURI(content);
						})
					}else{
						if(typeof data['error'][0] !== 'undefined' || data['error'][0] != null){
							$(".nav > ul").empty();
							$(".nav > ul").append('<li>'+data['error'][1]+"</li>");
						}else if (typeof data['error'][1] !== 'undefined' || data['error'][1] != null){
							$(".nav > ul").empty();
							$(".nav > ul").append('<li>'+data['error'][1]+"</li>");
						}
					}
				});
		}
	});*/

  $(".sidebar ul li a:not(.link)").click(function (e) {
    //e.preventDefault();
    $(this).parent().toggleClass("open");
  });
  /*print subnav*/
  $(".article h2").each(function () {
    // $("h2").each(function(){ $(this).nextUntil('h2').addBack().wrapAll("<div class='new'></div>"); });
    htmlText = $(this).attr("id");
    $(this)
      .nextUntil("h2")
      .addBack()
      .wrapAll("<div id='" + htmlText + "' class='block'></div>");
    $(this).attr("id", "");

    $("#subnav").append(
      '<li class="nav-item"><a href="#' +
        htmlText +
        '" class="nav-link">' +
        $(this).html() +
        "</a></li>"
    );    
  });

  // $(".subnav").stick_in_parent({
  //   offset_top: 100,
  // });

  /back to top/
  var btn = $(".scrolltop");

  $(window).scroll(function () {
    if ($(window).scrollTop() > 300) {
      btn.addClass("visible");
    } else {
      btn.removeClass("visible");
    }
  });

  btn.on("click", function (e) {
    e.preventDefault();
    $("html, body").animate({ scrollTop: 0 }, "300");
  });

  $(function () {
    $('a[href*="#"]:not([href="#"])').click(function () {
      if (
        location.pathname == this.pathname &&
        location.hostname == this.hostname
      ) {
        var target = $(this.hash);
        target = target.length
          ? target
          : $("[name=" + this.hash.slice(1) + "]");
        if (target.length) {
          $("html, body").animate(
            {
              scrollTop: target.offset().top,
            },
            0
          );
          return false;
        }
      }
    });
  });

  $(".sidebar .toggler").click(function () {
    $(".sidebar").toggleClass("open");
  });

  $(".table-anchor tr > td:first-child").each(function () {
    var hash = $(this).html();
    $(this).wrapInner('<a href="#' + hash + '"></a>');
  });
});
/* abrir sidebar */
if($('#collapseOne')){
  $('#collapseOne').collapse("show");
} else 
if ($('#collapseTwo')){
  $('#collapseTwo').collapse("show");
}else 
if ($('#collapseThree')){
  $('#collapseThree').collapse("show");
}

/* excluir accordionSidebarContent */
function ajustarSidebar() {
  $("#accordionSidebarContent .card").each(function () {
      htmlText = $(this).html();
      
      $("#accordionSidebar").append(
          '<div class="card">' +
          htmlText +
          '</div>'
      );
  });
  var myobj = document.getElementById("accordionSidebarContent");
  if(myobj){
    myobj.remove();
  }
};
ajustarSidebar();
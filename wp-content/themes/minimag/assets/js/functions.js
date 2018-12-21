/*------------------------------------
	Theme Name: Minimag
---------------------------------------*/
/*
	+ Responsive Caret*
	+ Expand Panel Resize*
	+ Sticky Menu*
	
	+ Document On Ready
		- Scrolling Navigation*
		- Set Sticky Menu*
		- Responsive Caret*
		- Expand Panel*
		- Collapse Panel*
		- Instagram Carousel
		- Trending Post
		- Related Post
	
	+ Window On Scroll
		- Set Sticky Menu
		
	+ Window On Resize
		- Expand Panel Resize
		
	+ Window On Load
		- Site Loader
		- Largest Post
		
*/

(function($) {

	"use strict";
	
	/* + Responsive Caret* */
	function menu_dropdown_open(){
		var width = $(window).width();
		if($(".ownavigation .navbar-nav li.ddl-active").length ) {
			if( width > 991 ) {
				$(".ownavigation .navbar-nav > li").removeClass("ddl-active");
				$(".ownavigation .navbar-nav li .dropdown-menu").removeAttr("style");
			}
		} else {
			$(".ownavigation .navbar-nav li .dropdown-menu").removeAttr("style");
		}
	}
	
	/* + Expand Panel Resize* */
	function panel_resize(){
		var width = $(window).width();
		if( width > 991 ) {
			if($(".header_s .slidepanel").length ) {
				$(".header_s .slidepanel").removeAttr("style");
			}
		}
	}

	/* + Sticky Menu* */
	function sticky_menu() {
		var menu_scroll = $("body").offset().top;
		var scroll_top = $(window).scrollTop();
		var height = $(window).height();
		var body_height = $("body").height();
		var header_height = $(".header-fix").height();
		var a = height + header_height + header_height;
		if( body_height > a  ){	
			if ( scroll_top > menu_scroll ) {
				$(".header-fix").addClass("fixed-top animated fadeInDown");
				$("body").css("padding-top",header_height);
			} else {
				$(".header-fix").removeClass("fixed-top animated fadeInDown"); 
				$("body").css("padding-top","0");
			}
		} else {
			$(".header-fix").removeClass("fixed-top animated fadeInDown"); 
			$("body").css("padding-top","0");
		}
	}
	
	/* + Document On Ready */
	$(document).on("ready", function() {

		/* - Scrolling Navigation* */
		var width	=	$(window).width();
		var height	=	$(window).height();
		
		/* - Set Sticky Menu* */
		if( $(".header-fix").length ) {
			sticky_menu();
		}
		
		$('.navbar-nav li a[href*="#"]:not([href="#"]), .site-logo a[href*="#"]:not([href="#"])').on("click", function(e) {
	
			var $anchor = $(this);
			
			$("html, body").stop().animate({ scrollTop: $($anchor.attr("href")).offset().top - 49 }, 1500, "easeInOutExpo");
			
			e.preventDefault();
		});

		/* - Responsive Caret* */
		$(".ddl-switch").on("click", function() {
			var li = $(this).parent();
			if ( li.hasClass("ddl-active") || li.find(".ddl-active").length !== 0 || li.find(".dropdown-menu").is(":visible") ) {
				li.removeClass("ddl-active");
				li.children().find(".ddl-active").removeClass("ddl-active");
				li.children(".dropdown-menu").slideUp();
			}
			else {
				li.addClass("ddl-active");
				li.children(".dropdown-menu").slideDown();
			}
		});
		
		/* - Expand Panel* */
		$( "[id*='slideit-']" ).each(function (index) { 
			index++;
			$("[id*='slideit-"+index+"']").on("click", function() {
				$("[id*='slidepanel-"+index+"']").slideDown(1000);
				$("header").animate({ scrollTop: 0 }, 1000);
			});
		});

		/* - Collapse Panel * */
		$( "[id*='closeit-']" ).each(function (index) {
			index++;			
			$("[id*='closeit-"+index+"']").on("click", function() {
				$("[id*='slidepanel-"+index+"']").slideUp("slow");			
				$("header").animate({ scrollTop: 0 }, 1000);
			});
		});
		
		/* Switch buttons from "Log In | Register" to "Close Panel" on click * */
		$( "[id*='toggle-']" ).each(function (index) { 
			index++;
			$("[id*='toggle-"+index+"'] a").on("click", function() {
				$("[id*='toggle-"+index+"'] a").toggle();
			});
		});		
		
		panel_resize();
		
		/* - Instagram Carousel */
		if( $(".instagram-carousel").length ) {
			$(".instagram-carousel").owlCarousel({
				loop: $(".instagram-carousel li").length <= 1 ? false : true,
				margin: 0,
				nav: false,
				dots: false,
				autoplay: true,
				responsive:{
					0:{
						items: 2
					},
					480:{
						items: 3
					},
					575:{
						items: 4
					},
					768:{
						items: 5
					},
					992:{
						items: $(".instagram-carousel").attr("data-items")
					}
				}
			});
		}
		
		
		/* - Related Post */
		if( $(".related-post-block").length ) {
			$(".related-post-block").owlCarousel({
				loop: true,
				margin: 30,
				nav: false,
				dots: false,
				autoplay: false,
				responsive:{
					0:{
						items: 2
					},
					480:{
						items: 2
					},
					575:{
						items: 3
					},
					768:{
						items: 2
					},
					992:{
						items: 4
					}
				}
			});
		}
		
		/* - Select Box */
		$( "select:not(.wpcf7-form-control)" ).wrap( "<div class='select_box'></div>" );

		if( $('.social-share').length ) {

			$('.social-share a').on('click', function(e) {

				var el = $(this);
				var popup = el.attr('class').replace('-','_');
				var link = el.attr('href');
				var w = 700;
				var h = 400;

				// Set popup sizes
				switch (popup) {
					case 'share_twitter':
					h = 300;
					break;

					case 'share_google':
					w = 500;
					break;
					
					case 'share_reddit':
					popup = false;
					break;
				}

				if ( popup ) {
					e.preventDefault();
					window.open(link, popup, 'width=' + w + ', height=' + h);
				}
			});
		}
		
	});	/* - Document On Ready /- */
	
	/* + Window On Scroll */
	$(window).on("scroll",function() {
		/* - Set Sticky Menu* */
		if( $(".header-fix").length ) {
			sticky_menu();
		}
	});
	
	/* + Window On Resize */ 
	$( window ).on("resize",function() {
		var width	=	$(window).width();
		var height	=	$(window).height();
		
		sticky_menu();
		
		/* - Expand Panel Resize */
		panel_resize();
		menu_dropdown_open();

	});
	
	/* + Window On Load */
	$(window).on("load",function() {
		/* - Site Loader* */
		if ( !$("html").is(".ie6, .ie7, .ie8") ) {
			$("#site-loader").delay(1000).fadeOut("slow");
		}
		else {
			$("#site-loader").css("display","none");
		}
		
		/* - Slider Loader  */
		if ( $(".image-loader").length ) {
			$(".image-loader").delay(1000).fadeOut("slow");
		}
		else {
			$(".image-loader").css("display","none");
		}
	});

})(jQuery);
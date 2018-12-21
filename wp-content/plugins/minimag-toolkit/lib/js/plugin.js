(function($) {

	"use strict";
	
	/* + Blog Masonry */
	function blog_masonry() {
		if($(".blog-masonry-list").length) {
			var $container = $(".blog-masonry-list");
			$container.isotope({
				layoutMode: 'masonry',
				percentPosition: true,				
				itemSelector: ".blog-masonry-box"
			});
		}
	}
	
	/* - Google Map */
	function initialize(obj) {

		var lat = $('#'+obj).attr("data-lat");
		var lng = $('#'+obj).attr("data-lng");
		var contentString = $('#'+obj).attr("data-string");
		var myLatlng = new google.maps.LatLng(lat,lng);
		var map, marker, infowindow;
		var image = $('#'+obj).attr("data-marker");
		var zoomLevel = parseInt($("#"+obj).attr("data-zoom") ,10);
		var styles = [{"featureType": "administrative.province","elementType": "all","stylers": [{"visibility": "off"}]},
					  {"featureType": "landscape","elementType": "all","stylers": [{"saturation": -100},{"lightness": 65},{"visibility": "on"}]},
					  {"featureType": "poi","elementType": "all","stylers": [{"saturation": -100},{"lightness": 51},{"visibility": "simplified"}]},
					  {"featureType": "poi.place_of_worship","elementType": "geometry.fill","stylers": [{"saturation": "6"},{"gamma": "1.29"},{"color": "#010101"}]},
					  {"featureType": "road.highway","elementType": "all","stylers": [{"saturation": -100},{"visibility": "simplified"}]},
					  {"featureType": "road.arterial","elementType": "all","stylers": [{"saturation": -100},{"lightness": 30},{"visibility": "on"}]},
					  {"featureType": "road.local","elementType": "all","stylers": [{"saturation": -100},{"lightness": 40},{"visibility": "on"}]},
					  {"featureType": "transit","elementType": "all","stylers": [{"saturation": -100},{"visibility": "simplified"}]},
					  {"featureType": "water","elementType": "geometry","stylers": [{"hue": "#ffff00"},{"lightness": -25},{"saturation": -97}]},
					  {"featureType": "water","elementType": "labels","stylers": [{"visibility": "on"},{"lightness": -25},{"saturation": -100}]}]
		var styledMap = new google.maps.StyledMapType(styles,{name: "Styled Map"});	
		var mapOptions = {
			zoom: zoomLevel,
			disableDefaultUI: true,
			center: myLatlng,
            scrollwheel: false,
			mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.ROADMAP, "map_style"]
			}
		}
		map = new google.maps.Map(document.getElementById(obj), mapOptions);	
		map.mapTypes.set('map_style', styledMap);
		map.setMapTypeId('map_style');
		infowindow = new google.maps.InfoWindow({
			content: contentString,
			maxWidth: 300
		});		
		marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			icon: image
		});
		if(contentString != '') {
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map,marker);
			});	
		}
	}
	
	/* Post Layout 1 */
	function layoutone_video_height() {
		var width = $(window).width();
		var cnt_height = $(".post-layout-one .entry-cover img").height();
		$(".post-layout-one .entry-cover iframe").css("height", cnt_height);	
	}
	
	/* Trending Section */
	function popularpost_video_height() {
		var width = $(window).width();
		var cnt_height = $(".trending-section .entry-cover img").height();
		$(".trending-section .entry-cover iframe").css("height", cnt_height);	
	}
	
	/* Post Layout 2 */
	function layouttwo_video_height() {
		var width = $(window).width();
		var cnt_height = $(".post-layout-two .entry-cover img").height();
		$(".post-layout-two .entry-cover iframe").css("height", cnt_height);	
	}
	
	/* Post 3 Column */
	function threecolumn_video_height() {
		var width = $(window).width();
		var cnt_height = $(".post-3-column .entry-cover img").height();
		$(".post-3-column .entry-cover iframe").css("height", cnt_height);	
	}
	
	/* Post 2 Column Center */
	function twocolumn_video_height() {
		var width = $(window).width();
		var cnt_height = $(".2-column-center .entry-cover img").height();
		$(".2-column-center .entry-cover iframe").css("height", cnt_height);	
	}
	
	/* Widget Trending */
	function wid_treding_video_height() {
		var width = $(window).width();
		var cnt_height = $(".widget_tranding_post .carousel-item .trnd-post-box .post-cover img").height();
		$(".widget_tranding_post .carousel-item .trnd-post-box .post-cover iframe").css("height", cnt_height);	
	}
	
	/* Single Post Center */
	function post_center_video_height() {
		var width = $(window).width();
		var cnt_height = $(".post-single-center .entry-cover img").height();
		$(".post-single-center .entry-cover iframe").css("height", cnt_height);	
	}
	
	/* Event - Document Ready */
	$(document).on("ready",function() {

		/* - Contact Map* */
		if( $( "#contact-map-canvas").length === 1 ){
			initialize( "contact-map-canvas" );
		}
		
		/* Post Layout 1 */
		if($(".post-layout-one").length){
			layoutone_video_height();
		}
		
		/* Trending Section */
		if($(".trending-section").length){
			popularpost_video_height();
		}
		
		/* Post Layout 2 */
		if($(".post-layout-two").length){
			layouttwo_video_height();
		}
		
		/* Post 3 Column */
		if($(".post-3-column").length){
			threecolumn_video_height();
		}
		
		/* Post 2 Column Center */
		if($(".2-column-center").length){
			twocolumn_video_height();
		}
		
		/* Widget Trending */
		if($(".widget_tranding_post").length){
			wid_treding_video_height();
		}
		
		/* Single Post Center */
		if($(".post-single-center").length){
			post_center_video_height();
		}
		
		/* - Slider Carousel 4 */
		if( $(".slider-carousel-4").length ) {
			$(".slider-carousel-4").owlCarousel({
				loop: true,
				margin: 4,
				nav: false,
				dots: false,
				autoplay: true,
				responsive:{
					0:{
						items: 1
					},
					477:{
						items: 2
					},
					768:{
						items: 3
					},
					992:{
						items: 4
					}
				}
			});
		}
		
		/* - Slider Carousel 5 */
		if( $(".slider-carousel-5").length ) {
			$(".slider-carousel-5").owlCarousel({
				loop: true,
				margin: 0,
				nav: true,
				dots: false,
				autoplay: true,
				responsive:{
					0:{
						items: 1
					}
				}
			});
		}
		
		/* - Slider Section 6 */
		if( $(".slider-section6").length ) {
			$(".slider-carousel-6").slick({
				centerMode: true,
				centerPadding: '250px',
				autoplay: true,
				slidesToShow: 2,
				responsive: [{
					breakpoint: 1366,
						settings: {
							arrows: false,
							centerMode: true,
							centerPadding: '200px',
							slidesToShow: 2
						}
					},{
					breakpoint: 1201,
						settings: {
							arrows: false,
							centerMode: true,
							centerPadding: '100px',
							slidesToShow: 2
						}
					},{
					breakpoint: 992,
						settings: {
							arrows: false,
							centerMode: true,
							centerPadding: '60px',
							slidesToShow: 2
						}
					},{
					breakpoint: 768,
						settings: {
							arrows: false,
							centerMode: true,
							centerPadding: '25px',
							slidesToShow: 2
						}
					},{
					breakpoint: 640,
						settings: {
							arrows: false,
							centerMode: true,
							centerPadding: '25px',
							slidesToShow: 1
						}
					},{
					breakpoint: 480,
						settings: {
						arrows: false,
						centerMode: true,
						centerPadding: '15px',
						slidesToShow: 1
					}
				}]
			});
		}
		
		/* - Slider Section 7 */
		if( $(".slider-section7").length ) {
			$(".slider-carousel-7").slick({
				centerMode: true,
				centerPadding: '373px',
				autoplay: true,
				slidesToShow: 1,
				responsive: [{
					breakpoint: 1600,
						settings: {
							arrows: false,
							centerMode: true,
							centerPadding: '200px',
							slidesToShow: 1
						}
					},{
					breakpoint: 1366,
						settings: {
							arrows: false,
							centerMode: true,
							centerPadding: '150px',
							slidesToShow: 1
						}
					},{
					breakpoint: 1201,
						settings: {
							arrows: false,
							centerMode: true,
							centerPadding: '100px',
							slidesToShow: 1
						}
					},{
					breakpoint: 992,
						settings: {
							arrows: false,
							centerMode: true,
							centerPadding: '60px',
							slidesToShow: 1
						}
					},{
					breakpoint: 768,
						settings: {
							arrows: false,
							centerMode: true,
							centerPadding: '25px',
							slidesToShow: 1
						}
					},{
					breakpoint: 640,
						settings: {
							arrows: false,
							centerMode: true,
							centerPadding: '25px',
							slidesToShow: 1
						}
					},{
					breakpoint: 480,
						settings: {
						arrows: false,
						centerMode: true,
						centerPadding: '15px',
						slidesToShow: 1
					}
				}]
			});
		}
		
		/* - Trending Post */
		if( $(".trending-carousel").length ) {
			$(".trending-carousel").owlCarousel({
				loop: true,
				margin: 30,
				nav: false,
				dots: false,
				autoplay: true,
				responsive:{
					0:{
						items: 1
					},
					400:{
						items: 2
					},
					768:{
						items: 3
					},
					992:{
						items: 4
					}
				}
			});
		}
		
	});	/* Event - Document Ready */
	
	$( window ).on("resize",function() {
		
		var width	=	$(window).width();
		var height	=	$(window).height();
		
		/* Post Layout 1 */
		if($(".post-layout-one").length){
			layoutone_video_height();
		}
		
		/* Trending Section */
		if($(".trending-section").length){
			popularpost_video_height();
		}
		
		/* Post Layout 2 */
		if($(".post-layout-two").length){
			layouttwo_video_height();
		}
		
		/* Post 3 Column */
		if($(".post-3-column").length){
			threecolumn_video_height();
		}
		
		/* Post 2 Column Center */
		if($(".2-column-center").length){
			twocolumn_video_height();
		}
		
		/* Widget Trending */
		if($(".widget_tranding_post").length){
			wid_treding_video_height();
		}
		
		/* Single Post Center */
		if($(".post-single-center").length){
			post_center_video_height();
		}
		
		blog_masonry();
		
	});
	
	$(window).on("load",function() {
		
		/* Post Layout 1 */
		if($(".post-layout-one").length){
			layoutone_video_height();
		}
		
		/* Trending Section */
		if($(".trending-section").length){
			popularpost_video_height();
		}
		
		/* Post Layout 2 */
		if($(".post-layout-two").length){
			layouttwo_video_height();
		}
		
		/* Post 3 Column */
		if($(".post-3-column").length){
			threecolumn_video_height();
		}
		
		/* Post 2 Column Center */
		if($(".2-column-center").length){
			twocolumn_video_height();
		}
		
		/* Widget Trending */
		if($(".widget_tranding_post").length){
			wid_treding_video_height();
		}
		
		/* Single Post Center */
		if($(".post-single-center").length){
			post_center_video_height();
		}
		
		blog_masonry();
		
	});
	
})(jQuery);
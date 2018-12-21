(function($) {
	
	"use strict";

	function media_upload( button_class) {
		var _custom_media = true,
		_orig_send_attachment = wp.media.editor.send.attachment;
		$('body').on('click',button_class, function() {
			var button_id ='#'+$(this).attr('id');
			var self = $(button_id);
			var send_attachment_bkp = wp.media.editor.send.attachment;
			var button = $(button_id);
			var id = button.attr('id').replace('_button', '');
			_custom_media = true;
			wp.media.editor.send.attachment = function(props, attachment){
				if ( _custom_media  ) {
				   $('.custom_media_id').val(attachment.id); 
				   $('.custom_media_url').val(attachment.url);   
				} else {
					return _orig_send_attachment.apply( button_id, [props, attachment] );
				}
			}
			wp.media.editor.open(button);
			return false;
		});
	}

	/* Event - Document Ready */
	$(document).on("ready",function() {

		$( "#redux_save" ).before(function() {
			return '<i class="fa fa-save"></i>';
 		});

		$( "#redux-defaults-section" ).before(function() {
			return '<i class="fa fa-undo"></i>';
 		});

		$( "#redux-defaults" ).before(function() {
			return '<i class="fa fa-refresh"></i>';
 		});

		$( "#redux-footer-sticky #redux_save" ).before(function() {
			return '<i class="fa fa-save"></i>';
 		});

		$( "#redux-footer-sticky #redux-defaults-section" ).before(function() {
			return '<i class="fa fa-undo"></i>';
 		});

		$( "#redux-footer-sticky #redux-defaults" ).before(function() {
			return '<i class="fa fa-refresh"></i>';
 		});	
		
		/* - Add Anchor link for button */
		$(".redux-action_bar").each(function() {
			$(this).find(".fa-save,#redux_save").wrapAll('<a class="control_button save" title="Save Changes"></a>');
			$(this).find(".fa-undo,#redux-defaults-section").wrapAll('<a class="control_button reset" title="Reset Section"></a>');
			$(this).find(".fa-refresh,#redux-defaults").wrapAll('<a class="control_button resetall" title="Reset All"></a>');
		});
		
		/* Disable : Page Editor */
		if( $('body.post-type-page #postdivrich').length && $('select#page_template').length ) {

			/* Sidebar Layout */
			if( $('select#page_template').val() != 'default' ) {
				$('body.post-type-page #postdivrich').slideUp(500);
			}

			$('select#page_template').live('change', function() {

				/* Sidebar Layout */
				if( $('select#page_template').val() != 'default' ) {
					$('body.post-type-page #postdivrich').slideUp(500);
				}
				else {
					$('body.post-type-page #postdivrich').slideDown(500);
					$(window).scrollTop($(window).scrollTop()+1);
				}

			});
		}
		
		/* Disable : Widget Area */
		if( $('body.post-type-page #postdivrich').length && $('select#page_template').length ) {

			/* Sidebar Layout */
			if( $('select#page_template').val() != 'default' ) {
				$('body.post-type-page #postdivrich').slideUp(500);
			}

			$('select#page_template').live('change', function() {

				/* Sidebar Layout */
				if( $('select#page_template').val() != 'default' ) {
					$('body.post-type-page #postdivrich').slideUp(500);
				}
				else {
					$('body.post-type-page #postdivrich').slideDown(500);
					$(window).scrollTop($(window).scrollTop()+1);
				}

			});
		}

		/* Sidebar Layout - Page */
		if( $('.cmb2-id-minimag-cf-sidebar-owlayout').length ) {

			if( $('#minimag_cf_sidebar_owlayout4:checked').length ) {
				$('.cmb2-id-minimag-cf-widget-area').slideUp(500);
			}
			$('[id*="minimag_cf_sidebar_owlayout"]').live('change', function() {

				if( $('#minimag_cf_sidebar_owlayout4:checked').length ) {
					$('.cmb2-id-minimag-cf-widget-area').slideUp(500);
				}
				else {
					$('.cmb2-id-minimag-cf-widget-area').slideDown(500);
				}
			});
		}
		
		/* Post : Formats */
		if( $('#post-formats-select').length ) {

			if( $('input[id="post-format-video"]').is(':checked') ) {
				$('#minimag_cf_metabox_post_video').slideDown(500); /* Enable Video */
				$('#minimag_cf_metabox_post_gallery').slideUp(500); /* Disable Gallery */
				$('#minimag_cf_metabox_post_audio').slideUp(500); /* Disable Audio */
			}
			else if( $('input[id="post-format-quote"]').is(':checked') ) {
				$('#minimag_cf_metabox_post_video').slideUp(500); /* Disable Video */
				$('#minimag_cf_metabox_post_gallery').slideUp(500); /* Disable Gallery */
				$('#minimag_cf_metabox_post_audio').slideUp(500); /* Disable Audio */
			}
			else if( $('input[id="post-format-gallery"]').is(':checked') ) {
				$('#minimag_cf_metabox_post_video').slideUp(500); /* Disable Video */
				$('#minimag_cf_metabox_post_gallery').slideDown(500); /* Enable Gallery */
				$('#minimag_cf_metabox_post_audio').slideUp(500); /* Disable Audio */
			}
			else if( $('input[id="post-format-audio"]').is(':checked') ) {
				$('#minimag_cf_metabox_post_video').slideUp(500); /* Disable Video */
				$('#minimag_cf_metabox_post_gallery').slideUp(500); /* Disable Gallery */
				$('#minimag_cf_metabox_post_audio').slideDown(500); /* Enable Audio */
			}
			else {
				$('#minimag_cf_metabox_post_video').slideUp(500); /* Disable Video */
				$('#minimag_cf_metabox_post_gallery').slideUp(500); /* Disable Gallery */
				$('#minimag_cf_metabox_post_audio').slideUp(500); /* Disable Audio */
			}
 
			/* On Change : Event */
			$('#post-formats-select').live('change', function() {

				var highlight_css = '"border":"2px solid green", "-webkit-transition":"all 0.3s ease 0s", "-moz-transition":"all 0.3s ease 0s", "-o-transition":"all 0.3s ease 0s", "-ms-transition":"all 0.3s ease 0s", "transition":"all 0.3s ease 0s"';
				
				if( $('input[id="post-format-video"]').is(':checked') ) {
					$('#minimag_cf_metabox_post_video').slideDown(500); /* Enable Video */
					$('#minimag_cf_metabox_post_gallery').slideUp(500); /* Disable Gallery */
					$('#minimag_cf_metabox_post_audio').slideUp(500); /* Disable Audio */

					$("#minimag_cf_metabox_post_video").css({"border":"2px solid green", "-webkit-transition":"all 0.3s ease 0s", "-moz-transition":"all 0.3s ease 0s", "-o-transition":"all 0.3s ease 0s", "-ms-transition":"all 0.3s ease 0s", "transition":"all 0.3s ease 0s"});
					$('html, body').animate({ scrollTop: $("#minimag_cf_metabox_post_video").offset().top }, 'slow' );
				}
				else if( $('input[id="post-format-audio"]').is(':checked') ) {
					$('#minimag_cf_metabox_post_video').slideUp(500); /* Disable Video */
					$('#minimag_cf_metabox_post_gallery').slideUp(500); /* Disable Gallery */
					$('#minimag_cf_metabox_post_audio').slideDown(500); /* Enable Audio */
				
					$("#minimag_cf_metabox_post_audio").css({"border":"2px solid green", "-webkit-transition":"all 0.3s ease 0s", "-moz-transition":"all 0.3s ease 0s", "-o-transition":"all 0.3s ease 0s", "-ms-transition":"all 0.3s ease 0s", "transition":"all 0.3s ease 0s"});
					$('html, body').animate({ scrollTop: $("#minimag_cf_metabox_post_audio").offset().top }, 'slow' );
				}
				else if( $('input[id="post-format-quote"]').is(':checked') ) {
					$('#minimag_cf_metabox_post_video').slideUp(500); /* Disable Video */
					$('#minimag_cf_metabox_post_gallery').slideUp(500); /* Disable Gallery */
					$('#minimag_cf_metabox_post_audio').slideUp(500); /* Disable Audio */
				}
				else if( $('input[id="post-format-gallery"]').is(':checked') ) {
					$('#minimag_cf_metabox_post_video').slideUp(500); /* Disable Video */
					$('#minimag_cf_metabox_post_gallery').slideDown(500); /* Enable Gallery */
					$('#minimag_cf_metabox_post_audio').slideUp(500); /* Disable Audio */

					$("#minimag_cf_metabox_post_gallery").css({"border":"2px solid green", "-webkit-transition":"all 0.3s ease 0s", "-moz-transition":"all 0.3s ease 0s", "-o-transition":"all 0.3s ease 0s", "-ms-transition":"all 0.3s ease 0s", "transition":"all 0.3s ease 0s"});
					$('html, body').animate({ scrollTop: $("#minimag_cf_metabox_post_gallery").offset().top }, 'slow' );
				} 
				else {
					$('#minimag_cf_metabox_post_video').slideUp(500); /* Disable Video */
					$('#minimag_cf_metabox_post_gallery').slideUp(500); /* Disable Gallery */
					$('#minimag_cf_metabox_post_audio').slideUp(500); /* Disable Audio */
				}
			});
		}

		/* Post : Video */
		if( $('#minimag_cf_post_video_source').val() == 'video_link' ) {
			$('.cmb2-id-minimag-cf-post-video-link').slideDown(500); /* Enable Video Link */
			$('.cmb2-id-minimag-cf-post-video-embed').slideUp(500); /* Disable Embed */
			$('.cmb2-id-minimag-cf-post-video-local').slideUp(500); /* Disable Video Local */
		}
		else if ( $('#minimag_cf_post_video_source').val() == 'video_embed_code' ) {
			$('.cmb2-id-minimag-cf-post-video-link').slideUp(500); /* Disable Video Link */
			$('.cmb2-id-minimag-cf-post-video-embed').slideDown(500); /* Enable Embed */
			$('.cmb2-id-minimag-cf-post-video-local').slideUp(500); /* Disable Video Local */
		}
		else if ( $('#minimag_cf_post_video_source').val() == 'video_upload_local' ) {
			$('.cmb2-id-minimag-cf-post-video-link').slideUp(500); /* Disable Video Link */
			$('.cmb2-id-minimag-cf-post-video-embed').slideUp(500); /* Disable Embed */
			$('.cmb2-id-minimag-cf-post-video-local').slideDown(500); /* Enable Video Local */
		}
		else {
			$('.cmb2-id-minimag-cf-post-video-link').slideUp(500); /* Disable Video Link */
			$('.cmb2-id-minimag-cf-post-video-embed').slideUp(500); /* Disable Embed */
			$('.cmb2-id-minimag-cf-post-video-local').slideUp(500); /* Disable Video Local */
		}

		/* On Change : Event */
		$('#minimag_cf_post_video_source').live('change', function() {

			if( $('#minimag_cf_post_video_source').val() == 'video_link' ) {
				$('.cmb2-id-minimag-cf-post-video-link').slideDown(500); /* Enable Video Link */
				$('.cmb2-id-minimag-cf-post-video-embed').slideUp(500); /* Disable Embed */
				$('.cmb2-id-minimag-cf-post-video-local').slideUp(500); /* Disable Video Local */
			}
			else if ( $('#minimag_cf_post_video_source').val() == 'video_embed_code' ) {
				$('.cmb2-id-minimag-cf-post-video-link').slideUp(500); /* Disable Video Link */
				$('.cmb2-id-minimag-cf-post-video-embed').slideDown(500); /* Enable Embed */
				$('.cmb2-id-minimag-cf-post-video-local').slideUp(500); /* Disable Video Local */
			}
			else if ( $('#minimag_cf_post_video_source').val() == 'video_upload_local' ) {
				$('.cmb2-id-minimag-cf-post-video-link').slideUp(500); /* Disable Video Link */
				$('.cmb2-id-minimag-cf-post-video-embed').slideUp(500); /* Disable Embed */
				$('.cmb2-id-minimag-cf-post-video-local').slideDown(500); /* Enable Video Local */
			}
			else {
				$('.cmb2-id-minimag-cf-post-video-link').slideUp(500);
				$('.cmb2-id-minimag-cf-post-video-embed').slideUp(500);
				$('.cmb2-id-minimag-cf-post-video-local').slideUp(500);
			}
		});

		/* Post : Audio */
		if( $('#minimag_cf_post_audio_source').val() == 'soundcloud_link' ) {
			$('.cmb2-id-minimag-cf-post-soundcloud-url').slideDown(500); /* Enable Soundcloud URL */
			$('.cmb2-id-minimag-cf-post-audio-local').slideUp(500); /* Disable Audio Local */
			$('.cmb2-id-minimag-cf-post-soundcloud-iframe').slideUp(500); /* Disable Audio iframe */
		}
		else if ( $('#minimag_cf_post_audio_source').val() == 'soundcloud_iframe' ) {
			$('.cmb2-id-minimag-cf-post-soundcloud-iframe').slideDown(500); /* Enable Audio iframe */
			$('.cmb2-id-minimag-cf-post-soundcloud-url').slideUp(500); /* Disable Soundcloud URL */
			$('.cmb2-id-minimag-cf-post-audio-local').slideUp(500); /* Disable Audio Local */
		}
		else if ( $('#minimag_cf_post_audio_source').val() == 'audio_upload_local' ) {
			$('.cmb2-id-minimag-cf-post-soundcloud-url').slideUp(500); /* Disable Soundcloud URL */
			$('.cmb2-id-minimag-cf-post-audio-local').slideDown(500); /* Enable Audio Local */
			$('.cmb2-id-minimag-cf-post-soundcloud-iframe').slideUp(500); /* Disable Audio iframe */
		}
		else {
			$('.cmb2-id-minimag-cf-post-soundcloud-url').slideUp(500); /* Enable Soundcloud URL */
			$('.cmb2-id-minimag-cf-post-audio-local').slideUp(500); /* Disable Audio Local */
			$('.cmb2-id-minimag-cf-post-soundcloud-iframe').slideUp(500); /* Disable iframe */
		}

		/* On Change : Event */
		$('#minimag_cf_post_audio_source').live('change', function() {
			if( $('#minimag_cf_post_audio_source').val() == 'soundcloud_link' ) {
				$('.cmb2-id-minimag-cf-post-soundcloud-url').slideDown(500); /* Enable Soundcloud URL */
				$('.cmb2-id-minimag-cf-post-audio-local').slideUp(500); /* Disable Audio Local */
				$('.cmb2-id-minimag-cf-post-soundcloud-iframe').slideUp(500); /* Disable Audio iframe */
			}
			else if ( $('#minimag_cf_post_audio_source').val() == 'soundcloud_iframe' ) {
				$('.cmb2-id-minimag-cf-post-soundcloud-iframe').slideDown(500); /* Enable Audio iframe */
				$('.cmb2-id-minimag-cf-post-soundcloud-url').slideUp(500); /* Disable Soundcloud URL */
				$('.cmb2-id-minimag-cf-post-audio-local').slideUp(500); /* Disable Audio Local */
			
			}
			else if ( $('#minimag_cf_post_audio_source').val() == 'audio_upload_local' ) {
				$('.cmb2-id-minimag-cf-post-soundcloud-url').slideUp(500); /* Disable Soundcloud URL */
				$('.cmb2-id-minimag-cf-post-audio-local').slideDown(500); /* Enable Audio Local */
				$('.cmb2-id-minimag-cf-post-soundcloud-iframe').slideUp(500); /* Disable Audio iframe */
			}
			else {
				$('.cmb2-id-minimag-cf-post-soundcloud-url').slideUp(500); /* Disable Soundcloud URL */
				$('.cmb2-id-minimag-cf-post-audio-local').slideUp(500); /* Disable Audio Local */
				$('.cmb2-id-minimag-cf-post-soundcloud-iframe').slideUp(500); /* Disable Audio iframe */
			}
		});
		media_upload( '.custom_media_upload');
	});

})(jQuery);
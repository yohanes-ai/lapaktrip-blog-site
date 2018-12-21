<?php
require_once( trailingslashit( get_template_directory() ) . 'include/inc.php' );
require_once( trailingslashit( get_template_directory() ) . 'admin/inc.php' );

/* ************************************************************************ */

if( !function_exists('minimag_get_the_ID') ) :

	function minimag_get_the_ID() {

		if( is_home() && get_option( 'page_for_posts' ) != "0" ) {
			$post_id = get_option( 'page_for_posts' );
		}
		elseif( class_exists( 'WooCommerce' ) && wc_get_page_id('shop') != "-1" && is_shop() ) {
			$post_id = wc_get_page_id('shop');
		}
		else {
			$post_id = get_the_ID();
		}

		return ! empty( $post_id ) ? $post_id : false;
	}
endif;

/* ************************************************************************ */

/* Redux Options */
if( !function_exists('minimag_options') ) :

	function minimag_options( $option, $arr = null ) {

		global $minimag_option;

		if( $arr ) {

			if( isset( $minimag_option[$option][$arr] ) ) {
				return $minimag_option[$option][$arr];
			}
		}
		else {
			if( isset( $minimag_option[$option] ) ) {
				return $minimag_option[$option];
			}
		}
	}

endif;

/* ************************************************************************ */

if( ! function_exists('minimag_add_allowed_tags') ) {

	function minimag_add_allowed_tags( $tags ) {
	
		$tags['h1'] = array( 'class' => array(), 'style' => array() );
		$tags['h2'] = array( 'class' => array(), 'style' => array() );
		$tags['h3'] = array( 'class' => array(), 'style' => array() );
		$tags['h4'] = array( 'class' => array(), 'style' => array() );
		$tags['h5'] = array( 'class' => array(), 'style' => array() );
		$tags['h6'] = array( 'class' => array(), 'style' => array() );
		$tags['em'] = array( 'class' => array(), 'style' => array() );
		$tags['li'] = array( 'class' => array(), 'style' => array() );
		$tags['ul'] = array( 'class' => array(), 'style' => array() );		
		$tags['ol'] = array( 'class' => array(), 'style' => array() );
		$tags['p'] = array( 'class' => array(), 'style' => array() );
		$tags['span'] = array( 'class' => array(), 'style' => array() );
		$tags['i'] = array( 'class' => array(), 'style' => array() );
		$tags['ins'] = array( 'datetime' => array() );
		$tags['img'] = array( 'class' => array(), 'src' => array(), 'alt' => array(), 'style' => array() );
		$tags['a'] = array( 'class' => array(), 'href' => array(), 'target' => array(), 'title' => array(), 'style' => array() );
	
		return $tags;
	}
	add_filter('wp_kses_allowed_html', 'minimag_add_allowed_tags');
}

/* ************************************************************************ */

/**
 * Set up the content width value based on the theme's design.
 *
 * @see minimag_content_width()
 *
 * @since Minimag 1.0
 */
if ( ! isset( $content_width ) ) { $content_width = 474; }


/**
 * Adjust content_width value for image attachment template.
 *
 * @since Minimag 1.0
 */
if( !function_exists('minimag_content_width') ) :

	function minimag_content_width() {
		if ( is_attachment() && wp_attachment_is_image() ) { $GLOBALS['content_width'] = 810; }
	}
	add_action( 'template_redirect', 'minimag_content_width' );
endif;

/* ************************************************************************ */

/**
 * Theme setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since Minimag 1.0
 */
if( !function_exists('minimag_theme_setup') ) :

	function minimag_theme_setup() {

		/* load theme languages */
		load_theme_textdomain( "minimag", get_template_directory() . '/languages' );

		/* Image Sizes */
		set_post_thumbnail_size( 770, 513, true ); /* Default Featured Image */		

		add_image_size( 'minimag_1920_400', 1920, 400, true  ); /* Single Post Layout 3 full */
		add_image_size( 'minimag_1170_250', 1170, 250, true  ); /* Single Post Layout 3 container */
		add_image_size( 'minimag_1170_605', 1170, 605, true  ); /* Post No Sidebar */
		add_image_size( 'minimag_170_113', 170, 113, true  ); /* Related Post With Sidebar */
		add_image_size( 'minimag_270_220', 270, 220, true  ); /* Related Post No Sidebar */

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'minimag_primary'   => esc_html__( 'Primary Menu', "minimag" ),
		) );

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array( 'video', 'gallery', 'audio' ) );
	}
	add_action( 'after_setup_theme', 'minimag_theme_setup' );
endif;

/* ************************************************************************ */

/* Google Font */
if( !function_exists('minimag_fonts_url') ) :

	function minimag_fonts_url() {

		$fonts_url = '';

		$montserrat = _x( 'on', 'Montserrat font: on or off', "minimag" );
		$hind = _x( 'on', 'Hind font: on or off', "minimag" );

		if ( 'off' !== $montserrat || 'off' !== $hind ) {

			$font_families = array(); 

			if ( 'off' !== $montserrat ) {
				$font_families[] = 'Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
			}
			if ( 'off' !== $hind ) {
				$font_families[] = 'Hind:300,400,500,600,700';
			}

			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);

			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
	}
endif;

/* ************************************************************************ */

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Minimag 1.0
 */
if( !function_exists('minimag_enqueue_scripts') ) :

	function minimag_enqueue_scripts() {

		// Load the html5 shiv.
		wp_enqueue_script( 'respond-min', get_template_directory_uri() . '/js/html5/respond.min.js', array( 'jquery' ) );
		wp_script_add_data( 'respond-min', 'conditional', 'lt IE 9' );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		/* Google Font */
		if( function_exists('minimag_fonts_url') ) :
			wp_enqueue_style( 'minimag-fonts', minimag_fonts_url() );
		endif;

		wp_enqueue_style( 'dashicons' );

		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr.js', array( 'jquery' ) );
		wp_enqueue_script( 'popper-min', get_template_directory_uri() . '/assets/js/popper.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', array( 'jquery' ) );
		wp_enqueue_script( 'easing', get_template_directory_uri() . '/assets/js/easing.js', array( 'jquery' ) );
		wp_enqueue_script( 'appear', get_template_directory_uri() . '/assets/js/appear.js', array( 'jquery' ) );
		wp_enqueue_script( 'isotope-pkgd-min', get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'owlcarousel', get_template_directory_uri() . '/assets/js/owl-carousel.js', array( 'jquery' ) );
		wp_enqueue_script( 'animate-number', get_template_directory_uri() . '/assets/js/animate-number.js', array( 'jquery' ) );
		wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/magnific-popup.js', array( 'jquery' ) );
		wp_enqueue_script( 'bootstrap-select', get_template_directory_uri() . '/assets/js/bootstrap-select.js', array( 'jquery' ) );
		wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/slick/slick.min.js', array( 'jquery' ) );

		wp_enqueue_style( 'loader', get_template_directory_uri() . '/assets/css/loader.css');
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css');
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css');
		wp_enqueue_style( 'elegant-icons', get_template_directory_uri() . '/assets/css/elegant-icons.css');
		wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.css');
		wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/owl-carousel.css');
		wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css');
		wp_enqueue_style( 'strockgap-icon', get_template_directory_uri() . '/assets/css/strockgap-icon.css');
		wp_enqueue_style( 'bootstrap-select', get_template_directory_uri() . '/assets/css/bootstrap-select.css');
		wp_enqueue_style( 'ionicons', get_template_directory_uri() . '/assets/css/ionicons.css');
		wp_enqueue_style( 'pe-icons', get_template_directory_uri() . '/assets/css/pe-icons.css');
		wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/slick/slick.css');
		wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/slick/slick-theme.css');

		/* RTL Style */
		if( minimag_options('opt_rtl_switch') =='1' ) {	 
			wp_enqueue_style( 'minimag-rtl', get_template_directory_uri() . '/assets/css/rtl.css');
		}

		wp_enqueue_script( 'minimag-functions', get_template_directory_uri() . '/assets/js/functions.js', array( 'jquery' ) );
		wp_enqueue_style( 'minimag-stylesheet', get_template_directory_uri() . '/style.css' );
	}
	add_action( 'wp_enqueue_scripts', 'minimag_enqueue_scripts' );
endif;

/* ************************************************************************ */

/**
 * Extend the default WordPress body classes.
 *
 * @since Minimag 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
if( !function_exists('minimag_body_classes') ) :

	function minimag_body_classes( $classes ) {

		if ( is_singular() && !is_front_page() ) {
			$classes[] = "singular";
		}

		if( is_front_page() && !is_home() ) {
			$classes[] = "front-page";
		}

		if( is_404() ) {
			$classes[] = "404-template";
		}

		return $classes;
	}
	add_filter( 'body_class', 'minimag_body_classes' );

endif;

/* ************************************************************************ */

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since Minimag 1.0
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
if( !function_exists('minimag_post_classes') ) :

	function minimag_post_classes( $classes ) {
		if ( ! is_attachment() && has_post_thumbnail() ) { $classes[] = 'has-post-thumbnail'; }
		return $classes;
	}
	add_filter( 'post_class', 'minimag_post_classes' );

endif;

/* ************************************************************************ */

if( !function_exists('minimag_remove_excerpt') )  {

	function minimag_remove_excerpt( $excerpt ) {

		$patterns = "/\[[\/]?vc_[^\]]*\]/";
		$replacements = "";

		return preg_replace($patterns, $replacements, $excerpt);
	}
}

/* ************************************************************************ */

if( !function_exists('minimag_excerpt') ) {
 
/** Function that cuts post excerpt to the number of word based on previosly set global * variable $word_count, which is defined below */
 
  function minimag_excerpt($excerpt_length = 25) {
 
		global $post;
	 
		$word_count =  "";
	 
		$word_count = isset( $word_count ) && $word_count != "" ? $word_count : $excerpt_length;
	 
		$post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags( $post->post_content ); $clean_excerpt = strpos( $post_excerpt, '[...]' ) ? strstr( $post_excerpt, '[...]', true ) : $post_excerpt;

		/** add by PR */
		if( $clean_excerpt != "" ) {

			$clean_excerpt = strip_shortcodes( minimag_remove_excerpt($clean_excerpt) );

			/** end PR mod */

			$excerpt_all = explode(' ',$clean_excerpt );
			$excerpt_words = array_slice( $excerpt_all, 0, $word_count );

			$excerpt = implode(' ', $excerpt_words );

			$trim_excerpt = trim( $excerpt );

			$cnt = count( $excerpt_all );

			$excpt = "";

			if( $trim_excerpt != "" ) {

				$excpt .= $trim_excerpt;
				
				if( $cnt > $word_count ) {
					$excpt .= ' ...';
				}
			}
			echo html_entity_decode( $excpt );
		}
	}
}
?>
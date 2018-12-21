<?php
require_once( trailingslashit( get_template_directory() ) . 'admin/tgm/tgm.php' );

if ( !function_exists('minimag_admin_enqueue') ) :

	function minimag_admin_enqueue() {

		wp_enqueue_media();

		wp_enqueue_script( 'minimag-admin-functions', get_template_directory_uri() . '/admin/js/functions.js', array( 'jquery' ) );	
		wp_enqueue_style( 'minimag-admin-css', get_template_directory_uri() . '/admin/css/style.css' );
		wp_enqueue_style( 'elegant-icons', get_template_directory_uri() . '/admin/css/eleganticons.css' );
		wp_enqueue_style( 'font-awesome.min', get_template_directory_uri() . '/admin/css/font-awesome.min.css' );
	}
	add_action( 'admin_enqueue_scripts', 'minimag_admin_enqueue' );
endif;

/**
 * Registers an editor stylesheet for the theme.
 */
function minimag_add_editor_styles() {
    add_editor_style( array( 'assets/css/editor-style.css') );
}
add_action( 'admin_init', 'minimag_add_editor_styles' );
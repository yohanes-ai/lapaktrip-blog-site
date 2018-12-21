<?php
/**
 * Plugin Name:  Minimag Toolkit
 * Plugin URI:   http://www.onistaweb.com/
 * Description:  An easy to use theme plugin to add custom features to WordPress Theme.
 * Version:      1.2
 * Author:       Onista Web
 * Author URI:   http://www.onistaweb.com/
 * Author Email: onistaweb@gmail.com
 *
 * @package    MINIMAG_Theme_Toolkit
 * @since      1.0
 * @author     Onista Web
 * @copyright  Copyright (c) 2015-2016, Onista Web
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class MINIMAG_Theme_Toolkit {

	/**
	 * PHP5 constructor method.
	 *
	 * @since  1.0
	 */
	public function __construct() {

		// Set constant path to the plugin directory.
		add_action( 'plugins_loaded', array( &$this, 'minimag_constants' ), 1 );

		// Internationalize the text strings used.
		add_action( 'plugins_loaded', array( &$this, 'minimag_i18n' ), 2 );

		// Load the plugin functions files.
		add_action( 'plugins_loaded', array( &$this, 'minimag_includes' ), 3 );

		// Loads the admin styles and scripts.
		add_action( 'admin_enqueue_scripts', array( &$this, 'minimag_admin_scripts' ) );

		// Loads the frontend styles and scripts.
		add_action( 'wp_enqueue_scripts', array( &$this, 'minimag_frontend_scripts' ) ); 
	}

	/**
	 * Defines constants used by the plugin.
	 *
	 * @since  1.0
	 */
	public function minimag_constants() {

		// Set constant path to the plugin directory.
		define( 'MINIMAG_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

		// Set the constant path to the plugin directory URI.
		define( 'MINIMAG_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

		// Set the constant path to the inc directory.
		define( 'MINIMAG_INC', MINIMAG_DIR . trailingslashit( 'includes' ) );

		// Set the constant path to the shortcodes directory.
		define( 'MINIMAG_SC', MINIMAG_DIR . trailingslashit( 'shortcodes' ) );

		// Set the constant path to the assets directory.
		define( 'MINIMAG_LIB', MINIMAG_URI . trailingslashit( 'lib' ) );
	}

	/**
	 * Loads the translation files.
	 *
	 * @since  0.1.0
	 */
	public function minimag_i18n() {
		load_plugin_textdomain( "minimag-toolkit", false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Loads the initial files needed by the plugin.
	 *
	 * @since  0.1.0
	 */
	public function minimag_includes() {

		// Load CPT, CMB, Widgets
		require_once( MINIMAG_INC . 'inc.php' );
		require_once( MINIMAG_SC . 'inc.php' );
	}

	/**
	 * Loads the admin styles and scripts.
	 *
	 * @since  0.1.0
	 */
	function minimag_admin_scripts() {
		
		// Loads the popup custom style.
		wp_enqueue_style( 'minimag-toolkit-admin', trailingslashit( MINIMAG_LIB ) . 'css/admin.css', array(), '1.0', 'all' );
		wp_enqueue_script( 'minimag-toolkit-admin' , trailingslashit( MINIMAG_LIB ) . 'js/admin.js', array( 'jquery' ), '1.0', false );
	}

	/**
	 * Loads the frontend styles and scripts.
	 *
	 * @since  0.1.0
	 */
	 
	function minimag_frontend_scripts() {

		global $post;

		if( $post && has_shortcode( $post->post_content, 'minimag_gmap' ) ) {
			
			$map_api = "";
			
			if( function_exists('minimag_options') ) {
				$map_api = minimag_options("map_api");
			}
			if( $map_api != "" ) {
				wp_enqueue_script( 'gmap-api', 'https://maps.googleapis.com/maps/api/js?key='.$map_api, array(), null, true );
			}
			else {
				wp_enqueue_script( 'gmap-api', 'https://maps.googleapis.com/maps/api/js?v=3.exp', array(), null, true );
			}
		}

		wp_enqueue_style( 'minimag-toolkit', trailingslashit( MINIMAG_LIB ) . 'css/plugin.css', array(), '1.0', 'all' );
		wp_enqueue_script( 'minimag-toolkit' , trailingslashit( MINIMAG_LIB ) . 'js/plugin.js', array( 'jquery' ), '1.0', false );
	}
}

new MINIMAG_Theme_Toolkit;
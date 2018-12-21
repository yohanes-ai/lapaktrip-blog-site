<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

if( ! function_exists("minimag_get_sidebars") ) {

	function minimag_get_sidebars() {

		global $wp_registered_sidebars;

		$sidebar_options = array();

		$dwidgetarea = array( "" => "Select an Option" );

		foreach ( $wp_registered_sidebars as $sidebar ) {
			$sidebar_options[$sidebar['id']] = $sidebar['name'];
		}
		return array_merge( $dwidgetarea, $sidebar_options );
	}
}

add_action( 'cmb2_init', 'minimag_theme_metabox' );
function minimag_theme_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'minimag_cf_';

	/* ## Page/Post Options ---------------------- */

	/* - Page Title */
	$cmb_pagetitle = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_pagetitle',
		'title'         => esc_html__( 'Page Title', "minimag-toolkit" ),
		'object_types'  => array( 'page'), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );

	$cmb_pagetitle->add_field( array(
		'name'             => 'On/Off',
		'id'               => $prefix . 'pagetitle',
		'type'             => 'select',
		'default'          => 'on',
		'options'          => array(
			'on' => esc_html__( 'On', "minimag-toolkit" ),
			'off'   => esc_html__( 'Off', "minimag-toolkit" ),
		),
	) );

	/* - Page Description */
	$cmb_page = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_page',
		'title'         => esc_html__( 'Page Options', "minimag-toolkit" ),
		'object_types'  => array( 'page', 'post'), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );

	$cmb_page->add_field( array(
		'name'             => 'Content Top/Bottom Padding',
		'desc'             => 'If your content section need to have just after header area without space, please select an option Off',
		'id'               => $prefix . 'content_padding',
		'type'             => 'select',
		'default'          => 'on',
		'options'          => array(
			'on' => esc_html__( 'On', "minimag-toolkit" ),
			'off'   => esc_html__( 'Off', "minimag-toolkit" ),
		),
	) );
	
	$cmb_page->add_field( array(
		'name'             => 'Page Layout',
		'desc'             => 'Select an option',
		'id'               => $prefix . 'page_owlayout',
		'type'             => 'radio',
		'default'          => 'none',
		'options'          => array(
			'none' =>  '<img title="Default" src="'. MINIMAG_LIB .'images/layout/default.png" />',
			'fixed' =>  '<img title="Fixed" src="'. MINIMAG_LIB .'images/layout/boxed.png" />',
			'fluid' =>  '<img title="Fluid" src="'. MINIMAG_LIB .'images/layout/full.png" />'
		),
	) );
	
	$cmb_page->add_field( array(
		'name'             => 'Sidebar Position',
		'desc'             => 'Select an option',
		'id'               => $prefix . 'sidebar_owlayout',
		'type'             => 'radio',
		'default'          => 'none',
		'options'          => array(
			'none' =>  '<img src="'. MINIMAG_LIB .'images/layout/default.png" />',
			'right_sidebar' =>  '<img src="'. MINIMAG_LIB .'images/layout/right_side.png" />',
			'left_sidebar' =>  '<img src="'. MINIMAG_LIB .'images/layout/left_side.png" />',
			'no_sidebar' =>  '<img src="'. MINIMAG_LIB .'images/layout/none.png" />',
		),
	) );
	
	$cmb_page->add_field( array(
		'name'             => 'Widget Area',
		'desc'             => 'Select an option',
		'id'               => $prefix . 'widget_area',
		'type'             => 'select',
		'options'          => minimag_get_sidebars(),
	) );
	
	$cmb_page->add_field( array(
		'name'             => 'Header Layout',
		'desc'             => 'Select an option',
		'id'               => $prefix . 'header_layout',
		'type'             => 'select',
		'options'          => array(
			'' => esc_html__( 'Default', "minimag-toolkit" ),
			'1' => esc_html__( 'Header 1 ( Default )', "minimag-toolkit" ),
			'2'   => esc_html__( 'Header 2', "minimag-toolkit" ),
			'3'   => esc_html__( 'Header 3', "minimag-toolkit" ),
			'4'   => esc_html__( 'Header 4', "minimag-toolkit" ),
			'5'   => esc_html__( 'Header 5', "minimag-toolkit" ),
		),
	) );
	
	$cmb_page->add_field( array(
		'name'             => 'Footer Layout',
		'desc'             => 'Select an option',
		'id'               => $prefix . 'footer_layout',
		'type'             => 'select',
		'options'          => array(
			'' => esc_html__( 'Default', "minimag-toolkit" ),
			'1' => esc_html__( 'Footer 1 ( Default )', "minimag-toolkit" ),
			'2'   => esc_html__( 'Footer 2', "minimag-toolkit" ),
			'3'   => esc_html__( 'Footer 3', "minimag-toolkit" ),
			'4'   => esc_html__( 'Footer 4', "minimag-toolkit" ),
		),
	) );
	
	$cmb_page->add_field( array(
		'name' => esc_html__( 'Page Top Header Logo', "minimag-toolkit" ),
		'id'   => $prefix . 'custom_logo',
		'type' => 'file',
	) );
	
	$cmb_page->add_field( array(
		'name' => esc_html__( 'Page Responsive Logo', "minimag-toolkit" ),
		'id'   => $prefix . 'res_logo',
		'type' => 'file',
	) );

	$prefix_cmb = "cmb_";

	/* ## Post Options ---------------------- */
	require_once( $prefix_cmb . "post.php");
}

/* User Metabox Options */
add_action( 'cmb2_admin_init', 'minimag_userprofile_metabox' );
function minimag_userprofile_metabox() {

	$prefix = 'minimag_user_';

	/**
	 * Metabox for the user profile screen
	 */
	$cmb_user = new_cmb2_box( array(
		'id'               => $prefix . 'edit',
		'title'            => esc_html__( 'User Profile Options', 'minimag-toolkit' ), // Doesn't output for user boxes
		'object_types'     => array( 'user' ), // Tells CMB2 to use user_meta vs post_meta
		'show_names'       => true,
		'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
	) );

	$cmb_user->add_field( array(
		'name'     => esc_html__( 'Extra Info', 'minimag-toolkit' ),
		'id'       => $prefix . 'extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );
	
	$cmb_user->add_field( array(
		'name' => esc_html__( 'Author Image :', 'minimag-toolkit' ),
		'id'   => $prefix . 'author_img',
		'type' => 'file',
	) );
	
	$cmb_user->add_field( array(
		'name' => esc_html__( 'Facebook URL :', 'minimag-toolkit' ),
		'id'   => $prefix . 'fb',
		'type' => 'text_url',
	) );
	$cmb_user->add_field( array(
		'name' => esc_html__( 'Twitter URL :', 'minimag-toolkit' ),
		'id'   => $prefix . 'tw',
		'type' => 'text_url',
	) );
	$cmb_user->add_field( array(
		'name' => esc_html__( 'GooglePlus URL :', 'minimag-toolkit' ),
		'id'   => $prefix . 'gp',
		'type' => 'text_url',
	) );
	$cmb_user->add_field( array(
		'name' => esc_html__( 'Linkedin URL :', 'minimag-toolkit' ),
		'id'   => $prefix . 'lnkd',
		'type' => 'text_url',
	) );
	$cmb_user->add_field( array(
		'name' => esc_html__( 'Youtube URL :', 'minimag-toolkit' ),
		'id'   => $prefix . 'yt',
		'type' => 'text_url',
	) );
	$cmb_user->add_field( array(
		'name' => esc_html__( 'Instagram URL :', 'minimag-toolkit' ),
		'id'   => $prefix . 'inst',
		'type' => 'text_url',
	) );
	$cmb_user->add_field( array(
		'name' => esc_html__( 'Skype User :', 'minimag-toolkit' ),
		'id'   => $prefix . 'skype',
		'type' => 'text_url',
	) );
	$cmb_user->add_field( array(
		'name' => esc_html__( 'Pinterest URL :', 'minimag-toolkit' ),
		'id'   => $prefix . 'pin',
		'type' => 'text_url',
	) );
	$cmb_user->add_field( array(
		'name' => esc_html__( 'Flickr URL :', 'minimag-toolkit' ),
		'id'   => $prefix . 'flick',
		'type' => 'text_url',
	) );
	$cmb_user->add_field( array(
		'name' => esc_html__( 'Tumblr URL :', 'minimag-toolkit' ),
		'id'   => $prefix . 'tumb',
		'type' => 'text_url',
	) );
	$cmb_user->add_field( array(
		'name' => esc_html__( 'Digg URL :', 'minimag-toolkit' ),
		'id'   => $prefix . 'digg',
		'type' => 'text_url',
	) );
	$cmb_user->add_field( array(
		'name' => esc_html__( 'Reddit URL :', 'minimag-toolkit' ),
		'id'   => $prefix . 'reddit',
		'type' => 'text_url',
	) );
}

add_action( 'cmb2_admin_init', 'minimag_taxonomy_metabox' );
function minimag_taxonomy_metabox() {

	$prefix = 'minimag_term_';

	/**
	 * Metabox to add fields to categories and tags
	 */
	$cmb_term = new_cmb2_box( array(
		'id'               => $prefix . 'edit',
		'title'            => esc_html__( 'Category Metabox', 'minimag-toolkit' ), // Doesn't output for term boxes
		'object_types'     => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta
		'taxonomies'       => array( 'category'), // Tells CMB2 which taxonomies should have these fields
		// 'new_term_section' => true, // Will display in the "Add New Category" section
	) );

	$cmb_term->add_field( array(
		'name'     => esc_html__( 'Category Image', 'minimag-toolkit' ),
		'id'       => $prefix . 'extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );

	$cmb_term->add_field( array(
		'name' => esc_html__( 'Term Image', 'minimag-toolkit' ),
		'id'   => $prefix . 'cat_image',
		'type' => 'file',
	) );
}
?>
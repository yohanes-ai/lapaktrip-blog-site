<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if ( ! class_exists( 'Redux' ) ) {
	return;
}

// This is your option name where all the Redux data is stored.
$opt_name = "minimag_option";

// This line is only for altering the demo. Can be easily removed.
$opt_name = apply_filters( 'minimag_option/opt_name', $opt_name );

/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
	// TYPICAL -> Change these values as you need/desire
	'opt_name'             => $opt_name,
	// This is where your data is stored in the database and also becomes your global variable name.
	'display_name'         => $theme->get( 'Name' ),
	// Name that appears at the top of your panel
	'display_version'      => $theme->get( 'Version' ),
	// Version that appears at the top of your panel
	'menu_type'            => 'menu',
	//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
	'allow_sub_menu'       => true,
	// Show the sections below the admin menu item or not
	'menu_title'           => esc_html__( 'Minimag Options', "minimag-toolkit" ),
	'page_title'           => esc_html__( 'Minimag Options', "minimag-toolkit" ),
	// You will need to generate a Google API key to use this feature.
	// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
	'google_api_key'       => '',
	// Set it you want google fonts to update weekly. A google_api_key value is required.
	'google_update_weekly' => false,
	// Must be defined to add google fonts to the typography module
	'async_typography'     => true,
	// Use a asynchronous font on the front end or font string
	//'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
	'admin_bar'            => true,
	// Show the panel pages on the admin bar
	'admin_bar_icon'       => 'dashicons-portfolio',
	// Choose an icon for the admin bar menu
	'admin_bar_priority'   => 50,
	// Choose an priority for the admin bar menu
	'global_variable'      => '',
	// Set a different name for your global variable other than the opt_name
	'dev_mode'             => false,
	// Show the time the page took to load, etc
	'update_notice'        => true,
	// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
	'customizer'           => true,
	// Enable basic customizer support
	//'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
	//'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

	// OPTIONAL -> Give you extra features
	'page_priority'        => null,
	// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	'page_parent'          => 'themes.php',
	// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	'page_permissions'     => 'manage_options',
	// Permissions needed to access the options panel.
	'menu_icon'            => '',
	// Specify a custom URL to an icon
	'last_tab'             => '',
	// Force your panel to always open to a specific tab (by id)
	'page_icon'            => 'icon-themes',
	// Icon displayed in the admin panel next to your menu_title
	'page_slug'            => '',
	// Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
	'save_defaults'        => true,
	// On load save the defaults to DB before user clicks save or not
	'default_show'         => false,
	// If true, shows the default value next to each field that is not the default value.
	'default_mark'         => '',
	// What to print by the field's title if the value shown is default. Suggested: *
	'show_import_export'   => true,
	// Shows the Import/Export panel when not used as a field.

	// CAREFUL -> These options are for advanced use only
	'transient_time'       => 60 * MINUTE_IN_SECONDS,
	'output'               => true,
	// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
	'output_tag'           => true,
	// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
	// 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

	// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	'database'             => '',
	// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	'use_cdn'              => true,
	// If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

	// HINTS
	'hints'                => array(
		'icon'          => 'el el-question-sign',
		'icon_position' => 'right',
		'icon_color'    => 'lightgray',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color'   => 'red',
			'shadow'  => true,
			'rounded' => false,
			'style'   => '',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'click mouseleave',
			),
		),
	)
);

Redux::setArgs( $opt_name, $args );

// If Redux is running as a plugin, this will remove the demo notice and links
add_action( 'redux/loaded', 'minimag_remove_demo' );

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'General Settings', "minimag-toolkit" ),
	'icon'         => 'fa fa-cogs',
	'id'         => 'general_settings',
	'fields'     => array(
		array(
			'id'       => 'info_siteloader',
			'type'     => 'info',
			'title'    => esc_html__( 'Loader', 'minimag-toolkit' ),
		),
		array(
			'id'       => 'opt_siteloader',
			'type'     => 'switch',
			'title'    => esc_html__( 'Display Site Loader', 'minimag-toolkit' ),
			'default'  => "0",
			'on'       => 'On',
			'off'      => 'Off',
		),
		array(
			'id'       => 'info_rtl',
			'type'     => 'info',
			'title'    => esc_html__( 'RTL Setting', 'minimag-toolkit' ),
		),
		array(
			'id'       => 'opt_rtl_switch',
			'type'     => 'switch',
			'title'    => esc_html__( 'Enable RTL Support', 'minimag-toolkit' ),
			'default'  => "0",
			'on'       => 'On',
			'off'      => 'Off',
		),
	),
));

Redux::setSection( $opt_name, array(
	'title'      => esc_html( 'Social Icons', "minimag-toolkit" ),
	'icon'         => 'fa fa-share-alt',
	'id'         => 'social_icons',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'info_social_icon',
			'type'     => 'info',
			'title'          => esc_html__( 'Social Icons', 'minimag-toolkit' ),
		),
		array(
			'id'             => 'opt_social_icons',
			'type'           => 'ow_repeater',
			'textOne'        => true,
			'image'          => false,
			'title'          => esc_html__( 'Social Icon Entries', 'minimag-toolkit' ),
			'subtitle'       => __( '<u>Here you can use css class like following :</u><br><br>- Elegant Icons ( "<b>social_facebook</b>" )<br>- Stroke Gap ( "<b>icon icon-Like</b>" )<br>- Font Awesome ( "<b>fa fa-facebook</b>" )', 'minimag-toolkit' ),
			'placeholder'    => array(
				'textOne'  => "Font Icon CSS Class",
			)
		),
	),
));

/* Google Map */
Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Google Map', "minimag-toolkit" ),
	'icon' => 'fa fa-map',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'=>'map_api',
			'type' => 'text',
			'title' => esc_html__( 'API Key', "minimag-toolkit" ),
			'desc' => wp_kses( __( '<a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">Get Api Key</a>', "minimag-toolkit" ), array( 'a' => array( 'target' => array(), 'href' => array() ) ) ),
		),
	),
) );

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Layout Settings', "minimag-toolkit" ),
	'icon'         => 'fa fa-desktop',
	'id'         => 'layout_settings',
	'fields'     => array(
		
	),
));

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Body Layout', "minimag-toolkit" ),
	'icon'         => 'fa fa-desktop',
	'id'         => 'body_layout',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'info_layout_body',
			'type'     => 'info',
			'title'    => esc_html__( 'Body Layout', 'minimag-toolkit' ),
		),
		array(
			'id'       => 'layout_body',
			'type'     => 'image_select',
			'icon'     => 'fa fa-tasks',
			'title'    => esc_html__( 'Body Layout', "minimag-toolkit" ),
			'options'  => array(
				'fixed' => array(
					'alt' => 'Boxed',
					'img' => esc_url( MINIMAG_LIB ) . 'images/layout/boxed.png'
				),
				'fluid' => array(
					'alt' => 'Full',
					'img' => esc_url( MINIMAG_LIB ) . 'images/layout/full.png'
				),
			),			
			'default'  => 'fixed'
		),
		array(
			'id'       => 'info_sidebar_layout',
			'type'     => 'info',
			'title'    => esc_html__( 'Sidebar Layout', 'minimag-toolkit' ),
		),
		array(
			'id'       => 'layout_sidebar',
			'type'     => 'image_select',
			'icon'     => 'fa fa-tasks',
			'title'    => esc_html__( 'Sidebar Settings', "minimag-toolkit" ),
			'options'  => array(
				'right_sidebar' => array(
					'alt' => 'Right Sidebar',
					'img' => esc_url( MINIMAG_LIB ) . 'images/layout/right_side.png'
				),
				'left_sidebar' => array(
					'alt' => 'Left Sidebar',
					'img' => esc_url( MINIMAG_LIB ) . 'images/layout/left_side.png'
				),
				'no_sidebar' => array(
					'alt' => 'No Sidebar',
					'img' => esc_url( MINIMAG_LIB ) . 'images/layout/none.png'
				),
			),			
			'default'  => 'right_sidebar'
		),
	),
));

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Header/Footer', "minimag-toolkit" ),
	'icon'         => 'fa fa-archive',
	'id'         => 'site_headerfooter',
	'fields'     => array(
	),
));

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Header', "minimag-toolkit" ),
	'icon'         => 'fa fa-credit-card',
	'subsection' => true,
	'id'         => 'site_header',
	'fields'     => array(
	
		array(
			'id'       => 'info_sticky',
			'type'     => 'info',
			'title'    => esc_html__( 'Sticky Menu', "minimag-toolkit" ),
		),
		array(
			'id'       => 'opt_sticky_menu',
			'type'     => 'switch',
			'title'    => esc_html__( 'Sticky Menu', "minimag-toolkit" ),
			'default'  => "1",
			'1'       => 'On',
			'2'      => 'Off',
		),
		array(
			'id'       => 'info_header',
			'type'     => 'info',
			'title'    => esc_html__( 'Header Layout', "minimag-toolkit" ),
		),
		array(
			'id'       => 'opt_headertype',
			'type'     => 'select',
			'title'    => esc_html__( 'Header Layout', "minimag-toolkit" ),
			'options'  => array(
				'1' => 'Layout 1',
				'2' => 'Layout 2',
				'3' => 'Layout 3',
				'4' => 'Layout 4',
				'5' => 'Layout 5',
			),
			'default'  => '1',
		),
		
		/* Logo */
		array(
			'id'       => 'info_sitelogo',
			'type'     => 'info',
			'notice' => true,
			'style' => 'critical',
			'icon' => 'fa fa-cube',
			'title'    => esc_html__( 'Site Logo', 'minimag-toolkit' ),
			'subtitle' => esc_html__( 'Choose Logo Type', 'minimag-toolkit' ),
		),
		array(
			'id'       => 'opt_logotype',
			'type'     => 'select',
			'title'    => esc_html__( 'Logo Type', "minimag-toolkit" ),
			'options'  => array(
				'1' => 'Site Title',
				'2' => 'Image',
				'3' => 'Custom Text',
			),
			'default'  => '2',
		),
		array(
			'id'             => 'opt_logo_size',
			'type'           => 'dimensions',
			'units'          => array( 'px' ),    // You can specify a unit value. Possible: px, em, %
			'height'         => true,
			'units_extended' => 'true',  // Allow users to select any type of unit
			'title'          => esc_html__( 'Logo ( Maximum Width ) Option', "minimag-toolkit" ),
			'required' => array( 'opt_logotype', '=', '2' ),
		),
		
		array(
			'id'=>'opt_logoimg',
			'type' => 'media',
			'title' => esc_html__('Logo Upload', "minimag-toolkit" ),
			'required' => array( 'opt_logotype', '=', '2' ),
			'default'  => array( 'url' => esc_url( MINIMAG_LIB ) . 'images/logo.png' ),
		),
		array(
			'id'=>'opt_customtxt',
			'type' => 'text',
			'title' => esc_html__('Custom Text', "minimag-toolkit" ),
			'required' => array( 'opt_logotype', '=', '3' ),
			'default'  => "Minimag"
		),
	),
));

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Footer', "minimag-toolkit" ),
	'icon'         => 'fa fa-window-maximize',
	'id'         => 'site_footer',
	'subsection' => true,
	'fields'     => array(
		
		array(
			'id'       => 'opt_footertype',
			'type'     => 'select',
			'title'    => esc_html__( 'Footer Layout', "minimag-toolkit" ),
			'options'  => array(
				'1' => 'Layout 1',
				'2' => 'Layout 2',
				'3' => 'Layout 3',
				'4' => 'Layout 4',
			),
			'default'  => '1',
		),
		
		array(
			'id'       => 'info_instagram',
			'type'     => 'info',
			'title'    => esc_html__( 'Instagram', 'minimag-toolkit' ),
		),
		
		array(
			'id'       => 'opt_instagram',
			'type'     => 'switch',
			'title'    => esc_html__( 'Instagram', 'minimag-toolkit' ),
			'default'  => "0",
			'on'       => 'On',
			'off'      => 'Off',
		),
		array(
			'id'=>'opt_insta_user',
			'type' => 'text',
			'title' => esc_html__( 'User Name', "minimag-toolkit" ),
		),
		
		array(
			'id'=>'opt_insta_image',
			'type' => 'select',
			'title' => esc_html__( 'Number Of Image Show', "minimag-toolkit" ),
			'options'  => array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
				'7' => '7',
				'8' => '8',
				'9' => '9',
				'10' => '10',
			),
			'default'  => '6',
		),
		
		array(
			'id'       => 'info_social',
			'type'     => 'info',
			'title'    => esc_html__( 'Social Icon', 'minimag-toolkit' ),
		),
		
		array(
			'id'             => 'opt_ftrsocial_icons',
			'type'           => 'ow_repeater',
			'textOne'        => true,
			'image'          => false,
			'title'          => esc_html__( 'Social Icon Entries', 'minimag-toolkit' ),
			'subtitle'       => __( '<u>Here you can use css class like following :</u><br><br>- Elegant Icons ( "<b>social_facebook</b>" )<br>- Stroke Gap ( "<b>icon icon-Like</b>" )<br>- Font Awesome ( "<b>fa fa-facebook</b>" )', 'minimag-toolkit' ),
			'placeholder'    => array(
				'textOne'  => "Font Icon CSS Class",
			)
		),
		
		array(
			'id'       => 'info_copyright',
			'type'     => 'info',
			'title'    => esc_html__( 'Copyright Text', 'minimag-toolkit' ),
		),
		
		array(
			'id'       => 'opt_footer_copyright',
			'type'     => 'editor',
			'title'    => esc_html__( 'Copyright Text', "minimag-toolkit" ),
			'subtitle' => esc_html__( 'Use any of the features of WordPress editor inside your panel!', "minimag-toolkit" ),
			'default'  => 'Copyrights &copy; [year] Minimag',
			 'args'   => array(
				'teeny'            => true,
				'textarea_rows'    => 10
			)
		),
	),
));

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Other Pages', "minimag-toolkit" ),
	'icon'         => 'el el-file',
	'id'         => 'other_pages',
	'fields'     => array(),
));

/* Blog Single Post */
Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Post Options', "minimag-toolkit" ),
	'icon'         => 'fa fa-commenting-o',
	'id'         => 'blog_post',
	'subsection' => true,
	'fields'     => array(
		
		array(
			'id'       => 'opt_post_category',
			'type'     => 'switch',
			'title'    => esc_html__( 'Categories', 'minimag-toolkit' ),
			'default'  => "1",
			'on'       => 'On',
			'off'      => 'Off',
		),
		array(
			'id'       => 'opt_post_tags',
			'type'     => 'switch',
			'title'    => esc_html__( 'Tags', 'minimag-toolkit' ),
			'default'  => "1",
			'on'       => 'On',
			'off'      => 'Off',
		),		
		array(
			'id'       => 'opt_post_author',
			'type'     => 'switch',
			'title'    => esc_html__( 'Author Details', "minimag-toolkit" ),
			'default'  => "1",
			'on'       => 'On',
			'off'      => 'Off',
		),
		array(
			'id'       => 'info_socialshare',
			'type'     => 'info',
			'title'    => esc_html__( 'Social Share', "minimag-toolkit" ),
		),
		array(
			'id'       => 'opt_post_share',
			'type'     => 'switch',
			'title'    => esc_html__( 'Enable/Disable All', "minimag-toolkit" ),
			'default'  => "1",
			'on'       => 'On',
			'off'      => 'Off',
		),
		array(
			'id'       => 'opt_fb',
			'type'     => 'checkbox',
			'title'    => esc_html__('Facebook',"minimag-toolkit"), 
			'default'  => '1'
		),
		array(
			'id'       => 'opt_tw',
			'type'     => 'checkbox',
			'title'    => esc_html__('Twitter',"minimag-toolkit"), 
			'default'  => '1'
		),
		array(
			'id'       => 'opt_pin',
			'type'     => 'checkbox',
			'title'    => esc_html__('Pinterest',"minimag-toolkit"), 
			'default'  => '1'
		),
		array(
			'id'       => 'opt_gp',
			'type'     => 'checkbox',
			'title'    => esc_html__('GooglePlus',"hoary-toolkit"), 
			'default'  => '1'
		),
		array(
			'id'       => 'opt_lin',
			'type'     => 'checkbox',
			'title'    => esc_html__('Linkedin',"minimag-toolkit"), 
			'default'  => '1'
		),
		array(
			'id'       => 'opt_digg',
			'type'     => 'checkbox',
			'title'    => esc_html__('Digg',"minimag-toolkit"), 
			'default'  => '1'
		),
		array(
			'id'       => 'opt_reddit',
			'type'     => 'checkbox',
			'title'    => esc_html__('Reddit',"minimag-toolkit"), 
			'default'  => '1'
		),
		
	),
));

/* 404 Page */
Redux::setSection( $opt_name, array(
	'title'      => esc_html__( '404 Page', "minimag-toolkit" ),
	'icon'         => 'fa fa-exclamation-triangle',
	'id'         => 'page_error',
	'subsection' => true,
	'fields'     => array(

		array(
			'id'       => 'opt_error_title',
			'type'     => 'text',
			'title'    => esc_html__( 'Title', "minimag-toolkit" ),
			'default'  => esc_html__('404',"minimag"),
		),
		array(
			'id'       => 'opt_error_subtitle',
			'type'     => 'text',
			'title'    => esc_html__( 'Sub Title', "minimag-toolkit" ),
			'default'  => esc_html__('Oops! That page can’t be found',"minimag"),
		),
		array(
			'id'       => 'opt_error_content',
			'type'     => 'editor',
			'title'    => esc_html__( 'Description Text', "minimag-toolkit" ),
			'default'  => esc_html__('Sorry, but the page you were looking for could not be found.',"minimag-toolkit"),
			 'args'   => array(
				'teeny'            => true,
				'textarea_rows'    => 10
			)
		),
	),
));

/* Admin Login */
Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Admin Login Page', "minimag-toolkit" ),
	'icon'         => 'fa fa-lock',
	'id'         => 'page_admin',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'opt_adminlogo',
			'type'     => 'media',
			'title'    => esc_html__( 'Logo Image', "minimag-toolkit" ),
		),
		array(
			'id'       => 'opt_adminbg_color',
			'type'     => 'color',
			'title'    => esc_html__( 'Background Color', "minimag-toolkit" ),
		),
		array(
			'id'       => 'opt_adminbg_img',
			'type'     => 'media',
			'title'    => esc_html__( 'Background Image', "minimag-toolkit" ),
		),
		array(
			'id'       => 'opt_admincolor',
			'type'     => 'color',
			'title'    => esc_html__( 'Text Color', "minimag-toolkit" ),
		),
	),
));

/* Typography Css */
Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Typography', "minimag-toolkit" ),
	'icon'         => 'fa fa-text-height ',
	'id'         => 'site_typography',
	'subsection' => false,
	'fields'     => array(
		array(
			'id'       => 'info_body_font',
			'type'     => 'info',
			'title'    => esc_html__( 'Body Font Settings', 'minimag-toolkit' ),
		),
		array(
			'id'          => 'opt_body_font',
			'type'        => 'typography', 
			'title'       => esc_html__('Body Style', 'minimag-toolkit'),
			'google'      => true, 
			'font-backup' => false,
			'subsets'      => false,
			'text-align'      => false,
			'line-height'      => false,
			'output'      => array('body'),
			'units'       =>'px',
			'subtitle'    => esc_html__('Body Style', 'minimag-toolkit'),
		),
		array(
			'id' => 'notice_critical11',
			'type' => 'info',
			'notice' => true,
			'style' => 'critical',
			'icon' => 'fa fa-font',
			'title' => esc_html__('H1 to H6 Styling', 'minimag-toolkit'),
			'subtitle' => esc_html__('Typography settings H1 to H6 Tags', 'minimag-toolkit'),
		),
		array(
			'id' => 'h1-font',
			'type' => 'typography',
			'title' => esc_html__('H1', 'minimag-toolkit'),
			'subtitle' => esc_html__('Specify the Heading font properties.', 'minimag-toolkit'),
			'google' => true,
			'text-align' =>false,
			'output' => 'h1',
		),
		array(
			'id' => 'h2-font',
			'type' => 'typography',
			'title' => esc_html__('H2', 'minimag-toolkit'),
			'subtitle' => esc_html__('Specify the Heading font properties.', 'minimag-toolkit'),
			'google' => true,
			'text-align' =>false,
			'output' => 'h2',
		),
		array(
			'id' => 'h3-font',
			'type' => 'typography',
			'title' => esc_html__('H3', 'minimag-toolkit'),
			'subtitle' => esc_html__('Specify the Heading font properties.', 'minimag-toolkit'),
			'google' => true,
			'text-align' =>false,
			'output' => 'h3',
		),
		array(
			'id' => 'h4-font',
			'type' => 'typography',
			'title' => esc_html__('H4', 'minimag-toolkit'),
			'subtitle' => esc_html__('Specify the Heading font properties.', 'minimag-toolkit'),
			'google' => true,
			'text-align' =>false,
			'output' => 'h4',
		),
		array(
			'id' => 'h5-font',
			'type' => 'typography',
			'title' => esc_html__('H5', 'minimag-toolkit'),
			'subtitle' => esc_html__('Specify the Heading font properties.', 'minimag-toolkit'),
			'google' => true,
			'text-align' =>false,
			'output' => 'h5',
		),
		array(
			'id' => 'h6-font',
			'type' => 'typography',
			'title' => esc_html__('H6', 'minimag-toolkit'),
			'subtitle' => esc_html__('Specify the Heading font properties.', 'minimag-toolkit'),
			'google' => true,
			'text-align' =>false,
			'output' => 'h6',
		),
	),
));

/**
 * Removes the demo link and the notice of integrated demo from the redux-framework plugin
 */
if ( ! function_exists( 'minimag_remove_demo' ) ) {
	function minimag_remove_demo() {
		// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
		if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
			remove_filter( 'plugin_row_meta', array(
				ReduxFrameworkPlugin::instance(),
				'plugin_metalinks'
			), null, 2 );

			// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
			remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
		}
	}
}
?>
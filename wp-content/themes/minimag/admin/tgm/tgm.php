<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Minimag
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

require_once( trailingslashit( get_template_directory() ) . 'admin/tgm/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'minimag_register_required_plugins' );
function minimag_register_required_plugins() {

	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name' => esc_html__('Minimag Toolkit', "minimag"), // The plugin name.
			'slug' => 'minimag-toolkit', // The plugin slug (typically the folder name).
			'source' => get_template_directory() . '/admin/plugins/minimag-toolkit.zip', // The plugin source.
			'required' => true, // If false, the plugin is only 'recommended' instead of required.
			'version' => '1.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
			'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url' => '', // If set, overrides default API URL and points to an external URL.
		),
		array(
			'name' => esc_html__('WPBakery Visual Composer', 'minimag'), // The plugin name.
			'slug' => 'js_composer', // The plugin slug (typically the folder name).
			'source' => get_template_directory() . '/admin/plugins/js_composer.zip', // The plugin source.
			'required' => true, // If false, the plugin is only 'recommended' instead of required.
			'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),		
		array(
			'name' => esc_html__('Revolution Slider', "minimag"), // The plugin name.
			'slug' => 'revslider', // The plugin slug (typically the folder name).
			'source' => get_template_directory() . "/admin/plugins/revslider.zip", // The plugin source.
			'required' => true, // If false, the plugin is only 'recommended' instead of required.
			'version' => '5.4.7.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
			'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url' => '', // If set, overrides default API URL and points to an external URL.
		),
		array(
			'name'               => esc_html__('CMB2', 'minimag'), // The plugin name.
			'slug'               => 'cmb2', // The plugin slug (typically the folder name).
			'required'           => true,
		),
		array(
			'name'               => esc_html__('Redux Framework', 'minimag'), // The plugin name.
			'slug'               => 'redux-framework', // The plugin slug (typically the folder name).
			'required'           => true,
		),
		array(
			'name'               => esc_html__('Contact Form 7', 'minimag'), // The plugin name.
			'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
			'required'           => true,
		),
		array(
			'name'               => esc_html__('MailChimp for WordPress Lite', 'minimag'), // The plugin name.
			'slug'               => 'mailchimp-for-wp', // The plugin slug (typically the folder name).
			'required'           => true,
		),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'minimag',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
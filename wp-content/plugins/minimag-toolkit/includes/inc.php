<?php
if ( !function_exists('minimag_adminpage') ) :
	function minimag_adminpage() {

		$admin_logo = $admin_bgcolor = $admin_bgimg = $admin_color = "";

		if( minimag_options("opt_adminlogo", "url") != "" ) { $admin_logo .= ".login h1 a { background-size: 150px; width: auto; background-image: url(" . esc_attr( minimag_options("opt_adminlogo", "url") ) . "); }"; }
		if( minimag_options("opt_adminbg_color") != "" ) { $admin_bgcolor .= "body.login-action-login { background-color: " . esc_attr( minimag_options("opt_adminbg_color") ) . "; } "; }
		if( minimag_options("opt_adminbg_img", "url") != "" ) { $admin_bgimg .= "body.login-action-login { background-repeat: no-repeat; background-size: cover; background-image: url(" . esc_attr( minimag_options("opt_adminbg_img", "url") ) . "); } "; }
		if( minimag_options("opt_admincolor") != "" ) { $admin_color .= ".login #backtoblog a, .login #nav a { color: " . esc_attr( minimag_options("opt_admincolor") ) . "; }"; }

		echo '<style  type="text/css">'. $admin_logo . $admin_bgcolor . $admin_bgimg . $admin_color . '</style>';
	}  
	add_action('login_head',  'minimag_adminpage');
endif;

if( ! function_exists('minimag_404content') ) {
	function minimag_404content() {
		echo do_shortcode( wpautop( wp_kses( minimag_options("opt_error_content"), wp_kses_allowed_html() ) ) );
	}
}

if( ! function_exists('minimag_copyright') ) {
	function minimag_copyright() {
		echo do_shortcode( wpautop( wp_kses( minimag_options("opt_footer_copyright"), wp_kses_allowed_html() ) ) );
	}
}

/* Include all components. */
require_once( "functions.php" );

if ( class_exists( 'ReduxFramework' ) ) {

	require_once( "redux/extensions/wbc_importer/example-functions.php" );

	/* Loads the Redux Extension Loader */
	require_once( "redux/extension-loader.php" );
	
	/* Loads the Redux Options */
	require_once( "redux/redux-options.php" );
}

// Loads the Custom Metaboxes
require_once( "cmb/inc.php" );

// Loads the Widget
require_once( "widgets/inc.php" );
?>
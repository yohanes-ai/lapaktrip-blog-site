<?php
/**
 * The Header for our theme
 *
 *
 * @package WordPress
 * @subpackage Minimag
 * @since Minimag 1.0
 */

$rtl_onoff = "";
if( minimag_options('opt_rtl_switch') != "" ) { 
	$rtl_onoff = minimag_options('opt_rtl_switch');
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js"<?php if( $rtl_onoff != "" && $rtl_onoff == 1 ) { ?> dir="rtl"<?php } ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<?php
	if( minimag_options("opt_siteloader") == 1 ) {
		get_template_part("template-parts/siteloader");
	}
	
	$pheader_type = get_post_meta( minimag_get_the_ID(), 'minimag_cf_header_layout', true );
	$header_type = minimag_options("opt_headertype");
	
	if( $pheader_type != "" ) {
		$hdr_type = $pheader_type;
	}
	elseif( $header_type != "" ) {
		$hdr_type = $header_type;
	}
	else {
		$hdr_type = "1";
	}
	
	get_template_part("template-parts/header" . $hdr_type );
	
	?>
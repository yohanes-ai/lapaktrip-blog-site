<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Minimag
 * @since Minimag 1.0
 */
 
	$pfooter_type = get_post_meta( minimag_get_the_ID(), 'minimag_cf_footer_layout', true );
	$footer_type = minimag_options("opt_footertype");
	
	if( $pfooter_type != "" ) {
		$ftr_type = $pfooter_type;
	}
	elseif( $footer_type != "" ) {
		$ftr_type = $footer_type;
	}
	else {
		$ftr_type = "1";
	}
	
	get_template_part("template-parts/footer" . $ftr_type );
	
	wp_footer();
?>

</body>
</html>
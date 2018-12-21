<?php
function minimag_newsletter( $atts, $content = null ) {
	
	extract( shortcode_atts( array( 'sc_title' => '', 'sc_subtitle' => '' ), $atts ) );
	
	ob_start();
	
	?>
	
	<div class="container-fluid no-left-padding no-right-padding subscribe-block">
		<!-- Container -->
		<div class="container">
			<?php if($sc_title != "") { ?><h3><?php echo esc_attr($sc_title); ?></h3><?php } ?>
			<?php if($sc_subtitle != "") { ?><p><?php echo esc_attr($sc_subtitle); ?></p><?php } ?>
			<?php 
				if( function_exists( 'wpb_js_remove_wpautop') ) {
					echo wpb_js_remove_wpautop( $content, true, wp_kses_allowed_html() );
				}
			?>
		</div><!-- Container /- -->
	</div>
	
	<?php
		
	return ob_get_clean();
}

add_shortcode('minimag_newsletter', 'minimag_newsletter');

if( function_exists('vc_map') ) {

	vc_map( array(
		'base' => 'minimag_newsletter',
		'name' => esc_html__( 'News Letter', "minimag-toolkit" ),
		'class' => '',
		"category" => esc_html__("Minimag Theme", "minimag-toolkit"),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title', "minimag-toolkit" ),
				'param_name' => 'sc_title',
				"holder" => "h4",
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Sub Title', "minimag-toolkit" ),
				'param_name' => 'sc_subtitle',
				"holder" => "p",
			),
			array(
				'type' => 'textarea_html',
				'heading' => esc_html__( 'Newsletter Shortcode', "minimag-toolkit" ),
				'param_name' => 'content',
				'description' => esc_html__('Example For:: [mc4wp_form id="176"] ',"mimimag-toolkit"),
				"holder" => "p",
			),
		),
	) );
}
?>
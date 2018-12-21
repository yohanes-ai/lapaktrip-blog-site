<?php
function minimag_about( $atts, $content = null ) {
	
	extract( shortcode_atts( array( 'sc_image' => '', 'sc_title'=> '' ), $atts ) );
	
	ob_start();
	
	$thumb = "";
	
	if( get_post_meta( get_the_ID(), 'minimag_cf_sidebar_owlayout', true ) == 'no_sidebar'  ) {
		$thumb = "minimag_1170_669";
	}
	else {
		$thumb = "minimag_770_440";
	}
	?>
	<!-- Page Content -->
	<div class="container-fluid no-left-padding no-right-padding">
		<!-- container -->	
		<div class="container no-padding">
			<div class="aboute-block">
				<?php
					echo wp_get_attachment_image($sc_image,$thumb);
					
					if($sc_title != "" ) {
						?>
						<div class="block-title">
							<h3><?php echo esc_attr($sc_title); ?></h3>
						</div>
						<?php
					}
					if( function_exists( 'wpb_js_remove_wpautop') ) {
						echo wpb_js_remove_wpautop( $content, true, wp_kses_allowed_html() );
					}
				
					if ( isset( $atts['plan_feature'] ) ) {
						?>
						<ul>
							<?php
							$result = "";
							$cnt_count = 1;
							foreach( vc_param_group_parse_atts( $atts['plan_feature'] ) as $key => $value ) {

								if( !empty( $value['feature_url'] ) && !empty( $value['feature_name'] ) ) {
									
									$result .= "<li><a href='".esc_url( $value['feature_url'] )."' target='_blank'><i class='".esc_attr( $value['feature_name'] )."' aria-hidden='true'></i></a></li>";
									
								}
							$cnt_count++;
							}
							echo html_entity_decode($result);
							?>
						</ul>
						<?php
					}
				?>
			</div>
		</div>
	</div><!-- Aboute-me Section /- -->
	<?php
	return ob_get_clean();
}

add_shortcode('minimag_about', 'minimag_about');

if( function_exists('vc_map') ) {

	vc_map( array(
		'base' => 'minimag_about',
		'name' => esc_html__( 'About Us', "minimag-toolkit" ),
		'class' => '',
		"category" => esc_html__("Minimag Theme", "minimag-toolkit"),
		'params' => array(
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image', "minimag-toolkit" ),
				'param_name' => 'sc_image',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title', "minimag-toolkit" ),
				'param_name' => 'sc_title',
			),
			array(
				'type' => 'textarea_html',
				'heading' => esc_html__( 'Description', "minimag-toolkit" ),
				'param_name' => 'content',
			),
			
			// params group
			array(
				'type' => 'param_group',
				'value' => '',
				'param_name' => 'plan_feature',
				// Note params is mapped inside param-group:
				'params' => array(
					array(
						'type' => 'iconpicker',
						'value' => '',
						'heading' => 'Select Icon',
						'param_name' => 'feature_name',
					),
					array(
						'type' => 'textfield',
						'value' => '',
						'heading' => 'URL',
						'param_name' => 'feature_url',
					),
				),
			),
		),
	) );
}
?>
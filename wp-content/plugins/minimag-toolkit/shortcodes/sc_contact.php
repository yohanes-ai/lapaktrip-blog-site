<?php
function minimag_contact( $atts ) {
	
	extract( shortcode_atts( array( 'sc_image'=> '', 'sc_title' => '', 'sc_desc' => '', 'id'=> '' ), $atts ) );
	
	if( minimag_options("layout_body") != "fluid" && get_post_meta( get_the_ID(), 'minimag_cf_page_owlayout', true ) == "none") {
		$css_container = " no-padding";
	}
	elseif( get_post_meta( get_the_ID(), 'minimag_cf_page_owlayout', true ) != "fluid") {
		$css_container = " no-padding";
	}
	else {
		$css_container = "";
	}
	
	ob_start();
	
	?>
	<!-- Page Content -->
	<div class="container-fluid no-left-padding no-right-padding">
		<!-- Container -->
		<div class="container<?php echo esc_attr($css_container); ?>">
			<?php
			if($sc_image != "" || $sc_title != "" || $sc_desc != "" ) {
				?>
				<div class="contact-info">
					<?php
						echo wp_get_attachment_image($sc_image,'minimag_1170_500');
						if($sc_title != "") {
							?>
							<div class="block-title">
								<h3><?php echo esc_attr($sc_title); ?></h3>
							</div>
							<?php
						}
						echo wpautop($sc_desc);
					?>
				</div>
				<?php
			}
			if($id != "") {
				?>
				<div class="contact-form">
					<?php echo do_shortcode('[contact-form-7 id="'.esc_attr( $id ).'"]'); ?>
				</div>
				<?php
			}
			?>
		</div><!-- Container /- -->
	</div><!-- Page Content /- -->
	<?php
	return ob_get_clean();
}

add_shortcode('minimag_contact', 'minimag_contact');

if( function_exists('vc_map') ) {
	
	/**
	 * Add Shortcode To Visual Composer
	*/
	$minimag_cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

	$minimag_contactforms = array();
	
	if ( $minimag_cf7 ) {
		foreach ( $minimag_cf7 as $cform ) {
			$minimag_contactforms[ $cform->post_title ] = $cform->ID;
		}
	} 
	else {
		$minimag_contactforms[ esc_html__( 'No contact forms found', 'minimag-toolkit' ) ] = 0;
	}
	
	vc_map( array(
		'base' => 'minimag_contact',
		'name' => esc_html__( 'Contact', "minimag-toolkit" ),
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
				"holder" => "h4",
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__( 'Description', "minimag-toolkit" ),
				'param_name' => 'sc_desc',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Select Contact Form', 'minimag-toolkit' ),
				'param_name' => 'id',
				'value' => $minimag_contactforms,
				'save_always' => true,
				'description' => esc_html__( 'Choose previously created contact form from the drop down list.', 'minimag-toolkit' ),
			),
		),
	) );
}
?>
<?php
function minimag_gmap( $atts ) {
	
	extract( shortcode_atts( array( 'vc_map_lati' => '','vc_map_longi' => '', 'vc_address' => '', 'vc_marker' => '', 'vc_zoomlevel' => '' ), $atts ) );
	
	if( '' === $vc_zoomlevel ) {
		$vc_zoomlevel = 10;
	}
	
	ob_start();
	
	if( $vc_map_lati != "" && $vc_map_longi != "" ) {
		?>
		<div class="container-fluid no-left-padding no-right-padding map-section">
			<div id="contact-map-canvas" class="map-canvas" data-lat="<?php echo esc_attr($vc_map_lati); ?>" data-lng="<?php echo esc_attr($vc_map_longi); ?>" data-marker="<?php if($vc_marker != "" ){ echo esc_url(wp_get_attachment_url($vc_marker,"full")); } else { echo esc_url( MINIMAG_LIB ).'images/marker.png'; }?>" data-string="<?php echo wpautop( $vc_address ); ?>" data-zoom="<?php echo esc_attr($vc_zoomlevel); ?>"></div>
		</div>
		<?php
	}
	
	return ob_get_clean();
}

add_shortcode('minimag_gmap', 'minimag_gmap');

if( function_exists('vc_map') ) {

	vc_map( array(
		'base' => 'minimag_gmap',
		'name' => esc_html__( 'Google Map', "minimag-toolkit" ),
		'class' => '',
		"category" => esc_html__("Minimag Theme", "minimag-toolkit"),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Map Latitute', "minimag-toolkit" ),
				'param_name' => 'vc_map_lati',
				"description" => esc_html("e.g : 40.708855", "minimag-toolkit"),
				"holder" => "h4",
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Map Longitute', "minimag-toolkit" ),
				'param_name' => 'vc_map_longi',
				"description" => esc_html("e.g :  -73.999515", "minimag-toolkit"),
				"holder" => "h4",
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__( 'Address', "minimag-toolkit" ),
				'param_name' => 'vc_address',
				"description" => esc_html("e.g : New York, NY, USA", "minimag-toolkit"),
				"holder" => "h4",
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Map ZoomLevel", "minimag-toolkit"),
				"param_name" => "vc_zoomlevel",
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Marker Image', "minimag-toolkit" ),
				'param_name' => 'vc_marker',
			),
		),
	) );
}
?>
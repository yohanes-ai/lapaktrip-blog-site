<?php
function minimag_team_outer( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_title' => '' ), $atts ) );
	
	$sec_title = "";
	
	if($sc_title != ""){
		$sec_title .= "<div class='block-title'>";
		$sec_title .= "<h3>".esc_attr($sc_title)."</h3>";
		$sec_title .= "</div>";
	}
	
	$result = "
		<div class='container no-padding'>
			<!-- Team Section -->
			<div class='team-section'>";
				$result .= "$sec_title";
				$result .= "
				".do_shortcode( $content )."
			</div><!-- Team Section /- -->
		</div>";
	return $result;
}
add_shortcode( 'team_outer', 'minimag_team_outer' );

function minimag_team_inner( $atts, $content = null ) {

	extract( shortcode_atts( array( 'team_image'=> '', 'title'=> '', 'desc'=> '' ), $atts ) );
	
	$teamtitle = "";
	
	if($title != "") {
		$teamtitle .= "<h4>".esc_attr($title)."</h4>";
	}
	
	$result = "
		<div class='team-box'>
			".wp_get_attachment_image($team_image,'minimag_170_170')."
			";
			$result .= "$teamtitle";
			$result .= "
			".wpautop($desc)."
			<ul>";
				foreach( vc_param_group_parse_atts( $atts['plan_feature'] ) as $key => $value ) {

					if( !empty( $value['feature_url'] ) && !empty( $value['feature_icon'] ) ) {
					$result .= "<li><a href=".esc_url($value['feature_url'] )." target='_blank'><i class='".esc_attr($value['feature_icon'] )."'></i></a></li>";
					}
					else {
						$result .= "";
					}
				}
				$result .= "
			</ul>
		</div>";
		
	return $result;
}
add_shortcode( 'team_inner', 'minimag_team_inner' );

// Parent Element
function vc_team_outer() {

	// Register "container" content element. It will hold all your inner (child) content elements
	vc_map( array(
		"name" => esc_html__("Team", "minimag-toolkit"),
		"base" => "team_outer",
		"category" => esc_html__('Minimag Theme', 'minimag-toolkit'),
		"as_parent" => array('only' => 'team_inner'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		"content_element" => true,
		"show_settings_on_create" => true,
		"is_container" => true,
		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "textfield",
				"heading" => esc_html__("Title", "minimag-toolkit"),
				"param_name" => "sc_title",
				"holder" => "h3",
			),
		),
		"js_view" => 'VcColumnView'
	) );
}
add_action( 'vc_before_init', 'vc_team_outer' );

// Nested Element
function vc_team_inner() {

	vc_map( array(
		"name" => esc_html__("Team", "minimag-toolkit"),
		"base" => "team_inner",
		"category" => esc_html__('Minimag Theme', 'minimag-toolkit'),
		"content_element" => true,
		"as_child" => array('only' => 'team_outer'), // Use only|except attributes to limit parent (separate multiple values with comma)
		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "attach_image",
				"heading" => esc_html__("Team Image", "minimag-toolkit"),
				"param_name" => "team_image",
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Title", "minimag-toolkit"),
				"param_name" => "title",
				"holder" => "h4",
			),
			array(
				"type" => "textarea",
				"heading" => esc_html__("Description", "minimag-toolkit"),
				"param_name" => "desc",
			),
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
						'param_name' => 'feature_icon',
					),
					array(
						'type' => 'textfield',
						'value' => '',
						'heading' => 'URL',
						'param_name' => 'feature_url',
					)
				)
			),
		)
	) );
}
add_action( 'vc_before_init', 'vc_team_inner' );

// Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

    class WPBakeryShortCode_Team_Outer extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {

    class WPBakeryShortCode_Team_Inner extends WPBakeryShortCode {
    }
}
?>
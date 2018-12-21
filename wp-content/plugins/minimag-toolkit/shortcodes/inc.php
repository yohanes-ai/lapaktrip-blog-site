<?php
if( !function_exists('minimag_sc_setup') ) {

	function minimag_sc_setup() {
		add_image_size( 'minimag_345_308', 345, 308, true  ); /* Advertiser */
		
		add_image_size( 'minimag_100_80', 100, 80, true  ); /* Popular Post */
		add_image_size( 'minimag_345_230', 345, 230, true  ); /* Trending Post */
		
		add_image_size( 'minimag_1170_500', 1170, 500, true  ); /* Contact Image && Post Crousal 4 */
		add_image_size( 'minimag_1170_669', 1170, 669, true  ); /* About Us Image No Sidebar */
		add_image_size( 'minimag_770_440', 770, 440, true  ); /* About Us Image With Sidebar */
		add_image_size( 'minimag_170_170', 170, 170, true  ); /* Team */
		
		add_image_size( 'minimag_1170_605', 1170, 605, true  ); /* Post one column no sidebar */
		add_image_size( 'minimag_770_513', 770, 513, true  ); /* Post 1 column with sidebar */
		add_image_size( 'minimag_910_550', 910, 550, true  ); /* Post 1 column no sidebar center post */
		add_image_size( 'minimag_370_247', 370, 247, true  ); /* Post 3 column && 2 column with sidebar && Post masonry 2 && Post masonry 3 && Post masonry 1 */
		add_image_size( 'minimag_270_220', 270, 220, true  ); /* Popular Post */
		add_image_size( 'minimag_440_293', 440, 293, true  ); /* 2 column Post center && Post masonry 4*/
		add_image_size( 'minimag_351_247', 351, 247, true  ); /* left thumb 1 column center & */
		add_image_size( 'minimag_570_380', 570, 380, true  ); /* 2 column no sidebar */
		add_image_size( 'minimag_501_375', 501, 375, true  ); /* left thumb 1 column no sidebar */
	
		add_image_size( 'minimag_770_500', 770, 500, true  ); /* Post Crousel 2 big && Post Crousel 1 */
		add_image_size( 'minimag_395_499', 395, 499, true  ); /* Post Crousel 2 small */
		add_image_size( 'minimag_1164_500', 1164, 500, true  ); /* Post Crousel 6 */
		add_image_size( 'minimag_700_600', 700, 600, true  ); /* Post Crousel 5 */
		add_image_size( 'minimag_477_500', 477, 500, true  ); /* Post Crousel 3 */
		
		add_image_size( 'minimag_370_493', 370, 493, true  ); /* Post masonry 2 && Post masonry 3 && Post masonry 1 */
		add_image_size( 'minimag_370_370', 370, 370, true  ); /* Post masonry 2 && Post masonry 3 && Post masonry 1 */
		add_image_size( 'minimag_370_555', 370, 555, true  ); /* Post masonry 2 && Post masonry 3 && Post masonry 1  */
		
		add_image_size( 'minimag_370_399', 370, 399, true  ); /* Post masonry 3 && Post masonry 1  */
		add_image_size( 'minimag_370_494', 370, 494, true  ); /* Post masonry 3 && Post masonry 1 */
		add_image_size( 'minimag_370_241', 370, 241, true  ); /* Post masonry 3 && Post masonry 1 */

		add_image_size( 'minimag_440_660', 440, 660, true  ); /* Post masonry 4 */
		add_image_size( 'minimag_440_440', 440, 440, true  ); /* Post masonry 4 */
		add_image_size( 'minimag_440_589', 440, 589, true  ); /* Post masonry 4 */
		add_image_size( 'minimag_440_580', 440, 580, true  ); /* Post masonry 4 */
		add_image_size( 'minimag_440_294', 440, 294, true  ); /* Post masonry 4 */
		
		add_image_size( 'minimag_370_479', 370, 479, true  ); /* Post masonry 1 */
		add_image_size( 'minimag_396_248', 396, 248, true  ); /* Post masonry 1 */
		
	}
	add_action( 'after_setup_theme', 'minimag_sc_setup' );
}

function minimag_currentYear() {
    return date('Y');
}
add_shortcode( 'year', 'minimag_currentYear' );

if( function_exists('vc_map') ) {

	vc_add_param("vc_row", array(
		"type" => "dropdown",
		"group" => "Page Layout",
		"class" => "",
		"heading" => "Type",
		"param_name" => "type",
		'value' => array(
			esc_html__( 'Default', "minimag-toolkit" ) => 'default-layout',
			esc_html__( 'Fixed', "minimag-toolkit" ) => 'container',
		),
	));
	
	vc_add_param("vc_row", array(
		"type" => "dropdown",
		"group" => "Top/bottom Space",
		"class" => "",
		"heading" => "Section Top/bottom Space",
		"param_name" => "spadding",
		'value' => array(
			esc_html__( 'no', "minimag-toolkit" ) => 'spaddingbottom',
			esc_html__( 'yes', "minimag-toolkit" ) => 'spaddingtop',
		),
	));
	
	vc_add_param("vc_column", array(
		"type" => "dropdown",
		"group" => "Section Padding",
		"class" => "",
		"heading" => "Section Left Padding",
		"param_name" => "cnt_lspacing",
		'value' => array(
			esc_html__( 'Yes', "minimag-toolkit" ) => 'yes',
			esc_html__( 'No', "minimag-toolkit" ) => 'no',
		),
	));

	vc_add_param("vc_column", array(
		"type" => "dropdown",
		"group" => "Section Padding",
		"class" => "",
		"heading" => "Section Right Padding",
		"param_name" => "cnt_rspacing",
		'value' => array(
			esc_html__( 'Yes', "minimag-toolkit" ) => 'yes',
			esc_html__( 'No', "minimag-toolkit" ) => 'no',
		),
	));

	vc_add_param("vc_column", array(
		"type" => "dropdown",
		"group" => "Section Padding",
		"class" => "",
		"heading" => "Section Bottom Padding",
		"description" => "Required for Visual Composer Default Elements.",
		"param_name" => "cnt_spacing",
		'value' => array(
			esc_html__( 'Yes', "minimag-toolkit" ) => 'yes',
			esc_html__( 'No', "minimag-toolkit" ) => 'no',
		),
	));
	
	vc_add_param("vc_column", array(
		"type" => "dropdown",
		"group" => "Section Padding",
		"class" => "",
		"heading" => "Section Top Padding",
		"description" => "Required for Visual Composer Default Elements.",
		"param_name" => "cnttop_spacing",
		'value' => array(
			esc_html__( 'Yes', "minimag-toolkit" ) => 'yes',
			esc_html__( 'No', "minimag-toolkit" ) => 'no',
		),
	));

	/* Include all individual shortcodes. */
	$prefix_sc = "sc_";

	require_once( $prefix_sc . "masonry_one.php");
	require_once( $prefix_sc . "carousel_one.php");
	require_once( $prefix_sc . "poststyle_one.php");
	require_once( $prefix_sc . "poststyle_two.php");
	require_once( $prefix_sc . "popular_post.php");
	require_once( $prefix_sc . "masonry_two.php");
	require_once( $prefix_sc . "carousel_two.php");
	require_once( $prefix_sc . "masonry_three.php");
	require_once( $prefix_sc . "masonry_four.php");
	require_once( $prefix_sc . "carousel_three.php");
	require_once( $prefix_sc . "poststyle_three.php");
	require_once( $prefix_sc . "carousel_four.php");
	require_once( $prefix_sc . "poststyle_four.php");
	require_once( $prefix_sc . "carousel_five.php");
	require_once( $prefix_sc . "carousel_six.php");
	require_once( $prefix_sc . "contact.php");
	require_once( $prefix_sc . "about.php");
	require_once( $prefix_sc . "team.php");
	require_once( $prefix_sc . "gmap.php");
	require_once( $prefix_sc . "newslatter.php");
}
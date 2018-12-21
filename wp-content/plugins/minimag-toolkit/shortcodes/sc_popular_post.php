<?php
function minimag_popular_post( $atts ) {
	
	extract( shortcode_atts( array( 'sc_title' => '', 'posts_display' => '', 'stick_post'=> '' ), $atts ) );
	
	if( '' === $posts_display ) :
		$posts_display = 4;
	endif;
	
	if($stick_post == 'true') {
		$stick = "0";
	}
	else {
		$stick = "1";
	}
	
	$qry = new WP_Query( array(
		'posts_per_page'         => $posts_display,
		'meta_key'    => 'post_views_count',
		'orderby'     => 'meta_value_num',
		'ignore_sticky_posts'    => $stick,
	) );
	
	$post_cat = "";
						
	$post_cat = minimag_options('opt_post_category');
	
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
	
	if( $sc_title != "" || $qry->have_posts()  ) {
		?>
		<!-- Trending Section -->
		<div class="container-fluid no-left-padding no-right-padding trending-section">
			<!-- Container -->
			<div class="container<?php echo esc_attr($css_container); ?>">
				<?php
				if( $sc_title != "" ) {
					?>
					<!-- Section Header -->
					<div class="section-header">
						<h3><?php echo esc_attr($sc_title); ?></h3>
					</div><!-- Section Header /- -->
					<?php
				}
				
				if( $qry->have_posts() ) {
					?>
					<div class="image-loader spinner-image">
						<div class="spinner">
							<div class="dot1"></div>
							<div class="dot2"></div>
							<div class="bounce1"></div>
							<div class="bounce2"></div>
							<div class="bounce3"></div>
						</div>
					</div>
					<div class="trending-carousel">
						<?php
							while ( $qry->have_posts() ) : $qry->the_post();
								if( get_post_format() != "gallery" ) {
									?>
									<div class="type-post">
										<?php
											if( get_post_format() == "audio" && 
												( get_post_meta( get_the_ID(), 'minimag_cf_post_soundcloud_url', 1 ) != "" ||
												get_post_meta( get_the_ID(), 'minimag_cf_post_audio_local', 1 ) != "" ||
												get_post_meta( get_the_ID(), 'minimag_cf_post_soundcloud_iframe',1 ) != "" )
												
											) {
												?>
												<div class="entry-cover">
													<?php
														if( get_post_meta( get_the_ID(), 'minimag_cf_post_audio_source', 1 ) == "soundcloud_link" && get_post_meta( get_the_ID(), 'minimag_cf_post_soundcloud_url', 1 ) != "" ) {
															?>
															<iframe src="<?php echo esc_url( get_post_meta( get_the_ID(), 'minimag_cf_post_soundcloud_url', 1 ) ); ?>"></iframe>
															<?php
														}
														elseif( get_post_meta( get_the_ID(), 'minimag_cf_post_audio_source', 1 ) == "soundcloud_iframe" && get_post_meta( get_the_ID(), 'minimag_cf_post_soundcloud_iframe', 1 ) != "" ) {
															echo get_post_meta( get_the_ID(), 'minimag_cf_post_soundcloud_iframe', 1 );
														}
														elseif( get_post_meta( get_the_ID(), 'minimag_cf_post_audio_source', 1 ) == "audio_upload_local" && get_post_meta( get_the_ID(), 'minimag_cf_post_audio_local', 1 ) != "" ) {
															?>
															<audio controls>
																<source src="<?php echo esc_url( get_post_meta( get_the_ID(), 'minimag_cf_post_audio_local', 1 ) ); ?>" type="audio/mpeg">
																<?php esc_html_e("Your browser does not support the audio element.","minimag-toolkit"); ?>
															</audio>
															<?php
														}
													?>
												</div>
												<?php
											}
											if( get_post_format() == "video" ) {
												?>
												<div class="entry-cover">
													<?php
														if( get_post_meta( get_the_ID(), 'minimag_cf_post_video_source', 1 ) == "video_link" && get_post_meta( get_the_ID(), 'minimag_cf_post_video_link', 1 ) != "" ) {
															echo wp_oembed_get( esc_url( get_post_meta( get_the_ID(), 'minimag_cf_post_video_link', true ) ) );
														}
														elseif( get_post_meta( get_the_ID(), 'minimag_cf_post_video_source', 1 ) == "video_embed_code" && get_post_meta( get_the_ID(), 'minimag_cf_post_video_embed', 1 ) != "" ) {
															echo get_post_meta( get_the_ID(), 'minimag_cf_post_video_embed', 1 );
														}
														elseif( get_post_meta( get_the_ID(), 'minimag_cf_post_video_source', 1 ) == "video_upload_local" && get_post_meta( get_the_ID(), 'minimag_cf_post_video_local', 1 ) != "" ) {
															?>
															<video controls>
																<source src="<?php echo esc_url( get_post_meta( get_the_ID(), 'minimag_cf_post_video_local', 1 ) ); ?>" type="video/mp4">
																<?php esc_html_e("Your browser does not support the video tag.","minimag-toolkit"); ?>
															</video> 
															<?php			
														}
													?>
												</div>
												<?php
											}
											if( has_post_thumbnail() && ( get_post_format() != "audio" && get_post_format() != "video" ) ) {
												?>
												<div class="entry-cover">
													<a href="<?php the_permalink(); ?>">
														<?php the_post_thumbnail('minimag_270_220'); ?>
													</a>
												</div>
												<?php
											}
										?>
										<div class="entry-content">
											<div class="entry-header">
												<?php
												if($post_cat != "0") {
													?>
													<span><?php the_category( ' , ' ); ?></span>
													<?php
												}
												?>
												<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
											</div>
										</div>
									</div>
									<?php
								}
								
							// End the loop.
							endwhile;
								
							/* Reset Post Data */
							wp_reset_postdata();
						?>
					</div>
					<?php
				}
				?>
			</div><!-- Container /- -->
		</div><!-- Trending Section /- -->
		<?php
	}
	
	return ob_get_clean();
}

add_shortcode('minimag_popular_post', 'minimag_popular_post');

if( function_exists('vc_map') ) {

	vc_map( array(
		'base' => 'minimag_popular_post',
		'name' => esc_html__( 'Popular Post', "minimag-toolkit" ),
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
				'heading' => esc_html__( 'Posts Per Page Display', "minimag-toolkit" ),
				'param_name' => 'posts_display',
				"holder" => "h4",
			),
			array(
				"type" => "checkbox",
				"heading" => esc_html__("Display Stick Post", "minimag-toolkit"),
				"param_name" => "stick_post",
			),
		),
	) );
}
?>
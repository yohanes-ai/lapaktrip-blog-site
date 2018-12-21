<?php
function minimag_style_four( $atts ) {
	
	extract( shortcode_atts( array(  'posts_display' => '', 'posts_display' => '', 'post_by'=> 'random', 'select_cat'=> '', 'post_id'=> '', 'cat_ids'=> '', 'stick_post'=> '' ), $atts ) );
	
	if( '' === $posts_display ) :
		$posts_display = 9;
	endif;
	
	if($stick_post == 'true') {
		$stick = "0";
	}
	else {
		$stick = "1";
	}
	
	$seperatecat = "";
	$seperatecat = explode(",", $cat_ids);
	
	$seperatepost = "";
	$seperatepost = explode(",", $post_id);
	
	if( is_front_page() ){
		$paged =  get_query_var('page') ? get_query_var('page') : 1;
		
		if($post_by == "random") {
			query_posts( array(
				'posts_per_page'=> $posts_display,
				'ignore_sticky_posts'    => $stick,
				'paged' => $paged 
			) );
		}
		elseif($post_by == "catlist") {
			query_posts( array(
				'posts_per_page' => $posts_display,
				'ignore_sticky_posts'    => $stick,
				'paged' => $paged,
				'tax_query' => array(
					array(
						'taxonomy' => 'category',
						'field' => 'slug',
						'terms' => $select_cat,
					)
				),
			) );
		}
		elseif($post_by == "category_id") {
			query_posts( array(
				'posts_per_page' => $posts_display,
				'ignore_sticky_posts'    => $stick,
				'cat' => $seperatecat,
				'paged' => $paged,
			) );
		}
		elseif($post_by == "postid") {
			query_posts( array(
				'posts_per_page' => $posts_display,
				'ignore_sticky_posts'    => $stick,
				'post__in'=> $seperatepost,
				'paged' => $paged,
			) );
		}
		else {
			query_posts( array(
				'posts_per_page'=> $posts_display,
				'ignore_sticky_posts'    => $stick,
				'paged' => $paged 
			) );
		}
	}
	else {
		if($post_by == "catlist") {
			
			$paged = 1;
			if ( get_query_var('paged') ) {
				$paged = get_query_var('paged');
			}
			
			$args = array(
				'posts_per_page' => $posts_display,
				'ignore_sticky_posts'    => $stick,
				'paged' => $paged,
				'tax_query' => array(
					array(
						'taxonomy' => 'category',
						'field' => 'slug',
						'terms' => $select_cat,
					)
				),
			 );
			query_posts($args);
		}
		elseif($post_by == "category_id") {
			query_posts('posts_per_page='.$posts_display.'&paged='. get_query_var('paged').'&ignore_sticky_posts='.$stick.'&cat='.$cat_ids );
		}
		elseif($post_by == "postid") {
			
			$paged = 1;
			if ( get_query_var('paged') ) {
				$paged = get_query_var('paged');
			}
			
			$args = array(
				'posts_per_page' => $posts_display,
				'ignore_sticky_posts'    => $stick,
				'paged' => $paged,
				'post__in' => $seperatepost,
			 );
			 
			query_posts($args);
		}
		else {
			query_posts('posts_per_page='.$posts_display.'&paged='. get_query_var('paged'). '&ignore_sticky_posts='.$stick );
		}
	}
	
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
	
	?>
	
	<!-- Page Content -->
	<div class="container-fluid no-left-padding no-right-padding post-3-column">
		<!-- Container -->
		<div class="container<?php echo esc_attr($css_container); ?>">
			<div class="row">
				<!-- Content Area -->
				<div class="col-lg-12 col-md-12 content-area">
					<!-- Row -->
					<div class="row">
						<?php
							while ( have_posts() ) : the_post();
								?>
								<div class="col-lg-4 col-md-6 col-sm-6">
									<div <?php post_class(); ?>>
										<?php
											if( get_post_format() == "gallery" && count( get_post_meta( get_the_ID(), 'minimag_cf_post_gallery', 1 ) ) > 0 && is_array( get_post_meta( get_the_ID(), 'minimag_cf_post_gallery', 1 ) ) ) {
												?>
												<div class="entry-cover">
													<div class="post-meta">
														<span class="byline"><?php esc_html_e('by',"minimag-toolkit"); ?>
															<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a>
														</span>
														<span class="post-date">
															<a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
														</span>
													</div>
													<!-- Carousel -->
													<div id="blog-carousel-<?php echo esc_attr(the_ID()); ?>" class="carousel slide" data-ride="carousel">
														<div class="carousel-inner" role="listbox">
															<?php
															$active=1;
															foreach ( (array) get_post_meta( get_the_ID(), 'minimag_cf_post_gallery', 1 ) as $attachment_id => $attachment_url ) {
																?>
																<div class="carousel-item<?php if( $active == 1 ) { echo ' active'; } ?>">
																	<?php echo wp_get_attachment_image( $attachment_id, 'minimag_370_247' ); ?>
																</div>
																<?php
																$active++;
															} ?>
														</div>
														<a title="<?php esc_html_e('Previous',"minimag-toolkit"); ?>" class="carousel-control-prev" href="#blog-carousel-<?php echo esc_attr(the_ID()); ?>" role="button" data-slide="prev">
															<span class="fa fa-chevron-left" aria-hidden="true"></span>
														</a>
														<a title="<?php esc_html_e('Next',"minimag-toolkit"); ?>" class="carousel-control-next" href="#blog-carousel-<?php echo esc_attr(the_ID()); ?>" role="button" data-slide="next">
															<span class="fa fa-chevron-right" aria-hidden="true"></span>
														</a>
													</div><!-- /.carousel -->
												</div>
												<?php
											}
											if( get_post_format() == "audio" && 
												( get_post_meta( get_the_ID(), 'minimag_cf_post_soundcloud_url', 1 ) != "" ||
												get_post_meta( get_the_ID(), 'minimag_cf_post_audio_local', 1 ) != "" ||
												get_post_meta( get_the_ID(), 'minimag_cf_post_soundcloud_iframe',1 ) != "" )
												
											) {
												?>
												<div class="entry-cover">
													<div class="post-meta">
														<span class="byline"><?php esc_html_e('by',"minimag-toolkit"); ?>
															<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a>
														</span>
														<span class="post-date">
															<a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
														</span>
													</div>
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
													<div class="post-meta">
														<span class="byline"><?php esc_html_e('by',"minimag-toolkit"); ?>
															<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a>
														</span>
														<span class="post-date">
															<a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
														</span>
													</div>
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
											if( has_post_thumbnail() && ( get_post_format() != "audio" && get_post_format() != "video" && get_post_format() != "gallery" ) ) {
												?>
												<div class="entry-cover">
													<div class="post-meta">
														<span class="byline"><?php esc_html_e('by',"minimag-toolkit"); ?>
															<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a>
														</span>
														<span class="post-date">
															<a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
														</span>
													</div>
													<a href="<?php the_permalink(); ?>">
														<?php the_post_thumbnail('minimag_370_247'); ?>
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
													<span class="post-category">
														<?php the_category( ' , ' ); ?>
													</span>
													<?php
												}
												?>
												<h3 class="entry-title">
													<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
												</h3>
											</div>
											<p><?php minimag_excerpt(); ?></p>
											<a href="<?php the_permalink(); ?>" title="<?php esc_html_e('Read More',"minimag-toolkit"); ?>">
												<?php esc_html_e('Read More',"minimag-toolkit"); ?>
											</a>
										</div>
									</div>
								</div>
								<?php
							endwhile;
						?></div><!-- Row /- --><?php
						// Previous/next page navigation.				
						the_posts_pagination( array(
							'prev_text'          => wp_kses( __( 'Previous', "minimag-toolkit" ), array( 'i' => array( 'class' => array() ) ) ),
							'next_text'          => wp_kses( __( 'Next', "minimag-toolkit" ), array( 'i' => array( 'class' => array() ) ) ),
							'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', "minimag-toolkit" ) . ' </span>',
						) );
						
						// Restore original Post Data
						wp_reset_query();
					?>
				</div><!-- Content Area /- -->
			</div>
		</div><!-- Container /- -->
	</div><!-- Page Content /- -->
	
	<?php
		
	return ob_get_clean();
}

add_shortcode('minimag_style_four', 'minimag_style_four');

if( function_exists('vc_map') ) {
	
	$categories_array = array('select');
	
	$categories = get_categories();
	
	foreach( $categories as $category ){
	  $categories_array[] = $category->slug;
	}

	vc_map( array(
		'base' => 'minimag_style_four',
		'name' => esc_html__( 'Post 3 Column', "minimag-toolkit" ),
		'class' => '',
		"category" => esc_html__("Minimag Theme", "minimag-toolkit"),
		'params' => array(
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Post Display By...", "minimag-toolkit"),
				"param_name" => "post_by",
				'value' => array(
					esc_html__( 'Recent Posts', "minimag-toolkit" ) => 'random',
					esc_html__( 'Posts by selecetd category', "minimag-toolkit" ) => 'catlist',
					esc_html__( 'Enter Multiple Category IDs', "minimag-toolkit" ) => 'category_id',
					esc_html__( 'Enter Post IDs', "minimag-toolkit" ) => 'postid',
				),	
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Select Category", "minimag-toolkit"),
				"param_name" => "select_cat",
				"value" => $categories_array,
				"dependency" => Array('element' => "post_by", 'value' => array( 'catlist', ) ),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Multiple Category (Category IDs)", "minimag-toolkit"),
				"param_name" => "cat_ids",
				'description' => esc_html__("Note: Enter comma seperated list of ID's (example For: 22,23,24)", "minimag-toolkit"),
				"holder" => "h4",
				"dependency" => Array('element' => "post_by", 'value' => array( 'category_id', ) ),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Multiple Posts (Posts IDs)", "minimag-toolkit"),
				"param_name" => "post_id",
				'description' => esc_html__("Note: Enter Posts IDs by comma seperated list (example For: 22,23,24)", "minimag-toolkit"),
				"holder" => "h4",
				"dependency" => Array('element' => "post_by", 'value' => array( 'postid', ) ),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Posts Per Page Display", "minimag-toolkit"),
				"param_name" => "posts_display",
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
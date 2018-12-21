<?php
function minimag_carousel_two( $atts ) {
	
	extract( shortcode_atts( array( 'posts_display' => '','post_by'=> 'random', 'select_cat'=> '', 'post_id'=> '', 'cat_ids'=> '', 'stick_post'=> '' ), $atts ) );
	
	if( '' === $posts_display ) :
		$posts_display = 4;
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
	
	if($post_by == "random") {
		$qry = new WP_Query( array(
			'posts_per_page' => $posts_display,
			'ignore_sticky_posts'    => $stick,
			'meta_query' => array(
				array(
					'key' => '_thumbnail_id'
				)
			)
		) );
	}
	elseif($post_by == "catlist") {
		$qry = new WP_Query( array(
			'posts_per_page' => $posts_display,
			'ignore_sticky_posts'    => $stick,
			'tax_query' => array(
				array(
					'taxonomy' => 'category',
					'field' => 'slug',
					'terms' => $select_cat,
				)
			),
			'meta_query' => array(
				array(
					'key' => '_thumbnail_id'
				)
			)
		) );
	}
	elseif($post_by == "category_id") {
		$qry = new WP_Query( array(
			'posts_per_page' => $posts_display,
			'cat' => $seperatecat,
			'ignore_sticky_posts'    => $stick,
			'meta_query' => array(
				array(
					'key' => '_thumbnail_id'
				)
			)
		) );
	}
	elseif($post_by == "postid") {
		$qry = new WP_Query( array(
			'posts_per_page' => $posts_display,
			'post__in'=> $seperatepost,
			'ignore_sticky_posts'    => $stick,
			'meta_query' => array(
				array(
					'key' => '_thumbnail_id'
				)
			)
		) );
	}
	else {
		$qry = new WP_Query( array(
			'posts_per_page' => $posts_display,
			'ignore_sticky_posts'    => $stick,
			'meta_query' => array(
				array(
					'key' => '_thumbnail_id'
				)
			)
		) );
	}
	
	$post_cat = "";
						
	$post_cat = minimag_options('opt_post_category');
	
	ob_start();
	
	if( $qry->have_posts() ) {
		?>
		<!-- Slider Section -->
		<div class="container-fluid no-left-padding no-right-padding slider-section slider-section3">
			<!-- Container -->
			<div class="container no-padding">
				<div id="slider-carousel-3" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner" role="listbox">
						<?php
						
							$md_class = $thumb = "";
							
							$count_post = 1;
							
							while ( $qry->have_posts() ) : $qry->the_post();
								if( $count_post % 2 == 1) {
									?><div class="carousel-item<?php if($count_post == 1){ echo ' active'; } ?>">
									<div class="row">
									<?php
								}
								
								if($count_post % 2 != 0 ){	
									$md_class = "col-lg-8 col-sm-12 post-block post-big";
									$thumb = "minimag_770_500";
								}
								else {
									$md_class = "col-lg-4 col-sm-12 post-block post-thumb";
									$thumb = "minimag_395_499";
								}
								?>
									<div class="<?php echo esc_attr($md_class); ?>">
										<div class="post-box">
											<?php the_post_thumbnail($thumb); ?>
											<div class="entry-content">
												<?php
												if($post_cat != "0") {
													?>
													<span class="post-category">
														<?php the_category( ' , ' ); ?>
													</span>
													<?php
												}
												?>
												<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
												<a href="<?php the_permalink(); ?>" title="<?php esc_html_e('Read More',"minimag-toolkit"); ?>">
													<?php esc_html_e('Read More',"minimag-toolkit"); ?>
												</a>
											</div>
										</div>
									</div>
									<?php
									
									if( $count_post == 3 ){
										$count_post = 1;
									}
							
									if( $count_post  % 2 == 0) {
										?></div></div><?php
									}
									
									//echo $count_post;
							
							$count_post++;
							// End the loop.
							endwhile;
									
							/* Reset Post Data */
							wp_reset_postdata();
						?>
					</div>
				  <a class="carousel-control-prev" href="#slider-carousel-3" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				  </a>
				  <a class="carousel-control-next" href="#slider-carousel-3" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
				  </a>
				</div>
			</div><!-- Container /- -->
		</div><!-- Slider Section /- -->
		<?php
	}
	
	return ob_get_clean();
}

add_shortcode('minimag_carousel_two', 'minimag_carousel_two');

if( function_exists('vc_map') ) {
	
	$categories_array = array('select');
	
	$categories = get_categories();
	
	foreach( $categories as $category ){
	  $categories_array[] = $category->slug;
	}
	
	vc_map( array(
		'base' => 'minimag_carousel_two',
		'name' => esc_html__( 'Post Carousel 2', "minimag-toolkit" ),
		'class' => '',
		"category" => esc_html__("Minimag Theme", "minimag-toolkit"),
		'params' => array(
			array(
				"type" => "dropdown",
				"heading" => esc_html__("Post Display By...", "minimag-toolkit"),
				"param_name" => "post_by",
				'description' => esc_html__("Note: To avoid design issue we have disabled audio/video/gallery posts also disabled post without post thumbnail in this shortcode", "minimag-toolkit"),
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
				"heading" => esc_html__("Multiple Category(Category IDs)", "minimag-toolkit"),
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
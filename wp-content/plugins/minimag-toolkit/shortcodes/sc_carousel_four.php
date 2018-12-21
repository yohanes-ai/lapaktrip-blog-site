<?php
function minimag_carousel_four( $atts ) {
	
	extract( shortcode_atts( array( 'posts_display' => '', 'post_by'=> 'random', 'select_cat'=> '', 'post_id'=> '', 'cat_ids'=> '', 'stick_post'=> '' ), $atts ) );
	
	if( '' === $posts_display ) :
		$posts_display = 2;
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
			'ignore_sticky_posts'    => $stick,
			'cat' => $seperatecat,
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
			'ignore_sticky_posts'    => $stick,
			'post__in'=> $seperatepost,
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
		<div class="container-fluid no-left-padding no-right-padding slider-section slider-section5">
			<div class="image-loader spinner-image">
				<div class="spinner">
					<div class="dot1"></div>
					<div class="dot2"></div>
					<div class="bounce1"></div>
					<div class="bounce2"></div>
					<div class="bounce3"></div>
				</div>
			</div>
			<!-- Container -->
			<div class="container no-padding">
				<div class="slider-carousel-5">
					<?php
						$post_count = 1;
						while ( $qry->have_posts() ) : $qry->the_post();
							?>
							<div class="post-item<?php if($post_count == 1) { echo ' active'; } ?>">
								<?php the_post_thumbnail('minimag_1170_500'); ?>
								<div class="carousel-caption">
									<?php
									if($post_cat != "0") {
										?>
										<span class="post-category">
											<?php the_category( ' , ' ); ?>
										</span>
										<?php
									}
									?>
									<h3>
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
									</h3>
									<a href="<?php the_permalink(); ?>" title="<?php esc_html_e('Read More',"minimag-toolkit"); ?>">
										<?php esc_html_e('Read More',"minimag-toolkit"); ?>
									</a>
								</div>
							</div>
							<?php
						$post_count++;
						// End the loop.
						endwhile;
							
						/* Reset Post Data */
						wp_reset_postdata();
						
					?>
				</div>
			</div><!-- Container /- -->
		</div><!-- Slider Section /- -->
		<?php
	}
	
	return ob_get_clean();
}

add_shortcode('minimag_carousel_four', 'minimag_carousel_four');

if( function_exists('vc_map') ) {
	
	$categories_array = array('select');
	
	$categories = get_categories();
	
	foreach( $categories as $category ){
	  $categories_array[] = $category->slug;
	}
	
	vc_map( array(
		'base' => 'minimag_carousel_four',
		'name' => esc_html__( 'Post Carousel 4', "minimag-toolkit" ),
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
				"heading" => esc_html__("Multiple Posts(Posts IDs)", "minimag-toolkit"),
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
				"heading" => esc_html__(" Display Stick Post", "minimag-toolkit"),
				"param_name" => "stick_post",
			),
		),
	) );
}
?>
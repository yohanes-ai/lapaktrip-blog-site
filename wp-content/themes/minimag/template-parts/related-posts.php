<?php
// Get array of terms
$terms = get_the_terms( $post->ID , 'category', 'string');

// Pluck out the IDs to get an array of IDS
$term_ids = wp_list_pluck( $terms,'term_id' );

// Query posts with tax_query. Choose in 'IN' if want to query posts with any of the terms

// Chose 'AND' if you want to query for posts with all terms
$qry = new WP_Query( array(
	'post_type' => 'post',
	'posts_per_page' => 4,
	'tax_query' => array(
		array(
			'taxonomy' => 'category',
			'field' => 'id',
			'terms' => $term_ids,
			'operator'=> 'IN' //Or 'AND' or 'NOT IN'
		)
	),
	'meta_query' => array(
		array(
			'key' => '_thumbnail_id'
		)
	),
	'post__not_in' => array ($post->ID),
) );

$post_category = minimag_options('opt_post_category');

if ( $qry->have_posts() ) {
	?>
	<!-- Related Post -->
	<div class="related-post">
		<div class="image-loader spinner-image">
			<div class="spinner">
				<div class="dot1"></div>
				<div class="dot2"></div>
				<div class="bounce1"></div>
				<div class="bounce2"></div>
				<div class="bounce3"></div>
			</div>
		</div>
		<h3><?php esc_html_e('You May Also Like',"minimag"); ?></h3>
		<div class="related-post-block">
			<?php
			while( $qry->have_posts() ) : $qry->the_post();
				?>
				<div class="related-post-box">
					<a href="<?php the_permalink(); ?>">
						<?php
						if( get_post_meta( get_the_ID(),'minimag_cf_page_owlayout',true) == "no_sidebar" && get_post_meta( get_the_ID(),'minimag_cf_sidebar_owlayout',true) == "no_sidebar" && !is_archive() ) {
							the_post_thumbnail('minimag_170_113');
						}
						else {
							the_post_thumbnail('minimag_270_220');
						}
						?>
					</a>
					<?php
					if($post_category != "0" ) {
						?>
						<span class="post-category">
							<?php the_category( ' , ' ); ?>
						</span>
						<?php
					}
					?>
					<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
				</div>
				<?php
			endwhile;

			// Restore original Post Data
			wp_reset_postdata();
			?>
		</div>
	</div>
	<?php
}
?>
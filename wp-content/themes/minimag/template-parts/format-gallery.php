<?php
$thumb = "";

if( get_post_meta( get_the_ID(),'minimag_cf_page_owlayout',true) == "no_sidebar" && get_post_meta( get_the_ID(),'minimag_cf_sidebar_owlayout',true) == "no_sidebar" && !is_archive() ) {
	$thumb = 'minimag_1170_605';
}
else {
	$thumb = 'minimag_770_513';
}

/* Post Format : Gallery */
if( get_post_format() == "gallery" && count( get_post_meta( get_the_ID(), 'minimag_cf_post_gallery', 1 ) ) > 0 && is_array( get_post_meta( get_the_ID(), 'minimag_cf_post_gallery', 1 ) ) ) {
	?>
	<div class="entry-cover">
		<div class="post-meta">
			<span class="byline"><?php esc_html_e('by',"minimag") ?>
				<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a>
			</span>
			<span class="post-date">
				<a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
			</span>
		</div>
		<!-- Carousel -->	
		<div id="blog-carousel-<?php echo esc_attr( the_ID() ); ?>" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner" role="listbox">
				<?php
				$active=1;
				foreach ( (array) get_post_meta( get_the_ID(), 'minimag_cf_post_gallery', 1 ) as $attachment_id => $attachment_url ) {
					?>
					<div class="carousel-item<?php if( $active == 1 ) { echo ' active'; } ?>">
						<?php echo wp_get_attachment_image( $attachment_id, $thumb ); ?>
					</div>
					<?php
					$active++;
				} ?>
			</div>
			<a title="<?php esc_html_e('Previous',"minimag"); ?>" class="carousel-control-prev" href="#blog-carousel-<?php echo esc_attr(the_ID()); ?>" role="button" data-slide="prev">
				<span class="fa fa-chevron-left" aria-hidden="true"></span>
			</a>
			<a title="<?php esc_html_e('Next',"minimag"); ?>" class="carousel-control-next" href="#blog-carousel-<?php echo esc_attr(the_ID()); ?>" role="button" data-slide="next">
				<span class="fa fa-chevron-right" aria-hidden="true"></span>
			</a>
		</div><!-- /.carousel -->
	</div>
	<?php
}
?>
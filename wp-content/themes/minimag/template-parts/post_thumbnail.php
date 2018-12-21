<?php
if( !is_single() && has_post_thumbnail() && ( get_post_format() != "audio" && get_post_format() != "video" && get_post_format() != "gallery" ) ) {	?>
	
	<div class="entry-cover">
		<div class="post-meta">
			<span class="byline"><?php esc_html_e('by',"minimag") ?>
				<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a>
			</span>
			<span class="post-date">
				<a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
			</span>
		</div>
		<a href="<?php the_permalink(); ?>">
			<?php
			if( get_post_meta( get_the_ID(),'minimag_cf_sidebar_owlayout',true) == "no_sidebar" && get_post_meta( get_the_ID(),'minimag_cf_sidebar_owlayout',true) == "no_sidebar" && !is_archive() ) {
				the_post_thumbnail('minimag_1170_605');
			}
			else {
				the_post_thumbnail();
			}
			?>
		</a>
	</div>
	<?php
}
else {
	if( is_single() ) {
		if( get_post_meta( get_the_ID(), 'minimag_cf_single_content',true) 	== '2' || 
			get_post_meta( get_the_ID(), 'minimag_cf_single_content',true)	== '3' ||
			get_post_meta( get_the_ID(),'minimag_cf_single_content',true) 	== '4' 
		) {
			//nothing
		}
		else{
			if(has_post_thumbnail() ) {
				?>
				<div class="entry-cover">
					<?php
						if( get_post_meta( get_the_ID(),'minimag_cf_sidebar_owlayout',true) == "no_sidebar" && get_post_meta( get_the_ID(),'minimag_cf_page_owlayout',true) == "fixed" ) {
							the_post_thumbnail('minimag_1170_605');
						}
						elseif( get_post_meta( get_the_ID(),'minimag_cf_sidebar_owlayout',true) == "no_sidebar" && get_post_meta( get_the_ID(),'minimag_cf_page_owlayout',true) == "none" ) {
							the_post_thumbnail('minimag_1170_605');
						}
						elseif( get_post_meta( get_the_ID(),'minimag_cf_sidebar_owlayout',true) == "none" && get_post_meta( get_the_ID(),'minimag_cf_page_owlayout',true) == "fluid" ) {
							the_post_thumbnail('minimag_1260_840');
						}
						elseif( get_post_meta( get_the_ID(),'minimag_cf_sidebar_owlayout',true) == "no_sidebar" && get_post_meta( get_the_ID(),'minimag_cf_page_owlayout',true) == "fluid" ) {
							the_post_thumbnail('minimag_1920_900');
						}
						else {
							the_post_thumbnail();
						}
					?>
				</div>
				<?php
			}
		}
	}
}
?>
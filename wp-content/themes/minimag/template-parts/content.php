<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Minimag
 * @since Minimag 1.0
 */

$css = $post_category = "";

if( ! has_post_thumbnail() ) {
	$css = "no-post-thumbnail";
}

$post_category = minimag_options('opt_post_category');

?>
<article id="post-<?php the_ID(); ?>" <?php post_class($css); ?>>
	<?php
	
	if ( is_sticky() && is_home() ) {
		?><span class="sticky-post"><?php esc_html_e( 'Featured', "minimag" ); ?></span><?php
	}
	
	get_template_part("template-parts/post_thumbnail");
	
	get_template_part("template-parts/format","audio");
	
	get_template_part("template-parts/format","video");
	
	get_template_part("template-parts/format","gallery");
		
	?>
	<div class="entry-content">
		<?php
		if( get_post_meta( get_the_ID(),'minimag_cf_single_content',true) != '4' ) {
			?>
			<div class="entry-header">
				<?php
				if($post_category != "0" ) {
					?>
					<span class="post-category">
						<?php the_category( ' , ' ); ?>
					</span>
					<?php
				}
				if( !is_single() ) {
					the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
				}
				else {
					the_title('<h3 class="entry-title">','</h3>');
					?>
					<div class="post-meta">
						<span class="byline"><?php esc_html_e('by',"minimag"); ?>
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a>
						</span>
						<span class="post-date"><?php echo get_the_date(); ?></span>
						<?php
						if( function_exists('minimag_set_post_view') ) {
							minimag_set_post_view( minimag_get_the_ID() );
						}
						if( function_exists('minimag_get_post_view') ) {
							?><span class="post-view"><?php echo esc_attr( minimag_get_post_view( minimag_get_the_ID() ) ); ?></span><?php
						}
						?>
					</div>
					<?php
				}
				?>
			</div>
			<?php
		}
		if( ! is_single() ) {
			?>
			<p><?php minimag_excerpt(70); ?></p>
			<a href="<?php the_permalink(); ?>" title="<?php esc_html_e('Read More',"minimag"); ?>">
				<?php esc_html_e('Read More',"minimag"); ?>
			</a>
			<?php
		}
		else {
			the_content( sprintf(
				esc_html__( 'Continue reading %s', "minimag" ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', "minimag" ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', "minimag" ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
			
			$post_tags = minimag_options('opt_post_tags');
			?>
			<div class="entry-footer">
				<?php
				if( has_tag() && $post_tags != "0" ) {
					?>
					<div class="tags">
						<span><?php esc_html_e('Tags : ',"minimag"); ?></span>
						<?php echo get_the_tag_list('', ', '); ?>
					</div>
					<?php
				}
				if( minimag_options("opt_post_share") == '1' && (
					minimag_options("opt_fb") == '1' ||
					minimag_options("opt_tw") == '1' ||
					minimag_options("opt_pin") == '1' ||
					minimag_options("opt_gp") == '1' ||
					minimag_options("opt_lin") == '1' ||
					minimag_options("opt_digg") == '1' ||
					minimag_options("opt_reddit") == '1'
					) ) {
					?>
					<ul class="social-share">
						<?php if( minimag_options("opt_fb") == '1' ) { ?><li><a class="share-facebook" target="_blank" href="http://www.facebook.com/share.php?u=<?php echo esc_url( the_permalink() ); ?>&title=<?php echo esc_attr( the_title() ); ?>"><i class="fa fa-facebook"></i></a></li><?php } ?>
						<?php if( minimag_options("opt_tw") == '1' ) { ?><li><a class="share-twitter" target="_blank" href="https://twitter.com/share?url=<?php echo esc_url( the_permalink() ); ?>&amp;text=<?php echo esc_attr( the_title() ); ?>"><i class="fa fa-twitter"></i></a></li><?php } ?>
						<?php if( minimag_options("opt_pin") == '1' ) { ?><li><a class="share-pinterest" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url( the_permalink() ); ?>&media=<?php echo wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ); ?>&description=<?php echo esc_attr( the_title() ); ?>"><i class="fa fa-pinterest"></i></a></li><?php } ?>
						<?php if( minimag_options("opt_gp") == '1' ) { ?><li><a class="share-google" target="_blank" href="https://plus.google.com/share?url=<?php echo esc_url( the_permalink() ); ?>"><i class="fa fa-google-plus"></i></a></li><?php } ?>
						<?php if( minimag_options("opt_lin") == '1' ) { ?><li><a class="share-linkedin" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url( the_permalink() ); ?>&title=<?php echo esc_attr( the_title() ); ?>"><i class="fa fa-linkedin"></i></a></li><?php } ?>
						<?php if( minimag_options("opt_digg") == '1' ) { ?><li><a class="share-digg" target="_blank" href="http://digg.com/submit?url=<?php echo esc_url( the_permalink() ); ?>&amp;title=<?php echo esc_attr( the_title() ); ?>"><i class="fa fa-digg"></i></a></li><?php } ?>
						<?php if( minimag_options("opt_reddit") == '1' ) { ?><li><a class="share-reddit" target="_blank" href="http://www.reddit.com/submit?url=<?php echo esc_url( the_permalink() ); ?>&amp;title=<?php echo esc_attr( the_title() ); ?>"><i class="fa fa-reddit"></i></a></li><?php } ?>
					</ul>
					<?php
				}
				?>
			</div>
			<?php
		}
		?>
	</div>
</article>
<?php
if( is_single() ) {
	
	if( minimag_options('opt_post_author') != "0" && get_the_author_meta('description') != "" ) {
		?>
		<!-- About Author -->
		<div class="about-author-box">
			<div class="author">
				<?php
					if( get_user_meta( get_the_author_meta('ID'), 'minimag_user_author_img', true ) !="" ){
						?><i><?php echo wp_get_attachment_image(get_user_meta( get_the_author_meta('ID'), 'minimag_user_author_img_id', true ),'minimag_170_170');?></i><?php
					}	
					else{
						?><i><?php echo get_avatar( get_the_author_meta( 'ID' ) , 170 ); ?></i><?php
					}
				?>
				<h4><?php the_author(); ?></h4>
				<?php 
					echo wpautop( get_the_author_meta('description') );

					$fb = get_user_meta( get_the_author_meta('ID'), 'minimag_user_fb', true );
					$tw = get_user_meta( get_the_author_meta('ID'), 'minimag_user_tw', true );
					$gp = get_user_meta( get_the_author_meta('ID'), 'minimag_user_gp', true );
					$lnkd = get_user_meta( get_the_author_meta('ID'), 'minimag_user_lnkd', true );
					$yt = get_user_meta( get_the_author_meta('ID'), 'minimag_user_yt', true );
					$inst = get_user_meta( get_the_author_meta('ID'), 'minimag_user_inst', true );
					$skype = get_user_meta( get_the_author_meta('ID'), 'minimag_user_skype', true );
					$pin = get_user_meta( get_the_author_meta('ID'), 'minimag_user_pinterest', true );
					$flick = get_user_meta( get_the_author_meta('ID'), 'minimag_user_flick', true );
					$tumb = get_user_meta( get_the_author_meta('ID'), 'minimag_user_tumb', true );
					$digg = get_user_meta( get_the_author_meta('ID'), 'minimag_user_digg', true );
					$reddit = get_user_meta( get_the_author_meta('ID'), 'minimag_user_reddit', true );
					
					if( $fb != "" ||
						$tw != "" ||
						$gp != "" ||
						$lnkd != "" ||
						$yt != "" ||
						$inst != "" ||
						$skype != "" ||
						$pin != "" ||
						$flick != "" ||
						$tumb != "" ||
						$digg != "" ||
						$reddit != ""
					) {
						?>
						<ul>
							<?php if( $fb != "" ) { ?><li><a href="<?php echo esc_url( $fb ); ?>" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li><?php } ?>
							<?php if( $tw != "" ) { ?><li><a href="<?php echo esc_url( $tw ); ?>" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li><?php } ?>
							<?php if( $gp != "" ) { ?><li><a href="<?php echo esc_url( $gp ); ?>" title="Google Plus" target="_blank"><i class="fa fa-google-plus"></i></a></li><?php } ?>
							<?php if( $lnkd != "" ) { ?><li><a href="<?php echo esc_url( $lnkd ); ?>" title="Linkedin" target="_blank"><i class="fa fa-linkedin"></i></a></li><?php } ?>
							<?php if( $yt != "" ) { ?><li><a href="<?php echo esc_url( $yt ); ?>" title="Youtube" target="_blank"><i class="fa fa-youtube"></i></a></li><?php } ?>
							<?php if( $inst != "" ) { ?><li><a href="<?php echo esc_url( $inst ); ?>" title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a></li><?php } ?>
							<?php if( $skype != "" ) { ?><li><a href="<?php echo esc_url( $skype ); ?>" title="Skype" target="_blank"><i class="fa fa-skype"></i></a></li><?php } ?>
							<?php if( $pin != "" ) { ?><li><a href="<?php echo esc_url( $pin ); ?>" title="Pinterest" target="_blank"><i class="fa fa-pinterest"></i></a></li><?php } ?>
							<?php if( $flick != "" ) { ?><li><a href="<?php echo esc_url( $flick ); ?>" title="Flickr" target="_blank"><i class="fa fa-flickr"></i></a></li><?php } ?>
							<?php if( $tumb != "" ) { ?><li><a href="<?php echo esc_url( $tumb ); ?>" title="Tumblr" target="_blank"><i class="fa fa-tumblr"></i></a></li><?php } ?>
							<?php if( $digg != "" ) { ?><li><a href="<?php echo esc_url( $digg ); ?>" title="Digg" target="_blank"><i class="fa fa-digg"></i></a></li><?php } ?>
							<?php if( $reddit != "" ) { ?><li><a href="<?php echo esc_url( $reddit ); ?>" title="Reddit" target="_blank"><i class="fa fa-reddit"></i></a></li><?php } ?>
						</ul>
						<?php
					}
				?>
			</div>
		</div><!-- About Author /- -->
		<?php
	}
	get_template_part("template-parts/related-posts");
}
?>
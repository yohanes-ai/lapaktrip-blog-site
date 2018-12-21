<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Minimag
 * @since Minimag 1.0
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	if( get_post_meta( get_the_ID(), "minimag_cf_pagetitle", true ) != "off" ) {
		?>
		<div class="block-title page-title">
			<h3 class="no-top-margin"><?php the_title(); ?></h3>
		</div>
		<?php
	}

	the_post_thumbnail(); ?>

	<div class="entry-content">

		<?php the_content(); ?>

		<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', "minimag" ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', "minimag" ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>

	</div><!-- .entry-content -->

	<?php edit_post_link( esc_html__( 'Edit', "minimag" ), '<div class="container no-padding"><div class="entry-footer"><span class="edit-link">', '</span></div><!-- .entry-footer --></div>' ); ?>

</div><!-- #post-## -->
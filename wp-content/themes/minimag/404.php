<?php
/**
* The Template for displaying all single posts
*
* @package WordPress
* @subpackage Minimag
* @since Minimag 1.0
*/
get_header(); ?>
<main id="main" class="site-main">
	<!-- Page Content -->
	<div class="container-fluid no-left-padding no-right-padding page-content">
		<!-- Container -->	
		<div class="container">
			<div class="row justify-content-md-center">
				<div class="col-md-8">
					<div class="error-block">
						<?php 
						if( minimag_options("opt_error_title") != "" ) {
							?>
							<span><?php echo esc_attr( minimag_options("opt_error_title") ); ?></span>
							<?php
						}
						else {
							?><span><?php esc_html_e('404',"minimag"); ?></span><?php
						}
						
						if( minimag_options("opt_error_subtitle") != "" ) {
							?>
							<h2><?php echo esc_attr( minimag_options("opt_error_subtitle") ); ?></h2>
							<?php
						}
						else {
							?><h2><?php esc_html_e('Oops! That page cant be found',"minimag"); ?></h2><?php
						}

						if( minimag_options("opt_error_content") != "" && function_exists('minimag_404content') ) {
							echo minimag_404content();
						}
						else {
							?><p><?php esc_html_e('Sorry, but the page you were looking for could not be found.',"minimag"); ?></p>
							<?php
						}
						?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_html_e('Back Home',"minimag"); ?>">
							<?php esc_html_e('Back Home',"minimag"); ?>
						</a>
					</div>
				</div>
			</div>
		</div><!-- Container /- -->
	</div><!-- Page Content /- -->
</main><!-- .site-main -->
<?php get_footer(); ?>
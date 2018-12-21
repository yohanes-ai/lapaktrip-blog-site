<!-- Footer Main -->
<footer class="container-fluid no-left-padding no-right-padding footer-main footer-section1 footer-dark">
	<?php
	get_template_part("template-parts/instagram-gallery");
	
	if( is_active_sidebar("sidebar-7") ||
		is_active_sidebar("sidebar-8") ||
		is_active_sidebar("sidebar-9") ||
		is_active_sidebar("sidebar-10")
	) {
		?>
		<!-- Footer Widget -->
		<div class="container-fluid no-left-padding no-right-padding footer-widget">
			<!-- Container -->
			<div class="container">
				<div class="row">
					<?php
					if(is_active_sidebar("sidebar-7") ) {
						?>
						<div class="col-lg-3 col-sm-6">
							<?php dynamic_sidebar("sidebar-7") ?>
						</div>
						<?php
					}
					if(is_active_sidebar("sidebar-8") ) {
						?>
						<div class="col-lg-3 col-sm-6">
							<?php dynamic_sidebar("sidebar-8") ?>
						</div>
						<?php
					}
					if(is_active_sidebar("sidebar-9") ) {
						?>
						<div class="col-lg-3 col-sm-6">
							<?php dynamic_sidebar("sidebar-9") ?>
						</div>
						<?php
					}
					if(is_active_sidebar("sidebar-10") ) {
						?>
						<div class="col-lg-3 col-sm-6">
							<?php dynamic_sidebar("sidebar-10") ?>
						</div>
						<?php
					}
					?>
				</div>
			</div><!-- Container -->
		</div><!-- Footer Widget -->
		<?php
	}
	?>

	<!-- Container -->
	<div class="container">
		<?php get_template_part("template-parts/footersocial_icons"); ?>
		<div class="copyright">
			<?php
			if( minimag_options("opt_footer_copyright") != "" && function_exists('minimag_copyright') ) {
				echo minimag_copyright();
			}
			else {
				?><p>
					<?php esc_html_e('Copyright &copy;',"minimag"); ?>
					<?php echo date('Y '); ?>
					<?php esc_html_e('MINIMAG',"minimag"); ?>
				</p>
				<?php
			}
			?>
		</div>
	</div><!-- Container /- -->
</footer><!-- Footer Main /- -->
<?php
if( minimag_options("opt_sticky_menu") != "0" ){
	$header_css = " header-fix";
}
else {
	$header_css = "";
}
?>
<!-- Header Section -->
<header class="container-fluid no-left-padding no-right-padding header_s header_s3<?php echo esc_attr($header_css); ?>">
	
	<!-- Menu Block -->
	<div class="container-fluid no-left-padding no-right-padding menu-block">
		<!-- Container -->
		<div class="container">				
			<nav class="navbar ownavigation navbar-expand-lg">
				<?php get_template_part("template-parts/sitelogo"); ?>
				<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar3" aria-controls="navbar1" aria-expanded="false" aria-label="Toggle navigation">
					<i class="fa fa-bars"></i>
				</button>
				<div class="collapse navbar-collapse" id="navbar3">
					<?php
						if( has_nav_menu('minimag_primary') ) {
							wp_nav_menu( array(
								'theme_location' => 'minimag_primary',
								'container' => false,
								'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'depth' => 10,
								'menu_class' => 'navbar-nav justify-content-end',
								'walker' => new minimag_nav_walker
							));
						}
						else {
							?>
							<h3 class="menu-setting-info navbar-nav justify-content-end">
								<a href="<?php echo esc_url( admin_url("/nav-menus.php") ); ?>"><?php esc_html_e( 'Set The Menu', "minimag" );?></a>
							</h3>
							<?php
						}
					?>
				</div>
				<ul class="user-info">
					<li>
						<a href="#search-box3" data-toggle="collapse" class="search collapsed" title="<?php esc_html_e('Search',"minimag"); ?>">
							<i class="pe-7s-search sr-ic-open"></i><i class="pe-7s-close sr-ic-close"></i>
						</a>
					</li>
				</ul>
			</nav>
		</div><!-- Container /- -->
	</div><!-- Menu Block /- -->
	<!-- Search Box -->
	<div class="search-box collapse" id="search-box3">
		<div class="container">
			<?php get_search_form(); ?>
		</div>
	</div><!-- Search Box /- -->
</header><!-- Header Section /- -->
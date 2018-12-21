<?php
get_header();

$bodylayout = "";
$bodylayout_css = "";

$sidebarlayout = "";
$sidebarlayout_css = "";

$page_css = $template_css = $dbodylayout_css = $dbodylayout = $dsidebarlayout = $dsidebarlayout_css = $pid = "";

$pid = minimag_get_the_ID();

if( minimag_options("layout_body") != "" ) {

	$dbodylayout = minimag_options("layout_body");

	if( $dbodylayout == "fixed" ) {
		$dbodylayout_css = "container";
	}
	elseif( $dbodylayout == "fluid" ) {
		$dbodylayout_css = "container-fluid no-padding";
	}
	else { /* Do Nothing.. */ }
}
else {
	$dbodylayout_css = "container";	
}

if( minimag_options("layout_sidebar") != "" ) {

	$dsidebarlayout = minimag_options("layout_sidebar");

	if( $dsidebarlayout == "right_sidebar" ) {
		$dsidebarlayout_css = " content-left col-xl-8 col-lg-8 col-md-6";
	}
	elseif( $dsidebarlayout == "left_sidebar" ) {
		$dsidebarlayout_css = " content-right col-xl-8 col-lg-8 col-md-6";
	}
	elseif( $dsidebarlayout == "no_sidebar" ) {
		$dsidebarlayout_css = " no-sidebar col-xl-12 col-lg-12 col-md-12";
	}
	else { /* Do Nothing.. */ }
}
else {
	$dsidebarlayout_css = " content-left col-xl-8 col-lg-8 col-md-6";
}

if( $pid != "" && !is_search() && !is_archive() ) {

	/* Page Layout */
	if( get_post_meta( $pid, 'minimag_cf_page_owlayout', true ) != "" || get_post_meta( $pid, 'minimag_cf_page_owlayout', true ) != "none" ) {

		$bodylayout = get_post_meta( $pid, 'minimag_cf_page_owlayout', true );
		
		if( $bodylayout == "fixed" ) {
			$bodylayout_css = "container";
		}
		elseif( $bodylayout == "fluid" ) {
			$bodylayout_css = "container-fluid no-padding";
		}
		else {
			$bodylayout_css = $dbodylayout_css;
		}
	}	

	/* Sidebar Layout */
	if( get_post_meta( $pid, 'minimag_cf_sidebar_owlayout', true ) != "" || get_post_meta( $pid, 'minimag_cf_sidebar_owlayout', true ) != 'none' ) {

		$sidebarlayout = get_post_meta( $pid, 'minimag_cf_sidebar_owlayout', true );
		
		if( $sidebarlayout == "right_sidebar" ) {
			$sidebarlayout_css = " content-left col-xl-8 col-lg-8 col-md-6";
		}
		elseif( $sidebarlayout == "left_sidebar" ) {
			$sidebarlayout_css = " content-right col-xl-8 col-lg-8 col-md-6";
		}
		elseif( $sidebarlayout == "no_sidebar" ) {
			$sidebarlayout_css = " no-sidebar col-xl-12 col-lg-12 col-md-12";
		}
		else {
			$sidebarlayout_css = $dsidebarlayout_css;
		}
	}
	
	if( get_post_meta( $pid, 'minimag_cf_content_padding', true ) != "off" ) {
		$page_css = " page_spacing";
	}

	if( is_singular("post") ) {
		$template_css = " blog-listing blog-single";
	}
}
else {

	$bodylayout_css = $dbodylayout_css;
	$sidebarlayout_css = $dsidebarlayout_css;
	$page_css = " page_spacing";
}
?>
<main id="main" class="site-main<?php echo esc_attr( $page_css ); ?>">
	
	<?php
	if( is_single() && has_post_thumbnail() ) {

		$post_category = minimag_options('opt_post_category');

		if( get_post_meta($pid, 'minimag_cf_single_content',true) == '2') {
			?>
			<div class="container single-layout-2">
				<div class="entry-cover">
					<?php the_post_thumbnail('minimag_1170_605'); ?>
				</div>
			</div>
			<?php
		}
		elseif( get_post_meta($pid, 'minimag_cf_single_content',true) == '3') {
			?>
			<div class="entry-cover single-layout-3">
				<?php the_post_thumbnail('minimag_1920_400'); ?>
			</div>
			<?php
		}
		elseif( get_post_meta($pid, 'minimag_cf_single_content',true) == '4') {
			?>
			<div class="post-nosidebar single-layout-4">
				<div class="entry-cover">
					<?php the_post_thumbnail('minimag_1920_400'); ?>
					<div class="entry-header">	
						<?php
						if($post_category != "0" ) {
							?>
							<span class="post-category">
								<?php the_category( ' , ' ); ?>
							</span>
							<?php
						}
						the_title('<h3 class="entry-title">','</h3>');
						?>
						<span class="post-date"><?php echo get_the_date(); ?></span>
					</div>
				</div>
			</div>
			<?php
		}
	}

	?>

	<div class="<?php echo esc_attr( $bodylayout_css ); ?>">
	
		<div class="row">
		
			<div class="content-area<?php echo esc_attr( $sidebarlayout_css . $template_css ); ?>">
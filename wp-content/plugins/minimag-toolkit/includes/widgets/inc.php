<?php
/* Widget Register / UN-register */
function minimag_manage_widgets() {

	/* Social Icon */
	require_once("social_icon.php");
	register_widget( 'Minimag_Widget_SocialIcon' );
	
	/* Instagram */
	require_once("instagram.php");
	register_widget( 'Minimag_Widget_Intstagram' );
	
	/* Popularpost */
	require_once("popularpost.php");
	register_widget( 'Minimag_Widget_PopularPost' );
	
	/* Tranding Post */
	require_once("tranding_post.php");
	register_widget( 'Minimag_Widget_Tranding' );
	
	/* Advertise */
	require_once("advertise.php");
	register_widget( 'Minimag_Widget_Advertise' );
	
	/* Category Image */
	require_once("category_image.php");
	register_widget( 'Minimag_Widget_CategoryImage' );
	
}
add_action( 'widgets_init', 'minimag_manage_widgets' );
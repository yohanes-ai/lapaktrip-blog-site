<?php
/* Define Constants */
define( 'MINIMAG_IMGURI', get_template_directory_uri() . '/assets/images' );

/**
 * Register three widget areas.
 *
 * @since Minimag 1.0
 */
if ( ! function_exists( 'minimag_widgets_init' ) ) {

	function minimag_widgets_init() {

		register_sidebar( array(
			'name'          => esc_html__( 'Blog Right Sidebar (Default for Blog)', "minimag" ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Appears in the Blog Right section', "minimag" ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));
		register_sidebar( array(
			'name'          => esc_html__( 'Blog Left Sidebar', "minimag" ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Appears in the Blog Left section, it will display when you select in page options', "minimag" ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));
		register_sidebar( array(
			'name'          => esc_html__( 'Pages Sidebar 1', "minimag" ),
			'id'            => 'sidebar-3',
			'description'   => esc_html__( 'Optional widget area which displays when choose in blog shortcodes', "minimag" ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));
		register_sidebar( array(
			'name'          => esc_html__( 'Pages Sidebar 2', "minimag" ),
			'id'            => 'sidebar-4',
			'description'   => esc_html__( 'Optional widget area which displays when choose in blog shortcodes', "minimag" ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));
		register_sidebar( array(
			'name'          => esc_html__( 'Pages Sidebar 3', "minimag" ),
			'id'            => 'sidebar-5',
			'description'   => esc_html__( 'Optional widget area which displays when choose in blog shortcodes', "minimag" ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));
		register_sidebar( array(
			'name'          => esc_html__( 'Pages Sidebar 4', "minimag" ),
			'id'            => 'sidebar-6',
			'description'   => esc_html__( 'Optional widget area which displays when choose in blog shortcodes', "minimag" ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));		
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar 1', "minimag" ),
			'id'            => 'sidebar-7',
			'description'   => esc_html__( 'Appears in Footer at 1st Position', "minimag" ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar 2', "minimag" ),
			'id'            => 'sidebar-8',
			'description'   => esc_html__( 'Appears in Footer at 2nd Position', "minimag" ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar 3', "minimag" ),
			'id'            => 'sidebar-9',
			'description'   => esc_html__( 'Appears in Footer at 3rd Position', "minimag" ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar 4', "minimag" ),
			'id'            => 'sidebar-10',
			'description'   => esc_html__( 'Appears in Footer at 4th Position', "minimag" ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));
	}
	
	add_action( 'widgets_init', 'minimag_widgets_init' );
}

/* ************************************************************************ */

require_once( trailingslashit( get_template_directory() ) . 'include/nav_walker.php' );
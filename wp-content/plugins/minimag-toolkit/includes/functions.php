<?php
/* Redux Options */
if( !function_exists('minimag_options') ) :

	function minimag_options( $option, $arr = null ) {

		global $minimag_option;

		if( $arr ) {

			if( isset( $minimag_option[$option][$arr] ) ) {
				return $minimag_option[$option][$arr];
			}
		}
		else {
			if( isset( $minimag_option[$option] ) ) {
				return $minimag_option[$option];
			}
		}
	}

endif;

if( ! function_exists('minimag_add_allowed_tags') ) {

	function minimag_add_allowed_tags( $tags ) {
	
		$tags['h1'] = array( 'class' => array(), 'style' => array() );
		$tags['h2'] = array( 'class' => array(), 'style' => array() );
		$tags['h3'] = array( 'class' => array(), 'style' => array() );
		$tags['h4'] = array( 'class' => array(), 'style' => array() );
		$tags['h5'] = array( 'class' => array(), 'style' => array() );
		$tags['h6'] = array( 'class' => array(), 'style' => array() );
		$tags['em'] = array( 'class' => array(), 'style' => array() );
		$tags['li'] = array( 'class' => array(), 'style' => array() );
		$tags['ul'] = array( 'class' => array(), 'style' => array() );		
		$tags['ol'] = array( 'class' => array(), 'style' => array() );
		$tags['p'] = array( 'class' => array(), 'style' => array() );
		$tags['span'] = array( 'class' => array(), 'style' => array() );
		$tags['i'] = array( 'class' => array(), 'style' => array() );
		$tags['ins'] = array( 'datetime' => array() );
		$tags['img'] = array( 'class' => array(), 'src' => array(), 'alt' => array(), 'style' => array() );
		$tags['a'] = array( 'class' => array(), 'href' => array(), 'target' => array(), 'title' => array(), 'style' => array() );
	
		return $tags;
	}
	add_filter('wp_kses_allowed_html', 'minimag_add_allowed_tags');
}

/* ************************************************************************ */

if( !function_exists('minimag_remove_excerpt') )  {

  function minimag_remove_excerpt( $excerpt ) {
    $patterns = "/\[[\/]?vc_[^\]]*\]/";
    $replacements = "";
    return preg_replace($patterns, $replacements, $excerpt);
  }
  
}

/* ************************************************************************ */

if( !function_exists('minimag_excerpt') ) {
 
/** Function that cuts post excerpt to the number of word based on previosly set global * variable $word_count, which is defined below */
 
  function minimag_excerpt($excerpt_length = 25) {
 
		global $post;
	 
		$word_count =  "";
	 
		$word_count = isset( $word_count ) && $word_count != "" ? $word_count : $excerpt_length;
	 
		$post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags( $post->post_content ); $clean_excerpt = strpos( $post_excerpt, '[...]' ) ? strstr( $post_excerpt, '[...]', true ) : $post_excerpt;

		/** add by PR */
		if( $clean_excerpt != "" ) {

			$clean_excerpt = strip_shortcodes( minimag_remove_excerpt($clean_excerpt) );

			/** end PR mod */

			$excerpt_all = explode(' ',$clean_excerpt );
			$excerpt_words = array_slice( $excerpt_all, 0, $word_count );

			$excerpt = implode(' ', $excerpt_words );

			$trim_excerpt = trim( $excerpt );

			$cnt = count( $excerpt_all );

			$excpt = "";

			if( $trim_excerpt != "" ) {

				$excpt .= $trim_excerpt;
				
				if( $cnt > $word_count ) {
					$excpt .= ' ...';
				}
			}
			echo html_entity_decode( $excpt );
		}
	}
}

/* ************************************************************************ */

if( !function_exists('minimag_get_post_view') ) :
	function minimag_get_post_view( $postID ) {
		$count_key = 'post_views_count';
		$count     = get_post_meta( $postID, $count_key, true );
		if ( $count == '' ) {
			delete_post_meta( $postID, $count_key );
			add_post_meta( $postID, $count_key, '0' );
		 
		 return esc_html__('0 View',"minimag");
		 }
	 
	 return $count . esc_html__(' Views',"minimag");
	}
endif;
/**
 * To count number of views and store in database.
 *
 * @param $postID currently viewed post/page
 */

if( !function_exists('minimag_set_post_view') ) :
	function minimag_set_post_view( $postID ) {
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count == ''){
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
		}else{
			$count++;
			update_post_meta($postID, $count_key, $count);
		}
	}
endif;

/**
 * Add a new column in the wp-admin posts list
 *
 * @param $defaults
 *
 * @return mixed
 */
if( !function_exists('minimag_posts_column_views') ) :
	function minimag_posts_column_views( $defaults ) {
		$defaults['post_views'] = esc_html__( 'Views',"minimag" );
	 return $defaults;
	}
	add_filter( 'manage_posts_columns', 'minimag_posts_column_views' );
endif;

/**
 * Display the number of views for each posts
 *
 * @param $column_name
 * @param $id
 *
 * @return void simply echo out the number of views
 */
if( !function_exists('minimag_posts_custom_column_views') ) :
	function minimag_posts_custom_column_views( $column_name, $id ) {
		if ( $column_name === 'post_views' ) {
			echo esc_attr( minimag_get_post_view( minimag_get_the_ID() ) );
		}
	}
	add_action( 'manage_posts_custom_column', 'minimag_posts_custom_column_views', 5, 2 );
endif;
?>
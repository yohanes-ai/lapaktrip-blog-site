<?php
/**
 * Tranding widget class Minimag
 *
 * @since 2.8.0
 */
class Minimag_Widget_Tranding extends WP_Widget {

	public function __construct() {

		$widget_ops = array( 'classname' => 'widget_tranding_post', 'description' => esc_html__( "", "minimag-toolkit" ) );

		parent::__construct('widget_tranding_post', esc_html__('Minimag :: Trending Posts', "minimag-toolkit"), $widget_ops);

		$this->alt_option_name = 'widget_tranding_post';
	}

	public function widget($args, $instance) {

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Trending Posts', "minimag-toolkit" );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 3;

		if ( ! $number ) {
			$number = 3;
		}

		/**
		 * Filter the arguments for the latest Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$qry_args = array (
			'post_status'            => 'publish',
			'posts_per_page'         => $number,
			'ignore_sticky_posts'    => true,
			'meta_key'    => 'post_views_count',
			'post_type'   => 'post',
			'orderby'     => 'meta_value_num',  /* this will look at the meta_key you set below */
		);

		$qry = new WP_Query( $qry_args );

		echo html_entity_decode( $args['before_widget'] );

		if ( $title ) {
			echo html_entity_decode( $args['before_title'] . $title . $args['after_title'] );
		}
		$crousel_id = rand(0,999);
		
		if( $qry->have_posts() ) {
			?>
			<div id="trending-widget-<?php echo esc_attr($crousel_id); ?>" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					<?php
					$i = 1;
					while ( $qry->have_posts() ) : $qry->the_post();
						if($i == 1){
							$act_css = " active";
						}
						else {
							$act_css = "";
						}
						?>
						<div class="carousel-item<?php echo esc_attr($act_css); ?>">
							<div class="trnd-post-box">
								<?php
									if( get_post_format() == "audio" && 
										( get_post_meta( get_the_ID(), 'minimag_cf_post_soundcloud_url', 1 ) != "" ||
										get_post_meta( get_the_ID(), 'minimag_cf_post_audio_local', 1 ) != "" ||
										get_post_meta( get_the_ID(), 'minimag_cf_post_soundcloud_iframe',1 ) != "" )
										
									) {
										?>
										<div class="post-cover">
											<?php
												if( get_post_meta( get_the_ID(), 'minimag_cf_post_audio_source', 1 ) == "soundcloud_link" && get_post_meta( get_the_ID(), 'minimag_cf_post_soundcloud_url', 1 ) != "" ) {
													?>
													<iframe src="<?php echo esc_url( get_post_meta( get_the_ID(), 'minimag_cf_post_soundcloud_url', 1 ) ); ?>"></iframe>
													<?php
												}
												elseif( get_post_meta( get_the_ID(), 'minimag_cf_post_audio_source', 1 ) == "soundcloud_iframe" && get_post_meta( get_the_ID(), 'minimag_cf_post_soundcloud_iframe', 1 ) != "" ) {
													echo get_post_meta( get_the_ID(), 'minimag_cf_post_soundcloud_iframe', 1 );
												}
												elseif( get_post_meta( get_the_ID(), 'minimag_cf_post_audio_source', 1 ) == "audio_upload_local" && get_post_meta( get_the_ID(), 'minimag_cf_post_audio_local', 1 ) != "" ) {
													?>
													<audio controls>
														<source src="<?php echo esc_url( get_post_meta( get_the_ID(), 'minimag_cf_post_audio_local', 1 ) ); ?>" type="audio/mpeg">
														<?php esc_html_e("Your browser does not support the audio element.","minimag-toolkit"); ?>
													</audio>
													<?php
												}
											?>
										</div>
										<?php
									}
									if( get_post_format() == "video" ) {
										?>
										<div class="post-cover">
											<?php
												if( get_post_meta( get_the_ID(), 'minimag_cf_post_video_source', 1 ) == "video_link" && get_post_meta( get_the_ID(), 'minimag_cf_post_video_link', 1 ) != "" ) {
													echo wp_oembed_get( esc_url( get_post_meta( get_the_ID(), 'minimag_cf_post_video_link', true ) ) );
												}
												elseif( get_post_meta( get_the_ID(), 'minimag_cf_post_video_source', 1 ) == "video_embed_code" && get_post_meta( get_the_ID(), 'minimag_cf_post_video_embed', 1 ) != "" ) {
													echo get_post_meta( get_the_ID(), 'minimag_cf_post_video_embed', 1 );
												}
												elseif( get_post_meta( get_the_ID(), 'minimag_cf_post_video_source', 1 ) == "video_upload_local" && get_post_meta( get_the_ID(), 'minimag_cf_post_video_local', 1 ) != "" ) {
													?>
													<video controls>
														<source src="<?php echo esc_url( get_post_meta( get_the_ID(), 'minimag_cf_post_video_local', 1 ) ); ?>" type="video/mp4">
														<?php esc_html_e("Your browser does not support the video tag.","minimag-toolkit"); ?>
													</video> 
													<?php			
												}
											?>
										</div>
										<?php
									}
									if( has_post_thumbnail() && ( get_post_format() != "audio" && get_post_format() != "video" ) ) {
										?>
										<div class="post-cover">
											<a href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail('minimag_345_230'); ?>
											</a>
										</div>
										<?php
									}
								?>
								<span class="post-category"><?php the_category( ' , ' ); ?></span>
								<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							</div>
						</div>
						<?php
					$i++;
					endwhile;
					?>
				</div>
				<ol class="carousel-indicators">
					<?php
						for( $j=0; $j < $qry->post_count; $j++ ) {
						?><li data-target="#trending-widget-<?php echo esc_attr($crousel_id); ?>" data-slide-to="<?php echo esc_attr( $j ); ?>"<?php if( $j == 0 ) { echo ' class="active"'; } ?>></li><?php
					}
					?>
				</ol>
			</div>
			<?php
		}
		
		echo html_entity_decode( $args['after_widget'] );

		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];

		return $instance;
	}

	public function form( $instance ) {

		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 3;
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', "minimag-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', "minimag-toolkit" ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" />
		</p>
		<?php
	}
}
?>
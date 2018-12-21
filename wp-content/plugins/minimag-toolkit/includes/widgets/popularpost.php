<?php
/**
 * PopularPost widget class Minimag
 *
 * @since 2.8.0
 */
class Minimag_Widget_PopularPost extends WP_Widget {

	public function __construct() {

		$widget_ops = array( 'classname' => 'widget_latestposts', 'description' => esc_html__( "", "minimag-toolkit" ) );

		parent::__construct('widget_latestposts', esc_html__('Minimag :: Popular Posts', "minimag-toolkit"), $widget_ops);

		$this->alt_option_name = 'widget_latestposts';
	}

	public function widget($args, $instance) {

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Popular Posts', "minimag-toolkit" );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 4;

		if ( ! $number ) {
			$number = 4;
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
		
		if( $qry->have_posts() ) {
			
			while ( $qry->have_posts() ) : $qry->the_post();
				
				$css_class = "";
				
				if( !has_post_thumbnail() ) { 
					$css_class = " no-post-thumb";
				}
				else {
					$css_class = "";
				}
				?>
				<div class="latest-content<?php echo esc_attr($css_class); ?>">
					<?php
						if( has_post_thumbnail() ) {
							?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<i><?php the_post_thumbnail('minimag_100_80'); ?></i>
							</a>
							<?php
						}
					?>
					<h5><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
					<span><a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a></span>
				</div>
				<?php
			endwhile;
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
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 4;
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', "minimag-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', "minimag-toolkit" ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="4" />
		</p>
		<?php
	}
}
?>
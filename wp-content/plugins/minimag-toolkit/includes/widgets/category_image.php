<?php
/**
 * CategoryImage widget class Minimag
 *
 * @since 2.8.0
 */
class Minimag_Widget_CategoryImage extends WP_Widget {

	public function __construct() {

		$widget_ops = array( 'classname' => 'widget_categories2', 'description' => esc_html__( "", "minimag-toolkit" ) );

		parent::__construct('widget_categories2', esc_html__('Minimag :: Categories With Image', "minimag-toolkit"), $widget_ops);

		$this->alt_option_name = 'widget_categories2';
	}

	public function widget($args, $instance) {

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Categories', "minimag-toolkit" );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 4;

		if ( ! $number ) {
			$number = 4;
		}

		$catargs = array(
			'number' 	=> $number,
		);

		echo html_entity_decode( $args['before_widget'] );

		if ( $title ) {
			echo html_entity_decode( $args['before_title'] . $title . $args['after_title'] );
		}
		
		?>
		<div class="categories-box">
			<ul>
				<?php
				// retrieves an array of categories or taxonomy terms
				$cats = get_categories();
				foreach($cats as $cat) {
					if( get_term_meta($cat->term_id, 'minimag_term_cat_image_id', true ) != "" ) {
						?>
						<li>
							<a href="<?php echo get_term_link($cat); ?>">
								<?php echo wp_get_attachment_image( get_term_meta($cat->term_id, 'minimag_term_cat_image_id', true ), "minimag_345_80" ); ?>
								<span><?php echo $cat->name; ?></span>
							</a>
						</li>
						<?php
					}
				}
				?>
			</ul>
		</div>
		<?php
		
		echo html_entity_decode( $args['after_widget'] );
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
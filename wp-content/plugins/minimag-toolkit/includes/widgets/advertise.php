<?php
/**
 * Advertiser widget class Minimag
 *
 * @since 2.8.0
 */
class Minimag_Widget_Advertise extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'classname' => 'widget_advertise', 'description' => esc_html__( "", "minimag-toolkit" ) );
		
		parent::__construct('widget_advertise', esc_html('Minimag :: Advertisement', "minimag-toolkit"), $widget_ops);
		
		$this->alt_option_name = 'widget_advertise';
	}

	public function widget( $args, $instance ) {
		
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( '', "minimag-toolkit" );
		
		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$adver_img = ( ! empty( $instance['adver_img'] ) ) ? esc_url( $instance['adver_img'] ) : "";
		$add_url = ( ! empty( $instance['add_url'] ) ) ? esc_attr( $instance['add_url'] ) : "";
		$add_title = ( ! empty( $instance['add_title'] ) ) ? esc_attr( $instance['add_title'] ) : "";
		$subtitle = ( ! empty( $instance['subtitle'] ) ) ? esc_attr( $instance['subtitle'] ) : "";
		
		echo html_entity_decode( $args['before_widget'] );

		if ( $title ) {
			echo html_entity_decode( $args['before_title'] . $title . $args['after_title'] );
		}
		
		?>
		<div class="advertise-content">
			<?php
			if( $add_url != "" && $adver_img != "" ) {
				?>
				<a href="<?php echo esc_url($add_url); ?>" target="_blank">
					<img src="<?php echo esc_url($adver_img); ?>" alt="">
				</a>
				<?php
			}
			elseif($adver_img != "") {
				?><img src="<?php echo esc_url($adver_img); ?>" alt=""><?php
			}
			if($add_title != "" && $subtitle != "") {
				?>
				<div class="advertise-inner">
					<?php if($add_title != "") { ?><h3><?php echo esc_attr($add_title); ?></h3><?php } ?>
					<?php if($subtitle != "") { ?><p><?php echo esc_attr($subtitle); ?></p><?php } ?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
		echo html_entity_decode( $args['after_widget'] );
	}

	public function form( $instance ) {
		$instance = wp_parse_args( ( array ) $instance, array( 'title' => '','adver_img' => '','adver_img' => '' ) );

		$title	=	isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : "";
		$add_title	=	isset( $instance['add_title'] ) ? esc_attr( $instance['add_title'] ) : "";
		$subtitle	=	isset( $instance['subtitle'] ) ? esc_attr( $instance['subtitle'] ) : "";
		$add_url	=	isset( $instance['add_url'] ) ? esc_attr( $instance['add_url'] ) : "";
		$adver_img	=	isset( $instance['adver_img'] ) ? esc_url( $instance['adver_img'] ) : "";
		
		?>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Widget Title:', "minimag-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_url( $this->get_field_id('adver_img') ); ?>"><?php esc_html_e('Advertisement Image', "minimag-toolkit"); ?></label>
			<input type="text" class="widefat custom_media_url" name="<?php echo esc_attr( $this->get_field_name('adver_img') ); ?>" id="<?php echo esc_attr( $this->get_field_name('adver_img') ); ?>" value="<?php echo esc_url( $instance['adver_img'] ); ?>">
			<input type="button" value="<?php esc_html_e( 'Upload Image', "minimag-toolkit" ); ?>" class="button custom_media_upload" id="custom_image_uploader"/>
			<?php
            if ( $adver_img != "" ) {
				?>
				<div class="custom_media_image">
					<img class="custom_media_image image_upload" src="<?php echo esc_url($adver_img); ?>" alt="">
				</div>
				<?php
			}
			?>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'add_title' ) ); ?>"><?php esc_html_e( 'Title:', "minimag-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'add_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'add_title' ) ); ?>" type="text" value="<?php echo esc_attr( $add_title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>"><?php esc_html_e( 'Sub Title:', "minimag-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'subtitle' ) ); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'add_url' ) ); ?>"><?php esc_html_e( 'Advertiser URL:', "minimag-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'add_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'add_url' ) ); ?>" type="text" value="<?php echo esc_attr( $add_url ); ?>" />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['add_title'] = strip_tags( $new_instance['add_title'] );
		$instance['subtitle'] = strip_tags( $new_instance['subtitle'] );
		$instance['add_url'] = strip_tags( $new_instance['add_url'] );
		$instance['adver_img'] = strip_tags( $new_instance['adver_img'] );
		
		return $instance;
	}
}
?>
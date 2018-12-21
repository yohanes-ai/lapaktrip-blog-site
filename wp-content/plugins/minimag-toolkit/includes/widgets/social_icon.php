<?php
/**
 * Social Icon widget class Hory
 *
 * @since 2.8.0
 */
class Minimag_Widget_SocialIcon extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'classname' => 'widget_social', 'description' => esc_html__( "", "minimag-toolkitt" ) );
		
		parent::__construct('widget-social', esc_html('Minimag :: Social Icon', "minimag-toolkitt"), $widget_ops);
		
		$this->alt_option_name = 'widget_social';
	}

	public function widget( $args, $instance ) {
		
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Follow Us', "minimag-toolkitt" );
		
		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		
		$fb = ( ! empty( $instance['fb'] ) ) ? esc_url( $instance['fb'] ) : "";
		$tw = ( ! empty( $instance['tw'] ) ) ? esc_url( $instance['tw'] ) : "";
		$gp = ( ! empty( $instance['gp'] ) ) ? esc_url( $instance['gp'] ) : "";
		$lnk = ( ! empty( $instance['lnk'] ) ) ? esc_url( $instance['lnk'] ) : "";
		$ytb = ( ! empty( $instance['ytb'] ) ) ? esc_url( $instance['ytb'] ) : "";
		$ins = ( ! empty( $instance['ins'] ) ) ? esc_url( $instance['ins'] ) : "";
		$sky = ( ! empty( $instance['sky'] ) ) ? esc_attr( $instance['sky'] ) : "";
		$pint = ( ! empty( $instance['pint'] ) ) ? esc_url( $instance['pint'] ) : "";
		$flk = ( ! empty( $instance['flk'] ) ) ? esc_url( $instance['flk'] ) : "";
		$tub = ( ! empty( $instance['tub'] ) ) ? esc_url( $instance['tub'] ) : "";
		$digg = ( ! empty( $instance['digg'] ) ) ? esc_url( $instance['digg'] ) : "";
		$reddit = ( ! empty( $instance['reddit'] ) ) ? esc_url( $instance['reddit'] ) : "";

		echo html_entity_decode( $args['before_widget'] );

		if ( $title ) {
			echo html_entity_decode( $args['before_title'] . $title . $args['after_title'] );
		}
		
		if( $fb != "" ||
			$tw != "" ||
			$gp != "" ||
			$lnk != "" ||
			$ytb != "" ||
			$ins != "" ||
			$sky != "" ||
			$pint != "" ||
			$flk != "" ||
			$tub != "" ||
			$digg != "" ||
			$reddit != "" ){
			?>
			<ul>
				<?php if( $fb != "" ) { ?><li><a href="<?php echo esc_url( $fb ); ?>" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li><?php } ?>
				<?php if( $tw != "" ) { ?><li><a href="<?php echo esc_url( $tw ); ?>" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li><?php } ?>
				<?php if( $gp != "" ) { ?><li><a href="<?php echo esc_url( $gp ); ?>" target="_blank" title="Google+"><i class="fa fa-google-plus"></i></a></li><?php } ?>
				<?php if( $lnk != "" ) { ?><li><a href="<?php echo esc_url( $lnk ); ?>" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li><?php } ?>
				<?php if( $ytb != "" ) { ?><li><a href="<?php echo esc_url( $ytb ); ?>" target="_blank" title="Youtube"><i class="fa fa-youtube"></i></a></li><?php } ?>
				<?php if( $ins != "" ) { ?><li><a href="<?php echo esc_url( $ins ); ?>" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a></li><?php } ?>
				<?php if( $sky != "" ) { ?><li><a href="skype:<?php echo esc_attr( $sky ); ?>?userinfo" title="Skype"><i class="fa fa-skype"></i></a></li><?php } ?>
				<?php if( $pint != "" ) { ?><li><a href="<?php echo esc_url( $pint ); ?>" target="_blank" title="Pinterst"><i class="fa fa-pinterest-p"></i></a></li><?php } ?>
				<?php if( $flk != "" ) { ?><li><a href="<?php echo esc_url( $flk ); ?>" target="_blank" title="Flickr"><i class="fa fa-flickr"></i></a></li><?php } ?>
				<?php if( $tub != "" ) { ?><li><a href="<?php echo esc_url( $tub ); ?>" target="_blank" title="Tumblr"><i class="fa fa-tumblr"></i></a></li><?php } ?>
				<?php if( $digg != "" ) { ?><li><a href="<?php echo esc_url( $digg ); ?>" target="_blank" title="Digg"><i class="fa fa-digg"></i></a></li><?php } ?>
				<?php if( $reddit != "" ) { ?><li><a href="<?php echo esc_url( $reddit ); ?>" target="_blank" title="Reddit"><i class="fa fa-reddit"></i></a></li><?php } ?>
			</ul>
			<?php
		}
		echo html_entity_decode( $args['after_widget'] );
	}

	public function form( $instance ) {
		
		$title	=	isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : "";
		
		$fb = isset( $instance['fb'] ) ? esc_url( $instance['fb'] ) : "";
		$tw = isset( $instance['tw'] ) ? esc_url( $instance['tw'] ) : "";
		$gp = isset( $instance['gp'] ) ? esc_url( $instance['gp'] ) : "";
		$lnk = isset( $instance['lnk'] ) ? esc_url( $instance['lnk'] ) : "";
		$ytb = isset( $instance['ytb'] ) ? esc_url( $instance['ytb'] ) : "";
		$ins = isset( $instance['ins'] ) ? esc_url( $instance['ins'] ) : "";
		$sky = isset( $instance['sky'] ) ? esc_attr( $instance['sky'] ) : "";
		$pint = isset( $instance['pint'] ) ? esc_url( $instance['pint'] ) : "";
		$flk = isset( $instance['flk'] ) ? esc_url( $instance['flk'] ) : "";
		$tub = isset( $instance['tub'] ) ? esc_url( $instance['tub'] ) : "";
		$digg = isset( $instance['digg'] ) ? esc_url( $instance['digg'] ) : "";
		$reddit = isset( $instance['reddit'] ) ? esc_url( $instance['reddit'] ) : "";
		?>		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Widget Title:', "minimag-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'fb' ) ); ?>"><?php esc_html_e( 'Facebook URL:', "minimag-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'fb' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'fb' ) ); ?>" type="text" value="<?php echo esc_attr( $fb ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'tw' ) ); ?>"><?php esc_html_e( 'Twitter URL:', "minimag-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tw' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tw' ) ); ?>" type="text" value="<?php echo esc_attr( $tw ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'gp' ) ); ?>"><?php esc_html_e( 'Google+ URL:', "minimag-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'gp' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'gp' ) ); ?>" type="text" value="<?php echo esc_attr( $gp ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'lnk' ) ); ?>"><?php esc_html_e( 'Linkedin URL:', "minimag-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'lnk' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'lnk' ) ); ?>" type="text" value="<?php echo esc_attr( $lnk ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'ytb' ) ); ?>"><?php esc_html_e( 'YouTube URL:', "minimag-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ytb' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ytb' ) ); ?>" type="text" value="<?php echo esc_attr( $ytb ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'ins' ) ); ?>"><?php esc_html_e( 'Instagram URL:', "minimag-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ins' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ins' ) ); ?>" type="text" value="<?php echo esc_attr( $ins ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'sky' ) ); ?>"><?php esc_html_e( 'Skype Username:', "minimag-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'sky' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'sky' ) ); ?>" type="text" value="<?php echo esc_attr( $sky ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'pint' ) ); ?>"><?php esc_html_e( 'Pinterst URL:', "minimag-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pint' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pint' ) ); ?>" type="text" value="<?php echo esc_attr( $pint ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'flk' ) ); ?>"><?php esc_html_e( 'Flickr URL:', "minimag-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'flk' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'flk' ) ); ?>" type="text" value="<?php echo esc_attr( $flk ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'tub' ) ); ?>"><?php esc_html_e( 'Tumblr URL:', "minimag-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tub' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tub' ) ); ?>" type="text" value="<?php echo esc_attr( $tub ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'digg' ) ); ?>"><?php esc_html_e( 'Digg URL:', "minimag-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'digg' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'digg' ) ); ?>" type="text" value="<?php echo esc_attr( $digg ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'reddit' ) ); ?>"><?php esc_html_e( 'Reddit URL:', "minimag-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'reddit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'reddit' ) ); ?>" type="text" value="<?php echo esc_attr( $reddit ); ?>" />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		
		$instance['fb'] = strip_tags( $new_instance['fb'] );
		$instance['tw'] = strip_tags( $new_instance['tw'] );
		$instance['gp'] = strip_tags( $new_instance['gp'] );
		$instance['lnk'] = strip_tags( $new_instance['lnk'] );
		$instance['ytb'] = strip_tags( $new_instance['ytb'] );
		$instance['ins'] = strip_tags( $new_instance['ins'] );
		$instance['sky'] = strip_tags( $new_instance['sky'] );
		$instance['pint'] = strip_tags( $new_instance['pint'] );
		$instance['flk'] = strip_tags( $new_instance['flk'] );
		$instance['tub'] = strip_tags( $new_instance['tub'] );
		$instance['digg'] = strip_tags( $new_instance['digg'] );
		$instance['reddit'] = strip_tags( $new_instance['reddit'] );
		
		return $instance;
	}
}
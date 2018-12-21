<?php
	
	$insta_gallery = minimag_options('opt_instagram');
	$user_name = minimag_options('opt_insta_user');

	if( minimag_options("opt_insta_image") != "" ) {
		$show_image =  minimag_options("opt_insta_image");
	}
	else {
		$show_image = "6";
	}
	
	if( $user_name != "" && $insta_gallery == '1' ) {
		?>
		<!-- Instagram -->
		<div class="container-fluid no-left-padding no-right-padding instagram-block">
			<?php
			if( !function_exists('minimagscrape_insta') ) {
				function minimagscrape_insta($user_name) {
					$insta_source = wp_remote_get( 'https://instagram.com/'.trim( $user_name ) );
					if ( is_wp_error( $insta_source ) ) {
						esc_html__( 'Unable to communicate with Instagram.', 'minimag' );
					}
					else {
						$shards = explode('window._sharedData = ', $insta_source['body']);
						$insta_json = explode(';</script>', $shards[1]); 
						$insta_array = json_decode($insta_json[0], TRUE);
						return $insta_array;
					}
				}
			}
			
			$results_array = minimagscrape_insta($user_name);
			
			if( is_array( $results_array ) && !empty( $results_array ) ) {
				?>
				<ul class="instagram-carousel" data-items="<?php echo esc_attr($show_image); ?>">
					<?php
					
					$latest_array = $results_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];
					
					$media_array = array_slice( $latest_array, 0, $show_image );
					
					if( is_array( $media_array ) && !empty( $media_array ) ) {
						
						foreach( $media_array as $item ) {
							?>
							<li><a href="https://instagram.com/p/<?php echo esc_attr( $item['node']['shortcode'] );?>" target="_blank"><img src="<?php echo esc_url( $item['node']['thumbnail_src'] ); ?>" alt="<?php echo esc_attr( $item['node']['shortcode'] ); ?>"></a></li>
							<?php
						}
					} ?>
				</ul>
				<?php
			} ?>
		</div><!-- Instagram /- -->
		<?php
	}
?>
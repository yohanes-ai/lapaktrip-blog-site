<?php
$ftrsocial_icons = "";
$ftrsocial_icons = minimag_options("opt_ftrsocial_icons");
if( $ftrsocial_icons != "" ) {
	?><ul class="ftr-social"><?php
	foreach( $ftrsocial_icons as $single_item ) {
		if( $single_item["textOne"] != "" ) {
			?>
			<li>
				<a href="<?php echo esc_url( $single_item["url"] ); ?>" target="_blank"><i class="<?php echo esc_attr( $single_item["textOne"] ); ?>"></i><?php echo esc_attr( $single_item["title"] ); ?></a>
			</li>
			<?php 
		}
	}
	?></ul><?php
}
?>
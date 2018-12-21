<?php
$plogo = $limg = $lsitetitle = $lcustomtxt = $logohw = $logow_s = "";

$plogo = get_post_meta( minimag_get_the_ID(), "minimag_cf_custom_logo", true );
$limg = minimag_options('opt_logoimg','url');
$lsitetitle = get_bloginfo('name');
$lcustomtxt = minimag_options('opt_customtxt');

$logoh = minimag_options('opt_logo_size',"height");

$logow = minimag_options('opt_logo_size',"width");

$logoh_s = "";
if( $logoh != "" && $logoh != "px") {
	$logoh_s = 'max-height: '.$logoh.';';
}

$logow_s = "";
if( $logow != "" && $logow != "px" ) {
	$logow_s = 'max-width: '.$logow.';';
}

if( $logoh != "" && $logoh != "px" || ( $logow != "" && $logow != "px" ) ) {
	$logohw = ' style="'.$logoh_s.$logow_s.'"';
}

if( $plogo != "" ) { 
	?>
	<a class="image-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<img src="<?php echo esc_url( $plogo ); ?>" alt=""<?php echo html_entity_decode( $logohw ); ?>/>
	</a>
	<?php
}
elseif( minimag_options('opt_logotype') == "2" && $limg != "" ) { // Logo - Image
	?>
	<a class="image-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<img src="<?php echo esc_url( $limg ); ?>" alt=""<?php echo html_entity_decode( $logohw ); ?>/>
	</a>
	<?php
}
elseif( minimag_options('opt_logotype') == "1" && $lsitetitle != "" ) { // Logo - Site Title
	?>
	<a class="text-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo get_bloginfo( $lsitetitle ); ?></a>
	<?php
}
elseif( minimag_options('opt_logotype') == "3" && $lcustomtxt != "" ) { // Logo - Custom Text
	?>
	<a class="text-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php echo esc_attr( $lcustomtxt ); ?>
	</a>
	<?php
} 
else {
	?>
	<a class="image-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<img src="<?php echo esc_url( MINIMAG_IMGURI ); ?>/logo.png" alt=""<?php echo html_entity_decode( $logohw ); ?>/>
	</a>
	<?php
}
?>
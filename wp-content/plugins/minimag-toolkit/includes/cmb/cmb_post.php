<?php
// Start with an underscore to hide fields from custom fields list
$prefix = 'minimag_cf_';

$cmb_post_option = new_cmb2_box( array(
	'id'            => $prefix . 'cmb_post_option',
	'title'         => esc_html__( 'Post Options', "minimag-toolkit" ),
	'object_types'  => array( 'post' ), // Post type
	'context'       => 'normal',
	'priority'      => 'high',
	'show_names'    => true, // Show field names on the left
) );

$cmb_post_option->add_field( array(
	'name'             => 'Layout',
	'desc'             => 'Select an option',
	'id'               => $prefix . 'single_content',
	'type'             => 'select',
	'options'          => array(
		'' => esc_html__( 'Select Options', "minimag-toolkit" ),
		'1' => esc_html__( 'Layout 1', "minimag-toolkit" ),
		'2'   => esc_html__( 'Layout 2', "minimag-toolkit" ),
		'3'   => esc_html__( 'Layout 3', "minimag-toolkit" ),
		'4'   => esc_html__( 'Layout 4', "minimag-toolkit" ),
	),
) );;

/* Post : Gallery */
$cmb_post_gallery = new_cmb2_box( array(
	'id'            => $prefix . 'metabox_post_gallery',
	'title'         => esc_html__( 'Gallery Post Options', "minimag-toolkit" ),
	'object_types'  => array( 'post' ), // Post type
	'context'       => 'normal',
	'priority'      => 'high',
	'show_names'    => true, // Show field names on the left
) );

$cmb_post_gallery->add_field( array(
	'name' => esc_html__( 'Post Gallery', 'minimag-toolkit' ),
	'id'   => $prefix . 'post_gallery',
	'type' => 'file_list',
) );

/* Post : Video */
$cmb_post_video = new_cmb2_box( array(
	'id'            => $prefix . 'metabox_post_video',
	'title'         => esc_html__( 'Video Post Options', "minimag-toolkit" ),
	'object_types'  => array( 'post' ), // Post type
	'context'       => 'normal',
	'priority'      => 'high',
	'show_names'    => true, // Show field names on the left
) );

$cmb_post_video->add_field( array(
	'name'             => 'Choose Video Source',
	'desc'             => 'Select an option',
	'id'               => $prefix . 'post_video_source',
	'type'             => 'select',
	'default'          => 'video_link',
	'options'          => array(
		'video_link' => esc_html__( 'Video Link', "minimag-toolkit" ),
		'video_embed_code'   => esc_html__( 'Video Embed Code', "minimag-toolkit" ),
		'video_upload_local'   => esc_html__( 'Upload Local File', "minimag-toolkit" ),
	),
) );

$cmb_post_video->add_field( array(
	'name'             => 'Video URL',
	'id'               => $prefix . 'post_video_link',
	'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
	'type' => 'oembed',
) );

$cmb_post_video->add_field( array(
	'name'             => 'Video embed code',
	'id'               => $prefix . 'post_video_embed',
	'desc'               => 'Paste video embed code',
	'type'             => 'textarea_code',
) );

$cmb_post_video->add_field( array(
	'name'             => 'Upload Local File',
	'id'               => $prefix . 'post_video_local',
	'desc'               => 'Support .mp4 file format only',
	'type'             => 'file',
) );

/* Post : Gallery */
$cmb_post_gallery = new_cmb2_box( array(
	'id'            => $prefix . 'metabox_post_gallery',
	'title'         => esc_html__( 'Gallery Post Options', "minimag-toolkit" ),
	'object_types'  => array( 'post' ), // Post type
	'context'       => 'normal',
	'priority'      => 'high',
	'show_names'    => true, // Show field names on the left
) );

$cmb_post_gallery->add_field( array(
	'name' => esc_html__( 'Post Gallery', 'minimag-toolkit' ),
	'id'   => $prefix . 'post_gallery',
	'type' => 'file_list',
) );

/* Post : Audio */
$cmb_post_audio = new_cmb2_box( array(
	'id'            => $prefix . 'metabox_post_audio',
	'title'         => esc_html__( 'Audio Post Options', "minimag-toolkit" ),
	'object_types'  => array( 'post' ), // Post type
	'context'       => 'normal',
	'priority'      => 'high',
	'show_names'    => true, // Show field names on the left
) );

$cmb_post_audio->add_field( array(
	'name'             => 'Choose Audio Source',
	'desc'             => 'Select an option',
	'id'               => $prefix . 'post_audio_source',
	'type'             => 'select',
	'default'          => 'soundcloud_link',
	'options'          => array(
		'soundcloud_link' => esc_html__( 'Soundcloud Link', "minimag-toolkit" ),
		'soundcloud_iframe' => esc_html__( 'Soundcloud Iframe', "minimag-toolkit" ),
		'audio_upload_local'   => esc_html__( 'Upload Local File', "minimag-toolkit" ),
	),
) );

$cmb_post_audio->add_field( array(
	'name'             => 'Soundcloud URL',
	'id'               => $prefix . 'post_soundcloud_url',
	'type'             => 'textarea_code',
) );

$cmb_post_audio->add_field( array(
	'name'             => 'Soundcloud Iframe',
	'id'               => $prefix . 'post_soundcloud_iframe',
	'type'             => 'textarea_code',
) );

$cmb_post_audio->add_field( array(
	'name'             => 'Upload Local File',
	'id'               => $prefix . 'post_audio_local',
	'desc'               => 'Support .mp3 file format only',
	'type'             => 'file',
) );
?>
<?php
$link_before = $after_link = $image = $thim_animation = $images_size = '';
$src         = wp_get_attachment_image_src( $instance['image'], $instance['image_size'] );

$text_align = ( isset( $instance['image_alignment'] ) && '' != $instance['image_alignment'] ) ? 'text-' . $instance['image_alignment'] : '';

$thim_animation .= thim_getCSSAnimation( $instance['css_animation'] );

if ( $src ) {
	if ( strpos( $instance['image_size'], 'x' ) ) {
		$size = explode( 'x', $instance['image_size'] );
		echo thim_get_feature_image( $instance['image'], 'full', $size[0], $size[1] );
	} else {
		$images_size = @getimagesize( $src['0'] );
		$image       = '<img src ="' . $src['0'] . '" ' . $images_size['3'] . ' alt=""/>';
	}
}
if ( $instance['image_link'] ) {
	$link_before = '<a href="' . $instance['image_link'] . '" target="' . $instance['link_target'] . '">';
	$after_link  = "</a>";
}
echo '<div class="single-image ' . $text_align . '">' . $link_before . $image . $after_link . '</div>';
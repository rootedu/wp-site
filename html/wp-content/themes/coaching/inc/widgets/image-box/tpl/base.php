<?php
$title    = $instance['title'] ? $instance['title'] : '';
$subtitle = $instance['subtitle'] ? $instance['subtitle'] : '';
$link     = $instance['link'] ? $instance['link'] : '';
$img      = $instance['image_box'] ? $instance['image_box'] : '';
$html     = '';

if ( $title ) {
	if ( $subtitle ) {
		$title = $subtitle . '<span>' . $title . '</span>';
	}
	$title = '<div class="thim-image-title"><a href="' . $link . '">' . $title . '</a></div>';
}
if ( $img ) {
	$img = thim_get_feature_image( $img );
}
$html = '<div class="thim-image-box">' . $img . $title . '</div>';
echo $html;
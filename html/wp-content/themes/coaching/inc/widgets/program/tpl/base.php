<?php

$title    = $instance['title'] ? $instance['title'] : '';
$programs = $instance['program'] ? $instance['program'] : '';
$text_align = '';
if($instance['text_align'] && $instance['text_align'] <> ''){
	$text_align = $instance['text_align'];
}

if ( empty( $programs ) ) {
	return;
}
?>

<div class="thim_program_container">
	<div class="thim_program <?php echo $text_align;?> row">
		<?php
		if ( $title != '' ) {
			echo '<h3 class="widget-title">' . $title . '</h3>';
		}
		?>

		<?php foreach ( $programs as $key => $program )  : ?>
			<?php
			$program_title = $program['program_title'];
			$program_link  = $program['program_link'];

            if ( thim_plugin_active( 'elementor/elementor.php' ) ) {
                $program_image = $program['program_image']['id'];
            } else {
                $program_image = $program['program_image'];
            }
			?>
			<div class="item-program col-sm-4">
				<a href="<?php echo esc_url( $program_link ); ?>">
				<div class="image-program">
					<?php echo thim_get_feature_image( $program_image, 'full', '370', '420', get_the_title() ); ?>
					<div class="title-program">
						<a href="<?php echo esc_url( $program_link ); ?>"><?php echo esc_html( $program_title ); ?></a>
					</div>
				</div>
				</a>
			</div>
		<?php endforeach ?>
	</div>
</div>





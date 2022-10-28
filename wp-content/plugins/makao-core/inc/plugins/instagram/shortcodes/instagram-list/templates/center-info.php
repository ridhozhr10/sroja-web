<?php
$button_params = array(
	'button_layout' => 'outlined',
	'link'          => $button_link,
	'text'          => $button_text
);
?>

<div class="qodef-instagram-center-info">
	<?php if ( !empty($subtitle) ) : ?>
		<h6 class="qodef-instagram-ic-subtitle"><?php echo esc_html( $subtitle ); ?></h6>
	<?php endif; ?>
	<?php if ( !empty($title) ) : ?>
		<h2 class="qodef-instagram-ic-title"><?php echo esc_html( $title ); ?></h2>
	<?php endif; ?>
	
	<?php if ( class_exists( 'MakaoCoreButtonShortcode' ) && !empty($button_text) ) { ?>
		<div class="qodef-m-button">
			<?php echo MakaoCoreButtonShortcode::call_shortcode( $button_params ); ?>
		</div>
	<?php } ?>
</div>
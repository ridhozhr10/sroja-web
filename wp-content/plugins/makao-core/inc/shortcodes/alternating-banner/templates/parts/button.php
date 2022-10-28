<?php
$button_params = array(
	'button_layout' => $button_type,
	'link'          => $link_url,
	'target'        => $link_target,
	'text'          => $button_text
);
?>

<?php if ( class_exists( 'MakaoCoreButtonShortcode' ) && ! empty( $button_text ) ) { ?>
	<div class="qodef-m-button">
		<?php echo MakaoCoreButtonShortcode::call_shortcode( $button_params ); ?>
	</div>
<?php } ?>
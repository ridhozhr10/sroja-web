<?php
$subtitle_styles = array();
if ( ! empty( $item_subtitle_color ) ) {
	$subtitle_styles[] = 'color: ' . $item_subtitle_color;
}
?>

<?php if ( ! empty( $item_subtitle ) ) : ?>
	<?php echo '<' . esc_attr( $item_subtitle_tag ); ?> class="qodef-m-subtitle" <?php qode_framework_inline_style( $subtitle_styles ); ?>>
	<?php echo esc_html( $item_subtitle ); ?>
	<?php echo '</' . esc_attr( $item_subtitle_tag ); ?>>
<?php endif; ?>
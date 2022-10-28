<?php
$title_styles = array();
if ( ! empty( $item_title_color ) ) {
	$title_styles[] = 'color: ' . $item_title_color;
}
?>

<?php if ( ! empty( $item_title ) ) : ?>
	<?php echo '<' . esc_attr( $item_title_tag ); ?> class="qodef-m-title" <?php qode_framework_inline_style( $title_styles ); ?>>
	<?php echo esc_html( $item_title ); ?>
	<?php echo '</' . esc_attr( $item_title_tag ); ?>>
<?php endif; ?>
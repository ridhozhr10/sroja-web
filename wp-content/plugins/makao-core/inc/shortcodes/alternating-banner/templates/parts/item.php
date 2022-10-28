<?php
$item_classes = '';
if( !empty($image_position) ) {
	$item_classes = 'qodef-ab-image-' . $image_position;
}
if( empty( $button_text ) ){
    $item_classes .= ' qodef-ab-without-button';
}
?>

<div class="qodef-alternating-banner-item <?php echo esc_attr($item_classes); ?>">
	<?php makao_core_template_part( 'shortcodes/alternating-banner', 'templates/parts/image', '', $params ) ?>
	<div class="qodef-m-content">
		<div class="qodef-m-content-inner">
			<?php makao_core_template_part( 'shortcodes/alternating-banner', 'templates/parts/subtitle', '', $params ) ?>
			<?php makao_core_template_part( 'shortcodes/alternating-banner', 'templates/parts/title', '', $params ) ?>
			<?php makao_core_template_part( 'shortcodes/alternating-banner', 'templates/parts/text', '', $params ) ?>
			<?php makao_core_template_part( 'shortcodes/alternating-banner', 'templates/parts/button', '', $params ) ?>
		</div>
        <?php if( empty( $button_text ) && ! empty( $link_url ) ){ ?>
            <a itemprop="url" class="qodef-ab-content-link-overlay" href="<?php echo esc_url( $link_url ) ?>" target="<?php echo esc_attr( $link_target )?>"></a>
        <?php } ?>
	</div>
</div>
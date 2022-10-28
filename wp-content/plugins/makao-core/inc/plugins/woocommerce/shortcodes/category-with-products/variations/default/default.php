<?php
$button_link = !empty($category_slug) ? get_term_link( $category_slug, 'product_cat' ) : '#';
$button_params = array(
	'button_layout' => 'textual',
	'link'          => $button_link,
	'text'          => esc_html__( 'Shop Here', 'makao-core' )
);
?>

<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-woo-category-holder">
		<?php makao_core_template_part( 'plugins/woocommerce/shortcodes/category-with-products', 'templates/post-info/image', '', $params ); ?>
		<div class="qodef-woo-category-holder-inner">
			<?php makao_core_template_part( 'plugins/woocommerce/shortcodes/category-with-products', 'templates/post-info/title', '', $params ); ?>
			<?php echo MakaoCoreButtonShortcode::call_shortcode( $button_params ); ?>
		</div>
	</div>
	<div class="qodef-woo-products-holder">
		<?php makao_core_template_part( 'plugins/woocommerce/shortcodes/category-with-products', 'templates/post-info/product-list', '', $params ); ?>
	</div>
</div>
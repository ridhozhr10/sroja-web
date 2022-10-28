<?php
$button_link = !empty($category_slug) ? get_term_link( $category_slug, 'product_cat' ) : '#';
$button_text = !empty($button_text) ? $button_text : 'Learn More';
$button_params = array(
	'button_layout' => 'textual',
	'link'          => $button_link,
	'text'          => esc_html__( $button_text, 'makao-core' )
);
?>

<div <?php wc_product_cat_class( $item_classes ); ?>>
	<div class="qodef-product-categories-item">
	    <a href="<?php echo get_term_link( $category_slug, 'product_cat' ) ?>">
            <?php makao_core_template_part( 'plugins/woocommerce/shortcodes/product-categories-list', 'templates/post-info/image', '', $params ); ?>
        </a>
        <div class="qodef-product-categories-info-holder">
            <?php makao_core_template_part( 'plugins/woocommerce/shortcodes/product-categories-list', 'templates/post-info/title', '', $params ); ?>
            <?php echo MakaoCoreButtonShortcode::call_shortcode( $button_params ); ?>
        </div>
	</div>
</div>
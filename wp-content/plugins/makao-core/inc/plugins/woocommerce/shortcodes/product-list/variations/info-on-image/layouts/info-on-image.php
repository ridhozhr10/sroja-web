<div <?php wc_product_class( $item_classes ); ?>>
    <div class="qodef-woo-product-inner">
		<?php if ( has_post_thumbnail() ) { ?>
            <div class="qodef-woo-product-image">
				<?php makao_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/on-sale' ); ?>
				<?php makao_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/image', '', $params ); ?>
                <div class="qodef-woo-product-image-inner">
					<?php makao_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/category', '', $params ); ?>
					<?php makao_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/title', '', $params ); ?>
					<?php makao_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/rating', '', $params ); ?>
					<?php makao_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/price', '', $params ); ?>
                    <div class="qodef-add-to-cart-wrapper">
                        <?php makao_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/add-to-cart' ); ?>
                        <?php
                        // Hook to include additional content inside product list item image
                        do_action( 'makao_core_action_product_list_item_additional_image_content' );
                        ?>
                    </div>
                </div>
            </div>
		<?php } ?>
		<?php makao_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/link' ); ?>
    </div>
</div>
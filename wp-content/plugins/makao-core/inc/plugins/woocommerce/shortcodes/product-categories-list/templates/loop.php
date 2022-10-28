<?php

if ( $categories !== '' ) {
	foreach ( $categories as $category ) {
		$params['category_slug']   = $category->slug;
		$params['category_name']   = $category->name;
		$params['category_id']     = $category->term_id;
		$params['image_dimension'] = $this_shortcode->get_image_dimension( $params );
		$params['item_classes']    = $this_shortcode->get_item_classes( $params );
		
		makao_core_list_sc_template_part( 'plugins/woocommerce/shortcodes/product-categories-list', 'layouts/' . $layout, '', $params );
	}
} else {
	// Include global posts not found
	makao_core_theme_template_part( 'content', 'templates/parts/posts-not-found' );
}
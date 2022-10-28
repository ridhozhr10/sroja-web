<?php

if ( ! function_exists( 'makao_core_add_product_categories_list_variation_info_on_image' ) ) {
	function makao_core_add_product_categories_list_variation_info_on_image( $variations ) {
		$variations['info-on-image'] = esc_html__( 'Info On Image', 'makao-core' );

		return $variations;
	}

	add_filter( 'makao_core_filter_product_categories_list_layouts', 'makao_core_add_product_categories_list_variation_info_on_image' );
}
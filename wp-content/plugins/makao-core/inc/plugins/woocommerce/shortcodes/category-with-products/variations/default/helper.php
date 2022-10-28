<?php

if ( ! function_exists( 'makao_core_add_category_with_products_variation_default' ) ) {
	function makao_core_add_category_with_products_variation_default( $variations ) {
		$variations['default'] = esc_html__( 'Default', 'makao-core' );

		return $variations;
	}

	add_filter( 'makao_core_filter_category_with_products_layouts', 'makao_core_add_category_with_products_variation_default' );
}
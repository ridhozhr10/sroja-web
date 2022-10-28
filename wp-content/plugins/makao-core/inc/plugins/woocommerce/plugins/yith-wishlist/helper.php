<?php

if ( ! function_exists( 'makao_core_include_yith_wishlist_plugin_is_installed' ) ) {
	function makao_core_include_yith_wishlist_plugin_is_installed( $installed, $plugin ) {
		if ( $plugin === 'yith-wishlist' ) {
			return defined( 'YITH_WCWL' );
		}
		
		return $installed;
	}
	
	add_filter( 'qode_framework_filter_is_plugin_installed', 'makao_core_include_yith_wishlist_plugin_is_installed', 10, 2 );
}

if ( ! function_exists( 'makao_core_get_yith_wishlist_shortcode' ) ) {
	function makao_core_get_yith_wishlist_shortcode() {
		if ( qode_framework_is_installed( 'yith-wishlist' ) ) {
			echo '<div class="qodef-woo-product-wishlist-holder">' . do_shortcode( '[yith_wcwl_add_to_wishlist]' ) . '</div>';
		}
	}
}

remove_all_actions('yith_wcwl_table_after_product_name');

if ( ! function_exists( 'makao_mikado_woocommerce_wishlist_shortcode' ) ) {
    function makao_mikado_woocommerce_wishlist_shortcode() {
        if ( qode_framework_is_installed( 'yith-wishlist' ) ) {
            echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
        }
    }
}
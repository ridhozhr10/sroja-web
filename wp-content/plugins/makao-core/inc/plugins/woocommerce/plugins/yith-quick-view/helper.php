<?php

if ( ! function_exists( 'makao_core_include_yith_quick_view_plugin_is_installed' ) ) {
	function makao_core_include_yith_quick_view_plugin_is_installed( $installed, $plugin ) {
		if ( $plugin === 'yith-quick-view' ) {
			return defined( 'YITH_WCQV' );
		}
		
		return $installed;
	}
	
	add_filter( 'qode_framework_filter_is_plugin_installed', 'makao_core_include_yith_quick_view_plugin_is_installed', 10, 2 );
}

add_action( 'yith_wcqv_product_summary', 'makao_mikado_woocommerce_wishlist_shortcode', 31 );

if( ! function_exists('makao_core_include_yith_quick_view_body_class') ){
    function makao_core_include_yith_quick_view_body_class( $classes ){
        if( defined( 'YITH_WCQV' ) ){
            $classes[] = 'qodef-installed-yith-quick-view';
        }

        return $classes;
    }

    add_filter('body_class', 'makao_core_include_yith_quick_view_body_class');
}
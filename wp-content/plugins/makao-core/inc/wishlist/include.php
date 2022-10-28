<?php

include_once MAKAO_CORE_INC_PATH . '/wishlist/helper.php';

if ( ! function_exists( 'makao_core_wishlist_include_widgets' ) ) {
	/**
	 * Function that includes widgets
	 */
	function makao_core_wishlist_include_widgets() {
		foreach ( glob( MAKAO_CORE_INC_PATH . '/wishlist/widgets/*/include.php' ) as $widget ) {
			include_once $widget;
		}
	}
	
	add_action( 'qode_framework_action_before_widgets_register', 'makao_core_wishlist_include_widgets' );
}
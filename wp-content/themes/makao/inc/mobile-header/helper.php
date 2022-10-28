<?php

if ( ! function_exists( 'makao_load_page_mobile_header' ) ) {
	/**
	 * Function which loads page template module
	 */
	function makao_load_page_mobile_header() {
		// Include mobile header template
		echo apply_filters( 'makao_filter_mobile_header_template', makao_get_template_part( 'mobile-header', 'templates/mobile-header' ) );
	}
	
	add_action( 'makao_action_page_header_template', 'makao_load_page_mobile_header' );
}

if ( ! function_exists( 'makao_register_mobile_navigation_menus' ) ) {
	/**
	 * Function which registers navigation menus
	 */
	function makao_register_mobile_navigation_menus() {
		$navigation_menus = apply_filters( 'makao_filter_register_mobile_navigation_menus', array( 'mobile-navigation' => esc_html__( 'Mobile Navigation', 'makao' ) ) );
		
		if ( ! empty( $navigation_menus ) ) {
			register_nav_menus( $navigation_menus );
		}
	}
	
	add_action( 'makao_action_after_include_modules', 'makao_register_mobile_navigation_menus' );
}
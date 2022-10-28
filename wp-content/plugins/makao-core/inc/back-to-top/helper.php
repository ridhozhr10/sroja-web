<?php

if ( ! function_exists( 'makao_core_is_back_to_top_enabled' ) ) {
	function makao_core_is_back_to_top_enabled() {
		return makao_core_get_post_value_through_levels( 'qodef_back_to_top' ) !== 'no';
	}
}

if ( ! function_exists( 'makao_core_add_back_to_top_to_body_classes' ) ) {
	function makao_core_add_back_to_top_to_body_classes( $classes ) {
		$classes[] = makao_core_is_back_to_top_enabled() ? 'qodef-back-to-top--enabled' : '';
		
		return $classes;
	}
	
	add_filter( 'body_class', 'makao_core_add_back_to_top_to_body_classes' );
}

if ( ! function_exists( 'makao_core_load_back_to_top' ) ) {
	/**
	 * Loads Back To Top HTML
	 */
	function makao_core_load_back_to_top() {
		
		if ( makao_core_is_back_to_top_enabled() ) {
			$parameters = array();
			
			makao_core_template_part( 'back-to-top', 'templates/back-to-top', '', $parameters );
		}
	}
	
	add_action( 'makao_action_before_wrapper_close_tag', 'makao_core_load_back_to_top' );
}
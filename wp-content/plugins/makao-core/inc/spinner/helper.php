<?php

if ( ! function_exists( 'makao_core_is_page_spinner_enabled' ) ) {
	function makao_core_is_page_spinner_enabled() {
		return makao_core_get_post_value_through_levels( 'qodef_enable_page_spinner' ) === 'yes';
	}
}

if ( ! function_exists( 'makao_core_load_page_spinner' ) ) {
	/**
	 * Loads Spinners HTML
	 */
	function makao_core_load_page_spinner() {
		
		if ( makao_core_is_page_spinner_enabled() ) {
			$parameters = array();
			
			makao_core_template_part( 'spinner', 'templates/spinner', '', $parameters );
		}
	}
	
	add_action( 'makao_action_after_body_tag_open', 'makao_core_load_page_spinner' );
}

if ( ! function_exists( 'makao_core_get_spinners_type' ) ) {
	function makao_core_get_spinners_type() {
		$html = '';
		$type = makao_core_get_post_value_through_levels( 'qodef_page_spinner_type' );
		
		if ( ! empty( $type ) ) {
			$html = makao_core_get_template_part( 'spinner', 'layouts/' . $type . '/templates/' . $type );
		}
		
		echo wp_kses_post( $html );
	}
}

if ( ! function_exists( 'makao_core_set_page_spinner_classes' ) ) {
	/**
	 * Function that return classes for page spinner area
	 *
	 * @param $classes array
	 *
	 * @return array
	 */
	function makao_core_set_page_spinner_classes( $classes ) {
		$type = makao_core_get_post_value_through_levels( 'qodef_page_spinner_type' );
		
		if ( ! empty( $type ) ) {
			$classes[] = 'qodef-layout--' . esc_attr( $type );
		}
		
		return $classes;
	}
	
	add_filter( 'makao_filter_page_spinner_classes', 'makao_core_set_page_spinner_classes' );
}

if ( ! function_exists( 'makao_core_set_page_spinner_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param $style string
	 *
	 * @return string
	 */
	function makao_core_set_page_spinner_styles( $style ) {
		$spinner_styles = array();
		
		$spinner_background_color = makao_core_get_post_value_through_levels( 'qodef_page_spinner_background_color' );
		$spinner_color            = makao_core_get_post_value_through_levels( 'qodef_page_spinner_color' );
		
		if ( ! empty( $spinner_background_color ) ) {
			$spinner_styles['background-color'] = $spinner_background_color;
		}
		
		if ( ! empty( $spinner_color ) ) {
			$spinner_styles['color'] = $spinner_color;
		}
		
		if ( ! empty( $spinner_styles ) ) {
			$style .= qode_framework_dynamic_style( '#qodef-page-spinner .qodef-m-inner', $spinner_styles );
		}
		
		return $style;
	}
	
	add_filter( 'makao_filter_add_inline_style', 'makao_core_set_page_spinner_styles' );
}
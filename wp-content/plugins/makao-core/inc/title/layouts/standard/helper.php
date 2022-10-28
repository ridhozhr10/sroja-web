<?php

if ( ! function_exists( 'makao_core_register_standard_title_layout' ) ) {
	function makao_core_register_standard_title_layout( $layouts ) {
		$layouts['standard'] = 'MakaoCoreStandardTitle';
		
		return $layouts;
	}
	
	add_filter( 'makao_core_filter_register_title_layouts', 'makao_core_register_standard_title_layout');
}

if ( ! function_exists( 'makao_core_add_standard_title_layout_option' ) ) {
	/**
	 * Function that set new value into title layout options map
	 *
	 * @param $layouts array - module layouts
	 *
	 * @return array
	 */
	function makao_core_add_standard_title_layout_option( $layouts ) {
		$layouts['standard'] = esc_html__( 'Standard', 'makao-core' );
		
		return $layouts;
	}
	
	add_filter( 'makao_core_filter_title_layout_options', 'makao_core_add_standard_title_layout_option' );
}

if ( ! function_exists( 'makao_core_get_standard_title_layout_subtitle_text' ) ) {
	/**
	 * Function that render current page subtitle text
	 */
	function makao_core_get_standard_title_layout_subtitle_text() {
		$subtitle_meta = makao_core_get_post_value_through_levels( 'qodef_page_title_subtitle' );
		$subtitle      = array( 'subtitle' => ! empty( $subtitle_meta ) ? $subtitle_meta : '' );
		
		return apply_filters( 'makao_core_filter_standard_title_layout_subtitle_text', $subtitle );
	}
}

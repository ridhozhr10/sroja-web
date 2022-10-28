<?php

if ( ! function_exists( 'makao_core_add_standard_mobile_header_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */
	function makao_core_add_standard_mobile_header_global_option( $header_layout_options ) {
		$header_layout_options['standard'] = array(
			'image' => MAKAO_CORE_HEADER_LAYOUTS_URL_PATH . '/standard/assets/img/standard-header.png',
			'label' => esc_html__( 'Standard', 'makao-core' )
		);

		return $header_layout_options;
	}

	add_filter( 'makao_core_filter_mobile_header_layout_option', 'makao_core_add_standard_mobile_header_global_option' );
}

if ( ! function_exists( 'makao_core_add_standard_mobile_header_as_default_global_option' ) ) {
	/**
	 * This function set default value for global mobile header option map
	 */
	function makao_core_add_standard_mobile_header_as_default_global_option( $default_option ) {
		return 'standard';
	}

	add_filter( 'makao_core_filter_mobile_header_layout_default_option', 'makao_core_add_standard_mobile_header_as_default_global_option' );
}

if ( ! function_exists( 'makao_core_register_standard_mobile_header_layout' ) ) {
	function makao_core_register_standard_mobile_header_layout( $mobile_header_layouts ) {
		$mobile_header_layout = array(
			'standard' => 'StandardMobileHeader'
		);

		$mobile_header_layouts = array_merge( $mobile_header_layouts, $mobile_header_layout );

		return $mobile_header_layouts;
	}

	add_filter( 'makao_core_filter_register_mobile_header_layouts', 'makao_core_register_standard_mobile_header_layout');
}
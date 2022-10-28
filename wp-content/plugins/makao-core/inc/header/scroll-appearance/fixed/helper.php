<?php

if ( ! function_exists( 'makao_core_add_fixed_header_option' ) ) {
	/**
	 * This function set header scrolling appearance value for global header option map
	 */
	function makao_core_add_fixed_header_option( $options ) {
		$options['fixed'] = esc_html__( 'Fixed', 'makao-core' );

		return $options;
	}

	add_filter( 'makao_core_filter_header_scroll_appearance_option', 'makao_core_add_fixed_header_option' );
}
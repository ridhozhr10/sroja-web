<?php

if ( ! function_exists( 'makao_core_add_pulse_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param $layouts array - module layouts
	 *
	 * @return array
	 */
	function makao_core_add_pulse_spinner_layout_option( $layouts ) {
		$layouts['pulse'] = esc_html__( 'Pulse', 'makao-core' );
		
		return $layouts;
	}
	
	add_filter( 'makao_core_filter_page_spinner_layout_options', 'makao_core_add_pulse_spinner_layout_option' );
}

if ( ! function_exists( 'makao_core_set_pulse_spinner_layout_as_default_option' ) ) {
	/**
	 * Function that set default value for page spinner layout options map
	 *
	 * @param $default_value string
	 *
	 * @return string
	 */
	function makao_core_set_pulse_spinner_layout_as_default_option( $default_value ) {
		return 'pulse';
	}
	
	add_filter( 'makao_core_filter_page_spinner_default_layout_option', 'makao_core_set_pulse_spinner_layout_as_default_option' );
}
<?php

if ( ! function_exists( 'makao_core_add_mitosis_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param $layouts array - module layouts
	 *
	 * @return array
	 */
	function makao_core_add_mitosis_spinner_layout_option( $layouts ) {
		$layouts['mitosis'] = esc_html__( 'Mitosis', 'makao-core' );
		
		return $layouts;
	}
	
	add_filter( 'makao_core_filter_page_spinner_layout_options', 'makao_core_add_mitosis_spinner_layout_option' );
}
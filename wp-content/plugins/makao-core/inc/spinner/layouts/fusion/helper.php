<?php

if ( ! function_exists( 'makao_core_add_fusion_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param $layouts array - module layouts
	 *
	 * @return array
	 */
	function makao_core_add_fusion_spinner_layout_option( $layouts ) {
		$layouts['fusion'] = esc_html__( 'Fusion', 'makao-core' );
		
		return $layouts;
	}
	
	add_filter( 'makao_core_filter_page_spinner_layout_options', 'makao_core_add_fusion_spinner_layout_option' );
}
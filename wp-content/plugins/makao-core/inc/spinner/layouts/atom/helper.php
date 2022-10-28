<?php

if ( ! function_exists( 'makao_core_add_atom_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param $layouts array - module layouts
	 *
	 * @return array
	 */
	function makao_core_add_atom_spinner_layout_option( $layouts ) {
		$layouts['atom'] = esc_html__( 'Atom', 'makao-core' );
		
		return $layouts;
	}
	
	add_filter( 'makao_core_filter_page_spinner_layout_options', 'makao_core_add_atom_spinner_layout_option' );
}
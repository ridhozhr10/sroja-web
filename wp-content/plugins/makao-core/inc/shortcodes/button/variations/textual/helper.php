<?php

if ( ! function_exists( 'makao_core_add_button_variation_textual' ) ) {
	function makao_core_add_button_variation_textual( $variations ) {
		
		$variations['textual'] = esc_html__( 'Textual', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_button_layouts', 'makao_core_add_button_variation_textual' );
}

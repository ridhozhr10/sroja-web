<?php

if ( ! function_exists( 'makao_core_add_button_variation_outlined' ) ) {
	function makao_core_add_button_variation_outlined( $variations ) {
		
		$variations['outlined'] = esc_html__( 'Outlined', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_button_layouts', 'makao_core_add_button_variation_outlined' );
}

<?php

if ( ! function_exists( 'makao_core_add_call_to_action_variation_standard' ) ) {
	function makao_core_add_call_to_action_variation_standard( $variations ) {
		
		$variations['standard'] = esc_html__( 'Standard', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_call_to_action_layouts', 'makao_core_add_call_to_action_variation_standard' );
}

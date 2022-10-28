<?php

if ( ! function_exists( 'makao_core_add_pricing_table_variation_standard' ) ) {
	function makao_core_add_pricing_table_variation_standard( $variations ) {
		
		$variations['standard'] = esc_html__( 'Standard', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_pricing_table_layouts', 'makao_core_add_pricing_table_variation_standard' );
}

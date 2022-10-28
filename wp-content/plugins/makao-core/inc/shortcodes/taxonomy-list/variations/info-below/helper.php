<?php

if ( ! function_exists( 'makao_core_add_taxonomy_list_variation_info_below' ) ) {
	function makao_core_add_taxonomy_list_variation_info_below( $variations ) {
		
		$variations['info-below'] = esc_html__( 'Info Below', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_taxonomy_list_layouts', 'makao_core_add_taxonomy_list_variation_info_below' );
}

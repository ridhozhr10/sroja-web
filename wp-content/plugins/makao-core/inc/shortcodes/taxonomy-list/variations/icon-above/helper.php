<?php

if ( ! function_exists( 'makao_core_add_taxonomy_list_variation_icon_above' ) ) {
	function makao_core_add_taxonomy_list_variation_icon_above( $variations ) {
		
		$variations['icon-above'] = esc_html__( 'Icon Above', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_taxonomy_list_layouts', 'makao_core_add_taxonomy_list_variation_icon_above' );
}

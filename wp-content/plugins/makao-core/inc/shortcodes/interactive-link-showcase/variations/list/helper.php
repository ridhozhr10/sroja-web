<?php

if ( ! function_exists( 'makao_core_add_interactive_link_showcase_variation_list' ) ) {
	function makao_core_add_interactive_link_showcase_variation_list( $variations ) {
		$variations['list'] = esc_html__( 'List', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_interactive_link_showcase_layouts', 'makao_core_add_interactive_link_showcase_variation_list' );
}

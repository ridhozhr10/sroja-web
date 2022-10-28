<?php

if ( ! function_exists( 'makao_core_add_social_share_variation_dropdown' ) ) {
	function makao_core_add_social_share_variation_dropdown( $variations ) {
		
		$variations['dropdown'] = esc_html__( 'Dropdown', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_social_share_layouts', 'makao_core_add_social_share_variation_dropdown' );
}

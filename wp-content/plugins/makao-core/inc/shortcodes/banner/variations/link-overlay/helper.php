<?php

if ( ! function_exists( 'makao_core_add_banner_variation_link_overlay' ) ) {
	function makao_core_add_banner_variation_link_overlay( $variations ) {
		
		$variations['link-overlay'] = esc_html__( 'Link Overlay', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_banner_layouts', 'makao_core_add_banner_variation_link_overlay' );
}

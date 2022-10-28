<?php

if ( ! function_exists( 'makao_core_add_banner_variation_link_button' ) ) {
	function makao_core_add_banner_variation_link_button( $variations ) {
		
		$variations['link-button'] = esc_html__( 'Link Button', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_banner_layouts', 'makao_core_add_banner_variation_link_button' );
}

<?php

if ( ! function_exists( 'makao_core_add_social_share_variation_text' ) ) {
	function makao_core_add_social_share_variation_text( $variations ) {
		
		$variations['text'] = esc_html__( 'Text', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_social_share_layouts', 'makao_core_add_social_share_variation_text' );
}

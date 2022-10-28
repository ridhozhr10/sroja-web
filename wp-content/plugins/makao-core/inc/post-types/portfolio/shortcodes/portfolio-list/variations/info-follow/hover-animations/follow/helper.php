<?php
if ( ! function_exists( 'makao_core_filter_portfolio_list_info_follow' ) ) {
	function makao_core_filter_portfolio_list_info_follow( $variations ) {

		$variations['follow'] = esc_html__( 'Follow', 'makao-core' );

		return $variations;
	}

	add_filter( 'makao_core_filter_portfolio_list_info_follow_animation_options', 'makao_core_filter_portfolio_list_info_follow' );
}
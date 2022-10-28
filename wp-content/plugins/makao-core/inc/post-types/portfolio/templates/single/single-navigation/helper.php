<?php

if ( ! function_exists( 'makao_core_include_portfolio_single_post_navigation_template' ) ) {
	/**
	 * Function which includes additional module on single portfolio page
	 */
	function makao_core_include_portfolio_single_post_navigation_template() {
		makao_core_template_part( 'post-types/portfolio', 'templates/single/single-navigation/templates/single-navigation' );
	}
	
	add_action( 'makao_core_action_after_portfolio_single_item', 'makao_core_include_portfolio_single_post_navigation_template' );
}
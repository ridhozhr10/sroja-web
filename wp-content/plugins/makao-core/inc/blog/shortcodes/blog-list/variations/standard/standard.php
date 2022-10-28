<?php

if ( ! function_exists( 'makao_core_add_blog_list_variation_standard' ) ) {
	function makao_core_add_blog_list_variation_standard( $variations ) {
		$variations['standard'] = esc_html__( 'Standard', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_blog_list_layouts', 'makao_core_add_blog_list_variation_standard' );
}

if ( ! function_exists( 'makao_core_load_blog_list_variation_standard_assets' ) ) {
	function makao_core_load_blog_list_variation_standard_assets( $is_enabled, $params ) {
		
		if ( $params['layout'] === 'standard' ) {
			$is_enabled = true;
		}
		
		return $is_enabled;
	}
	
	add_filter( 'makao_core_filter_load_blog_list_assets', 'makao_core_load_blog_list_variation_standard_assets', 10, 2 );
}

if ( ! function_exists( 'makao_core_register_blog_list_standard_scripts' ) ) {
	/**
	 * Function that register modules 3rd party scripts
	 *
	 * @param $scripts
	 * @return $atts
	 */
	function makao_core_register_blog_list_standard_scripts( $scripts ) {

		$scripts['wp-mediaelement'] = array(
			'registered'	=> true
		);
		$scripts['mediaelement-vimeo'] = array(
			'registered'	=> true
		);

		return $scripts;
	}

	add_filter( 'makao_core_filter_blog_list_register_scripts', 'makao_core_register_blog_list_standard_scripts' );
}

if ( ! function_exists( 'makao_core_register_blog_list_standard_styles' ) ) {
	/**
	 * Function that register modules 3rd party scripts
	 *
	 * @param $styles
	 * @return $atts
	 */
	function makao_core_register_blog_list_standard_styles( $styles ) {

		$styles['wp-mediaelement'] = array(
			'registered'	=> true
		);

		return $styles;
	}

	add_filter( 'makao_core_filter_blog_list_register_styles', 'makao_core_register_blog_list_standard_styles' );
}
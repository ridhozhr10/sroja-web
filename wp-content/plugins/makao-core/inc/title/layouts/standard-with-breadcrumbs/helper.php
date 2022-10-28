<?php

if ( ! function_exists( 'makao_core_register_standard_with_breadcrumbs_title_layout' ) ) {
	function makao_core_register_standard_with_breadcrumbs_title_layout( $layouts ) {
		$layouts['standard-with-breadcrumbs'] = 'MakaoCoreStandardWithBreadcrumbsTitle';

		return $layouts;
	}

	add_filter( 'makao_core_filter_register_title_layouts', 'makao_core_register_standard_with_breadcrumbs_title_layout' );
}

if ( ! function_exists( 'makao_core_add_standard_with_breadcrumbs_title_layout_option' ) ) {
	/**
	 * Function that set new value into title layout options map
	 *
	 * @param $layouts array - module layouts
	 *
	 * @return array
	 */
	function makao_core_add_standard_with_breadcrumbs_title_layout_option( $layouts ) {
		$layouts['standard-with-breadcrumbs'] = esc_html__( 'Standard with breadcrumbs', 'makao-core' );

		return $layouts;
	}

	add_filter( 'makao_core_filter_title_layout_options', 'makao_core_add_standard_with_breadcrumbs_title_layout_option' );
}


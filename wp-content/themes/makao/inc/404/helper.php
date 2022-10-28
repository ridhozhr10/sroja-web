<?php

if ( ! function_exists( 'makao_set_404_page_inner_classes' ) ) {
	/**
	 * Function that return classes for the page inner div from header.php
	 *
	 * @param $classes string
	 *
	 * @return string
	 */
	function makao_set_404_page_inner_classes( $classes ) {
		
		if ( is_404() ) {
			$classes = 'qodef-content-full-width';
		}
		
		return $classes;
	}
	
	add_filter( 'makao_filter_page_inner_classes', 'makao_set_404_page_inner_classes' );
}

if ( ! function_exists( 'makao_get_404_page_parameters' ) ) {
	/**
	 * Function that set 404 page area content parameters
	 */
	function makao_get_404_page_parameters() {
		
		$params = array(
            'tagline'     => esc_html__ ( '404', 'makao' ),
			'title'       => esc_html__( 'Page Not Found', 'makao' ),
			'text'        => esc_html__( 'Oops! The page you are looking for does not exist. It might have been moved or deleted.', 'makao' ),
			'button_text' => esc_html__( 'Back to home', 'makao' ),
		);
		
		return apply_filters( 'makao_filter_404_page_template_params', $params );
	}
}

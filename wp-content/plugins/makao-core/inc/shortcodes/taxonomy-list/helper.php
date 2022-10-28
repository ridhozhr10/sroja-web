<?php

if ( ! function_exists( 'makao_core_get_taxonomy_query_params' ) ) {
	/**
	 * Function that return query parameters
	 *
	 * @param $params array - options value
	 *
	 * @return array
	 */
	function makao_core_get_taxonomy_query_params( $params ) {
		$taxonomy       = $params['taxonomy'];
		$posts_per_page = isset( $params['posts_per_page'] ) && ! empty( $params['posts_per_page'] ) ? $params['posts_per_page'] : 0;
		$hide_empty     = $params['hide_empty'] === 'yes' ? true : false;
		
		$args = array(
			'taxonomy'   => $taxonomy,
			'number'     => $posts_per_page,
			'hide_empty' => $hide_empty,
			'orderby'    => $params['orderby'],
			'order'      => $params['order'],
		);
		
		return $args;
	}
}
<?php

if ( ! function_exists( 'makao_core_search_include_widgets' ) ) {
	/**
	 * Function that includes widgets
	 */
	function makao_core_search_include_widgets() {
		foreach ( glob( MAKAO_CORE_INC_PATH . '/search/widgets/*/include.php' ) as $widget ) {
			include_once $widget;
		}
	}
	
	add_action( 'qode_framework_action_before_widgets_register', 'makao_core_search_include_widgets' );
}

if ( ! function_exists( 'makao_core_search_include_layout' ) ) {
	function makao_core_search_include_layout() {
		$header_object = MakaoCoreHeaders::get_instance()->get_header_object();
		
		if ( ! empty( $header_object ) ) {
			$search_layout = $header_object->search_layout;
			$layouts       = apply_filters( 'makao_core_filter_register_search_layouts', $header_layouts_option = array() );

			if ( ! empty( $layouts ) ) {
				foreach ( $layouts as $key => $value ) {
					if ( $search_layout === $key ) {
						$value::get_instance();
					}
				}
			}
		}
	}
	
	add_action( 'wp', 'makao_core_search_include_layout' );
}

if ( ! function_exists( 'makao_core_set_search_page_page_title' ) ) {
	/**
	 * Function that enable/disable page title area for blog single page
	 *
	 * @param $enable_page_title bool
	 *
	 * @return bool
	 */
	function makao_core_set_search_page_page_title( $enable_page_title ) {
		$option = makao_core_get_post_value_through_levels( 'qodef_search_page_enable_page_title' ) !== 'no';
		
		if ( is_search() && $option !== '' ) {
			$enable_page_title = $option;
		}
		
		return $enable_page_title;
	}
	
	add_filter( 'makao_filter_enable_page_title', 'makao_core_set_search_page_page_title' );
}

if ( ! function_exists( 'makao_core_set_search_page_sidebar_layout' ) ) {
	/**
	 * Function that return sidebar layout
	 *
	 * @param $layout string
	 *
	 * @return string
	 */
	function makao_core_set_search_page_sidebar_layout( $layout ) {
		
		if ( is_search() ) {
			$option = makao_core_get_post_value_through_levels( 'qodef_search_page_sidebar_layout' );
			
			if ( ! empty( $option ) ) {
				$layout = $option;
			}
		}
		
		return $layout;
	}
	
	add_filter( 'makao_filter_sidebar_layout', 'makao_core_set_search_page_sidebar_layout' );
}

if ( ! function_exists( 'makao_core_set_search_page_custom_sidebar_name' ) ) {
	/**
	 * Function that return sidebar name
	 *
	 * @param $sidebar_name string
	 *
	 * @return string
	 */
	function makao_core_set_search_page_custom_sidebar_name( $sidebar_name ) {
		
		if ( is_search() ) {
			$option = makao_core_get_post_value_through_levels( 'qodef_search_page_custom_sidebar' );
			
			if ( ! empty( $option ) ) {
				$sidebar_name = $option;
			}
		}
		
		return $sidebar_name;
	}
	
	add_filter( 'makao_filter_sidebar_name', 'makao_core_set_search_page_custom_sidebar_name' );
}

if ( ! function_exists( 'makao_core_set_search_page_sidebar_grid_gutter_classes' ) ) {
	/**
	 * Function that returns grid gutter classes
	 *
	 * @param $classes string
	 *
	 * @return string
	 */
	function makao_core_set_search_page_sidebar_grid_gutter_classes( $classes ) {
		
		if ( is_search() ) {
			$option = makao_core_get_post_value_through_levels( 'qodef_search_page_sidebar_grid_gutter' );
			
			if ( ! empty( $option ) ) {
				$classes = 'qodef-gutter--' . esc_attr( $option );
			}
		}
		
		return $classes;
	}
	
	add_filter( 'makao_filter_grid_gutter_classes', 'makao_core_set_search_page_sidebar_grid_gutter_classes' );
}

if ( ! function_exists( 'makao_core_set_search_page_post_excerpt_length' ) ) {
	/**
	 * Function that set number of characters for excerpt on blog list page
	 *
	 * @param $excerpt_length int
	 *
	 * @return int
	 */
	function makao_core_set_search_page_post_excerpt_length( $excerpt_length ) {
		$option = makao_core_get_post_value_through_levels( 'qodef_search_page_excerpt_number_of_characters' );
		
		if ( $option !== '' ) {
			$excerpt_length = $option;
		}
		
		return $excerpt_length;
	}
	
	add_filter( 'makao_filter_search_page_excerpt_length', 'makao_core_set_search_page_post_excerpt_length' );
}
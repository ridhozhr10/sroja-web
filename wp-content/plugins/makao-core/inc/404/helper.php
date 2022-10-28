<?php

if ( ! function_exists( 'makao_core_disable_page_title_for_404_page' ) ) {
	/**
	 * Function that disable page title area for 404 page
	 *
	 * @param $enable_page_title bool
	 *
	 * @return bool
	 */
	function makao_core_disable_page_title_for_404_page( $enable_page_title ) {
		$is_enabled = makao_core_get_post_value_through_levels( 'qodef_enable_404_page_title' ) !== 'no';
		
		if ( is_404() && ! $is_enabled ) {
			$enable_page_title = false;
		}
		
		return $enable_page_title;
	}
	
	add_filter( 'makao_filter_enable_page_title', 'makao_core_disable_page_title_for_404_page' );
}

if ( ! function_exists( 'makao_core_disable_page_footer_for_404_page' ) ) {
	/**
	 * Function that disable page footer area for 404 page
	 *
	 * @param $enable_page_footer bool
	 *
	 * @return bool
	 */
	function makao_core_disable_page_footer_for_404_page( $enable_page_footer ) {
		$is_enabled = makao_core_get_post_value_through_levels( 'qodef_enable_404_page_footer' ) !== 'no';
		
		if ( is_404() && ! $is_enabled ) {
			$enable_page_footer = false;
		}
		
		return $enable_page_footer;
	}
	
	add_filter( 'makao_filter_enable_page_footer', 'makao_core_disable_page_footer_for_404_page' );
}

if ( ! function_exists( 'makao_core_set_404_page_area_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param $style string
	 *
	 * @return string
	 */
	function makao_core_set_404_page_area_styles( $style ) {
		
		if ( is_404() ) {
			$styles = array();
			
			$background_color = makao_core_get_post_value_through_levels( 'qodef_404_page_background_color' );
			$background_image = makao_core_get_post_value_through_levels( 'qodef_404_page_background_image' );
			
			if ( ! empty( $background_color ) ) {
				$styles['background-color'] = $background_color;
			}
			
			if ( ! empty( $background_image ) ) {
				$styles['background-image'] = 'url(' . esc_url( wp_get_attachment_image_url( $background_image, 'full' ) ) . ')';
			}
			
			if ( ! empty( $styles ) ) {
				$style .= qode_framework_dynamic_style( '.error404 #qodef-page-outer', $styles );
			}

            $tagline_styles = array ();
            $tagline_color = makao_core_get_post_value_through_levels ( 'qodef_404_page_tagline_color' );
            if ( ! empty( $tagline_color ) ) {
                $tagline_styles[ 'color' ] = $tagline_color;
            }
            if ( ! empty( $tagline_styles ) ) {
                $style .= qode_framework_dynamic_style ( '#qodef-404-page .qodef-404-tagline', $tagline_styles );
            }
			
			$title_styles = array();
			
			$title_color = makao_core_get_post_value_through_levels( 'qodef_404_page_title_color' );
			
			if ( ! empty( $title_color ) ) {
				$title_styles['color'] = $title_color;
			}
			
			if ( ! empty( $title_styles ) ) {
				$style .= qode_framework_dynamic_style( '#qodef-404-page .qodef-404-title', $title_styles );
			}
			
			$text_styles = array();
			
			$text_color = makao_core_get_post_value_through_levels( 'qodef_404_page_text_color' );
			
			if ( ! empty( $text_color ) ) {
				$text_styles['color'] = $text_color;
			}
			
			if ( ! empty( $text_styles ) ) {
				$style .= qode_framework_dynamic_style( '#qodef-404-page .qodef-404-text', $text_styles );
			}
		}
		
		return $style;
	}
	
	add_filter( 'makao_filter_add_inline_style', 'makao_core_set_404_page_area_styles' );
}

if ( ! function_exists( 'makao_core_set_404_page_template_params' ) ) {
	/**
	 * Function that set 404 page area content parameters
	 *
	 * @param $params array
	 *
	 * @return array
	 */
	function makao_core_set_404_page_template_params( $params ) {
        $tagline     = makao_core_get_post_value_through_levels( 'qodef_404_page_tagline' );
		$title       = makao_core_get_post_value_through_levels( 'qodef_404_page_title' );
		$text        = makao_core_get_post_value_through_levels( 'qodef_404_page_text' );
		$button_text = makao_core_get_post_value_through_levels( 'qodef_404_page_button_text' );

        if ( ! empty( $tagline ) ) {
            $params[ 'tagline' ] = esc_attr ( $tagline );
        }
		
		if ( ! empty( $title ) ) {
			$params['title'] = esc_attr( $title );
		}
		
		if ( ! empty( $text ) ) {
			$params['text'] = esc_attr( $text );
		}
		
		if ( ! empty( $button_text ) ) {
			$params['button_text'] = esc_attr( $button_text );
		}
		
		return $params;
	}
	
	add_filter( 'makao_filter_404_page_template_params', 'makao_core_set_404_page_template_params' );
}

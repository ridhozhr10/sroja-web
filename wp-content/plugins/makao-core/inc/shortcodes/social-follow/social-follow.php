<?php

if ( ! function_exists( 'makao_core_add_social_follow_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function makao_core_add_social_follow_shortcode( $shortcodes ) {
		$shortcodes[] = 'MakaoCoreSocialFollowShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'makao_core_filter_register_shortcodes', 'makao_core_add_social_follow_shortcode' );
}

if ( class_exists( 'MakaoCoreShortcode' ) ) {
	class MakaoCoreSocialFollowShortcode extends MakaoCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( MAKAO_CORE_SHORTCODES_URL_PATH . '/social-follow' );
			$this->set_base( 'makao_core_social_follow' );
			$this->set_name( esc_html__( 'Social Follow', 'makao-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays social-follow with provided parameters', 'makao-core' ) );
			$this->set_category( esc_html__( 'Makao Core', 'makao-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'makao-core' ),
			) );

            $this->set_option( array(
                'field_type' => 'select',
                'name'       => 'layout',
                'title'      => esc_html__( 'Layout', 'makao-core' ),
                'options'    => array(
                    ''        => esc_html__( 'Default', 'makao-core' ),
                    'simple'  => esc_html__( 'Simple', 'makao-core' )
                )
            ) );

			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'label_text',
				'title'      => esc_html__( 'Label Text', 'makao-core' )
			) );

            $this->set_option( array(
                'field_type' => 'select',
                'name'       => 'link_target',
                'title'      => esc_html__( 'Link Target', 'makao-core' ),
                'options'    => makao_core_get_select_type_options_pool( 'link_target', false )
            ));

            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'text_font_size',
                'title'      => esc_html__( 'Label Text Font Size', 'makao-core' ),
                'group'      => esc_html__( 'Label', 'makao-core' )
            ) );

            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'icons_font_size',
                'title'      => esc_html__( 'Icons Text Font Size', 'makao-core' ),
                'group'      => esc_html__( 'Icons', 'makao-core' )
            ) );

            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'icons_padding',
                'title'      => esc_html__( 'Icons padding', 'makao-core' ),
                'group'      => esc_html__( 'Icons', 'makao-core' )
            ) );

            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'text_padding',
                'title'      => esc_html__( 'Label Text Padding', 'makao-core' ),
                'group'      => esc_html__( 'Label', 'makao-core' )
            ) );

            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'facebook_link',
                'title'      => esc_html__( 'Facebook Link', 'makao-core' )
            ) );

            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'twitter_link',
                'title'      => esc_html__( 'Twitter Link', 'makao-core' )
            ) );

            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'linkedin_link',
                'title'      => esc_html__( 'LinkedIn Link', 'makao-core' )
            ) );

            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'pinterest_link',
                'title'      => esc_html__( 'Pinterest Link', 'makao-core' )
            ) );

            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'tumblr_link',
                'title'      => esc_html__( 'Tumblr Link', 'makao-core' )
            ) );

            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'vk_link',
                'title'      => esc_html__( 'VK Link', 'makao-core' )
            ) );

		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['icons_styles']    = $this->get_icon_styles( $atts );
			$atts['text_styles']    = $this->get_text_styles( $atts );
			
			return makao_core_get_template_part( 'shortcodes/social-follow', 'templates/social-follow', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-social-follow';
			$holder_classes[] = ! empty( $atts['type'] ) ? 'qodef-type--' . $atts['type'] : '';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';

			return implode( ' ', $holder_classes );
		}
		
		private function get_text_styles( $atts ) {
			$styles = array();

            $font_size = $atts['text_font_size'];
            if ( ! empty( $font_size ) ) {
                if ( qode_framework_string_ends_with_typography_units( $font_size ) ) {
                    $styles[] = 'font-size: ' . $font_size;
                } else {
                    $styles[] = 'font-size: ' . intval( $font_size ) . 'px';
                }
            }


            if ( ! empty( $atts['text_padding'] ) ) {
                $styles[] = 'padding: ' . $atts['text_padding'];
            }

			return $styles;
		}
		
		private function get_icon_styles( $atts ) {
			$styles = array();

            $font_size = $atts['icons_font_size'];
            if ( ! empty( $font_size ) ) {
                if ( qode_framework_string_ends_with_typography_units( $font_size ) ) {
                    $styles[] = 'font-size: ' . $font_size;
                } else {
                    $styles[] = 'font-size: ' . intval( $font_size ) . 'px';
                }
            }

            if ( ! empty( $atts['icons_padding'] ) ) {
                $styles[] = 'padding: ' . $atts['icons_padding'];
            }
			
			return $styles;
		}
	}
}
<?php

if ( ! function_exists( 'makao_core_add_video_button_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function makao_core_add_video_button_shortcode( $shortcodes ) {
		$shortcodes[] = 'MakaoCoreVideoButton';
		
		return $shortcodes;
	}
	
	add_filter( 'makao_core_filter_register_shortcodes', 'makao_core_add_video_button_shortcode' );
}

if ( class_exists( 'MakaoCoreShortcode' ) ) {
	class MakaoCoreVideoButton extends MakaoCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( MAKAO_CORE_SHORTCODES_URL_PATH . '/video-button' );
			$this->set_base( 'makao_core_video_button' );
			$this->set_name( esc_html__( 'Video Button', 'makao-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds video button element', 'makao-core' ) );
			$this->set_category( esc_html__( 'Makao Core', 'makao-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'makao-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'video_link',
				'title'      => esc_html__( 'Video Link', 'makao-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'video_image',
				'title'      => esc_html__( 'Image', 'makao-core' ),
				'description'=> esc_html__( 'Select image from media library', 'makao-core' )
			) );
            $this->set_option( array(
                'field_type'    => 'text',
                'name'          => 'holder_height',
                'title'         => esc_html__( 'Holder Height', 'masterds-core' )
            ) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'play_button_color',
				'title'      => esc_html__( 'Play Button Color', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'play_button_size',
				'title'      => esc_html__( 'Play Button Size (px)', 'makao-core' )
			) );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes']		= $this->get_holder_classes( $atts );
			$atts['play_button_styles'] = $this->get_play_button_styles( $atts );
            $atts['holder_height']      = $this->get_holder_height( $atts );

			return makao_core_get_template_part( 'shortcodes/video-button', 'templates/video-button', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-video-button';
			$holder_classes[] = ! empty( $atts['video_image'] ) ? 'qodef--has-img' : '';
			
			return implode( ' ', $holder_classes );
		}

        private function get_holder_height( $atts ) {
            $styles = array();


            if ( ! empty( $atts['holder_height'] ) ) {
                if ( qode_framework_string_ends_with_typography_units( $atts['holder_height'] ) ) {
                    $styles[] = 'height: ' . $atts['holder_height'];
                } else {
                    $styles[] = 'height: ' . intval( $atts['holder_height'] ) . 'px';
                }
            }

            return implode( ';', $styles );
        }

		private function get_play_button_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['play_button_color'] ) ) {
				$styles[] = 'color: ' . $atts['play_button_color'];
			}
			
			if ( ! empty( $atts['play_button_size'] ) ) {
				if ( qode_framework_string_ends_with_typography_units( $atts['play_button_size'] ) ) {
					$styles[] = 'font-size: ' . $atts['play_button_size'];
				} else {
					$styles[] = 'font-size: ' . intval( $atts['play_button_size'] ) . 'px';
				}
			}
			
			return implode( ';', $styles );
		}
	}
}
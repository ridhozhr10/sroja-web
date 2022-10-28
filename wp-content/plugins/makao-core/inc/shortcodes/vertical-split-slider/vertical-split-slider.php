<?php

if ( ! function_exists( 'makao_core_add_vertical_split_slider_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function makao_core_add_vertical_split_slider_shortcode( $shortcodes ) {
		$shortcodes[] = 'MakaoVerticalSplitSliderShortcode';

		return $shortcodes;
	}

	add_filter( 'makao_core_filter_register_shortcodes', 'makao_core_add_vertical_split_slider_shortcode' );
}

if ( class_exists( 'MakaoCoreShortcode' ) ) {
	class MakaoVerticalSplitSliderShortcode extends MakaoCoreShortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( MAKAO_CORE_SHORTCODES_URL_PATH . '/vertical-split-slider' );
			$this->set_base( 'makao_vertical_split_slider' );
			$this->set_name( esc_html__( 'Vertical Split Slider', 'makao-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds vertical split slider holder', 'makao-core' ) );
			$this->set_category( esc_html__( 'Makao Core', 'makao-core' ) );
			$this->set_scripts(
				array(
					'jquery-effects-core' => array(
						'registered'	=> true
					),
					'multiscroll' => array(
						'registered'	=> false,
						'url'			=> MAKAO_CORE_SHORTCODES_URL_PATH . '/vertical-split-slider/assets/js/plugins/jquery.multiscroll.min.js',
						'dependency'	=> array( 'jquery', 'jquery-effects-core' )
					)
				)
			);

			$this->set_necessary_styles(
				array(
					'multiscroll' => array(
						'registered'	=> false,
						'url'			=> MAKAO_CORE_SHORTCODES_URL_PATH . '/vertical-split-slider/assets/css/plugins/jquery.multiscroll.css'
					)
				)
			);

			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'makao-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'disable_breakpoint',
				'title'         => esc_html__( 'Disable on smaller screens', 'makao-core' ),
				'options'       => array(
					'1024' => esc_html__( 'Below 1024px', 'makao-core' ),
					'768'  => esc_html__( 'Below 768px', 'makao-core' ),
				),
				'default_value' => '1024'
			) );
			$this->set_option( array(
				'field_type' => 'repeater',
				'name'       => 'children',
				'title'      => esc_html__( 'Slide Items', 'makao-core' ),
				'items'      => array(
					array(
						'field_type' => 'select',
						'name'       => 'slide_header_style',
						'title'      => esc_html__( 'Header/Bullets Style', 'makao-core' ),
						'options'    => array(
							''      => esc_html__( 'Default', 'makao-core' ),
							'light' => esc_html__( 'Light', 'makao-core' ),
							'dark'  => esc_html__( 'Dark', 'makao-core' ),
						)
					),
					array(
						'field_type' => 'select',
						'name'       => 'slide_layout',
						'title'      => esc_html__( 'Slide Layout', 'makao-core' ),
						'options'    => array(
							'image-left'  => esc_html__( 'Image On Left', 'makao-core' ),
							'image-right' => esc_html__( 'Image On Right', 'makao-core' )
						),
					),
					array(
						'field_type' => 'image',
						'name'       => 'slide_image',
						'title'      => esc_html__( 'Image', 'makao-core' )
					),
					array(
						'field_type' => 'text',
						'name'       => 'slide_content_title',
						'title'      => esc_html__( 'Title', 'makao-core' ),
					),
                    array(
                        'field_type' => 'text',
                        'name'       => 'slide_content_title_link',
                        'title'      => esc_html__( 'Title Link', 'makao-core' ),
                    ),
                    array(
                        'field_type' => 'select',
                        'name'       => 'slide_content_title_target',
                        'title'      => esc_html__( 'Title Link Target', 'makao-core' ),
                        'options'    => makao_core_get_select_type_options_pool( 'link_target', false )
                    ),
					array(
						'field_type' => 'select',
						'name'       => 'slide_content_title_tag',
						'title'      => esc_html__( 'Title Tag', 'makao-core' ),
						'options'    => makao_core_get_select_type_options_pool( 'title_tag', false ),
					),
                    array(
                        'field_type' => 'text',
                        'name'       => 'slide_content_title_font_size',
                        'title'      => esc_html__( 'Title Font Size', 'makao-core' ),
                        'description'=> 'Enter font size in pixels'
                    ),
                    array(
                        'field_type' => 'text',
                        'name'       => 'slide_content_title_margin',
                        'title'      => esc_html__( 'Title Margin', 'makao-core' ),
                    ),
                    array(
                        'field_type' => 'text',
                        'name'       => 'slide_content_title_font_size_responsive',
                        'title'      => esc_html__( 'Title Font Size Responsive', 'makao-core' ),
                        'description'=> 'Enter font size in pixels'
                    ),
					array(
						'field_type' => 'textarea',
						'name'       => 'slide_content_text',
						'title'      => esc_html__( 'Text', 'makao-core' ),
					),
                    array(
                        'field_type' => 'text',
                        'name'       => 'slide_content_text_link',
                        'title'      => esc_html__( 'Text Link', 'makao-core' ),
                    ),
                    array(
                        'field_type' => 'select',
                        'name'       => 'slide_content_text_target',
                        'title'      => esc_html__( 'Text Link Target', 'makao-core' ),
                        'options'    => makao_core_get_select_type_options_pool( 'link_target', false )
                    ),
					array(
						'field_type' => 'image',
						'name'       => 'slide_content_image',
						'title'      => esc_html__( 'Content Image', 'makao-core' )
					),
                    array(
                        'field_type' => 'image',
                        'name'       => 'slide_content_background_image',
                        'title'      => esc_html__( 'Content Image', 'makao-core' )
                    ),
                    array(
                        'field_type' => 'color',
                        'name'       => 'slide_content_background_color',
                        'title'      => esc_html__( 'Background Color', 'makao-core' )
                    )
				)
			) );
		}
		
		public function load_assets() {
			wp_enqueue_script( 'jquery-effects-core' );
			
			wp_enqueue_script( 'multiscroll');
			wp_enqueue_style( 'multiscroll' );
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts                   = $this->get_atts();
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['this_object']    = $this;
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );

			return makao_core_get_template_part( 'shortcodes/vertical-split-slider', 'templates/vertical-split-slider', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-vertical-split-slider qodef-m';
			$holder_classes[] = ! empty ( $atts['disable_breakpoint'] ) ? 'qodef-disable-below--' . $atts['disable_breakpoint'] : '';

			return implode( ' ', $holder_classes );
		}

		public function get_slide_image_styles( $slide_atts ) {
			$styles = array();

			$styles[] = ! empty( $slide_atts['slide_image'] ) ? 'background-image: url(' . wp_get_attachment_url( $slide_atts['slide_image'] ) . ')' : '';

			return $styles;
		}

        public function get_slide_background_image( $slide_atts ) {
            $styles = array();

            $styles[] = ! empty( $slide_atts['slide_content_background_image'] ) ? 'background-image: url(' . wp_get_attachment_url( $slide_atts['slide_content_background_image'] ) . ')' : '';

            return $styles;
        }


        public function get_title_styles( $atts ) {
            $styles = array();


            $font_size =  $atts['slide_content_title_font_size'];
            $margin = $atts['slide_content_title_margin'];

            if ( ! empty( $font_size ) ) {
                if ( qode_framework_string_ends_with_typography_units( $font_size ) ) {
                    $styles[] = 'font-size: ' . $font_size;
                } else {
                    $styles[] = 'font-size: ' . intval( $font_size ) . 'px';
                }
            }

            if ( ! empty( $margin ) ) {
                $styles[] = 'margin: ' .  $margin;
            }

            return $styles;
        }

        public function get_title_styles_responsive( $atts ) {
            $styles = array();


            $font_size =  $atts['slide_content_title_font_size_responsive'];

            if ( ! empty( $font_size ) ) {
                if ( qode_framework_string_ends_with_typography_units( $font_size ) ) {
                    $styles[] = 'font-size: ' . $font_size;
                } else {
                    $styles[] = 'font-size: ' . intval( $font_size ) . 'px';
                }
            }

            return $styles;
        }

        public function get_holder_styles( $atts ) {
            $styles = array();


            $background_color =  $atts['slide_content_background_color'];

            if ( ! empty( $background_color ) ) {
                $styles[] = 'background-color: ' . $background_color;
            }

            $styles[] = ! empty( $atts['slide_content_background_image'] ) ? 'background-image: url(' . wp_get_attachment_url( $atts['slide_content_background_image'] ) . ')' : '';
            $styles[] = ! empty( $atts['slide_content_background_image'] ) ? 'background-repeat: no-repeat': '';

            return $styles;
        }

		public function get_slide_data( $slide_atts ) {
			$data = array();

			$data['data-header-skin'] = ! empty( $slide_atts['slide_header_style'] ) ? $slide_atts['slide_header_style'] : '';

			return $data;
		}
	}
}
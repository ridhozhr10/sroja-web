<?php

if ( ! function_exists( 'makao_core_add_button_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function makao_core_add_button_shortcode( $shortcodes ) {
		$shortcodes[] = 'MakaoCoreButtonShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'makao_core_filter_register_shortcodes', 'makao_core_add_button_shortcode', 9 );
}

if ( class_exists( 'MakaoCoreShortcode' ) ) {
	class MakaoCoreButtonShortcode extends MakaoCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'makao_core_filter_button_layouts', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( MAKAO_CORE_SHORTCODES_URL_PATH . '/button' );
			$this->set_base( 'makao_core_button' );
			$this->set_name( esc_html__( 'Button', 'makao-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays button with provided parameters', 'makao-core' ) );
			$this->set_category( esc_html__( 'Makao Core', 'makao-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'makao-core' )
			) );
			
			$options_map = makao_core_get_variations_options_map( $this->get_layouts() );

			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'button_layout',
				'title'         => esc_html__( 'Layout', 'makao-core' ),
				'options'       => $this->get_layouts(),
				'default_value' => $options_map['default_value'],
				'visibility'    => array(
					'map_for_page_builder' => $options_map['visibility'],
					'map_for_widget' => $options_map['visibility']
				)
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'size',
				'title'      => esc_html__( 'Size', 'makao-core' ),
				'options'    => array(
					''      => esc_html__( 'Normal', 'makao-core' ),
					'small' => esc_html__( 'Small', 'makao-core' ),
					'large' => esc_html__( 'Large', 'makao-core' )
				)
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'text',
				'title'      => esc_html__( 'Button Text', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'link',
				'title'      => esc_html__( 'Button Link', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'target',
				'title'         => esc_html__( 'Target', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self'
			) );
            $this->set_option( array(
                'field_type' => 'select',
                'name'       => 'skin',
                'title'      => esc_html__( 'Skin', 'makao-core' ),
                'options'    => array(
                    ''      => esc_html__( 'Default', 'makao-core' ),
                    'light' => esc_html__( 'Light', 'makao-core' )
                ),
                'dependency'    => array(
                    'show' => array(
                        'button_layout' => array(
                            'values'        => 'textual',
                            'default_value' => ''
                        )
                    )
                ),
                'group'      => esc_html__( 'Style', 'makao-core' )
            ) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'color',
				'title'      => esc_html__( 'Text Color', 'makao-core' ),
				'group'      => esc_html__( 'Style', 'makao-core' )
			) );
			$this->set_option( array(
				'name'       => 'hover_color',
				'field_type' => 'color',
				'title'      => esc_html__( 'Text Hover Color', 'makao-core' ),
				'group'      => esc_html__( 'Style', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'background_color',
				'title'      => esc_html__( 'Background Color', 'makao-core' ),
				'group'      => esc_html__( 'Style', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'hover_background_color',
				'title'      => esc_html__( 'Background Hover Color', 'makao-core' ),
				'group'      => esc_html__( 'Style', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'border_color',
				'title'      => esc_html__( 'Border Color', 'makao-core' ),
				'group'      => esc_html__( 'Style', 'makao-core' ),
				'dependency'    => array(
                    'show' => array(
                        'button_layout' => array(
                            'values'        => array( 'filled', 'outlined' ),
                            'default_value' => ''
                        )
                    )
                ),
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'border_inner_color',
				'title'      => esc_html__( 'Border Inner Color', 'makao-core' ),
				'group'      => esc_html__( 'Style', 'makao-core' ),
				'dependency'    => array(
                    'show' => array(
                        'button_layout' => array(
                            'values'        => array( 'filled', 'outlined' ),
                            'default_value' => ''
                        )
                    )
                ),
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'hover_border_inner_color',
				'title'      => esc_html__( 'Border Inner Hover Color', 'makao-core' ),
				'group'      => esc_html__( 'Style', 'makao-core' ),
				'dependency'    => array(
                    'show' => array(
                        'button_layout' => array(
                            'values'        => array( 'filled', 'outlined' ),
                            'default_value' => ''
                        )
                    )
                ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'margin',
				'title'      => esc_html__( 'Margin', 'makao-core' ),
				'group'      => esc_html__( 'Style', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'padding',
				'title'      => esc_html__( 'Padding', 'makao-core' ),
				'group'      => esc_html__( 'Style', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'font_size',
				'title'      => esc_html__( 'Font Size', 'makao-core' ),
				'group'      => esc_html__( 'Typography', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'font_weight',
				'title'      => esc_html__( 'Font Weight', 'makao-core' ),
				'options'    => makao_core_get_select_type_options_pool( 'font_weight' ),
				'group'      => esc_html__( 'Typography', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'text_transform',
				'title'      => esc_html__( 'Text Transform', 'makao-core' ),
				'options'    => makao_core_get_select_type_options_pool( 'text_transform' ),
				'group'      => esc_html__( 'Typography', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'html_type',
				'title'         => esc_html__( 'HTML Type', 'makao-core' ),
				'options'       => array(
					'default' => esc_html__( 'Default', 'makao-core' ),
					'input'   => esc_html__( 'Input', 'makao-core' ),
					'submit'  => esc_html__( 'Submit', 'makao-core' )
				),
				'default_value' => 'default',
				'visibility'    => array(
					'map_for_page_builder'    => false
				)
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'input_name',
				'title'      => esc_html__( 'Input Name', 'makao-core' ),
				'visibility'    => array(
					'map_for_page_builder'    => false
				)
			) );
			$this->set_option( array(
				'field_type' => 'array',
				'name'       => 'custom_attrs',
				'title'      => esc_html__( 'Custom Data Attributes', 'makao-core' ),
				'visibility'    => array(
					'map_for_page_builder'    => false
				)
			) );
		}
		
		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'makao_core_button', $params );
			$html = str_replace( "\n", '', $html );
			
			return $html;
		}
		
		public function render( $options, $content = null ) {
			
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['data_attrs']     = $this->get_data_attrs( $atts );
			$atts['styles']         = $this->get_styles( $atts );

			return makao_core_get_template_part( 'shortcodes/button', 'variations/'.$atts['button_layout'].'/templates/' . $atts['html_type'], '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-button';
			$holder_classes[] = ! empty( $atts['button_layout'] ) ? 'qodef-layout--' . $atts['button_layout'] : '';
			$holder_classes[] = ! empty( $atts['size'] ) ? 'qodef-size--' . $atts['size'] : '';
			$holder_classes[] = $atts['html_type'] === 'default' ? 'qodef-html--link' : '';
			$holder_classes[] = $atts['skin'] === 'light' && $atts['button_layout'] === 'textual' ? 'qodef-button-light' : '';

			return implode( ' ', $holder_classes );
		}
		
		private function get_data_attrs( $atts ) {
			$data = array();
			
			if ( ! empty( $atts['hover_color'] ) ) {
				$data['data-hover-color'] = $atts['hover_color'];
			}
			
			if ( ! empty( $atts['hover_background_color'] ) ) {
				$data['data-hover-background-color'] = $atts['hover_background_color'];
			}
			
			if ( ! empty( $atts['border_inner_color'] ) ) {
				$data['data-border-inner-color'] = $atts['border_inner_color'];
			}
			
			if ( ! empty( $atts['hover_border_inner_color'] ) ) {
				$data['data-hover-border-inner-color'] = $atts['hover_border_inner_color'];
			}
			
			if ( ! empty( $atts['custom_attrs'] ) && is_array( $atts['custom_attrs'] ) ) {
				$data = array_merge( $data, $atts['custom_attrs'] );
			}
			
			return $data;
		}
		
		private function get_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['color'] ) ) {
				$styles[] = 'color: ' . $atts['color'];
			}
			
			if ( ! empty( $atts['background_color'] ) && $atts['button_layout'] !== 'outlined' && $atts['button_layout'] !== 'textual' ) {
				$styles[] = 'background-color: ' . $atts['background_color'];
			}

            if ( ! empty( $atts['border_color'] ) && $atts['button_layout'] === 'filled' || $atts['button_layout'] === 'outlined' ) {
                $styles[] = 'border: ' . '1px solid ' . $atts['border_color'];
            }
			
			if ( ! empty( $atts['font_size'] ) ) {
				if ( qode_framework_string_ends_with_typography_units( $atts['font_size'] ) ) {
					$styles[] = 'font-size: ' . $atts['font_size'];
				} else {
					$styles[] = 'font-size: ' . intval( $atts['font_size'] ) . 'px';
				}
			}
			
			if ( ! empty( $atts['font_weight'] ) ) {
				$styles[] = 'font-weight: ' . $atts['font_weight'];
			}
			
			if ( ! empty( $atts['text_transform'] ) ) {
				$styles[] = 'text-transform: ' . $atts['text_transform'];
			}
			
			if ( $atts['margin'] !== '' ) {
				$styles[] = 'margin: ' . $atts['margin'];
			}
			
			if ( $atts['padding'] !== '' ) {
				$styles[] = 'padding: ' . $atts['padding'];
			}
			
			return $styles;
		}
	}
}
<?php

if ( ! function_exists( 'makao_core_add_image_with_text_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function makao_core_add_image_with_text_shortcode( $shortcodes ) {
		$shortcodes[] = 'MakaoCoreImageWithTextShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'makao_core_filter_register_shortcodes', 'makao_core_add_image_with_text_shortcode' );
}

if ( class_exists( 'MakaoCoreShortcode' ) ) {
	class MakaoCoreImageWithTextShortcode extends MakaoCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'makao_core_filter_image_with_text_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'makao_core_filter_image_with_text_extra_options', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( MAKAO_CORE_SHORTCODES_URL_PATH . '/image-with-text' );
			$this->set_base( 'makao_core_image_with_text' );
			$this->set_name( esc_html__( 'Image With Text', 'makao-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds image with text element', 'makao-core' ) );
			$this->set_category( esc_html__( 'Makao Core', 'makao-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'makao-core' ),
			) );
			
			$options_map = makao_core_get_variations_options_map( $this->get_layouts() );
			
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'layout',
				'title'         => esc_html__( 'Layout', 'makao-core' ),
				'options'		=> $this->get_layouts(),
				'default_value' => $options_map['default_value'],
				'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] )
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'image',
				'title'      => esc_html__( 'Image', 'makao-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'image_size',
				'title'      => esc_html__( 'Image Size', 'makao-core' ),
				'description'=> esc_html__( 'For predefined image sizes input thumbnail, medium, large or full. If you wish to set a custom image size, type in the desired image dimensions in pixels (e.g. 400x400).', 'makao-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'image_action',
				'title'         => esc_html__( 'Image Action', 'makao-core' ),
				'options'       => array(
					''                => esc_html__( 'No Action', 'makao-core' ),
					'open-popup'      => esc_html__( 'Open Popup', 'makao-core' ),
					'custom-link'     => esc_html__( 'Custom Link', 'makao-core' ),
                    'scrolling-image' => esc_html__( 'Scrolling Image', 'makao-core' )
				)
			) );
            $this->set_option( array(
                'field_type'    => 'select',
                'name'          => 'scrolling_direction',
                'title'         => esc_html__( 'Scrolling Direction', 'makao-core' ),
                'options'       => array(
                    'vertical'   => esc_html__( 'Vertical', 'makao-core' ),
                    'horizontal' => esc_html__( 'Horizontal', 'makao-core' )
                ),
                'dependency' => array(
                    'show' => array(
                        'image_action' => array(
                            'values'        => 'scrolling-image',
                            'default_value' => ''
                        )
                    )
                )
            ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'link',
				'title'      => esc_html__( 'Custom Link', 'makao-core' ),
				'dependency' => array(
					'show' => array(
						'image_action' => array(
							'values'        => array(
							    'custom-link',
                                'scrolling-image'
                            ),
							'default_value' => ''
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'target',
				'title'         => esc_html__( 'Custom Link Target', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self',
				'dependency' => array(
					'show' => array(
						'image_action' => array(
                            'values'        => array(
                                'custom-link',
                                'scrolling-image'
                            ),
							'default_value' => ''
						)
					)
				)
			) );
            $this->set_option( array(
                'field_type' => 'select',
                'name'       => 'text_align',
                'title'      => esc_html__( 'Text Align', 'makao-core' ),
                'options'    => array(
                    ''                => esc_html__( 'Default', 'makao-core' ),
                    'center'          => esc_html__( 'Center', 'makao-core' ),
                    'left'       => esc_html__( 'Left', 'makao-core' )
                )
            ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title',
				'title'      => esc_html__( 'Title', 'makao-core' ),
				'group'      => esc_html__( 'Content', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h2',
				'group'         => esc_html__( 'Content', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'title_color',
				'title'      => esc_html__( 'Title Color', 'makao-core' ),
				'group'      => esc_html__( 'Content', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title_margin_top',
				'title'      => esc_html__( 'Title Margin Top', 'makao-core' ),
				'group'      => esc_html__( 'Content', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type' => 'textarea',
				'name'       => 'text',
				'title'      => esc_html__( 'Text', 'makao-core' ),
				'group'      => esc_html__( 'Content', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'text_color',
				'title'      => esc_html__( 'Text Color', 'makao-core' ),
				'group'      => esc_html__( 'Content', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'text_margin',
				'title'      => esc_html__( 'Text Margin', 'makao-core' ),
				'group'      => esc_html__( 'Content', 'makao-core' )
			) );
			$this->map_extra_options();
		}
		
		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'makao_core_image_with_text', $params );
			$html = str_replace( "\n", '', $html );
			
			return $html;
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['title_styles']   = $this->get_title_styles( $atts );
			$atts['text_styles']    = $this->get_text_styles( $atts );
			$atts['image_params']   = $this->generate_image_params( $atts );
			
			return makao_core_get_template_part( 'shortcodes/image-with-text', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-image-with-text';
			$holder_classes[] = ! empty ( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty ( $atts['image_action'] ) ? 'qodef-image-action--' . $atts['image_action'] : '';
            $holder_classes[] = ! empty ( $atts['scrolling_direction'] ) ? 'qodef-scrolling--' . $atts['scrolling_direction'] : '';
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_title_styles( $atts ) {
			$styles = array();
			
			if ( $atts['title_margin_top'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $atts['title_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $atts['title_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['title_margin_top'] ) . 'px';
				}
			}
			
			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}

            if ( ! empty( $atts['text_align'] ) ) {
                $styles[] = 'text-align: ' . $atts['text_align'];
            }
			
			return $styles;
		}
		
		private function get_text_styles( $atts ) {
			$styles = array();

            if ( ! empty( $atts['text_margin'] ) ) {
                $styles[] = 'margin: ' . $atts['text_margin'];
            }
			
			if ( ! empty( $atts['text_color'] ) ) {
				$styles[] = 'color: ' . $atts['text_color'];
			}


            if ( ! empty( $atts['text_align'] ) ) {
                $styles[] = 'text-align: ' . $atts['text_align'];
            }
			return $styles;
		}
		
		private function generate_image_params( $atts ) {
			$image = array();
			
			if ( ! empty( $atts['image'] ) ) {
				$id = $atts['image'];
				
				$image['image_id'] = intval( $id );
				$image_original    = wp_get_attachment_image_src( $id, 'full' );
				$image['url']      = $image_original[0];
				$image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );
				
				$image_size = trim( $atts['image_size'] );
				preg_match_all( '/\d+/', $image_size, $matches ); /* check if numeral width and height are entered */
				if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) {
					$image['image_size'] = $image_size;
				} elseif ( ! empty( $matches[0] ) ) {
					$image['image_size'] = array(
						$matches[0][0],
						$matches[0][1]
					);
				} else {
					$image['image_size'] = 'full';
				}
			}
			
			return $image;
		}
	}
}
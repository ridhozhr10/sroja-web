<?php

if ( ! function_exists( 'makao_core_add_stacked_images_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function makao_core_add_stacked_images_shortcode( $shortcodes ) {
		$shortcodes[] = 'MakaoCoreStackedImagesShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'makao_core_filter_register_shortcodes', 'makao_core_add_stacked_images_shortcode' );
}

if ( class_exists( 'MakaoCoreShortcode' ) ) {
	class MakaoCoreStackedImagesShortcode extends MakaoCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'makao_core_filter_stacked_images_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'makao_core_filter_stacked_images_extra_options', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( MAKAO_CORE_SHORTCODES_URL_PATH . '/stacked-images' );
			$this->set_base( 'makao_core_stacked_images' );
			$this->set_name( esc_html__( 'Stacked Images', 'makao-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds image with text element', 'makao-core' ) );
			$this->set_category( esc_html__( 'Makao Core', 'makao-core' ) );
            $this->set_scripts(
                array(
                    'parallax-scroll' => array(
                        'registered'	=> false,
                        'url'			=> MAKAO_CORE_INC_URL_PATH . '/shortcodes/stacked-images/assets/js/plugins/jquery.parallax-scroll.js',
                        'dependency'	=> array( 'jquery' )
                    )
                )
            );

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
				'options'       => $this->get_layouts(),
				'default_value' => $options_map['default_value'],
				'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] )
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'main_image',
				'title'      => esc_html__( 'Main Image', 'makao-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'stacked_image',
				'title'      => esc_html__( 'Stacked Image', 'makao-core' ),
				'dependency' => array(
					'show' => array(
						'layout' => array(
							'values'        => 'image',
							'default_value' => ''
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title',
				'title'      => esc_html__( 'Title', 'makao-core' ),
				'dependency' => array(
					'show' => array(
						'layout' => array(
							'values'        => 'box-with-text',
							'default_value' => ''
						)
					)
				),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h3',
				'dependency' => array(
					'show' => array(
						'layout' => array(
							'values'        => 'box-with-text',
							'default_value' => ''
						)
					)
				)
			) );
			
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title_font_size',
				'title'      => esc_html__( 'Title Font Size', 'makao-core' ),
				'dependency' => array(
					'show' => array(
						'layout' => array(
							'values'        => 'box-with-text',
							'default_value' => ''
						)
					)
				)
			) );
			
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'title_color',
				'title'      => esc_html__( 'Title Color', 'makao-core' ),
				'dependency' => array(
					'show' => array(
						'layout' => array(
							'values'        => 'box-with-text',
							'default_value' => ''
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'textarea',
				'name'       => 'text_field',
				'title'      => esc_html__( 'Text', 'makao-core' ),
				'dependency' => array(
					'show' => array(
						'layout' => array(
							'values'        => 'box-with-text',
							'default_value' => ''
						)
					)
				)
			) );
			
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'email',
				'title'      => esc_html__( 'Email', 'makao-core' ),
				'dependency' => array(
					'show' => array(
						'layout' => array(
							'values'        => 'box-with-text',
							'default_value' => ''
						)
					)
				),
			) );
			
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'phone',
				'title'      => esc_html__( 'Phone', 'makao-core' ),
				'dependency' => array(
					'show' => array(
						'layout' => array(
							'values'        => 'box-with-text',
							'default_value' => ''
						)
					)
				),
			) );
			$this->map_extra_options();
		}

        public function load_assets() {
            wp_enqueue_script( 'parallax-scroll' );
        }
		
		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'makao_core_stacked_images', $params );
			$html = str_replace( "\n", '', $html );
			
			return $html;
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['title_styles']    = $this->get_title_styles( $atts );
			$atts['image_params']   = $this->generate_image_params( $atts );
			
			return makao_core_get_template_part( 'shortcodes/stacked-images', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-stacked-images';
			$holder_classes[] = ! empty ( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_title_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}
			
			if ( ! empty( $atts['title_font_size'] ) ) {
				if ( qode_framework_string_ends_with_typography_units( $atts['title_font_size'] ) ) {
					$styles[] = 'font-size: ' . $atts['title_font_size'];
				} else {
					$styles[] = 'font-size: ' . intval( $atts['title_font_size'] ) . 'px';
				}
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
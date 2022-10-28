<?php

if ( ! function_exists( 'makao_core_add_interactive_link_showcase_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function makao_core_add_interactive_link_showcase_shortcode( $shortcodes ) {
		$shortcodes[] = 'MakaoCoreInteractiveLinkShowcaseShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'makao_core_filter_register_shortcodes', 'makao_core_add_interactive_link_showcase_shortcode' );
}

if ( class_exists( 'MakaoCoreShortcode' ) ) {
	class MakaoCoreInteractiveLinkShowcaseShortcode extends MakaoCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'makao_core_filter_interactive_link_showcase_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'makao_core_filter_interactive_link_showcase_extra_options', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( MAKAO_CORE_SHORTCODES_URL_PATH . '/interactive-link-showcase' );
			$this->set_base( 'makao_core_interactive_link_showcase' );
			$this->set_name( esc_html__( 'Interactive Link Showcase', 'makao-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds interactive link showcase holder', 'makao-core' ) );
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
				'field_type' => 'select',
				'name'       => 'skin',
				'title'      => esc_html__( 'Link Skin', 'makao-core' ),
				'options'    => array(
					''      => esc_html__( 'Default', 'makao-core' ),
					'light' => esc_html__( 'Light', 'makao-core' )
				)
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'background_color',
				'title'      => esc_html__( 'Background Color', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'link_target',
				'title'         => esc_html__( 'Link Target', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self'
			) );
			$this->set_option( array(
				'field_type' => 'repeater',
				'name'       => 'children',
				'title'      => esc_html__( 'Child elements', 'makao-core' ),
				'items'   => array(
					array(
						'field_type'    => 'text',
						'name'          => 'item_link',
						'title'         => esc_html__( 'Link', 'makao-core' ),
						'default_value' => ''
					),
					array(
						'field_type' => 'text',
						'name'       => 'item_title',
						'title'      => esc_html__( 'Title', 'makao-core' )
					),
                    array(
                        'field_type' => 'color',
                        'name'       => 'item_bg_color',
                        'title'      => esc_html__( 'Background Color', 'makao-core' )
                    ),
					array(
						'field_type' => 'image',
						'name'       => 'item_image_1',
						'title'      => esc_html__( 'Image 1', 'makao-core' ),
						'multiple'   => 'yes'
					),
					array(
						'field_type' => 'image',
						'name'       => 'item_image_2',
						'title'      => esc_html__( 'Image 2', 'makao-core' ),
						'multiple'   => 'yes'
					),
					array(
						'field_type' => 'image',
						'name'       => 'item_image_3',
						'title'      => esc_html__( 'Image 3', 'makao-core' ),
						'multiple'   => 'yes'
					),
					array(
						'field_type' => 'image',
						'name'       => 'item_image_4',
						'title'      => esc_html__( 'Image 4', 'makao-core' ),
						'multiple'   => 'yes'
					),
					array(
						'field_type' => 'image',
						'name'       => 'item_image_5',
						'title'      => esc_html__( 'Image 5', 'makao-core' ),
						'multiple'   => 'yes'
					)
				)
			) );
			$this->map_extra_options();
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['holder_styles']  = $this->get_holder_styles( $atts );
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );
			$atts['this_shortcode'] = $this;
			
			return makao_core_get_template_part( 'shortcodes/interactive-link-showcase', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-interactive-link-showcase';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty( $atts['skin'] ) ? 'qodef-skin--' . $atts['skin'] : '';
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_holder_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['background_color'] ) ) {
				$styles[] = 'background-color: ' . $atts['background_color'];
			}
			
			return $styles;
		}
		
		public function get_image_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['item_image'] ) ) {
				$styles[] = 'background-image: url(' . esc_url( wp_get_attachment_url( $atts['item_image'] ) ) . ')';
			}
			
			return $styles;
		}

		public function get_item_background_styles( $atts ) {
            $styles = array();

            if ( ! empty( $atts['item_bg_color'] ) ) {
                $styles[] = 'background-color: ' . $atts['item_bg_color'];
            }

            return $styles;
        }
	}
}
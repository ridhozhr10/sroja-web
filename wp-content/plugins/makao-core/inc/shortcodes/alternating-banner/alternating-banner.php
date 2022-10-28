<?php

if ( ! function_exists( 'makao_core_add_alternating_banner_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function makao_core_add_alternating_banner_shortcode( $shortcodes ) {
		$shortcodes[] = 'MakaoCoreAlternatingBannerShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'makao_core_filter_register_shortcodes', 'makao_core_add_alternating_banner_shortcode' );
}

if ( class_exists( 'MakaoCoreShortcode' ) ) {
	class MakaoCoreAlternatingBannerShortcode extends MakaoCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'makao_core_filter_alternating_banner_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'makao_core_filter_alternating_banner_extra_options', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( MAKAO_CORE_SHORTCODES_URL_PATH . '/alternating-banner' );
			$this->set_base( 'makao_core_alternating_banner' );
			$this->set_name( esc_html__( 'Alternating Banner', 'makao-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds alternating banner element', 'makao-core' ) );
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
				'options'       => $this->get_layouts(),
				'default_value' => $options_map['default_value'],
				'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] )
			) );
            $this->set_option( array(
                'field_type'    => 'select',
                'name'          => 'appear_animation',
                'title'         => esc_html__( 'Enable Animation on Appear', 'makao-core' ),
                'options'       => makao_core_get_select_type_options_pool('no_yes', false),
                'default_value' => 'no'
            ) );
			$this->set_option( array(
				'field_type' => 'repeater',
				'name'       => 'children',
				'title'      => esc_html__( 'Child elements', 'makao-core' ),
				'items'   => array(
					array(
						'field_type' => 'image',
						'name'       => 'image',
						'title'      => esc_html__( 'Image', 'makao-core' ),
					),
					array(
						'field_type'    => 'select',
						'name'          => 'image_position',
						'title'         => esc_html__( 'Image Position', 'makao-core' ),
						'options'       => array(
							'left'    => esc_html__( 'Left', 'makao-core' ),
							'right'   => esc_html__( 'Right', 'makao-core' )
						),
						'default_value' => 'left',
					),
					array(
						'field_type' => 'text',
						'name'       => 'item_title',
						'title'      => esc_html__( 'Title', 'makao-core' )
					),
					array(
						'field_type' => 'select',
						'name'       => 'item_title_tag',
						'title'      => esc_html__( 'Title Tag', 'makao-core' ),
						'options'    => makao_core_get_select_type_options_pool( 'title_tag', false ),
						'default_value'    => 'h3'
					),
					array(
						'field_type' => 'color',
						'name'       => 'item_title_color',
						'title'      => esc_html__( 'Title Color', 'makao-core' ),
					),
					array(
						'field_type' => 'text',
						'name'       => 'item_subtitle',
						'title'      => esc_html__( 'Subtitle', 'makao-core' )
					),
					array(
						'field_type' => 'select',
						'name'       => 'item_subtitle_tag',
						'title'      => esc_html__( 'Subtitle Tag', 'makao-core' ),
						'options'    => makao_core_get_select_type_options_pool( 'title_tag', false ),
						'default_value'    => 'h6'
					),
					array(
						'field_type' => 'color',
						'name'       => 'item_subtitle_color',
						'title'      => esc_html__( 'Subtitle Color', 'makao-core' ),
					),
					array(
						'field_type' => 'text',
						'name'       => 'button_text',
						'title'      => esc_html__( 'Button Text', 'makao-core' ),
                        'description' => esc_html__( 'If you leave empty Button Text option link will be placed over whole image', 'makao-core' ),
					),
					array(
						'field_type'    => 'select',
						'name'          => 'button_type',
						'title'         => esc_html__( 'Button Type', 'makao-core' ),
						'options'       => array(
							'filled'      => esc_html__( 'Filled', 'makao-core' ),
							'outlined'    => esc_html__( 'Outlined', 'makao-core' ),
							'textual'     => esc_html__( 'Textual', 'makao-core' )
						),
						'default_value' => 'outlined',
					),
					array(
						'field_type' => 'text',
						'name'       => 'link_url',
						'title'      => esc_html__( 'Link', 'makao-core' )
					),
					array(
						'field_type'    => 'select',
						'name'          => 'link_target',
						'title'         => esc_html__( 'Link Target', 'makao-core' ),
						'options'       => makao_core_get_select_type_options_pool( 'link_target' ),
						'default_value' => '_self'
					),
				)
			) );
			$this->map_extra_options();
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes']  = $this->get_holder_classes( $atts );
			$atts['items']           = array_chunk( $this->parse_repeater_items( $atts['children'] ), ceil( count( $this->parse_repeater_items( $atts['children'] ) ) ) );
			$atts['this_shortcode']  = $this;
			
			return makao_core_get_template_part( 'shortcodes/alternating-banner', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-alternating-banner';
			$holder_classes[] = ! empty ( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty ( $atts['appear_animation'] ) && $atts['appear_animation'] === 'yes' ? 'qodef-appear-animation': '';
			
			return implode( ' ', $holder_classes );
		}
	}
}
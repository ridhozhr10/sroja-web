<?php

if ( ! function_exists( 'makao_core_add_call_to_action_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function makao_core_add_call_to_action_shortcode( $shortcodes ) {
		$shortcodes[] = 'MakaoCoreCallToActionShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'makao_core_filter_register_shortcodes', 'makao_core_add_call_to_action_shortcode' );
}

if ( class_exists( 'MakaoCoreShortcode' ) ) {
	class MakaoCoreCallToActionShortcode extends MakaoCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'makao_core_filter_call_to_action_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'makao_core_filter_call_to_action_extra_options', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( MAKAO_CORE_SHORTCODES_URL_PATH . '/call-to-action' );
			$this->set_base( 'makao_core_call_to_action' );
			$this->set_name( esc_html__( 'Call to Action', 'makao-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds call to action element', 'makao-core' ) );
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
				'visibility'    => array(
					'map_for_page_builder' => $options_map['visibility'],
					'map_for_widget' => $options_map['visibility']
				)
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'style',
				'title'         => esc_html__( 'Style', 'makao-core' ),
				'options'       => array(
					'stretched' => esc_html__( 'Stretched', 'makao-core' ),
					'centered' => esc_html__( 'Centered', 'makao-core' )
				),
				'default_value' => 'stretched'
			) );
			$this->set_option( array(
				'field_type' => 'html',
				'name'       => 'content',
				'title'      => esc_html__( 'Content', 'makao-core' )
			) );
			$this->import_shortcode_options( array(
				'shortcode_base'    => 'makao_core_button',
				'exclude'           => array( 'custom_class' ),
				'additional_params' => array(
					'group' => esc_html__( 'Button', 'makao-core' ),
				)
			) );
			$this->map_extra_options();
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['button_params']  = $this->generate_button_params( $atts );
			$atts['content']        = $this->get_editor_content( $content, $options );
			
			return makao_core_get_template_part( 'shortcodes/call-to-action', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-call-to-action';
			$holder_classes[] = ! empty ( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty ( $atts['style'] ) ? 'qodef-style--' . $atts['style'] : '';
			
			return implode( ' ', $holder_classes );
		}
		
		private function generate_button_params( $atts ) {
			$params = $this->populate_imported_shortcode_atts( array(
				'shortcode_base' => 'makao_core_button',
				'exclude'        => array( 'custom_class' ),
				'atts'           => $atts,
			) );
			
			return $params;
		}
	}
}
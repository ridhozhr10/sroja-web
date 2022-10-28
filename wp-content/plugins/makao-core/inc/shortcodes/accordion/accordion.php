<?php

if ( ! function_exists( 'makao_core_add_accordion_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function makao_core_add_accordion_shortcode( $shortcodes ) {
		$shortcodes[] = 'MakaoCoreAccordionShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'makao_core_filter_register_shortcodes', 'makao_core_add_accordion_shortcode' );
}

if ( class_exists( 'MakaoCoreShortcode' ) ) {
	class MakaoCoreAccordionShortcode extends MakaoCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'makao_core_filter_accordion_layouts', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( MAKAO_CORE_SHORTCODES_URL_PATH . '/accordion' );
			$this->set_base( 'makao_core_accordion' );
			$this->set_name( esc_html__( 'Accordion', 'makao-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds accordion holder', 'makao-core' ) );
			$this->set_category( esc_html__( 'Makao Core', 'makao-core' ) );
			$this->set_is_parent_shortcode( true );
			$this->set_child_elements( array(
				'makao_core_accordion_child'
			) );

			$this->set_scripts(
				array(
					'jquery-ui-accordion' => array(
						'registered'	=> true
					)
				)
			);

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
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'makao-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'behavior',
				'title'         => esc_html__( 'Behavior', 'makao-core' ),
				'options'       => array(
					'accordion' => esc_html__( 'Accordion', 'makao-core' ),
					'toggle'    => esc_html__( 'Toggle', 'makao-core' )
				),
				'default_value' => 'accordion'
			) );
		}
		
		public static function call_shortcode( $params ) {
			$content = null;
			
			if ( isset( $params['accordion_titles'] ) && ! empty( $params['accordion_titles'] ) && isset( $params['accordion_contents'] ) && ! empty( $params['accordion_contents'] ) ) {
				$title_tag = isset( $params['accordion_title_tag'] ) && ! empty( $params['accordion_title_tag'] ) ? esc_attr( $params['accordion_title_tag'] ) : '';
				
				foreach ( $params['accordion_titles'] as $index => $title ) {
					$content .= '[makao_core_accordion_child title_tag="' . esc_attr( $title_tag ) . '" title="' . esc_attr( $title ) . '"]' . $params['accordion_contents'][ $index ] . '[/makao_core_accordion_child]';
				}
			}
			
			$html = qode_framework_call_shortcode( 'makao_core_accordion', $params, $content );
			
			return $html;
		}
		
		public function load_assets() {
			wp_enqueue_script( 'jquery-ui-accordion' );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			$atts['holder_classes'] = $this->get_holder_classes( $atts );

			$atts['content'] = preg_replace('/\[makao_core_accordion_child/i', '[makao_core_accordion_child layout="'.$atts['layout'].'"', $content);

			return makao_core_get_template_part( 'shortcodes/accordion', 'variations/'.$atts['layout'].'/templates/holder', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-accordion';
			$holder_classes[] = 'clear';
			$holder_classes[] = ! empty( $atts['behavior'] ) ? 'qodef-behavior--' . $atts['behavior'] : '';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';

			return implode( ' ', $holder_classes );
		}
	}
}
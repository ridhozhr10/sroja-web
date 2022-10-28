<?php

if ( ! function_exists( 'makao_core_add_info_section_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function makao_core_add_info_section_shortcode( $shortcodes ) {
		$shortcodes[] = 'MakaoCoreInfoSectionShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'makao_core_filter_register_shortcodes', 'makao_core_add_info_section_shortcode' );
}

if ( class_exists( 'MakaoCoreShortcode' ) ) {
	class MakaoCoreInfoSectionShortcode extends MakaoCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'makao_core_filter_info_section_layouts', array() ) );
			
			$options_map = makao_core_get_variations_options_map( $this->get_layouts() );
			$default_value = $options_map['default_value'];
			
			$this->set_extra_options( apply_filters( 'makao_core_filter_info_section_extra_options', array(), $default_value ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( MAKAO_CORE_SHORTCODES_URL_PATH . '/info-section' );
			$this->set_base( 'makao_core_info_section' );
			$this->set_name( esc_html__( 'Info Section', 'makao-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds info section element', 'makao-core' ) );
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
					'map_for_page_builder' => $options_map['visibility']
				)
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title',
				'title'      => esc_html__( 'Title', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h4'
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'line_break_positions',
				'title'       => esc_html__( 'Positions of Line Break', 'makao-core' ),
				'description' => esc_html__( 'Enter the positions of the words after which you would like to create a line break. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a line break, you would enter "1,3,4")', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'disable_title_break_words',
				'title'         => esc_html__( 'Disable Title Line Break', 'makao-core' ),
				'description'   => esc_html__( 'Enabling this option will disable title line breaks for screen size 1024 and lower', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'no_yes', false ),
				'default_value' => 'no'
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'title_color',
				'title'      => esc_html__( 'Title Color', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type' => 'textarea',
				'name'       => 'info_text',
				'title'      => esc_html__( 'Text', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'info_text_color',
				'title'      => esc_html__( 'Text Color', 'makao-core' )
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
			$atts['title']          = $this->get_modified_title( $atts );
			$atts['title_styles']   = $this->get_title_styles( $atts );
			$atts['text_styles']    = $this->get_text_styles( $atts );
			
			$atts = apply_filters( 'makao_core_filter_info_section_variation_atts', $atts );
			
			return makao_core_get_template_part( 'shortcodes/info-section', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-info-section';
			$holder_classes[] = ! empty ( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[]  = $atts['disable_title_break_words'] === 'yes' ? 'qodef-title-break--disabled' : '';
			$holder_classes = apply_filters( 'makao_core_filter_info_section_variation_classes', $holder_classes, $atts );
			
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
		
		private function get_modified_title( $atts ) {
			$title = $atts['title'];
			
			if ( ! empty( $title ) && ! empty( $atts['line_break_positions'] ) ) {
				$split_title          = explode( ' ', $title );
				$line_break_positions = explode( ',', str_replace( ' ', '', $atts['line_break_positions'] ) );
				
				foreach ( $line_break_positions as $position ) {
					if ( isset( $split_title[ $position - 1 ] ) && ! empty( $split_title[ $position - 1 ] ) ) {
						$split_title[ $position - 1 ] = $split_title[ $position - 1 ] . '<br />';
					}
				}
				
				$title = implode( ' ', $split_title );
			}
			
			return $title;
		}
		
		private function get_title_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}
			
			return $styles;
		}
		
		private function get_text_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['info_text_color'] ) ) {
				$styles[] = 'color: ' . $atts['info_text_color'];
			}
			
			return $styles;
		}
	}
}
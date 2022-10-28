<?php

if ( ! function_exists( 'makao_core_add_accordion_child_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function makao_core_add_accordion_child_shortcode( $shortcodes ) {
		$shortcodes[] = 'MakaoCoreAccordionChildShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'makao_core_filter_register_shortcodes', 'makao_core_add_accordion_child_shortcode' );
}

if ( class_exists( 'MakaoCoreShortcode' ) ) {
	class MakaoCoreAccordionChildShortcode extends MakaoCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( MAKAO_CORE_SHORTCODES_URL_PATH . '/accordion' );
			$this->set_base( 'makao_core_accordion_child' );
			$this->set_name( esc_html__( 'Accordion Child', 'makao-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds accordion child to accordion holder', 'makao-core' ) );
			$this->set_category( esc_html__( 'Makao Core', 'makao-core' ) );
			$this->set_is_child_shortcode( true );
			$this->set_parent_elements( array(
				'makao_core_accordion'
			) );
			$this->set_is_parent_shortcode( true );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title',
				'title'      => esc_html__( 'Title', 'makao-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h6'
			) );
			$this->set_option( array(
				'field_type'    => 'text',
				'name'          => 'layout',
				'title'         => esc_html__( 'Layout', 'makao-core' ),
				'default_value' => '',
				'visibility'    => array('map_for_page_builder' => false)
			) );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			$atts['content'] = $content;

			return makao_core_get_template_part( 'shortcodes/accordion', 'variations/'.$atts['layout'].'/templates/child', '', $atts );
		}
	}
}
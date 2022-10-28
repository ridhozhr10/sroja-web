<?php

if ( ! function_exists( 'makao_core_add_taxonomy_list_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function makao_core_add_taxonomy_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'MakaoCoreTaxonomyListShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'makao_core_filter_register_shortcodes', 'makao_core_add_taxonomy_list_shortcode' );
}

if ( class_exists( 'MakaoCoreListShortcode' ) ) {
	class MakaoCoreTaxonomyListShortcode extends MakaoCoreListShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'makao_core_filter_taxonomy_list_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'makao_core_filter_taxonomy_list_extra_options', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( MAKAO_CORE_SHORTCODES_URL_PATH . '/taxonomy-list' );
			$this->set_base( 'makao_core_taxonomy_list' );
			$this->set_name( esc_html__( 'Taxonomy List', 'makao-core' ) );
			$this->set_description( esc_html__( 'Shortcode that display list of categories', 'makao-core' ) );
			$this->set_category( esc_html__( 'Makao Core', 'makao-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'taxonomy',
				'title'      => esc_html__( 'Taxonomy', 'makao-core' ),
				'options'    => qode_framework_get_framework_root()->get_custom_post_type_taxonomies(),
				'group'      => esc_html__( 'Query', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'hide_empty',
				'title'      => esc_html__( 'Hide Empty', 'makao-core' ),
				'options'    => makao_core_get_select_type_options_pool( 'no_yes', false ),
				'group'      => esc_html__( 'Query', 'makao-core' )
			) );
			$this->map_list_options();
			$this->map_query_options( array(
				'exclude_option' => array( 'additional_params' )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'additional_params',
				'title'      => esc_html__( 'Additional Params', 'makao-core' ),
				'options'    => array(
					''   => esc_html__( 'No', 'makao-core' ),
					'id' => esc_html__( 'Taxonomy IDs', 'makao-core' ),
				),
				'group'      => esc_html__( 'Query', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'taxonomy_ids',
				'title'       => esc_html__( 'Taxonomy IDs', 'makao-core' ),
				'description' => esc_html__( 'Separate taxonomy IDs with commas', 'makao-core' ),
				'group'       => esc_html__( 'Query', 'makao-core' ),
				'dependency'  => array(
					'show' => array(
						'additional_params' => array(
							'values'        => 'id',
							'default_value' => ''
						)
					)
				)
			) );
			$this->map_layout_options( array( 'layouts' => $this->get_layouts() ) );
			$this->map_additional_options( array( 'exclude_filter' => true, 'exclude_pagination' => true ) );
			$this->map_extra_options();
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			
			$atts = $this->get_atts();
			
			$atts['query_result']   = new \WP_Term_Query( makao_core_get_taxonomy_query_params( $atts ) );
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['slider_attr']    = $this->get_slider_data( $atts );
			$atts['data_attr']      = makao_core_get_pagination_data( MAKAO_CORE_REL_PATH, 'shortcodes/taxonomy-list', 'taxonomy-list', '', $atts );
			
			$atts['this_shortcode'] = $this;
			
			return makao_core_get_template_part( 'shortcodes/taxonomy-list', 'templates/content', $atts['behavior'], $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-taxonomy-list';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			
			$list_classes            = $this->get_list_classes( $atts );
			$hover_animation_classes = $this->get_hover_animation_classes( $atts );
			$holder_classes          = array_merge( $holder_classes, $list_classes, $hover_animation_classes );
			
			return implode( ' ', $holder_classes );
		}
		
		public function get_item_classes( $atts ) {
			$item_classes = $this->init_item_classes();
			
			$list_item_classes = $this->get_list_item_classes( $atts );
			
			$item_classes = array_merge( $item_classes, $list_item_classes );
			
			return implode( ' ', $item_classes );
		}
		
		public function get_title_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['text_transform'] ) ) {
				$styles[] = 'text-transform: ' . $atts['text_transform'];
			}
			
			return $styles;
		}
	}
}
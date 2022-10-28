<?php

if ( ! function_exists( 'makao_core_add_product_list_shortcode' ) ) {
	/**
	 * Function that is adding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function makao_core_add_product_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'MakaoCoreProductListShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'makao_core_filter_register_shortcodes', 'makao_core_add_product_list_shortcode' );
}

if ( class_exists( 'MakaoCoreListShortcode' ) ) {
	class MakaoCoreProductListShortcode extends MakaoCoreListShortcode {
		
		public function __construct() {
			$this->set_post_type( 'product' );
			$this->set_post_type_taxonomy( 'product_cat' );
			$this->set_post_type_additional_taxonomies( array( 'product_tag', 'product_type' ) );
			$this->set_layouts( apply_filters( 'makao_core_filter_product_list_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'makao_core_filter_product_list_extra_options', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( MAKAO_CORE_PLUGINS_URL_PATH . '/woocommerce/shortcodes/product-list' );
			$this->set_base( 'makao_core_product_list' );
			$this->set_name( esc_html__( 'Product List', 'makao-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays list of products', 'makao-core' ) );
			$this->set_category( esc_html__( 'Makao Core', 'makao-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'makao-core' )
			) );
			$this->map_list_options();
			$this->map_query_options( array( 'post_type' => $this->get_post_type() ) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'filterby',
				'title'         => esc_html__( 'Filter By', 'makao-core' ),
				'options'       => array(
					''             => esc_html__( 'Default', 'makao-core' ),
					'on_sale'      => esc_html__( 'On Sale', 'makao-core' ),
					'featured'     => esc_html__( 'Featured', 'makao-core' ),
					'top_rated'    => esc_html__( 'Top Rated', 'makao-core' ),
					'best_selling' => esc_html__( 'Best Selling', 'makao-core' )
				),
				'default_value' => '',
				'group'         => esc_html__( 'Query', 'makao-core' ),
				'dependency'    => array(
					'show' => array(
						'additional_params' => array(
							'values'        => '',
							'default_value' => ''
						)
					)
				)
			) );
			$this->map_layout_options( array( 'layouts' => $this->get_layouts() ) );
			$this->map_additional_options();
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'display_category',
				'title'         => esc_html__( 'Display Category', 'makao-core' ),
				'options'       => array(
					''             => esc_html__( 'No', 'makao-core' ),
					'yes'      => esc_html__( 'Yes', 'makao-core' )
				),
				'default_value' => '',
				'group'         => esc_html__( 'Additional', 'makao-core' )
			) );
			$this->map_extra_options();
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'makao_core_product_list', $params );
			$html = str_replace( "\n", '', $html );
			
			return $html;
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			
			$atts = $this->get_atts();
			
			$atts['post_type']       = $this->get_post_type();
			$atts['taxonomy_filter'] = $this->get_post_type_taxonomy();
			
			// Additional query args
			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['query_result']   = new \WP_Query( makao_core_get_query_params( $atts ) );
			
			
			$slider_data = json_decode($this->get_slider_data( $atts ));
			if ($slider_data->spaceBetween === 25) {
				$slider_data->spaceBetween = 30;
			}
			$slider_data = json_encode($slider_data);
			
			$atts['slider_attr']    = $slider_data;
			$atts['data_attr']      = makao_core_get_pagination_data( MAKAO_CORE_REL_PATH, 'plugins/woocommerce/shortcodes', 'product-list', 'product', $atts );
			
			$atts['this_shortcode'] = $this;
			
			return makao_core_get_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/content', $atts['behavior'], $atts );
		}
		
		public function get_additional_query_args( $atts ) {
			$args = parent::get_additional_query_args( $atts );
			
			if ( ! empty( $atts['filterby'] ) ) {
				switch ( $atts['filterby'] ) {
					case 'on_sale':
						$args['no_found_rows'] = 1;
						$args['post__in']      = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
						break;
					case 'featured':
						$args['tax_query'] = WC()->query->get_tax_query();
						
						$args['tax_query'][] = array(
							'taxonomy'         => 'product_visibility',
							'terms'            => 'featured',
							'field'            => 'name',
							'operator'         => 'IN',
							'include_children' => false,
						);
						break;
					case 'top_rated':
						$args['meta_key'] = '_wc_average_rating';
						$args['order']    = 'DESC';
						$args['orderby']  = 'meta_value_num';
						break;
					case 'best_selling':
						$args['meta_key'] = 'total_sales';
						$args['order']    = 'DESC';
						$args['orderby']  = 'meta_value_num';
						break;
				}
			}
			
			return $args;
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-woo-shortcode';
			$holder_classes[] = 'qodef-woo-product-list';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-item-layout--' . $atts['layout'] : '';
			
			$list_classes   = $this->get_list_classes( $atts );
			$holder_classes = array_merge( $holder_classes, $list_classes );
			
			return implode( ' ', $holder_classes );
		}
		
		public function get_item_classes( $atts ) {
			$item_classes      = $this->init_item_classes();
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
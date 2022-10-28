<?php

if ( ! function_exists( 'makao_core_add_category_with_products_shortcode' ) ) {
	/**
	 * Function that is adding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function makao_core_add_category_with_products_shortcode( $shortcodes ) {
		$shortcodes[] = 'MakaoCoreCategoryWithProductsShortcode';

		return $shortcodes;
	}

	add_filter( 'makao_core_filter_register_shortcodes', 'makao_core_add_category_with_products_shortcode' );
}

if ( class_exists( 'MakaoCoreShortcode' ) ) {
	class MakaoCoreCategoryWithProductsShortcode extends MakaoCoreShortcode {
		
		private $post_type;
		private $post_type_taxonomy;
		
		private function get_post_type() {
			return $this->post_type;
		}
		
		private function set_post_type( $post_type ) {
			$this->post_type = $post_type;
		}
		
		private function get_post_type_taxonomy() {
			return $this->post_type_taxonomy;
		}
		
		private function set_post_type_taxonomy( $post_type_taxonomy ) {
			$this->post_type_taxonomy = $post_type_taxonomy;
		}

		public function __construct() {
			$this->set_post_type( 'product' );
			$this->set_post_type_taxonomy( 'product_cat' );
			$this->set_layouts( apply_filters( 'makao_core_filter_category_with_products_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'makao_core_filter_category_with_products_extra_options', array() ) );
			
			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( MAKAO_CORE_PLUGINS_URL_PATH . '/woocommerce/shortcodes/product-list' );
			$this->set_base( 'makao_core_category_with_products' );
			$this->set_name( esc_html__( 'Category with Products', 'makao-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays category and two porducts', 'makao-core' ) );
			$this->set_category( esc_html__( 'Makao Core', 'makao-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'makao-core' )
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
				'field_type'  => 'text',
				'name'        => 'category_slug',
				'title'       => esc_html__( 'Category Slug', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'orderby',
				'title'         => esc_html__( 'Order Products By', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'order_by', true),
				'default_value' => 'date'
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'order',
				'title'         => esc_html__( 'Order Products', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'order' ),
				'default_value' => 'DESC'
			) );
			
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h3',
				'group'         => esc_html__( 'Layout', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'image_position',
				'title'         => esc_html__( 'Category Image Position', 'makao-core' ),
				'options'       => array(
					''         => esc_html__( 'Left', 'makao-core' ),
					'right'    => esc_html__( 'Right', 'makao-core' ),
				),
				'default_value' => '',
				'group'         => esc_html__( 'Layout', 'makao-core' )
			) );
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'makao_core_category_with_products', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts = $this->get_atts();

			$atts['post_type']      = $this->get_post_type();
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['categories']     = $this->get_categories( $atts );

			$atts['this_shortcode'] = $this;
			
			return makao_core_get_template_part( 'plugins/woocommerce/shortcodes/category-with-products', 'variations/' . $atts['layout'] . '/' . $atts['layout'], '', $atts  );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-woo-shortcode';
			$holder_classes[] = 'qodef-woo-category-with-products';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-item-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty( $atts['image_position'] ) && $atts['image_position'] === 'right' ? 'qodef-woo-category-image-right' : '';
			
			return implode( ' ', $holder_classes );
		}

		public function get_title_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['text_transform'] ) ) {
				$styles[] = 'text-transform: ' . $atts['text_transform'];
			}

			return $styles;
		}

		private function get_categories( $atts ) {
			$slugs   = ! empty( $atts['category_slugs'] ) ? explode( ',', $atts['category_slugs'] ) : '';

			$args = array(
				'taxonomy'     => $this->get_post_type_taxonomy(),
				'slug'         => $slugs,
				'hide_empty'   => true,
				'hierarchical' => false,
			);
			
			$terms = get_terms( $args );

			
			$cats = array();
			
			foreach ($terms as $term) {
				if( ! empty($term->slug) && ! empty($term->name) ) {
					$cats[ $term->slug ] = $term->name;
				}
			}

			
			return $cats;
		}
		
	}
}
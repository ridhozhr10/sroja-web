<?php

if ( ! function_exists( 'makao_core_add_blog_list_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function makao_core_add_blog_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'MakaoCoreBlogListShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'makao_core_filter_register_shortcodes', 'makao_core_add_blog_list_shortcode' );
}

if ( class_exists( 'MakaoCoreListShortcode' ) ) {
	class MakaoCoreBlogListShortcode extends MakaoCoreListShortcode {
		
		public function __construct() {
			$this->set_post_type( 'post' );
			$this->set_post_type_taxonomy( 'category' );
			$this->set_post_type_additional_taxonomies( array( 'post_tag' ) );
			$this->set_layouts( apply_filters( 'makao_core_filter_blog_list_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'makao_core_filter_blog_list_extra_options', array() ) );
			$this->set_hover_animation_options( apply_filters( 'makao_core_filter_blog_list_hover_animation_options', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( MAKAO_CORE_INC_URL_PATH . '/blog/shortcodes/blog-list' );
			$this->set_base( 'makao_core_blog_list' );
			$this->set_name( esc_html__( 'Blog List', 'makao-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays list of blog posts', 'makao-core' ) );
			$this->set_category( esc_html__( 'Makao Core', 'makao-core' ) );
			$this->set_scripts(
				apply_filters('makao_core_filter_blog_list_register_scripts', array())
			);
			$this->set_necessary_styles(
				apply_filters('makao_core_filter_blog_list_register_styles', array())
			);
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'makao-core' )
			) );
			$this->map_list_options();
			$this->map_query_options();
			$this->map_layout_options( array(
				'layouts'          => $this->get_layouts(),
				'hover_animations' => $this->get_hover_animation_options()
			) );
            $this->set_option( array(
                'field_type' => 'select',
                'name'       => 'show_excerpt',
                'title'      => esc_html__( 'Show Excerpt', 'makao-core' ),
                'options'    => makao_core_get_select_type_options_pool( 'yes_no', false ),
                'group'      => esc_html__( 'Layout', 'makao-core' ),
                'dependency'    => array(
                    'show' => array(
                        'layout' => array(
                            'values'        => array('standard', 'minimal'),
                            'default_value' => 'standard'
                        )
                    )
                )
            ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'excerpt_length',
				'title'      => esc_html__( 'Excerpt Length', 'makao-core' ),
				'group'      => esc_html__( 'Layout', 'makao-core' ),
                'dependency'    => array(
                    'show' => array(
                        'show_excerpt' => array(
                            'values'        => 'yes',
                            'default_value' => 'yes'
                        )
                    )
                )
			) );
            $this->set_option( array(
                'field_type' => 'select',
                'name'       => 'show_blog_list_image',
                'title'      => esc_html__( 'Show Blog List Image', 'makao-core' ),
                'options'    => makao_core_get_select_type_options_pool( 'no_yes', false ),
                'description' => esc_html__( 'Enabling this option will show Blog List Image instead of featured image', 'makao-core' ),
                'group'      => esc_html__( 'Layout', 'makao-core' )
            ) );
			$this->map_additional_options();
			$this->map_extra_options();
		}
		
		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'makao_core_blog_list', $params );
			$html = str_replace( "\n", '', $html );
			
			return $html;
		}
		
		public function load_assets() {
			parent::load_assets();
			
			$is_allowed = apply_filters( 'makao_core_filter_load_blog_list_assets', false, $this->get_atts() );
			
			if ( $is_allowed ) {
				wp_enqueue_style( 'wp-mediaelement' );
				wp_enqueue_script( 'wp-mediaelement' );
				wp_enqueue_script( 'mediaelement-vimeo' );
			}
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
			$atts['slider_attr']    = $this->get_slider_data( $atts );
			$atts['data_attr']      = makao_core_get_pagination_data( MAKAO_CORE_REL_PATH, 'blog/shortcodes', 'blog-list', 'post', $atts );
			
			$atts['this_shortcode'] = $this;
			
			return makao_core_get_template_part( 'blog/shortcodes/blog-list', 'templates/content', $atts['behavior'], $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-blog';
			if ( ! empty( $atts['layout'] ) && $atts['layout'] == 'standard' ) {
				$holder_classes[] = 'qodef--list';
			}
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-item-layout--' . $atts['layout'] : '';
			
			$list_classes   = $this->get_list_classes( $atts );
			$holder_classes = array_merge( $holder_classes, $list_classes );
			
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
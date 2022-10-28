<?php

abstract class MakaoCoreListShortcode extends QodeFrameworkShortcode {
	private $post_type;
	private $post_type_taxonomy;
	private $post_type_additional_taxonomies = array();
	private $layouts = array();
	private $hover_animation_options = array();
	private $extra_options = array();
	
	public function __construct() {
		parent::__construct();

		$this->register_list_scripts();
	}
	
	public function get_post_type() {
		return $this->post_type;
	}
	
	public function set_post_type( $post_type ) {
		$this->post_type = $post_type;
	}
	
	public function get_post_type_taxonomy() {
		return $this->post_type_taxonomy;
	}
	
	public function set_post_type_taxonomy( $post_type_taxonomy ) {
		$this->post_type_taxonomy = $post_type_taxonomy;
	}
	
	public function get_post_type_additional_taxonomies() {
		return $this->post_type_additional_taxonomies;
	}
	
	public function set_post_type_additional_taxonomies( $post_type_additional_taxonomies ) {
		$this->post_type_additional_taxonomies = $post_type_additional_taxonomies;
	}
	
	public function get_layouts() {
		return $this->layouts;
	}
	
	public function set_layouts( $layouts ) {
		$this->layouts = $layouts;
	}
	
	public function get_hover_animation_options() {
		return $this->hover_animation_options;
	}
	
	public function set_hover_animation_options( $hover_animation_options ) {
		$this->hover_animation_options = $hover_animation_options;
	}
	
	public function get_extra_options() {
		return $this->extra_options;
	}
	
	public function set_extra_options( $extra_options ) {
		$this->extra_options = $extra_options;
	}
	
	public function map_list_options( $params = array() ) {
		$group            = isset( $params['group'] ) ? $params['group'] : null;
		$exclude_option   = isset( $params['exclude_option'] ) ? $params['exclude_option'] : array();
		$exclude_behavior = isset( $params['exclude_behavior'] ) ? $params['exclude_behavior'] : array();
		$exclude_columns  = isset( $params['exclude_columns'] ) ? $params['exclude_columns'] : array();
		$include_columns  = isset( $params['include_columns'] ) ? $params['include_columns'] : array();
		
		$this->set_option( array(
			'field_type'    => 'select',
			'name'          => 'behavior',
			'title'         => esc_html__( 'List Appearance', 'makao-core' ),
			'options'       => makao_core_get_select_type_options_pool( 'list_behavior', false, $exclude_behavior ),
			'default_value' => 'columns',
			'group'         => $group
		) );
		if ( empty( $exclude_behavior ) || ( ! empty( $exclude_behavior ) && ! in_array( 'masonry', $exclude_behavior ) ) ) {
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'masonry_images_proportion',
				'title'         => esc_html__( 'Image Proportions', 'makao-core' ),
				'options'       => array(
					''      => esc_html__( 'Original', 'makao-core' ),
					'fixed' => esc_html__( 'Fixed', 'makao-core' )
				),
				'default_value' => '',
				'group'         => $group,
				'dependency'    => array(
					'show' => array(
						'behavior' => array(
							'values'        => 'masonry',
							'default_value' => 'columns'
						)
					)
				)
			) );
		}
		if ( empty( $exclude_option ) || ( ! empty( $exclude_option ) && ! in_array( 'images_proportion', $exclude_option ) ) ) {
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'images_proportion',
				'default_value' => 'full',
				'title'         => esc_html__( 'Image Proportions', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'list_image_dimension', false ),
				'group'         => $group,
				'dependency'    => array(
					'show' => array(
						'behavior' => array(
							'values'        => array( '', 'columns', 'slider' ),
							'default_value' => 'columns'
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'custom_image_width',
				'title'       => esc_html__( 'Custom Image Width', 'makao-core' ),
				'description' => esc_html__( 'Enter image width in px', 'makao-core' ),
				'group'       => $group,
				'dependency'  => array(
					'show' => array(
						'images_proportion' => array(
							'values'        => 'custom',
							'default_value' => 'full'
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'custom_image_height',
				'title'       => esc_html__( 'Custom Image Height', 'makao-core' ),
				'description' => esc_html__( 'Enter image height in px', 'makao-core' ),
				'group'       => $group,
				'dependency'  => array(
					'show' => array(
						'images_proportion' => array(
							'values'        => 'custom',
							'default_value' => 'full'
						)
					)
				)
			) );
		}
		
		if ( empty( $exclude_option ) || ( ! empty( $exclude_option ) && ! in_array( 'columns', $exclude_option ) ) ) {
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'columns',
				'title'         => esc_html__( 'Number of Columns', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'columns_number', true, $exclude_columns, $include_columns ),
				'default_value' => '3',
				'group'         => $group,
				'dependency'    => array(
					'hide' => array(
						'behavior' => array(
							'values'        => 'justified-gallery',
							'default_value' => 'columns'
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'columns_responsive',
				'title'         => esc_html__( 'Columns Responsive', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'columns_responsive' ),
				'default_value' => 'predefined',
				'group'         => $group,
				'dependency'    => array(
					'hide' => array(
						'behavior' => array(
							'values'        => 'justified-gallery',
							'default_value' => 'columns'
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'columns_1440',
				'title'         => esc_html__( 'Number of Columns 1367px - 1440px', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'columns_number' ),
				'default_value' => '3',
				'dependency'    => array(
					'show' => array(
						'columns_responsive' => array(
							'values'        => 'custom',
							'default_value' => '3'
						)
					)
				),
				'group'         => $group
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'columns_1366',
				'title'         => esc_html__( 'Number of Columns 1025px - 1366px', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'columns_number' ),
				'default_value' => '3',
				'dependency'    => array(
					'show' => array(
						'columns_responsive' => array(
							'values'        => 'custom',
							'default_value' => '3'
						)
					)
				),
				'group'         => $group
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'columns_1024',
				'title'         => esc_html__( 'Number of Columns 769px - 1024px', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'columns_number' ),
				'default_value' => '3',
				'dependency'    => array(
					'show' => array(
						'columns_responsive' => array(
							'values'        => 'custom',
							'default_value' => '3'
						)
					)
				),
				'group'         => $group
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'columns_768',
				'title'         => esc_html__( 'Number of Columns 681px - 768px', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'columns_number' ),
				'default_value' => '3',
				'dependency'    => array(
					'show' => array(
						'columns_responsive' => array(
							'values'        => 'custom',
							'default_value' => '3'
						)
					)
				),
				'group'         => $group
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'columns_680',
				'title'         => esc_html__( 'Number of Columns 481px - 680px', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'columns_number' ),
				'default_value' => '3',
				'dependency'    => array(
					'show' => array(
						'columns_responsive' => array(
							'values'        => 'custom',
							'default_value' => '3'
						)
					)
				),
				'group'         => $group
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'columns_480',
				'title'         => esc_html__( 'Number of Columns 0 - 480px', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'columns_number' ),
				'default_value' => '3',
				'dependency'    => array(
					'show' => array(
						'columns_responsive' => array(
							'values'        => 'custom',
							'default_value' => '3'
						)
					)
				),
				'group'         => $group
			) );
		}
		
		$this->set_option( array(
			'field_type'    => 'select',
			'name'          => 'space',
			'title'         => esc_html__( 'Space Between Items', 'makao-core' ),
			'options'       => makao_core_get_select_type_options_pool( 'items_space' ),
			'default_value' => 'normal',
			'group'         => $group
		) );
		
		if ( empty( $exclude_behavior ) || ( ! empty( $exclude_behavior ) && ! in_array( 'slider', $exclude_behavior ) ) ) {
			$params['dependency'] = array(
				'show' => array(
					'behavior' => array(
						'values'        => 'slider',
						'default_value' => 'columns'
					)
				)
			);
			$this->map_slider_options( $params );
		}
		if ( empty( $exclude_behavior ) || ( ! empty( $exclude_behavior ) && ! in_array( 'justified-gallery', $exclude_behavior ) ) ) {
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'justified_gallery_row_height',
				'title'      => esc_html__( 'Row Height', 'makao-core' ),
				'dependency' => array(
					'show' => array(
						'behavior' => array(
							'values'        => 'justified-gallery',
							'default_value' => 'columns'
						)
					)
				),
				'group'      => $group
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'justified_gallery_row_height_max',
				'title'      => esc_html__( 'Max Row Height', 'makao-core' ),
				'dependency' => array(
					'show' => array(
						'behavior' => array(
							'values'        => 'justified-gallery',
							'default_value' => 'columns'
						)
					)
				),
				'group'      => $group
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'justified_gallery_treshold',
				'title'      => esc_html__( 'Last Row Treshold', 'makao-core' ),
				'dependency' => array(
					'show' => array(
						'behavior' => array(
							'values'        => 'justified-gallery',
							'default_value' => 'columns'
						)
					)
				),
				'group'      => $group
			) );
		}
	}
	
	public function map_slider_options( $params = array() ) {
		$group      = isset( $params['group'] ) ? $params['group'] : null;
		$dependency = isset( $params['dependency'] ) ? $params['dependency'] : array();
		
		$this->set_option( array(
			'field_type' => 'select',
			'name'       => 'slider_loop',
			'title'      => esc_html__( 'Enable Slider Loop', 'makao-core' ),
			'options'    => makao_core_get_select_type_options_pool( 'yes_no' ),
			'dependency' => $dependency,
			'group'      => $group
		) );
		$this->set_option( array(
			'field_type' => 'select',
			'name'       => 'slider_autoplay',
			'title'      => esc_html__( 'Enable Slider Autoplay', 'makao-core' ),
			'options'    => makao_core_get_select_type_options_pool( 'yes_no' ),
			'dependency' => $dependency,
			'group'      => $group
		) );
        $this->set_option( array(
            'field_type' => 'select',
            'name'       => 'slider_center',
            'title'      => esc_html__( 'Center Slider', 'querida-core' ),
            'options'    => makao_core_get_select_type_options_pool( 'yes_no', false ),
            'dependency' => $dependency,
            'group'      => $group
        ) );
        $this->set_option( array(
            'field_type' => 'select',
            'name'       => 'slider_width',
            'title'      => esc_html__( 'Enable Slider Auto Width', 'querida-core' ),
            'options'    => makao_core_get_select_type_options_pool( 'no_yes', false ),
            'dependency' => $dependency,
            'group'      => $group
        ) );
		$this->set_option( array(
			'field_type'  => 'text',
			'name'        => 'slider_speed',
			'title'       => esc_html__( 'Slide Duration', 'makao-core' ),
			'description' => esc_html__( 'Default value is 5000 (ms)', 'makao-core' ),
			'dependency'  => $dependency,
			'group'       => $group
		) );
		$this->set_option( array(
			'field_type'  => 'text',
			'name'        => 'slider_speed_animation',
			'title'       => esc_html__( 'Slide Animation Duration', 'makao-core' ),
			'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 800.', 'makao-core' ),
			'dependency'  => $dependency,
			'group'       => $group
		) );
		$this->set_option( array(
			'field_type' => 'select',
			'name'       => 'slider_navigation',
			'title'      => esc_html__( 'Enable Slider Navigation', 'makao-core' ),
			'options'    => makao_core_get_select_type_options_pool( 'yes_no' ),
			'dependency' => $dependency,
			'group'      => $group
		) );
		$this->set_option( array(
			'field_type' => 'select',
			'name'       => 'slider_pagination',
			'title'      => esc_html__( 'Enable Slider Pagination', 'makao-core' ),
			'options'    => makao_core_get_select_type_options_pool( 'yes_no' ),
			'dependency' => $dependency,
			'group'      => $group
		) );
	}
	
	public function get_list_classes( $atts ) {
		$holder_classes = array();
		
		$holder_classes[] = 'qodef-grid';
		$holder_classes[] = ! empty( $atts['behavior'] ) && $atts['behavior'] == 'slider' ? 'qodef-swiper-container' : 'qodef-layout--' . $atts['behavior'];
		$holder_classes[] = ! empty( $atts['behavior'] ) && $atts['behavior'] == 'masonry' && ! empty( $atts['masonry_images_proportion'] ) && $atts['masonry_images_proportion'] == 'fixed' ? 'qodef-items--fixed' : '';
		$holder_classes[] = ! empty( $atts['space'] ) ? 'qodef-gutter--' . $atts['space'] : '';
		$holder_classes[] = ! empty( $atts['columns'] ) ? 'qodef-col-num--' . $atts['columns'] : '';
		
		$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-item-layout--' . $atts['layout'] : '';
		
		if ( ! empty( $atts['enable_filter'] ) ) {
			$holder_classes[] = 'qodef-filter--on';
		}
		
		if ( ! empty( $atts['pagination_type'] ) ) {
			if ( $atts['pagination_type'] == 'no-pagination' ) {
				$holder_classes[] = 'qodef--no-bottom-space';
				$holder_classes[] = 'qodef-pagination--off';
			} else {
				$holder_classes[] = 'qodef-pagination--on';
				$holder_classes[] = 'qodef-pagination-type--' . $atts['pagination_type'];
			}
		}
		
		if ( ! empty( $atts['columns_responsive'] ) && $atts['columns_responsive'] === 'custom' ) {
			$holder_classes[] = 'qodef-responsive--custom';
			$holder_classes[] = ! empty( $atts['columns_1440'] ) ? 'qodef-col-num--1440--' . $atts['columns_1440'] : 'qodef-col-num--1440--' . $atts['columns'];
			$holder_classes[] = ! empty( $atts['columns_1366'] ) ? 'qodef-col-num--1366--' . $atts['columns_1366'] : 'qodef-col-num--1366--' . $atts['columns'];
			$holder_classes[] = ! empty( $atts['columns_1024'] ) ? 'qodef-col-num--1024--' . $atts['columns_1024'] : 'qodef-col-num--1024--' . $atts['columns'];
			$holder_classes[] = ! empty( $atts['columns_768'] ) ? 'qodef-col-num--768--' . $atts['columns_768'] : 'qodef-col-num--768--' . $atts['columns'];
			$holder_classes[] = ! empty( $atts['columns_680'] ) ? 'qodef-col-num--680--' . $atts['columns_680'] : 'qodef-col-num--680--' . $atts['columns'];
			$holder_classes[] = ! empty( $atts['columns_480'] ) ? 'qodef-col-num--480--' . $atts['columns_480'] : 'qodef-col-num--480--' . $atts['columns'];
		} else {
			$holder_classes[] = 'qodef-responsive--predefined';
		}
		
		return $holder_classes;
	}
	
	public function get_hover_animation_classes( $atts ) {
		$holder_classes = array();
		
		$layout = $atts['layout'];
		if ( isset( $atts[ 'hover_animation_' . $layout ] ) ) {
			$holder_classes[] = 'qodef-hover-animation--' . $atts[ 'hover_animation_' . $layout ];
		}
		
		return $holder_classes;
	}
	
	public function get_list_item_classes( $atts ) {
		$item_classes = array();
		
		$item_classes[] = ! empty( $atts['behavior'] ) && $atts['behavior'] == 'slider' ? 'swiper-slide' : 'qodef-grid-item';
		
		if ( ! empty( $atts['image_dimension'] ) ) {
			$item_classes[] = $atts['image_dimension']['class'];
		}
		
		return $item_classes;
	}
	
	public function get_list_item_image_dimension( $atts ) {
		$image_dimension = array();
		
		if ( ! empty( $atts['behavior'] ) && $atts['behavior'] == 'masonry' && ! empty( $atts['masonry_images_proportion'] ) && $atts['masonry_images_proportion'] == 'fixed' ) {
			$masonry_image_dimension_name = 'qodef_masonry_image_dimension_' . str_replace( '-', '_', $atts['post_type'] );
			$image_dimension              = makao_core_get_custom_image_size_meta( 'meta-box', $masonry_image_dimension_name, get_the_ID() );
		}
		
		if ( ! empty( $atts['behavior'] ) && in_array( $atts['behavior'], array( 'columns', 'slider' ) ) ) {
			$image_dimension = array(
				'size'  => $atts['images_proportion'],
				'class' => makao_core_get_custom_image_size_class_name( $atts['images_proportion'] )
			);
		}
		
		return $image_dimension;
	}
	
	public function get_slider_data( $atts, $include = array() ) {
		$data = array();

        if ( isset( $atts['slider_width'] ) && $atts['slider_width'] === 'yes') {
            $data['slidesPerView'] = 'auto';
        } else {
            $data['slidesPerView']  = isset( $atts['columns'] ) ? $atts['columns'] : 1;
        }

        if (isset( $atts['slider_center'] ) && $atts['slider_center'] !== '') {
            $data['centeredSlides'] = $atts['slider_center'] === 'yes' ? true : false;
        }

		$data['spaceBetween']   = isset( $atts['space'] ) ? makao_core_get_space_value( $atts['space'] ) : 0;
		$data['loop']           = isset( $atts['slider_loop'] ) ? $atts['slider_loop'] != 'no' : true;
		$data['autoplay']       = isset( $atts['slider_autoplay'] ) ? $atts['slider_autoplay'] != 'no' : true;
		$data['speed']          = isset( $atts['slider_speed'] ) ? $atts['slider_speed'] : '';
		$data['speedAnimation'] = isset( $atts['slider_speed_animation'] ) ? $atts['slider_speed_animation'] : '';
		
		if ( ! empty( $atts['columns_responsive'] ) && $atts['columns_responsive'] === 'custom' ) {
			$data['customStages']      = true;
			$data['slidesPerView1440'] = ! empty( $atts['columns_1440'] ) ? $atts['columns_1440'] : $atts['columns'];
			$data['slidesPerView1366'] = ! empty( $atts['columns_1366'] ) ? $atts['columns_1366'] : $atts['columns'];
			$data['slidesPerView1024'] = ! empty( $atts['columns_1024'] ) ? $atts['columns_1024'] : $atts['columns'];
			$data['slidesPerView768']  = ! empty( $atts['columns_768'] ) ? $atts['columns_768'] : $atts['columns'];
			$data['slidesPerView680']  = ! empty( $atts['columns_680'] ) ? $atts['columns_680'] : $atts['columns'];
			$data['slidesPerView480']  = ! empty( $atts['columns_480'] ) ? $atts['columns_480'] : $atts['columns'];
		}
		
		if ( ! empty( $include ) ) {
			foreach ( $include as $key => $value ) {
				if ( ! array_key_exists( $key, $data ) ) {
					$data[ $key ] = $value;
				}
			}
		}
		
		return json_encode( $data );
	}
	
	public function map_query_options( $params = array() ) {
		$group                = isset( $params['group'] ) ? $params['group'] : esc_html__( 'Query', 'makao-core' );
		$post_type            = isset( $params['post_type'] ) ? $params['post_type'] : 'post';
		$taxonomies_formatted = array();
		$exclude_option       = isset( $params['exclude_option'] ) ? $params['exclude_option'] : array();
		$exclude_order_by     = isset( $params['exclude_order_by'] ) ? $params['exclude_order_by'] : array();
		$include_order_by     = isset( $params['include_order_by'] ) ? $params['include_order_by'] : array();
		
		if ( ! empty ( $post_type ) ) {
			$main_taxonomy = $this->get_post_type_taxonomy();
			$taxonomies    = array_filter( array_merge( array( ! empty( $main_taxonomy ) ? $main_taxonomy : '' ), $this->get_post_type_additional_taxonomies() ) );
			
			if ( ! empty ( $taxonomies ) ) {
				foreach ( $taxonomies as $taxonomy ) {
					$taxonomies_formatted[ $taxonomy ] = ucwords( str_replace( array( '_', '-' ), array(
						' ',
						' '
					), $taxonomy ) );
				}
			}
		}
		
		$this->set_option( array(
			'field_type' => 'text',
			'name'       => 'posts_per_page',
			'title'      => esc_html__( 'Posts per Page', 'makao-core' ),
			'default'    => '-1',
			'group'      => $group
		) );
		$this->set_option( array(
			'field_type'    => 'select',
			'name'          => 'orderby',
			'title'         => esc_html__( 'Order By', 'makao-core' ),
			'options'       => makao_core_get_select_type_options_pool( 'order_by', true, $exclude_order_by, $include_order_by ),
			'default_value' => 'date',
			'group'         => $group
		) );
		$this->set_option( array(
			'field_type'    => 'select',
			'name'          => 'order',
			'title'         => esc_html__( 'Order', 'makao-core' ),
			'options'       => makao_core_get_select_type_options_pool( 'order' ),
			'default_value' => 'DESC',
			'group'         => $group
		) );
		
		if ( empty( $exclude_option ) || ( ! empty( $exclude_option ) && ! in_array( 'additional_params', $exclude_option ) ) ) {
			
			do_action( 'makao_core_action_map_query_options_before_additional', $group );
			
			$additional_params = apply_filters( 'makao_core_filter_map_additional_query_params', array(
				''       => esc_html__( 'No', 'makao-core' ),
				'id'     => esc_html__( 'Post IDs', 'makao-core' ),
				'tax'    => esc_html__( 'Taxonomy Slug', 'makao-core' ),
				'author' => esc_html__( 'Author Name', 'makao-core' ),
			) );
			
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'additional_params',
				'title'      => esc_html__( 'Additional Params', 'makao-core' ),
				'options'    => $additional_params,
				'group'      => $group
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'post_ids',
				'title'       => esc_html__( 'Posts IDs', 'makao-core' ),
				'description' => esc_html__( 'Separate post IDs with commas', 'makao-core' ),
				'group'       => $group,
				'dependency'  => array(
					'show' => array(
						'additional_params' => array(
							'values'        => 'id',
							'default_value' => ''
						)
					)
				)
			) );
			if ( ! empty( $taxonomies_formatted ) ) {
				$this->set_option( array(
					'field_type' => 'select',
					'name'       => 'tax',
					'title'      => esc_html__( 'Taxonomy', 'makao-core' ),
					'options'    => $taxonomies_formatted,
					'group'      => $group,
					'dependency' => array(
						'show' => array(
							'additional_params' => array(
								'values'        => 'tax',
								'default_value' => ''
							)
						)
					)
				) );
				$this->set_option( array(
					'field_type' => 'text',
					'name'       => 'tax_slug',
					'title'      => esc_html__( 'Taxonomy Slug', 'makao-core' ),
					'group'      => $group,
					'dependency' => array(
						'show' => array(
							'additional_params' => array(
								'values'        => 'tax',
								'default_value' => ''
							)
						)
					)
				) );
				$this->set_option( array(
					'field_type'  => 'text',
					'name'        => 'tax__in',
					'title'       => esc_html__( 'Taxonomy IDs', 'makao-core' ),
					'description' => esc_html__( 'Separate taxonomy IDs with commas', 'makao-core' ),
					'group'       => $group,
					'dependency'  => array(
						'show' => array(
							'additional_params' => array(
								'values'        => 'tax',
								'default_value' => ''
							)
						)
					)
				) );
			}
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'author_slug',
				'title'      => esc_html__( 'Author Slug', 'makao-core' ),
				'group'      => $group,
				'dependency' => array(
					'show' => array(
						'additional_params' => array(
							'values'        => 'author',
							'default_value' => ''
						)
					)
				)
			) );
			
			do_action( 'makao_core_action_map_query_options_after_additional', $group );
		}
	}
	
	public function get_additional_query_args( $atts ) {
		$args = array();
		
		if ( ! empty( $atts['additional_params'] ) && $atts['additional_params'] == 'id' ) {
			$post_ids         = explode( ',', $atts['post_ids'] );
			$args['orderby']  = 'post__in';
			$args['post__in'] = $post_ids;
		}
		
		if ( ! empty( $atts['additional_params'] ) && $atts['additional_params'] == 'tax' ) {
			$taxonomy_values = array();
			
			$slug = isset( $atts['tax_slug'] ) ? $atts['tax_slug'] : '';
			$ids  = isset( $atts['tax__in'] ) ? $atts['tax__in'] : '';
			
			if ( ! empty( $ids ) && empty( $slug ) ) {
				$taxonomy_values['field'] = 'term_id';
				$taxonomy_values['terms'] = is_array( $ids ) ? array_map( 'intval', $ids ) : array_map( 'intval', explode( ',', str_replace( ' ', '', $ids ) ) );
			} elseif ( ! empty( $slug ) ) {
				$taxonomy_values['field'] = 'slug';
				$taxonomy_values['terms'] = $slug;
			}
			
			if ( ! empty( $atts['tax'] ) && ! empty( $taxonomy_values ) ) {
				$args['tax_query'] = array( array_merge( array( 'taxonomy' => $atts['tax'] ), $taxonomy_values ) );
			}
		}
		
		if ( ! empty( $atts['additional_params'] ) && $atts['additional_params'] == 'author' ) {
			$args['author_name'] = $atts['author_slug'];
		}
		
		$args = apply_filters( 'makao_core_filter_additional_query_args', $args, $atts );
		
		return $args;
	}
	
	public function map_layout_options( $params = array() ) {
		$layouts                 = isset( $params['layouts'] ) ? $params['layouts'] : array();
		$hover_animations        = isset( $params['hover_animations'] ) ? $params['hover_animations'] : array();
		$exclude_option          = isset( $params['exclude_option'] ) ? $params['exclude_option'] : array();
		$default_value_title_tag = isset( $params['default_value_title_tag'] ) ? $params['default_value_title_tag'] : 'h4';
		
		$map_for_page_builder = sizeof( $layouts ) > 1 ? true : false;
		
		$default_value = '';
		if ( ! empty ( $layouts ) ) {
			reset( $layouts );
			$default_value = key( $layouts );
		}
		
		$this->set_option( array(
			'field_type'    => 'select',
			'name'          => 'layout',
			'title'         => esc_html__( 'Item Layout', 'makao-core' ),
			'options'       => $layouts,
			'default_value' => $default_value,
			'group'         => esc_html__( 'Layout', 'makao-core' ),
			'visibility'    => array( 'map_for_page_builder' => $map_for_page_builder )
		) );
		
		if ( ! empty ( $hover_animations ) ) {
			foreach ( $hover_animations as $option ) {
				$this->set_option( $option );
			}
		}
		
		if ( empty( $exclude_option ) || ( ! empty( $exclude_option ) && ! in_array( 'title_tag', $exclude_option ) ) ) {
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => $default_value_title_tag,
				'group'         => esc_html__( 'Layout', 'makao-core' )
			) );
		}
		if ( empty( $exclude_option ) || ( ! empty( $exclude_option ) && ! in_array( 'text_transform', $exclude_option ) ) ) {
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'text_transform',
				'title'      => esc_html__( 'Title Text Transform', 'makao-core' ),
				'options'    => makao_core_get_select_type_options_pool( 'text_transform' ),
				'group'      => esc_html__( 'Layout', 'makao-core' )
			) );
		}
	}
	
	public function map_additional_options( $params = array() ) {
		$group_name         = esc_html__( 'Additional', 'makao-core' );
		$exclude_filter     = isset( $params['exclude_filter'] ) ? (bool) $params['exclude_filter'] : false;
		$exclude_pagination = isset( $params['exclude_pagination'] ) ? (bool) $params['exclude_pagination'] : false;
		
		if ( ! $exclude_filter ) {
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'enable_filter',
				'title'         => esc_html__( 'Enable Filter', 'makao-core' ),
				'description'   => esc_html__( 'Enabling this option will show categories filter above list', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'no_yes' ),
				'default_value' => '',
				'dependency'    => array(
					'hide' => array(
						'behavior' => array(
							'values'        => 'justified-gallery',
							'default_value' => 'columns'
						)
					)
				),
				'group'         => $group_name
			) );
			
			do_action( 'makao_core_action_map_additional_options_after_filter', $group_name );
		}
		
		if ( ! $exclude_pagination ) {
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'pagination_type',
				'title'         => esc_html__( 'Pagination', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'pagination_type' ),
				'default_value' => 'no-pagination',
				'group'         => $group_name
			) );
			
			$this->set_option( array(
				'field_type'    => 'text',
				'name'          => 'pagination_type_load_more_top_margin',
				'title'         => esc_html__( 'Load More Top Margin (px or %)', 'makao-core' ),
				'default_value' => '',
				'group'         => $group_name,
				'dependency'    => array(
					'show' => array(
						'pagination_type' => array(
							'values'        => 'load-more',
							'default_value' => ''
						)
					)
				)
			) );
			
			do_action( 'makao_core_action_map_additional_options_after_pagination', $group_name );
		}
	}
	
	public function map_extra_options() {
		$extra_options = $this->get_extra_options();
		
		if ( ! empty ( $extra_options ) ) {
			foreach ( $extra_options as $option ) {
				$this->set_option( $option );
			}
		}
	}

    public function register_list_scripts() {
        $scripts      = $this->get_scripts();
        $list_scripts = apply_filters( 'makao_core_filter_register_list_shortcode_scripts', isset( $scripts ) ? $scripts : array() );

        $this->set_scripts( $list_scripts );
    }
	
	public function load_assets() {
		do_action( 'makao_core_action_list_shortcodes_load_assets', $this->get_atts() );
	}
	
	public function render( $options, $content = null ) {
		parent::render( $options );
		
		$atts                                         = $this->get_atts();
		$atts['pagination_type_load_more_top_margin'] = ! empty( $atts['pagination_type_load_more_top_margin'] ) ? 'margin-top:' . $atts['pagination_type_load_more_top_margin'] : '';
		$this->set_option_atts( $atts );
	}
}
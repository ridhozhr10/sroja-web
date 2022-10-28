<?php

if ( ! function_exists( 'makao_core_add_instagram_list_shortcode' ) ) {
	/**
	 * Function that is adding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function makao_core_add_instagram_list_shortcode( $shortcodes ) {
		if( qode_framework_is_installed( 'instagram' ) ) {
			$shortcodes[] = 'MakaoCoreInstagramListShortcode';
		}
		
		return $shortcodes;
	}
	
	add_filter( 'makao_core_filter_register_shortcodes', 'makao_core_add_instagram_list_shortcode' );
}

if ( class_exists( 'MakaoCoreShortcode' ) ) {
	class MakaoCoreInstagramListShortcode extends MakaoCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( MAKAO_CORE_PLUGINS_URL_PATH . '/instagram/shortcodes/instagram-list' );
			$this->set_base( 'makao_core_instagram_list' );
			$this->set_name( esc_html__( 'Instagram List', 'makao-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays instagram list', 'makao-core' ) );
			$this->set_category( esc_html__( 'Makao Core', 'makao-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'photos_number',
				'title'      => esc_html__( 'Number of Photos', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'columns_number',
				'title'         => esc_html__( 'Number of Columns', 'makao-core' ),
				'options'       => array(
					'1'  => esc_html__( '1', 'makao-core' ),
					'2'  => esc_html__( '2', 'makao-core' ),
					'3'  => esc_html__( '3', 'makao-core' ),
					'4'  => esc_html__( '4', 'makao-core' ),
					'5'  => esc_html__( '5', 'makao-core' ),
					'6'  => esc_html__( '6', 'makao-core' ),
					'7'  => esc_html__( '7', 'makao-core' ),
					'8'  => esc_html__( '8', 'makao-core' ),
					'9'  => esc_html__( '9', 'makao-core' ),
					'10' => esc_html__( '10', 'makao-core' ),
				),
				'default_value' => '3'
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'type',
				'title'         => esc_html__( 'Type', 'makao-core' ),
				'options'       => array(
					'standard'     => esc_html__( 'Standard', 'makao-core' ),
					'center_info'  => esc_html__( 'Info in Center', 'makao-core' )
				),
				'default_value' => 'standard'
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'overlapping_images',
				'title'         => esc_html__( 'Overlapping Images', 'makao-core' ),
				'options'       => array(
					'no'     => esc_html__( 'No', 'makao-core' ),
					'yes'  => esc_html__( 'Yes', 'makao-core' )
				),
				'default_value' => 'no',
				'dependency'    => array(
					'show' => array(
						'type' => array(
							'values'        => 'standard',
							'default'       => ''
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'space',
				'title'         => esc_html__( 'Padding Around Images', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'items_space' ),
				'description'   => esc_html__( "This doesn't work with Overlapping Images", 'makao-core'),
				'default_value' => 'small',
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'image_resolution',
				'title'         => esc_html__( 'Image Resolution', 'makao-core' ),
				'options'       => array(
					'auto'  => esc_html__( 'Auto-detect (recommended)', 'makao-core' ),
					'thumb'  => esc_html__( 'Thumbnail (150x150)', 'makao-core' ),
					'medium'  => esc_html__( 'Medium (306x306)', 'makao-core' ),
					'full'  => esc_html__( 'Full (640x640)', 'makao-core' )
				),
				'default_value' => 'auto'
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'title',
				'title'       => esc_html__( 'Title', 'makao-core' ),
				'dependency'    => array(
					'show' => array(
						'type' => array(
							'values'        => 'center_info',
							'default'       => ''
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'subtitle',
				'title'       => esc_html__( 'Subtitle', 'makao-core' ),
				'dependency'    => array(
					'show' => array(
						'type' => array(
							'values'        => 'center_info',
							'default'       => ''
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'button_text',
				'title'       => esc_html__( 'Button Text', 'makao-core' ),
				'dependency'    => array(
					'show' => array(
						'type' => array(
							'values'        => 'center_info',
							'default'       => ''
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'button_link',
				'title'       => esc_html__( 'Button Link', 'makao-core' ),
				'dependency'    => array(
					'show' => array(
						'type' => array(
							'values'        => 'center_info',
							'default'       => ''
						)
					)
				)
			) );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			
			$atts = $this->get_atts();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['instagram_params']   = $this->get_instagram_params( $atts );
			
			return makao_core_get_template_part( 'plugins/instagram/shortcodes/instagram-list', 'templates/instagram-list', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-instagram-list';
			if (! empty( $atts['overlapping_images'] && $atts['overlapping_images'] === 'no')) {
				$holder_classes[] = ! empty( $atts['space'] ) ? 'qodef-gutter--' . $atts['space'] : '';
			}
			$holder_classes[] = ! empty( $atts['columns_number'] ) ? 'qodef-col-num--' . $atts['columns_number'] : '';
			$holder_classes[] = ! empty( $atts['overlapping_images'] ) && $atts['overlapping_images'] === 'yes' ? 'qodef-instagram-overlapping-images' : '';
			
			$holder_classes = array_merge( $holder_classes );
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_instagram_params( $atts ) {
			$params = array();
			
			$params['num'] = isset( $atts['photos_number'] ) && ! empty( $atts['photos_number'] ) ? $atts['photos_number'] : 6;
			$params['cols'] = isset( $atts['columns_number'] ) && ! empty( $atts['columns_number'] ) ? $atts['columns_number'] : 3;
			$params['imagepadding'] = isset( $atts['space'] ) && ! empty( $atts['space'] ) ? makao_core_get_space_value( $atts['space'] ) : 10;
			$params['imagepaddingunit'] = 'px';
			$params['showheader'] = false;
			$params['showfollow'] = false;
			$params['showbutton'] = false;
			$params['imageres'] = isset( $atts['image_resolution'] ) && ! empty( $atts['image_resolution'] ) ? $atts['image_resolution'] : 'auto';
			
			if ( is_array( $params ) && count( $params ) ) {
				foreach ( $params as $key => $value ) {
					if ( $value !== '' ) {
						$params[] = $key . "='" . esc_attr( str_replace( ' ', '', $value ) ) . "'";
					}
				}
			}
			
			return implode( ' ', $params );
		}
	}
}
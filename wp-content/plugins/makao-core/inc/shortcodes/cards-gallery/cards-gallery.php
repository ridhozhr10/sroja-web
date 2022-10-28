<?php

if ( ! function_exists( 'makao_core_add_cards_gallery_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function makao_core_add_cards_gallery_shortcode( $shortcodes ) {
		$shortcodes[] = 'MakaoCoreCardsGalleryShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'makao_core_filter_register_shortcodes', 'makao_core_add_cards_gallery_shortcode' );
}

if ( class_exists( 'MakaoCoreShortcode' ) ) {
	class MakaoCoreCardsGalleryShortcode extends MakaoCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( MAKAO_CORE_SHORTCODES_URL_PATH . '/cards-gallery' );
			$this->set_base( 'makao_core_cards_gallery' );
			$this->set_name( esc_html__( 'Cards Gallery', 'makao-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds cards gallery holder', 'makao-core' ) );
			$this->set_category( esc_html__( 'Makao Core', 'makao-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'makao-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'link_target',
				'title'         => esc_html__( 'Link Target', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self'
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'orientation',
				'title'         => esc_html__( 'Info Position', 'makao-core' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'makao-core' ),
					'right'  => esc_html__( 'Shuffled Right', 'makao-core' ),
					'left'   => esc_html__( 'Shuffled Left', 'makao-core' )
				),
				'default_value' => 'right'
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'bundle_animation',
				'title'         => esc_html__( 'Bundle Animation', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'no_yes' ),
				'default_value' => 'no'
			) );
			$this->set_option( array(
				'field_type' => 'repeater',
				'name'       => 'children',
				'title'      => esc_html__( 'Image Items', 'makao-core' ),
				'items'   => array(
					array(
						'field_type'    => 'text',
						'name'          => 'item_link',
						'title'         => esc_html__( 'Link', 'makao-core' ),
						'default_value' => ''
					),
					array(
						'field_type' => 'image',
						'name'       => 'item_image',
						'title'      => esc_html__( 'Item Image', 'makao-core' )
					),
				)
			) );
			$this->map_extra_options();
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );
			
			return makao_core_get_template_part( 'shortcodes/cards-gallery', 'templates/cards-gallery', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-cards-gallery';
			$holder_classes[]  = ! empty( $atts['orientation'] ) ? 'qodef-orientation--' . $atts['orientation'] : 'qodef-orientation--right';
			$holder_classes[]  = isset( $atts['bundle_animation'] ) && $atts['bundle_animation'] === 'yes' ? 'qodef-animation--bundle' : 'qodef-animation--no';
			
			if ( count($this->parse_repeater_items( $atts['children'])) !== 0 ) {
				$number_of_items = count($this->parse_repeater_items( $atts['children']));
				$holder_classes[] = 'qodef-cards-gallery-' . $number_of_items . '-items';
			}
			
			return implode( ' ', $holder_classes );
		}
	}
}
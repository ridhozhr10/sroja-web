<?php

if ( ! function_exists( 'makao_core_add_icon_list_item_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function makao_core_add_icon_list_item_widget( $widgets ) {
		$widgets[] = 'MakaoCoreIconListItemWidget';
		
		return $widgets;
	}
	
	add_filter( 'makao_core_filter_register_widgets', 'makao_core_add_icon_list_item_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class MakaoCoreIconListItemWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'makao_core_icon_list_item',
				'exclude'   => array(
					'icon_type', 'custom_icon'
				)
			) );
			if( $widget_mapped ) {
				$this->set_base( 'makao_core_icon_list_item' );
				$this->set_name( esc_html__( 'Makao Icon List Item', 'makao-core' ) );
				$this->set_description( esc_html__( 'Add a icon list item element into widget areas', 'makao-core' ) );
			}
		}
		
		public function render( $atts ) {
			
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[makao_core_icon_list_item $params]" ); // XSS OK
		}
	}
}

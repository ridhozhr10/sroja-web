<?php

if ( ! function_exists( 'makao_core_add_social_share_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function makao_core_add_social_share_widget( $widgets ) {
		$widgets[] = 'MakaoCoreSocialShareWidget';
		
		return $widgets;
	}
	
	add_filter( 'makao_core_filter_register_widgets', 'makao_core_add_social_share_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class MakaoCoreSocialShareWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'makao_core_social_share'
			) );
			if( $widget_mapped ) {
				$this->set_base( 'makao_core_social_share' );
				$this->set_name( esc_html__( 'Makao Social Share', 'makao-core' ) );
				$this->set_description( esc_html__( 'Add a social share element into widget areas', 'makao-core' ) );
			}
		}
		
		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[makao_core_social_share $params]" ); // XSS OK
		}
	}
}
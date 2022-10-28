<?php

if ( ! function_exists( 'makao_core_add_blog_list_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function makao_core_add_blog_list_widget( $widgets ) {
		$widgets[] = 'MakaoCoreBlogListWidget';
		
		return $widgets;
	}
	
	add_filter( 'makao_core_filter_register_widgets', 'makao_core_add_blog_list_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class MakaoCoreBlogListWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'widget_title',
					'title'      => esc_html__( 'Title', 'makao-core' )
				)
			);
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'makao_core_blog_list'
			) );
			
			if ( $widget_mapped ) {
				$this->set_base( 'makao_core_blog_list' );
				$this->set_name( esc_html__( 'Makao Blog List', 'makao-core' ) );
				$this->set_description( esc_html__( 'Display a list of blog posts', 'makao-core' ) );
			}
		}
		
		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[makao_core_blog_list $params]" ); // XSS OK
		}
	}
}

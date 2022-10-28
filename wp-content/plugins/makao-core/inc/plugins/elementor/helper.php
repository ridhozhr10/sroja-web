<?php

if ( ! function_exists( 'makao_core_get_elementor_instance' ) ) {
	function makao_core_get_elementor_instance() {
		return \Elementor\Plugin::instance();
	}
}

if ( ! function_exists( 'makao_core_get_elementor_widgets_manager' ) ) {
	function makao_core_get_elementor_widgets_manager() {
		return makao_core_get_elementor_instance()->widgets_manager;
	}
}

if ( ! function_exists( 'makao_core_load_elementor_widgets' ) ) {
	function makao_core_load_elementor_widgets() {
		foreach ( glob( MAKAO_CORE_SHORTCODES_PATH . '/*/*-elementor.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
		
		foreach ( glob( MAKAO_CORE_INC_PATH . '/*/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
		
		foreach ( glob( MAKAO_CORE_CPT_PATH . '/*/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
		
		foreach ( glob( MAKAO_CORE_PLUGINS_PATH . '/*/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	add_action( 'elementor/widgets/widgets_registered', 'makao_core_load_elementor_widgets' );
}
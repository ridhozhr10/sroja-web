<?php

if ( ! function_exists( 'makao_core_include_widgets' ) ) {
	/**
	 * Function that includes widgets
	 */
	function makao_core_include_widgets() {
		foreach ( glob( MAKAO_CORE_INC_PATH . '/widgets/*/include.php' ) as $widget ) {
			include_once $widget;
		}
	}
	
	add_action( 'qode_framework_action_before_widgets_register', 'makao_core_include_widgets' );
}

if ( ! function_exists( 'makao_core_register_widgets' ) ) {
	/**
	 * Function that register widgets
	 */
	function makao_core_register_widgets() {
		$qode_framework = qode_framework_get_framework_root();
		$widgets        = apply_filters( 'makao_core_filter_register_widgets', $widgets = array() );
		
		if ( ! empty( $widgets ) ) {
			foreach ( $widgets as $widget ) {
				$qode_framework->add_widget( new $widget() );
			}
		}
	}
	
	add_action( 'qode_framework_action_before_widgets_register', 'makao_core_register_widgets', 11 ); // Priority 11 set because include of files is called on default action 10
}
<?php

include_once MAKAO_CORE_INC_PATH . '/core-dashboard/core-dashboard.php';

if ( ! function_exists( 'makao_core_dashboard_load_files' ) ) {
	function makao_core_dashboard_load_files() {
		include_once MAKAO_CORE_INC_PATH . '/core-dashboard/rest/include.php';
		include_once MAKAO_CORE_INC_PATH . '/core-dashboard/registration-rest.php';
		include_once MAKAO_CORE_INC_PATH . '/core-dashboard/sub-pages/sub-page.php';
		
		foreach ( glob( MAKAO_CORE_INC_PATH . '/core-dashboard/sub-pages/*/load.php' ) as $subpages ) {
			include_once $subpages;
		}
	}
	
	add_action( 'after_setup_theme', 'makao_core_dashboard_load_files' );
}
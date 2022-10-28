<?php

if ( ! class_exists( 'MakaoCoreMaps' ) ) {
	class MakaoCoreMaps {
		private static $instance;
		
		function __construct() {
			
			// Include google map scripts
            add_action( 'makao_core_action_before_main_js', array( $this, 'include_google_scripts' ) );
			
			// Load global maps variables
            add_action( 'makao_core_action_before_main_js', array( $this, 'set_global_map_variables' ), 20 );
			
			$maps_in_admin = apply_filters( 'materds_core_filter_google_maps_in_admin', false );
			
			if ( $maps_in_admin ) {
				add_action( 'admin_enqueue_scripts', array( $this, 'include_google_scripts' ) );
			}
			
			add_action( 'qode_framework_before_dashboard_scripts', array( $this, 'include_google_scripts' ) );
		}
		
		public static function get_instance() {
			if (null == self::$instance) {
				self::$instance = new self;
			}
			
			return self::$instance;
		}
		
		public function include_google_scripts() {
			$google_maps_api_key          = makao_core_get_option_value( 'admin', 'qodef_maps_api_key' );
			$google_maps_extensions       = '';
			$google_maps_extensions_array = apply_filters( 'makao_core_filter_google_maps_extensions', array() );

			if ( ! empty( $google_maps_extensions_array ) ) {
				$google_maps_extensions .= '&libraries=';
				$google_maps_extensions .= implode( ',', $google_maps_extensions_array );
			}

			if ( ! empty( $google_maps_api_key ) ) {
				wp_register_script( 'google-map-api', '//maps.googleapis.com/maps/api/js?key=' . esc_attr( $google_maps_api_key ) . $google_maps_extensions, array(), false, true );
				wp_register_script( 'map-custom-marker', MAKAO_CORE_INC_URL_PATH . '/maps/assets/js/custom-marker.js', array( 'google-map-api', 'underscore', 'jquery' ), false, true );
				wp_register_script( 'markerclusterer', MAKAO_CORE_INC_URL_PATH . '/maps/assets/js/markerclusterer.js', array( 'google-map-api', 'jquery' ), false, true );
				wp_register_script( 'makao-core-google-map', MAKAO_CORE_INC_URL_PATH . '/maps/assets/js/google-map.js', array( 'google-map-api', 'map-custom-marker', 'markerclusterer', 'jquery' ), false, true );
				wp_register_script( 'nouislider', MAKAO_CORE_INC_URL_PATH . '/maps/assets/js/nouislider.min.js', array(), false, true );
			}
		}
		
		public function set_global_map_variables() {
			$map_zoom = makao_core_get_post_value_through_levels( 'qodef_map_zoom' );
			$map_style = json_decode( makao_core_get_post_value_through_levels( 'qodef_map_style' ) );
			
			$js_map_variables['mapStyle']          = ! empty ( $map_style ) ? $map_style : '';
			$js_map_variables['mapZoom']           = ! empty ( $map_zoom ) ? $map_zoom : 12;
			$js_map_variables['mapScrollable']     = makao_core_get_post_value_through_levels( 'qodef_enable_map_scroll' ) == 'yes' ? true : false;
			$js_map_variables['mapDraggable']      = makao_core_get_post_value_through_levels( 'qodef_enable_map_drag' ) == 'yes' ? true : false;
			$js_map_variables['streetViewControl'] = makao_core_get_post_value_through_levels( 'qodef_enable_map_street_view_control' ) == 'yes' ? true : false;
			$js_map_variables['zoomControl']       = makao_core_get_post_value_through_levels( 'qodef_enable_map_zoom_control' ) == 'yes' ? true : false;
			$js_map_variables['mapTypeControl']    = makao_core_get_post_value_through_levels( 'qodef_enable_map_type_control' ) == 'yes' ? true : false;
			$js_map_variables['fullscreenControl'] = makao_core_get_post_value_through_levels( 'qodef_enable_map_full_screen_control' ) == 'yes' ? true : false;
			
			$js_map_variables = apply_filters( 'makao_core_filter_js_map_variables', $js_map_variables );
			
			wp_localize_script( 'makao-core-google-map', 'qodefMapsVariables', array(
				'global' => $js_map_variables,
			) );
		}
	}
}

MakaoCoreMaps::get_instance();
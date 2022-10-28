<?php

if ( ! function_exists( 'makao_core_add_rest_api_wishlist_dropdown_global_variables' ) ) {
	function makao_core_add_rest_api_wishlist_dropdown_global_variables( $global, $namespace ) {
		$global['wishlistDropdownRestRoute'] = $namespace . '/wishlistdropdown';
		
		return $global;
	}
	
	add_filter( 'makao_filter_rest_api_global_variables', 'makao_core_add_rest_api_wishlist_dropdown_global_variables', 10, 2 );
}

if ( ! function_exists( 'makao_core_add_rest_api_wishlist_remove_route' ) ) {
	function makao_core_add_rest_api_wishlist_remove_route( $routes ) {
		$routes['wishlistdropdown'] = array(
			'route'               => 'wishlistDropdown',
			'methods'             => WP_REST_Server::CREATABLE,
			'callback'            => 'masterds_core_update_wishlist_dropdown_content',
			'permission_callback' => function () {
				return is_user_logged_in();
			},
			'args'                => array(
				'options' => array(
					'required'          => true,
					'validate_callback' => function ( $param, $request, $key ) {
						// Simple solution for validation can be 'is_array' value instead of callback function
						return is_array( $param ) ? $param : (array) $param;
					},
					'description'       => esc_html__( 'Options data is array with reaction and id values', 'makao-core' ),
				),
			),
		);
		
		return $routes;
	}
	
	add_filter( 'makao_filter_rest_api_routes', 'makao_core_add_rest_api_wishlist_remove_route' );
}

if ( ! function_exists( 'makao_core_update_wishlist_dropdown_content' ) ) {
	function makao_core_update_wishlist_dropdown_content() {
		
		if ( isset( $_POST['options'] ) ) {
			$data    = $_POST['options'];
			$item_id = intval( $data['itemID'] );
			
			if ( ! empty( $item_id ) ) {
				$count = makao_core_get_number_of_wishlist_items();
				
				ob_clean();
				
				$item_params          = array();
				$item_params['id']    = $item_id;
				$item_params['title'] = get_the_title( $item_id );
				
				makao_core_template_part( 'wishlist', 'widgets/wishlist-dropdown/templates/item', '', $item_params );
				
				$new_html = ob_get_clean();
				
				qode_framework_get_ajax_status( 'success', esc_html__( 'Updated', 'makao-core' ), array(
					'count'    => $count,
					'new_html' => $new_html
				) );
				
				unset( $_POST['options'] ); // Remove data from global post variable after submission
			} else {
				qode_framework_get_ajax_status( 'error', esc_html__( 'Item ID is invalid.', 'makao-core' ) );
			}
		} else {
			qode_framework_get_ajax_status( 'error', esc_html__( 'Something was wrong.', 'makao-core' ) );
		}
	}
}
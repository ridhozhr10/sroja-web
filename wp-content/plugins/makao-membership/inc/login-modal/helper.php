<?php

if ( ! function_exists( 'makao_membership_add_login_modal_template' ) ) {
	/**
	 * Loads modal template
	 */
	function makao_membership_add_login_modal_template() {
		
		if ( ! is_user_logged_in() ) {
			$dashboard_template = apply_filters( 'makao_membership_filter_dashboard_template_name', '' );
			
			if ( ! empty( $dashboard_template ) && is_page_template( $dashboard_template ) ) {
				add_action( 'makao_membership_action_after_user_dashboard_page_content', 'makao_membership_include_login_modal_template' );
			} else {
				add_action( 'makao_action_before_wrapper_close_tag', 'makao_membership_include_login_modal_template' );
			}
		}
	}
	
	add_action( 'template_redirect', 'makao_membership_add_login_modal_template' ); // template_redirect action is set because it's a first hook where page id is available
}

if ( ! function_exists( 'makao_membership_include_login_modal_template' ) ) {
	/**
	 * Loads modal template
	 */
	function makao_membership_include_login_modal_template() {
		makao_membership_template_part( 'login-modal', 'templates/login-modal' );
	}
}

if ( ! function_exists( 'makao_membership_add_rest_api_login_modal_global_variables' ) ) {
	function makao_membership_add_rest_api_login_modal_global_variables( $global, $namespace ) {
		$global['loginModalRestRoute'] = $namespace . '/login-modal';
		$global['loginModalGetRestRoute'] = $namespace . '/login-modal-get';
		
		return $global;
	}
	
	add_filter( 'makao_filter_rest_api_global_variables', 'makao_membership_add_rest_api_login_modal_global_variables', 10, 2 );
}

if ( ! function_exists( 'makao_membership_add_rest_api_login_modal_route' ) ) {
	function makao_membership_add_rest_api_login_modal_route( $routes ) {
		$routes_values = array(
			'login-modal' => array(
				'methods'  => WP_REST_Server::CREATABLE
			),
			'login-modal-get' => array(
				'methods'  => WP_REST_Server::READABLE
			)
		);
		
		foreach ( $routes_values as $key => $value ) {
			$routes[ $key ] = array(
				'route'    => $key,
				'methods'  => $value['methods'],
				'callback' => 'makao_membership_rest_api_login_modal',
				'args'     => array(
					'options' => array(
						'required'          => true,
						'validate_callback' => function ( $param, $request, $key ) {
							return is_array( $param ) ? $param : (array) strip_tags( $param );
						},
						'description'       => esc_html__( 'Options data is array with all necessary parameters for login functionality.', 'makao-membership' )
					),
					'nonce'   => array(
						'required'          => true,
						'validate_callback' => function ( $param, $request, $key ) {
							return is_string( $param ) ? $param : (string) strip_tags( $param );
						},
						'description'       => esc_html__( 'Secret code to check if user is submitted the form.', 'makao-membership' )
					)
				)
			);
		}
		
		return $routes;
	}
	
	add_filter( 'makao_filter_rest_api_routes', 'makao_membership_add_rest_api_login_modal_route' );
}

if ( ! function_exists( 'makao_membership_rest_api_login_modal' ) ) {
	function makao_membership_rest_api_login_modal() {
		$post_request = $_POST;
		$get_request  = $_GET;
		
		if ( ( ! isset( $post_request ) || empty( $post_request ) ) && ( ! isset( $get_request ) || empty( $get_request ) ) ) {
			qode_framework_get_ajax_status( 'error', esc_html__( 'HTTP method is invalid.', 'makao-membership' ) );
		} else {
			$method = array();
			
			if ( isset( $post_request['options'] ) && ! empty( $post_request['options'] ) ) {
				$method = $post_request;
			} else if ( isset( $get_request['options'] ) && ! empty( $get_request['options'] ) ) {
				$method = $get_request;
			}
			
			$options = array_map( 'sanitize_text_field', $method['options'] );
			
			if ( is_array( $options ) && ! empty( $options ) && wp_verify_nonce( $method['nonce'], "makao-membership-ajax-{$options['request_type']}-nonce" ) ) {
				$response = false;
				
				switch ( $options['request_type'] ) {
					case 'login':
						if ( function_exists( 'makao_membership_init_rest_api_login' ) ) {
							$response = true;
							makao_membership_init_rest_api_login( $options );
						}
						break;
					case 'register':
						if ( function_exists( 'makao_membership_init_rest_api_register' ) ) {
							$response = true;
							makao_membership_init_rest_api_register( $options );
						}
						break;
					case 'reset-password':
						if ( function_exists( 'makao_membership_init_rest_api_reset_password' ) ) {
							$response = true;
							makao_membership_init_rest_api_reset_password( $options );
						}
						break;
				}
				
				unset( $method );
				
				if ( ! $response ) {
					qode_framework_get_ajax_status( 'error', sprintf( esc_html__( 'Something was wrong during the %s process.', 'makao-membership' ), $options['request_type'] ) );
				}
			} else {
				qode_framework_get_ajax_status( 'error', esc_html__( 'You are not authorized.', 'makao-membership' ) );
			}
		}
	}
}

if ( ! function_exists( 'makao_membership_login_current_user_by_meta' ) ) {
	/**
	 * Login current user by meta
	 *
	 * @param string $meta
	 * @param bool $enable_response
	 */
	function makao_membership_login_current_user_by_meta( $meta, $enable_response = true ) {
		$user = get_user_by( is_email( $meta ) ? 'email' : 'login', $meta );
		
		if ( ! is_wp_error( $user ) ) {
			
			if ( is_user_logged_in() ) {
				return;
			}
			
			wp_clear_auth_cookie();
			wp_set_current_user( $user->ID, $user->user_login );
			wp_set_auth_cookie( $user->ID );
			do_action( 'wp_login', $user->user_login, $user );
			
			if ( $enable_response ) {
				qode_framework_get_ajax_status( 'success', esc_html__( 'You are successfully logged in. Please wait...', 'makao-membership' ), null, makao_membership_get_membership_redirect_url() );
			}
		} else {
			qode_framework_get_ajax_status( 'error', esc_html__( 'User credentials are invalid.', 'makao-membership' ) );
		}
	}
}
<?php

if ( ! function_exists( 'makao_membership_get_dashboard_navigation_pages' ) ) {
	/**
	 * Function that return main dashboard page navigation items
	 *
	 * @return array
	 */
	function makao_membership_get_dashboard_navigation_pages() {
		$dashboard_url = makao_membership_get_dashboard_page_url();
		
		$items = array(
			'profile'      => array(
				'url'         => esc_url( add_query_arg( array( 'user-action' => 'profile' ), $dashboard_url ) ),
				'text'        => esc_html__( 'Profile', 'makao-membership' ),
				'user_action' => 'profile',
				'icon'        => '<i class="fa fa-user" aria-hidden="true"></i>'
			),
			'edit-profile' => array(
				'url'         => esc_url( add_query_arg( array( 'user-action' => 'edit-profile' ), $dashboard_url ) ),
				'text'        => esc_html__( 'Edit Profile', 'makao-membership' ),
				'user_action' => 'edit-profile',
				'icon'        => '<i class="fa fa-cog" aria-hidden="true"></i>'
			),
			'log-out' => array(
				'url'         => wp_logout_url( makao_membership_get_membership_redirect_url() ),
				'text'        => esc_html__( 'Log Out', 'makao-membership' ),
				'user_action' => 'log-out',
				'icon'        => '<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>'
			)
		);
		
		$items = apply_filters( 'makao_membership_filter_dashboard_navigation_pages', $items, $dashboard_url );

		return $items;
	}
}

if ( ! function_exists( 'makao_membership_get_dashboard_pages' ) ) {
	/**
	 * Function that return content for main dashboard page item
	 *
	 * @return string that contains html of content
	 */
	function makao_membership_get_dashboard_pages() {
		$action = isset( $_GET['user-action'] ) && ! empty( $_GET['user-action'] ) ? sanitize_text_field( $_GET['user-action'] ) : 'profile';
		
		$params = array();
		if ( 'profile' === $action || 'edit-profile' === $action ) {
			$params = makao_membership_get_user_params( $action );
		}
		
		switch ( $action ) {
			case 'profile':
				$html = makao_membership_get_template_part( 'general', 'page-templates/parts/profile', '', $params );
				break;
			case 'edit-profile':
				$html = makao_membership_get_template_part( 'general', 'page-templates/parts/edit-profile', '', $params );
				break;
			default:
				$html = makao_membership_get_template_part( 'general', 'page-templates/parts/profile', '', $params );
				break;
		}
		
		return apply_filters( 'makao_membership_filter_dashboard_page', $html, $action );
	}
}

if ( ! function_exists( 'makao_membership_get_user_params' ) ) {
	/**
	 * Function that return user attributes for main dashboard page
	 *
	 * @param string $action
	 *
	 * @return array
	 */
	function makao_membership_get_user_params( $action ) {
		$params = array();

		$user = wp_get_current_user();
		$user_id                 = $user->data->ID;

		$params['user']    		 = $user;
		$params['first_name']    = get_the_author_meta( 'first_name', $user_id );
		$params['last_name']     = get_the_author_meta( 'last_name', $user_id );
		$params['email']         = get_the_author_meta( 'user_email', $user_id );
		$params['website']       = get_the_author_meta( 'user_url', $user_id );
		$params['description']   = get_the_author_meta( 'description', $user_id );
		$params['profile_image'] = get_avatar( $user_id, 96 );
		$params['action']        = $action;

		return apply_filters( 'makao_membership_filter_user_params', $params );
	}
}

if ( ! function_exists( 'makao_membership_add_rest_api_update_user_meta_global_variables' ) ) {
	/**
	 * Extend main rest api variables with new case
	 *
	 * @param array $global - list of variables
	 * @param string $namespace - rest namespace url
	 *
	 * @return array
	 */
	function makao_membership_add_rest_api_update_user_meta_global_variables( $global, $namespace ) {
		$global['updateUserRestRoute'] = $namespace . '/edit-profile';
		$global['updateUserNonce']     = wp_create_nonce( 'wp_rest' );

		return $global;
	}

	add_filter( 'qode_framework_filter_rest_api_global_variables', 'makao_membership_add_rest_api_update_user_meta_global_variables', 10, 2 );
}

if ( ! function_exists( 'makao_membership_add_rest_api_update_user_meta_route' ) ) {
	/**
	 * Extend main rest api routes with new case
	 *
	 * @param array $routes - list of rest routes
	 *
	 * @return array
	 */
	function makao_membership_add_rest_api_update_user_meta_route( $routes ) {
		$routes['edit-profile'] = array(
			'route'    => 'edit-profile',
			'methods'  => WP_REST_Server::CREATABLE,
			'callback' => 'makao_membership_update_user_profile',
			'permission_callback' => function () {
				return is_user_logged_in();
			},
			'args'     => array(
				'options' => array(
					'required'          => true,
					'validate_callback' => function ( $param, $request, $key ) {
						// Simple solution for validation can be 'is_array' value instead of callback function
						return is_array( $param ) ? $param : (array) $param;
					},
					'description'       => esc_html__( 'Options data is array with reaction and id values', 'makao-membership' )
				),
			),
		);

		return $routes;
	}

	add_filter( 'qode_framework_filter_rest_api_routes', 'makao_membership_add_rest_api_update_user_meta_route' );
}

if ( ! function_exists( 'makao_membership_update_user_profile' ) ) {
	/**
	 * Function that update user profile
	 */
	function makao_membership_update_user_profile() {

		if ( ! isset( $_POST ) || empty( $_POST ) ) {
			qode_framework_get_ajax_status( 'error', esc_html__( 'Post method is invalid.', 'makao-membership' ) );
		} else {
			$options = isset( $_POST['options'] ) ? $_POST['options'] : array();

			if ( ! empty( $options ) ) {
				parse_str( $options, $options );
	
				$user_id = get_current_user_id();
				
				if ( ! empty( $user_id ) ) {
					$user_fields = array();
					
					if ( isset( $options['user_password'] ) && ! empty( $options['user_password'] ) ) {
						if ( $options['user_password'] === $options['user_confirm_password'] ) {
							$user_fields['user_pass'] = esc_attr( $options['user_password'] );
						} else {
							qode_framework_get_ajax_status( 'error', esc_html__( 'Password and confirm password doesn\'t match.', 'makao-membership' ) );
						}
					}
					
					if ( isset( $options['user_email'] ) && ! empty( $options['user_email'] ) ) {
						
						if ( ! is_email( $options['user_email'] ) ) {
							qode_framework_get_ajax_status( 'error', esc_html__( 'Please provide a valid email address.', 'makao-membership' ) );
						}
						
						$current_user_object = get_user_by( 'email', $options['user_email'] );
						if ( ! empty( $current_user_object ) && $current_user_object->ID !== $user_id && email_exists( $options['user_email'] ) ) {
							qode_framework_get_ajax_status( 'error', esc_html__( 'An account is already registered with this email address. Please fill another one.', 'makao-membership' ) );
						} else {
							$user_fields['user_email'] = sanitize_email( $options['user_email'] );
						}
					}
					
					$simple_fields = array(
						'first_name'  => array(
							'escape' => 'attr'
						),
						'last_name'   => array(
							'escape' => 'attr'
						),
						'user_url'    => array(
							'escape' => 'url'
						),
						'description' => array(
							'escape' => 'attr'
						)
					);
					
					foreach ( $simple_fields as $key => $value ) {
						if ( isset( $options[ $key ] ) && ! empty( $options[ $key ] ) ) {
							$escape = 'esc_' . $value['escape'];
							
							$user_fields[ $key ] = $escape( $options[ $key ] );
						}
					}

					do_action( 'makao_membership_action_update_user_profile', $options, $user_id );
					
					if ( ! empty( $user_fields ) ) {
						wp_update_user( array_merge(
							array( 'ID' => $user_id ),
							$user_fields
						) );
						
						qode_framework_get_ajax_status( 'success', esc_html__( 'Your profile is successfully updated.', 'makao-membership' ), null, makao_membership_get_membership_redirect_url() );
					} else {
						qode_framework_get_ajax_status( 'error', esc_html__( 'Change your information in order to update your profile.', 'makao-membership' ) );
					}
				} else {
					qode_framework_get_ajax_status( 'error', esc_html__( 'You are unauthorized to perform this action.', 'makao-membership' ) );
				}
			} else {
				qode_framework_get_ajax_status( 'error', esc_html__( 'Data are invalid.', 'makao-membership' ) );
			}
		}
	}
}
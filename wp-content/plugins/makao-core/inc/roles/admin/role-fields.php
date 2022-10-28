<?php

if ( ! function_exists( 'makao_core_add_admin_user_options' ) ) {
	function makao_core_add_admin_user_options() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'administrator', 'author' ),
				'type'  => 'user',
				'title' => esc_html__( 'Social Networks', 'makao-core' ),
				'slug'  => 'admin-options',
			)
		);
		
		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_facebook',
					'title'       => esc_html__( 'Facebook', 'makao-core' ),
					'description' => esc_html__( 'Enter user Facebook profile URL', 'makao-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_instagram',
					'title'       => esc_html__( 'Instagram', 'makao-core' ),
					'description' => esc_html__( 'Enter user Instagram profile URL', 'makao-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_twitter',
					'title'       => esc_html__( 'Twitter', 'makao-core' ),
					'description' => esc_html__( 'Enter user Twitter profile URL', 'makao-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_linkedin',
					'title'       => esc_html__( 'LinkedIn', 'makao-core' ),
					'description' => esc_html__( 'Enter user LinkedIn profile URL', 'makao-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_pinterest',
					'title'       => esc_html__( 'Pinterest', 'makao-core' ),
					'description' => esc_html__( 'Enter user Pinterest profile URL', 'makao-core' ),
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'makao_core_action_after_admin_user_options_map', $page );
		}
	}
	
	add_action( 'makao_core_action_register_role_custom_fields', 'makao_core_add_admin_user_options' );
}
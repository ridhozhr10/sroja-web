<?php

if ( ! function_exists( 'makao_core_add_clients_meta_box' ) ) {
	/**
	 * Function that adds fields for clients
	 */
	function makao_core_add_clients_meta_box() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'clients' ),
				'type'  => 'meta',
				'slug'  => 'clients',
				'title' => esc_html__( 'Clients Parameters', 'makao-core' )
			)
		);
		
		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_logo_image',
					'title'      => esc_html__( 'Client Logo Image', 'makao-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_logo_hover_image',
					'title'      => esc_html__( 'Client Logo Hover Image', 'makao-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_client_link',
					'title'      => esc_html__( 'Client Link', 'makao-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_client_link_target',
					'title'      => esc_html__( 'Client Link Target', 'makao-core' ),
					'options'    => makao_core_get_select_type_options_pool( 'link_target' )
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'makao_core_action_after_clients_meta_box_map', $page );
		}
	}
	
	add_action( 'makao_core_action_default_meta_boxes_init', 'makao_core_add_clients_meta_box' );
}
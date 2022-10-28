<?php

if ( ! function_exists( 'makao_core_add_logo_options' ) ) {
	function makao_core_add_logo_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => MAKAO_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'logo',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Logo', 'makao-core' ),
				'description' => esc_html__( 'Global Logo Options', 'makao-core' ),
				'layout'      => 'tabbed'
			)
		);

		if ( $page ) {

			$header_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-header',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Header Logo Options', 'makao-core' ),
					'description' => esc_html__( 'Set options for initial headers', 'makao-core' )
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_logo_height',
					'title'       => esc_html__( 'Logo Height', 'makao-core' ),
					'description' => esc_html__( 'Enter logo height', 'makao-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'makao-core' )
					)
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'    => 'image',
					'name'          => 'qodef_logo_main',
					'title'         => esc_html__( 'Logo - Main', 'makao-core' ),
					'description'   => esc_html__( 'Choose main logo image', 'makao-core' ),
					'default_value' => defined( 'MAKAO_ASSETS_ROOT' ) ? MAKAO_ASSETS_ROOT . '/img/logo.png' : '',
					'multiple'      => 'no'
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_dark',
					'title'       => esc_html__( 'Logo - Dark', 'makao-core' ),
					'description' => esc_html__( 'Choose dark logo image', 'makao-core' ),
					'multiple'    => 'no'
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_light',
					'title'       => esc_html__( 'Logo - Light', 'makao-core' ),
					'description' => esc_html__( 'Choose light logo image', 'makao-core' ),
					'multiple'    => 'no'
				)
			);

			// Hook to include additional options after module options
			do_action( 'makao_core_action_after_header_logo_options_map', $page, $header_tab );
		}
	}

	add_action( 'makao_core_action_default_options_init', 'makao_core_add_logo_options', makao_core_get_admin_options_map_position( 'logo' ) );
}
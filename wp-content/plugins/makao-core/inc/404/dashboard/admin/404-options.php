<?php

if ( ! function_exists( 'makao_core_add_404_page_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function makao_core_add_404_page_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => MAKAO_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => '404',
				'icon'        => 'fa fa-book',
				'title'       => esc_html__( '404', 'makao-core' ),
				'description' => esc_html__( 'Global 404 Page Options', 'makao-core' )
			)
		);
		
		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_404_page_title',
					'title'         => esc_html__( 'Enable Page Title', 'makao-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable page title on 404 page', 'makao-core' ),
					'default_value' => 'no'
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_404_page_footer',
					'title'         => esc_html__( 'Enable Page Footer', 'makao-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable page footer on 404 page', 'makao-core' ),
					'default_value' => 'yes'
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_404_page_background_color',
					'title'       => esc_html__( 'Background Color', 'makao-core' ),
					'description' => esc_html__( 'Enter 404 page area background color', 'makao-core' )
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_404_page_background_image',
					'title'       => esc_html__( 'Background Image', 'makao-core' ),
					'description' => esc_html__( 'Enter 404 page area background image', 'makao-core' )
				)
			);

            $page -> add_field_element (
                array (
                    'field_type' => 'text',
                    'name'       => 'qodef_404_page_tagline',
                    'title'      => esc_html__ ( 'Tagline Label', 'makao-core' ),
                )
            );
            $page -> add_field_element (
                array (
                    'field_type' => 'color',
                    'name'       => 'qodef_404_page_tagline_color',
                    'title'      => esc_html__ ( 'Tagline Color', 'makao-core' ),
                )
            );
			
			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_404_page_title',
					'title'      => esc_html__( 'Title Label', 'makao-core' )
				)
			);
			
			$page->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_404_page_title_color',
					'title'      => esc_html__( 'Title Color', 'makao-core' )
				)
			);
			
			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_404_page_text',
					'title'      => esc_html__( 'Text Label', 'makao-core' )
				)
			);
			
			$page->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_404_page_text_color',
					'title'      => esc_html__( 'Text Color', 'makao-core' )
				)
			);
			
			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_404_page_button_text',
					'title'      => esc_html__( 'Button Text', 'makao-core' )
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'makao_core_action_after_404_page_options_map', $page );
		}
	}
	
	add_action( 'makao_core_action_default_options_init', 'makao_core_add_404_page_options', makao_core_get_admin_options_map_position( '404' ) );
}
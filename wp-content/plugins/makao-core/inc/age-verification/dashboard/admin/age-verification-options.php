<?php

if ( ! function_exists( 'makao_core_add_age_verification_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function makao_core_add_age_verification_options() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope'       => MAKAO_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'age-verification',
				'icon'        => 'fa fa-envelope',
				'title'       => esc_html__( 'Age Verification', 'makao-core' ),
				'description' => esc_html__( 'Age Verification Settings', 'makao-core' )
			)
		);
		
		if ( $page ) {
			
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_age_verification',
					'title'         => esc_html__( 'Enable Age Verification', 'makao-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable Age Verification', 'makao-core' ),
					'default_value' => 'no'
				)
			);
			
			$age_verification_section = $page->add_section_element(
				array(
					'name'       => 'qodef_ae_verification_section',
					'title'      => esc_html__( 'Age Verification', 'makao-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_age_verification' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);
			
			$age_verification_section->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_age_verification_logo_image',
					'title'      => esc_html__( 'Logo Image', 'makao-core' )
				)
			);
			
			$age_verification_section->add_field_element(
				array(
					'field_type'    => 'text',
					'name'          => 'qodef_age_verification_title',
					'title'         => esc_html__( 'Title', 'makao-core' ),
					'description'   => esc_html__( 'Enter Age Verification window title', 'makao-core' ),
					'default_value' => esc_html__( 'Are You Over 18?', 'makao-core' )
				)
			);
			
			$age_verification_section->add_field_element(
				array(
					'field_type'    => 'text',
					'name'          => 'qodef_age_verification_subtitle',
					'title'         => esc_html__( 'Subtitle', 'makao-core' ),
					'description'   => esc_html__( 'Enter Age Verification window subtitle', 'makao-core' ),
					'default_value' => esc_html__( 'By entering this site you agree to our Privacy Policy', 'makao-core' )
				)
			);
			
			$age_verification_section->add_field_element(
				array(
					'field_type'    => 'text',
					'name'          => 'qodef_age_verification_note',
					'title'         => esc_html__( 'Note', 'makao-core' ),
					'description'   => esc_html__( 'Enter Age Verification window note', 'makao-core' ),
					'default_value' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lectus arcu bibendum at varius. Ut porttitor leo a diam. Penatibus et magnis dis. Ut enim ad minim veniam.', 'makao-core' )
				)
			);
			
			$age_verification_section->add_field_element(
				array(
					'field_type'    => 'text',
					'name'          => 'qodef_age_verification_link',
					'title'         => esc_html__( 'Link for Negative Action', 'makao-core' ),
					'description'   => esc_html__( 'Enter Age Verification link for negative action', 'makao-core' ),
					'default_value' => esc_html__( 'https://www.google.com', 'makao-core' )
				)
			);
			
			$age_verification_section->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_age_verification_background_image',
					'title'      => esc_html__( 'Background Image', 'makao-core' )
				)
			);
			
			$age_verification_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_age_verification_prevent_behavior',
					'title'       => esc_html__( 'Age Verification Behavior', 'makao-core' ),
					'description' => esc_html__( 'Choose how to manage modal', 'makao-core' ),
					'options'     => array(
						'cookies' => esc_html__( 'by Cookies', 'makao-core' )
					)
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'makao_core_action_after_age_verification_options_map', $age_verification_section );
		}
	}
	
	add_action( 'makao_core_action_default_options_init', 'makao_core_add_age_verification_options', makao_core_get_admin_options_map_position( 'age-verification' ) );
}
<?php

if ( ! function_exists( 'makao_core_add_fonts_options' ) ) {
	/**
	 * Function that add options for this module
	 */
	function makao_core_add_fonts_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => MAKAO_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'fonts',
				'title'       => esc_html__( 'Fonts', 'makao-core' ),
				'description' => esc_html__( 'Global Fonts Options', 'makao-core' ),
				'icon'        => 'fa fa-cog'
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_google_fonts',
					'title'         => esc_html__( 'Enable Google Fonts', 'makao-core' ),
					'default_value' => 'yes',
					'args'          => array(
						'custom_class' => 'qodef-enable-google-fonts'
					)
				)
			);

			$google_fonts_section = $page->add_section_element(
				array(
					'name'       => 'qodef_google_fonts_section',
					'title'      => esc_html__( 'Google Fonts Options', 'makao-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_enable_google_fonts' => array(
								'values'        => 'yes',
								'default_value' => ''
							)
						)
					)
				)
			);

			$page_repeater = $google_fonts_section->add_repeater_element(
				array(
					'name'        => 'qodef_choose_google_fonts',
					'title'       => esc_html__( 'Google Fonts to Include', 'makao-core' ),
					'description' => esc_html__( 'Choose Google Fonts which you want to use on your website', 'makao-core' ),
					'button_text' => esc_html__( 'Add New Google Font', 'makao-core' )
				)
			);

			$page_repeater->add_field_element( array(
				'field_type'  => 'googlefont',
				'name'        => 'qodef_choose_google_font',
				'title'       => esc_html__( 'Google Font', 'makao-core' ),
				'description' => esc_html__( 'Choose Google Font', 'makao-core' ),
				'args'        => array(
					'include' => 'google-fonts'
				)
			) );

			$google_fonts_section->add_field_element(
				array(
					'field_type'  => 'checkbox',
					'name'        => 'qodef_google_fonts_weight',
					'title'       => esc_html__( 'Google Fonts Weight', 'makao-core' ),
					'description' => esc_html__( 'Choose a default Google Fonts weights for your website. Impact on page load time', 'makao-core' ),
					'options'     => array(
						'100'  => esc_html__( '100 Thin', 'makao-core' ),
						'100i' => esc_html__( '100 Thin Italic', 'makao-core' ),
						'200'  => esc_html__( '200 Extra-Light', 'makao-core' ),
						'200i' => esc_html__( '200 Extra-Light Italic', 'makao-core' ),
						'300'  => esc_html__( '300 Light', 'makao-core' ),
						'300i' => esc_html__( '300 Light Italic', 'makao-core' ),
						'400'  => esc_html__( '400 Regular', 'makao-core' ),
						'400i' => esc_html__( '400 Regular Italic', 'makao-core' ),
						'500'  => esc_html__( '500 Medium', 'makao-core' ),
						'500i' => esc_html__( '500 Medium Italic', 'makao-core' ),
						'600'  => esc_html__( '600 Semi-Bold', 'makao-core' ),
						'600i' => esc_html__( '600 Semi-Bold Italic', 'makao-core' ),
						'700'  => esc_html__( '700 Bold', 'makao-core' ),
						'700i' => esc_html__( '700 Bold Italic', 'makao-core' ),
						'800'  => esc_html__( '800 Extra-Bold', 'makao-core' ),
						'800i' => esc_html__( '800 Extra-Bold Italic', 'makao-core' ),
						'900'  => esc_html__( '900 Ultra-Bold', 'makao-core' ),
						'900i' => esc_html__( '900 Ultra-Bold Italic', 'makao-core' )
					)
				)
			);

			$google_fonts_section->add_field_element(
				array(
					'field_type'  => 'checkbox',
					'name'        => 'qodef_google_fonts_subset',
					'title'       => esc_html__( 'Google Fonts Style', 'makao-core' ),
					'description' => esc_html__( 'Choose a default Google Fonts style for your website. Impact on page load time', 'makao-core' ),
					'options'     => array(
						'latin'        => esc_html__( 'Latin', 'makao-core' ),
						'latin-ext'    => esc_html__( 'Latin Extended', 'makao-core' ),
						'cyrillic'     => esc_html__( 'Cyrillic', 'makao-core' ),
						'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'makao-core' ),
						'greek'        => esc_html__( 'Greek', 'makao-core' ),
						'greek-ext'    => esc_html__( 'Greek Extended', 'makao-core' ),
						'vietnamese'   => esc_html__( 'Vietnamese', 'makao-core' )
					)
				)
			);

			$page_repeater = $page->add_repeater_element(
				array(
					'name'        => 'qodef_custom_fonts',
					'title'       => esc_html__( 'Custom Fonts', 'makao-core' ),
					'description' => esc_html__( 'Add custom fonts', 'makao-core' ),
					'button_text' => esc_html__( 'Add New Custom Font', 'makao-core' )
				)
			);

			$page_repeater->add_field_element( array(
				'field_type' => 'file',
				'name'       => 'qodef_custom_font_ttf',
				'title'      => esc_html__( 'Custom Font TTF', 'makao-core' ),
				'args'       => array(
					'allowed_type' => 'application/octet-stream'
				)
			) );

			$page_repeater->add_field_element( array(
				'field_type' => 'file',
				'name'       => 'qodef_custom_font_otf',
				'title'      => esc_html__( 'Custom Font OTF', 'makao-core' ),
				'args'       => array(
					'allowed_type' => 'application/octet-stream'
				)
			) );

			$page_repeater->add_field_element( array(
				'field_type' => 'file',
				'name'       => 'qodef_custom_font_woff',
				'title'      => esc_html__( 'Custom Font WOFF', 'makao-core' ),
				'args'       => array(
					'allowed_type' => 'application/octet-stream'
				)
			) );

			$page_repeater->add_field_element( array(
				'field_type' => 'file',
				'name'       => 'qodef_custom_font_woff2',
				'title'      => esc_html__( 'Custom Font WOFF2', 'makao-core' ),
				'args'       => array(
					'allowed_type' => 'application/octet-stream'
				)
			) );

			$page_repeater->add_field_element( array(
				'field_type' => 'text',
				'name'       => 'qodef_custom_font_name',
				'title'      => esc_html__( 'Custom Font Name', 'makao-core' ),
			) );

			// Hook to include additional options after module options
			do_action( 'makao_core_action_after_page_fonts_options_map', $page );
		}
	}

	add_action( 'makao_core_action_default_options_init', 'makao_core_add_fonts_options', makao_core_get_admin_options_map_position( 'fonts' ) );
}
<?php

if ( ! function_exists( 'makao_register_required_plugins' ) ) {
	/**
	 * Function that registers theme required and optional plugins. Hooks to tgmpa_register hook
	 */
	function makao_register_required_plugins() {
		$plugins = array(
			array(
				'name'               => esc_html__( 'Qode Framework', 'makao' ),
				'slug'               => 'qode-framework',
				'source'             => MAKAO_INC_ROOT_DIR . '/plugins/qode-framework.zip',
				'version'            => '1.1.3',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false,
			),
			array(
				'name'               => esc_html__( 'Makao Core', 'makao' ),
				'slug'               => 'makao-core',
				'source'             => MAKAO_INC_ROOT_DIR . '/plugins/makao-core.zip',
				'version'            => '1.0.2',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false,
			),
            array(
				'name'               => esc_html__( 'Makao Membership', 'makao' ),
				'slug'               => 'makao-membership',
				'source'             => MAKAO_INC_ROOT_DIR . '/plugins/makao-membership.zip',
				'version'            => '1.0.1',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false,
			),
			array(
				'name'               => esc_html__( 'Revolution Slider', 'makao' ),
				'slug'               => 'revslider',
				'source'             => MAKAO_INC_ROOT_DIR . '/plugins/revslider.zip',
				'version'            => '6.4.11',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false,
			),
            array(
                'name'     => esc_html__( 'Elementor Page Builder', 'makao' ),
                'slug'     => 'elementor',
                'required' => true,
            ),
			array(
				'name'     => esc_html__( 'Qi Addons For Elementor', 'makao' ),
				'slug'     => 'qi-addons-for-elementor',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'WooCommerce Plugin', 'makao' ),
				'slug'     => 'woocommerce',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'Contact Form 7', 'makao' ),
				'slug'     => 'contact-form-7',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'Custom Twitter Feeds', 'makao' ),
				'slug'     => 'custom-twitter-feeds',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'Instagram Feed', 'makao' ),
				'slug'     => 'instagram-feed',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'Envato Market', 'makao' ),
				'slug'     => 'envato-market',
				'source'   => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
				'required' => false,
			)
		);
		
		$config = array(
			'domain'       => 'makao',
			'default_path' => '',
			'parent_slug'  => 'themes.php',
			'capability'   => 'edit_theme_options',
			'menu'         => 'install-required-plugins',
			'has_notices'  => true,
			'is_automatic' => false,
			'message'      => '',
			'strings'      => array(
				'page_title'                      => esc_html__( 'Install Required Plugins', 'makao' ),
				'menu_title'                      => esc_html__( 'Install Plugins', 'makao' ),
				'installing'                      => esc_html__( 'Installing Plugin: %s', 'makao' ),
				'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'makao' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'makao' ),
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'makao' ),
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this website for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'makao' ),
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'makao' ),
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'makao' ),
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this website for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'makao' ),
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'makao' ),
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this website for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'makao' ),
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'makao' ),
				'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'makao' ),
				'return'                          => esc_html__( 'Return to Required Plugins Installer', 'makao' ),
				'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'makao' ),
				'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'makao' ),
				'nag_type'                        => 'updated'
			),
		);
		
		tgmpa( $plugins, $config );
	}
	
	add_action( 'tgmpa_register', 'makao_register_required_plugins' );
}
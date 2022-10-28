<?php

class MinimalHeader extends MakaoCoreHeader {
	private static $instance;

	public function __construct() {
		$this->set_slug( 'minimal' );
		$this->search_layout         = 'fullscreen';
		$this->default_header_height = 90;

		add_action( 'makao_action_before_wrapper_close_tag', array( $this, 'fullscreen_menu_template' ) );

		parent::__construct();
	}

	public static function get_instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	function fullscreen_menu_template() {
		$parameters = array(
			'fullscreen_menu_in_grid' => makao_core_get_post_value_through_levels( 'qodef_fullscreen_menu_in_grid' ) === 'yes'
		);

		makao_core_template_part( 'fullscreen-menu', 'templates/full-screen-menu', '', $parameters );
	}
}
<?php

class VerticalHeader extends MakaoCoreHeader {
	private static $instance;

	public function __construct() {
		$this->set_slug( 'vertical' );
		$this->overriding_whole_header = true;

		parent::__construct();
	}

	public static function get_instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function enqueue_additional_assets() {
		wp_enqueue_style( 'perfect-scrollbar', MAKAO_CORE_URL_PATH . 'assets/plugins/perfect-scrollbar/perfect-scrollbar.css', array() );
		wp_enqueue_script( 'perfect-scrollbar', MAKAO_CORE_URL_PATH . 'assets/plugins/perfect-scrollbar/perfect-scrollbar.jquery.min.js', array( 'jquery' ), false, true );
	}

	public function set_nav_menu_header_selector( $selector ) {
		return '.qodef-header--vertical .qodef-header-vertical-navigation';
	}

	public function set_nav_menu_narrow_header_selector( $selector ) {
		return '';
	}
}
<?php

class VerticalSlidingHeader extends MakaoCoreHeader {
	private static $instance;

	public function __construct() {
		$this->set_slug( 'vertical-sliding' );
		$this->overriding_whole_header = true;

        add_filter( 'body_class', array( $this, 'add_body_classes' ) );

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
		return '.qodef-header--vertical-sliding .qodef-header-vertical-sliding-navigation';
	}

	public function set_nav_menu_narrow_header_selector( $selector ) {
		return '';
	}

    function add_body_classes( $classes ) {
        $only_main_logo = makao_core_get_post_value_through_levels( 'qodef_vertical_sliding_menu_only_main_logo' );

        $classes[] = ! empty( $only_main_logo ) && $only_main_logo === 'yes'  ? 'qodef-only-main-logo' : '';

        return $classes;
    }
}
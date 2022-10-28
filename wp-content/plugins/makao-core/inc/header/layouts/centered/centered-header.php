<?php

class CenteredHeader extends MakaoCoreHeader {
	private static $instance;

	public function __construct() {
		$this->set_slug( 'centered' );
		$this->default_header_height = 134;

		parent::__construct();
	}

	public static function get_instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}
<?php
class FullscreenSearch extends MakaoCoreSearch {
	private static $instance;

	public function __construct() {
		parent::__construct();
		add_action('makao_action_page_footer_template', array($this, 'load_template'), 11); //after footer
	}

	public static function get_instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function load_template() {
		if(is_active_widget(false,false,'makao_core_search_opener')) {
			makao_core_template_part('search/layouts/' . $this->search_layout, 'templates/' . $this->search_layout);
		}
	}
}
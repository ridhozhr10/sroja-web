<?php
if ( ! function_exists( 'makao_core_add_import_sub_page_to_list' ) ) {
	function makao_core_add_import_sub_page_to_list( $sub_pages ) {
		$sub_pages[] = 'MakaoCoreImportPage';
		return $sub_pages;
	}
	
	add_filter( 'makao_core_filter_add_welcome_sub_page', 'makao_core_add_import_sub_page_to_list', 11 );
}

if ( class_exists( 'MakaoCoreSubPage' ) ) {
	class MakaoCoreImportPage extends MakaoCoreSubPage {
		
		public function __construct() {
			parent::__construct();
		}
		
		public function add_sub_page() {
			$this->set_base( 'import' );
			$this->set_title( esc_html__('Import', 'makao-core'));
			$this->set_atts( $this->set_atributtes());
		}

		public function set_atributtes(){
			$params = array();

			$iparams = MakaoCoreDashboard::get_instance()->get_import_params();
			if(is_array($iparams) && isset($iparams['submit'])) {
				$params['submit'] = $iparams['submit'];
			}

			return $params;
		}
	}
}
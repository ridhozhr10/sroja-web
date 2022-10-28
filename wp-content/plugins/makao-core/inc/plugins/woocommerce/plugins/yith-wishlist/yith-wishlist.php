<?php

if ( ! class_exists( 'MakaoCoreWooCommerceYITHWishlist' ) ) {
	class MakaoCoreWooCommerceYITHWishlist {
		private static $instance;
		
		public function __construct() {
			
			if ( qode_framework_is_installed( 'yith-wishlist' ) ) {
				// Init
				add_action( 'after_setup_theme', array( $this, 'init' ) );
			}
		}
		
		public static function get_instance() {
			if ( self::$instance == null ) {
				self::$instance = new self();
			}
			
			return self::$instance;
		}
		
		function init() {
			
			// Unset default templates modules
			$this->unset_templates_modules();
			
			// Change default templates position
			$this->change_templates_position();
		}
		
		function unset_templates_modules() {
			// Remove quick view button from wishlist
			remove_all_actions( 'yith_wcwl_table_after_product_name' );
		}
		
		function change_templates_position() {
			// Add button element for shop pages
			add_action( 'makao_core_action_product_list_item_additional_image_content', 'makao_core_get_yith_wishlist_shortcode' );
		}
	}
	
	MakaoCoreWooCommerceYITHWishlist::get_instance();
}
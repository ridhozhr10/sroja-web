<?php

if ( ! class_exists( 'MakaoCoreWooCommerce' ) ) {
	class MakaoCoreWooCommerce {
		private static $instance;
		
		public function __construct() {
			
			if ( qode_framework_is_installed( 'woocommerce' ) ) {
				// Include files
				$this->include_files();
				
				// Init
				add_action( 'before_woocommerce_init', array( $this, 'init' ) );
			}
		}
		
		public static function get_instance() {
			if ( self::$instance == null ) {
				self::$instance = new self();
			}
			
			return self::$instance;
		}
		
		function include_files() {
			// Include helper functions
			include_once MAKAO_CORE_PLUGINS_PATH . '/woocommerce/helper.php';
			
			// Include template helper functions
			include_once MAKAO_CORE_PLUGINS_PATH . '/woocommerce/template-functions.php';
			
			// Include options
			include_once MAKAO_CORE_PLUGINS_PATH . '/woocommerce/dashboard/admin/woocommerce-options.php';
			
			// Include meta boxes
			include_once MAKAO_CORE_PLUGINS_PATH . '/woocommerce/dashboard/meta-box/product-meta-box.php';
			
			// Include shortcodes
			add_action( 'qode_framework_action_before_shortcodes_register', array( $this, 'include_shortcodes' ) );
			
			// Include widgets
			add_action( 'qode_framework_action_before_widgets_register', array( $this, 'include_widgets' ) );
			
			// Include plugin addons
			foreach ( glob( MAKAO_CORE_PLUGINS_PATH . '/woocommerce/plugins/*/include.php' ) as $plugin ) {
				include_once $plugin;
			}
			
			// Set product list layout
			add_action( 'qode_framework_action_after_options_init_' . MAKAO_CORE_OPTIONS_NAME, array( $this, 'set_product_list_layout' ) );
		}
		
		function init() {
			// Adds theme supports
			add_theme_support( 'woocommerce' );
			
			// Disable default WooCommerce style
			add_filter( 'woocommerce_enqueue_styles', '__return_false' );
			
			// Enqueue 3rd party plugins script
			add_action( 'makao_core_action_before_main_js', array( $this, 'enqueue_assets' ) );
			
			// Unset default WooCommerce templates modules
			$this->unset_templates_modules();
			
			// Add new WooCommerce templates
//			$this->add_templates();
//
//			// Change default WooCommerce templates position
//			$this->change_templates_position();
//
//			// Override default WooCommerce templates
//			$this->override_templates();
		}
		
		function include_shortcodes() {
			foreach ( glob( MAKAO_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/*/include.php' ) as $shortcode ) {
				include_once $shortcode;
			}
		}
		
		function include_widgets() {
			foreach ( glob( MAKAO_CORE_PLUGINS_PATH . '/woocommerce/widgets/*/include.php' ) as $widget ) {
				include_once $widget;
			}
		}
		
		function enqueue_assets() {
			// Enqueue plugin's 3rd party scripts (select2 is registered inside WooCommerce plugin)
			wp_enqueue_script( 'select2' );
		}
		
		function unset_templates_modules() {
			// Remove main shop holder
			remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
			remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
			
			// Remove breadcrumbs
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
			
			// Remove sidebar
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
			
			// Remove product ratings on list
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
			
			// Remove product link on list
			remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
		}
		
		function add_templates() {
			/**
			 * Global templates hooks
			 */
			
			// Add grid template holder around shop
			add_action( 'woocommerce_before_main_content', 'makao_core_add_main_woo_page_template_holder', 5 ); // permission 5 is set because makao_core_add_main_woo_page_holder hook is added on 10
			add_action( 'woocommerce_after_main_content', 'makao_core_add_main_woo_page_template_holder_end', 20 ); // permission 20 is set because makao_core_add_main_woo_page_holder_end hook is added on 10
			
			// Add main shop holder
			add_action( 'woocommerce_before_main_content', 'makao_core_add_main_woo_page_holder', 10 );
			add_action( 'woocommerce_after_main_content', 'makao_core_add_main_woo_page_holder_end', 10 );
			add_action( 'woocommerce_before_cart', 'makao_core_add_main_woo_page_holder', 5 ); // permission 5 is set just to holder be at the first place
			add_action( 'woocommerce_after_cart', 'makao_core_add_main_woo_page_holder_end', 20 ); // permission 20 is set just to holder be at the last place
			add_action( 'woocommerce_before_checkout_form', 'makao_core_add_main_woo_page_holder', 5 ); // permission 5 is set just to holder be at the first place
			add_action( 'woocommerce_after_checkout_form', 'makao_core_add_main_woo_page_holder_end', 20 ); // permission 20 is set just to holder be at the last place
			
			// Add additional tags around results and ordering
			add_action( 'woocommerce_before_shop_loop', 'makao_core_add_results_and_ordering_holder', 15 ); // permission 5 is set because wc_print_notices hook is added on 10
			add_action( 'woocommerce_before_shop_loop', 'makao_core_add_results_and_ordering_holder_end', 40 ); // permission 40 is set because woocommerce_catalog_ordering hook is added on 30
			
			// Add sidebar templates for shop page
			add_action( 'woocommerce_after_main_content', 'makao_core_add_main_woo_page_sidebar_holder', 15 ); // permission 15 is set because makao_core_add_main_woo_page_holder_end hook is added on 10
			
			// Add out of stock mark for product list item
			add_filter( 'woocommerce_before_single_product_summary', 'makao_core_add_out_of_stock_mark_on_product', 10 ); // permission 10 is set because woocommerce_show_product_sale_flash hook is added on 10
			add_action( 'woocommerce_before_shop_loop_item_title', 'makao_core_add_out_of_stock_mark_on_product', 10 ); // permission 10 is set because woocommerce_show_product_loop_sale_flash hook is added on 10
			
			// Add new mark for product list item
			add_filter( 'woocommerce_before_single_product_summary', 'makao_core_add_new_mark_on_product', 10 ); // permission 10 is set because woocommerce_show_product_sale_flash hook is added on 10
			add_action( 'woocommerce_before_shop_loop_item_title', 'makao_core_add_new_mark_on_product', 10 ); // permission 10 is set because woocommerce_show_product_loop_sale_flash hook is added on 10
			
			/**
			 * Product single page templates hooks
			 */
			
			// Add additional tags around product image and content
			add_action( 'woocommerce_before_single_product_summary', 'makao_core_add_product_single_content_holder', 2 ); // permission 2 is set because makao_core_add_product_single_image_holder hook is added on 5
			add_action( 'woocommerce_after_single_product_summary', 'makao_core_add_product_single_content_holder_end', 5 ); // permission 5 is set because woocommerce_output_product_data_tabs hook is added on 10
			
			// Add additional tags around product list item image
			add_action( 'woocommerce_before_single_product_summary', 'makao_core_add_product_single_image_holder', 5 ); // permission 5 is set because woocommerce_show_product_sale_flash hook is added on 10
			add_action( 'woocommerce_before_single_product_summary', 'makao_core_add_product_single_image_holder_end', 30 ); // permission 30 is set because woocommerce_show_product_images hook is added on 20
			
			// Add social share template for product single page
			add_action( 'woocommerce_share', 'makao_core_woo_product_render_social_share_html', 25 );

//            //Change product tabs position
//            remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
//            add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 55);

			// add additional tags around product single thumbnails
            remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
			add_action( 'woocommerce_product_thumbnails', 'makao_core_woo_single_thumbnail_images_wrapper', 5 );
			add_action( 'woocommerce_product_thumbnails', 'makao_core_woo_single_thumbnail_images_wrapper_end', 35 );
			add_action( 'woocommerce_before_single_product_summary', 'makao_core_woo_get_product_image_gallery', 25 );

		}
		
		function change_templates_position() {
			// Add link around image for product list item
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_open', 29 ); // permission 29 is set because makao_core_add_product_list_item_holder_end hook is closed on 30
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 29 );
		}
		
		function override_templates() {
			
			// Disable page heading
			add_filter( 'woocommerce_show_page_title', 'makao_core_woo_disable_page_heading' );
			
			// Override product list holder
			add_filter( 'woocommerce_product_loop_start', 'makao_core_add_product_list_holder' );
			add_filter( 'woocommerce_product_loop_end', 'makao_core_add_product_list_holder_end' );
			
			// Override number of columns for main shop page
			add_filter( 'loop_shop_columns', 'makao_core_woo_product_list_columns' );
			
			// Override number of products per page
			add_filter( 'loop_shop_per_page', 'makao_core_woo_products_per_page' );
			
			// Override list pagination args
			add_filter( 'woocommerce_pagination_args', 'makao_core_woo_pagination_args' );

			// Override reviews pagination args
			add_filter( 'woocommerce_comment_pagination_args', 'makao_core_woo_pagination_args' );

			// Override On sale template
			add_filter( 'woocommerce_sale_flash', 'makao_core_woo_sale_flash' );
			
			// Override product title
			remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 ); // permission 10 is default
			add_action( 'woocommerce_shop_loop_item_title', 'makao_core_woo_shop_loop_item_title', 10 );
			
			// Add product classes
			add_filter( 'post_class', 'makao_core_add_single_product_classes', 10, 3 );
			
			// Override product title
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 ); // permission 5 is default
			add_action( 'woocommerce_single_product_summary', 'makao_core_woo_template_single_title', 5 );
			
			// Override number of thumbnails for single product
			add_filter( 'woocommerce_product_thumbnails_columns', 'makao_core_woo_single_thumbnail_images_columns' );
			
			// Override thumbnails size for single product
			add_filter( 'woocommerce_gallery_thumbnail_size', 'makao_core_woo_single_thumbnail_images_size' );
			
			// Override related products args
			add_filter( 'woocommerce_output_related_products_args', 'makao_core_woo_single_related_product_list_columns' );
			
			// Override rating template
			add_filter( 'woocommerce_product_get_rating_html', 'makao_core_woo_product_get_rating_html', 10, 3 );
			
			// Override product search form template
			add_filter( 'get_product_search_form', 'makao_core_woo_get_product_search_form' );
			
			// Override product content widget template
			add_filter( 'wc_get_template', 'makao_core_woo_get_content_widget_product', 10, 5 );
			
			// Override quantity input template
			add_filter( 'wc_get_template', 'makao_core_woo_get_quantity_input', 10, 5 );
			
			// Override single product meta template
			add_filter( 'wc_get_template', 'makao_core_woo_get_single_product_meta', 10, 5 );
		}
		
		function set_product_list_layout() {
			
			/**
			 * Shop page templates hooks
			 */
			$list_item_layouts = apply_filters( 'makao_core_filter_product_list_layouts', array() );
			$options_map       = makao_core_get_variations_options_map( $list_item_layouts );
			
			if ( $options_map['visibility'] ) {
				$options_map['default_value'] = makao_core_get_option_value( 'admin', 'qodef_product_list_item_layout', $options_map['default_value'] );
			}

            // This conditional can't be inside constructor because Elementor doesn't recognize it
            if ( qode_framework_is_installed( 'theme' ) ) {
                do_action ( 'makao_core_action_shop_list_item_layout_' . $options_map[ 'default_value' ] );
            }
		}
	}
	
	MakaoCoreWooCommerce::get_instance();
}
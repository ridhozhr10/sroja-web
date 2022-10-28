<?php

/**
 * Global templates hooks
 */

if ( ! function_exists( 'makao_add_main_woo_page_template_holder' ) ) {
	/**
	 * Function that render additional content for main shop page
	 */
	function makao_add_main_woo_page_template_holder() {
		echo '<main id="qodef-page-content" class="qodef-grid qodef-layout--template qodef--no-bottom-space ' . esc_attr( makao_get_grid_gutter_classes() ) . '"><div class="qodef-grid-inner clear">';
	}
}

if ( ! function_exists( 'makao_add_main_woo_page_template_holder_end' ) ) {
	/**
	 * Function that render additional content for main shop page
	 */
	function makao_add_main_woo_page_template_holder_end() {
		echo '</div></main>';
	}
}

if ( ! function_exists( 'makao_add_main_woo_page_holder' ) ) {
	/**
	 * Function that render additional content around WooCommerce pages
	 */
	function makao_add_main_woo_page_holder() {
		$classes = array();
		
		// add class to pages with sidebar and on single page
		if ( makao_is_woo_page( 'shop' ) || makao_is_woo_page( 'category' ) || makao_is_woo_page( 'tag' ) || makao_is_woo_page( 'single' ) ) {
			$classes[] = 'qodef-grid-item';
		}
		
		// add class to pages with sidebar
		if ( makao_is_woo_page( 'shop' ) || makao_is_woo_page( 'category' ) || makao_is_woo_page( 'tag' ) ) {
			$classes[] = makao_get_page_content_sidebar_classes();
		}
		
		$classes[] = makao_get_woo_main_page_classes();
		
		echo '<div id="qodef-woo-page" class="' . implode( ' ', $classes ) . '" >';
	}
}

if ( ! function_exists( 'makao_add_main_woo_page_holder_end' ) ) {
	/**
	 * Function that render additional content around WooCommerce pages
	 */
	function makao_add_main_woo_page_holder_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'makao_add_main_woo_page_sidebar_holder' ) ) {
	/**
	 * Function that render sidebar layout for main shop page
	 */
	function makao_add_main_woo_page_sidebar_holder() {
		
		if ( ! is_singular( 'product' ) ) {
			// Include page content sidebar
			makao_template_part( 'sidebar', 'templates/sidebar' );
		}
	}
}

if ( ! function_exists( 'makao_woo_render_product_categories' ) ) {
	/**
	 * Function that render product categories
	 *
	 * @param $before string
	 * @param $after string
	 */
	function makao_woo_render_product_categories( $before = '', $after = '' ) {
		echo makao_woo_get_product_categories( $before, $after );
	}
}

if ( ! function_exists( 'makao_woo_get_product_categories' ) ) {
	/**
	 * Function that render product categories
	 *
	 * @param $before string
	 * @param $after string
	 *
	 * @return string
	 */
	function makao_woo_get_product_categories( $before = '', $after = '' ) {
		$product = makao_woo_get_global_product();
		
		return ! empty( $product ) ? wc_get_product_category_list( $product->get_id(), '<span class="qodef-category-separator"></span>', $before, $after ) : '';
	}
}

/**
 * Shop page templates hooks
 */

if ( ! function_exists( 'makao_add_results_and_ordering_holder' ) ) {
	/**
	 * Function that render additional content around results and ordering templates on main shop page
	 */
	function makao_add_results_and_ordering_holder() {
		echo '<div class="qodef-woo-results">';
	}
}

if ( ! function_exists( 'makao_add_results_and_ordering_holder_end' ) ) {
	/**
	 * Function that render additional content around results and ordering templates on main shop page
	 */
	function makao_add_results_and_ordering_holder_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'makao_add_product_list_item_holder' ) ) {
	/**
	 * Function that render additional content around product list item on main shop page
	 */
	function makao_add_product_list_item_holder() {
		echo '<div class="qodef-woo-product-inner">';
	}
}

if ( ! function_exists( 'makao_add_product_list_item_holder_end' ) ) {
	/**
	 * Function that render additional content around product list item on main shop page
	 */
	function makao_add_product_list_item_holder_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'makao_add_product_list_item_image_holder' ) ) {
	/**
	 * Function that render additional content around image template on main shop page
	 */
	function makao_add_product_list_item_image_holder() {
		echo '<div class="qodef-woo-product-image">';
	}
}

if ( ! function_exists( 'makao_add_product_list_item_image_holder_end' ) ) {
	/**
	 * Function that render additional content around image template on main shop page
	 */
	function makao_add_product_list_item_image_holder_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'makao_add_product_list_item_additional_image_holder' ) ) {
	/**
	 * Function that render additional content around image and sale templates on main shop page
	 */
	function makao_add_product_list_item_additional_image_holder() {
		echo '<div class="qodef-woo-product-image-inner"><div class="qodef-woo-product-button-holder">';
	}
}

if ( ! function_exists( 'makao_add_product_list_item_additional_image_holder_end' ) ) {
	/**
	 * Function that render additional content around image and sale templates on main shop page
	 */
	function makao_add_product_list_item_additional_image_holder_end() {
		// Hook to include additional content inside product list item image
		do_action( 'makao_action_product_list_item_additional_image_content' );
		
		echo '</div></div>';
	}
}

if ( ! function_exists( 'makao_add_product_list_item_content_holder' ) ) {
	/**
	 * Function that render additional content around product info on main shop page
	 */
	function makao_add_product_list_item_content_holder() {
		echo '<div class="qodef-woo-product-content">';
	}
}

if ( ! function_exists( 'makao_add_product_list_item_content_holder_end' ) ) {
	/**
	 * Function that render additional content around product info on main shop page
	 */
	function makao_add_product_list_item_content_holder_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'makao_add_product_list_item_categories' ) ) {
	/**
	 * Function that render product categories
	 */
	function makao_add_product_list_item_categories() {
		makao_woo_render_product_categories( '<div class="qodef-woo-product-categories">', '</div>' );
	}
}

/**
 * Product single page templates hooks
 */

if ( ! function_exists( 'makao_add_product_single_content_holder' ) ) {
	/**
	 * Function that render additional content around image and summary templates on single product page
	 */
	function makao_add_product_single_content_holder() {
		echo '<div class="qodef-woo-single-inner">';
	}
}

if ( ! function_exists( 'makao_add_product_single_content_holder_end' ) ) {
	/**
	 * Function that render additional content around image and summary templates on single product page
	 */
	function makao_add_product_single_content_holder_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'makao_add_product_single_image_holder' ) ) {
	/**
	 * Function that render additional content around featured image on single product page
	 */
	function makao_add_product_single_image_holder() {
		echo '<div class="qodef-woo-single-image">';
	}
}

if ( ! function_exists( 'makao_add_product_single_image_holder_end' ) ) {
	/**
	 * Function that render additional content around featured image on single product page
	 */
	function makao_add_product_single_image_holder_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'makao_woo_product_render_social_share_html' ) ) {
	/**
	 * Function that render social share html
	 */
	function makao_woo_product_render_social_share_html() {
		
		if ( class_exists( 'MakaoCoreSocialShareShortcode' ) ) {
			$params           = array();
			$params['layout'] = 'text';
			$params['title']  = esc_html__( 'Share:', 'makao' );
			
			echo MakaoCoreSocialShareShortcode::call_shortcode( $params );
		}
	}
}

/**
 * Override default WooCommerce templates
 */

if ( ! function_exists( 'makao_woo_disable_page_heading' ) ) {
	/**
	 * Function that disable heading template on main shop page
	 *
	 * @return bool
	 */
	function makao_woo_disable_page_heading() {
		return false;
	}
}

if ( ! function_exists( 'makao_add_product_list_holder' ) ) {
	/**
	 * Function that add additional content around product lists on main shop page
	 *
	 * @param $html string
	 *
	 * @return string which contains html content
	 */
	function makao_add_product_list_holder( $html ) {
		$classes = array();
		$layout  = makao_get_post_value_through_levels( 'qodef_product_list_item_layout' );
		$option  = makao_get_post_value_through_levels( 'qodef_woo_product_list_columns_space' );
		
		if ( ! empty( $layout ) ) {
			$classes[] = 'qodef-item-layout--' . $layout;
		}
		
		if ( ! empty( $option ) ) {
			$classes[] = 'qodef-gutter--' . $option;
		}
		
		$classes = implode( ' ', $classes );
		
		return '<div class="qodef-woo-product-list ' . esc_attr( $classes ) . '">' . $html;
	}
}

if ( ! function_exists( 'makao_add_product_list_holder_end' ) ) {
	/**
	 * Function that add additional content around product lists on main shop page
	 *
	 * @param $html string
	 *
	 * @return string which contains html content
	 */
	function makao_add_product_list_holder_end( $html ) {
		return $html . '</div>';
	}
}

if ( ! function_exists( 'makao_woo_product_list_columns' ) ) {
	/**
	 * Function that set number of columns for main shop page
	 *
	 * @param $columns int
	 *
	 * @return int
	 */
	function makao_woo_product_list_columns( $columns ) {
		$option = makao_get_post_value_through_levels( 'qodef_woo_product_list_columns' );
		
		if ( ! empty( $option ) ) {
			$columns = intval( $option );
		} else {
			$columns = 3;
		}
		
		return $columns;
	}
}

if ( ! function_exists( 'makao_woo_products_per_page' ) ) {
	/**
	 * Function that set number of items for main shop page
	 *
	 * @param $products_per_page int
	 *
	 * @return int
	 */
	function makao_woo_products_per_page( $products_per_page ) {
		$option = makao_get_post_value_through_levels( 'qodef_woo_product_list_products_per_page' );
		
		if ( ! empty( $option ) ) {
			$products_per_page = intval( $option );
		}
		
		return $products_per_page;
	}
}

if ( ! function_exists( 'makao_woo_pagination_args' ) ) {
	/**
	 * Function that override pagination args on main shop page
	 *
	 * @param $args array
	 *
	 * @return array
	 */
	function makao_woo_pagination_args( $args ) {
		$args['prev_text']          =  makao_get_icon( 'lnr-chevron-left', 'linear-icons', '' ).'<span class="qodef-prev-label">'.esc_html__('Prev', 'makao').'</span>';
		$args['next_text']          = '<span class="qodef-next-label">'.esc_html__('Next', 'makao').'</span>'.makao_get_icon( 'lnr-chevron-right', 'linear-icons', '' );
		$args['type']               = 'plain';
		$args['before_page_number'] = '';
		
		return $args;
	}
}

if ( ! function_exists( 'makao_add_single_product_classes' ) ) {
	/**
	 * Function that render additional content around WooCommerce pages
	 */
	function makao_add_single_product_classes( $classes, $class = '', $post_id = 0 ) {
		if ( ! $post_id || ! in_array( get_post_type( $post_id ), array( 'product', 'product_variation' ), true ) ) {
			return $classes;
		}
		
		$product = wc_get_product( $post_id );
		
		if ( $product ) {
			$new = get_post_meta( $post_id, 'qodef_show_new_sign', true );
			
			if ( $new === 'yes' ) {
				$classes[] = 'new';
			}
		}
		
		return $classes;
	}
}

if ( ! function_exists( 'makao_woo_sale_flash' ) ) {
	/**
	 * Function that override on sale template for product
	 *
	 * @return string which contains html content
	 */
	function makao_woo_sale_flash() {
		$product = makao_woo_get_global_product();
		
		return '<span class="qodef-woo-product-mark qodef-woo-onsale">' . makao_woo_get_woocommerce_sale( $product ) . '</span>';
	}
}

if ( ! function_exists( 'makao_woo_get_woocommerce_sale' ) ) {
	function makao_woo_get_woocommerce_sale( $product ) {
		$enable_percent_mark = makao_get_post_value_through_levels( 'qodef_woo_enable_percent_sign_value' );
		$price               = intval( $product->get_regular_price() );
		$sale_price          = intval( $product->get_sale_price() );
		
		if ( $price > 0 && $enable_percent_mark === 'yes' ) {
			return '-' . ( 100 - round( ( $sale_price * 100 ) / $price ) ) . '%';
		} else {
			return esc_html__( 'Sale', 'makao' );
		}
	}
}

if ( ! function_exists( 'makao_add_out_of_stock_mark_on_product' ) ) {
	/**
	 * Function for adding out of stock template for product
	 */
	function makao_add_out_of_stock_mark_on_product() {
		$product = makao_woo_get_global_product();
		
		if ( ! empty( $product ) && ! $product->is_in_stock() ) {
			echo makao_get_out_of_stock_mark();
		}
	}
}

if ( ! function_exists( 'makao_get_out_of_stock_mark' ) ) {
	/**
	 * Function for adding out of stock template for product
	 *
	 * @return string
	 */
	function makao_get_out_of_stock_mark() {
		return '<span class="qodef-woo-product-mark qodef-out-of-stock">' . esc_html__( 'Sold', 'makao' ) . '</span>';
	}
}

if ( ! function_exists( 'makao_add_new_mark_on_product' ) ) {
	/**
	 * Function for adding out of stock template for product
	 */
	function makao_add_new_mark_on_product() {
		$product = makao_woo_get_global_product();
		
		if ( ! empty( $product ) && $product->get_id() !== '' ) {
			echo makao_get_new_mark( $product->get_id() );
		}
	}
}

if ( ! function_exists( 'makao_get_new_mark' ) ) {
	/**
	 * Function for adding out of stock template for product
	 *
	 * @param $product_id int
	 *
	 * @return string
	 */
	function makao_get_new_mark( $product_id ) {
		$option = get_post_meta( $product_id, 'qodef_show_new_sign', true );
		
		if ( $option === 'yes' ) {
			return '<span class="qodef-woo-product-mark qodef-new">' . esc_html__( 'New', 'makao' ) . '</span>';
		}
		
		return false;
	}
}

if ( ! function_exists( 'makao_woo_shop_loop_item_title' ) ) {
	/**
	 * Function that override product list item title template
	 */
	function makao_woo_shop_loop_item_title() {
		$option    = makao_get_post_value_through_levels( 'qodef_woo_product_list_title_tag' );
		$title_tag = ! empty( $option ) ? esc_attr( $option ) : 'h4';
		
		echo '<' . $title_tag . ' class="qodef-woo-product-title woocommerce-loop-product__title">' . get_the_title() . '</' . $title_tag . '>';
	}
}

if ( ! function_exists( 'makao_woo_template_single_title' ) ) {
	/**
	 * Function that override product single item title template
	 */
	function makao_woo_template_single_title() {
		$option    = makao_get_post_value_through_levels( 'qodef_woo_single_title_tag' );
		$title_tag = ! empty( $option ) ? esc_attr( $option ) : 'h2';
		
		echo '<' . $title_tag . ' class="qodef-woo-product-title product_title entry-title">' . get_the_title() . '</' . $title_tag . '>';
	}
}

if ( ! function_exists( 'makao_woo_single_thumbnail_images_columns' ) ) {
	/**
	 * Function that set number of columns for thumbnail images on single product page
	 *
	 * @param $columns int
	 *
	 * @return int
	 */
	function makao_woo_single_thumbnail_images_columns( $columns ) {
		$option = makao_get_post_value_through_levels( 'qodef_woo_single_thumbnail_images_columns' );
		
		if ( ! empty( $option ) ) {
			$columns = intval( $option );
		}
		
		return $columns;
	}
}

if ( ! function_exists( 'makao_woo_single_thumbnail_images_size' ) ) {
	/**
	 * Function that set thumbnail images size on single product page
	 *
	 * @param $size string
	 *
	 * @return string
	 */
	function makao_woo_single_thumbnail_images_size( $size ) {
		return apply_filters( 'makao_filter_woo_single_thumbnail_size', 'woocommerce_thumbnail' );
	}
}

if ( ! function_exists( 'makao_woo_single_thumbnail_images_wrapper' ) ) {
	/**
	 * Function that add additional wrapper around thumbnail images on single product
	 */
	function makao_woo_single_thumbnail_images_wrapper() {
		echo '<div class="qodef-woo-thumbnails-wrapper">';
	}
}

if ( ! function_exists( 'makao_woo_single_thumbnail_images_wrapper_end' ) ) {
	/**
	 * Function that add additional wrapper around thumbnail images on single product
	 */
	function makao_woo_single_thumbnail_images_wrapper_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'makao_woo_single_related_product_list_columns' ) ) {
	/**
	 * Function that set number of columns for related product list on single product page
	 *
	 * @param $args array
	 *
	 * @return array
	 */
	function makao_woo_single_related_product_list_columns( $args ) {
		$option = makao_get_post_value_through_levels( 'qodef_woo_single_related_product_list_columns' );
		
		if ( ! empty( $option ) ) {
			$args['posts_per_page'] = intval( $option );
			$args['columns']        = intval( $option );
		}
		
		return $args;
	}
}

if ( ! function_exists( 'makao_woo_product_get_rating_html' ) ) {
	/**
	 * Function that override ratings templates
	 *
	 * @param $html string - contains html content
	 * @param $rating float
	 * @param $count int - total number of ratings
	 *
	 * @return string
	 */
	function makao_woo_product_get_rating_html( $html, $rating, $count ) {
		if ( ! empty( $rating ) ) {
			$html = '<div class="qodef-woo-ratings qodef-m"><div class="qodef-m-inner">';
			$html .= '<div class="qodef-m-star qodef--initial">';
			for ( $i = 0; $i < 5; $i ++ ) {
				$html .= makao_get_icon( 'icon_star', 'elegant-icons', '' );
			}
			$html .= '</div>';
			$html .= '<div class="qodef-m-star qodef--active" style="width:' . ( ( $rating / 5 ) * 100 ) . '%">';
			for ( $i = 0; $i < 5; $i ++ ) {
				$html .= makao_get_icon( 'icon_star', 'elegant-icons', '' );
			}
			$html .= '</div>';
			$html .= '</div></div>';
		}
		
		return $html;
	}
}

if ( ! function_exists( 'makao_woo_get_product_search_form' ) ) {
	/**
	 * Function that override product search widget form
	 *
	 * @param $html string
	 *
	 * @return string which contains html content
	 */
	function makao_woo_get_product_search_form( $html ) {
		return makao_get_template_part( 'woocommerce', 'templates/product-searchform' );
	}
}

if ( ! function_exists( 'makao_woo_get_content_widget_product' ) ) {
	/**
	 * Function that override product content widget
	 *
	 * @param $located string
	 * @param $template_name string
	 * @param $args array
	 * @param $template_path string
	 * @param $default_path string
	 *
	 * @return string which contains html content
	 */
	function makao_woo_get_content_widget_product( $located, $template_name, $args, $template_path, $default_path ) {
		
		if ( $template_name === 'content-widget-product.php' && file_exists( MAKAO_INC_ROOT_DIR . '/woocommerce/templates/content-widget-product.php' ) ) {
			$located = MAKAO_INC_ROOT_DIR . '/woocommerce/templates/content-widget-product.php';
		}
		
		return $located;
	}
}

if ( ! function_exists( 'makao_woo_get_quantity_input' ) ) {
	/**
	 * Function that override quantity input
	 *
	 * @param $located string
	 * @param $template_name string
	 * @param $args array
	 * @param $template_path string
	 * @param $default_path string
	 *
	 * @return string which contains html content
	 */
	function makao_woo_get_quantity_input( $located, $template_name, $args, $template_path, $default_path ) {
		
		if ( $template_name === 'global/quantity-input.php' && file_exists( MAKAO_INC_ROOT_DIR . '/woocommerce/templates/global/quantity-input.php' ) ) {
			$located = MAKAO_INC_ROOT_DIR . '/woocommerce/templates/global/quantity-input.php';
		}
		
		return $located;
	}
}

if ( ! function_exists( 'makao_woo_get_single_product_meta' ) ) {
	/**
	 * Function that override single product meta
	 *
	 * @param $located string
	 * @param $template_name string
	 * @param $args array
	 * @param $template_path string
	 * @param $default_path string
	 *
	 * @return string which contains html content
	 */
	function makao_woo_get_single_product_meta( $located, $template_name, $args, $template_path, $default_path ) {
		
		if ( $template_name === 'single-product/meta.php' && file_exists( MAKAO_INC_ROOT_DIR . '/woocommerce/templates/single-product/meta.php' ) ) {
			$located = MAKAO_INC_ROOT_DIR . '/woocommerce/templates/single-product/meta.php';
		}
		
		return $located;
	}
}

if ( ! function_exists( 'makao_woo_change_product_tabs_position' ) ) {
    /**
     * Puts product tabs below product summary
     *
     * @return void
     */
    function makao_woo_change_product_tabs_position(){

        remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
        add_action('woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 55);
    }
}

if ( ! function_exists( 'makao_woo_get_list_shortcode_item_image' ) ) {
	/**
	 * Function that override thumbnail img tag for list shortcodes
	 *
	 * @param $html string
	 * @param $attachment_id int
	 *
	 * @return string generated img tag
	 */
	function makao_woo_get_list_shortcode_item_image( $html, $attachment_id ) {
		
		if ( empty( $attachment_id ) && get_post_type() === 'product' ) {
			$html = woocommerce_get_product_thumbnail();
		}
		
		return $html;
	}
}

if ( ! function_exists( 'makao_woo_get_product_single_layout' ) ) {
    /**
     * Checks out the layout of product single page
     *
     * @return string
     */
    function makao_woo_get_product_single_layout() {

        if(get_post_type() === 'product' ){
            $product_page_layout = get_post_meta( get_the_ID(), 'qodef_product_layout', true );

            return $product_page_layout;
        }
    }
}

if ( ! function_exists( 'makao_product_single_layout_class' ) ) {

    function makao_product_single_layout_class($classes){

        $layout = makao_woo_get_product_single_layout();

        $classes[] = 'qodef-product-single-' . $layout . '-layout';

        return $classes;

    }

    add_filter('body_class', 'makao_product_single_layout_class');
}

if ( ! function_exists( 'makao_woo_get_product_render_small_gallery_layout' ) ) {
    /**
     * Creates image gallery for "Small Gallery" product layout
     *
     * @return gallery HTML
     */
    function makao_woo_get_product_render_small_gallery_layout() {

        if(get_post_type() === 'product' || makao_woo_get_product_single_layout() == 'small-gallery'){
            $product_gallery = array();
            $product_gallery = get_post_meta( get_the_ID(), 'qodef_product_images_gallery', true );
            $product_gallery = explode(',', $product_gallery);
            $html = '';


            $html .= '<div class="qodef-grid qodef-layout--columns  qodef-gutter--small qodef-col-num--2">';
            $html .= '<div class="qodef-grid-inner clear">';

            foreach($product_gallery as $image){
                $html .= '<div class="qodef-product-gallery-image qodef-grid-item">';
                $html .= wp_get_attachment_image($image, 'full');
                $html .= '</div>';
            }

            $html .= '</div></div>';

            echo makao_return_module_part( $html );
        }
        makao_woo_change_product_tabs_position();
    }
}

if ( ! function_exists( 'makao_woo_get_product_render_big_gallery_layout' ) ) {
    /**
     * Creates image gallery for "Small Gallery" product layout
     *
     * @return void
     */
    function makao_woo_get_product_render_big_gallery_layout() {

        if(get_post_type() === 'product' || makao_woo_get_product_single_layout() == 'small-gallery'){
            $product_gallery = array();
            $product_gallery = get_post_meta( get_the_ID(), 'qodef_product_images_gallery', true );
            $product_gallery = explode(',', $product_gallery);
            $html = '';


            $html .= '<div class="qodef-grid qodef-layout--columns  qodef-gutter--normal qodef-col-num--1">';
            $html .= '<div class="qodef-grid-inner clear">';

            foreach($product_gallery as $image){
                $html .= '<div class="qodef-product-gallery-image qodef-grid-item">';
                $html .= wp_get_attachment_image($image, 'full');
                $html .= '</div>';
            }

            $html .= '</div></div>';

            echo makao_return_module_part( $html );
        }

        makao_woo_change_product_tabs_position();
    }
}

if ( ! function_exists( 'makao_woo_get_product_render_slider_layout' ) ) {
    /**
     * Creates image gallery for "Slider" product layout
     *
     * @return void
     */
    function makao_woo_get_product_render_slider_layout() {

        if(get_post_type() === 'product' || makao_woo_get_product_single_layout() == 'slider'){
            $product_gallery = array();
            $product_gallery = get_post_meta( get_the_ID(), 'qodef_product_images_gallery', true );
            $product_gallery = explode(',', $product_gallery);
            $html = '';
            $data_atts = array();
            $data_atts['slidesPerView'] = '2';
            $data_atts['spaceBetween'] =  20;
            $data_atts['loop'] =  true;
            $data_atts['autoplay'] =  true;
            $data_atts['outsideNavigation'] =  'yes';
            $data_atts['unique'] = wp_unique_id();


            $html .= '<div class="qodef-grid qodef-swiper-container  
                        qodef-gutter--normal qodef-col-num--2  qodef-responsive--predefined" 
                        '.qode_framework_get_inline_attr( json_encode($data_atts), 'data-options' ).'>';
            $html .= '<div class="swiper-wrapper">';

            foreach($product_gallery as $image){
                $html .= '<div class="qodef-e qodef-image-wrapper swiper-slide">';
                $html .= wp_get_attachment_image($image, 'full');
                $html .= '</div>';
            }

            $html .= '</div></div>';
            $html .= '<div class="swiper-button-next swiper-button-next-' . $data_atts['unique'] . '"></div>
		              <div class="swiper-button-prev swiper-button-prev-' . $data_atts['unique'] . '"></div>';

            echo makao_return_module_part( $html );
        }
    }
}

if ( ! function_exists( 'makao_woo_get_product_image_gallery' ) ) {
    /**
     * Creates image gallery for product single page
     *
     * @return gallery HTML
     */
    function makao_woo_get_product_image_gallery() {

        if(get_post_type() === 'product'){
            $product_layout =  makao_woo_get_product_single_layout();

            switch($product_layout){
                case 'small-gallery':
                    makao_woo_get_product_render_small_gallery_layout();
                    break;
                case 'big-gallery':
                    makao_woo_get_product_render_big_gallery_layout();
                    break;
                case 'slider':
                    makao_woo_get_product_render_slider_layout();
                    break;
                default: add_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 29  );
            }
        }
    }
}



<?php

if ( ! function_exists( 'makao_core_add_portfolio_item_list_meta_boxes' ) ) {
	/**
	 * Function that adds portfolio list settings for portfolio single module
	 */
	function makao_core_add_portfolio_item_list_meta_boxes( $page ) {

		if ( $page ) {

			$list_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-list',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'List Settings', 'makao-core' ),
					'description' => esc_html__( 'Portfolio list settings', 'makao-core' )
				)
			);

			$list_tab->add_field_element( array(
				'field_type'  => 'image',
				'name'        => 'qodef_portfolio_list_image',
				'title'       => esc_html__( 'Portfolio List Image', 'makao-core' ),
				'description' => esc_html__( 'Upload image to be displayed on portfolio list instead of featured image', 'makao-core' ),
			) );

			$list_tab->add_field_element( array(
				'field_type'  => 'select',
				'name'        => 'qodef_masonry_image_dimension_portfolio_item',
				'title'       => esc_html__( 'Image Dimension', 'makao-core' ),
				'description' => esc_html__( 'Choose an image layout for "masonry behavior" portfolio list. If you are using fixed image proportions on the list, choose an option other than default', 'makao-core' ),
				'options'     => makao_core_get_select_type_options_pool( 'masonry_image_dimension' )
			) );

			$list_tab->add_field_element( array(
				'field_type'  => 'text',
				'name'        => 'qodef_portfolio_item_padding',
				'title'       => esc_html__( 'Portfolio Item Custom Padding', 'makao-core' ),
				'description' => esc_html__( 'Choose item padding when it appears in portfolio list (ex. 5% 5% 5% 5%)', 'makao-core' )
			) );
			
			// Hook to include additional options after module options
			do_action( 'makao_core_action_after_portfolio_list_meta_box_map', $list_tab );
		}
	}

	add_action( 'makao_core_action_after_portfolio_meta_box_map', 'makao_core_add_portfolio_item_list_meta_boxes' );
}
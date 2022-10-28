<?php

if ( ! function_exists( 'makao_core_add_product_single_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function makao_core_add_product_single_meta_box() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'product' ),
				'type'  => 'meta',
				'slug'  => 'product-list',
				'title' => esc_html__( 'Product List', 'makao-core' )
			)
		);

		if ( $page ) {

            $page->add_field_element(
                array(
                    'field_type'  => 'select',
                    'name'        => 'qodef_product_layout',
                    'title'       => esc_html__( 'Product layout', 'makao-core' ),
                    'description' => esc_html__( 'Choose layout for product single page', 'makao-core' ),
                    'options'     => array(
                        'default'       => esc_html__( 'Default', 'makao-core' ),
                        'small-gallery' => esc_html__( 'Small Gallery', 'makao-core' ),
                        'big-gallery'   => esc_html__( 'Big Gallery', 'makao-core' ),
                        'slider'        => esc_html__( 'Slider', 'makao-core' )
                    )
                )
            );

            $page->add_field_element(
                array(
                    'field_type' => 'image',
                    'name'       => 'qodef_product_images_gallery',
                    'title'      => esc_html__( 'Upload Gallery Images', 'makao-core' ),
                    'multiple'   => 'yes',
                    'dependency' => array(
                        'hide' => array(
                            'qodef_product_layout' => array(
                                'values'        => 'default',
                                'default_value' => 'default'
                            )
                        )
                    )
                )
            );

			$page->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_product_list_image',
					'title'       => esc_html__( 'Product List Image', 'makao-core' ),
					'description' => esc_html__( 'Upload image to be displayed on product list instead of featured image', 'makao-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_masonry_image_dimension_product',
					'title'       => esc_html__( 'Image Dimension', 'makao-core' ),
					'description' => esc_html__( 'Choose an image layout for product list. If you are using fixed image proportions on the list, choose an option other than default', 'makao-core' ),
					'options'     => makao_core_get_select_type_options_pool( 'masonry_image_dimension' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_show_new_sign',
					'title'         => esc_html__( 'Show New Sign', 'makao-core' ),
					'description'   => esc_html__( 'Enabling this option will show "New Sign" mark on product.', 'makao-core' ),
					'options'       => makao_core_get_select_type_options_pool( 'no_yes' ),
					'default_value' => 'no'
				)
			);

			// Hook to include additional options after module options
			do_action( 'makao_core_action_after_product_single_meta_box_map', $page );
		}
	}

	add_action( 'makao_core_action_default_meta_boxes_init', 'makao_core_add_product_single_meta_box' );
}
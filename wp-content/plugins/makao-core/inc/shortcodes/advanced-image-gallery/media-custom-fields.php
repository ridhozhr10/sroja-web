<?php

if ( ! function_exists( 'makao_core_add_image_shortcode_media_options' ) ) {
	function makao_core_add_image_shortcode_media_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope' => 'image',
				'type'  => 'attachment',
				'slug'  => 'qodef_advanced_image_gallery',
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_advanced_image_gallery_custom_link',
					'title'       => esc_html__( 'Custom Link URL', 'makao-core' ),
					'description' => esc_html__( 'Enter URL where image should navigate to if custom link option is selected in image gallery shortcode', 'makao-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_advanced_image_gallery_masonry_size',
					'title'       => esc_html__( 'Image Size', 'makao-core' ),
					'description' => esc_html__( 'Choose image size for list shortcode item if masonry layout > fixed image size is selected in image gallery shortcode', 'makao-core' ),
					'options'     => makao_core_get_select_type_options_pool( 'masonry_image_dimension' )
				)
			);
		}
	}

	add_action( 'qode_framework_action_custom_media_fields', 'makao_core_add_image_shortcode_media_options', 11 );
}
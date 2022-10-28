<?php

if ( ! function_exists( 'makao_core_add_testimonials_list_variation_info_below' ) ) {
	function makao_core_add_testimonials_list_variation_info_below( $variations ) {
		
		$variations['info-below'] = esc_html__( 'Info Below', 'makao-core' );
		
		return $variations;
	}
	
	add_filter( 'makao_core_filter_testimonials_list_layouts', 'makao_core_add_testimonials_list_variation_info_below' );
}

if ( ! function_exists( 'makao_core_add_testimonials_list_options_info_below' ) ) {
	function makao_core_add_testimonials_list_options_info_below( $options ) {
		$info_below_options   = array();
		$margin_option        = array(
			'field_type' => 'text',
			'name'       => 'info_below_content_margin_top',
			'title'      => esc_html__( 'Content Top Margin', 'makao-core' ),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => 'info-below',
						'default_value' => 'default'
					)
				)
			),
			'group'      => esc_html__( 'Layout', 'makao-core' )
		);
		$info_below_options[] = $margin_option;
		
		return array_merge( $options, $info_below_options );
	}
	
	add_filter( 'makao_core_filter_testimonials_list_extra_options', 'makao_core_add_testimonials_list_options_info_below' );
}
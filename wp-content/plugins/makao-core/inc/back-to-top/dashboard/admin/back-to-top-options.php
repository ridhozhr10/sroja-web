<?php

if ( ! function_exists( 'makao_core_add_back_to_top_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function makao_core_add_back_to_top_options( $page ) {
		
		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_back_to_top',
					'title'         => esc_html__( 'Enable Back to Top', 'makao-core' ),
					'default_value' => 'yes'
				)
			);
		}
	}
	
	add_action( 'makao_core_action_after_general_options_map', 'makao_core_add_back_to_top_options' );
}
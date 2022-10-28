<?php

if ( ! function_exists( 'makao_core_register_portfolio_for_meta_options' ) ) {
	function makao_core_register_portfolio_for_meta_options( $post_types ) {
		$post_types[] = 'portfolio-item';
		
		return $post_types;
	}
	
	add_filter( 'qode_framework_filter_meta_box_save', 'makao_core_register_portfolio_for_meta_options' );
	add_filter( 'qode_framework_filter_meta_box_remove', 'makao_core_register_portfolio_for_meta_options' );
}

if ( ! function_exists( 'makao_core_add_portfolio_custom_post_type' ) ) {
	/**
	 * Function that adds portfolio custom post type
	 *
	 * @param $cpts array
	 *
	 * @return array
	 */
	function makao_core_add_portfolio_custom_post_type( $cpts ) {
		$cpts[] = 'MakaoCorePortfolioCPT';
		
		return $cpts;
	}
	
	add_filter( 'makao_core_filter_register_custom_post_types', 'makao_core_add_portfolio_custom_post_type' );
}

if ( class_exists( 'QodeFrameworkCustomPostType' ) ) {
	class MakaoCorePortfolioCPT extends QodeFrameworkCustomPostType {
		
		public function map_post_type() {
			$name = esc_html__( 'Portfolio', 'makao-core' );
			$this->set_base( 'portfolio-item' );
			$this->set_menu_position( 10 );
			$this->set_menu_icon( 'dashicons-grid-view' );
			$this->set_slug( 'portfolio-item' );
			$this->set_name( $name );
			$this->set_path( MAKAO_CORE_CPT_PATH . '/portfolio' );
			$this->set_labels( array(
				'name'          => esc_html__( 'Makao Portfolio', 'makao-core' ),
				'singular_name' => esc_html__( 'Portfolio Item', 'makao-core' ),
				'add_item'      => esc_html__( 'New Portfolio Item', 'makao-core' ),
				'add_new_item'  => esc_html__( 'Add New Portfolio Item', 'makao-core' ),
				'edit_item'     => esc_html__( 'Edit Portfolio Item', 'makao-core' )
			) );
			$this->add_post_taxonomy( array(
				'base'          => 'portfolio-category',
				'slug'          => 'portfolio-category',
				'singular_name' => esc_html__( 'Category', 'makao-core' ),
				'plural_name'   => esc_html__( 'Categories', 'makao-core' ),
			) );
			$this->add_post_taxonomy( array(
				'base'          => 'portfolio-tag',
				'slug'          => 'portfolio-tag',
				'singular_name' => esc_html__( 'Tag', 'makao-core' ),
				'plural_name'   => esc_html__( 'Tags', 'makao-core' ),
			) );
		}
	}
}
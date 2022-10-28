<?php

if ( ! function_exists( 'makao_core_register_testimonials_for_meta_options' ) ) {
	function makao_core_register_testimonials_for_meta_options( $post_types ) {
		$post_types[] = 'testimonials';
		return $post_types;
	}
	
	add_filter( 'qode_framework_filter_meta_box_save', 'makao_core_register_testimonials_for_meta_options' );
	add_filter( 'qode_framework_filter_meta_box_remove', 'makao_core_register_testimonials_for_meta_options' );
}

if ( ! function_exists( 'makao_core_add_testimonials_custom_post_type' ) ) {
	/**
	 * Function that adds testimonials custom post type
	 *
	 * @param $cpts array
	 *
	 * @return array
	 */
	function makao_core_add_testimonials_custom_post_type( $cpts ) {
		$cpts[] = 'MakaoCoreTestimonialsCPT';
		
		return $cpts;
	}
	
	add_filter( 'makao_core_filter_register_custom_post_types', 'makao_core_add_testimonials_custom_post_type' );
}

if ( class_exists( 'QodeFrameworkCustomPostType' ) ) {
	class MakaoCoreTestimonialsCPT extends QodeFrameworkCustomPostType {
		
		public function map_post_type() {
			$name = esc_html__( 'Testimonials', 'makao-core' );
			$this->set_base( 'testimonials' );
			$this->set_menu_position( 10 );
			$this->set_menu_icon( 'dashicons-format-status' );
			$this->set_slug( 'testimonials' );
			$this->set_name( $name );
			$this->set_path( MAKAO_CORE_CPT_PATH . '/testimonials' );
			$this->set_labels( array(
				'name'          => esc_html__( 'Makao Testimonials', 'makao-core' ),
				'singular_name' => esc_html__( 'Testimonial', 'makao-core' ),
				'add_item'      => esc_html__( 'New Testimonial', 'makao-core' ),
				'add_new_item'  => esc_html__( 'Add New Testimonial', 'makao-core' ),
				'edit_item'     => esc_html__( 'Edit Testimonial', 'makao-core' )
			) );
			$this->set_public( false );
			$this->set_archive( false );
			$this->set_supports( array(
				'title',
				'thumbnail'
			) );
			$this->add_post_taxonomy( array(
				'base'          => 'testimonials-category',
				'slug'          => 'testimonials-category',
				'singular_name' => esc_html__( 'Category', 'makao-core' ),
				'plural_name'   => esc_html__( 'Categories', 'makao-core' ),
			) );
		}
		
	}
}
<?php

if ( ! function_exists( 'makao_core_register_masonry_gallery_for_meta_options' ) ) {
	function makao_core_register_masonry_gallery_for_meta_options( $post_types ) {
		$post_types[] = 'masonry-gallery';
		return $post_types;
	}
	
	add_filter( 'qode_framework_filter_meta_box_save', 'makao_core_register_masonry_gallery_for_meta_options' );
	add_filter( 'qode_framework_filter_meta_box_remove', 'makao_core_register_masonry_gallery_for_meta_options' );
}

if ( ! function_exists( 'makao_core_add_masonry_gallery_custom_post_type' ) ) {
	/**
	 * Function that adds masonry_gallery custom post type
	 *
	 * @param $cpts array
	 *
	 * @return array
	 */
	function makao_core_add_masonry_gallery_custom_post_type( $cpts ) {
		$cpts[] = 'MakaoCoreMasonryGalleryCPT';
		
		return $cpts;
	}
	
	add_filter( 'makao_core_filter_register_custom_post_types', 'makao_core_add_masonry_gallery_custom_post_type' );
}

if ( class_exists( 'QodeFrameworkCustomPostType' ) ) {
	class MakaoCoreMasonryGalleryCPT extends QodeFrameworkCustomPostType {
		
		public function map_post_type() {
			$name = esc_html__( 'Masonry Gallery', 'makao-core' );
			$this->set_base( 'masonry-gallery' );
			$this->set_menu_position( 10 );
			$this->set_menu_icon( 'dashicons-schedule' );
			$this->set_slug( 'masonry-gallery' );
			$this->set_name( $name );
			$this->set_path( MAKAO_CORE_CPT_PATH . '/masonry-gallery' );
			$this->set_labels( array(
				'name'          => esc_html__( 'Makao Masonry Gallery', 'makao-core' ),
				'singular_name' => esc_html__( 'Masonry Gallery', 'makao-core' ),
				'add_item'      => esc_html__( 'New Masonry Gallery', 'makao-core' ),
				'add_new_item'  => esc_html__( 'Add New Masonry Gallery', 'makao-core' ),
				'edit_item'     => esc_html__( 'Edit Masonry Gallery', 'makao-core' )
			) );
			$this->set_public( false );
			$this->set_archive( false );
			$this->set_supports( array(
				'title',
				'thumbnail'
			) );
			$this->add_post_taxonomy( array(
				'base'          => 'masonry-gallery-category',
				'slug'          => 'masonry-gallery-category',
				'singular_name' => esc_html__( 'Category', 'makao-core' ),
				'plural_name'   => esc_html__( 'Categories', 'makao-core' ),
			) );
		}
		
	}
}
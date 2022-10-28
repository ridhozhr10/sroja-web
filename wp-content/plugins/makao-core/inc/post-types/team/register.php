<?php

if ( ! function_exists( 'makao_core_register_team_for_meta_options' ) ) {
	function makao_core_register_team_for_meta_options( $post_types ) {
		$post_types[] = 'team';
		
		return $post_types;
	}
	
	add_filter( 'qode_framework_filter_meta_box_save', 'makao_core_register_team_for_meta_options' );
	add_filter( 'qode_framework_filter_meta_box_remove', 'makao_core_register_team_for_meta_options' );
}

if ( ! function_exists( 'makao_core_add_team_custom_post_type' ) ) {
	/**
	 * Function that adds team custom post type
	 *
	 * @param $cpts array
	 *
	 * @return array
	 */
	function makao_core_add_team_custom_post_type( $cpts ) {
		$cpts[] = 'MakaoCoreTeamCPT';
		
		return $cpts;
	}
	
	add_filter( 'makao_core_filter_register_custom_post_types', 'makao_core_add_team_custom_post_type' );
}

if ( class_exists( 'QodeFrameworkCustomPostType' ) ) {
	class MakaoCoreTeamCPT extends QodeFrameworkCustomPostType {
		
		public function map_post_type() {
			$name = esc_html__( 'Team', 'makao-core' );
			$this->set_base( 'team' );
			$this->set_menu_position( 10 );
			$this->set_menu_icon( 'dashicons-businessperson' );
			$this->set_slug( 'team' );
			$this->set_name( $name );
			$this->set_path( MAKAO_CORE_CPT_PATH . '/team' );
			$this->set_labels( array(
				'name'          => esc_html__( 'Makao Team', 'makao-core' ),
				'singular_name' => esc_html__( 'Team Member', 'makao-core' ),
				'add_item'      => esc_html__( 'New Team Member', 'makao-core' ),
				'add_new_item'  => esc_html__( 'Add New Team Member', 'makao-core' ),
				'edit_item'     => esc_html__( 'Edit Team Member', 'makao-core' )
			) );
			if ( ! makao_core_team_has_single() ) {
				$this->set_public( false );
				$this->set_archive( false );
				$this->set_supports( array(
					'title',
					'thumbnail'
				) );
			}
			$this->add_post_taxonomy( array(
				'base'          => 'team-category',
				'slug'          => 'team-category',
				'singular_name' => esc_html__( 'Category', 'makao-core' ),
				'plural_name'   => esc_html__( 'Categories', 'makao-core' ),
			) );
		}
	}
}
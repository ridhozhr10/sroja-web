<?php

if ( ! function_exists( 'makao_core_add_team_single_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function makao_core_add_team_single_meta_box() {
		$qode_framework = qode_framework_get_framework_root();
		$has_single     = makao_core_team_has_single();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'team' ),
				'type'  => 'meta',
				'slug'  => 'team',
				'title' => esc_html__( 'Team Single', 'makao-core' )
			)
		);
		
		if ( $page ) {
			$section = $page->add_section_element(
				array(
					'name'        => 'qodef_team_general_section',
					'title'       => esc_html__( 'General Settings', 'makao-core' ),
					'description' => esc_html__( 'General information about team member.', 'makao-core' )
				)
			);
			
			if ( $has_single ) {
				$section->add_field_element( array(
					'field_type'  => 'select',
					'name'        => 'qodef_team_single_layout',
					'title'       => esc_html__( 'Single Layout', 'makao-core' ),
					'description' => esc_html__( 'Choose default layout for team single', 'makao-core' ),
					'options'     => array(
						'' => esc_html__( 'Default', 'makao-core' )
					)
				) );
			}
			
			$section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_team_member_role',
					'title'       => esc_html__( 'Role', 'makao-core' ),
					'description' => esc_html__( 'Enter team member role', 'makao-core' ),
				)
			);
			
			$social_icons_repeater = $section->add_repeater_element(
				array(
					'name'        => 'qodef_team_member_social_icons',
					'title'       => esc_html__( 'Social Networks', 'makao-core' ),
					'description' => esc_html__( 'Populate team member social networks info', 'makao-core' ),
					'button_text' => esc_html__( 'Add New Network', 'makao-core' )
				)
			);
			
			$social_icons_repeater->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_team_member_social_network_type',
					'title'       => esc_html__( 'Social Icon Type', 'makao-core' ),
					'options'     => array(
						''     => esc_html__( 'Default', 'makao-core' ),
						'icon' => esc_html__( 'Icon', 'makao-core' ),
						'text' => esc_html__( 'Text', 'makao-core' )
					)
				)
			);
			
			$social_icons_repeater->add_field_element(
				array(
					'field_type' => 'iconpack',
					'name'       => 'qodef_team_member_icon',
					'title'      => esc_html__( 'Icon', 'makao-core' ),
					'dependency'  => array(
						'show' => array(
							'qodef_team_member_social_network_type' => array(
								'values'        => 'icon',
								'default_value' => ''
							)
						),
						'hide' => array(
							'qodef_team_member_social_network_type' => array(
								'values'        => 'text'
							)
						),
					)
				)
			);
			
			$social_icons_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_team_member_social_network_name',
					'title'      => esc_html__( 'Social Network Name', 'makao-core' ),
					'dependency'  => array(
						'show' => array(
							'qodef_team_member_social_network_type' => array(
								'values'        => 'text',
								'default_value' => ''
							)
						),
						'hide' => array(
							'qodef_team_member_social_network_type' => array(
								'values'        => 'icon'
							)
						),
					)
				)
			);
			
			$social_icons_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_team_member_icon_link',
					'title'      => esc_html__( 'Link', 'makao-core' )
				)
			);
			
			$social_icons_repeater->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_team_member_icon_target',
					'title'      => esc_html__( 'Target', 'makao-core' ),
					'options'    => makao_core_get_select_type_options_pool( 'link_target' )
				)
			);
			
			if ( $has_single ) {
				$section->add_field_element( array(
					'field_type'  => 'date',
					'name'        => 'qodef_team_member_birth_date',
					'title'       => esc_html__( 'Birth Date', 'makao-core' ),
					'description' => esc_html__( 'Enter team member birth date', 'makao-core' ),
				) );
				
				$section->add_field_element( array(
					'field_type'  => 'text',
					'name'        => 'qodef_team_member_email',
					'title'       => esc_html__( 'E-mail', 'makao-core' ),
					'description' => esc_html__( 'Enter team member e-mail address', 'makao-core' ),
				) );
				
				$section->add_field_element( array(
					'field_type'  => 'text',
					'name'        => 'qodef_team_member_address',
					'title'       => esc_html__( 'Address', 'makao-core' ),
					'description' => esc_html__( 'Enter team member address', 'makao-core' ),
				) );
				
				$section->add_field_element( array(
					'field_type'  => 'text',
					'name'        => 'qodef_team_member_education',
					'title'       => esc_html__( 'Education', 'makao-core' ),
					'description' => esc_html__( 'Enter team member education', 'makao-core' ),
				) );
				
				$section->add_field_element( array(
					'field_type'  => 'file',
					'name'        => 'qodef_team_member_resume',
					'title'       => esc_html__( 'Resume', 'makao-core' ),
					'description' => esc_html__( 'Upload team member resume', 'makao-core' ),
					'args'        => array(
						'allowed_type' => '[application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]'
					)
				) );
			}
			
			// Hook to include additional options after module options
			do_action( 'makao_core_action_after_team_meta_box_map', $page, $has_single );
		}
	}
	
	add_action( 'makao_core_action_default_meta_boxes_init', 'makao_core_add_team_single_meta_box' );
}
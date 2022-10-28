<?php

if ( ! function_exists( 'makao_core_add_section_title_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function makao_core_add_section_title_shortcode( $shortcodes ) {
		$shortcodes[] = 'MakaoCoreSectionTitleShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'makao_core_filter_register_shortcodes', 'makao_core_add_section_title_shortcode' );
}

if ( class_exists( 'MakaoCoreShortcode' ) ) {
	class MakaoCoreSectionTitleShortcode extends MakaoCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( MAKAO_CORE_SHORTCODES_URL_PATH . '/section-title' );
			$this->set_base( 'makao_core_section_title' );
			$this->set_name( esc_html__( 'Section Title', 'makao-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds section title element', 'makao-core' ) );
			$this->set_category( esc_html__( 'Makao Core', 'makao-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'makao-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title',
				'title'      => esc_html__( 'Title', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'line_break_positions',
				'title'       => esc_html__( 'Positions of Line Break', 'makao-core' ),
				'description' => esc_html__( 'Enter the positions of the words after which you would like to create a line break. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a line break, you would enter "1,3,4")', 'makao-core' ),
				'group'       => esc_html__( 'Title Style', 'makao-core' )
			) );
            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'title_font_size',
                'title'      => esc_html__( 'Title Font Size', 'makao-core' ),
                'group'      => esc_html__( 'Title Style', 'makao-core' )
            ) );
            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'title_line_height',
                'title'      => esc_html__( 'Title Line Height', 'makao-core' ),
                'group'      => esc_html__( 'Title Style', 'makao-core' )
            ) );
            $this->set_option( array(
                'field_type'  => 'text',
                'name'        => 'caps_lock_positions',
                'title'       => esc_html__( 'Positions of Caps Lock Word', 'makao-core' ),
                'group'       => esc_html__( 'Title Style', 'makao-core' )
            ) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'disable_title_break_words',
				'title'         => esc_html__( 'Disable Title Line Break', 'makao-core' ),
				'description'   => esc_html__( 'Enabling this option will disable title line breaks for screen size 1024 and lower', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'no_yes', false ),
				'default_value' => 'no',
				'group'         => esc_html__( 'Title Style', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h2',
				'group'         => esc_html__( 'Title Style', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'title_color',
				'title'      => esc_html__( 'Title Color', 'makao-core' ),
				'group'      => esc_html__( 'Title Style', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'link',
				'title'      => esc_html__( 'Title Custom Link', 'makao-core' ),
				'group'      => esc_html__( 'Title Style', 'makao-core' )
			) );
            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'text_font_size',
                'title'      => esc_html__( 'Text Font Size', 'makao-core' ),
                'group'      => esc_html__( 'Text Style', 'makao-core' )
            ) );
            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'text_line_height',
                'title'      => esc_html__( 'Text Line Height', 'makao-core' ),
                'group'      => esc_html__( 'Text Style', 'makao-core' )
            ) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'target',
				'title'         => esc_html__( 'Custom Link Target', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self',
				'dependency' => array(
					'show' => array(
						'image_action' => array(
							'values'        => 'custom-link',
							'default_value' => ''
						)
					)
				),
				'group'      => esc_html__( 'Title Style', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type' => 'textarea',
				'name'       => 'text',
				'title'      => esc_html__( 'Text', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'text_tag',
				'title'         => esc_html__( 'Text Tag', 'makao-core' ),
				'options'       => makao_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'p',
				'group'         => esc_html__( 'Text Style', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'text_color',
				'title'      => esc_html__( 'Text Color', 'makao-core' ),
				'group'      => esc_html__( 'Text Style', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'text_margin_top',
				'title'      => esc_html__( 'Text Margin Top', 'makao-core' ),
				'group'      => esc_html__( 'Text Style', 'makao-core' )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'content_alignment',
				'title'      => esc_html__( 'Content Alignment', 'makao-core' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'makao-core' ),
					'left'   => esc_html__( 'Left', 'makao-core' ),
					'center' => esc_html__( 'Center', 'makao-core' ),
					'right'  => esc_html__( 'Right', 'makao-core' )
				),
			) );
            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'caption',
                'title'      => esc_html__( 'Caption', 'makao-core' )
            ) );
            $this->set_option( array(
                'field_type' => 'color',
                'name'       => 'caption_color',
                'title'      => esc_html__( 'Caption Color', 'makao-core' ),
                'group'      => esc_html__( 'Caption Style', 'makao-core' )
            ) );
            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'caption_margin',
                'title'      => esc_html__( 'Caption Margin', 'makao-core' ),
                'group'      => esc_html__( 'Caption Style', 'makao-core' )
            ) );
            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'caption_font_size',
                'title'      => esc_html__( 'Caption Font Size', 'makao-core' ),
                'group'      => esc_html__( 'Caption Style', 'makao-core' )
            ) );

            $this->set_option( array(
                'field_type'  => 'select',
                'name'        => 'button',
                'title'       => esc_html__( 'Show Button', 'makao-core' ),
                'options'     => makao_core_get_select_type_options_pool( 'no_yes' )
            ) );

            $this->set_option( array(
                'field_type'    => 'select',
                'name'          => 'appear_animation',
                'title'         => esc_html__( 'Enable Appear Animation', 'makao-core' ),
                'options'       => makao_core_get_select_type_options_pool( 'no_yes' ),
                'default_value' => 'no'
            ) );

            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'button_text',
                'title'      => esc_html__( 'Button Text', 'makao-core' ),
                'group'      => esc_html__( 'Button Styles', 'makao-core' ),
                'default_value'      => esc_html__( 'Read More', 'makao-core' ),
                'dependency'  => array(
                    'show' => array(
                        'button' => array(
                            'values'        => 'yes',
                            'default_value' => 'no'
                        )
                    )
                )
            ) );

            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'button_link',
                'title'      => esc_html__( 'Button Link', 'makao-core' ),
                'group'      => esc_html__( 'Button Styles', 'makao-core' ),
                'dependency'  => array(
                    'show' => array(
                        'button' => array(
                            'values'        => 'yes',
                            'default_value' => 'no'
                        )
                    )
                )
            ) );

            $this->set_option( array(
                'field_type'    => 'select',
                'name'          => 'button_link_target',
                'title'         => esc_html__( 'Link Target', 'makao-core' ),
                'group'         => esc_html__( 'Button Styles', 'makao-core' ),
                'options'       => makao_core_get_select_type_options_pool( 'link_target' ),
                'default_value' => '_self',
                'dependency'  => array(
                    'show' => array(
                        'button' => array(
                            'values'        => 'yes',
                            'default_value' => 'no'
                        )
                    )
                )
            ) );

            $this->set_option( array(
                'field_type'    => 'select',
                'name'          => 'button_style',
                'title'         => esc_html__( 'Button Style', 'makao-core' ),
                'group'         => esc_html__( 'Button Styles', 'makao-core' ),
                'options'       => array(
                    'filled'         =>  esc_html__( 'Filled', 'makao-core' ),
                    'outlined'      =>  esc_html__( 'Outlined', 'makao-core' ),
                    'textual'       =>  esc_html__( 'Textual', 'makao-core' )
                ),
                'default_value' => 'outlined',
                'dependency'  => array(
                    'show' => array(
                        'button' => array(
                            'values'        => 'yes',
                            'default_value' => 'no'
                        )
                    )
                )
            ) );

            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'button_margin',
                'title'      => esc_html__( 'Button Margin', 'makao-core' ),
                'group'      => esc_html__( 'Button Styles', 'makao-core' ),
                'dependency'  => array(
                    'show' => array(
                        'button' => array(
                            'values'        => 'yes',
                            'default_value' => 'no'
                        )
                    )
                )
            ) );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['title']          = $this->get_modified_title( $atts );
			$atts['title_styles']   = $this->get_title_styles( $atts );
			$atts['text_styles']    = $this->get_text_styles( $atts );
            $atts['caption_styles'] = $this->get_caption_styles( $atts );
			
			return makao_core_get_template_part( 'shortcodes/section-title', 'templates/section-title', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-section-title';
			$holder_classes[] = ! empty( $atts['content_alignment'] ) ?  'qodef-alignment--' . $atts['content_alignment'] : 'qodef-alignment--left';
			$holder_classes[] = $atts['disable_title_break_words'] === 'yes' ? 'qodef-title-break--disabled' : '';
			$holder_classes[] = ! empty( $atts['appear_animation'] ) && $atts['appear_animation'] === 'yes' ? 'qodef-appear-animation' : '';
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_modified_title( $atts ) {
			$title = $atts['title'];
			
			if ( ! empty( $title ) && ! empty( $atts['line_break_positions']) ||
                    ! empty( $title ) && ! empty( $atts['caps_lock_positions'])
                 ) {

				$split_title          = explode( ' ', $title );
				$line_break_positions = explode( ',', str_replace( ' ', '', $atts['line_break_positions'] ) );
				$caps_lock_position   = $atts['caps_lock_positions'];

				if( !empty ($caps_lock_position) && $caps_lock_position <= count($split_title) ){
				    $split_title[$caps_lock_position -1] = '<span class="qodef-capsed-word">'.$split_title[$caps_lock_position -1].'</span>';
                }

				if( !empty ($atts['line_break_positions']) ) {
                    foreach ($line_break_positions as $position) {
                        if (isset($split_title[$position - 1]) && !empty($split_title[$position - 1])) {
                            $split_title[$position - 1] = $split_title[$position - 1] . '<br />';
                        }
                    }
                }
				
				$title = implode( ' ', $split_title );
			}
			
			return $title;
		}
		
		private function get_title_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}

            $font_size = $atts['title_font_size'];
            if ( ! empty( $font_size ) ) {
                if ( qode_framework_string_ends_with_typography_units( $font_size ) ) {
                    $styles[] = 'font-size: ' . $font_size;
                } else {
                    $styles[] = 'font-size: ' . intval( $font_size ) . 'px';
                }
            }

            $line_height = $atts['title_line_height'];
            if ( ! empty( $line_height ) ) {
                if ( qode_framework_string_ends_with_typography_units( $line_height ) ) {
                    $styles[] = 'line-height: ' . $line_height;
                } else {
                    $styles[] = 'line-height: ' . intval( $line_height ) . 'px';
                }
            }
			
			return $styles;
		}

        private function get_caption_styles( $atts ) {
            $styles = array();

            if ( ! empty( $atts['caption_color'] ) ) {
                $styles[] = 'color: ' . $atts['caption_color'];
            }

            if ( ! empty( $atts['caption_margin'] ) ) {
                $styles[] = 'margin: ' . $atts['caption_margin'];
            }

            $font_size = $atts['caption_font_size'];
            if ( ! empty( $font_size ) ) {
                if ( qode_framework_string_ends_with_typography_units( $font_size ) ) {
                    $styles[] = 'font-size: ' . $font_size;
                } else {
                    $styles[] = 'font-size: ' . intval( $font_size ) . 'px';
                }
            }

            return $styles;
        }
		
		private function get_text_styles( $atts ) {
			$styles = array();
			
			if ( $atts['text_margin_top'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $atts['text_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $atts['text_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['text_margin_top'] ) . 'px';
				}
			}

            if ( ! empty( $atts['text_line_height'] ) ) {
                $styles[] = 'line-height: ' . $atts['text_line_height'];
            }

            $font_size = $atts['text_font_size'];
            if ( ! empty( $font_size ) ) {
                if ( qode_framework_string_ends_with_typography_units( $font_size ) ) {
                    $styles[] = 'font-size: ' . $font_size;
                } else {
                    $styles[] = 'font-size: ' . intval( $font_size ) . 'px';
                }
            }

			if ( ! empty( $atts['text_color'] ) ) {
				$styles[] = 'color: ' . $atts['text_color'];
			}
			
			return $styles;
		}
	}
}
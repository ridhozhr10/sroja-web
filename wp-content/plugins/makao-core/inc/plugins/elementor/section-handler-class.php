<?php

class MakaoCoreElementorSectionHandler {
	private static $instance;
	public $sections = array();
	
	public function __construct() {
		add_action( 'elementor/element/section/_section_responsive/after_section_end', array( $this, 'render_parallax_options' ), 10, 2 );
		add_action( 'elementor/element/section/_section_responsive/after_section_end', array( $this, 'render_grid_options' ), 10, 2 );
		add_action( 'elementor/frontend/section/before_render', array( $this, 'section_before_render' ) );
		add_action( 'elementor/frontend/element/before_render', array( $this, 'section_before_render' ) );
		add_action( 'elementor/frontend/before_enqueue_styles', array( $this, 'enqueue_styles' ), 9 );
		add_action( 'elementor/frontend/before_enqueue_scripts', array( $this, 'enqueue_scripts' ), 9 );
        add_filter( 'elementor/widgets/black_list', array( $this, 'blacklist_widgets' ) );
	}
	
	public static function get_instance() {
		if ( self::$instance === null ) {
			return new self();
		}
		
		return self::$instance;
	}
	
	public function render_parallax_options( $section, $args ) {
		$section->start_controls_section(
			'qodef_parallax',
			[
				'label' => esc_html__( 'Makao Core Parallax', 'makao-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);
		
		$section->add_control(
			'qodef_enable_parallax',
			[
				'label'       => esc_html__( 'Enable Parallax', 'makao-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'no',
				'options'     => [
					'no'  => esc_html__( 'No', 'makao-core' ),
					'yes' => esc_html__( 'Yes', 'makao-core' ),
				],
				'render_type' => 'template',
			]
		);
		
		$section->add_control(
			'qodef_parallax_image',
			[
				'label'       => esc_html__( 'Parallax Background Image', 'makao-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'condition'   => [
					'qodef_enable_parallax' => 'yes'
				],
				'render_type' => 'template',
			]
		);
		
		$section->add_control(
			'qodef_parallax_height',
			[
				'label'       => esc_html__( 'Parallax Section Height', 'makao-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'condition'   => [
					'qodef_enable_parallax' => 'yes'
				],
				'render_type' => 'template',
			]
		);
		
		$section->end_controls_section();
	}
	
	public function render_grid_options( $section, $args ) {
		$section->start_controls_section(
			'qodef_grid_row',
			[
				'label' => esc_html__( 'Makao Grid', 'makao-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);
		
		$section->add_control(
			'qodef_enable_grid_row',
			[
				'label'        => esc_html__( 'Make this row "In Grid"', 'makao-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'no',
				'options'      => [
					'no'   => esc_html__( 'No', 'makao-core' ),
					'grid' => esc_html__( 'Yes', 'makao-core' ),
				],
				'prefix_class' => 'qodef-elementor-content-'
			]
		);
		
		$section->end_controls_section();
	}
	
	public function section_before_render( $widget ) {
		$data     = $widget->get_data();
		$type     = isset( $data['elType'] ) ? $data['elType'] : 'section';
		$settings = $data['settings'];
		
		if ( 'section' === $type ) {
			if ( isset( $settings['qodef_enable_parallax'] ) && $settings['qodef_enable_parallax'] == 'yes' ) {
				$parallax_image  = $widget->get_settings_for_display( 'qodef_parallax_image' );
				$parallax_height = $widget->get_settings_for_display( 'qodef_parallax_height' );
				
				if ( ! in_array( $data['id'], $this->sections ) ) {
					$this->sections[ $data['id'] ] = [ $parallax_image, $parallax_height ];
				}
				
				$widget->add_render_attribute( '_wrapper', 'style', 'height: ' . $parallax_height );
			}
		}
	}

	public function blacklist_widgets( $black_list ){
        $black_list = apply_filters( 'makao_core_filter_register_widgets', $black_list );

        if (($key = array_search('MakaoCoreContactForm7Widget', $black_list)) !== false) {
            unset($black_list[$key]);
        }

        return $black_list;
    }
	
	public function enqueue_styles() {
		wp_enqueue_style( 'makao-core-elementor', MAKAO_CORE_PLUGINS_URL_PATH . '/elementor/assets/css/elementor.min.css' );
	}
	
	public function enqueue_scripts() {
		wp_enqueue_script( 'makao-core-elementor', MAKAO_CORE_PLUGINS_URL_PATH . '/elementor/assets/js/elementor.js', array( 'jquery', 'elementor-frontend' ) );
		
		$elementor_global_vars = array(
			'elementorSectionHandler' => $this->sections
		);
		
		wp_localize_script( 'makao-core-elementor', 'qodefElementorGlobal', array(
			'vars' => $elementor_global_vars,
		) );
	}
}

if ( ! function_exists( 'makao_core_init_elementor_section_handler' ) ) {
	function makao_core_init_elementor_section_handler() {
		MakaoCoreElementorSectionHandler::get_instance();
	}
	
	add_action( 'init', 'makao_core_init_elementor_section_handler', 1 );
}
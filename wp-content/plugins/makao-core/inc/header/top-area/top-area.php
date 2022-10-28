<?php

class MakaoCoreTopArea {
	private static $instance;
	private $is_top_area_enabled;
	private $is_top_area_transparent;
	private $top_area_height;
	private $is_header_transparent;
	
	public function __construct() {
		add_action( 'wp', array( $this, 'set_variables' ), 11 ); //after header
		add_action( 'makao_action_before_page_header', array( $this, 'load_template' ) );
		add_filter( 'makao_filter_localize_main_js', array( $this, 'set_global_javascript_variables' ) );
		add_filter( 'makao_core_filter_content_margin', array( $this, 'get_content_margin' ) );
		add_filter( 'makao_core_filter_title_padding', array( $this, 'get_title_padding' ) );
		add_filter( 'makao_filter_add_inline_style', array( $this, 'set_inline_top_area_styles' ) );
	}
	
	public static function get_instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}
		
		return self::$instance;
	}
	
	function is_top_area_enabled() {
		$top_area_enabled = makao_core_get_post_value_through_levels( 'qodef_top_area_header' ) === 'yes';

		$this->is_top_area_enabled = $top_area_enabled;
	}
	
	public function set_top_area_height() {
		if ( $this->is_top_area_enabled ) {
			$height         = makao_core_get_post_value_through_levels( 'qodef_top_area_header_height' );
			$top_bar_height = ! empty( $height ) ? $height : 40;
			
			$this->top_area_height = intval( $top_bar_height );
		} else {
			$this->top_area_height = 0;
		}
	}
	
	public function is_top_area_transparent() {
		$background_color = makao_core_get_post_value_through_levels( 'qodef_top_area_header_background_color' );
		
		if ( ! empty( $background_color ) ) {
			if ( preg_match( '/^#[a-f0-9]{6}$/i', $background_color ) ) { //hex color is valid
				$this->is_top_area_transparent = false;
			} else {
				$this->is_top_area_transparent = true;
			}
		}else{
			$this->is_top_area_transparent = false;
		}
	}
	
	public function set_variables() {
		$header_object = MakaoCoreHeaders::get_instance()->get_header_object();
		
		$this->is_top_area_enabled();
		$this->is_top_area_transparent();
		$this->set_top_area_height();
		$this->is_header_transparent = ! empty( $header_object ) ? ($header_object->get_header_transparency() || $header_object->content_behind_header()): false;
	}
	
	public function load_template() {
		$parameters = array(
			'show_header_area' => $this->is_top_area_enabled
		);
		
		makao_core_template_part( 'header/top-area/', 'templates/top-area', '', $parameters );
	}
	
	public function set_global_javascript_variables( $global_vars ) {
		$global_vars['topAreaHeight'] = $this->top_area_height;
		
		return $global_vars;
	}
	
	public function get_content_margin( $margin ) {
        $header_object = MakaoCoreHeaders::get_instance()->get_header_object();

		if ( ( $this->is_top_area_transparent && $this->is_header_transparent ) || $header_object->content_behind_header() ) {
			$margin += $this->top_area_height;
		}
		
		return $margin;
	}
	
	public function get_title_padding( $padding ) {
		if ( $this->is_top_area_transparent && $this->is_header_transparent ) {
			$padding += $this->top_area_height;
		}
		
		return $padding;
	}
	
	public function set_inline_top_area_styles( $style ) {
		$styles  = array();
		
		$background_color = makao_core_get_post_value_through_levels( 'qodef_top_area_header_background_color' );
		$height           = makao_core_get_post_value_through_levels( 'qodef_top_area_header_height' );
		$padding          = makao_core_get_post_value_through_levels( 'qodef_top_area_header_side_padding' );
		
		if ( ! empty( $background_color ) ) {
			$styles['background-color'] = $background_color;
		}
		
		if ( ! empty( $height ) ) {
			$styles['height'] = intval( $height ) . 'px';
		}
		
		if ( ! empty( $padding ) ) {
			$styles['padding'] = '0 ' . $padding;
		}
		
		if ( ! empty( $styles ) ) {
			$style .= qode_framework_dynamic_style( '#qodef-top-area', $styles );
		}
		
		return $style;
	}
}

MakaoCoreTopArea::get_instance();
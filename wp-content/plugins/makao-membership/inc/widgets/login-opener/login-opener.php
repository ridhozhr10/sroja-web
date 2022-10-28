<?php

if ( ! function_exists( 'makao_membership_add_author_info_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function makao_membership_add_author_info_widget( $widgets ) {
		$widgets[] = 'MakaoMembershipLoginOpenerWidget';
		
		return $widgets;
	}
	
	add_filter( 'makao_membership_filter_register_widgets', 'makao_membership_add_author_info_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) && !class_exists( 'MakaoMembershipLoginOpenerWidget' ) ) {
	class MakaoMembershipLoginOpenerWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$this->set_base( 'makao_membership_login_opener' );
			$this->set_name( esc_html__( 'Makao Login Opener', 'makao-membership' ) );
			$this->set_description( esc_html__( 'Login and register membership widget', 'makao-membership' ) );
			$this->set_widget_option(
				array(
					'field_type'  => 'text',
					'name'        => 'login_opener_margin',
					'title'       => esc_html__( 'Opener Margin', 'makao-membership' ),
					'description' => esc_html__( 'Insert margin in format: top right bottom left', 'makao-membership' )
				)
			);
		}
		
		public function render( $atts ) {
			$classes = array();
			$classes[] = is_user_logged_in() ? 'qodef-user-logged--in' : 'qodef-user-logged--out';
			
			$styles = array();
			
			if ( ! empty( $atts['login_opener_margin'] ) ) {
				$styles[] = 'margin: ' . $atts['login_opener_margin'];
			}
			
			$dashboard_template = apply_filters( 'makao_membership_filter_dashboard_template_name', '' );
			
			if ( empty( $dashboard_template ) || ! is_page_template( $dashboard_template ) || ( is_page_template( $dashboard_template ) && is_user_logged_in() ) ) { ?>
				<div class="qodef-login-opener-widget <?php echo implode( ' ', $classes ); ?>" <?php qode_framework_inline_style( $styles ); ?>>
					<?php makao_membership_template_part( 'widgets/login-opener', 'templates/holder' ); ?>
				</div>
			<?php }
		}
	}
}

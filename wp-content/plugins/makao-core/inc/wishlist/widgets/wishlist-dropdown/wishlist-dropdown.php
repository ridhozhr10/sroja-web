<?php

if ( ! function_exists( 'makao_core_add_wishlist_dropdown_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function makao_core_add_wishlist_dropdown_widget( $widgets ) {
		$widgets[] = 'MakaoCoreWishlistDropdown';
		
		return $widgets;
	}
	
	add_filter( 'makao_core_filter_register_widgets', 'makao_core_add_wishlist_dropdown_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class MakaoCoreWishlistDropdown extends QodeFrameworkWidget {
		
		public function map_widget() {
			$this->set_base( 'makao_core_wishlist' );
			$this->set_name( esc_html__( 'Makao Wishlist', 'makao-core' ) );
			$this->set_description( esc_html__( 'Display a wishlist heart icon with a dropdown that shows all items you added in wishlist', 'makao-core' ) );
			
			$this->set_widget_option(
				array(
					'field_type'  => 'text',
					'name'        => 'widget_margin',
					'title'       => esc_html__( 'Margin', 'makao-core' ),
					'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'makao-core' )
				)
			);
		}
		
		public function render( $atts ) {
			$styles = array();
			
			if ( $atts['widget_margin'] !== '' ) {
				$styles[] = 'margin: ' . $atts['widget_margin'];
			}
			
			$number_of_items = makao_core_get_number_of_wishlist_items();
			
			$classes = ! empty( $number_of_items ) ? 'qodef-items--has' : 'qodef-items--no';
			?>
			<div class="qodef-wishlist-dropdown qodef-m <?php echo esc_attr( $classes ) ?>" <?php qode_framework_inline_style( $styles ); ?>>
				<div class="qodef-m-inner">
					<?php makao_core_template_part( 'wishlist', 'widgets/wishlist-dropdown/templates/content', '', array( 'number_of_items' => $number_of_items ) ); ?>
				</div>
			</div>
			<?php
		}
	}
}

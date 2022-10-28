<?php if ( ! post_password_required() && class_exists( 'MakaoCoreButtonShortcode' ) ) { ?>
	<div class="qodef-e-read-more">
		<?php
		$button_params = array(
			'link' => get_the_permalink(),
			'text' => esc_html__( 'Read More', 'makao-core' )
		);
		
		echo MakaoCoreButtonShortcode::call_shortcode( $button_params ); ?>
	</div>
<?php } ?>
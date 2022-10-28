<div class="qodef-e qodef-info--social-share">
	<?php if ( class_exists( 'MakaoCoreSocialShareShortcode' ) ) {
		$params = array(
			'title'  => esc_html__( 'Share:', 'makao-core' ),
			'layout' => 'text'
		);
		
		echo MakaoCoreSocialShareShortcode::call_shortcode( $params );
	} ?>
</div>
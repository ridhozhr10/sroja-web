<?php if ( class_exists( 'MakaoCoreSocialShareShortcode' ) ) { ?>
	<div class="qodef-e-info-item qodef-e-info-social-share">
		<?php
		$params = array();
		$params['title'] = esc_html__( 'Share:', 'makao-core' );
		
		echo MakaoCoreSocialShareShortcode::call_shortcode( $params ); ?>
	</div>
<?php } ?>
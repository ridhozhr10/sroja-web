<?php if ( ! empty( $button_params ) && ! empty ( $button_params['text'] ) && class_exists( 'MakaoCoreButtonShortcode' ) ) { ?>
	<div class="qodef-m-button">
		<?php echo MakaoCoreButtonShortcode::call_shortcode( $button_params ); ?>
	</div>
<?php } ?>
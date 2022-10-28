<a href="javascript:void(0)" <?php echo ! empty( $custom_id ) ? 'id="' . esc_attr( $custom_id ) . '"' : ''; ?> class="qodef-opener-icon qodef-m <?php echo makao_core_get_opener_icon_class( $option_name, $custom_class ) ?>" <?php qode_framework_inline_style( $inline_style ); ?> <?php echo ! empty( $inline_attr ) ? $inline_attr : ''; ?>>
	<span class="qodef-m-icon qodef--open">
        <?php if ($custom_class === 'qodef-fullscreen-menu-opener') : ?>
            <span class="qodef-opener-label"><?php esc_html_e( 'Menu', 'makao-core' ); ?></span>
        <?php endif; ?>
		<?php echo makao_core_get_opener_icon_html_content( $option_name, $set_icon_as_close, $custom_icon ); ?>
	</span>
	<?php if ( $has_close_icon ) { ?>
		<span class="qodef-m-icon qodef--close">
            <?php if($has_close_icon){ ?>
                <span class="qodef-fullscreen-close-text">
                    <?php echo esc_html__('Close', 'makao-core'); ?>
                </span>
            <?php } ?>
			<?php echo makao_core_get_opener_icon_html_content( $option_name, true, $custom_icon ); ?>
		</span>
	<?php } ?>
	<?php if ( $custom_html ) {
		echo wp_kses_post( $custom_html );
	} ?>
</a>
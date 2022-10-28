<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<?php echo do_shortcode( "[instagram-feed $instagram_params]" ); // XSS OK ?>
	
	<?php if ( !empty($type) && $type === 'center_info') : ?>
		<?php makao_core_template_part( 'plugins/instagram/shortcodes/instagram-list', 'templates/center-info', '', $params ); ?>
	<?php endif; ?>
</div>
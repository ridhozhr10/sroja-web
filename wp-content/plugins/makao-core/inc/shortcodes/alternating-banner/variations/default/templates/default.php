<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<?php foreach ( $items[0] as $item ) : ?>
		<?php makao_core_template_part( 'shortcodes/alternating-banner', 'templates/parts/item', '', $item ); ?>
	<?php endforeach; ?>
</div>
<?php for ($i = 1; $i <= 5; $i++) : ?>
	<div class="qodef-image-<?php echo esc_html($i); ?>-holder">
		<?php echo wp_get_attachment_image( ${'item_image_' . $i}, 'full' ); ?>
	</div>
<?php endfor; ?>

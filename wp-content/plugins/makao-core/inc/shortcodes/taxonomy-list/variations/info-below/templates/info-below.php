<article <?php qode_framework_class_attribute( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<div class="qodef-e-image">
			<a itemprop="url" class="qodef-e-link" href="<?php echo esc_attr( $params['term_link'] ); ?>">
				<?php makao_core_template_part( 'shortcodes/taxonomy-list', 'templates/parts/image', '', $params ) ?>
			</a>
		</div>
		<div class="qodef-e-content">
			<a itemprop="url" class="qodef-e-link" href="<?php echo esc_attr( $params['term_link'] ); ?>">
				<?php makao_core_template_part( 'shortcodes/taxonomy-list', 'templates/parts/title', '', $params ) ?>
			</a>
			<?php makao_core_template_part( 'shortcodes/taxonomy-list', 'templates/parts/description', '', $params ) ?>
		</div>
	</div>
</article>
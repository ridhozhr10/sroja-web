<article <?php qode_framework_class_attribute( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<a itemprop="url" class="qodef-e-link" href="<?php echo esc_attr( $params['term_link'] ); ?>">
			<div class="qodef-e-icon">
				<?php makao_core_template_part( 'shortcodes/taxonomy-list', 'templates/parts/icon', '', $params ) ?>
			</div>
			<div class="qodef-e-content">
				<div class="qodef-e-content-inner">
					<?php makao_core_template_part( 'shortcodes/taxonomy-list', 'templates/parts/title', '', $params ) ?>
				</div>
			</div>
		</a>
	</div>
</article>
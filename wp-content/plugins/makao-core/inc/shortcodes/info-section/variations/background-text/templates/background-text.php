<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-m-background-text">
		<?php makao_core_template_part( 'shortcodes/info-section/variations/background-text', 'templates/parts/background-text', '', $params ) ?>
	</div>
	<div class="qodef-m-info">
		<?php makao_core_template_part( 'shortcodes/info-section', 'templates/parts/title', '', $params ) ?>
		<?php makao_core_template_part( 'shortcodes/info-section', 'templates/parts/text', '', $params ) ?>
		<?php makao_core_template_part( 'shortcodes/info-section', 'templates/parts/button', '', $params ) ?>
	</div>
</div>
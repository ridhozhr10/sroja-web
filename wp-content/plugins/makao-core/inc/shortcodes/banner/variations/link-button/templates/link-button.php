<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<?php makao_core_template_part( 'shortcodes/banner', 'templates/parts/image', '', $params ) ?>
    <?php if ( !empty($link_url) ) : ?>
        <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
    <?php endif; ?>
        <div class="qodef-m-content">
            <div class="qodef-m-content-inner">
                <?php makao_core_template_part( 'shortcodes/banner', 'templates/parts/subtitle', '', $params ) ?>
                <?php makao_core_template_part( 'shortcodes/banner', 'templates/parts/title', '', $params ) ?>
                <?php makao_core_template_part( 'shortcodes/banner', 'templates/parts/text', '', $params ) ?>
            </div>
        </div>
    <?php if ( !empty($link_url) ) : ?>
        </a>
    <?php endif; ?>
    <?php makao_core_template_part( 'shortcodes/banner', 'templates/parts/button', '', $params ) ?>
</div>
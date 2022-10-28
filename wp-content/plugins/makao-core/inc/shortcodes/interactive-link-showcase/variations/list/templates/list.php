<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_style( $holder_styles ); ?>>
    <div class="qodef-m-items">
        <?php foreach ( $items as $item ) { ?>
            <a itemprop="url" class="qodef-m-item qodef-e" href="<?php echo esc_url( $item['item_link'] ) ?>" target="<?php echo esc_attr( $link_target ); ?>">
                <span class="qodef-e-title"><?php echo esc_html( $item['item_title'] ); ?></span>
            </a>
        <?php } ?>
    </div>
    <div class="qodef-m-images">
        <?php foreach ( $items as $item ) { ?>
            <?php $item_background = $this_shortcode->get_item_background_styles( $item ); ?>
            <div class="qodef-m-item-images">
                <div class="qodef-m-item-bg-holder" <?php qode_framework_inline_style( $item_background ); ?>></div>
                <?php makao_core_template_part( 'shortcodes/interactive-link-showcase', 'variations/list/templates/parts/images', '', $item ); ?>
            </div>
        <?php } ?>
    </div>
</div>
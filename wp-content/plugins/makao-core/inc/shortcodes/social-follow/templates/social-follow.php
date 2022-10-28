<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
    <div class="qodef-social-follow-wrapper">
        <span class="qodef-m-label" <?php qode_framework_inline_style( $text_styles ); ?>><?php echo esc_html( $label_text ); ?></span>
        <span class="qodef-m-icons">
            <?php if ( ! empty( $facebook_link ) ) { ?>
                <span class="qodef-m-icon" <?php qode_framework_inline_style( $icons_styles ); ?>><a href="<?php echo esc_html( $facebook_link ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html__('fb', 'makao-core'); ?></a></span>
            <?php } ?>
            <?php if ( ! empty( $twitter_link ) ) { ?>
                <span class="qodef-m-icon" <?php qode_framework_inline_style( $icons_styles ); ?>><a href="<?php echo esc_html( $twitter_link ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html__('tw', 'makao-core'); ?></a></span>
            <?php } ?>
            <?php if ( ! empty( $linkedin_link ) ) { ?>
                <span class="qodef-m-icon" <?php qode_framework_inline_style( $icons_styles ); ?>><a href="<?php echo esc_html( $linkedin_link ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html__('ln', 'makao-core'); ?></a></span>
            <?php } ?>
            <?php if ( ! empty( $pinterest_link ) ) { ?>
                <span class="qodef-m-icon" <?php qode_framework_inline_style( $icons_styles ); ?>><a href="<?php echo esc_html( $pinterest_link ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html__('pi', 'makao-core'); ?></a></span>
            <?php } ?>
            <?php if ( ! empty( $tumblr_link ) ) { ?>
                <span class="qodef-m-icon" <?php qode_framework_inline_style( $icons_styles ); ?>><a href="<?php echo esc_html( $tumblr_link ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html__('tmb', 'makao-core'); ?></a></span>
            <?php } ?>
            <?php if ( ! empty( $vk_link ) ) { ?>
                <span class="qodef-m-icon" <?php qode_framework_inline_style( $icons_styles ); ?>><a href="<?php echo esc_html( $vk_link ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html__('vk', 'makao-core'); ?></a></span>
            <?php } ?>
        </span>
    </div>
</div>
<?php
    $spinner_color = makao_core_get_post_value_through_levels( 'qodef_page_spinner_color' );
    $spinner_text  = makao_core_get_post_value_through_levels( 'qodef_page_spinner_text' );

    $spinner_style = array();

    if ( ! empty( $spinner_color ) ) {
        $spinner_style[] = 'color: ' . $spinner_color;
    }
?>

<div class="qodef-makao-text">
    <div class="qodef-m-text" <?php qode_framework_inline_style( $spinner_style ); ?>><?php esc_html_e( $spinner_text ); ?></div>
</div>
<?php

if ( ! function_exists( 'makao_core_add_makao_text_spinner_layout_option' ) ) {
    /**
     * Function that set new value into page spinner layout options map
     *
     * @param array $layouts  - module layouts
     *
     * @return array
     */
    function makao_core_add_makao_text_spinner_layout_option( $layouts ) {
        $layouts['makao-text'] = esc_html__( 'Makao Text', 'makao-core' );

        return $layouts;
    }

    add_filter( 'makao_core_filter_page_spinner_layout_options', 'makao_core_add_makao_text_spinner_layout_option' );
}
<?php

if ( ! function_exists( 'makao_register_justified_gallery_scripts' ) ) {
    /**
     * Function that register module 3rd party scripts
     */
    function makao_register_justified_gallery_scripts() {
        wp_register_script( 'justified-gallery', MAKAO_INC_ROOT . '/justified-gallery/assets/js/plugins/jquery.justifiedGallery.min.js', array( 'jquery' ), true );
    }

    add_action( 'makao_action_before_main_js', 'makao_register_justified_gallery_scripts' );
}

if ( ! function_exists( 'makao_include_justified_gallery_scripts' ) ) {
    /**
     * Function that enqueue modules 3rd party scripts
     *
     * @param array $atts
     */
    function makao_include_justified_gallery_scripts( $atts ) {

        if ( isset( $atts['behavior'] ) && $atts['behavior'] == 'justified-gallery' ) {
            wp_enqueue_script( 'justified-gallery' );
        }
    }

    add_action( 'makao_core_action_list_shortcodes_load_assets', 'makao_include_justified_gallery_scripts' );
}

if ( ! function_exists( 'makao_register_justified_gallery_scripts_for_list_shortcodes' ) ) {
    /**
     * Function that set module 3rd party scripts for list shortcodes
     *
     * @param array $scripts
     *
     * @return array
     */
    function makao_register_justified_gallery_scripts_for_list_shortcodes( $scripts ) {

        $scripts['justified-gallery'] = array(
            'registered' => true
        );

        return $scripts;
    }

    add_filter( 'makao_core_filter_register_list_shortcode_scripts', 'makao_register_justified_gallery_scripts_for_list_shortcodes' );
}
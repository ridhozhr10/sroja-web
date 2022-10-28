<?php

$params                      = array();
$params['layout']            = 'text';
$params['dropdown_behavior'] = 'left';
$params['title'] = esc_html__('Share:', 'makao');

if( class_exists( 'MakaoCoreSocialShareShortcode' ) ) {
    echo MakaoCoreSocialShareShortcode::call_shortcode($params);
}
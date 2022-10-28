<?php

$image_dimension     = isset( $image_dimension ) && ! empty( $image_dimension ) ? esc_attr( $image_dimension['size'] ) : 'full';
$custom_image_width  = isset( $custom_image_width ) && $custom_image_width !== '' ? intval( $custom_image_width ) : 0;
$custom_image_height = isset( $custom_image_height ) && $custom_image_height !== '' ? intval( $custom_image_height ) : 0;

$taxonomy = str_replace('-','_', $taxonomy);
$image = get_term_meta($term_id, 'qodef_' . esc_attr($taxonomy) . '_image', true);

echo makao_core_get_list_shortcode_item_image( $image_dimension, $image, $custom_image_width, $custom_image_height );
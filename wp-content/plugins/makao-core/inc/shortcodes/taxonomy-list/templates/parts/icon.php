<?php

$taxonomy = str_replace('-','_', $taxonomy);
$image = get_term_meta($term_id, 'qodef_' . esc_attr($taxonomy) . '_icon', true);

echo wp_get_attachment_image( $image, 'full' );

<?php
    $spinner_image = makao_core_get_post_value_through_levels( 'qodef_page_spinner_image' );

    $image = array();

    if ( ! empty( $spinner_image ) ) {
        $id = $spinner_image;

        $image['image_id'] = intval( $id );
        $image_original    = wp_get_attachment_image_src( $id, 'full' );
        $image['url']      = $image_original[0];
        $image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );
    }
?>

<div class="qodef-makao-image">
    <div class="qodef-m-image"><?php echo wp_get_attachment_image( $image['image_id'], 'full' ); ?></div>
</div>
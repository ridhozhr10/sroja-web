<div class="qodef-m-image">
    <?php if ( $image_action === 'scrolling-image') { ?>
    <div class="qodef-m-image-holder">
        <div class="qodef-m-image-holder-inner">
            <?php } ?>
	<?php if ( $image_action === 'open-popup' ) { ?>
		<a class="qodef-magnific-popup qodef-popup-item" itemprop="image" href="<?php echo esc_url( $image_params['url'] ); ?>" data-type="image" title="<?php echo esc_attr( $image_params['alt'] ); ?>">
	<?php } elseif ( ( $image_action === 'scrolling-image' || $image_action === 'custom-link' ) && ! empty( $link ) ) { ?>
		<a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
	<?php } ?>
		<?php if ( is_array( $image_params['image_size'] ) && count( $image_params['image_size'] ) ) {
            echo qode_framework_generate_thumbnail($image_params['image_id'], $image_params['image_size'][0], $image_params['image_size'][1]);
		}
		else {
            if ( $image_action === 'scrolling-image') {
                if ( is_int( $image_params['image_id'] ) ) {
                    $attachment_id = $image_params['image_id'];
                } else {
                    $attachment_id = qode_framework_get_attachment_id_from_url( $image_params['image_id'] );
                }

                $url = wp_get_attachment_url( $attachment_id );

                $img_alt  = ! empty( $attachment_id ) ? get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) : '';
                $attr['alt'] = esc_attr( $img_alt );

                echo qode_framework_get_image_html_from_src( $url, $attr );
            } else {
                echo wp_get_attachment_image($image_params['image_id'], $image_params['image_size']);
            }
		} ?>
	<?php if ( $image_action === 'open-popup' || $image_action === 'scrolling-image' || $image_action === 'custom-link' ) { ?>
		</a>
	<?php } ?>
    <?php if ( $image_action === 'scrolling-image' ) { ?>
        </div>
        <img class="qodef-m-frame" src="<?php echo MAKAO_ROOT ?>/assets/img/scrolling-image-frame.png" alt="<?php esc_html_e( 'Scrolling Image Frame', 'makao-core' ) ?>" />
    </div>
    <?php } ?>
</div>
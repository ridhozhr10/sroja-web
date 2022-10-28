<div class="qodef-m-image">
    <?php if( empty( $button_text ) && ! empty( $link_url ) ){ ?>
        <a itemprop="url" class="qodef-ab-image-link" href="<?php echo esc_url( $link_url ) ?>" target="<?php echo esc_attr( $link_target )?>">
    <?php } ?>
	        <?php echo wp_get_attachment_image( $image, 'full' ); ?>
    <?php if( empty( $button_text ) && ! empty( $link_url ) ){ ?>
        </a>
    <?php } ?>
</div>
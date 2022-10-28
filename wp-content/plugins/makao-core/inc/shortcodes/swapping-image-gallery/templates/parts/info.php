<div class="qodef-m-info clearfix">
	<div class="qodef-m-headline">
        <?php if( ! empty( $info_title ) ) { ?>
            <<?php echo esc_attr( $title_tag ); ?> class="qodef-m-title">
                <?php echo wp_kses_post( $info_title ); ?>
            </<?php echo esc_attr( $title_tag ); ?>>
        <?php } ?>
        <?php if( ! empty( $info_description ) ) { ?>
            <p class="qodef-m-description">
                <?php echo esc_html( $info_description ); ?>
            </p>
        <?php } ?>
	</div>
	<div class="qodef-m-thumbnails-holder">
		<div class="qodef-m-thumbnails-holder-inner">
				<?php foreach ( $items as $image_item ): ?>
				<div class="qodef-m-thumbnail">
                    <div class="qodef-m-thumbnail-holder-inner">
                        <div class="qodef-m-inactive-thumbnail">
					    <?php echo wp_get_attachment_image( $image_item['thumbnail_image'], 'full' ); ?>
                        </div>
                        <div class="qodef-m-active-thumbnail">
                            <?php echo wp_get_attachment_image( $image_item['active_thumbnail_image'], 'full' ); ?>
                        </div>
                    </div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
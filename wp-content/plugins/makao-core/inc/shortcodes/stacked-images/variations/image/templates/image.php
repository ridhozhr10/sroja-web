<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-m-images">
        <div class="qodef-m-images-holder-inner">
            <?php if ( ! empty( $main_image ) ) : ?>
                <div class="qodef-m-main-image-holder">
                    <?php echo wp_get_attachment_image( $main_image, 'full', false, array( 'class' => 'qodef-e-image qodef--main' ) ); ?>
                </div>
            <?php endif; ?>

            <?php if ( ! empty( $stacked_image ) ): ?>
                <div class="qodef-m-stack-image-holder">
                    <?php echo wp_get_attachment_image( $stacked_image, 'full', false, array( 'class' => 'qodef-e-image qodef--stack' ) ); ?>
                </div>
            <?php endif; ?>
        </div>
	</div>
</div>
<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
    <div class="qodef-grid-inner clear">
		<?php
		// include global masonry template from theme
		makao_core_theme_template_part( 'masonry', 'templates/sizer-gutter', '', $params['behavior'] );

		// include items
		if ( ! empty( $images ) ) {
			foreach ( $images as $image ) {
				$image['item_classes'] = $item_classes;
				$image['image_action'] = $image_action;
				$image['target']       = $target;

				// override image size w/ attachment meta value if masonry fixed - begin
                $masonry_images_proportion = 'fixed';
				if ( $masonry_images_proportion === 'fixed' ) {
					$image_size_meta = makao_core_get_custom_image_size_meta( 'attachment', 'qodef_advanced_image_gallery_masonry_size', $image['image_id'] );

					$image['image_size']   = $image_size_meta['size'];
					$image['item_classes'] .= ' ' . $image_size_meta['class'];
				}
				// override image size w/ attachment meta value if masonry fixed - end

				makao_core_template_part( 'shortcodes/advanced-image-gallery', 'templates/parts/image', '', $image );
			}
		}
		?>
    </div>
</div>
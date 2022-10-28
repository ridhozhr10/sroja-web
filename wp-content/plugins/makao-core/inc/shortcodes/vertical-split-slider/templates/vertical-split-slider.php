<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
    <div class="ms-left">

		<?php foreach ( $items as $key => $item ) :
			$slide_image_styles         = $this_object->get_slide_image_styles( $item );
			$slide_data                 = $this_object->get_slide_data( $item );
            $title_styles               = $this_object->get_title_styles( $item );
            $slide_background           = $this_object->get_holder_styles( $item );
            $slide_title_link           = $item['slide_content_title_link'];
            $slide_title_link_target    = $item['slide_content_title_target'];
        ?>


			<?php if ( $item['slide_layout'] === 'image-left' ) : ?>

                <div class="qodef-m-slide-image ms-section ms-table" <?php echo qode_framework_get_inline_attrs( $slide_data ); ?> <?php qode_framework_inline_style( $slide_image_styles ); ?>>
                    <div class="qodef-m-slide-image ms-section ms-table" <?php qode_framework_inline_style( $slide_image_styles ); ?>>
                        <a class="qodef-e-title-link" href="<?php echo esc_html($slide_title_link) ?>" target="<?php echo esc_html($slide_title_link_target) ?>">
                            <?php if ( ! empty( $item['slide_content_title'] ) ) : ?>
                                <<?php echo esc_attr( $item['slide_content_title_tag'] ); ?> class="qodef-m-title" <?php qode_framework_inline_style( $title_styles ); ?>>
                                <?php echo esc_html( $item['slide_content_title'] ); ?>
                            </<?php echo esc_attr( $item['slide_content_title_tag'] ); ?>>
                            <?php endif; ?>
                        </a>
                    </div>
                </div>

            <?php else : ?>

                <div class="qodef-m-slide-content ms-section ms-table" <?php echo qode_framework_get_inline_attrs( $slide_data ); ?> <?php qode_framework_inline_style( $slide_background ); ?>>
                    <div class="qodef-m-slide-content-inner">
                        <?php if ( ! empty( $item['slide_content_image'] ) ):
                            echo wp_get_attachment_image( $item['slide_content_image'], 'full', false, array( 'class' => 'qodef-m-image' ) );
                        endif; ?>

                        <?php if ( ! empty( $item['slide_content_text'] ) ) : ?>
                            <?php if ( !empty( $item['slide_content_text_link'] ) ) : ?>
                                <a class="qodef-e-text-link" href="<?php echo esc_html($item['slide_content_text_link']) ?>" target="<?php echo esc_html($item['slide_content_text_target']) ?>">
                            <?php endif; ?>
                                <h4 class="qodef-m-text"><?php echo wp_kses( nl2br( $item['slide_content_text'] ), array( 'br' => array() ) ) ?></h4>
                            <?php if ( !empty( $item['slide_content_text_link'] ) ) : ?>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php
        //                    $button_params = array(
        //                        'link'             => $item['slide_content_button_link'],
        //                        'text'             => $item['slide_content_button_text'],
        //                        'target'           => $item['slide_content_button_target'],
        //                        'size'             => 'normal',
        //                        'color'            => '#ffffff',
        //                        'background_color' => '#a6cef9',
        //                        'button_layout'    => 'filled',
        //                        'custom_class'     => 'qodef-m-button',
        //                    );
        //                    echo MakaoCoreButtonShortcode::call_shortcode( $button_params );
                        ?>
                    </div>

                </div>

            <?php endif; ?>
		<?php endforeach; ?>

    </div><!-- .ms-left -->

    <div class="ms-right">

		<?php foreach ( $items as $key => $item ) :
			$slide_image_styles = $this_object->get_slide_image_styles( $item );
            $slide_data                 = $this_object->get_slide_data( $item );
            $title_styles               = $this_object->get_title_styles( $item );
            $slide_background           = $this_object->get_holder_styles( $item );
            $slide_title_link           = $item['slide_content_title_link'];
            $slide_title_link_target    = $item['slide_content_title_target'];
			?>

			<?php if ( $item['slide_layout'] === 'image-right' ) : ?>

                <div class="qodef-m-slide-image ms-section ms-table" <?php qode_framework_inline_style( $slide_image_styles ); ?>>
                    <a class="qodef-e-title-link" href="<?php echo esc_html($slide_title_link) ?>" target="<?php echo esc_html($slide_title_link_target) ?>">
                        <?php if ( ! empty( $item['slide_content_title'] ) ) : ?>
                        <<?php echo esc_attr( $item['slide_content_title_tag'] ); ?> class="qodef-m-title" <?php qode_framework_inline_style( $title_styles ); ?>>
                        <?php echo esc_html( $item['slide_content_title'] ); ?>
                        </<?php echo esc_attr( $item['slide_content_title_tag'] ); ?>>
                        <?php endif; ?>
                    </a>
                </div>

            <?php else : ?>

                <div class="qodef-m-slide-content ms-section ms-table">
                    <div class="qodef-m-slide-content-inner">

                        <?php if ( ! empty( $item['slide_content_image'] ) ):
                            echo wp_get_attachment_image( $item['slide_content_image'], 'full', false, array( 'class' => 'qodef-m-image' ) );
                        endif; ?>

                        <?php if ( ! empty( $item['slide_content_title'] ) ) : ?>
                            <<?php echo esc_attr( $item['slide_content_title_tag'] ); ?> class="qodef-m-title" <?php qode_framework_inline_style( $title_styles ); ?>>
                                <?php echo esc_html( $item['slide_content_title'] ); ?>
                            </<?php echo esc_attr( $item['slide_content_title_tag'] ); ?>>
                        <?php endif; ?>

                        <?php if ( ! empty( $item['slide_content_text'] ) ) : ?>
                            <?php if ( !empty( $item['slide_content_text_link'] ) ) : ?>
                                <a class="qodef-e-text-link" href="<?php echo esc_html($item['slide_content_text_link']) ?>" target="<?php echo esc_html($item['slide_content_text_target']) ?>">
                            <?php endif; ?>
                                <h4 class="qodef-m-text"><?php echo wp_kses( nl2br( $item['slide_content_text'] ), array( 'br' => array() ) ) ?></h4>
                            <?php if ( !empty( $item['slide_content_text_link'] ) ) : ?>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                </div>

            <?php endif; ?>
		<?php endforeach; ?>

    </div><!-- .ms-right -->

</div>

<div class="qodef-vss-responsive qodef-m">

	<?php foreach ( $items as $key => $item ) :
		$slide_image_styles = $this_object->get_slide_image_styles( $item );
        $title_styles_responsive    = $this_object->get_title_styles_responsive( $item );
        $slide_data                 = $this_object->get_slide_data( $item );
        $title_styles               = $this_object->get_title_styles( $item );
        $slide_background           = $this_object->get_holder_styles( $item );
        $slide_title_link           = $item['slide_content_title_link'];
        $slide_title_link_target    = $item['slide_content_title_target'];
		?>

        <div class="qodef-m-slide-content" <?php qode_framework_inline_style( $slide_background ); ?>>
            <div class="qodef-m-slide-content-inner">

                <?php if ( ! empty( $item['slide_content_image'] ) ):
                    echo wp_get_attachment_image( $item['slide_content_image'], 'full', false, array( 'class' => 'qodef-m-image' ) );
                endif; ?>
                <?php if ( ! empty( $item['slide_content_text'] ) ) : ?>
                    <?php if ( !empty( $item['slide_content_text_link'] ) ) : ?>
                        <a class="qodef-e-text-link" href="<?php echo esc_html($item['slide_content_text_link']) ?>" target="<?php echo esc_html($item['slide_content_text_target']) ?>">
                    <?php endif; ?>
                        <h4 class="qodef-m-text"><?php echo wp_kses( nl2br( $item['slide_content_text'] ), array( 'br' => array() ) ) ?></h4>
                    <?php if ( !empty( $item['slide_content_text_link'] ) ) : ?>
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="qodef-m-slide-image" <?php qode_framework_inline_style( $slide_image_styles ); ?>>
            <a class="qodef-e-title-link" href="<?php echo esc_html($slide_title_link) ?>" target="<?php echo esc_html($slide_title_link_target) ?>">
                <?php if ( ! empty( $item['slide_content_title'] ) ) : ?>
                <<?php echo esc_attr( $item['slide_content_title_tag'] ); ?> class="qodef-m-title" <?php qode_framework_inline_style( $title_styles_responsive ); ?>>
                <?php echo esc_html( $item['slide_content_title'] ); ?>
            </<?php echo esc_attr( $item['slide_content_title_tag'] ); ?>>
            <?php endif; ?>
            </a>
        </div>

	<?php endforeach; ?>

</div>
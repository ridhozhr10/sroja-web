<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attr( $slider_attr, 'data-options' ); ?>>
	<div class="swiper-wrapper">
		<?php
		// Include items
        $i = 0;
		if ( ! empty( $images ) ) {
			foreach ( $images as $image ) {
				$image['item_classes'] = $item_classes;
				$image['image_action'] = $image_action;
				$image['target']       = $target;
				$slide_content_title        = $repeater_elements[$i]['slide_content_title'];
				$slide_content_title_tag    = !empty($repeater_elements[$i]['slide_content_title_tag']) ? $repeater_elements[$i]['slide_content_title_tag'] : 'h2';
				$title_styles =  $this_object->get_title_styles($repeater_elements[$i]);
				$title_attr = $this_object->get_title_data( $repeater_elements[$i] );
                $slide_content_subtitle        = $repeater_elements[$i]['slide_content_subtitle'];
                $slide_content_subtitle_tag    = !empty($repeater_elements[$i]['slide_content_subtitle_tag']) ? $repeater_elements[$i]['slide_content_subtitle_tag'] : 'h6';
				?>
                <div class="qodef-e qodef-image-wrapper swiper-slide">
                    <div class="qodef-m-slide-content">
                        <<?php echo esc_attr( $slide_content_subtitle_tag ); ?> class="qodef-e-subtitle"><?php echo esc_html( $slide_content_subtitle ); ?></<?php echo esc_attr( $slide_content_subtitle_tag ); ?>>
                        <div class="qodef-e-title">
                            <?php if ( ! empty( $slide_content_title ) ) : ?>
                            <<?php echo esc_attr( $slide_content_title_tag ); ?> class="qodef-m-title"  <?php qode_framework_inline_attr( $title_attr, 'data-options' ); ?> <?php qode_framework_inline_style( $title_styles ); ?>>
                            <?php echo makao_return_module_part( makao_return_capsed_word( $slide_content_title, 2 )); ?>
                            </<?php echo esc_attr( $slide_content_title_tag ); ?>>
                            <?php endif; ?>
                        </div>
                        <div class="qodef-e-button">
                            <?php
                                if(!empty($repeater_elements[$i]['slide_content_button_text'])){
                                    $button_params = array(
                                        'link'             => $repeater_elements[$i]['slide_content_button_link'],
                                        'text'             => $repeater_elements[$i]['slide_content_button_text'],
                                        'target'           => $repeater_elements[$i]['slide_content_button_target'],
                                        'size'             => 'normal',
                                        'color'            => '#ffffff',
                                        'button_layout'    => 'outlined',
                                        'custom_class'     => 'qodef-m-button',
                                    );
                                    echo MakaoCoreButtonShortcode::call_shortcode( $button_params );
                                }
                            ?>
                        </div>
                    </div>
                    <?php
                        makao_core_template_part( 'shortcodes/advanced-image-gallery', 'templates/parts/image', '', $image );

                        $i++;
                    ?>
                </div>
                <?php
			}
		}
		?>
	</div>
	<?php if ( $slider_navigation !== 'no' ) { ?>
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
	<?php } ?>
	<?php if ( $slider_pagination !== 'no' ) { ?>
		<div class="swiper-pagination"></div>
	<?php } ?>
</div>
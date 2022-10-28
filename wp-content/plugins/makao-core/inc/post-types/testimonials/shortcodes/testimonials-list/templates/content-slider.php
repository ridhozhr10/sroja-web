<div class="qodef-testimonials-quote">
    <img src="<?php echo MAKAO_CORE_CPT_URL_PATH . '/testimonials/shortcodes/testimonials-list/assets/img/quote-icon-testimonials.png'; ?>" alt="testimonials-quote">
</div>
<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attr( $slider_attr, 'data-options' ); ?>>
    <div class="swiper-wrapper">
        <?php
        // Include items
        makao_core_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'templates/loop', '', $params );
        ?>
    </div>
	<?php if ( $slider_pagination !== 'no' ) { ?>
		<div class="swiper-pagination"></div>
	<?php } ?>
</div>
<?php if ( $slider_navigation !== 'no' ) { ?>
	<div class="qodef-testimonials-navigation">
		<div class="swiper-button-next swiper-button-outside swiper-button-next-<?php echo esc_attr( $unique ); ?>"></div>
		<div class="swiper-button-prev swiper-button-outside swiper-button-prev-<?php echo esc_attr( $unique ); ?>"></div>
	</div>
<?php } ?>
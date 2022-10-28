<?php
// Hook to include additional content before portfolio single item
do_action( 'makao_core_action_before_portfolio_single_item' );
?>
<article <?php post_class( 'qodef-portfolio-single-item qodef-e' ); ?>>
    <div class="qodef-e-inner">
        <div class="qodef-e-content qodef-grid qodef-layout--template <?php echo makao_core_get_grid_gutter_classes(); ?>">
            <div class="qodef-grid-inner clear">
                <div class="qodef-grid-item qodef-col--8">
	                <div class="qodef-media qodef-swiper-container qodef--slider">
		                <div class="swiper-wrapper">
			                <?php makao_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/media', 'slider'); ?>
		                </div>
		                <div class="swiper-button-next"></div>
		                <div class="swiper-button-prev"></div>
	                </div>
                </div>
                <div class="qodef-grid-item qodef-col--4 ">
					<?php makao_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/title' ); ?>
					<?php makao_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/content' ); ?>
                    <div class="qodef-portfolio-info">
						<?php makao_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/custom-fields' ); ?>
						<?php makao_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/date' ); ?>
						<?php makao_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/categories' ); ?>
						<?php makao_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/social-share' ); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="qodef-e-bottom-line"></div>
    </div>
</article>
<?php
// Hook to include additional content after portfolio single item
do_action( 'makao_core_action_after_portfolio_single_item' );
?>
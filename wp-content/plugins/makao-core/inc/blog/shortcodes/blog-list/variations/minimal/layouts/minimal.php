<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<div class="qodef-e-content">
			<div class="qodef-e-info qodef-info--top">
				<?php
				// Include post date info
				makao_core_theme_template_part( 'blog', 'templates/parts/post-info/date' );
				// Include post category info
				makao_core_theme_template_part( 'blog', 'templates/parts/post-info/category' );
				?>
			</div>
			<div class="qodef-e-text">
				<?php
				// Include post title
				makao_core_theme_template_part( 'blog', 'templates/parts/post-info/title', '', array( 'title_tag' => $title_tag ) );

                if($show_excerpt == 'yes') {
                    // Include post excerpt
                    makao_core_theme_template_part('blog', 'templates/parts/post-info/excerpt', '', $params);
                }
				
				// Hook to include additional content after blog single content
				do_action( 'makao_action_after_blog_single_content' );
				?>
			</div>
			<div class="qodef-e-info qodef-info--bottom">
				<div class="qodef-e-info-left">
					<?php
					// Include post read more
					makao_core_theme_template_part( 'blog', 'templates/parts/post-info/read-more' );
					?>
				</div>
			</div>
		</div>
	</div>
</article>
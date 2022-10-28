<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php
        // Include post media
        if ($show_blog_list_image === 'yes') {
            makao_core_template_part('blog/shortcodes/blog-list', 'templates/post-info/image', '', $params);
        } else {
            makao_core_theme_template_part( 'blog', 'templates/parts/post-info/media' );
        }
		?>
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
				<div class="qodef-e-info-right">
					<?php
        //					// Include post author info
        //					makao_core_theme_template_part( 'blog', 'templates/parts/post-info/author' );
        //
        //					// Include post date info
        //					makao_core_theme_template_part( 'blog', 'templates/parts/post-info/date' );
        //
        //					// Include post comments info
        //					makao_core_theme_template_part( 'blog', 'templates/parts/post-info/comments' );
					?>
				</div>
			</div>
		</div>
	</div>
</article>
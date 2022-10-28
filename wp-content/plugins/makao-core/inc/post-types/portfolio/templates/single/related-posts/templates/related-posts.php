<?php
$post_id       = get_the_ID();
$is_enabled    = makao_core_get_post_value_through_levels( 'qodef_portfolio_single_enable_related_posts' );
$related_posts = makao_core_get_custom_post_type_related_posts( $post_id, makao_core_get_portfolio_single_post_taxonomies( $post_id ) );

if ( $is_enabled === 'yes' && ! empty( $related_posts ) ) { ?>
	<div id="qodef-portfolio-single-related-items">
		<?php if ( class_exists( 'MakaoCorePortfolioListShortcode' ) ) {
			$params = apply_filters( 'makao_core_filter_portfolio_single_related_posts_params', array(
				'custom_class'      => 'qodef--no-bottom-space',
				'columns'           => '3',
				'posts_per_page'    => 3,
				'additional_params' => 'tax',
				'tax'               => $related_posts['taxonomy'],
				'tax__in'           => $related_posts['items'],
				'layouts'           => 'info-below',
				'title_tag'         => 'h5',
				'excerpt_length'    => '100'
			) );
			
			echo MakaoCorePortfolioListShortcode::call_shortcode( $params );
		}
		?>
	</div>
<?php } ?>
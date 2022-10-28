<?php
$query_array =  array(
	'post_type' => 'product', 
	'posts_per_page' => 2, 
	'product_cat' => $category_slug, 
	'orderby' => $orderby,
	'order'   => $order
);

$query_results = new WP_Query( $query_array );
?>

<ul class="qodef-woo-products">
	<?php while ( $query_results->have_posts() ) : $query_results->the_post(); global $product; ?>
		
		<li class="qodef-woo-product">
			<a href="<?php echo get_permalink( $query_results->post->ID ) ?>" title="<?php echo esc_attr($query_results->post->post_title ? $query_results->post->post_title : $query_results->post->ID); ?>">
				<?php if (has_post_thumbnail( $query_results->post->ID )) {
					echo get_the_post_thumbnail($query_results->post->ID, 'full');
				} else {
					echo '<img src="'.wc_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" />';
				}  ?>
				
<!--				<h3>--><?php //the_title(); ?><!--</h3>-->
<!--				<span class="qodef-woo-price">--><?php //echo $product->get_price_html(); ?><!--</span>-->
			</a>
<!--			--><?php //woocommerce_template_loop_add_to_cart( $query_results->post, $product ); ?>
		</li>
	
	<?php endwhile; ?>
	<?php wp_reset_query(); ?>
</ul>
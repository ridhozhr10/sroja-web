<?php // $number_of_items ?>

<a itemprop="url" href="<?php echo get_site_url().'/wishlist'; ?>" class="qodef-m-link">
	<?php echo qode_framework_icons()->render_icon( 'qodef-icon-simple-line-icons icon-heart', 'simple-line-icons', array( 'icon_attributes' => array( 'class' => 'qodef-m-link-icon' ) ) ); ?>
    <?php echo esc_html__('Wishlist', 'makao-core') ?>
</a>
<div class="qodef-m-items">
	<?php if ( ! empty( $number_of_items ) ) {
		$items = makao_core_get_wishlist_items();
		
		foreach ( $items as $id => $title ) {
			$item_params          = array();
			$item_params['id']    = $id;
			$item_params['title'] = $title;
			
			makao_core_template_part( 'wishlist', 'widgets/wishlist-dropdown/templates/item', '', $item_params );
		}
	}
	?>
</div>
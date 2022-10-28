<div class="qodef-m-content">
	<?php if ( ! WC()->cart->is_empty() ) {
		makao_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/loop' );
		
		makao_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/order-details' );
		
		makao_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/button' );
	} else {
		// Include posts not found
		makao_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/posts-not-found' );
	}
	
	makao_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/close' );
	?>
</div>
<?php makao_core_template_part( 'plugins/woocommerce/widgets/dropdown-cart', 'templates/parts/opener' ); ?>
<div class="qodef-m-dropdown">
	<div class="qodef-m-dropdown-inner">
		<?php if ( ! WC()->cart->is_empty() ) {
			makao_core_template_part( 'plugins/woocommerce/widgets/dropdown-cart', 'templates/parts/loop' );
			
			makao_core_template_part( 'plugins/woocommerce/widgets/dropdown-cart', 'templates/parts/order-details' );
			
			makao_core_template_part( 'plugins/woocommerce/widgets/dropdown-cart', 'templates/parts/button' );
		} else {
		    // Include posts not found
			makao_core_template_part( 'plugins/woocommerce/widgets/dropdown-cart', 'templates/parts/posts-not-found' );
		} ?>
	</div>
</div>
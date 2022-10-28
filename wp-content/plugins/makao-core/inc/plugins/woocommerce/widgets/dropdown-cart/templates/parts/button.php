<div class="qodef-m-action">
    <a itemprop="url" href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="qodef-m-action-link e-checkout qodef-button qodef-layout--filled"><span class="qodef-m-text"><?php esc_html_e( 'Checkout', 'makao-core' ); ?></span></a>
	<a itemprop="url" href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="qodef-m-action-link e-cart">
        <span class="qodef-top-border"></span>
        <span class="qodef-right-border"></span>
        <span class="qodef-bottom-border"></span>
        <span class="qodef-left-border"></span>
        <span class="qodef-m-text"><?php esc_html_e( 'View Cart', 'makao-core' ); ?></span>
    </a>
</div>
<?php

include_once MAKAO_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/product-list/product-list.php';

foreach ( glob( MAKAO_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/product-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
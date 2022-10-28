<?php

include_once MAKAO_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/category-with-products/category-with-products.php';

foreach ( glob( MAKAO_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/category-with-products/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
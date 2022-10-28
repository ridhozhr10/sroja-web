<?php

$product = makao_core_woo_get_global_product();

if ( ! empty( $product ) && $product->is_on_sale() ) {
	echo makao_core_woo_sale_flash();
}

if ( ! empty( $product ) && ! $product->is_in_stock() ) {
	echo makao_core_get_out_of_stock_mark();
}

if ( ! empty( $product ) && $product->get_id() !== '' ) {
	echo makao_core_get_new_mark( $product->get_id() );
}
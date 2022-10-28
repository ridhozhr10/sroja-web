<?php

include_once MAKAO_CORE_CPT_PATH . '/clients/shortcodes/clients-list/clients-list.php';

foreach ( glob( MAKAO_CORE_CPT_PATH . '/clients/shortcodes/clients-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
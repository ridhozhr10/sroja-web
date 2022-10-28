<?php

include_once MAKAO_CORE_SHORTCODES_PATH . '/stacked-images/stacked-images.php';

foreach ( glob( MAKAO_CORE_SHORTCODES_PATH . '/stacked-images/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
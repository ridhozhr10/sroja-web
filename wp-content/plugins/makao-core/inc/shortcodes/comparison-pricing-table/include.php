<?php

include_once MAKAO_CORE_SHORTCODES_PATH . '/comparison-pricing-table/comparison-pricing-table.php';

foreach ( glob( MAKAO_CORE_SHORTCODES_PATH . '/comparison-pricing-table/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
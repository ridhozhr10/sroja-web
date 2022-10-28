<?php

include_once MAKAO_CORE_SHORTCODES_PATH . '/counter/counter.php';

foreach ( glob( MAKAO_CORE_SHORTCODES_PATH . '/counter/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
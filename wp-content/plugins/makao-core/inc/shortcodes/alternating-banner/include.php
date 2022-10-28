<?php

include_once MAKAO_CORE_SHORTCODES_PATH . '/alternating-banner/alternating-banner.php';

foreach ( glob( MAKAO_CORE_INC_PATH . '/shortcodes/alternating-banner/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
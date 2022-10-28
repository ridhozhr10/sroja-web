<?php

include_once MAKAO_CORE_SHORTCODES_PATH . '/banner/banner.php';

foreach ( glob( MAKAO_CORE_INC_PATH . '/shortcodes/banner/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
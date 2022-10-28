<?php

include_once MAKAO_CORE_SHORTCODES_PATH . '/custom-font/custom-font.php';

foreach ( glob( MAKAO_CORE_SHORTCODES_PATH . '/custom-font/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
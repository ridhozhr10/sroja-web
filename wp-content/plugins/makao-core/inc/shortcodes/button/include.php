<?php

include_once MAKAO_CORE_SHORTCODES_PATH . '/button/button.php';

foreach ( glob( MAKAO_CORE_SHORTCODES_PATH . '/button/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
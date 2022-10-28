<?php

include_once MAKAO_CORE_SHORTCODES_PATH . '/countdown/countdown.php';

foreach ( glob( MAKAO_CORE_SHORTCODES_PATH . '/countdown/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
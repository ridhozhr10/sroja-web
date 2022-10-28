<?php

include_once MAKAO_CORE_SHORTCODES_PATH . '/tabs/tab.php';
include_once MAKAO_CORE_SHORTCODES_PATH . '/tabs/tab-child.php';

foreach ( glob( MAKAO_CORE_SHORTCODES_PATH . '/tabs/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
<?php

include_once MAKAO_CORE_SHORTCODES_PATH . '/accordion/accordion.php';
include_once MAKAO_CORE_SHORTCODES_PATH . '/accordion/accordion-child.php';

foreach ( glob( MAKAO_CORE_SHORTCODES_PATH . '/accordion/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
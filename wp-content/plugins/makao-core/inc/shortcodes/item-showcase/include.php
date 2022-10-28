<?php

include_once MAKAO_CORE_SHORTCODES_PATH . '/item-showcase/item-showcase.php';

foreach ( glob( MAKAO_CORE_SHORTCODES_PATH . '/item-showcase/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
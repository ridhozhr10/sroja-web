<?php

include_once MAKAO_CORE_SHORTCODES_PATH . '/taxonomy-list/helper.php';
include_once MAKAO_CORE_SHORTCODES_PATH . '/taxonomy-list/taxonomy-list.php';

foreach ( glob( MAKAO_CORE_INC_PATH . '/shortcodes/taxonomy-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
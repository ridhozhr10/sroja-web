<?php

include_once MAKAO_CORE_SHORTCODES_PATH . '/author-list/helper.php';
include_once MAKAO_CORE_SHORTCODES_PATH . '/author-list/author-list.php';

foreach ( glob( MAKAO_CORE_INC_PATH . '/shortcodes/author-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
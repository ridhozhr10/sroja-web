<?php

include_once MAKAO_CORE_SHORTCODES_PATH . '/icon-with-text/icon-with-text.php';

foreach ( glob( MAKAO_CORE_SHORTCODES_PATH . '/icon-with-text/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
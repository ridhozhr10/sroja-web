<?php

include_once MAKAO_CORE_SHORTCODES_PATH . '/info-section/info-section.php';

foreach ( glob( MAKAO_CORE_SHORTCODES_PATH . '/info-section/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
<?php

include_once MAKAO_CORE_SHORTCODES_PATH . '/image-with-text/image-with-text.php';

foreach ( glob( MAKAO_CORE_SHORTCODES_PATH . '/image-with-text/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
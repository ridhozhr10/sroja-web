<?php

include_once MAKAO_CORE_INC_PATH . '/social-share/shortcodes/social-share/social-share.php';

foreach ( glob( MAKAO_CORE_INC_PATH . '/social-share/shortcodes/social-share/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
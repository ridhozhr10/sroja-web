<?php

include_once MAKAO_CORE_SHORTCODES_PATH . '/interactive-link-showcase/interactive-link-showcase.php';

foreach ( glob( MAKAO_CORE_SHORTCODES_PATH . '/interactive-link-showcase/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
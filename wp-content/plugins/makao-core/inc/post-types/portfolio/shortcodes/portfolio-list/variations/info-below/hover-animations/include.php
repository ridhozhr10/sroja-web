<?php

include_once MAKAO_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/variations/info-below/hover-animations/hover-animations.php';

foreach ( glob( MAKAO_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/variations/info-below/hover-animations/*/include.php' ) as $animation ) {
	include_once $animation;
}
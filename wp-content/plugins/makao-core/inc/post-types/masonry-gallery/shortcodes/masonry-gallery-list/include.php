<?php

include_once MAKAO_CORE_CPT_PATH . '/masonry-gallery/shortcodes/masonry-gallery-list/masonry-gallery-list.php';

foreach ( glob( MAKAO_CORE_CPT_PATH . '/masonry-gallery/shortcodes/masonry-gallery-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
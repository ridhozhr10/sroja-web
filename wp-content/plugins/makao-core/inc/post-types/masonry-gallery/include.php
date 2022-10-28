<?php

foreach ( glob( MAKAO_CORE_CPT_PATH . '/masonry-gallery/dashboard/meta-box/*.php' ) as $module ) {
	include_once $module;
}
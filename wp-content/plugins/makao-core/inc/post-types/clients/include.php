<?php

include_once MAKAO_CORE_CPT_PATH . '/clients/helper.php';

foreach ( glob( MAKAO_CORE_CPT_PATH . '/clients/dashboard/meta-box/*.php' ) as $module ) {
	include_once $module;
}
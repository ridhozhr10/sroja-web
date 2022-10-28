<?php

include_once MAKAO_CORE_CPT_PATH . '/team/shortcodes/team-list/team-list.php';

foreach ( glob( MAKAO_CORE_CPT_PATH . '/team/shortcodes/team-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
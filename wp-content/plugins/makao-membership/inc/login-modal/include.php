<?php

include_once MAKAO_MEMBERSHIP_LOGIN_MODAL_PATH . '/helper.php';

foreach ( glob( MAKAO_MEMBERSHIP_LOGIN_MODAL_PATH . '/*/include.php' ) as $module ) {
	include_once $module;
}
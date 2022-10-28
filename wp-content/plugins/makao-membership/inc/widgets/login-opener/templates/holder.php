<?php

if ( is_user_logged_in() ) {
	makao_membership_template_part( 'widgets/login-opener', 'templates/logged-in-content' );
} else {
	makao_membership_template_part( 'widgets/login-opener', 'templates/logged-out-content' );
}
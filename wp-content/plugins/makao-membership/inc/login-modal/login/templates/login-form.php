<form id="qodef-membership-login-modal-part" class="qodef-m" method="GET">
	<div class="qodef-m-fields">
		<input type="text" class="qodef-m-user-name" name="user_name" placeholder="<?php esc_attr_e( 'User Name *', 'makao-membership' ) ?>" value="" required pattern=".{3,}" autocomplete="username"/>
		<input type="password" class="qodef-m-user-password" name="user_password" placeholder="<?php esc_attr_e( 'Password *', 'makao-membership' ) ?>" required autocomplete="current-password" />
	</div>
	<div class="qodef-m-links">
		<div class="qodef-m-links-remember-me">
			<input type="checkbox" id="qodef-m-links-remember" class="qodef-m-links-remember" name="remember" value="forever" />
			<label for="qodef-m-links-remember" class="qodef-m-links-remember-label"><?php esc_html_e( 'Remember me', 'makao-membership' ) ?></label>
		</div>
		<?php
		$reset_button_params = array(
			'custom_class'  => 'qodef-m-links-reset-password',
			'button_layout' => 'textual',
			'link'          => '#',
			'text'          => esc_html__( 'Lost Your password?', 'makao-membership' )
		);
		
		echo MakaoCoreButtonShortcode::call_shortcode( $reset_button_params ); ?>
	</div>
	<div class="qodef-m-action">
		<?php
		$login_button_params = array(
			'custom_class' => 'qodef-m-action-button',
			'html_type'    => 'submit',
			'text'         => esc_html__( 'Login', 'makao-membership' )
		);
		
		echo MakaoCoreButtonShortcode::call_shortcode( $login_button_params );
		
		makao_membership_template_part( 'login-modal', 'templates/parts/spinner' ); ?>
	</div>
	<?php
	/**
	 * Hook to include additional form content
	 */
	do_action( 'makao_membership_action_login_form_template' );
	
	makao_membership_template_part( 'login-modal', 'templates/parts/response' );
	makao_membership_template_part( 'login-modal', 'templates/parts/hidden-fields', '', array( 'response_type' => 'login' ) ); ?>
</form>
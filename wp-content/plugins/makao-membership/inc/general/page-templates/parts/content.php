<div id="qodef-membership-user-dashboard" class="qodef-m">
	<div class="qodef-m-navigation">
		<?php
		// Include dashboard navigation
		makao_membership_template_part( 'general', 'page-templates/parts/navigation' ); ?>
	</div>
	<div class="qodef-m-content">
		<?php
		//Include dashboard content
		echo makao_membership_get_dashboard_pages(); ?>
	</div>
</div>
<?php
// Include logo
makao_core_get_header_logo_image();

// Include main navigation
makao_core_template_part( 'header', 'templates/parts/navigation' );

// Include widget area one
if ( is_active_sidebar( 'qodef-header-widget-area-one' ) ) { ?>
	<div class="qodef-widget-holder">
		<?php makao_core_get_header_widget_area(); ?>
	</div>
<?php }
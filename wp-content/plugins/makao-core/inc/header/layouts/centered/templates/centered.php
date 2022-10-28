<?php

// Include logo
makao_core_get_header_logo_image();

$header_in_grid = makao_core_get_post_value_through_levels( 'qodef_header_in_grid' );


if( $header_in_grid == 'yes' ){
    $grid_class = 'qodef-content-grid';
}
else{
    $grid_class = '';
}

?>



<div class="qodef-centered-header-wrapper <?php echo esc_html($grid_class); ?>">
	<?php
	// Include widget area two
	if ( is_active_sidebar( 'qodef-header-widget-area-two' ) ) { ?>
		<div class="qodef-widget-holder">
			<?php makao_core_get_header_widget_area( '', 'two' ); ?>
		</div>
	<?php }
	
	// Include main navigation
	makao_core_template_part( 'header', 'templates/parts/navigation' );
	
	// Include widget area one
	if ( is_active_sidebar( 'qodef-header-widget-area-one' ) ) { ?>
		<div class="qodef-widget-holder">
			<?php makao_core_get_header_widget_area(); ?>
		</div>
	<?php } ?>
</div>

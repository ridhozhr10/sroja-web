<?php do_action('makao_action_before_page_header'); ?>

<header id="qodef-page-header">
    <div id="qodef-page-header-inner">
	
	    <?php
	    // Include logo
	    makao_core_get_header_logo_image();
	
	    // Include divided left navigation
		makao_core_template_part( 'header', 'layouts/vertical/templates/navigation' );

         ?>

        <div class="qpdef-vertical-header-widgets">

            <?php
                // Include widget area one
                if ( is_active_sidebar( 'qodef-header-widget-area-one-vertical' ) ) { ?>
                <div class="qodef-vertical-widget-holder-one">
                    <?php makao_core_get_header_widget_area('','one-vertical'); ?>
                </div>
            <?php } ?>

            <?php
                // Include widget area one
                if ( is_active_sidebar( 'qodef-header-widget-area-two-vertical' ) ) { ?>
                    <div class="qodef-vertical-widget-holder-two">
                        <?php makao_core_get_header_widget_area('','two-vertical'); ?>
                    </div>
            <?php } ?>

        </div>
    </div>
</header>


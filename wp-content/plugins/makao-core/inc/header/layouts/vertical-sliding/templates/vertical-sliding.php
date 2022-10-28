<?php do_action( 'makao_action_before_page_header' ); ?>

<header id="qodef-page-header">
	<div id="qodef-page-header-inner">
		<div class="qodef-vertical-sliding-area qodef--static">
			<?php
			// include logo
			makao_core_get_header_logo_image();
			
			// include opener
//			makao_core_get_opener_icon_html( array(
//				'option_name'  => 'vertical_sliding_menu',
//				'custom_class' => 'qodef-vertical-sliding-menu-opener'
//			), true );
			?>
            <a href="javascript:void(0)" class="qodef-opener-icon qodef-m qodef-source--icon-pack qodef-vertical-sliding-menu-opener">
                <div class="qodef-m-icon qodef--open">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="18px" height="13px" viewBox="0 0 18 13" enable-background="new 0 0 18 13" xml:space="preserve">
                            <line fill="none" stroke="#000000" stroke-miterlimit="10" x1="0" y1="0.5" x2="18" y2="0.5"/>
                        <line fill="none" stroke="#000000" stroke-miterlimit="10" x1="0" y1="6.5" x2="18" y2="6.5"/>
                        <line fill="none" stroke="#000000" stroke-miterlimit="10" x1="-0.001" y1="12.5" x2="17.999" y2="12.5"/>
                     </svg>
                </div>
                <div class="qodef-m-icon qodef--close">
                    <?php echo qode_framework_icons()->get_specific_icon_from_pack( 'close', 'linear-icons' ); ?>
                </div>
            </a>
            <?php
			// include widget area one
			if ( is_active_sidebar( 'qodef-header-widget-area-one' ) ) : ?>
				<div class="qodef-vertical-sliding-widget-holder">

				</div>
			<?php endif; ?>
		</div>
		<div class="qodef-vertical-sliding-area qodef--dynamic">
			<?php
			// include logo
			makao_core_get_header_logo_image( array( 'vertical_sliding_logo' => true ) );
			
			// include vertical sliding navigation
			makao_core_template_part( 'header', 'layouts/vertical-sliding/templates/navigation' );
			
			// include widget area two
			if ( is_active_sidebar( 'qodef-header-widget-area-two' ) ) : ?>

			<?php endif; ?>
		</div>
	</div>
</header>
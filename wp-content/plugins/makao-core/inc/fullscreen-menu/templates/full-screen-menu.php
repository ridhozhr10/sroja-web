<?php
$background_image_id = makao_core_get_post_value_through_levels( 'qodef_fullscreen_menu_background_image' );

?>
<div id="qodef-fullscreen-area">
    <div class="qpdef-fullscreen-menu-background-image">
        <?php
            if($background_image_id != '' && !empty($background_image_id)){
                echo wp_get_attachment_image( $background_image_id, 'large');
            }
        ?>
    </div>
	<?php if ( $fullscreen_menu_in_grid ) { ?>
		<div class="qodef-content-grid">
	<?php } ?>
		
		<div id="qodef-fullscreen-area-inner">

			<?php if ( has_nav_menu( 'fullscreen-menu-navigation' ) ) { ?>
				<nav class="qodef-fullscreen-menu">
					<?php wp_nav_menu(
						array(
							'theme_location' => 'fullscreen-menu-navigation',
							'container'         => '',
							'link_before'       => '<span class="qodef-menu-item-text">',
							'link_after'        => '</span>',
							'walker'         => new MakaoCoreRootMainMenuWalker()
						)
					); ?>
				</nav>
			<?php } ?>
		</div>
		
	<?php if ( $fullscreen_menu_in_grid ) { ?>
		</div>
	<?php } ?>
</div>
<?php
$is_enabled = makao_core_get_post_value_through_levels( 'qodef_portfolio_enable_navigation' );
$next_post = get_next_post();
$previous_post = get_previous_post();

if ( $is_enabled === 'yes' ) {
	$through_same_category = makao_core_get_post_value_through_levels( 'qodef_portfolio_navigation_through_same_category' ) === 'yes';
	?>
	<div id="qodef-single-portfolio-navigation" class="qodef-m">
		<div class="qodef-m-inner">
			<?php
			$post_navigation = array(
				'prev'      => array(
					'label' => '<h6 class="qodef-m-nav-label">' . esc_html__( 'Previous', 'makao-core' ) . '</h6>',
					'icon'  => qode_framework_icons()->render_icon( 'lnr-chevron-left', 'linear-icons', array( 'icon_attributes' => array( 'class' => 'qodef-m-nav-icon' ) ) )
				),
				'back-link' => array(),
				'next'      => array(
					'label' => '<h6 class="qodef-m-nav-label">' . esc_html__( 'Next', 'makao-core' ) . '</h6>',
					'icon'  => qode_framework_icons()->render_icon( 'lnr-chevron-right', 'linear-icons', array( 'icon_attributes' => array( 'class' => 'qodef-m-nav-icon' ) ) )
				)
			);
			
			if ( $through_same_category ) {
				if ( get_adjacent_post( true, '', true, 'portfolio-category') !== '' ) {
					$post_navigation['prev']['post'] = get_adjacent_post( true, '', true, 'portfolio-category');
				}
				if ( get_adjacent_post( true, '', false, 'portfolio-category' ) !== '' ) {
					$post_navigation['next']['post'] = get_adjacent_post( true, '', false, 'portfolio-category' );
				}
			} else {
				if ( get_adjacent_post(false, '', true) !== '' ) {
					$post_navigation['prev']['post'] = get_adjacent_post(false, '', true);
				}
				if ( get_adjacent_post(false, '', false) !== '' ) {
					$post_navigation['next']['post'] = get_adjacent_post(false, '', false);
				}
			}
			
			$back_to_link = get_post_meta( get_the_ID(), 'qodef_portfolio_single_back_to_link', true );
			if ( $back_to_link !== '' ) {
				$post_navigation['back-link'] = array(
					'post'    => true,
					'post_id' => $back_to_link,
					'icon'    => qode_framework_icons()->render_icon( 'icon-grid', 'simple-line-icons', array( 'icon_attributes' => array( 'class' => 'qodef-m-nav-icon' ) ) )
				);
			}

			foreach ( $post_navigation as $key => $value ) {
				if ( isset( $post_navigation[ $key ]['post'] ) ) {
					$current_post = $value['post'];
					$post_id      = isset( $value['post_id'] ) && ! empty( $value['post_id'] ) ? $value['post_id'] : $current_post->ID;
					?>
					<a itemprop="url" class="qodef-m-nav qodef--<?php echo esc_attr( $key ); ?>" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
                        <?php

                                if($key == 'prev'){
                                    echo get_the_post_thumbnail($previous_post->ID, array( 80, 80));
                                } elseif ($key == 'next') {
                                    echo get_the_post_thumbnail($next_post->ID, array( 80, 80));
                                }

                        ?>
                        <div class="qoded-navigation-text-holder">
                            <?php if($key == 'prev') : ?>
                                <?php echo '<h5 class="qodef-m-nav-post-title">' . esc_html( get_the_title($previous_post->ID) ) . '</h5>' ?>
                            <?php endif; ?>
                            <?php if($key == 'next') : ?>
                                <?php echo '<h5 class="qodef-m-nav-post-title">' . esc_html( get_the_title($next_post->ID) ) . '</h5>' ?>
                            <?php endif; ?>
                            <div class="qodef-m-nav-label-holder">
                                <?php if ( ! empty( $value['icon'] ) ) {
                                    echo wp_kses( $value['icon'], array( 'span' => array( 'class' => true ), 'h5' => array('class' => true), 'h6' => array('class' => true) ) );
                                } ?>
                                <?php if ( ! empty( $value['label'] ) ) {
                                    echo wp_kses( $value['label'], array( 'span' => array( 'class' => true ), 'h5' => array('class' => true), 'h6' => array('class' => true) ) );
                                } ?>
                            </div>
                        </div>
					</a>
				<?php }
			}
			?>
		</div>
	</div>
<?php } ?>
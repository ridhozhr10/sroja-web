<?php

if ( ! function_exists( 'makao_core_add_author_info_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function makao_core_add_author_info_widget( $widgets ) {
		$widgets[] = 'MakaoCoreAuthorInfoWidget';
		
		return $widgets;
	}
	
	add_filter( 'makao_core_filter_register_widgets', 'makao_core_add_author_info_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class MakaoCoreAuthorInfoWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$this->set_base( 'makao_core_author_info' );
			$this->set_name( esc_html__( 'Makao Author Info', 'makao-core' ) );
			$this->set_description( esc_html__( 'Add author info element into widget areas', 'makao-core' ) );
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'author_username',
					'title'      => esc_html__( 'Author Username', 'makao-core' )
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'color',
					'name'       => 'author_color',
					'title'      => esc_html__( 'Author Color', 'makao-core' )
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'iconpack',
					'name'       => 'icon_pack_author',
					'title'      => esc_html__( 'Author Icon', 'makao-core' )
				)
			);
		}
		
		public function render( $atts ) {
			$author_id = 1;
			if ( ! empty( $atts['author_username'] ) ) {
				$author = get_user_by( 'login', $atts['author_username'] );
				
				if ( ! empty( $author ) ) {
					$author_id = $author->ID;
				}
			}
			
			$author_link = get_author_posts_url( $author_id );
			$author_bio  = get_the_author_meta( 'description', $author_id );
            $user_socials  = makao_core_get_author_social_networks( $author_id );
			?>
			<div class="widget qodef-author-info">
				<a itemprop="url" class="qodef-author-info-image" href="<?php echo esc_url( $author_link ); ?>">
					<?php echo get_avatar( $author_id, 299 ); ?>
				</a>
				<?php if ( ! empty( $author_bio ) ) { ?>
					<p itemprop="description" class="qodef-author-info-description"><?php echo esc_html( $author_bio ); ?></p>

                    <?php if ( ! empty( $user_socials ) ) { ?>
                        <div class="qodef-m-social-icons">
                            <?php foreach ( $user_socials as $social ) { ?>
                                <a itemprop="url" class="<?php echo esc_attr( $social['class'] ) ?>" href="<?php echo esc_url( $social['url'] ) ?>" target="_blank">
                                    <span class="qodef-social-network-text"><?php echo get_icon_text_string($social['icon']); ?></span>
                                </a>
                            <?php } ?>
                        </div>
                    <?php } ?>
				<?php } ?>
			</div>
			<?php
		}
	}
}

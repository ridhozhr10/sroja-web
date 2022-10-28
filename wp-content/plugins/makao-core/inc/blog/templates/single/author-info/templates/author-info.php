<?php
$is_enabled = makao_core_get_post_value_through_levels( 'qodef_blog_single_enable_author_info' );

if ( $is_enabled === 'yes' && get_the_author_meta( 'description' ) !== '' ) {
	$author_id     = get_the_author_meta('ID');
	$author_link   = get_author_posts_url( $author_id );
	$email_enabled = makao_core_get_post_value_through_levels( 'qodef_blog_single_enable_author_info_email' ) === 'yes';
	$user_socials  = makao_core_get_author_social_networks( $author_id );
	?>
	<div id="qodef-author-info" class="qodef-m">
		<div class="qodef-m-inner">
			<div class="qodef-m-image">
				<a itemprop="url" href="<?php echo esc_url( $author_link ); ?>">
					<?php echo get_avatar( $author_id, 140 ); ?>
				</a>
			</div>
			<div class="qodef-m-content">
				<h4 class="qodef-m-author vcard author">
					<a itemprop="url" href="<?php echo esc_url( $author_link ); ?>">
						<span class="fn"><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></span>
					</a>
				</h4>
				<?php if ( $email_enabled && is_email( get_the_author_meta( 'email' ) ) ) { ?>
					<p itemprop="email" class="qodef-m-email"><?php echo sanitize_email( get_the_author_meta( 'email' ) ); ?></p>
				<?php } ?>
				<p itemprop="description" class="qodef-m-description"><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></p>
				<?php if ( ! empty( $user_socials ) ) { ?>
					<div class="qodef-m-social-icons">
						<?php foreach ( $user_socials as $social ) { ?>
							<a itemprop="url" class="<?php echo esc_attr( $social['class'] ) ?>" href="<?php echo esc_url( $social['url'] ) ?>" target="_blank">
                                <span class="qodef-social-network-text"><?php echo get_icon_text_string($social['icon']); ?></span>
							</a>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } ?>
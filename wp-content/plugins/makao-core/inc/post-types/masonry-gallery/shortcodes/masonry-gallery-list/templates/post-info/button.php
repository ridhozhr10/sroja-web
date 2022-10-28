<?php
$link = get_post_meta( get_the_ID(), 'qodef_masonry_gallery_item_link', true );

if ( ! empty( $link ) && class_exists( 'MakaoCoreButtonShortcode' ) ) {
	$button_label = get_post_meta( get_the_ID(), 'qodef_masonry_gallery_item_button_label', true );
	$link_target  = get_post_meta( get_the_ID(), 'qodef_masonry_gallery_item_link_target', true );
	?>
	<div class="qodef-e-button">
		<?php
		$button_params = array(
			'button_layout' => 'textual',
			'link'          => $link,
			'link_target'   => $link_target,
			'text'          => ! empty( $button_label ) ? $button_label : esc_html__( 'Read More', 'makao-core' )
		);
		
		echo MakaoCoreButtonShortcode::call_shortcode( $button_params ); ?>
	</div>
<?php } ?>
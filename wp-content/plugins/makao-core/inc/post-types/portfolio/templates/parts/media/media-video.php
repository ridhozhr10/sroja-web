<?php

if ( isset( $media ) && ! empty( $media ) ) {
	$settings = apply_filters( 'makao_core_filter_portfolio_video_format_settings', array(
		'width'  => 1100,
		'height' => 684,
		'loop'   => true
	) );
	
	$wrapped_start = '';
	$wrapped_end   = '';
	
	if ( isset( $media_type ) && $media_type === 'gallery' ) {
		$wrapped_start = '<div class="qodef-grid-item">';
		$wrapped_end   = '</div>';
	}
	
	echo sprintf( '%s%s%s', $wrapped_start, wp_video_shortcode( array_merge( array( 'src' => esc_url( $media ) ), $settings ) ), $wrapped_end );
}
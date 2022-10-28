<?php
$portfolio_media = get_post_meta( get_the_ID(), 'qodef_portfolio_media', true );

if ( ! empty ( $portfolio_media ) ) {
	foreach ( $portfolio_media as $media ) {
		$type            = $media['qodef_portfolio_media_type'];
		$params          = array();
		$media_name      = 'qodef_portfolio_' . $type;
		$params['media'] = $media[ $media_name ];
		
		makao_core_template_part( 'post-types/portfolio', 'templates/parts/media/media', $type . '-slide', $params );
	}
}
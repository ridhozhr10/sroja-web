<?php

if ( ! function_exists( 'makao_core_social_networks_list' ) ) {
	/**
	 * Function that returns array of social networks.
	 *
	 * @return array - list of social networks
	 */
	function makao_core_social_networks_list() {
		$social_networks = array(
			'facebook'  => array(
				'label'   => esc_html__( 'Facebook', 'makao-core' ),
				'shorten' => esc_html__( 'fb', 'makao-core' )
			),
			'twitter'   => array(
				'label'   => esc_html__( 'Twitter', 'makao-core' ),
				'shorten' => esc_html__( 'tw', 'makao-core' )
			),
			'linkedin'  => array(
				'label'   => esc_html__( 'LinkedIn', 'makao-core' ),
				'shorten' => esc_html__( 'in', 'makao-core' )
			),
			'pinterest' => array(
				'label'   => esc_html__( 'Pinterest', 'makao-core' ),
				'shorten' => esc_html__( 'pi', 'makao-core' )
			),
			'tumblr'    => array(
				'label'   => esc_html__( 'Tumblr', 'makao-core' ),
				'shorten' => esc_html__( 'tm', 'makao-core' )
			),
			'vk'        => array(
				'label'   => esc_html__( 'VK', 'makao-core' ),
				'shorten' => esc_html__( 'vk', 'makao-core' )
			)
		);

		return apply_filters( 'makao_core_filter_social_networks_list', $social_networks );
	}
}

if ( ! function_exists( 'makao_core_enabled_social_networks_list' ) ) {
	/**
	 * Function that returns array of social networks.
	 *
	 * @return array - list of social networks
	 */
	function makao_core_enabled_social_networks_list() {
		$social_networks = makao_core_social_networks_list();

		foreach ( $social_networks as $network => $label ) {
			$network_enabled = makao_core_get_option_value( 'admin', 'qodef_enable_share_' . $network ) == 'yes';

			if ( ! $network_enabled ) {
				unset( $social_networks[ $network ] );
			}
		}

		return $social_networks;
	}
}

if ( ! function_exists( 'makao_core_get_social_network_share_link' ) ) {
	/**
	 * Get share link for networks
	 *
	 * @param $net
	 * @param $image
	 *
	 * @return string
	 */
	function makao_core_get_social_network_share_link( $net, $image ) {
		switch ( $net ) {
			case 'facebook':
				if ( wp_is_mobile() ) {
					$link = 'window.open(\'https://m.facebook.com/sharer.php?u=' . urlencode( get_permalink() ) . '\');';
				} else {
					$link = 'window.open(\'https://www.facebook.com/sharer.php?u=' . urlencode( get_permalink() ) . '\', \'sharer\', \'toolbar=0,status=0,width=620,height=280\');';
				}
				break;
			case 'twitter':
				$count_char             = is_ssl() ? 23 : 22;
				$twitter_via_option_val = makao_core_get_option_value( 'admin', 'qodef_twitter_via' );
				$twitter_via            = $twitter_via_option_val !== '' ? esc_attr__( ' via ', 'makao-core' ) . esc_attr( $twitter_via_option_val ) : '';
				$link                   = 'window.open(\'https://twitter.com/intent/tweet?text=' . urlencode( makao_core_get_social_network_excerpt_max_charlength( $count_char ) . $twitter_via ) . get_permalink() . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');';
				break;
			case 'linkedin':
				$link = 'popUp=window.open(\'https://linkedin.com/shareArticle?mini=true&amp;url=' . urlencode( get_permalink() ) . '&amp;title=' . urlencode( get_the_title() ) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			case 'tumblr':
				$link = 'popUp=window.open(\'https://www.tumblr.com/share/link?url=' . urlencode( get_permalink() ) . '&amp;name=' . urlencode( get_the_title() ) . '&amp;description=' . urlencode( get_the_excerpt() ) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			case 'pinterest':
			    if( is_array( $image ) && count( $image ) ) {
                    $link = 'popUp=window.open(\'https://pinterest.com/pin/create/button/?url=' . urlencode(get_permalink()) . '&amp;description=' . urlencode(get_the_title()) . '&amp;media=' . urlencode($image[0]) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                } else{
                    $link = 'popUp=window.open(\'https://pinterest.com/pin/create/button/?url=' . urlencode(get_permalink()) . '&amp;description=' . urlencode(get_the_title()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                }
			    break;
			case 'vk':
                if( is_array( $image ) && count( $image ) ) {
                    $link = 'popUp=window.open(\'https://vkontakte.ru/share.php?url=' . urlencode(get_permalink()) . '&amp;title=' . urlencode(get_the_title()) . '&amp;description=' . urlencode(get_the_excerpt()) . '&amp;image=' . urlencode($image[0]) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                } else{
                    $link = 'popUp=window.open(\'https://vkontakte.ru/share.php?url=' . urlencode(get_permalink()) . '&amp;title=' . urlencode(get_the_title()) . '&amp;description=' . urlencode(get_the_excerpt()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                }
                break;
			default:
				$link = '';
		}

		return apply_filters( 'makao_core_filter_social_network_share_link', $link, $net, $image );
	}
}

if ( ! function_exists( 'makao_core_get_social_network_excerpt_max_charlength' ) ) {
	function makao_core_get_social_network_excerpt_max_charlength( $charlength ) {
		$twitter_via_meta = makao_core_get_option_value( 'admin', 'qodef_twitter_via' );
		$via              = ! empty( $twitter_via_meta ) ? esc_attr__( ' via ', 'makao-core' ) . esc_attr( $twitter_via_meta ) : '';

		$excerpt_text = get_the_excerpt();
		$excerpt      = esc_html( strip_shortcodes( $excerpt_text ) );
		$charlength   = 139 - ( mb_strlen( $via ) + $charlength );

		if ( mb_strlen( $excerpt ) > $charlength ) {
			$subex   = mb_substr( $excerpt, 0, $charlength );
			$exwords = explode( ' ', $subex );
			$excut   = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );

			if ( $excut < 0 ) {
				return mb_substr( $subex, 0, $excut );
			} else {
				return $subex;
			}
		} else {
			return $excerpt;
		}
	}
}

if ( ! function_exists( 'makao_core_include_social_share_shortcodes' ) ) {
	/**
	 * Function that includes shortcodes
	 */
	function makao_core_include_social_share_shortcodes() {
		foreach ( glob( MAKAO_CORE_INC_PATH . '/social-share/shortcodes/*/include.php' ) as $shortcode ) {
			include_once $shortcode;
		}
	}

	add_action( 'qode_framework_action_before_shortcodes_register', 'makao_core_include_social_share_shortcodes' );
}

if ( ! function_exists( 'makao_core_include_social_share_widgets' ) ) {
	/**
	 * Function that includes widgets
	 */
	function makao_core_include_social_share_widgets() {
		foreach ( glob( MAKAO_CORE_INC_PATH . '/social-share/shortcodes/*/widget/include.php' ) as $widget ) {
			include_once $widget;
		}
	}

	add_action( 'qode_framework_action_before_widgets_register', 'makao_core_include_social_share_widgets' );
}

if ( ! function_exists( 'get_icon_text_string' ) ) {

    function get_icon_text_string($string){
        $icons = array();

        $icons ['social_facebook'] = 'fb';
        $icons ['social_twitter'] = 'tw';
        $icons ['social_linkedin'] = 'ln';
        $icons ['social_instagram'] = 'in';
        $icons ['social_pinterest'] = 'pi';

        return $icons[$string];

    }
}
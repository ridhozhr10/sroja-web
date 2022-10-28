<?php

if ( ! function_exists( 'makao_str_split_unicode' ) ) {
	function makao_str_split_unicode( $str ) {
		return preg_split( '~~u', html_entity_decode( $str ), - 1, PREG_SPLIT_NO_EMPTY );
	}
}

if ( ! function_exists( 'makao_get_split_text' ) ) {
	function makao_get_split_text( $text ) {
		if ( ! empty( $text ) ) {
			$split_text = makao_str_split_unicode( $text );
			
			foreach ( $split_text as $key => $value ) {
				$split_text[ $key ] = '<span class="qodef-e-character">' . $value . '</span>';
			}
			
			return implode( ' ', $split_text );
		}
		
		return $text;
	}
}
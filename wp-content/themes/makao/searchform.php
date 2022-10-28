<?php
// Unique ID for search form fields
$qodef_unique_id = uniqid( 'qodef-search-form-' );
?>
<form role="search" method="get" class="qodef-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $qodef_unique_id ); ?>" class="screen-reader-text"><?php esc_html_e( 'Search for:', 'makao' ); ?></label>
	<div class="qodef-search-form-inner clear">
		<input type="search" id="<?php echo esc_attr( $qodef_unique_id ); ?>" class="qodef-search-form-field" value="" required name="s" placeholder="<?php esc_attr_e( 'Search', 'makao' ); ?>" />
		<button type="submit" class="qodef-search-form-button"><?php makao_render_icon( 'qodef-icon-linear-icons lnr-chevron-right', 'linear-icons', esc_html__( 'GO', 'makao' ) ); ?></button>
	</div>
</form>
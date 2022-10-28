<footer id="qodef-page-footer" <?php makao_class_attribute( implode( ' ', apply_filters( 'makao_filter_footer_holder_classes', array() ) ) ); ?>>
	<?php
	// Hook to include additional content before page footer content
	do_action( 'makao_action_before_page_footer_content' );
	
	// Include module content template
	echo apply_filters( 'makao_filter_footer_content_template', makao_get_template_part( 'footer', 'templates/footer-content' ) );
	
	// Hook to include additional content after page footer content
	do_action( 'makao_action_after_page_footer_content' );
	?>
</footer>
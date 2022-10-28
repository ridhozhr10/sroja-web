<div class="qodef-grid-item <?php echo esc_attr( makao_get_page_content_sidebar_classes() ); ?>">
	<div class="qodef-search qodef-m">
		<?php
		// Include search form
		makao_template_part( 'search', 'templates/parts/search-form' );
		
		// Include posts loop
		makao_template_part( 'search', 'templates/parts/loop' );
		
		// Include pagination
		makao_template_part( 'pagination', 'templates/pagination-wp' );
		?>
	</div>
</div>
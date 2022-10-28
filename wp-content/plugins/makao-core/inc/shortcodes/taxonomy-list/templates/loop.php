<?php

if ( $query_result->terms ) {
	foreach ( $query_result->terms as $term ) {
		$params['term_id']     = $term->term_id;
		$params['term_name']   = $term->name;
		$params['description'] = $term->description;
		$params['term_link']   = get_term_link( $term );
		
		$params['image_dimension'] = $this_shortcode->get_list_item_image_dimension( $params );
		$params['item_classes']    = $this_shortcode->get_item_classes( $params );
		
		if ( $params['additional_params'] !== '' ) {
			$exploded_ids = explode( ',', $params['taxonomy_ids'] );
			foreach ( $exploded_ids as $taxonomy_id ) {
				if ( intval( $taxonomy_id ) === $params['term_id'] ) {
					// Include post item
					makao_core_template_part( 'shortcodes/taxonomy-list', 'variations/' . $layout . '/templates/' . $layout, '', $params );
				}
			}
		} else {
			makao_core_template_part( 'shortcodes/taxonomy-list', 'variations/' . $layout . '/templates/' . $layout, '', $params );
		}
	}
} else {
	// Include global posts not found
	makao_core_theme_template_part( 'content', 'templates/parts/posts-not-found' );
}
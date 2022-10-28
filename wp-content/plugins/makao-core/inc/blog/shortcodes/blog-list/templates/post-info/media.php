<div class="qodef-e-media">
	<?php switch ( get_post_format() ) {
		case 'gallery':
			makao_core_theme_template_part( 'blog', 'templates/parts/post-format/gallery' );
			break;
		case 'video':
			makao_core_theme_template_part( 'blog', 'templates/parts/post-format/video' );
			break;
		case 'audio':
			makao_core_theme_template_part( 'blog', 'templates/parts/post-format/audio' );
			break;
		default:
			makao_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/image' );
			break;
	} ?>
</div>
<div class="qodef-e-media">
	<?php switch ( get_post_format() ) {
		case 'gallery':
			makao_template_part( 'blog', 'templates/parts/post-format/gallery' );
			break;
		case 'video':
			makao_template_part( 'blog', 'templates/parts/post-format/video' );
			break;
		case 'audio':
			makao_template_part( 'blog', 'templates/parts/post-format/audio' );
			break;
		default:
			makao_template_part( 'blog', 'templates/parts/post-info/image' );
			break;
	} ?>
</div>
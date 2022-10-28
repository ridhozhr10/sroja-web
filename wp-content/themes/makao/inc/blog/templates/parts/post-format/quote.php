<?php
$quote_meta = get_post_meta( get_the_ID(), 'qodef_post_format_quote_text', true );
$quote_text = ! empty( $quote_meta ) ? $quote_meta : get_the_title();

if ( ! empty( $quote_text ) ) {
	$quote_author     = get_post_meta( get_the_ID(), 'qodef_post_format_quote_author', true );
	$title_tag        = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h3';
	$author_title_tag = isset( $author_title_tag ) && ! empty( $author_title_tag ) ? $author_title_tag : 'span';
	?>
	<div class="qodef-e-quote">
    <div class="qodef-e-quote-svg">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             width="229.667px" height="187px" viewBox="0 0 229.667 187" enable-background="new 0 0 229.667 187" xml:space="preserve">
        <path fill="none" stroke="#000000" d="M10.98,185.813v-12.199c21.436-9.243,37.011-21.208,46.717-35.902
            c9.702-14.695,14.557-29.712,14.557-45.051c0-3.147-0.654-5.545-1.943-7.209c-1.294-1.479-2.592-2.218-3.881-2.218
            c-1.109,0-2.772,0.649-4.991,1.941c-5.364,3.142-12.018,4.713-19.961,4.713c-10.909,0-20.376-4.251-28.418-12.753
            C5.021,68.634,1,58.653,1,47.189c0-12.199,4.617-22.915,13.862-32.16C24.099,5.789,35.283,1.167,48.411,1.167
            c15.895,0,29.477,6.146,40.751,18.438c11.271,12.293,16.914,29.155,16.914,50.598c0,26.432-8.001,49.904-23.982,70.42
            C66.109,161.137,42.401,176.201,10.98,185.813z M133.215,185.813v-12.199c21.436-9.243,37.011-21.208,46.716-35.902
            c9.706-14.695,14.557-29.712,14.557-45.051c0-3.147-0.653-5.545-1.942-7.209c-1.293-1.479-2.593-2.218-3.882-2.218
            c-1.11,0-2.771,0.649-4.989,1.941c-5.365,3.142-12.02,4.713-19.963,4.713c-10.909,0-20.376-4.251-28.418-12.753
            c-8.037-8.5-12.06-18.48-12.06-29.944c0-12.199,4.616-22.915,13.864-32.16c9.236-9.241,20.422-13.862,33.547-13.862
            c15.895,0,29.479,6.146,40.753,18.438c11.269,12.293,16.913,29.155,16.913,50.598c0,26.432-8.001,49.904-23.982,70.42
            C188.338,161.137,164.635,176.201,133.215,185.813z"/>
        </svg>
    </div>
		<<?php echo esc_attr( $title_tag ); ?> class="qodef-e-quote-text"><?php echo esc_html( $quote_text ); ?></<?php echo esc_attr( $title_tag ); ?>>
		<?php if ( ! empty( $quote_author ) ) { ?>
			<<?php echo esc_attr( $author_title_tag ); ?> class="qodef-e-quote-author"><?php echo esc_html( $quote_author ); ?></<?php echo esc_attr( $author_title_tag ); ?>>
		<?php } ?>
		<?php if ( ! is_single() ) { ?>
			<a itemprop="url" class="qodef-e-quote-url" href="<?php the_permalink(); ?>"></a>
		<?php } ?>
	</div>
<?php } ?>
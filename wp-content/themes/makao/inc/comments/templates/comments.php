<div id="qodef-page-comments">
	<?php if ( have_comments() ) {
		$comments_number = get_comments_number();
		?>
		<div id="qodef-page-comments-list" class="qodef-m">
			<h4 class="qodef-m-title"><?php echo sprintf( _n( '%s Comment', '%s Comments', $comments_number, 'makao' ), $comments_number ); ?></h4>
			<ul class="qodef-m-comments">
				<?php wp_list_comments( array_unique( array_merge( array( 'callback' => 'makao_get_comments_list_template' ), apply_filters( 'makao_filter_comments_list_template_callback', array() ) ) ) ); ?>
			</ul>
			
			<?php if ( get_comment_pages_count() > 1 ) { ?>
				<div class="qodef-m-pagination qodef--wp">
					<?php the_comments_pagination( array(
						'prev_text'          => makao_get_icon( 'arrow_carrot-left', 'elegant-icons', esc_html__( '< Prev', 'makao' ) ),
						'next_text'          => makao_get_icon( 'arrow_carrot-right', 'elegant-icons', esc_html__( 'Next >', 'makao' ) ),
						'before_page_number' => '0',
					) ); ?>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
		<p class="qodef-page-comments-not-found"><?php esc_html_e( 'Comments are closed.', 'makao' ); ?></p>
	<?php } ?>

    <div id="qodef-page-comments-form">
        <?php
        $qodef_commenter = wp_get_current_commenter();
        $qodef_req       = get_option( 'require_name_email' );
        $qodef_aria_req  = ( $qodef_req ? " aria-required='true'" : '' );
        $qodef_consent   = empty( $qodef_commenter['comment_author_email'] ) ? '' : ' checked="checked"';

        $args = array(
            'id_form'              => 'commentform',
            'id_submit'            => 'submit_comment',
            'title_reply'          => esc_html__( 'Post a comment', 'makao' ),
            'title_reply_before'   => '<h4 id="reply-title" class="comment-reply-title">',
            'title_reply_after'    => '</h4>',
            'title_reply_to'       => esc_html__( 'Post a Reply to %s', 'makao' ),
            'cancel_reply_link'    => esc_html__( 'cancel reply', 'makao' ),
            'label_submit'         => esc_html__( 'Send', 'makao' ),
            'comment_field'        => apply_filters( 'makao_filter_comment_form_textarea_field', '<textarea id="comment" placeholder="' . esc_attr__( 'Type your comment here...', 'makao' ) . '" name="comment" cols="45" rows="6" aria-required="true"></textarea>' ),
            'comment_notes_before' => '',
            'comment_notes_after'  => '',
            'fields'               => apply_filters( 'makao_filter_comment_form_default_fields', array(
                'author' => '<div class="qodef-grid qodef-responsive--predefined qodef-layout--columns qodef-col-num--1 qodef-gutter--no"><div class="qodef-grid-inner clear"><div class="qodef-grid-item"><input id="author" name="author" placeholder="' . esc_attr__( 'Name', 'makao' ) . '" type="text" value="' . esc_attr( $qodef_commenter['comment_author'] ) . '" ' . $qodef_aria_req . ' /></div>',
                'email'  => '<div class="qodef-grid-item"><input id="email" name="email" placeholder="' . esc_attr__( 'E-mail', 'makao' ) . '" type="text" value="' . esc_attr( $qodef_commenter['comment_author_email'] ) . '" ' . $qodef_aria_req . ' /></div></div></div>',
                'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" ' . $qodef_consent . ' />' .
                    '<label for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'makao' ) . '</label></p>',
            ) ),
            'submit_button'         => '<button name="%1$s" type="submit" id="submit" class="%3$s" value="%4$s"><span class="qodef-btn-text">'.esc_attr__('Post a comment', 'makao' ).'</span></button>',
            'class_submit'          => 'submit qodef-btn qodef-btn-lare qodef-btn-outlined qodef-btn-with-prefix',
        );

        comment_form( apply_filters( 'makao_filter_comment_form_args', $args ) ); ?>
    </div>
</div>
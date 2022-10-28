<div class="qodef-e qodef-info--date">
	<h5 class="qodef-e-title"><?php esc_html_e( 'Date: ', 'makao-core' ); ?></h5>
	<h6 itemprop="dateCreated" class="entry-date updated"><?php the_time( get_option( 'date_format' ) ); ?></h6>
	<meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number( get_the_ID() ); ?>"/>
</div>
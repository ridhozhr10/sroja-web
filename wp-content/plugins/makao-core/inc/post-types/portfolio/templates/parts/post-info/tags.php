<?php
$tags = wp_get_post_terms( get_the_ID(), 'portfolio-tag');

if ( is_array( $tags ) && count( $tags ) ) { ?>
    <div class="qodef-e qodef-info--tags">
        <h5 class="qodef-e-title"><?php esc_html_e( 'Tags: ', 'makao-core' ); ?></h5>
        <h6 class="qodef-e-categories">
            <?php foreach ( $tags as $tag ) { ?>
                <a itemprop="url" class="qodef-e-category" href="<?php echo esc_url( get_term_link( $tag->term_id ) ); ?>">
                    <span><?php echo esc_html( $tag->name ); ?></span>
                </a>
            <?php } ?>
        </h6>
    </div>
<?php }
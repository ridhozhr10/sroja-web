<?php if ( ! empty( $video_link ) ) { ?>
	<a itemprop="url" class="qodef-m-play qodef-magnific-popup qodef-popup-item" <?php echo qode_framework_get_inline_style( $play_button_styles ); ?> href="<?php echo esc_url( $video_link ); ?>" data-type="iframe">
		<span class="qodef-m-play-inner">
            <svg version="1.1" x="0px" y="0px" width="50px" height="50px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve">
			    <polygon points="17,15 35,25 17,35 "/>
                <rect height="50" width="50" />
            </svg>
            <span class="qodef-initial-border"></span>
            <span class="qodef-top-border"></span>
            <span class="qodef-right-border"></span>
            <span class="qodef-bottom-border"></span>
            <span class="qodef-left-border"></span>
        </span>
	</a>
<?php } ?>
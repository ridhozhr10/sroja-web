<?php if( $button == 'yes') { ?>
    <div class="qodef-e-st-button">
        <?php
            $button_params = array(
                'button_layout' => $button_style,
                'text'          => $button_text,
                'link'          => $button_link,
                'target'        => $button_link_target,
                'margin'        => $button_margin
            );

            echo MakaoCoreButtonShortcode::call_shortcode( $button_params );
        ?>
    </div>
<?php } ?>
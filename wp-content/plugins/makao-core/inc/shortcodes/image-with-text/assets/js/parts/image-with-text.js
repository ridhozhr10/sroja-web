(function ($) {
    "use strict";

    qodefCore.shortcodes.makao_core_image_with_text = {};

    $(document).ready(function () {
        qodefImageWithText.init();
    });

    var qodefImageWithText = {
        init: function () {
            var $holder = $('.qodef-image-with-text');

            if ( $holder.length ) {
                $holder.each(function () {
                    var $thisHolder = $(this);

                    qodefImageWithText.scrollAnimation( $thisHolder );
                });
            }
        },
        scrollAnimation: function ( $thisHolder ) {
            if ( $thisHolder.hasClass('qodef-image-action--scrolling-image') ) {
                var $imageHolder = $thisHolder.find('.qodef-m-image'),
                    $frame = $thisHolder.find('.qodef-m-frame'),
                    $frameHeight,
                    $frameWidth,
                    $image = $thisHolder.find('.qodef-m-image-holder-inner > a > img, .qodef-m-image-holder-inner > img'),
                    $imageHeight,
                    $imageWidth,
                    $delta,
                    $timing,
                    $scrollable = false,
                    $horizontal = $thisHolder.hasClass('qodef-scrolling--horizontal');

                var setSize = function() {
                    $frameHeight = $frame.height();
                    $imageHeight = $image.height();
                    $frameWidth  = $frame.width();
                    $imageWidth  = $image.width();

                    if ( $horizontal ) {
                        $delta = Math.round($imageWidth - $frameWidth);
                        $timing = Math.round($imageWidth / $frameWidth) * 2;
                    } else {
                        $delta = Math.round($imageHeight - $frameHeight);
                        $timing = Math.round($imageHeight / $frameHeight) * 2;
                    }

                    if ( $horizontal ) {
                        if ( $imageWidth > $frameWidth ) {
                            $scrollable = true;
                        }
                    } else {
                        if ( $imageHeight > $frameHeight ) {
                            $scrollable = true;
                        }
                    }
                };

                var initAnimation = function() {
                    $imageHolder.on('mouseenter', function() {
                        $image.css('transition-duration', $timing + 's');

                        if ( $horizontal ) {
                            $image.css('transform', 'translate3d(-' + $delta + 'px, 0px, 0px)');
                        } else {
                            $image.css('transform', 'translate3d(0px, -' + $delta + 'px, 0px)');
                        }});

                    $imageHolder.on('mouseleave', function() {
                        if ( $scrollable ) {
                            $image.css('transition-duration', Math.min($timing / 3, 3) + 's');
                            $image.css('transform', 'translate3d(0px, 0px, 0px)');
                        }
                    });
                };

                $thisHolder.waitForImages( function() {
                    $thisHolder.css('visibility', 'visible');
                    setSize();
                    initAnimation();
                });

                $(window).resize(function(){
                    setSize();
                });
            }
        }
    };

    qodefCore.shortcodes.makao_core_image_with_text.qodefImageWithText = qodefImageWithText;

})(jQuery);
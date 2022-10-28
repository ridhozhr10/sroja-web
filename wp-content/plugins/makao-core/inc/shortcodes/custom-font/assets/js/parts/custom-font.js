(function ($) {
    "use strict";

    qodefCore.shortcodes.makao_core_custom_font = {};

    $(document).ready(function () {
        qodefCustomFont.init();
    });

    var qodefCustomFont = {
        init: function () {
            var $holder = $('.qodef-custom-font');

            if ( $holder ) {
                $holder.each(function () {
                    var $thisHolder = $(this);

                    qodefCustomFont.initAnimation( $thisHolder );
                });
            }
        },
        initAnimation: function ( $thisHolder ) {
            if ( $thisHolder.hasClass('qodef-appear-animation') ) {
                var $textContent = $thisHolder.text().trim(),
                    $textArray = $textContent.split(''),
                    $textArrayLength = $textArray.length - 1;

                $thisHolder.empty();

                $textArray.forEach(function ($item, $index) {
                    if ($item === ' ') {
                        $thisHolder.append('<span class="qodef-m-char qodef--empty-char">' + $item + '</span>')
                    } else {
                        $thisHolder.append('<span class="qodef-m-char">' + $item + '</span>')
                    }

                    if ($index === $textArrayLength) {
                        setTimeout(function () {
                            $thisHolder.addClass('qodef-custom-font--animated');

                            qodefCustomFont.initAppear($thisHolder);
                        }, 500);
                    }
                });
            }
        },
        initAppear: function ( $thisHolder ) {
            var appearOffsetY = 50;

            if ( $thisHolder.offset().top > qodef.windowHeight * .8 && $thisHolder.offset().top < qodef.windowHeight * 2 ) {
                appearOffsetY = -200;
            }

            $thisHolder.appear(function () {
                $thisHolder.find('.qodef-m-char:not(.qodef--empty-char)').each( function ($i) {
                    var $thisItem = $(this);

                    setTimeout(function () {
                        $thisItem.addClass('qodef--show');
                    }, $i * 100);
                });
            }, { accX: 0, accY: appearOffsetY });
        }
    };

    qodefCore.shortcodes.makao_core_custom_font.qodefCustomFont = qodefCustomFont;

})(jQuery);
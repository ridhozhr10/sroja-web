(function ($) {
    "use strict";

    qodefCore.shortcodes.makao_core_alternating_banner = {};

    $(document).ready(function () {
        qodefAlternatingBanner.init();
    });

    var qodefAlternatingBanner = {
        init: function () {
            var $holder = $('.qodef-alternating-banner');

            if ( $holder.length ) {
                $holder.each(function () {
                    var $thisHolder = $(this);

                    qodefAlternatingBanner.appearAnimation( $thisHolder );
                });
            }
        },
        appearAnimation: function ( $thisHolder ) {

            if ( $thisHolder.hasClass('qodef-appear-animation') ) {
                $thisHolder.appear(function() {
                    $thisHolder.addClass('qodef-appear');
                }, { accX: 0, accY: -200 });
            }
        }
    };

    qodefCore.shortcodes.makao_core_alternating_banner.qodefAlternatingBanner = qodefAlternatingBanner;

})(jQuery);
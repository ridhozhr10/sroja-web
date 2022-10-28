(function ($) {
    "use strict";

    qodefCore.shortcodes.makao_core_section_title = {};

    $(document).ready(function () {
        qodefSectionTitle.init();
    });

    var qodefSectionTitle = {
        init: function () {
            var $holder = $('.qodef-section-title');

            if ( $holder.length ) {
                $holder.each(function () {
                    var $thisHolder = $(this);

                    qodefSectionTitle.appearAnimation( $thisHolder );
                });
            }
        },
        appearAnimation: function ( $thisHolder ) {

            if ( $thisHolder.hasClass('qodef-appear-animation') ) {
                $thisHolder.appear(function() {
                    $thisHolder.addClass('qodef-appear');
                }, { accX: 0, accY: 0 });
            }
        }
    };

    qodefCore.shortcodes.makao_core_section_title.qodefSectionTitle = qodefSectionTitle;


})(jQuery);
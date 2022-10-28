(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefZoomOut.init();
    });

    $(document).on('masterds_theme_trigger_get_new_posts', function () {
        qodefZoomOut.init();
    });

    var qodefZoomOut = {
        init: function () {
            var $gallery = $('.qodef-hover-animation--zoom-out');

            if ( $gallery.length ) {
                $gallery.each(function () {
                    var $thisGallery = $(this),
                        $galleryItem = $thisGallery.find('article');

                    if ( $galleryItem.length ) {
                        $galleryItem.each( function() {
                            var $thisItem = $(this),
                                $title = $thisItem.find('.qodef-e-title-link');

                            $title.on('mouseenter', function() {
                                $(this).closest('article').addClass('qodef-active-hover');
                            });

                            $title.on('mouseleave', function() {
                                $(this).closest('article').removeClass('qodef-active-hover');
                            });
                        })
                    }
                });
            }
        }
    };

    qodefCore.shortcodes.makao_core_portfolio_list.qodefZoomOut = qodefZoomOut;

})(jQuery);
(function ($) {
    "use strict";
	qodefCore.shortcodes.makao_core_advanced_image_gallery = {};
	qodefCore.shortcodes.makao_core_advanced_image_gallery.qodefSwiper = qodef.qodefSwiper;
	qodefCore.shortcodes.makao_core_advanced_image_gallery.qodefMasonryLayout = qodef.qodefMasonryLayout;

    $(document).ready(function () {
        qodefAdvancedImageGallery.init();
    });

    var qodefAdvancedImageGallery = {
        init: function () {
            this.slides = $('.qodef-advanced-image-gallery .swiper-wrapper');

            if (this.slides.length) {
                this.slides.each(function () {
                    var $thisSlide = $(this),
						$title = $thisSlide.find('.qodef-m-title'),
                     	titleOptions = typeof $title.data('options') !== 'undefined' ? $title.data('options') : {},
						responsiveTitleFontSize = titleOptions.responsiveFontSize;

                    if(qodefCore.windowWidth < 768){
                    	$title.css('font-size', responsiveTitleFontSize);
					}

                    qodefAdvancedImageGallery.setDelay( $thisSlide );
                });
            }
        },
        setDelay: function ( $thisSlide ) {
            var $text   = $thisSlide.find('.qodef-e-title'),
                $subtitle = $thisSlide.find('.qodef-e-subtitle'),
                $button = $thisSlide.find('.qodef-e-button'),
                $speed  = $thisSlide.parent().data('options').speed;

            if ( $speed === '' ) {
                $speed = 800;
            }

            $subtitle.css('animation-delay', $speed - 300 + 'ms');
            $text.css('animation-delay', $speed - 300 + 'ms');
            $button.css('animation-delay', $speed - 100 + 'ms');
        }
    };

    qodefCore.shortcodes.makao_core_advanced_image_gallery.qodefAdvancedImageGallery = qodefAdvancedImageGallery;

})(jQuery);
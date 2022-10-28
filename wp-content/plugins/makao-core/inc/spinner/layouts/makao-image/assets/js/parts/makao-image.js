(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefMakaoSpinner.init();
    });

    $(window).on('elementor/frontend/init', function () {
        var isEditMode = Boolean(elementorFrontend.isEditMode());

        if (isEditMode) {
            qodefMakaoSpinner.init(isEditMode);
        }
    });

    var qodefMakaoSpinner = {
        init: function (isEditMode) {
            var $holder = $('#qodef-page-spinner.qodef-layout--makao-image');

            if ($holder.length) {
                if (isEditMode) {
                    qodefMakaoSpinner.finishAnimation($holder);
                } else {
                    qodefMakaoSpinner.animateSpinner($holder);

                    $(window).on('load', function () {
                        qodefMakaoSpinner.finishAnimation($holder);
                    });
                }
            }
        },
        finishAnimation: function ($holder) {
            var $rev = $('.qodef-landing-rev-holder');

            setTimeout(function () {
                $holder.addClass('qodef-finished');

                setTimeout(function () {
                    qodefMakaoSpinner.fadeOutLoader($holder);

                    if ($rev.length) {
                        $rev.find('rs-module').revstart();
                    }
                }, 300);
            }, 3000);
        },
        animateSpinner: function ($holder) {
            $holder.addClass('qodef-init');
        },
        fadeOutLoader: function ($holder, speed, delay, easing) {
            speed = speed ? speed : 500;
            delay = delay ? delay : 0;
            easing = easing ? easing : 'swing';

            if ($holder.length) {
                $holder.delay(delay).fadeOut(speed, easing);
                $(window).on('bind', 'pageshow', function (event) {
                    if (event.originalEvent.persisted) {
                        $holder.fadeOut(speed, easing);
                    }
                });
            }
        }
    };

})(jQuery);
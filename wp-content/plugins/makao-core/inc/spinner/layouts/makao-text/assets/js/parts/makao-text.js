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
            var $holder = $('#qodef-page-spinner.qodef-layout--makao-text'),
                $rev = $('.qodef-landing-rev-holder'),
                $interval;

            qodefMakaoSpinner.windowLoaded = false;

            if ($holder.length) {
                if (isEditMode) {
                    qodefMakaoSpinner.removeSpinner();
                } else {
                    qodefMakaoSpinner.splitText($holder);

                    setTimeout(function () {
                        qodefMakaoSpinner.animateSpinner($holder);

                        $interval = setInterval(function () {
                            qodefMakaoSpinner.animateSpinner($holder);

                            if (qodefMakaoSpinner.windowLoaded) {
                                setTimeout(function () {
                                    qodefMakaoSpinner.fadeOutLoader($holder);

                                    if ($rev.length) {
                                        $rev.find('rs-module').revstart();
                                    }
                                }, 4000);

                                setTimeout(function () {
                                    clearInterval($interval);
                                }, 2000);
                            }
                        }, 4000);
                    }, 500);

                    $(window).on('load', function () {
                        qodefMakaoSpinner.windowLoaded = true;
                    });
                }
            }
        },
        removeSpinner: function () {
            this.holder = $('#qodef-page-spinner.qodef-layout--makao-text');

            if (this.holder.length) {
                this.holder.remove();
            }
        },
        splitText: function ($holder) {
            var $text = $holder.find('.qodef-m-text');

            if ($text.length) {
                var $txt = $text.text(),
                    $newTxt = $.trim($txt),
                    $extraClass = '';

                $text.empty();
                $newTxt.split('').forEach(function (c) {
                    $extraClass = (c === " " ? 'qodef-empty-char' : '');
                    $text.append('<span class="qodef-char-mask ' + $extraClass + '"><span>' + c + '</span></span>');
                });
            }
        },
        animateSpans: function ($selector, $class, $delay) {
            $selector.each(function ($i) {
                var $thisSpan = $(this);

                setTimeout(function () {
                    $thisSpan.addClass($class);
                }, $delay * 0.85 + $i * $delay);
            });
        },
        animateSpinner: function ($holder) {
            setTimeout(function () {
                $holder.addClass('qodef-init');
                $('.qodef-m-text .qodef-char-mask > span').removeClass('qodef-animate-text-out');
            }, 200);
            qodefMakaoSpinner.animateSpans($('.qodef-m-text .qodef-char-mask > span'), 'qodef-animate-text-in', 30);
            setTimeout(function () {
                $('.qodef-m-text .qodef-char-mask > span').removeClass('qodef-animate-text-in');
                qodefMakaoSpinner.animateSpans($($('.qodef-m-text .qodef-char-mask > span').get().reverse()), 'qodef-animate-text-out', 200);
            }, 2000);
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
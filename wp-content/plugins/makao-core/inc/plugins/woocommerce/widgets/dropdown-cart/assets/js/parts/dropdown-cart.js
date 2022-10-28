(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefDropdownCart.init();
    });

    var qodefDropdownCart = {
        init: function () {
            var $holder = $('.qodef-m-dropdown');

            if ($holder.length) {
                $holder.each(function () {
                    var $thisHolder = $(this);

                    qodefDropdownCart.addElement($thisHolder);
                });
            }
        },
        addElement: function ($thisHolder) {
            var $button = $thisHolder.find('.qodef-m-action-link.e-cart');

            if ($button.length) {
                $button.prepend('<span class="qodef-initial-border"></span><span class="qodef-top-border"></span><span class="qodef-right-border"></span><span class="qodef-bottom-border"></span><span class="qodef-left-border"></span>');
            }
        }
    };

})(jQuery);
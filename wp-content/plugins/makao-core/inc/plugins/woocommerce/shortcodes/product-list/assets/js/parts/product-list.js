(function ($) {
	"use strict";

	qodefCore.shortcodes.makao_core_product_list = {};

	$(document).ready(function () {
		qodefProductList.init();
	});

	if (typeof qodefCore.listShortcodesScripts === 'object') {
		$.each(qodefCore.listShortcodesScripts, function (key, value) {
			qodefCore.shortcodes[shortcode][key] = value;
		});
	}

	var qodefProductList = {
		init: function () {
			var $productList = $('.qodef-woo-product-list.qodef-woo-shortcode');

			if ($productList.length) {
				$productList.each(function () {
					var $thisList = $(this);

					// qodefProductList.elementsAnimation( $thisList );
				})
			}
		},
		elementsAnimation: function ($thisList) {
			var $listItem = $thisList.find('.qodef-e');

			if ($listItem.length) {
				$listItem.each(function () {
					var $thisItem = $(this),
						$elemHolder = $thisItem.find('.qodef-woo-product-button-holder, .qodef-add-to-cart-wrapper'),
						$elements = $elemHolder.find('> *');

					if ($elements.length) {
						$elements.each(function () {
							var $thisElement = $(this);

							$thisElement.prepend('<span class="qodef-top-border"></span><span class="qodef-right-border"></span><span class="qodef-bottom-border"></span><span class="qodef-left-border"></span>');

							var $cartButton = $elemHolder.find('.add_to_cart_button, .product_type_grouped');

							$cartButton.on('click', function () {
								setTimeout(function () {
									var $addedButton = $elemHolder.find('.added_to_cart');

									$addedButton.prepend('<span class="qodef-top-border"></span><span class="qodef-right-border"></span><span class="qodef-bottom-border"></span><span class="qodef-left-border"></span>');
								}, 1500);
							})
						});
					}
				})
			}
		}
	};

	qodefCore.shortcodes.makao_core_product_list.qodefMasonryLayout = qodef.qodefMasonryLayout;
	qodefCore.shortcodes.makao_core_product_list.qodefSwiper = qodef.qodefSwiper;

})(jQuery);
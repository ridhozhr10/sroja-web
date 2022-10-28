(function ($) {
	"use strict";

	qodefCore.shortcodes.makao_core_button = {};

	$(document).ready(function () {
		qodefButton.init();
		qodefButton.otherBorderButtons();
	});

	var qodefButton = {
		init: function () {
			this.buttons = $('.qodef-button');

			if (this.buttons.length) {
				this.buttons.each(function () {
					var $thisButton = $(this);

					qodefButton.buttonHoverColor($thisButton);
					qodefButton.buttonHoverBgColor($thisButton);
					qodefButton.buttonBordersAnimation($thisButton);
					qodefButton.buttonHoverBehavior($thisButton);
				});
			}
		},
		buttonHoverColor: function ($button) {
			if (typeof $button.data('hover-color') !== 'undefined') {
				var hoverColor = $button.data('hover-color');
				var originalColor = $button.css('color');

				$button.on('mouseenter', function () {
					qodefButton.changeColor($button, 'color', hoverColor);
				});
				$button.on('mouseleave', function () {
					qodefButton.changeColor($button, 'color', originalColor);
				});
			}
		},
		buttonHoverBgColor: function ($button) {
			if (typeof $button.data('hover-background-color') !== 'undefined') {
				var hoverBackgroundColor = $button.data('hover-background-color');
				var originalBackgroundColor = $button.css('background-color');

				$button.on('mouseenter', function () {
					qodefButton.changeColor($button, 'background-color', hoverBackgroundColor);
				});
				$button.on('mouseleave', function () {
					qodefButton.changeColor($button, 'background-color', originalBackgroundColor);
				});
			}
		},
		changeColor: function ($button, cssProperty, color) {
			$button.css(cssProperty, color);
		},
		buttonBordersAnimation: function ($button) {
			if (!$button.hasClass('qodef-layout--borders-animated') && $button.hasClass('qodef-layout--outlined') || $button.hasClass('qodef-layout--filled')) {
				var borderInnerColor = $button.data('border-inner-color'),
					borderInnerHoverColor = $button.data('hover-border-inner-color');

				qodefButton.prependBorderSpans($button);
				qodefButton.prependInitialBorder($button);

				setTimeout(function () {
					$button.find('.qodef-initial-border').css('border-color', borderInnerColor);
					$button.find('span:not(.qodef-m-text):not(.qodef-initial-border)').css('background-color', borderInnerHoverColor);
					$button.addClass('qodef-layout--borders-animated');
				}, 10);
			}
		},
		otherBorderButtons: function () {
			var $buttons = $('.single_add_to_cart_button');

			if ($buttons.length) {
				$buttons.each(function () {
					var $button = $(this);
					if (!$button.hasClass('qodef-layout--borders-animated-others')) {
						$button.addClass('qodef-layout--borders-animated-others');
						qodefButton.prependInitialBorder($button);
						qodefButton.prependBorderSpans($button);
					}
				});
			}
		},
		buttonHoverBehavior: function ($button) {
			$button.on('mouseenter', function () {
				if (!$button.hasClass('qodef-btn-hovered')) {
					var $thisButton = $(this);
					$thisButton.addClass('qodef-btn-hovered');
					setTimeout(function () {
						$thisButton.removeClass('qodef-btn-hovered');
					}, 1200);
				}
			})
		},
		prependBorderSpans: function ($element) {
			$element.prepend('<span class="qodef-top-border"></span><span class="qodef-right-border"></span><span class="qodef-bottom-border"></span><span class="qodef-left-border"></span>');
		},
		prependInitialBorder: function ($element) {
			$element.prepend('<span class="qodef-initial-border"></span>');
		}
	};

	qodefCore.shortcodes.makao_core_button.qodefButton = qodefButton;

})(jQuery);
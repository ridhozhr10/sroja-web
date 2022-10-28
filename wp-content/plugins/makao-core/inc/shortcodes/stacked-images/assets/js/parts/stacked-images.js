(function ($) {
	"use strict";

	qodefCore.shortcodes.makao_core_stacked_images = {};

	$(document).ready(function () {
		qodefStackedImages.init();
	});
	
	var qodefStackedImages = {
		init: function () {
			var $holder = $('.qodef-stacked-images');
			
			if ( $holder.length ) {
				$holder.each(function () {
					var $thisHolder = $(this);

					qodefStackedImages.setFloatData( $thisHolder );

					setTimeout( function() {
						qodefStackedImages.appearAnimation( $thisHolder );
					}, 100);
				});
			}
		},
		setFloatData: function ( $thisHolder ) {
			var $images = $thisHolder.find('img');

			if ( $images.length ) {
				$images.each( function() {
					var $thisImage = $(this);

					$thisImage.attr('data-parallax', '{"y" : -50 , "scale": 1.10, "smoothness": 100}');
				});
			}

			qodefStackedImages.initFloatData();
		},
		initFloatData: function () {
			var $instances = $("[data-parallax]");

			if ( $instances.length && !qodef.html.hasClass('touch') ) {
				ParallaxScroll.init(); //initialzation removed from plugin js file to have it run only on non-touch devices
			}
		},
		appearAnimation: function ( $thisHolder ) {
			$thisHolder.appear(function() {
				$thisHolder.addClass('qodef-appear');
			}, { accX: 0, accY: 0 });
		}
	};

	qodefCore.shortcodes.makao_core_stacked_images.qodefStackedImages = qodefStackedImages;

})(jQuery);
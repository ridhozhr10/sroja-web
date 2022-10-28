(function ($) {
	"use strict";
	
	qodefCore.shortcodes.makao_core_instagram_list = {};
	
	$(document).ready(function () {
		qodefInstagram.init();
	});
	
	var qodefInstagram = {
		init: function () {
			this.holder = $('.sbi');
			
			if (this.holder.length) {
				this.holder.each(function () {
					var $thisHolder = $(this);

					if ( $thisHolder.hasClass('qodef-instagram-swiper-container') ) {
						qodefInstagram.sliderSettings( $thisHolder );
					}

					if ( $thisHolder.parent().hasClass('qodef-instagram-overlapping-images') ) {
						qodefInstagram.appearAnimation( $thisHolder )
					}
				});
			}
		},
		sliderSettings: function ( $thisHolder ) {
			var sliderOptions = $thisHolder.parent().attr('data-options'),
				$instagramImage = $thisHolder.find('.sbi_item.sbi_type_image'),
				$imageHolder = $thisHolder.find('#sbi_images');

			$thisHolder.attr('data-options', sliderOptions);

			$imageHolder.addClass('swiper-wrapper');

			if ($instagramImage.length) {
				$instagramImage.each(function () {
					$(this).addClass('qodef-e qodef-image-wrapper swiper-slide');
				});
			}

			if (typeof qodef.qodefSwiper === 'object') {
				qodef.qodefSwiper.init($thisHolder);
			}
		},
		appearAnimation: function ( $thisHolder ) {
			$thisHolder.appear(function() {
				$thisHolder.addClass('qodef-appear');
			}, { accX: 0, accY: -200 });
		}
	};
	
	qodefCore.shortcodes.makao_core_instagram_list.qodefInstagram = qodefInstagram;
	qodefCore.shortcodes.makao_core_instagram_list.qodefSwiper = qodef.qodefSwiper;
	
})(jQuery);
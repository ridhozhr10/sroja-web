(function ($) {

	"use strict";

	qodefCore.shortcodes.makao_core_team_list = {};

	$(document).ready(function () {
		qodefTeamList.init();
	});

	var qodefTeamList = {
		init: function () {
			var $teamList = $('.qodef-team-list');

			if ($teamList.length) {
				$teamList.each(function () {
					var $thisList = $(this);

					// qodefTeamList.elementsAnimation( $thisList );
				})
			}
		},
		elementsAnimation: function ($thisList) {
			var $listItem = $thisList.find('.qodef-e');

			if ($listItem.length) {
				$listItem.each(function () {
					var $thisItem = $(this),
						$elemHolder = $thisItem.find('.qodef-team-member-social-icons-inner'),
						$elements = $elemHolder.find('> a');

					if ($elements.length) {
						$elements.each(function () {
							var $thisElement = $(this);

							$thisElement.prepend('<span class="qodef-top-border"></span><span class="qodef-right-border"></span><span class="qodef-bottom-border"></span><span class="qodef-left-border"></span>');
						})
					}
				})
			}
		}
	};

	qodefCore.shortcodes.makao_core_team_list.qodefPagination = qodef.qodefPagination;
	qodefCore.shortcodes.makao_core_team_list.qodefFilter = qodef.qodefFilter;
	qodefCore.shortcodes.makao_core_team_list.qodefJustifiedGallery = qodef.qodefJustifiedGallery;
	qodefCore.shortcodes.makao_core_team_list.qodefMasonryLayout = qodef.qodefMasonryLayout;
	qodefCore.shortcodes.makao_core_team_list.qodefSwiper = qodef.qodefSwiper;

})(jQuery);
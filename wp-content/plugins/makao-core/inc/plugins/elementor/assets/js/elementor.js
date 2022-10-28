(function ($) {
	"use strict";

	$(window).on('load', function () {
		for (var key in qodefCore.shortcodes) {
			for (var keyChild in qodefCore.shortcodes[key]) {
				qodefElementor.init(key, keyChild);
			}
		}

		qodefElementorSection.init();
		elementorSection.init();
		qodefAppear.init();
	});

	var qodefElementor = {
		init: function (key, keyChild) {
			$(window).on('elementor/frontend/init', function (e) {
				elementorFrontend.hooks.addAction('frontend/element_ready/' + key + '.default', function (e) {
					// Check if object doesn't exist and print the module where is the error
					if (typeof qodefCore.shortcodes[key][keyChild] === 'undefined') {
						console.log(keyChild);
					}

					qodefCore.shortcodes[key][keyChild].init();
				});
			});
		}
	};

	var qodefElementorSection = {
		init: function () {
			$(window).on('elementor/frontend/init', function () {
				elementorFrontend.hooks.addAction('frontend/element_ready/section', elementorSection.init);
			});
		}
	};

	var elementorSection = {
		init: function ($scope) {
			var $target = $scope,
				isEditMode = Boolean(elementorFrontend.isEditMode()),
				settings = [],
				sectionData = {};

			//generate parallax settings
			if (isEditMode && typeof $scope !== 'undefined') {
				// generate options when in admin
				var editorElements = window.elementor.elements,
					sectionId = $target.data('id');

				$.each(editorElements.models, function (index, object) {
					if (sectionId === object.id) {
						sectionData = object.attributes.settings.attributes;

						if (typeof sectionData.qodef_enable_parallax !== 'undefined') {
							settings['enable_parallax'] = sectionData.qodef_enable_parallax;
						}

						if (typeof sectionData.qodef_enable_parallax !== 'undefined' && sectionData.qodef_enable_parallax == 'yes' && typeof sectionData.qodef_parallax_image['url'] !== 'undefined' && sectionData.qodef_parallax_image['url']) {
							settings['image_url'] = sectionData.qodef_parallax_image['url'];
						}

						if (typeof sectionData.qodef_parallax_height !== 'undefined') {
							settings['section_height'] = sectionData.qodef_parallax_height;
						}

						//generate output for section
						if (typeof $target !== 'undefined') {
							elementorSection.generateOutput($target, settings, false);
						}

						var columns = object.attributes.elements;
						if (typeof columns !== 'undefined') {
							$.each(columns.models, function (index, object) {
								var innerSections = object.attributes.elements;

								if (typeof (innerSections !== 'undefined')) {
									$.each(innerSections.models, function (index, object) {
										sectionData = object.attributes.settings.attributes;

										if (typeof sectionData.qodef_enable_parallax !== 'undefined') {
											settings['enable_parallax'] = sectionData.qodef_enable_parallax;
										}

										if (typeof sectionData.qodef_enable_parallax !== 'undefined' && sectionData.qodef_enable_parallax == 'yes' && typeof sectionData.qodef_parallax_image['url'] !== 'undefined' && sectionData.qodef_parallax_image['url']) {
											settings['image_url'] = sectionData.qodef_parallax_image['url'];
										}

										if (typeof sectionData.qodef_enable_parallax !== 'undefined' && sectionData.qodef_enable_parallax == 'yes' && typeof sectionData.qodef_parallax_height !== 'undefined') {
											settings['section_height'] = sectionData.qodef_parallax_height;
										}

										//generate output for inner section
										if (typeof $target !== 'undefined') {
											elementorSection.generateOutput($target, settings, true);
										}
									})
								}
							})
						}
					}
				});

			} else {
				// generate options when in frontend using global js variable
				var sectionHandlerData = qodefElementorGlobal.vars.elementorSectionHandler;

				$.each(sectionHandlerData, function (index, property) {
					$target = $('[data-id="' + index + '"]');
					settings['image_url'] = property[0].url;
					settings['section_height'] = property[1];

					if (typeof settings['image_url'] !== 'undefined') {
						settings['enable_parallax'] = 'yes';
					}

					//generate output for frontend
					if (typeof $target !== 'undefined' && $target.length) {
						elementorSection.generateOutput($target, settings, false);
					}
				});
			}
		},
		generateOutput: function ($target, settings, isInnerSection = false) {
			//check if it is inner section, if so parallax holder needs to attached to inner secton so $target has to be changed to inner section "Section" element
			if (isInnerSection) {
				$target = $target.find('section').first();
			}
			$('.qodef-parallax-img-holder', $target).remove();
			$target.removeClass('qodef-parallax qodef--parallax-row');
			$target.css({ 'overflow': 'hidden' });

			if (typeof settings['enable_parallax'] !== 'undefined' && settings['enable_parallax'] == 'yes' && typeof settings['image_url'] !== 'undefined') {
				var $layout = null;

				$target.addClass('qodef-parallax qodef--parallax-row');
				$target.css({ 'height': settings['section_height'], 'background': 'transparent' });

				$layout = $('<div class="qodef-parallax-img-holder"><div class="qodef-parallax-img-wrapper"><img src="' + settings['image_url'] + '" alt="Parallax image"></div></div>').prependTo($target);

				//wait for image src to be loaded
				var newImg = new Image;
				newImg.onload = function () {
					$target.find('img').attr('src', this.src);
					qodefCore.qodefParallaxBackground.init();
				};
				newImg.src = settings['image_url'];
			}
		}
	};

	var qodefAppear = {
		init: function () {
			var $holders = $('.qodef-custom-appear-left, .qodef-custom-appear-right, .qodef-custom-appear-fade');

			if ($holders.length) {
				$holders.each(function () {
					var $thisHolder = $(this);

					$thisHolder.appear(function () {
						$thisHolder.addClass('qodef-appear');
					}, { accX: 0, accY: -200 });
				});
			}
		}
	};

})(jQuery);

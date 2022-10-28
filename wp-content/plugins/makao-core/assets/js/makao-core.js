(function ($) {
	"use strict";

	window.qodefCore = {};
	qodefCore.shortcodes = {};

	qodefCore.body = $('body');
	qodefCore.html = $('html');
	qodefCore.windowWidth = $(window).width();
	qodefCore.windowHeight = $(window).height();
	qodefCore.scroll = 0;

	$(document).ready(function () {
		qodefCore.scroll = $(window).scrollTop();
		qodefInlinePageStyle.init();
	});

	$(window).resize(function () {
		qodefCore.windowWidth = $(window).width();
		qodefCore.windowHeight = $(window).height();
	});

	$(window).scroll(function () {
		qodefCore.scroll = $(window).scrollTop();
	});

	var qodefScroll = {
		disable: function(){
			if (window.addEventListener) {
				window.addEventListener('wheel', qodefScroll.preventDefaultValue, {passive: false});
			}

			// window.onmousewheel = document.onmousewheel = qodefScroll.preventDefaultValue;
			document.onkeydown = qodefScroll.keyDown;
		},
		enable: function(){
			if (window.removeEventListener) {
				window.removeEventListener('wheel', qodefScroll.preventDefaultValue, {passive: false});
			}
			window.onmousewheel = document.onmousewheel = document.onkeydown = null;
		},
		preventDefaultValue: function(e){
			e = e || window.event;
			if (e.preventDefault) {
				e.preventDefault();
			}
			e.returnValue = false;
		},
		keyDown: function(e) {
			var keys = [37, 38, 39, 40];
			for (var i = keys.length; i--;) {
				if (e.keyCode === keys[i]) {
					qodefScroll.preventDefaultValue(e);
					return;
				}
			}
		}
	};

	qodefCore.qodefScroll = qodefScroll;

	var qodefPerfectScrollbar = {
		init: function ($holder) {
			if ($holder.length) {
				qodefPerfectScrollbar.qodefInitScroll($holder);
			}
		},
		qodefInitScroll: function ($holder) {
			var $defaultParams = {
				wheelSpeed: 0.6,
				suppressScrollX: true
			};

			var $ps = new PerfectScrollbar($holder.selector, $defaultParams);
			$(window).resize(function () {
				$ps.update();
			});
		}
	};

	qodefCore.qodefPerfectScrollbar = qodefPerfectScrollbar;

	var qodefInlinePageStyle = {
		init: function () {
			this.holder = $('#makao-core-page-inline-style');

			if (this.holder.length) {
				var style = this.holder.data('style');

				if (style.length) {
					$('head').append('<style type="text/css">' + style + '</style>');
				}
			}
		}
	};

	qodefCore.qodefInlinePageStyle = qodefInlinePageStyle;

})(jQuery);
(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefBackToTop.init();
    });

    var qodefBackToTop = {
        init: function () {
            this.holder = $('#qodef-back-to-top');

            if(this.holder.length) {
                // Scroll To Top
                this.holder.on('click', function (e) {
                    e.preventDefault();
                    qodefBackToTop.animateScrollToTop();
                });

                qodefBackToTop.showHideBackToTop();
            }
        },
        animateScrollToTop: function() {
            var startPos = qodef.scroll,
                newPos = qodef.scroll,
                step = .9,
                animationFrameId;

            var startAnimation = function() {
                if (newPos === 0) return;
                newPos < 0.0001 ? newPos = 0 : null;
                var ease = qodefBackToTop.easingFunction((startPos - newPos) / startPos);
                $('html, body').scrollTop(startPos - (startPos - newPos) * ease);
                newPos = newPos * step;

                animationFrameId = requestAnimationFrame(startAnimation)
            };
            startAnimation();
            $(window).one('wheel touchstart', function() {
                cancelAnimationFrame(animationFrameId);
            });
        },
        easingFunction: function(n) {
            return 0 === n ? 0 : Math.pow(1024, n - 1);
        },
        showHideBackToTop: function () {
            $(window).scroll(function () {
                var $thisItem = $(this),
                    b = $thisItem.scrollTop(),
                    c = $thisItem.height(),
                    d;

                if (b > 0) {
                    d = b + c / 2;
                } else {
                    d = 1;
                }

                if (d < 1e3) {
                    qodefBackToTop.addClass('off');
                } else {
                    qodefBackToTop.addClass('on');
                }
            });
        },
        addClass: function (a) {
            this.holder.removeClass('qodef--off qodef--on');

            if (a === 'on') {
                this.holder.addClass('qodef--on');
            } else {
                this.holder.addClass('qodef--off');
            }
        }
    };

})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefAgeVerificationModal.init();
	});
	
	var qodefAgeVerificationModal = {
		init: function () {
			this.holder = $('#qodef-age-verification-modal');
			
			if (this.holder.length) {
				var $preventHolder = this.holder.find('.qodef-m-content-prevent');
				
				if ($preventHolder.length) {
					var $preventYesButton = $preventHolder.find('.qodef-prevent--yes');
					
					$preventYesButton.on('click', function () {
						var cname = 'disabledAgeVerification';
						var cvalue = 'Yes';
						var exdays = 7;
						var d = new Date();
						
						d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
						var expires = "expires=" + d.toUTCString();
						document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
						
						qodefAgeVerificationModal.handleClassAndScroll('remove');
					});
				}
			}
		},
		
		handleClassAndScroll: function (option) {
			if (option === 'remove') {
				qodefCore.body.removeClass('qodef-age-verification--opened');
				qodefCore.qodefScroll.enable();
			}
			if (option === 'add') {
				qodefCore.body.addClass('qodef-age-verification--opened');
				qodefCore.qodefScroll.disable();
			}
		},
	};
	
})(jQuery);
(function ($) {
	"use strict";

	$(window).on('load', function () {
		qodefUncoverFooter.init();
	});

	var qodefUncoverFooter = {
		holder: '',
		init: function () {
			this.holder = $('#qodef-page-footer.qodef--uncover');

			if (this.holder.length && !qodefCore.html.hasClass('touchevents')) {
				qodefUncoverFooter.addClass();
				qodefUncoverFooter.setHeight(this.holder);

				$(window).resize(function () {
					qodefUncoverFooter.setHeight(qodefUncoverFooter.holder);
				});
			}
		},
		setHeight: function ($holder) {
			$holder.css('height', 'auto');

			var footerHeight = $holder.outerHeight();

			if (footerHeight > 0) {
				$('#qodef-page-outer').css({ 'margin-bottom': footerHeight, 'background-color': qodefCore.body.css('backgroundColor') });
				$holder.css('height', footerHeight);
			}
		},
		addClass: function () {
			qodefCore.body.addClass('qodef-page-footer--uncover');
		}
	};

})(jQuery);

(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefFullscreenMenu.init();
	});
	
	var qodefFullscreenMenu = {
		init: function () {
			var $fullscreenMenuOpener = $('a.qodef-fullscreen-menu-opener'),
				$menuItems = $('#qodef-fullscreen-area nav ul li a');
			
			// Open popup menu
			$fullscreenMenuOpener.on('click', function (e) {
				e.preventDefault();
				
				if (!qodefCore.body.hasClass('qodef-fullscreen-menu--opened')) {
					qodefFullscreenMenu.openFullscreen();
					$(document).keyup(function (e) {
						if (e.keyCode === 27) {
							qodefFullscreenMenu.closeFullscreen();
						}
					});
				} else {
					qodefFullscreenMenu.closeFullscreen();
				}
			});
			
			//open dropdowns
			$menuItems.on('tap click', function (e) {
				var $thisItem = $(this);
				if ($thisItem.parent().hasClass('menu-item-has-children')) {
					e.preventDefault();
					qodefFullscreenMenu.clickItemWithChild($thisItem);
				} else if (($(this).attr('href') !== "http://#") && ($(this).attr('href') !== "#")) {
					qodefFullscreenMenu.closeFullscreen();
				}
			});
		},
		openFullscreen: function () {
			qodefCore.body.removeClass('qodef-fullscreen-menu-animate--out').addClass('qodef-fullscreen-menu--opened qodef-fullscreen-menu-animate--in');
			qodefCore.qodefScroll.disable();
		},
		closeFullscreen: function () {
			qodefCore.body.removeClass('qodef-fullscreen-menu--opened qodef-fullscreen-menu-animate--in').addClass('qodef-fullscreen-menu-animate--out');
			qodefCore.qodefScroll.enable();
			$("nav.qodef-fullscreen-menu ul.sub_menu").slideUp(200);
		},
		clickItemWithChild: function (thisItem) {
			var $thisItemParent = thisItem.parent(),
				$thisItemSubMenu = $thisItemParent.find('.sub-menu').first();
			
			if ($thisItemSubMenu.hasClass('qodef-opened')) {
				$thisItemSubMenu.removeClass('qodef-opened');

				setTimeout( function () {
					$thisItemSubMenu.css('display', 'none');
				}, 500);
			} else {
				$thisItemSubMenu.css('display', 'block');
				$thisItemParent.siblings().find('.sub-menu').removeClass('qodef-opened');

				setTimeout( function () {
					$thisItemSubMenu.addClass('qodef-opened');
				}, 50);

				setTimeout( function () {
					$thisItemParent.siblings().find('.sub-menu').css('display', 'none');
				}, 500);
			}
		}
	};
	
})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefHeaderScrollAppearance.init();
	});
	
	var qodefHeaderScrollAppearance = {
		appearanceType: function () {
			return qodefCore.body.attr('class').indexOf('qodef-header-appearance--') !== -1 ? qodefCore.body.attr('class').match(/qodef-header-appearance--([\w]+)/)[1] : '';
		},
		init: function () {
			var appearanceType = this.appearanceType();
			
			if (appearanceType !== '' && appearanceType !== 'none') {
                qodefCore[appearanceType + "HeaderAppearance"]();
			}
		}
	};
	
})(jQuery);

(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefMobileHeaderAppearance.init();
    });

    /*
     **	Init mobile header functionality
     */
    var qodefMobileHeaderAppearance = {
        init: function () {
            if (qodefCore.body.hasClass('qodef-mobile-header-appearance--sticky')) {

                var docYScroll1 = qodefCore.scroll,
                    displayAmount = qodefGlobal.vars.mobileHeaderHeight + qodefGlobal.vars.adminBarHeight,
                    $pageOuter = $('#qodef-page-outer');

                qodefMobileHeaderAppearance.showHideMobileHeader(docYScroll1, displayAmount, $pageOuter);
                $(window).scroll(function () {
                    qodefMobileHeaderAppearance.showHideMobileHeader(docYScroll1, displayAmount, $pageOuter);
                    docYScroll1 = qodefCore.scroll;
                });

                $(window).resize(function () {
                    $pageOuter.css('padding-top', 0);
                    qodefMobileHeaderAppearance.showHideMobileHeader(docYScroll1, displayAmount, $pageOuter);
                });
            }
        },
        showHideMobileHeader: function(docYScroll1, displayAmount,$pageOuter){
            if(qodefCore.windowWidth <= 1024) {
                if (qodefCore.scroll > displayAmount * 2) {
                    //set header to be fixed
                    qodefCore.body.addClass('qodef-mobile-header--sticky');

                    //add transition to it
                    setTimeout(function () {
                        qodefCore.body.addClass('qodef-mobile-header--sticky-animation');
                    }, 300); //300 is duration of sticky header animation

                    //add padding to content so there is no 'jumping'
                    $pageOuter.css('padding-top', qodefGlobal.vars.mobileHeaderHeight);
                } else {
                    //unset fixed header
                    qodefCore.body.removeClass('qodef-mobile-header--sticky');

                    //remove transition
                    setTimeout(function () {
                        qodefCore.body.removeClass('qodef-mobile-header--sticky-animation');
                    }, 300); //300 is duration of sticky header animation

                    //remove padding from content since header is not fixed anymore
                    $pageOuter.css('padding-top', 0);
                }

                if ((qodefCore.scroll > docYScroll1 && qodefCore.scroll > displayAmount) || (qodefCore.scroll < displayAmount * 3)) {
                    //show sticky header
                    qodefCore.body.removeClass('qodef-mobile-header--sticky-display');
                } else {
                    //hide sticky header
                    qodefCore.body.addClass('qodef-mobile-header--sticky-display');
                }
            }
        }
    };

})(jQuery);
(function ($) {
	"use strict";

	$(document).ready(function () {
		qodefNavMenu.init();
	});

	var qodefNavMenu = {
		init: function () {
			qodefNavMenu.dropdownBehavior();
			qodefNavMenu.wideDropdownPosition();
			qodefNavMenu.dropdownPosition();
		},
		dropdownBehavior: function () {
			var $menuItems = $('.qodef-header-navigation > ul > li');
			
			$menuItems.each(function () {
				var $thisItem = $(this);
				
				if ($thisItem.find('.qodef-drop-down-second').length) {
					$thisItem.waitForImages(function () {
						var $dropdownHolder = $thisItem.find('.qodef-drop-down-second'),
							$dropdownMenuItem = $dropdownHolder.find('.qodef-drop-down-second-inner ul'),
							dropDownHolderHeight = $dropdownMenuItem.outerHeight();
						
						if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
							$thisItem.on("touchstart mouseenter", function () {
								$dropdownHolder.css({
									'height': dropDownHolderHeight,
									'overflow': 'visible',
									'visibility': 'visible',
									'opacity': '1'
								});
							}).on("mouseleave", function () {
								$dropdownHolder.css({
									'height': '0px',
									'overflow': 'hidden',
									'visibility': 'hidden',
									'opacity': '0'
								});
							});
						} else {
							if (qodefCore.body.hasClass('qodef-drop-down-second--animate-height')) {
								var animateConfig = {
									interval: 0,
									over: function () {
										setTimeout(function () {
											$dropdownHolder.addClass('qodef-drop-down--start').css({
												'visibility': 'visible',
												'height': '0',
												'opacity': '1'
											});
											$dropdownHolder.stop().animate({
												'height': dropDownHolderHeight
											}, 400, 'easeInOutQuint', function () {
												$dropdownHolder.css('overflow', 'visible');
											});
										}, 100);
									},
									timeout: 100,
									out: function () {
										$dropdownHolder.stop().animate({
											'height': '0',
											'opacity': 0
										}, 100, function () {
											$dropdownHolder.css({
												'overflow': 'hidden',
												'visibility': 'hidden'
											});
										});
										
										$dropdownHolder.removeClass('qodef-drop-down--start');
									}
								};
								
								$thisItem.hoverIntent(animateConfig);
							} else {
								var config = {
									interval: 0,
									over: function () {
										setTimeout(function () {
											$dropdownHolder.addClass('qodef-drop-down--start').stop().css({'height': dropDownHolderHeight});
										}, 150);
									},
									timeout: 150,
									out: function () {
										$dropdownHolder.stop().css({'height': '0'}).removeClass('qodef-drop-down--start');
									}
								};
								
								$thisItem.hoverIntent(config);
							}
						}
					});
				}
			});
		},
		wideDropdownPosition: function () {
			var $menuItems = $(".qodef-header-navigation > ul > li.qodef-menu-item--wide");

			if ($menuItems.length) {
				$menuItems.each(function () {
					var $menuItem = $(this);
					var $menuItemSubMenu = $menuItem.find('.qodef-drop-down-second');

					if ($menuItemSubMenu.length) {
						$menuItemSubMenu.css('left', 0);

						var leftPosition = $menuItemSubMenu.offset().left;

						if (qodefCore.body.hasClass('qodef--boxed')) {
							//boxed layout case
							var boxedWidth = $('.qodef--boxed #qodef-page-wrapper').outerWidth();
							leftPosition = leftPosition - (qodefCore.windowWidth - boxedWidth) / 2;
							$menuItemSubMenu.css({'left': -leftPosition, 'width': boxedWidth});

						} else if (qodefCore.body.hasClass('qodef-drop-down-second--full-width')) {
							//wide dropdown full width case
							$menuItemSubMenu.css({'left': -leftPosition});
						}
						else {
							//wide dropdown in grid case
							$menuItemSubMenu.css({'left': -leftPosition + (qodefCore.windowWidth - $menuItemSubMenu.width()) / 2});
						}
					}
				});
			}
		},
		dropdownPosition: function () {
			var $menuItems = $('.qodef-header-navigation > ul > li.qodef-menu-item--narrow.menu-item-has-children');

			if ($menuItems.length) {
				$menuItems.each(function () {
					var $thisItem = $(this),
						menuItemPosition = $thisItem.offset().left,
						$dropdownHolder = $thisItem.find('.qodef-drop-down-second'),
						$dropdownMenuItem = $dropdownHolder.find('.qodef-drop-down-second-inner ul'),
						dropdownMenuWidth = $dropdownMenuItem.outerWidth(),
						menuItemFromLeft = $(window).width() - menuItemPosition;

                    if (qodef.body.hasClass('qodef--boxed')) {
                        //boxed layout case
                        var boxedWidth = $('.qodef--boxed #qodef-page-wrapper').outerWidth();
                        menuItemFromLeft = boxedWidth - menuItemPosition;
                    }

					var dropDownMenuFromLeft;

					if ($thisItem.find('li.menu-item-has-children').length > 0) {
						dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
					}

					$dropdownHolder.removeClass('qodef-drop-down--right');
					$dropdownMenuItem.removeClass('qodef-drop-down--right');
					if (menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth) {
						$dropdownHolder.addClass('qodef-drop-down--right');
						$dropdownMenuItem.addClass('qodef-drop-down--right');
					}
				});
			}
		}
	};

})(jQuery);
(function ($) {
    "use strict";

    $(window).on('load', function () {
        qodefParallaxBackground.init();
    });

    /**
     * Init global parallax background functionality
     */
    var qodefParallaxBackground = {
        init: function (settings) {
            this.$sections = $('.qodef-parallax');

            // Allow overriding the default config
            $.extend(this.$sections, settings);

            var isSupported = !qodef.windowWidth < 1024 && !qodefCore.body.hasClass('qodef-browser--edge') && !qodefCore.body.hasClass('qodef-browser--ms-explorer');

            if (this.$sections.length && isSupported) {
                this.$sections.each(function () {
                    qodefParallaxBackground.ready($(this));
                });
            }
        },
        ready: function ($section) {
            $section.$imgHolder = $section.find('.qodef-parallax-img-holder');
            $section.$imgWrapper = $section.find('.qodef-parallax-img-wrapper');
            $section.$img = $section.find('img.qodef-parallax-img');

            var h = $section.outerHeight(),
                imgWrapperH = $section.$imgWrapper.height();

            $section.movement = 300 * (imgWrapperH - h) / h / 2; //percentage (divided by 2 due to absolute img centering in CSS)

            $section.buffer = window.pageYOffset;
            $section.scrollBuffer = null;


            //calc and init loop
            requestAnimationFrame(function () {
                $section.$imgHolder.animate({ opacity: 1 }, 100);
                qodefParallaxBackground.calc($section);
                qodefParallaxBackground.loop($section);
            });

            //recalc
            $(window).on('resize', function () {
                qodefParallaxBackground.calc($section);
            });
        },
        calc: function ($section) {
            var wH = $section.$imgWrapper.height(),
                wW = $section.$imgWrapper.width();

            if ($section.$img.width() < wW) {
                $section.$img.css({
                    'width': '100%',
                    'height': 'auto'
                });
            }

            if ($section.$img.height() < wH) {
                $section.$img.css({
                    'height': '100%',
                    'width': 'auto',
                    'max-width': 'unset'
                });
            }
        },
        loop: function ($section) {
            if ($section.scrollBuffer === Math.round(window.pageYOffset)) {
                requestAnimationFrame(function () {
                    qodefParallaxBackground.loop($section);
                }); //repeat loop
                return false; //same scroll value, do nothing
            } else {
                $section.scrollBuffer = Math.round(window.pageYOffset);
            }

            var wH = window.outerHeight,
                sTop = $section.offset().top,
                sH = $section.outerHeight();

            if ($section.scrollBuffer + wH * 1.2 > sTop && $section.scrollBuffer < sTop + sH) {
                var delta = (Math.abs($section.scrollBuffer + wH - sTop) / (wH + sH)).toFixed(4), //coeff between 0 and 1 based on scroll amount
                    yVal = (delta * $section.movement).toFixed(4);

                if ($section.buffer !== delta) {
                    $section.$imgWrapper.css('transform', 'translate3d(0,' + yVal + '%, 0)');
                }

                $section.buffer = delta;
            }

            requestAnimationFrame(function () {
                qodefParallaxBackground.loop($section);
            }); //repeat loop
        }
    };

    qodefCore.qodefParallaxBackground = qodefParallaxBackground;

})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefSideArea.init();
	});
	
	var qodefSideArea = {
		init: function () {
			var $sideAreaOpener = $('a.qodef-side-area-opener'),
				$sideAreaClose = $('#qodef-side-area-close'),
				$sideArea = $('#qodef-side-area');
				qodefSideArea.openerHoverColor($sideAreaOpener);
			// Open Side Area
			$sideAreaOpener.on('click', function (e) {
				e.preventDefault();
				
				if (!qodefCore.body.hasClass('qodef-side-area--opened')) {
					qodefSideArea.openSideArea();
					
					$(document).keyup(function (e) {
						if (e.keyCode === 27) {
							qodefSideArea.closeSideArea();
						}
					});
				} else {
					qodefSideArea.closeSideArea();
				}
			});
			
			$sideAreaClose.on('click', function (e) {
				e.preventDefault();
				qodefSideArea.closeSideArea();
			});
			
			if ($sideArea.length && typeof qodefCore.qodefPerfectScrollbar === 'object') {
				qodefCore.qodefPerfectScrollbar.init($sideArea);
			}
		},
		openSideArea: function () {
			var $wrapper = $('#qodef-page-wrapper');
			var currentScroll = $(window).scrollTop();

			$('.qodef-side-area-cover').remove();
			$wrapper.prepend('<div class="qodef-side-area-cover"/>');
			qodefCore.body.removeClass('qodef-side-area-animate--out').addClass('qodef-side-area--opened qodef-side-area-animate--in');

			$('.qodef-side-area-cover').on('click', function (e) {
				e.preventDefault();
				qodefSideArea.closeSideArea();
			});

			$(window).scroll(function () {
				if (Math.abs(qodefCore.scroll - currentScroll) > 400) {
					qodefSideArea.closeSideArea();
				}
			});

		},
		closeSideArea: function () {
			qodefCore.body.removeClass('qodef-side-area--opened qodef-side-area-animate--in').addClass('qodef-side-area-animate--out');
		},
		openerHoverColor: function ($opener) {
			if (typeof $opener.data('hover-color') !== 'undefined') {
				var hoverColor = $opener.data('hover-color');
				var originalColor = $opener.css('color');
				
				$opener.on('mouseenter', function () {
					$opener.css('color', hoverColor);
				}).on('mouseleave', function () {
					$opener.css('color', originalColor);
				});
			}
		}
	};
	
})(jQuery);

(function ($) {
	"use strict";

	$(document).ready(function () {
		qodefSpinner.init();
	});

	$(window).on('elementor/frontend/init', function() {
		var isEditMode = Boolean(elementorFrontend.isEditMode());
		if (isEditMode) {
			qodefSpinner.init(isEditMode);
		}
	});

	var qodefSpinner = {
		init: function (isEditMode) {
			this.holder = $('#qodef-page-spinner:not(.qodef-layout--makao-text, .qodef-layout--makao-image)');

			if (this.holder.length) {
				qodefSpinner.animateSpinner(this.holder, isEditMode);
				qodefSpinner.fadeOutAnimation();
			}
		},
		animateSpinner: function ($holder, isEditMode) {
			$(window).on('load', function () {
				qodefSpinner.fadeOutLoader($holder);
			});

			if (isEditMode) {
				qodefSpinner.fadeOutLoader($holder);
			}
		},
		fadeOutLoader: function ($holder, speed, delay, easing) {
			speed = speed ? speed : 600;
			delay = delay ? delay : 0;
			easing = easing ? easing : 'swing';

			$holder.delay(delay).fadeOut(speed, easing);

			$(window).on('bind', 'pageshow', function (event) {
				if (event.originalEvent.persisted) {
					$holder.fadeOut(speed, easing);
				}
			});
		},
		fadeOutAnimation: function () {

			// Check for fade out animation
			if (qodefCore.body.hasClass('qodef-spinner--fade-out')) {
				var $pageHolder = $('#qodef-page-wrapper'),
					$linkItems = $('a');

				// If back button is pressed, than show content to avoid state where content is on display:none
				window.addEventListener("pageshow", function (event) {
					var historyPath = event.persisted || (typeof window.performance !== "undefined" && window.performance.navigation.type === 2);
					if (historyPath && !$pageHolder.is(':visible')) {
						$pageHolder.show();
					}
				});

				$linkItems.on('click', function (e) {
					var $clickedLink = $(this);

					if (
						e.which === 1 && // check if the left mouse button has been pressed
						$clickedLink.attr('href').indexOf(window.location.host) >= 0 && // check if the link is to the same domain
						!$clickedLink.hasClass('remove') && // check is WooCommerce remove link
						$clickedLink.parent('.product-remove').length <= 0 && // check is WooCommerce remove link
						$clickedLink.parents('.woocommerce-product-gallery__image').length <= 0 && // check is product gallery link
						typeof $clickedLink.data('rel') === 'undefined' && // check pretty photo link
						typeof $clickedLink.attr('rel') === 'undefined' && // check VC pretty photo link
						!$clickedLink.hasClass('lightbox-active') && // check is lightbox plugin active
						(typeof $clickedLink.attr('target') === 'undefined' || $clickedLink.attr('target') === '_self') && // check if the link opens in the same window
						$clickedLink.attr('href').split('#')[0] !== window.location.href.split('#')[0] // check if it is an anchor aiming for a different page
					) {
						e.preventDefault();

						$pageHolder.fadeOut(600, 'easeOutSine', function () {
							window.location = $clickedLink.attr('href');
						});
					}
				});
			}
		}
	}

})(jQuery);
(function ($) {
    "use strict";

    $(window).on('load', function () {
        qodefSubscribeModal.init();
    });

    var qodefSubscribeModal = {
        init: function () {
            this.holder = $('#qodef-subscribe-popup-modal');

            if (this.holder.length) {
                var $preventHolder = this.holder.find('.qodef-sp-prevent'),
                    $modalClose = $('.qodef-sp-close'),
                    disabledPopup = 'no';

                if ($preventHolder.length) {
                    var isLocalStorage = this.holder.hasClass('qodef-sp-prevent-cookies'),
                        $preventInput = $preventHolder.find('.qodef-sp-prevent-input'),
                        preventValue = $preventInput.data('value');

                    if (isLocalStorage) {
                        disabledPopup = localStorage.getItem('disabledPopup');
                        sessionStorage.removeItem('disabledPopup');
                    } else {
                        disabledPopup = sessionStorage.getItem('disabledPopup');
                        localStorage.removeItem('disabledPopup');
                    }

                    $preventHolder.children().on('click', function (e) {
                        if (preventValue !== 'yes') {
                            preventValue = 'yes';
                            $preventInput.addClass('qodef-sp-prevent-clicked').data('value', 'yes');
                        } else {
                            preventValue = 'no';
                            $preventInput.removeClass('qodef-sp-prevent-clicked').data('value', 'no');
                        }

                        if (preventValue === 'yes') {
                            if (isLocalStorage) {
                                localStorage.setItem('disabledPopup', 'yes');
                            } else {
                                sessionStorage.setItem('disabledPopup', 'yes');
                            }
                        } else {
                            if (isLocalStorage) {
                                localStorage.setItem('disabledPopup', 'no');
                            } else {
                                sessionStorage.setItem('disabledPopup', 'no');
                            }
                        }
                    });
                }

                if (disabledPopup !== 'yes') {
                    if (qodefCore.body.hasClass('qodef-sp-opened')) {
                        qodefSubscribeModal.handleClassAndScroll('remove');
                    } else {
                        qodefSubscribeModal.handleClassAndScroll('add');
                    }

                    $modalClose.on('click', function (e) {
                        e.preventDefault();

                        qodefSubscribeModal.handleClassAndScroll('remove');
                    });

                    // Close on escape
                    $(document).keyup(function (e) {
                        if (e.keyCode === 27) { // KeyCode for ESC button is 27
                            qodefSubscribeModal.handleClassAndScroll('remove');
                        }
                    });
                }
            }
        },

        handleClassAndScroll: function (option) {
            if (option === 'remove') {
                qodefCore.body.removeClass('qodef-sp-opened');
                qodefCore.qodefScroll.enable();
            }
            if (option === 'add') {
                qodefCore.body.addClass('qodef-sp-opened');
                qodefCore.qodefScroll.disable();
            }
        },
    };

})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefWishlist.init();
	});
	
	/**
	 * Function object that represents wishlist area popup.
	 * @returns {{init: Function}}
	 */
	var qodefWishlist = {
		init: function () {
			var $wishlistLink = $('.qodef-wishlist .qodef-m-link');
			
			if ($wishlistLink.length) {
				$wishlistLink.each(function () {
					var $thisWishlistLink = $(this),
						wishlistIconHTML = $thisWishlistLink.html(),
						$responseMessage = $thisWishlistLink.siblings('.qodef-m-response');
					
					$thisWishlistLink.off().on('click', function (e) {
						e.preventDefault();
						
						if (qodef.body.hasClass('logged-in')) {
							var itemID = $thisWishlistLink.data('id');
							
							if (itemID !== 'undefined' && !$thisWishlistLink.hasClass('qodef--added')) {
								$thisWishlistLink.html('<span class="fa fa-spinner fa-spin" aria-hidden="true"></span>');
								
								var wishlistData = {
									type: 'add',
									itemID: itemID
								};
								
								$.ajax({
									type: "POST",
									url: qodefGlobal.vars.restUrl + qodefGlobal.vars.wishlistRestRoute,
									data: {
										options: wishlistData
									},
									beforeSend: function (request) {
										request.setRequestHeader('X-WP-Nonce', qodefGlobal.vars.wishlistNonce);
									},
									success: function (response) {
										
										if (response.status === 'success') {
											$thisWishlistLink.addClass('qodef--added');
											$responseMessage.html(response.message).addClass('qodef--show').fadeIn(200);
											
											$(document).trigger('makao_core_wishlist_item_is_added', [itemID, response.data.user_id]);
										} else {
											$responseMessage.html(response.message).addClass('qodef--show').fadeIn(200);
										}
										
										setTimeout(function () {
											$thisWishlistLink.html(wishlistIconHTML);
											
											var $wishlistTitle = $thisWishlistLink.find('.qodef-m-link-label');
											
											if ($wishlistTitle.length) {
												$wishlistTitle.text($wishlistTitle.data('added-title'));
											}
											
											$responseMessage.fadeOut(300).removeClass('qodef--show').empty();
										}, 800);
									}
								});
							}
						} else {
							// Trigger event.
							$(document.body).trigger('open_user_login_trigger');
						}
					});
				});
			}
		}
	};
	
	$(document).on('makao_core_wishlist_item_is_removed', function (e, removedItemID) {
		var $wishlistLink = $('.qodef-wishlist .qodef-m-link');
		
		if ($wishlistLink.length) {
			$wishlistLink.each(function(){
				var $thisWishlistLink = $(this),
					$wishlistTitle = $thisWishlistLink.find('.qodef-m-link-label');
				
				if ($thisWishlistLink.data('id') === removedItemID && $thisWishlistLink.hasClass('qodef--added')) {
					$thisWishlistLink.removeClass('qodef--added');
					
					if ($wishlistTitle.length) {
						$wishlistTitle.text($wishlistTitle.data('title'));
					}
				}
			});
		}
	});
	
})(jQuery);
(function ($) {
	"use strict";

	qodefCore.shortcodes.makao_core_accordion = {};

	$(document).ready(function () {
		qodefAccordion.init();
	});
	
	var qodefAccordion = {
		init: function () {
			this.holder = $('.qodef-accordion');
			
			if (this.holder.length) {
				this.holder.each(function () {
					var $thisHolder = $(this);
					
					if ($thisHolder.hasClass('qodef-behavior--accordion')) {
						qodefAccordion.initAccordion($thisHolder);
					}
					
					if ($thisHolder.hasClass('qodef-behavior--toggle')) {
						qodefAccordion.initToggle($thisHolder);
					}
					
					$thisHolder.addClass('qodef--init');
				});
			}
		},
		initAccordion: function ($accordion) {
			$accordion.accordion({
				animate: "swing",
				collapsible: true,
				active: 0,
				icons: "",
				heightStyle: "content"
			});
		},
		initToggle: function ($toggle) {
			var $toggleAccordionTitle = $toggle.find('.qodef-accordion-title'),
				$toggleAccordionContent = $toggleAccordionTitle.next();
			
			$toggle.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
			$toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
			$toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();
			
			$toggleAccordionTitle.each(function () {
				var $thisTitle = $(this);
				
				$thisTitle.hover(function () {
					$thisTitle.toggleClass("ui-state-hover");
				});
				
				$thisTitle.on('click', function () {
					$thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
					$thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
				});
			});
		}
	};

	qodefCore.shortcodes.makao_core_accordion.qodefAccordion = qodefAccordion;

})(jQuery);
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
(function ($) {
    "use strict";

    qodefCore.shortcodes.makao_core_alternating_banner = {};

    $(document).ready(function () {
        qodefAlternatingBanner.init();
    });

    var qodefAlternatingBanner = {
        init: function () {
            var $holder = $('.qodef-alternating-banner');

            if ( $holder.length ) {
                $holder.each(function () {
                    var $thisHolder = $(this);

                    qodefAlternatingBanner.appearAnimation( $thisHolder );
                });
            }
        },
        appearAnimation: function ( $thisHolder ) {

            if ( $thisHolder.hasClass('qodef-appear-animation') ) {
                $thisHolder.appear(function() {
                    $thisHolder.addClass('qodef-appear');
                }, { accX: 0, accY: -200 });
            }
        }
    };

    qodefCore.shortcodes.makao_core_alternating_banner.qodefAlternatingBanner = qodefAlternatingBanner;

})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefAuthorListPagination.init();
	});
	
	$(window).scroll(function () {
		qodefAuthorListPagination.scroll();
	});
	
	$(document).on('makao_core_trigger_author_load_more', function (e, $holder, nextPage) {
		qodefAuthorListPagination.triggerLoadMore($holder, nextPage);
	});
	
	/*
	 **	Init pagination functionality
	 */
	var qodefAuthorListPagination = {
		init: function (settings) {
			this.holder = $('.qodef-author-pagination--on');
			
			// Allow overriding the default config
			$.extend(this.holder, settings);
			
			if (this.holder.length) {
				this.holder.each(function () {
					var $holder = $(this);
					
					qodefAuthorListPagination.initPaginationType($holder);
				});
			}
		},
		scroll: function (settings) {
			this.holder = $('.qodef-author-pagination--on');
			
			// Allow overriding the default config
			$.extend(this.holder, settings);
			
			if (this.holder.length) {
				this.holder.each(function () {
					var $holder = $(this);
					
					if ($holder.hasClass('qodef-pagination-type--infinite-scroll')) {
						qodefAuthorListPagination.initInfiniteScroll($holder);
					}
				});
			}
		},
		initPaginationType: function ($holder) {
			if ($holder.hasClass('qodef-pagination-type--standard')) {
				qodefAuthorListPagination.initStandard($holder);
			} else if ($holder.hasClass('qodef-pagination-type--load-more')) {
				qodefAuthorListPagination.initLoadMore($holder);
			} else if ($holder.hasClass('qodef-pagination-type--infinite-scroll')) {
				qodefAuthorListPagination.initInfiniteScroll($holder);
			}
		},
		initStandard: function ($holder) {
			var $paginationItems = $holder.find('.qodef-m-pagination-items');
			
			if ($paginationItems.length) {
				var options = $holder.data('options');
				
				$paginationItems.children().each(function () {
					var $thisItem = $(this),
						$itemLink = $thisItem.children('a');
					
					qodefAuthorListPagination.changeStandardState($holder, options.max_num_pages, 1);
					
					$itemLink.on('click', function (e) {
						e.preventDefault();
						
						if (!$thisItem.hasClass('qodef--active')) {
							qodefAuthorListPagination.getNewPosts($holder, $itemLink.data('paged'));
						}
					});
				});
			}
		},
		changeStandardState: function ($holder, max_num_pages, nextPage) {
			if ($holder.hasClass('qodef-pagination-type--standard')) {
				var $paginationNav = $holder.find('.qodef-m-pagination-items'),
					$numericItem = $paginationNav.children('.qodef--number'),
					$prevItem = $paginationNav.children('.qodef--prev'),
					$nextItem = $paginationNav.children('.qodef--next');
				
				$numericItem.removeClass('qodef--active').eq(nextPage - 1).addClass('qodef--active');
				
				$prevItem.children().data('paged', nextPage - 1);
				
				if (nextPage > 1) {
					$prevItem.show();
				} else {
					$prevItem.hide();
				}
				
				$nextItem.children().data('paged', nextPage + 1);
				
				if (nextPage === max_num_pages) {
					$nextItem.hide();
				} else {
					$nextItem.show();
				}
			}
		},
		initLoadMore: function ($holder) {
			var $loadMoreButton = $holder.find('.qodef-load-more-button');
			
			$loadMoreButton.on('click', function (e) {
				e.preventDefault();
				
				qodefAuthorListPagination.getNewPosts($holder);
			});
		},
		triggerLoadMore: function ($holder, nextPage) {
			qodefAuthorListPagination.getNewPosts($holder, nextPage);
		},
		hideLoadMoreButton: function ($holder, options) {
			if ($holder.hasClass('qodef-pagination-type--load-more') && options.next_page > options.max_num_pages) {
				$holder.find('.qodef-load-more-button').hide();
			}
		},
		initInfiniteScroll: function ($holder) {
			var holderEndPosition = $holder.outerHeight() + $holder.offset().top,
				scrollPosition = qodefCore.scroll + qodefCore.windowHeight,
				options = $holder.data('options');
			
			if (!$holder.hasClass('qodef--loading') && scrollPosition > holderEndPosition  && options.max_num_pages >= options.next_page) {
				qodefAuthorListPagination.getNewPosts($holder);
			}
		},
		getNewPosts: function ($holder, nextPage) {
			$holder.addClass('qodef--loading');
			
			var $itemsHolder = $holder.children('.qodef-grid-inner');
			var options = $holder.data('options');
			
			qodefAuthorListPagination.setNextPageValue(options, nextPage, false);
			
			$.ajax({
				type: "GET",
				url: qodefGlobal.vars.restUrl + qodefGlobal.vars.authorPaginationRestRoute,
				data: {
					options: options
				},
				beforeSend: function( request ) {
					request.setRequestHeader( 'X-WP-Nonce', qodefGlobal.vars.authorPaginationNonce );
				},
				success: function (response) {
					
					if (response.status === 'success') {
						qodefAuthorListPagination.setNextPageValue(options, nextPage, true);
						qodefAuthorListPagination.changeStandardState($holder, options.max_num_pages, nextPage);
						
						$itemsHolder.waitForImages(function () {
							qodefAuthorListPagination.addPosts($itemsHolder, response.data, nextPage);

							qodefCore.body.trigger('makao_core_trigger_get_new_authors', [$holder]);
						});
						
						qodefAuthorListPagination.hideLoadMoreButton($holder, options);
					} else {
						console.log(response.message);
					}
				},
				complete: function () {
					$holder.removeClass('qodef--loading');
				}
			});
		},
		setNextPageValue: function (options, nextPage, ajaxTrigger) {
			if (typeof nextPage !== 'undefined' && nextPage !== '' && !ajaxTrigger) {
				options.next_page = nextPage;
			} else if (ajaxTrigger) {
				options.next_page = parseInt(options.next_page, 10) + 1;
			}
		},
		addPosts: function ($itemsHolder, newItems, nextPage) {
			if (typeof nextPage !== 'undefined' && nextPage !== '') {
				$itemsHolder.html(newItems);
			} else {
				$itemsHolder.append(newItems);
			}
		}
	};
	
})(jQuery);
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
(function ($) {
	"use strict";

	qodefCore.shortcodes.makao_core_cards_gallery = {};

	$(document).ready(function () {
		qodefCardsGallery.init();
	});
	
	var qodefCardsGallery = {
		init: function () {
			this.holder = $('.qodef-cards-gallery');
			
			if (this.holder.length) {
				this.holder.each(function () {
					var $thisHolder = $(this);
					qodefCardsGallery.initCards( $thisHolder );
					qodefCardsGallery.initBundle( $thisHolder );
				});
			}
		},
		initCards: function ($holder) {
			var $cards = $holder.find('.qodef-m-card');
			$cards.each(function () {
				var $card = $(this);
				
				$card.on('click', function () {
					if (!$cards.last().is($card)) {
						$card.addClass('qodef-out qodef-animating').siblings().addClass('qodef-animating-siblings');
						$card.detach();
						$card.insertAfter($cards.last());
						
						setTimeout(function () {
							$card.removeClass('qodef-out');
						}, 200);
						
						setTimeout(function () {
							$card.removeClass('qodef-animating').siblings().removeClass('qodef-animating-siblings');
						}, 1200);
						
						$cards = $holder.find('.qodef-m-card');
						
						return false;
					}
				});
				
				
			});
		},
		initBundle: function($holder) {
			if ($holder.hasClass('qodef-animation--bundle') && !qodefCore.html.hasClass('touchevents')) {
				$holder.appear(function () {
					$holder.addClass('qodef-appeared');
					$holder.find('img').one('animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd', function () {
						$(this).addClass('qodef-animation-done');
					});
				}, {accX: 0, accY: -100});
			}
		}
	};

	qodefCore.shortcodes.makao_core_cards_gallery.qodefCardsGallery  = qodefCardsGallery;
	
})(jQuery);
(function ($) {
	"use strict";

	qodefCore.shortcodes.makao_core_countdown = {};

	$(document).ready(function () {
		qodefCountdown.init();
	});
	
	var qodefCountdown = {
		init: function () {
			this.countdowns = $('.qodef-countdown');
			
			if (this.countdowns.length) {
				this.countdowns.each(function () {
					var $thisCountdown = $(this),
						$countdownElement = $thisCountdown.find('.qodef-m-date'),
						options = qodefCountdown.generateOptions($thisCountdown);
					
					qodefCountdown.initCountdown($countdownElement, options);
				});
			}
		},
		generateOptions: function($countdown) {
			var options = {};
			options.date = typeof $countdown.data('date') !== 'undefined' ? $countdown.data('date') : null;
			
			options.weekLabel = typeof $countdown.data('week-label') !== 'undefined' ? $countdown.data('week-label') : '';
			options.weekLabelPlural = typeof $countdown.data('week-label-plural') !== 'undefined' ? $countdown.data('week-label-plural') : '';
			
			options.dayLabel = typeof $countdown.data('day-label') !== 'undefined' ? $countdown.data('day-label') : '';
			options.dayLabelPlural = typeof $countdown.data('day-label-plural') !== 'undefined' ? $countdown.data('day-label-plural') : '';
			
			options.hourLabel = typeof $countdown.data('hour-label') !== 'undefined' ? $countdown.data('hour-label') : '';
			options.hourLabelPlural = typeof $countdown.data('hour-label-plural') !== 'undefined' ? $countdown.data('hour-label-plural') : '';
			
			options.minuteLabel = typeof $countdown.data('minute-label') !== 'undefined' ? $countdown.data('minute-label') : '';
			options.minuteLabelPlural = typeof $countdown.data('minute-label-plural') !== 'undefined' ? $countdown.data('minute-label-plural') : '';
			
			options.secondLabel = typeof $countdown.data('second-label') !== 'undefined' ? $countdown.data('second-label') : '';
			options.secondLabelPlural = typeof $countdown.data('second-label-plural') !== 'undefined' ? $countdown.data('second-label-plural') : '';
			
			return options;
		},
		initCountdown: function ($countdownElement, options) {
			var $weekHTML = '<span class="qodef-digit-wrapper"><span class="qodef-digit">%w</span><span class="qodef-label">' + '%!w:' + options.weekLabel + ',' + options.weekLabelPlural + ';</span></span>';
			var $dayHTML = '<span class="qodef-digit-wrapper"><span class="qodef-digit">%d</span><span class="qodef-label">' + '%!d:' + options.dayLabel + ',' + options.dayLabelPlural + ';</span></span>';
			var $hourHTML = '<span class="qodef-digit-wrapper"><span class="qodef-digit">%H</span><span class="qodef-label">' + '%!H:' + options.hourLabel + ',' + options.hourLabelPlural + ';</span></span>';
			var $minuteHTML = '<span class="qodef-digit-wrapper"><span class="qodef-digit">%M</span><span class="qodef-label">' + '%!M:' + options.minuteLabel + ',' + options.minuteLabelPlural + ';</span></span>';
			var $secondHTML = '<span class="qodef-digit-wrapper"><span class="qodef-digit">%S</span><span class="qodef-label">' + '%!S:' + options.secondLabel + ',' + options.secondLabelPlural + ';</span></span>';
			
			$countdownElement.countdown(options.date, function(event) {
				$(this).html(event.strftime($weekHTML + $dayHTML + $hourHTML + $minuteHTML + $secondHTML));
			});
		}
	};

	qodefCore.shortcodes.makao_core_countdown.qodefCountdown  = qodefCountdown;


})(jQuery);
(function ($) {
	"use strict";

	qodefCore.shortcodes.makao_core_counter = {};

	$(document).ready(function () {
		qodefCounter.init();
	});
	
	var qodefCounter = {
		init: function () {
			this.counters = $('.qodef-counter');
			
			if (this.counters.length) {
				this.counters.each(function () {
					var $thisCounter = $(this),
						$counterElement = $thisCounter.find('.qodef-m-digit'),
						options = qodefCounter.generateOptions($thisCounter);
					
					qodefCounter.counterScript($counterElement, options);
				});
			}
		},
		generateOptions: function($counter) {
			var options = {};
			options.start = typeof $counter.data('start-digit') !== 'undefined' && $counter.data('start-digit') !== '' ? $counter.data('start-digit') : 0;
			options.end = typeof $counter.data('end-digit') !== 'undefined' && $counter.data('end-digit') !== '' ? $counter.data('end-digit') : null;
			options.step = typeof $counter.data('step-digit') !== 'undefined' && $counter.data('step-digit') !== '' ? $counter.data('step-digit') : 1;
			options.delay = typeof $counter.data('step-delay') !== 'undefined' && $counter.data('step-delay') !== '' ? parseInt( $counter.data('step-delay'), 10 ) : 100;
			options.txt = typeof $counter.data('digit-label') !== 'undefined' && $counter.data('digit-label') !== '' ? $counter.data('digit-label') : '';
			
			return options;
		},
		counterScript: function ($counterElement, options) {
			var defaults = {
				start: 0,
				end: null,
				step: 1,
				delay: 100,
				txt: ""
			};
			
			var settings = $.extend(defaults, options || {});
			var nb_start = settings.start;
			var nb_end = settings.end;
			
			$counterElement.text(nb_start + settings.txt);
			
			var counter = function() {
				// Definition of conditions of arrest
				if (nb_end !== null && nb_start >= nb_end) {
					return;
				}
				// incrementation
				nb_start = nb_start + settings.step;
				
				if( nb_start >= nb_end ) {
					nb_start = nb_end;
				}
				// display
				$counterElement.text(nb_start + settings.txt);
			};
			
			// Timer
			// Launches every "settings.delay"
			$counterElement.appear(function() {
				setInterval(counter, settings.delay);
			}, { accX: 0, accY: 0 });
		}
	};

	qodefCore.shortcodes.makao_core_counter.qodefCounter  = qodefCounter;

})(jQuery);
(function ($) {
    "use strict";

    qodefCore.shortcodes.makao_core_custom_font = {};

    $(document).ready(function () {
        qodefCustomFont.init();
    });

    var qodefCustomFont = {
        init: function () {
            var $holder = $('.qodef-custom-font');

            if ( $holder ) {
                $holder.each(function () {
                    var $thisHolder = $(this);

                    qodefCustomFont.initAnimation( $thisHolder );
                });
            }
        },
        initAnimation: function ( $thisHolder ) {
            if ( $thisHolder.hasClass('qodef-appear-animation') ) {
                var $textContent = $thisHolder.text().trim(),
                    $textArray = $textContent.split(''),
                    $textArrayLength = $textArray.length - 1;

                $thisHolder.empty();

                $textArray.forEach(function ($item, $index) {
                    if ($item === ' ') {
                        $thisHolder.append('<span class="qodef-m-char qodef--empty-char">' + $item + '</span>')
                    } else {
                        $thisHolder.append('<span class="qodef-m-char">' + $item + '</span>')
                    }

                    if ($index === $textArrayLength) {
                        setTimeout(function () {
                            $thisHolder.addClass('qodef-custom-font--animated');

                            qodefCustomFont.initAppear($thisHolder);
                        }, 500);
                    }
                });
            }
        },
        initAppear: function ( $thisHolder ) {
            var appearOffsetY = 50;

            if ( $thisHolder.offset().top > qodef.windowHeight * .8 && $thisHolder.offset().top < qodef.windowHeight * 2 ) {
                appearOffsetY = -200;
            }

            $thisHolder.appear(function () {
                $thisHolder.find('.qodef-m-char:not(.qodef--empty-char)').each( function ($i) {
                    var $thisItem = $(this);

                    setTimeout(function () {
                        $thisItem.addClass('qodef--show');
                    }, $i * 100);
                });
            }, { accX: 0, accY: appearOffsetY });
        }
    };

    qodefCore.shortcodes.makao_core_custom_font.qodefCustomFont = qodefCustomFont;

})(jQuery);
(function ($) {
	'use strict';

	qodefCore.shortcodes.makao_core_frame_slider = {};

	$(document).ready(function () {
		qodefFrameSlider.init();
	});
	
	var qodefFrameSlider = {
		init: function () {
			this.holder = $('.qodef-frame-slider-holder');
			
			if (this.holder.length) {
				this.holder.each(function () {
					var $thisHolder = $(this);
					
					qodefFrameSlider.createSlider($thisHolder);
				});
			}
		},
		
		createSlider: function ($holder) {
			var $swiperHolder = $holder.find('.qodef-m-swiper'),
				$sliderHolder = $holder.find('.qodef-m-items'),
				$pagination = $holder.find('.swiper-pagination');
			
			var $swiper = new Swiper($swiperHolder, {
				slidesPerView: 'auto',
				centeredSlides: true,
				spaceBetween: 0,
				autoplay: true,
				loop: true,
				speed: 800,
				pagination: {
					el: $pagination,
					type: 'bullets',
					clickable: true
				},
				on: {
					init: function () {
						setTimeout(function () {
                            $sliderHolder.addClass('qodef-swiper--initialized');
                        }, 1500);
					}
				}
			});
		}
	};

	qodefCore.shortcodes.makao_core_frame_slider.qodefFrameSlider  = qodefFrameSlider;

})(jQuery);
(function ($) {
	"use strict";

	qodefCore.shortcodes.makao_core_google_map = {};

	$(document).ready(function () {
		qodefGoogleMap.init();
	});

	var qodefGoogleMap = {
		init: function () {
			this.holder = $('.qodef-google-map');

			if (this.holder.length) {
				this.holder.each(function () {
					if (typeof window.qodefGoogleMap !== 'undefined') {
						window.qodefGoogleMap.initMap($(this).find('.qodef-m-map'));
					}
				});
			}
		}
	};

	qodefCore.shortcodes.makao_core_google_map.qodefGoogleMap  = qodefGoogleMap;
})(jQuery);
(function ($) {
    "use strict";

	qodefCore.shortcodes.makao_core_icon = {};

    $(document).ready(function () {
        qodefIcon.init();
    });

    var qodefIcon = {
        init: function () {
            this.icons = $('.qodef-icon-holder');

            if (this.icons.length) {
                this.icons.each(function () {
                    var $thisIcon = $(this);

                    qodefIcon.iconHoverColor($thisIcon);
                    qodefIcon.iconHoverBgColor($thisIcon);
                    qodefIcon.iconHoverBorderColor($thisIcon);
                });
            }
        },
        iconHoverColor: function ($iconHolder) {
            if (typeof $iconHolder.data('hover-color') !== 'undefined') {
                var spanHolder = $iconHolder.find('span');
                var originalColor = spanHolder.css('color');
                var hoverColor = $iconHolder.data('hover-color');

                $iconHolder.on('mouseenter', function () {
                    qodefIcon.changeColor(spanHolder, 'color', hoverColor);
                });
                $iconHolder.on('mouseleave', function () {
                    qodefIcon.changeColor(spanHolder, 'color', originalColor);
                });
            }
        },
        iconHoverBgColor: function ($iconHolder) {
            if (typeof $iconHolder.data('hover-background-color') !== 'undefined') {
                var hoverBackgroundColor = $iconHolder.data('hover-background-color');
                var originalBackgroundColor = $iconHolder.css('background-color');

                $iconHolder.on('mouseenter', function () {
                    qodefIcon.changeColor($iconHolder, 'background-color', hoverBackgroundColor);
                });
                $iconHolder.on('mouseleave', function () {
                    qodefIcon.changeColor($iconHolder, 'background-color', originalBackgroundColor);
                });
            }
        },
        iconHoverBorderColor: function ($iconHolder) {
            if (typeof $iconHolder.data('hover-border-color') !== 'undefined') {
                var hoverBorderColor = $iconHolder.data('hover-border-color');
                var originalBorderColor = $iconHolder.css('borderTopColor');

                $iconHolder.on('mouseenter', function () {
                    qodefIcon.changeColor($iconHolder, 'border-color', hoverBorderColor);
                });
                $iconHolder.on('mouseleave', function () {
                    qodefIcon.changeColor($iconHolder, 'border-color', originalBorderColor);
                });
            }
        },
        changeColor: function (iconElement, cssProperty, color) {
            iconElement.css(cssProperty, color);
        }
    };

	qodefCore.shortcodes.makao_core_icon.qodefIcon = qodefIcon;

})(jQuery);
(function ($) {
    "use strict";
	qodefCore.shortcodes.makao_core_image_gallery = {};
	qodefCore.shortcodes.makao_core_image_gallery.qodefSwiper = qodef.qodefSwiper;
	qodefCore.shortcodes.makao_core_image_gallery.qodefMasonryLayout = qodef.qodefMasonryLayout;

})(jQuery);
(function ($) {
    "use strict";

    qodefCore.shortcodes.makao_core_image_with_text = {};

    $(document).ready(function () {
        qodefImageWithText.init();
    });

    var qodefImageWithText = {
        init: function () {
            var $holder = $('.qodef-image-with-text');

            if ( $holder.length ) {
                $holder.each(function () {
                    var $thisHolder = $(this);

                    qodefImageWithText.scrollAnimation( $thisHolder );
                });
            }
        },
        scrollAnimation: function ( $thisHolder ) {
            if ( $thisHolder.hasClass('qodef-image-action--scrolling-image') ) {
                var $imageHolder = $thisHolder.find('.qodef-m-image'),
                    $frame = $thisHolder.find('.qodef-m-frame'),
                    $frameHeight,
                    $frameWidth,
                    $image = $thisHolder.find('.qodef-m-image-holder-inner > a > img, .qodef-m-image-holder-inner > img'),
                    $imageHeight,
                    $imageWidth,
                    $delta,
                    $timing,
                    $scrollable = false,
                    $horizontal = $thisHolder.hasClass('qodef-scrolling--horizontal');

                var setSize = function() {
                    $frameHeight = $frame.height();
                    $imageHeight = $image.height();
                    $frameWidth  = $frame.width();
                    $imageWidth  = $image.width();

                    if ( $horizontal ) {
                        $delta = Math.round($imageWidth - $frameWidth);
                        $timing = Math.round($imageWidth / $frameWidth) * 2;
                    } else {
                        $delta = Math.round($imageHeight - $frameHeight);
                        $timing = Math.round($imageHeight / $frameHeight) * 2;
                    }

                    if ( $horizontal ) {
                        if ( $imageWidth > $frameWidth ) {
                            $scrollable = true;
                        }
                    } else {
                        if ( $imageHeight > $frameHeight ) {
                            $scrollable = true;
                        }
                    }
                };

                var initAnimation = function() {
                    $imageHolder.on('mouseenter', function() {
                        $image.css('transition-duration', $timing + 's');

                        if ( $horizontal ) {
                            $image.css('transform', 'translate3d(-' + $delta + 'px, 0px, 0px)');
                        } else {
                            $image.css('transform', 'translate3d(0px, -' + $delta + 'px, 0px)');
                        }});

                    $imageHolder.on('mouseleave', function() {
                        if ( $scrollable ) {
                            $image.css('transition-duration', Math.min($timing / 3, 3) + 's');
                            $image.css('transform', 'translate3d(0px, 0px, 0px)');
                        }
                    });
                };

                $thisHolder.waitForImages( function() {
                    $thisHolder.css('visibility', 'visible');
                    setSize();
                    initAnimation();
                });

                $(window).resize(function(){
                    setSize();
                });
            }
        }
    };

    qodefCore.shortcodes.makao_core_image_with_text.qodefImageWithText = qodefImageWithText;

})(jQuery);
(function ($) {
    "use strict";

	qodefCore.shortcodes.makao_core_interactive_link_showcase = {};

})(jQuery);
(function ($) {
    "use strict";
	
	qodefCore.shortcodes.makao_core_item_showcase = {};
	
	$(document).ready(function () {
		qodefItemShowcaseList.init();
	});
	
	var qodefItemShowcaseList = {
		init: function () {
			this.holder = $('.qodef-item-showcase');
			
			if (this.holder.length) {
				this.holder.each(function () {
					var $thisHolder = $(this);
					
					$thisHolder.appear(function(){
						$thisHolder.addClass('qodef--init');
					}, {accX: 0, accY: -100});
				});
			}
		}
	};
	qodefCore.shortcodes.makao_core_item_showcase.qodefItemShowcaseList = qodefItemShowcaseList;

})(jQuery);
(function ($) {
	'use strict';

	qodefCore.shortcodes.makao_core_progress_bar = {};

	$(document).ready(function () {
		qodefProgressBar.init();
	});

	/**
	 * Init progress bar shortcode functionality
	 */
	var qodefProgressBar = {
		init: function () {
			this.holder = $('.qodef-progress-bar');

			if (this.holder.length) {
				this.holder.each(function () {
					var $thisHolder = $(this),
						layout = $thisHolder.data('layout');
					
					$thisHolder.appear(function () {
						$thisHolder.addClass('qodef--init');
						
						var $container = $thisHolder.find('.qodef-m-canvas'),
							data = qodefProgressBar.generateBarData($thisHolder, layout),
							number = $thisHolder.data('number') / 100;
						
						switch (layout) {
							case 'circle':
								qodefProgressBar.initCircleBar($container, data, number);
								break;
							case 'semi-circle':
								qodefProgressBar.initSemiCircleBar($container, data, number);
								break;
							case 'line':
								data = qodefProgressBar.generateLineData($thisHolder, number);
								qodefProgressBar.initLineBar($container, data);
								break;
							case 'custom':
								qodefProgressBar.initCustomBar($container, data, number);
								break;
						}
					});
				});
			}
		},
		generateBarData: function (thisBar, layout) {
			var activeWidth = thisBar.data('active-line-width');
			var activeColor = thisBar.data('active-line-color');
			var inactiveWidth = thisBar.data('inactive-line-width');
			var inactiveColor = thisBar.data('inactive-line-color');
			var easing = 'linear';
			var duration = typeof thisBar.data('duration') !== 'undefined' && thisBar.data('duration') !== '' ? parseInt(thisBar.data('duration'), 10) : 1600;
			var textColor = thisBar.data('text-color');

			return {
				strokeWidth: activeWidth,
				color: activeColor,
				trailWidth: inactiveWidth,
				trailColor: inactiveColor,
				easing: easing,
				duration: duration,
				svgStyle: {
					width: '100%',
					height: '100%'
				},
				text: {
					style: {
						color: textColor
					},
					autoStyleContainer: false
				},
				from: {
					color: inactiveColor
				},
				to: {
					color: activeColor
				},
				step: function (state, bar) {
					if (layout !== 'custom') {
						bar.setText(Math.round(bar.value() * 100) + '%');
					}
				}
			};
		},
		generateLineData: function (thisBar, number) {
			var height = thisBar.data('active-line-width');
			var activeColor = thisBar.data('active-line-color');
			var inactiveHeight = thisBar.data('inactive-line-width');
			var inactiveColor = thisBar.data('inactive-line-color');
			var duration = typeof thisBar.data('duration') !== 'undefined' && thisBar.data('duration') !== '' ? parseInt(thisBar.data('duration'), 10) : 1600;
			var textColor = thisBar.data('text-color');

			return {
				percentage: number * 100,
				duration: duration,
				fillBackgroundColor: activeColor,
				backgroundColor: inactiveColor,
				height: height,
				inactiveHeight: inactiveHeight,
				followText: thisBar.hasClass('qodef-percentage--floating'),
				textColor: textColor
			};
		},
		initCircleBar: function ($container, data, number) {
			var $bar = new ProgressBar.Circle($container[0], data);
			
			$bar.animate(number);
		},
		initSemiCircleBar: function ($container, data, number) {
			var $bar = new ProgressBar.SemiCircle($container[0], data);

			$bar.animate(number);
		},
		initCustomBar: function ($container, data, number) {
			var $bar = new ProgressBar.Path($container[0], data);
			$bar.set(0);

			$bar.animate(number);
		},
		initLineBar: function ($container, data) {
			$container.LineProgressbar(data);
		}
	};

	qodefCore.shortcodes.makao_core_progress_bar.qodefProgressBar = qodefProgressBar;

})(jQuery);
(function ($) {
    "use strict";

    qodefCore.shortcodes.makao_core_section_title = {};

    $(document).ready(function () {
        qodefSectionTitle.init();
    });

    var qodefSectionTitle = {
        init: function () {
            var $holder = $('.qodef-section-title');

            if ( $holder.length ) {
                $holder.each(function () {
                    var $thisHolder = $(this);

                    qodefSectionTitle.appearAnimation( $thisHolder );
                });
            }
        },
        appearAnimation: function ( $thisHolder ) {

            if ( $thisHolder.hasClass('qodef-appear-animation') ) {
                $thisHolder.appear(function() {
                    $thisHolder.addClass('qodef-appear');
                }, { accX: 0, accY: 0 });
            }
        }
    };

    qodefCore.shortcodes.makao_core_section_title.qodefSectionTitle = qodefSectionTitle;


})(jQuery);
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
(function ($) {
	'use strict';

	qodefCore.shortcodes.makao_core_stamp = {};

	$(document).ready(function () {
		qodefInitStamp.init();
	});
	
	/**
	 * Inti stamp shortcode on appear
	 */
	var qodefInitStamp = {
		init: function () {
			this.holder = $('.qodef-stamp');
			
			if (this.holder.length) {
				this.holder.each(function () {
					var $holder = $(this),
						appearing_delay = typeof $holder.data('appearing-delay') !== 'undefined' ? parseInt($holder.data('appearing-delay'), 10) : 0;
					
					// Initialization
                    qodefInitStamp.initStampText($holder);
					qodefInitStamp.load($holder, appearing_delay);
					
					if ($holder.hasClass('qodef--repeating')) {
						setInterval(function () {
							qodefInitStamp.reLoad($holder);
						}, 5500);
					}
				});
			}
		},
		initStampText: function ($holder) {
			var $stamp = $holder.children('.qodef-m-text'),
				count = typeof $holder.data('appearing-delay') !== 'undefined' ? parseInt($stamp.data('count'), 10) : 1;
			
			$stamp.children().each(function (i) {
				var transform = -90 + i * 360 / count,
					transitionDelay = i * 60 / count * 10;
				
				$(this).css({
					'transform': 'rotate(' + transform + 'deg) translateZ(0)',
					'transition-delay': transitionDelay + 'ms'
				});
			});
		},
		load: function ($holder, appearing_delay) {
			if ($holder.hasClass('qodef--nested')) {
				setTimeout(function () {
					qodefInitStamp.appear($holder);
				}, appearing_delay);
			} else {
				$holder.appear(function () {
					setTimeout(function () {
						qodefInitStamp.appear($holder);
					}, appearing_delay);
				}, {accX: 0, accY: -100});
			}
		},
		reLoad: function ($holder) {
			$holder.removeClass('qodef--init');
			
			setTimeout(function () {
				$holder.removeClass('qodef--appear');
				
				setTimeout(function () {
					qodefInitStamp.appear($holder);
				}, 500);
			}, 600);
		},
		appear: function ($holder) {
			$holder.addClass('qodef--appear');
			
			setTimeout(function () {
				$holder.addClass('qodef--init');
			}, 300);
		}
	};

	qodefCore.shortcodes.makao_core_stamp.qodefInitStamp = qodefInitStamp;

})(jQuery);
(function ($) {
	"use strict";

	qodefCore.shortcodes.makao_core_swapping_image_gallery = {};

	$(document).ready(function () {
		qodefSwappingImageGallery.init();
	});
	
	var qodefSwappingImageGallery = {
		init: function () {
			this.holder = $('.qodef-swapping-image-gallery');
			
			if (this.holder.length) {
				this.holder.each(function () {
					var $thisHolder = $(this);
					qodefSwappingImageGallery.createSlider($thisHolder);
				});
			}
		},
		createSlider: function ($holder) {
			var $swiperHolder = $holder.find('.qodef-m-image-holder');
			var $paginationHolder = $holder.find('.qodef-m-thumbnails-holder .qodef-m-thumbnails-holder-inner');
			var spaceBetween = 0;
			var slidesPerView = 1;
			var centeredSlides = false;
			var loop = false;
			var autoplay = false;
			var speed = 800;
			
			var $swiper = new Swiper($swiperHolder, {
				slidesPerView: slidesPerView,
				centeredSlides: centeredSlides,
				spaceBetween: spaceBetween,
				autoplay: autoplay,
				loop: loop,
				speed: speed,
				effect: 'fade',
				fadeEffect: {
					crossFade: true
				},
				pagination: {
					el: $paginationHolder,
					type: 'custom',
					clickable: true,
					bulletClass: 'qodef-m-thumbnail'
				},
				on: {
					init: function () {
						$swiperHolder.addClass('qodef-swiper--initialized');
						$paginationHolder.find('.qodef-m-thumbnail').eq(0).addClass('qodef--active');
					},
					slideChange: function slideChange() {
						var swiper = this;
						var activeIndex = swiper.activeIndex;
						$paginationHolder.find('.qodef--active').removeClass('qodef--active');
						$paginationHolder.find('.qodef-m-thumbnail').eq(activeIndex).addClass('qodef--active');
					}
				}
			});

			$paginationHolder.find('.qodef-m-thumbnail').hover(function() {
				$( this ).trigger( "click" );
			});
		}
	};

	qodefCore.shortcodes.makao_core_swapping_image_gallery.qodefSwappingImageGallery = qodefSwappingImageGallery;

})(jQuery);
(function ($) {
	"use strict";

	qodefCore.shortcodes.makao_core_tabs = {};

	$(document).ready(function () {
		qodefTabs.init();
	});
	
	var qodefTabs = {
		init: function () {
			this.holder = $('.qodef-tabs');
			
			if (this.holder.length) {
				this.holder.each(function () {
					qodefTabs.initTabs($(this));
				});
			}
		},
		initTabs: function ($tabs) {
			$tabs.children('.qodef-tabs-content').each(function (index) {
				index = index + 1;
				
				var $that = $(this),
					link = $that.attr('id'),
					$navItem = $that.parent().find('.qodef-tabs-navigation li:nth-child(' + index + ') a'),
					navLink = $navItem.attr('href');
				
				link = '#' + link;
				
				if (link.indexOf(navLink) > -1) {
					$navItem.attr('href', link);
				}
			});
			
			$tabs.addClass('qodef--init').tabs();
		}
	};

	qodefCore.shortcodes.makao_core_tabs.qodefTabs = qodefTabs;

})(jQuery);
(function ($) {
	"use strict";

	qodefCore.shortcodes.makao_core_text_marquee = {};

	$(document).ready(function () {
		qodefTextMarquee.init();
	});
	
	var qodefTextMarquee = {
		init: function () {
			this.holder = $('.qodef-text-marquee');
			
			if (this.holder.length) {
				this.holder.each(function () {
					qodefTextMarquee.initMarquee($(this));
					qodefTextMarquee.initResponsive($(this).find('.qodef-m-content'));
				});
			}
		},
		initResponsive: function (thisMarquee) {
			var fontSize,
				lineHeight,
				coef1 = 1,
				coef2 = 1;
			
			if (qodefCore.windowWidth < 1480) {
				coef1 = 0.8;
			}
			
			if (qodefCore.windowWidth < 1200) {
				coef1 = 0.7;
			}
			
			if (qodefCore.windowWidth < 768) {
				coef1 = 0.55;
				coef2 = 0.65;
			}
			
			if (qodefCore.windowWidth < 600) {
				coef1 = 0.45;
				coef2 = 0.55;
			}
			
			if (qodefCore.windowWidth < 480) {
				coef1 = 0.4;
				coef2 = 0.5;
			}
			
			fontSize = parseInt(thisMarquee.css('font-size'));
			
			if (fontSize > 200) {
				fontSize = Math.round(fontSize * coef1);
			} else if (fontSize > 60) {
				fontSize = Math.round(fontSize * coef2);
			}
			
			thisMarquee.css('font-size', fontSize + 'px');
			
			lineHeight = parseInt(thisMarquee.css('line-height'));
			
			if (lineHeight > 70 && qodefCore.windowWidth < 1440) {
				lineHeight = '1.2em';
			} else if (lineHeight > 35 && qodefCore.windowWidth < 768) {
				lineHeight = '1.2em';
			} else {
				lineHeight += 'px';
			}
			
			thisMarquee.css('line-height', lineHeight);
		},
		initMarquee: function (thisMarquee) {
			var elements = thisMarquee.find('.qodef-m-text'),
				delta = 0.05;
			
			elements.each(function (i) {
				$(this).data('x', 0);
			});
			
			requestAnimationFrame(function () {
				qodefTextMarquee.loop(thisMarquee, elements, delta);
			});
		},
		inRange: function (thisMarquee) {
			if (qodefCore.scroll + qodefCore.windowHeight >= thisMarquee.offset().top && qodefCore.scroll < thisMarquee.offset().top + thisMarquee.height()) {
				return true;
			}
			
			return false;
		},
		loop: function (thisMarquee, elements, delta) {
			if (!qodefTextMarquee.inRange(thisMarquee)) {
				requestAnimationFrame(function () {
					qodefTextMarquee.loop(thisMarquee, elements, delta);
				});
				return false;
			} else {
				elements.each(function (i) {
					var el = $(this);
					el.css('transform', 'translate3d(' + el.data('x') + '%, 0, 0)');
					el.data('x', (el.data('x') - delta).toFixed(2));
					el.offset().left < -el.width() - 25 && el.data('x', 100 * Math.abs(i - 1));
				});
				requestAnimationFrame(function () {
					qodefTextMarquee.loop(thisMarquee, elements, delta);
				});
			}
		}
	};

	qodefCore.shortcodes.makao_core_text_marquee.qodefTextMarquee = qodefTextMarquee;

})(jQuery);
(function ($) {
    "use strict";

	qodefCore.shortcodes.makao_vertical_split_slider = {};

    $(document).ready(function () {
        qodefVerticalSplitSlider.init();
    });

    var qodefVerticalSplitSlider = {
        init: function () {
            var $holder = $('.qodef-vertical-split-slider'),
                breakpoint = qodefVerticalSplitSlider.getBreakpoint($holder),
                initialHeaderStyle = '';

            if (qodefCore.body.hasClass('qodef-header--light')) {
                initialHeaderStyle = 'light';
            } else if (qodefCore.body.hasClass('qodef-header--dark')) {
                initialHeaderStyle = 'dark';
            }

            if ($holder.length) {
                $holder.multiscroll({
                    navigation: true,
                    navigationPosition: 'right',
                    loopBottom: true,
                    loopTop: true,
                    afterRender: function () {
                        qodefCore.body.addClass('qodef-vertical-split-slider--initialized');
                        qodefVerticalSplitSlider.bodyClassHandler($('.ms-left .ms-section:first-child').data('header-skin'), initialHeaderStyle);
                    },
                    onLeave: function (index, nextIndex) {
                        qodefVerticalSplitSlider.bodyClassHandler($($('.ms-left .ms-section')[nextIndex - 1]).data('header-skin'), initialHeaderStyle);
                    }
                });

                $holder.height(qodefCore.windowHeight);
                qodefVerticalSplitSlider.buildAndDestroy(breakpoint);

                $(window).resize(function () {
                    qodefVerticalSplitSlider.buildAndDestroy(breakpoint);
                });
            }
        },
        getBreakpoint: function ($holder) {
            if ($holder.hasClass('qodef-disable-below--768')) {
                return 768;
            } else {
                return 1024;
            }
        },
        buildAndDestroy: function (breakpoint) {
            if (qodefCore.windowWidth <= breakpoint) {
                $.fn.multiscroll.destroy();
                $('html, body').css('overflow', 'initial');
                qodefCore.body.removeClass('qodef-vertical-split-slider--initialized');
            } else {
                $.fn.multiscroll.build();
                qodefCore.body.addClass('qodef-vertical-split-slider--initialized');
            }
        },
        bodyClassHandler: function (slideHeaderStyle, initialHeaderStyle) {
            if (slideHeaderStyle !== undefined && slideHeaderStyle !== '') {
                qodefCore.body.removeClass('qodef-header--light qodef-header--dark').addClass('qodef-header--' + slideHeaderStyle);
            } else if (initialHeaderStyle !== '') {
                qodefCore.body.removeClass('qodef-header--light qodef-header--dark').addClass('qodef-header--' + slideHeaderStyle);
            } else {
                qodefCore.body.removeClass('qodef-header--light qodef-header--dark');
            }
        }
    };

	qodefCore.shortcodes.makao_vertical_split_slider.qodefVerticalSplitSlider = qodefVerticalSplitSlider;

})(jQuery);
(function ($) {

	"use strict";

	qodefCore.shortcodes.makao_core_blog_list = {};

	$(document).ready(function () {
		qodefBlogList.init();
	});

	var qodefBlogList = {
		init: function () {
			this.holder = $('.qodef-blog');

			if (this.holder.length) {
				this.holder.each( function () {
					var $thisHolder = $(this);

					if ( $thisHolder.hasClass('qodef-item-layout--standard') ) {
						qodefBlogList.hoverAnimation( $thisHolder );
					}
				});
			}
		},
		hoverAnimation: function ( $holder ) {
			var $post = $holder.find('article');

			if ( $post.length ) {
				$post.each( function () {
					var $thisPost = $(this),
						$title = $thisPost.find('.qodef-e-title-link');

					$title.on('mouseenter', function() {
						$(this).closest('article').addClass('qodef-active-hover');
					});

					$title.on('mouseleave', function() {
						$(this).closest('article').removeClass('qodef-active-hover');
					});
				});
			}
		}
	};

	qodefCore.shortcodes.makao_core_blog_list.qodefPagination = qodef.qodefPagination;
	qodefCore.shortcodes.makao_core_blog_list.qodefFilter = qodef.qodefFilter;
	qodefCore.shortcodes.makao_core_blog_list.qodefJustifiedGallery = qodef.qodefJustifiedGallery;
	qodefCore.shortcodes.makao_core_blog_list.qodefMasonryLayout = qodef.qodefMasonryLayout;
	qodefCore.shortcodes.makao_core_blog_list.qodefSwiper = qodef.qodefSwiper;
	
})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefVerticalNavMenu.init();
	});
	
	/**
	 * Function object that represents vertical menu area.
	 * @returns {{init: Function}}
	 */
	var qodefVerticalNavMenu = {
		initNavigation: function ($verticalMenuObject) {
			var $verticalNavObject = $verticalMenuObject.find('.qodef-header-vertical-navigation');
			
			if ($verticalNavObject.hasClass('qodef-vertical-drop-down--below')) {
				qodefVerticalNavMenu.dropdownClickToggle($verticalNavObject);
			} else if ($verticalNavObject.hasClass('qodef-vertical-drop-down--side')) {
				qodefVerticalNavMenu.dropdownFloat($verticalNavObject);
			}
		},
		dropdownClickToggle: function ($verticalNavObject) {
			var $menuItems = $verticalNavObject.find('ul li.menu-item-has-children');
			
			$menuItems.each(function () {
				var $elementToExpand = $(this).find(' > .qodef-drop-down-second, > ul');
				var menuItem = this;
				var $dropdownOpener = $(this).find('> a');
				var slideUpSpeed = 'fast';
				var slideDownSpeed = 'slow';
				
				$dropdownOpener.on('click tap', function (e) {
					e.preventDefault();
					e.stopPropagation();
					
					if ($elementToExpand.is(':visible')) {
						$(menuItem).removeClass('qodef-menu-item--open');
						$elementToExpand.slideUp(slideUpSpeed);
					} else if ($dropdownOpener.parent().parent().children().hasClass('qodef-menu-item--open') && $dropdownOpener.parent().parent().parent().hasClass('qodef-vertical-menu')) {
						$(this).parent().parent().children().removeClass('qodef-menu-item--open');
						$(this).parent().parent().children().find(' > .qodef-drop-down-second').slideUp(slideUpSpeed);
						
						$(menuItem).addClass('qodef-menu-item--open');
						$elementToExpand.slideDown(slideDownSpeed);
					} else {
						
						if (!$(this).parents('li').hasClass('qodef-menu-item--open')) {
							$menuItems.removeClass('qodef-menu-item--open');
							$menuItems.find(' > .qodef-drop-down-second, > ul').slideUp(slideUpSpeed);
						}
						
						if ($(this).parent().parent().children().hasClass('qodef-menu-item--open')) {
							$(this).parent().parent().children().removeClass('qodef-menu-item--open');
							$(this).parent().parent().children().find(' > .qodef-drop-down-second, > ul').slideUp(slideUpSpeed);
						}
						
						$(menuItem).addClass('qodef-menu-item--open');
						$elementToExpand.slideDown(slideDownSpeed);
					}
				});
			});
		},
		dropdownFloat: function ($verticalNavObject) {
			var $menuItems = $verticalNavObject.find('ul li.menu-item-has-children');
			var $allDropdowns = $menuItems.find(' > .qodef-drop-down-second > .qodef-drop-down-second-inner > ul, > ul');
			
			$menuItems.each(function () {
				var $elementToExpand = $(this).find(' > .qodef-drop-down-second > .qodef-drop-down-second-inner > ul, > ul');
				var menuItem = this;
				
				if (Modernizr.touch) {
					var $dropdownOpener = $(this).find('> a');
					
					$dropdownOpener.on('click tap', function (e) {
						e.preventDefault();
						e.stopPropagation();
						
						if ($elementToExpand.hasClass('qodef-float--open')) {
							$elementToExpand.removeClass('qodef-float--open');
							$(menuItem).removeClass('qodef-menu-item--open');
						} else {
							if (!$(this).parents('li').hasClass('qodef-menu-item--open')) {
								$menuItems.removeClass('qodef-menu-item--open');
								$allDropdowns.removeClass('qodef-float--open');
							}
							
							$elementToExpand.addClass('qodef-float--open');
							$(menuItem).addClass('qodef-menu-item--open');
						}
					});
				} else {
					//must use hoverIntent because basic hover effect doesn't catch dropdown
					//it doesn't start from menu item's edge
					$(this).hoverIntent({
						over: function () {
							$elementToExpand.addClass('qodef-float--open');
							$(menuItem).addClass('qodef-menu-item--open');
						},
						out: function () {
							$elementToExpand.removeClass('qodef-float--open');
							$(menuItem).removeClass('qodef-menu-item--open');
						},
						timeout: 300
					});
				}
			});
		},
		verticalAreaScrollable: function ($verticalMenuObject) {
			return $verticalMenuObject.hasClass('qodef-with-scroll');
		},
		initVerticalAreaScroll: function ($verticalMenuObject) {
			if (qodefVerticalNavMenu.verticalAreaScrollable($verticalMenuObject) && typeof qodefCore.qodefPerfectScrollbar === 'object') {
				qodefCore.qodefPerfectScrollbar.init($verticalMenuObject);
			}
		},
		init: function () {
			var $verticalMenuObject = $('.qodef-header--vertical #qodef-page-header');
			
			if ($verticalMenuObject.length) {
				qodefVerticalNavMenu.initNavigation($verticalMenuObject);
				qodefVerticalNavMenu.initVerticalAreaScroll($verticalMenuObject);
			}
		}
	};
	
})(jQuery);
(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefVerticalSlidingNavMenu.init();
    });

    /**
     * Function object that represents vertical menu area.
     * @returns {{init: Function}}
     */
    var qodefVerticalSlidingNavMenu = {
        initNavigation: function ($verticalSlidingMenuObject) {
            var $verticalSlidingNavObject = $verticalSlidingMenuObject.find('.qodef-header-vertical-sliding-navigation');

            if ($verticalSlidingNavObject.hasClass('qodef-vertical-sliding-drop-down--below')) {
                qodefVerticalSlidingNavMenu.dropdownClickToggle($verticalSlidingNavObject);
            } else if ($verticalSlidingNavObject.hasClass('qodef-vertical-sliding-drop-down--side')) {
                qodefVerticalSlidingNavMenu.dropdownFloat($verticalSlidingNavObject);
            }
        },
        dropdownClickToggle: function ($verticalSlidingNavObject) {
            var $menuItems = $verticalSlidingNavObject.find('ul li.menu-item-has-children');

            $menuItems.each(function () {
                var $elementToExpand = $(this).find(' > .qodef-drop-down-second, > ul');
                var menuItem = this;
                var $dropdownOpener = $(this).find('> a');
                var slideUpSpeed = 'fast';
                var slideDownSpeed = 'slow';

                $dropdownOpener.on('click tap', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    if ($elementToExpand.is(':visible')) {
                        $(menuItem).removeClass('qodef-menu-item--open');
                        $elementToExpand.slideUp(slideUpSpeed);
                    } else if ($dropdownOpener.parent().parent().children().hasClass('qodef-menu-item--open') && $dropdownOpener.parent().parent().parent().hasClass('qodef-vertical-menu')) {
                        $(this).parent().parent().children().removeClass('qodef-menu-item--open');
                        $(this).parent().parent().children().find(' > .qodef-drop-down-second').slideUp(slideUpSpeed);

                        $(menuItem).addClass('qodef-menu-item--open');
                        $elementToExpand.slideDown(slideDownSpeed);
                    } else {

                        if (!$(this).parents('li').hasClass('qodef-menu-item--open')) {
                            $menuItems.removeClass('qodef-menu-item--open');
                            $menuItems.find(' > .qodef-drop-down-second, > ul').slideUp(slideUpSpeed);
                        }

                        if ($(this).parent().parent().children().hasClass('qodef-menu-item--open')) {
                            $(this).parent().parent().children().removeClass('qodef-menu-item--open');
                            $(this).parent().parent().children().find(' > .qodef-drop-down-second, > ul').slideUp(slideUpSpeed);
                        }

                        $(menuItem).addClass('qodef-menu-item--open');
                        $elementToExpand.slideDown(slideDownSpeed);
                    }
                });
            });
        },
        dropdownFloat: function ($verticalSlidingNavObject) {
            var $menuItems = $verticalSlidingNavObject.find('ul li.menu-item-has-children');
            var $allDropdowns = $menuItems.find(' > .qodef-drop-down-second > .qodef-drop-down-second-inner > ul, > ul');

            $menuItems.each(function () {
                var $elementToExpand = $(this).find(' > .qodef-drop-down-second > .qodef-drop-down-second-inner > ul, > ul');
                var menuItem = this;

                if (Modernizr.touch) {
                    var $dropdownOpener = $(this).find('> a');

                    $dropdownOpener.on('click tap', function (e) {
                        e.preventDefault();
                        e.stopPropagation();

                        if ($elementToExpand.hasClass('qodef-float--open')) {
                            $elementToExpand.removeClass('qodef-float--open');
                            $(menuItem).removeClass('qodef-menu-item--open');
                        } else {
                            if (!$(this).parents('li').hasClass('qodef-menu-item--open')) {
                                $menuItems.removeClass('qodef-menu-item--open');
                                $allDropdowns.removeClass('qodef-float--open');
                            }

                            $elementToExpand.addClass('qodef-float--open');
                            $(menuItem).addClass('qodef-menu-item--open');
                        }
                    });
                } else {
                    //must use hoverIntent because basic hover effect doesn't catch dropdown
                    //it doesn't start from menu item's edge
                    $(this).hoverIntent({
                        over: function () {
                            $elementToExpand.addClass('qodef-float--open');
                            $(menuItem).addClass('qodef-menu-item--open');
                        },
                        out: function () {
                            $elementToExpand.removeClass('qodef-float--open');
                            $(menuItem).removeClass('qodef-menu-item--open');
                        },
                        timeout: 300
                    });
                }
            });
        },
        verticalSlidingAreaScrollable: function ($verticalSlidingMenuObject) {
            return $verticalSlidingMenuObject.hasClass('qodef-with-scroll');
        },
        initVerticalSlidingAreaScroll: function ($verticalSlidingMenuObject) {
            if (qodefVerticalSlidingNavMenu.verticalSlidingAreaScrollable($verticalSlidingMenuObject) && typeof qodefCore.qodefPerfectScrollbar === 'object') {
                qodefCore.qodefPerfectScrollbar.init($verticalSlidingMenuObject);
            }
        },
        verticalSlidingAreaShowHide: function ($verticalSlidingMenuObject) {
            var $verticalSlidingMenuOpener = $verticalSlidingMenuObject.find('.qodef-vertical-sliding-menu-opener');

            $verticalSlidingMenuOpener.on('click', function (e) {
                e.preventDefault();

                if (!$verticalSlidingMenuObject.hasClass('qodef-vertical-sliding-menu--opened')) {
                    $verticalSlidingMenuObject.addClass('qodef-vertical-sliding-menu--opened');
                } else {
                    $verticalSlidingMenuObject.removeClass('qodef-vertical-sliding-menu--opened');
                }
            });
        },
        init: function () {
            var $verticalSlidingMenuObject = $('.qodef-header--vertical-sliding #qodef-page-header');

            if ($verticalSlidingMenuObject.length) {
                qodefVerticalSlidingNavMenu.verticalSlidingAreaShowHide($verticalSlidingMenuObject);
                qodefVerticalSlidingNavMenu.initNavigation($verticalSlidingMenuObject);
                qodefVerticalSlidingNavMenu.initVerticalSlidingAreaScroll($verticalSlidingMenuObject);
            }
        }
    };

})(jQuery);
(function ($) {
	"use strict";
	
	var fixedHeaderAppearance = {
		showHideHeader: function ($pageOuter, $header) {
			if (qodefCore.windowWidth > 1024) {
				if (qodefCore.scroll <= 0) {
					qodefCore.body.removeClass('qodef-header--fixed-display');
					$pageOuter.css('padding-top', '0');
					$header.css('margin-top', '0');
				} else {
					qodefCore.body.addClass('qodef-header--fixed-display');
					$pageOuter.css('padding-top', parseInt(qodefGlobal.vars.headerHeight + qodefGlobal.vars.topAreaHeight) + 'px');
					$header.css('margin-top', parseInt(qodefGlobal.vars.topAreaHeight) + 'px');
				}
			}
		},
		init: function () {
            
            if (!qodefCore.body.hasClass('qodef-header--vertical')) {
                var $pageOuter = $('#qodef-page-outer'),
                    $header = $('#qodef-page-header');
                
                fixedHeaderAppearance.showHideHeader($pageOuter, $header);
                
                $(window).scroll(function () {
                    fixedHeaderAppearance.showHideHeader($pageOuter, $header);
                });
                
                $(window).resize(function () {
                    $pageOuter.css('padding-top', '0');
                    fixedHeaderAppearance.showHideHeader($pageOuter, $header);
                });
            }
		}
	};
	
	qodefCore.fixedHeaderAppearance = fixedHeaderAppearance.init;
	
})(jQuery);
(function ($) {
	"use strict";
	
	var stickyHeaderAppearance = {
		displayAmount: function () {
			if (qodefGlobal.vars.qodefStickyHeaderScrollAmount !== 0) {
				return parseInt(qodefGlobal.vars.qodefStickyHeaderScrollAmount, 10);
			} else {
				return parseInt(qodefGlobal.vars.headerHeight + qodefGlobal.vars.adminBarHeight, 10);
			}
		},
		showHideHeader: function (displayAmount) {
			
			if (qodefCore.scroll < displayAmount) {
				qodefCore.body.removeClass('qodef-header--sticky-display');
			} else {
				qodefCore.body.addClass('qodef-header--sticky-display');
			}
		},
		init: function () {
			var displayAmount = stickyHeaderAppearance.displayAmount();
			
			stickyHeaderAppearance.showHideHeader(displayAmount);
			$(window).scroll(function () {
				stickyHeaderAppearance.showHideHeader(displayAmount);
			});
		}
	};
	
	qodefCore.stickyHeaderAppearance = stickyHeaderAppearance.init;
	
})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefSearchCoversHeader.init();
	});
	
	var qodefSearchCoversHeader = {
		init: function () {
			var $searchOpener = $('a.qodef-search-opener'),
				$searchForm = $('.qodef-search-cover-form'),
				$searchClose = $searchForm.find('.qodef-m-close');
			
			if ($searchOpener.length && $searchForm.length) {
				$searchOpener.on('click', function (e) {
					e.preventDefault();
					qodefSearchCoversHeader.openCoversHeader($searchForm);
					
				});
				$searchClose.on('click', function (e) {
					e.preventDefault();
					qodefSearchCoversHeader.closeCoversHeader($searchForm);
				});
			}
		},
		openCoversHeader: function ($searchForm) {
			qodefCore.body.addClass('qodef-covers-search--opened qodef-covers-search--fadein');
			qodefCore.body.removeClass('qodef-covers-search--fadeout');
			
			setTimeout(function () {
				$searchForm.find('.qodef-m-form-field').focus();
			}, 600);
		},
		closeCoversHeader: function ($searchForm) {
			qodefCore.body.removeClass('qodef-covers-search--opened qodef-covers-search--fadein');
			qodefCore.body.addClass('qodef-covers-search--fadeout');
			
			setTimeout(function () {
				$searchForm.find('.qodef-m-form-field').val('');
				$searchForm.find('.qodef-m-form-field').blur();
				qodefCore.body.removeClass('qodef-covers-search--fadeout');
			}, 300);
		}
	};
	
})(jQuery);

(function($) {
    "use strict";

    $(document).ready(function(){
        qodefSearchFullscreen.init();
    });

	var qodefSearchFullscreen = {
	    init: function(){
            var $searchOpener = $('a.qodef-search-opener'),
                $searchHolder = $('.qodef-fullscreen-search-holder'),
                $searchClose = $searchHolder.find('.qodef-m-close');

            if ($searchOpener.length && $searchHolder.length) {
                $searchOpener.on('click', function (e) {
                    e.preventDefault();
                    if(qodefCore.body.hasClass('qodef-fullscreen-search--opened')){
                        qodefSearchFullscreen.closeFullscreen($searchHolder);
                    }else{
                        qodefSearchFullscreen.openFullscreen($searchHolder);
                    }
                });
                $searchClose.on('click', function (e) {
                    e.preventDefault();
                    qodefSearchFullscreen.closeFullscreen($searchHolder);
                });

                //Close on escape
                $(document).keyup(function (e) {
                    if (e.keyCode === 27) { //KeyCode for ESC button is 27
                        qodefSearchFullscreen.closeFullscreen($searchHolder);
                    }
                });
            }
        },
        openFullscreen: function($searchHolder){
            qodefCore.body.removeClass('qodef-fullscreen-search--fadeout');
            qodefCore.body.addClass('qodef-fullscreen-search--opened qodef-fullscreen-search--fadein');

            setTimeout(function () {
                $searchHolder.find('.qodef-m-form-field').focus();
            }, 900);

            qodefCore.qodefScroll.disable();
        },
        closeFullscreen: function($searchHolder){
            qodefCore.body.removeClass('qodef-fullscreen-search--opened qodef-fullscreen-search--fadein');
            qodefCore.body.addClass('qodef-fullscreen-search--fadeout');

            setTimeout(function () {
                $searchHolder.find('.qodef-m-form-field').val('');
                $searchHolder.find('.qodef-m-form-field').blur();
                qodefCore.body.removeClass('qodef-fullscreen-search--fadeout');
            }, 300);

            qodefCore.qodefScroll.enable();
        }
    };

})(jQuery);

(function ($) {
	"use strict";
	
	$(document).ready(function () {
        qodefSearch.init();
	});
	
	var qodefSearch = {
		init: function () {
            this.search = $('a.qodef-search-opener');

            if (this.search.length) {
                this.search.each(function () {
                    var $thisSearch = $(this);

                    qodefSearch.searchHoverColor($thisSearch);
                });
            }
        },
		searchHoverColor: function ($searchHolder) {
			if (typeof $searchHolder.data('hover-color') !== 'undefined') {
				var hoverColor = $searchHolder.data('hover-color'),
				    originalColor = $searchHolder.css('color');
				
				$searchHolder.on('mouseenter', function () {
					$searchHolder.css('color', hoverColor);
				}).on('mouseleave', function () {
					$searchHolder.css('color', originalColor);
				});
			}
		}
	};
	
})(jQuery);

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
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefProgressBarSpinner.init();
	});
	
	var qodefProgressBarSpinner = {
		percentNumber: 0,
		init: function () {
			this.holder = $('#qodef-page-spinner.qodef-layout--progress-bar');
			
			if (this.holder.length) {
				qodefProgressBarSpinner.animateSpinner(this.holder);
			}
		},
		animateSpinner: function ($holder) {
			
			var $numberHolder = $holder.find('.qodef-m-spinner-number-label'),
				$spinnerLine = $holder.find('.qodef-m-spinner-line-front'),
				numberIntervalFastest,
				windowLoaded = false;
			
			$spinnerLine.animate({'width': '100%'}, 10000, 'linear');
			
			var numberInterval = setInterval(function () {
				qodefProgressBarSpinner.animatePercent($numberHolder, qodefProgressBarSpinner.percentNumber);
			
				if (windowLoaded) {
					clearInterval(numberInterval);
				}
			}, 100);
			
			$(window).on('load', function () {
				windowLoaded = true;
				
				numberIntervalFastest = setInterval(function () {
					if (qodefProgressBarSpinner.percentNumber >= 100) {
						clearInterval(numberIntervalFastest);
						$spinnerLine.stop().animate({'width': '100%'}, 500);
						
						setTimeout(function () {
							$holder.addClass('qodef--finished');
							
							setTimeout(function () {
								qodefProgressBarSpinner.fadeOutLoader($holder);
							}, 1000);
						}, 600);
					} else {
						qodefProgressBarSpinner.animatePercent($numberHolder, qodefProgressBarSpinner.percentNumber);
					}
				}, 6);
			});
		},
		animatePercent: function ($numberHolder, percentNumber) {
			if (percentNumber < 100) {
				percentNumber += 5;
				$numberHolder.text(percentNumber);
				
				qodefProgressBarSpinner.percentNumber = percentNumber;
			}
		},
		fadeOutLoader: function ($holder, speed, delay, easing) {
			speed = speed ? speed : 600;
			delay = delay ? delay : 0;
			easing = easing ? easing : 'swing';
			
			$holder.delay(delay).fadeOut(speed, easing);
			
			$(window).on('bind', 'pageshow', function (event) {
				if (event.originalEvent.persisted) {
					$holder.fadeOut(speed, easing);
				}
			});
		}
	};
	
})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefWishlistDropdown.init();
	});
	
	/**
	 * Function object that represents wishlist dropdown.
	 * @returns {{init: Function}}
	 */
	var qodefWishlistDropdown = {
		init: function () {
			var $holder = $('.qodef-wishlist-dropdown');
			
			if ($holder.length) {
				$holder.each(function () {
					var $thisHolder = $(this),
						$link = $thisHolder.find('.qodef-m-link');
					
					$link.on('click', function (e) {
						//e.preventDefault();
					});
					
					qodefWishlistDropdown.removeItem($thisHolder);
				});
			}
		},
		removeItem: function ($holder) {
			var $removeLink = $holder.find('.qodef-e-remove');
			
			$removeLink.off().on('click', function (e) {
				e.preventDefault();
				
				var $thisRemoveLink = $(this),
					removeLinkHTML = $thisRemoveLink.html(),
					removeItemID = $thisRemoveLink.data('id');
				
				$thisRemoveLink.html('<span class="fa fa-spinner fa-spin" aria-hidden="true"></span>');
				
				var wishlistData = {
					type: 'remove',
					itemID: removeItemID
				};
				
				$.ajax({
					type: "POST",
					url: qodefGlobal.vars.restUrl + qodefGlobal.vars.wishlistRestRoute,
					data: {
						options: wishlistData
					},
					beforeSend: function (request) {
						request.setRequestHeader('X-WP-Nonce', qodefGlobal.vars.wishlistNonce);
					},
					success: function (response) {
						if (response.status === 'success') {
							var newNumberOfItemsValue = parseInt(response.data['count'], 10);
							
							$holder.find('.qodef-m-link-count').html(newNumberOfItemsValue);
							
							if (newNumberOfItemsValue === 0) {
								$holder.removeClass('qodef-items--has').addClass('qodef-items--no');
							}
							
							$thisRemoveLink.closest('.qodef-m-item').fadeOut(200).remove();
							
							$(document).trigger('makao_core_wishlist_item_is_removed', [removeItemID]);
						} else {
							$thisRemoveLink.html(removeLinkHTML);
						}
					}
				});
			});
		}
	};
	
	$(document).on('makao_core_wishlist_item_is_added', function (e, addedItemID, addedUserID) {
		var $holder = $('.qodef-wishlist-dropdown');
		
		if ($holder.length) {
			$holder.each(function () {
				var $thisHolder = $(this),
					$link = $thisHolder.find('.qodef-m-link'),
					numberOfItemsValue = $link.find('.qodef-m-link-count'),
					$itemsHolder = $thisHolder.find('.qodef-m-items');
				
				var wishlistData = {
					itemID: addedItemID,
					userID: addedUserID,
				};
				
				$.ajax({
					type: "POST",
					url: qodefGlobal.vars.restUrl + qodefGlobal.vars.wishlistDropdownRestRoute,
					data: {
						options: wishlistData
					},
					success: function (response) {
						if (response.status === 'success') {
							numberOfItemsValue.html(parseInt(response.data['count'], 10));
							
							if ($thisHolder.hasClass('qodef-items--no')) {
								$thisHolder.removeClass('qodef-items--no').addClass('qodef-items--has');
							}
							
							$itemsHolder.append(response.data['new_html']);
						}
					},
					complete: function () {
						qodefWishlistDropdown.init();
					}
				});
			});
		}
	});
	
})(jQuery);

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
(function($) {
    "use strict";

    /*
     **	Re-init scripts on gallery loaded
     */
	$(document).on('yith_wccl_product_gallery_loaded', function () {
		
		if (typeof qodefCore.qodefWooMagnificPopup === "function") {
			qodefCore.qodefWooMagnificPopup.init();
		}
	});

})(jQuery);
(function ($) {
    "use strict";
	qodefCore.shortcodes.makao_core_product_categories_list = {};
	qodefCore.shortcodes.makao_core_product_categories_list.qodefMasonryLayout = qodef.qodefMasonryLayout;

})(jQuery);
(function ($) {
    "use strict";
	qodefCore.shortcodes.makao_core_product_categories_list = {};
	qodefCore.shortcodes.makao_core_product_categories_list.qodefMasonryLayout = qodef.qodefMasonryLayout;
	qodefCore.shortcodes.makao_core_product_categories_list.qodefSwiper = qodef.qodefSwiper;
})(jQuery);
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
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefSideAreaCart.init();
	});
	
	var qodefSideAreaCart = {
		init: function () {
			var $holder = $('.qodef-woo-side-area-cart');
			
			if ($holder.length) {
				$holder.each(function () {
					var $thisHolder = $(this);
					
					if (qodefCore.windowWidth > 680) {
						qodefSideAreaCart.trigger($thisHolder);
						
						qodefCore.body.on('added_to_cart', function () {
							qodefSideAreaCart.trigger($thisHolder);
						});
					}
				});
			}
		},
		trigger: function ($holder) {
			var $opener = $holder.find('.qodef-m-opener'),
				$close = $holder.find('.qodef-m-close'),
				$items = $holder.find('.qodef-m-items');
			
			// Open Side Area
			$opener.on('click', function (e) {
				e.preventDefault();
				
				if (!$holder.hasClass('qodef--opened')) {
					qodefSideAreaCart.openSideArea($holder);
					
					$(document).keyup(function (e) {
						if (e.keyCode === 27) {
							qodefSideAreaCart.closeSideArea($holder);
						}
					});
				} else {
					qodefSideAreaCart.closeSideArea($holder);
				}
			});
			
			$close.on('click', function (e) {
				e.preventDefault();
				
				qodefSideAreaCart.closeSideArea($holder);
			});
			
			if ($items.length && typeof qodefCore.qodefPerfectScrollbar === 'object') {
				qodefCore.qodefPerfectScrollbar.init($items);
			}
		},
		openSideArea: function ($holder) {
			qodefCore.qodefScroll.disable();
			
			$holder.addClass('qodef--opened');
			$('#qodef-page-wrapper').prepend('<div class="qodef-woo-side-area-cart-cover"/>');
			
			$('.qodef-woo-side-area-cart-cover').on('click', function (e) {
				e.preventDefault();
				
				qodefSideAreaCart.closeSideArea($holder);
			});
		},
		closeSideArea: function ($holder) {
			if ($holder.hasClass('qodef--opened')) {
				qodefCore.qodefScroll.enable();
				
				$holder.removeClass('qodef--opened');
				$('.qodef-woo-side-area-cart-cover').remove();
			}
		}
	};
	
})(jQuery);

(function ($) {
	
    "use strict";
	qodefCore.shortcodes.makao_core_portfolio_list = {};
	qodefCore.shortcodes.makao_core_portfolio_list.qodefPagination = qodef.qodefPagination;
	qodefCore.shortcodes.makao_core_portfolio_list.qodefFilter = qodef.qodefFilter;
	qodefCore.shortcodes.makao_core_portfolio_list.qodefJustifiedGallery = qodef.qodefJustifiedGallery;
	qodefCore.shortcodes.makao_core_portfolio_list.qodefMasonryLayout = qodef.qodefMasonryLayout;

})(jQuery);
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
(function ($) {
    "use strict";
	qodefCore.shortcodes.makao_core_testimonials_list = {};
	qodefCore.shortcodes.makao_core_testimonials_list.qodefSwiper = qodef.qodefSwiper;

})(jQuery);
(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefInteractiveLinkShowcaseList.init();
    });

    var qodefInteractiveLinkShowcaseList = {
        init: function () {
            this.holder = $('.qodef-interactive-link-showcase.qodef-layout--list');

            if (this.holder.length) {
                this.holder.each(function () {
                    var $thisHolder = $(this),
                        $images = $thisHolder.find('.qodef-m-item-images'),
                        $links = $thisHolder.find('.qodef-m-item');
    
                    $images.eq(0).addClass('qodef--active');
                    $links.eq(0).addClass('qodef--active');
    
                    $links.on('touchstart mouseenter', function (e) {
                        var $thisLink = $(this);
        
                        if (!qodefCore.html.hasClass('touchevents') || (!$thisLink.hasClass('qodef--active'))) {
                            e.preventDefault();
                            $images.removeClass('qodef--active').eq($thisLink.index()).addClass('qodef--active');
                            $links.removeClass('qodef--active').eq($thisLink.index()).addClass('qodef--active');
                        }
                    }).on('touchend mouseleave', function () {
                        var $thisLink = $(this);
        
                        if (!qodefCore.html.hasClass('touchevents') || (!$thisLink.hasClass('qodef--active'))) {
                            $links.removeClass('qodef--active').eq($thisLink.index()).addClass('qodef--active');
                            $images.removeClass('qodef--active').eq($thisLink.index()).addClass('qodef--active');
                        }
                    });
    
                    $thisHolder.addClass('qodef--init');
                });
            }
        }
    };

	qodefCore.shortcodes.makao_core_interactive_link_showcase.qodefInteractiveLinkShowcaseList = qodefInteractiveLinkShowcaseList;

})(jQuery);
(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefZoomOut.init();
    });

    $(document).on('masterds_theme_trigger_get_new_posts', function () {
        qodefZoomOut.init();
    });

    var qodefZoomOut = {
        init: function () {
            var $gallery = $('.qodef-hover-animation--zoom-out');

            if ( $gallery.length ) {
                $gallery.each(function () {
                    var $thisGallery = $(this),
                        $galleryItem = $thisGallery.find('article');

                    if ( $galleryItem.length ) {
                        $galleryItem.each( function() {
                            var $thisItem = $(this),
                                $title = $thisItem.find('.qodef-e-title-link');

                            $title.on('mouseenter', function() {
                                $(this).closest('article').addClass('qodef-active-hover');
                            });

                            $title.on('mouseleave', function() {
                                $(this).closest('article').removeClass('qodef-active-hover');
                            });
                        })
                    }
                });
            }
        }
    };

    qodefCore.shortcodes.makao_core_portfolio_list.qodefZoomOut = qodefZoomOut;

})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefInfoFollow.init();
	});
	
	$(document).on('makao_trigger_get_new_posts', function () {
		qodefInfoFollow.init();
	});
	
	var qodefInfoFollow = {
		init: function () {
			var $gallery = $('.qodef-hover-animation--follow');
			
			if ($gallery.length) {
				qodefCore.body.append('<div class="qodef-follow-info-holder"><div class="qodef-follow-info-inner"><span class="qodef-follow-info-category"></span><br/><span class="qodef-follow-info-title"></span></div></div>');
				
				var $followInfoHolder = $('.qodef-follow-info-holder'),
					$followInfoCategory = $followInfoHolder.find('.qodef-follow-info-category'),
					$followInfoTitle = $followInfoHolder.find('.qodef-follow-info-title');
				
				$gallery.each(function () {
					$gallery.find('.qodef-e-inner').each(function () {
						var $thisItem = $(this);
						
						//info element position
						$thisItem.on('mousemove', function (e) {
                            if(e.clientX + 20 + $followInfoHolder.width() > qodefCore.windowWidth){
                                $followInfoHolder.addClass('qodef-right');
                            }else{
                                $followInfoHolder.removeClass('qodef-right');
                            }

							$followInfoHolder.css({
								top: e.clientY + 20,
								left: e.clientX + 20
							});
						});
						
						//show/hide info element
						$thisItem.on('mouseenter', function () {
							var $thisItemTitle = $(this).find('.qodef-e-title'),
								$thisItemCategory = $(this).find('.qodef-e-info-category');
							
							if ($thisItemTitle.length) {
								$followInfoTitle.html($thisItemTitle.clone());
							}
							
							if ($thisItemCategory.length) {
								$followInfoCategory.html($thisItemCategory.html());
							}
							
							if (!$followInfoHolder.hasClass('qodef-is-active')) {
								$followInfoHolder.addClass('qodef-is-active');
							}
						}).on('mouseleave', function () {
							if ($followInfoHolder.hasClass('qodef-is-active')) {
								$followInfoHolder.removeClass('qodef-is-active');
							}
						});
					});
				});
			}
		}
	};
	
	qodefCore.shortcodes.makao_core_portfolio_list.qodefInfoFollow = qodefInfoFollow;
	
})(jQuery);
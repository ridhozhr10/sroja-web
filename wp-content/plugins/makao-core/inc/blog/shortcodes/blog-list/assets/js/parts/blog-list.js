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
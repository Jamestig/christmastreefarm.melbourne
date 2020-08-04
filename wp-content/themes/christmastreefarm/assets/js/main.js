(function ($) {

	document.addEventListener('DOMContentLoaded', function () {

		console.log('JQ loaded');

		// Declare global variables
		let mediaSize = 'mobile';

		// Media query function
		function mediaQuery() {
			if (window.matchMedia('(max-width: 767px)').matches) {
				mediaSize = 'mobile';
			} else if (window.matchMedia('(max-width: 1023px)').matches) {
				mediaSize = 'tablet';
			} else if (window.matchMedia('(max-width: 1365px)').matches) {
				mediaSize = 'large-tablet';
			} else if (window.matchMedia('(min-width: 1366px)').matches) {
				mediaSize = 'desktop';
			}
		}
		mediaQuery();
		console.log(mediaSize);

		// Refresh page on resize
		var responseSize;
		var windowSize = jQuery(window);

		if (windowSize.width() < 768) {
			responseSize = 'small';
		} else {
			responseSize = 'large';
		}

		jQuery(window).resize(function () {
			if ((windowSize.width() < 768) && (responseSize != 'small')) {
				location.reload();
			} else if ((windowSize.width() >= 768) && (responseSize != 'large')) {
				location.reload();
			}
		});

	}); // END DOCUMENT
})(jQuery);
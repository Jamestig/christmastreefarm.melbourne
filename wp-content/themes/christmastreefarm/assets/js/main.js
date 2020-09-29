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

		// Check shipping method based on custom product addon
		function shippingCheck() {
			if ($(".woocommerce-checkout-review-order-table tbody:contains('home')").length > 0 &&  $(".woocommerce-checkout-review-order-table tbody:contains('farm')").length > 0) {
				console.log('error');
				$('body').addClass('shippingError');
				$('form.woocommerce-checkout').hide();
				$('.entry-content > .woocommerce').append('<p class="woocommerce-error">Please choose your trees with either delivery or pickup | <a href="/cart/">Remove items from cart</a></p>');
			} else {
			if ($(".variation-PleaseselecthowyoudliketoreceiveyourChristmastree div span:contains('Delivery')").length > 0) {
				console.log('contains delivery');
				if ($('input[id^="shipping_method_0_local_pickup"').prop('checked', true) ) {
					console.log('switch to delivery');
					$('input[id^="shipping_method_0_flat_rate"').prop('checked', true);
				}
				$('body').addClass('collectHidden');
			} else if ($(".variation-PleaseselecthowyoudliketoreceiveyourChristmastree div span:contains('click')").length > 0) {
				console.log('contains collect');
				if ($('input[id^="shipping_method_0_flat_rate"').prop('checked', true) ) {
					console.log('switch to collect');
					$('input[id^="shipping_method_0_local_pickup"').prop('checked', true);
				}
				$('body').addClass('deliveryHidden');
			}
		}
		}
		shippingCheck();

	}); // END DOCUMENT
})(jQuery);
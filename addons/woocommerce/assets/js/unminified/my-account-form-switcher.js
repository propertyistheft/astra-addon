/**
 * WooCommerce shop layout view updation.
 *
 * @package Astra Addon
 * @since x.x.x
 */

/**
 * Toggles the visibility of login and registration forms.
 *
 * @param {string} type Type of form to display ('do-register' or 'do-login').
 */
function astraToggleShopForm(type) {
	var loginForm = document.querySelector('#customer_login > .u-column1');
	var registerForm = document.querySelector('#customer_login > .u-column2');

	if ('do-register' === type) {
		// Registration form should be visible.
		loginForm.style.display = "none";
		registerForm.style.display = "block";
		updateUrlHash('#ast-woo-register');
	} else {
		// Login form should be visible.
		loginForm.style.display = "block";
		registerForm.style.display = "none";
		updateUrlHash('#ast-woo-login');
	}
}

/**
 * Updating the URL hash without reloading the page.
 *
 * @param {string} hash The hash to set in the URL.
 */
function updateUrlHash(hash) {
	history.replaceState(null, '', window.location.pathname + hash);
}

/**
 * Astra updating shop view. Grid|List.
 */
function astraUpdateShopView() {
	var astWooFormTriggerLinks = document.querySelectorAll('.ast-woo-account-form-link');

	astWooFormTriggerLinks.forEach(function (link) {
		link.addEventListener('click', function (e) {
			e.preventDefault();
			var type = this.dataset.type;
			astraToggleShopForm(type);
		});
	});
}

/**
 * Enhances shop view to handle URL hash-based form toggling.
 */
function toggleShopFormByHash() {
	var hash = window.location.hash;
	var type = hash === '#ast-woo-register' ? 'do-register' : 'do-login';
	astraToggleShopForm(type);
}

window.addEventListener('load', function () {
	astraUpdateShopView();
	toggleShopFormByHash();
});

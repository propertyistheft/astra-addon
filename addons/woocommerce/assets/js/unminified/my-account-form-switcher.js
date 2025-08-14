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
	let loginForms = document.querySelectorAll("#customer_login > .u-column1");
	let registerForms = document.querySelectorAll(
		"#customer_login > .u-column2"
	);

	if ("do-register" === type) {
		// Registration form should be visible.
		loginForms.forEach(function (form) {
			form.style.display = "none";
		});
		registerForms.forEach(function (form) {
			form.style.display = "block";
		});
		updateUrlHash("#create-account");
	} else {
		// Login form should be visible.
		loginForms.forEach(function (form) {
			form.style.display = "block";
		});
		registerForms.forEach(function (form) {
			form.style.display = "none";
		});
		updateUrlHash("#login");
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
	let astWooFormTriggerLinks = document.querySelectorAll('.ast-woo-account-form-link');

	astWooFormTriggerLinks.forEach(function (link) {
		link.addEventListener('click', function (e) {
			e.preventDefault();
			let type = this.dataset.type;
			astraToggleShopForm(type);
		});
	});
}

/**
 * Enhances shop view to handle URL hash-based form toggling.
 */
function toggleShopFormByHash() {
	let hash = window.location.hash;
	let type = hash === '#create-account' ? 'do-register' : 'do-login';
	astraToggleShopForm(type);
}

window.addEventListener('load', function () {
	astraUpdateShopView();
	toggleShopFormByHash();
});

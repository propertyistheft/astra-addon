/**
 * Custom Layout Enable or Disable actions.
 *
 * @package Astra Addon
 * @since x.x.x
 */

var toggelSwitch = function() {
	var self = this;
	self.classList.toggle('ast-active');
	var enable= self.classList.contains('ast-active') ? 'yes' : 'no'
	// Ajax request.
	var xhttp = new XMLHttpRequest();
	astHooksData.url += '?action=ast_advanced_hook_display_toggle&post_id=' + self.dataset.post_id + '&enable=' + enable + '&nonce=' + astHooksData.nonce;
	xhttp.open("GET", astHooksData.url);
	xhttp.send();
}
document.addEventListener("DOMContentLoaded", function() {
	var switchSelector = document.querySelectorAll('.ast-custom-layout-switch');
	for ( var switchSelectorCount = 0; switchSelectorCount < switchSelector.length; switchSelectorCount++ ) {
		switchSelector[switchSelectorCount].addEventListener( 'click', toggelSwitch, false );
	}
});

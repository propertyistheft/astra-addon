// Frontend
jQuery(document).ready(function( $ ) {
	setTimeout(function(){
		let accordions = $('[data-pafe-close-first-accordion]');
		let accordionsItem, tabTitle, tabContent;
		$.each(accordions, function(){
			accordionsItem = $(this).find('.elementor-accordion-item').eq(0);
			tabTitle = accordionsItem.find('.elementor-tab-title');
			tabContent = accordionsItem.find('.elementor-tab-content');
			tabTitle.removeClass( 'elementor-active' );
			tabContent.css( 'display', 'none' );
		});
	}, 1000);
});
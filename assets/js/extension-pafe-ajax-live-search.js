jQuery(document).ready(function($) {

	$('[data-pafe-ajax-live-search]').each(function(){
		var $form = $(this).find('.elementor-search-form'),
			postType = $(this).data('pafe-ajax-live-search');

		$form.append('<div class="pafe-ajax-live-search-results" data-pafe-ajax-live-search-results></div><input type="hidden" name="post_type" value="' + postType + '">');
		$form.find('.elementor-search-form__input').attr('autocomplete','off');
	});
	
	var pafeTimeout = null; 
 
    $('[data-pafe-ajax-live-search] .elementor-search-form__input').keyup(function(){

    	var $wrapper = $(this).closest('[data-pafe-ajax-live-search]'),
    		$search = $wrapper.find('.elementor-search-form__input'),
    		$result = $wrapper.find('[data-pafe-ajax-live-search-results]'),
    		postType = $wrapper.data('pafe-ajax-live-search');

        clearTimeout(pafeTimeout);
        pafeTimeout = setTimeout(function ()   
        {
            var data = {
				'action': 'pafe_ajax_live_search',
				'search': $search.val(),
				'post_type': postType,
			};
 
            $.post($('[data-pafe-ajax-url]').data('pafe-ajax-url'), data, function(response) {
            	if (response.trim() != '') {
            		$result.addClass('active');
            		$result.html(response);
            	} else {
            		$result.removeClass('active');
            	}
			});
        }, 300);
    });

    $(document).on('click','[data-pafe-ajax-live-search-href]',function(){
    	window.location.href = $(this).data('pafe-ajax-live-search-href');
    });

    $(document).on('click mousedown touchstart',function (e) {
	    if (!$('[data-pafe-ajax-live-search] .elementor-search-form__input').is(e.target) && !$('[data-pafe-ajax-live-search] *').is(e.target)) {
	        $('[data-pafe-ajax-live-search]').find('[data-pafe-ajax-live-search-results]').removeClass('active');
	    }
	});

});
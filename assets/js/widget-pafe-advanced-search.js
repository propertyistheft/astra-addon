/*
 * jQuery throttle / debounce - v1.1 - 3/7/2010
 * http://benalman.com/projects/jquery-throttle-debounce-plugin/
 * 
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function(b,c){var $=b.jQuery||b.Cowboy||(b.Cowboy={}),a;$.throttle=a=function(e,f,j,i){var h,d=0;if(typeof f!=="boolean"){i=j;j=f;f=c}function g(){var o=this,m=+new Date()-d,n=arguments;function l(){d=+new Date();j.apply(o,n)}function k(){h=c}if(i&&!h){l()}h&&clearTimeout(h);if(i===c&&m>e){l()}else{if(f!==true){h=setTimeout(i?k:l,i===c?e-m:e)}}}if($.guid){g.guid=j.guid=j.guid||$.guid++}return g};$.debounce=function(d,e,f){return f===c?a(d,e,false):a(d,f,e!==false)}})(this);
 
(function ($) {
    var WidgetPafeAdvancedSearch = function ($scope, $) {
         var $selectionInner =  $scope.find('.pafe-advanced-search-cat__inner');
       $selectionInner.each(function(){
            $selectTag = $(this).find('select');
            
            $("<div class='pafe_advanced_search__select-selected'></div>").appendTo($(this));
            $selectSelected = $(this).find('.pafe_advanced_search__select-selected');
            $selectSelected.addClass('pafe-advanced-search__input-typo')
            $selectedHtml = $(this).find("option:selected").html();
            $selectSelected.html($selectedHtml);

            $("<div class='pafe_advanced_search__select-items pafe_advanced_search__select-items-hide'></div>").appendTo($(this));
            $selectItems = $(this).find('.pafe_advanced_search__select-items');
            $originalSelectOption = $selectTag.find('option');
            $originalSelectOption.each(function(){
                $originalSelectOptionHtml = $(this).html();
                $newSelectOption = $(document.createElement('div'));
                $newSelectOption.html($originalSelectOptionHtml);
                $newSelectOption.appendTo($selectItems);
                $newSelectOption.addClass('pafe_advanced_search__select-option');
                $newSelectOption.addClass('pafe-advanced-search__input-typo');
                $newSelectOption.each(function(){
                    if ($newSelectOption.html() == $selectSelected.html()) {
                        $(this).addClass("pafe_advanced_search__same-as-selected-option");
                    }
                });

                $newSelectOption.click(function(){
                    $parent = $(this).closest('.pafe-advanced-search-cat__inner');
                    $originalSelected = $parent.find('select');
                    $newSelected = $parent.find('.pafe_advanced_search__select-selected');
                    $originalSelectedOptions = $originalSelected.find('option');
                    $newSelectOptionHtml = $(this).html(); 
                    $newSelected.html($newSelectOptionHtml); 
                    $originalSelectedOptions.each(function(){
                        if ($(this).html() == $newSelectOptionHtml) {
                            $(this).attr('selected','selected');
                            Query($originalSelected);
                            $originalSelected.change();
                        }    
                    });
                    $parentOptions = $(this).closest ('.pafe_advanced_search__select-items'); 
                    $siblingOption = $parentOptions.find('div');
                    $siblingOption.each(function(){
                         $siblingOption.removeClass("pafe_advanced_search__same-as-selected-option");
                    }); 
                    $(this).addClass("pafe_advanced_search__same-as-selected-option");
                }); 
            });
            $catParent = $selectSelected.closest('.pafe-advanced-search-cat__inner');
            $catParent.click(function(stopPropagation){
                stopPropagation.stopPropagation();
                $icon = $(this).find('.pafe_advanced_search__categories-select-icon')
                $thisSelectOptions = $(this).find('.pafe_advanced_search__select-items');
                $allOptionsWrapper = $(document).find('.pafe_advanced_search__select-items');
                $allOptionsWrapper.each(function(){
                    if(!$(this).is($thisSelectOptions)){$(this).addClass('pafe_advanced_search__select-items-hide')};
                });

                $thisSelectOptions.toggleClass('pafe_advanced_search__select-items-hide');    

                if ($icon.hasClass('fa-caret-down')) {
                    $icon.removeClass('fa-caret-down');
                    $icon.addClass('fa-caret-up');
                } else if ($icon.hasClass('fa-caret-up')) {
                    $icon.removeClass('fa-caret-up');
                    $icon.addClass('fa-caret-down');
                }
                // closeAllSelect($(this));         
            });
 
        }); 

    function Query(emt) {  
        
        var $parent = emt.closest('.pafe-advanced-search');
        var $input = $parent.find('[data-pafe-advanced-search-input]');
        var $postNumber = $parent.find('[data-pafe-advanced-search-results-per-page]').attr('data-pafe-advanced-search-results-per-page');
        var $noResult = $parent.find('[data-pafe-advanced-search-result-no-post-message]').attr('data-pafe-advanced-search-result-no-post-message');
        var $resultFooter = $parent.find('[data-pafe-advanced-search-result-footer]').attr('data-pafe-advanced-search-result-footer');
        var $inputValue = $input.val(); 
        var $selectionValue = $parent.find("option:selected").val();
        var $taxonomy = $parent.find('[data-pafe-advanced-search-taxonomy]').attr('data-pafe-advanced-search-taxonomy');
        var $result = $parent.find('.pafe-advanced-search__results');
            if ($inputValue.length > 0) {
                var data = {  
                        'action': 'pafe_advanced_search_tax',
                        'keywords': $inputValue, 
                        'term': $selectionValue,
                        'taxonomy': $taxonomy,
                        'posts_per_page': $postNumber,
                        'no_result': $noResult,
                        'result_footer':$resultFooter,
                         };         
                $.post($('[data-pafe-ajax-url]').data('pafe-ajax-url'),data, function(response) {
                        $result.html(response);
                        $result.addClass('show');
                });
            }; 
     } 
    };
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/pafe-advanced-search.default', WidgetPafeAdvancedSearch);
    });
})(jQuery); 

jQuery(document).ready(function( $ ) {
    var $selectionInner =  $(document).find('.pafe-advanced-search-cat__inner');
	$(document).on('keyup','[data-pafe-advanced-search-input]', $.debounce( 200, function() {
        var $parent = $(this).closest('.pafe-advanced-search');
        var $input = $parent.find('[data-pafe-advanced-search-input]');
        var $postNumber = $parent.find('[data-pafe-advanced-search-results-per-page]').attr('data-pafe-advanced-search-results-per-page');
        var $noResult = $parent.find('[data-pafe-advanced-search-result-no-post-message]').attr('data-pafe-advanced-search-result-no-post-message');
        var $resultFooter = $parent.find('[data-pafe-advanced-search-result-footer]').attr('data-pafe-advanced-search-result-footer');
        var $inputValue = $input.val(); 
        var $selectionValue = $parent.find("option:selected").val();
        var $taxonomy = $parent.find('[data-pafe-advanced-search-taxonomy]').attr('data-pafe-advanced-search-taxonomy');
		var $result = $parent.find('.pafe-advanced-search__results');
            if ($inputValue.length > 0) {
        		var data = {  
                        'action': 'pafe_advanced_search',
                        'keywords': $inputValue,
                        'term': $selectionValue,
                        'taxonomy': $taxonomy,
                        'posts_per_page': $postNumber,
                        'no_result': $noResult,
                        'result_footer':$resultFooter,
                   		 };			
        		$.post($('[data-pafe-ajax-url]').data('pafe-ajax-url'),data, function(response) {
                        $result.html(response);
                        $result.addClass('show');
                });
            };
	}));  
 
     function Query(emt) {  
        
        var $parent = emt.closest('.pafe-advanced-search');
        var $input = $parent.find('[data-pafe-advanced-search-input]');
        var $postNumber = $parent.find('[data-pafe-advanced-search-results-per-page]').attr('data-pafe-advanced-search-results-per-page');
        var $noResult = $parent.find('[data-pafe-advanced-search-result-no-post-message]').attr('data-pafe-advanced-search-result-no-post-message');
        var $resultFooter = $parent.find('[data-pafe-advanced-search-result-footer]').attr('data-pafe-advanced-search-result-footert');
        var $inputValue = $input.val(); 
        var $selectionValue = $parent.find("option:selected").val();
        var $taxonomy = $parent.find('[data-pafe-advanced-search-taxonomy]').attr('data-pafe-advanced-search-taxonomy');
        var $result = $parent.find('.pafe-advanced-search__results');
            if ($inputValue.length > 0) {
                var data = {  
                        'action': 'pafe_advanced_search_tax',
                        'keywords': $inputValue, 
                        'term': $selectionValue,
                        'taxonomy': $taxonomy,
                        'posts_per_page': $postNumber,
                        'no_result': $noResult,
                        'result_footer':$resultFooter,
                         };         
                $.post($('[data-pafe-ajax-url]').data('pafe-ajax-url'),data, function(response) {
                        $result.html(response);
                        $result.addClass('show');
                });
            }; 
     }

     $(document).on('mousedown touchstart',function (e) {

        if (!$selectionInner.is(e.target) && !$('.pafe-advanced-search-cat__inner *' ).is(e.target) && !$('.pafe_advanced_search__select-items').is(e.target) && !$('.pafe_advanced_search__select-items *').is(e.target) ) {

        $('.pafe_advanced_search__select-items').addClass('pafe_advanced_search__select-items-hide');
        var $icon = $(document).find('.pafe_advanced_search__categories-select-icon')
            $icon.removeClass('fa-caret-up');
            $icon.addClass('fa-caret-down');
        }

        }); 

    $(document).on('click','[data-advanced-search-paged]', function() {
        var paged = $(this).attr('data-advanced-search-paged');
        var $parent = $(this).closest('.pafe-advanced-search');
        var $postNumber = $parent.find('[data-pafe-advanced-search-results-per-page]').attr('data-pafe-advanced-search-results-per-page');
        var $noResult = $parent.find('[data-pafe-advanced-search-result-no-post-message]').attr('data-pafe-advanced-search-result-no-post-message');
        var $resultFooter = $parent.find('[data-pafe-advanced-search-result-footer]').attr('data-pafe-advanced-search-result-footer');
        var $input = $parent.find('[data-pafe-advanced-search-input]');
        var $inputValue = $input.val(); 
        var $selectionValue = $parent.find("option:selected").val();
        var $taxonomy = $parent.find('[data-pafe-advanced-search-taxonomy]').attr('data-pafe-advanced-search-taxonomy');
        var $result = $parent.find('.pafe-advanced-search__results');
            if ($inputValue.length > 0) {
                var data = {  
                        'action': 'pafe_advanced_search',
                        'keywords': $inputValue,
                        'term': $selectionValue,
                        'taxonomy': $taxonomy,
                        'paged':paged,
                        'posts_per_page': $postNumber,
                        'no_result': $noResult,
                        'result_footer':$resultFooter,
                         };         
                $.post($('[data-pafe-ajax-url]').data('pafe-ajax-url'),data, function(response) {
                        $result.html(response);
                        $result.addClass('show');
                });
            };
    });

    $(document).on('click','.pafe-advanced-search__results-full', function() {
        $(".pafe-advanced-search__submit").trigger("click");
    });

    $(document).on('change', '[data-pafe-advanced-search-term-select]', function(){
    if($(this).val() !== 'all'){
        var terms = $(this).val().split('|');
        $('[data-pafe-advanced-search-terms]').val(terms[0]);
    }else{
        $('[data-pafe-advanced-search-terms]').val('');
    }
  });
});    
  
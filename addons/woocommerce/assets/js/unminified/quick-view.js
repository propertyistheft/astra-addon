(function($){

	if( typeof astra === 'undefined' ) {
        return;
    }

	AstraProQuickView = {

		stick_add_to_cart          : astra.shop_quick_view_stick_cart,
		auto_popup_height_by_image : astra.shop_quick_view_auto_height,

		/**
		 * Init
		 */
		init: function()
		{
			this._init_popup();
			this._bind();
		},

		_init_popup: function() {

			/**
			 * Set Max Height Width For Wrappers.
			 */
			$('#ast-quick-view-content,#ast-quick-view-content div.product').css({
				'max-width'  : parseFloat( $(window).width() ) - 120,
				'max-height' : parseFloat( $(window).height() ) - 120
			});

			/**
			 * Remove HREF from the links.
			 */
			var on_img_click_els = $('.ast-qv-on-image-click .astra-shop-thumbnail-wrap .woocommerce-LoopProduct-link');

			if ( on_img_click_els.length > 0 ) {
				on_img_click_els.each(function(e) {
					$(this).attr('href', 'javascript:void(0)' );
				});
			}
		},

		/**
		 * Binds events
		 */
		_bind: function()
		{
			// Open Quick View.
			$(document).off( 'click', '.ast-quick-view-button, .ast-quick-view-text, .ast-qv-on-image-click .astra-shop-thumbnail-wrap .woocommerce-LoopProduct-link' ).on( 'click', '.ast-quick-view-button, .ast-quick-view-text, .ast-qv-on-image-click .astra-shop-thumbnail-wrap .woocommerce-LoopProduct-link', AstraProQuickView._open_quick_view);

			// Close Quick View.
			$(document).on( 'click', '#ast-quick-view-close', AstraProQuickView._close_quick_view);
			$(document).on( 'click', '.ast-content-main-wrapper', AstraProQuickView._close_quick_view_on_overlay_click);
			$(document).on( 'keyup', AstraProQuickView._close_quick_view_on_esc_keypress);
		},

		/**
		 * Open Quick View.
		 *
		 * @param  {[type]} e [description]
		 * @return {[type]}   [description]
		 */
		_open_quick_view: function( e ) {
			e.preventDefault();

			var self       	  = $(this),
				wrap 		  = self.closest('li.product'),
				quick_view    = $(document).find( '#ast-quick-view-modal' ),
				quick_view_bg = $(document).find( '.ast-quick-view-bg' );

			var product_id = self.data( 'product_id' );

			if ( wrap.hasClass( 'ast-qv-on-image-click' )  ) {
				product_id = wrap.find('.ast-quick-view-data').data( 'product_id' );
			}

			if( ! quick_view.hasClass( 'loading' ) ) {
				quick_view.addClass('loading');
			}

			if ( ! quick_view_bg.hasClass( 'ast-quick-view-bg-ready' ) ) {
				quick_view_bg.addClass( 'ast-quick-view-bg-ready' );
			}

			// stop loader
			$(document).trigger( 'ast_quick_view_loading' );

			// Append the single product markup into the popup.
			// Process the AJAX to open the product.
			$.ajax({
				url        : astra.ajax_url,
				type       : 'POST',
				dataType   : 'html',
				data       : {
					action     : 'ast_load_product_quick_view',
					product_id : product_id
				},
				success: function (data) {
					$(document).find( '#ast-quick-view-modal' ).find( '#ast-quick-view-content' ).html(data);
					AstraProQuickView._after_markup_append_process();
				}
			});
		},

		/**
		 * Auto set height to the content.
		 */
		_after_markup_append_process: function() {

			var quick_view 		   = $(document).find( '#ast-quick-view-modal' ),
				quick_view_content = quick_view.find( '#ast-quick-view-content' ),
				form_variation     = quick_view_content.find('.variations_form');

			if ( ! quick_view.hasClass('open') ) {

				var modal_height  = quick_view_content.outerHeight(),
					window_height = $(window).height(),
					$html 		  = $('html');

				if( modal_height > window_height ) {
					$html.css( 'margin-right', AstraProQuickView._get_scrollbar_width() );
				} else {
					$html.css( 'margin-right', '' );
					$html.find( '.ast-sticky-active, .ast-header-sticky-active, .ast-custom-footer' ).css( 'max-width', '100%' );
				}

				$html.addClass('ast-quick-view-is-open');
			}

			// Initialize variable form.
			if ( form_variation.length > 0 ) {

				// Trigger variation form actions.
				form_variation.trigger( 'check_variations' );
				form_variation.trigger( 'reset_image' );

				// Trigger variation form.
				form_variation.wc_variation_form();
				form_variation.find('select').change();
			}

			// Initialize flex slider.
			var image_slider_wrap = quick_view.find('.ast-qv-image-slider');
			if ( image_slider_wrap.find('li').length > 1 ) {
				image_slider_wrap.flexslider();
			}

			setTimeout(function() {
				AstraProQuickView._auto_set_content_height_by_image();

				// Add popup open class.
				quick_view.removeClass('loading').addClass('open');
				$('.ast-quick-view-bg').addClass('open');
			}, 100);

			// stop loader
			$(document).trigger('ast_quick_view_loader_stop');
		},

		/**
		 * Auto set height to the content depends on the option.
		 *
		 * @return {[type]} [description]
		 */
		_auto_set_content_height_by_image: function() {

			$('#ast-quick-view-modal').imagesLoaded()
			.always( function( instance ) {

				var quick_view 		   = $(document).find( '#ast-quick-view-modal' );
					image_height 	   = quick_view.find( '.woocommerce-product-gallery__image img' ).outerHeight(),
					summary    		   = quick_view.find('.product .summary.entry-summary'),
					content    		   = summary.css('content'),
					summary_content_ht = quick_view.find( '.summary-content' ).outerHeight();

				// No Image.
				var featured_image = quick_view.find('.woocommerce-product-gallery__image img, .ast-qv-slides img');

				/**
				 * Auto height to the content as per image height.
				 *
				 * @param  {[type]} AstraProQuickView.auto_popup_height_by_image [description]
				 * @return {[type]}                                              [description]
				 */
				var popup_height = parseFloat( $(window).height() ) - 120,
					image_height = parseFloat( image_height );

				if( AstraProQuickView.auto_popup_height_by_image ) {
					if( featured_image.length ) {

						// If image height is less then popup/window height the set max height of `image` to the summery.
						if( image_height < popup_height ) {
							summary.css('max-height', parseFloat( image_height ) );

						// Or set the popup/window height.
						} else {
							summary.css('max-height', popup_height );
						}
					} else {
						summary.css('width', '100%' );
					}
				} else {
					console.log( 'here' );
					summary.css('max-height', parseFloat( popup_height ) );
				}

				/**
				 * Stick the Add to Cart Box.
				 *
				 * @param  {[type]} AstraProQuickView.stick_add_to_cart [description]
				 * @return {[type]}                                     [description]
				 */
				if( AstraProQuickView.stick_add_to_cart ) {

					quick_view.addClass('stick-add-to-cart');

					var cart_height  = quick_view.find('.cart').outerHeight();
					var summery_height = parseFloat(popup_height) - parseFloat(cart_height);

					// Reset the summery height:
					// If Image height is large than the stick cart form
					// Then calculate the sticky cart height and set the summery.
					if( image_height > cart_height ) {

						// Stick Class.
						quick_view.find('.cart').addClass('stick');

						// Recalculate the outer heights,
						// Because, These are change after adding `stick` class to the form.
						var popup_height   = $('#ast-quick-view-content').outerHeight();
						var cart_height    = quick_view.find('.cart').outerHeight();
						var summery_height = parseFloat(popup_height) - parseFloat(cart_height);

						summary.css('max-height', parseFloat( summery_height ) );

					} else {

						// If image height is less then popup/window height the set max height of `image` to the summery.
						if( popup_height > summery_height ) {
							summary.css('max-height', parseFloat( popup_height ) );
						} else {
							summary.css('max-height', '' );
						}
					}
				}
			});

		},

		/**
		 * Close box with esc key.
		 *
		 * @param  {[type]} e [description]
		 * @return {[type]}   [description]
		 */
		_close_quick_view_on_esc_keypress: function( e ) {
			e.preventDefault();
			if( e.keyCode === 27 ) {
				AstraProQuickView._close_quick_view();
			}
		},

		/**
		 * Close Quick View.
		 *
		 * @param  {[type]} e [description]
		 * @return {[type]}   [description]
		 */
		_close_quick_view: function( e ) {

			if( e ) {
				e.preventDefault();
			}

			$(document).find( '.ast-quick-view-bg' ).removeClass( 'ast-quick-view-bg-ready' );
			$(document).find( '#ast-quick-view-modal' ).removeClass('open').removeClass('loading');
			$('.ast-quick-view-bg').removeClass('open');
			$('html').removeClass('ast-quick-view-is-open');
			$('html').css( 'margin-right', '' );

			setTimeout(function () {
				$(document).find( '#ast-quick-view-modal' ).find( '#ast-quick-view-content' ).html('');
			}, 600);
		},

		/**
		 * Close box by click overlay.
		 *
		 * @param  {[type]} e [description]
		 * @return {[type]}   [description]
		 */
		_close_quick_view_on_overlay_click: function( e ) {
			if ( this === e.target ) {
				AstraProQuickView._close_quick_view();
			}
		},

		/**
		 * Get Scrollbar Width
		 *
		 * @return {[type]} [description]
		 */
		_get_scrollbar_width: function () {
			// Append our div, do our calculation and then remove it.
			var div = $('<div style="width:50px;height:50px;overflow:hidden;position:absolute;top:-200px;left:-200px;"><div style="height:100px;"></div>');
			$('body').append(div);
			var w1 = $('div', div).innerWidth();
			div.css('overflow-y', 'scroll');
			var w2 = $('div', div).innerWidth();
			$(div).remove();

			return (w1 - w2);
		}

	};

	/**
	 * Initialization
	 */
	$(function(){
		AstraProQuickView.init();
	});

})(jQuery);

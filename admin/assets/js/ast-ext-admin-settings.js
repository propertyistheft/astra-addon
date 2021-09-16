/**
 * Astra Addon admin settings
 *
 * @package Astra Addon
 * @since  1.0.0
 */

(function( $ ) {

	/**
	 * AJAX Request Queue
	 *
	 * - add()
	 * - remove()
	 * - run()
	 * - stop()
	 *
	 * @since 1.2.0.8
	 */
	var AstraAddonAjaxQueue = (function() {

		var requests = [];

		return {

			/**
			 * Add AJAX request
			 *
			 * @since 1.2.0.8
			 */
			add:  function(opt) {
			    requests.push(opt);
			},

			/**
			 * Remove AJAX request
			 *
			 * @since 1.2.0.8
			 */
			remove:  function(opt) {
			    if( jQuery.inArray(opt, requests) > -1 )
			        requests.splice($.inArray(opt, requests), 1);
			},

			/**
			 * Run / Process AJAX request
			 *
			 * @since 1.2.0.8
			 */
			run: function() {
			    var self = this,
			        oriSuc;

			    if( requests.length ) {
			        oriSuc = requests[0].complete;

			        requests[0].complete = function() {
			             if( typeof(oriSuc) === 'function' ) oriSuc();
			             requests.shift();
			             self.run.apply(self, []);
			        };

			        jQuery.ajax(requests[0]);

			    } else {

			      self.tid = setTimeout(function() {
			         self.run.apply(self, []);
			      }, 1000);
			    }
			},

			/**
			 * Stop AJAX request
			 *
			 * @since 1.2.0.8
			 */
			stop:  function() {

			    requests = [];
			    clearTimeout(this.tid);
			}
		};

	}());


	ASTExtAdmin = {

		init: function() {
			/**
			 * Run / Process AJAX request
			 */
			AstraAddonAjaxQueue.run();
			$( document ).delegate( ".ast-activate-module", "click", ASTExtAdmin._activate_module );
			$( document ).delegate( ".ast-deactivate-module", "click", ASTExtAdmin._deactivate_module );

			$( document ).delegate( ".ast-activate-all", "click", ASTExtAdmin._bulk_activate_modules_activate_module );
			$( document ).delegate( ".ast-deactivate-all", "click", ASTExtAdmin._bulk_deactivate_modules_activate_module );
			
			$( document ).delegate( ".clear-cache", "click", ASTExtAdmin._clear_assets_cache );

			$(document).on("change", "#ast-wl-hide-branding",ASTExtAdmin._enable_white_label );
			$(document).on('click', '#astra_beta_updates', ASTExtAdmin._astra_beta_updates);
			$(document).on('click', '#astra_file_generation', ASTExtAdmin._astra_file_generation);
			$(document).on('click', '#astra_refresh_assets', ASTExtAdmin._astra_refresh_assets);

			$( "#search-astra-addon" ).focus();
			$( "#search-astra-addon" ).bind( "keyup input", ASTExtAdmin._search_modules );

			// Call Tooltip
			$('.ast-white-label-help').tooltip({
				content: function() {
					return $(this).prop('title');
				},
				tooltipClass: 'ast-white-label-ui-tooltip',
				position: {
					my: 'center top',
					at: 'center bottom+10',
				},
				hide: {
					duration: 200,
				},
				show: {
					duration: 200,
				},
			});
		},

		_astra_beta_updates: function(e)
		{
			var _this = $(this)
			var status = _this.data('value');

			if ( status == 'disable' ) {
				newString = astraAddonModules.disableBetaUpdates;
				newStatus = 'enable';
			} else {
				newString = astraAddonModules.enableBetaUpdates;
				newStatus = 'disable';
			}

			_this.removeClass('install-now installed button-disabled updated-message')
				.addClass('updating-message');

			$.ajax({
				url: astra.ajaxUrl,
				type: 'POST',
				data: {
					'action': 'astra_beta_updates',
					'status': newStatus,
					'nonce': astraAddonModules.ajax_nonce,
				},
			})
			.done(function(result) {
				if (result.success) {
					_this.html(newString).data('value', newStatus).removeClass('updating-message');
				} else {
					_this.removeClass('updating-message');

				}
			});
		},

		_astra_file_generation: function(e)
		{
			var _this = $(this)
			var status = _this.data('value');

			if ( 'disable' == status ) {
				newString = astraAddonModules.disableFileGeneration;
				newStatus = 'enable';
				$('.astra-refresh-assets-wrapper').slideDown();
			} else {
				newString = astraAddonModules.enableFileGeneration;
				newStatus = 'disable';
				$('.astra-refresh-assets-wrapper').slideUp();
			}

			_this.removeClass('install-now installed button-disabled updated-message')
				.addClass('updating-message');

				$.ajax({
				url: astra.ajaxUrl,
				type: 'POST',
				data: {
					'action': 'astra_file_generation',
					'status': newStatus,
					'nonce': astraAddonModules.ajax_nonce,
				},
			})
			.done(function(result) {
				if (result.success) {
					_this.html(newString).data('value', newStatus).removeClass('updating-message');
					if( 'disable' === newStatus ) {
						// Delete all the Dynamic CSS files.
						$('#astra_refresh_assets').trigger('click');
					}
				} else {
					_this.removeClass('updating-message');

				}
			});
		},

		_astra_refresh_assets: function(e)
		{
			var _this = $(this)

			if ( undefined !== e.originalEvent ) {
				_this.addClass('refreshing-assets');
				_this.find( '.ast-loader' ).addClass( 'spinner is-active' );
				_this.find( '.ast-refresh-btn-text' ).text( astraAddonModules.assetsRefreshingButtonText + '...' );
			}

			$.ajax({
				url: astra.ajaxUrl,
				type: 'POST',
				data: {
					'action': 'astra_refresh_assets_files',
					'nonce': astraAddonModules.ajax_nonce,
				},
			})
			.done(function(result) {
				if (e.originalEvent !== undefined) {
					if (result.success) {
					    _this.find( '.ast-loader' ).removeClass( 'spinner is-active' );
						_this.removeClass('refreshing-assets');
						_this.find( '.ast-refresh-btn-text' ).text( astraAddonModules.assetsRefreshedButtonText );
					} else {
						_this.find( '.ast-loader' ).removeClass( 'spinner is-active' );
						_this.removeClass('refreshing-assets');
						_this.find( '.ast-refresh-btn-text' ).text( astraAddonModules.assetsRefreshedButtonText );
					}
				}
			});
		},

		/**
		 * Callback for when the Hide White Label  is checked
		 *
		 * @method _enable_white_label
		 */
		_enable_white_label: function( e )
		{
            e.preventDefault();
			if( $(this).is(':checked') ) {
            	$('.ast-white-label-desc-wrap').slideDown();
			}
			else{
				$('.ast-white-label-desc-wrap').slideUp();
			}
		},

		/**
		 * Activate All Modules.
		 */
		_bulk_activate_modules_activate_module: function( e ) {
			var button = $( this );

			var data = {
				action: 'astra_addon_bulk_activate_modules',
				nonce: astraAddonModules.ajax_nonce,
			};

			if ( button.hasClass( 'updating-message' ) ) {
				return;
			}
			
			$( button ).addClass('updating-message');

			AstraAddonAjaxQueue.add({
				url: ajaxurl,
				type: 'POST',
				data: data,
				success: function(data){

					// Delete all the Dynamic CSS files.
					$('#astra_refresh_assets').trigger('click');

					// Add Page Headers submenu dynamically.
					if( ! $("#wp-admin-bar-new-astra_adv_header").length ) {
						// Add Page Header submenu under Appearance -> Astra Options menu.
						$('li#menu-appearance ul.wp-submenu li.current').after( '<li><a href="edit.php?post_type=astra_adv_header">'+ astraAddonModules.pageHeadersText +'</a></li>' );

						// Add Page Header submenu under wp-admin bar.
						$('li#wp-admin-bar-new-content ul.ab-submenu').append('<li id="wp-admin-bar-new-astra_adv_header"><a href="'+ astraAddonModules.adminUrl +'astra_adv_header">'+ astraAddonModules.pageHeadersText +'</a></li>');
					}

					// Add Custom Layouts submenu dynamically.
					if( ! $("#wp-admin-bar-new-astra-advanced-hook").length ) {
						// Add Custom Layout submenu under Appearance -> Astra Options menu.
						$('li#menu-appearance ul.wp-submenu li.current').after( '<li><a href="edit.php?post_type=astra-advanced-hook">'+ astraAddonModules.customLayoutText +'</a></li>' );

						// Add Custom Layout submenu under wp-admin bar.
						$('li#wp-admin-bar-new-content ul.ab-submenu').append('<li id="wp-admin-bar-new-astra-advanced-hook"><a href="'+ astraAddonModules.adminUrl +'astra-advanced-hook">'+ astraAddonModules.customLayoutText +'</a></li>');
					}

					// Bulk add or remove classes to all modules.
					$('.ast-addon-list').children( "li" ).addClass( 'active' ).removeClass( 'deactive' );
					$('.ast-addon-list').children( "li" ).not('.ast-disable').find('.ast-activate-module')
						.addClass('ast-deactivate-module')
						.text(astraAddonModules.deactivate)
						.removeClass('ast-activate-module');
						$( button ).removeClass('updating-message');
					}
			});
			e.preventDefault();
		},

		/**
		 * Deactivate Bulk Modules.
		 */
		_bulk_deactivate_modules_activate_module: function( e ) {
			var button = $( this );

			var data = {
				action: 'astra_addon_bulk_deactivate_modules',
				nonce: astraAddonModules.ajax_nonce,
			};

			if ( button.hasClass( 'updating-message' ) ) {
				return;
			}
			$( button ).addClass('updating-message');

			AstraAddonAjaxQueue.add({
				url: ajaxurl,
				type: 'POST',
				data: data,
				success: function(data){

					// Delete all the Dynamic CSS files.
					$('#astra_refresh_assets').trigger('click');

					// Remove Page Header submenu dynamically.
					// Remove Custom Layout submenu under Appearance -> Astra Options menu.
					$('li#menu-appearance ul.wp-submenu li').find('a[href*="edit.php?post_type=astra_adv_header"]').remove();

					// Remove Page Header submenu under wp-admin bar.
					$('li#wp-admin-bar-new-content ul.ab-submenu').find('li#wp-admin-bar-new-astra_adv_header').remove();

					// Remove Custom Layouts submenu dynamically.
					// Remove Custom Layout submenu under Appearance -> Astra Options menu.
					$('li#menu-appearance ul.wp-submenu li').find('a[href*="edit.php?post_type=astra-advanced-hook"]').remove();

					// Remove Custom layout submenu under wp-admin bar.
					$('li#wp-admin-bar-new-content ul.ab-submenu').find('li#wp-admin-bar-new-astra-advanced-hook').remove();

					// Bulk add or remove classes to all modules.
					$('.ast-addon-list').children( "li" ).addClass( 'deactive' ).removeClass( 'active' );
					$('.ast-addon-list').children( "li" ).not('.ast-disable').find('.ast-deactivate-module')
						.addClass('ast-activate-module')
						.text(astraAddonModules.activate)
						.removeClass('ast-deactivate-module');
						$( button ).removeClass('updating-message');
					}
			});
			e.preventDefault();
		},

		/**
		 * Activate Module.
		 */
		_activate_module: function( e ) {
			var button = $( this ),
				id     = button.parents('li').attr('id'),
				title  = button.parents('li').find("h3").text();

			if( button.parents('li').hasClass( 'ast-disable' ) ) {
				e.stopPropagation();
				e.preventDefault();
				return;
			}

			var data = {
				module_id : id,
				action: 'astra_addon_activate_module',
				nonce: astraAddonModules.ajax_nonce,
			};

			if ( button.hasClass( 'updating-message' ) ) {
				return;
			}

			$( button ).addClass('updating-message');

			AstraAddonAjaxQueue.add({
				url: ajaxurl,
				type: 'POST',
				data: data,
				success: function(data){

					// Delete all the Dynamic CSS files.
					$('#astra_refresh_assets').trigger('click');

					// Add Page Headers submenu dynamically.
					if( 'advanced-headers' === id ) {
						// Add Page Header submenu under Appearance -> Astra Options menu.
						$('li#menu-appearance ul.wp-submenu li.current').after( '<li><a href="edit.php?post_type=astra_adv_header">'+ astraAddonModules.pageHeadersText +'</a></li>' );

						// Add Page Header submenu under wp-admin bar.
						$('li#wp-admin-bar-new-content ul.ab-submenu').append('<li id="wp-admin-bar-new-astra_adv_header"><a href="'+ astraAddonModules.adminUrl +'astra_adv_header">'+ astraAddonModules.pageHeadersText +'</a></li>');
					}

					// Add Custom Layouts submenu dynamically.
					if( 'advanced-hooks' === id ) {
						// Add Custom Layout submenu under Appearance -> Astra Options menu.
						$('li#menu-appearance ul.wp-submenu li.current').after( '<li><a href="edit.php?post_type=astra-advanced-hook">'+ astraAddonModules.customLayoutText +'</a></li>' );

						// Add Custom Layout submenu under wp-admin bar.
						$('li#wp-admin-bar-new-content ul.ab-submenu').append('<li id="wp-admin-bar-new-astra-advanced-hook"><a href="'+ astraAddonModules.adminUrl +'astra-advanced-hook">'+ astraAddonModules.customLayoutText +'</a></li>');
					}

					// Add active class.
					$( '#' + id ).addClass('active').removeClass( 'deactive' );

					// Change button classes & text.
					$( '#' + id ).find('.ast-activate-module')
						.addClass('ast-deactivate-module')
						.text(astraAddonModules.deactivate)
						.removeClass('ast-activate-module')
						.removeClass('updating-message');
					}
			});
			e.preventDefault();
		},

		/**
		 * Deactivate Module.
		 */
		_deactivate_module: function( e ) {
			var button = $( this ),
				id     = button.parents('li').attr('id');

			if( button.parents('li').hasClass( 'ast-disable' ) ) {
				e.stopPropagation();
				e.preventDefault();
				return;
			}
			
			var data = {
				module_id: id,
				action: 'astra_addon_deactivate_module',
				nonce: astraAddonModules.ajax_nonce,
			};
			
			if ( button.hasClass( 'updating-message' ) ) {
				return;
			}

			$( button ).addClass('updating-message');

			AstraAddonAjaxQueue.add({
				url: ajaxurl,
				type: 'POST',
				data: data,
				success: function(data){

					// Delete all the Dynamic CSS files.
					$('#astra_refresh_assets').trigger('click');

					// Remove Page Header submenu dynamically.
					if( 'advanced-headers' === id ) {
						// Remove Custom Layout submenu under Appearance -> Astra Options menu.
						$('li#menu-appearance ul.wp-submenu li').find('a[href*="edit.php?post_type=astra_adv_header"]').remove();

						// Remove Page Header submenu under wp-admin bar.
						$('li#wp-admin-bar-new-content ul.ab-submenu').find('li#wp-admin-bar-new-astra_adv_header').remove();
					}

					// Remove Custom Layouts submenu dynamically.
					if( 'advanced-hooks' === id ) {
						// Remove Custom Layout submenu under Appearance -> Astra Options menu.
						$('li#menu-appearance ul.wp-submenu li').find('a[href*="edit.php?post_type=astra-advanced-hook"]').remove();

						// Remove Custom layout submenu under wp-admin bar.
						$('li#wp-admin-bar-new-content ul.ab-submenu').find('li#wp-admin-bar-new-astra-advanced-hook').remove();
					}

					// Remove active class.
					$( '#' + id ).addClass( 'deactive' ).removeClass('active');

					// Remove active tabs.
					$('#ast-menu-page a.nav-tab[href*="' + id + '"]').hide();

					// Change button classes & text.
					$( '#' + id ).find('.ast-deactivate-module')
						.addClass('ast-activate-module')
						.text(astraAddonModules.activate)
						.removeClass('ast-deactivate-module')
						.removeClass('updating-message');

				}
			})
			e.preventDefault();
		},

		/**
		 * Quick Search - Search by Title
		 *
		 */
		_search_modules: function() {
			var q = $(this).val().toLowerCase();
			$('.ast-addon-wrap .ast-nothing-found').hide();
			if( q === '' ) {
	             $('.ast-addon-list li').fadeIn();
	        } else {
	            $('.ast-addon-list li').each( function(){
	                var self = $(this);

	                if( self.find('h3').html().toLowerCase().indexOf(q) > -1 ) {
	                    self.fadeIn().addClass('visible');
	                } else {
	                    self.fadeOut().removeClass('visible');
	                }
	            } );
	         // No result found message
        	if ( $('.ast-addon-list li').hasClass('visible') ) {
        		$('.ast-addon-wrap .ast-nothing-found').hide();
        	}
        	else{
        		$('.ast-addon-wrap .ast-nothing-found').fadeIn();
        	}
	        }
		},

		/**
		 * Clear Assets Cache.
		 */
		_clear_assets_cache: function() {
			var button 			= $( this );

			button.addClass('loading');

			var data = {
				action: 'astra_addon_clear_cache',
				nonce: astraAddonModules.ajax_nonce,
			};
			
			AstraAddonAjaxQueue.add({
				url: ajaxurl,
				type: 'POST',
				data: data,
				success: function(data){

					button.removeClass('loading');
					button.addClass('success');

					setTimeout(function() {
						button.removeClass('success');
					}, 3000);
				}
			})
		},
	}

	$( document ).ready(function() {
		ASTExtAdmin.init();
	});

})( jQuery );

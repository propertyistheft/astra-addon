(function($) { 

	AstMegaMenuAdmin = {

		init: function() {

			$( document )
				.ready( this._ready )
				.on( 'click', '.astra-megamenu-opts-btn', this._openSettingsModal )
				.on( 'click', '.astra-mm-modal-overlay, .astra-megamenu-cancel-btn, .astra-mm-options-wrap .astra-mm-close ', this._closeSettingsModal )
				.on( 'click', '.astra-megamenu-save-opts', this._saveMegamenuOptions )
				.on( 'click', '.astra-builder-upload-button', this._openMediaUploader )
				.on( 'click', '.ast-remove-button', this._removeUploadButton )
				.on( 'change', '.field-mm-enabled input', this._megaMenuOptionDependency )
				.on( 'change', '.field-mm-width [name="menu-item-megamenu_width"]', this._megaMenuWidthStyleDependency )
				.on( 'change', '.field-mm-enabled-heading input', this._megaMenuHeadingOptionDependency )
				.on( 'change', '.ast-content-src', this._contentOptDependency )
				.on( 'change', '.field-mm-disable-label input', this._disableLabelOptionDependency )
				.on( 'click', '.ast-insert-widget', this._dropWidget )
				.on( 'click', '.astra-mm-options-wrap .widget-action', this._editWidget )
		},

		_openSettingsModal: function() {

			var $this              = $(this);
			var $holder            = $this.parents( '.menu-item-settings' );
			var menu_item          = $this.closest('li.menu-item');
			var classes            = menu_item.attr('class').split(' ');
			var menu_item_id       = parseInt( menu_item.attr("id").match(/[0-9]+/)[0], 10 );
			var security_nonce     = menu_item.find('.ast-nonce-field').val();
			var popup_wrap         = $('.ast-popup-wrap');
			var menu_title         = menu_item.find('.menu-item-title').text();
			var spinner            = popup_wrap.find('.ast-megamenu-spinner.spinner');
			var opts_wrap 		   = $('.astra-mm-options-wrap'),
				advanced_options   = $(".field-mm-advanced-options");

			$('html').css( 'overflow', 'hidden' );

			$popup_menu_item = popup_wrap.data( 'menu_item' );
			spinner.addClass( 'is-active' );
			AstMegaMenuAdmin._addDepthClass( classes );

			var li_parent = $this.parents('.menu-item');
			var closest_parent = li_parent.prevAll('.menu-item-depth-0');
			var closest_parent_id = closest_parent.attr('id');
			var parent_id = null;
			
			if ( typeof closest_parent_id != 'undefined' ) {
				parent_id = closest_parent_id.replace(/[^0-9\.]/g, '');
			}

			// If already loaded
			if( menu_item_id == $popup_menu_item ) {

				spinner.removeClass( 'is-active' );
				popup_wrap.css( 'display', 'flex' );
				popup_wrap.find('.astra-mm-options-wrap, .astra-mm-modal-overlay').show();	
				return;
			} else {
				popup_wrap.find('.astra-mm-options-wrap div').css( 'visibility', 'hidden' );
			}

			var data = {
				action : 'ast_render_popup',
				menu_item_id: menu_item_id,
				parent_id: parent_id,
				security_nonce: security_nonce
			};

			popup_wrap.css( 'display', 'flex' );
			popup_wrap.find('.astra-mm-options-wrap, .astra-mm-modal-overlay').show();

			$.post( ajaxurl, data, function( response ) {

				var widget_html = response.data;
				spinner.removeClass( 'is-active' );
				popup_wrap.find('astra-mm-options-wrap div').css( 'visibility', 'visible' );

				$('.ast-popup-wrap .astra-mm-options-wrap').html( widget_html );

				var editing_prefix = $(".ast-editing-label").data( 'label');
				var edit_text      = editing_prefix + ' ' + menu_title;

				$(".ast-editing-label").text( edit_text );

				$('.ast-popup-wrap .astra-mm-options-wrap').data( 'menu-item', menu_item_id );
				
				AstMegaMenuAdmin._initSelect2( opts_wrap );

				opts_wrap.find('.astra-wp-color-input').wpColorPicker();
				AstMegaMenuAdmin._contentOptDependency( $this, opts_wrap );

				$( $holder ).addClass( 'ast-active' );

				popup_wrap.data( 'loaded', true );
				popup_wrap.data( 'menu_item', menu_item_id );

				AstMegaMenuAdmin._renderSavedWidgets( opts_wrap, menu_item_id );

			});
		},

		_addDepthClass: function( classes ) {

			var depth_class        = '';

			// Get depth class for menu item
			for ( var i = 0; i < classes.length; i++ ) {
				var matches = /^menu-item\-(.+)/.exec( classes[i] );
				if ( matches != null ) {
					var container_class = matches[1];
					if( container_class.indexOf( 'depth' ) !== -1 ) {
						depth_class = 'menu-item-' + container_class;
					}
				}
			}

			// Remove existing depth classes
			$('.astra-mm-options-wrap').removeClass( function ( index, css ) {
				return ( css.match (/\bmenu-item-depth\S+/g) || []).join(' ');
			});

			$('.astra-mm-options-wrap').addClass( depth_class );
		},

		_openMediaUploader: function( e ) {

			e.preventDefault();
 
    		var button = $(this),
    			item_id = button.data( 'id' ),
    		    custom_uploader = wp.media({
					title: 'Insert image',
					library : {
						// uncomment the next line if you want to attach image to the current post
						// uploadedTo : wp.media.view.settings.post.id, 
						type : 'image'
					},
					button: {
						text: 'Use this image' // button label text
					},
					multiple: false // for multiple image selection set to true
				}).on('select', function() { // it also has "open" and "close" events 
						
					var mediaAttachment = custom_uploader.state().get( 'selection' ).first().toJSON();
					$( '#edit-menu-item-megamenu-' + item_id ).val( mediaAttachment.url );
					$( '#astra-media-img-' + item_id ).attr( 'src', mediaAttachment.url ).css( 'display', 'block' );
					$( '#astra-media-img-' + item_id ).parents( '.ast-media-img-container' ).addClass( 'ast-image-set' );
				})
				.open();
		},

		_closeSettingsModal: function() {

			$('html').css( 'overflow', 'unset' );
			$( '.menu-item-settings' ).removeClass('ast-active');
			$('.astra-mm-modal-overlay').hide();
			$('.astra-mm-options-wrap').hide();
			$(".ast-popup-wrap").hide();
			$('.ast-popup-wrap').find('.spinner').removeClass( 'is-active' );

		},

		_initSelect2: function( container ) {

			container.find(".ast-select2-container").astselect2({

				placeholder: astMegamenuVars.select2_placeholder,

				ajax: {
				    url: ajaxurl,
				    dataType: 'json',
				    method: 'post',
				    delay: 250,
				    data: function (params) {

				      	return {
				        	q: params.term, // search term
					        page: params.page,
							action: 'ast_get_posts_list',
							'nonce': astRules.ajax_nonce,
				    	};
					},
					processResults: function (data) {
			            // parse the results into the format expected by Select2.
			            // since we are using custom formatting functions we do not need to
			            // alter the remote JSON data

			            return {
			                results: data
			            };
			        },
				    cache: true
				},
				minimumInputLength: 2,
				language: astRules.ast_lang
			});
		},

		_removeUploadButton: function() {

			var $media_container = $( this ).parents( '.ast-media-img-container' );
			$media_container.find( 'img' ).attr( 'src', '' );
			$media_container.find( '.astra-builder-upload-field' ).val( '' );
			$media_container.removeClass( 'ast-image-set' );
		},

		_megaMenuHeadingOptionDependency: function() {

			var $this             = $(this);
			var is_checked        = $this.prop('checked');
			var heading_options   = $(".field-mm-header-sep-color");
			
			if( is_checked ) {
				if ( ! $this.parents('.astra-mm-options-wrap').hasClass('menu-item-depth-0') ) {
					heading_options.show();
				}
			} else {
				heading_options.hide();
			}
			
		},
		_megaMenuOptionDependency: function() {

			var $this               = $(this),
				is_checked          = $this.prop('checked'),
				width_options       = $(".field-mm-megamenu-opts .field-mm-width"),
				mega_menu_dependent = $(".bg-image-container, .field-mm-color"),
				mega_menu_src       = $( '.field-mm-content-src' ),
				mega_menu_container_style = $('.field-mm-width [name="menu-item-megamenu_width"]'),
				mega_menu_custom_width = $('.mm-custom-width-wrap'),
				advanced_options   = $(".field-mm-advanced-options");

			if( is_checked ) {
				width_options.show();
				mega_menu_dependent.show();
				if ( ! $this.parents('.astra-mm-options-wrap').hasClass('menu-item-depth-0') ) {
					mega_menu_src.show();
					advanced_options.hide();
				} else {
					advanced_options.show();
				}
				if ( 'custom' == mega_menu_container_style.val() ) {
					mega_menu_custom_width.show();
				}
			} else {
				width_options.hide();
				mega_menu_dependent.hide();
				mega_menu_src.hide();
				mega_menu_custom_width.hide();
				advanced_options.hide();
			}
		},

		_megaMenuWidthStyleDependency: function() {

			var $this               = $(this),
				mega_menu_custom_width = $('.mm-custom-width-wrap');

			if ( 'custom' == $this.val() ) {
				mega_menu_custom_width.show();
			} else {
				mega_menu_custom_width.hide();
			}
		},

		_disableLabelOptionDependency: function() {
				
			var $this = $(this);
			var is_checked = $this.prop('checked');
			var disable_link = $('.field-mm-disable-link');
			
			if( is_checked ) {
				disable_link.hide();
			} else {
				disable_link.show();
			}
		},

		_contentOptDependency: function( event, opts_wrap ) {

			$('.field-mm-template').hide();
			$('.field-mm-custom-text').hide();
			$('.field-mm-widget-option').hide();
			$('.field-mm-widget-area').hide();
			$('.mm-custom-width-wrap').hide();
			$('.field-mm-advanced-options').hide();

			if( 'undefined' != typeof opts_wrap ) {
				var src = opts_wrap.find(".ast-content-src").val(),
					settings_container = opts_wrap.find('.ast-mm-settings'),
					is_mega_menu_enabled = opts_wrap.find('.field-mm-enabled input').prop('checked'),
					menu_container_style = opts_wrap.find('.field-mm-width [name="menu-item-megamenu_width"]'),
					mega_menu_custom_width = opts_wrap.find('.mm-custom-width-wrap'),
					advanced_options = opts_wrap.find(".field-mm-advanced-options");

				if( is_mega_menu_enabled ) {
					if ( opts_wrap.closest( '.astra-mm-options-wrap' ).hasClass('menu-item-depth-0') ) {
						advanced_options.show();
					} else {
						advanced_options.hide();
					}
					if ( 'custom' == menu_container_style.val() ) {
						mega_menu_custom_width.show();
					} else {
						mega_menu_custom_width.hide();
					}
				}
			} else {
				var src = $(this).val();
				var settings_container = $(this).closest('.ast-mm-settings');
			}

			switch( src ) {

				case 'template': 
					settings_container.find('.field-mm-template').show();
				break;
				case 'custom_text': 
					settings_container.find('.field-mm-custom-text').show();
				break;
				case 'widget':
					settings_container.find('.field-mm-widget-option').show();
					settings_container.find('.field-mm-widget-area').show();
				break;
			}			
		},

		_dropWidget: function( event ) {

			event.preventDefault();

			var $this = $(this);
			var widget_id = $('.ast-select-widget').val();
			var container = $this.closest( '.astra-mm-options-wrap' );
			var menu_item_id = container.data('menu-item');
			var security_nonce = container.find(".ast-drop-widget-nonce").val();

			if( '' == widget_id ) {
				return;
			}

			$('.ast-widget-list').show();

			var data = {
				action : 'ast_add_widget',
				widget_id: widget_id,
				menu_item_id: menu_item_id,
				title:  $('.ast-select-widget').find("option:selected").text(),
				security_nonce: security_nonce
			};

			$.post( ajaxurl, data, function( response ) {
				var widget_html = $(response.data);

				container.find('.ast-widget-list').append( widget_html );

				$('.ast-select-widget').val('');

			});
		},

		_editWidget: function() {

			var widget = $(this).closest(".widget");
            var widget_inner = widget.find(".widget-inner");
            var id = widget.attr("id");

            widget.toggleClass('menu-item-edit-active');

			var data = {
				action : 'ast_edit_widget',
				widget_id: id
			};

           if ( !widget.hasClass( "open" ) && ! widget.data( "loaded" ) ) {

				$.post( ajaxurl, data, function( response ) {

					widget_inner.html( response.data );

					widget.data( "loaded", true ).toggleClass("open");

	                // Init Black Studio TinyMCE
	                if ( widget.is('[id*=black-studio-tinymce]') ) {
	                    bstw( widget ).deactivate().activate();
	                }

	                setTimeout(function(){
	                    $(document).trigger("widget-added", [widget]);
	                }, 100 );

	                // bind delete button action
	                widget.find( '.delete' ).on("click", function(e) {
	                    e.preventDefault();

	                    var security_nonce = widget.find('.ast-delete-widget-nonce').val();

	                    var data = {
	                        action: "ast_delete_widget",
	                        widget_id: id,
	                        security_nonce: security_nonce
	                    };

	                    $.post(ajaxurl, data, function(delete_response) {
	                        widget.remove();
	                    });

	                });

	                widget.find( '.close' ).on("click", function(e) {
	                    e.preventDefault();

	                    widget.toggleClass("open");
	                });

	                widget.find('.ast-save-widget').on("click", function(e) {
	                    e.preventDefault();

	                    var data = widget.find("form").serialize();
	                    var $button = $(this);
	                    $button.attr( 'disabled', 'disabled' );

	                    widget.find( '.spinner' ).css( 'visibility', 'visible' );

	                    $.post( ajaxurl, data, function( submit_response ) {
	                        	
	                        widget.find( '.spinner' ).css( 'visibility', 'hidden' );
		                    $button.removeAttr( 'disabled' );

	                    });

	                });

				});
			} else {
				widget.toggleClass("open");
			}

		},

		_renderSavedWidgets: function( container, menu_item_id ) {

			var security_nonce = container.find( '.ast-render-widgets-nonce' ).val();

			var data = {
				action : 'ast_render_widgets',
				menu_item_id: menu_item_id,
				security_nonce: security_nonce
			};

			$.post( ajaxurl, data, function( response ) {
				var widget_html = response.data.html;
				var has_widgets = response.data.has_widgets;

				if( has_widgets ) {
					$(".ast-widget-list").show();
				}

				container.find('.ast-widget-list').html( widget_html );

				$( "#ast-widget-sortable" ).sortable();

    			$( "#ast-widget-sortable" ).disableSelection();

			});

			
		},

		_saveMegamenuOptions: function() {

			var $button = $(this);
			var options_wrap = $button.closest( '.astra-mm-options-wrap' );
			var menu_item_id = options_wrap.data( 'menu-item' );
			var nav_object_id = $("#nav-menu-meta-object-id").val();
			var widget_sequence = [];
			var security_nonce = options_wrap.find(".ast-nonce-field").val();

			$(".astra-mm-cta-wrap .spinner").css( 'visibility', 'visible' );
			$button.text( astMegamenuVars.saving_text );
			$button.attr( 'disabled', 'disabled' );
			var options_data = {};

			options_wrap.find( 'select, textarea, input' ).each( function() {

				var $input = $(this);

				if( $input.closest( '.astra-mm-settings-wrap' ).find( '.ast-widget-list' ).length > 0 
				 || $input.hasClass('ast-nonce-field') ) {
					return;
				}

				var name = $input.attr('name');
				var value = $input.val();

				if( 'checkbox' == $input.attr('type') ) {
					if( ! $input.is(':checked') ) {
						value = '';
					} 
				}

				if( $input.tagName == 'textarea' ) {
					value = $(this).text();
				}

				if( 'undefined' != typeof name ) {
					options_data[name] = value;
				}
			});

			$('#ast-widget-sortable > .widget').each( function() {

				var widget_index = $(this).index();
				var widget_id    = $(this).attr( 'id' );

				widget_sequence[ widget_index ] = widget_id;
			});

			var data = {
				action: 'ast_save_menu_options',
				menu_item_id: menu_item_id,
				nav_id: nav_object_id,
				widgets: widget_sequence,
				options: options_data,
				security_nonce: security_nonce
			};

			$.post( ajaxurl, data, function( response ) {
				$button.text( astMegamenuVars.saved_text );
				$(".astra-mm-cta-wrap .spinner").css( 'visibility', 'hidden' );

				setTimeout(function() {
					$button.text( $button.data('label') );
                    $button.removeAttr( 'disabled' );
				}, 1000 );

			});	

		}
	}

	AstMegaMenuAdmin.init();

})(jQuery);

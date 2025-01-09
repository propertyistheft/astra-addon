document.addEventListener("DOMContentLoaded", () => {
	//click event for menu settings button.
	menuSettingsEventClick();

});

function menuSettingsEventClick() {
	const offCanvasSection = document.querySelector(".ast-offcanvas-wrapper");

	document.addEventListener("click", function (event) {
		if (event.target.matches(".astra-megamenu-opts-btn")) {

			const menuDepth = event.target.closest(".menu-item").classList.value;
			if (menuDepth.includes('menu-item-depth-')) {
				const menuDeptId = menuDepth.split('menu-item-depth-')[1].split('')[0];
				const menuName = event.target.getAttribute("data-menu-title");
				const menuId = event.target.getAttribute("data-menu-id");
				const navId = document
					.querySelector("#nav-menu-meta-object-id")
					.getAttribute("value");

				if (menuDeptId && menuName && menuId && navId) {
					document.dispatchEvent(
						new CustomEvent("astra_mega_menu_event", {
							detail: {
								menu_depth: menuDeptId,
								menu_name: menuName,
								menu_id: menuId,
								navId: navId,
							},
						})
					);

					if (!offCanvasSection.classList.contains("active")) {
						offCanvasSection.classList.add("active");
					}
				}
			}

		}
	});
}

function onColorReady() {
	jQuery(document).mouseup(function (e) {
		var container = jQuery('.ast-color');
		var colorWrap = container.find('.astra-color-picker-wrap');
		var resetBtnWrap = container.find('.ast-color-btn-reset-wrap');

		// If the target of the click isn't the container nor a descendant of the container.
		if (!colorWrap.is(e.target) && !resetBtnWrap.is(e.target) && colorWrap.has(e.target).length === 0 && resetBtnWrap.has(e.target).length === 0) {
			container.find('.components-button.astra-color-icon-indicate.open').click();
		}
	});
}

// Old code modified to work with current implementation.

(function ($) {
	const abortController = { current: null };
	document.addEventListener("astra_mega_menu_loaded", function (event) {
		renderSavedWidgets(event.detail.menu_id);
		select2Init();
		onColorReady();
	});

	// This event listener is triggered when the mega menu is unmounted.
	// It checks if there's an ongoing request and aborts it if found.
	document.addEventListener( 'astra_mega_menu_unmounted', () => {
		if ( abortController.current ) {
			abortController.current?.abort();
		}
	} );

	document.addEventListener("astra_mega_menu_widget_event", function (event) {
		dropWidget(event.detail.menu_id);
	});

	function dropWidget(menuid) {
		var widget_id = $(".ast-select-widget").val();
		var container = $(".astra-mm-options-wrap");
		var menu_item_id = menuid;

		if ("" == widget_id) {
			return;
		}

		$(".ast-widget-list").show();

		var data = {
			action: "ast_add_widget",
			widget_id: widget_id,
			menu_item_id: menu_item_id,
			title: $(".ast-select-widget").find("option:selected").text(),
			security_nonce: AstraBuilderMegaMenu.nonceWidget,
		};

		$.post(ajaxurl, data, function (response) {
			var widget_html = $(response.data);
			widget_html?.each((_, element) => container.find(".ast-widget-list").append(DOMPurify.sanitize(element)));

			$(".widget-action").off();

			$(".widget-action").on("click", editWidget);
			$("#mega-menu-submit").removeClass('ast-disabled');
		});
	}

	function renderSavedWidgets( menu_item_id ) {
		const container = $( '.astra-mm-options-wrap' );

		// Abort any ongoing request before starting a new one.
		if ( abortController.current ) {
			abortController.current?.abort();
		}

		// Create a new AbortController for this request.
		abortController.current = new AbortController();

		const data = {
			action: 'ast_render_widgets',
			menu_item_id: menu_item_id,
			security_nonce: AstraBuilderMegaMenu.nonceWidget,
		};

		// Convert data to URL-encoded format
		const params = new URLSearchParams( data ).toString();

		// Using fetch instead of $.post() to make use of the AbortController.
		fetch( ajaxurl, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded',
			},
			body: params,
			signal: abortController.current?.signal,
		} )
			.then( ( response ) => {
				if ( ! response.ok ) {
					throw new Error( 'Network response was not ok!' );
				}
				return response.json();
			} )
			.then( ( response ) => {
				const widgetHTML = response.data.html;
				const hasWidgets = response.data.has_widgets;

				if ( hasWidgets ) {
					$( '.ast-widget-list' ).show();
				}

				container.find( '.ast-widget-list' ).html( DOMPurify.sanitize( widgetHTML ) );

				$( '#ast-widget-sortable' ).sortable( {
					change: function ( event, ui ) {
						$( '#mega-menu-submit' ).removeClass( 'ast-disabled' );
					},
				} );

				$( '#ast-widget-sortable' ).disableSelection();

				$( '.widget-action' ).off();

				$( '.widget-action' ).on( 'click', editWidget );
			} )
			.catch( ( error ) => {
				if ( error.name === 'AbortError' ) {
					return;
				}
				console.error( 'Fetch error: ', error );
			} );
	}

	function editWidget() {
		var widget = $(this).closest(".widget");
		var widget_inner = widget.find(".widget-inner");
		var id = widget.attr("id");

		widget.toggleClass("menu-item-edit-active");

		var data = {
			action: "ast_edit_widget",
			widget_id: id,
			security_nonce: AstraBuilderMegaMenu.nonceWidget,
		};

		if (!widget.hasClass("open") && !widget.data("loaded")) {
			$.post(ajaxurl, data, function (response) {
				// Configure DOMPurify to allow the name="action" attribute on input elements.
				DOMPurify.addHook('afterSanitizeAttributes', (node) => {
					if (node.nodeName === 'INPUT' && node?.hasAttribute('value') && node?.getAttribute('value') === 'ast_save_widget') {
						node?.setAttribute('name', 'action');
					}
				});

				widget_inner.html(DOMPurify.sanitize(response.data));

				widget.data("loaded", true).toggleClass("open");

				// Init Black Studio TinyMCE
				if (widget.is("[id*=black-studio-tinymce]")) {
					bstw(widget).deactivate().activate();
				}

				setTimeout(function () {
					$(document).trigger("widget-added", [widget]);
				}, 100);

				// bind delete button action
				widget.find(".delete").on("click", function (e) {
					e.preventDefault();

					var data = {
						action: "ast_delete_widget",
						widget_id: id,
						security_nonce: AstraBuilderMegaMenu.nonceWidget,
					};

					$.post(ajaxurl, data, function (delete_response) {
						widget.remove();
						$("#mega-menu-submit").removeClass('ast-disabled');
					});
				});

				widget.find(".close").on("click", function (e) {
					e.preventDefault();

					widget.toggleClass("open");
				});

				widget.find(".ast-save-widget").on("click", function (e) {
					e.preventDefault();

					var data = widget.find("form").serialize();
					var $button = $(this);
					$button.attr("disabled", "disabled");

					widget.find(".spinner").css("visibility", "visible");

					$.post(ajaxurl, data, function (submit_response) {
						widget.find(".spinner").css("visibility", "hidden");
						$button.removeAttr("disabled");
						$("#mega-menu-submit").removeClass('ast-disabled');
					});
				});
			});
		} else {
			widget.toggleClass("open");
		}
	}

	function select2Init() {
		$(".astra-mm-options-wrap")
			.find(".ast-select2-container")
			.astselect2({
				placeholder: astMegamenuVars.select2_placeholder,

				ajax: {
					url: ajaxurl,
					dataType: "json",
					method: "post",
					delay: 250,
					data: function (params) {
						return {
							q: params.term, // search term
							page: params.page,
							action: "ast_get_posts_list",
							nonce: astRules.ajax_nonce,
						};
					},
					processResults: function (data) {
						// parse the results into the format expected by Select2.
						// since we are using custom formatting functions we do not need to
						// alter the remote JSON data
						$("#mega-menu-submit").removeClass('ast-disabled');
						return {
							results: data,
						};
					},
					cache: true,
				},
				minimumInputLength: 2,
				language: astRules.ast_lang,
			});
	}
})(jQuery);

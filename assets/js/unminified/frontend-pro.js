/**
 * File fronend-pro.js
 *
 * Handles toggling the navigation menu for Addon widget
 *
 * @package astra-addon
 */

 astraToggleSetupPro = function( mobileHeaderType, body, menu_click_listeners ) {

	var flag = false;
	var menuToggleAllLength;

	if ( 'off-canvas' === mobileHeaderType || 'full-width' === mobileHeaderType ) {
        // comma separated selector added, if menu is outside of Off-Canvas then submenu is not clickable, it work only for Off-Canvas area with dropdown style.
        var __main_header_all = document.querySelectorAll( '#ast-mobile-popup, #ast-mobile-header' );
        if ( body.classList.contains('ast-header-break-point') ) {

            var menu_toggle_all   = document.querySelectorAll( '#ast-mobile-header .main-header-menu-toggle' );
        } else {
            menu_toggle_all   = document.querySelectorAll( '#ast-desktop-header .main-header-menu-toggle' );
		}
		menuToggleAllLength = menu_toggle_all.length;
    } else {

		if ( body.classList.contains('ast-header-break-point') ) {

			var __main_header_all = document.querySelectorAll( '#ast-mobile-header' ),
				menu_toggle_all   = document.querySelectorAll( '#ast-mobile-header .main-header-menu-toggle' );
				menuToggleAllLength = menu_toggle_all.length;
				flag = menuToggleAllLength > 0 ? false : true;
				menuToggleAllLength = flag ? 1 : menuToggleAllLength;
		} else {

			var __main_header_all = document.querySelectorAll( '#ast-desktop-header' ),
				menu_toggle_all = document.querySelectorAll('#ast-desktop-header .main-header-menu-toggle');
				menuToggleAllLength = menu_toggle_all.length;
		}
	}

	if ( menuToggleAllLength > 0 || flag ) {

        for (var i = 0; i < menuToggleAllLength; i++) {

			if ( !flag ) {
				menu_toggle_all[i].setAttribute('data-index', i);

				if (!menu_click_listeners[i]) {
					menu_click_listeners[i] = menu_toggle_all[i];
					menu_toggle_all[i].removeEventListener('click', astraNavMenuToggle);
					menu_toggle_all[i].addEventListener('click', astraNavMenuToggle, false);
				}
			}

            if ('undefined' !== typeof __main_header_all[i]) {

                // To handle the comma seprated selector added above we need this loop.
                for( var mainHeaderCount =0; mainHeaderCount  < __main_header_all.length; mainHeaderCount++ ){

                    if (document.querySelector('header.site-header').classList.contains('ast-builder-menu-toggle-link')) {
                        var astra_menu_toggle = __main_header_all[mainHeaderCount].querySelectorAll('ul.main-header-menu .menu-item-has-children > .menu-link, ul.main-header-menu .ast-menu-toggle');
                    } else {
                        var astra_menu_toggle = __main_header_all[mainHeaderCount].querySelectorAll('ul.main-header-menu .ast-menu-toggle');
                    }
                    // Add Eventlisteners for Submenu.
                    if (astra_menu_toggle.length > 0) {

                        for (var j = 0; j < astra_menu_toggle.length; j++) {
                            astra_menu_toggle[j].removeEventListener('click', AstraToggleSubMenu);
                            astra_menu_toggle[j].addEventListener('click', AstraToggleSubMenu, false);
                        }
                    }
                }
            }
        }
    }
}

astraNavMenuTogglePro = function ( event, body, mobileHeaderType, thisObj ) {

    event.preventDefault();

    var desktop_header = event.target.closest('#ast-desktop-header');

    var desktop_header_content = document.querySelector('#masthead > #ast-desktop-header .ast-desktop-header-content');

    if ( null !== desktop_header && undefined !== desktop_header && '' !== desktop_header ) {

        var desktop_toggle = desktop_header.querySelector( '.main-header-menu-toggle' );
    } else {
        var desktop_toggle = document.querySelector('#masthead > #ast-desktop-header .main-header-menu-toggle');
    }

    var desktop_menu = document.querySelector('#masthead > #ast-desktop-header .ast-desktop-header-content .main-header-bar-navigation');

    if ( 'desktop' === event.currentTarget.trigger_type ) {

        if ( null !== desktop_menu && '' !== desktop_menu && undefined !== desktop_menu ) {
            astraToggleClass(desktop_menu, 'toggle-on');
            if (desktop_menu.classList.contains('toggle-on')) {
                desktop_menu.style.display = 'block';
            } else {
                desktop_menu.style.display = '';
            }
        }
        astraToggleClass(desktop_toggle, 'toggled');
        if ( desktop_toggle.classList.contains( 'toggled' ) ) {
            body.classList.add("ast-main-header-nav-open");
            if ( 'dropdown' === mobileHeaderType ) {
                desktop_header_content.style.display = 'block';
            }
        } else {
            body.classList.remove("ast-main-header-nav-open");
            desktop_header_content.style.display = 'none';
        }
        return;
    }

    var __main_header_all = document.querySelectorAll('#masthead > #ast-mobile-header .main-header-bar-navigation');
    menu_toggle_all 	 = document.querySelectorAll( '#masthead > #ast-mobile-header .main-header-menu-toggle' )
    var event_index = '0';
    var sticky_header = false;
    if ( null !== thisObj.closest( '#ast-fixed-header' ) ) {

        __main_header_all = document.querySelectorAll('#ast-fixed-header > #ast-mobile-header .main-header-bar-navigation');
        menu_toggle_all 	 = document.querySelectorAll( '#ast-fixed-header .main-header-menu-toggle' )

        event_index = '0';
        sticky_header = true;

    }

    if ('undefined' === typeof __main_header_all[event_index]) {
        return false;
    }
    var menuHasChildren = __main_header_all[event_index].querySelectorAll('.menu-item-has-children');
    for (var i = 0; i < menuHasChildren.length; i++) {
        menuHasChildren[i].classList.remove('ast-submenu-expanded');
        var menuHasChildrenSubMenu = menuHasChildren[i].querySelectorAll('.sub-menu');
        for (var j = 0; j < menuHasChildrenSubMenu.length; j++) {
            menuHasChildrenSubMenu[j].style.display = 'none';
        }
    }

    var menu_class = thisObj.getAttribute('class') || '';

    if ( menu_class.indexOf('main-header-menu-toggle') !== -1 ) {
        astraToggleClass(__main_header_all[event_index], 'toggle-on');
        astraToggleClass(menu_toggle_all[event_index], 'toggled');
        if ( sticky_header && 1 < menu_toggle_all.length ) {
            astraToggleClass(menu_toggle_all['1'], 'toggled');
        }
        if (__main_header_all[event_index].classList.contains('toggle-on')) {
            __main_header_all[event_index].style.display = 'block';
            body.classList.add("ast-main-header-nav-open");
        } else {
            __main_header_all[event_index].style.display = '';
            body.classList.remove("ast-main-header-nav-open");
        }
    }
}

const accountMenuToggle = function () {
    const checkAccountActionTypeCondition = astraAddon.hf_account_action_type && 'menu' === astraAddon.hf_account_action_type;
    const accountMenuClickCondition = checkAccountActionTypeCondition && astraAddon.hf_account_show_menu_on && 'click' === astraAddon.hf_account_show_menu_on;

    const headerAccountContainer = document.querySelectorAll('.ast-header-account-wrap');

    if(  headerAccountContainer ) {

        headerAccountContainer.forEach(element => {

            const accountMenu = element.querySelector('.ast-account-nav-menu');

            document.addEventListener('pointerup', function(e) {
                const condition = ( accountMenuClickCondition ) || ( checkAccountActionTypeCondition && document.querySelector('body').classList.contains('ast-header-break-point'));
                if( condition ) {
                    // if the target of the click isn't the container nor a descendant of the container
                    if ( accountMenu && !element.contains( e.target ) ) {
                        accountMenu.style.right = '';
                        accountMenu.style.left = '';
                    }
                }
            });

            const headerAccountTrigger =  element.querySelector( '.ast-header-account-link' );
            if( headerAccountTrigger ) {
                headerAccountTrigger.addEventListener( 'click', function(e) {
                    const condition = ( accountMenuClickCondition ) || ( checkAccountActionTypeCondition && document.querySelector('body').classList.contains('ast-header-break-point'));
                    if( condition ) {

                        headerSelectionPosition = e.target.closest('.site-header-section');

                        if( headerSelectionPosition ) {
                            if( headerSelectionPosition.classList.contains('site-header-section-left') ) {
                                accountMenu.style.left   = accountMenu.style.left  === '' ? '-100%' : '';
                                accountMenu.style.right   = accountMenu.style.right  === '' ? 'auto' : '';
                            } else {
                                accountMenu.style.right   = accountMenu.style.right  === '' ? '-100%' : '';
                                accountMenu.style.left   = accountMenu.style.left  === '' ? 'auto' : '';
                            }
                        }
                    }
                });
            }
        });
    }
}

/**
 * Color Switcher.
 *
 * @since 4.10.0
 */
const astraColorSwitcher = {
	...astraAddon?.colorSwitcher, // Spreading Color Switcher options.

	/**
	 * Initializes the Color Switcher Widget.
	 */
	init: function () {
		if ( ! this?.isInit ) {
			return;
		}

		this.switcherButtons = document.querySelectorAll( '.ast-builder-color-switcher .ast-switcher-button' );

		if ( ! this.switcherButtons?.length ) {
			return;
		}

		this.switcherButtons?.forEach( ( switcherButton ) => {
			switcherButton?.addEventListener( 'click', this.toggle ); // ✅ `this` refers to astraColorSwitcher
		} );

		if ( this.isDarkPalette && this.defaultMode === 'system' ) {
			// Detect system preference and apply mode accordingly.
			this.detectSystemColorScheme();
		}
	},

	/**
	 * Detects the system's color scheme preference and sets the theme accordingly.
	 */
	detectSystemColorScheme: function () {
		const storedPreference = this.getCookie( 'astraColorSwitcherState' );

		// Bail early, if user has previously chosen a theme.
		if ( storedPreference !== null ) {
			return;
		}

		// Detect system preference.
		const prefersDark = window.matchMedia( '(prefers-color-scheme: dark)' ).matches;

		if ( prefersDark && ! this.isSwitched ) {
			// Apply the detected or stored theme.
			this.toggle();
		}
	},

	/**
	 * Toggle the palette.
	 *
	 * @param {Event} e Button click event object.
	 */
	toggle: function ( e ) {
		e?.preventDefault();
		const switcher = astraColorSwitcher;

		// Toggle the state
		switcher.isSwitched = ! switcher.isSwitched;

		// Store state in cookie (expires in 90 days).
		switcher.setCookie( 'astraColorSwitcherState', switcher.isSwitched, 90 );

		if ( switcher?.forceReload ) {
			window.location.reload();
			return;
		}

		switcher.switchPaletteColors();
		switcher.switchIcon();

		if ( switcher.isDarkPalette ) {
			switcher.handleDarkModeCompatibility();
		}
	},

	/**
	 * Switch Palette Colors.
	 */
	switchPaletteColors: function () {
		// Choose the correct palette based on `isSwitched` state.
		const currentPalette = this.isSwitched ? this?.palettes?.switched : this?.palettes?.default;

		// Apply the colors to CSS variables.
		currentPalette?.forEach( ( color, index ) => {
			document.documentElement.style.setProperty( `--ast-global-color-${ index }`, color );
		} );
	},

	/**
	 * Switch Icon.
	 */
	switchIcon: function () {
		this.switcherButtons?.forEach( ( switcherButton ) => {
			const [ defaultIcon, switchedIcon ] = switcherButton?.querySelectorAll( '.ast-switcher-icon' );

			// Avoid icon switching if there is none or only one.
			if ( defaultIcon && switchedIcon ) {
				const [ first, second ] = this.isSwitched ? [ switchedIcon, defaultIcon ] : [ defaultIcon, switchedIcon ];

				// Animate icon.
				switcherButton?.classList.add( 'ast-animate' );

				setTimeout( () => {
					first?.classList.add( 'ast-current' );
					second?.classList.remove( 'ast-current' );
				}, 100 );

				setTimeout( () => switcherButton?.classList.remove( 'ast-animate' ), 200 );
			}

            /// Switch aria attribute.
            const ariaLabelTextKey = this.isSwitched ? 'defaultText' : 'switchedText';
			switcherButton?.setAttribute(
				'aria-label',
				switcherButton?.dataset?.[ ariaLabelTextKey ] || 'Switch color palette.'
			);
		} );
	},

	/**
	 * Handle Dark Mode Compatibility.
	 */
	handleDarkModeCompatibility: function () {
		// Add the dark mode class.
		document.body.classList.toggle( 'astra-dark-mode-enable' );

		// Todo: Handle dark compatibility CSS.
	},

	/**
	 * Helper function to set a cookie.
	 */
	setCookie: ( name, value, days ) => {
		const expires = new Date();
		expires.setTime( expires.getTime() + days * 24 * 60 * 60 * 1000 );
		document.cookie = `${ name }=${ value }; expires=${ expires.toUTCString() }; path=/`;
	},

	/**
	 * Helper function to get a cookie.
	 */
	getCookie: ( name ) => {
		const cookies = document.cookie.split( '; ' );
		for ( let cookie of cookies ) {
			const [ key, val ] = cookie.split( '=' );
			if ( key === name ) return val;
		}
		return null;
	},
};

document.addEventListener( 'astPartialContentRendered', function() {
    accountMenuToggle();
});

window.addEventListener( 'load', function() {
    accountMenuToggle();
    astraColorSwitcher.init();
} );

document.addEventListener( 'astLayoutWidthChanged', function() {
    accountMenuToggle();
} );

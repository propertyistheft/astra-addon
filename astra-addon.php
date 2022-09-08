<?php
/**
 * Plugin Name: Astra Pro
 * Plugin URI: https://wpastra.com/
 * Description: This plugin is an add-on for the Astra WordPress Theme. It offers premium features & functionalities that enhance your theming experience at next level.
 * Version: 3.9.2
 * Author: Brainstorm Force
 * Author URI: https://www.brainstormforce.com
 * Text Domain: astra-addon
 *
 * @package Astra Addon
 */

if ( 'astra' !== get_template() ) {
	return;
}

/**
 * Set constants.
 */
define( 'ASTRA_EXT_FILE', __FILE__ ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound
define( 'ASTRA_EXT_BASE', plugin_basename( ASTRA_EXT_FILE ) ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound
define( 'ASTRA_EXT_DIR', plugin_dir_path( ASTRA_EXT_FILE ) ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound
define( 'ASTRA_EXT_URI', plugins_url( '/', ASTRA_EXT_FILE ) ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound
define( 'ASTRA_EXT_VER', '3.9.2' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound
define( 'ASTRA_EXT_TEMPLATE_DEBUG_MODE', false ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound

/**
 * Minimum Version requirement of the Astra Theme.
 * This will display the notice asking user to update the theme to the version defined below.
 */
define( 'ASTRA_THEME_MIN_VER', '3.9.2' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound

// 'ast-container' has 20px left, right padding. For pixel perfect added ( twice ) 40px padding to the 'ast-container'.
// E.g. If width set 1200px then with padding left ( 20px ) & right ( 20px ) its 1240px for 'ast-container'. But, Actual contents are 1200px.
define( 'ASTRA_THEME_CONTAINER_PADDING', 20 ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound
define( 'ASTRA_THEME_CONTAINER_PADDING_TWICE', ( 20 * 2 ) ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound
define( 'ASTRA_THEME_CONTAINER_BOX_PADDED_PADDING', 40 ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound
define( 'ASTRA_THEME_CONTAINER_BOX_PADDED_PADDING_TWICE', ( 40 * 2 ) ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound

/**
 * Update Astra Addon
 */
require_once ASTRA_EXT_DIR . 'classes/class-astra-addon-update.php';
require_once ASTRA_EXT_DIR . 'classes/astra-addon-update-functions.php';
require_once ASTRA_EXT_DIR . 'classes/class-astra-addon-background-updater.php';

/**
 * Inluding Filesystem astra_addon_filesystem
 */
require_once ASTRA_EXT_DIR . 'classes/class-astra-addon-filesystem.php';

/**
 * Extensions
 */
require_once ASTRA_EXT_DIR . 'classes/class-astra-theme-extension.php';

/**
 * Builder Core Files.
 */
require_once ASTRA_EXT_DIR . 'classes/builder/class-astra-addon-builder-helper.php';


/**
 * Header Footer Builder
 */
require_once ASTRA_EXT_DIR . 'classes/class-astra-builder.php';

/**
 * Load deprecated functions
 */
require_once ASTRA_EXT_DIR . 'classes/deprecated/deprecated-functions.php';

/**
 * Brainstorm Updater.
 */
require_once ASTRA_EXT_DIR . 'class-brainstorm-update-astra-addon.php';

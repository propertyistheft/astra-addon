<?php
/**
 * Plugin Name: Astra Pro
 * Plugin URI: https://wpastra.com/
 * Description: This plugin is an add-on for the Astra WordPress Theme. It offers premium features & functionalities that enhance your theming experience at next level.
 * Version: 4.5.0
 * Author: Brainstorm Force
 * Author URI: https://www.brainstormforce.com
 * Text Domain: astra-addon
 * WC requires at least: 3.0
 * WC tested up to: 8.0.3
 *
 * @package Astra Addon
 */

/**
 * Stops further processing if Astra theme is not installed & activate. Also display same notice for users.
 *
 * @since 3.9.3
 */
if ( 'astra' !== get_template() ) {

	/**
	 * Display the notice about theme installation & activation.
	 *
	 * @since 3.9.3
	 */
	function astra_addon_theme_requirement_notice() {
		?>
			<div class="notice notice-error">
				<p>
					<?php
						printf(
							wp_kses(
								/* translators: %s - Astra theme install URL. */
								__( 'Astra Pro requires <strong> Astra </strong> to be your active theme. <a href="%s">Install and activate now.</a>', 'astra-addon' ),
								array(
									'a'      => array(
										'href'   => array(),
										'target' => array(),
										'rel'    => array(),
									),
									'strong' => array(),
								)
							),
							esc_url( self_admin_url( 'theme-install.php?theme=astra' ) )
						);
					?>
				</p>
			</div>
		<?php
	}

	add_action( 'admin_notices', 'astra_addon_theme_requirement_notice' );
	return;
}

/**
 * Set constants.
 */
// @codingStandardsIgnoreStart
define( 'ASTRA_EXT_FILE', __FILE__ );
define( 'ASTRA_EXT_BASE', plugin_basename( ASTRA_EXT_FILE ) );
define( 'ASTRA_EXT_DIR', plugin_dir_path( ASTRA_EXT_FILE ) );
define( 'ASTRA_EXT_URI', plugins_url( '/', ASTRA_EXT_FILE ) );
define( 'ASTRA_EXT_VER', '4.5.0' );
define( 'ASTRA_EXT_TEMPLATE_DEBUG_MODE', false );
define( 'ASTRA_ADDON_BSF_PACKAGE', file_exists( ASTRA_EXT_DIR . 'class-brainstorm-update-astra-addon.php' ) );

/**
 * Maintaining this constant for preparing WooCommerce marketplace related package.
 * Because we are restricting Code Editor feature from Custom Layout due to eval() & echo $php_snippet code.
 */
define( 'ASTRA_WITH_EXTENDED_FUNCTIONALITY', file_exists( ASTRA_EXT_DIR . 'classes/astra-addon-extended-functionality.php' ) );

/**
 * Minimum Version requirement of the Astra Theme.
 * This will display the notice asking user to update the theme to the version defined below.
 */
define( 'ASTRA_THEME_MIN_VER', '4.5.0' );

// 'ast-container' has 20px left, right padding. For pixel perfect added ( twice ) 40px padding to the 'ast-container'.
// E.g. If width set 1200px then with padding left ( 20px ) & right ( 20px ) its 1240px for 'ast-container'. But, Actual contents are 1200px.
define( 'ASTRA_THEME_CONTAINER_PADDING', 20 );
define( 'ASTRA_THEME_CONTAINER_PADDING_TWICE', ( 20 * 2 ) );
define( 'ASTRA_THEME_CONTAINER_BOX_PADDED_PADDING', 40 );
define( 'ASTRA_THEME_CONTAINER_BOX_PADDED_PADDING_TWICE', ( 40 * 2 ) );
// @codingStandardsIgnoreEnd

/**
 * Update Astra Addon
 */
require_once ASTRA_EXT_DIR . 'classes/class-astra-addon-update.php';
require_once ASTRA_EXT_DIR . 'classes/astra-addon-update-functions.php';
require_once ASTRA_EXT_DIR . 'classes/class-astra-addon-background-updater.php';

/**
 * Extended code escaper.
 */
require_once ASTRA_EXT_DIR . 'classes/class-astra-addon-kses.php';

/**
 * Inluding Filesystem astra_addon_filesystem
 */
require_once ASTRA_EXT_DIR . 'classes/class-astra-addon-filesystem.php';

/**
 * Extensions
 */
if ( ASTRA_WITH_EXTENDED_FUNCTIONALITY ) {
	require_once ASTRA_EXT_DIR . 'classes/astra-addon-extended-functionality.php';
}
require_once ASTRA_EXT_DIR . 'classes/class-astra-theme-extension.php';

/**
 * Admin extended dashboard app.
 */
require_once ASTRA_EXT_DIR . 'admin/core/class-astra-addon-admin-loader.php';

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
if ( ASTRA_ADDON_BSF_PACKAGE ) {
	require_once ASTRA_EXT_DIR . 'class-brainstorm-update-astra-addon.php';
}

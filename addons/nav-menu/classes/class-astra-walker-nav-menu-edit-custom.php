<?php
/**
 * Custom walker nav edit.
 *
 * @package Astra
 */

if ( ! class_exists( 'Astra_Walker_Nav_Menu_Edit_Custom' ) ) {

	/**
	 * Create HTML list of nav menu input items.
	 *
	 * @since 1.6.0
	 */
	class Astra_Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu_Edit {

		/**
		 * Start the element output.
		 *
		 * @param string $output menu html.
		 * @param object $item menu item object.
		 * @param int    $depth menu item depth.
		 * @param object $args menu item args.
		 * @param int    $id menu item id.
		 *
		 * @since 1.6.0
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$item_output = '';

			parent::start_el( $item_output, $item, $depth, $args, $id );

			$position = '<fieldset class="field-move';

			$extra = $this->get_fields( $item, $depth, $args, $id );

			$output .= str_replace( $position, $extra . $position, $item_output );
		}

		/**
		 * Add custom hook to add new field.
		 *
		 * @param object $item menu item object.
		 * @param int    $depth menu item depth.
		 * @param object $args menu item args.
		 * @param int    $id menu item id.
		 * @since 1.6.0
		 */
		protected function get_fields( $item, $depth, $args = array(), $id = 0 ) {
			ob_start();

			global $wp_version;
			$item_id = intval( $item->ID );

			if ( version_compare( preg_replace( '/[^0-9\.]/', '', $wp_version ), '5.4', '<' ) ) {
				do_action( 'wp_nav_menu_item_custom_fields', $item_id, $item, $depth, $args );
			}

			return ob_get_clean();
		}

	} // Walker_Nav_Menu_Edit_Custom
}

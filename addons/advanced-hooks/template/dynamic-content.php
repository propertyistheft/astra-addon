<?php
/**
 * The template for displaying dynamic content.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Astra Addon
 * @since 4.3.0
 */

if ( isset( $args['template_id'] ) ) {
	Astra_Ext_Advanced_Hooks_Markup::render_overridden_template( absint( $args['template_id'] ) );
}

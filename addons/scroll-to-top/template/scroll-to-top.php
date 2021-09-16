<?php
/**
 * Scroll To Top Template
 *
 * @package Astra Addon
 */

$scroll_top_alignment = astra_get_option( 'scroll-to-top-icon-position' );
$scroll_top_devices   = astra_get_option( 'scroll-to-top-on-devices' );
?>
<a id="ast-scroll-top" class="<?php echo esc_attr( apply_filters( 'astra_scroll_top_icon', 'ast-scroll-top-icon' ) ); ?> ast-scroll-to-top-<?php echo esc_attr( $scroll_top_alignment ); ?>" data-on-devices="<?php echo esc_attr( $scroll_top_devices ); ?>">
	<?php Astra_Icons::get_icons( 'arrow', true ); ?>
	<span class="screen-reader-text"><?php esc_html_e( 'Scroll to Top', 'astra-addon' ); ?></span>
</a>

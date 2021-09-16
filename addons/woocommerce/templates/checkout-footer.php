<?php
/**
 * WooCommerce - Footer Template
 *
 * @package Astra Addon
 */

?>
<footer itemtype="https://schema.org/WPFooter" itemscope="itemscope" id="colophon" <?php astra_footer_classes(); ?> role="contentinfo">

	<?php do_action( 'astra_woo_checkout_footer_content_top' ); ?>

	<?php ( true === astra_addon_builder_helper()->is_header_footer_builder_active ) ? do_action( 'astra_below_footer' ) : astra_footer_small_footer_template(); ?>

	<?php do_action( 'astra_woo_checkout_footer_content_bottom' ); ?>

</footer><!-- #colophon -->

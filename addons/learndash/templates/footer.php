<?php
/**
 * LearnDash - Footer Template
 *
 * @package Astra Addon
 */

?>
<footer itemtype="https://schema.org/WPFooter" itemscope="itemscope" id="colophon" <?php astra_footer_classes(); ?>>

	<?php do_action( 'astra_woo_checkout_footer_content_top' ); ?>

	<?php astra_footer_small_footer_template(); ?>

	<?php do_action( 'astra_woo_checkout_footer_content_bottom' ); ?>

</footer><!-- #colophon -->

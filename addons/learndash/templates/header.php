<?php
/**
 * LearnDash - Header Template
 *
 * @package Astra Addon
 */

?>
<header itemtype="https://schema.org/WPHeader" itemscope="itemscope" id="masthead" <?php astra_header_classes(); ?>>
<?php do_action( 'astra_woo_checkout_masthead_top' ); ?>
	<div class="main-header-bar-wrap">
		<div class="main-header-bar">
			<?php do_action( 'astra_woo_checkout_main_header_bar_top' ); ?>
			<div class="ast-container">
				<div class="ast-flex main-header-container">
					<div class="site-branding">
						<div class="ast-site-identity" itemscope="itemscope" itemtype="https://schema.org/Organization">
							<?php astra_logo(); ?>
						</div>
					</div>
					<?php ASTRA_Ext_LearnDash_Markup::astra_header_learndash(); ?>
				</div><!-- Main Header Container -->
			</div><!-- ast-row -->
			<?php do_action( 'astra_woo_checkout_main_header_bar_bottom' ); ?>
		</div> <!-- Main Header Bar -->
	</div> <!-- Main Header Bar Wrap -->
<?php do_action( 'astra_woo_checkout_masthead_bottom' ); ?>
</header><!-- #masthead -->

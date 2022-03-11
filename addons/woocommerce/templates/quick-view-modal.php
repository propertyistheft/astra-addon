<?php
/**
 * WooCommerce - Quick View Modal
 *
 * @package Astra Addon
 */

?>
<div class="ast-quick-view-bg"><div class="ast-quick-view-loader blockUI blockOverlay"></div></div>
<div id="ast-quick-view-modal">
	<div class="ast-content-main-wrapper"><?php /*Don't remove this html comment*/ ?><!--
	--><div class="ast-content-main">
			<div class="ast-lightbox-content">
				<div class="ast-content-main-head">
					<a href="#" id="ast-quick-view-close" class="ast-quick-view-close-btn"> <?php Astra_Icons::get_icons( 'close', true ); ?> </a>
				</div>
				<div id="ast-quick-view-content" class="woocommerce single-product"></div>
			</div>
		</div>
	</div>
</div>

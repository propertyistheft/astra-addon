<?php
/**
 * Below Header Layout 1
 *
 * Stack Layout
 *
 * @package     Astra Addon
 */

?>
<div class="ast-below-header-wrap ast-below-header-2">
	<div class="ast-below-header">
		<?php do_action( 'astra_below_header_top' ); ?>
		<div class="ast-container">
			<div class="ast-flex ast-below-header-section-wrap">

				<?php Astra_Ext_Header_Sections_Markup::get_below_header_section( 'below-header-section-1', 'below-header-2' ); ?>

			</div>
		</div>
		<?php do_action( 'astra_below_header_bottom' ); ?>
	</div><!-- .ast-below-header -->
</div><!-- .ast-below-header-wrap -->

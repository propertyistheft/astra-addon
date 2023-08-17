<?php
/**
 * Above Header Layout 2
 *
 * This template generates markup required for the Above Header style 2
 *
 * @todo Update this template for Default Above Header Style
 *
 * @package Astra Addon
 */

$astra_addon_abv_header_section_type  = Astra_Ext_Header_Sections_Markup::get_above_header_section( 'above-header-section-1' );
$astra_addon_abv_header_section_value = astra_get_option( 'above-header-section-1' );
/**
 * Hide above header markup if:
 *
 * - User is not logged in. [AND]
 * - Sections 1 is set to none
 */
if ( empty( $astra_addon_abv_header_section_type ) ) {
	return;
}
?>

<div class="ast-above-header-wrap above-header-2" >
	<div class="ast-above-header">
		<?php do_action( 'astra_above_header_top' ); ?>
		<div class="ast-container">
			<div class="ast-flex ast-above-header-section-wrap">
				<?php if ( $astra_addon_abv_header_section_type ) { ?>
					<div class="ast-above-header-section ast-above-header-section-1 ast-flex ast-justify-content-center <?php echo esc_attr( $astra_addon_abv_header_section_value ); ?>-above-header" >
						<?php echo do_shortcode( $astra_addon_abv_header_section_type ); ?>
					</div>
				<?php } ?>
			</div>
		</div><!-- .ast-container -->
		<?php do_action( 'astra_above_header_bottom' ); ?>
	</div><!-- .ast-above-header -->
</div><!-- .ast-above-header-wrap -->

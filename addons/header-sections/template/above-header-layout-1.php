<?php
/**
 * Above Header Layout 1
 *
 * This template generates markup required for the Above Header style 1
 *
 * @todo Update this template for Default Above Header Style
 *
 * @package Astra Addon
 */

$astra_addon_abv_header_section_1 = Astra_Ext_Header_Sections_Markup::get_above_header_section( 'above-header-section-1' );
$astra_addon_abv_header_section_2 = Astra_Ext_Header_Sections_Markup::get_above_header_section( 'above-header-section-2' );

$astra_addon_section_1_value = astra_get_option( 'above-header-section-1' );
$astra_addon_section_2_value = astra_get_option( 'above-header-section-2' );
/**
 * Hide above header markup if:
 *
 * - User is not logged in. [AND]
 * - Sections 1 / 2 is set to none
 */
if ( empty( $astra_addon_abv_header_section_1 ) && empty( $astra_addon_abv_header_section_2 ) ) {
	return;
}
?>

<div class="ast-above-header-wrap ast-above-header-1" >
	<div class="ast-above-header">
		<?php do_action( 'astra_above_header_top' ); ?>
		<div class="ast-container">
			<div class="ast-flex ast-above-header-section-wrap">
				<?php if ( ! empty( $astra_addon_abv_header_section_1 ) ) { ?>
					<div class="ast-above-header-section ast-above-header-section-1 ast-flex ast-justify-content-flex-start <?php echo esc_attr( $astra_addon_section_1_value ); ?>-above-header" >
						<?php echo do_shortcode( $astra_addon_abv_header_section_1 ); ?>
					</div>
				<?php } ?>

				<?php if ( ! empty( $astra_addon_abv_header_section_2 ) ) { ?>
					<div class="ast-above-header-section ast-above-header-section-2 ast-flex ast-justify-content-flex-end <?php echo esc_attr( $astra_addon_section_2_value ); ?>-above-header" >
						<?php echo do_shortcode( $astra_addon_abv_header_section_2 ); ?>
					</div>
				<?php } ?>
			</div>
		</div><!-- .ast-container -->
		<?php do_action( 'astra_above_header_bottom' ); ?>
	</div><!-- .ast-above-header -->
</div><!-- .ast-above-header-wrap -->

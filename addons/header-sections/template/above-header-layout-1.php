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

$section_1 = Astra_Ext_Header_Sections_Markup::get_above_header_section( 'above-header-section-1' );
$section_2 = Astra_Ext_Header_Sections_Markup::get_above_header_section( 'above-header-section-2' );


$value1 = astra_get_option( 'above-header-section-1' );
$value2 = astra_get_option( 'above-header-section-2' );
/**
 * Hide above header markup if:
 *
 * - User is not logged in. [AND]
 * - Sections 1 / 2 is set to none
 */
if ( empty( $section_1 ) && empty( $section_2 ) ) {
	return;
}
?>

<div class="ast-above-header-wrap ast-above-header-1" >
	<div class="ast-above-header">
		<?php do_action( 'astra_above_header_top' ); ?>
		<div class="ast-container">
			<div class="ast-flex ast-above-header-section-wrap">
				<?php if ( ! empty( $section_1 ) ) { ?>
					<div class="ast-above-header-section ast-above-header-section-1 ast-flex ast-justify-content-flex-start <?php echo esc_attr( $value1 ); ?>-above-header" >
						<?php echo $section_1; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				<?php } ?>

				<?php if ( ! empty( $section_2 ) ) { ?>
					<div class="ast-above-header-section ast-above-header-section-2 ast-flex ast-justify-content-flex-end <?php echo esc_attr( $value2 ); ?>-above-header" >
						<?php echo $section_2; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				<?php } ?>
			</div>
		</div><!-- .ast-container -->
		<?php do_action( 'astra_above_header_bottom' ); ?>
	</div><!-- .ast-above-header -->
</div><!-- .ast-above-header-wrap -->

<?php
/**
 * Footer Layout 3
 *
 * @package Astra Addon
 */

/**
 * Hide advanced footer markup if:
 *
 * - User is not logged in. [AND]
 * - All widgets are not active.
 */
if ( ! is_user_logged_in() ) {
	if (
		! is_active_sidebar( 'advanced-footer-widget-1' ) &&
		! is_active_sidebar( 'advanced-footer-widget-2' ) &&
		! is_active_sidebar( 'advanced-footer-widget-3' )
	) {
		return;
	}
}

if ( ! isset( $astra_addon_footer_layout_classes ) || ! is_array( $astra_addon_footer_layout_classes ) ) {
	$astra_addon_footer_layout_classes = array();
}

$astra_addon_footer_layout_classes[] = 'footer-adv';
$astra_addon_footer_layout_classes[] = 'footer-adv-layout-3';
$astra_addon_footer_layout_classes   = implode( ' ', $astra_addon_footer_layout_classes );
?>

<div class="<?php echo esc_attr( $astra_addon_footer_layout_classes ); ?>">
	<div class="footer-adv-overlay">
		<div class="ast-container">
			<?php do_action( 'astra_footer_inside_container_top' ); ?>
			<div class="ast-row">
				<div class="<?php echo esc_html( apply_filters( 'astra_attr_ast-layout-3-grid_output', 'ast-layout-3-grid' ) ); ?> footer-adv-widget footer-adv-widget-1">
					<?php Astra_Ext_Adv_Footer_Markup::get_sidebar( 'advanced-footer-widget-1' ); ?>
				</div>
				<div class="<?php echo esc_html( apply_filters( 'astra_attr_ast-layout-3-grid_output', 'ast-layout-3-grid' ) ); ?> footer-adv-widget footer-adv-widget-2">
					<?php Astra_Ext_Adv_Footer_Markup::get_sidebar( 'advanced-footer-widget-2' ); ?>
				</div>
				<div class="<?php echo esc_html( apply_filters( 'astra_attr_ast-layout-3-grid_output', 'ast-layout-3-grid' ) ); ?> footer-adv-widget footer-adv-widget-3">
					<?php Astra_Ext_Adv_Footer_Markup::get_sidebar( 'advanced-footer-widget-3' ); ?>
				</div>
			</div><!-- .ast-row -->
			<?php do_action( 'astra_footer_inside_container_bottom' ); ?>
		</div><!-- .ast-container -->
	</div><!-- .footer-adv-overlay-->
</div><!-- .ast-theme-footer .footer-adv-layout-3 -->

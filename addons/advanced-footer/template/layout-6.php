<?php
/**
 * Footer Layout 6
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

$classes[] = 'footer-adv';
$classes[] = 'footer-adv-layout-6';
$classes   = implode( ' ', $classes );
?>

<div class="<?php echo esc_attr( $classes ); ?>">
	<div class="footer-adv-overlay">
		<div class="ast-container">
			<?php do_action( 'astra_footer_inside_container_top' ); ?>
			<div class="ast-row">
				<div class="<?php echo astra_attr( 'ast-layout-6-grid' ); ?> footer-adv-widget footer-adv-widget-1">
					<?php Astra_Ext_Adv_Footer_Markup::get_sidebar( 'advanced-footer-widget-1' ); ?>
				</div>
				<div class="<?php echo astra_attr( 'ast-layout-6-grid' ); ?>">
					<div class="ast-row">
						<div class="<?php echo astra_attr( 'ast-layout-6-grid' ); ?> footer-adv-widget footer-adv-widget-2">
							<?php Astra_Ext_Adv_Footer_Markup::get_sidebar( 'advanced-footer-widget-2' ); ?>
						</div>
						<div class="<?php echo astra_attr( 'ast-layout-6-grid' ); ?> footer-adv-widget footer-adv-widget-3">
							<?php Astra_Ext_Adv_Footer_Markup::get_sidebar( 'advanced-footer-widget-3' ); ?>
						</div>
					</div>
				</div>
			</div><!-- .ast-row -->
			<?php do_action( 'astra_footer_inside_container_bottom' ); ?>
		</div><!-- .ast-container -->
	</div><!-- .footer-adv-overlay-->
</div><!-- .ast-theme-footer .footer-adv-layout-6 -->

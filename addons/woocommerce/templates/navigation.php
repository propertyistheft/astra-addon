<?php
/**
 * WooCommerce My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 *
 * @since Astra-Addon 3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $current_user;

do_action( 'woocommerce_before_account_navigation' );
?>

<nav class="woocommerce-MyAccount-navigation">
	<?php
	if ( true === astra_get_option( 'my-account-user-gravatar', false ) ) {
		?>
				<div class="ast-wooaccount-user-wrapper">
					<?php echo get_avatar( $current_user->user_email, '60', null, null, $args = array( 'class' => array( 'lazyload' ) ) ); ?>
					<span class="ast-username">
					<?php
						apply_filters(
							'astra_addon_woo_account_user_welcome_message',
							printf(
								/* translators: 1: Active user name. */
								esc_attr__( 'Hello %1$s', 'astra-addon' ),
								'<strong>' . esc_html( $current_user->display_name ) . '</strong>'
							)
						);
					?>
					</span>
				</div>
			<?php
	}
	?>
	<ul>
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<?php
			switch ( $endpoint ) {
				case 'dashboard':
					$icon = Astra_Builder_UI_Controller::fetch_svg_icon( 'chalkboard-teacher', false );
					break;

				case 'orders':
					$icon = Astra_Builder_UI_Controller::fetch_svg_icon( 'shopping-cart', false );
					break;

				case 'downloads':
					$icon = Astra_Builder_UI_Controller::fetch_svg_icon( 'download', false );
					break;

				case 'edit-address':
					$icon = Astra_Builder_UI_Controller::fetch_svg_icon( 'map-marker-alt', false );
					break;

				case 'edit-account':
					$icon = Astra_Builder_UI_Controller::fetch_svg_icon( 'user', false );
					break;

				case 'customer-logout':
					$icon = Astra_Builder_UI_Controller::fetch_svg_icon( 'sign-out-alt', false );
					break;

				default:
					$icon = Astra_Builder_UI_Controller::fetch_svg_icon( 'bars', false );
					break;
			}
			$endpoint_icon = apply_filters( 'astra_addon_woo_account_menu_icon', $icon, $endpoint );
			?>
			<li class="<?php echo esc_html( wc_get_account_menu_item_classes( $endpoint ) ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo wp_kses( $endpoint_icon, Astra_Addon_Kses::astra_addon_svg_kses_protocols() ) . '<span class="ast-woo-nav-link-name">' . esc_html( $label ) . '</span>'; ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>

<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 *
 * @since Astra Pro 3.9.0
 */

defined( 'ABSPATH' ) || exit;

$has_orders      = $args['has_orders'];
$customer_orders = $args['customer_orders'];
$current_page    = $args['current_page'];

do_action( 'woocommerce_before_account_orders', $has_orders ); ?>

<?php if ( $has_orders ) : ?>

	<div class="ast-woo-grid-orders-container">
		<?php
		foreach ( $customer_orders->orders as $customer_order ) {
			$an_order   = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			$item_count = $an_order->get_item_count() - $an_order->get_item_count_refunded();
			?>
				<div class="ast-orders-table__row ast-orders-table__row--status-<?php echo esc_attr( $an_order->get_status() ); ?> order">
				<?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>

						<div class="ast-orders-table__cell ast-orders-table__cell-<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>">
							<?php if ( has_action( 'woocommerce_my_account_my_orders_column_' . $column_id ) ) : ?>
								<?php do_action( 'woocommerce_my_account_my_orders_column_' . $column_id, $an_order ); ?>

								<?php
							elseif ( 'order-number' === $column_id ) :


								$product_filter_image_size = apply_filters( 'astra_ordered_product_image_size', array( 60, 60 ) );
								$placeholder_image         = sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( $product_filter_image_size ) ), esc_html__( 'Awaiting product image', 'astra-addon' ) );

								foreach ( $an_order->get_items() as $item_id => $item_values ) {
									$product_image  = get_the_post_thumbnail( $item_values->get_product_id(), $product_filter_image_size );
									$featured_image = $product_image ? $product_image : $placeholder_image;
									echo wp_kses_post( $featured_image );
									break;
								}
								?>

							<?php elseif ( 'order-date' === $column_id ) : ?>
								<strong class="ast-woo-order-date"> <time datetime="<?php echo esc_attr( $an_order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $an_order->get_date_created() ) ); ?></time> </strong>

							<?php elseif ( 'order-status' === $column_id ) : ?>
								<?php echo esc_html( __( 'Status - ', 'astra-addon' ) . wc_get_order_status_name( $an_order->get_status() ) ); ?>

							<?php elseif ( 'order-total' === $column_id ) : ?>
								<?php
									/* translators: 1: formatted order total 2: total order items */
									echo wp_kses_post( sprintf( _n( '%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'astra-addon' ), $an_order->get_formatted_order_total(), $item_count ) );
								?>

							<?php elseif ( 'order-actions' === $column_id ) : ?>
								<?php
									$actions = wc_get_account_orders_actions( $an_order );
								if ( ! empty( $actions ) ) {
									foreach ( $actions as $key => $order_action ) {
										echo '<a href="' . esc_url( $order_action['url'] ) . '" class="' . sanitize_html_class( $key ) . '">' . esc_html( $order_action['name'] ) . '</a>';
									}
								}
								?>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
				<?php
		}
		?>
	</div>

	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php if ( 1 < $customer_orders->max_num_pages ) : ?>
		<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
			<?php if ( 1 !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><?php esc_html_e( 'Previous', 'astra-addon' ); ?></a>
			<?php endif; ?>

			<?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><?php esc_html_e( 'Next', 'astra-addon' ); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

<?php else : ?>
	<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
		<a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>"><?php esc_html_e( 'Browse products', 'astra-addon' ); ?></a>
		<?php esc_html_e( 'No order has been made yet.', 'astra-addon' ); ?>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>

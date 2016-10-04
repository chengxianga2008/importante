<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

	<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

	<?php do_action( 'woocommerce_before_cart_table' ); ?>

	<div class="htheme_cart_holder shop_table shop_table_responsive cart">
		<div class="htheme_cart_head">
			<div class="htheme_col_6">
				<div class="htheme_inner_col">
					<?php esc_html_e( 'Product', 'woocommerce' ); ?>
				</div>
			</div>
			<div class="htheme_col_2">
				<div class="htheme_inner_col">
					<?php esc_html_e( 'Price', 'woocommerce' ); ?>
				</div>
			</div>
			<div class="htheme_col_1">
				<div class="htheme_inner_col">
					<?php esc_html_e( 'Quantity', 'woocommerce' ); ?>
				</div>
			</div>
			<div class="htheme_col_2">
				<div class="htheme_inner_col">
					<?php esc_html_e( 'Total', 'woocommerce' ); ?>
				</div>
			</div>
		</div>
		<div class="htheme_cart_content">
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>
			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
				$image = wp_get_attachment_image_src ( get_post_thumbnail_id ( $product_id ), 'small' );
				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					?>
						<div class="htheme_cart_row <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
							<div class="htheme_col_1 htheme_position htheme_cart_image" style="background-image:url(<?php echo esc_url($image[0]); ?>)">
								<div class="htheme_inner_col"></div>
							</div>
							<div class="htheme_col_5 htheme_position">
								<div class="htheme_inner_col">
									<div class="htheme_row_content_wrap">
										<?php
										if ( ! $_product->is_visible() ) {
											echo '<h1>' . apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '</h1>&nbsp;';
										} else {
											echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<h1><a href="%s">%s</a></h1>', esc_url( $_product->get_permalink( $cart_item ) ), $_product->get_title() ), $cart_item, $cart_item_key );
										}

										// Meta data
										echo WC()->cart->get_item_data( $cart_item );

										// Backorder notification
										if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
											echo '<span>' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</span>';
										}
										?>
									</div>
								</div>
							</div>
							<div class="htheme_col_2 htheme_position">
								<div class="htheme_inner_col">
									<?php
									echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
									?>
								</div>
							</div>
							<div class="htheme_col_1 htheme_position">
								<div class="htheme_inner_col product-quantity">
									<?php
									if ( $_product->is_sold_individually() ) {
										$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
									} else {
										$product_quantity = woocommerce_quantity_input( array(
											'input_name'  => "cart[{$cart_item_key}][qty]",
											'input_value' => $cart_item['quantity'],
											'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
											'min_value'   => '0'
										), $_product, false );
									}
									echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
									?>
								</div>
							</div>
							<div class="htheme_col_2 htheme_position">
								<div class="htheme_inner_col">
									<?php
										echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
									?>
								</div>
							</div>
							<div class="htheme_col_1 htheme_position">
								<?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
									'<a href="%s" class="remove htheme_icon_cart_delete" title="%s" data-product_id="%s" data-product_sku="%s"></a>',
									esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
									__( 'Remove this item', 'woocommerce' ),
									esc_attr( $product_id ),
									esc_attr( $_product->get_sku() )
								), $cart_item_key );
								?>
							</div>
						</div>
					<?php
				}
			}
			do_action( 'woocommerce_cart_contents' );
			?>
		</div>
	</div>

	<div class="htheme_cart_footer_holder">

		<?php if ( wc_coupons_enabled() ) { ?>
			<div class="coupon">

				<div class="htheme_coupon_wrap">
					<div class="htheme_coupon_open htheme_cart_button_light" data-toggle="open"><?php esc_html_e( 'HAVE A COUPON?', 'woocommerce' ); ?></div>
					<div class="htheme_coupon_inner">
						<div class="htheme_form_field_item">
							<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" />
							<label for="coupon_code"><?php esc_html_e( 'Coupon Code', 'woocommerce' ); ?></label>
						</div>
						<input type="submit" class="button htheme_cart_button_dark" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'woocommerce' ); ?>" />
						<?php do_action( 'woocommerce_cart_coupon' ); ?>
					</div>
				</div>

			</div>
		<?php } ?>

		<div class="htheme_cart_update">
			<input type="submit" class="button htheme_cart_button_light" name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'woocommerce' ); ?>" />
			<?php do_action( 'woocommerce_cart_actions' ); ?>
			<?php wp_nonce_field( 'woocommerce-cart' ); ?>
		</div>

	</div>

	<?php do_action( 'woocommerce_after_cart_contents' ); ?>

	<?php do_action( 'woocommerce_after_cart_table' ); ?>

	</form>

	<div class="cart-collaterals">

		<?php do_action( 'woocommerce_cart_collaterals' ); ?>

	</div>

	<?php do_action( 'woocommerce_after_cart' ); ?>
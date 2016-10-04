<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $woocommerce;

$checkout_url = $woocommerce->cart->get_checkout_url();
$cart_url = $woocommerce->cart->get_cart_url();

?>

<div class="htheme_cart_totals cart_totals <?php if ( WC()->customer->has_calculated_shipping() ) echo 'calculated_shipping'; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<!-- SUB TOTAL -->
	<div class="htheme_cart_footer_row">
		<h4 class="htheme_sub_total"><?php esc_html_e( 'Sub total:', 'woocommerce' ); ?> <?php wc_cart_totals_subtotal_html(); ?></h4>
	</div>

	<!-- COUPON TOTALS -->
	<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
	<div class="htheme_cart_footer_row">
		<span class="htheme_coupon_enabled"><?php wc_cart_totals_coupon_label( $coupon ); ?> <?php wc_cart_totals_coupon_html( $coupon ); ?></span>
	</div>
	<?php endforeach; ?>

	<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

		<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

		<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

	<?php elseif ( WC()->cart->needs_shipping() ) : ?>
		<div class="htheme_cart_footer_row">
			<span class="htheme_shipping_enabled"><?php esc_html_e( 'Shipping', 'woocommerce' ); ?> <?php woocommerce_shipping_calculator(); ?></span>
		</div>
	<?php endif; ?>

	<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
		<div class="htheme_cart_footer_row">
			<span class="htheme_shipping_enabled"><?php echo esc_html( $fee->name ); ?> <?php wc_cart_totals_fee_html( $fee ); ?></span>
		</div>
	<?php endforeach; ?>

	<?php if ( wc_tax_enabled() && 'excl' === WC()->cart->tax_display_cart ) :
		$taxable_address = WC()->customer->get_taxable_address();
		$estimated_text  = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
			? sprintf( ' <small>(' . esc_html__( 'estimated for %s', 'woocommerce' ) . ')</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] )
			: '';
		if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
			<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
				<div class="htheme_cart_footer_row">
					<span class="htheme_shipping_enabled"><?php echo esc_html( $tax->label ) . $estimated_text; ?> <?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<div class="htheme_cart_footer_row">
				<span class="htheme_shipping_enabled"><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; ?> <?php wc_cart_totals_taxes_total_html(); ?></span>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

	<!-- FINAL TOTAL -->
	<div class="htheme_cart_footer_row">
		<h2 class="htheme_total"><?php esc_html_e( 'Total', 'woocommerce' ); ?> <?php wc_cart_totals_order_total_html(); ?></h2>
	</div>

	<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

	<!-- CHECK OUT BUTTON -->
	<div class="htheme_cart_footer_row">
		<a href="<?php echo esc_url($checkout_url); ?>" class="htheme_cart_button_dark htheme_float_right">
			<?php esc_html_e('Checkout', 'woocommerce'); ?>
		</a>
	</div>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

	<!-- CONTINUE SHOPPING -->
	<div class="htheme_cart_footer_row">
		<a href="<?php echo esc_url(get_permalink(wc_get_page_id( 'shop'))); ?>" class="htheme_continue_shopping htheme_float_right">
			<?php esc_html_e('Continue shopping', 'woocommerce'); ?>
		</a>
	</div>

</div>
<?php
/**
 * Checkout shipping information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="woocommerce-shipping-fields">
	<?php if ( true === WC()->cart->needs_shipping_address() ) : ?>

		<h3>
			<?php esc_html_e( 'Adres dostawy', 'woocommerce' ); ?>	</label>
		</h3>

		<div class="shipping_address">

			<?php do_action( 'woocommerce_before_checkout_shipping_form', $checkout ); ?>

			<div class="woocommerce-shipping-fields__field-wrapper row">
				<?php
				$fields = $checkout->get_checkout_fields( 'shipping' );

				foreach ( $fields as $key => $field ) {
					woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
				}
				?>
			</div>

			<?php do_action( 'woocommerce_after_checkout_shipping_form', $checkout ); ?>

		</div>

	<?php endif; ?>
</div>
<div class="summary-shipping">
<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

<?php wc_cart_totals_shipping_html(); ?>

<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

<?php endif; ?>
</div>
<div class="woocommerce-additional-fields">
	<?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>
	<?php if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_order_comments', 'yes' ) ) ) : ?>

		<?php if ( ! WC()->cart->needs_shipping() || wc_ship_to_billing_address_only() ) : ?>

			<h3><?php esc_html_e( 'Dodatkowe informacje:', 'woocommerce' ); ?></h3>
			<p><?php esc_html_e( 'Napisz nam swoje uwagi do zamówienia, opisz wymagania dotyczące dostawy itp.', 'woocommerce' ); ?>t</p>

		<?php endif; ?>
		<h3><?php esc_html_e( 'Dodatkowe informacje:', 'woocommerce' ); ?></h3>
			<p><?php esc_html_e( 'Napisz nam swoje uwagi do zamówienia, opisz wymagania dotyczące dostawy itp.', 'woocommerce' ); ?>t</p>

		<div class="woocommerce-additional-fields__field-wrapper">
			<?php foreach ( $checkout->get_checkout_fields( 'order' ) as $key => $field ) : ?>
				<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				
			<?php endforeach; ?>
		</div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>
</div>

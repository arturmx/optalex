<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.4
 */

defined('ABSPATH') || exit;

$show_shipping = !wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>
<section class="woocommerce-customer-details">




<div class="row">

		<div class="col-12 col-lg-4">
		<h2 class="woocommerce-column__title"><?php esc_html_e('Billing address', 'woocommerce');?></h2>
		<address>
		<?php echo wp_kses_post($order->get_formatted_billing_address(esc_html__('N/A', 'woocommerce'))); ?>

 
<p  >NIP: <?= get_post_meta( $order->id, 'billing_nip', true );?></p>

		<?php if ($order->get_billing_phone()): ?>
			<p class="woocommerce-customer-details--phone"><?php echo esc_html($order->get_billing_phone()); ?></p>
		<?php endif;?>

		<?php if ($order->get_billing_email()): ?>
			<p class="woocommerce-customer-details--email"><?php echo esc_html($order->get_billing_email()); ?></p>
		<?php endif;?>
	</address>

		</div>
		<div class="col-12 col-lg-4">
		<h2 class="woocommerce-column__title"><?php esc_html_e('Shipping address', 'woocommerce');?></h2>
			<address>
				<?php echo wp_kses_post($order->get_formatted_shipping_address(esc_html__('N/A', 'woocommerce'))); ?>
			</address>
		</div>
		<div class="col-12 col-lg-4">
		<h2 class="woocommerce-column__title"><?php esc_html_e('Payment', 'woocommerce');?></h2>
			<address>
				<?php
					$bacs_accounts_info = get_option('woocommerce_bacs_accounts');
					//echo "<pre>"; var_dump($bacs_accounts_info); echo "</pre>";
					//account_number
					//bank_name
					//sort_code
					//iban
					///bic
					?>
					<div class="payment-info"><span><?=__("Amount","optalex")?></span> <span class="summary"><?php echo $order->get_formatted_order_total();?></span></div>
					<div class="payment-info mt-3"><span><?=__("Payment form","optalex")?></span> <span class="account"><?=$order->get_payment_method()=="bacs" ? __("Bank transfer","optalex") : __("Cash on delivery","optalex") ;?></span></div>

			</address>
		</div>

</div>






	<?php do_action('woocommerce_order_details_after_customer_details', $order);?>

</section>

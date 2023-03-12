<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart');?>


<?php $lang=get_bloginfo("language"); ?>
<div class="col-12 d-flex align-items-center mt-12 alert-shoop">
<span class="dashicons dashicons-info-outline"></span><span class="alert_shoop">
<?php 
	if ($lang == "en-US") { 
		echo get_theme_mod('alert_shoop_en' , 'optalex');}
	else if ($lang == "pl-PL") {
		echo get_theme_mod('alert_shoop', 'optalex');} 
?>
</span> 
</div>



<form class="woocommerce-cart-form cart" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
	<?php do_action('woocommerce_before_cart_table');?>

	<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
	<thead>
		<tr>

			<th class="product-name"><?php esc_html_e('Product', 'woocommerce');?></th>
			<th class="product-attr"><?php esc_html_e('Kolor frontu', 'woocommerce');?></th>
			<th class="product-attr"><?php esc_html_e('Kolor zausznika', 'woocommerce');?></th>
			<th class="product-price"><?php esc_html_e('Price', 'woocommerce');?></th>
			<th class="product-quantity"><?php esc_html_e('Quantity', 'woocommerce');?></th>
			<th class="product-subtotal"><?php esc_html_e('Subtotal', 'woocommerce');?></th>
			<th class="product-remove">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php do_action('woocommerce_before_cart_contents');?>

		<?php
		foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
			$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
			$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

			if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
				$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
				?>
				<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">





					<td class="product-name" data-title="<?php esc_attr_e('Product', 'woocommerce');?>">
						<div class="d-flex">
							<div class="product-name-img">
								<?php
								$thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

								if (!$product_permalink) {
            echo $thumbnail; // PHPCS: XSS ok.
        } else {
            printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
        }
        ?>

    </div>
    <div class="product-name-title">
    	<div class="product-name-title-category">
    		<?php echo wc_get_product_category_list($cart_item['product_id']); ?>
    	</div>
    	<?php

    	if (!$product_permalink) {
    		echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
    	} else {
    		echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
    	}
    	?>
    </div>
</div>

<?php
// if ( ! $product_permalink ) {
        //     echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
        // } else {
        //     echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
        // }

        //    do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

        // Meta data.
        //echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

        // Backorder notification.
if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
	echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
}
?>
</td>

<td class="product-name" data-title="<?php esc_attr_e('Product', 'woocommerce');?>">


	<?php
	$value = $cart_item['variation']["attribute_pa_kolor-frontu"];

	$term = get_term_by('slug', $value, "pa_kolor-frontu");

	if (!is_wp_error($term) && $term && $term->name) {
		$value = $term->name;
	}

	echo $value;

	?>
</td>
<td class="product-name" data-title="<?php esc_attr_e('Product', 'woocommerce');?>">
	<?php
	$value = $cart_item['variation']["attribute_pa_kolor-zausznika"];

	$term = get_term_by('slug', $value, "pa_kolor-zausznika");

	if (!is_wp_error($term) && $term && $term->name) {
		$value = $term->name;
	}

	echo $value;

	?>
</td>

<td class="product-price" data-title="<?php esc_attr_e('Price', 'woocommerce');?>">
	<?php
echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
?>
</td>

<td class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce');?>">
	<div class="product-quantity-wrapper">
		<button type="button" class="minus" >-</button>
		<?php
		if ($_product->is_sold_individually()) {
			$product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
		} else {
			$product_quantity = woocommerce_quantity_input(
				array(
					'input_name' => "cart[{$cart_item_key}][qty]",
					'input_value' => $cart_item['quantity'],
					'max_value' => $_product->get_max_purchase_quantity(),
					'min_value' => '0',
					'product_name' => $_product->get_name(),
				),
				$_product,
				false
			);
		}

        echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
        ?>
        <button type="button" class="plus" >+</button>
    </div>
</td>

<td class="product-subtotal" data-title="<?php esc_attr_e('Subtotal', 'woocommerce');?>">
	<?php
echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
?>
<small class="woocommerce-price-suffix d-block"><?=__("netto","optalex")?></small>
</td>

<td class="product-remove">
	<?php
echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'woocommerce_cart_item_remove_link',
	sprintf(
		'<a href="%s" class="remove" aria-label="%s" title="%s" data-product_id="%s" data-product_sku="%s"><i class="icon-trash"></i></a>',
		esc_url(wc_get_cart_remove_url($cart_item_key)),
		esc_html__('Remove this item', 'woocommerce'),
		esc_html__('Remove this item', 'woocommerce'),
		esc_attr($product_id),
		esc_attr($_product->get_sku())
	),
	$cart_item_key
);
?>
</td>
</tr>
<?php
}
}
?>


</tbody>

<?php  
$discount = WC()->cart->get_coupons();
?>
<tfoot>
	<?php do_action( 'woocommerce_cart_contents' ); ?>
	<tr>

		<td>
			<?php if (wc_coupons_enabled()) {?>
				<div class="coupon <?=$discount ? 'active' : '' ?>">
					<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?= $discount? __('Dobry kod', 'woocommerce')  : __('Coupon code', 'woocommerce');?>" /> <button type="submit" class="button" name="apply_coupon" value="<?= $discount? __('Zatwierdzony', 'woocommerce')  : __('Apply coupon', 'woocommerce');?>"><?= $discount? __('Zatwierdzony', 'woocommerce')  : __('Apply coupon', 'woocommerce');?></button>

					<?php do_action('woocommerce_cart_coupon');?>
				</div>
			<?php }?>
		</td>

		<td colspan="2">


			<?php

			if ($discount) {
				foreach ($discount as $code => $coupon): ?>

					Wartość rabatu: <?php wc_cart_totals_coupon_html($coupon);?>

				<?php endforeach;}?>

			</td>
			<td class="f-14"><?php esc_attr_e('Całość:', 'woocommerce');?></td>
			<td align="center">
				<?php	if ($discount) {
					echo "<s>"; 
					wc_cart_totals_subtotal_html() ; 
					echo "</s>";
				}?>

			</td>
			<td>
				<?php	if ($discount) {
					wc_cart_totals_order_total_html();
				} else {
					wc_cart_totals_subtotal_html();
				}?>
				<small class="woocommerce-price-suffix d-block"><?=__("netto","optalex")?></small>

			</td>
			<td>
				<button type="submit" class="button" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce');?>"><?php esc_html_e('Update cart', 'woocommerce');?></button>
					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
			</td>

		</tr>
		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tfoot>
</table>
	<?php do_action('woocommerce_after_cart_table');?>
	<div class="wc-proceed-to-checkout">
		<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
	</div>
</form>

<?php do_action('woocommerce_before_cart_collaterals');?>

<div class="cart-collaterals">
	<?php
/**
 * Cart collaterals hook.
 *
 * @hooked woocommerce_cross_sell_display
 * @hooked woocommerce_cart_totals - 10
 */
//do_action('woocommerce_cart_collaterals');
?>
</div>

<?php do_action('woocommerce_after_cart');?>

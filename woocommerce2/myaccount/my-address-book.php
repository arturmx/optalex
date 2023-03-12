<?php
/**
 * Woo Address Book
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address-book.php.
 *
 * HOWEVER, on occasion Woo Address Book will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @package WooCommerce Address Book/Templates
 * @version 1.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$wc_address_book = WC_Address_Book::get_instance();
$wc_address_book_extended = new WC_Address_BookExtended;

$woo_address_book_customer_id  = get_current_user_id();
$woo_address_book_address_book = $wc_address_book->get_address_book( $woo_address_book_customer_id );

// Do not display on address edit pages.
if ( ! $type ) : ?>

	<?php

	$woo_address_book_shipping_address = get_user_meta( $woo_address_book_customer_id, 'shipping_address_1', true );

	// Only display if primary addresses are set and not on an edit page.
	if ( ! empty( $woo_address_book_shipping_address ) ) :
		?>

		<div class="row mt-4">
			<div class="col-12">
			<h3><?php esc_html_e( 'Shipping Address Book', 'woo-address-book' ); ?></h3>

<p class="myaccount_address">
	<?php echo esc_html( apply_filters( 'woocommerce_my_account_my_address_book_description', __( 'The following addresses are available during the checkout process.', 'woo-address-book' ) ) ); ?>
</p>
			</div>

		 <div class="col-12 col-lg-6 mb-4">
			 <div class="wc-address-book-address book-new">

			
<?php
		// Add link/button to the my accounts page for adding addresses.
		$wc_address_book_extended->add_additional_address_button();
		?>
		</div>
		</div>
		 

		 

			 

			<?php
			 

			foreach ( $woo_address_book_address_book as $woo_address_book_name => $woo_address_book_fields ) :
				?>
				
					 <?php
				// Prevent default shipping from displaying here.
				if ( 'shipping' === $woo_address_book_name || 'billing' === $woo_address_book_name ) {
					continue;
				}
?>
 <div class="col-12 col-lg-6 mb-4 address_book">

<?php
				$woo_address_book_address = apply_filters(
					'woocommerce_my_account_my_address_formatted_address',
					array(
						'first_name' => get_user_meta( $woo_address_book_customer_id, $woo_address_book_name . '_first_name', true ),
						'last_name'  => get_user_meta( $woo_address_book_customer_id, $woo_address_book_name . '_last_name', true ),
						'company'    => get_user_meta( $woo_address_book_customer_id, $woo_address_book_name . '_company', true ),
						'address_1'  => get_user_meta( $woo_address_book_customer_id, $woo_address_book_name . '_address_1', true ),
						'address_2'  => get_user_meta( $woo_address_book_customer_id, $woo_address_book_name . '_address_2', true ),
						'city'       => get_user_meta( $woo_address_book_customer_id, $woo_address_book_name . '_city', true ),
						'state'      => get_user_meta( $woo_address_book_customer_id, $woo_address_book_name . '_state', true ),
						'postcode'   => get_user_meta( $woo_address_book_customer_id, $woo_address_book_name . '_postcode', true ),
						'country'    => get_user_meta( $woo_address_book_customer_id, $woo_address_book_name . '_country', true ),
					),
					$woo_address_book_customer_id,
					$woo_address_book_name
				);
 
				$woo_address_book_formatted_address = WC()->countries->get_formatted_address( $woo_address_book_address );
 
				if ( $woo_address_book_formatted_address ) :

					$address_field = wp_kses( $woo_address_book_formatted_address, array( 'br' => array() ) );
					 $address_field = explode("<br />",$address_field);


					?>

<div class="wc-address-book-address">
					<div class="row">
								<div class="col-8">
								<address>
							<?php
							
							foreach($address_field as $key => $item){
								if($key == 0){
									echo '<span class="nickname">'.$item.'</span>';
								}else{
									echo $item.'<br>';
								}
							}
							
							
							?>
						</address>
								</div>
								<div class="col-4">
								<div class="wc-address-book-meta">
						
						<a href="<?php echo esc_url( $wc_address_book->get_address_book_endpoint_url( $woo_address_book_name ) ); ?>" class="wc-address-book-edit"><?php echo esc_attr__( 'Edit', 'woo-address-book' ); ?></a>
						<a id="<?php echo esc_attr( $woo_address_book_name ); ?>" class="wc-address-book-delete"><?php echo esc_attr__( 'Delete', 'woo-address-book' ); ?></a>
						<?php if(true==false){?>
						<a id="<?php echo esc_attr( $woo_address_book_name ); ?>" class="wc-address-book-make-primary"><?php echo esc_attr__( 'Make Primary', 'woo-address-book' ); ?></a>
						<?php } ?>
					</div>
								</div>
							</div>
						
						
					</div>

				<?php endif; ?>
				 </div>
			<?php endforeach; ?>

			 

		</div>
		<?php
		
	endif;
endif;

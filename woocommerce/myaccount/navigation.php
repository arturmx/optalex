<?php
/**
 * My Account navigation
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
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>

<nav class="woocommerce-MyAccount-navigation">
	<ul>
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">

			
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" <?=$endpoint =="customer-logout" ? 'data-bs-toggle="modal" data-bs-target="#logoutModal"' : '';?>>
				
				<?php
			if($endpoint == "orders"){
				echo '<i class="icon-box"></i>';
			}elseif($endpoint == "edit-address"){
				echo '<i class="icon-pin-bold"></i>';
			}elseif($endpoint == "edit-account"){
				echo '<i class="icon-user"></i>';
			}elseif($endpoint == "downloads"){
				echo '<i class="icon-doc"></i>';
			}elseif($endpoint == "customer-logout"){
				echo '<i class="icon-off"></i>';
			}else{
				echo '<i class="icon-home"></i>';
			}

			 
			?><span><?php echo esc_html( $label ); ?></span></a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>
 

<!-- Modal -->
<div class="modal fade modal-logout " id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      
      <div class="modal-body d-flex flex-column justify-content-center align-items-center">
		  <i class="icon-off"></i>
		  <span class="title-modal f-16 mt-5">
        <?= __("Czy jesteś pewien, że chcesz się wylogować?","optalex")?>
		</span>
		<div class="d-flex justify-content-center mt-5">
		<a href="<?=wc_logout_url()?>" class="btn btn-outline-secondary btn-large bt-long " > <?= __("Wyloguj się","optalex")?></a>
        <button type="button" class="btn btn-dark btn-large  btn-long ms-3" data-bs-dismiss="modal"> <?= __("Anuluj","optalex")?></button>
		</div>
      </div>
       
    </div>
  </div>
</div>
<?php do_action( 'woocommerce_after_account_navigation' ); ?>

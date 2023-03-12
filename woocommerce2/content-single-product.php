<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
 */

defined('ABSPATH') || exit;

global $product;

$attributes = $product->get_attributes();
$kolorFrontu = $attributes['pa_kolor-frontu']['options'] ?? null;
$kolorZausznika = $attributes['pa_kolor-zausznika']['options'] ?? null;
 


?>
<div class="container">
	<div class="row">
		<div class="col-12">
			<?php

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');
?>
		</div>
	</div>
</div>
<?php

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<div class="container">
	<div class="row">
	<div class="col-12">
<div id="product-<?php the_ID();?>" <?php wc_product_class('', $product);?>>

<div class="row">
	<div class="col-12 col-md-6">
	<?php
/**
 * Hook: woocommerce_before_single_product_summary.
 *
 * @hooked woocommerce_show_product_sale_flash - 10
 * @hooked woocommerce_show_product_images - 20
 */
do_action('woocommerce_before_single_product_summary');
?>
	</div>
	<div class="col-12 col-md-4 offset-md-2">
	<div class="wishlist">
		<?php echo  do_shortcode("[yith_wcwl_add_to_wishlist]");?>
	</div>
	<?php woocommerce_template_single_title()?>
	<span class="product-title-attr">
	<?php
	$ozdobyIMaterialy = wp_get_post_terms( $product->id, 'pa_ozdoby-i-materialy' );
	if($ozdobyIMaterialy){
		echo "(";
	
		foreach ($ozdobyIMaterialy  as $key => $attr) {
			if($key > 0){
				echo ", ";
			}
			echo $attr->name;
			
		}
		echo ")";
	}

?>
</span>
	<?php //woocommerce_template_single_rating()?>

	<?php woocommerce_template_single_excerpt()?>
	<div class="product-meta">
		<span class="product-meta-text"><?=__("Price","optalex")?></span>
		<?php if (is_user_logged_in()) {

		  woocommerce_template_single_price();
		   }else{?>

  <object> <?php _e('<a href="/rejestracja" title=" Create account" class="text-decoration-underline"> Create an account </a> to see the price', 'optalex')?> </object>

		  <?php } ?>
	</div>
	<?php if (get_field('product_size_1', $product->ID)) {?>
	<div class="product-meta">
		<span class="product-meta-text"><?=__("Size","optalex")?></span>
		<span>
        <?php the_field('product_size_1', $product->ID);?> <i class="icon icon-square icon-11 ms-2 me-2"></i> <?php the_field('product_size_2', $product->ID);?></span>

	</div>
	<?php }?>
	<?php   if (is_user_logged_in()) {woocommerce_template_single_add_to_cart(); }?>
	<?php //woocommerce_template_single_meta()?>
	<?php //woocommerce_template_single_sharing()?>
	<a href="#more" class="product-more">
		<i class="icon-mouse"></i> <?php echo __("See available colors of fronts and temples", "optalex") ?>
	</a>
	<?php
/**
 * Hook: woocommerce_single_product_summary.
 *
 * @hooked woocommerce_template_single_title - 5
 * @hooked woocommerce_template_single_rating - 10
 * @hooked woocommerce_template_single_price - 10
 * @hooked woocommerce_template_single_excerpt - 20
 * @hooked woocommerce_template_single_add_to_cart - 30
 * @hooked woocommerce_template_single_meta - 40
 * @hooked woocommerce_template_single_sharing - 50
 * @hooked WC_Structured_Data::generate_product_data() - 60
 */
//do_action( 'woocommerce_single_product_summary' );
?>
	</div>
</div>


		<div id="more" class="row product-more">
			<?php if($kolorFrontu){ ?>
			<div class="col-12 col-md-6 d-flex align-items-center flex-column">
				<span class="product-more-subtitle"><?php echo __("Available", "optalex") ?></span>
				<span class="product-more-title"><?php echo __("Front colors", "optalex") ?></span>
				<div class="product-more-content">
					<?php

					foreach ($kolorFrontu as $attr) {
						$attrObj = get_term($attr, 'pa_kolor-frontu');

						?>
						<div class="product-more-attr">
						<?=wp_get_attachment_image(get_field('attribute_img', "pa_kolor-frontu_" . $attr), 'full', false, ["class" => "img-fluid"])?>
							<span class="product-more-attr-title"><?=$attrObj->name?></span>
						</div>

					<?php

					}
					?>
				</div>
			</div>
			<?php } ?>
			<?php if($kolorZausznika){ ?>
			<div class="col-12 col-md-6 d-flex align-items-center flex-column">
			<span class="product-more-subtitle"><?php echo __("Available
", "optalex") ?></span>
				<span class="product-more-title"><?php echo __("Temple colors", "optalex") ?></span>
				<div class="product-more-content">
					<?php

					foreach ($kolorZausznika as $attr) {
						$attrObj = get_term($attr, 'pa_kolor-zausznika');
						?>
						<div class="product-more-attr">
						<?=wp_get_attachment_image(get_field('attribute_img', "pa_kolor-zausznika_" . $attr), 'full', false, ["class" => "img-fluid"])?>
							<span class="product-more-attr-title"><?=$attrObj->name?></span>
						</div>

					<?php

					}
					?>
				</div>
			</div>
			<?php } ?>
		</div>

	<?php
/**
 * Hook: woocommerce_after_single_product_summary.
 *
 * @hooked woocommerce_output_product_data_tabs - 10
 * @hooked woocommerce_upsell_display - 15
 * @hooked woocommerce_output_related_products - 20
 */
//woocommerce_output_product_data_tabs();
//woocommerce_upsell_display();
//woocommerce_output_related_products();
//do_action( 'woocommerce_after_single_product_summary' );
?>
</div>
</div>
</div>
</div>


<?php 

$slug = null;

$terms =  get_the_terms( $post->ID, 'product_cat' );
if ( $terms && ! is_wp_error( $terms ) ) {
   
	$slug = $terms[0]->slug  ;
 
}

 

 

if($slug){

get_template_part('template-parts/product-carousel', null,
    [
        'category' => $slug,
        'bg' => 'section-gray',
        'info' => false,

    ]);
	}
	?>


 
<?php do_action('woocommerce_after_single_product');?>

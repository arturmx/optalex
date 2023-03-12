<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

 

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
//remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
do_action( 'woocommerce_before_main_content' );

?>
 
<div class="page-product container">
	<div class="row">
	<div class="col-6  col-lg-4 col-xl-3">
		<span class="page-product-filter-title" data-action="open-filter"><?php echo __('Filters', 'optalex');?> <i class="icon-arrow-down-sign-to-navigate ms-3 d-lg-none"></i></span>
	</div>
	<div class="col-6  col-lg-8 col-xl-9  page-product-list">

	<p class="woocommerce-result-count">
		<div class="d-none d-lg-inline-block">
	<?php

	echo woocommerce_result_count();
	// phpcs:disable WordPress.Security

	?>
	 </div>
	<?php 
	woocommerce_catalog_ordering(); 
	
	?>
</p>


	</div>
	<div class="col-12   col-lg-4 col-xl-3">
		<div class="page-product-filter mb-3" data-item="filter">
		<?php 
		/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );
		?>
	</div>
	<?php get_template_part('template-parts/section-widget', null);?>
	</div>
	<div class="col-12  col-lg-8 col-xl-9 page-product-list">
		<?php 
		if ( woocommerce_product_loop() ) {

			/**
			 * Hook: woocommerce_before_shop_loop.
			 *
			 * @hooked woocommerce_output_all_notices - 10
			 * @hooked woocommerce_result_count - 20
			 * @hooked woocommerce_catalog_ordering - 30
			 */
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
			do_action( 'woocommerce_before_shop_loop' );
		
			woocommerce_product_loop_start();
		
			if ( wc_get_loop_prop( 'total' ) ) {
				while ( have_posts() ) {
					the_post();
					
					/**
					 * Hook: woocommerce_shop_loop.
					 */
					do_action( 'woocommerce_shop_loop' );
		
					wc_get_template_part( 'content', 'product' );
				}
			}
		
			woocommerce_product_loop_end();
		
			/**
			 * Hook: woocommerce_after_shop_loop.
			 *
			 * @hooked woocommerce_pagination - 10
			 */
			do_action( 'woocommerce_after_shop_loop' );
		} else {
			/**
			 * Hook: woocommerce_no_products_found.
			 *
			 * @hooked wc_no_products_found - 10
			 */
			do_action( 'woocommerce_no_products_found' );
		}
		?>
	</div>
	</div>
</div>
<?php


/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );



get_footer( 'shop' );

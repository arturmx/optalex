<?php
/**
 * Wishlist pages template; load template parts basing on the url
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 3.0.0
 */

/**
 * Template Variables:
 *
 * @var $template_part string Sub-template to load
 * @var $var array Array of attributes that needs to be sent to sub-template
 */

if ( ! defined( 'YITH_WCWL' ) ) {
	exit;
} // Exit if accessed directly
?>

<div class="page-product">
	<div class="row">
	<div class="col-12 col-md-3">
 
	</div>
	<div class="col-12 col-md-9  page-product-list mb-3 d-flex justify-content-between">
		<span class="page-product-filter-title"><?php echo __('Ulubione', 'optalex');?></span>
		<span class="text-hover f-14">
		<span class="yith-wcwl-items-count"><?=yith_wcwl_count_all_products()?></span> <span><?=__("produktów","optalex")?></span>
		</span>
	</div>
	<div class="col-12 col-md-4 col-lg-4 col-xl-3">
		 
	<?php get_template_part('template-parts/section-widget', null);?>
	</div>
	<div class="col-12 col-md-12 col-lg-8 col-xl-9  page-product-list">
	<?php
/**
 * Hook: yith_wcwl_wishlist_before_wishlist_content.
 *
 * @hooked \YITH_WCWL_Frontend::wishlist_header - 10
 */
do_action( 'yith_wcwl_wishlist_before_wishlist_content', $var );
?>

<?php
/**
 * Hook: yith_wcwl_wishlist_main_wishlist_content.
 *
 * @hooked \YITH_WCWL_Frontend::main_wishlist_content - 10
 */
do_action( 'yith_wcwl_wishlist_main_wishlist_content', $var );
?>

<?php
/**
 * Hook: yith_wcwl_wishlist_after_wishlist_content.
 *
 * @hooked \YITH_WCWL_Frontend::wishlist_footer - 10
 */
//do_action( 'yith_wcwl_wishlist_after_wishlist_content', $var );
?>
</div>
	</div>
</div>


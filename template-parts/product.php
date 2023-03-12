<?php

/**
 * Get argument from global $args variable.
 * @variable $args
 * @reference https://developer.wordpress.org/reference/functions/get_template_part/
 */

$subtitle = get_field('subtitle');
$link = get_field('link');
$logo = get_field('logo');
global $product;

$cat = $product->category_ids[0];

 

$color = get_field("category_color","product_cat_".$cat ) ?? 'rgb(241, 241, 241)';

$css =isset($args['css']) ? $args['css'] : '' ;

 
?>

<a href="<?php the_permalink()?>" class="product-item h-100 <?=$css?>" title="<?php _e('View products', 'optalex')?>" style="--cat-color: <?=$color?>">
    <object class="top-badge">
    <?php echo  do_shortcode("[yith_wcwl_add_to_wishlist]");?>
    </object>
    <div class="top-img">
        <?php
if (has_post_thumbnail()):
    echo get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'img-fluid']);
endif;
?>
    </div>
    <span class="top-title">
        <?php the_title();?>

        <?php if (is_user_logged_in()) {?>

 
	<span class="price"><?php echo $product->price. ' ' . get_woocommerce_currency_symbol()  ?></span>
 
            <?php }?>
    </span>

    <span class="top-subtitle d-flex justify-content-between">
   
    <span class="d-flex align-items-center justify-content-between">
    <?php if(get_field('product_size_1', $product->ID)){?>
        <?php the_field('product_size_1', $product->ID);?> <i class="icon icon-square icon-11 ms-2 me-2"></i> <?php the_field('product_size_2', $product->ID);?>
        <?php }?>
    </span>
  
    <?php if (is_user_logged_in()) {

    if ($product->is_type('simple')) {

        if ($product->sale_price) {
            echo "<s>" . $product->regular_price . ' ' . get_woocommerce_currency_symbol() . "</s>";

        }

    } elseif ($product->is_type('variable')) {
        #1 Get product variations
        $product_variations = $product->get_available_variations();

#2 Get one variation id of a product
        $variation_product_id = $product_variations[0]['variation_id'];

#3 Create the product object
        $variation_product = new WC_Product_Variation($variation_product_id);

#4 Use the variation product object to get the variation prices
        //echo $variation_product ->regular_price;

        if ($variation_product->sale_price) {
            echo "<s>" . $variation_product->regular_price . ' ' . get_woocommerce_currency_symbol() . "</s>";

        }
    }
}

?>
</span>
    <span class="more">
        <?php if (is_user_logged_in()) {

    echo apply_filters(
        'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
        sprintf(
            '<object><a href="%s" data-quantity="%s" class="%s" %s><i class="icon-cart"></i>%s</a></object>',
            esc_url($product->add_to_cart_url()),
            esc_attr(isset($product->quantity) ? $product->quantity : 1),
            esc_attr(isset($product->class) ? $product->class : 'button'),
            isset($args->attributes) ? wc_implode_html_attributes($args->attributes) : '',
            esc_html($product->add_to_cart_text())
        ),
        $product,
        $args
    );

} else {?>
            <object> <?php _e('<a href="/register" title=" Create an account" class="text-decoration-underline"> Create an account </a> to see the price', 'optalex')?> </object>
        <?php }?>
        </span>
</a>
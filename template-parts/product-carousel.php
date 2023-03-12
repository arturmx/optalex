<?php

/**
 * Get argument from global $args variable.
 * @variable $args
 * @reference https://developer.wordpress.org/reference/functions/get_template_part/
 */

 
$category = get_term_by( 'slug', $args['category'], 'product_cat' );
$color = get_field("category_color","product_cat_".$category->term_id);

?>


<section class="section-products <?=$args['bg']?>">
    <div class="container">
        <div class="d-flex w-100 justify-content-between section-products-title">
        <h2 class="title">
            <span class="title-circle" style="border-color:<?=$color?>"></span>
            <span><?=get_field("category_carousel_title","product_cat_".$category->term_id);?></span>
        </h2>

<div class="more">
    <a href="<?=get_permalink( woocommerce_get_page_id( 'shop' ) );?>?swoof=1&product_cat=<?=$category->slug?>" title="<?php _e('See all', 'optalex')?>"> 
    <span class="d-none d-md-flex"><?php _e('See all', 'optalex')?></span>
    <span class="icon-circle-dark   ms-md-3"><i class="icon icon-icon-next"></i></span>
</a>
</div>


        </div>

<section class="carousel">
<div class="row">
            <div class="col-12 carousel-wrap">


            <?php
$params = array(

    'posts_per_page' => 9,
    'post_type' => 'product',
    'product_cat' => $category->slug,
    'paged' => 1,
    'orderby' => 'rand',

);
$wc_query = new WP_Query($params); // (2)

?>
                        <?php
if ($wc_query->have_posts()): $i = 0;

?>
            <span class="carousel-arrow carousel-arrow__prev" data-arrow="best-prev"><i class="icon-left"></i></span>
                    <span class="carousel-arrow carousel-arrow__next" data-arrow="best-next"><i class="icon-right"></i></span>
                <div class="swiper-container swiper-bestseller">
               
                    <div class="swiper-wrapper">

<?php 
    while ($wc_query->have_posts()): $wc_query->the_post();?>

		                        <div class="swiper-slide">
                                <?php get_template_part('template-parts/product', null,  ['css' => '',]);?>

		                        </div>
		                        <?php

        $i++;
    endwhile;

 ?>

                    </div>

                </div>
            </div>
         <?php   $total_pages = $wc_query->max_num_pages;
    if ($total_pages > 1) {
        ?>


	                        <?php }?>


	                        <?php wp_reset_postdata(); // (5)   ?>
	                        <?php else: ?>
                        <p>
                            <?php _e('No products', 'optalex'); // (6)    ?>
                        </p>
                        <?php endif;?>

        </div>
</section>
<?php if( $args['info']) { ?> 
 <div class="section-products-bottom">
     <span class="d-flex align-items-center mb-3 mb-md-0"><i class="icon-check"></i> <?=get_field("category_text_left","product_cat_".$category->term_id);?></span>
     <span><?=get_field("category_text_right","product_cat_".$category->term_id);?></span>
 </div>
 <?php } ?>
</div>
</section>
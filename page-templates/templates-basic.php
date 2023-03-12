<?php
/**
 * Template Name: Basic
 *
 * The template for basic page.
 *
 * @author Tomasz Załucki <info@innhouse.pl>
 */
get_header();

?>




<section class="page-basic">
    <div class="container">

    <div class="row page-basic-return">
        <div class="col-12">
            <a href="javascript:history.back()" title="<?=__("Back","optalex")?>" class="d-flex align-items-center">
            <span class="icon-circle-dark me-3"><i class="icon-return"></i></span> <?=__("Back","optalex")?> 
            </a>
        </div>
    </div>
        <div class="row">
            <div class="col-12 col-lg-3 aside">
              
                    <h1><?php the_title(); ?></h1>

                  
                        
                    
                    <?php if (have_rows('basic_links')): ?>
                    <ul  class="links d-none d-lg-block">
                        <?php while (have_rows('basic_links')): the_row();?>
                        <li>
                        <a href="<?php the_sub_field('link');?>">
                                <?=wp_get_attachment_image(get_sub_field('icon'), 'medium', false, ["class" => "img-fluid"])?>
                                <span><?php the_sub_field('text');?></span>
                                <i class="icon-icon-next"></i>
                                </a>
                        </li>
                        <?php endwhile;?>
                    </ul>
                    <?php endif;?>


 
                 
            </div>
            <div class="col-12 col-lg-8 offset-lg-1 content">
                <?php the_content(); ?>

                <a href="/" title="<?=__('Go to the home page','optalex')?>" class="btn btn-dark btn-long mt-5"><?=__('Go to the home page','optalex')?></a>
            </div>

            <div class="col-12 d-lg-none">
                
            <?php if (have_rows('basic_links')): ?>
                    <ul  class="links">
                        <?php while (have_rows('basic_links')): the_row();?>
                        <li>
                        <a href="<?php the_sub_field('link');?>">
                                <?=wp_get_attachment_image(get_sub_field('icon'), 'medium', false, ["class" => "img-fluid"])?>
                                <span><?php the_sub_field('text');?></span>
                                <i class="icon-icon-next"></i>
                                </a>
                        </li>
                        <?php endwhile;?>
                    </ul>
                    <?php endif;?>
            </div>
        </div>
    </div>
</section>

<?php get_footer();
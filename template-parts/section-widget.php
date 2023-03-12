<?php

/**
 * Get argument from global $args variable.
 * @variable $args
 * @reference https://developer.wordpress.org/reference/functions/get_template_part/
 */

$post_id = get_option('woocommerce_shop_page_id');

?>
<div class="widget-info   d-none d-lg-block">
		<span class="widget-info-title"><?php the_field('shop_widget_title',$post_id)?></span>
		<span class="widget-info-text"><i class="icon-phone"></i> <a href="tel:<?php the_field('shop_widget_phone',$post_id)?>" title="<?php echo __('Call Us','optalex')?>"> <?php the_field('shop_widget_phone',$post_id)?></a></span>
		<span class="widget-info-text"><i class="icon-email"></i> <a href="mailto:<?php the_field('shop_widget_email',$post_id)?>" title="<?php echo __('Write to us','optalex')?>"><?php the_field('shop_widget_email',$post_id)?></a></span>
		<div class="widget-info-img">
		<?=wp_get_attachment_image(get_field('shop_widget_img', $post_id), 'medium', false, ["class" => "img-fluid"])?> </div>
	</div>
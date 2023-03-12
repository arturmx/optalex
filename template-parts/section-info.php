<?php

/**
 * Get argument from global $args variable.
 * @variable $args
 * @reference https://developer.wordpress.org/reference/functions/get_template_part/
 */

$homeID = get_option('page_on_front');

?>
<?php if (have_rows('infoimage_1', $homeID)): ?>
<?php while (have_rows('infoimage_1', $homeID)): the_row();?>
	<div class="col-12 col-lg-4 section-information-txt ">
	<span class="title"><?=get_sub_field('title')?></span>
	<span class="desc"><?=get_sub_field('text')?></span>
	<a href="<?=get_sub_field('button_link')?>" class="btn btn-dark  btn-large  btn-long" title="<?=get_sub_field('button_text')?>"><?=get_sub_field('button_text')?></a>
	</div>
	<?php endwhile;?>
<?php endif;?>


<?php if (have_rows('infoimage_2', $homeID)): ?>
<?php while (have_rows('infoimage_2', $homeID)): the_row();?>
	<div class="col-12 col-lg-4">
	<div class="section-information-img">
	<?=wp_get_attachment_image(get_sub_field('img'), 'large', false, ["class" => "img-fluid"])?>
	</div>
	</div>
	<?php endwhile;?>
<?php endif;?>


<?php if (have_rows('infoimage_3', $homeID)): ?>
<?php while (have_rows('infoimage_3', $homeID)): the_row();?>
	<div class="col-12 col-lg-4 section-information-txt ">
	<span class="title"><?=get_sub_field('title')?></span>
	<span class="desc"><?=get_sub_field('text')?></span>
	<a href="<?=get_sub_field('button_link')?>" class="btn btn-dark  btn-large  btn-long" title="<?=get_sub_field('button_text')?>"><?=get_sub_field('button_text')?></a>
	</div>
	<?php endwhile;?>
<?php endif;?>
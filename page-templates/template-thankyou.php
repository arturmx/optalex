<?php
/**
 * Template Name: Thank You Page
 *
 * The template for thank you page.
 *
 * @author Tomasz Załucki <info@innhouse.pl>
 */
get_header();
?>

<section class="page-information">
	<div class="container">
		<div class="row">
			<div class="col-12 offset-lg-2 col-lg-8  d-flex flex-column justify-content-center align-items-center">
				 <span><?=get_field('thankyou_subtitle')?></span>
				 <h1><?=get_field('thankyou_title')?></h1>
				 <?=get_field('thankyou_desc')?>
				 <a href="/" title="<?= __("Strona główna","optalex")?>" class="btn btn-dark btn-long"><?= __("Strona główna","optalex")?></a>

			</div>
	</div>
	</div>
</section>


<?php get_footer();
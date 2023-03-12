<?php
/**
 * Template Name: Home
 *
 * The template for home page.
 *
 * @author Tomasz Załucki <info@innhouse.pl>
 */
get_header();
?>

<section class="section-slider">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div id="carouselMainSlider" class="carousel slide" data-ride="carousel">

					<div class="carousel-inner">
						<?php
						$params = array(
							'posts_per_page' => 100,
							'post_type' => 'slider',
							'meta_key' => 'slide_active',
							'meta_value' => 'tak',
						);
$wc_query = new WP_Query($params); // (2)
?>
<?php
if ($wc_query->have_posts()): $i = 0;
	while ($wc_query->have_posts()): $wc_query->the_post();?>
		<!-- carousel item -->
		<div class="carousel-item <?=$i == 0 ? "active" : ""?>">
			<div class="row">
				<div class="col-12 col-lg-5">
					<div class="carousel-caption no-select">
						<h2><?php the_field('slider_title')?></h2>
						<div class="desc"><?php the_field('slider_desc')?></div>
						<a href="<?php the_field('slider_button_link')?>" title="<?php the_field('slider_button_text')?>" class="btn btn-large btn-dark"><?php the_field('slider_button_text')?></a>
					</div>
				</div>
				<div class="col-12 col-lg-5 offset-lg-2 carousel-img">
					<?php
					$product = get_field('slider_product');
					get_post_thumbnail_id($loop->post->ID)
					?>
					<strong><?=$product->post_title?></strong>
					<?=wp_get_attachment_image(get_post_thumbnail_id($product->ID), 'full', false, ["class" => "img-fluid"])?>

					<span class="d-flex align-items-center"><?php the_field('product_size_1', $product->ID);?> <i class="icon icon-square icon-11 ms-2 me-2"></i> <?php the_field('product_size_2', $product->ID);?></span>

				</div>
			</div>
		</div>

		<!-- end carousel item -->
		<?php
		$i++;
	endwhile;
	?>
	<?php wp_reset_postdata(); // (5)   ?>
<?php else: ?>
	<p>
		<?php _e('No Sliders'); // (6)    ?>
	</p>
<?php endif;?>
</div>
<ol class="carousel-indicators">
	<?php
	if ($wc_query->have_posts()): $i = 0;
		while ($wc_query->have_posts()): $wc_query->the_post();?>
			<li data-bs-target="#carouselMainSlider" data-bs-slide-to="<?=$i?>"
				class="<?=$i == 0 ? "active" : ""?>">
				<?php
				$product = get_field('slider_product');
				get_post_thumbnail_id($loop->post->ID)
				?>

				<?=wp_get_attachment_image(get_post_thumbnail_id($product->ID), 'full', false, ["class" => "img-fluid"])?>



			</li>
			<?php
			$i++;
		endwhile;
		?>
	<?php endif;?>
</ol>
</div>
</div>
</div>
</div>
</section>
<section class="section-products section-light">
	<div class="container">
		<div class="d-flex w-100 justify-content-between section-products-title">
			<h2 class="title"><?=_e('Bestsellers', 'optalex')?></h2>

			<div class="more">
				<a href="<?=get_permalink( woocommerce_get_page_id( 'shop' ) );?>?swoof=1&product_cat=bestseller" title="<?php _e('See all', 'optalex')?>">
					<?php _e('See all', 'optalex')?>
					<span class="icon-circle-dark ms-3"><i class="icon icon-icon-next"></i></span>
				</a>
			</div>


		</div>

		<section class="carousel">
			<div class="row">
				<div class="col-12 carousel-wrap">
					<span class="carousel-arrow carousel-arrow__prev" data-arrow="best-prev"><i class="icon-left"></i></span>
					<span class="carousel-arrow carousel-arrow__next" data-arrow="best-next"><i class="icon-right"></i></span>
					<div class="swiper-container swiper-bestseller">

						<div class="swiper-wrapper">

							<?php
							$params = array(

								'posts_per_page' => 9,
								'post_type' => 'product',
								'paged' => 1,
								'orderby' => 'rand',
								  'product_cat' => 'bestseller',

							);
$wc_query = new WP_Query($params); // (2)

?>
<?php
if ($wc_query->have_posts()): $i = 0;
	while ($wc_query->have_posts()): $wc_query->the_post();?>

		<div class="swiper-slide">
			<?php get_template_part('template-parts/product', null,  ['css' => '',]);?>

		</div>
		<?php

		$i++;
	endwhile;

	$total_pages = $wc_query->max_num_pages;
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

</div>
</div>


</div>
</section>
<section class="section-information">
	<div class="row">

		<?php get_template_part('template-parts/section-info', null);?>

	</div>
</section>
</div>
</section>



<?php get_template_part('template-parts/product-carousel', null,
	[
		'category' => 'damskie',
		'bg' => 'section-gray',
		'info' => true,
	]);?>


<?php get_template_part('template-parts/product-carousel', null,
	[
		'category' => 'meskie',
		'bg' => 'section-light',
		'info' => true,
	]);?>

<?php get_template_part('template-parts/product-carousel', null,
	[
		'category' => 'dzieciece',
		'bg' => 'section-gray',
		'info' => true,
	]);?>
	<section class="section-banner section-light">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="banner">
						<?=wp_get_attachment_image(get_field('banner_logo'), 'medium', false, ["class" => "img-fluid banner-logo"])?>
						<div class="d-flex banner-content  h-100">
							<div class="col-6 order-0 order-lg-0 col-lg-3 d-flex flex-column justify-content-center align-items-start banner-content__left">
								<span class="banner-text">
									<?=get_field('banner_left_text_big')?><small><?=get_field('banner_left_text_small')?></small>
								</span>
								<span class="banner-line"></span>
								<span class="banner-subtext"><?=get_field('banner_left_text_line')?></span>
							</div>
							<div class="col-12 order-2 order-lg-1 col-lg-6 banner-center" style="background-image: url('<?php echo get_field('banner_img'); ?>')">

								<a href="<?=get_field('banner_button_link')?>" class="btn btn-dark btn-large btn-long" title="<?=get_field('banner_button_text')?>"><?=get_field('banner_button_text')?></a>
							</div>
							<div class="col-6 order-1 order-lg-2 col-lg-3 d-flex flex-column justify-content-center align-items-end banner-content__right">
								<span class="banner-text">
									<?=get_field('banner_right_text_big')?><small><?=get_field('banner_right_text_small')?></small>
								</span>
								<span class="banner-line"></span>
								<span class="banner-subtext"><?=get_field('banner_right_text_line')?></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="section-step section-light">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h4><?=get_field('information_title')?></h4>
				</div>





				<?php if (have_rows('info_1')): ?>
					<?php while (have_rows('info_1')): the_row();?>

						<div class="col-12 col-lg-4 d-flex flex-column align-items-center">
							<span class="circle"><?=get_sub_field('nr')?></span>
							<span class="title"><?=get_sub_field('title')?></span>
							<span class="subtitle"><?=get_sub_field('subtitle')?></span>
						</div>

					<?php endwhile;?>
				<?php endif;?>
				<?php if (have_rows('info_2')): ?>
					<?php while (have_rows('info_2')): the_row();?>

						<div class="col-12 col-lg-4 d-flex flex-column align-items-center">
							<span class="circle"><?=get_sub_field('nr')?></span>
							<span class="title"><?=get_sub_field('title')?></span>
							<span class="subtitle"><?=get_sub_field('subtitle')?></span>
						</div>

					<?php endwhile;?>
				<?php endif;?>
				<?php if (have_rows('info_3')): ?>
					<?php while (have_rows('info_3')): the_row();?>

						<div class="col-12 col-lg-4 d-flex flex-column align-items-center">
							<span class="circle"><?=get_sub_field('nr')?></span>
							<span class="title"><?=get_sub_field('title')?></span>
							<span class="subtitle"><?=get_sub_field('subtitle')?></span>
						</div>

					<?php endwhile;?>
				<?php endif;?>
				<div class="col-12 d-flex justify-content-center">
					<a href="<?=get_field('information_button_link')?>" class="btn btn-dark btn-large btn-long" title="<?=get_field('information_button_text')?>"><?=get_field('information_button_text')?></a>
				</div>
			</div>
		</div>
	</section>


	<section class="section-gallery section-light">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-4 mb-3 mb-md-0">
					<div class="ratio ratio-4x3">
						<?=wp_get_attachment_image(get_field('gallery_1'), 'full', false, ["class" => "img-absolute"])?>
					</div>
				</div>
				<div class="col-12 col-md-4 mb-3 mb-md-0">
					<div class="ratio ratio-4x3">
						<?=wp_get_attachment_image(get_field('gallery_2'), 'full', false, ["class" => "img-absolute"])?>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="ratio ratio-4x3">
						<?=wp_get_attachment_image(get_field('gallery_3'), 'full', false, ["class" => "img-absolute"])?>
					</div>
				</div>

			</div>
		</div>
	</section>


	<?php get_footer();
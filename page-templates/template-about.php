<?php
/**
 * Template Name: About
 *
 * The template for about page.
 *
 * @author Tomasz Załucki <info@innhouse.pl>
 */
get_header();
?>


<section class="section-gray about-one" style="background-image: url('<?=get_field('about_img');?>')">
	<div class="container " >
		<div class="row">
			<div class="col-12 col-lg-6 about-one-wrapper">
				<i class="icon-quote"></i>
				<h1><?=get_field('about_title');?></h1>
				<?=get_field('about_desc');?>
				<span class="sig"><?=get_field('about_sig');?></span>
				<div class="about-one-stat">
					<div class="about-one-stat-item">
						<span><?=get_field('about_txt_1');?></span><small><?=get_field('about_txt_2');?></small>
						<span class="line"></span>
						<span class="desc"><?=get_field('about_txt_3');?></span>
					</div>
					<div class="about-one-stat-item">
						<span><?=get_field('about_txt_4');?></span>
						<span class="line"></span>
						<span class="desc"><?=get_field('about_txt_5');?></span>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>



<section class="section-light about-info about-padding">
	<div class="container " >
		<div class="row">
			<div class="col-12 col-lg-8 offset-lg-2 about-info-wrapper">
	<h2><?=get_field('about_2_title');?></h2>
	<?=get_field('about_2_desc');?>
	<?=wp_get_attachment_image(get_field('about_2_img'), 'full', false, ["class" => "img-fluid"])?>
	<a href="<?=get_field('about_2_button_link');?>" title="<?=get_field('about_2_button');?>" class="btn btn-dark btn-long mt-5"><?=get_field('about_2_button');?></a>
			</div>
		</div>
	</div>
</section>
	
<section class="about-download">
	<div class="about-download-wrapper">
		<h2 class="about-download-h2"><?=get_field('about_download_h2');?></h2>
		<div class="about-download-section1">
			<h3 class="about-download-h3"><?=get_field('about_download_section1_documents');?></h3>	
				<?php while( have_rows('about_download_files1') ) : the_row(); ?>
				<?php $plik = get_sub_field('file'); ?>
				
			<div class="about-download-box">
				<div class="about-download-box-left">
				<svg  id="Component_40_1" data-name="Component 40 – 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18" height="24" viewBox="0 0 18 24">
					<defs>
						<clipPath id="clip-path">
							<rect id="Rectangle_246" data-name="Rectangle 246" width="18" height="24" fill="none" stroke="#707070" class="about-download-svg-color" stroke-linejoin="round" stroke-width="1"/>
						</clipPath>
					</defs>
					<g id="Group_1315" data-name="Group 1315">
						<g id="Group_1314" data-name="Group 1314" clip-path="url(#clip-path)">
						<path id="Path_579" data-name="Path 579" d="M17.054,23.073H.5V.5H12.539l4.515,4.515Z" transform="translate(0.252 0.252)" fill="none" stroke="#707070" class="about-download-svg-color" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1"/>
						</g>
					</g>
					<line id="Line_5" data-name="Line 5" x2="6.02" transform="translate(4.515 8.076)" fill="none" stroke="#707070" class="about-download-svg-color" stroke-miterlimit="10" stroke-width="1"/>
					<line id="Line_6" data-name="Line 6" x2="9.029" transform="translate(4.515 12.322)" fill="none" stroke="#707070" class="about-download-svg-color" stroke-miterlimit="10" stroke-width="1"/>
					<line id="Line_7" data-name="Line 7" x2="9" transform="translate(5 17)" fill="none" stroke="#707070" class="about-download-svg-color" stroke-miterlimit="10" stroke-width="1"/>
				</svg>
					<p class="about-download-filename"><?php echo $plik['title']; ?></p>
					<p>(<?php echo $plik['filesize'] >> 10; ?> Kb)</p>
				</div>
				<a download href="<?php echo $plik['url']; ?>" class="about-download-link">Pobierz plik</a>
			</div>
				<?php endwhile; ?>
				
		</div>
		<div class="about-download-section2">
			<h3 class="about-download-h3"><?=get_field('about_download_section2_documents');?></h3>
				<?php while( have_rows('about_download_files2') ) : the_row(); ?>
				<?php $plik = get_sub_field('file'); ?>
			<div class="about-download-box">
				<div class="about-download-box-left">
				<svg  id="Component_40_1" data-name="Component 40 – 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18" height="24" viewBox="0 0 18 24">
					<defs>
						<clipPath id="clip-path">
							<rect id="Rectangle_246" data-name="Rectangle 246" width="18" height="24" fill="none" stroke="#707070" class="about-download-svg-color" stroke-linejoin="round" stroke-width="1"/>
						</clipPath>
					</defs>
					<g id="Group_1315" data-name="Group 1315">
						<g id="Group_1314" data-name="Group 1314" clip-path="url(#clip-path)">
						<path id="Path_579" data-name="Path 579" d="M17.054,23.073H.5V.5H12.539l4.515,4.515Z" transform="translate(0.252 0.252)" fill="none" stroke="#707070" class="about-download-svg-color" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1"/>
						</g>
					</g>
					<line id="Line_5" data-name="Line 5" x2="6.02" transform="translate(4.515 8.076)" fill="none" stroke="#707070" class="about-download-svg-color" stroke-miterlimit="10" stroke-width="1"/>
					<line id="Line_6" data-name="Line 6" x2="9.029" transform="translate(4.515 12.322)" fill="none" stroke="#707070" class="about-download-svg-color" stroke-miterlimit="10" stroke-width="1"/>
					<line id="Line_7" data-name="Line 7" x2="9" transform="translate(5 17)" fill="none" stroke="#707070" class="about-download-svg-color" stroke-miterlimit="10" stroke-width="1"/>
				</svg>
					<p class="about-download-filename"><?php echo $plik['title']; ?></p>
					<p>(<?php echo $plik['filesize'] >> 10; ?> Kb)</p>
				</div>
				<a download href="<?php echo $plik['url'] ?>" class="about-download-link">Pobierz plik</a>
			</div>
				<?php endwhile; ?>
		</div>
	</div>
	<div class="container">
		<div class="about-download-line"></div>
	</div>
</section>

<section class="section-gray about-stat about-padding">
	<div class="container " >
		<div class="row">
			<div class="col-12 col-lg-3 d-flex align-items-center  justify-content-center">
			<?=wp_get_attachment_image(get_field('about_3_img'), 'full', false, ["class" => "img-fluid"])?>
			</div>
			<div class="
			col-12 col-lg-6
			d-flex flex-column
			justify-content-center
			align-items-center  align-items-lg-start
			text-center text-lg-start
			mt-5 mt-lg-0
			">
			<h2><?=get_field('about_3_title');?></h2>
	<?=get_field('about_3_desc');?>
			<a href="<?=get_field('about_3_button_link');?>" title="<?=get_field('about_3_button');?>" class="btn btn-dark btn-long "><?=get_field('about_3_button');?></a>
			</div>
			<div class="col-12 col-lg-1">
				<div class="line-vertical"></div>
			</div>
			<div class="col-12 col-lg-2 mt-5 mt-lg-0">
				<div class="row">


			<?php if (have_rows('about_3_stat')): ?>
	<?php while (have_rows('about_3_stat')): the_row();?>
		<div class="col-4 col-lg-12">
		<a href="<?=get_sub_field('link')?>" title="<?=get_sub_field('desc')?>" class="about-stat-link">
		<span class="nr"><?=get_sub_field('nr')?></span>
		<span class="line"></span>
		<span class="desc"><?=get_sub_field('desc')?></span>
		</a>
		</div>
		<div class="col-4 col-lg-12">
		<a href="<?=get_sub_field('link_2')?>" title="<?=get_sub_field('desc_2')?>" class="about-stat-link">
		<span class="nr"><?=get_sub_field('nr_2')?></span>
		<span class="line"></span>
		<span class="desc"><?=get_sub_field('desc_2')?></span>
		</a>
		</div>
		<div class="col-4 col-lg-12">
		<a href="<?=get_sub_field('link_3')?>" title="<?=get_sub_field('desc_3')?>" class="about-stat-link">
		<span class="nr"><?=get_sub_field('nr_3')?></span>
		<span class="line"></span>
		<span class="desc"><?=get_sub_field('desc_3')?></span>
		</a>
		</div>
		<?php endwhile;?>
<?php endif;?>
</div>
			</div>
		</div>
	</div>
</section>
 
<section class="section-information section-light about-padding">
	<div class="container">
	<div class="row">

	<?php get_template_part('template-parts/section-info', null);?>
	</div>
	</div>
</section>

<?php get_footer();
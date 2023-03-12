 
		</main><!-- /#main -->
		<footer id="footer" class="footer">
			<div class="top">
			<div class="container">
				<div class="row">
					<div class="col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-lg-start">
						<span class="footer-info-text"><?php echo get_theme_mod('footer_text_1'); ?></span>
					</div>
					<div class="col-12 col-md-3 justify-content-center justify-content-lg-start">
					<span class="footer-info-contact">
					<span class="icon-circle-dark"><i class="icon-phone"></i> </span> <a href="tel:<?php echo get_theme_mod('footer_text_2'); ?>" title="Zadzwoń do nas"><?php echo get_theme_mod('footer_text_2'); ?></a>
					</span>
					</div>
					<div class="col-12 col-md-3 justify-content-center justify-content-lg-start">
					<span class="footer-info-contact">
					<span class="icon-circle-dark"><i class="icon-email"></i> </span>   <a href="mailto:<?php echo get_theme_mod('footer_text_3'); ?>" title="Napisz do nas"><?php echo get_theme_mod('footer_text_3'); ?></a>
					</span>
					</div>
			</div>
			</div>
			</div>
			<div class="bottom">
			<div class="container">
				<div class="row footer-wrap-menu">

				<?php if (is_active_sidebar('footer_1')):
?>
						<div class="col-12 col-md-6 col-lg-3 footer-logo">
							<?php
dynamic_sidebar('footer_1');

if (current_user_can('manage_options')):
?>
								<span class="edit-link"><a href="<?php echo esc_url(admin_url('widgets.php')); ?>" class="badge badge-secondary"><?php esc_html_e('Edit', 'optalex');?></a></span><!-- Show Edit Widget link -->
							<?php
endif;
?>
						</div>
					<?php
endif;
?>


				<?php if (is_active_sidebar('footer_2')):
?>
						<div class="col-12 col-md-6 col-lg-3 footer-menu">
							<?php
dynamic_sidebar('footer_2');

if (current_user_can('manage_options')):
?>
								<span class="edit-link"><a href="<?php echo esc_url(admin_url('widgets.php')); ?>" class="badge badge-secondary"><?php esc_html_e('Edit', 'optalex');?></a></span><!-- Show Edit Widget link -->
							<?php
endif;
?>
						</div>
					<?php
endif;
?>
					<?php if (is_active_sidebar('footer_3')):
?>
						<div class="col-12 col-md-6 col-lg-3 footer-menu">
							<?php
dynamic_sidebar('footer_3');

if (current_user_can('manage_options')):
?>
								<span class="edit-link"><a href="<?php echo esc_url(admin_url('widgets.php')); ?>" class="badge badge-secondary"><?php esc_html_e('Edit', 'optalex');?></a></span><!-- Show Edit Widget link -->
							<?php
endif;
?>
						</div>
					<?php
endif;
?>
					<?php if (is_active_sidebar('footer_4')):
?>
						<div class="col-12 col-md-6 col-lg-3 footer-menu">
							<?php
dynamic_sidebar('footer_4');

if (current_user_can('manage_options')):
?>
								<span class="edit-link"><a href="<?php echo esc_url(admin_url('widgets.php')); ?>" class="badge badge-secondary"><?php esc_html_e('Edit', 'optalex');?></a></span><!-- Show Edit Widget link -->
							<?php
endif;
?>
						</div>
					<?php
endif;
?>
					<div class="col-12">
						<div class="footer-information">
						<div class="row">
							<div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
								<i class="icon-box"></i> <span><?php echo get_theme_mod('footer_menu_1'); ?></span>
							</div>
							<div class="col-12 col-md-4 d-flex justify-content-center align-items-center mt-3 mt-md-0">
								<i class="icon-shield"></i> <span><?php echo get_theme_mod('footer_menu_2'); ?></span>
							</div>
							<div class="col-12 col-md-4 d-flex justify-content-center align-items-center mt-3 mt-md-0">
								<i class="icon-cert"></i> <span><?php echo get_theme_mod('footer_menu_3'); ?></span>
							</div>
						</div>
						</div>
					</div>

					<div class="col-12 footer-copy">
						<div class="row">
							<div class="col-12 col-md-3 d-flex justify-content-start align-items-center">
							<p><?php printf(esc_html__('&copy; %1$s %2$s.', 'optalex'), date_i18n('Y'), get_bloginfo('name', 'display'));?></p>
							</div>
							<div class="col-12 col-md-6 d-flex justify-content-center align-items-center">
							<?php
if (has_nav_menu('footer-menu-bottom')): // See
    wp_nav_menu(
        array(
            'theme_location' => 'footer-menu-bottom',
            'container' => 'nav',
            'container_class' => '',
            'fallback_cb' => '',
            'items_wrap' => '<ul class="footer-copy-menu">%3$s</ul>',
            //'fallback_cb'    => 'WP_Bootstrap4_Navwalker_Footer::fallback',
            'walker' => new WP_Bootstrap4_Navwalker_Footer(),
        )
    );
endif;?>
							</div>
							<div class="col-12 col-md-3 d-flex justify-content-center align-items-center">
								<p>
								<?= __('Project:', 'optalex')?>  <a href="https://propercolors.pl" title="Projektowanie graficzne" target="_blank">propercolors</a>
							</p>
							</div>
						</div>
					</div>

			</div>
			</div>

			</div>

		</footer><!-- /#footer -->
	</div><!-- /#wrapper -->
	<!-- START Bootstrap-Cookie-Alert -->
<div class="alert  cookiealert" role="alert">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-12 col-lg-8 "> <?php _e('Cookie', 'optalex')?></div>
            <div class="col-12 col-lg-4 d-flex justify-content-start justify-content-lg-end"> <button type="button"
                    class="btn btn-primary btn-sm acceptcookies">
                    <?php _e('OK, I understand', 'optalex')?>
                </button></div>
        </div>


        </span>


    </div>
</div>
<!-- END Bootstrap-Cookie-Alert -->
	<?php
wp_footer();
?>
</body>
</html>

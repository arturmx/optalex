<?php
/**
 * Template Name: Registration Form
 *
 * The template for register page.
 *
 * @author Tomasz Załucki <info@innhouse.pl>
 */

if (is_user_logged_in()) {
    wp_redirect(get_permalink(get_option('woocommerce_myaccount_page_id')));
}

do_action('woocommerce_auth_page_header');
?>

<div class="col-12 col-lg-6 ">

		<div class="row h-100 align-items-lg-center  justify-content-center justify-content-lg-start">
			<div class="col-12 offset-lg-2 col-lg-8 col-xl-7 col-xxl-6 max-404">

			<div class="form-head">
			<a class="navbar-brand" href="<?php echo esc_url(home_url()); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
					<?php
$header_logo = get_theme_mod('header_logo'); // Get custom meta-value.

if (!empty($header_logo)):
?>
						<img src="<?php echo esc_url($header_logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" />
					<?php
else:
    echo esc_attr(get_bloginfo('name', 'display'));
endif;
?>
				</a>
				<span><?=__("Optics zone", "optalex")?></span>
			</div>
			<div class='form-title'>
			<h1><?=__('Login', 'optalex')?></h1>
			<div class="form-title-link">
				<span><?=__('Already have an account?', 'optalex')?></span>
			<a href="/logowanie/" title="<?=__('Login', 'optalex')?>"><?=__('Login', 'optalex')?></a>
			</div>
			</div>

			<div class="form-info">
		<p>
			<?=__('Your request to create an account on our website will be processed as soon as possible.', 'optalex')?>

		</p>
	</div>


			<?php wc_print_notices();?>
	<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action('woocommerce_register_form_tag');?> >



		<?php if ('no' === get_option('woocommerce_registration_generate_username')): ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="reg_username"><?php esc_html_e('Username', 'woocommerce');?>&nbsp;<span class="required">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>

		<?php endif;?>

		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide <?=isset( $_POST['email'] ) &&empty($_POST['email']) ? "error" : ''?>">
			<label for="reg_email"><?php esc_html_e('Email address', 'woocommerce');?>&nbsp;<span class="required">*</span></label>
			<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
		</p>



		<?php if ('no' === get_option('woocommerce_registration_generate_password')): ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide <?=isset( $_POST['password'] ) &&empty($_POST['password']) ? "error" : ''?>">
				<label for="reg_password"><?php esc_html_e('Password', 'woocommerce');?>&nbsp;<span class="required">*</span></label>
				<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
			</p>

		<?php else: ?>

			<p><?php esc_html_e('A password will be sent to your email address.', 'woocommerce');?></p>

		<?php endif;?>
		<?php do_action('woocommerce_register_form_start');?>
		<?php do_action('woocommerce_register_form');?>

		<p class="woocommerce-form-row form-row">
			<?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce');?>
			<button type="submit" class="btn btn-dark btn-long w-100" name="register" value="<?php esc_attr_e('Register', 'woocommerce');?>"><?php esc_html_e('Register', 'woocommerce');?></button>
		</p>

		<?php do_action('woocommerce_register_form_end');?>

	</form>

	<div class="form-info">
		<p>
			<?=__('<strong> Note: </strong> the login and registration option is available only for opticians. If you are an individual user - ask the nearest optician to order the selected model of our luminaires.', 'optalex')?>

		</p>
	</div>
			</div>
		</div>

<?php do_action('woocommerce_after_customer_login_form');?>
<?php do_action('woocommerce_auth_page_footer');?>
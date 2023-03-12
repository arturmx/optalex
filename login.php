<?php
/**
 * Template Name: Login Form
 *
 * The template for login page.
 *
 * @author Tomasz Załucki <info@innhouse.pl>
 */

if (is_user_logged_in()) {
    wp_redirect(get_permalink(get_option('woocommerce_myaccount_page_id')));
}
do_action( 'woocommerce_auth_page_header' ); 
?>
 

		<div class="col-12 col-lg-6 ">

		<div class="row h-100 align-items-lg-center justify-content-center justify-content-lg-start">
			<div class="col-12 offset-lg-2 col-lg-8 col-xl-7 col-xxl-6 max-404">

			<div class="form-head">
			<a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php
						$header_logo = get_theme_mod( 'header_logo' ); // Get custom meta-value.

						if ( ! empty( $header_logo ) ) :
					?>
						<img src="<?php echo esc_url( $header_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
					<?php
						else :
							echo esc_attr( get_bloginfo( 'name', 'display' ) );
						endif;
					?>
				</a>
				<span><?= __("Strefa optyka","optalex")?></span>
			</div>
			<div class='form-title'>
			<h1><?=__( 'Login', 'optalex' )?></h1> 
			<div class="form-title-link">
				<span><?=__( 'You do not have an account?', 'optalex' )?></span>
			<a href="/rejestracja/" title="<?=__( 'Register', 'optalex' )?>"><?=__( 'Register', 'optalex' )?></a>
			</div>
			</div>

<?php wc_print_notices(); ?>

 
<form method="post" class="wc-auth-login">
	<p class="form-row form-row-wide">
		<label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input type="text" class="input-text" name="username" id="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" /><?php //@codingStandardsIgnoreLine ?>
	</p>
	<p class="form-row form-row-wide">
		<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input class="input-text" type="password" name="password" id="password" />
	</p>
	<div class="form-remember">
	<p class="form-row">
		<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
			<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
		</label>
		<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
		<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ); ?>" />
	 
	</p>
	<p class="lost_password">
		<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
	</p>

	</div>
	<p class="wc-auth-actions">
		<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
		<button type="submit" class="btn btn-dark btn-long w-100" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>"><?php esc_html_e( 'Login', 'woocommerce' ); ?></button>
		<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect_url ); ?>" />
	</p>
</form>

<div class="form-info">
		<p>
			<?=__('<strong> Note: </strong> the login and registration option is available only for opticians. If you are an individual user - ask the nearest optician to order the selected model of our luminaires.', 'optalex')?>

		</p>
	</div>
			</div>
		</div>
		
	
 

<?php do_action( 'woocommerce_auth_page_footer' ); ?>
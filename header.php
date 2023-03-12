<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
<script> function mySearch() { var element = document.getElementById("searchform"); element.classList.toggle("searchformstyle"); } </script>

	<?php wp_head(); ?>
</head>

<?php
	$navbar_scheme   = get_theme_mod( 'navbar_scheme', 'navbar-light bg-light' ); // Get custom meta-value.
	$navbar_position = get_theme_mod( 'navbar_position', 'static' ); // Get custom meta-value.

	$search_enabled  = get_theme_mod( 'search_enabled', '1' ); // Get custom meta-value.
?>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<a href="#main" class="visually-hidden-focusable"><?php esc_html_e( 'Skip to main content', 'optalex' ); ?></a>

<div id="wrapper">
	<header>
		<nav id="header" class="navbar navbar-expand-xl <?php echo esc_attr( $navbar_scheme ); if ( isset( $navbar_position ) && 'fixed_top' === $navbar_position ) : echo ' fixed-top'; elseif ( isset( $navbar_position ) && 'fixed_bottom' === $navbar_position ) : echo ' fixed-bottom'; endif; if ( is_home() || is_front_page() ) : echo ' home'; endif; ?>">
			<div class="container-fluid">
			<div class="row w-100">
			<div class="
			col-5
			col-xl-3 
			order-0">
			<a class="navbar-brand logo" href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
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
				</div>
			<div class="
			col-2 
			col-md-1
			col-xl-6 
			d-flex justify-content-end  
			order-xl-1
			order-2">
			<button class="navbar-toggler order-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'optalex' ); ?>">
					<span class="icon-menu"></span>
				</button>

				<div id="navbar" class="collapse navbar-collapse justify-content-center">
					<?php
						// Loading WordPress Custom Menu (theme_location).
						wp_nav_menu(
							array(
								'theme_location' => 'main-menu',
								'container'      => '',
								'menu_class'     => 'navbar-nav',
								'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
								'walker'         => new WP_Bootstrap_Navwalker(),
							)
						);

					 
					?>
				</div><!-- /.navbar-collapse -->
				</div>
			<div class="
			col-5 
			col-md-5
			col-xl-3 
			d-flex align-items-center justify-content-end 
			order-xl-2
			order-1
			">
			<?php
			if ( '1' === $search_enabled ) :
					?>
							<form class="search-form my-2 my-lg-0" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<div class="input-group">
									<input type="text" name="s" class="form-control" placeholder="<?php esc_attr_e( 'Search', 'optalex' ); ?>" title="<?php esc_attr_e( 'Search', 'optalex' ); ?>" />
									<button type="submit" name="submit" class="btn btn-outline-secondary"><?php esc_html_e( 'Search', 'optalex' ); ?></button>
								</div>
							</form>
					<?php
						endif;
						global $woocommerce;
					?>

					<button class="woof_show_auto_form  d-md-flex align-items-center search-header header-icon text-hover" onclick="mySearch()"><span class="header-text d-flex search-text-pl">Szukaj</span><span class="header-text d-flex search-text-en">Search</span><i class="icon icon-search1 ms-2"></i></button>
					
					<a href="/ulubione/" class=" d-md-flex  align-items-center header-margin header-icon text-hover" title="<?php echo __('Favorite', 'optalex')?>"><span class="header-text d-flex"><span class="d-none d-xxl-flex"><?php echo __('Favorite', 'optalex')?></span> (<span class="yith-wcwl-items-count"><?=yith_wcwl_count_all_products()?></span>)</span> <i class="icon icon-heart ms-2"></i></a>

					<a href="<?=wc_get_cart_url()?>" class=" d-md-flex align-items-center header-margin header-icon text-hover" title="<?php echo __('Cart', 'optalex')?>"><span class="header-text d-flex"> <span class="d-none d-xxl-flex"><?php echo __('Cart', 'optalex')?></span> (<?=  $woocommerce->cart->cart_contents_count;?>)</span> <i class="icon icon-cart ms-2"></i></a>

					<?php if (is_active_sidebar('header_lang')):
						dynamic_sidebar('header_lang');
					endif; ?>

<?php  if(is_user_logged_in()){ ?>
	<div class="dropdown">
	<div class="header-account header-margin" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
		<span class="icon-circle-dark"><i class="icon-user"></i></span>
		<span class="name d-none d-md-flex"><?=__( 'Account', 'optalex')?></span>
		<i class="icon-arrow-down-sign-to-navigate"></i>
	</div>

	<ul class="dropdown-menu header-account-dropdown" aria-labelledby="dropdownMenuButton1">

	<li class="dropdown-item d-md-none">
	<a href="/ulubione/"   title="<?php echo __('Favorite', 'optalex')?>">
	<i class="icon icon-heart"></i><span><?php echo __('Favorite', 'optalex')?></span> (<span class="yith-wcwl-items-count"><?=yith_wcwl_count_all_products()?></span>) 

</a>
	</li>
	<li class="dropdown-item d-md-none">
<a href="<?=wc_get_cart_url()?>" title="<?php echo __('Cart', 'optalex')?>"> 
<i class="icon icon-cart"></i>
<span><?php echo __('Cart', 'optalex')?></span> (<?=  $woocommerce->cart->cart_contents_count;?>) </a>
	</li>
	<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="dropdown-item">

			
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>">
				
				<?php
			if($endpoint == "orders"){
				echo '<i class="icon-box"></i>';
			}elseif($endpoint == "edit-address"){
				echo '<i class="icon-pin-bold"></i>';
			}elseif($endpoint == "edit-account"){
				echo '<i class="icon-user"></i>';
			}elseif($endpoint == "downloads"){
				echo '<i class="icon-doc"></i>';
			}elseif($endpoint == "customer-logout"){
				echo '<i class="icon-off"></i>';
			}else{
				echo '<i class="icon-home"></i>';
			}

			 
			?><span><?php echo esc_html( $label ); ?></span></a>
			</li>
		<?php endforeach; ?>
  </ul>
	</div>

<?php  }else{ ?>
					<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="d-none d-xl-flex btn btn-dark btn-large header-margin btn-long"><?=__( 'Account', 'optalex')?></a>
					<?php  } ?>
			
			</div>
			</div>
				

			
			</div><!-- /.container -->
		</nav><!-- /#header -->
	</header>

	<main id="main"  <?php if ( isset( $navbar_position ) && 'fixed_top' === $navbar_position ) : echo ' style="padding-top: 100px;"'; elseif ( isset( $navbar_position ) && 'fixed_bottom' === $navbar_position ) : echo ' style="padding-bottom: 100px;"'; endif; ?>>
	





<?php
$classes = get_body_class();
if (in_array('woocommerce-shop',$classes)) {
    ?>
	<script>


</script>

	<div class="container search-form-all search-form-shoop" id="searchform" style="z-index: 999 ;right: 0;left: 0; "> 
		<div class="row">
			<div class="col-12">
			<i class="icon icon-search1 fa-search-cio"></i>
				<?php echo do_shortcode('[woof sid="auto_shortcode" autohide=0 taxonomies=product_cat:9 autosubmit=1]'); ?>

			</div>
		</div>
	</div>
	<?php
} else {
    ?>




	<div class="container search-form-all all-pages" id="searchform" style="z-index: 999;position: fixed;right: 0;left: 0; "> 
		<div class="row">
			<div class="col-12">
				<?php if ( is_active_sidebar( 'new-widget-area' ) ) : ?>
					<div id="secondary-sidebar" class="new-widget-area">
				<?php dynamic_sidebar( 'new-widget-area' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php
}
?>

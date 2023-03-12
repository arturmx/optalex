<?php
/**
 * Template Name: Not found
 * Description: Page template 404 Not found
 *
 */

get_header();

$search_enabled = get_theme_mod( 'search_enabled', '1' ); // Get custom meta-value.
?>
<div id="post-0" class="content error404 not-found">
<div class="container">
	<div class="row">
		<div class="col-12 mt-5 mb-5 d-flex justify-content-center">
		<div class="entry-content text-center">
		<img class="mt-5 img-fluid" src="/wp-content/themes/optalex/assets/img/404.png" alt="404">
		<p class="mt-5"><?php _e( "Something went wrong, we couldn't find the page you are looking for.", 'optalex' ); ?></p>
	<a href="/" title="<?php _e( 'Home', 'optalex' ); ?>" class="btn btn-dark btn-large mt-5"><?php _e( 'Home', 'optalex' ); ?></a>
	</div><!-- /.entry-content -->
		</div>
	</div>
</div>
	
</div><!-- /#post-0 -->
<?php
get_footer();

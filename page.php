<?php
/**
 * Template Name: Page (Default)
 * Description: Page template with Sidebar on the left side.
 *
 */

get_header();

 
?>
<div class="container">
<div class="row">
	<div class="col-12">
	<?php
			while ( have_posts() ) :
				do_action( 'woocommerce_before_main_content' );
				the_post();
			  the_content(); 


			endwhile; // End of the loop.
			?>
	</div><!-- /.col -->
 
</div><!-- /.row -->
</div><!-- /.container -->
<?php
get_footer();

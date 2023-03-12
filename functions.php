<?php

/**
 * Include Theme Customizer.
 *
 * @since v1.0
 */
$theme_customizer = get_template_directory() . '/inc/customizer.php';
if (is_readable($theme_customizer)) {
    require_once $theme_customizer;
}

/**
 * Include Support for wordpress.com-specific functions.
 *
 * @since v1.0
 */
$theme_wordpresscom = get_template_directory() . '/inc/wordpresscom.php';
if (is_readable($theme_wordpresscom)) {
    require_once $theme_wordpresscom;
}

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since v1.0
 */
if (!isset($content_width)) {
    $content_width = 800;
}

/**
 * General Theme Settings.
 *
 * @since v1.0
 */
if (!function_exists('optalex_setup_theme')):
    function optalex_setup_theme()
{
        // Make theme available for translation: Translations can be filed in the /languages/ directory.
        load_theme_textdomain('optalex', get_template_directory() . '/languages');

        // Theme Support.
        add_theme_support('title-tag');
        add_theme_support('automatic-feed-links');
        add_theme_support('post-thumbnails');
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'script',
                'style',
                'navigation-widgets',
            )
        );

        // Add support for Block Styles.
        add_theme_support('wp-block-styles');
        // Add support for full and wide alignment.
        add_theme_support('align-wide');
        // Add support for editor styles.
        add_theme_support('editor-styles');
        // Enqueue editor styles.
        add_editor_style('style-editor.css');

        // Default Attachment Display Settings.
        update_option('image_default_align', 'none');
        update_option('image_default_link_type', 'none');
        update_option('image_default_size', 'large');

        // Custom CSS-Styles of Wordpress Gallery.
        add_filter('use_default_gallery_style', '__return_false');

    }
    add_action('after_setup_theme', 'optalex_setup_theme');

    // Disable Block Directory: https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/filters/editor-filters.md#block-directory
    remove_action('enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets');
    remove_action('enqueue_block_editor_assets', 'gutenberg_enqueue_block_editor_assets_block_directory');
endif;

/**
 * Fire the wp_body_open action.
 *
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
 *
 * @since v2.2
 */
if (!function_exists('wp_body_open')):
    function wp_body_open()
{
        /**
         * Triggered after the opening <body> tag.
         *
         * @since v2.2
         */
        do_action('wp_body_open');
    }
endif;

/**
 * Add new User fields to Userprofile.
 *
 * @since v1.0
 */
if (!function_exists('optalex_add_user_fields')):
    function optalex_add_user_fields($fields)
{
        // Add new fields.
        $fields['facebook_profile'] = 'Facebook URL';
        $fields['twitter_profile'] = 'Twitter URL';
        $fields['linkedin_profile'] = 'LinkedIn URL';
        $fields['xing_profile'] = 'Xing URL';
        $fields['github_profile'] = 'GitHub URL';

        return $fields;
    }
    add_filter('user_contactmethods', 'optalex_add_user_fields'); // get_user_meta( $user->ID, 'facebook_profile', true );
endif;

/**
 * Test if a page is a blog page.
 * if ( is_blog() ) { ... }
 *
 * @since v1.0
 */
function is_blog()
{
    global $post;
    $posttype = get_post_type($post);

    return ((is_archive() || is_author() || is_category() || is_home() || is_single() || (is_tag() && ('post' === $posttype))) ? true : false);
}

/**
 * Disable comments for Media (Image-Post, Jetpack-Carousel, etc.)
 *
 * @since v1.0
 */
function optalex_filter_media_comment_status($open, $post_id = null)
{
    $media_post = get_post($post_id);
    if ('attachment' === $media_post->post_type) {
        return false;
    }
    return $open;
}
add_filter('comments_open', 'optalex_filter_media_comment_status', 10, 2);

/**
 * Style Edit buttons as badges: https://getbootstrap.com/docs/5.0/components/badge
 *
 * @since v1.0
 */
function optalex_custom_edit_post_link($output)
{
    return str_replace('class="post-edit-link"', 'class="post-edit-link badge badge-secondary"', $output);
}
add_filter('edit_post_link', 'optalex_custom_edit_post_link');

function optalex_custom_edit_comment_link($output)
{
    return str_replace('class="comment-edit-link"', 'class="comment-edit-link badge badge-secondary"', $output);
}
add_filter('edit_comment_link', 'optalex_custom_edit_comment_link');

/**
 * Responsive oEmbed filter: https://getbootstrap.com/docs/5.0/helpers/ratio
 *
 * @since v1.0
 */
function optalex_oembed_filter($html)
{
    return '<div class="ratio ratio-16x9">' . $html . '</div>';
}
add_filter('embed_oembed_html', 'optalex_oembed_filter', 10, 4);

if (!function_exists('optalex_content_nav')):
    /**
     * Display a navigation to next/previous pages when applicable.
     *
     * @since v1.0
     */
    function optalex_content_nav($nav_id)
{
        global $wp_query;

        if ($wp_query->max_num_pages > 1):
        ?>
				<div id="<?php echo esc_attr($nav_id); ?>" class="d-flex mb-4 justify-content-between">
					<div><?php next_posts_link('<span aria-hidden="true">&larr;</span> ' . esc_html__('Older posts', 'optalex'));?></div>
					<div><?php previous_posts_link(esc_html__('Newer posts', 'optalex') . ' <span aria-hidden="true">&rarr;</span>');?></div>
				</div><!-- /.d-flex -->
		<?php
else:
        echo '<div class="clearfix"></div>';
    endif;
}

// Add Class.
function posts_link_attributes()
{
    return 'class="btn btn-secondary btn-lg"';
}
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');
endif;

/**
 * Init Widget areas in Sidebar.
 *
 * @since v1.0
 */
function optalex_widgets_init()
{
    // Area 1.
    register_sidebar(
        array(
            'name' => 'Primary Widget Area (Sidebar)',
            'id' => 'primary_widget_area',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );

    // Area 2.
    register_sidebar(
        array(
            'name' => 'Secondary Widget Area (Header Navigation)',
            'id' => 'secondary_widget_area',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h6 class="widget-title">',
            'after_title' => '</h6>',
        )
    );

    // Area 3.
    register_sidebar(
        array(
            'name' => 'Stopka - obszar 1',
            'id' => 'footer_1',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h6 class="widget-title">',
            'after_title' => '</h6>',
        )
    );

    // Area 3.
    register_sidebar(
        array(
            'name' => 'Stopka - obszar 2',
            'id' => 'footer_2',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h6 class="widget-title">',
            'after_title' => '</h6>',
        )
    );
    // Area 3.
    register_sidebar(
        array(
            'name' => 'Stopka - obszar 3',
            'id' => 'footer_3',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h6 class="widget-title">',
            'after_title' => '</h6>',
        )
    );
    // Area 3.
    register_sidebar(
        array(
            'name' => 'Stopka - obszar 4',
            'id' => 'footer_4',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h6 class="widget-title">',
            'after_title' => '</h6>',
        )
    );

    // Area 3.
    register_sidebar(
        array(
            'name' => 'Header języki',
            'id' => 'header_lang',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h6 class="widget-title">',
            'after_title' => '</h6>',
        )
    );
}
add_action('widgets_init', 'optalex_widgets_init');

if (!function_exists('optalex_article_posted_on')):
    /**
     * "Theme posted on" pattern.
     *
     * @since v1.0
     */
    function optalex_article_posted_on()
{
        printf(
            __('<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author-meta vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'optalex'),
            esc_url(get_the_permalink()),
            esc_attr(get_the_date() . ' - ' . get_the_time()),
            esc_attr(get_the_date('c')),
            esc_html(get_the_date() . ' - ' . get_the_time()),
            esc_url(get_author_posts_url((int) get_the_author_meta('ID'))),
            sprintf(esc_attr__('View all posts by %s', 'optalex'), get_the_author()),
            get_the_author()
        );
    }
endif;

/**
 * Template for Password protected post form.
 *
 * @since v1.0
 */
function optalex_password_form()
{
    global $post;
    $label = 'pwbox-' . (empty($post->ID) ? rand() : $post->ID);

    $output = '<div class="row">';
    $output .= '<form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" method="post">';
    $output .= '<h4 class="col-md-12 alert alert-warning">' . esc_html__('This content is password protected. To view it please enter your password below.', 'optalex') . '</h4>';
    $output .= '<div class="col-md-6">';
    $output .= '<div class="input-group">';
    $output .= '<input type="password" name="post_password" id="' . esc_attr($label) . '" placeholder="' . esc_attr__('Password', 'optalex') . '" class="form-control" />';
    $output .= '<div class="input-group-append"><input type="submit" name="submit" class="btn btn-primary" value="' . esc_attr__('Submit', 'optalex') . '" /></div>';
    $output .= '</div><!-- /.input-group -->';
    $output .= '</div><!-- /.col -->';
    $output .= '</form>';
    $output .= '</div><!-- /.row -->';
    return $output;
}
add_filter('the_password_form', 'optalex_password_form');

if (!function_exists('optalex_comment')):
    /**
     * Style Reply link.
     *
     * @since v1.0
     */
    function optalex_replace_reply_link_class($class)
{
        return str_replace("class='comment-reply-link", "class='comment-reply-link btn btn-outline-secondary", $class);
    }
    add_filter('comment_reply_link', 'optalex_replace_reply_link_class');

    /**
     * Template for comments and pingbacks:
     * add function to comments.php ... wp_list_comments( array( 'callback' => 'optalex_comment' ) );
     *
     * @since v1.0
     */
    function optalex_comment($comment, $args, $depth)
{
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type):
    case 'pingback':
    case 'trackback':
        ?>
			<li class="post pingback">
				<p><?php esc_html_e('Pingback:', 'optalex');?> <?php comment_author_link();?><?php edit_comment_link(__('Edit', 'optalex'), '<span class="edit-link">', '</span>');?></p>
		<?php
    break;
    default:
        ?>
			<li <?php comment_class();?> id="li-comment-<?php comment_ID();?>">
				<article id="comment-<?php comment_ID();?>" class="comment">
					<footer class="comment-meta">
						<div class="comment-author vcard">
							<?php
    $avatar_size = ('0' !== $comment->comment_parent ? 68 : 136);
        echo get_avatar($comment, $avatar_size);

        /* translators: 1: comment author, 2: date and time */
        printf(
            __('%1$s, %2$s', 'optalex'),
            sprintf('<span class="fn">%s</span>', get_comment_author_link()),
            sprintf('<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                esc_url(get_comment_link($comment->comment_ID)),
                get_comment_time('c'),
                /* translators: 1: date, 2: time */
                sprintf(esc_html__('%1$s ago', 'optalex'), human_time_diff((int) get_comment_time('U'), current_time('timestamp')))
            )
        );

        edit_comment_link(__('Edit', 'optalex'), '<span class="edit-link">', '</span>');
        ?>
						</div><!-- .comment-author .vcard -->

						<?php if ('0' === $comment->comment_approved): ?>
							<em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'optalex');?></em>
							<br />
						<?php endif;?>
				</footer>

				<div class="comment-content"><?php comment_text();?></div>

				<div class="reply">
					<?php
comment_reply_link(array_merge($args, array('reply_text' => __('Reply', 'optalex') . ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'])));
    ?>
				</div><!-- /.reply -->
			</article><!-- /#comment-## -->
		<?php
break;
    endswitch;
}

/**
 * Custom Comment form.
 *
 * @since v1.0
 * @since v1.1: Added 'submit_button' and 'submit_field'
 * @since v2.0.2: Added '$consent' and 'cookies'
 */
function optalex_custom_commentform($args = array(), $post_id = null)
{
        if (null === $post_id) {
            $post_id = get_the_ID();
        }

        $commenter = wp_get_current_commenter();
        $user = wp_get_current_user();
        $user_identity = $user->exists() ? $user->display_name : '';

        $args = wp_parse_args($args);

        $req = get_option('require_name_email');
        $aria_req = ($req ? " aria-required='true' required" : '');
        $consent = (empty($commenter['comment_author_email']) ? '' : ' checked="checked"');
        $fields = array(
            'author' => '<div class="form-floating mb-3">
							<input type="text" id="author" name="author" class="form-control" value="' . esc_attr($commenter['comment_author']) . '" placeholder="' . esc_html__('Name', 'optalex') . ($req ? '*' : '') . '"' . $aria_req . ' />
							<label for="author">' . esc_html__('Name', 'optalex') . ($req ? '*' : '') . '</label>
						</div>',
            'email' => '<div class="form-floating mb-3">
							<input type="email" id="email" name="email" class="form-control" value="' . esc_attr($commenter['comment_author_email']) . '" placeholder="' . esc_html__('Email', 'optalex') . ($req ? '*' : '') . '"' . $aria_req . ' />
							<label for="email">' . esc_html__('Email', 'optalex') . ($req ? '*' : '') . '</label>
						</div>',
            'url' => '',
            'cookies' => '<p class="form-check mb-3 comment-form-cookies-consent">
							<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" class="form-check-input" type="checkbox" value="yes"' . $consent . ' />
							<label class="form-check-label" for="wp-comment-cookies-consent">' . esc_html__('Save my name, email, and website in this browser for the next time I comment.', 'optalex') . '</label>
						</p>',
        );

        $defaults = array(
            'fields' => apply_filters('comment_form_default_fields', $fields),
            'comment_field' => '<div class="form-floating mb-3">
											<textarea id="comment" name="comment" class="form-control" aria-required="true" required placeholder="' . esc_attr__('Comment', 'optalex') . ($req ? '*' : '') . '"></textarea>
											<label for="comment">' . esc_html__('Comment', 'optalex') . '</label>
										</div>',
            /** This filter is documented in wp-includes/link-template.php */
            'must_log_in' => '<p class="must-log-in">' . sprintf(__('You must be <a href="%s">logged in</a> to post a comment.', 'optalex'), wp_login_url(apply_filters('the_permalink', get_the_permalink(get_the_ID())))) . '</p>',
            /** This filter is documented in wp-includes/link-template.php */
            'logged_in_as' => '<p class="logged-in-as">' . sprintf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'optalex'), get_edit_user_link(), $user->display_name, wp_logout_url(apply_filters('the_permalink', get_the_permalink(get_the_ID())))) . '</p>',
            'comment_notes_before' => '<p class="small comment-notes">' . esc_html__('Your Email address will not be published.', 'optalex') . '</p>',
            'comment_notes_after' => '',
            'id_form' => 'commentform',
            'id_submit' => 'submit',
            'class_submit' => 'btn btn-primary',
            'name_submit' => 'submit',
            'title_reply' => '',
            'title_reply_to' => esc_html__('Leave a Reply to %s', 'optalex'),
            'cancel_reply_link' => esc_html__('Cancel reply', 'optalex'),
            'label_submit' => esc_html__('Post Comment', 'optalex'),
            'submit_button' => '<input type="submit" id="%2$s" name="%1$s" class="%3$s" value="%4$s" />',
            'submit_field' => '<div class="form-submit">%1$s %2$s</div>',
            'format' => 'html5',
        );

        return $defaults;
}
add_filter('comment_form_defaults', 'optalex_custom_commentform');

endif;

/**
 * Nav menus.
 *
 * @since v1.0
 */
if (function_exists('register_nav_menus')) {
    register_nav_menus(
        array(
            'main-menu' => 'Main Navigation Menu',
            'footer-menu' => 'Footer Menu',
            'footer-menu-bottom' => 'Footer Menu Bottom',
        )
    );
}

// Custom Nav Walker: wp_bootstrap_navwalker().
$custom_walker = get_template_directory() . '/inc/wp_bootstrap_navwalker.php';
if (is_readable($custom_walker)) {
    require_once $custom_walker;
}

$custom_walker_footer = get_template_directory() . '/inc/wp_bootstrap_navwalker_footer.php';
if (is_readable($custom_walker_footer)) {
    require_once $custom_walker_footer;
}

/**
 * Loading All CSS Stylesheets and Javascript Files.
 *
 * @since v1.0
 */
function optalex_scripts_loader()
{
    $theme_version = wp_get_theme()->get('Version');

    // 1. Styles.
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css', array(), $theme_version, 'all');
    wp_enqueue_style('main', get_template_directory_uri() . '/assets/css/main.css', array(), $theme_version, 'all'); // main.scss: Compiled Framework source + custom styles.
    wp_enqueue_style('about-download', get_template_directory_uri() . '/assets/css/about.css');

    if (is_rtl()) {
        wp_enqueue_style('rtl', get_template_directory_uri() . '/assets/css/rtl.css', array(), $theme_version, 'all');
    }

    // 2. Scripts.

    wp_enqueue_script('swipper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array('jquery'), $theme_version, true);

    wp_enqueue_script('select2', get_template_directory_uri() . '/assets/js/select2.min.js', array('jquery'), $theme_version, true);

    wp_enqueue_script('mainjsfront', get_template_directory_uri() . '/assets/js/main.bundle.js', array(), $theme_version, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'optalex_scripts_loader');

function add_woocommerce_support()
{
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'add_woocommerce_support');

function bittersweet_pagination()
{

    global $wp_query;

    if ($wp_query->max_num_pages <= 1) {
        return;
    }

    $big = 999999999; // need an unlikely integer

    $pages = paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'type' => 'array',
        'prev_text' => '<span class="d-none d-lg-flex">' . __('Previous', 'optalex') . '</span><span class="d-flex d-lg-none">&laquo;</span>',
        'next_text' => '<span class="d-none d-lg-flex">' . __('Next', 'optalex') . '</span><span class="d-flex d-lg-none">&raquo;</span>',
    ));
    if (is_array($pages)) {
        $paged = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');
        echo '<div class="pagination-wrap"><ul class="pagination">';
        if (!get_query_var('paged')) {
            echo '<li class="prev disable me-auto"><span class="d-none d-lg-flex">' . __('Previous', 'optalex') . '</span><span class="d-flex d-lg-none">&laquo;</span></li>';
        }
        foreach ($pages as $page) {
            echo "<li>$page</li>";
        }
        if (get_query_var('paged') == $wp_query->max_num_pages) {
            echo '<li class="next disable ms-auto"><span class="d-none d-lg-flex">' . __('Next', 'optalex') . '</span><span class="d-flex d-lg-none">&raquo;</span></li>';
        }
        echo '</ul></div>';
    }

}
// Add WooCommerce 'Shop' location rule value
// https://www.advancedcustomfields.com/resources/custom-location-rules/
add_filter('acf/location/rule_values/page_type', 'dc_acf_location_rules_values_woo_shop');

function dc_acf_location_rules_values_woo_shop($choices)
{

    $choices['woo-shop-page'] = 'WooCommerce Shop Page';

    return $choices;
}

if (class_exists('WooCommerce')) {
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}

add_filter( 'woocommerce_single_product_carousel_options', 'ud_update_woo_flexslider_options' );

function ud_update_woo_flexslider_options( $options ) {
$options['directionNav'] = true;

return $options;
}
/**
 * Plus Minus Quantity Buttons @ WooCommerce Single Product Page
 */

// -------------
// 1. Show Buttons

function silva_display_quantity_plus()
{
    echo '<button type="button" class="plus" >+</button>';
}

function silva_display_quantity_minus()
{
    echo '<button type="button" class="minus" >-</button>';
}

// Note: to place minus @ left and plus @ right replace above add_actions with:
add_action('woocommerce_before_add_to_cart_quantity', 'silva_display_quantity_minus');
add_action('woocommerce_after_add_to_cart_quantity', 'silva_display_quantity_plus');

// -------------
// 2. Trigger jQuery script

add_action('wp_footer', 'silva_add_cart_quantity_plus_minus');

function silva_add_cart_quantity_plus_minus()
{
    // Only run this on the single product page

    $classQty = "form";

    if (is_cart()) {
        $classQty = ".product-quantity";
    }

    if (is_product() || is_cart()) {

        ?>
      <script type="text/javascript">

      jQuery(document).ready(function($){

         $(document).on( 'click', 'button.plus, button.minus', function() {

            // Get current quantity values
            var qty = $( this ).closest( '<?=$classQty?>' ).find( '.qty' );
            var val = parseFloat(qty.val());
            var max = parseFloat(qty.attr( 'max' ));
            var min = parseFloat(qty.attr( 'min' ));
            var step = parseFloat(qty.attr( 'step' ));

            // Change the value if plus or minus
            if ( $( this ).is( '.plus' ) ) {
               if ( max && ( max <= val ) ) {
                  qty.val( max );
               } else {
                  qty.val( val + step );
               }
            } else {
               if ( min && ( min >= val ) ) {
                  qty.val( min );
               } else if ( val > 1 ) {
                  qty.val( val - step );
               }
            }
			qty.change();

         });

      });

      </script>
   <?php
}
}

// add_filter( 'woocommerce_form_field', 'my_woocommerce_form_field' );
// function my_woocommerce_form_field( $field ) {
//     return preg_replace(
//         '#<p class="form-row (.*?)"(.*?)>(.*?)</p>#',
//         '<div class="$1 form-group"$2>$3</div>',
//         $field
//     );
// }
/** Forms */

if (!function_exists('woocommerce_form_field')) {

    /**
     * Outputs a checkout/address form field.
     *
     * @param string $key Key.
     * @param mixed  $args Arguments.
     * @param string $value (default: null).
     * @return string
     */
    function woocommerce_form_field($key, $args, $value = null)
    {
        $defaults = array(
            'type' => 'text',
            'label' => '',
            'description' => '',
            'placeholder' => '',
            'maxlength' => false,
            'required' => false,
            'autocomplete' => false,
            'id' => $key,
            'class' => array(),
            'label_class' => array(),
            'input_class' => array(),
            'return' => false,
            'options' => array(),
            'custom_attributes' => array(),
            'validate' => array(),
            'default' => '',
            'autofocus' => '',
            'priority' => '',
        );

        $args = wp_parse_args($args, $defaults);
        $args = apply_filters('woocommerce_form_field_args', $args, $key, $value);

        if ($args['required']) {
            $args['class'][] = 'validate-required';
            $required = '&nbsp;<abbr class="required" title="' . esc_attr__('required', 'woocommerce') . '">*</abbr>';
        } else {
            $required = '&nbsp;<span class="optional">(' . esc_html__('optional', 'woocommerce') . ')</span>';
        }

        if (is_string($args['label_class'])) {
            $args['label_class'] = array($args['label_class']);
        }

        if (is_null($value)) {
            $value = $args['default'];
        }

        // Custom attribute handling.
        $custom_attributes = array();
        $args['custom_attributes'] = array_filter((array) $args['custom_attributes'], 'strlen');

        if ($args['maxlength']) {
            $args['custom_attributes']['maxlength'] = absint($args['maxlength']);
        }

        if (!empty($args['autocomplete'])) {
            $args['custom_attributes']['autocomplete'] = $args['autocomplete'];
        }

        if (true === $args['autofocus']) {
            $args['custom_attributes']['autofocus'] = 'autofocus';
        }

        if ($args['description']) {
            $args['custom_attributes']['aria-describedby'] = $args['id'] . '-description';
        }

        if (!empty($args['custom_attributes']) && is_array($args['custom_attributes'])) {
            foreach ($args['custom_attributes'] as $attribute => $attribute_value) {
                $custom_attributes[] = esc_attr($attribute) . '="' . esc_attr($attribute_value) . '"';
            }
        }

        if (!empty($args['validate'])) {
            foreach ($args['validate'] as $validate) {
                $args['class'][] = 'validate-' . $validate;
            }
        }

        $field = '';
        $label_id = $args['id'];
        $sort = $args['priority'] ? $args['priority'] : '';
        $field_container = '<div class="form-group %1$s" id="%2$s" data-priority="' . esc_attr($sort) . '">%3$s</div>';

        switch ($args['type']) {
            case 'country':
                $countries = 'shipping_country' === $key ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();

                if (1 === count($countries)) {

                    $field .= '<strong>' . current(array_values($countries)) . '</strong>';

                    $field .= '<input type="hidden" name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" value="' . current(array_keys($countries)) . '" ' . implode(' ', $custom_attributes) . ' class="country_to_state" readonly="readonly" />';

                } else {
                    $data_label = !empty($args['label']) ? 'data-label="' . esc_attr($args['label']) . '"' : '';

                    $field = '<select name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" class="country_to_state country_select ' . esc_attr(implode(' ', $args['input_class'])) . '" ' . implode(' ', $custom_attributes) . ' data-placeholder="' . esc_attr($args['placeholder'] ? $args['placeholder'] : esc_attr__('Select a country / region&hellip;', 'woocommerce')) . '" ' . $data_label . '><option value="">' . esc_html__('Select a country / region&hellip;', 'woocommerce') . '</option>';

                    foreach ($countries as $ckey => $cvalue) {
                        $field .= '<option value="' . esc_attr($ckey) . '" ' . selected($value, $ckey, false) . '>' . esc_html($cvalue) . '</option>';
                    }

                    $field .= '</select>';

                    $field .= '<noscript><button type="submit" name="woocommerce_checkout_update_totals" value="' . esc_attr__('Update country / region', 'woocommerce') . '">' . esc_html__('Update country / region', 'woocommerce') . '</button></noscript>';

                }

                break;
            case 'state':
                /* Get country this state field is representing */
                $for_country = isset($args['country']) ? $args['country'] : WC()->checkout->get_value('billing_state' === $key ? 'billing_country' : 'shipping_country');
                $states = WC()->countries->get_states($for_country);

                if (is_array($states) && empty($states)) {

                    $field_container = '<div class="form-group %1$s" id="%2$s" style="display: none">%3$s</div>';

                    $field .= '<input type="hidden" class="hidden" name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" value="" ' . implode(' ', $custom_attributes) . ' placeholder="' . esc_attr($args['placeholder']) . '" readonly="readonly" data-input-classes="' . esc_attr(implode(' ', $args['input_class'])) . '"/>';

                } elseif (!is_null($for_country) && is_array($states)) {
                    $data_label = !empty($args['label']) ? 'data-label="' . esc_attr($args['label']) . '"' : '';

                    $field .= '<select name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" class="state_select ' . esc_attr(implode(' ', $args['input_class'])) . '" ' . implode(' ', $custom_attributes) . ' data-placeholder="' . esc_attr($args['placeholder'] ? $args['placeholder'] : esc_html__('Select an option&hellip;', 'woocommerce')) . '"  data-input-classes="' . esc_attr(implode(' ', $args['input_class'])) . '" ' . $data_label . '>
						<option value="">' . esc_html__('Select an option&hellip;', 'woocommerce') . '</option>';

                    foreach ($states as $ckey => $cvalue) {
                        $field .= '<option value="' . esc_attr($ckey) . '" ' . selected($value, $ckey, false) . '>' . esc_html($cvalue) . '</option>';
                    }

                    $field .= '</select>';

                } else {

                    $field .= '<input type="text" class="input-text ' . esc_attr(implode(' ', $args['input_class'])) . '" value="' . esc_attr($value) . '"  placeholder="' . esc_attr($args['placeholder']) . '" name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" ' . implode(' ', $custom_attributes) . ' data-input-classes="' . esc_attr(implode(' ', $args['input_class'])) . '"/>';

                }

                break;
            case 'textarea':
                $field .= '<textarea name="' . esc_attr($key) . '" class="input-text ' . esc_attr(implode(' ', $args['input_class'])) . '" id="' . esc_attr($args['id']) . '" placeholder="' . esc_attr($args['placeholder']) . '" ' . (empty($args['custom_attributes']['rows']) ? ' rows="2"' : '') . (empty($args['custom_attributes']['cols']) ? ' cols="5"' : '') . implode(' ', $custom_attributes) . '>' . esc_textarea($value) . '</textarea>';

                break;
            case 'checkbox':
                $field = '<label class="checkbox ' . implode(' ', $args['label_class']) . '" ' . implode(' ', $custom_attributes) . '>
						<input type="' . esc_attr($args['type']) . '" class="input-checkbox ' . esc_attr(implode(' ', $args['input_class'])) . '" name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" value="1" ' . checked($value, 1, false) . ' /> ' . $args['label'] . $required . '</label>';

                break;
            case 'text':
            case 'password':
            case 'datetime':
            case 'datetime-local':
            case 'date':
            case 'month':
            case 'time':
            case 'week':
            case 'number':
            case 'email':
            case 'url':
            case 'tel':
                $field .= '<input type="' . esc_attr($args['type']) . '" class="input-text ' . esc_attr(implode(' ', $args['input_class'])) . '" name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" placeholder="' . esc_attr($args['placeholder']) . '"  value="' . esc_attr($value) . '" ' . implode(' ', $custom_attributes) . ' />';

                break;
            case 'hidden':
                $field .= '<input type="' . esc_attr($args['type']) . '" class="input-hidden ' . esc_attr(implode(' ', $args['input_class'])) . '" name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" value="' . esc_attr($value) . '" ' . implode(' ', $custom_attributes) . ' />';

                break;
            case 'select':
                $field = '';
                $options = '';

                if (!empty($args['options'])) {
                    foreach ($args['options'] as $option_key => $option_text) {
                        if ('' === $option_key) {
                            // If we have a blank option, select2 needs a placeholder.
                            if (empty($args['placeholder'])) {
                                $args['placeholder'] = $option_text ? $option_text : __('Choose an option', 'woocommerce');
                            }
                            $custom_attributes[] = 'data-allow_clear="true"';
                        }
                        $options .= '<option value="' . esc_attr($option_key) . '" ' . selected($value, $option_key, false) . '>' . esc_html($option_text) . '</option>';
                    }

                    $field .= '<select name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" class="select ' . esc_attr(implode(' ', $args['input_class'])) . '" ' . implode(' ', $custom_attributes) . ' data-placeholder="' . esc_attr($args['placeholder']) . '">
							' . $options . '
						</select>';
                }

                break;
            case 'radio':
                $label_id .= '_' . current(array_keys($args['options']));

                if (!empty($args['options'])) {
                    foreach ($args['options'] as $option_key => $option_text) {
                        $field .= '<input type="radio" class="input-radio ' . esc_attr(implode(' ', $args['input_class'])) . '" value="' . esc_attr($option_key) . '" name="' . esc_attr($key) . '" ' . implode(' ', $custom_attributes) . ' id="' . esc_attr($args['id']) . '_' . esc_attr($option_key) . '"' . checked($value, $option_key, false) . ' />';
                        $field .= '<label for="' . esc_attr($args['id']) . '_' . esc_attr($option_key) . '" class="radio ' . implode(' ', $args['label_class']) . '">' . esc_html($option_text) . '</label>';
                    }
                }

                break;
        }

        if (!empty($field)) {
            $field_html = '';

            if ($args['label'] && 'checkbox' !== $args['type']) {
                $field_html .= '<label for="' . esc_attr($label_id) . '" class="' . esc_attr(implode(' ', $args['label_class'])) . '">' . wp_kses_post($args['label']) . $required . '</label>';
            }

            $field_html .= '<span class="woocommerce-input-wrapper">' . $field;

            if ($args['description']) {
                $field_html .= '<span class="description" id="' . esc_attr($args['id']) . '-description" aria-hidden="true">' . wp_kses_post($args['description']) . '</span>';
            }

            $field_html .= '</span>';

            $container_class = esc_attr(implode(' ', $args['class']));
            $container_id = esc_attr($args['id']) . '_field';
            $field = sprintf($field_container, $container_class, $container_id, $field_html);
        }

        /**
         * Filter by type.
         */
        $field = apply_filters('woocommerce_form_field_' . $args['type'], $field, $key, $args, $value);

        /**
         * General filter on form fields.
         *
         * @since 3.4.0
         */
        $field = apply_filters('woocommerce_form_field', $field, $key, $args, $value);

        if ($args['return']) {
            return $field;
        } else {
            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            echo $field;
        }
    }
}

add_filter('woocommerce_order_needs_shipping_address', '__return_true');

function wpb_woo_endpoint_title($title, $id)
{

    if (is_wc_endpoint_url('orders') && in_the_loop()) {
        $title = __("Orders", "optalex");
    } elseif (is_wc_endpoint_url('edit-address') && in_the_loop()) {
        $title = __("Your addresses", "optalex");
    } elseif (is_wc_endpoint_url('payment-methods') && in_the_loop()) {
        $title = __("Payment", "optalex");
    } elseif (is_wc_endpoint_url('edit-account') && in_the_loop()) {
        $title = __("Account details", "optalex");
    } elseif (is_wc_endpoint_url('downloads') && in_the_loop()) {
        $title = __("Files to download", "optalex");
    }
    return $title;
}
add_filter('the_title', 'wpb_woo_endpoint_title', 10, 2);

class WC_Address_BookExtended extends WC_Address_Book
{
    /**
     * Adds a link/button to the my account page under the addresses for adding additional addresses to their account.
     *
     * @since 1.0.0
     */
    public function add_additional_address_button()
    {
        $user_id = get_current_user_id();
        $address_names = $this->get_address_names($user_id);

        $name = $this->set_new_address_name($address_names);

        ?>


			<a href="<?php echo esc_url($this->get_address_book_endpoint_url($name)); ?>" class="add-button">

			<span class="icon-circle-dark __gray"><i class="icon-plus"></i></span>
			<span>
			<?php echo esc_html_e('Add New Shipping Address', 'woo-address-book'); ?>
			</span>
		</a>


		<?php
}
}

function wooc_extra_register_fields()
{?>
	<p class="form-row form-row-wide <?=isset($_POST['billing_company']) && empty($_POST['billing_company']) ? "error" : ''?>">
	<label for="reg_billing_company"><?php _e('Company', 'woocommerce');?><span class="required">*</span></label>
	<input type="text" class="input-text" name="billing_company" id="reg_billing_company" value="<?php if (!empty($_POST['billing_company'])) {
    esc_attr_e($_POST['billing_company']);
}
    ?>" />
	</p>

	<p class="form-row form-row-wide <?=isset($_POST['billing_nip']) && empty($_POST['billing_nip']) ? "error" : ''?>">
	<label for="reg_billing_nip"><?php _e('NIP', 'woocommerce');?><span class="required">*</span></label>
	<input type="text" class="input-text" name="billing_nip" id="reg_billing_nip" value="<?php if (!empty($_POST['billing_nip'])) {
        esc_attr_e($_POST['billing_nip']);
    }
    ?>" />
	</p>


	<p class="form-row form-row-wide <?=isset($_POST['billing_phone']) && empty($_POST['billing_phone']) ? "error" : ''?>">
       <label for="reg_billing_phone"><?php _e('Phone', 'woocommerce');?><span class="required">*</span></label>
       <input type="text" class="input-text" name="billing_phone" id="reg_billing_phone" value="<?php esc_attr_e($_POST['billing_phone']);?>" />
       </p>
	<div class="clear"></div>
	<?php
}
add_action('woocommerce_register_form_start', 'wooc_extra_register_fields');
/**
 * register fields Validating.
 */
function wooc_validate_extra_register_fields($username, $email, $validation_errors)
{

    if (isset($_POST['billing_company']) && empty($_POST['billing_company'])) {
        $validation_errors->add('billing_company_error', __('<strong>Error</strong>: Company is required!', 'woocommerce'));

    }
    if (isset($_POST['billing_phone']) && empty($_POST['billing_phone'])) {
        $validation_errors->add('billing_phone_error', __('<strong>Error</strong>: Phone is required!', 'woocommerce'));

    }

    if (isset($_POST['billing_nip']) && empty($_POST['billing_nip'])) {
        $validation_errors->add('billing_nip_error', __('<strong>Error</strong>: NIP is required!', 'woocommerce'));
    }

    return $validation_errors;
}
add_action('woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3);

/**
 * Below code save extra fields.
 */
function wooc_save_extra_register_fields($customer_id)
{
    if (isset($_POST['billing_phone'])) {
        // Phone input filed which is used in WooCommerce
        update_user_meta($customer_id, 'billing_phone', sanitize_text_field($_POST['billing_phone']));
    }
    if (isset($_POST['billing_company'])) {

        update_user_meta($customer_id, 'billing_company', sanitize_text_field($_POST['billing_company']));
    }

    if (isset($_POST['billing_nip'])) {

        update_user_meta($customer_id, 'billing_nip', sanitize_text_field($_POST['billing_nip']));
    }

}
add_action('woocommerce_created_customer', 'wooc_save_extra_register_fields');

add_action('user_register', 'thankyou_page_redirect', 10, 1);

function thankyou_page_redirect($user_id)
{

    $thankyoupage = site_url('dziekujemy');

    wp_redirect($thankyoupage);
    exit;

}
add_action('template_redirect', 'wc_redirect_non_logged_to_login_access');
function wc_redirect_non_logged_to_login_access()
{
    global $post;
    global $user;

    //@todo dopisać warunek, żeby wpuszczał do strony zapomniałem hasło?
    // var_dump(WC()->query->get_current_endpoint());
    // var_dump(wc_lostpassword_url()).exit;

    if(!is_user_logged_in() && WC()->query->get_current_endpoint() === "lost-password"){
        return true;
        exit;
    }
	if (!is_user_logged_in() && get_option('woocommerce_myaccount_page_id') == $post->ID){
		wp_redirect('logowanie');
        exit();
	}
	//var_dump($user);
	// var_dump(wc_current_user_has_role(   'subscriber' ));


    if (is_user_logged_in() && get_option('woocommerce_myaccount_page_id') == $post->ID && !wc_current_user_has_role(   'customer' ) && !wc_current_user_has_role(   'administrator' )) {
        // if ( !is_user_logged_in() && ( is_woocommerce() || is_shop() || is_cart() || is_checkout() ) ) {



			wp_logout();
         wp_redirect('logowanie?alert');
        exit();
    }

	// CART
	if(! is_user_logged_in() && (is_cart() || is_checkout()) ){
		//wp_redirect(home_url());
		wp_redirect('logowanie');
        exit;
	}

}



function my_woocommerce_catalog_orderby( $orderby ) {
   
   
   
    unset($orderby["rating"]);
 

    return $orderby;
}
add_filter( "woocommerce_catalog_orderby", "my_woocommerce_catalog_orderby", 20 );


if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_get_items_count' ) ) {
    function yith_wcwl_get_items_count() {
     ob_start();
     ?>
     <span class="yith-wcwl-items-count">
         <i class="yith-wcwl-icon fa fa-star-o">
       <?php echo esc_html( yith_wcwl_count_all_products() ); ?>
         </i>
     </span>
     <?php
     return ob_get_clean();
    }
    add_shortcode( 'yith_wcwl_items_count', 'yith_wcwl_get_items_count' );
   }
   
   if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_ajax_update_count' ) ) {
    function yith_wcwl_ajax_update_count() {
     wp_send_json( array(
         'count' => yith_wcwl_count_all_products()
     ) );
    }
    add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
    add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
   }
   
   if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_enqueue_custom_script' ) ) {
    function yith_wcwl_enqueue_custom_script() {
     wp_add_inline_script(
         'jquery-yith-wcwl',
         "
           jQuery( function( $ ) {
             $( document ).on( 'added_to_wishlist removed_from_wishlist', function() {
               $.get( yith_wcwl_l10n.ajax_url, {
                 action: 'yith_wcwl_update_wishlist_count'
               }, function( data ) {
                 $('.yith-wcwl-items-count').html( data.count );
               } );
             } );
           } );
         "
     );
    }
    add_action( 'wp_enqueue_scripts', 'yith_wcwl_enqueue_custom_script', 20 );
   }

   add_filter( 'woocommerce_account_menu_items', 'misha_remove_my_account_dashboard' );
function misha_remove_my_account_dashboard( $menu_links ){
	
	unset( $menu_links['dashboard'] );
	return $menu_links;
	
}

add_action('template_redirect', 'misha_redirect_to_orders_from_dashboard' );

function misha_redirect_to_orders_from_dashboard(){

	if( is_account_page() && empty( WC()->query->get_current_endpoint() ) ){
		wp_safe_redirect( wc_get_account_endpoint_url( 'orders' ) );
		exit;
	}

}

/**
 * Get My Account > Orders columns.
 *
 * @since 2.6.0
 * @return array
 */
function wc_get_account_orders_columns_custom() {
	$columns = apply_filters(
		'woocommerce_account_orders_columns',
		array(
			'order-number'  => __( 'Order', 'woocommerce' ),
			'order-date'    => __( 'Date', 'woocommerce' ),
			
			'order-total'   => __( 'Total', 'woocommerce' ),
		//	'order-actions' => __( 'Actions', 'woocommerce' ),
            'order-status'  => __( 'Status', 'woocommerce' ),
		)
	);

	// Deprecated filter since 2.6.0.
	return apply_filters( 'woocommerce_my_account_my_orders_columns', $columns );
}

/**
 * Change default status
 */

add_filter( 'woocommerce_bacs_process_payment_order_status','filter_process_payment_order_status_callback', 10, 2 );
add_filter( 'woocommerce_cheque_process_payment_order_status','filter_process_payment_order_status_callback', 10, 2 );
function filter_process_payment_order_status_callback( $status, $order ) {
    return 'processing';
}



/**
 * Filter payment gateways
 */
function my_custom_available_payment_gateways( $gateways ) {
    $chosen_shipping_rates = ( isset( WC()->session ) ) ? WC()->session->get( 'chosen_shipping_methods' ) : array();

        if ( in_array( 'flat_rate:1', $chosen_shipping_rates ) ) :
        unset( $gateways['cod'] );
        
        elseif ( in_array( 'flat_rate:3', $chosen_shipping_rates ) ) :
        unset( $gateways['bacs'] );
        
        // elseif ( in_array( 'flat_rate:3', $chosen_shipping_rates ) ) :
        // unset( $gateways['cod'] );
        
        // elseif ( in_array( 'flat_rate:4', $chosen_shipping_rates ) ) :
        // unset( $gateways['bacs'] );

    endif;
    return $gateways;
}
add_filter( 'woocommerce_available_payment_gateways', 'my_custom_available_payment_gateways' );



add_filter('woocommerce_new_customer_data', 'wc_assign_custom_role', 10, 1);
 /// Set default role
function wc_assign_custom_role($args) {
  $args['role'] = 'subscriber';
  
  return $args;
}
// Email notification when change user role

function user_role_update( $user_id, $new_role ) {

    $site_url = get_bloginfo('wpurl');
    $user_info = get_userdata( $user_id );
    $to = $user_info->user_email; 
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html;\r\n";
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre><br>";
    // var_dump($user_info).exit;
    if($new_role == "customer"){
        $subject = "Optalex - Aktywacja konta";
        $message = "Witaj " .$user_info->display_name . "<br>Mamy świetną wiadomość, Twoje konto na ".$site_url." zostało zweryfikowanie pozytywnie! <a href='".$site_url."/logowanie/'>Zaloguj się</a> korzystając z danych podanych podczas rejestracji i zyskaj dostęp do pełnej oferty naszej firmy. Miłego dnia!";

        wp_mail($to, $subject, $message,$headers);


    }else{
            //subscriber
        $subject = "Optalex - Założenie konta";
        $message = "Witaj " .$user_info->display_name . " Twoje konto na stronie ".$site_url." zostało założone. Nasz zespół skontaktuje się z Tobą w celu potwierdzenia, że jesteś przedstawicielem Salonu optycznego. Po pozytywnej weryfikacji, otrzymasz dostęp do pełnej oferty.";
        // Update extra fields

         wp_mail($to, $subject, $message,$headers);

        if (isset($_POST['billing_phone'])) {
        // Phone input filed which is used in WooCommerce
            update_user_meta($user_id, 'billing_phone', sanitize_text_field($_POST['billing_phone']));
        }
        if (isset($_POST['billing_company'])) {

            update_user_meta($user_id, 'billing_company', sanitize_text_field($_POST['billing_company']));
        }

        if (isset($_POST['billing_nip'])) {

            update_user_meta($user_id, 'billing_nip', sanitize_text_field($_POST['billing_nip']));
        }


         // Send to admin

        $adminEmail = get_bloginfo('admin_email');
        $subjectAdmin = "Optalex - Nowe konto - " .$user_info->display_name;
        $messageAdmin = "Nowe konto zostało założone przez: <br> " .$user_info->display_name . "(".$user_info->user_email.") <br> Firma: ".get_user_meta(  $user_id, "billing_company", true )." <br> NIP: ".get_user_meta(  $user_id, "billing_nip", true )." <br> Telefon: ".get_user_meta($user_id, "billing_phone", true )." <br><br> Przejdź do panelu adminitratora i aktywuj konto: <a href='".$site_url."/wp-admin/user-edit.php?user_id=".$user_id."'>Edytuj użytkownika</a>";
        wp_mail($adminEmail, $subjectAdmin, $messageAdmin,$headers);

        // DEBUG
        wp_mail("z4lucki@gmail.com", $subjectAdmin, $messageAdmin,$headers);


        //sleep(4);
        $thankyoupage = site_url('dziekujemy');

        wp_redirect($thankyoupage);
        exit;
    }

   
}
add_action( 'set_user_role', 'user_role_update', 10, 2);


add_filter( 'woocommerce_order_button_text', 'woo_custom_order_button_text' ); 

function woo_custom_order_button_text() {
    return __( 'Kupuję', 'woocommerce' ); 
}

//Search form

function register_custom_widget_area() {
    register_sidebar(
    array(
    'id' => 'new-widget-area',
    'name' => esc_html__( 'My new widget area', 'theme-domain' ),
    'description' => esc_html__( 'A new widget area made for testing purposes', 'theme-domain' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="widget-title-holder"><h3 class="widget-title">',
    'after_title' => '</h3></div>'
    )
    );
    }
    add_action( 'widgets_init', 'register_custom_widget_area' );

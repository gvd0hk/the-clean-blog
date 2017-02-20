<?php
/**
 * Clean Blog functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package The_Clean_Blog
 */
if (!function_exists('cleanblog_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function cleanblog_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on components, use a find and replace
         * to change 'the-clean-blog' to the name of your theme in all the template files.
         */
        load_theme_textdomain('the-clean-blog', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Top', 'the-clean-blog'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        /*
         * Add callback for custom TinyMCE editor stylesheet.
         *
         * @link https://developer.wordpress.org/reference/functions/add_editor_style/
         */
        add_editor_style('css/editor-style.css');

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('cleanblog_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));
    }
endif;
add_action('after_setup_theme', 'cleanblog_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cleanblog_content_width()
{
    $GLOBALS['content_width'] = apply_filters('cleanblog_content_width', 750);
}
add_action('after_setup_theme', 'cleanblog_content_width', 0);

/**
 * REMOVE WP EMOJI
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

/**
 * Enqueue scripts and styles.
 */
function cleanblog_scripts()
{
    wp_enqueue_style('cleanblog-style', get_stylesheet_uri());

    wp_enqueue_style('cleanblog-bootstrap-style', get_theme_file_uri() . '/css/bootstrap.min.css');

    wp_enqueue_style('cleanblog-main-style', get_theme_file_uri() . '/css/clean-blog.css');
    
    wp_enqueue_style('cleanblog-fontawesome', get_theme_file_uri() . '/fa/css/font-awesome.min.css');    

    wp_enqueue_style('cleanblog-lora', 'https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic');

    wp_enqueue_style('cleanblog-opensans', 'https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800');

    wp_enqueue_script('cleanblog-navigation', get_theme_file_uri() . '/assets/js/navigation.js', array(), '20151215', true);

    wp_enqueue_script('cleanblog-skip-link-focus-fix', get_theme_file_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true);

    wp_enqueue_script('cleanblog-bootstrap-script', get_theme_file_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '3.3.7', true);

    wp_enqueue_script('cleanblog-script', get_theme_file_uri() . '/assets/js/clean-blog.js', array('jquery'), '3.3.7', true);

    wp_enqueue_script('cleanblog-hero', get_theme_file_uri() . '/assets/js/hero.js', array('jquery'), '', true);

    wp_enqueue_script('cleanblog-scrollto', get_theme_file_uri() . '/assets/js/scrollTo.js', array('jquery'), '2.1.2', true);

    wp_enqueue_script('cleanblog-footer', get_theme_file_uri() . '/assets/js/footer-reveal.min.js', array('jquery'), '', true);

    wp_enqueue_script('cleanblog-scrollup', get_theme_file_uri() . '/assets/js/jquery.scrollUp.min.js', array('jquery'), '2.4.1', true);
    
    if (get_post_gallery()) {
        wp_enqueue_script('cleanblog-imagelightbox', get_theme_file_uri() . '/assets/js/imagelightbox.min.js', array('jquery'), '', true);
        wp_enqueue_script('cleanblog-imagegallery', get_theme_file_uri() . '/assets/js/imagegallery.js', array('jquery', 'cleanblog-imagelightbox'), '', true);
    }
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'cleanblog_scripts');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Require Clean Blog custom functions.
 */
require get_template_directory() . '/inc/cleanblog-functions.php';
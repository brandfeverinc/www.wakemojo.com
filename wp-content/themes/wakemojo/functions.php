<?php
/**
 * WakeMojo functions and definitions
 *
 * @package WakeMojo
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'WakeMojo_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function WakeMojo_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on WakeMojo, use a find and replace
	 * to change 'WakeMojo' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'WakeMojo', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'WakeMojo' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'WakeMojo_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );
}
endif; // WakeMojo_setup
add_action( 'after_setup_theme', 'WakeMojo_setup' );


/**
 * Register widgetized area and update sidebar with default widgets.
 */
function WakeMojo_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Header Aside', 'bf' ),
		'id'            => 'header-aside',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'bf' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Aside First', 'bf' ),
		'id'            => 'footer-aside-first',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Aside Second', 'bf' ),
		'id'            => 'footer-aside-second',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Aside Third', 'bf' ),
		'id'            => 'footer-aside-third',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'WakeMojo_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function WakeMojo_scripts() {
	//wp_enqueue_style( 'WakeMojo-style', get_stylesheet_uri() );
	wp_enqueue_style( 'WakeMojo-style', get_stylesheet_directory_uri() . '/style/base.css' );
	wp_register_style('mmenu', get_template_directory_uri() . '/js/jQuery.mmenu/src/css/jquery.mmenu.all.css');
    wp_enqueue_style( 'mmenu');
	wp_enqueue_script( 'mmenu', get_template_directory_uri() . '/js/jQuery.mmenu/src/js/jquery.mmenu.min.all.js', array('jquery'), 'v4.2.4', true );
	wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/fancybox/source/jquery.fancybox.pack.js', array('jquery'));
	wp_enqueue_style( 'fancybox-style', get_template_directory_uri() . '/js/fancybox/source/jquery.fancybox.css' );
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'));
	wp_enqueue_script( 'fitColumns', get_template_directory_uri() . '/js/fit-columns.js', array('jquery', 'isotope') );
	wp_enqueue_script( 'WakeMojo-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	// load scripts
	if ( !is_admin() ) {
		$scriptdir = get_template_directory_uri();
		$scriptdir .= '/js/';
		wp_enqueue_script('modernizr', $scriptdir . 'modernizr.min.js', null, '20140408' );
		wp_enqueue_script('scripts', $scriptdir . 'scripts.js', array('jquery'), '20140408' );
		wp_enqueue_script('cycle2', $scriptdir . 'jquery.cycle2.min.js', array('jquery'), 'v20130709' );
 	}
}
add_action( 'wp_enqueue_scripts', 'WakeMojo_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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


// convert Gravity Forms admin notifications to text format instead of the default html format
add_filter('gform_notification', 'change_notification_format', 10, 3);
function change_notification_format( $notification, $form, $entry ) {
	$notification['message_format'] = "text";
	return $notification;
}

// In case you need to do it only for some particular Notification, you can use this function instead:
// add_filter('gform_notification', 'change_notification_format', 10, 3);
// function change_notification_format( $notification, $form, $entry ) {
// 	if($notification['name']=='Admin Notification'){
// 		$notification['message_format'] = "text";
// 	}
// 	return $notification;
// }

add_action( 'admin_footer-edit-tags.php', 'wpse_56569_remove_cat_tag_description' );

function wpse_56569_remove_cat_tag_description(){
    global $current_screen;
    switch ( $current_screen->id ) 
    {
        case 'edit-category':
            // WE ARE AT /wp-admin/edit-tags.php?taxonomy=category
            // OR AT /wp-admin/edit-tags.php?action=edit&taxonomy=category&tag_ID=1&post_type=post
            break;
        case 'edit-post_tag':
            // WE ARE AT /wp-admin/edit-tags.php?taxonomy=post_tag
            // OR AT /wp-admin/edit-tags.php?action=edit&taxonomy=post_tag&tag_ID=3&post_type=post
            break;
    }
    ?>
    <script type="text/javascript">
    jQuery(document).ready( function($) {
        $('#tag-description').parent().remove();
    });
    </script>
    <?php
}

add_image_size( 'homepage', 230, 150, true );








<?php
/**
 * wp_elem_stellar functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wp_elem_stellar
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

function wp_elem_stellar_setup() {
	/**
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on wp_elem_stellar, use a find and replace
		* to change 'wp_elem_stellar' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'wp_elem_stellar', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/**
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/**
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'Header' => esc_html__( 'Primary', 'wp_elem_stellar' ),
		)
	);

	/**
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'wp_elem_stellar_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'wp_elem_stellar_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */

function wp_elem_stellar_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wp_elem_stellar_content_width', 640 );
}
add_action( 'after_setup_theme', 'wp_elem_stellar_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function wp_elem_stellar_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'wp_elem_stellar' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'wp_elem_stellar' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'wp_elem_stellar_widgets_init' );


function wp_elem_stellar_scripts() {
	wp_enqueue_style( 'wp_elem_stellar-style', get_template_directory_uri(), array(), _S_VERSION );
    wp_enqueue_style( 'wp_elem_stellar-main', get_template_directory_uri().'/assets/css/main.css', array(), _S_VERSION );
    wp_enqueue_style( 'fontawesome_all', get_stylesheet_uri().'/assets/css/fontawesome-all.min.css', array(), _S_VERSION );
    wp_style_add_data( 'wp_elem_stellar-style', 'rtl', 'replace' );

	wp_enqueue_script( 'wp_elem_stellar-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'scrollex', get_template_directory_uri() . '/assets/js/jquery.scrollex.min.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'scrolly', get_template_directory_uri() . '/assets/js/jquery.scrolly.min.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'browser', get_template_directory_uri() . '/assets/js/browser.min.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'brakepoints', get_template_directory_uri() . '/assets/js/breakpoints.min.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'util', get_template_directory_uri() . '/assets/js/util.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'wp_elem_stellar_main', get_template_directory_uri() . '/assets/js/main.js', array(), _S_VERSION, true );

    /*
     * if comments exist
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    */
}
add_action( 'wp_enqueue_scripts', 'wp_elem_stellar_scripts' );

/**
 * Implement the Custom Header feature.
 */

require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */

require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */

require get_template_directory() . '/inc/template-functions.php';


/**
 * REDUX (sample-config.php from plugin/redux../sample/sample-config)
 */

require get_template_directory() . '/inc/redux-config.php';


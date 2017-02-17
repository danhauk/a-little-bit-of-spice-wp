<?php
/**
 * A Little Bit of Spice functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package A_Little_Bit_of_Spice
 */

if ( ! function_exists( 'a_little_bit_of_spice_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function a_little_bit_of_spice_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on A Little Bit of Spice, use a find and replace
	 * to change 'a-little-bit-of-spice' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'a-little-bit-of-spice', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'a-little-bit-of-spice' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'a_little_bit_of_spice_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Set up the custom logo feature
	add_theme_support( 'custom-logo' );
	add_filter( 'get_custom_logo', 'get_my_custom_logo' );

	function get_my_custom_logo( $blog_id = 0 ) {
	  $html = '';
		$custom_logo_id = get_theme_mod( 'custom_logo' );

		// We have a logo. Logo is go.
		if ( $custom_logo_id ) {
			$custom_logo = wp_get_attachment_image_src( $custom_logo_id, 'full', false );
			$custom_logo_url = $custom_logo[0];
			$html = sprintf( '<img src="%1$s" alt="%2$s"/>', $custom_logo_url, get_bloginfo( 'name' ) );
		}

		// If no logo is set but we're in the Customizer, leave a placeholder (needed for the live preview).
		elseif ( is_customize_preview() ) {
			$html = sprintf( '<img class="custom-logo"/>' );
		}

		return $html;
	}

	/**
	 * WP Ultimate Recipe custom template
	 */
	add_filter( 'wpurp_output_recipe_block_recipe-ingredients', 'wpurp_custom_ingredients', 10, 3 );
	add_filter( 'wpurp_output_recipe', 'wpurp_custom_template_test', 10, 2 );
}
endif;
add_action( 'after_setup_theme', 'a_little_bit_of_spice_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function a_little_bit_of_spice_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'a_little_bit_of_spice_content_width', 640 );
}
add_action( 'after_setup_theme', 'a_little_bit_of_spice_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function a_little_bit_of_spice_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'a-little-bit-of-spice' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'a-little-bit-of-spice' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'a_little_bit_of_spice_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function a_little_bit_of_spice_scripts() {
	wp_enqueue_style( 'a-little-bit-of-spice-font', get_template_directory_uri() . '/font.css' );
	wp_enqueue_style( 'a-little-bit-of-spice-style', get_template_directory_uri() . '/style.min.css' );

	wp_enqueue_script( 'a-little-bit-of-spice-navigation', get_template_directory_uri() . '/js/navigation.min.js', array(), '20151215', true );

	wp_enqueue_script( 'a-little-bit-of-spice-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.min.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'a_little_bit_of_spice_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
 * Custom Authors Widget
 */
require get_template_directory() . '/inc/authors-widget.php';

require get_template_directory() . '/inc/recipe-template.php';

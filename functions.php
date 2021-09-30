<?php

/**
 * FWD School Starter Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package FWD_School_Starter_Theme
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

if (!function_exists('fwdshool_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function fwdshool_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on FWD School Starter Theme, use a find and replace
		 * to change 'fwdshool' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('fwdshool', get_template_directory() . '/languages');

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

		// --- Custom Crop Sizes --- //
		// Portrait Student Taxonomy Size - 200px width, 300px height, hard crop
		// Used in template taxonomy-fwd-student-category.php
		add_image_size('portrait-student-taxonomy', 200, 300, true);

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__('Primary', 'fwdshool'),
			)
		);

		/*
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
				'fwdshool_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

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

		/**
		 * Add support for Block Editor features.
		 *
		 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/
		 */
		add_theme_support('wp-block-styles');
		add_theme_support('responsive-embeds');
		add_theme_support('align-wide'); //add support for wide/full width alignment feature
	}
endif;
add_action('after_setup_theme', 'fwdshool_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fwdshool_content_width()
{
	$GLOBALS['content_width'] = apply_filters('fwdshool_content_width', 640);
}
add_action('after_setup_theme', 'fwdshool_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fwdshool_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'fwdshool'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'fwdshool'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'fwdshool_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function fwdshool_scripts()
{
	wp_enqueue_style(
		'fwdschool-googlefonts', //handle 
		'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Ubuntu:wght@400;700&display=swap', //src 
		array(), //dependencies
		null //version number needs to be null for Google Fonts
	);

	wp_enqueue_style('fwdshool-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('fwdshool-style', 'rtl', 'replace');

	wp_enqueue_script('fwdshool-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'fwdshool_scripts');

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
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Custom Post Types & Taxonomies
 */
require get_template_directory() . '/inc/cpt-taxonomy.php';

//Change the default excerpt length only for student list template to 25
function fwd_excerpt_length($length)
{
	if (is_post_type_archive('fwd-student')) {
		return 25;
	}
	return $length;
}

add_filter('excerpt_length', 'fwd_excerpt_length', 999); //999 is the priority

//Change the default excerpt ending only for student list template
//Ideas coming from: https://developer.wordpress.org/reference/functions/is_post_type_archive/
function fwd_excerpt_more($more)
{
	if (is_post_type_archive('fwd-student')) {
		$more = ' <a class="read-more" href="' . get_permalink() . '">Read more about the student...</a>';
		return $more;
	}
	return $more;
}

add_filter('excerpt_more', 'fwd_excerpt_more');


//Remove the archive prefix only on the custom taxonomy for student CPT...
//Only show the title for the taxonomy of the student CPT...
function fwd_archive_title_prefix($prefix)
{
	if (is_tax('fwd-student-category')) {
		return;
	} else {
		return $prefix;
	}
}
add_filter('get_the_archive_title_prefix', 'fwd_archive_title_prefix');

//Modify titles on the archive pages
//On student CPT archive page, show 'The Class', and add 'Students' after the title for the taxonomy of the student CPT...
//Ideas coming from: https://developer.wordpress.org/reference/functions/get_the_archive_title/
function modify_archive_title($title)
{
	if (is_tax('fwd-student-category')) {
		$var = ' Students';
		return $title . $var;
	}
	if (get_post_type() === 'fwd-student') {
		$var = "The Class";

		return $var;
	}
}

add_filter('get_the_archive_title', 'modify_archive_title', 99);





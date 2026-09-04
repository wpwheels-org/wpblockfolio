<?php
/**
 * WPBlockfolio functions and definitions.
 *
 * @package WPBlockfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'WPBLOCKFOLIO_VERSION', '1.0.0' );

/**
 * Theme setup.
 */
function wpblockfolio_setup() {
	// Make the theme available for translation.
	load_theme_textdomain( 'wpblockfolio', get_template_directory() . '/languages' );

	// Core block-theme support.
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );

	// Custom logo support.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 48,
			'width'       => 160,
			'flex-height' => true,
			'flex-width'  => true,
			'unlink-homepage-logo' => true,
		)
	);

	// Featured image sizes used across the portfolio & blog patterns.
	set_post_thumbnail_size( 800, 800, true );
	add_image_size( 'wpblockfolio-portfolio', 600, 600, true );
	add_image_size( 'wpblockfolio-blog-card', 500, 340, true );

	add_editor_style( 'assets/css/editor-style.css' );
}
add_action( 'after_setup_theme', 'wpblockfolio_setup' );

/**
 * Enqueue front-end assets.
 */
function wpblockfolio_enqueue_assets() {
	// Theme styles that theme.json cannot express (progress bars, timeline, cards, hovers).
	wp_enqueue_style(
		'wpblockfolio-style',
		get_stylesheet_uri(),
		array(),
		WPBLOCKFOLIO_VERSION
	);

	wp_enqueue_style(
		'wpblockfolio-custom',
		get_template_directory_uri() . '/assets/build/css/custom.css',
		array( 'wpblockfolio-style' ),
		WPBLOCKFOLIO_VERSION
	);

	wp_enqueue_script(
		'wpblockfolio-script',
		get_template_directory_uri() . '/assets/build/js/main.js',
		array(),
		WPBLOCKFOLIO_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'wpblockfolio_enqueue_assets' );

/**
 * Load the same fonts + custom styling in the block editor.
 */
function wpblockfolio_editor_assets() {
	wp_enqueue_style(
		'wpblockfolio-editor-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap',
		array(),
		null
	);
	wp_enqueue_style(
		'wpblockfolio-editor-custom',
		get_template_directory_uri() . '/assets/build/css/custom.css',
		array(),
		WPBLOCKFOLIO_VERSION
	);
}
add_action( 'enqueue_block_editor_assets', 'wpblockfolio_editor_assets' );

/**
 * Register custom block pattern categories so the patterns below
 * show up grouped nicely inside the Pattern inserter.
 */
function wpblockfolio_pattern_categories() {
	register_block_pattern_category(
		'wpblockfolio-sections',
		array( 'label' => __( 'WPBlockfolio Sections', 'wpblockfolio' ) )
	);
}
add_action( 'init', 'wpblockfolio_pattern_categories' );

/**
 * Register navigation menu (used as a fallback / for classic-menu compatibility
 * and so the Navigation block has a menu to reference on first activation).
 */
function wpblockfolio_menus() {
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'wpblockfolio' ),
		)
	);
}
add_action( 'after_setup_theme', 'wpblockfolio_menus' );

/**
 * Widen the default "excerpt more" behaviour used in the Blog / Recent Posts pattern.
 */
function wpblockfolio_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'wpblockfolio_excerpt_length' );

function wpblockfolio_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'wpblockfolio_excerpt_more' );

/**
 * Register skill/progress block pattern data as reusable via block patterns
 * (patterns themselves are auto-registered by WordPress from /patterns/*.php,
 * each file's header comment declares its slug, title & categories).
 */

require_once get_theme_file_path('/inc/inc.php');
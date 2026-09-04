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
 * Register theme supports, image sizes, translations, and editor styles.
 *
 * Hooked to `after_setup_theme`. Enables the block-theme feature set
 * (block styles, editor styles, wide alignment, post thumbnails, HTML5
 * markup, and a flexible custom logo), loads the theme text domain from
 * `/languages`, and defines the featured-image sizes used by the
 * portfolio and blog patterns.
 *
 * @return void
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
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );

	// Custom logo support.
	add_theme_support(
		'custom-logo',
		[
			'height'               => 48,
			'width'                => 160,
			'flex-height'          => true,
			'flex-width'           => true,
			'unlink-homepage-logo' => true,
		]
	);

	// Featured image sizes used across the portfolio & blog patterns.
	set_post_thumbnail_size( 800, 800, true );
	add_image_size( 'wpblockfolio-portfolio', 600, 600, true );
	add_image_size( 'wpblockfolio-blog-card', 500, 340, true );

	add_editor_style( 'assets/css/editor-style.css' );
}
add_action( 'after_setup_theme', 'wpblockfolio_setup' );

/**
 * Read the webpack-generated asset manifest for the theme's main bundle.
 *
 * Returns the `dependencies` and `version` written to
 * `assets/build/js/main.asset.php` by @wordpress/scripts, falling back to
 * an empty dependency list and `WPBLOCKFOLIO_VERSION` when the file is
 * missing (e.g. before a first build).
 *
 * @return array{dependencies: string[], version: string} Asset manifest.
 */
function wpblockfolio_asset_meta() {
	if ( file_exists( get_template_directory() . '/assets/build/js/main.asset.php' ) ) {
		return require get_template_directory() . '/assets/build/js/main.asset.php';
	}

	return [
		'dependencies' => [],
		'version'      => WPBLOCKFOLIO_VERSION,
	];
}

/**
 * Enqueue front-end styles and scripts.
 *
 * Hooked to `wp_enqueue_scripts`. Loads the root `style.css`, the compiled
 * `assets/build/css/custom.css` (dependent on the root stylesheet) for the
 * rules theme.json cannot express, and the compiled `assets/build/js/main.js`
 * in the footer. The script's dependencies and cache-busting version come
 * from `assets/build/js/main.asset.php`, and `custom.css` is registered with
 * an RTL counterpart (`custom-rtl.css`) served automatically on RTL locales.
 *
 * @return void
 */
function wpblockfolio_enqueue_assets() {
	$asset = wpblockfolio_asset_meta();

	// Theme styles that theme.json cannot express (progress bars, timeline, cards, hovers).
	wp_enqueue_style(
		'wpblockfolio-style',
		get_stylesheet_uri(),
		[],
		WPBLOCKFOLIO_VERSION
	);

	wp_enqueue_style(
		'wpblockfolio-custom',
		get_template_directory_uri() . '/assets/build/css/custom.css',
		[ 'wpblockfolio-style' ],
		$asset['version']
	);
	wp_style_add_data( 'wpblockfolio-custom', 'rtl', 'replace' );

	wp_enqueue_script(
		'wpblockfolio-script',
		get_template_directory_uri() . '/assets/build/js/main.js',
		$asset['dependencies'],
		$asset['version'],
		true
	);
}
add_action( 'wp_enqueue_scripts', 'wpblockfolio_enqueue_assets' );

/**
 * Enqueue the Google Fonts and compiled custom stylesheet inside the block editor.
 *
 * Hooked to `enqueue_block_editor_assets` so the editor canvas matches the
 * front end. The font stylesheet is enqueued with a null version; the custom
 * stylesheet is versioned from `assets/build/js/main.asset.php` and registered
 * with an RTL counterpart (`custom-rtl.css`) served automatically on RTL
 * locales.
 *
 * @return void
 */
function wpblockfolio_editor_assets() {
	$asset = wpblockfolio_asset_meta();

	wp_enqueue_style(
		'wpblockfolio-editor-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap',
		[],
		null
	);
	wp_enqueue_style(
		'wpblockfolio-editor-custom',
		get_template_directory_uri() . '/assets/build/css/custom.css',
		[],
		$asset['version']
	);
	wp_style_add_data( 'wpblockfolio-editor-custom', 'rtl', 'replace' );
}
add_action( 'enqueue_block_editor_assets', 'wpblockfolio_editor_assets' );

/**
 * Register the theme's custom block pattern category.
 *
 * Hooked to `init`. Adds the "WPBlockfolio Sections" category so the
 * theme's bundled patterns are grouped together in the pattern inserter.
 *
 * @return void
 */
function wpblockfolio_pattern_categories() {
	register_block_pattern_category(
		'wpblockfolio-sections',
		[ 'label' => __( 'WPBlockfolio Sections', 'wpblockfolio' ) ]
	);
}
add_action( 'init', 'wpblockfolio_pattern_categories' );

/**
 * Register the theme's navigation menu locations.
 *
 * Hooked to `after_setup_theme`. Registers a single "primary" location used
 * as a fallback for classic-menu compatibility and so the Navigation block
 * has a menu to reference on first activation.
 *
 * @return void
 */
function wpblockfolio_menus() {
	register_nav_menus(
		[
			'primary' => __( 'Primary Menu', 'wpblockfolio' ),
		]
	);
}
add_action( 'after_setup_theme', 'wpblockfolio_menus' );

/**
 * Force auto-generated excerpts to 20 words.
 *
 * Filters `excerpt_length` for the Blog / Recent Posts pattern.
 *
 * @param int $length Default excerpt length in words.
 * @return int Excerpt length in words.
 */
function wpblockfolio_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'wpblockfolio_excerpt_length' );

/**
 * Replace the trailing "[...]" excerpt marker with an ellipsis.
 *
 * Filters `excerpt_more` for the Blog / Recent Posts pattern.
 *
 * @param string $more Default "read more" string appended to the excerpt.
 * @return string The replacement string appended to the excerpt.
 */
function wpblockfolio_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'wpblockfolio_excerpt_more' );

/**
 * Register skill/progress block pattern data as reusable via block patterns
 * (patterns themselves are auto-registered by WordPress from /patterns/*.php,
 * each file's header comment declares its slug, title & categories).
 */

require_once get_theme_file_path( '/inc/inc.php' );

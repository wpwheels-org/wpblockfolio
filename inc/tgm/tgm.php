<?php
/**
 * Plugin recommendation
 *
 * @package WPBlockfolio 
 */

// Load TGM library.
require_once get_theme_file_path( 'inc/tgm/class-tgm-plugin-activation.php' );

if ( ! function_exists( 'wpblockfolio_recommended_plugins' ) ) :

	/**
	 * Register the theme's recommended plugins with TGM Plugin Activation.
	 *
	 * Hooked to `tgmpa_register`. Currently recommends (does not require)
	 * Contact Form 7 from the WordPress.org repository.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function wpblockfolio_recommended_plugins() {
		$plugins = [
			[
				'name'     => esc_html__( 'Contact Form 7', 'wpblockfolio' ),
				'slug'     => 'contact-form-7',
				'required' => false,
			],
		];

		$config = [];

		tgmpa( $plugins, $config );
	}

endif;

add_action( 'tgmpa_register', 'wpblockfolio_recommended_plugins' );

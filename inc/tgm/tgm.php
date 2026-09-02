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
	 * Register recommended plugins.
	 *
	 * @since 1.0.0
	 */
	function wpblockfolio_recommended_plugins() {
		$plugins = array(
			array(
				'name'     => esc_html__( 'Contact Form 7', 'wpblockfolio' ),
				'slug'     => 'contact-form-7',
				'required' => false,
			),
		);

		$config = array();

		tgmpa( $plugins, $config );
	}

endif;

add_action( 'tgmpa_register', 'wpblockfolio_recommended_plugins' );

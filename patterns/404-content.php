<?php
/**
 * Title: 404 Content
 * Slug: wpblockfolio/404-content
 * Description: The 404 error page content — heading, CTA buttons, search, and quick links, all using site-relative URLs.
 * Keywords: 404, error, not found
 * Viewport width: 1000
 */

$wpblockfolio_home = home_url( '/' );
?>
<!-- wp:group {"tagName":"main","align":"full","className":"wpblockfolio-404","style":{"spacing":{"padding":{"top":"5rem","bottom":"6rem"}}},"layout":{"type":"constrained","contentSize":"620px"}} -->
<main class="wp-block-group alignfull wpblockfolio-404" style="padding-top:5rem;padding-bottom:6rem">

	<!-- wp:paragraph {"align":"center","className":"wpblockfolio-eyebrow wpblockfolio-404-eyebrow"} -->
	<p class="has-text-align-center wpblockfolio-eyebrow wpblockfolio-404-eyebrow"><?php esc_html_e( 'Error 404', 'wpblockfolio' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:paragraph {"align":"center","className":"wpblockfolio-404-code"} -->
	<p class="has-text-align-center wpblockfolio-404-code">404</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"textAlign":"center","level":1,"className":"wpblockfolio-404-title","style":{"spacing":{"margin":{"top":"0.25rem","bottom":"1rem"}}}} -->
	<h1 class="wp-block-heading has-text-align-center wpblockfolio-404-title" style="margin-top:0.25rem;margin-bottom:1rem"><?php esc_html_e( 'This page took a wrong turn', 'wpblockfolio' ); ?></h1>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center","textColor":"body-text","style":{"spacing":{"margin":{"bottom":"2rem"}}}} -->
	<p class="has-text-align-center has-body-text-color has-text-color" style="margin-bottom:2rem"><?php esc_html_e( 'The page you\'re looking for was moved, renamed, or never existed. Let\'s get you back on track.', 'wpblockfolio' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":"1rem","margin":{"bottom":"2.5rem"}}}} -->
	<div class="wp-block-buttons" style="margin-bottom:2.5rem">
		<!-- wp:button {"backgroundColor":"primary"} -->
		<div class="wp-block-button"><a class="wp-block-button__link has-primary-background-color has-background wp-element-button" href="<?php echo esc_url( $wpblockfolio_home ); ?>"><?php esc_html_e( 'Back to home', 'wpblockfolio' ); ?></a></div>
		<!-- /wp:button -->

		<!-- wp:button {"className":"is-style-outline"} -->
		<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $wpblockfolio_home . '#portfolio' ); ?>"><?php esc_html_e( 'Browse work', 'wpblockfolio' ); ?></a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->

	<!-- wp:search {"label":"<?php echo esc_attr_x( 'Search', 'search form label', 'wpblockfolio' ); ?>","showLabel":false,"placeholder":"<?php echo esc_attr__( 'Search the site…', 'wpblockfolio' ); ?>","buttonText":"<?php echo esc_attr_x( 'Search', 'search button text', 'wpblockfolio' ); ?>","buttonPosition":"button-inside","className":"wpblockfolio-404-search"} /-->

	<!-- wp:paragraph {"align":"center","className":"wpblockfolio-404-links","style":{"spacing":{"margin":{"top":"2.5rem"}},"typography":{"fontSize":"0.85rem"}}} -->
	<p class="has-text-align-center wpblockfolio-404-links" style="margin-top:2.5rem;font-size:0.85rem">
		<a href="<?php echo esc_url( $wpblockfolio_home ); ?>"><?php esc_html_e( 'Home', 'wpblockfolio' ); ?></a>
		<a href="<?php echo esc_url( $wpblockfolio_home . '#about' ); ?>"><?php esc_html_e( 'About', 'wpblockfolio' ); ?></a>
		<a href="<?php echo esc_url( $wpblockfolio_home . '#portfolio' ); ?>"><?php esc_html_e( 'Work', 'wpblockfolio' ); ?></a>
		<a href="<?php echo esc_url( $wpblockfolio_home . '#blog' ); ?>"><?php esc_html_e( 'Blog', 'wpblockfolio' ); ?></a>
		<a href="<?php echo esc_url( $wpblockfolio_home . '#contact' ); ?>"><?php esc_html_e( 'Contact', 'wpblockfolio' ); ?></a>
	</p>
	<!-- /wp:paragraph -->

</main>
<!-- /wp:group -->
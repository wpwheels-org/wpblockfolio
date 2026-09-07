<?php
/**
 * Title: 404 Content
 * Slug: wpblockfolio/404-content
 * Description: The 404 error page content — heading, CTA buttons, search, and quick links, all using site-relative URLs.
 * Keywords: 404, error, not found
 * Viewport width: 1000
 */

$home = home_url( '/' );
?>
<!-- wp:group {"tagName":"main","align":"full","className":"wpblockfolio-404","style":{"spacing":{"padding":{"top":"5rem","bottom":"6rem"}}},"layout":{"type":"constrained","contentSize":"620px"}} -->
<main class="wp-block-group alignfull wpblockfolio-404" style="padding-top:5rem;padding-bottom:6rem">

	<!-- wp:paragraph {"align":"center","className":"wpblockfolio-eyebrow wpblockfolio-404-eyebrow"} -->
	<p class="has-text-align-center wpblockfolio-eyebrow wpblockfolio-404-eyebrow">Error 404</p>
	<!-- /wp:paragraph -->

	<!-- wp:paragraph {"align":"center","className":"wpblockfolio-404-code"} -->
	<p class="has-text-align-center wpblockfolio-404-code">404</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"textAlign":"center","level":1,"className":"wpblockfolio-404-title","style":{"spacing":{"margin":{"top":"0.25rem","bottom":"1rem"}}}} -->
	<h1 class="wp-block-heading has-text-align-center wpblockfolio-404-title" style="margin-top:0.25rem;margin-bottom:1rem">This page took a wrong turn</h1>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center","textColor":"body-text","style":{"spacing":{"margin":{"bottom":"2rem"}}}} -->
	<p class="has-text-align-center has-body-text-color has-text-color" style="margin-bottom:2rem">The page you're looking for was moved, renamed, or never existed. Let's get you back on track.</p>
	<!-- /wp:paragraph -->

	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":"1rem","margin":{"bottom":"2.5rem"}}}} -->
	<div class="wp-block-buttons" style="margin-bottom:2.5rem">
		<!-- wp:button {"backgroundColor":"primary"} -->
		<div class="wp-block-button"><a class="wp-block-button__link has-primary-background-color has-background wp-element-button" href="<?php echo esc_url( $home ); ?>">Back to home</a></div>
		<!-- /wp:button -->

		<!-- wp:button {"className":"is-style-outline"} -->
		<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $home . '#portfolio' ); ?>">Browse work</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->

	<!-- wp:search {"label":"Search","showLabel":false,"placeholder":"Search the site…","buttonText":"Search","buttonPosition":"button-inside","className":"wpblockfolio-404-search"} /-->

	<!-- wp:paragraph {"align":"center","className":"wpblockfolio-404-links","style":{"spacing":{"margin":{"top":"2.5rem"}},"typography":{"fontSize":"0.85rem"}}} -->
	<p class="has-text-align-center wpblockfolio-404-links" style="margin-top:2.5rem;font-size:0.85rem">
		<a href="<?php echo esc_url( $home ); ?>">Home</a>
		<a href="<?php echo esc_url( $home . '#about' ); ?>">About</a>
		<a href="<?php echo esc_url( $home . '#portfolio' ); ?>">Work</a>
		<a href="<?php echo esc_url( $home . '#blog' ); ?>">Blog</a>
		<a href="<?php echo esc_url( $home . '#contact' ); ?>">Contact</a>
	</p>
	<!-- /wp:paragraph -->

</main>
<!-- /wp:group -->
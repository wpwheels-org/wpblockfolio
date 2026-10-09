<?php
/**
 * Title: Hero — Intro Panel
 * Slug: wpblockfolio/hero
 * Categories: wpblockfolio-sections
 * Description: Bold gradient introduction panel with heading, bio and call-to-action buttons. Pairs with the "Sidebar — Profile Card" pattern, which carries the photo, name and navigation.
 * Keywords: hero, intro
 * Viewport width: 1000
 */
?>
<!-- wp:group {"anchor":"home","backgroundColor":"primary","textColor":"white","className":"wpblockfolio-hero-panel wpblockfolio-pad-x wpblockfolio-pad-y"} -->
<div id="home" class="wp-block-group wpblockfolio-hero-panel wpblockfolio-pad-x wpblockfolio-pad-y has-white-color has-primary-background-color has-text-color has-background">

	<!-- wp:paragraph {"className":"has-white-color has-text-color wpblockfolio-hero-eyebrow"} -->
	<p class="has-white-color has-text-color wpblockfolio-hero-eyebrow"><?php esc_html_e( 'WELCOME TO MY PORTFOLIO', 'wpblockfolio' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":1,"textColor":"white","fontSize":"huge"} -->
	<h1 class="wp-block-heading has-white-color has-text-color has-huge-font-size"><?php esc_html_e( 'I\'m Alex Rivera.', 'wpblockfolio' ); ?></h1>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"className":"has-white-color has-text-color wpblockfolio-hero-bio"} -->
	<p class="has-white-color has-text-color wpblockfolio-hero-bio"><?php esc_html_e( 'I design and build clean, purposeful digital products — from early concept sketches to fully shipped, production-ready interfaces.', 'wpblockfolio' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:buttons -->
	<div class="wp-block-buttons">
		<!-- wp:button {"backgroundColor":"white","textColor":"primary"} -->
		<div class="wp-block-button"><a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background wp-element-button" href="#portfolio"><?php esc_html_e( 'View Portfolio', 'wpblockfolio' ); ?></a></div>
		<!-- /wp:button -->

		<!-- wp:button {"className":"wpblockfolio-btn-outline-white"} -->
		<div class="wp-block-button wpblockfolio-btn-outline-white"><a class="wp-block-button__link wp-element-button" href="#contact"><?php esc_html_e( 'Hire Me', 'wpblockfolio' ); ?></a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->

</div>
<!-- /wp:group -->

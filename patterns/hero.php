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
<!-- wp:group {"anchor":"home","backgroundColor":"primary","textColor":"white","className":"fh-hero-panel fh-pad-x fh-pad-y"} -->
<div id="home" class="wp-block-group fh-hero-panel fh-pad-x fh-pad-y has-white-color has-primary-background-color has-text-color has-background">

	<!-- wp:paragraph {"className":"has-white-color has-text-color fh-hero-eyebrow"} -->
	<p class="has-white-color has-text-color fh-hero-eyebrow">WELCOME TO MY PORTFOLIO</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":1,"textColor":"white","fontSize":"huge"} -->
	<h1 class="wp-block-heading has-white-color has-text-color has-huge-font-size">I'm Alex Rivera.</h1>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"className":"has-white-color has-text-color fh-hero-bio"} -->
	<p class="has-white-color has-text-color fh-hero-bio">I design and build clean, purposeful digital products — from early concept sketches to fully shipped, production-ready interfaces.</p>
	<!-- /wp:paragraph -->

	<!-- wp:buttons -->
	<div class="wp-block-buttons">
		<!-- wp:button {"backgroundColor":"white","textColor":"primary"} -->
		<div class="wp-block-button"><a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background wp-element-button" href="#portfolio">View Portfolio</a></div>
		<!-- /wp:button -->

		<!-- wp:button {"className":"fh-btn-outline-white"} -->
		<div class="wp-block-button fh-btn-outline-white"><a class="wp-block-button__link wp-element-button" href="#contact">Hire Me</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->

</div>
<!-- /wp:group -->

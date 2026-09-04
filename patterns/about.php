<?php
/**
 * Title: About Me
 * Slug: wpblockfolio/about
 * Categories: wpblockfolio-sections
 * Description: Photo, greeting, quick-fact list (name, location, birthday, email) and CV / hire buttons.
 * Keywords: about, bio, cv
 * Viewport width: 1400
 */
?>
<!-- wp:group {"anchor":"about","align":"wide","className":"fh-card fh-pad-x fh-pad-y","style":{"spacing":{"margin":{"top":"3rem"}}}} -->
<div id="about" class="wp-block-group alignwide fh-card fh-pad-x fh-pad-y" style="margin-top:3rem">

	<!-- wp:paragraph {"className":"fh-eyebrow"} -->
	<p class="fh-eyebrow">About Me</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":2,"style":{"spacing":{"margin":{"top":"0.5rem","bottom":"2rem"}}}} -->
	<h2 class="wp-block-heading" style="margin-top:0.5rem;margin-bottom:2rem">A little about who I am</h2>
	<!-- /wp:heading -->

	<!-- wp:columns {"verticalAlignment":"top","style":{"spacing":{"blockGap":{"left":"2.5rem"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-top">

		<!-- wp:column {"verticalAlignment":"top","width":"180px"} -->
		<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:180px">
			<!-- wp:image {"sizeSlug":"large","className":"fh-about-avatar"} -->
			<figure class="wp-block-image size-large fh-about-avatar"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/build/images/placeholder.png'); ?>" alt="Portrait of Alex Rivera"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"top"} -->
		<div class="wp-block-column is-vertically-aligned-top">

			<!-- wp:heading {"level":3,"fontSize":"large"} -->
			<h3 class="wp-block-heading has-large-font-size">Hello, I'm Alex</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"textColor":"body-text"} -->
			<p class="has-body-text-color has-text-color">I'm a product designer and front-end developer based in Berlin, Germany. I care about accessible, well-crafted interfaces and I enjoy turning early ideas into polished, working software — from small business sites to full web applications.</p>
			<!-- /wp:paragraph -->

			<!-- wp:columns {"style":{"spacing":{"margin":{"top":"1.5rem"}}}} -->
			<div class="wp-block-columns" style="margin-top:1.5rem">
				<!-- wp:column -->
				<div class="wp-block-column">
					<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem"}}} --><p style="font-size:0.9rem"><strong>Name:</strong> Alex Rivera</p><!-- /wp:paragraph -->
					<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem"}}} --><p style="font-size:0.9rem"><strong>Location:</strong> Berlin, Germany</p><!-- /wp:paragraph -->
				</div>
				<!-- /wp:column -->
				<!-- wp:column -->
				<div class="wp-block-column">
					<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem"}}} --><p style="font-size:0.9rem"><strong>Birthday:</strong> 14 August 1998</p><!-- /wp:paragraph -->
					<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem"}}} --><p style="font-size:0.9rem"><strong>Email:</strong> hello@alexrivera.dev</p><!-- /wp:paragraph -->
				</div>
				<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->

			<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"1.5rem"}}}} -->
			<div class="wp-block-buttons" style="margin-top:1.5rem">
				<!-- wp:button {"backgroundColor":"accent"} -->
				<div class="wp-block-button"><a class="wp-block-button__link has-accent-background-color has-background wp-element-button" href="#">Download CV</a></div>
				<!-- /wp:button -->

				<!-- wp:button {"className":"is-style-outline"} -->
				<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="#contact">Hire Me</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->

		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->

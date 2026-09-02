<?php
/**
 * Title: Testimonials
 * Slug: wpblockfolio/testimonials
 * Categories: wpblockfolio-sections
 * Description: Two-column client quotes with avatar, name and role.
 * Keywords: testimonials, reviews, quotes, clients
 * Viewport width: 1400
 */
?>
<!-- wp:group {"align":"wide","className":"fh-card fh-pad-x fh-pad-y","style":{"spacing":{"margin":{"top":"2rem"}}}} -->
<div class="wp-block-group alignwide fh-card fh-pad-x fh-pad-y" style="margin-top:2rem">

	<!-- wp:paragraph {"className":"fh-eyebrow"} -->
	<p class="fh-eyebrow">Testimonials</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":2,"style":{"spacing":{"margin":{"top":"0.5rem","bottom":"2.5rem"}}}} -->
	<h2 class="wp-block-heading" style="margin-top:0.5rem;margin-bottom:2.5rem">What clients say</h2>
	<!-- /wp:heading -->

	<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"3rem"}}}} -->
	<div class="wp-block-columns">

		<!-- wp:column {"className":"fh-testimonial"} -->
		<div class="wp-block-column fh-testimonial">

			<!-- wp:paragraph {"style":{"typography":{"fontSize":"1.05rem","fontStyle":"italic"}},"textColor":"body-text"} -->
			<p class="has-body-text-color has-text-color" style="font-size:1.05rem;font-style:italic">Alex took a vague brief and turned it into a site that actually converts. Communication was clear from kickoff to launch, and the handoff docs made our team self-sufficient.</p>
			<!-- /wp:paragraph -->

			<!-- wp:group {"style":{"spacing":{"margin":{"top":"1.25rem"}}},"layout":{"type":"flex"}} -->
			<div class="wp-block-group" style="margin-top:1.25rem">
				<!-- wp:image {"sizeSlug":"thumbnail","className":"fh-avatar-sm"} -->
				<figure class="wp-block-image size-thumbnail fh-avatar-sm"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/placeholder.png'); ?>" alt="Portrait of Helen Novak"/></figure>
				<!-- /wp:image -->
				<!-- wp:group {"className":"fh-tight-stack","layout":{"type":"flex","orientation":"vertical","justifyContent":"left"}} -->
				<div class="wp-block-group fh-tight-stack">
					<!-- wp:paragraph {"style":{"typography":{"fontWeight":"700"},"spacing":{"margin":{"bottom":"0"}}}} --><p style="margin-bottom:0;font-weight:700">Helen Novak</p><!-- /wp:paragraph -->
					<!-- wp:paragraph {"textColor":"body-text","style":{"typography":{"fontSize":"0.85rem"}}} --><p class="has-body-text-color has-text-color" style="font-size:0.85rem">Founder, Novak Roasters</p><!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"className":"fh-testimonial"} -->
		<div class="wp-block-column fh-testimonial">

			<!-- wp:paragraph {"style":{"typography":{"fontSize":"1.05rem","fontStyle":"italic"}},"textColor":"body-text"} -->
			<p class="has-body-text-color has-text-color" style="font-size:1.05rem;font-style:italic">Reliable, detail-oriented, and genuinely invested in getting the small things right. Our dashboard redesign shipped on time and our support tickets dropped noticeably.</p>
			<!-- /wp:paragraph -->

			<!-- wp:group {"style":{"spacing":{"margin":{"top":"1.25rem"}}},"layout":{"type":"flex"}} -->
			<div class="wp-block-group" style="margin-top:1.25rem">
				<!-- wp:image {"sizeSlug":"thumbnail","className":"fh-avatar-sm"} -->
				<figure class="wp-block-image size-thumbnail fh-avatar-sm"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/placeholder.png'); ?>" alt="Portrait of Jordan Marsh"/></figure>
				<!-- /wp:image -->
				<!-- wp:group {"className":"fh-tight-stack","layout":{"type":"flex","orientation":"vertical","justifyContent":"left"}} -->
				<div class="wp-block-group fh-tight-stack">
					<!-- wp:paragraph {"style":{"typography":{"fontWeight":"700"},"spacing":{"margin":{"bottom":"0"}}}} --><p style="margin-bottom:0;font-weight:700">Jordan Marsh</p><!-- /wp:paragraph -->
					<!-- wp:paragraph {"textColor":"body-text","style":{"typography":{"fontSize":"0.85rem"}}} --><p class="has-body-text-color has-text-color" style="font-size:0.85rem">Product Lead, Northlane</p><!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->

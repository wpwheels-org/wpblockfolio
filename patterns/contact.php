<?php
/**
 * Title: Get In Touch
 * Slug: wpblockfolio/contact
 * Categories: wpblockfolio-sections
 * Description: Contact details (phone, email, location) beside a native WordPress comment-style contact form built from Form/Input blocks.
 * Keywords: contact, form, get in touch
 * Viewport width: 1400
 */
?>
<!-- wp:group {"anchor":"contact","align":"wide","className":"fh-card fh-pad-x fh-pad-y","style":{"spacing":{"margin":{"top":"2rem","bottom":"2rem"}}}} -->
<div id="contact" class="wp-block-group alignwide fh-card fh-pad-x fh-pad-y" style="margin-top:2rem;margin-bottom:2rem">

	<!-- wp:paragraph {"className":"fh-eyebrow"} -->
	<p class="fh-eyebrow">Get In Touch</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":2,"style":{"spacing":{"margin":{"top":"0.5rem","bottom":"2rem"}}}} -->
	<h2 class="wp-block-heading" style="margin-top:0.5rem;margin-bottom:2rem">Let's work together</h2>
	<!-- /wp:heading -->

	<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"3rem"}}}} -->
	<div class="wp-block-columns">

		<!-- wp:column {"width":"35%"} -->
		<div class="wp-block-column" style="flex-basis:35%">

			<!-- wp:paragraph {"textColor":"body-text"} -->
			<p class="has-body-text-color has-text-color">Have a project in mind? Send a note — I typically reply within one business day.</p>
			<!-- /wp:paragraph -->

			<!-- wp:group {"className":"fh-contact-item","layout":{"type":"flex","flexWrap":"nowrap"}} -->
			<div class="wp-block-group fh-contact-item">
				<!-- wp:html --><div class="fh-contact-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 5c0-.6.4-1 1-1h3l2 4-2 1.5a11 11 0 0 0 5.5 5.5L15 13l4 2v3c0 .6-.4 1-1 1C10.5 19 4 12.5 4 5z"/></svg></div><!-- /wp:html -->
				<!-- wp:group {"className":"fh-tight-stack","layout":{"type":"flex","orientation":"vertical","justifyContent":"left"}} -->
				<div class="wp-block-group fh-tight-stack">
					<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem"},"spacing":{"margin":{"bottom":"0"}}}} --><p style="margin-bottom:0;font-size:0.9rem"><strong>Phone</strong></p><!-- /wp:paragraph -->
					<!-- wp:paragraph {"textColor":"body-text","style":{"typography":{"fontSize":"0.9rem"}}} --><p class="has-body-text-color has-text-color" style="font-size:0.9rem">+49 151 12345678</p><!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"className":"fh-contact-item","layout":{"type":"flex","flexWrap":"nowrap"}} -->
			<div class="wp-block-group fh-contact-item">
				<!-- wp:html --><div class="fh-contact-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h16v12H4z"/><path d="M4 7l8 6 8-6"/></svg></div><!-- /wp:html -->
				<!-- wp:group {"className":"fh-tight-stack","layout":{"type":"flex","orientation":"vertical","justifyContent":"left"}} -->
				<div class="wp-block-group fh-tight-stack">
					<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem"},"spacing":{"margin":{"bottom":"0"}}}} --><p style="margin-bottom:0;font-size:0.9rem"><strong>Email</strong></p><!-- /wp:paragraph -->
					<!-- wp:paragraph {"textColor":"body-text","style":{"typography":{"fontSize":"0.9rem"}}} --><p class="has-body-text-color has-text-color" style="font-size:0.9rem">hello@alexrivera.dev</p><!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"className":"fh-contact-item","layout":{"type":"flex","flexWrap":"nowrap"}} -->
			<div class="wp-block-group fh-contact-item">
				<!-- wp:html --><div class="fh-contact-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11z"/><circle cx="12" cy="10" r="2.5"/></svg></div><!-- /wp:html -->
				<!-- wp:group {"className":"fh-tight-stack","layout":{"type":"flex","orientation":"vertical","justifyContent":"left"}} -->
				<div class="wp-block-group fh-tight-stack">
					<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem"},"spacing":{"margin":{"bottom":"0"}}}} --><p style="margin-bottom:0;font-size:0.9rem"><strong>Location</strong></p><!-- /wp:paragraph -->
					<!-- wp:paragraph {"textColor":"body-text","style":{"typography":{"fontSize":"0.9rem"}}} --><p class="has-body-text-color has-text-color" style="font-size:0.9rem">Berlin, Germany</p><!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->

		</div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"65%"} -->
		<div class="wp-block-column" style="flex-basis:65%">
		<?php echo wpblockfolio_get_contact_form(); ?>
		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->

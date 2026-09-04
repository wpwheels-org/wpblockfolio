<?php
/**
 * Title: Services
 * Slug: wpblockfolio/services
 * Categories: wpblockfolio-sections
 * Description: A responsive grid of service cards, each with an icon, title and short description.
 * Keywords: services, offerings
 * Viewport width: 1400
 */

$wpblockfolio_services = array(
	array( '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3 3 8l9 5 9-5-9-5z"/><path d="M3 13l9 5 9-5"/></svg>', 'Product Design', 'Wireframes, prototypes and polished UI kits designed around real user goals.' ),
	array( '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M8 6 3 12l5 6"/><path d="M16 6l5 6-5 6"/></svg>', 'Development', 'Fast, accessible, standards-based front-end and WordPress builds.' ),
	array( '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17l6-6 4 4 8-8"/><path d="M15 6h6v6"/></svg>', 'SEO', 'On-page structure and performance tuning that helps the right people find you.' ),
	array( '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>', 'Copywriting', 'Clear, conversion-minded copy that matches your brand voice.' ),
	array( '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11v2a2 2 0 0 0 2 2h1l3 5V4l-3 5H5a2 2 0 0 0-2 2z"/><path d="M14 8a4 4 0 0 1 0 8"/><path d="M17 5a8 8 0 0 1 0 14"/></svg>', 'Marketing', 'Launch plans and content strategy across search and social.' ),
	array( '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a4 4 0 0 0-5.4 5.4L3 18l3 3 6.3-6.3a4 4 0 0 0 5.4-5.4l-2.8 2.8-2-2 2.8-2.8z"/></svg>', 'Support', 'Ongoing maintenance, updates and priority troubleshooting.' ),
);
?>
<!-- wp:group {"anchor":"services","align":"wide","style":{"spacing":{"margin":{"top":"2rem"}}}} -->
<div id="services" class="wp-block-group alignwide" style="margin-top:2rem">

	<!-- wp:paragraph {"className":"fh-eyebrow","align":"center"} -->
	<p class="has-text-align-center fh-eyebrow">Services</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":2,"style":{"spacing":{"margin":{"top":"0.5rem","bottom":"2.5rem"}}}} -->
	<h2 class="wp-block-heading" style="margin-top:0.5rem;margin-bottom:2.5rem">What I can help you with</h2>
	<!-- /wp:heading -->

	<!-- wp:group {"className":"fh-services-grid"} -->
	<div class="wp-block-group fh-services-grid">
		<?php foreach ( $wpblockfolio_services as $service ) : ?>
		<!-- wp:group {"className":"fh-card fh-tight-stack","style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"1.75rem","right":"1.75rem"}}}} -->
		<div class="wp-block-group fh-card fh-tight-stack" style="padding-top:2rem;padding-right:1.75rem;padding-bottom:2rem;padding-left:1.75rem">
			<!-- wp:html --><div class="fh-service-icon" aria-hidden="true"><?php echo $service[0]; ?></div><!-- /wp:html -->
			<!-- wp:heading {"level":3,"fontSize":"medium"} --><h3 class="wp-block-heading has-medium-font-size"><?php echo esc_html( $service[1] ); ?></h3><!-- /wp:heading -->
			<!-- wp:paragraph {"textColor":"body-text","style":{"typography":{"fontSize":"0.9rem"}}} --><p class="has-body-text-color has-text-color" style="font-size:0.9rem"><?php echo esc_html( $service[2] ); ?></p><!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->
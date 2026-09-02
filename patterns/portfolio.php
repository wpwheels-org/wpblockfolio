<?php
/**
 * Title: Portfolio Grid
 * Slug: wpblockfolio/portfolio
 * Categories: wpblockfolio-sections
 * Description: A responsive image grid for showcasing project work, with a "view all" button.
 * Keywords: portfolio, projects, gallery, works
 * Viewport width: 1400
 */

$wpblockfolio_projects = array(
	array( 'placeholder.png', 'Project 01', 'Brand identity for a coffee roastery' ),
	array( 'placeholder.png', 'Project 02', 'Dashboard UI for a SaaS analytics tool' ),
	array( 'placeholder.png', 'Project 03', 'E-commerce storefront redesign' ),
	array( 'placeholder.png', 'Project 04', 'Mobile app onboarding flow' ),
	array( 'placeholder.png', 'Project 05', 'Marketing site for a design studio' ),
	array( 'placeholder.png', 'Project 06', 'Editorial layout for a print magazine' ),
);

?>
<!-- wp:group {"anchor":"portfolio","align":"wide","className":"fh-pad-x","style":{"spacing":{"margin":{"top":"2rem"}}}} -->
<div id="portfolio" class="wp-block-group alignwide fh-pad-x" style="margin-top:2rem">

	<!-- wp:paragraph {"className":"fh-eyebrow","align":"center"} -->
	<p class="has-text-align-center fh-eyebrow">Portfolio</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":2,"style":{"spacing":{"margin":{"top":"0.5rem","bottom":"2.5rem"}}}} -->
	<h2 class="wp-block-heading" style="margin-top:0.5rem;margin-bottom:2.5rem">Selected work</h2>
	<!-- /wp:heading -->

	<!-- wp:group {"className":"fh-portfolio-grid"} -->
	<div class="wp-block-group fh-portfolio-grid">
		<?php foreach ( $wpblockfolio_projects as $project ) : ?>
		<!-- wp:image {"sizeSlug":"large","className":"fh-portfolio-item"} -->
		<figure class="wp-block-image size-large fh-portfolio-item"><img src="<?php echo esc_attr( get_template_directory_uri() . '/assets/images/' . $project[0] ); ?>" alt="<?php echo esc_attr( $project[2] ); ?>"/><figcaption class="wp-element-caption"><?php echo esc_html( $project[2] ); ?></figcaption></figure>
		<!-- /wp:image -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->

	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"2.5rem"}}}} -->
	<div class="wp-block-buttons" style="margin-top:2.5rem">
		<!-- wp:button {"backgroundColor":"accent"} -->
		<div class="wp-block-button"><a class="wp-block-button__link has-accent-background-color has-background wp-element-button" href="#">View All Work</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->

</div>
<!-- /wp:group -->
<?php
/**
 * Title: Portfolio Grid
 * Slug: wpblockfolio/portfolio
 * Categories: wpblockfolio-sections
 * Description: A responsive image grid for showcasing project work, with a "view all" button.
 * Keywords: portfolio, projects, gallery, works
 * Viewport width: 1400
 */

$wpblockfolio_projects = [
	[ 'placeholder.png', 'Project 01', 'Brand identity for a coffee roastery' ],
	[ 'placeholder.png', 'Project 02', 'Dashboard UI for a SaaS analytics tool' ],
	[ 'placeholder.png', 'Project 03', 'E-commerce storefront redesign' ],
	[ 'placeholder.png', 'Project 04', 'Mobile app onboarding flow' ],
	[ 'placeholder.png', 'Project 05', 'Marketing site for a design studio' ],
	[ 'placeholder.png', 'Project 06', 'Editorial layout for a print magazine' ],
];

// The "View All Work" target. get_post_type_archive_link() returns the posts
// page (or the site home) for the built-in 'post' type, but is typed
// string|false, so fall back to the home URL to guarantee a valid href.
$wpblockfolio_work_url = get_post_type_archive_link( 'post' );

if ( ! $wpblockfolio_work_url ) {
	$wpblockfolio_work_url = home_url( '/' );
}

?>
<!-- wp:group {"anchor":"portfolio","align":"wide","style":{"spacing":{"margin":{"top":"2rem"}}}} -->
<div id="portfolio" class="wp-block-group alignwide" style="margin-top:2rem">

	<!-- wp:paragraph {"className":"wpblockfolio-eyebrow","align":"center"} -->
	<p class="has-text-align-center wpblockfolio-eyebrow">Portfolio</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":2,"style":{"spacing":{"margin":{"top":"0.5rem","bottom":"2.5rem"}}}} -->
	<h2 class="wp-block-heading" style="margin-top:0.5rem;margin-bottom:2.5rem">Selected work</h2>
	<!-- /wp:heading -->

	<!-- wp:group {"className":"wpblockfolio-portfolio-grid"} -->
	<div class="wp-block-group wpblockfolio-portfolio-grid">
		<?php foreach ( $wpblockfolio_projects as $wpblockfolio_project ) : ?>
		<!-- wp:image {"sizeSlug":"large","className":"wpblockfolio-portfolio-item"} -->
		<figure class="wp-block-image size-large wpblockfolio-portfolio-item"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/build/images/' . $wpblockfolio_project[0] ); ?>" alt="<?php echo esc_attr( $wpblockfolio_project[2] ); ?>"/><figcaption class="wp-element-caption"><?php echo esc_html( $wpblockfolio_project[2] ); ?></figcaption></figure>
		<!-- /wp:image -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->

	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"2.5rem"}}}} -->
	<div class="wp-block-buttons" style="margin-top:2.5rem">
		<!-- wp:button {"backgroundColor":"accent"} -->
		<div class="wp-block-button"><a class="wp-block-button__link has-accent-background-color has-background wp-element-button" href="<?php echo esc_url( $wpblockfolio_work_url ); ?>">View All Work</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->

</div>
<!-- /wp:group -->
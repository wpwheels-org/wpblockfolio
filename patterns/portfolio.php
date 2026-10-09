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
	[ 'placeholder.png', __( 'Project 01', 'wpblockfolio' ), __( 'Brand identity for a coffee roastery', 'wpblockfolio' ) ],
	[ 'placeholder.png', __( 'Project 02', 'wpblockfolio' ), __( 'Dashboard UI for a SaaS analytics tool', 'wpblockfolio' ) ],
	[ 'placeholder.png', __( 'Project 03', 'wpblockfolio' ), __( 'E-commerce storefront redesign', 'wpblockfolio' ) ],
	[ 'placeholder.png', __( 'Project 04', 'wpblockfolio' ), __( 'Mobile app onboarding flow', 'wpblockfolio' ) ],
	[ 'placeholder.png', __( 'Project 05', 'wpblockfolio' ), __( 'Marketing site for a design studio', 'wpblockfolio' ) ],
	[ 'placeholder.png', __( 'Project 06', 'wpblockfolio' ), __( 'Editorial layout for a print magazine', 'wpblockfolio' ) ],
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
	<p class="has-text-align-center wpblockfolio-eyebrow"><?php esc_html_e( 'Portfolio', 'wpblockfolio' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":2,"style":{"spacing":{"margin":{"top":"0.5rem","bottom":"2.5rem"}}}} -->
	<h2 class="wp-block-heading" style="margin-top:0.5rem;margin-bottom:2.5rem"><?php esc_html_e( 'Selected work', 'wpblockfolio' ); ?></h2>
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
		<div class="wp-block-button"><a class="wp-block-button__link has-accent-background-color has-background wp-element-button" href="<?php echo esc_url( $wpblockfolio_work_url ); ?>"><?php esc_html_e( 'View All Work', 'wpblockfolio' ); ?></a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->

</div>
<!-- /wp:group -->
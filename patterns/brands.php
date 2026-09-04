<?php
/**
 * Title: Tools & Platforms Marquee
 * Slug: wpblockfolio/brands
 * Categories: wpblockfolio-sections
 * Description: An auto-scrolling strip of tool/platform logos, pauses on hover.
 * Keywords: brands, tools, platforms, logos, carousel, marquee
 * Viewport width: 1000
 */

$wpblockfolio_tools = array(
	array( 'wordpress.svg', 'WordPress' ),
	array( 'figma.svg', 'Figma' ),
	array( 'jquery.svg', 'jQuery' ),
	array( 'github.svg', 'GitHub' ),
	array( 'envato.svg', 'Envato' ),
	array( 'react.svg', 'React' ),
);

// Render the strip twice back-to-back so the CSS animation can loop seamlessly.
function wpblockfolio_marquee_track( $tools ) {
	$out = '';
	foreach ( $tools as $tool ) {
		$out .= '<div class="fh-marquee-item"><img src="' . get_template_directory_uri() . '/assets/build/images/' . $tool[0] . '" alt="' . esc_attr( $tool[1] ) . '" loading="lazy" width="28" height="28"/><span>' . esc_html( $tool[1] ) . '</span></div>';
	}
	return $out;
}
?>
<!-- wp:group {"className":"fh-card fh-pad-x fh-pad-y","style":{"spacing":{"margin":{"top":"2rem"}}}} -->
<div class="wp-block-group fh-card fh-pad-x fh-pad-y" style="margin-top:2rem">

	<!-- wp:paragraph {"className":"fh-eyebrow","align":"center"} -->
	<p class="has-text-align-center fh-eyebrow">Toolkit</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":3,"fontSize":"large","style":{"spacing":{"margin":{"top":"0.5rem","bottom":"2rem"}}}} -->
	<h3 class="wp-block-heading has-large-font-size" style="margin-top:0.5rem;margin-bottom:2rem">Tools &amp; platforms I work with</h3>
	<!-- /wp:heading -->

	<!-- wp:html -->
	<div class="fh-marquee" role="group" aria-label="Tools and platforms I work with">
		<div class="fh-marquee-track">
			<?php echo wpblockfolio_marquee_track( $wpblockfolio_tools ); ?>
			<?php echo wpblockfolio_marquee_track( $wpblockfolio_tools ); ?>
		</div>
	</div>
	<!-- /wp:html -->

</div>
<!-- /wp:group -->
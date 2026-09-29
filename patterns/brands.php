<?php
/**
 * Title: Tools & Platforms Marquee
 * Slug: wpblockfolio/brands
 * Categories: wpblockfolio-sections
 * Description: An auto-scrolling strip of tool/platform logos, pauses on hover.
 * Keywords: brands, tools, platforms, logos, carousel, marquee
 * Viewport width: 1000
 */

$wpblockfolio_tools = [
	[ 'wordpress.svg', 'WordPress' ],
	[ 'figma.svg', 'Figma' ],
	[ 'jquery.svg', 'jQuery' ],
	[ 'github.svg', 'GitHub' ],
	[ 'envato.svg', 'Envato' ],
	[ 'react.svg', 'React' ],
];

// Render the strip twice back-to-back so the CSS animation can loop seamlessly.
if ( ! function_exists( 'wpblockfolio_marquee_track' ) ) {
	/**
	 * Build the markup for one pass of the tool marquee.
	 *
	 * Each entry is a two-element list of the image filename to show and
	 * the human-readable label to render beside it. The whole track is
	 * emitted twice by the caller so the CSS animation can loop without a
	 * visible seam.
	 *
	 * @param array<int, array{0: string, 1: string}> $tools Ordered list of
	 *                     `[ filename, label ]` pairs, where filename is a
	 *                     file in `assets/build/images/`.
	 * @return string Concatenated `<div class="wpblockfolio-marquee-item">` markup.
	 */
	function wpblockfolio_marquee_track( $tools ) {
		$out = '';
		foreach ( $tools as $tool ) {
			$out .= '<div class="wpblockfolio-marquee-item"><img src="' . get_template_directory_uri() . '/assets/build/images/' . esc_attr( $tool[0] ) . '" alt="' . esc_attr( $tool[1] ) . '" loading="lazy" width="28" height="28"/><span>' . esc_html( $tool[1] ) . '</span></div>';
		}
		return $out;
	}
}
?>
<!-- wp:group {"className":"wpblockfolio-card wpblockfolio-pad-x wpblockfolio-pad-y","style":{"spacing":{"margin":{"top":"2rem"}}}} -->
<div class="wp-block-group wpblockfolio-card wpblockfolio-pad-x wpblockfolio-pad-y" style="margin-top:2rem">

	<!-- wp:paragraph {"className":"wpblockfolio-eyebrow","align":"center"} -->
	<p class="has-text-align-center wpblockfolio-eyebrow">Toolkit</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":3,"fontSize":"large","style":{"spacing":{"margin":{"top":"0.5rem","bottom":"2rem"}}}} -->
	<h3 class="wp-block-heading has-large-font-size" style="margin-top:0.5rem;margin-bottom:2rem">Tools &amp; platforms I work with</h3>
	<!-- /wp:heading -->

	<!-- wp:html -->
	<div class="wpblockfolio-marquee" role="group" aria-label="Tools and platforms I work with">
		<div class="wpblockfolio-marquee-track">
			<?php echo wpblockfolio_marquee_track( $wpblockfolio_tools ); ?>
			<?php echo wpblockfolio_marquee_track( $wpblockfolio_tools ); ?>
		</div>
	</div>
	<!-- /wp:html -->

</div>
<!-- /wp:group -->
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
<!-- wp:group {"anchor":"about","align":"wide","className":"wpblockfolio-card wpblockfolio-pad-x wpblockfolio-pad-y","style":{"spacing":{"margin":{"top":"3rem"}}}} -->
<div id="about" class="wp-block-group alignwide wpblockfolio-card wpblockfolio-pad-x wpblockfolio-pad-y" style="margin-top:3rem">

	<!-- wp:paragraph {"className":"wpblockfolio-eyebrow"} -->
	<p class="wpblockfolio-eyebrow"><?php esc_html_e( 'About Me', 'wpblockfolio' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":2,"style":{"spacing":{"margin":{"top":"0.5rem","bottom":"2rem"}}}} -->
	<h2 class="wp-block-heading" style="margin-top:0.5rem;margin-bottom:2rem"><?php esc_html_e( 'A little about who I am', 'wpblockfolio' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:columns {"verticalAlignment":"top","style":{"spacing":{"blockGap":{"left":"2.5rem"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-top">

		<!-- wp:column {"verticalAlignment":"top","width":"180px"} -->
		<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:180px">
			<!-- wp:image {"sizeSlug":"large","className":"wpblockfolio-about-avatar"} -->
			<figure class="wp-block-image size-large wpblockfolio-about-avatar"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/build/images/placeholder.png' ); ?>" alt="<?php esc_attr_e( 'Portrait of Alex Rivera', 'wpblockfolio' ); ?>"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"top"} -->
		<div class="wp-block-column is-vertically-aligned-top">

			<!-- wp:heading {"level":3,"fontSize":"large"} -->
			<h3 class="wp-block-heading has-large-font-size"><?php esc_html_e( 'Hello, I\'m Alex', 'wpblockfolio' ); ?></h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"textColor":"body-text"} -->
			<p class="has-body-text-color has-text-color"><?php esc_html_e( 'I\'m a product designer and front-end developer based in Berlin, Germany. I care about accessible, well-crafted interfaces and I enjoy turning early ideas into polished, working software — from small business sites to full web applications.', 'wpblockfolio' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:columns {"style":{"spacing":{"margin":{"top":"1.5rem"}}}} -->
			<div class="wp-block-columns" style="margin-top:1.5rem">
				<!-- wp:column -->
				<div class="wp-block-column">
					<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem"}}} --><p style="font-size:0.9rem"><strong><?php esc_html_e( 'Name:', 'wpblockfolio' ); ?></strong> <?php esc_html_e( 'Alex Rivera', 'wpblockfolio' ); ?></p><!-- /wp:paragraph -->
					<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem"}}} --><p style="font-size:0.9rem"><strong><?php esc_html_e( 'Location:', 'wpblockfolio' ); ?></strong> <?php esc_html_e( 'Berlin, Germany', 'wpblockfolio' ); ?></p><!-- /wp:paragraph -->
				</div>
				<!-- /wp:column -->
				<!-- wp:column -->
				<div class="wp-block-column">
					<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem"}}} --><p style="font-size:0.9rem"><strong><?php esc_html_e( 'Birthday:', 'wpblockfolio' ); ?></strong> <?php esc_html_e( '14 August 1998', 'wpblockfolio' ); ?></p><!-- /wp:paragraph -->
					<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9rem"}}} --><p style="font-size:0.9rem"><strong><?php esc_html_e( 'Email:', 'wpblockfolio' ); ?></strong> hello@example.com</p><!-- /wp:paragraph -->
				</div>
				<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->

			<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"1.5rem"}}}} -->
			<div class="wp-block-buttons" style="margin-top:1.5rem">
				<!-- wp:button {"backgroundColor":"accent"} -->
				<div class="wp-block-button"><a class="wp-block-button__link has-accent-background-color has-background wp-element-button" href="#experience"><?php esc_html_e( 'View Resume', 'wpblockfolio' ); ?></a></div>
				<!-- /wp:button -->

				<!-- wp:button {"className":"is-style-outline"} -->
				<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="#contact"><?php esc_html_e( 'Hire Me', 'wpblockfolio' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->

		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->

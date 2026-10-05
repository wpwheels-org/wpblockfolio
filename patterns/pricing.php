<?php
/**
 * Title: Pricing Table
 * Slug: wpblockfolio/pricing
 * Categories: wpblockfolio-sections
 * Description: Three pricing tiers with the middle plan visually highlighted as the recommended option.
 * Keywords: pricing, packages, plans
 * Viewport width: 1400
 */
?>
<!-- wp:group {"anchor":"pricing","align":"wide","style":{"spacing":{"margin":{"top":"2rem"}}}} -->
<div id="pricing" class="wp-block-group alignwide" style="margin-top:2rem">

	<!-- wp:paragraph {"className":"wpblockfolio-eyebrow","align":"center"} -->
	<p class="has-text-align-center wpblockfolio-eyebrow"><?php esc_html_e( 'Pricing', 'wpblockfolio' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":2,"style":{"spacing":{"margin":{"top":"0.5rem","bottom":"2.5rem"}}}} -->
	<h2 class="wp-block-heading" style="margin-top:0.5rem;margin-bottom:2.5rem"><?php esc_html_e( 'Simple, transparent packages', 'wpblockfolio' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:columns {"className":"wpblockfolio-price-card-grid","verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"1.5rem"}}}} -->
	<div class="wp-block-columns wpblockfolio-price-card-grid are-vertically-aligned-center">

		<!-- wp:column {"verticalAlignment":"center","className":"wpblockfolio-pricing-card wpblockfolio-card","style":{"spacing":{"padding":{"top":"2.5rem","bottom":"2.5rem","left":"2rem","right":"2rem"}}}} -->
		<div class="wp-block-column is-vertically-aligned-center wpblockfolio-pricing-card wpblockfolio-card" style="padding-top:2.5rem;padding-right:2rem;padding-bottom:2.5rem;padding-left:2rem">
			<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"700","fontSize":"0.8rem","letterSpacing":"0.05em"}},"textColor":"accent"} --><p class="has-text-align-center has-accent-color has-text-color" style="font-size:0.8rem;font-weight:700;letter-spacing:0.05em"><?php esc_html_e( 'STARTER', 'wpblockfolio' ); ?></p><!-- /wp:paragraph -->
			<!-- wp:heading {"level":3,"textAlign":"center","fontSize":"xx-large"} --><h3 class="wp-block-heading has-text-align-center has-xx-large-font-size">$249</h3><!-- /wp:heading -->
			<!-- wp:paragraph {"align":"center","textColor":"body-text","style":{"spacing":{"margin":{"bottom":"1.5rem"}}}} --><p class="has-text-align-center has-body-text-color has-text-color" style="margin-bottom:1.5rem"><?php esc_html_e( 'One-page site build', 'wpblockfolio' ); ?></p><!-- /wp:paragraph -->
			<!-- wp:list {"style":{"typography":{"fontSize":"0.9rem"}},"className":"wpblockfolio-price-list"} -->
			<ul class="wpblockfolio-price-list" style="font-size:0.9rem">
				<!-- wp:list-item --><li><?php esc_html_e( '1 template page', 'wpblockfolio' ); ?></li><!-- /wp:list-item -->
				<!-- wp:list-item --><li><?php esc_html_e( 'Basic SEO setup', 'wpblockfolio' ); ?></li><!-- /wp:list-item -->
				<!-- wp:list-item --><li><?php esc_html_e( '7 days support', 'wpblockfolio' ); ?></li><!-- /wp:list-item -->
			</ul>
			<!-- /wp:list -->
			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"1.5rem"}}}} -->
			<div class="wp-block-buttons" style="margin-top:1.5rem">
				<!-- wp:button {"className":"is-style-outline","width":100} --><div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-outline"><a class="wp-block-button__link wp-element-button" href="#contact"><?php esc_html_e( 'Get Started', 'wpblockfolio' ); ?></a></div><!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center","className":"wpblockfolio-pricing-card is-featured","style":{"spacing":{"padding":{"top":"3rem","bottom":"3rem","left":"2rem","right":"2rem"}}}} -->
		<div class="wp-block-column is-vertically-aligned-center wpblockfolio-pricing-card is-featured" style="padding-top:3rem;padding-right:2rem;padding-bottom:3rem;padding-left:2rem">
			<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"700","fontSize":"0.8rem","letterSpacing":"0.05em"}}} --><p class="has-text-align-center" style="font-size:0.8rem;font-weight:700;letter-spacing:0.05em"><?php esc_html_e( 'PROFESSIONAL', 'wpblockfolio' ); ?></p><!-- /wp:paragraph -->
			<!-- wp:heading {"level":3,"textAlign":"center","fontSize":"xx-large"} --><h3 class="wp-block-heading has-text-align-center has-xx-large-font-size">$549</h3><!-- /wp:heading -->
			<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"1.5rem"}}}} --><p class="has-text-align-center" style="margin-bottom:1.5rem"><?php esc_html_e( 'Full multi-page site', 'wpblockfolio' ); ?></p><!-- /wp:paragraph -->
			<!-- wp:list {"style":{"typography":{"fontSize":"0.9rem"}},"className":"wpblockfolio-price-list"} -->
			<ul class="wpblockfolio-price-list" style="font-size:0.9rem">
				<!-- wp:list-item --><li><?php esc_html_e( 'Up to 6 template pages', 'wpblockfolio' ); ?></li><!-- /wp:list-item -->
				<!-- wp:list-item --><li><?php esc_html_e( 'Full on-page SEO', 'wpblockfolio' ); ?></li><!-- /wp:list-item -->
				<!-- wp:list-item --><li><?php esc_html_e( '30 days support', 'wpblockfolio' ); ?></li><!-- /wp:list-item -->
			</ul>
			<!-- /wp:list -->
			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"1.5rem"}}}} -->
			<div class="wp-block-buttons" style="margin-top:1.5rem">
				<!-- wp:button {"width":100} --><div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link wp-element-button" href="#contact"><?php esc_html_e( 'Get Started', 'wpblockfolio' ); ?></a></div><!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center","className":"wpblockfolio-pricing-card wpblockfolio-card","style":{"spacing":{"padding":{"top":"2.5rem","bottom":"2.5rem","left":"2rem","right":"2rem"}}}} -->
		<div class="wp-block-column is-vertically-aligned-center wpblockfolio-pricing-card wpblockfolio-card" style="padding-top:2.5rem;padding-right:2rem;padding-bottom:2.5rem;padding-left:2rem">
			<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"700","fontSize":"0.8rem","letterSpacing":"0.05em"}},"textColor":"accent"} --><p class="has-text-align-center has-accent-color has-text-color" style="font-size:0.8rem;font-weight:700;letter-spacing:0.05em"><?php esc_html_e( 'PREMIUM', 'wpblockfolio' ); ?></p><!-- /wp:paragraph -->
			<!-- wp:heading {"level":3,"textAlign":"center","fontSize":"xx-large"} --><h3 class="wp-block-heading has-text-align-center has-xx-large-font-size">$999</h3><!-- /wp:heading -->
			<!-- wp:paragraph {"align":"center","textColor":"body-text","style":{"spacing":{"margin":{"bottom":"1.5rem"}}}} --><p class="has-text-align-center has-body-text-color has-text-color" style="margin-bottom:1.5rem"><?php esc_html_e( 'Custom web application', 'wpblockfolio' ); ?></p><!-- /wp:paragraph -->
			<!-- wp:list {"style":{"typography":{"fontSize":"0.9rem"}},"className":"wpblockfolio-price-list"} -->
			<ul class="wpblockfolio-price-list" style="font-size:0.9rem">
				<!-- wp:list-item --><li><?php esc_html_e( 'Unlimited pages', 'wpblockfolio' ); ?></li><!-- /wp:list-item -->
				<!-- wp:list-item --><li><?php esc_html_e( 'Custom functionality', 'wpblockfolio' ); ?></li><!-- /wp:list-item -->
				<!-- wp:list-item --><li><?php esc_html_e( '90 days support', 'wpblockfolio' ); ?></li><!-- /wp:list-item -->
			</ul>
			<!-- /wp:list -->
			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"1.5rem"}}}} -->
			<div class="wp-block-buttons" style="margin-top:1.5rem">
				<!-- wp:button {"className":"is-style-outline","width":100} --><div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-outline"><a class="wp-block-button__link wp-element-button" href="#contact"><?php esc_html_e( 'Get Started', 'wpblockfolio' ); ?></a></div><!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->

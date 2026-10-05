<?php
/**
 * Title: My Skills
 * Slug: wpblockfolio/skills
 * Categories: wpblockfolio-sections
 * Description: Intro paragraph plus a two-column set of labelled progress bars for key skills.
 * Keywords: skills, progress, bars
 * Viewport width: 1400
 */
?>
<!-- wp:group {"anchor":"skills","align":"wide","className":"wpblockfolio-card wpblockfolio-pad-x wpblockfolio-pad-y","style":{"spacing":{"margin":{"top":"2rem"}}}} -->
<div id="skills" class="wp-block-group alignwide wpblockfolio-card wpblockfolio-pad-x wpblockfolio-pad-y" style="margin-top:2rem">

	<!-- wp:paragraph {"className":"wpblockfolio-eyebrow"} -->
	<p class="wpblockfolio-eyebrow"><?php esc_html_e( 'My Skills', 'wpblockfolio' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":2,"style":{"spacing":{"margin":{"top":"0.5rem","bottom":"1rem"}}}} -->
	<h2 class="wp-block-heading" style="margin-top:0.5rem;margin-bottom:1rem"><?php esc_html_e( 'Tools & technologies I work with', 'wpblockfolio' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"textColor":"body-text","style":{"spacing":{"margin":{"bottom":"2rem"}}}} -->
	<p class="has-body-text-color has-text-color" style="margin-bottom:2rem"><?php esc_html_e( 'A mix of design and front-end tools I use daily to take a project from wireframe to finished, responsive product.', 'wpblockfolio' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"3rem"}}}} -->
	<div class="wp-block-columns">

		<!-- wp:column -->
		<div class="wp-block-column">

			<!-- wp:group {"className":"wpblockfolio-skill"} -->
			<div class="wp-block-group wpblockfolio-skill">
				<!-- wp:paragraph {"className":"wpblockfolio-skill-label"} --><p class="wpblockfolio-skill-label"><span><?php esc_html_e( 'WordPress', 'wpblockfolio' ); ?></span><span>92%</span></p><!-- /wp:paragraph -->
				<!-- wp:html --><div class="wpblockfolio-skill-track"><div class="wpblockfolio-skill-fill" style="width:92%"></div></div><!-- /wp:html -->
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"className":"wpblockfolio-skill"} -->
			<div class="wp-block-group wpblockfolio-skill">
				<!-- wp:paragraph {"className":"wpblockfolio-skill-label"} --><p class="wpblockfolio-skill-label"><span><?php esc_html_e( 'JavaScript', 'wpblockfolio' ); ?></span><span>85%</span></p><!-- /wp:paragraph -->
				<!-- wp:html --><div class="wpblockfolio-skill-track"><div class="wpblockfolio-skill-fill" style="width:85%"></div></div><!-- /wp:html -->
			</div>
			<!-- /wp:group -->

		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">

			<!-- wp:group {"className":"wpblockfolio-skill"} -->
			<div class="wp-block-group wpblockfolio-skill">
				<!-- wp:paragraph {"className":"wpblockfolio-skill-label"} --><p class="wpblockfolio-skill-label"><span><?php esc_html_e( 'HTML & CSS', 'wpblockfolio' ); ?></span><span>95%</span></p><!-- /wp:paragraph -->
				<!-- wp:html --><div class="wpblockfolio-skill-track"><div class="wpblockfolio-skill-fill" style="width:95%"></div></div><!-- /wp:html -->
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"className":"wpblockfolio-skill"} -->
			<div class="wp-block-group wpblockfolio-skill">
				<!-- wp:paragraph {"className":"wpblockfolio-skill-label"} --><p class="wpblockfolio-skill-label"><span><?php esc_html_e( 'Figma', 'wpblockfolio' ); ?></span><span>88%</span></p><!-- /wp:paragraph -->
				<!-- wp:html --><div class="wpblockfolio-skill-track"><div class="wpblockfolio-skill-fill" style="width:88%"></div></div><!-- /wp:html -->
			</div>
			<!-- /wp:group -->

		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->

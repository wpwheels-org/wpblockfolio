<?php
/**
 * Title: Sidebar — Profile Card
 * Slug: wpblockfolio/sidebar-profile
 * Categories: wpblockfolio-sections
 * Description: Avatar, name, tagline, in-page navigation and social links — designed to sit in a sticky sidebar column that stays visible while the rest of the page scrolls, resume-style.
 * Keywords: sidebar, profile, resume, sticky, navigation
 * Viewport width: 400
 */
?>
<!-- wp:group {"className":"fh-card fh-pad-x fh-pad-y fh-sidebar-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group fh-card fh-pad-x fh-pad-y fh-sidebar-card">

	<!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
	<div class="wp-block-group">

		<!-- wp:group {"className":"fh-avatar-ring"} -->
		<div class="wp-block-group fh-avatar-ring">
			<!-- wp:image {"sizeSlug":"thumbnail"} -->
			<figure class="wp-block-image size-thumbnail"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/build/images/placeholder.png'); ?>" alt="Portrait photo"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:group -->

		<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0.1rem"}}},"fontSize":"large"} -->
		<h3 class="wp-block-heading has-large-font-size" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0.1rem">Alex Rivera</h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","textColor":"body-text","style":{"typography":{"fontSize":"0.85rem"}}} -->
		<p class="has-text-align-center has-body-text-color has-text-color" style="font-size:0.85rem">Product Designer &amp; Front-End Developer</p>
		<!-- /wp:paragraph -->

	</div>
	<!-- /wp:group -->

	<!-- wp:separator {"className":"fh-separator-left","style":{"spacing":{"margin":{"top":"1.5rem","bottom":"1.5rem"}}},"backgroundColor":"border"} -->
	<hr class="wp-block-separator has-text-color has-border-color has-alpha-channel-opacity has-border-background-color has-background fh-separator-left" style="margin-top:1.5rem;margin-bottom:1.5rem"/>
	<!-- /wp:separator -->

	<!-- wp:list {"className":"fh-sidebar-nav","style":{"typography":{"fontSize":"0.9rem"},"spacing":{"blockGap":"0.7rem"}}} -->
	<ul class="wp-block-list fh-sidebar-nav" style="font-size:0.9rem">
		<!-- wp:list-item --><li><a href="#home">Home</a></li><!-- /wp:list-item -->
		<!-- wp:list-item --><li><a href="#about">About</a></li><!-- /wp:list-item -->
		<!-- wp:list-item --><li><a href="#skills">Skills</a></li><!-- /wp:list-item -->
		<!-- wp:list-item --><li><a href="#services">Services</a></li><!-- /wp:list-item -->
		<!-- wp:list-item --><li><a href="#experience">Resume</a></li><!-- /wp:list-item -->
		<!-- wp:list-item --><li><a href="#portfolio">Works</a></li><!-- /wp:list-item -->
		<!-- wp:list-item --><li><a href="#pricing">Pricing</a></li><!-- /wp:list-item -->
		<!-- wp:list-item --><li><a href="#blog">Blog</a></li><!-- /wp:list-item -->
		<!-- wp:list-item --><li><a href="#contact">Contact</a></li><!-- /wp:list-item -->
	</ul>
	<!-- /wp:list -->

	<!-- wp:separator {"className":"fh-separator-left","style":{"spacing":{"margin":{"top":"1.5rem","bottom":"1.5rem"}}},"backgroundColor":"border"} -->
	<hr class="wp-block-separator has-text-color has-border-color has-alpha-channel-opacity has-border-background-color has-background fh-separator-left" style="margin-top:1.5rem;margin-bottom:1.5rem"/>
	<!-- /wp:separator -->

	<!-- wp:social-links {"iconColor":"ink","iconColorValue":"#181a17","className":"is-style-logos-only fh-social","style":{"spacing":{"blockGap":{"left":"0.5rem"}}},"layout":{"type":"flex","orientation":"horizontal","justifyContent":"center"}} -->
	<ul class="wp-block-social-links has-icon-color is-style-logos-only fh-social">
		<!-- wp:social-link {"url":"#","service":"facebook"} /-->
		<!-- wp:social-link {"url":"#","service":"twitter"} /-->
		<!-- wp:social-link {"url":"#","service":"instagram"} /-->
		<!-- wp:social-link {"url":"#","service":"linkedin"} /-->
	</ul>
	<!-- /wp:social-links -->

	<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"1.5rem"}}}} -->
	<div class="wp-block-buttons" style="margin-top:1.5rem">
		<!-- wp:button {"backgroundColor":"accent","width":100} -->
		<div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link has-accent-background-color has-background wp-element-button" href="#contact">Hire Me</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->

</div>
<!-- /wp:group -->

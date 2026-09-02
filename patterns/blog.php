<?php
/**
 * Title: Recent Posts
 * Slug: wpblockfolio/blog
 * Categories: wpblockfolio-sections
 * Description: A live Query Loop grid of the 3 most recent blog posts with featured image, date and excerpt.
 * Keywords: blog, posts, articles, query
 * Viewport width: 1400
 */
?>
<!-- wp:group {"anchor":"blog","align":"wide","className":"fh-pad-x","style":{"spacing":{"margin":{"top":"2rem"}}}} -->
<div id="blog" class="wp-block-group alignwide fh-pad-x" style="margin-top:2rem">

	<!-- wp:paragraph {"className":"fh-eyebrow","align":"center"} -->
	<p class="has-text-align-center fh-eyebrow">Blog</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":2,"style":{"spacing":{"margin":{"top":"0.5rem","bottom":"2.5rem"}}}} -->
	<h2 class="wp-block-heading" style="margin-top:0.5rem;margin-bottom:2.5rem">Recent posts</h2>
	<!-- /wp:heading -->

	<!-- wp:query {"queryId":1,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false}} -->
	<div class="wp-block-query">
		 <!-- wp:post-template {"className":"fh-blog-grid","style":{"spacing":{"blockGap":{"top":"1.5rem","left":"1.5rem"}}},"layout":{"type":"grid","columnCount":3}} -->

			<!-- wp:group {"className":"fh-card","style":{"spacing":{"padding":{"bottom":"1.5rem"}}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group fh-card" style="padding-bottom:1.5rem">

				<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3","style":{"border":{"radius":"0px"}}} /-->

				<!-- wp:group {"style":{"spacing":{"padding":{"left":"1.5rem","right":"1.5rem","top":"1.25rem"}}}} -->
				<div class="wp-block-group" style="padding-top:1.25rem;padding-right:1.5rem;padding-left:1.5rem">

					<!-- wp:post-date {"textColor":"accent","style":{"typography":{"fontSize":"0.8rem","fontWeight":"600","textTransform":"uppercase"}}} /-->

					<!-- wp:post-title {"level":3,"isLink":true,"fontSize":"medium","style":{"spacing":{"margin":{"top":"0.4rem","bottom":"0.6rem"}}}} /-->

					<!-- wp:post-excerpt {"excerptLength":16,"textColor":"body-text","style":{"typography":{"fontSize":"0.9rem"}}} /-->

				</div>
				<!-- /wp:group -->

			</div>
			<!-- /wp:group -->

		<!-- /wp:post-template -->

		<!-- wp:query-no-results -->
			<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center">No posts published yet — your latest articles will appear here automatically.</p>
			<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->

	</div>
	<!-- /wp:query -->

</div>
<!-- /wp:group -->

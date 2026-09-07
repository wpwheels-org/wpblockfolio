<?php
/**
 * Title: Single — Back to all posts
 * Slug: wpblockfolio/single-back-link
 * Inserter: no
 * Description: "Back to all posts" link for the single post template, using a site-relative URL so it works when WordPress is installed in a subdirectory.
 * Keywords: single, back, blog
 */

$home = home_url( '/' );
?>
<!-- wp:paragraph {"className":"wpblockfolio-back-link"} -->
<p class="wpblockfolio-back-link"><a href="<?php echo esc_url( $home . '#blog' ); ?>">&#8592; Back to all posts</a></p>
<!-- /wp:paragraph -->

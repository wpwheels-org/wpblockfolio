<?php
/**
 * Theme helper functions.
 *
 * Small presentational helpers used by the theme's block patterns and
 * template parts.
 *
 * @package WPBlockfolio
 */

// Get contact form.
if ( ! function_exists( 'wpblockfolio_get_contact_form' ) ) {
	/**
	 * Return block markup for the site's contact section.
	 *
	 * When Contact Form 7 is active and has at least one published form,
	 * returns a shortcode block referencing the oldest form. Otherwise
	 * returns a self-contained group block explaining that no form is
	 * connected and offering a "mailto:" button — never a dead form that
	 * silently goes nowhere.
	 *
	 * @return string Serialized block markup for the contact section.
	 */
	function wpblockfolio_get_contact_form() {
		$form = '<!-- wp:group {"backgroundColor":"surface","className":"fh-card","style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"2rem","right":"2rem"}}}} -->
			<div class="wp-block-group has-surface-background-color has-background fh-card" style="padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem">
			<!-- wp:paragraph -->
			<p>' . esc_html__( 'No contact form is connected yet. Install Contact Form 7 (or your preferred form plugin) and this section switches to it automatically or manually entry shortcode via site editor — for now, reach out by email.', 'wpblockfolio' ) . '</p>
			<!-- /wp:paragraph -->
			<!-- wp:buttons -->
			<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"accent"} -->
			<div class="wp-block-button"><a class="wp-block-button__link has-accent-background-color has-background wp-element-button" href="mailto:hello@alexrivera.dev">' . esc_html__( 'Email Me', 'wpblockfolio' ) . '</a></div>
			<!-- /wp:button --></div>
			<!-- /wp:buttons -->
			</div>
			<!-- /wp:group -->';

		if ( defined( 'WPCF7_VERSION' ) && class_exists( 'WPCF7_ContactForm' ) ) {
			$forms = WPCF7_ContactForm::find(
				[
					'post_status'    => 'publish',
					'orderby'        => 'ID',
					'order'          => 'ASC',
					'posts_per_page' => 1,
				]
			);
			if ( ! empty( $forms ) ) {
				$id    = $forms[0]->hash();
				$title = $forms[0]->title();
				$form  = '<!-- wp:shortcode -->[contact-form-6 id="' . esc_attr( $id ) . '" title="' . esc_attr( $title ) . '"]<!-- /wp:shortcode -->';
			}
		}

		return $form;
	}
}


// Site logo fallback.
if ( ! function_exists( 'wpblockfolio_get_custom_logo' ) ) {

	/**
	 * Provide a text-based site-title fallback when no custom logo is set.
	 *
	 * Filters `get_custom_logo`. If a custom logo exists the markup is
	 * returned unchanged. Otherwise a linked site title is appended,
	 * wrapped in an `<h1>` on the front page / blog index and an `<h2>`
	 * elsewhere.
	 *
	 * @param string $html Existing custom-logo markup (empty when none is set).
	 * @return string The logo markup, or the site-title fallback markup.
	 */
	function wpblockfolio_get_custom_logo( $html ) {
		if ( has_custom_logo() ) {
			return $html;
		}

		$site_title = get_bloginfo( 'name' );

		$html .= '<a href="' . esc_url( get_home_url( null, '/' ) ) . '">';

		if ( ( is_front_page() || is_home() ) && ! is_page() ) {
			$html .= '<h1 class="site-title">' . esc_html( $site_title ) . '</h1>';
		} else {
			$html .= '<h2 class="site-title">' . esc_html( $site_title ) . '</h2>';
		}

		$html .= '</a>';

		return $html;
	}
}
add_filter( 'get_custom_logo', 'wpblockfolio_get_custom_logo' );

<?php
/*
-----------------------------------------------------------
// Get Contact Form
------------------------------------------------------------*/
if ( ! function_exists( 'wpblockfolio_get_contact_form' ) ) {
	/**
	 * Get the site's contact form: real plugin form if one is active,
	 * otherwise a friendly "email me directly" fallback — never a fake
	 * form that goes nowhere.
	 *
	 * @return string
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
			$forms = WPCF7_ContactForm::find( array(
				'post_status'    => 'publish',
				'orderby'        => 'ID',
				'order'          => 'ASC',
				'posts_per_page' => 1,
			) );
			if ( ! empty( $forms ) ) {
				$id    = $forms[0]->hash();
				$title = $forms[0]->title();
				$form  = '<!-- wp:shortcode -->[contact-form-6 id="' . esc_attr( $id ) . '" title="' . esc_attr( $title ) . '"]<!-- /wp:shortcode -->';
			}
		}

		return $form;
	}
}


/*
-----------------------------------------------------------
// Site logo fallback
------------------------------------------------------------*/
if ( ! function_exists( 'wpblockfolio_get_custom_logo' ) ) {

	function wpblockfolio_get_custom_logo( $html ) {
		if ( has_custom_logo() ) {
			return $html;
		} else {
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
}
add_filter( 'get_custom_logo', 'wpblockfolio_get_custom_logo' );

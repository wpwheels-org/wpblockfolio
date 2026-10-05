# Code Quality & Security

Most **Required**-severity failures in a real Theme Review live here. Read `functions.php` and
every file it `require`s/`include`s line by line — don't skim.

## Escaping output (the #1 thing reviewers flag)

Every variable echoed into HTML must be escaped at the point of output, not just "sanitized
somewhere upstream." Reviewers want to see escaping right next to the `echo`/print, because that's
what's verifiable without tracing the whole call chain.

| Context | Required function |
|---|---|
| Plain text in HTML | `esc_html()` |
| Text inside a translated string being echoed | `esc_html_e()` / `esc_html__()` |
| HTML attribute value | `esc_attr()` |
| URL (`href`, `src`) | `esc_url()` (use `esc_url_raw()` only when storing, not displaying) |
| `<textarea>` content | `esc_textarea()` |
| Allowing a safe subset of HTML | `wp_kses_post()` or `wp_kses()` with an explicit allowed-tags array — never raw `echo $html` |
| JS values injected into inline `<script>` | `wp_json_encode()` / `esc_js()` as appropriate — never raw interpolation |

**Flag as Required**: any `echo $var`, `echo $_GET[...]`, `<?= $var ?>`, or string concatenation
into `echo`/`print` without a matching `esc_*()`/`wp_kses*()` call wrapping it. This includes
values from `get_theme_mod()`, `get_option()`, customizer settings, and post meta — reviewers do
not assume upstream sanitization is sufficient; escaping must happen at output.

## Sanitizing input

Any value read from `$_GET`, `$_POST`, `$_REQUEST`, `$_COOKIE`, or `$_SERVER` must be sanitized
before use (`sanitize_text_field()`, `absint()`, `sanitize_key()`, etc. as appropriate to the
expected type) and, if it affects state (saves data, triggers an action), must be nonce-verified.

**Flag as Required**: raw `$_GET`/`$_POST` access without sanitization anywhere, especially if it
flows into a DB query, file path, or is echoed.

## Nonces

Any form or AJAX handler that changes state (saves an option, triggers an action) must:
- Output a nonce field (`wp_nonce_field()`) or include one in the AJAX payload.
- Verify it server-side (`check_admin_referer()`, `wp_verify_nonce()`, `check_ajax_referer()`)
  before acting on the request.

**Flag as Required** if a state-changing handler is missing nonce generation or verification.

## Database access

Themes should use WordPress APIs (`WP_Query`, `get_posts()`, `get_option()`/`update_option()`,
`$wpdb` with `prepare()`) rather than raw SQL. If `$wpdb` is used directly:
- Every query with variable input must use `$wpdb->prepare()` with placeholders — flag any string
  concatenation of variables directly into SQL as **Required** (SQL injection risk).
- Themes generally shouldn't need direct `$wpdb` calls at all — if present, ask whether it's
  actually necessary or if a core API would do the same job, and flag as **Recommended** to
  simplify even if it is safely prepared.

## Enqueuing scripts & styles

- **Required**: all CSS/JS must be loaded via `wp_enqueue_style()` / `wp_enqueue_script()` hooked
  into `wp_enqueue_scripts` (front end) or `enqueue_block_editor_assets`/`enqueue_block_assets`
  (editor). Flag any hardcoded `<script src="...">` or `<link rel="stylesheet">` written directly
  into a template/header file — this bypasses dependency management and is a hard fail.
- Scripts should declare proper dependencies (e.g. depend on `jquery` if used, rather than assuming
  load order) and be enqueued with `true` for in-footer loading where appropriate.
- No scripts/styles should be enqueued on every single page unconditionally if they're only needed
  on specific templates — flag unconditional global enqueuing of something clearly used in a single
  area as **Recommended** to scope down (performance).
- Flag inline `<style>` blocks injected via PHP string concatenation for anything beyond small,
  genuinely dynamic values (e.g. a user-configurable accent color) — large static CSS blocks belong
  in an enqueued stylesheet, not a PHP-generated `<style>` tag. (Small dynamic per-instance rules,
  like block-specific CSS custom properties keyed to a block ID, are normal and fine — don't flag
  that pattern itself, just excessive/static content living there.)

## Theme vs. plugin territory

Theme Review explicitly prohibits themes from including functionality that should be a plugin —
this trips up a lot of otherwise well-coded themes. **Flag as Required** if `functions.php`
includes any of:
- Custom post types or taxonomies **unless removing the theme should reasonably also remove that
  content type** (i.e., it's deeply theme-specific, like a "Portfolio Item" CPT for a portfolio
  theme is usually fine *if* clearly tied to the theme's core premise — but a generic "Testimonials"
  or "Team Member" CPT is borderline and should be flagged for discussion).
- Shortcodes (themes must not register shortcodes — this is squarely plugin territory).
- Widgets beyond standard widget-area registration (custom widget classes are discouraged in favor
  of blocks in a block theme anyway).
- Social media icon/sharing functionality beyond simple links.
- Any functionality that would break other content on the site if the user switched themes (since
  switching themes should not mean losing *content*, only *presentation*).

## Deprecated / discouraged functions

Flag use of: `create_function()`, `each()`, direct `mysql_*` functions, `extract()` on
untrusted input, `eval()`, PHP short echo tags `<?=` outside of contexts where the theme explicitly
requires PHP 5.4+ with short_open_tag (prefer full `<?php echo`), and any WordPress function marked
`@deprecated` in current core (check via `wp_deprecated_function` references or search if unsure of
current status).

## General code quality (Recommended / nitpick tier)

- Consistent text domain string literal matching the theme slug everywhere (cross-check with
  i18n-and-licensing.md) — inconsistency here is often auto-flagged.
- No commented-out dead code blocks left in.
- No `var_dump()`, `print_r()`, `error_log()` debug calls left active.
- Functions/constants prefixed consistently to avoid collisions with other themes/plugins (e.g. if
  the theme is internally `foliohub`/`fh-` prefixed, that's fine as long as it's consistent — flag
  if prefixing is inconsistent or missing on globally-scoped functions).

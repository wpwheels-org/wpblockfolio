# Internationalization (i18n) & Licensing

## Text domain consistency

- The text domain string literal passed to every `__()`, `_e()`, `esc_html__()`, `esc_html_e()`,
  `_x()`, `_n()`, etc. call must **exactly match** the `Text Domain:` field in the `style.css`
  header, and should match the theme's slug/directory name.
- **Required** fix: any translation function call using a different/hardcoded string, a variable, or
  no text domain at all (as of WP 4.6+, theme text domains load automatically from the slug if
  omitted and matching — but Theme Review still expects the domain to be explicitly passed and
  correct for clarity and tooling compatibility). Flag inconsistent domains across files (e.g. half
  the theme uses `my-theme` and half uses an old/renamed slug like `foliohub` — this is a **Required**
  fix and a good example of exactly the kind of drift that happens after a theme gets renamed
  publicly but internal prefixes/domains aren't fully updated everywhere).
- Text domain must not be a variable (`__( $string, $this->domain )`) — must be a static string
  literal, because translation tools parse source statically and can't resolve variables.

## Translator comments

- Any translatable string containing a `%s`/`%d` placeholder needs a `translators:` comment
  immediately above it explaining what the placeholder will contain, e.g.:
  ```php
  /* translators: %s: Site name */
  printf( esc_html__( 'Powered by %s', 'my-theme' ), esc_html( get_bloginfo( 'name' ) ) );
  ```
  Flag missing translator comments on any placeholder string as **Recommended** (soft-required in
  practice — reviewers do check for this).

## Untranslated strings

- Any user-facing string hardcoded in PHP templates/`functions.php` without being wrapped in a
  translation function is a **Required** fix — this includes strings in `aria-label`, `alt`,
  `title` attributes, not just visible text.
- Strings inside JS files that are user-facing should use `wp_set_script_translations()` with a
  generated `.json`/`.pot`-derived translation file, or at minimum be flagged as untranslated if
  the theme has no i18n story for its JS at all.

## Licensing — bundled assets

Everything shipped in the theme must be 100% GPL-compatible (or public domain / a compatible
permissive license), because the theme itself is licensed GPL and redistributed on WordPress.org.

For **each** bundled asset, verify and flag as **Required** if unclear/violating:
- **Fonts**: Google Fonts are generally OFL-licensed (compatible) but must be **self-hosted**, not
  loaded from `fonts.googleapis.com` at runtime (this is also a privacy/GDPR concern reviewers
  flag — calling out to Google's CDN exposes visitor IPs to a third party without consent). Flag any
  `<link href="https://fonts.googleapis.com/...">` or `@import` from Google Fonts as **Required** to
  fix — download and bundle the font files instead, reference via `theme.json` `fontFace` or local
  `@font-face`.
- **Icon fonts / SVG icon sets**: verify the specific icon set's license (many are MIT/OFL/CC0 and
  fine; some "free for personal use" sets are not GPL-compatible and must not be bundled).
- **Images used as demo/placeholder content**: must be properly licensed for redistribution (CC0,
  theme author's own photos, or explicitly licensed stock) — generic stock photos without a clear
  redistributable license are a common rejection reason. Unsplash/Pexels-style licenses are
  generally fine but confirm they don't require attribution in a way the theme doesn't provide.
- **JS libraries**: check license headers of any bundled third-party JS — must be GPL-compatible
  (MIT, Apache 2.0, BSD are all fine; GPL-incompatible licenses are not).
- **Color/font choices lifted from a commercial theme/brand**: not a licensing violation per se
  but can raise trademark-adjacent concerns if combined with a similar name — cross-reference with
  required-files-and-header.md's naming section if relevant.

## No remote calls without disclosure

- Theme Review flags any theme that phones home to a remote server (analytics, update checks
  outside the standard WP update API, license-validation pings, remotely-loaded fonts/scripts,
  "activate with email" flows) without clear, explicit user-facing disclosure and opt-in. Flag any
  such call found in `functions.php` as **Required** to either remove or properly disclose/opt-in.

# FSE / Block Theme Specifics

Checks that only apply to full-site-editing themes (presence of `theme.json`).

## theme.json

- **Required**: valid JSON (no trailing commas, no comments — pure JSON only). A single syntax
  error here can silently break the entire editor experience, so actually parse it, don't eyeball it.
- **Required**: `$schema` key present, ideally pointing at
  `https://schemas.wp.org/trunk/theme.json` (or a version-pinned schema URL) — enables editor
  tooling/validation for theme authors and is expected in a well-formed theme.
- **Required**: `version` key present. Should be `2` or `3` (version 1 is legacy/deprecated —
  flag if found).
- Check `settings.color.palette` — a block theme should define its own color palette rather than
  relying solely on default WP colors, so users get theme-appropriate choices in the block editor.
  Flag as **Recommended** if empty/missing entirely.
- Check `settings.typography.fontSizes` and `fontFamilies` — similarly expected to be defined for a
  polished editor experience. If custom fonts are referenced via `fontFace`, verify the font files
  are actually bundled in the theme (e.g. under `assets/fonts/`) and are GPL-compatible/licensed
  for bundling (cross-check with i18n-and-licensing.md) — a `theme.json` referencing a Google Font
  by file without the file present, or bundling a non-redistributable commercial font, is a
  **Required** fix.
- `settings.layout.contentSize` / `wideSize` — should be set to sensible values; flag if missing
  (editor falls back to no content-width constraint, usually not intended).
- Check `settings.spacing.spacingSizes` / `units` are present rather than leaving spacing totally
  unconstrained, which produces an inconsistent editor experience.
- `styles.css` (the top-level additional-CSS escape hatch in `theme.json`) should be used sparingly
  — if it contains large amounts of styling that could be expressed through `settings`/`styles`
  JSON properties instead, flag as **Recommended** (defeats the purpose of theme.json-driven
  theming and won't sync properly with style variations / the site editor's UI controls).
- If the theme defines **style variations** (`styles/*.json` in a `styles/` subfolder), verify each
  one is valid JSON and actually produces a visually distinct result — a "variation" that's
  identical to the default is a Recommended-tier nitpick.
- `customTemplates` and `templateParts` arrays in `theme.json` should list every custom template
  and template part the theme ships, each with a human-readable `title` — missing entries mean
  users can't find/assign them properly in the site editor. Flag any `.html` file under
  `templates/` or `parts/` that isn't registered here.

## Templates (`templates/*.html`)

- **Required**: `templates/index.html` must exist — this is the fallback template and its absence
  breaks the theme.
- Check that templates use **block markup** (HTML comments like `<!-- wp:group -->`) correctly —
  malformed block comments (mismatched opening/closing, missing `/-->`  on self-closing blocks)
  will cause "this block contains unexpected or invalid content" errors on the front end, exactly
  like a corrupted custom block's `save()` output would. Validate the comment delimiters are
  balanced.
- Verify templates include the expected structural blocks: `wp:template-part` for header/footer
  (rather than hardcoded markup duplicating what should be a template part — flag duplication as
  **Recommended** to refactor into a shared part), `wp:post-content` or equivalent inside
  single/page templates so actual post content renders.
- Check for hardcoded text content inside template HTML comments/markup (e.g. literal "Hello World"
  strings, placeholder lorem ipsum, author's personal site links) left over from development —
  flag as **Required** to remove before a public release; shipping dev placeholder content is a
  common reviewer rejection reason.

## Template parts (`parts/*.html`)

- `parts/header.html` should include site title/logo (`wp:site-title`, `wp:site-logo`) and
  navigation (`wp:navigation`), not hardcoded links.
- `parts/footer.html` credit links: see required-files-and-header.md's credit-link rule — must be
  optional/removable, max one link.
- Verify there's exactly one `<nav>` landmark per template part doing navigation duty, not multiple
  competing nav blocks (accessibility — see accessibility.md).

## Patterns (`patterns/*.php`)

- Each pattern file needs a header comment block (`Title:`, `Slug:`, `Categories:`, optionally
  `Block Types:`, `Keywords:`) — missing headers mean the pattern won't register/appear correctly
  in the inserter. Flag missing/incomplete headers as **Required**.
- Pattern PHP files should contain **only** a block-comment HTML string (optionally with minimal
  PHP for dynamic bits like `esc_html__()` on translatable text) — any heavier logic doesn't belong
  in a pattern file.
- Slugs should be prefixed with the theme's text domain/slug (e.g. `my-theme/hero-banner`) to avoid
  collisions with other themes'/plugins' patterns.

## Custom blocks (if the theme bundles any, under `blocks/` or similar)

If the theme ships custom blocks (not just patterns), note that a theme review is generally
stricter about this — bundling non-trivial custom blocks can itself be flagged as plugin-territory
functionality (see code-quality-security.md's "Theme vs. plugin territory" section) unless they're
clearly presentational/theme-specific (e.g. a layout block vs. a block that stores/manages
independent data that would persist meaningfully if the user switched themes).

For any bundled block, apply the exact same `save()`/escaping/markup-validity scrutiny described in
code-quality-security.md's escaping section — a custom block with a `save()` function that doesn't
match the structure WordPress expects when re-parsing saved content will show the
"this block contains unexpected or invalid content" / block-recovery error on real sites, which is
both a functional bug and something a reviewer will catch by just testing the theme.

## Performance

- Check that `theme.json` / enqueued CSS isn't duplicating default WordPress core block styles
  unnecessarily (`wp-block-library` should still be relied on, not reimplemented wholesale).
- Flag render-blocking enqueued scripts in the `<head>` without `defer`/`async` or footer loading,
  unless there's a clear reason they must block render.
- `add_theme_support('post-thumbnails')`, `('responsive-embeds')`, `('html5', [...])` and similar
  standard supports should be declared — flag missing ones as **Recommended**.

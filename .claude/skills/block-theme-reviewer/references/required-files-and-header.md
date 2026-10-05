# Required Files & style.css Header

The fastest way to fail (or pass) an initial Theme Review pass. Check these first.

## Required directory contents

| File | Required? | Notes |
|---|---|---|
| `style.css` | **Required** | Must contain the full header block (below), even if the theme's actual CSS lives elsewhere (e.g. compiled into `assets/`). A block theme can have an almost-empty `style.css` body but the header is still mandatory. |
| `theme.json` | **Required for block themes** | Its presence is effectively what makes WordPress treat the theme as a block theme. |
| `templates/index.html` | **Required** | Minimum viable block template. Theme will not function/activate meaningfully without it. |
| `readme.txt` | Required for WordPress.org submission | Standard WP readme format: `=== Theme Name ===`, `Contributors`, `Requires at least`, `Tested up to`, `Requires PHP`, `License`, `License URI`, then `== Description ==`, `== Changelog ==`, etc. Flag if missing or missing those fields. |
| `screenshot.png` (or `.jpg`/`.gif`) | Required | Recommended 1200×900 (4:3 ratio). Flag if missing, wrong aspect ratio, or if it's a generic placeholder/stock photo that misrepresents the theme. |
| `LICENSE` / `license.txt` | Required | Full text of the license (GPL v2 or later is the WordPress.org standard). Theme and all bundled resources (fonts, icons, images, JS/PHP libraries) must be 100% GPL-compatible. |
| `functions.php` | Common but not strictly required | If present, flag any functionality that isn't theme-appropriate (see code-quality-security.md — themes should not include plugin-territory functionality). |
| `parts/header.html`, `parts/footer.html` | Expected | Not hard-required by name, but a theme claiming to be a complete FSE theme should have header/footer template parts registered in `theme.json`'s `templateParts`. |

## style.css header — required fields

```css
/*
Theme Name: My Theme
Theme URI: https://example.com/my-theme/
Author: Jane Doe
Author URI: https://example.com/
Description: A short description.
Requires at least: 6.4
Tested up to: 6.7
Requires PHP: 7.4
Version: 1.0.0
License: GNU General Public License v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: my-theme
Tags: full-site-editing, block-patterns, accessibility-ready
*/
```

Flag as **Required**:
- `Theme Name` missing or doesn't match the directory name's intent.
- `Version` missing, or not incrementing from a previous submission if this is an update.
- `License` / `License URI` missing — without this the theme cannot be hosted on WordPress.org at all.
- `Text Domain` missing, or not matching the theme's actual slug/directory name — this breaks
  translation loading and is checked everywhere strings are wrapped in `__()`/`_e()` etc.
  (cross-reference with i18n-and-licensing.md).
- `Tags` containing a tag the theme doesn't actually support (e.g. claiming
  `accessibility-ready` without meeting the accessibility-ready requirements — see
  accessibility.md) — this is a **hard fail**, not a style nit; misusing that tag is taken
  seriously because it misleads users relying on it.
- Any tag used for marketing rather than describing an actual feature (e.g. a subjective tag like
  "best", "premium" — tags must be from the
  [official tag list](https://make.wordpress.org/themes/handbook/review/required/theme-tags/)).

Flag as **Recommended**:
- `Theme URI` / `Author URI` missing (nice to have, not required).
- `Requires at least` / `Tested up to` missing or stale (>2 major WP versions behind current).

## Naming and trademarks

- Theme name must not contain a trademarked term it's not authorized to use — most commonly
  flagged: "WordPress", "WooCommerce", other product/company names used in a way that implies
  official affiliation (e.g. "WordPress Blog Theme", "Shopify-style Theme"). Flag as **Required**
  fix (rename) if found.
- The theme should not imply core WordPress functionality is a unique feature of the theme (e.g.
  claiming "Built-in SEO" when it's just using standard `<title>` tags — this is fine, but
  overstating what's custom vs. what's WordPress-native in marketing copy/readme can get flagged).

## credit links

- If the theme includes a footer credit link ("Powered by X"), it must be optional (removable by
  the user without editing code, or simply not hardcoded/forced) and must not contain more than one
  link, and the link must not be an affiliate/tracking link. Flag hardcoded, non-removable credit
  links as **Required** to fix.

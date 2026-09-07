# Changelog

All notable changes to this project are documented in this file.

## [1.0.1] - 2026-09-07

### Fixed
- **404 template**: broken navigation links on the not-found page now resolve correctly — the page content moved into a new `wpblockfolio/404-content` block pattern that builds every link (home, section anchors, quick links) from `home_url()` instead of hard-coded paths.

### Changed
- **Style class prefix**: renamed the theme's CSS class prefix from `fh-` to `wpblockfolio-` across all block patterns, templates, and `assets/src/css/custom.css` for consistent, namespaced styling.
- Added `AGENTS.md` with contributor and coding-convention notes for the theme.

## [1.0.0]

### Added
- Initial release.

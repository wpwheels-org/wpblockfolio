# AGENTS.md

## What this is

A WordPress **block theme** built for Full Site Editing. Despite the names, it
is *not* a plugin:

- `composer.json` / `package.json` derive from a plugin-scaffolded project.
  Their metadata has been corrected to describe this theme, but the code is
  the source of truth: `style.css` header, `theme.json`,
  `templates/*.html`, `parts/*.html`, `patterns/*.php`.
- `npm run test:php` still assumes a plugin layout
  (`wp-content/plugins/$(basename $(pwd))`) inside `wp-env`; PHPUnit currently
  has an empty `tests/phpunit/` suite, so tests mostly don't run.

## Build pipeline (webpack)

`assets/src/` is compiled to **`assets/build/`** by `@wordpress/scripts`
(`webpack.config.js`, `babel.config.js`, `postcss.config.js`,
`tailwind.config.js`). Build output **is committed** — it is not in
`.gitignore`. `functions.php` reads runtime versions/deps from
`assets/build/js/main.asset.php` and enqueues `assets/build/css/custom.css`
and `assets/build/js/main.js`, so the theme won't look right before a build.

- `npm run start` — dev watch mode
- `npm run build` — `clean` → webpack build (JS + CSS)
- `npm run build:prod` — full production build (`clean` → build → strip maps →
  `composer install --no-dev`); use for shipped artifacts
- JS entry: `assets/src/js/main.js` (plain JS, no TypeScript); webpack alias
  `@` → `assets/src`
- `assets/src/images/` and `assets/src/fonts/` copy verbatim into `build/`

Do not hand-edit files under `assets/build/`; edit `assets/src/` and rebuild.

> The `build` / `lint` scripts list their sub-scripts **explicitly**. They used
> to glob (`build:*` / `lint:*`), which silently pulled in `build:prod` (stripping
> dev Composer deps) and the `lint:*:fix` autofixers (mutating files mid-lint).
> If you add a sub-script, add it to the parent's list too.

## Lint / checks

```sh
npm run lint                    # all of the below in parallel, exit 0 = clean
npm run lint:js                 # eslint (wp-scripts, single quote, 2-space tab)
npm run lint:css                # stylelint
npm run lint:php                # parallel-lint (PHP syntax)
npm run lint:phpcs              # phpcs (phpcs.xml.dist)
npm run lint:php:stan           # phpstan (phpstan.neon.dist)
composer run-script format      # phpcbf (auto-fix phpcs)
```

There is no `lint:js:types` — the theme ships no TypeScript and has no
`tsconfig.json`, so `tsc --noEmit` had nothing to compile and always failed.
Reintroduce it (with a `tsconfig.json`) only if TS/TSX is actually added.

PHP code is expected to pass **WPCS** ruleset plus `WordPress-VIP-Go` and
`PHPCompatibilityWP`. Global prefix requirement (enforced by
`PrefixAllGlobals`): constants `WPBLOCKFOLIO_`, classes `WPBlockfolio`,
functions/variables `wpblockfolio_`. i18n text domain is **`wpblockfolio`**.

### Deliberate lint-config deviations

Don't "fix" these — they are intentional:

- `phpstan.neon.dist` analyses `functions.php`, `inc/`, `patterns/` and
  excludes `inc/tgm/` (third-party TGM Plugin Activation). `phpVersion.min` is
  pinned to `70400` to match the `Requires PHP: 7.4` in `style.css` /
  `readme.txt`, so PHPStan rejects PHP 8-only syntax. `composer.json`'s
  `require.php` is `^8.0` because the *dev toolchain* needs it — that is not a
  statement about the theme's runtime floor. Stubs come from the explicit
  `php-stubs/wordpress-stubs` dev dependency, not a transitive one.
- `phpcs.xml.dist` `testVersion` is `7.4-` for the same reason, and
  `inc/tgm/` is excluded. `Squiz.Commenting.FileComment` is excluded under
  `patterns/` because a WordPress pattern header (`Title:`/`Slug:`/
  `Categories:`) is not a PHPDoc file comment and has no `@package`.
- `WordPress.Security.EscapeOutput` lists `wpblockfolio_marquee_track()` and
  `wpblockfolio_get_contact_form()` as `customEscapingFunctions` — both return
  already-escaped markup, and `wp_kses_post()` on the contact form would strip
  the `<form>` element. The trusted inline SVG in `patterns/services.php`
  carries a `phpcs:ignore` for the same reason (kses has no `svg` context).
- `Generic.CodeAnalysis.UnusedFunctionParameter` is at severity 0: a filter
  that replaces a value outright (`excerpt_length`) is *required* by the WP
  API to accept a parameter it never uses.
- `.stylelintrc.json` overrides `selector-class-pattern` to allow a BEM `__`
  element suffix. A block theme must be able to target core block classes
  (`.wp-block-button__link`, `.wp-block-navigation__responsive-container`),
  which the upstream wp-scripts pattern rejects.
- `.stylelintrc.json` also disables `no-descending-specificity`. It compares
  specificity purely by trailing key selector, so it flags unrelated
  container-scoped rules (`.wpblockfolio-post-cats a` vs
  `.wpblockfolio-sidebar-nav a:hover`) that can never conflict. All 23 reports
  were audited: two were selectors inside a single grouped rule sharing
  identical declarations, the rest set disjoint properties. Reordering them
  would churn unrelated page sections for no rendering benefit.

## PHP conventions

- All reusable helpers `inc/` guarded with `function_exists()`; loaded from
  `functions.php` via `inc/inc.php` (which also loads `inc/tgm/tgm.php`).
- Strict PHPDoc docblocks are expected (summary line, aligned `@param`, always
  `@return`). See `.opencode/skills/php-doc-comments/SKILL.md` for the exact
  house style; use it whenever adding/documenting PHP.
- Helpers live in `inc/helpers.php`. Notable: the contact form is rendered
  server-side via `do_shortcode()` (CF7) because `core/shortcode` blocks never
  run `the_content`'s shortcode filter inside block templates/patterns — see
  the docblock in `helpers.php` before touching feature-flag patterns.

## Theme structure (FSE)

- `templates/*.html`, `parts/*.html` — HTML block markup, edited in the Site Editor
- `patterns/*.php` — auto-registered block patterns; each file's header comment
  declares slug/category. Directories map to the "WPBlockfolio Sections" category.
- `styles/*.json` — global style variations (cobalt / noir / terracotta / violet-dusk)
- `theme.json` — colors, typography (Poppins/Inter), spacing, element styles
- `assets/src/css/custom.css` — supplemental CSS theme.json can't express
  (progress bars, timeline, card hovers, stat icons)

## i18n

`npm run i18n:make-pot` generates `languages/wpblockfolio.pot`; it is
path-scoped (`*.php`, `inc/**/*.php`, `assets/src/**/*.js`) with explicit
exclusions — don't broad-stroke the globs. `grunt-checktextdomain` enforces the
text domain in `inc/**/*.php`.

## Packaging

`Gruntfile.js` (`npm run ...`? no: `grunt release`) assembles a distributable
`.zip` into top-level `build/` (`build/wpblockfolio-<version>.zip`), excluding
dev configs, node_modules, vendor, tests, and cypress. Do not confuse the
top-level `build/` (Grunt artifact) with `assets/build/` (webpack output).

## Local overrides

`phpcs.xml`, `phpunit.xml`, `phpstan.neon`, `.env`, and
`.wp-env.override.json` are gitignored local overrides — don't commit them, and
don't rely on them existing for other contributors (`.dist` variants are the
source of truth).

## Skills / tooling

`.claude/skills/` and `.opencode/skills/` mirror identical workflows:
`changelog`, `commit-msg` (conventional commits, e.g. `feat(x): ...`),
`php-doc-comments`, `wpcs`. Git history uses conventional-commit messages —
match that style.
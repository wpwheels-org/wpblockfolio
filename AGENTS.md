# AGENTS.md

## What this is

A WordPress **block theme** built for Full Site Editing. Despite the names, it
is *not* a plugin:

- `composer.json` declares `type: wordpress-plugin` and `package.json`
  describes a "plugin with a custom post type" — both are stale/incorrect
  metadata inherited from an older project. Trust the actual code: `style.css`
  header, `theme.json`, `templates/*.html`, `parts/*.html`, `patterns/*.php`.
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
- `npm run build` — development build
- `npm run build:prod` — full production build (`clean` → build → strip maps →
  `composer install --no-dev`); use for shipped artifacts
- JS/TS entry: `assets/src/js/main.js`; webpack alias `@` → `assets/src`
- `assets/src/images/` and `assets/src/fonts/` copy verbatim into `build/`

Do not hand-edit files under `assets/build/`; edit `assets/src/` and rebuild.

## Lint / checks

```sh
npm run lint                    # all of the below in parallel
npm run lint:js                 # eslint (wp-scripts, single quote, 2-space tab)
npm run lint:js:types           # tsc --noEmit (TS/TSX supported)
npm run lint:css                # stylelint
composer run-script lint:php     # parallel-lint (PHP syntax)
composer run-script phpstan      # static analysis (phpstan.neon.dist)
composer run-script lint:phpcs   # phpcs (phpcs.xml.dist)
npm run phpcbf                  # composer run-script format (auto-fix phpcs)
```

PHP code is expected to pass **WPCS** ruleset plus `WordPress-VIP-Go` and
`PHPCompatibilityWP`. Global prefix requirement (enforced by
`PrefixAllGlobals`): constants `WPBLOCKFOLIO_`, classes `WPBlockfolio`,
functions/variables `wpblockfolio_`. i18n text domain is **`wpblockfolio`**.

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
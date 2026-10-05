# WordPress.org Theme Review Skill

## Purpose

This skill ensures that any WordPress theme created, modified, refactored, or reviewed by Claude follows the current official WordPress.org Theme Review Requirements.

Primary reference:
https://make.wordpress.org/themes/handbook/review/required/

The theme must be suitable for submission to the official WordPress.org Theme Directory.

Claude MUST treat the official WordPress Theme Review Requirements as the source of truth.

Do not rely on outdated Theme Review Codex pages, old tutorials, or deprecated requirements when they conflict with the current handbook.

---

## Core Rule

When creating or modifying a WordPress theme:

1. Follow WordPress.org Theme Review Requirements.
2. Prefer WordPress Core APIs over custom implementations.
3. Keep theme functionality focused on presentation and design.
4. Move non-presentational functionality into plugins.
5. Follow WordPress security standards.
6. Follow WordPress accessibility requirements.
7. Follow GPL-compatible licensing requirements.
8. Make all user-facing strings translatable.
9. Avoid external resources unless explicitly permitted.
10. Before considering the theme complete, perform a full Theme Review compliance audit.

If there is uncertainty about whether something belongs in a theme or plugin, treat it as plugin territory unless the official requirements clearly allow it.

---

# 1. Licensing & Copyright

The theme MUST be GPL-compatible.

Recommended license:

    GPL-2.0-or-later

Everything distributed inside the theme must be GPL-compatible, including PHP, JavaScript, CSS, fonts, icons, images, SVG files, third-party libraries, bundled assets, demo content, and other resources.

Every third-party resource must have compatible licensing.

Third-party resources must include:
- resource name
- copyright/author
- license
- source URL

Maintain a resource attribution list in `readme.txt`.

Do not copy another theme's design, clone another commercial theme, bundle incompatible assets, use copyrighted images without permission, or include proprietary libraries with incompatible licenses.

---

# 2. Privacy

Tracking and collection of user data must be disabled by default and explicitly opt-in where required.

Do not silently:
- send analytics data
- collect telemetry
- track users
- send usage information
- communicate with external services

If user data is collected:
- clearly disclose it
- document what is collected
- document why it is collected
- document where it is sent
- document how it is used

Document this in `readme.txt`.

Avoid remote requests unless explicitly permitted and user-consented.

---

# 3. Accessibility

The theme MUST provide accessible navigation and interaction.

## Skip Links

For classic themes:
- provide a skip link
- it should be the first meaningful focusable element
- it must become visible on keyboard focus
- it must move focus to the main content

For block themes, ensure the `<main>` element is correctly implemented so WordPress can provide its automatic skip-link behavior.

## Keyboard Navigation

Every interactive element must be keyboard accessible.

Ensure:
- links can receive keyboard focus
- buttons can receive keyboard focus
- menus are keyboard usable
- forms are keyboard usable
- custom controls support keyboard interaction
- focus states are visible

Never rely exclusively on `:hover` for important interactions.

Provide visible `:focus` / `:focus-visible` states.

Do not remove browser focus indicators without providing an equivalent accessible focus state.

---

# 4. Code Quality & Security

The theme MUST NOT generate PHP or JavaScript errors, warnings, or notices.

Never introduce:
- PHP notices
- PHP warnings
- PHP fatal errors
- JavaScript console errors
- undefined variables
- undefined indexes
- invalid function calls
- deprecated WordPress APIs

## Security

All untrusted data must be:
1. validated
2. sanitized
3. escaped at output

Examples:

    sanitize_text_field()
    sanitize_key()
    sanitize_email()
    sanitize_url()
    absint()
    intval()
    wp_kses_post()

Output escaping:

    esc_html()
    esc_attr()
    esc_url()
    esc_js()
    wp_kses_post()

Never output untrusted values directly.

---

# 5. Nonces

Any state-changing action initiated by a user should use WordPress nonce protection where appropriate.

Use:
- `wp_nonce_field()`
- `wp_create_nonce()`
- `check_admin_referer()`
- `check_ajax_referer()`

Nonces do NOT replace capability checks. Always combine nonce validation with authorization.

---

# 6. Capability Checks

Never rely only on user roles.

Use capabilities:

    current_user_can( 'edit_theme_options' )

Do not use role names as authorization checks when a capability exists.

`is_admin()` is not an authorization mechanism.

---

# 7. Prefixing

Everything added to the public PHP namespace must use a unique prefix. Use a minimum 4-character prefix.

Prefix:
- functions
- classes
- constants
- global variables
- options
- post meta keys
- custom database identifiers
- script/style handles where appropriate
- custom image sizes
- block pattern categories
- other public identifiers

Example:

    function myth_setup() {}
    function myth_enqueue_assets() {}
    $myth_options = array();

Do not use generic names such as `setup()`, `custom_init()`, or `theme_setup()`.

---

# 8. Deprecated APIs

Do NOT use deprecated WordPress functions, classes, constants, or APIs.

Prefer modern WordPress APIs and verify unfamiliar APIs against current WordPress documentation.

---

# 9. Theme vs Plugin Boundary

Themes are primarily for:
- presentation
- layout
- styling
- templates
- visual configuration
- design-related functionality

Do NOT place application functionality in the theme.

Do not include:
- custom post types
- custom taxonomies
- custom roles
- custom user contact methods
- custom MIME types
- shortcodes
- analytics
- SEO functionality
- contact forms
- caching systems
- session manipulation
- unrelated business logic

If functionality survives a theme switch and belongs to the site's content/application, it generally belongs in a plugin.

---

# 10. Admin Notices and Activation

Use `admin_notices` for theme-generated admin notices.

Notices must be:
- dismissible
- consistent with WordPress admin UI
- non-obtrusive

Do not:
- display intrusive popups immediately after activation
- redirect users automatically on activation
- hijack activation
- block the admin bar
- remove WordPress functionality
- manipulate activation flow

---

# 11. Plugin Recommendations

Themes may recommend plugins hosted on WordPress.org.

Plugins must only be installed after explicit user action.

Never:
- automatically install plugins
- automatically download plugin ZIP files
- bundle plugin ZIP files
- include third-party plugin functionality inside the theme

---

# 12. Theme Naming

Theme names must not use:
- `WordPress`
- `Theme`
- `Twenty*`

Do not choose a name confusingly similar to another theme or brand.

Respect trademarks.

Never use the WordPress logo in theme branding or promotional assets.

---

# 13. Internationalization

Every user-facing string must be translatable.

Use WordPress gettext APIs:

    __( 'Read More', 'theme-slug' )
    _e( 'Read More', 'theme-slug' )
    esc_html__( 'Read More', 'theme-slug' )
    esc_attr__( 'Read More', 'theme-slug' )

The text domain MUST match the theme slug.

Avoid hard-coded user-facing strings.

---

# 14. Theme Files

Remove development/system files and artifacts, including:
- `.git`
- `.svn`
- `.hg`
- `.bzr`
- `Thumbs.db`
- `desktop.ini`
- `error_log`
- SQL dumps
- ZIP files
- temporary files
- local environment files
- credentials
- build artifacts
- backups
- `__MACOSX`

Do not include secrets, API keys, passwords, or local machine configuration.

---

# 15. Remote Resources

Do not load external CSS, JavaScript, images, videos, fonts, APIs, or libraries without satisfying the applicable WordPress.org requirements.

Prefer bundling assets locally.

Google Fonts are an exception recognized by the current requirements, but privacy and performance implications should still be considered.

---

# 16. style.css

`style.css` must contain valid theme headers.

Example:

    /*
    Theme Name: My Theme
    Author: Example Author
    Description: A modern WordPress block theme.
    Version: 1.0.0
    Requires at least: 6.6
    Tested up to: 6.9
    Requires PHP: 8.0
    License: GPL-2.0-or-later
    License URI: https://www.gnu.org/licenses/gpl-2.0.html
    Text Domain: my-theme
    */

Required metadata:
- Theme Name
- Author
- Description
- Version
- Requires at least
- Tested up to
- Requires PHP
- License
- License URI
- Text Domain

---

# 17. readme.txt

Include `readme.txt` with appropriate WordPress.org metadata.

Recommended sections:

    == Description ==
    == Frequently Asked Questions ==
    == Changelog ==
    == Upgrade Notice ==
    == Resources ==

Document third-party resources under `== Resources ==`.

---

# 18. JavaScript and CSS

If distributing minified assets, include the original source file too.

Use WordPress-bundled versions of libraries whenever available.

Use:
- `wp_enqueue_script()`
- `wp_enqueue_style()`

Do not hardcode assets unnecessarily.

---

# 19. Asset Enqueuing

Good:

    wp_enqueue_style(
        'my-theme-style',
        get_stylesheet_uri(),
        array(),
        MY_THEME_VERSION
    );

    wp_enqueue_script(
        'my-theme-script',
        get_theme_file_uri( 'assets/js/main.js' ),
        array(),
        MY_THEME_VERSION,
        true
    );

Avoid hardcoded `<script>` and `<link>` tags when WordPress enqueue APIs are appropriate.

---

# 20. Classic Themes

If creating a classic theme, verify:

    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>

Use:
- `wp_head()` immediately before `</head>`
- `wp_body_open()` immediately after `<body>`
- `body_class()` on `<body>`
- `wp_footer()` immediately before `</body>`
- `post_class()` for post containers where appropriate
- `wp_link_pages()` for paginated content where appropriate

Add appropriate theme supports such as:
- `title-tag`
- `automatic-feed-links`

Use WordPress template APIs:
- `get_header()`
- `get_footer()`
- `get_sidebar()`
- `get_search_form()`
- `get_template_part()`

Test both latest-posts and static-front-page configurations.

---

# 21. Block Themes

For block themes, required files include:

    style.css
    readme.txt
    theme.json
    templates/index.html

Recommended structure:

    my-theme/
    ├── style.css
    ├── theme.json
    ├── readme.txt
    ├── functions.php
    ├── templates/
    │   ├── index.html
    │   ├── single.html
    │   ├── page.html
    │   ├── archive.html
    │   └── 404.html
    ├── parts/
    │   ├── header.html
    │   └── footer.html
    ├── patterns/
    └── assets/

Use block-theme architecture appropriately.

---

# 22. Block Template Integrity

All block templates must be valid.

Check for:
- missing closing comments
- malformed block markup
- invalid block nesting
- invalid attributes
- broken template markup

Example:

    <!-- wp:group -->
    <div class="wp-block-group">
        <!-- wp:paragraph -->
        <p>Content</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:group -->

Never leave malformed block comments.

---

# 23. theme.json

Use `theme.json` for block-theme configuration including:
- color palette
- typography
- spacing
- layout
- appearance tools
- editor configuration
- style variations
- block styles

Prefer Core-supported configuration over custom PHP/JavaScript systems.

---

# 24. Theme Settings

If the theme provides settings:
- use WordPress Settings/Options APIs
- use appropriate capabilities
- validate and sanitize all values
- namespace options with the theme prefix

Never save raw `$_POST` values.

---

# 25. Admin Pages

Custom theme admin pages should:
- use WordPress admin UI
- use appropriate capabilities
- enqueue assets only on relevant pages
- avoid affecting unrelated admin screens

Use `admin_enqueue_scripts` and inspect the relevant hook suffix.

---

# 26. Onboarding

Allowed:
- dismissible admin notice
- one-time informational message
- link to theme settings
- user-initiated onboarding

Not allowed:
- activation popups
- forced redirects
- automatic external requests
- automatic demo imports
- tracking
- hidden affiliate links

---

# 27. Content Creation

Do not create persistent site content from a theme.

Avoid creating:
- posts
- pages
- custom post types
- taxonomies
- application data

Do not make users lose important content when switching themes.

---

# 28. Selling and Upselling

Do not display obtrusive upselling.

Do not place promotional spam on the front end.

Affiliate relationships must be disclosed.

Do not use:
- spam
- keyword stuffing
- blackhat SEO
- competitor keyword spam
- misleading promotional content

---

# 29. Credit Links

A theme may have a front-facing theme-author credit link consistent with the current requirements.

Do not:
- add multiple promotional links
- hide links
- place invisible links in CSS/JS/HTML
- use deceptive anchor text

---

# 30. Screenshot

The theme screenshot must:
- represent the actual theme
- not look like an advertisement
- be appropriate for WordPress.org

Use the WordPress.org screenshot requirements as the source of truth for dimensions and format.

---

# 31. Images

All bundled images must have compatible licensing.

Do not include prohibited imagery or assets that violate WordPress.org content requirements.

---

# 32. External APIs

Do not introduce external API calls without a valid, user-consented reason and compliance with the applicable requirements.

Pay particular attention to:
- `wp_remote_get()`
- `wp_remote_post()`
- `file_get_contents()` with remote URLs
- cURL requests

Never use external calls for hidden tracking, telemetry, analytics, forced activation, or promotional behavior.

---

# 33. Database Safety

Prefer WordPress APIs.

If SQL is necessary, use `$wpdb->prepare()`.

Never concatenate untrusted input into SQL.

---

# 34. File Operations

Do not:
- write arbitrary files
- upload files without validation
- execute uploaded files
- modify WordPress core files

Use WordPress filesystem APIs where appropriate.

---

# 35. REST API

If REST API functionality exists, verify:
- permissions
- authentication
- sanitization
- validation
- escaped output
- schema
- data exposure

Application-level REST APIs generally belong in plugins rather than themes.

---

# 36. AJAX

For AJAX:
- use nonce verification where appropriate
- verify capabilities
- validate and sanitize request data
- use `wp_send_json_success()` / `wp_send_json_error()`

Never trust `$_POST`, `$_GET`, or `$_REQUEST`.

---

# 37. Dynamic Output

Use context-appropriate escaping:

    esc_html()
    esc_attr()
    esc_url()
    esc_js()
    wp_kses_post()

Sanitize input and escape output.

---

# 38. Forms

Forms must include:
- nonce protection where applicable
- capability checks where needed
- validation
- sanitization
- escaped output

Do not rely on client-side validation for security.

---

# 39. Block Patterns

When registering patterns:
- prefix custom identifiers
- ensure valid block markup
- use translatable strings
- avoid application functionality
- avoid unauthorized remote assets

Prefer Core blocks and patterns whenever possible.

---

# 40. Custom Blocks

Do not create custom blocks inside a WordPress.org theme unless the current Theme Review Requirements explicitly allow the implementation.

Prefer:
1. Core blocks
2. block patterns
3. block styles
4. theme.json

Move application functionality to a plugin.

---

# 41. Custom Post Types

Do not register custom post types in a theme.

Move this functionality into a plugin.

---

# 42. Shortcodes

Do not register custom shortcodes in the theme.

Move shortcode functionality into a plugin.

---

# 43. Custom Taxonomies

Do not register custom taxonomies in a theme.

Move them into a plugin.

---

# 44. Custom Roles

Do not create custom user roles in a theme.

Move role management into a plugin.

---

# 45. Custom MIME Types

Do not register custom MIME types in a theme.

This belongs in plugin/application functionality.

---

# 46. SEO / Analytics

Do not implement SEO engines, analytics, tracking, or marketing automation in a theme.

The theme should integrate cleanly with WordPress and existing plugins.

---

# 47. Performance

Prefer:
- conditional asset loading
- local assets
- optimized images
- modern CSS
- minimal JavaScript
- Core APIs
- efficient templates

Do not sacrifice security, accessibility, or compatibility for performance.

---

# 48. WordPress.org Compatibility

The theme should work with standard WordPress Core functionality.

Do not require proprietary hosting, custom server configuration, or proprietary services for basic theme operation.

---

# 49. Preflight Checklist

## Licensing
- [ ] GPL-compatible license
- [ ] All assets have compatible licenses
- [ ] Third-party resources documented
- [ ] Copyright information included
- [ ] No copied/cloned design
- [ ] `readme.txt` contains resources

## Privacy
- [ ] No tracking by default
- [ ] No hidden telemetry
- [ ] External communication reviewed
- [ ] User consent implemented where necessary
- [ ] Data collection documented

## Accessibility
- [ ] Skip link implemented where required
- [ ] Keyboard navigation works
- [ ] Visible focus states
- [ ] Forms are keyboard accessible
- [ ] Menus are keyboard accessible
- [ ] Interactive elements work without mouse

## Security
- [ ] No PHP warnings/notices
- [ ] No JS console errors
- [ ] Inputs validated
- [ ] Inputs sanitized
- [ ] Outputs escaped
- [ ] Nonces implemented where appropriate
- [ ] Capability checks implemented
- [ ] No deprecated APIs
- [ ] No SQL injection risks
- [ ] No XSS risks
- [ ] No privilege escalation risks

## Prefixing
- [ ] Functions prefixed
- [ ] Classes prefixed
- [ ] Constants prefixed
- [ ] Globals prefixed
- [ ] Options prefixed
- [ ] Meta keys prefixed
- [ ] Custom identifiers prefixed

## Internationalization
- [ ] User-facing strings use gettext
- [ ] Correct text domain
- [ ] Text domain matches theme slug
- [ ] No hard-coded user-facing strings

## Files
- [ ] `style.css`
- [ ] `readme.txt`
- [ ] Required block-theme files if applicable
- [ ] No `.git`
- [ ] No temporary files
- [ ] No ZIP files inside theme
- [ ] No logs
- [ ] No SQL dumps
- [ ] No local configuration
- [ ] No credentials
- [ ] No development artifacts

## Assets
- [ ] Assets loaded using WordPress APIs
- [ ] No unnecessary CDN
- [ ] No unauthorized remote resources
- [ ] Original source files included for minified assets
- [ ] WordPress-provided libraries reused

## Classic Theme
- [ ] Valid DOCTYPE
- [ ] `language_attributes()`
- [ ] `wp_head()`
- [ ] `wp_body_open()`
- [ ] `body_class()`
- [ ] `wp_footer()`
- [ ] `post_class()`
- [ ] `wp_link_pages()`
- [ ] `title-tag`
- [ ] `automatic-feed-links`
- [ ] Correct front-page behavior
- [ ] Correct template APIs

## Block Theme
- [ ] `style.css`
- [ ] `readme.txt`
- [ ] `theme.json`
- [ ] `templates/index.html`
- [ ] Valid block markup
- [ ] No malformed block comments
- [ ] Correct template structure
- [ ] Appropriate use of `theme.json`

## Functionality
- [ ] No CPTs
- [ ] No custom roles
- [ ] No custom taxonomies
- [ ] No custom MIME types
- [ ] No custom shortcodes
- [ ] No application functionality
- [ ] No analytics
- [ ] No SEO engine
- [ ] No contact-form application
- [ ] No caching system
- [ ] No session manipulation

## Admin
- [ ] Correct capabilities
- [ ] Admin notices use `admin_notices`
- [ ] Notices dismissible
- [ ] No activation popup
- [ ] No forced redirect
- [ ] No automatic plugin installation
- [ ] No unauthorized demo import
- [ ] No hidden external calls
- [ ] No tracking/affiliate abuse

## Promotion
- [ ] No spam
- [ ] No keyword stuffing
- [ ] No blackhat SEO
- [ ] No obtrusive upselling
- [ ] Affiliate disclosure where applicable
- [ ] Credit links comply with requirements

---

# 50. Automated Checks

When possible, run:

    wp theme list

Enable WordPress debugging in a development environment:

    define( 'WP_DEBUG', true );
    define( 'WP_DEBUG_LOG', true );
    define( 'WP_DEBUG_DISPLAY', false );

Check PHP syntax:

    find . -name "*.php" -print0 | xargs -0 -n1 php -l

Search for potentially sensitive patterns:

    grep -R "eval(" .
    grep -R "base64_decode(" .
    grep -R "wp_remote_get(" .
    grep -R "wp_remote_post(" .
    grep -R "register_post_type(" .
    grep -R "register_taxonomy(" .
    grep -R "add_shortcode(" .
    grep -R "wp_insert_post(" .
    grep -R "update_option(" .
    grep -R "add_option(" .
    grep -R "current_user_can(" .
    grep -R "check_ajax_referer(" .

These searches are not automatically violations. Inspect context before deciding compliance.

If available, use official WordPress Theme Check tooling as an additional automated check. Automated tools are supplementary; the official requirements remain authoritative.

---

# 51. Claude Development Behavior

When Claude creates or modifies a theme, continuously evaluate each change against this skill.

Before adding functionality, ask:

### Is this presentation/design functionality?
If yes, theme implementation may be appropriate.

### Does it create/manage content or application data?
If yes, prefer plugin architecture.

### Does it collect data or communicate externally?
If yes, check privacy and remote-resource requirements.

### Does it create a public namespace?
If yes, apply the theme prefix.

### Does it display user-controlled or external data?
If yes: Validate → Sanitize → Escape.

### Does it add user-facing text?
If yes, use gettext with the theme text domain.

### Does it add an external library?
If yes, check whether WordPress already provides the library.

### Does it add a remote resource?
If yes, check the WordPress.org remote-resource requirements before implementation.

---

# 52. Never Automatically Do These Things

Claude MUST NOT introduce the following into a WordPress.org theme without explicitly determining that the current requirements allow it:

    Custom Post Types
    Custom Taxonomies
    Custom Roles
    Custom Shortcodes
    Custom Blocks
    Custom MIME Types
    Analytics
    Tracking
    Telemetry
    SEO Systems
    Contact Forms
    Caching Systems
    Session Manipulation
    Automatic Plugin Installation
    Automatic Demo Import
    External API Calls
    Remote Asset Loading
    Forced Activation Redirects
    Activation Popups
    Obtrusive Upselling
    Hidden Affiliate Links
    Keyword Stuffing
    Theme Cloning
    Unlicensed Assets
    Unescaped Dynamic Output
    Unsanitized Database Input
    Unprotected AJAX
    Unauthorized Admin Actions

---

# 53. Final Compliance Report

Before completing a theme implementation, Claude MUST provide:

    WordPress.org Theme Review Status

    License: PASS / FAIL
    Privacy: PASS / FAIL
    Accessibility: PASS / FAIL
    Security: PASS / FAIL
    Prefixing: PASS / FAIL
    Internationalization: PASS / FAIL
    Files: PASS / FAIL
    Assets: PASS / FAIL
    Classic Theme Requirements: PASS / N/A
    Block Theme Requirements: PASS / N/A
    Theme Settings: PASS / N/A
    Plugin Territory: PASS / FAIL
    Admin/Onboarding: PASS / N/A
    Selling/Promotion: PASS / FAIL

    Critical Issues:
    - ...

    Warnings:
    - ...

    Recommended Improvements:
    - ...

    Overall:
    READY FOR WORDPRESS.ORG REVIEW

Claude MUST NOT report `READY FOR WORDPRESS.ORG REVIEW` if a known required violation remains unresolved.

---

# 54. Required vs Recommended

Categorize findings as:

    REQUIRED
    RECOMMENDED
    OPTIONAL

A REQUIRED violation must be fixed.

A recommendation can be reported separately without unnecessarily changing the implementation.

---

# 55. Source of Truth

Primary source:

https://make.wordpress.org/themes/handbook/review/required/

The official WordPress.org Theme Review Requirements are authoritative.

When there is a conflict between:
- a design request
- a client request
- generated UI
- a third-party framework
- a previous implementation
- a tutorial
- Claude's assumptions

and the WordPress.org Theme Review Requirements:

**The WordPress.org requirements win.**

If a requested feature conflicts with the requirements:
1. explain the conflict
2. identify the requirement
3. propose a compliant alternative
4. implement the compliant alternative when possible

The goal is to produce a secure, accessible, translatable, GPL-compatible, WordPress-native, WordPress.org-review-ready theme.

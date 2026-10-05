---
name: wp-block-theme-reviewer
description: Audits a WordPress block (FSE) theme the way an official WordPress.org Theme Review Team reviewer would — required files, style.css header, theme.json, template/template-part markup, PHP security (escaping, sanitization, nonces), i18n/text-domain consistency, enqueuing, accessibility (WCAG), and licensing/trademark issues. Trigger this whenever the user asks to review, audit, check, lint, or "theme check" a WordPress block theme or FSE theme, wants to know if a theme is ready for WordPress.org submission, asks about theme review guidelines compliance, or is debugging why a theme failed a Theme Check / review. Also use proactively whenever the user is deep in block-theme development (editing theme.json, templates/*.html, parts/*.html, functions.php of a block theme) and asks for a general code review — a full theme audit will usually be more useful than a narrow one. Covers wpblockfolio/foliohub-style FSE themes and any other WP block theme.
---

# WordPress Block Theme Reviewer

Acts as a WordPress.org Theme Review Team reviewer auditing a **block theme (FSE)** against the
[Theme Review Guidelines](https://make.wordpress.org/themes/handbook/review/required/), the
[Theme Check plugin](https://wordpress.org/plugins/theme-check/) rule set, and current block-theme
(`theme.json`, block templates, template parts, patterns) conventions. The goal is a report that
reads like real reviewer feedback: every finding is labeled by severity, cites the exact file and
line, and explains *why* it would get flagged — not a vague "looks good" pass.

This skill does NOT replace actually installing Theme Check or the Theme Sniffer plugin inside
WordPress — recommend the user also run those as a final check before submission. What this skill
gives is a fast, thorough first pass covering the things those tools catch plus things they don't
(theme.json correctness, FSE template structure, genuine accessibility review, design/UX judgment).

## Workflow

1. **Locate the theme.** Find the theme root (contains `style.css` with a `Theme Name:` header).
   If the user hasn't pointed at a path/upload, ask once, or use the only theme-like directory
   present. If multiple themes are candidates (e.g. a monorepo), ask which one.

2. **Run the automated scan first.** Always run this before manual review — it catches the
   mechanical stuff fast and tells you where to focus manual attention:

   ```bash
   python3 /mnt/skills/.../wp-block-theme-reviewer/scripts/audit_theme.py /path/to/theme
   ```

   (Copy `scripts/audit_theme.py` to a writable location first if needed, same as any read-only
   skill asset.) It prints findings grouped by severity with file:line references. Treat its output
   as a checklist of things to go verify by reading the actual code — it's a grep-based scanner, not
   a parser, so **confirm every REQUIRED/CRITICAL finding by opening the file** before reporting it;
   false positives happen (e.g. a string correctly escaped two lines earlier in a multi-line
   statement). Never report a scanner finding you haven't personally verified in the source.

3. **Read the reference docs for areas the scan flagged, or that need judgment the scanner can't
   provide.** Don't load all of them up front — pull in only what's relevant to this theme:
   - `references/required-files-and-header.md` — style.css header fields, readme.txt, screenshot,
     license file, directory structure requirements. Read this always; it's the fastest pass/fail.
   - `references/code-quality-security.md` — escaping/sanitization/validation, nonces, enqueuing
     scripts/styles correctly, no PHP short tags, no direct DB queries when an API exists, deprecated
     functions, theme not hooking into things it shouldn't.
   - `references/fse-block-theme.md` — `theme.json` schema/version correctness, required templates
     (`index.html` at minimum), template-part registration, block patterns, `style variations`,
     `fontFamilies`/`fontSizes` structure, use of `theme.json` settings vs. hardcoded CSS.
   - `references/accessibility.md` — skip links, landmark roles, color contrast, focus states, form
     labels, alt text expectations, keyboard navigation, reduced-motion handling (relevant to
     anything animated, like a marquee block).
   - `references/i18n-and-licensing.md` — text-domain consistency, translator comments for strings
     with placeholders, GPL-compatibility of bundled assets (fonts, images, icon fonts, JS libs),
     trademark issues in the theme name.

4. **Do the manual read-through.** For a block theme specifically, always open and actually read:
   - `style.css` (header block, not the CSS body)
   - `theme.json`
   - `templates/index.html` and every other file in `templates/`
   - everything in `parts/`
   - `functions.php` (and any `inc/*.php` it pulls in) — this is where most REQUIRED-level
     violations live (missing escaping, missing sanitization, improper enqueuing)
   - `readme.txt`
   - any custom blocks/patterns under `patterns/` or a custom `blocks/` directory

5. **Write the report.** Structure every review this way, strictly in this order:

   - **Summary** — 2-4 sentences: would this pass WordPress.org Theme Review as-is? If not, what's
     the single biggest blocker?
   - **🛑 Required (would fail review)** — things that must be fixed. Each item: file:line,
     what's wrong, why it's required (cite the guideline), the fix.
   - **⚠️ Recommended** — not a hard blocker but strongly expected / best practice. Same format.
   - **♿ Accessibility** — called out separately even though some items overlap with Required,
     because accessibility issues are easy to skim past when mixed into a long list.
   - **🧹 Code quality / nitpicks** — minor stuff: naming consistency, dead code, redundant CSS.
   - **✅ What's already solid** — a short honest list. A real reviewer-style report isn't just a
     wall of complaints, and it helps the user know what not to touch.

   Keep each finding to 1-3 sentences. Link findings to the specific guideline they violate when
   there's a clear one (cite it by name, e.g. "Theme Review Guideline: Theme Specific Functionality
   must be optional" or "all output must be escaped"), not just "this looks risky."

6. **If the user asks to fix issues rather than just report them**, fix the Required items first,
   confirm with the user before touching design/CSS choices that are subjective (Recommended/nitpick
   tier), and re-run the scan afterward to confirm the fix actually resolved the finding.

## Scope notes

- This skill is for **block themes** (FSE: `theme.json` + HTML templates). If the theme turns out to
  be a classic PHP-template theme (`index.php`, `header.php`, etc., no `theme.json`), say so and
  still review it, but skip `fse-block-theme.md` and instead check for classic-theme equivalents
  (`get_header()`/`get_footer()` usage, `wp_head()`/`wp_footer()` calls, template hierarchy files) —
  note explicitly that the FSE-specific checks were skipped because the theme isn't FSE.
- Don't rubber-stamp. If nothing is flagged in a section, say "no issues found" rather than omitting
  the section — an omitted section reads as "not checked," which undermines the whole report's
  credibility as a thorough audit.
- WordPress.org's actual guidelines evolve. If the user needs a citation on a point this skill's
  references don't cover, or a guideline that may have changed, search
  `https://make.wordpress.org/themes/handbook/review/` rather than guessing.

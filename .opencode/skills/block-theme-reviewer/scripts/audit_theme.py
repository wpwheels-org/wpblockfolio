#!/usr/bin/env python3
"""
audit_theme.py — fast grep-style static scan of a WordPress block theme.

This is a FIRST PASS, not a full reviewer. It is intentionally regex/heuristic-based
(no PHP/JSON AST parsing beyond basic json.load for theme.json), so it WILL produce some
false positives. Every finding must be manually verified by reading the actual source
before being reported to the user — that verification step lives in SKILL.md, not here.

Usage:
    python3 audit_theme.py /path/to/theme
"""

import json
import os
import re
import sys
from pathlib import Path

SEVERITY_REQUIRED = "REQUIRED"
SEVERITY_RECOMMENDED = "RECOMMENDED"
SEVERITY_A11Y = "ACCESSIBILITY"
SEVERITY_NIT = "NITPICK"

findings = []


def flag(severity, file, line, message):
    findings.append(
        {
            "severity": severity,
            "file": str(file),
            "line": line,
            "message": message,
        }
    )


def read_lines(path):
    try:
        with open(path, "r", encoding="utf-8", errors="replace") as f:
            return f.readlines()
    except OSError:
        return []


def scan_style_css(theme_dir):
    style = theme_dir / "style.css"
    if not style.exists():
        flag(SEVERITY_REQUIRED, "style.css", 0, "style.css is missing entirely.")
        return

    lines = read_lines(style)
    header_text = "".join(lines[:60])  # header block is always near the top

    required_fields = {
        "Theme Name": r"Theme Name\s*:",
        "Version": r"Version\s*:",
        "License": r"License\s*:",
        "License URI": r"License URI\s*:",
        "Text Domain": r"Text Domain\s*:",
    }
    for label, pattern in required_fields.items():
        if not re.search(pattern, header_text, re.IGNORECASE):
            flag(
                SEVERITY_REQUIRED,
                "style.css",
                0,
                f"Missing '{label}:' field in the style.css header block.",
            )

    recommended_fields = {
        "Theme URI": r"Theme URI\s*:",
        "Author URI": r"Author URI\s*:",
        "Requires at least": r"Requires at least\s*:",
        "Tested up to": r"Tested up to\s*:",
        "Requires PHP": r"Requires PHP\s*:",
    }
    for label, pattern in recommended_fields.items():
        if not re.search(pattern, header_text, re.IGNORECASE):
            flag(
                SEVERITY_RECOMMENDED,
                "style.css",
                0,
                f"Missing '{label}:' field in the style.css header block.",
            )

    m = re.search(r"Tags\s*:\s*(.+)", header_text, re.IGNORECASE)
    if m and "accessibility-ready" in m.group(1).lower():
        flag(
            SEVERITY_A11Y,
            "style.css",
            0,
            "Theme claims 'accessibility-ready' tag — every item in "
            "references/accessibility.md must be treated as REQUIRED, not just recommended. "
            "Verify all of them explicitly.",
        )


def scan_required_files(theme_dir):
    required = {
        "readme.txt": SEVERITY_REQUIRED,
        "theme.json": SEVERITY_REQUIRED,
    }
    for fname, sev in required.items():
        if not (theme_dir / fname).exists():
            flag(sev, fname, 0, f"{fname} is missing.")

    if not list(theme_dir.glob("screenshot.*")):
        flag(SEVERITY_REQUIRED, "screenshot.png", 0, "No screenshot file found (screenshot.png/.jpg/.gif).")

    if not (theme_dir / "LICENSE").exists() and not (theme_dir / "license.txt").exists():
        flag(
            SEVERITY_REQUIRED,
            "LICENSE",
            0,
            "No LICENSE or license.txt file found in the theme root.",
        )

    index_html = theme_dir / "templates" / "index.html"
    if not index_html.exists():
        flag(
            SEVERITY_REQUIRED,
            "templates/index.html",
            0,
            "templates/index.html is missing — this is the required fallback block template.",
        )


def scan_theme_json(theme_dir):
    path = theme_dir / "theme.json"
    if not path.exists():
        return

    raw = "".join(read_lines(path))
    try:
        data = json.loads(raw)
    except json.JSONDecodeError as e:
        flag(SEVERITY_REQUIRED, "theme.json", e.lineno, f"theme.json is not valid JSON: {e.msg}")
        return

    if "$schema" not in data:
        flag(SEVERITY_RECOMMENDED, "theme.json", 0, "Missing '$schema' key.")

    version = data.get("version")
    if version is None:
        flag(SEVERITY_REQUIRED, "theme.json", 0, "Missing 'version' key.")
    elif version not in (2, 3):
        flag(SEVERITY_REQUIRED, "theme.json", 0, f"'version' is {version!r}; expected 2 or 3.")

    settings = data.get("settings", {})
    if not settings.get("color", {}).get("palette"):
        flag(SEVERITY_RECOMMENDED, "theme.json", 0, "No settings.color.palette defined.")
    if not settings.get("typography", {}).get("fontSizes"):
        flag(SEVERITY_RECOMMENDED, "theme.json", 0, "No settings.typography.fontSizes defined.")
    layout = settings.get("layout", {})
    if not layout.get("contentSize") and not layout.get("wideSize"):
        flag(SEVERITY_RECOMMENDED, "theme.json", 0, "No settings.layout.contentSize/wideSize defined.")

    # cross-check registered templates/parts against files on disk
    registered_templates = {t.get("name") for t in data.get("customTemplates", [])}
    registered_parts = {p.get("name") for p in data.get("templateParts", [])}

    templates_dir = theme_dir / "templates"
    if templates_dir.exists():
        for f in templates_dir.glob("*.html"):
            slug = f.stem
            if slug != "index" and slug not in registered_templates:
                flag(
                    SEVERITY_RECOMMENDED,
                    f"templates/{f.name}",
                    0,
                    f"Template '{slug}' isn't listed in theme.json 'customTemplates' "
                    "(won't show a friendly name in the site editor's template picker).",
                )

    parts_dir = theme_dir / "parts"
    if parts_dir.exists():
        for f in parts_dir.glob("*.html"):
            slug = f.stem
            if slug not in registered_parts:
                flag(
                    SEVERITY_RECOMMENDED,
                    f"parts/{f.name}",
                    0,
                    f"Template part '{slug}' isn't listed in theme.json 'templateParts'.",
                )


PHP_ECHO_UNESCAPED = re.compile(
    r"""
    (?:echo|print)\s+
    (?!\s*(?:esc_html|esc_attr|esc_url|esc_textarea|esc_js|wp_kses|__\(|_e\(|
        esc_html__|esc_html_e|esc_attr__|esc_attr_e))
    \$[A-Za-z_][A-Za-z0-9_]*
    """,
    re.VERBOSE,
)

PHP_SHORT_ECHO_UNESCAPED = re.compile(
    r"""<\?=\s*
    (?!\s*(?:esc_html|esc_attr|esc_url|esc_textarea|esc_js|wp_kses))
    \$[A-Za-z_][A-Za-z0-9_]*
    """,
    re.VERBOSE,
)

RAW_SUPERGLOBAL = re.compile(r"\$_(GET|POST|REQUEST|COOKIE|SERVER)\[")

SANITIZE_NEARBY = re.compile(
    r"(sanitize_|absint\(|intval\(|esc_|wp_kses|floatval\(|is_numeric)"
)

HARDCODED_ASSET_TAG = re.compile(
    r"<(script|link)\b[^>]*\b(src|href)\s*=\s*[\"'](?!<\?php)", re.IGNORECASE
)

GOOGLE_FONTS_REMOTE = re.compile(r"fonts\.googleapis\.com", re.IGNORECASE)

DEPRECATED_FUNCS = [
    "create_function(",
    "each(",
    "mysql_query(",
    "mysql_connect(",
    "eval(",
]

SHORTCODE_REG = re.compile(r"add_shortcode\s*\(")
CUSTOM_WIDGET_REG = re.compile(r"register_widget\s*\(")

DEBUG_CALLS = re.compile(r"\b(var_dump|print_r|error_log)\s*\(")

NONCE_VERIFY = re.compile(r"(wp_verify_nonce|check_admin_referer|check_ajax_referer)\s*\(")
NONCE_FIELD = re.compile(r"wp_nonce_field\s*\(")


def scan_php_files(theme_dir):
    php_files = list(theme_dir.rglob("*.php"))
    any_nonce_field = False
    any_nonce_verify = False

    for path in php_files:
        rel = path.relative_to(theme_dir)
        lines = read_lines(path)
        full_text = "".join(lines)

        if NONCE_FIELD.search(full_text):
            any_nonce_field = True
        if NONCE_VERIFY.search(full_text):
            any_nonce_verify = True

        for i, line in enumerate(lines, start=1):
            stripped = line.strip()
            if stripped.startswith("//") or stripped.startswith("*") or stripped.startswith("#"):
                continue

            if PHP_ECHO_UNESCAPED.search(line) or PHP_SHORT_ECHO_UNESCAPED.search(line):
                flag(
                    SEVERITY_REQUIRED,
                    rel,
                    i,
                    "Possible unescaped output (echo/print of a variable without an obvious "
                    "esc_*()/wp_kses() wrapper on this line). VERIFY by reading context — "
                    "escaping could be applied earlier in a multi-line statement, or this "
                    "could be a false positive.",
                )

            if RAW_SUPERGLOBAL.search(line) and not SANITIZE_NEARBY.search(line):
                flag(
                    SEVERITY_REQUIRED,
                    rel,
                    i,
                    "Raw superglobal access ($_GET/$_POST/etc.) with no sanitization function "
                    "visible on this line. VERIFY: sanitization may happen when the value is "
                    "assigned elsewhere.",
                )

            if HARDCODED_ASSET_TAG.search(line):
                flag(
                    SEVERITY_REQUIRED,
                    rel,
                    i,
                    "Hardcoded <script>/<link> tag outputting an asset URL directly instead of "
                    "via wp_enqueue_script()/wp_enqueue_style().",
                )

            if GOOGLE_FONTS_REMOTE.search(line):
                flag(
                    SEVERITY_REQUIRED,
                    rel,
                    i,
                    "References fonts.googleapis.com — fonts must be self-hosted/bundled, not "
                    "loaded remotely from Google (licensing + privacy/GDPR concern).",
                )

            for dep in DEPRECATED_FUNCS:
                if dep in line:
                    flag(
                        SEVERITY_REQUIRED,
                        rel,
                        i,
                        f"Use of deprecated/discouraged function: {dep.rstrip('(')}().",
                    )

            if SHORTCODE_REG.search(line):
                flag(
                    SEVERITY_REQUIRED,
                    rel,
                    i,
                    "add_shortcode() found — themes must not register shortcodes "
                    "(plugin-territory functionality per Theme Review Guidelines).",
                )

            if CUSTOM_WIDGET_REG.search(line):
                flag(
                    SEVERITY_RECOMMENDED,
                    rel,
                    i,
                    "register_widget() found — custom widget classes are discouraged in a "
                    "block theme; consider a block/pattern instead, and confirm this isn't "
                    "plugin-territory functionality.",
                )

            if DEBUG_CALLS.search(line):
                flag(
                    SEVERITY_NIT,
                    rel,
                    i,
                    "Debug call left in (var_dump/print_r/error_log) — remove before release.",
                )

    if any_nonce_field and not any_nonce_verify:
        flag(
            SEVERITY_REQUIRED,
            "(theme-wide)",
            0,
            "wp_nonce_field() is used somewhere but no matching "
            "wp_verify_nonce()/check_admin_referer()/check_ajax_referer() call was found "
            "anywhere in the theme's PHP. VERIFY — the nonce may be checked in a way this "
            "scanner didn't match.",
        )


UNCLOSED_BLOCK_COMMENT_HINT = re.compile(r"<!--\s*wp:")


def scan_templates_and_parts(theme_dir):
    for subdir in ("templates", "parts"):
        d = theme_dir / subdir
        if not d.exists():
            continue
        for f in d.glob("*.html"):
            rel = f.relative_to(theme_dir)
            text = "".join(read_lines(f))
            opens = len(re.findall(r"<!--\s*wp:[a-zA-Z0-9/_-]+(?:\s+\{[^}]*\})?\s*-->", text))
            opens_with_children = len(
                re.findall(r"<!--\s*wp:[a-zA-Z0-9/_-]+(?:\s+\{[^}]*\})?\s*-->(?!\s*<!--\s*/wp:)", text)
            )
            closes = len(re.findall(r"<!--\s*/wp:[a-zA-Z0-9/_-]+\s*-->", text))
            self_closing = len(re.findall(r"<!--\s*wp:[a-zA-Z0-9/_-]+(?:\s+\{[^}]*\})?\s*/-->", text))
            # Rough balance heuristic only — not a real parser.
            if (opens - self_closing) != closes:
                flag(
                    SEVERITY_RECOMMENDED,
                    rel,
                    0,
                    "Possible mismatched block comment open/close tags (rough heuristic count "
                    f"mismatch: {opens - self_closing} openers vs {closes} closers, "
                    f"{self_closing} self-closing). VERIFY manually — a mismatch here can cause "
                    "'this block contains unexpected or invalid content' errors.",
                )

            for i, line in enumerate(text.splitlines(), start=1):
                if re.search(r"lorem ipsum", line, re.IGNORECASE):
                    flag(
                        SEVERITY_REQUIRED,
                        rel,
                        i,
                        "Lorem ipsum placeholder text left in template markup.",
                    )
                if re.search(r"<img\b(?![^>]*\balt\s*=)", line, re.IGNORECASE):
                    flag(
                        SEVERITY_A11Y,
                        rel,
                        i,
                        "<img> tag with no 'alt' attribute found.",
                    )
                if re.search(r"outline\s*:\s*(none|0)", line, re.IGNORECASE):
                    flag(
                        SEVERITY_A11Y,
                        rel,
                        i,
                        "outline: none/0 found — verify a visible :focus-visible replacement "
                        "style exists, or this removes keyboard focus indication.",
                    )


def scan_patterns(theme_dir):
    patterns_dir = theme_dir / "patterns"
    if not patterns_dir.exists():
        return
    for f in patterns_dir.glob("*.php"):
        rel = f.relative_to(theme_dir)
        text = "".join(read_lines(f))
        header = text[:500]
        for field in ("Title:", "Slug:"):
            if field not in header:
                flag(
                    SEVERITY_REQUIRED,
                    rel,
                    0,
                    f"Pattern file missing '{field}' in its header comment block.",
                )


def scan_css_for_reduced_motion(theme_dir):
    css_files = list(theme_dir.rglob("*.css")) + list(theme_dir.rglob("*.scss"))
    has_animation = False
    has_reduced_motion = False
    animation_files = []
    for f in css_files:
        text = "".join(read_lines(f))
        if re.search(r"@keyframes|animation\s*:", text):
            has_animation = True
            animation_files.append(f.relative_to(theme_dir))
        if "prefers-reduced-motion" in text:
            has_reduced_motion = True

    if has_animation and not has_reduced_motion:
        flag(
            SEVERITY_A11Y,
            ", ".join(str(f) for f in animation_files) or "(css)",
            0,
            "CSS animations/@keyframes found but no '@media (prefers-reduced-motion: reduce)' "
            "rule anywhere in the theme's stylesheets.",
        )


def main():
    if len(sys.argv) != 2:
        print("Usage: python3 audit_theme.py /path/to/theme", file=sys.stderr)
        sys.exit(1)

    theme_dir = Path(sys.argv[1]).resolve()
    if not theme_dir.is_dir():
        print(f"Not a directory: {theme_dir}", file=sys.stderr)
        sys.exit(1)

    scan_style_css(theme_dir)
    scan_required_files(theme_dir)
    scan_theme_json(theme_dir)
    scan_php_files(theme_dir)
    scan_templates_and_parts(theme_dir)
    scan_patterns(theme_dir)
    scan_css_for_reduced_motion(theme_dir)

    order = [SEVERITY_REQUIRED, SEVERITY_A11Y, SEVERITY_RECOMMENDED, SEVERITY_NIT]
    findings.sort(key=lambda f: (order.index(f["severity"]), str(f["file"]), f["line"]))

    if not findings:
        print("No automated findings. Proceed to manual review — this scanner is a first pass only.")
        return

    current_severity = None
    for f in findings:
        if f["severity"] != current_severity:
            current_severity = f["severity"]
            print(f"\n=== {current_severity} ===")
        loc = f"{f['file']}:{f['line']}" if f["line"] else str(f["file"])
        print(f"  [{loc}] {f['message']}")

    print(f"\n{len(findings)} total findings. REMEMBER: verify every one against the actual "
          f"source before reporting it — this is a regex scanner, not a parser, and will have "
          f"false positives.")


if __name__ == "__main__":
    main()

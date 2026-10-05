# Accessibility

Apply this section fully regardless of whether the theme claims the `accessibility-ready` tag —
basic accessibility is good practice either way. If the theme **does** claim that tag, every item
here becomes a **Required** fix rather than Recommended, since misusing the tag is a hard fail
(see required-files-and-header.md).

## Keyboard & focus

- Every interactive element (links, buttons, form controls, custom nav toggles) must be reachable
  via Tab and have a visible focus indicator — flag any CSS that does `outline: none` /
  `outline: 0` without providing a replacement focus style (`:focus-visible` with a visible
  box-shadow/outline substitute). This is one of the most common accessibility-ready rejections.
- Dropdown/mobile menus must be operable via keyboard alone (Enter/Space to open, Escape to close,
  arrow keys to navigate submenus where applicable) — if nav toggle behavior is custom JS, actually
  check it handles keyboard events, not just `click`.
- No keyboard traps — a user tabbing through must always be able to continue past any component.

## Skip link

- Templates should include a "Skip to content" link as the first focusable element, pointing to
  the main content landmark (`#main` / `#content`), visually hidden until focused. Flag as
  **Required** (for accessibility-ready) or **Recommended** otherwise if missing.

## Landmarks & semantic structure

- Exactly one `<main>` per page.
- `<nav>` for navigation menus (via `wp:navigation`, which outputs this correctly by default —
  flag if a custom nav implementation uses a plain `<div>` instead).
- Heading hierarchy should be logical (one `<h1>` per page, no skipped levels like `h2` straight to
  `h4`) — check template-part and pattern markup for this, it's easy to get wrong when patterns are
  composed from arbitrary heading blocks.
- `role="banner"`/`role="contentinfo"` are implicit with `<header>`/`<footer>` at the top level —
  don't flag their absence as explicit ARIA attributes, but do flag if `<header>`/`<footer>` tags
  are used in a *nested* context where the implicit landmark role would be wrong (e.g. a `<header>`
  inside an `<article>` for a post's own header is fine and intentional — just verify it's not
  creating a second competing page-level banner).

## Color contrast

- Check `theme.json`'s color palette combinations actually used together (text-on-background,
  button text-on-button-background, link color-on-background) against WCAG AA minimums: 4.5:1 for
  normal text, 3:1 for large text (≥18pt / ≥14pt bold) and UI components/graphical objects.
  Flag any combination that's visibly low-contrast (light gray on white, etc.) as **Required** for
  accessibility-ready, **Recommended** otherwise.
- Don't rely on color alone to convey state/meaning (e.g. error states, "current page" nav
  indicators) — there should be a secondary indicator (icon, underline, bold).

## Images & media

- All `<img>` tags (in patterns, template parts, demo content) need meaningful `alt` text — decorative
  images should have `alt=""` (empty, not missing) rather than no alt attribute at all, or use
  `aria-hidden="true"` if wrapped in a way that makes them purely decorative.
- Background images used to convey actual content (not pure decoration) need an accessible text
  alternative elsewhere on the page.

## Forms

- Every form input needs an associated `<label>` (via `for`/`id` pairing, or visually-hidden label
  text — not just a `placeholder` attribute, which is not a substitute for a label and disappears
  on input).
- Required fields should be indicated both visually and programmatically (`required` attribute /
  `aria-required="true"`), not color alone.
- Error messages should be programmatically associated with their field (`aria-describedby`) and
  announced (e.g. via `aria-live` region or focus management), not just colored red text.

## Motion & animation

Directly relevant to anything like a marquee/carousel/auto-scrolling block:
- Any auto-playing, continuously-moving, or auto-advancing content (marquees, carousels, animated
  backgrounds) **must** respect `prefers-reduced-motion` — verify there's a
  `@media (prefers-reduced-motion: reduce)` rule that stops/removes the animation, not just slows it.
  Flag as **Required** for accessibility-ready, **Recommended** (but strongly so) otherwise — WCAG
  2.2.2 (Pause, Stop, Hide) also expects user-controllable pausing for anything that auto-moves for
  more than 5 seconds, so a hover-to-pause affordance (common on marquees) helps but
  `prefers-reduced-motion` support is the baseline that should never be skipped.
- Nothing should flash more than 3 times per second (seizure risk) — relevant if any theme feature
  does rapid flashing/strobing effects.

## Text & readability

- Body text should not be set in `px` in a way that ignores user browser font-size settings —
  prefer relative units (`rem`/`em`) so zoom and OS-level text-size preferences work.
- Line length, line height should be reasonable for readability (not strictly enforced by
  reviewers, but worth a Recommended note if egregious — e.g. full-width unconstrained body text).
- Content must remain usable at 200% browser zoom without horizontal scrolling or content loss —
  spot-check this if the theme has any fixed-width elements outside normal content flow.

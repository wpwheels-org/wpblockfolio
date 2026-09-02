=== WPBlockfolio ===
Contributors: wpwheels
Requires at least: 6.4
Tested up to: 6.6
Requires PHP: 7.4
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.en.html
Tags: portfolio, grid-layout, one-page, one-column, two-columns, block-patterns, block-styles, custom-logo, custom-menu, editor-style, featured-images, full-site-editing, full-width-template, style-variations, template-editing, theme-options, wide-blocks

A clean, one-page portfolio & resume block theme for freelancers, designers and developers, built with full site editing (FSE).

== Description ==

WPBlockfolio is a Full Site Editing (block) theme. Every part of the design — colors, type, spacing, header, footer, and each homepage section — is editable in the Site Editor (Appearance → Editor). No page builder or shortcodes are required.

== Installation ==

1. In WordPress, go to Appearance → Themes → Add New → Upload Theme.
2. Upload the wpblockfolio.zip file and click Activate.
3. Go to Appearance → Editor → Pages → Front Page. If your homepage doesn't already show the one-page layout, create/edit a Page, set it as the site's static front page under Settings → Reading, and the "Front Page (Portfolio One-Page)" template will apply automatically — or simply leave the front page setting as "Your latest posts" and WPBlockfolio's front-page.html template still renders the full one-page layout.
4. Replace the placeholder photo, name, bio, skills, timeline entries, project images and contact details directly in the editor — click any block to edit it in place.
5. Each homepage section (Hero, About, Skills, Stats, Services, Experience, Portfolio, Pricing, Testimonials, Blog, Contact) is also available on its own as a reusable pattern: Appearance → Editor → Patterns → WPBlockfolio Sections, so you can drag them into any other page too.

== Notes on the contact form ==

The Contact section includes a plain HTML form (name, email, subject, message) styled to match the theme. It does not send email by itself — connect it to a form plugin such as Contact Form 7, WPForms, or Fluent Forms, or wire up a custom `admin-post.php` handler, then swap in the plugin's shortcode/block if you'd rather not edit PHP.

== Structure ==

* theme.json — global color palette, typography (Poppins/Inter), spacing scale, and element styles
* templates/ — front-page, index, single, page, page-no-title, archive, search, 404
* parts/ — header.html, footer.html
* patterns/ — one file per homepage section, registered under the "WPBlockfolio Sections" category
* assets/css/custom.css — supplemental CSS for progress bars, timeline, card hovers, stat icons (things theme.json block supports can't express)

== Changelog ==

= 1.0.0 =
* Initial release.

== Copyright ==

WPBlockfolio is distributed under the terms of the GNU GPL v3 or later.

This theme bundles no third-party images or icon fonts.

Fonts:
* Poppins, Copyright 2014-2023 The Poppins Project Authors (https://github.com/itfoundry/Poppins)
  Licensed under the SIL Open Font License, Version 1.1
  https://scripts.sil.org/OFL

* Inter, Copyright 2020 The Inter Project Authors (https://github.com/rsms/inter)
  Licensed under the SIL Open Font License, Version 1.1
  https://scripts.sil.org/OFL

Full license text is included with each font in assets/fonts/[Font Name]/OFL.txt

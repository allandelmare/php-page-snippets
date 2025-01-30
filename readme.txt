=== Simply Simple Snippets ===
Contributors: allan-delmare
Tags: snippets, php, javascript, code injection, functions
Requires at least: 5.0
Tested up to: 6.2
Requires PHP: 7.0
Stable tag: 1.2.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Easy code injection: Add PHP and JavaScript snippets per-page, plus site-wide PHP functions.

== Description ==

Simply Simple Snippets allows you to effortlessly inject custom PHP and JavaScript code on a per-page basis, as well as manage site-wide PHP functions. Enhance your WordPress site’s functionality without modifying theme or core files.

**Features:**

* **Per-Page PHP Snippets:** Add custom PHP code to individual pages.
* **Per-Page JavaScript Snippets:** Insert custom JavaScript into specific pages’ `<head>` section.
* **Site-Wide PHP Functions:** Manage PHP functions that apply across your entire site.
* **Secure and Safe:** Utilizes nonces and capability checks to ensure only authorized users can add or modify snippets.
* **User-Friendly Interface:** Intuitive meta boxes and settings pages for easy snippet management.

== Installation ==

1. **Upload the Plugin:**
   - Download the plugin zip file.
   - In your WordPress dashboard, go to `Plugins` > `Add New`.
   - Click on `Upload Plugin` and select the downloaded zip file.
   - Click `Install Now` and then `Activate`.

2. **Activate the Plugin:**
   - After installation, activate the plugin to start using Simply Simple Snippets.

== Usage ==

=== Adding PHP Snippets to a Page ===

1. **Edit a Page:**
   - Go to `Pages` > `All Pages`.
   - Click `Edit` on the desired page.

2. **Add PHP Snippet:**
   - Locate the `PHP Snippet` meta box.
   - Enter your PHP code without the `<?php` tags.
   - Click `Update` to save.

=== Adding JavaScript Snippets to a Page ===

1. **Edit a Page:**
   - Go to `Pages` > `All Pages`.
   - Click `Edit` on the desired page.

2. **Add JavaScript Snippet:**
   - Locate the `JavaScript Snippet` meta box.
   - Enter your JavaScript code without the `<script>` tags.
   - Click `Update` to save.

=== Managing Site-Wide PHP Functions ===

1. **Access Settings:**
   - Navigate to `Settings` > `Simple Snippets`.

2. **Add PHP Functions:**
   - In the `Site-wide PHP Functions` section, enter your PHP code without the `<?php` tags.
   - Click `Save Site-wide Functions` to apply.

== Changelog ==

= 1.2.0 =
* Improved security with enhanced nonce verification.
* Added support for complex PHP functions.
* Enhanced error handling for PHP snippets.

= 1.1.0 =
* Introduced JavaScript snippet functionality.
* Improved user interface for snippet management.

= 1.0.0 =
* Initial release with PHP snippet capabilities.

== Frequently Asked Questions ==

= Can I use this plugin for free? =
Yes, Simply Simple Snippets is completely free and open-source.

= Is there any warranty? =
No, this plugin is provided as-is without any warranty.

== Screenshots ==

1. **PHP Snippet Meta Box:** Add custom PHP snippets to individual pages.
2. **JavaScript Snippet Meta Box:** Insert JavaScript into specific pages.
3. **Site-Wide Functions:** Manage PHP functions that apply across the entire site.

== Upgrade Notice ==

= 1.2.0 =
Improved security measures and enhanced error handling for a more robust experience.

== License ==

This plugin is licensed under the GNU General Public License v2.0 or later. See the [LICENSE](LICENSE) file for details.
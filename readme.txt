=== PHP Page Snippets ===
Contributors: allandelmare
Tags: php, snippets, code, page, metabox, developer
Requires at least: 5.0
Tested up to: 6.4
Stable tag: 1.0.0
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Add PHP code snippets to individual WordPress pages through a simple metabox interface.

== Description ==

PHP Page Snippets adds a metabox to WordPress pages where administrators can add PHP code snippets that will only execute on that specific page. This is useful for adding custom PHP functionality to individual pages without modifying theme files.

**Features:**

* Add PHP code snippets to individual pages
* Snippets only execute on their specific pages
* Simple and clean interface
* Security measures to prevent unauthorized access
* Error handling with admin-only error messages

**Security Features:**

* Nonce verification for all operations
* Capability checking for authorized users
* Direct file access prevention
* Snippet execution limited to single pages in main query

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/php-page-snippets` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Edit any page to find the PHP Snippet metabox where you can add your code

== Frequently Asked Questions ==

= Is it safe to allow PHP execution? =

Only users with the `edit_pages` capability can add or edit PHP snippets. Make sure you trust your page editors.

= How do I add a PHP snippet? =

1. Edit any page in WordPress
2. Scroll down to find the "PHP Snippet" metabox
3. Enter your PHP code without the opening <?php tags
4. Update/publish the page

= Where will the snippet output appear? =

The snippet output will appear at the end of the page content.

== Screenshots ==

1. PHP Snippet metabox in the page editor
2. Example of snippet output on the frontend

== Changelog ==

= 1.0.0 =
* Initial release

== Upgrade Notice ==

= 1.0.0 =
Initial release of PHP Page Snippets 
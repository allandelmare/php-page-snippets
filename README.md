# PHP Page Snippets

A WordPress plugin that allows adding PHP code snippets directly to individual pages through a metabox interface.

## Description

PHP Page Snippets adds a metabox to WordPress pages where administrators can add PHP code snippets that will only execute on that specific page. This is useful for adding custom PHP functionality to individual pages without modifying theme files.

## Installation

1. Upload the plugin files to the `/wp-content/plugins/php-page-snippets` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Edit any page to find the PHP Snippet metabox where you can add your code

## Security

- Only users with `edit_pages` capability can add/edit PHP snippets
- Nonce verification is implemented for all operations
- Direct file access is prevented
- Snippet execution is limited to single pages in the main query

## Requirements

- WordPress 5.0 or higher
- PHP 7.0 or higher

## License

This plugin is licensed under the GPL v2 or later. 
<?php
/**
 * Plugin Name: PHP Page Snippets
 * Plugin URI: https://github.com/allandelmare/php-page-snippets
 * Description: Adds a metabox to pages for PHP code snippets that run only on that page
 * Version: 1.0.0
 * Requires at least: 5.0
 * Requires PHP: 7.0
 * Author: Allan Delmare
 * Author URI: https://github.com/allandelmare
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: php-page-snippets
 * Domain Path: /languages
 *
 * PHP Page Snippets is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * PHP Page Snippets is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with PHP Page Snippets. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('PHP_PAGE_SNIPPETS_VERSION', '1.0.0');
define('PHP_PAGE_SNIPPETS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('PHP_PAGE_SNIPPETS_PLUGIN_URL', plugin_dir_url(__FILE__));

// Load the main plugin class
require_once PHP_PAGE_SNIPPETS_PLUGIN_DIR . 'includes/class-php-page-snippets.php';

// Initialize the plugin
new PHP_Page_Snippets(); 
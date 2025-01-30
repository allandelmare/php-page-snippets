<?php
// If uninstall not called from WordPress, exit
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Clean up by deleting all snippet meta data
global $wpdb;
$wpdb->delete($wpdb->postmeta, array('meta_key' => '_php_snippet')); 
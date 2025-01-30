<?php
/**
 * Plugin Name: PHP Page Snippets
 * Description: Adds a metabox to pages for PHP code snippets that run only on that page
 * Version: 1.0.0
 * Author: Allan Delmare
 * License: GPL v2 or later
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class PHP_Page_Snippets {
    
    public function __construct() {
        add_action('add_meta_boxes', array($this, 'add_php_snippet_meta_box'));
        add_action('save_post', array($this, 'save_php_snippet'));
        add_action('the_content', array($this, 'execute_php_snippet'));
    }

    public function add_php_snippet_meta_box() {
        add_meta_box(
            'php_snippet_meta_box',
            'PHP Snippet',
            array($this, 'display_php_snippet_meta_box'),
            'page',
            'normal',
            'high'
        );
    }

    public function display_php_snippet_meta_box($post) {
        // Add nonce for security
        wp_nonce_field('php_snippet_nonce', 'php_snippet_nonce');
        
        // Get existing snippet if any
        $snippet = get_post_meta($post->ID, '_php_snippet', true);
        ?>
        <p><em>Enter PHP code without <?php echo esc_html('<?php'); ?> tags. This code will only run on this page's frontend.</em></p>
        <textarea name="php_snippet" id="php_snippet" style="width: 100%; height: 200px; font-family: monospace;"><?php echo esc_textarea($snippet); ?></textarea>
        <?php
    }

    public function save_php_snippet($post_id) {
        // Check if nonce is set and valid
        if (!isset($_POST['php_snippet_nonce']) || 
            !wp_verify_nonce($_POST['php_snippet_nonce'], 'php_snippet_nonce')) {
            return;
        }

        // Check if this is an autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Check user permissions
        if (!current_user_can('edit_page', $post_id)) {
            return;
        }

        // Sanitize and save the snippet
        if (isset($_POST['php_snippet'])) {
            $snippet = wp_unslash($_POST['php_snippet']);
            update_post_meta($post_id, '_php_snippet', $snippet);
        }
    }

    public function execute_php_snippet($content) {
        // Only execute on single pages in the main query
        if (is_page() && is_main_query() && in_the_loop()) {
            $snippet = get_post_meta(get_the_ID(), '_php_snippet', true);
            
            if (!empty($snippet)) {
                ob_start();
                try {
                    eval($snippet);
                } catch (ParseError $e) {
                    if (current_user_can('edit_pages')) {
                        echo '<!-- PHP Snippet Error: ' . esc_html($e->getMessage()) . ' -->';
                    }
                }
                $snippet_output = ob_get_clean();
                $content .= $snippet_output;
            }
        }
        return $content;
    }
}

// Initialize the plugin
new PHP_Page_Snippets(); 
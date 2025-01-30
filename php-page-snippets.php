<?php
/**
 * Plugin Name: PHP Page Snippets
 * Description: Adds a metabox to pages for PHP code snippets that run only on that page and allows adding code to functions.php
 * Version: 1.1.0
 * Author: Allan Delmare
 * License: GPL v2 or later
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class PHP_Page_Snippets {
    private $options_page_slug = 'php-snippets-settings';
    private $option_name = 'php_snippets_functions';
    
    public function __construct() {
        // Original page snippet functionality
        add_action('add_meta_boxes', array($this, 'add_php_snippet_meta_box'));
        add_action('save_post', array($this, 'save_php_snippet'));
        add_action('the_content', array($this, 'execute_php_snippet'));
        
        // New functions.php snippet functionality
        add_action('admin_menu', array($this, 'add_settings_page'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('init', array($this, 'execute_functions_snippet'));
    }

    // Original meta box methods
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
        wp_nonce_field('php_snippet_nonce', 'php_snippet_nonce');
        $snippet = get_post_meta($post->ID, '_php_snippet', true);
        ?>
        <p><em>Enter PHP code without <?php echo esc_html('<?php'); ?> tags. This code will only run on this page's frontend.</em></p>
        <textarea name="php_snippet" id="php_snippet" style="width: 100%; height: 200px; font-family: monospace;"><?php echo esc_textarea($snippet); ?></textarea>
        <?php
    }

    public function save_php_snippet($post_id) {
        if (!isset($_POST['php_snippet_nonce']) || 
            !wp_verify_nonce($_POST['php_snippet_nonce'], 'php_snippet_nonce')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!current_user_can('edit_page', $post_id)) {
            return;
        }

        if (isset($_POST['php_snippet'])) {
            $snippet = wp_unslash($_POST['php_snippet']);
            update_post_meta($post_id, '_php_snippet', $snippet);
        }
    }

    public function execute_php_snippet($content) {
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

    // New settings page methods
    public function add_settings_page() {
        add_options_page(
            'PHP Snippets Settings',
            'PHP Snippets',
            'manage_options',
            $this->options_page_slug,
            array($this, 'render_settings_page')
        );
    }

    public function register_settings() {
        register_setting(
            $this->options_page_slug,
            $this->option_name,
            array(
                'type' => 'string',
                'sanitize_callback' => array($this, 'sanitize_functions_snippet')
            )
        );
    }

    public function sanitize_functions_snippet($input) {
        // Only allow super admins to save function snippets
        if (!current_user_can('manage_options')) {
            add_settings_error(
                $this->option_name,
                'insufficient_permissions',
                'You do not have permission to modify function snippets.'
            );
            return get_option($this->option_name);
        }
        return $input;
    }

    public function render_settings_page() {
        if (!current_user_can('manage_options')) {
            return;
        }

        $snippet = get_option($this->option_name, '');
        ?>
        <div class="wrap">
            <h1>PHP Snippets Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields($this->options_page_slug);
                do_settings_sections($this->options_page_slug);
                ?>
                <div class="php-snippets-functions">
                    <h2>Functions Snippet</h2>
                    <p><em>Enter PHP code without <?php echo esc_html('<?php'); ?> tags. This code will run globally like functions.php</em></p>
                    <p><strong>Warning:</strong> Be careful with the code you add here as it will affect your entire site.</p>
                    <textarea name="<?php echo esc_attr($this->option_name); ?>" 
                              id="functions-snippet" 
                              style="width: 100%; height: 400px; font-family: monospace;"
                    ><?php echo esc_textarea($snippet); ?></textarea>
                </div>
                <?php submit_button('Save Functions Snippet'); ?>
            </form>
        </div>
        <?php
    }

    public function execute_functions_snippet() {
        $snippet = get_option($this->option_name);
        if (!empty($snippet)) {
            try {
                eval($snippet);
            } catch (ParseError $e) {
                if (current_user_can('manage_options')) {
                    add_action('admin_notices', function() use ($e) {
                        ?>
                        <div class="notice notice-error">
                            <p>PHP Snippets Functions Error: <?php echo esc_html($e->getMessage()); ?></p>
                        </div>
                        <?php
                    });
                }
            }
        }
    }
}

// Initialize the plugin
new PHP_Page_Snippets();
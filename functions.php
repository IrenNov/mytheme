<?php
add_action( 'wp_enqueue_scripts', 'add_scripts_and_styles' );
add_theme_support('custom-logo' );
add_action('after_setup_theme', 'add_menu');

function add_scripts_and_styles() {
    wp_enqueue_script( 'pages_pagimation', get_template_directory_uri() . '/assets/scripts/pages_pagimation.js', array(), null, true);
    wp_enqueue_script( 'hamburger', get_template_directory_uri() . '/assets/scripts/hamburger.js', array(), null, true);
    wp_enqueue_style( 'fonts', get_template_directory_uri() . '/assets/css/fonts.css' );
    wp_enqueue_style( 'main', get_stylesheet_uri(), array('fonts'));
}

add_action('init', 'handle_subscription_form');

function handle_subscription_form() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
        $email = sanitize_email($_POST['email']);

        if (is_email($email)) {
            
            global $wpdb;
            $table_name = $wpdb->prefix . 'subscribers';

            
            if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
                $charset_collate = $wpdb->get_charset_collate();
                $sql = "CREATE TABLE $table_name (
                    id mediumint(9) NOT NULL AUTO_INCREMENT,
                    email varchar(100) NOT NULL,
                    created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
                    PRIMARY KEY  (id)
                ) $charset_collate;";
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                dbDelta($sql);
            }

            
            $exists = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table_name WHERE email = %s", $email));

            if (!$exists) {
                $wpdb->insert($table_name, ['email' => $email]);
                wp_redirect(add_query_arg('subscribed', 'true', $_SERVER['REQUEST_URI']));
                exit;
            } else {
                wp_redirect(add_query_arg('subscribed', 'already', $_SERVER['REQUEST_URI']));
                exit;
            }
        }
    }
}
function add_menu() {
    register_nav_menu( 'top', 'Главное меню' );
    register_nav_menu( 'bottom', 'Нижнее меню' );
}

?>
<?php

add_theme_support('custom-logo' );
add_action('after_setup_theme', 'add_menu');

function add_scripts_and_styles() {
    wp_enqueue_script( 'jquery' ); // Подключаем jQuery, если ещё не подключен
    wp_enqueue_script( 'pages_pagimation', get_template_directory_uri() . '/assets/scripts/pages_pagimation.js', array('jquery'), null, true );

    // Локализуем данные для работы с AJAX
    wp_localize_script( 'pages_pagimation', 'ajax_obj', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ) // URL для AJAX запросов
    ));
    wp_enqueue_script( 'hamburger', get_template_directory_uri() . '/assets/scripts/hamburger.js', array(), null, true );
    wp_enqueue_style( 'fonts', get_template_directory_uri() . '/assets/css/fonts.css' );
    wp_enqueue_style( 'main', get_stylesheet_uri(), array('fonts') );
}

add_action( 'wp_enqueue_scripts', 'add_scripts_and_styles' );


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


function load_articles_callback() {
    $posts_per_page = isset( $_POST['posts_per_page'] ) ? intval( $_POST['posts_per_page'] ) : -1; // Загружаем все записи, если posts_per_page не указан

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $posts_per_page,
        'paged'          => isset( $_POST['paged'] ) ? intval( $_POST['paged'] ) : 1,
    );

    $query = new WP_Query( $args );

    if( $query->have_posts() ) :
        while( $query->have_posts() ) : $query->the_post();
            ?>
            <li class="article-container">
                <article class="articles__item">
                    <a class="category"><?php the_category(', '); ?></a>
                    <a class="title"><h3><?php the_title(); ?></h3></a>
                    <p class="text"><?php the_excerpt(); ?></p>
                    <time class="date"><?php the_date(); ?></time>
                </article>
            </li>
            <?php
        endwhile;
    else :
        echo '<p>Статьи не найдены.</p>';
    endif;

    // Завершаем обработку запроса
    wp_reset_postdata();
    die(); // Завершаем обработку AJAX-запроса
}

add_action( 'wp_ajax_load_articles', 'load_articles_callback' );
add_action( 'wp_ajax_nopriv_load_articles', 'load_articles_callback' );



?>
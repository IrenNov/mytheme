<?php
add_action( 'wp_enqueue_scripts', 'add_scripts_and_styles' );
add_theme_support('custom-logo' );

function add_scripts_and_styles() {
    wp_enqueue_script( 'pages_pagimation', get_template_directory_uri() . '/assets/scripts/pages_pagimation.js', array(), null, true);
    wp_enqueue_script( 'hamburger', get_template_directory_uri() . '/assets/scripts/hamburger.js', array(), null, true);
    wp_enqueue_style( 'fonts', get_stylesheet_uri() . '/assets/css/fonts.css');
    wp_enqueue_style( 'main', get_stylesheet_uri(), array('fonts'));
}
?>
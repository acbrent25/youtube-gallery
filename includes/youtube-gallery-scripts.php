<?php

// Add Scripts

function yg_add_scripts(){
    wp_enqueue_style('yg-main-style', plugins_url() . '/youtube-gallery/css/style.css');
    wp_enqueue_script('yg-main-script', plugins_url() . '/youtube-gallery/js/main.js');
}

add_action('wp_enqueue_scripts', 'yg_add_scripts');
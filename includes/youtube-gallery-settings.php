<?php

function yg_settings_api_init(){
    add_settings_section(
        'yg_setting_section',
        'YouTube Video Gallery Settings',
        'yg_setting_section_callback',
        // Where we want it to show up
        'reading'
    );

    add_settings_field(
        'yg_setting_disable_fullscreen',
        'Disable Fullscreen',
        'yg_setting_disable_fullscreen_callback',
        'reading',
        'yg_setting_section'
    );

    register_setting('reading', 'yg_setting_disable_fullscreen');
}

add_action('admin_init', 'yg_settings_api_init');

function yg_setting_section_callback(){
    echo '<p>Setting for Youtube Video Gallery</p>';
}

function yg_setting_disable_fullscreen_callback(){
    echo '<input name="yg_setting_disable_fullscreen" id="yg_setting_disable_fullscreen" type="checkbox" value="1" class="code"' . checked(1, get_option('yg_setting_disable_fullscreen'), false);
}
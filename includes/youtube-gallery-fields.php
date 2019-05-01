<?php

function yg_add_fields_metabox(){
    add_meta_box(
        'yg_video_fields',
        __('Video Fields'),
        'yg_video_fields_callback',
        'video',
        'normal',
        'default'
    );
}

add_action('add_meta_boxes', 'yg_add_fields_metabox');

// Display meta box content
function yg_video_fields_callback($post){
    wp_nonce_field(basename(__FILE__), 'yg_videos_nonce');
    $yg_video_stored_meta = get_post_meta($post->ID);
    ?>

        <div class="wrap video-form">
            <div class="form-group">
                <label for="video-id"><?php esc_html_e('Video ID', 'yg-domain'); ?></label>
                <input type="text" name="video_id" id="video-id" value="<?php if(!empty($yg_video_stored_meta['video_id'])) echo esc_attr($yg_video_stored_meta['video_id'][0])?>">
            </div>
            <div class="form-group">
                <label for="details"><?php esc_html_e('Details', 'yg-domain'); ?></label>
                <?php
                    $content = get_post_meta($post->ID, 'details', true);
                    $editor = 'details';
                    $settings = array(
                        'textarea_rows' => 5,
                        'media_buttons' => false
                    );

                    wp_editor($content, $editor, $settings);
                ?>
            </div>

            <?php 
                if(isset($yg_video_stored_meta['video_id'][0])){ 
                    $vid_id = $yg_video_stored_meta['video_id'][0]; ?>
                    <style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='https://www.youtube.com/embed/<?php echo $vid_id; ?>' frameborder='0' allowfullscreen></iframe></div>
            <?php } ?>

        </div>

    <?php
}

function yg_video_save($post_id){
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce = (isset($_POST['yg_videos_nonce']) && wp_verify_nonce($_POST['yg_videos_nonce'], basename(__FILE__))) ? 'true' : 'false';

    if($is_autosave || $is_revision || !$is_valid_nonce){
        return;
    }

    if( isset($_POST['video_id'])){
        update_post_meta($post_id, 'video_id', sanitize_text_field($_POST['video_id']));
    }

    if( isset($_POST['details'])){
        update_post_meta($post_id, 'details', sanitize_text_field($_POST['details']));
    }

}

add_action('save_post', 'yg_video_save');

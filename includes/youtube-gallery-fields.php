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
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $vid_id; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <?php } ?>

        </div>

    <?php
}

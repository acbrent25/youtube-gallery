<?php
// List Videos

function yg_list_videos($atts, $content = null){
    global $post;

    $atts = shortcode_atts(array(
        'title'     => 'Video Gallery',
        'count'     => 20,
        'category'  => 'all'
    ), $atts);

    // Check Category
    if($atts['category'] == 'all'){
        $terms = '';
    } else {
        $terms = array(
            array(
                'taxonomy'  => 'category',
                'field'     => 'slug',
                'terms'     => $atts['category']
            )
        );
    }

    // Query Args
    $args = array(
        'post_type'     => 'video',
        'post_status'   => 'publish',
        'orderby'       => 'created',
        'order'         => 'DESC',
        'post_per_page' => $atts['count'],
        'tax_query'     => $terms,
    );

    // Fetch Videos
    $videos = new WP_Query($args);

    // Check for videos
    if($videos->have_posts()){
        $category = str_replace('-', ' ', $atts['category']);

        // Init Output
        $output = '';

        // Build Output
        $output .= '<div class="video-list">';

        while($videos->have_posts()){
            $videos->the_post();

            // Get field values
            $video_id = get_post_meta($post->ID, 'video_id', true);
            $details = get_post_meta($post->ID, 'details', true);

            $output .= '<div class="yg-video">';
            $output .= '<h4>'.get_the_title().'</h4>';
            if(get_option('yg_setting_disable_fullscreen')){
                $output .= '<style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class="embed-container"><iframe src="https://www.youtube.com/embed/'.$video_id.'" frameborder="0"></iframe></div>';
            } else {
                $output .= '<style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class="embed-container"><iframe src="https://www.youtube.com/embed/'.$video_id.'" frameborder="0" allowfullscreen></iframe></div>';
            }
            
            $output .= '<div>'.$details.'</div>';
            $output .= '</div><br><hr>';
        }

        $output .= '</div>';

        // Reset post data
        wp_reset_postdata();

        return $output;

    } else {
        return '<p> No Videos Found</p>';
    }
}

// Video list shortcode
add_shortcode('videos', 'yg_list_videos');
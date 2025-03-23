<?php

function lpm_add_city_meta_box() {
    add_meta_box(
        'lpm_city_meta_box',  // Unique ID
        'City Name',          // Box title
        'lpm_city_meta_box_callback', // Content callback
        'post',               // Post type
        'side',               // Context: 'normal', 'side', or 'advanced'
        'high'                // Priority
    );
}
add_action('add_meta_boxes', 'lpm_add_city_meta_box');

function lpm_city_meta_box_callback($post) {
    // Get the current value
    $city = get_post_meta($post->ID, 'lpm_city', true);
    ?>
    <label for="lpm_city">Enter City:</label>
    <input type="text" id="lpm_city" name="lpm_city" value="<?php echo esc_attr($city); ?>" style="width:100%;" />
    <?php
}

// Save the city field when post is saved
function lpm_save_city_meta_box($post_id) {
    if (array_key_exists('lpm_city', $_POST)) {
        update_post_meta($post_id, 'lpm_city', sanitize_text_field($_POST['lpm_city']));
    }
}
add_action('save_post', 'lpm_save_city_meta_box');

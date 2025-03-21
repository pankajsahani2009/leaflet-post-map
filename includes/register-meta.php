<?php

function lpm_register_location_meta() {
    register_post_meta('post', 'lpm_city', [
        'type'         => 'string',
        'single'       => true,
        'show_in_rest' => true,
    ]);
}

add_action('init', 'lpm_register_location_meta');

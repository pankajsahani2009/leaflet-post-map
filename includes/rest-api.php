<?php

function lpm_get_posts_with_location() {
    $args = [
        'post_type'      => 'post',
        'posts_per_page' => -1,
        'meta_query'     => [
            [
                'key'     => 'lpm_city',
                'compare' => 'EXISTS',
            ],
        ],
    ];
    $query = new WP_Query($args);
    
    $posts = [];
    foreach ($query->posts as $post) {
        $posts[] = [
            'title' => get_the_title($post),
            'link'  => get_permalink($post),
            'city'  => get_post_meta($post->ID, 'lpm_city', true),
        ];
    }

    return rest_ensure_response($posts);
}

function lpm_register_rest_routes() {
    register_rest_route('lpm/v1', '/locations', [
        'methods'  => 'GET',
        'callback' => 'lpm_get_posts_with_location',
    ]);
}

add_action('rest_api_init', 'lpm_register_rest_routes');

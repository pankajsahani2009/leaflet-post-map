<?php

function lpm_enqueue_scripts() {
    // Load Leaflet.js from CDN
    wp_enqueue_style('leaflet-css', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css');
    wp_enqueue_script('leaflet-js', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js', [], null, true);

    // Load custom map JavaScript and CSS
    wp_enqueue_style('lpm-style', plugin_dir_url(__FILE__) . '../assets/leaflet-style.css');
    wp_enqueue_script('lpm-map', plugin_dir_url(__FILE__) . '../assets/leaflet-map.js', ['leaflet-js'], null, true);

    // Pass the REST API URL to JavaScript
    wp_localize_script('lpm-map', 'lpmData', [
        'apiUrl' => rest_url('lpm/v1/locations'),
    ]);
}

add_action('wp_enqueue_scripts', 'lpm_enqueue_scripts');

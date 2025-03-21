<?php
/**
 * Plugin Name: Leaflet Post Map
 * Description: Adds location-based markers for blog posts using Leaflet.js.
 * Version: 1.0
 * Author: Pankaj Sahani
 */

if (!defined('ABSPATH')) {
    exit;
}

// Include dependencies
include_once plugin_dir_path(__FILE__) . 'includes/register-meta.php';
include_once plugin_dir_path(__FILE__) . 'includes/rest-api.php';
include_once plugin_dir_path(__FILE__) . 'includes/enqueue-scripts.php';


// Add the shortcode to include the map page
function lpm_map_shortcode() {
    return '<div id="lpm-map" style="width: 100%; height: 500px;"></div>';
}

add_shortcode('lpm_map', 'lpm_map_shortcode');

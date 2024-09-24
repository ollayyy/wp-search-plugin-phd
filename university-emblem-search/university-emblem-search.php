<?php
/*
Plugin Name: University Emblem Search
Description: A plugin to search for university emblems using Google Custom Search API.
This PHP script does the following:

Enqueues a JavaScript file to handle the front-end logic.
Localizes the script to pass the AJAX URL and API credentials from the server to the client.
Handles the AJAX request to fetch the emblems from the Google Custom Search API.

Version: 1.0
Author: Oliver Eve

Create a New Plugin Folder: Inside your WordPress installations wp-content/plugins/ directory, create a new folder (e.g., university-emblem-search).
*/

// Enqueue JavaScript file
function emblem_search_scripts() {
    wp_enqueue_script('emblem-search-js', plugins_url('emblem-search.js', __FILE__), array('jquery'), null, true);
    wp_localize_script('emblem-search-js', 'emblemSearch', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'api_key' => 'AIzaSyDLmFFsLMzbTAs2ToYTPnSjcbgl9BKN5Xk',  // Replace with your actual Google API key
        'cx' => 'f68e9e7edff744ca1' // Replace with your Custom Search Engine ID
    ));
}
add_action('wp_enqueue_scripts', 'emblem_search_scripts');

// Handle AJAX request
function fetch_emblems() {
    $university_name = sanitize_text_field($_POST['university_name']);
    $api_key = $_POST['api_key'];
    $cx = $_POST['cx'];
    
    $search_url = "https://www.googleapis.com/customsearch/v1";
    $params = http_build_query([
        'q' => "$university_name emblem",
        'searchType' => 'image',
        'key' => $api_key,
        'cx' => $cx,
        'num' => 3
    ]);

    $response = wp_remote_get("$search_url?$params");
    $body = wp_remote_retrieve_body($response);
    echo $body;
    wp_die();
}
add_action('wp_ajax_fetch_emblems', 'fetch_emblems');
add_action('wp_ajax_nopriv_fetch_emblems', 'fetch_emblems');

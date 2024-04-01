<?php

add_action('rest_api_init', 'add_custom_reviews_api');

function add_custom_reviews_api() {
    register_rest_route('myshoes/v1', '/manageReviews', array(
       'methods' => 'POST',
       'callback' => 'create_review'
    ));
}

function create_review($data) {
    return wp_insert_post(array(
        'post_type' => 'reviews',
        'post_status' => 'publish',
        'post_author' => $data['userId'],
        'post_title' => $data['name'],
        'post_content' => $data['review'],
        'post_parent' => $data['productId'],
    ));
}
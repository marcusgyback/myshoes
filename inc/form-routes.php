<?php

add_action('rest_api_init', 'add_custom_form_api');

function add_custom_form_api() {
    register_rest_route('myshoes/v1', '/contact', array(
        'methods' => 'POST',
        'callback' => 'add_question'
    ));
}

function add_question($data) {
    if(empty($data['name'])) {
        return wp_send_json_error('Please enter your name', 422);
    }
    if(empty($data['email'])) {
        return wp_send_json_error('Please enter your email', 422);
    }
    if(empty($data['message'])) {
        return wp_send_json_error('Ops, it looks like you have missed to type a message', 422);
    }

    $post = wp_insert_post(array(
        'post_type' => 'contactForm',
        'post_status' => 'publish',
        'post_title' => date('Y-m-d H:i')." ".$data['email'],
        'post_content' => $data['message'],
    ));

    add_post_meta($post, 'acf_contactform_name', $data['name']);
    add_post_meta($post, 'acf_contactform_email', $data['email']);
    add_post_meta($post, 'acf_contactform_phone', $data['phone']);
}
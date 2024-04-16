<?php

add_action('rest_api_init', 'add_custom_customer_routes');

function add_custom_customer_routes() {
    register_rest_route('myshoes/v1', '/customer', array(
        'methods' => 'POST',
        'callback' => 'create_account'
    ));
}

function create_account($data) {
    if(empty($data['first_name'])) {
        return wp_send_json_error('First name is required');
    }
    if(empty($data['last_name'])) {
        return wp_send_json_error('Last name is required');
    }
    if(empty($data['email'])) {
        return wp_send_json_error('Email name is required');
    }
    if(empty($data['username'])) {
        return wp_send_json_error('Please choose a username');
    }
    if(empty($data['password'])) {
        return wp_send_json_error('Please select your password');
    }
    if(empty($data['password2'])) {
        return wp_send_json_error('Please confirm your password');
    }
    if($data['password2'] !== $data['password']) {
        return wp_send_json_error('Passwords do not match');
    }

    $user = wp_create_user($data['username'], $data['password'], $data['email']);
    $user_meta = [
        'first_name'    => $data['first_name'],
        'last_name'     => $data['last_name'],
    ];

    sleep(1);
    foreach($user_meta as $key => $value) {
        update_user_meta($user, $key, $value);
    }
}
<?php

add_action('rest_api_init', 'add_custom_customer_routes');

function add_custom_customer_routes() {
    register_rest_route('myshoes/v1', '/customer', array(
        'methods' => 'POST',
        'callback' => 'create_account'
    ));
    register_rest_route('myshoes/v1', '/customer', array(
        'methods' => 'PUT',
        'callback' => 'update_account'
    ));
}

function create_account($data) {
    if(empty($data['first_name'])) {
        return wp_send_json_error('First name is required', 422);
    }
    if(empty($data['last_name'])) {
        return wp_send_json_error('Last name is required', 422);
    }
    if(empty($data['username'])) {
        return wp_send_json_error('Please choose a username', 422);
    }
    if(empty($data['email'])) {
        return wp_send_json_error('Email is required', 422);
    }
    if(empty($data['password'])) {
        return wp_send_json_error('Please select your password', 422);
    }
    if(empty($data['password2'])) {
        return wp_send_json_error('Please confirm your password', 422);
    }
    if($data['password2'] !== $data['password']) {
        return wp_send_json_error('Passwords do not match', 422);
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

    wp_send_json_success('Your account has been created');
}

function update_account($data) {
    $user = wp_get_current_user();
    if(empty($data['first_name'])) {
        return wp_send_json_error('First name is required', 422);
    }
    if(empty($data['last_name'])) {
        return wp_send_json_error('Last name is required', 422);
    }
    if(empty($data['email'])) {
        return wp_send_json_error('Email is required', 422);
    }
    if(empty($data['phone'])) {
        return wp_send_json_error('Phone is required', 422);
    }
    if(empty($data['address'])) {
        return wp_send_json_error('Address is required', 422);
    }
    if(empty($data['postcode'])) {
        return wp_send_json_error('Postcode is required', 422);
    }
    if(empty($data['city'])) {
        return wp_send_json_error('city is required', 422);
    }

    $user_meta = [
        'shipping_first_name' => $data['first_name'],
        'shipping_last_name' => $data['last_name'],
        'billing_email' => $data['email'],
        'shipping_phone' => $data['phone'],
        'shipping_address_1' => $data['address'],
        'shipping_postcode' => $data['postcode'],
        'shipping_city' => $data['city'],
    ];

    foreach($user_meta as $key => $value) {
        update_user_meta($user, $key, $value);
    }

    wp_send_json_success('Profile has been updated');
}
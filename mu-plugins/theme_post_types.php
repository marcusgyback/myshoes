<?php
function theme_post_types() {
    register_post_type('news', [
       'supports' => ['title', 'editor'],
       'rewrite' => ['slug' => 'news'],
       'has_archive' => true,
       'public' => true,
       'labels' => [
           'name' => 'News',
           'add_new_item' => 'Add news',
           'edit_item' => 'Edit',
           'all_items' => 'All News',
           'singular_name' => 'News'
       ],
       'menu_icon' => 'dashicons-list-view'
    ]);

    register_post_type('reviews', [
        'show_in_rest' => true,
        'supports' => ['title', 'editor'],
        'rewrite' => ['slug' => 'reviews'],
        'has_archive' => true,
        'public' => true,
        'labels' => [
            'name' => 'Reviews',
            'add_new_item' => 'Add Review',
            'edit_item' => 'Edit',
            'all_items' => 'All Reviews',
            'singular_name' => 'Reviews'
        ],
        'show_in_menu', false
    ]);
}

add_action('init', 'theme_post_types');
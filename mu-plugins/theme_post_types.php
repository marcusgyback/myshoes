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
}

add_action('init', 'theme_post_types');
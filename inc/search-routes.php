<?php
add_action('rest_api_init', 'myShoesRegisterSearch');

function myShoesRegisterSearch() {
    register_rest_route('myshoes/v1', 'search', [
       'method' => WP_REST_SERVER::READABLE,
       'callback' => 'myShoesSearchResults'
    ]);
}

function myShoesSearchResults($data) {
    $mainQuery = new WP_Query([
       'post_type' => ['product', 'news'],
       's' => sanitize_text_field($data['query']),
       'posts_per_page' => 5
    ]);

    $results = [
        'product'
    ];

    while($mainQuery->have_posts()) {
        $mainQuery->the_post();
        $product = new WC_Product(get_the_ID());

        if(!empty($product->get_sale_price()) && $product->get_sale_price() < $product->get_regular_price()) {
            $productPrice = $product->get_sale_price();
        } else {
            $productPrice = $product->get_regular_price();
        }

        if(get_post_type() === 'product') {
            $results['product'][] = [
                'product_name' => $product->get_name(),
                'product_image' => wp_get_attachment_url($product->get_image_id()),
                'product_price' => $productPrice,
                'product_stock' => $product->get_stock_quantity(),
                'shop_currency' => get_woocommerce_currency(),
                'product_link' => $product->get_permalink()
            ];
        }

        if(get_post_type() === 'news') {
            $results['news'][] = [
                'title' => get_post_meta(get_the_ID(), 'acf_start_page_news_item_heading', true),
                'text' => get_post_meta(get_the_ID(), 'acf_start_page_news_items_text', true),
                'newsImage' => get_the_guid(get_post_meta(get_the_ID(), 'acf_start_page_news_item_image', true))
            ];
        }
    }

    return $results;
}
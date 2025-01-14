<?php

add_action('init', 'webspark_product_delete');
function webspark_product_delete()
{
    if (isset($_GET['action'], $_GET['product_id']) && $_GET['action'] === 'delete_product') {
        $product_id = intval($_GET['product_id']);

        wp_delete_post($product_id);

        wp_safe_redirect(wc_get_account_endpoint_url('my-products'));
    }
}

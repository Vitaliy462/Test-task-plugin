<?php
function webspark_add_product_page()
{
    echo '<h1>Add product page</h1>';

    echo '<form method="POST">';
    echo '<p><label for="product_name">Product name</label>';
    echo '<input type="text" name="product_name" required></p>';
    echo '<p><label for="product_price">Product price</label>';
    echo '<input type="number" name="product_price" step="0" required></p>';
    echo '<p><label for="product_quantity">Product quantity</label>';
    echo '<input type="number" name="product_quantity" step="0" required></p>';
    echo '<p><label for="product_description">Product description</label></p>';
    wp_editor('', 'product_description', array(
        'textarea_name' => 'product_description',
        'textarea_rows' => 10,
    ));
    echo '<p><label for="product_image">Product image</label></p>';
    echo '<button id="upload_image">Select image</button>';
    echo '<input type="hidden" name="product_image_id" id="product_image_id" />';
    echo '<div id="product_image_preview"></div>';

    echo '<p><button type="submit">Add product</button></p>';
    echo '</form>';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['product_name'])) {
        $product_name = sanitize_text_field($_POST['product_name']);
        $product_price = sanitize_text_field($_POST['product_price']);
        $product_quantity = intval($_POST['product_quantity']);
        $product_description = wp_kses_post($_POST['product_description']);
        $product_image_id = intval($_POST['product_image_id']);


        $product = new WC_Product_Simple();
        $product->set_name($product_name);
        $product->set_regular_price($product_price);
        $product->set_manage_stock(true);
        $product->set_stock_quantity($product_quantity);
        $product->set_description($product_description);
        if ($product_image_id) {
            $product->set_image_id($product_image_id);
        }
        $product->save();

        $redirect_url = add_query_arg('product_added', 'success', wc_get_account_endpoint_url('add-product'));
        wp_safe_redirect($redirect_url);
        exit;
    }

    if (isset($_GET['product_added']) && $_GET['product_added'] === 'success') {
        echo '<p>Product was added</p>';
    }
}
add_action('woocommerce_account_add-product_endpoint', 'webspark_add_product_page');

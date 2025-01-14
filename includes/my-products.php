<?php

function webspark_my_products_page()
{
    echo '<h1>My products</h1>';

    $user_id = get_current_user_id();
    $current_page = max(1, get_query_var('paged', 1));
    $products_per_page = 5;
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => $products_per_page,
        'paged'          => $current_page,
        'author'         => $user_id,
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<table class="my-products__table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Product name</th>';
        echo '<th>Quantity</th>';
        echo '<th>Price</th>';
        echo '<th>Status</th>';
        echo '<th>Edit</th>';
        echo '<th>Delete</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($query->have_posts()) {
            $query->the_post();
            $product = wc_get_product(get_the_ID());

            echo '<tr>';
            echo '<td>' . get_the_title() . '</td>';
            $stock_quantity = $product->get_stock_quantity();
            echo '<td>' . $stock_quantity . '</td>';
            echo '<td>' . wc_price($product->get_price()) . '</td>';
            $status = 'Pending review';
            echo '<td>' . $status . '</td>';
            $edit_url = admin_url('post.php?post=' . get_the_ID() . '&action=edit');
            echo '<td>';
            echo '<a href="' . esc_url($edit_url) . '" target="_blank">Edit</a>';
            echo '</td>';
            $delete_url = add_query_arg(array(
                'action' => 'delete_product',
                'product_id' => get_the_ID(),
            ), wc_get_account_endpoint_url('my-products'));
            echo '<td>';
            echo '<a href="' . esc_url($delete_url) . '" onclick="return confirm(\'' . 'Are you sure you want delete this product?' . '\');">Delete</a>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';

        $total_pages = $query->max_num_pages;
        if ($total_pages > 1) {
            echo '<div class="my-products__pagination">';
            echo paginate_links(array(
                'base'    => trailingslashit(wc_get_account_endpoint_url('my-products')) . 'page/%#%/',
                'format'  => 'page/%#%/',
                'current' => $current_page,
                'total'   => $total_pages,
            ));
            echo '</div>';
        }
    } else {
        echo '<p>No products found</p>';
    }

    wp_reset_postdata();
}
add_action('woocommerce_account_my-products_endpoint', 'webspark_my_products_page');

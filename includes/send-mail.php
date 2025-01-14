<?php

add_action('save_post_product', 'webspark_send_admin_email', 10, 3);

function webspark_send_admin_email($post_id, $post, $update)
{
    $product_name = get_the_title($post_id);
    $edit_product_url = admin_url('post.php?post=' . $post_id . '&action=edit');
    $author_id = $post->post_author;
    $author_profile_url = admin_url('user-edit.php?user_id=' . $author_id);

    $admin_email = get_option('admin_email');
    $subject = 'Product update notification';

    $message = '<p>A product has been created or updated.</p>';
    $message .= '<p>Product name:' . esc_html($product_name) . '</p>';
    $message .= '<p>Author profile: <a href="' . esc_url($author_profile_url) . '">View author profile</a></p>';
    $message .= '<p>Edit product: <a href="' . esc_url($edit_product_url) . '">Edit product</a></p>';

    wp_mail($admin_email, $subject, $message);
}

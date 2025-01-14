<?php

/**
 * Plugin Name: WP My Product Webspark
 * Author: Vitaliy Lemesh
 */

if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    add_action('wp_enqueue_scripts', 'webspark_enqueue_styles_and_scripts');
    function webspark_enqueue_styles_and_scripts()
    {
        wp_enqueue_style('webspark-plugin-style', plugin_dir_url(__FILE__) . 'assets/css/style.css');
        wp_enqueue_script('webspark-plugin-script', plugin_dir_url(__FILE__) . 'assets/js/script.js', array(), null, true);
    }

    require_once plugin_dir_path(__FILE__) . 'includes/endpoints.php';
    require_once plugin_dir_path(__FILE__) . 'includes/menu-items.php';
    require_once plugin_dir_path(__FILE__) . 'includes/add-product.php';
    require_once plugin_dir_path(__FILE__) . 'includes/my-products.php';
    require_once plugin_dir_path(__FILE__) . 'includes/delete-product.php';
    require_once plugin_dir_path(__FILE__) . 'includes/send-mail.php';
}

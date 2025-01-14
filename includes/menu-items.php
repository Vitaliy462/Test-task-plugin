<?php
add_filter('woocommerce_account_menu_items', 'webspark_add_my_account_menu_items');
function webspark_add_my_account_menu_items($menu_items)
{
    $menu_items['add-product'] = 'Add product';
    $menu_items['my-products'] = 'My products';

    return $menu_items;
}

<?php
add_action('init', 'webspark_register_my_account_endpoints');
function webspark_register_my_account_endpoints()
{
    add_rewrite_endpoint('add-product', EP_ROOT | EP_PAGES);
    add_rewrite_endpoint('my-products', EP_ROOT | EP_PAGES);
}

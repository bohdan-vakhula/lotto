<?php
    /**
     * Include Plugins
     */
    include_once(LOTTO_PLUGIN_ROOT.'plugins/carbon-fields/carbon-fields-plugin.php');
    include_once(LOTTO_PLUGIN_ROOT.'plugins/plugin-updates/plugin-update-checker.php');

    /**
     * Include Helpers
     */
    include_once(LOTTO_PLUGIN_ROOT.'helpers/functions.php');

    /**
     * Include Admin Options
     */
    include_once(LOTTO_PLUGIN_ROOT.'admin/admin.php');
    include_once(LOTTO_PLUGIN_ROOT.'admin/theme-options.php');
    include_once(LOTTO_PLUGIN_ROOT.'admin/custom-fields.php');


    $whitelist = array('127.0.0.1', "::1");
    if (! defined('IS_LOCALHOST')) {
        define('IS_LOCALHOST', in_array($_SERVER['REMOTE_ADDR'], $whitelist));
    }

    if (! defined('TOKEN')) {
        define('TOKEN', carbon_get_theme_option('lotto_access_token')); //'PlamenToken89'
    }

    if (! defined('BASE_API_URL')) {
        define('BASE_API_URL', carbon_get_theme_option('lotto_base_api_url'));//'https://5.100.249.154/api/'
    }

    if (! defined('CASHIER_URL')) {
        define('CASHIER_URL', carbon_get_theme_option('lotto_cashier_url')); //'https://5.100.249.154/Cashier/'
    }

    if (! defined('BRAND_ID')) {
        define('BRAND_ID', carbon_get_theme_option('lotto_brand_id'));
    }

    if (! defined('NG_CART')) {
        define('NG_CART', carbon_get_theme_option('lotto_ngcart'));
    }

    if (! defined('SITE_CURRENCY')) {
        define('SITE_CURRENCY', carbon_get_theme_option('lotto_currency'));
    }
    /**
     * Include Data Arrays & Data from API Data from API
     */
    include_once(LOTTO_PLUGIN_ROOT.'helpers/data-arrays.php');
    include_once(LOTTO_PLUGIN_ROOT.'helpers/data-transients.php');

    /**
     * Include Modules
     */
    if (NG_CART) {
        include_once(LOTTO_PLUGIN_ROOT.'modules/cart/cart.php');
    }

    if (!class_exists('Init')) {
        include_once(LOTTO_PLUGIN_ROOT.'modules/api/Init.php');
    }

<?php

if (! defined('CART_PARTIALS_URI')) {
    define('CART_PARTIALS_URI', trailingslashit(get_template_directory_uri() . '/fragments/cart-partials'));
}

if (! defined('CART_TRANSLATION_URL')) {
    define('CART_TRANSLATION_URL', trailingslashit(get_template_directory_uri() . '/languages/translations'));
}

function init_cart()
{
    if (IS_LOCALHOST) {
        crb_enqueue_script('angular', plugin_dir_url(__FILE__) . 'libs/angular.js', array('jquery'), false);
    } else {
        crb_enqueue_script('angular', plugin_dir_url(__FILE__) . 'libs/angular.min.js', array('jquery'), false);
    }
    crb_enqueue_script('ng-dialog', plugin_dir_url(__FILE__) . 'libs/ngDialog.js', array('jquery'), true);
    crb_enqueue_script('angular-cache', plugin_dir_url(__FILE__) . 'libs/angular-cache.min.js', array('jquery'), true);
    crb_enqueue_script('angular-resource', plugin_dir_url(__FILE__) . 'libs/angular-resource.min.js', array('jquery'), true);
    crb_enqueue_script('fancybox', plugin_dir_url(__FILE__) . 'libs/fancybox/jquery.fancybox.pack.js', array('jquery'), false);
    crb_enqueue_style('fancybox-style', plugin_dir_url(__FILE__) .'libs/fancybox/jquery.fancybox.css');
    crb_enqueue_script('angular-fancybox-plus', plugin_dir_url(__FILE__) . 'libs/angular-fancybox-plus.js', array('jquery'), true);

    // if (IS_LOCALHOST) {
        crb_enqueue_script('angular-app', plugin_dir_url(__FILE__) . 'index.js', array('jquery'), true);
    // } else {
        // crb_enqueue_script('angular-app', plugin_dir_url(__FILE__) . 'build/cart.build.js', array('jquery'), true);
    // }

    $products = '';
    if (!empty($_GET['m']) && isset($_GET['s'])) {
        $products = lotto_olap($_GET['m'], $_GET['s']);
        $products->Hash = $_GET['m'];
        $_SESSION["olapAffiliateCode"] = $_GET['s'];
    }

    wp_localize_script(
        'angular-app',
        'CART_CONFIG',
        array(
            'CART_PARTIALS_URI' => CART_PARTIALS_URI,
            'CART_TRANSLATION_URL' => CART_TRANSLATION_URL,
            'CART_PRODUCTS' => $products,
            'CART_OLAP_AFFILIATE_CODE' => empty($_SESSION['olapAffiliateCode']) ? 0 : $_SESSION['olapAffiliateCode'],
            'CART_IS_FIRSTTIME_PURCHASE' => empty($_SESSION['user_balance']['FirstPurchase']) ? 0 : 1,
            'CART_DEV' => ($_SERVER['REMOTE_ADDR'] == '92.247.60.50') ? 1 : 0
        )
    );

    wp_enqueue_script('angular-app');

    // if (IS_LOCALHOST) {
        crb_enqueue_script('ng-cart', plugin_dir_url(__FILE__) . 'cartjs/ngCart.js', array('jquery'), true);
        crb_enqueue_script('mainctrl', plugin_dir_url(__FILE__) . 'cartjs/mainCtrl.js', array('jquery'), true);
        crb_enqueue_script('mapper', plugin_dir_url(__FILE__) . 'cartjs/Mapper.js', array('jquery'), true);
        crb_enqueue_script('phonescodes', plugin_dir_url(__FILE__) . 'cartjs/phonescodes.js', array('jquery'), true);
        crb_enqueue_script('countdown-directive', plugin_dir_url(__FILE__) . 'cartjs/Directives/countdownDirective.js', array('jquery'), true);
        crb_enqueue_script('animate-numbers-directive', plugin_dir_url(__FILE__) . 'cartjs/Directives/animateNumbersDirective.js', array('jquery'), true);
    // }
}
add_action('wp_enqueue_scripts', 'init_cart');

function lotto_olap($hash, $affiliate)
{
    $url = BASE_API_URL. 'backoffice/get-olap-product';

    $data["Affiliate"] = $affiliate;
    $data["Hash"] = urlencode($hash);
    $data["BrandID"] = BRAND_ID;
    $data["Brand"] = BRAND_ID;
    $data["Product"] = '';
    $data_string = json_encode($data);
    $response = wp_remote_post($url, array(
        'headers' => array(
            'Token' => TOKEN,
            'Content-Type' => 'application/json'
        ),
        'sslverify' => false,
        'body' => $data_string
    ));

    if (is_wp_error($response)) {
        wp_redirect(HOME_URL);
        exit;
    } else {
        $decode_response = json_decode(wp_remote_retrieve_body($response), false);
        if (empty($decode_response->Products)) {
            wp_redirect(HOME_URL);
            // exit;
        }
        return $decode_response;
    }
}

<?php

include_once(dirname(__FILE__) . '/common.php');

/* Reblaze client IP */
if (!empty($_SERVER["HTTP_X_REAL_IP"])) {
    $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_X_REAL_IP"] ? $_SERVER["HTTP_X_REAL_IP"] : $_SERVER["REMOTE_ADDR"];
}
/***********************************************
 * 	-----------TODO----------
 *  The code will be refactoring
 ***********************************************/
remove_action('wp_head', 'wp_generator');

// TODO merge with cart.php init_cart
add_action('wp_enqueue_scripts', 'lotto_yard_js_variables');
function lotto_yard_js_variables()
{
    $admin_url = get_admin_url() . 'admin-ajax.php';
    if (defined('ICL_LANGUAGE_CODE')) {
        $admin_url = get_admin_url() . 'admin-ajax.php?lang='.ICL_LANGUAGE_CODE;
    }
    ?>
    <script type="text/javascript">
        /* <![CDATA[ */
        var remoteAddr = "<?php echo $_SERVER['REMOTE_ADDR'] ?>";
        var CONFIG = {
            "imgurl": "<?php echo TEMPLATE_URL;?>/images/loading.gif",
            "templateURL" : "<?php echo TEMPLATE_URL;?>",
            "adminURL": "<?php echo $admin_url;?>",
            "homeURL": "<?php echo HOME_URL;?>",
            "isHome": "<?php echo is_home();?>",
            "isMobile": <?php echo (wp_is_mobile()) ? "true" : "false";?>,
            "isLogin": <?php echo empty($_SESSION['user_data']) ? "false" : "true";?>,
            "sessionId": <?php echo empty($_SESSION['user_data']['UserSessionId']) ? 0 : $_SESSION['user_data']['UserSessionId'];?>,
            "affiliateId": <?php echo empty($_SESSION['bta']) ? 0 : $_SESSION['bta'];?>,
            "isThankYouPage": <?php echo (is_page('thankyou') && !isset($_GET['deposit-funds'])) ? "true" : "false";?>,
            "siteCurrency": "<?php echo SITE_CURRENCY;?>",
            "cartPromoCode": "<?php echo empty($_SESSION['prc']) ? null : $_SESSION["prc"];?>",
            "countryCode": "<?php echo empty($_SESSION['user_maxmind_data']['country_code']) ? '': $_SESSION['user_maxmind_data']['country_code'];?>",
            "isFirstPurchase": "<?php echo empty($_SESSION['user_balance']['FirstPurchase']) ? "false" : "true"; ?>",
            "siteLang": "<?php echo (defined('ICL_LANGUAGE_CODE')) ? ICL_LANGUAGE_CODE : "en"; ?>"
        };
        function debug(o){o?console=consoleHolder:(consoleHolder=console,console={},console.warn=function(){},console.log=function(){},console.group=function(){},console.dir=function(){},console.error=function(){},console.info=function(){},console.groupEnd=function(){})}var consoleHolder=console;
        /* ]]> */
    </script>
    <?php if(!is_admin_bar_showing()) : ?>
    <script type="text/javascript">debug(true);</script>
    <?php
    endif;
}

add_action('wp_enqueue_scripts', 'init_lotto_yard');
function init_lotto_yard()
{
    if (empty($_SESSION['user_maxmind_data']['country_code'])) {
        crb_enqueue_script('script-country', '//js.maxmind.com/js/apis/geoip2/v2.1/geoip2.js', array( 'jquery' ), false);
        crb_enqueue_script('lotto-yard-functions', plugin_dir_url(__FILE__) . '../assets/functions.js', array('jquery'), true);
    }
}

add_action('wp_ajax_set_country_code', 'lotto_set_country_code');
add_action('wp_ajax_nopriv_set_country_code', 'lotto_set_country_code');
function lotto_set_country_code()
{
    $_SESSION['user_maxmind_data']['country_code'] = $_POST['geoipdata'];
    exit;
}

function register_my_session()
{
    if (session_id() === "") {
        session_start();
    }

    if (isset($_GET["bta"])) {
        $_SESSION["bta"] = trim($_GET["bta"]);
    }

    if (isset($_GET["prc"])) {
        $_SESSION["prc"] = $_GET["prc"];
    }

    if (isset($_GET["cxd"])) {
        $_SESSION["cxd"] = trim($_GET["cxd"]);
    }

    if (isset($_GET["utm_campaign"])) {
        $_SESSION["utm_campaign"] = trim($_GET["utm_campaign"]);
    }
	
	if (isset($_GET["session_id"])) {
        $_SESSION['user_data']['UserSessionId'] = trim($_GET["session_id"]);
    }
}

function lotto_logout()
{
    unset($_SESSION['user_data']);
    unset($_SESSION['user_balance']);
    unset($_SESSION['user_selection']);
}
add_action('wp_logout', 'lotto_logout');

function lotto_setup()
{
    if (! defined('TEMPLATE_URL')) {
        define('TEMPLATE_URL', get_template_directory_uri());
    }

    if (! defined('TEMPLATE_DIR')) {
        define('TEMPLATE_DIR', get_template_directory());
    }
    if (! defined('HOME_URL')) {
        define('HOME_URL', home_url());
    }

    add_action('init', 'register_my_session');
}

add_action('after_setup_theme', 'lotto_setup');

function GetPMCfromThankYouUrl($url)
{
    $url_parsed = parse_url($url);
    $str = $url_parsed["path"];
    preg_match('/([^&"]+)/', $str, $match);
    $pmc = str_replace('/thankyou/', '', $match[1]);
    $pmc = str_replace('/', '', $pmc);

    return $pmc;
}

function ChangeLotteryNameForUrl($Lottery)
{
    $Lottery = strtolower($Lottery);
    if ($Lottery == "laprimitiva") {
        $lotteryname = "laprimitiva";
    } else {
        if ($Lottery == "elgordo") {
            $lotteryname = "elgordo";
        } else {
            if ($Lottery == "uklotto") {
                $lotteryname = "uklotto";
            } else {
                if ($Lottery == "newyorklotto") {
                    $lotteryname = "newyorklotto";
                } else {
                    $lotteryname = $Lottery;
                }
            }
        }
    }

    return $lotteryname;
}

function GetLotteryNameFromUrl($url)
{
    $url_parsed   = parse_url($url);
    $path         = $url_parsed["path"];
    $lottery_seo  = strtolower(trim(strstr($path, "-lottery", true), "/"));

    // remove lang
    if (strpos($lottery_seo, '/') !== false) {
        $lottery_seo = trim(strstr($lottery_seo, '/'), '/');
    }

    // TODO get all lottaries name from API
    $lotteryNames = array(
        'newyorklotto' => 'NewYorkLotto',
        'laprimitiva'   => 'LaPrimitiva',
        'uklotto'    => 'UkLotto',
        'elgordo'       => 'ElGordo',
        'bonoloto'       => 'BonoLoto',
        'lotto649'       => 'Lotto649',
        'powerball'      => 'PowerBall',
        'superenalotto'  => 'SuperEnalotto',
        'megamillions'   => 'MegaMillions',
        'euromillions'   => 'EuroMillions',
        'eurojackpot'    => 'EuroJackpot',
        'ozlotto'        => 'OzLotto'
    );

    return $lotteryNames[$lottery_seo];
}

// If user not logged in.
function change_menu($items)
{
    global $post;

    foreach ($items as $item) {
        if ($item->title == "My Account" && !isset($_SESSION['user_data'])) {
            $item->url = "";
			?>
            <script type="text/javascript">
                jQuery(function ($) {
					jQuery(this).find(".menu-item-1381").addClass( "show-sign-up");
                });
            </script>
			<?php
        }
    }

    return $items;
}

add_filter('wp_nav_menu_objects', 'change_menu');

add_action('wp_ajax_lottery_data', 'api_lottery');
add_action('wp_ajax_nopriv_lottery_data', 'api_lottery');
function api_lottery()
{
    $method_url = $_POST['m'];
    $response   = '';

    if ($method_url == 'withdraw') {
        if (isset($_POST['amt']) && $_POST['amt'] > 0) {
            $data     = array('MemberId' => $_SESSION['user_data']['MemberId'], 'BrandID' => BRAND_ID, 'Amount' => number_format($_POST['amt'], 2));
            $temp     = json_decode(apiCall('mailservice/send-withdraw', $data), 1);
            $response = json_encode($temp);
        }

        echo $response;
        exit;
    }

    if ($method_url != false) {
        $app = new Init($_POST);
        $app->call($method_url);
    }

    exit;
}

function apiCall($url, $data)
{
    $url = BASE_API_URL . $url; // New url

    $data_string = json_encode($data);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Token: ' . TOKEN
        )
    );

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

    return $resultData = curl_exec($ch);

    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $resultData;
}

function Login($email, $password)
{
    $data = array("email" => $email, "password" => $password, "brandId" => BRAND_ID); // login
    $temp1 = json_decode(apiCall("userinfo/login", $data), true);

    if (!empty($temp1['MemberId'])) {
        unset($_SESSION['user_data']);
        $_SESSION['user_data'] = $temp1;

        // escaping code
        $_SESSION['user_data']['FirstName']   = htmlspecialchars($_SESSION['user_data']['FirstName'], ENT_QUOTES, 'UTF-8');
        $_SESSION['user_data']['LastName']    = htmlspecialchars($_SESSION['user_data']['LastName'], ENT_QUOTES, 'UTF-8');
        $_SESSION['user_data']['Email']       = htmlspecialchars($_SESSION['user_data']['Email'], ENT_QUOTES, 'UTF-8');
        $_SESSION['user_data']['CountryCode'] = htmlspecialchars($_SESSION['user_data']['CountryCode'], ENT_QUOTES, 'UTF-8');
        $_SESSION['user_data']['City']        = htmlspecialchars($_SESSION['user_data']['City'], ENT_QUOTES, 'UTF-8');
        $_SESSION['user_data']['Address']     = htmlspecialchars($_SESSION['user_data']['Address'], ENT_QUOTES, 'UTF-8');
        $_SESSION['user_data']['State']       = htmlspecialchars($_SESSION['user_data']['State'], ENT_QUOTES, 'UTF-8');

        $data = array("MemberId" => $temp1['MemberId'], "BrandID" => BRAND_ID);
        $temp = json_decode(apiCall("userinfo/get-member-money-balance", $data), 1);
        unset($_SESSION['user_balance']);
        $_SESSION['user_balance'] = $temp;
        $_SESSION['user_balance']['currency'] = SITE_CURRENCY;
    }
}

function sendWelcomeMail()
{
    $url = BASE_API_URL . 'mailservice/send-welcome'; // New url

    $data = array("BrandID" => BRAND_ID, "MemberID" => $_SESSION['user_data']['MemberId'], "Email" => $_SESSION['user_data']['Email']);
    $data_string = json_encode($data);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // New token
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Token: ' . TOKEN
        )
    );

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);


    $resultData = curl_exec($ch);

    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
}

function sendForgotPassEmail($method = "", $resp = array())
{
    $resetpassword_link = get_permalink(519);
    $url = BASE_API_URL . $method; // New url

    if ($method === "mailservice/send-reset-password") {
        $data = array(
            "BrandID"    => BRAND_ID,
            "MemberID"   => $resp['MemberId'],
            "Email"      => $resp['Email'],
            "ActionLink" => $resetpassword_link . "?",
        );
        $data_string = json_encode($data);
    }


    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // New token
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Token: ' . TOKEN
        )
    );

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

    $resultData = curl_exec($ch);

    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return array("status" => $status, "response" => $resultData);
}

function executeGenericApiCall($method = "", $request)
{
    $url = BASE_API_URL . $method; // New url
    $data = $request;
    $data["BrandID"] = BRAND_ID;
    $data_string = json_encode($data);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // New token
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Token: ' . TOKEN
        )
    );

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

    $resultData = curl_exec($ch);

    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return array("status" => $status, "response" => $resultData);
}

function sortByOrder($a, $b)
{
    return $b->Jackpot - $a->Jackpot;
}

function sortByDate($a, $b)
{
    return strtotime($b->DrawDate) - strtotime($a->DrawDate);
}

function getLotteryTypeId($data, $lt)
{
    $temp = array();
    foreach ($data as $key => $value) {
        if ($lt == $value->LotteryTypeId) {
            $temp[] = $value;
        }
    }
    return $temp;
}

function getLotteryTypeByName($data, $lt)
{
    $temp = array();
    foreach ($data as $key => $value) {
        if (strcasecmp($lt, $value->LotteryType) == 0) {
            $temp[] = $value;
        }
    }
    return $temp;
}

function getMethodDetails($data, $cardid)
{
    foreach ($data as $key => $value) {
        if ($cardid == $value->Id) {
            $value->day = date("d", strtotime($value->ExpirationDate));
            $value->month = date("m", strtotime($value->ExpirationDate));
            $value->year = date("Y", strtotime($value->ExpirationDate));
            return $value;
        }
    }
}

function getLotteryByDrawId($data, $drid)
{
    $temp = array();
    foreach ($data as $key => $value) {
        if ($drid == $value->DrawId) {
            $temp[] = $value;
        }
    }

    return $temp;
}

// Send mail if signup.
function sendMail($resp = array())
{
    $subject = "Lottery Master Registration";

    $to = $resp['Email'];

    $headers = 'From: support@netolotto.dev' . "\r\n" .
        'Reply-To: support@netolotto.dev' . "\r\n" .
        'Return-Path: support@netolotto.dev' . "\r\n" .
        'Content-type: text/html; charset=utf-8' . "\r\n";


    $html = "";
    $html .= "Hi, " . $resp['FirstName'] . " " . $resp['LastName'] . "<br/><br/>";
    $html .= "Welcome To Lottery Master.";
    $html .= "<br/> -- User Details -- <br/>";
    $html .= " First Name : " . $resp['FirstName'] . "<br/>";
    $html .= " Last Name : " . $resp['LastName'] . "<br/>";
    $html .= " Email : " . $resp['Email'] . "<br/>";
    $html .= " Password : " . $resp['Password'] . "<br/>";
    $html .= " <br/><br/> Click <a href='" . home_url() . "' target='_blank'>here</a> to login";

    wp_mail($to, $subject, $html, $headers);
}

remove_filter('the_content', 'wpautop');
add_filter('the_content', 'add_newlines_to_post_content');

function add_newlines_to_post_content($content)
{
    return nl2br($content);
}

// Defer parsing filter.
function defer_parsing_of_js($url)
{
    if (false === strpos($url, '.js')) {
        return $url;
    }
    if (strpos($url, 'jquery.js')) {
        return $url;
    }
    return "$url' defer ";
}
if (!is_admin()) {
    // add_filter('clean_url', 'defer_parsing_of_js', 11, 1);
}

function add_custom_meta_boxes()
{

    // Define the custom attachment for posts
    add_meta_box(
        'wp_custom_attachment', 'Graph Image', 'wp_custom_attachment', 'post', 'side', 'low'
    );

    // Define the custom attachment for pages
    add_meta_box(
        'wp_custom_attachment', 'Graph Image', 'wp_custom_attachment', 'page', 'side', 'low'
    );
}

// end add_custom_meta_boxes
add_action('add_meta_boxes', 'add_custom_meta_boxes');

function wp_custom_attachment()
{
    wp_nonce_field(plugin_basename(__FILE__), 'wp_custom_attachment_nonce');

    $html = '<p class="description">';
    $html .= 'Upload your graph image here.';
    $html .= '</p>';
    $html .= '<input type="file" id="wp_custom_attachment" name="wp_custom_attachment" value="" size="25" />';

    echo $html;
}

// end wp_custom_attachment

function save_custom_meta_data($id)
{

    /* --- security verification --- */
    if (!wp_verify_nonce($_POST['wp_custom_attachment_nonce'], plugin_basename(__FILE__))) {
        return $id;
    } // end if

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $id;
    } // end if

    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $id)) {
            return $id;
        } // end if
    } else {
        if (!current_user_can('edit_page', $id)) {
            return $id;
        } // end if
    } // end if
    /* - end security verification - */

    // Make sure the file array isn't empty
    if (!empty($_FILES['wp_custom_attachment']['name'])) {

//        echo $_FILES['wp_custom_attachment']['name'];exit;
        // Setup the array of supported file types. In this case, it's just image.
        $supported_types = array('image/jpeg', 'image/jpg', 'image/gif', 'image/png');

        // Get the file type of the upload
        $arr_file_type = wp_check_filetype(basename($_FILES['wp_custom_attachment']['name']));

        $uploaded_type = $arr_file_type['type'];


        // Check if the type is supported. If not, throw an error.
        if (in_array($uploaded_type, $supported_types)) {

            // Use the WordPress API to upload the file
            $upload = wp_upload_bits($_FILES['wp_custom_attachment']['name'], null,
                file_get_contents($_FILES['wp_custom_attachment']['tmp_name']));

            if (isset($upload['error']) && $upload['error'] != 0) {
                wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
            } else {
                add_post_meta($id, 'wp_custom_attachment', $upload);
                update_post_meta($id, 'wp_custom_attachment', $upload);
            } // end if/else
        } else {
            wp_die("The file type that you've uploaded is not an image.");
        } // end if/else
    } // end if
}

// end save_custom_meta_data
add_action('save_post', 'save_custom_meta_data');

function update_edit_form()
{
    echo ' enctype="multipart/form-data"';
}

// end update_edit_form
add_action('post_edit_form_tag', 'update_edit_form');

// Add url to featured image meta box
function prefix_featured_image_meta($content)
{
    global $post;
    $text = __('Url : ', 'twentythirteen');
    $id = 'featured_image_url';
    $value = esc_attr(get_post_meta($post->ID, $id, true));
    $input = '<p>' . $text . '<input name="' . $id . '" type="text" id="' . $id . '" value="' . $value . ' "> <br/> ie. http://netolotto.dev </p  >';
    return $content .= $input;
}

add_filter('admin_post_thumbnail_html', 'prefix_featured_image_meta');

function prefix_save_featured_image_meta($post_id)
{
    $value = "";
    if (isset($_REQUEST['featured_image_url'])) {
        $value = $_REQUEST['featured_image_url'];
    }

    // Set meta value to either 1 or 0
    update_post_meta($post_id, 'featured_image_url', $value);
}

add_action('save_post', 'prefix_save_featured_image_meta', 10, 1);

// change date for usa lotteries(-1 day)
function changeDate($lotteryName, $date)
{
    $lotteries = array('MegaMillions', 'NewYorkLotto', 'PowerBall', 'Lotto649');
    $time      = strtotime($date);

    if (in_array($lotteryName, $lotteries)) {
        return $time - 24*60*60;
    }

    return $time;
}

// group ticket select button in mobile site
add_filter('query_vars', 'parameter_queryvars');
function parameter_queryvars($qvars)
{
    $qvars[] = 'group-tab';
    return $qvars;
}

add_filter('body_class', 'append_language_class');
function append_language_class($classes)
{
    $classes[] = (defined('ICL_LANGUAGE_CODE')) ? ICL_LANGUAGE_CODE : '';
    return $classes;
}

remove_action('wp_head', 'print_emoji_detection_script', 7);

function convert_country_name($country_name)
{
    $lang_code = (defined('ICL_LANGUAGE_CODE')) ? ICL_LANGUAGE_CODE : 'en';
    $countries = array(
        'en' => array('USA' => 'USA', 'Spain' => 'Spain', 'Europe' => 'Europe', 'Italy' => 'Italy', 'Canada' => 'Canada', 'UK' => 'UK', 'Australia' => 'Australia'),
        'ru' => array('USA' => 'США', 'Spain' => 'Испания', 'Europe' => 'Европа', 'Italy' => 'Италия', 'Canada' => 'Канада', 'UK' => 'Великобритания','Australia' => 'Австралия'),
        'fr' => array('USA' => 'USA', 'Spain' => 'Espagne', 'Europe' => 'Europe', 'Italy' => 'Italie', 'Canada' => 'Canada', 'UK' => 'Royaume-Uni'),
        'de' => array('USA' => 'USA', 'Spain' => 'Spanien', 'Europe' => 'Europa', 'Italy' => 'Italien', 'Canada' => 'Kanada', 'UK' => 'Vereinigtes Königreich'),
        'es' => array('USA' => 'EE.UU.', 'Spain' => 'España', 'Europe' => 'Europa', 'Italy' => 'Italia', 'Canada' => 'Canadá', 'UK' => 'UK'),
        'pl' => array('USA' => 'USA', 'Spain' => 'Hiszpania', 'Europe' => 'Europa', 'Italy' => 'Włochy', 'Canada' => 'Kanada', 'UK' => 'UK'),
    );
    return $countries[$lang_code][$country_name];
}

if (defined('DOING_AJAX') && DOING_AJAX) {
    global $sitepress;
    if (method_exists($sitepress, 'switch_lang') && isset($_GET['lang']) && $_GET['lang'] !== $sitepress->get_default_language()) {
        $sitepress->switch_lang($_GET['lang'], true);
    }
}

function lotto_page_template_redirect()
{
    if (is_page('my-account') && empty($_SESSION['user_data'])) {
        wp_redirect(home_url(), 301);
        exit();
    }
}
add_action('template_redirect', 'lotto_page_template_redirect');

if (!function_exists('lotto_fix_product_name')) :
    function lotto_fix_product_name($product)
    {
        // TODO get all lottaries name from API
        $correct_names = array(
            'personalandgroup'         => 'Personal And Group',
            'toplottopersonal'         => 'Top Lotto Personal',
            'toplottopersonalandgroup' => 'Top Lotto Personal And Group',
            'freeproduct'              => 'Free Product',
            'groupvip1'                => 'Group Vip 1',
            'groupvip2'                => 'Group Vip 2',
            'groupvip3'                => 'Group Vip 3',
            'groupvip4'                => 'Group Vip 4',
            'groupvip5'                => 'Group Vip 5',
            'toplottogroup'            => 'Top Lotto Group',
            'navidadgroup'             => 'Navidad Group',
            'freesingle'               => 'Free Single',
            'specialholiday'           => 'Special Holiday',
            'specialholidaygroup'      => 'Special Holiday Group',
            'onemillionpackage'        => 'One Million Package',
            'elniñogroup'              => 'ElNiño Group',
            'ozlotto'                  => 'OzLotto',
        );

        $formatted_product_name = trim(strtolower($product));
        if (array_key_exists($formatted_product_name, $correct_names)) {
            $product = $correct_names[$formatted_product_name];
        }

        return $product;
    }
endif;

if (!function_exists('lotto_browser_body_class')) :
function lotto_browser_body_class($classes = '')
{
    global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
    if (!empty($_SESSION['user_data'])) {
        $classes[] = 'is-lotto-login';
    }
    if ($is_lynx) {
        $classes[] = 'lynx';
    } elseif ($is_gecko) {
        $classes[] = 'gecko';
    } elseif ($is_opera) {
        $classes[] = 'opera';
    } elseif ($is_NS4) {
        $classes[] = 'ns4';
    } elseif ($is_safari) {
        $classes[] = 'safari';
    } elseif ($is_chrome) {
        $classes[] = 'chrome';
    } elseif ($is_IE) {
        $classes[] = 'ie';
    } else {
        $classes[] = 'unknown';
    }

    if ($is_iphone) {
        $classes[] = 'iphone';
    }
    return $classes;
}
endif;
add_filter('body_class', 'lotto_browser_body_class');
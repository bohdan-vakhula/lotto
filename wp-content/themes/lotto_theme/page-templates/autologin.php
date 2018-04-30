<?php
/**
 * Template Name: Autologin Page
 */
get_header();

if (isset($_SESSION['user_data'])) {
    echo '<script type="text/javascript">
				document.location.href="/";
				</script>';
} else {
    $session_id = isset($_GET['session_id']) ? $_GET['session_id'] : 0;
    $brandid  = isset($_GET['brandid']) ? $_GET['brandid'] : '';
    $bta = isset($_GET['bta']) ? $_GET['bta'] : '';
    $data = array('SessionId' => $session_id , 'BrandId' => $brandid , 'bta' => $bta);
    $lang = isset($_GET['lang']) ? $_GET['lang'] : '';
    $result = executeGenericApiCall('userinfo/get-personal-details-by-sessionid', $data);
    $user_info = json_decode($result['response']);
    if ($result['status'] == 200 && $user_info->Email !== NULL && $user_info->Password !== NULL) {
        Login($user_info->Email, $user_info->Password);
        echo '<script type="text/javascript">
				document.location.href="/";
				</script>';
    } else {
        echo '
            <div id="middle" class="innerbg_select_page">
                <div class="wrap">
                    <div class="innerpage">
                        <h1>AutoLogin</h1>
                        <h2>Error:</h2>
                        <div style="color: red; font-size: 18px;">Such member doesn\'t exist.</div>
                    </div>
                </div>
            </div>
    	';
    }
}

get_footer();
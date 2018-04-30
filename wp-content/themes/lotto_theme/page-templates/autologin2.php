<?php
/**
 * Template Name: Autologin2 Page
 */
get_header();

if (isset($_SESSION['user_data'])) {
    echo '<script type="text/javascript">
				window.location="/lottery/";
				</script>';
} else {
    $memberid = isset($_GET['memberid']) ? $_GET['memberid'] : 0;
    $brandid  = isset($_GET['brandid']) ? $_GET['brandid'] : '';
    $bta = isset($_GET['bta']) ? $_GET['bta'] : '';
    $data = array('MemberId' => $memberid , 'BrandId' => $brandid , 'AffiliateId' => $bta);
    $lang = isset($_GET['lang']) ? $_GET['lang'] : '';
    $result = executeGenericApiCall('userinfo/get-personal-details-by-memberid', $data);
    $user_info = json_decode($result['response']);
    if ($result['status'] == 200 && $user_info->Email !== NULL && $user_info->Password !== NULL) {
        Login($user_info->Email, $user_info->Password);
		executeGenericApiCall('userinfo/get-personal-details-by-memberid', $data);
		echo '<script type="text/javascript">
				window.location="/lottery/";
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
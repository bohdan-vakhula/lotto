<?php
/**
 * Template Name: Thank you
 *
 */

get_header();
$url = $_SERVER['REQUEST_URI'];
$pmc=preg_replace("/[^0-9]/","",$url);
if (isset($_SESSION['user_data']) && is_array($_SESSION['user_data']['Result'])) {
    $usersession = $_SESSION['user_data']['Result']['UserSessionId'];
    $_SESSION['user_data'] = $_SESSION['user_data']['Result'] + $_SESSION['user_data'];
} else {
    $usersession = $_SESSION['user_data']['UserSessionId'];
}

$method_url       = 'userinfo/get-member-purchase-complete-details';
$request          = array("ProductManagementCounter" => $pmc, "SessionID" => $usersession);
$response         = executeGenericApiCall($method_url, $request);
$response_decoded = json_decode($response["response"]);

if ($response["status"] == 200 && count($response_decoded) > 0 && $response_decoded[0]->NumberOfDraws > 0 && $response_decoded[0]->LotteryTypeId > 0 && $response_decoded[0]->ProductId > 0) { // show
    $nrdraws = ($response_decoded[0]->NumberOfDraws);
    $nrlines = ($response_decoded[0]->Lines);

    $money = ($response_decoded[0]->RealMoneyUsed + $response_decoded[0]->BonusMoneyUsed + $response_decoded[0]->WinningMoneyUsed);
    $date = date("d/m/Y", strtotime($response_decoded[0]->DrawEndDate));
	if ($response_decoded[0]->ProductId === 1){
        $lineshare=__("Lines","twentythirteen");
    } else {
        $lineshare=__("Shares","twentythirteen");
    }
    ?>

    <!-- #main-content -->
    <!-- Page will be loaded just when user is logged in else will redirect to homepage -->
	<div class="hadding inner-hadding">
        <h1><?php the_title(); ?> page</h1>
    </div>
    <div id="middle" class="innerbg">
        <div class="wrap">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="<?php echo home_url(); ?>"><img src="<?php echo TEMPLATE_URL; ?>/images/homeicon.png"/></a></li>
                    <li>››</li>
                    <li><?php the_title() ?></li>
                </ul>
            </div>
            <div class="innerpage thankyoupage">
                <center><h1 class="thankyoutitle"><?php _e("Thank you and good luck","twentythirteen") ?></h1></center>
                <div class="clear_inner">&nbsp;</div>
                <div class="comman">
                    <div class="thankyoupage1">
                        <p class="thanktxt1">
                            <?php _e("Congratulation, your payment was successful. We wish you luck on your next draw. Thank you for playing with OroLotto the online lottery membership club.","twentythirteen") ?>
                        </p>

                        <p class="thanktxt">
                            <img style="width:100px;margin-right:5px;" src="<?php echo TEMPLATE_URL; ?>/images/logos/<?php echo strtolower($response_decoded[0]->LotteryName) ?>1.png">
                            <?php if ( wp_is_mobile() ) {
                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;". $nrlines . "&nbsp;" . $lineshare ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $nrdraws . "&nbsp;" . __("Draws","twentythirteen") .
                                    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>". __("Purchase Date:","twentythirteen") ."&nbsp;&nbsp;&nbsp;&nbsp;" . date('d/m/Y') .
                                    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>". __("End Date:","twentythirteen") . "&nbsp;&nbsp;&nbsp;&nbsp;" . $date .
                                    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>Price: <strong>". SITE_CURRENCY . $money . "</strong>"
                                ;
                            } else {
                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;". $nrlines . "&nbsp;" . $lineshare ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $nrdraws . "&nbsp;" . __("Draws","twentythirteen") .
                                    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . __("Purchase Date:","twentythirteen") ."&nbsp;&nbsp;&nbsp;&nbsp;" . date('d/m/Y') .
                                    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;". __("End Date:","twentythirteen") ."&nbsp;&nbsp;&nbsp;&nbsp;" . $date . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><span style='color:#06a153;font-size:20px;font-weight:bold;'>". SITE_CURRENCY .
                                    $money . "</span></strong>"
                                ;
                            } ?>
                        </p>

                        <h2 class="thankh2"> <?php _e("You may also like","twentythirteen") ?> </h2>

                        <?php

                    get_template_part('fragments/home-owl-slider');
                ?>
                        <div class="thankurl right"><a href="<?php echo home_url(); ?>"><?php _e("No, thanks, <span style='color:#06a153'>continue</span>","twentythirteen") ?> &#10151;</a></div>
                        <script type="text/javascript">
                            jQuery(document).ready(function ($) {
                                setTimeout(function () {
                                    jQuery(document).trigger("refresh_balance");
                                }, 500);
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    echo "<script>document.location.href='/';</script>";
    exit();
}

get_footer();

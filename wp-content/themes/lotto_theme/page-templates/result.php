<?php
    /**
    * Template Name: Result
    *
    */
    get_header();

    $temp = explode("/", $_SERVER['REQUEST_URI']);

    array_pop($temp);
    $lottery = end($temp);
    // fix for direct play page call
    if (!isset($_SESSION['allbrand']) || !is_array($_SESSION['allbrand']) || count($_SESSION['allbrand']) == 0) {
        $response = executeGenericApiCall('globalinfo/get-all-brand-draws', array("BasePricesEnabled" => true));
        $response_decoded = json_decode($response["response"]);
        //echo $response["status"];
        if ($response["status"] == 200 && is_array($response_decoded)) {
            usort($response_decoded, "sortByOrder");
            $_SESSION['allbrand'] = $response_decoded;
        }
    }

    if (isset($_SESSION['allbrand'])) {
        foreach ($_SESSION['allbrand'] as $key => $value) {
            if ($lottery === strtolower(ChangeLotteryNameForUrl($value->LotteryName) . "-results")) {
                $data = json_decode(json_encode($value), 1);
                break;
            }
        }
    }

    if (count($data) > 0) {
        if (stristr($data['LotteryName'], 'lotto') !== false || stristr($data['LotteryName'], 'loto') !== false) {
            $lotteryname = $data['LotteryName'] . " ".__("jackpot","twentythirteen");
        } else {
            $lotteryname = $data['LotteryName'] . " ".__("lotto jackpot","twentythirteen");
        }


        // Lottery Link
        $ln = strtolower(ChangeLotteryNameForUrl($data['LotteryName']));


        // Lottery Image
        $imgsrc = get_template_directory_uri() . '/images/logos/' . $ln . '1.png';
        $playlink = home_url() . "/" . strtolower(ChangeLotteryNameForUrl($data['LotteryName']) . '-lottery');
    ?>
    <style type="text/css">
        .ellipse_blue{
            height: 30px !important;
            line-height: 28px !important;
        }
        .ellipse_green{
            line-height: 30px !important;
        }
        .l-results-header{
            -webkit-box-align: center;
            align-items: center;
            border-bottom: 1px solid #d9deda;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            flex-direction: row;
            -webkit-box-pack: justify;
            justify-content: space-between;
        }
        .winning_number_dropdown{
            margin: -41px 10px 0px 0px !important;
            float: right !important;
        }
        .displaydate{
            font-size: 16px;
            margin-top: 20px;
        }
        .winning_number {
            width: 100%;
            float: left;
        }
        .prizebreakdown2 {
            width: 100%;
            float: left;
        }
        .prizebreakdown2_table tr th{
            background: #fff;
            border: 1px solid #d3d0d0;
            border-right-width: 1px !important;
            color: #0169b2;
        }

        .breakdown tr:hover {
            background: #fff;
            color: #0169b2 !important;
        }

    </style>

    <script type="text/javascript">
        jQuery(document).ready(function () {



            jQuery(".loader").show();

            var datastring = "action=lottery_data&m=globalinfo/get-lotteries-last-results&lt=<?php echo $data['LotteryTypeId']; ?>";
            jQuery.ajax({
                type: "POST",
                url: CONFIG.adminURL,
                data: datastring,
                success: function (resp) {
                    jQuery(".winning_number_detail").html(resp);

                    var drid = jQuery(".datewiseresult option:first").attr("data-id");
                    var selecteddate = jQuery(".datewiseresult option:first").attr("data-date");
                    jQuery("#replace-date").html(selecteddate);
                    displayPrizes(drid);
                }

            });

        });

        function displayPrizes(drid) {
            jQuery(".loader").show();
            var datastring = "action=lottery_data&m=globalinfo/get-lotteries-last-results-prizes&drid=" + drid;
            jQuery.ajax({
                type: "POST",
                url: CONFIG.adminURL,
                data: datastring,
                success: function (resp) {
                    jQuery(".loader").hide();
                    jQuery(".breakdown").removeClass("hide");
                    jQuery(".breakdown").html(resp);
                }
            });
        }

    </script>
    <div id="middle" class="innerbg singleresult" style="margin-top: 0px;">

        <div id="result-page-wrap" class="wrap">

            <?php /*

                <div class="banner_txt">
                <?php
                $response .=
                '<div class="slider_content">
                <div class="clock">
                <span id="dispclock">' . date("d M H:i:s", strtotime($data['DrawDate'])) . '</span>
                </div>
                <script type="text/javascript">
                jQuery(document).ready(function () {
                var date = "' . date("Y-m-d H:i:s", strtotime($data['DrawDate'])) . '";
                jQuery("#dispclock").countdown(date, function (event) {
                jQuery(this).html(event.strftime("<table><tr><td><h1><span>%D</span></h1></td><td><h1><span>%H</span></h1></td><td><h1><span>%M</span></h1></td></tr><tr><td>'.__('days','twentythirteen').'</td><td>'.__('hrs','twentythirteen').'</td><td>'.__('min','twentythirteen').'</td></tr></table>"));
                });
                });
                </script>
                </div> ';
                echo $response;
                ?>
                <div class="hadding">
                <?php
                if ($data['Jackpot'] < 0) {
                $jackpot = 'PENDING';
                } else {
                $jackpot = $data['LotteryCurrency2'] . '' . number_format($data['Jackpot'], 0, "", ",");
                }
                ?>
                <h1><?php _e('Official','twentythirteen'); ?> <?php echo convert_country_name($data['CountryName']) . " " . $data['LotteryName']; ?></h1>

                <h2>
                <div class="play-btn-result-page">
                <a href="<?php echo $playlink;?>"><?php _e('Play Now','twentythirteen') ?></a>
                </div>
                <span class="info-page-jackpot"><?php echo $jackpot;?></span>
                </h2>
                </div>

                </div>

            */ ?>

            <div class="resultjackpot">
                <div class="resultjackpot_hadding" style="padding:20px 0;">
                    <img style="width:100px; vertical-align:center;" src="<?php echo $imgsrc; ?>" />
                </div>
                <div class="resultjackpot_detail">
                    <!-- <p> -->
                    <?php while (have_posts()) : the_post(); ?>

                        <?php the_content(); ?>

                        <?php endwhile; ?>
                    <!-- </p> -->
                </div>
            </div>


            <div class="clear_inner">&nbsp;</div>
            <div class="winning_number">
                <?php /* <h3><?php echo $data['LotteryName']; ?> <?php _e('Winning Numbers','twentythirteen') ?></h3> */?>
                <div class="winning_number_detail">
                    <!--Dynamic Content load-->
                </div>
            </div>
            <div class="prizebreakdown2">
                <h3><?php _e('Prize Breakdown','twentythirteen') ?></h3>
                <div class="prizebreakdown2_table">

                    <table width="100%" border="0" cellspacing="0" cellpadding="0">

                        <tbody class="breakdown hide">

                            <!--Dynamic Content load-->
                        </tbody>
                    </table>
                    <img src="<?php bloginfo("template_directory") ?>/images/loading.gif" class="loader">
                </div>
            </div>
            <?php /*
                <div class="winning_number">
                <h3><?php echo $data['LotteryName']; ?> <?php _e('Winning Numbers','twentythirteen') ?></h3>
                <div class="winning_number_detail">
                <!--Dynamic Content load-->
                </div>
                </div>
            */ ?>

            <div class="clear_inner">&nbsp;</div>
            <div>
                <?php
                    echo apply_filters('the_content', get_field("result_field_first_data"));
                ?>
            </div>
        </div>
    </div>
    <?php
} else {
    echo "<script>location.reload();</script>";
    exit();
}

get_footer();

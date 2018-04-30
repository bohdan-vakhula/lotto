<?php
    /**
    * Template Name: Info
    *
    */
    get_header();

    $temp = explode("/", $_SERVER['REQUEST_URI']);

    array_pop($temp);
    $lottery = end($temp);

    if (isset($_SESSION['allbrand'])) {
        foreach ($_SESSION['allbrand'] as $key => $value) {
            if ($lottery === strtolower($value->LotteryName . "-info")) {
                $data = json_decode(json_encode($value), 1);
                break;
            }
        }
    }

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

    if (count($data) > 0) {

        $playlink = HOME_URL . "/" . strtolower(ChangeLotteryNameForUrl($data['LotteryName']).'-lottery');
        $flagimg  = TEMPLATE_URL . "/images/flag_" . strtolower($data['CountryName']) . ".png";
        // Lottery Image
        $imgsrc = TEMPLATE_URL . '/images/logos/' . strtolower(ChangeLotteryNameForUrl($data['LotteryName'])) . '1.png';
        $breakdown = "";
        if ($data['LotteryName'] === "PowerBall") {
            $breakdown = '<tr>
            <td height="30" align="center" valign="top" width="20%">' . $data['CountryName'] . '</td>
            <td align="center" valign="top" width="20%">Wednesday 23:00 <br/> Saturday 23:00</td>
            <td align="center" valign="top" width="20%">5/69 + PowerBall 1/26</td>
            <td align="center" valign="top" width="20%">29 Annual installments Cash Value: About 50%</td>
            <td align="center" valign="top" width="20%">About 36.00%</td>
            </tr>';
            $lotterystart = 'US$ 40,000,000';
            $odds = "24.9";
        } else if ($data['LotteryName'] === "MegaMillions") {
                $breakdown = '<tr>
                <td height="30" align="center" valign="top" width="20%">' . $data['CountryName'] . '</td>
                <td align="center" valign="top" width="20%">Tuesday 23:00 <br/> Friday 23:00</td>
                <td align="center" valign="top" width="20%">5/75 + MegaBall 1/15</td>
                <td align="center" valign="top" width="20%">26 Annual installments Cash Value: About 50%</td>
                <td align="center" valign="top" width="20%">About 34.00%</td>
                </tr>';
                $lotterystart = '$ 15,000,000';
                $odds = "14.7";
            } else if ($data['LotteryName'] === "EuroMillions") {
                    $breakdown = '<tr>
                    <td height="30" align="center" valign="top" width="20%">' . $data['CountryName'] . '</td>
                    <td align="center" valign="top" width="20%">Tuesday 21:00 <br/> Friday 21:00</td>
                    <td align="center" valign="top" width="20%">5/50 + LS 2/11</td>
                    <td align="center" valign="top" width="20%">Cash</td>
                    <td align="center" valign="top" width="20%">About 20.00%</td>
                    </tr>';
                    $lotterystart = '€ 15,000,000';
                    $odds = "13";
                } else if ($data['LotteryName'] === "EuroJackpot") {
                        $breakdown = '<tr>
                        <td height="30" align="center" valign="top" width="20%">' . $data['CountryName'] . '</td>
                        <td  align="center" valign="top" width="20%">Friday 21:00</td>
                        <td align="center" valign="top" width="20%">5/50 + EuroStars 2/10</td>
                        <td align="center" valign="top" width="20%">Cash</td>
                        <td align="center" valign="top" width="20%">About 6.00%</td>
                        </tr>';
                        $lotterystart = '€ 10,000,000';
                        $odds = "26";
                    } else if ($data['LotteryName'] === "Lotto649") {
                            $breakdown = '<tr>
                            <td height="30" align="center" valign="top" width="20%">' . $data['CountryName'] . '</td>
                            <td align="center" valign="top" width="20%">Wednesday 21:00 <br/> Saturday 21:00</td>
                            <td align="center" valign="top" width="20%">6/49</td>
                            <td align="center" valign="top" width="20%">Cash</td>
                            <td align="center" valign="top" width="20%"></td>
                            </tr>';
                            $lotterystart = 'CAD$ 5,000,000';
                            $odds = "6.6";
                        } else if ($data['LotteryName'] === "SuperEnalotto") {
                                $breakdown = '<tr>
                                <td height="30" align="center" valign="top" width="20%">' . $data['CountryName'] . '</td>
                                <td align="center" valign="top" width="20%">Tuesday 20:00 <br/> Thursday 20:00 <br/> Saturday 20:00</td>
                                <td align="center" valign="top" width="20%">6/90</td>
                                <td align="center" valign="top" width="20%">Cash</td>
                                <td align="center" valign="top" width="20%">About 6.00%</td>
                                </tr>';
                                $lotterystart = '€ 1,300,000';
                                $odds = "318";
                            } else if ($data['LotteryName'] === "LaPrimitiva") {
                                    $breakdown = '<tr>
                                    <td height="30" align="center" valign="top" width="20%">' . $data['CountryName'] . '</td>
                                    <td align="center" valign="top" width="20%">Thursday 21:30 <br/> Saturday 21:30</td>
                                    <td align="center" valign="top" width="20%">6/49</td>
                                    <td align="center" valign="top" width="20%">Cash</td>
                                    <td align="center" valign="top" width="20%">About 20.00%</td>
                                    </tr>';
                                    $lotterystart = '€ 3,000,000';
                                    $odds = "10";
                                } else if ($data['LotteryName'] === "ElGordo") {
                                        $breakdown = '<tr>
                                        <td height="30" align="center" valign="top" width="20%">' . $data['CountryName'] . '</td>
                                        <td align="center" valign="top" width="20%">Sunday 21:00</td>
                                        <td align="center" valign="top" width="20%">5/54 + Reintegro 1/9</td>
                                        <td align="center" valign="top" width="20%">Cash</td>
                                        <td align="center" valign="top" width="20%">About 20.00%</td>
                                        </tr>';
                                        $lotterystart = '€ 5,000,000';
                                        $odds = "10";
                                    } else if ($data['LotteryName'] === "BonoLoto") {
                                            $breakdown = '<tr>
                                            <td height="30" align="center" valign="top" width="20%">' . $data['CountryName'] . '</td>
                                            <td height="30" align="center" valign="top" width="20%">Monday 21:30 <br/> Tuesday 21:30  <br/> Wednesday 21:30 <br/> Thursday 21:30 <br/> Friday 21:30  <br/> Saturday 21:30 </td>
                                            <td align="center" valign="top" width="20%">6/49</td>
                                            <td align="center" valign="top" width="20%">Cash</td>
                                            <td align="center" valign="top" width="20%">About 20.00%</td>
                                            </tr>';
                                            $lotterystart = '€ 400,000';
                                            $odds = "10";
                                        } else if ($data['LotteryName'] === "NewYorkLotto") {
                                                $breakdown = '<tr>
                                                <td height="30" align="center" valign="top" width="20%">' . $data['CountryName'] . '</td>
                                                <td align="center" valign="top" width="20%">Wednesday 23:00  <br/> Saturday 23:00</td>
                                                <td align="center" valign="top" width="20%">6/59</td>
                                                <td align="center" valign="top" width="20%">26 annual installments</td>
                                                <td align="center" valign="top" width="20%">About 37.00%</td>
                                                </tr>';
                                                $lotterystart = '$ 2,000,000';
                                                $odds = "46";
                                            } else if ($data['LotteryName'] === "UkLotto") {
                                                    $breakdown = '<tr>
                                                    <td height="30" align="center" valign="top" width="20%">' . $data['CountryName'] . '</td>
                                                    <td align="center" valign="top" width="20%">Wednesday 22:30  <br/> Saturday 20:30</td>
                                                    <td align="center" valign="top" width="20%">6/59</td>
                                                    <td align="center" valign="top" width="20%">Cash</td>
                                                    <td align="center" valign="top" width="20%">No Tax / Tax FREE</td>
                                                    </tr>';
                                                    $lotterystart = '£ 20,000';
                                                    $odds = "9.3";
                                                } elseif ($data['LotteryName'] === "OzLotto") {
                                                    $breakdown = '<tr>
                                                    <td height="30" align="center" valign="top" width="20%">' . $data['CountryName'] . '</td>
                                                    <td align="center" valign="top" width="20%">Tuesday 10:40 am (GMT)</td>
                                                    <td align="center" valign="top" width="20%">7/45 + 2 Extra</td>
                                                    <td align="center" valign="top" width="20%">Cash</td>
                                                    <td align="center" valign="top" width="20%">No Tax / Tax FREE</td>
                                                    </tr>';
                                                    $lotterystart = 'AUD$ 2 000 000';
                                                }
    ?>
    <script defer="defer" src="<?php echo TEMPLATE_URL;; ?>/js/jquery.countdown.js"></script>

    <div id="middle" class="singleresult" style="margin-top: 0px;">
        <div id="info-page-wrap" class="wrap">
        
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
                        <span class="info-page-jackpot"><?php echo $jackpot;?></span>
                        <div class="play-btn-result-page">
                            <a href="<?php echo $playlink;?>"><?php _e('Play Now','twentythirteen') ?></a>
                        </div>
                    </h2>
                </div>

            </div> 
            
             */?>

            <div class="resultjackpot">
                <div class="resultjackpot_hadding" style="padding:20px 0;">
                    <img style="width:100px;" src="<?php echo $imgsrc; ?>" />
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
            <div class="prizebreakdown_table allresult_table">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <th align="center" valign="middle" class="hadding"><?php _e('Hosted In','twentythirteen') ?></th>
                        <th align="center" valign="middle" class="hadding"><?php _e('Schedule','twentythirteen') ?></th>
                        <th align="center" valign="middle" class="hadding"><?php _e('Guess Range','twentythirteen') ?></th>
                        <th align="center" valign="middle" class="hadding"><?php _e('Jackpot Type','twentythirteen') ?></th>
                        <th align="center" valign="middle" class="hadding"><?php _e('Tax Requirements','twentythirteen') ?></th>
                    </tr>
                    <?php echo $breakdown; ?>
                </table>
            </div>

            <div class="clear_inner">&nbsp;</div>
            <div class="prizebreakdown">
                <h3><?php _e('Prize Breakdown','twentythirteen') ?></h3>
                <div class="comman font14"><?php _e('Lottery Starts From:','twentythirteen') ?> <?php echo $lotterystart; ?></div>
                <div class="chart">
                    <?php
                        $graph = get_post_meta($post->ID, 'wp_custom_attachment', true);

                        if (is_array($graph) && count($graph) > 0) {
                            echo '<img src="' . $graph['url'] . '" alt="Graph image" />';
                        }
                    ?>
                </div>
                <div class="comman fontcapital"><?php _e('*The overall odds of winning any prize in the game are approximately 1 in ' . $odds . '.','twentythirteen') ?></div>
            </div>
            <div class="clear_inner">&nbsp;</div>
            <div>
                <!-- <h3>About <?php echo $data['LotteryName']; ?></h3> -->
                <p>
                    <?php the_field('result_field_second_data'); ?>
                </p>
            </div>

            <div class="clear_inner">&nbsp;</div>
            <div>
                <?php
                    echo apply_filters('the_content', get_field("result_field_first_data"));
                ?>
            </div>
            <div class="clear_inner">&nbsp;</div>
        </div>
    </div>

    <?php
} else {
    echo "<script>location.reload();</script>";
    exit();
}

get_footer();

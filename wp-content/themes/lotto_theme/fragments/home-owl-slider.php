<!--<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>-->
<style type="text/css">
    .owl-carousel {
        width: 100%;
        margin-top: -65px;
    }
    .slide.MegaMillions.track{
        background: linear-gradient(#333796,#CF8486);
    }
    .slide.SuperEnalotto.track{

        background: linear-gradient(#FF720E,#FFE9C2);
    }
    .slide.EuroMillions.track{
        background: linear-gradient(#093D81,#FDBF3A);
    }
    .slide.PowerBall.track{
        background: linear-gradient(#FC162D,#FEDADD);
    }
    .slide.ElGordo.track{
        background: linear-gradient(#508AC2,#C30000);
    }
    .slide.LaPrimitiva.track{
        background: linear-gradient(#AD15B6,#F6E6F9);
    }
    .slide.EuroJackpot.track{
        background: linear-gradient(#128296,#A9FBF7);
    }
    .slide.Lotto649.track{
        background: linear-gradient(#474FA7,#D33C3E);
    }
    .slide.NewYorkLotto.track{
        background: linear-gradient(#712847,#5C51A7);
    }
    .slide.OzLotto.track{
        background: linear-gradient(#7DC929,#F5F02B);
    }
    .slide.UkLotto.track{
        background: linear-gradient(#B12AB3,#9AA8A1);
    } 
    .slide.BonoLoto.track{
        background: linear-gradient(#4AA5BE,#AADFEC);
    }

    .lotto-owl-slider .slide {
        width: 310px;
        /*margin-right: 15px;*/
        margin: 0px 0px 0px 20px;
        padding: 0;
        overflow: hidden;
        height: auto;
        background-image: none;
        cursor: default!important;
        float: left;
    }
    .lotto-owl-slider .mainbox .teaserBox {
        color: #0c2e61 !important;
    }
    .lotto-owl-slider .teaserBox {
        box-shadow: none;
        height: auto;
        position: relative;
        border-radius: 3px 3px 0 0;
        border-bottom: 1px solid #ddd;
    }
    .lotto-owl-slider .teaserBox:before {
        border-radius: 100px 100px 100px 100px/10px 10px 10px 10px;
        bottom: 15px;
        box-shadow: 0 15px 5px rgba(0,0,0,.7);
        content: "";
        height: 20px;
        left: 5%;
        max-width: 300px;
        position: absolute;
        width: 90%;
        z-index: -1;
    }
    .lotto-owl-slider .teaserBox .content {
        height: 115px;
    }
    .lotto-owl-slider .lottoLabel {
        display: block;
        font-family: "daxlinebold";
        font-size: 24px;
        font-weight: 400;
        height: 50px;
        line-height: 26px;
        /* text-shadow: 0 -1px 0 #333; */
        padding: 10px 0 0 10px;
        width: 200px;
        color: #ffffff !important;
    }
    .lotto-owl-slider .teaserBox .jackpot {
        font-family: "daxlinebold";
        font-size: 27px;
        line-height: 50px;
        padding-left: 5px;
        padding-top: 0;
        color: #ffffff;
        font-weight: bold;
    }
    /*.lotto-owl-slider  .teaserBox .jackpot span:last-of-type {
    font-size: 36px;
    margin-right: 4px;
    }*/
    .lotto-owl-slider .teaserBox .jackpot .amount {
        margin-left: 5px;
    }
    .lotto-owl-slider .teaserBox .footer {
        background: linear-gradient(90deg,#eee,#fff,#eee);
        height: 50px;
        position: relative;
    }
    .lotto-owl-slider .teaserBox .footer .countdown, .startTeaserCol .teaserBox .footer .euroEquivalent {
        bottom: 14px;
        /*color: #999;*/
        color: #0c2e61;
        font-size: 13px;
        font-weight: 700;
        left: 10px;
        line-height: 20px;
        position: absolute;
        text-shadow: 0 1px 0 #fff, 0 1px 0 #fff, 0 1px 0 #fff;
    }
    .iHourglass {
        font-style: normal;
    }
    .lotto-owl-slider .teaserBox .footer .countdown:before, .startTeaserCol .teaserBox .footer .euroEquivalent:before {
        font-size: 24px;
        margin-right: 6px;
        position: relative;
        top: 2px;
    }
    .iHourglass:before {
        content: "\0057";
    }
    /*.i:before, i:before {
        font-family: Icons;
        font-weight: 400;
        font-size: 1.3em;
        position: relative;
        text-align: center;
        line-height: normal;
    }*/
    .button.goOn {
        position: absolute;
        bottom: 6px;
        right: 12px;
    }


    .button.goOn {
        display: inline-block;
        cursor: pointer;
        height: 36px;
        background-color: #8bc53f;
        color: #fff;
        font-family: Arial,sans-serif;
        font-weight: 700;
        font-size: 12px;
        text-decoration: none;
        text-align: center;
        text-shadow: 1px 1px 0 #8bc53f;
        padding: 0 12px;
        border: 0;
        border-radius: 5px;
        vertical-align: bottom;
        box-sizing: border-box;
        line-height: 34px;
        padding-top: 0;
        padding-bottom: 2px;
        box-shadow: inset 0 -4px 0 -2px #8bc53f;
        background-size: 100%;
        /*background-image: linear-gradient(#c3dc41,#97bd00);*/
    }
    a.button.goOn:hover {
        background: #0df90d;
        box-shadow: none;
        text-shadow: none;
    }
    .all .button.arrow:after, .all button.arrow:after {
        font-family: Icons;
        content: "\003e";
        font-size: 11px;
        padding-left: 6px;
    }
</style>
<?php
    global $all_brand_draws;

    //echo "<pre>";print_R($all_brand_draws);die;

    function secondsToWords($seconds)
    {
        $ret = "";

        /*** get the days ***/
        $days = intval(intval($seconds) / (3600*24));
        if($days> 0)
        {
            $ret .= "$days days ";
        }

        /*** get the hours ***/
        $hours = (intval($seconds) / 3600) % 24;
        if($hours > 0)
        {
            $ret .= "$hours hours ";
        }

        /*** get the minutes ***/
        $minutes = (intval($seconds) / 60) % 60;
        if($minutes > 0)
        {
            if($days <= 0){

                $ret .= "$minutes minutes ";

            }
        }

        /*** get the seconds ***/
        $seconds = intval($seconds) % 60;
        if ($seconds > 0) {
            //$ret .= "$seconds seconds";
        }

        return $ret;
    }

?>
<?php /*  if (!empty($all_brand_draws)): ?>
    <div class="wrap lotto-owl-slider">
    <div id="owl-demo" class="owl-carousel">
    <?php
    $templatedir = TEMPLATE_URL;
    $clockimg = $templatedir . '/images/scroller_time.png';
    $response = ' ';
    foreach ($all_brand_draws as $key => $val) {
    $lotteryname = strtolower(ChangeLotteryNameForUrl($val->LotteryName));
    $lotteryname2 = ($val->LotteryName);
    $imgsrc = '/images/logos/' . $lotteryname . '1.png';

    if ($val->Jackpot < 0) {
    $jackpot = 'PENDING';
    } else {
    $jackpot = $val->LotteryCurrency2 . ' ' . number_format($val->Jackpot / 1000000, 2)  . ' Million';
    }

    $country = strtoupper($val->CountryName);

    $response .= '<a href = "' . home_url() . '/' . $lotteryname . '-lottery/" class = "item">';
    $response .= '<div class="slider_box">';
    $response .= '<div class ="item_img"><img src = "' . TEMPLATE_URL . $imgsrc . '" /></div>';
    $response .= '<div class="slider_bg ' . $lotteryname . '">';
    $response .= '<div class="slidewrap"><h1 class="lname">' . $lotteryname2 . '</h1>';
    $response .= '<h3 class="lname3">'. $country .'</h3>';
    $response .= '<h2 class="lname2">' . $jackpot .'</h2></div></div>';
    //$response .= '<div class="carousel_time">';
    $response .= '<div class="carousel_time_text" id="caro_clock_' . $key . '">' . date("d M H:i:s", strtotime($val->DrawDate)) . '</div>';
    $response .= '<div class="comman"><span class="buy_button">'.__('Play Now','twentythirteen').'</span>';
    $response .= '<script type="text/javascript">
    jQuery(document).ready(function () {
    var date = "' . date("Y-m-d H:i:s", strtotime($val->DrawDate)) . '";
    var days = "' . date('d', strtotime($val->DrawDate)) . '";
    days*=1;
    jQuery("#caro_clock_' . $key . '").countdown(date, function (event) {
    jQuery(this).html(event.strftime("<h4><span>%D</span>'.__(' Days : ','twentythirteen').'<span>%H</span>'.__(' Hrs : ','twentythirteen').'<span>%M</span>'.__(' Min : ','twentythirteen').'<span>%S</span>'.__(' Sec','twentythirteen').'</h4>"));
    if (days <= 3) {
    jQuery("#caro_clock_' . $key . ' td:first-of-type").css("display","none");
    }
    });
    });
    </script></div>';
    $response .= '</div></a>';
    }
    echo $response;
    ?>
    </div>
    <a href="<?php echo HOME_URL ?>/lottery/" class="right"><?php _e('View all lotteries', 'twentythirteen'); ?><i class="ico-arrow-right"></i></a>
    <div class="clear"></div>
    </div><!-- Desktop content /-->
<?php endif */ ?>

<?php  if (!empty($all_brand_draws)): ?>
    <div class="wrap lotto-owl-slider">
        <div id="owl-demo" class="owl-carousel">
            <?php  foreach ($all_brand_draws as $key => $val) {

                    $lotteryname = strtolower(ChangeLotteryNameForUrl($val->LotteryName));
                    $lotteryname2 = ($val->LotteryName);
                    $imgsrc = '/images/logos/' . $lotteryname . '1.png';

                    if ($val->Jackpot < 0) {
                        $jackpot = 'PENDING';
                    } else {
                        $jackpot = $val->LotteryCurrency2 . ' ' . number_format($val->Jackpot / 1000000, 2)  . ' Million';
                    }

                    $country = strtoupper($val->CountryName);

                ?>
                <div class="slide <?php echo $val->LotteryName; ?> track" data-track-name="slideWM">
                    <a data-query="dyj=false" href="<?php echo home_url() . '/' . $lotteryname . '-lottery/'; ?>" class="js-ajaxNavi ajaxNavi">
                        <div class="teaserBox">
                            <div class="content">
                                <img style="width: 80px;float: right;" src = "<?php echo TEMPLATE_URL . $imgsrc;?>" />
                                <div class="lottoLabel">
                                    <?php echo $lotteryname2; ?>
                                </div>
                                <div class="jackpot">
                                    <?php 
                                        if ($val->Jackpot < 0) { echo "PENDING"; ?>
                                        <?php  } else { ?>
                                        <span class="currency"><?php echo $val->LotteryCurrency2; ?></span><span class="amount"><?php echo number_format($val->Jackpot / 1000000, 2); ?></span> million
                                        <?php    } ?>
                                </div>
                            </div>
                            <div class="footer">

                                <?php 
                                    //echo date("Y-m-d H:i:s", strtotime($val->DrawDate));
                                    $totalSec = (strtotime(date("Y-m-d H:i:s", strtotime($val->DrawDate)))-time());

                                ?>
                                <div class="countdown" id="caro_clock_<?php echo $key; ?>"><?php echo secondsToWords($totalSec); ?></div>
                                <?php /* $scriptdata = '<script type="text/javascript">
                                    jQuery(document).ready(function () {
                                    var date = "' . date("Y-m-d H:i:s", strtotime($val->DrawDate)) . '";
                                    var days = "' . date('d', strtotime($val->DrawDate)) . '";
                                    days*=1;
                                    jQuery("#caro_clock_' . $key . '").countdown(date, function (event) {
                                    jQuery(this).html(event.strftime("<span>%D</span>'.__(' Days : ','twentythirteen').'<span>%H</span>'.__(' Hrs : ','twentythirteen').'<span>%M</span>'.__(' Min : ','twentythirteen').'<span>%S</span>'.__(' Sec','twentythirteen').'"));
                                    if (days <= 3) {
                                    jQuery("#caro_clock_' . $key . ' td:first-of-type").css("display","none");
                                    }
                                    });
                                    });
                                    </script>'; 

                                    echo $scriptdata; */

                                ?>
                                <a href="<?php echo home_url() . '/' . $lotteryname . '-lottery/'; ?>" class="button goOn">Play Now</a>
                            </div>
                        </div>
                    </a>
                </div>
                <?php } ?>
        </div>
        <a href="<?php echo HOME_URL ?>/lottery/" class="right" style="margin: 12px 0 0 0;"><?php _e('View all lotteries', 'twentythirteen'); ?><i class="ico-arrow-right"></i></a>
        <div class="clear"></div>
    </div><!-- Desktop content /-->
    <?php endif ?>

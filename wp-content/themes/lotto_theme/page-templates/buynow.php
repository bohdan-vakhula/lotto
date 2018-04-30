<?php
    /*
    * Template Name: buynow
    *
    */
    get_header();

    function selectNumCol($data, $numbOfTicket)
    {
        $lotteriesNames = array(
        'PowerBall'    => __(' 1 Power Ball', 'twentythirteen'),
        'MegaMillions' => __(' 1 Mega Ball', 'twentythirteen'),
        'EuroMillions' => __(' 2 Lucky Numbers', 'twentythirteen'),
        'EuroJackpot'  => __(' 2 EuroStars', 'twentythirteen'),
        );

        if (wp_is_mobile()) { ?>

        <!-- mobile ver /-->

        <div class="select_num_col">

            <div class="close-btn">
                <a href="javascript:void(0)" class="quickpic_close visible-xs">
                    <img src="<?php echo TEMPLATE_URL; ?>/images/close-icon.png"/>
                </a>
            </div>

            <div class="select_num_col_part">

                <div class="all_num_part">
                    <div class="lt_numbers_wrapper">
                        <?php
                            for ($i = 1; $i <= $data['NumberOfMainNumbers']; $i++) {
                                echo "<span id=\"$i\">$i</span>";
                            }
                        ?>
                    </div>
                </div>
                <?php if ($data['NumberOfExtraNumbers'] > 0) : ?>
                    <div class="select_num_part">

                        <div class="select_num_part_wrapper">
                            <?php
                                for ($i = $data["MinExtraNumber"]; $i <= $data['NumberOfExtraNumbers']; $i++) {
                                    echo "<span class=\"line\" id=\"$i\">$i</span>";
                                }
                            ?>
                        </div>
                    </div>
                    <?php endif; ?>

                <div class="quickpic-mobile">
                    <div class="quickpic_text" style="display:none;">QUICK PICK</div>
                    <a href="javascript:void(0)" class="quickpic_delete">

                    </a>
                </div>
            </div>

        </div>

        <?php } else {  ?>

        <!-- desktop ver /-->

        <div class="select_num_col">
            <div class="select_num_col_part">
                <div class="select_num_col_part-blue"></div>
                <?php /* //Display Delete Button one hover of column */?>
                <div class="quickpic">
                    <div class="quickpic_text on_ticket">&nbsp;</div>
                    <h6 class="pick_num_title"><?php _e('Pick', 'twentythirteen') ?>  <?php echo $data['AmountOfMainNumbersToMatch']; ?> <?php _e('Numbers', 'twentythirteen') ?></h6>
                    <a href="javascript:void(0)" class="quickpic_delete">
                        <!--<img src="<?php echo TEMPLATE_URL; ?>/images/delete.png"/>-->
                    </a>
                    <a href="javascript:void(0)" class="quickpic_close visible-xs">
                        <img src="<?php echo TEMPLATE_URL; ?>/images/close-icon.png"/>
                    </a>
                </div>
                <div class="all_num_part">

                    <!--<h6 class="slide-trigger"><?php _e('Pick', 'twentythirteen') ?>  <?php echo $data['AmountOfMainNumbersToMatch']; ?> <?php _e('Numbers', 'twentythirteen') ?></h6>-->
                    <div class="watermarktry">
                        <p class="watermarkdigit"><?php echo $numbOfTicket; ?></p>
                    </div>
                    <div class="lt_numbers_wrapper">
                        <!--<div class="watermarktry">
                        <p class="watermarkdigit">2</p>
                        </div>-->
                        <?php
                            for ($i = 1; $i <= $data['NumberOfMainNumbers']; $i++) {
                                echo "<span id=\"$i\">$i</span>";
                            }
                        ?>
                    </div>
                </div>
                <?php if ($data['NumberOfExtraNumbers'] > 0) : ?>
                    <div class="select_num_part">
                        <h5 class="slide-trigger"><?php _e('Pick', 'twentythirteen') ?> <?php echo $lotteriesNames[$data['LotteryName']]; ?></h5>
                        <div class="select_num_part_wrapper">
                            <?php
                                for ($i = $data["MinExtraNumber"]; $i <= $data['NumberOfExtraNumbers']; $i++) {
                                    echo "<span class=\"line\" id=\"$i\">$i</span>";
                                }
                            ?>
                        </div>
                    </div>
                    <?php endif; ?>
            </div>
        </div>

        <?php } ?>

    <?php } ?>

<?php if (empty($_SESSION['allbrand'])) {
        $response = executeGenericApiCall('globalinfo/get-all-brand-draws', array("BasePricesEnabled" => true));
        $response_decoded = json_decode($response["response"]);

        if ($response["status"] == 200 && is_array($response_decoded)) {
            usort($response_decoded, "sortByOrder");
            $_SESSION['allbrand'] = $response_decoded;
        }
    }

    $lottery = GetLotteryNameFromUrl($_SERVER['REQUEST_URI']);
    if (isset($_SESSION['allbrand'])) {
        foreach ($_SESSION['allbrand'] as $key => $value) {
            if (strtolower($lottery) === strtolower($value->LotteryName)) {
                $data = json_decode(json_encode($value), 1);
                $lotterytypeid = $value->LotteryTypeId;

                break;
            }
        }
    }

    // get rules min lines
    $data["MinExtraNumber"] =1;
    $response = executeGenericApiCall('globalinfo/lottery-rules', array());
    $response_decoded1 = json_decode($response["response"]);
    if ($response["status"] == 200 && is_array($response_decoded1)) {
        $rulesData = $response_decoded1;
        foreach ($rulesData as $key => $value) {
            if ($value->LotteryTypeId === $lotterytypeid) {
                $data["MinExtraNumber"] = $value->MinExtraNumber;
                $data["MinLines"] = $value->MinLines;
                $data["MaxLines"] = $value->MaxLines;
                $data["EvenLinesOnly"] = $value->EvenLinesOnly;
                break;
            }
        }
    }


    if (!isset($_SESSION['groupdata'])) {
        $response = executeGenericApiCall('globalinfo/get-prices-and-discounts', array("NumberOfDraws" => 1, "ProductId" => 3));
        $response_decoded = json_decode($response["response"]);

        if ($response["status"] == 200 && is_array($response_decoded)) {
            $_SESSION['groupdata'] = $response_decoded;
        }
    }

    if (isset($_SESSION['groupdata'])) {
        foreach ($_SESSION['groupdata'] as $key => $value) {
            if ($lotterytypeid == $value->LotteryTypeId) {
                $groupdata = json_decode(json_encode($value), 1);
                break;
            }
        }
    }

    $selectedno = $groupsel = "";
    if (isset($_SESSION['user_selection']) && count($_SESSION['user_selection']) > 0) {
        foreach ($_SESSION['user_selection'] as $key => $value) {
            if ($key === $data['LotteryName'] && $value['quantity'] > 0) {
                $groupsel = $value;
            }

            if ($key === $data['LotteryName'] && $value['lines'] > 0) {
                $selectedno = $value;
            }
        }
    }

    if (count($data) > 0) {
        // Selections
        $draws = 0;

        $multidraw = array(2, 4, 8, 26, 52);
        $subs = array(1, 2, 4);

        $drawop1 = $drawop2 = $drawop3 = $gdrawop1 = $gdrawop2 = $gdrawop3 = $tdraw = $ssubs = $gtdraw = $gsubs = $drawopSelected1 = $drawopSelected2 = $drawopSelected3 = $gdrawopSelected1 = $gdrawopSelected2 = $gdrawopSelected3 = "";
        if (isset($_POST['single_drawop']) && $_POST['single_drawop'] == 1) {
            $sdraws = $_POST['single_drawop'];
            $drawop1 = "checked='checked'";
            $drawopSelected1 = 'selcteddrow';
        } else {
            if (isset($_POST['single_drawop']) && $_POST['single_drawop'] == 2) {
                $sdraws = $_POST['single_totaldraw'];
                $drawop2 = "checked='checked'";
                $drawopSelected2 = 'selcteddrow';
                if (in_array($sdraws, $multidraw)) {
                    $tdraw[$draws] = "selected";
                }
            } else {
                if (isset($_POST['single_drawop']) && $_POST['single_drawop'] == 3) {
                    $sdraws = $_POST['single_subs'];
                    $drawop3 = "checked='checked'";
                    $drawopSelected3 = 'selcteddrow';
                    if (in_array($sdraws, $subs)) {
                        $ssubs[$draws] = "selected";
                    }
                } else {
                    $drawop1 = "checked='checked'";
                    $drawopSelected1 = 'selcteddrow';
                }
            }
        }

        if (isset($_POST['group_drawop']) && $_POST['group_drawop'] == 1) {
            $draws = $_POST['group_drawop'];
            $gdrawop1 = "checked='checked'";
            $gdrawopSelected1 = "selcteddgrouprow";

        } else {
            if (isset($_POST['group_drawop']) && $_POST['group_drawop'] == 2) {
                $draws = $_POST['group_totaldraw'];
                $gdrawop2 = "checked='checked'";
                $gdrawopSelected2 = "selcteddgrouprow";
                if (in_array($draws, $multidraw)) {
                    $gtdraw[$draws] = "selected";
                }
            } else {
                if (isset($_POST['group_drawop']) && $_POST['group_drawop'] == 3) {
                    $draws = $_POST['group_subs'];
                    $gdrawop3 = "checked='checked'";
                    $gdrawopSelected3 = "selcteddgrouprow";
                    if (in_array($draws, $subs)) {
                        $gsubs[$draws] = "selected";
                    }
                } else {
                    $gdrawop1 = "checked='checked'";
                    $gdrawopSelected1 = "selcteddgrouprow";
                }
            }
        }

        if ($selectedno !== "" || $groupsel !== "") {
            if (isset($selectedno['single_drawop']) && $selectedno['single_drawop'] == 1) {
                $sdraws = $selectedno['single_drawop'];
                $drawop1 = "checked='checked'";
                $drawopSelected1 = 'selcteddrow';
            } else {
                if (isset($selectedno['single_drawop']) && $selectedno['single_drawop'] == 2) {
                    $sdraws = $selectedno['single_totaldraw'];
                    $drawop2 = "checked='checked'";
                    $drawopSelected2 = 'selcteddrow';
                    if (in_array($sdraws, $multidraw)) {
                        $tdraw[$draws] = "selected";
                    }
                } else {
                    if (isset($selectedno['single_drawop']) && $selectedno['single_drawop'] == 3) {
                        $sdraws = $selectedno['single_subs'];
                        $drawop3 = "checked='checked'";
                        $drawopSelected3 = 'selcteddrow';
                        if (in_array($sdraws, $subs)) {
                            $ssubs[$draws] = "selected";
                        }
                    } else {
                        $drawop1 = "checked='checked'";
                        $drawopSelected1 = 'selcteddrow';
                    }
                }
            }

            if (isset($groupsel['group_drawop']) && $groupsel['group_drawop'] == 1) {
                $draws = $groupsel['group_drawop'];
                $gdrawop1 = "checked='checked'";
                $gdrawopSelected1 = "selcteddgrouprow";
            } else {
                if (isset($groupsel['group_drawop']) && $groupsel['group_drawop'] == 2) {
                    $draws = $groupsel['group_totaldraw'];
                    $gdrawop2 = "checked='checked'";
                    $gdrawopSelected2 = "selcteddgrouprow";
                    if (in_array($draws, $multidraw)) {
                        $gtdraw[$draws] = "selected";
                    }
                } else {
                    if (isset($groupsel['group_drawop']) && $groupsel['group_drawop'] == 3) {
                        $draws = $groupsel['group_subs'];
                        $gdrawop3 = "checked='checked'";
                        $gdrawopSelected3 = "selcteddgrouprow";
                        if (in_array($draws, $subs)) {
                            $gsubs[$draws] = "selected";
                        }
                    } else {
                        $gdrawop1 = "checked='checked'";
                        $gdrawopSelected1 = "selcteddgrouprow";
                    }
                }
            }
        }

    ?>


    <script type="text/javascript">

        function swap(one, two) {
            document.getElementById(one).style.display = 'block';
            document.getElementById(two).style.display = 'none';
        }
        // Calculate total in single.
        function totalForSingle() {

            // total price
            var lottery = jQuery("#otherdata").val().split("|");
            var stp = jQuery("#stp").val();

            var totalcard = 0;
            jQuery('.cardline').find(".select_num_col").each(function () {
                if (jQuery(this).hasClass("selected")) {
                    totalcard = parseInt(totalcard + 1);
                }
            });

            var stp1 = parseFloat(stp * totalcard).toFixed(2);
            var single = '#single';
            var group = '#group';


            var lines ='<?php _e("lines","twentythirteen") ?>';

            jQuery(single).find(".lines").html(totalcard + " "+lines);
            jQuery(single).find(".subtotal").html(stp1);
            jQuery(single).find(".bonusmoney").html(stp1);
            jQuery(single).find(".totalprice").html(stp1);

            var draws_lang ='<?php _e("Draws","twentythirteen") ?>';

            if (jQuery(single).find("input[name=single_drawop]:checked").attr("id") === "radio1") {
                jQuery(single).find(".draws").html("1 "+ draws_lang);
            }

            if (jQuery(single).find("input[name=single_drawop]:checked").attr("id") === "radio2") {
                var draws = jQuery(single).find(".single_totaldraw option:selected").val();
                jQuery(single).find(".subtotal").html(parseFloat(draws * stp1).toFixed(2));
                jQuery(single).find(".draws").html(draws + " " + draws_lang);
                DiscountCounter(draws, stp1, 1, "single");
            }

            if (jQuery(single).find("input[name=single_drawop]:checked").attr("id") === "radio3") {

                var draws = num_of_draws_group_per_week[lottery[1].toUpperCase()];
                var weeks = jQuery(single).find(".single_subs option:selected").val();

                jQuery(single).find(".subtotal").html(parseFloat(draws * weeks * stp1).toFixed(2));
                jQuery(single).find(".draws").html(parseInt(draws * weeks) + " " + draws_lang);

                DiscountCounter(draws, stp1, weeks, "single");
            }
        }
        function setActiveTab(_ticketType){
            if(_ticketType == 'single'){
                $("a[href='#single']").first().parents('li').addClass('active_li');
                $("a[href='#group']").first().parents('li').removeClass('active_li');
                jQuery( "#single" ).removeClass('hide');
                jQuery( "#single" ).addClass('active');
                jQuery( "#group" ).addClass('hide');
                jQuery( "#group" ).removeClass('active');
            }
            else {
                $("a[href='#group']").first().parents('li').addClass('active_li');
                $("a[href='#single']").first().parents('li').removeClass('active_li');
                jQuery( "#group" ).removeClass('hide');
                jQuery( "#group" ).addClass('active');
                jQuery( "#single" ).addClass('hide');
                jQuery( "#single" ).removeClass('active');
            }
        }
        jQuery(document).ready(function ($) {
            var lotteryname = window.location.pathname.substring(1, window.location.pathname.lastIndexOf('-'));

            // destop session parsing
            /*if(sessionStorage.getItem(lotteryname.toLowerCase())){
            var _data = sessionStorage.getItem(lotteryname.toLowerCase());
            var parsedData = JSON.parse(_data);

            if(typeof parsedData['storeselected'] === 'undefined' || parsedData['storeselected'] === ''){

            generateTwoLines();
            }
            } else {
            generateTwoLines();
            }*/
            // all user data gets stored on window close

            $( window ).unload(function() {
                //debugger;
                return getDataFromPaymentPage();
            });


            $( window ).load(function() {
                var lotteryname = window.location.pathname.substring(1, window.location.pathname.lastIndexOf('-'));

                //set tab to group
                var mtab = "single";
                if (typeof qs["group"] !== "undefined") {
                    mtab = "group";
                }
                setActiveTab(mtab);

                //mobile site detection and group ticket. to be refactored
                var mtab = "single";

                if (CONFIG.isMobile) {
                    //console.log(qs["group-tab"]);
                    if (typeof qs["group-tab"] !== "undefined") {
                        mtab = "group";
                    }
                    setActiveTab(mtab);
                }

                if (CONFIG.isMobile && mtab === "single") {
                    //trigger quickpick for mobile if nothing stored in session
                    //totalForSingle();
                    //console.log('mobile single')

                    //$(".picall_btn").click();
                }

                parseNumbers(lotteryname);
                if(mtab = "single") {
                    totalForSingle();
                }
            });

            // LotteryRules
            jQuery("#minl").val(<?php echo $data["MinLines"]; ?>);
            jQuery("#maxl").val(<?php echo $data["MaxLines"]; ?>);
            jQuery("#even").val(<?php echo $data["EvenLinesOnly"]; ?>);

            // Timer
            var days ='<?php _e("days","twentythirteen") ?>';
            var hrs ='<?php _e("hrs","twentythirteen") ?>';
            var min ='<?php _e("min","twentythirteen") ?>';
            var sec ='<?php _e("sec","twentythirteen") ?>';

            var date = "<?php echo date("Y-m-d H:i:s", strtotime($data['DrawDate'])); ?>";
            jQuery("#dispclock").countdown(date, function (event) {
                jQuery(this).html(event.strftime("<table><tr><td><h1><span>%D</span></h1></td><td><h1><span>%H</span></h1></td><td><h1><span>%M</span></h1></td></tr><tr><td>"+days+"</td><td>"+hrs+"</td><td>"+min+"</td></tr></table>"));
            });

            //$(".option_table").addClass("bottomFixed");
            //$(".box_ttl").hide();


            var heightToReleaseBotFix = 230;

            $(".addlines").click(function(){
                heightToReleaseBotFix+=750;
            });
            $(".removelines").click(function(){
                heightToReleaseBotFix-=750;
            });

            //$(window).scroll(function() {
            //var height = $(window).scrollTop();

            //$(".option_table").addClass("bottomFixed");
            //$(".box_ttl").hide();

            //if (height  > heightToReleaseBotFix) {
            //$(".option_table").removeClass("bottomFixed");
            //$(".box_ttl").show();
            //}
            //});

            $(".select_num_col").click(function() {
                $(".select_num_col").each(function (index, el){
                    if ($(this).hasClass('selected')) {
                        $(this).find(".watermarktry").addClass('nonDisplay');
                    } else {
                        $(this).find(".watermarktry").removeClass('nonDisplay');
                    }
                });
            })

            /*if(sessionStorage.getItem(lotteryname.toLowerCase())){
            //console.log('we have a lottery in sessionStorage');
            var _data = sessionStorage.getItem(lotteryname.toLowerCase());
            var parsedData = JSON.parse(_data);
            if(typeof parsedData['storeselected'] === 'undefined' || parsedData['storeselected'] === ''){
            generateTwoLines();
            }
            }else{
            generateTwoLines();
            }*/
            // set mobile look after session data is loaded
            //setMobileLayout();

            //second line functions not used in mobile
            /*function generateTwoLines(callback){
            /*debugger;
            if (CONFIG.isMobile == false) {

            //console.log('not mobile two lines');
            var selnum = jQuery("#storeselected").val();
            if (selnum !== "") {

            setTimeout(function () {
            var row = selnum.split("|");

            var num = [];
            for (var i = 0; i < row.length; i++) {
            if (row[i] !== "") {
            var temp = row[i].toString().split("=>");
            num[i] = temp;
            }
            }

            var line = [];
            var main = [];
            var num1 = [];
            var extra = [];

            if (num.length > 5) {
            jQuery(".addlines").trigger("click");
            }
            for (var i = 0; i < num.length; i++) {


            line = num[i][0].toString().split("-");
            num1 = num[i][1].toString().split("#");

            main = num1[0].toString().split(",");
            extra = num1[1].toString().split(",");

            var temp = parseInt(line[1]) + parseInt(1);

            for (var j = 0; j < main.length; j++) {
            jQuery("#" + line[0]).find(".select_num_col:nth-child(" + temp + ")").addClass("selected");
            jQuery("#" + line[0]).find(".select_num_col:nth-child(" + temp + ")").find(".lt_numbers_wrapper").children("#" + main[j]).addClass("main_active");

            }

            if (extra.length > 0) {

            jQuery("#" + line[0]).find(".select_num_col:nth-child(" + temp + ")").addClass("selected");
            for (var j = 0; j < extra.length; j++) {
            if(extra != "")
            {
            jQuery("#" + line[0]).find(".select_num_col:nth-child(" + temp + ")").find(".select_num_part_wrapper").children("#" + extra[j]).addClass("extra_active");
            }

            }
            }
            totalForSingle();
            if(typeof callback === 'function') {
            callback();
            }
            }

            }, 1000);
            };
            };

            };*/

        });
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <style type="text/css">
        #middle2 {
            float: left;
            margin-top: 0px;
            min-height: 133px;
            padding: 20px 20px;
            border: 1px solid #ddd;
            width: 100%;
        }

        .all_num_part{
            padding: 20px 3px 0 3px !important;
        }
        .lt_numbers_wrapper span{
            margin: 0 6px 5px 0px;
        }
        .option_table.left{
            border-left: 1px solid #e1e1e1;
            border-right: 1px solid #e1e1e1;
            border-bottom: 1px solid #e1e1e1;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
            padding: 0px 6px 14px 6px;
            margin-top: -8px;
            width: 98.8% !important;
        }
        .beton-header{
            margin: 0 0 0px 0px !important;
            width: 100.3% !important;
        }

        .tabin_main_select{
            width: 99%;
            margin-left: 4px;
        }
        .tabin_main{
            border-left: 1px solid #e1e1e1;
            border-right: 1px solid #e1e1e1;

        }
        .option_table_container{
            margin-top: 10px !important;   
        }
        .select_num_part{
            padding: 10px 2px 0px 3px !important
        }
        .select_num_part_wrapper{
            width: 103% !important;
        }
        .select_num_part_wrapper span{
            margin: 0 6px 5px 0px !important;
        }

    </style>

    <div id="middle" class="lotterydetail">

        <div id="buy-now-page" class="wrap">
            <div id="buy-now-top" class="row visible-xs">
                <br />
                <br />
                <br />
                <div class="col-xs-3">
                    <div class="mob-center">
                        <img src="<?php echo TEMPLATE_URL; ?>/images/<?php echo strtolower($data['LotteryName']) ?>.png">
                    </div>
                </div>

                <div class="col-xs-9">
                    <div class="row">
                        <div class="banner-mobile">

                            <h2>
                                <?php echo ($data['LotteryName']); ?>
                            </h2>

                        </div>
                        <div class="banner-mobile">

                            <h1>
                                <?php
                                    if ($data['Jackpot'] < 0) {
                                        $jackpot = 'PENDING';
                                    } else {
                                        $jackpot =  $data['LotteryCurrency2'] . " " . ($data['Jackpot'] / 1000000) . ' ' .__('Million','twentythirteen');
                                    }
                                    echo $jackpot;
                                ?>
                            </h1>

                        </div>
                    </div>
                </div>
                <br />
                <br />
                <br />
                <hr>
            </div>
            <div class="banner_txt">
                <div class="slider_content">
                    <div class="clock">
                        <span id="dispclock"><?php echo date("Y-m-d H:i:s", strtotime($data['DrawDate'])); ?></span>
                    </div>
                </div>
                <div class="hadding">
                    <h2>
                        <?php
                            if ($data['Jackpot'] < 0) {
                                $jackpot = 'PENDING';
                            } else {
                                $jackpot =  $data['LotteryCurrency2'] . " " . ($data['Jackpot'] / 1000000) . ' ' .__('Million','twentythirteen');
                            };

                            if (stripos($data['LotteryName'], 'lotto') !== false || stripos($data['LotteryName'], 'loto') !== false) {
                                echo $data['LotteryName'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $jackpot;
                            } else {
                                echo $data['LotteryName'] . " lotto jackpot" . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $jackpot;
                            }
                        ?>
                    </h2>
                </div>
            </div>
            <?php
                $link = home_url().'/'.strtolower($data['LotteryName']);
            ?>
            <div class="nav-holder">
                <ul id="main-nav">
                    <li class="home active_li"><a href="#single"><?php _e("Personal ticket","twentythirteen") ?></a></li>
                    <li class=" current"><a href="#group"><?php _e("Group ticket","twentythirteen") ?></a></li>
                </ul>
                <ul>
                    <li class="no-change"><a href="<?php echo $link.'-results/';?>"><?php echo $data['LotteryName'];?> Results</a></li>
                    <li class="no-change"><a href="<?php echo $link.'-info/'; ?>"><?php echo $data['LotteryName'];?> Info</a></li>
                </ul>
            </div>

            <ul id="main-nav" class="green-nav-buttons mid_buttons">
                <!--<input name="" type="button" value="<?php _e('Clear All','twentythirteen')?>" class="clearall_btn clearall"/>-->
                <span class="removelines hide hidden-xs"><?php _e('Less Lines','twentythirteen')?></span>
                <?php if (wp_is_mobile()): ?>
                    <br>
                    <br>
                    <div class="addline-more extra-lines-button"><?php _e('More Lines','twentythirteen')?></div>
                    <br>
                    <?php endif ?>
                <span class="addlines hidden-xs"><?php _e('More Lines','twentythirteen')?></span>
                <div class="clearall_btn clearall"><img src="<?php echo TEMPLATE_URL; ?>/images/delete_red.png" title="Clear All" /></div>
                <input name="" type="button" value="<?php _e('Quick Pick All','twentythirteen')?>" class="picall_btn pickall"/>
            </ul>



            <form name="singledata" id="singledata" action="<?php echo home_url(); ?>/payment" method="post">
                <div class="single active" id="single">
                    <ul id="main-nav" class="green-nav-buttons mid_buttons2">
                        <!--<input name="" type="button" value="<?php _e('Clear All','twentythirteen')?>" class="clearall_btn clearall"/>-->

                        <span class="tooltip" style="display: none;">
                            <div class="removelines hide hidden-xs"></div>
                            <span class="tip-remove-line"><?php _e('Remove Lines','twentythirteen')?></span></span>



                        <span class="tooltip" style="display: none;">
                            <div class="addlines hidden-xs"></div>
                            <span class="tip-add-line"><?php _e('Add 5 more Lines','twentythirteen')?></span></span>




                        <span class="tooltip" style="display: none;">
                            <div class="clearall_btn clearall"></div>
                            <span class="tip-clear-line"><?php _e('Clear all selected numbers','twentythirteen')?></span></span>


                        <span class="tooltip" style="display: none;">
                            <input name="" type="button" class="picall_btn pickall"/>
                            <span class="tip-pick-line"><?php _e('QuickPick Select Numbers on All Tickets on the Page','twentythirteen')?></span></span>

                    </ul>
                    <div class="how-to-play">
                        <div class="how-to-play-holder">
                            <h1 class="inline">1</h1>
                            <span class="inline"><?php _e('Choose your numbers or QuickPick','twentythirteen')?></span>
                            <div class="diag-line"></div>
                        </div>
                        <div class="how-to-play-holder">
                            <h1 class="inline">2</h1>
                            <span class="inline"><?php _e('Select your draws and duration','twentythirteen')?></span>
                            <div class="diag-line"></div>
                        </div>
                        <div class="how-to-play-holder">
                            <h1 class="inline">3</h1>
                            <span class="inline last"><?php _e('Press continue','twentythirteen')?></span>
                            <div class="diag-line diag-line-last"></div>
                        </div>
                    </div>

                    <div class="beton-header <?php echo $data['LotteryName']; ?>">

                        <div class="lotto-name-container">
                            <?php 

                                $lotterynameNew = strtolower(ChangeLotteryNameForUrl($data['LotteryName']));
                                $imgsrcNew = '/images/logos/' . $lotterynameNew . '1.png';
                            ?>
                            <img src="<?php echo TEMPLATE_URL.$imgsrcNew; ?>" class="lotto-logo">
                            <span class="lotto-name"><?php echo $data['LotteryName']; ?></span>
                        </div>

                        <div class="lotto-prize-container">
                            <?php
                                if ($data['Jackpot'] < 0) {
                                    $jackpotnew = 'PENDING';
                                } else {

                                    $jackpotnew =  $data['LotteryCurrency2'].($data['Jackpot'] / 1000000).'<span class="small-m">M</span>';
                                };

                            ?>
                            <h1 class="lotto-prize"><?php echo $jackpotnew; ?></h1>
                        </div>


                        <!-- Timer - Start -->
                        <div class="lotto-timer">

                            <div class="timer-view">

                                <table>

                                    <tbody>
                                        <tr id="caro_clock_time">

                                            <?php /*Replace Time*/ ?>

                                        </tr>

                                        <tr>
                                            <td><div class="timer-unit unit-1">Hours</div></td>
                                            <td></td>
                                            <td><div class="timer-unit unit-2">Mins</div></td>
                                            <td></td>
                                            <td><div class="timer-unit unit-3">Sec</div></td>
                                        </tr>

                                    </tbody></table>
                            </div>

                            <script type="text/javascript">
                                jQuery(document).ready(function () {
                                    var date = '<?php echo date("Y-m-d H:i:s", strtotime($data["DrawDate"])); ?>';
                                    var days = '<?php echo date("d", strtotime($data["DrawDate"])) ?>';
                                    days*=1;
                                    jQuery("#caro_clock_time").countdown(date, function (event) {

                                        var totalHours = event.offset.totalDays * 24 + event.offset.hours;

                                        //var myhtml = '<td><div class="timer-value value-1">%H</div></td>';
                                        //myhtml += '<td><div class="timer-delimiter">:</div></td>';
                                        var hourhtml = '';
                                        hourhtml += '<td><div class="timer-value value-1">'+totalHours+'</div></td>';
                                        hourhtml += '<td><div class="timer-delimiter">:</div></td>';
                                        var myhtml = '';
                                        myhtml += '<td><div class="timer-value value-2">%M</div></td>';
                                        myhtml += '<td><div class="timer-delimiter">:</div></td>';
                                        myhtml += '<td><div class="timer-value value-3">%S</div></td>';

                                        jQuery(this).html(hourhtml + event.strftime(myhtml));
                                    });

                                    jQuery( "#magic-pickall" ).click(function() {
                                        jQuery( ".picall_btn" ).trigger( "click" );
                                    });
                                });
                            </script>

                        </div>
                        <!-- Timer - End -->


                        <div class="lotto-action-container">
                            <button type="button" id="magic-pickall" class="btn-magic-all"><i class="fa fa-magic"></i> <span class="btn-magic-all-text">Pick All</span></button>
                            <!--<button class="btn-trash-all"><i class="fa fa-trash-o"></i></button>-->
                        </div>

                    </div>

                    <div class="cardlist">
                        <input type="hidden" id="totallines" value="1"/>
                        <input type="hidden" id="choosenTab" value="#single"/>
                        <input type="hidden" id="lotteryId" value="<?php echo $lotterytypeid;?>" name="lotteryId" />
                        <input type="hidden" id="m" value="<?php echo $data['NumberOfMainNumbers']; ?>"/>
                        <input type="hidden" id="m1" value="<?php echo $data['AmountOfMainNumbersToMatch']; ?>"/>
                        <input type="hidden" id="e" value="<?php echo $data['NumberOfExtraNumbers']; ?>"/>
                        <input type="hidden" id="e1" value="<?php echo $data['AmountOfExtraNumbersToMatch']; ?>"/>
                        <input type="hidden" id="lines" name="lines"
                            value="<?php echo (is_array($selectedno) && count($selectedno) > 0) ? $selectedno['lines'] : ""; ?>"/>
                        <input type="hidden" id="selno" name="selno"
                            value="<?php echo (is_array($selectedno) && count($selectedno) > 0) ? $selectedno['selno'] : ""; ?>"/>
                        <input type="hidden" id="singtp" name="totalprice"
                            value="<?php echo (is_array($selectedno) && count($selectedno) > 0) ? $selectedno['totalprice'] : ""; ?>"/>
                        <input type="hidden" id="singsubtp" name="subtotal"
                            value="<?php echo (is_array($selectedno) && count($selectedno) > 0) ? $selectedno['subtotal'] : ""; ?>"/>
                        <input type="hidden" id="singbm" name="bonusmoney"
                            value="<?php echo (is_array($selectedno) && count($selectedno) > 0) ? $selectedno['bonusmoney'] : ""; ?>"/>
                        <input type="hidden" id="minl" value=""/>
                        <input type="hidden" id="maxl" value=""/>
                        <input type="hidden" id="even" value=""/>
                        <input type="hidden" id="storeselected"
                            value="<?php echo (is_array($selectedno) && count($selectedno) > 0) ? $selectedno['storeselected'] : ""; ?>" name="storeselected"/>
                        <input type="hidden" id="otherdata" name="otherdata" value="<?php echo $data['LotteryCurrency2'] . "|" . $data['LotteryName'] . "|0"; ?>"/>


                        <div class="card_row addcardrow cardline" id="row_1">
                            <div class="tabin_main">
                                <div class="tabin_main_select left">
                                    <?php
                                        for ($i = 0; $i < 5; $i++) {
                                            selectNumCol($data, $i + 1);
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="card_row removecardrow hide" id="removecardrow">
                            <div class="clear_inner hidden-xs">&nbsp;</div>
                            <div class="tabin_main">
                                <div class="tabin_main_select left">
                                    <?php
                                        for ($i = 0; $i < 5; $i++) {
                                            selectNumCol($data, $i + 6);
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clear_inner hidden-xs" style="height: 5px;">&nbsp;</div>
                    <?php /*
                        <!--<div class="comman">
                        <hr class="visible-xs">
                        <span class="removelines hide hidden-xs"><?php _e('Less Lines','twentythirteen')?></span>

                        <?php if (wp_is_mobile()): ?>
                        <br>
                        <br>
                        <div class="addline-more extra-lines-button"><?php _e('More Lines','twentythirteen')?></div>
                        <br>
                        <?php endif ?>
                        <span class="addlines hidden-xs"><?php _e('More Lines','twentythirteen')?></span>
                    </div>--> */ ?>

                    <style type="text/css">
                        .col-3-contain {
                            padding: 20px 0px 0px 10px;
                        }
                    </style>

                    <div class="option_table left">
                        <div class="option_table_container">
                            <div class="choose_option left">
                                <div class="box_ttl">
                                    <?php _e('Choose your draw participation options:','twentythirteen')?>
                                </div>
                                <div class="box_det" style="width: 100%;padding: 0px;">
                                    <div class="col3 <?php echo $drawopSelected1; ?>" style="min-height: 140px;">
                                        <div class="col-3-contain">
                                            <input type="radio" name="single_drawop" id="radio1" class="css-checkbox" value="1" <?php echo $drawop1; ?>/>
                                            <label for="radio1" class="css-label radGroup1 radGroup1"><?php _e('One-time entry','twentythirteen')?> <span class="tooltip">
                                                    <img src="<?php echo TEMPLATE_URL; ?>/images/info_icon.png"/><span><?php _e('ONE-TIME ENTRY','twentythirteen')?> <hr/> <br/> <?php _e('Play for the next upcoming Draw only. <br/> Try a Multi-Draw or Subscription and get higher  discounts per draw.','twentythirteen')?></span></span></label>

                                            <div class="font13 comman draw-info">
                                                <span>
                                                    <?php _e('For the upcoming draw only','twentythirteen'); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col3 <?php echo $drawopSelected2; ?>" style="min-height: 140px;">
                                        <div class="col-3-contain">
                                            <input type="radio" name="single_drawop" id="radio2" class="css-checkbox" value="2" <?php echo $drawop2; ?> />
                                            <label for="radio2" class="css-label radGroup1 radGroup1"><?php _e('Multi-draw','twentythirteen')?><span class="tooltip">
                                                    <img src="<?php echo TEMPLATE_URL; ?>/images/info_icon.png"/><span><?php _e('MULTI-DRAW','twentythirteen')?> <hr/><br/><?php _e('Choose Multi-Draw to play for several draws in  advance. Save up to 25% per draw.','twentythirteen')?></span></span></label>

                                            <div class="comman left">
                                                <div class="dropdown_new_c" style="margin-left: 0px;">
                                                    <select class="single_totaldraw" name="single_totaldraw">
                                                        <option value="2" <?php echo $tdraw[2]; ?>><?php _e('2 draws 2% discount','twentythirteen')?></option>
                                                        <option value="4" <?php echo $tdraw[4]; ?>><?php _e('4 draws 4% discount','twentythirteen')?></option>
                                                        <option value="8" <?php echo $tdraw[8]; ?>><?php _e('8 draws 15% discount','twentythirteen')?></option>
                                                        <option value="26" <?php echo $tdraw[26]; ?>><?php _e('26 draws 22% discount','twentythirteen')?></option>
                                                        <option value="52" <?php echo $tdraw[52]; ?>><?php _e('52 draws 25% discount','twentythirteen')?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col3 <?php echo $drawopSelected3; ?>" style="min-height: 140px;">
                                        <div class="col-3-contain">
                                            <input type="radio" name="single_drawop" id="radio3" class="css-checkbox" value="3" <?php echo $drawop3; ?> />
                                            <label for="radio3" class="css-label radGroup1 radGroup1"><?php _e('Subscription','twentythirteen')?><span class="tooltip">
                                                    <img src="<?php echo TEMPLATE_URL; ?>/images/info_icon.png"/><span><?php _e('Subscription','twentythirteen')?> <hr/><br/><?php _e('Earn more VIP points, more discounts and never miss a draw! Choose your billing period of 1 week, 2 weeks or 4 weeks.','twentythirteen')?></span></span></label>

                                            <div class="comman left">
                                                <div class="dropdown_new_c" style="margin-left: 0px;">
                                                    <select class="single_subs" name="single_subs">
                                                        <option value="1" <?php echo $ssubs[1]; ?>>
                                                            <?php
                                                                $discounts = new Discounts();
                                                                $discounts->setLotteryName($data['LotteryName']);
                                                                $discounts->setType('single');
                                                                $discounts->setPeriod(1);

                                                                echo $discounts->getDiscount();
                                                            ?>
                                                        </option>
                                                        <option value="2" <?php echo $ssubs[2]; ?>>
                                                            <?php
                                                                $discounts->setPeriod(2);
                                                                echo $discounts->getDiscount();
                                                            ?>
                                                        </option>
                                                        <option value="4" <?php echo $ssubs[4]; ?>>
                                                            <?php
                                                                $discounts->setPeriod(4);
                                                                echo $discounts->getDiscount();
                                                            ?>
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="total_sum right">
                                <div class="box_ttl"><?php _e('Total Sum','twentythirteen'); ?></div>
                                <div class="box_dec">
                                    <div class="sum_cal">
                                        <div style="width:64%;" class="left">
                                            <span class="lines"><?php echo (is_array($selectedno) && count($selectedno) > 0) ? $selectedno['lines'] : "0" ?> <?php _e('lines','twentythirteen'); ?></span>
                                            X <span class="draws"><?php echo ($sdraws > 0) ? $sdraws : "1"; ?> <?php _e('Draws','twentythirteen'); ?></span>
                                        </div>
                                        <div style="width:36%;" class="right">
                                            <?php echo SITE_CURRENCY; ?>&nbsp;
                                            <span class="subtotal"><?php echo (is_array($selectedno) && count($selectedno) > 0) ? $selectedno['subtotal'] : number_format(0.00, 2); ?></span>
                                        </div>
                                        <div style="width:100%;" class="left">
                                            <div id="disc_single" style="display:none">
                                                <?php _e('Discount:  ' . SITE_CURRENCY . ' 0.00','twentythirteen'); ?>
                                            </div>
                                        </div>
                                        <div class="ttl_share_lab">
                                            <span class="left"><?php _e('Bonus Money','twentythirteen'); ?>
                                                <span class="tooltip">
                                                    <img src="<?php echo get_template_directory_uri(); ?>/images/info_icon_white.png"/>
                                                    <span><?php _e('Bonus Money','twentythirteen'); ?>
                                                        <hr/><br/>
                                                        <?php _e('This is the amount of bonus money you get on this   purchase. Bonus money can be used to purchase more tickets for free.','twentythirteen'); ?>
                                                    </span>
                                                </span>
                                                <span class="bmcurrency"><?php echo SITE_CURRENCY; ?></span>&nbsp;
                                                <span
                                                    class="bonusmoney"><?php echo (is_array($selectedno) && count($selectedno) > 0) ? $selectedno['bonusmoney'] : number_format(0.00,
                                                    2); ?></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="total_share">
                                        <div class="font13"><?php _e('total','twentythirteen'); ?></div>
                                        <div class="font22">
                                            <?php echo SITE_CURRENCY; ?>&nbsp;
                                            <span class="totalprice"><?php echo (is_array($selectedno) && count($selectedno) > 0) ? $selectedno['totalprice'] : number_format(0.00, 2); ?></span>
                                        </div>
                                        <input type="hidden" value="<?php echo number_format($data['PricePerLine'], 2); ?>" id="stp">
                                        <a class="total_share_conti_btn" id="single_continue"><?php _e('Continue','twentythirteen'); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="select_page_det left">

                        <!-- <h1><?php the_title(); ?></h1>-->

                        <div class="col8 left">
                            <?php while (have_posts()) : the_post(); ?>
                                <?php the_content(); ?>
                                <?php endwhile; ?>
                        </div>

                        <div class="col2 left">
                            <img src="<?php echo TEMPLATE_URL; ?>/images/scanned_ticket.png"/>
                        </div>

                    </div>

                    <div class="select_page_det2">
                        <div class="del_cup"><img src="<?php echo TEMPLATE_URL; ?>/images/del_cup.png"/></div>
                        <div class="star"><img src="<?php echo TEMPLATE_URL; ?>/images/star.png"/></div>
                        <div class="font13"><?php get_field("buynow_field"); ?></div>
                    </div>

                    <div class="hide" id="error">
                        <a href="#" class="remodal-close error-close">&#10006;</a>

                        <div id="errorbox">Ticket lines must between X and Y</div>
                    </div>
                </div>
            </form>

            <form name="groupdata" action="<?php echo home_url(); ?>/payment" id="groupdata" method="post">
                <div class="group hide" id="group">
                    <div class="tabin_main" style="border-left: none;border-right: none;">
                        <div class="tabin_main_group left">
                            <div class="grp_left hidden-xs">

                                <div class="grp_img">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/group.jpg"/>
                                </div>
                            </div>
                            <div class="grp_right">
                                <div class="grp_ttl hidden-xs"><?php echo $data['LotteryName']; ?> <?php _e('Group','twentythirteen'); ?></div>
                                <p class="hidden-xs"><?php _e("Increase your winning chances with a Group Subscription. 1 in 4 jackpots is won by a Group Ticket. On this Subscription we cover all the bonus numbers to increase the winning chances of the group. You get: 50 lines and up to 150 shares in the group. Get more shares so you'll have a bigger portion from the winning","twentythirteen"); ?></p>

                                <div class="shars_countre center-block-mobile">
                                    <p><?php _e('How many shares would you like?','twentythirteen'); ?></p>

                                    <div class="countre desktop-only-left">
                                        <table width="100%" border="0">
                                            <tr>
                                                <td width="35" align="left" valign="middle">
                                                    <a href="javascript:void(0)" class='qtyminus' field='quantity'>
                                                        <img src="<?php echo get_template_directory_uri(); ?>/images/remove_share.png"/>
                                                    </a>
                                                </td>
                                                <td width="80" align="center" valign="middle">
                                                    <input type="text" name='quantity' class="u_share_fill qty" value="<?php echo ($groupsel != "") ? $groupsel['quantity'] : "1"; ?>"/>
                                                </td>
                                                <td width="35" align="right" valign="middle">
                                                    <a href="javascript:void(0)" class="qtyplus" field='quantity'>
                                                        <img src="<?php echo get_template_directory_uri(); ?>/images/add_share.png"/>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="option_table left" style="margin-top: 10px; border: none !important;padding: 0px;width: 100%;">
                        <div class="option_table_container">
                            <div class="choose_option left">
                                <div class="box_ttl">
                                    <?php _e('Choose your plan:','twentythirteen'); ?>
                                </div>
                                <div class="box_det" style="width: 100%;padding: 0px;">
                                    <div class="col3 <?php echo $gdrawopSelected1;?>" style="min-height: 140px;">
                                        <div class="col-3-contain">
                                            <input type="radio" name="group_drawop" id="grpradio1" class="css-checkbox" value="1" <?php echo $gdrawop1; ?>/>
                                            <label for="grpradio1" class="css-label radGroup1 radGroup1">
                                                <?php _e('One-time entry','twentythirteen'); ?>
                                                <span class="tooltip">
                                                    <img src="<?php echo TEMPLATE_URL; ?>/images/info_icon.png"/>
                                                    <span>
                                                        <?php _e('One-Time Entry','twentythirteen'); ?> <hr/> <br/>
                                                        <?php _e('Play for the next upcoming Draw only. <br/> Try a Multi-Draw or Subscription and get higher  discounts per draw.','twentythirteen'); ?>
                                                    </span>
                                                </span>
                                            </label>
                                            <div class="font13 comman draw-info">
                                                <span>
                                                    <?php _e('For the upcoming draw only','twentythirteen'); ?>
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col3 <?php echo $gdrawopSelected2;?>" style="min-height: 140px;">
                                        <div class="col-3-contain">
                                            <input type="radio" name="group_drawop" id="grpradio2" class="css-checkbox" value="2" <?php echo $gdrawop2; ?>/>
                                            <label for="grpradio2" class="css-label radGroup1 radGroup1">
                                                <?php _e('Multi-draw','twentythirteen'); ?>
                                                <span class="tooltip">
                                                    <img src="<?php echo TEMPLATE_URL; ?>/images/info_icon.png"/>
                                                    <span><?php _e('Multi-draw','twentythirteen'); ?> <hr/><br/><?php _e('Choose Multi-Draw to play for several draws in  advance. Save up to 20% per draw.','twentythirteen'); ?></span>
                                                </span>
                                            </label>

                                            <div class="comman left">
                                                <div class="dropdown_new_c" style="margin-left: 0px;">
                                                    <select class="group_totaldraw" name="group_totaldraw">
                                                        <option value="2" <?php echo $gtdraw[2]; ?>><?php _e('2 draws','twentythirteen'); ?></option>
                                                        <option value="4" <?php echo $gtdraw[4]; ?>><?php _e('4 draws','twentythirteen'); ?></option>
                                                        <option value="8" <?php echo $gtdraw[8]; ?>><?php _e('8 draws','twentythirteen'); ?></option>
                                                        <option value="26" <?php echo $gtdraw[26]; ?>><?php _e('26 draws 15% discount','twentythirteen'); ?></option>
                                                        <option value="52" <?php echo $gtdraw[52]; ?>><?php _e('52 draws 20% discount','twentythirteen'); ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col3 <?php echo $gdrawopSelected3;?>" style="min-height: 140px;">
                                        <div class="col-3-contain">
                                            <input type="radio" name="group_drawop" id="grpradio3" class="css-checkbox" value="3" <?php echo $gdrawop3; ?>/>
                                            <label for="grpradio3" class="css-label radGroup1 radGroup1">
                                                <?php _e('Subscription','twentythirteen'); ?>
                                                <span class="tooltip">
                                                    <img src="<?php echo TEMPLATE_URL; ?>/images/info_icon.png"/>
                                                    <span><?php _e('Subscription','twentythirteen'); ?>
                                                        <hr/><br/><?php _e('Earn more VIP points, more discounts and never miss a draw! Choose your billing period of 1 week, 2 weeks or 4 weeks.','twentythirteen'); ?>
                                                    </span>
                                                </span>
                                            </label>

                                            <div class="comman left">
                                                <div class="dropdown_new_c" style="margin-left: 0px;">
                                                    <select class="group_subs" name="group_subs">
                                                        <option value="1" <?php echo $gsubs[1]; ?>>
                                                            <?php
                                                                $discounts = new Discounts();
                                                                $discounts->setLotteryName($data['LotteryName']);
                                                                $discounts->setPeriod(1);
                                                                $discounts->setType('group');

                                                                echo $discounts->getDiscount();
                                                            ?>
                                                        </option>
                                                        <option value="2" <?php echo $gsubs[2]; ?>>
                                                            <?php
                                                                $discounts->setPeriod(2);
                                                                echo $discounts->getDiscount();
                                                            ?>
                                                        </option>
                                                        <option value="4" <?php echo $gsubs[4]; ?>>
                                                            <?php
                                                                $discounts->setPeriod(4);
                                                                echo $discounts->getDiscount();
                                                            ?>
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="total_sum right">
                                <div class="box_ttl"><?php _e('Total Sum','twentythirteen');?></div>
                                <div class="box_dec">
                                    <div class="sum_cal">

                                        <div style="width:64%;" class="left">
                                            <span class="shares"><?php echo ($groupsel !== "") ? $groupsel['quantity'] : "1"; ?> <?php _e('Shares','twentythirteen');?></span>
                                            X <span class="draws"><?php echo ($groupsel != "") ? $draws : "1"; ?> <?php _e('Draws','twentythirteen');?></span>
                                        </div>
                                        <div style="width:36%;"class="right">
                                        <?php echo SITE_CURRENCY; ?>
                                        <span class="subtotal"><?php echo ($groupsel != "") ? $groupsel['subtotal'] : number_format($groupdata['Price'], 2); ?></span>
                                        </div>
                                        <div style="width:100%;" class="left">
                                            <div id="disc_group" style="display:none">
                                                <?php _e('Discount:  ' . SITE_CURRENCY . ' 0.00','twentythirteen');?>
                                            </div>
                                        </div>
                                        <div class="ttl_share_lab">
                                            <span class="left"><span class="fontcapital"><?php _e('Bonus Money','twentythirteen');?></span><span
                                                    class="tooltip"><img
                                                        src="<?php echo get_template_directory_uri(); ?>/images/info_icon_white.png"
                                                        class="grpbmimg"/><span><?php _e('Bonus Money','twentythirteen');?> <hr/><br/><?php _e('This is the amount of bonus money you get on this   purchase. Bonus money can be used to purchase more tickets for free.','twentythirteen');?></span></span><span
                                                    class="bmcurrency"> <?php echo SITE_CURRENCY; ?>&nbsp;</span><span
                                                    class="bonusmoney"><?php echo ($groupsel != "") ? $groupsel['bonusmoney'] : number_format($groupdata['Price'],
                                                    2); ?></span></span>
                                        </div>
                                    </div>
                                    <div class="total_share">
                                        <div class="font13"><?php _e('total','twentythirteen');?></div>
                                        <div class="font22">
                                            <?php echo SITE_CURRENCY; ?>&nbsp;
                                            <span class="totalprice"><?php echo ($groupsel != "") ? $groupsel['totalprice'] : number_format($groupdata['Price'], 2); ?></span>
                                        </div>
                                        <input type="hidden" value="<?php echo number_format($groupdata['Price'], 2); ?>"
                                            id="gtp">
                                        <input type="hidden" id="grptp" name="totalprice"
                                            value="<?php echo ($groupsel != "") ? $groupsel['totalprice'] : ""; ?>"/>
                                        <input type="hidden" id="grpsubtp" name="subtotal"
                                            value="<?php echo ($groupsel != "") ? $groupsel['subtotal'] : ""; ?>"/>
                                        <input type="hidden" id="grpbm" name="bonusmoney"
                                            value="<?php echo ($groupsel != "") ? $groupsel['bonusmoney'] : ""; ?>"/>
                                        <input type="hidden" id="otherdata" name="otherdata" value="
                                            <?php echo $data['LotteryCurrency2'] . "|" . $data['LotteryName'] . "|0"; ?>"/>
                                        <input type="hidden" id="productid" name="productid" value="<?php echo $groupdata['ProductId']; ?>"/>

                                        <a href="#" class="total_share_conti_btn" id="group_continue"><?php _e('Continue','twentythirteen');?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clear_inner">&nbsp;</div>

                    <div class="visible-xs">

                        <div class="grp_left visible-xs">
                            <div class="grp_ttl"><?php _e('Improve your odds with group','twentythirteen'); ?></div>
                            <div class="grp_img">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/man_jumping.png"/>
                            </div>
                            <div class="grp_ttl"><?php echo $data['LotteryName']; ?> <?php _e('Group','twentythirteen'); ?></div>
                            <br>
                            <p><?php _e("Increase your winning chances with a Group Subscription. 1 in 4 jackpots is won by a Group Ticket. On this Subscription we cover all the bonus numbers to increase the winning chances of the group. You get: 50 lines and up to 150 shares in the group. Get more shares so you'll have a bigger portion from the winning","twentythirteen"); ?></p>
                            <br>
                        </div>

                    </div>

                    <div class="select_page_det left">
                        <!--<h1><?php the_title(); ?></h1>-->
                        <div class="col8 left">
                            <?php while (have_posts()) : the_post(); ?>
                                <?php the_content(); ?>
                                <?php endwhile; ?>
                        </div>
                        <div class="col2 left">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/scanned_ticket.png"/>
                        </div>
                    </div>

                    <div class="select_page_det2">
                        <div class="del_cup"><img src="<?php echo get_template_directory_uri(); ?>/images/del_cup.png"/></div>
                        <div class="star"><img src="<?php echo get_template_directory_uri(); ?>/images/star.png"/></div>
                        <div class="font13"><?php get_field("buynow_field"); ?></div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">

        jQuery('input[type=radio][name=single_drawop]').on( "click", function() {
            if (jQuery(this).is(":checked")) { 
                jQuery('.box_det').find(jQuery('.selcteddrow')).removeClass('selcteddrow');
                jQuery(this).closest(".col3").addClass("selcteddrow"); 
            }
        });

        jQuery('input[type=radio][name=group_drawop]').on( "click", function() {
            if (jQuery(this).is(":checked")) { 
                jQuery('.box_det').find(jQuery('.selcteddgrouprow')).removeClass('selcteddgrouprow');
                jQuery(this).closest(".col3").addClass("selcteddgrouprow");
            }
        });

    </script>

    <?php
} else {
    echo "<script>location.reload();</script>";
    exit();
}

get_footer();

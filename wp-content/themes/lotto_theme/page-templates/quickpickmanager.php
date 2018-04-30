<?php
/**
 * Template Name: QuickPickManager
 */
get_header();
global $all_brand_draws;
parse_str($_SERVER['QUERY_STRING']);
$navidadPrice = 29.9;
?>
<div class="cl"></div>
<div class="page-quick-pick">
    <h2>Please wait, cart page is loading...</h2>
    <img src="<?php echo TEMPLATE_URL; ?>/images/loading.gif">
</div>
<div id="errors"></div>
<div>
    <div id="qp_single">
        <form id="iFormValuesSingle" name="nFormValuesSingle" action="/" method="post">
            <input type="hidden" id="lines" name="lines" value="">
            <input type="hidden" id="selno" name="selno" value="">
            <input type="hidden" id="totalprice" name="totalprice" value="">
            <input type="hidden" id="subtotal" name="subtotal" value="">
            <input type="hidden" id="bonusmoney" name="bonusmoney" value="">
            <input type="hidden" id="storeselected" name="storeselected" value="">
            <input type="hidden" id="otherdata" name="otherdata" value="">
            <input type="hidden" id="single_drawop" name="single_drawop" value="">
            <input type="hidden" id="single_totaldraw" name="single_totaldraw" value="">
            <input type="hidden" id="single_subs" name="single_subs" value="">
        </form>
    </div>

    <div id="qp_group">
        <form id="iFormValuesGroup" name="nFormValuesGroup" action="/" method="post">
            <input type="hidden" id="quantity" name="quantity" value="">
            <input type="hidden" id="group_drawop" name="group_drawop" value="">
            <input type="hidden" id="group_totaldraw" name="group_totaldraw" value="">
            <input type="hidden" id="group_subs" name="group_subs" value="">
            <input type="hidden" id="totalprice" name="totalprice" value="">
            <input type="hidden" id="subtotal" name="subtotal" value="">
            <input type="hidden" id="bonusmoney" name="bonusmoney" value="">
            <input type="hidden" id="otherdata" name="otherdata" value="">
            <input type="hidden" id="productid" name="productid" value="3">
        </form>
    </div>
    <div id="qp_raffle">
        <form id="iFormValuesRaffle" name="nFormValuesRaffle" action="/" method="post">
            <input type="hidden" id="choosenTab" value="#single" />
            <input type="hidden" id="lines" name="lines" value=""/>
            <input type="hidden" id="selno" name="selno" value=""/>
            <input type="hidden" id="singtp" name="totalprice" value="<"/>
            <input type="hidden" id="singsubtp" name="subtotal" value=""/>
            <input type="hidden" id="singbm" name="bonusmoney" value=""/>
            <input type="hidden" id="minl" value=""/>
            <input type="hidden" id="maxl" value=""/>
            <input type="hidden" id="storeselected" value="" name="storeselected"/>
            <input type="hidden" id="otherdata" name="otherdata" value="$|Navidad|">
            <input type="hidden" id="productid" name="productid" value="15">
        </form>
    </div>
    <div id="qp_raffle_valentine">
        <form id="iFormValuesRaffleValentine" name="nFormValuesRaffleValentine" action="/" method="post">
            <input type="hidden" id="choosenTab" value="#single" />
            <input type="hidden" id="lines" name="lines" value=""/>
            <input type="hidden" id="selno" name="selno" value=""/>
            <input type="hidden" id="singtp" name="totalprice" value="<"/>
            <input type="hidden" id="singsubtp" name="subtotal" value=""/>
            <input type="hidden" id="singbm" name="bonusmoney" value=""/>
            <input type="hidden" id="minl" value=""/>
            <input type="hidden" id="maxl" value=""/>
            <input type="hidden" id="storeselected" value="" name="storeselected"/>
            <input type="hidden" id="otherdata" name="otherdata" value="$|Valentine|">
            <input type="hidden" id="productid" name="productid" value="26">
        </form>
    </div>
</div>
<script type="text/javascript">
    <?php
     //mess js and php
    if (isset($_SESSION['user_data'])) {
        echo 'var isLogged=1;';
    } else {
        echo 'var isLogged=0;';
    }
    ?>
    var urlParams;
    var queryStrings = window.location.search.substring(1);
    (window.onpopstate = function () {
        var match,
            pl = /\+/g,  // Regex for replacing addition symbol with a space
            search = /([^&=]+)=?([^&]*)/g,
            decode = function (s) {
                return decodeURIComponent(s.replace(pl, " "));
            },
            query = window.location.search.substring(1);

        urlParams = {};
        while (match = search.exec(query))
            urlParams[decode(match[1])] = decode(match[2]);
    })();


    //debugger;
    console.log('urlParams' + urlParams);

    if (typeof urlParams.lotterytype === 'undefined') {
        var isTop = 1;
    }
    else {
        var isTop = 0;
    }

    var productData = {};

    var qp_type = '';
    //var target = '/Payment/';
    var target = '/cart';

    var price = <?php echo number_format($navidadPrice, 2); ?>;

    function insertNavidadNumbersQuickPick(selectedIds,fiveDigitNumb, threeNumbersLine, oneNumberLine, curerntIdTimeStamp)
    {
        //debugger;

        var datastring = "action=lottery_data&m=playlottery/insert-navidad-numbers&productID=15&lt=" + selectedIds;
        jQuery.ajax({
            type: "POST",
            url: CONFIG.adminURL,
            data: datastring,
            dataType: 'json',
            success: function (resp) {
                debugger;

                var otherdata = jQuery("#iFormValuesRaffle #otherdata").val();
                if (resp.ProductManagementCounter > 0) {
                    var splitedData = otherdata.split("|");
                    otherdata = splitedData[0]+'|'+splitedData[1]+'|'+resp.ProductManagementCounter + '|false';
                    jQuery("#iFormValuesRaffle #otherdata").val(otherdata);
                }

                /*setTimeout(function() {
                    document.forms['iFormValuesRaffle'].submit();
                }, 200);*/
                saveToCartNavidad(selectedIds,fiveDigitNumb, threeNumbersLine, oneNumberLine, curerntIdTimeStamp);
            }
        });
    }
    function insertValentineNumbersQuickPick(selectedIds)
    {
        var datastring = "action=lottery_data&m=playlottery/insert-navidad-numbers&productID=26&lt=" + selectedIds;
        jQuery.ajax({
            type: "POST",
            url: CONFIG.adminURL,
            data: datastring,
            dataType: 'json',
            success: function (res) {
                var otherdata = jQuery("#iFormValuesRaffleValentine #otherdata").val();
                if (res.ProductManagementCounter > 0) {
                    var splitedData = otherdata.split("|");
                    otherdata = splitedData[0]+'|'+splitedData[1]+'|'+res.ProductManagementCounter + '|false';
                    jQuery("#iFormValuesRaffleValentine #otherdata").val(otherdata);
                }

                setTimeout(function() {
                    document.forms['iFormValuesRaffleValentine'].submit();
                }, 200);
            }
        });
    }

    function getNavidadNumbers()
    {
        //debugger;
        var queryString = "&lotterytype=" + urlParams.lotterytype + "&shares=" + urlParams.shares + "&bta=" + urlParams.bta + "&sub=" + urlParams.sub + "&prc=" + urlParams.prc;
        var datastring = "action=lottery_data&m=playlottery/quick-pick-select" + queryString;
        jQuery.ajax({
            type: "POST",
            url: CONFIG.adminURL,
            data: datastring,
            datatype: 'json'
        });

        datastring = "action=lottery_data&m=playlottery/get-navidad-numbers&productID=15&lt=";
        jQuery.ajax({
            type: "POST",
            url: CONFIG.adminURL,
            data: datastring,
            dataType: 'json',
            success: function (res) {
                debugger;
                if (res.error_msg == "Not more tickets to sold") {
                    window.location = "/";
                }
                //var nums = JSON.parse(res["response"]);
                var nums = res;
                var selNums = [];
                var i = 0;

                /*for (i; i < urlParams.shares; i++) {
                    // no more tickets left
                    if (typeof nums[i] == 'undefined') {
                        break;
                    }

                    if (selNums == '') {
                        selNums = nums[i]['Id'];
                    } else {
                        selNums += ',' + nums[i]['Id'];
                    }
                }*/
                restoreNavidadTicketNumber(nums) 
                var navidadExpiration = $.parseJSON(sessionStorage.getItem('navidad'));
                var curerntIdTimeStamp;

                nums.forEach(function (item) {
                    debugger;
                    curerntIdTimeStamp = navidadExpiration.filter(function (ids) {
                        return item.Id === ids.id;
                    });
                    console.log(item);
                });

                var numOfShares = urlParams.shares;
                if (urlParams.shares > nums.length) {
                    numOfShares = nums.length;
                }
                for (var i = 0; i < numOfShares; i++) {
                    selNums.push(nums[i]['Id']);
                    threeNumbersLine = nums[i]['Seat'];
                    oneNumberLine = nums[i]['Ticket'];
                }
                var fiveDigitNumb = String(nums[0]['Number']);
                fiveDigitNumb = fiveDigitNumb.substring(0,5);
                fiveDigitNumb = pad(fiveDigitNumb, 5)

                jQuery("#iFormValuesRaffle").attr('action', target);
                jQuery('#iFormValuesRaffle #lines').attr('value', i);

                jQuery('#iFormValuesRaffle #singtp').attr('value', price * i);

                jQuery('#iFormValuesRaffle #selno').attr('value', selNums);

                //saveToCartNavidad(selNums, threeNumbersLine, oneNumberLine);

                insertNavidadNumbersQuickPick(selNums,fiveDigitNumb, threeNumbersLine, oneNumberLine, curerntIdTimeStamp);
            }
        });
    }
    function restoreNavidadTicketNumber(numbers) {
        for (var i = 0; i < numbers.length; i++) {
            //console.log(numbers[i]);
            if (numbers[i].Number % 10 == 0) {
                numbers[i].Number = numbers[i].Number / 10;
            }
            numbers[i].Number = parseInt(numbers[i].Number / 10, 10);
            console.log(numbers[i]);

            var toUpdateArr = [];
            var obj = {};
            var navidadExpiration = new Date();
            navidadExpiration.setMinutes(navidadExpiration.getMinutes() + 5);
            obj.id = numbers[i].Id;
            obj.exp = navidadExpiration;
            toUpdateArr.push(obj);

            if (sessionStorage.getItem('navidad') === null) {
                sessionStorage.setItem('navidad', JSON.stringify(toUpdateArr));
            } else {
                var test = $.parseJSON(sessionStorage.getItem('navidad'));
                test.push(obj);
                sessionStorage.setItem('navidad', JSON.stringify(test));
            }
        }
    }
    function getValentineNumbers()
    {
        var queryString = "&lotterytype=" + urlParams.lotterytype + "&shares=" + urlParams.shares + "&bta=" + urlParams.bta + "&sub=" + urlParams.sub + "&prc=" + urlParams.prc;
        var datastring = "action=lottery_data&m=playlottery/quick-pick-select" + queryString;
        jQuery.ajax({
            type: "POST",
            url: CONFIG.adminURL,
            data: datastring,
            dataType: 'json'
        });

        datastring = "action=lottery_data&m=playlottery/get-navidad-numbers&productID=26&lt=";
        jQuery.ajax({
            type: "POST",
            url: CONFIG.adminURL,
            data: datastring,
            dataType: 'json',
            success: function (res) {
                debugger;
                var nums = JSON.parse(res.response);
                var selNums = '';
                var i = 0;

                for (i; i < urlParams.shares; i++) {
                    // no more tickets left
                    if (typeof nums[i] == 'undefined') {
                        break;
                    }

                    if (selNums == '') {
                        selNums = nums[i]['Id'];
                    } else {
                        selNums += ',' + nums[i]['Id'];
                    }
                }

                jQuery("#iFormValuesRaffleValentine").attr('action', target);
                jQuery('#iFormValuesRaffleValentine #lines').attr('value', i);
                jQuery('#iFormValuesRaffleValentine #singtp').attr('value', price * i);
                jQuery('#iFormValuesRaffleValentine #selno').attr('value', selNums);

                insertValentineNumbersQuickPick(selNums);
            }
        });
    }
    function pad(num, size) {
        var s = num + "";
        while (s.length < size)
            s = "0" + s;
        return s;
    }
    function checkLotteryRules(_lotterytype) {
        //personal
        if (_lotterytype.lines !== 'undefined') {
            var lotteries_rule = localStorage.getItem('cachefactory.caches.cachelottoyard.data.lottery-rules');
            if(typeof lotteries_rule !== 'undefined' && lotteries_rule !== null){
                var lotteries_rule_parsed = JSON.parse(lotteries_rule);
                //debugger;
                var lottery_rule = lotteries_rule_parsed.value.filter(function (x) {
                    if (x.LotteryType.toLowerCase() === (_lotterytype.lotterytype).toLowerCase()) {
                        return true;
                    } else {
                        return false;
                    }
                });

                if(typeof  lottery_rule[0].ProductsDrawOptions !== 'undefined'){
                    var ProductsDrawOptions = lottery_rule[0].ProductsDrawOptions.filter(function (x) {
                        if (x.ProductId === 1 && x.IsSubscription === false) { //personal && isSubscription
                            return true;
                        } else {
                            return false;
                        }
                    });

                    if(typeof ProductsDrawOptions[0].MultiDrawOptions !== 'undefined'){
                        var lines = ProductsDrawOptions[0].MultiDrawOptions.filter(function (x) {
                            if (x.NumberOfDraws === parseInt(_lotterytype.draws)) {
                                return true;
                            } else {
                                return false;
                            }
                        });
                    }
                }

                if (typeof lines !== 'undefined' && lines.length > 0) {
                    if (urlParams.lines < lines[0].MinLines) {
                        urlParams.lines = lines[0].MinLines;
                    } else if (urlParams.lines > lines[0].MaxLines) {
                        urlParams.lines = lines[0].MaxLines;
                    }
                }
            }
        }

        //group
        if (typeof urlParams.shares !== 'undefined') {
            if (urlParams.shares <= 0) {
                urlParams.shares = 1;
            }
            else if (urlParams.shares > 150) {
                urlParams.shares = 150;
            }
        }

        var updateQuery = '';
        for (var propertyName in urlParams) {
            updateQuery += propertyName + '=' + urlParams[propertyName] + '&';
        }
        if (updateQuery.indexOf(_lotterytype.lotterytype) === -1) {
            updateQuery += 'lotterytype=' + _lotterytype.lotterytype;
        }
        //debugger;
        getPricesFromApi(_lotterytype.lotterytype, updateQuery);
    }

    function getPricesFromApi(_lotterytype, _queryStrings) {
        var datastring = "action=lottery_data&m=playlottery/quick-pick-select&" + _queryStrings;
        //debugger;
        jQuery.ajax({
            type: "POST",
            url: CONFIG.adminURL,
            data: datastring,
            datatype: 'json',
            success: function (res) {
//                debugger;
                if (res === "An error occurred, please try again or contact the administrator.") {
                    window.location.replace(CONFIG.homeURL);
                }
                var resp = JSON.parse(res);
                productData.draws = resp.Draws;
                productData.price = currency_symbol + resp.Price;
                productData.shares = resp.Shares;
                productData.lines = resp.Lines;

                if(resp.SelectedNumbers.indexOf('#|') !== -1) {
                    splitNumbers = resp.SelectedNumbers.split('#|');
                    joinNumbers = splitNumbers.join('|');
                    productData.selectedNumbers = joinNumbers.replace('#','|');
                } else {
                    productData.selectedNumbers = resp.SelectedNumbers;
                }

                productData.lotteryTypeId = resp.LotteryType;
                productData.isSubscription = urlParams.sub;
                productData.lotteryType = _lotterytype;
                productData.personalSettingsIndex = 1;
                productData.groupSettingsIndex = 1;

                if (productData.draws > 1) {
                    productData.personalSettingsIndex = 2;
                    productData.groupSettingsIndex = 2;
                }
                if (urlParams.sub) {
                    productData.personalSettingsIndex = 3;
                    productData.groupSettingsIndex = 3;
                }

                qp_type = resp.TicketsNumber > 0 ? "raffle" : resp.Shares > 0 ? "group" : "single";
                saveToCart();
            }
        });
    }

    function saveToCart() {

//        debugger;
        if (qp_type == 'single') {
            var lotteryresults = {
                lotteryType : productData.lotteryTypeId,
                discount : 0,
                nooflines : productData.lines,
                noofdraws : productData.draws,
                numbers : productData.selectedNumbers,
                totalCost : productData.price.replace(/\u20ac/g, ''),
                selectedTab: 'single',
                personalSettingsIndex : productData.personalSettingsIndex,
                personalComboBoxSelectionIndex : 1
            };
        } else if (qp_type == 'group') {
            var lotteryresults = {
                lotteryType : productData.lotteryTypeId,
                discount : 0,
                selectedTab: 'groupselection',
                totalCost : productData.price.replace(/\u20ac/g, ''),
                groupdiscount : 0,
                groupnodraws : productData.draws,
                groupnoshares : urlParams.shares,
                groupSettingsIndex : productData.groupSettingsIndex,
                groupComboBoxSelectionIndex : 2,
                grouptotal : productData.price.replace(/\u20ac/g, ''),
                originalprice : 1,
                grouporiginalprice : 1
            };
        } else {

        }
//        console.log(lotteryresults);
//        debugger;
        var scope = angular.element(
            document.
            getElementById("Head1")).
        scope();
        scope.$apply(function () {
            scope.saveToCart(lotteryresults, true);
        });
    }
    function saveToCartNavidad(numbers,fiveDigitNumb, threeNumbersLine, oneNumberLine, curerntIdTimeStamp){
        debugger;
        var otherdata = $("#iFormValuesRaffle").find('#otherdata').val().split("|");
        var lotteryresults = {
            discount: 0,
            lotteryType: 13,
            noofdraws: 1,
            productType: 15,
            nooflines: $("#iFormValuesRaffle").find("#lines").val(),
            numbers: fiveDigitNumb + "-" + threeNumbersLine + "-" + oneNumberLine,
            originalprice: 29.90,
            totalCost: $("#iFormValuesRaffle").find("#singtp").val(),
            ticketNumberIds: numbers,
            timestamp: curerntIdTimeStamp
        }

        var scope = angular.element(
            document.
            getElementById("Head1")).
        scope();
        scope.$apply(function () {
            scope.saveToCartNavidad(lotteryresults, true);
        });
    }

    jQuery(document).ready(function () {
        if (urlParams.lotterytype == 'navidad') {
            getNavidadNumbers();
        } else if(urlParams.lotterytype == 'valentine') {
            getValentineNumbers();
        } else {
            if (isTop) {
                //here we have to change to validate before getting prices
                var toplotterytype = JSON.parse('<?php echo json_encode($all_brand_draws); ?>');
//                debugger;
//                console.log(urlParams)
                var params = {
                    lotterytype: toplotterytype[0].LotteryName,
                    sub:urlParams.sub,
                    draws:urlParams.draws
                };

                checkLotteryRules(params);
            } else {
                checkLotteryRules(urlParams);
            }
        }
    });

</script>
<?php
get_footer();

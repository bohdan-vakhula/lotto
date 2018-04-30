<?php


    global $prices_by_brand_and_productid;
    global $all_brand_draws;
    
    //echo "<pre>";print_R($prices_by_brand_and_productid);
    //echo "<pre>";print_R($all_brand_draws);

    // sort by highest jackpot DESC
    $lotteries = $all_brand_draws;
    usort($lotteries, function($prev, $curr) {
        if ($prev->Jackpot > $curr->Jackpot) {
            return false;
        }
        return true;
    });

if(!empty($prices_by_brand_and_productid)): ?>

<script type="text/javascript">
    var selectedProductId; // opened popup product id
    var selectedLotteryTypeId; // opened popup lottery type id

    var productPrices = <?php echo json_encode($prices_by_brand_and_productid); ?>;
    // debugger;

    // top jackpot
    var topLottoJacktpot = numberWithCommas(getProductPrices(14, 2, 7).PossabilityToWin);

    // american jackpot
    var powerballJackpot = getProductPrices(3, 1, 1).PossabilityToWin;
    var newyorkJackpot = getProductPrices(3, 1, 14).PossabilityToWin;
    var megamillionsJackpot = getProductPrices(3, 1, 2).PossabilityToWin;

    var americanProductJacktop = numberWithCommas(powerballJackpot + newyorkJackpot + megamillionsJackpot);

    // euro jackpot
    var euroJackpot = getProductPrices(3, 1, 9).PossabilityToWin;
    var euroMilionsJackpot = getProductPrices(3, 1, 5).PossabilityToWin;

    var euroProductJacktop = numberWithCommas(euroJackpot + euroMilionsJackpot);

    jQuery(document).ready(function($) {

        var currency = CONFIG.siteCurrency;

        $('#americanGroup .lname2').text('$' + americanProductJacktop);
        $('#euroGroup .lname2').text('€' + euroProductJacktop);
        $('#topGroup .lname2').text('$' + topLottoJacktpot);

        $('#firstJackpot').html('Join Group only ' + currency + getProductPrices(3, 4, <?php echo $lotteries[0]->LotteryTypeId; ?>).Price);
        $('#secondJackpot').html('Join Group only '+ currency + getProductPrices(3, 4, <?php echo $lotteries[1]->LotteryTypeId; ?>).Price);
        $('#thirdJackpot').html('Join Group only '+ currency + getProductPrices(3, 4, <?php echo $lotteries[2]->LotteryTypeId; ?>).Price);

        $('#DrawsSelect').change(function() {
            var total = calculatePriceAndDiscountByDraws(selectedProductId, parseInt($(this).val()), selectedLotteryTypeId);
            $('#PopUpTotalSum b').html(currency + total.price);
            $('#popupDiscount').html(currency + total.discount);
        });

        $('#popUpBuy').click(function() {
            buyNowProductBtn(selectedProductId, parseInt($('#DrawsSelect').val()), selectedLotteryTypeId, 1);
        });
    });
</script>
<div class="clear">&nbsp;</div>
<div id="middle_home">
  <div class="wrap">

        <div id="middle_about">
            <div class="cart-products loading">
                <h1 class="special-heading">Increase your chances by <a href="https://www.orolotto.com/all-group/">playing with a group,</a> pay a fraction of the cost and win!</h1>

                <!--<div class="row">

                    <div class="cart-item item">
                        <div class="slider_box">
                            <div class="slider_bg new-york-lotto">
                                <div class="slidewrap">
                                    <h1 class="lname">Get 200 tickets</h1>
                                    <h2 class="lname2"><?php echo $lotteries[0]->LotteryCurrency2; ?><?php echo number_format($lotteries[0]->Jackpot); ?></h2>
                                </div>
                                <div class="item_img">
                                    <div class="lottinner sliderlogo<?php echo $lotteries[0]->LotteryName; ?>"></div>
                                </div>
                            </div>

                            <div class="carousel_time">
                                <div class="comman">
                                    <a href="#" onclick="buyNowProductBtn(3, 4, <?php echo $lotteries[0]->LotteryTypeId; ?>, 1)">
                                        <span id="firstJackpot" class="buy_button cart_button"></span>
                                    </a>
                                </div>

                                <div class="comman">
                                    <a href="#" onclick="viewMorePopUp(3, 1, <?php echo $lotteries[0]->LotteryTypeId; ?>)">
                                        <span class="buy_button view_button"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cart-item item">
                        <div class="slider_box">
                            <div class="slider_bg new-york-lotto">
                                <div class="slidewrap">
                                    <h1 class="lname">Get 200 tickets</h1>
                                    <h2 class="lname2"><?php echo $lotteries[1]->LotteryCurrency2; ?><?php echo number_format($lotteries[1]->Jackpot); ?></h2>
                                </div>
                                <div class="item_img">
                                    <div class="lottinner sliderlogo<?php echo $lotteries[1]->LotteryName; ?>"></div>
                                </div>
                            </div>

                            <div class="carousel_time">
                                <div class="comman">
                                    <a href="#" onclick="buyNowProductBtn(3, 4, <?php echo $lotteries[1]->LotteryTypeId; ?>, 1)">
                                        <span id="secondJackpot" class="buy_button cart_button"></span>
                                    </a>
                                </div>

                                <div class="comman">
                                    <a href="#" onclick="viewMorePopUp(3, 1, <?php echo $lotteries[1]->LotteryTypeId; ?>)">
                                        <span class="buy_button view_button"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cart-item item">
                        <div class="slider_box">
                            <div class="slider_bg new-york-lotto">
                                <div class="slidewrap">
                                    <h1 class="lname">Get 200 tickets</h1>
                                    <h2 class="lname2"><?php echo $lotteries[2]->LotteryCurrency2; ?><?php echo number_format($lotteries[2]->Jackpot); ?></h2>
                                </div>
                                <div class="item_img">
                                    <div class="lottinner sliderlogo<?php echo $lotteries[2]->LotteryName; ?>"></div>
                                </div>
                            </div>

                            <div class="carousel_time">
                                <div class="comman">
                                    <a href="#" onclick="buyNowProductBtn(3, 4, <?php echo $lotteries[2]->LotteryTypeId; ?>, 1)">
                                        <span id="thirdJackpot" class="buy_button cart_button"></span>
                                    </a>
                                </div>

                                <div class="comman">
                                    <a href="#" onclick="viewMorePopUp(3, 1, <?php echo $lotteries[2]->LotteryTypeId; ?>)">
                                        <span class="buy_button view_button"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->

                <div class="row row-special" style="display:none;">

                    <div class="cart-item item" id="americanGroup">
                        <div class="slider_box">
                            <div class="slider_bg new-york-lotto">
                                <div class="item_img">
                                    <?php echo '<img src ="'.TEMPLATE_URL.'/images/product-logo-america.png">' ?>
                                </div>
                                <div class="slidewrap">
                                    <h1 class="lname">American <span class="brand-color">Group</span></h1>
                                    <h2 class="lname2"></h2>
                                </div>
                            </div>

                            <div class="carousel_time">
                                <div class="comman">
                                    <a href="#" onclick="viewMorePopUp(999, 1, 7)">
                                        <span class="buy_button view_big">Details</span>
                                    </a>
                                </div>
                                <div class="comman">
                                    <a href="#" onclick="buyNowProductBtn(999, 2, 7, 1)">
                                        <span class="buy_button special">Join Group</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cart-item item" id="euroGroup">
                        <div class="slider_box">
                            <div class="slider_bg new-york-lotto">
                                <div class="item_img">
                                    <?php echo '<img src ="'.TEMPLATE_URL.'/images/product-logo-euro.png">' ?>
                                </div>
                                <div class="slidewrap">
                                    <h1 class="lname">Euro <span class="brand-color">Group</span></h1>
                                    <h2 class="lname2"></h2>
                                </div>
                            </div>

                            <div class="carousel_time">
                                <div class="comman">
                                    <a href="#" onclick="viewMorePopUp(998, 1, 7)">
                                        <span class="buy_button view_big">Details</span>
                                    </a>
                                </div>
                                <div class="comman">
                                    <a href="#" onclick="buyNowProductBtn(998, 2, 7, 1)">
                                        <span class="buy_button special">Join Group</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cart-item item" id="topGroup">
                        <div class="slider_box">
                            <div class="slider_bg new-york-lotto">
                                <div class="item_img">
                                    <?php echo '<img src ="'.TEMPLATE_URL.'/images/product-logo-tophunter.png">' ?>
                                </div>
                                <div class="slidewrap">
                                    <h1 class="lname">Jackpot <span class="brand-color">hunter</span></h1>
                                    <h2 class="lname2"></h2>
                                </div>
                            </div>

                            <div class="carousel_time">
                                <div class="comman">
                                    <a href="#" onclick="viewMorePopUp(14, 2, 7)">
                                        <span class="buy_button view_big">Details</span>
                                    </a>
                                </div>
                                <div class="comman">
                                    <a href="#" onclick="buyNowProductBtn(14, 2, 7, 1)">
                                        <span class="buy_button special">Join Group</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cart-item item" id="americanGroup">
                        <div class="slider_box">
                            <div class="slider_bg new-york-lotto">
                                <div class="item_img">
                                    <?php echo '<img src ="'.TEMPLATE_URL.'/images/product-logo-america.png">' ?>
                                </div>
                                <div class="slidewrap">
                                    <h1 class="lname">American <span class="brand-color">Group</span></h1>
                                    <h2 class="lname2"></h2>
                                </div>
                            </div>

                            <div class="carousel_time">
                                <div class="comman">
                                    <a href="#" onclick="viewMorePopUp(999, 1, 7)">
                                        <span class="buy_button view_big">Details</span>
                                    </a>
                                </div>
                                <div class="comman">
                                    <a href="#" onclick="buyNowProductBtn(999, 2, 7, 1)">
                                        <span class="buy_button special">Join Group</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="cart-popup" id="">
          <a href="#" onclick="viewMorePopUpHide()"><div class="close-btn"></div></a>
          <div class="signinwrap">
              <div class="form-title">
                  <div class="product-logo" id="popUpProduct"></div>
                  <div class="form_hadding" id="popUpTitle"></div>
              </div>
              <div class="clear">&nbsp;</div>
              <br>
              <hr>
              <br>
              <span><p id="popUpText">Win the biggest lottery jackpot in the world! Boost your winning odds by 5000%. With our Groups you get more tickets, win more and pay less.</p></span>
              <hr>
              <br>
              <div class="form_part">
                  <form method="post" class="ng-pristine ng-valid">
                      <div class="numberofdraws">
                          <div class="darwsselectpart">
                              <div class="lable">
                                  <span id="ContentPlaceHolder1_Label19_draws">Number Of Draws:</span>
                              </div>
                              <select class="u_field" id="DrawsSelect">
                              </select>
                          </div>
                          <br>
                          <div class="total-sum">
                              <div class="drawdiscount">
                                  <span id="ContentPlaceHolder1_Label19_discount">Discount:</span>
                                  <div id="popupDiscount" class="discountnum" style="display: inline-block;">$0.00</div>
                              </div>
                              <div class="totalforview"> Total:
                                  <span id="PopUpTotalSum" class="totalsum"><b>€27.00</b></span>
                              </div>
                          </div>
                          <br> <br>
                          <input type="button" value="Join Group" id="popUpBuy" class="buy_button special" />
                          <span class="signup_error"></span>
                      </div>
                  </form>
              </div>
          </div>
        </div>
<?php endif;
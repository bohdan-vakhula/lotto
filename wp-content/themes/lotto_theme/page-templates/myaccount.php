<?php
/**
 * Template Name: My account
 *
 */

get_header();

    $FirstName    = $_SESSION['user_data']['FirstName'];
    $LastName     = $_SESSION['user_data']['LastName'];
    $Email        = $_SESSION['user_data']['Email'];
    $CountryCode  = $_SESSION['user_data']['CountryCode'];
    $City         = $_SESSION['user_data']['City'];
    $Address      = $_SESSION['user_data']['Address'];
    $ZipCode      = $_SESSION['user_data']['ZipCode'];
    $MobileNumber = $_SESSION['user_data']['MobileNumber'];
    $Phone2       = $_SESSION['user_data']['PhoneNumber'];
    $state        = $_SESSION['user_data']['State'];
    $countries    = lotto_get_countries();
    $perc         = ($_SESSION['user_balance']['Points'] == 0 || $_SESSION['user_balance']['EndPoints'] == 0) ? 0 : ($_SESSION['user_balance']['Points'] / $_SESSION['user_balance']['EndPoints']) * 100;

    // JS using point in pixel, that's why we have added additional pixel, dont remove it.
    if ($perc == 100) {
        $perc += 62;
    } else if ($_SESSION['user_balance']['Points'] > 99) {
        $perc += 30;
    }
    $real_money = $_SESSION['user_balance']['currency'] . " " . number_format(($_SESSION['user_balance']['AccountBalance'] + $_SESSION['user_balance']['WinningAmount']), 2);
    $bonus_money = $_SESSION['user_balance']['currency'] . " " . number_format($_SESSION['user_balance']['BonusAmount'],2);
    ?>
    <script type="text/javascript">
        var perc = <?php echo $perc; ?>;

        jQuery(document).ready(function(){
            var lastTab = localStorage.getItem('lastOpenedTab')
            if (lastTab) {
                //$("[data=" + lastTab + "]").css("border","1px solid red")
                setTimeout(function(){
                    $("[data=" + lastTab + "]").trigger("click");
                }, 500)
            }
            if (isMobile) {
                setTimeout(function(){
                    $("[data=tabs-4]").trigger("click");
                }, 500)
            }
        });

        jQuery( window ).unload(function() {
            var lastOpenedTab = $(".r-tabs-state-active").find(".r-tabs-anchor").attr("data");
            localStorage.setItem('lastOpenedTab', lastOpenedTab);
		});
    </script>

    <div class="wrap-my-account clearfix">

        <div class="hadding inner-hadding">
            <h1><?php the_title(); ?></h1>
        </div>

        <div id="user-info-box">
            <div class="part ">
                <i class="avatar"></i>
                <p class="box_name"><?php echo $FirstName . " " . $LastName; ?></p>
                <p class="box_viplvl"><?php echo ($_SESSION['user_balance']['VipLevel'] != "None") ? $_SESSION['user_balance']['VipLevel'] : ""; ?></p>
            </div>
            <div class="part">
                <i class="realmoney-pic"></i>
                <p class="box_name"><?php _e('Real money:','twentythirteen') ?></p>
                <p class="box_text"><?php echo $real_money; ?></p>
            </div>
            <div class="part">
                <i class="accpig-pic"></i>
                <p class="box_name"><?php _e('Bonus money','twentythirteen') ?></p>
                <p class="box_text"><?php echo $bonus_money; ?></p>
            </div>
            <div class="part">
                <p class="text_holder"><?php _e('My points','twentythirteen') ?><span style="color: rgb(29, 50, 101);" class="text_right green"><?php echo $_SESSION['user_balance']['Points']; ?></span></p>
                <div class="meter nostripes">
                    <span style="width: <?php echo $perc; ?>%; background-color: #00ac75"></span>
                </div>
                <p class="text_holder"><?php _e('Points to next level','twentythirteen') ?><span style="color: rgb(29, 50, 101);" class="text_right green"><?php echo $_SESSION['user_balance']['EndPoints']; ?></span></p>
            </div>
            <div class="btns_box clearfix">
                <a href="<?php echo HOME_URL ?>/my-account/deposit" class="btn btn_dark-blue right"><?php _e('Deposit','twentythirteen') ?></a>
                <a href="<?php echo HOME_URL ?>/withdraw-money" class="btn btn_light-blue right"><?php _e('Withdraw','twentythirteen') ?></a>
            </div>

            <!--<div class="points_box">
                not used in DommLotto
                <?php if ($_SESSION['user_balance']['Discount'] > 0 && $_SESSION['user_balance']['CashBack'] > 0): ?>
                <p><?php _e('Discount:','twentythirteen') ?><span class="text_right green"><?php echo ($_SESSION['user_balance']['Discount'] * 100) . "%"; ?></span></p>
                <p><?php _e('Money back:','twentythirteen') ?><span class="text_right green"><?php echo ($_SESSION['user_balance']['CashBack'] * 100) . "%"; ?></span></p>
                <?php endif ?>
            </div>-->
        </div><!-- /.user-info-box -->
        <div id="horizontalTab">

            <ul class="clearfix">
                <li><a href="#" data="tabs-1"><i class="ico-tabs ico-details">&nbsp;</i><?php _e('My Details','twentythirteen') ?></a></li>
                <li><a href="#" data="tabs-2" id="my_payments_detail"><i class="ico-tabs ico-payments">&nbsp;</i><?php _e('Payment Methods','twentythirteen') ?></a></li>
                <li><a href="#" data="tabs-3" id="mytransactions"><i class="ico-tabs ico-transactions">&nbsp;</i><?php _e('Transactions','twentythirteen') ?></a></li>
                <li><a href="#" data="tabs-4" id="my_tickets"><i class="ico-tabs ico-tickets">&nbsp;</i><?php _e('My Tickets','twentythirteen') ?></a></li>
                <li><a href="#" data="tabs-5" id="my_products"><i class="ico-tabs ico-products">&nbsp;</i><?php _e('My Products','twentythirteen') ?></a></li>
            </ul>
        </div>

        <div id="user-details">
                <img src="<?php echo TEMPLATE_URL ?>/images/loading.gif" class="macloader">

                <div id="tabs-1" class="r_tabs">
                    <form name="myaccount_detail" id="myaccount_detail" class="" action="" method="POST">
                        <div class="myaccount_detail_error"></div>
                        <div class="account_form">

                            <div class="field left">
                                <i class="ico-fname"></i>
                                <input name="first_name" id="first_name" type="text" onkeypress="return isNameValid(event)" class="account_field" value="<?php echo $FirstName; ?>" />
                                <label for="first_name"><?php _e('First Name','twentythirteen') ?></label>
                            </div>

                            <div class="field right">
                                <input name="last_name" id="last_name" type="text" onkeypress="return isNameValid(event)" class="account_field" value="<?php echo $LastName; ?>" />
                                <label for="last_name"><?php _e('Last Name','twentythirteen') ?></label>
                            </div>

                            <div class="cl"></div>

                            <div class="field left">
                                <i class="ico-email"></i>
                                <input name="email" id="email" readonly="readonly" type="text" class="account_field" value="<?php echo $Email; ?>" />
                                <label for="email"><?php _e('Your Email','twentythirteen') ?></label>
                            </div>
                            <hr/>

                            <div class="field left">
                                <i class="ico-country"></i>
                                <select name="country" id="country">
                                    <?php
                                        foreach ($countries as $key => $value) {
                                            if ($CountryCode == $key) {
                                                $selected = 'selected="selected"';
                                            } else {
                                                $selected ='';
                                            }
                                            ?>
                                            <option value="<?= $key ?>" <?= $selected ?> title="<?= $value ?>"><?php _e($value, 'twentythirteen') ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                                 <label for="country"><?php _e('Country','twentythirteen') ?></label>
                            </div>

                            <div class="field right">
                                <input name="city" id="city" type="text" onkeypress="return isAlphaKey(event)" class="account_field" value="<?php echo $City; ?>"/>
                                <label for="city"><?php _e('City','twentythirteen') ?></label>
                            </div>
                            <div class="cl"></div>

                            <div class="field left">
                                <input name="address" id="address" type="text" class="account_field"  value="<?php echo $Address; ?>"/>
                                <label for="address"><?php _e('Address','twentythirteen') ?></label>
                            </div>

                            <div class="field right">
                                <input name="zipcode" id="zipcode" type="text" onkeypress="return isNumberKey(event)" class="account_field" value="<?php echo $ZipCode; ?>" maxlength="6"/>
                                <label for="zipcode"><?php _e('Zip Code','twentythirteen') ?></label>
                            </div>
                            <hr/>
                            <div class="cl"></div>

                            <div class="field left">
                                <i class="ico-phone"></i>
                                <input name="phone" id="phone" type="text" onkeypress="return isNumberAddBrackets(event)" class="account_field" value="<?php echo $Phone2; ?>" maxlength="25"/>
                                <label for="phone"><?php _e('Phone 1','twentythirteen') ?></label>
                            </div>

                            <div class="field right">
                                <input name="mobno" id="mobno" type="text" onkeypress="return isNumberAddBrackets(event)" class="account_field" value="<?php echo $MobileNumber; ?>" maxlength="25"/>
                                <label for="mobno"><?php _e('Phone 2','twentythirteen') ?></label>
                            </div>
                            <hr/>
                            <div class="cl"></div>

                            <a class="btn btn_dark-blue right" id="myaccount_update"><?php _e('Save Changes','twentythirteen') ?></a>
                            <a href="#tab-6" class="u_changepassword dark-blue-font"><i class="ico-changepassword"></i><?php _e('Change Password','twentythirteen') ?></a>
                            <div class="cl"></div>
                        </div>
                        <div class="account_form change_pass">

                            <div class="field left">
                                <input name="oldpassword" id="oldpassword" type="password" class="account_field" />
                                <label for="oldpassword"><?php _e('Old Password','twentythirteen') ?></label>
                            </div>
                            <div class="cl"></div>

                            <div class="field left">
                                <input name="newpassword" id="newpassword" type="password" class="account_field" />
                                <label for="newpassword"><?php _e('New Password','twentythirteen') ?></label>
                            </div>
                            <div class="cl"></div>

                            <div class="field left">
                                <input name="retypepassword" id="retypepassword" type="password" class="account_field" />
                                <label for="retypepassword"><?php _e('Retype Password','twentythirteen') ?></label>
                            </div>
                            <div class="cl"></div>

                            <a id="change_password" class="btn btn_dark-blue right"><?php _e('Save Password','twentythirteen') ?></a>
                        </div>
                    </form>
                </div><!-- /.tab-1/.My Details -->

                <div id="tabs-2" class="r_tabs table_style_1">

                    <div class="payment_method">
                        <table cellspacing="1" cellpadding="0">
                            <thead class="btn_dark-blue">
                            <tr>
                                <th height="30" align="center" valign="middle" class="small-arrow"><?php _e('Payment Method','twentythirteen') ?></th>
                                <th align="center" valign="middle" class="small-arrow"><?php _e('Status','twentythirteen') ?></th>
                                <th align="center" valign="middle" class="small-arrow"><?php _e('Default','twentythirteen') ?></th>
                                <th align="center" valign="middle"><?php _e('Update','twentythirteen') ?></th>
                                <th align="center" valign="middle"><?php _e('Delete','twentythirteen') ?></th>
                            </tr>
                            </thead>
                            <tbody id="mypayment_method">
                            <!--Dynamic content load-->
                            </tbody>
                        </table>
                    </div>

                    <input type="button" class="btn btn_dark-blue right" id="addmethod" value="<?php _e('Add Payment Method','twentythirteen') ?>"/>

                    <hr>

                    <!--<div class="head_payment_cart_detail">
                        <i class="ico-bg-payment"></i>
                        <span><?php _e('Add Payment Method','twentythirteen'); ?></span>
                        <i class="ico-close"></i>
                    </div>-->

                    <form name="updatecard" action="" method="post" id="updatecard">
                        <input type="hidden" name="cardid" id="cardid" value="342"/>
                        <input type="hidden" name="cardtype" id="cardtype" value=""/>

                        <div class="card_option clearfix">
                            <!--<input type="radio" value="Visa" name="card" id="Visa" class="Visa" checked=""/>-->
                            <i class="ico-visa" id="Visa"></i>

                            <!--<input type="radio" value="MasterCard" name="card" id="MasterCard" class="MasterCard"/>-->
                            <i class="ico-mastercard" id="MasterCard"></i>
                        </div>

                        <div class="card_form">
                            <div>
                                <div class="field field-left">
                                    <label for="card_num"><?php _e('Card Number:','twentythirteen') ?></label>
                                    <input type="text" placeholder="" maxlength="16" name="card_num" id="card_num" class="card_num card_num_field" onkeypress="return isNumberKey(event)">
                                </div>

                                <div class="field field-right clearfix">
                                    <div class="expdate left">
                                        <select name="month" class="month">
                                            <?php
                                            for ($i = 1; $i <= 12; $i++) {
                                                $i = strlen($i) == 1 ? '0' . $i : $i;
                                                echo '<option value=' . $i . '>' . $i . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <select name="year" class="year">
                                            <?php
                                            for ($i = 16; $i <= 25; $i++) {
                                                echo '<option value=20' . $i . '>20' . $i . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <label><?php _e('Expiration Date:','twentythirteen') ?></label>
                                </div>
                            </div>

                            <div>
                                <div class="field field-left">
                                    <label for="card_fullname"><?php _e('Full Name:','twentythirteen') ?></label>
                                    <input name="fullname" type="text" id="card_fullname" class="fullname fullname_field" value="" maxlength="100" />
                                </div>

                                <div class="field field-right">
                                    <div class="cvc2">
                                        <input name="cvv" id="cvv" class="cvv cvc2_field" type="text" value="" onkeypress="return isNumberKey(event)" maxlength="4"/>
                                        <label for="cvv"><?php _e('CVV/CVC2:','twentythirteen') ?></label>
                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="cardupdatemsg left"></div>
                    </form>
                    <input type="button" class="btn btn_dark-blue right" id="" onclick="updateMethod()" value="<?php _e('Save Changes','twentythirteen') ?>"/>
                </div><!-- /.tab-2/.Payment Methods -->

                <div id="tabs-3" class="r_tabs table_style_1">
                    <div class="table_style_1">
                        <table cellspacing="1" cellpadding="0">
                            <thead class="btn_dark-blue">
                            <tr>
                                <th height="30" align="center" valign="middle" class="small-arrow"><?php _e('Transactions','twentythirteen') ?></th>
                                <th align="center" valign="middle" class="small-arrow"><?php _e('ID','twentythirteen') ?></th>
                                <th align="center" valign="middle" class="small-arrow"><?php _e('Date','twentythirteen') ?></th>
                                <th align="center" valign="middle" class="small-arrow"><?php _e('Amount','twentythirteen') ?></th>
                                <th align="center" valign="middle" class="small-arrow"><?php _e('Lottery','twentythirteen') ?></th>
                                <th align="center" valign="middle" class="small-arrow"><?php _e('Product','twentythirteen') ?></th>
                                <th align="center" valign="middle" class="small-arrow"><?php _e('Method','twentythirteen') ?></th>
                            </tr>
                            </thead>
                            <tbody id="mytransaction"></tbody>
                        </table>
                    </div>
                    <!-- An empty div which will be populated using jQuery -->
                    <input type='hidden' class='current_page'/>
                    <input type='hidden' class='show_per_page'/>
                    <div class="paging_part"></div>
                </div><!-- /.tab-3/.My Transactions -->

                <div id="tabs-4" class="r_tabs">
                    <div class="my_table_main">
                        <div class="table_style_1">
                            <table cellspacing="1" cellpadding="0" border="0">
                                <thead class="btn_dark-blue">
                                <tr>
                                    <th height="30" align="center" class="small-arrow" valign="middle"><?php _e('Country','twentythirteen') ?></th>
                                    <th align="center" class="small-arrow" valign="middle"><?php _e('Lottery','twentythirteen') ?></th>
                                    <th align="center" class="small-arrow" valign="middle"><?php _e('Date','twentythirteen') ?></th>
                                    <th align="center" class="small-arrow" valign="middle"><?php _e('Status','twentythirteen') ?></th>
                                    <th align="center" class="small-arrow" valign="middle"><?php _e('Winnings','twentythirteen') ?></th>
                                    <th align="center" valign="middle"><?php _e('Details','twentythirteen') ?></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div id="my_tickets_data"></div>
                    </div>
                    <!-- An empty div which will be populated using jQuery -->
                    <input type='hidden' class='current_page'/>
                    <input type='hidden' class='show_per_page'/>
                    <div class="paging_part"></div>
                </div><!-- /.tab-4/.My Tickets -->

                <div id="tabs-5" class="r_tabs">
                    <div class="my_table_main">
                        <div class="table_style_1">
                            <table cellspacing="1" cellpadding="0" border="0">
                                <thead class="btn_dark-blue">
                                <tr>
                                    <th height="30" align="center" valign="middle"><?php _e('Product','twentythirteen') ?></th>
                                    <th align="center" valign="middle"><?php _e('Lottery','twentythirteen') ?></th>
                                    <th align="center" valign="middle"><?php _e('Group Shares','twentythirteen') ?></th>
                                    <th align="center" valign="middle"><?php _e('Draws Left','twentythirteen') ?></th>
                                    <th align="center" valign="middle"><?php _e('Total Lines','twentythirteen') ?></th>
                                    <th align="center" valign="middle" style="font-size: 11px"><?php _e('Purchased On','twentythirteen') ?></th>
                                    <th align="center" valign="middle"><?php _e('End Date','twentythirteen') ?></th>
                                    <th align="center" valign="middle"><?php _e('Status','twentythirteen') ?></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="drawer-item myproductdrawer" id="myproduct"></div>
                    </div>
                    <!-- An empty div which will be populated using jQuery -->
                    <input type='hidden' class='current_page'/>
                    <input type='hidden' class='show_per_page'/>
                    <div class="paging_part"></div>
            </div><!-- /.horizontalTab -->
        </div><!-- /.user-details -->
    </div><!-- /.wrap-my-account -->
<?php

get_footer();

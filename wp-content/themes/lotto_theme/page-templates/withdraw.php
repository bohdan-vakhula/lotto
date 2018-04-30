<?php
/**
 * Template Name: Withdraw
 *
 */
get_header();

if (isset($_SESSION['user_data']) && count($_SESSION['user_data']) > 0) {
    ?>

    <div class="hadding inner-hadding">
        <h1><?php the_title(); ?></h1>
    </div>

    <div class="widthdrawpage">
        <div class="widthdrawpagetitle">
            <div class="widthdrawinnercontainer">
                <div class="widthdrawtitleinner">
                    <div class="widthdrawtitlepart">
                        <h2>
                            <span id="ContentPlaceHolder1_Label1"><?php _e('Withdraw Your Winnings and Account Balance','twentythirteen')?></span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="withdrawexplanation">
            <div class="widthdrawinnercontainer">
                <p>
                    <span id="ContentPlaceHolder1_Label2"><?php _e('At any time you may ask to withdraw your winnings and your account’s balance. After requesting to withdraw, Your withdrawal request will be processed within 48 hours. Please make sure your contact details are fully updated.','twentythirteen')?></span>
                </p>
            </div>
        </div>
        <div class="widthdrawmoneyup">
            <div class="widthdrawmoneyupinner">
                <div class="widthdrawinnercontainer">
                    <h2>
                        <span id="ContentPlaceHolder1_Label3"><?php _e('Withdraw Your Money:','twentythirteen')?></span>
                    </h2>
                    <p>
                        <span id="ContentPlaceHolder1_Label4"><?php _e('On your account (Winnings &amp; Balance) you have an overall amount of:','twentythirteen')?></span>
                        <span id="ContentPlaceHolder1_real_money"> <?php echo $_SESSION['user_balance']['currency'] . " " .  number_format($_SESSION['user_balance']['AccountBalance'] + $_SESSION['user_balance']['WinningAmount'], 2);?></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="widthdrawmoneydown">
            <div class="widthdrawmoneydowninner">
                <div class="widthdrawmoneydowninnerwrapper">
                    <div class="howmuchwuthdrawtext">
                        <p>
                            <span id="ContentPlaceHolder1_Label5"><?php _e('Choose how much you would like to withdraw:','twentythirteen')?></span>
                        </p>
                    </div>
                    <div class="howmuchwuthdrawinputtext">
                        <input type="text" class="cvc2_field" name="amt" onkeypress="return isNumberKey(event)" maxlength="6"/>
                    </div>
                    <div class="withdrawbtnpart">
                        <div class="withdrawbtn">
                            <div clientidmode="Static" id="btn_withdraw" >
                                <p class="withdrawbtntxt">
                                    <span id="ContentPlaceHolder1_Label6"><?php _e('Request Withdraw','twentythirteen')?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="myaccount_detail_error" style="margin-top: 20px;"></div>
            </div>
        </div>
    </div>
<?php
} else {
    $location = home_url() . "#modal";
    echo '<script type="text/javascript">
            window.location.href = "' . $location . '"
        </script>';
}

get_footer();

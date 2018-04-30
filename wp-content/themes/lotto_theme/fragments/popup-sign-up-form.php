<div id="sign-up-form" class="popup-form">
    <div class="register-main">
        <div class="reg-left">
            <img src="<?php echo TEMPLATE_URL; ?>/images/logo_reg.png" />
            <h2> Welcome </h2>
            <h5>LOTTOWORLDGROUP is owned and </br>
                operated by LWGL Lotto World Group Ltd.</h5>
            <h6> Registration with social media:</h6>
            <a href="#" style="margin-left: 4px;"> <img src="<?php echo TEMPLATE_URL; ?>/images/reg-fb.png" /> </a>
        </div>
        <div class="reg-right">
            <form form name="signup" method="post" action="" id="signup">
                <h3> Registration </h3>
                <div class="fname"> <input id="signup-fullname" type="text" name="full_name" class="form-data" placeholder="Full Name" style=" width: 90%;" /> <span style="float:right;"> <img src="<?php echo TEMPLATE_URL; ?>/images/usr.png" /> </span> </div>
                <div class="border"></div>
                <div class="fname"> <input id="signup-phone" type="text" name="phone" class="form-data" placeholder="Phone" style=" width: 90%;" /> <span style="float:right;"> <img src="<?php echo TEMPLATE_URL; ?>/images/call.png" /> </span> </div>
                <div class="border"></div>
                <div class="fname"> <input id="signup-email" type="text" name="email" class="form-data email_field" placeholder="Email" style=" width: 90%;" /> <span style="float:right;"> <img src="<?php echo TEMPLATE_URL; ?>/images/email.png"/> </span> </div>
                <div class="border"></div>
                <div class="fname"> <input id="signup-password" type="password" name="password" class="form-data password_field" placeholder="Password" style=" width: 90%;" /> <span style="float:right;"> <img src="<?php echo TEMPLATE_URL; ?>/images/login.png"> </span> </div>
                <div class="border"></div>
                <span class="signup_error"></span>

                <input name="firstname" type="hidden" />
                <input name="lastname" type="hidden" />

                <p><input id="signup-terms" type="checkbox" name="terms" />&nbsp;&nbsp;<?php printf(__('I accept the <a href="%1$s">Terms and Conditions</a>', 'crb'), home_url('/').'terms-and-conditions'); ?></a></p>

                <a class="button1 signup_submit" name="signup_submit" href="javascript:void(0);"> <img src="<?php echo TEMPLATE_URL; ?>/images/reg_button.png" style="margin-left: -11px;width: 306px;"> <div class="but-text" style="left: 70px !important;font-size: 16px !important;"> Create an account  </div></a>
                <h6>By creating a new account I accept the
                    <a target="_blank" href="<?php echo home_url('/').'terms-and-conditions'; ?>">terms and conditions</a>, the <a target="_blank" href="<?php echo home_url('/').'privacy-policy'; ?>">privacy policy</a> and
                    confirm that I am over 18 years of age. It is
                    an offence to gamble if under age. <a href="#">Gamble
                        Responsibly</a>.</h6>
            </form>
        </div>
    </div>    
    <img src="<?php echo TEMPLATE_URL; ?>/images/loading.gif" class="hidesignuploader">
</div>
<script type="text/javascript">

    jQuery('.fname').on( "click", function() {
        jQuery(this).find('input[type="text"]').focus();
        jQuery(this).find('input[type="password"]').focus();
    });
</script>

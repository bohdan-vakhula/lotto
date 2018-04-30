<div class="blur"></div>

<div id="sign-in-form" class="popup-form">
    <div class="register-main1">
        <div class="reg-top">
            <h3> Log in </h3>
            <img src="<?php echo TEMPLATE_URL; ?>/images/logo_login.png" />
        </div>
        <div class="reg-top1">
            <h6> Log in to your account</h6>
        </div>
        <div class="reg-right1">
            <form id="signin" name="signin" method="post" action="">
                <div class="fname"> <input id="login-email" type="text" name="email" class="form-data email_field" placeholder="Email" style=" width: 90%;" /> <span style="float:right;"> <img src="<?php echo TEMPLATE_URL; ?>/images/email.png"/> </span> </div>
                <div class="border"></div>
                <div class="fname"> <input id="login-password" type="password" name="password" class="form-data" placeholder="Password" style=" width: 90%;" /> <span style="float:right;"> <img src="<?php echo TEMPLATE_URL; ?>/images/login.png"> </span> </div>
                <div class="border"></div>
                <label class="checkcontainer" style="font-size: 15px !important;width: 50%;float: left;">
                    Remember me <input type="checkbox"  style="display:none;"><span class="checkmark"></span>
                </label>
                <div class="for"> <a class="forgotpass" href="javascript:void(0)"> Forgot Password?  </a></div>
                <div class="forgotemaildisp" style="display: none;">
                    <div class="fname" style="margin-top: 10px !important;"> 
                        <input id="forgotemail" type="text" name="forgotemail" class="form-data email_field" placeholder="Email" style=" width: 90%;" /> 
                        <span style="float:right;"> <img src="<?php echo TEMPLATE_URL; ?>/images/email.png"/> </span> 
                    </div>
                    <div class="border" style="margin-bottom: 0px !important;"></div>
                </div>
                <div class="clearfix"></div>
                <p class="signin_error"></p>
                <a href="javascript:void(0);" name="signin_submit" class="signin_submit button2"> <img src="<?php echo TEMPLATE_URL; ?>/images/reg_button.png" style="    margin-left: -11px;width: 200px;height: 44px;"> <div class="but-text1" style=" left: 34% !important;"> Log in  </div> </a>
                <a href="javascript:void(0);" name="forgot_submit" class="forgot_submit button2" style="display:none;margin-bottom: 20px;"> <img src="<?php echo TEMPLATE_URL; ?>/images/reg_button.png" style="margin-left: -11px;width: 200px;height: 44px;"> <div class="but-text1" style="font-size: 16px !important;left: 34% !important;"> Submit  </div> </a>
                <a href="#" class="lg-fb"> <img src="<?php echo TEMPLATE_URL; ?>/images/log-fb.png" /> </a>
            </form>
        </div>
    </div>  
    <img src="<?php echo TEMPLATE_URL; ?>/images/loading.gif" class="hidesigninloader">
</div>
<script type="text/javascript">

    jQuery('.fname').on( "click", function() {
        jQuery(this).find('input[type="text"]').focus();
        jQuery(this).find('input[type="password"]').focus();
    });
</script>

<?php
/**
 * Template Name: Reset
 *
 */
get_header();

if (isset($_GET) && $_GET['lang'] && count($_GET) == 2) {
    $keys       = array_keys($_GET);
    $method_url = 'userinfo/verify-reset-password-link-with-output';
    $request    = array("EncryptedQueryString" => $_SERVER['QUERY_STRING']);
    $response   = executeGenericApiCall($method_url, $request);

    $response_decoded = json_decode($response["response"]);
    if ($response["status"] == 200 && $response_decoded->MemberId > 0) { // show reset form
        // get memberid
        $_SESSION['ResetMemberId'] = $response_decoded->MemberId;
        ?>
        <div class="hadding inner-hadding">
            <h1><?php the_title(); ?></h1>
        </div>
        <div class="main-content">
            <form id="resetform" name="resetform" action="" method="post">
                <div class="form">
                    <ul>
                        <li><input name="password" type="password" placeholder="New Password" value="" class="u_field"/></li>
                        <li><input name="confirm_password" type="password" placeholder="Confirm New Password" value="" class="u_field"/></li>
                        <li><input name="" type="button" value="Reset Password" id="reset_password_button" class="u_button"/></li>
                        <li><img src="<?php echo TEMPLATE_URL ?>/images/loading.gif" class="hidesignuploader"/></li>
                        <li><span class="reset_error"></span></li>
                    </ul>
                </div>
            </form>
        </div>

        <script type="text/javascript">
            jQuery("#reset_password_button").click(function () {
                var checkpassword = validateResetPasswordForm();
                if (checkpassword) {
                    var pass = jQuery("#resetform").find("input[name=password]");
                    var pass_val = jQuery.trim(pass.val());
                    var datastring = "action=lottery_data&m=userinfo/update-password&email=<?php echo $response_decoded->Email; ?>&password=" + pass_val;
                    jQuery(".hidesignuploader").show();
                    jQuery.ajax({
                        type: "POST",
                        url: CONFIG.adminURL,
						dataType : "json",
                        data: datastring,
                        success: function (data) {
                            var success = data.Result;
                            console.log(data);
                            jQuery("#resetform").find(".reset_error").html(success);
                            jQuery("[type=password]").val("");
                            setTimeout(function () {
                                window.location = "<?php echo home_url( '/' ); ?>";
                            }, 1000);
                        }
                        , error: function (data) {
                            jQuery(".hidesignuploader").hide();
                        }
                    });
                }
            });
        </script>
        <?php
    } else {
        ?>
        <div class="hadding inner-hadding">
            <h1><?php _e('Reset password link is not valid','twentythirteen') ?></h1>
        </div>
        <div class="main-content">
            <?php 
                printf(__('<p>Please check the URL for proper spelling and capitalization.<br />If you\'re having trouble locating a destination, try visiting the <a href="%1$s">home page</a>.</p>', 'crb'), home_url('/'));
            ?>
        </div>
        <?php
    }
}

get_footer();
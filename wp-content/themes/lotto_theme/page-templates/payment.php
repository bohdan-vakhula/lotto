<?php
/**
 * Template Name: Payment
 *
 */
get_header();

if (count($_POST) == 0) {
    echo "<script>location.href='" . home_url() . "'</script>";
    exit();
} else {
    if (isset($_SESSION) && $_SESSION['user_data']) {
        if (isset($_SESSION['user_data']) && is_array($_SESSION['user_data']['Result'])) {
            $usersession = $_SESSION['user_data']['Result']['UserSessionId'];
            $_SESSION['user_data'] = $_SESSION['user_data']['Result'] + $_SESSION['user_data'];
        } else {
            $usersession = $_SESSION['user_data']['UserSessionId'];
        }

        $otherdata = explode("|", $_POST['otherdata']);

        if (isset($_POST['single_drawop']) && $_POST['single_drawop'] == 1) {
            $draws = $_POST['single_drawop'];
        }
        if (isset($_POST['single_drawop']) && $_POST['single_drawop'] == 2) {
            $draws = $_POST['single_totaldraw'];
        }
        if (isset($_POST['single_drawop']) && $_POST['single_drawop'] == 3) {
            // Per week = 2 Draws
            $draws = $_POST['single_subs'] * 2;
        }

        if (isset($_POST['group_drawop']) && $_POST['group_drawop'] == 1) {
            $draws = $_POST['group_drawop'];
        }
        if (isset($_POST['group_drawop']) && $_POST['group_drawop'] == 2) {
            $draws = $_POST['group_totaldraw'];
        }
        if (isset($_POST['group_drawop']) && $_POST['group_drawop'] == 3) {
            // Per week = 2 Draws
            $draws = $_POST['group_subs'] * 2;
        }
        ?>

        <script type="text/javascript">

            jQuery(document).ready(function ($) {
                $('#my-deferred-iframe').getIframeSize('div.innerpage_left');
                //$('#my-deferred-iframe').height('1200px');

                // iframe size set to 320 for mobile
                isMoble = <?php echo (wp_is_mobile()) ? "true" : "false";?>;
                
                if (isMoble) {
                    var proxyWindow = $('.logo').width() + 20;

                    if ( proxyWindow <= 630 ) {
                        $('#my-deferred-iframe').css("width","100%");
                    }
                }

            });

            function loadDeferredIframe() {
                var iframe = document.getElementById("my-deferred-iframe");

                //New iframe
                iframe.src = "<?php echo CASHIER_URL ?>OpenCashier.aspx?actionType=<?php if ( wp_is_mobile() ) echo 'm' ?>Order&pmc=<?php echo $otherdata[3]; ?>&sessionId=<?php echo $usersession; ?>&Lang=" + CONFIG.siteLang + "&isGroup=<?php echo $otherdata[4]; ?>&isSubscription=<?php echo (empty($otherdata[2])) ? 'False' : 'True'; ?>&hasFreeTicket=False&numPurch=1&mailaffiliate=False&DepositStep=StepOne&prc=<?php echo $_SESSION['prc']; ?>&brandid=<?php echo BRAND_ID; ?>"; // here goes your url
            }

            window.onload = loadDeferredIframe;

        </script>
        <div id="hidden_clicker" style="display: none">
            <a id="hiddenclicker" href="#" class="fancybox fancybox.iframe"></a>
        </div>
        <!-- #main-content -->
        <div id="middle" class="innerbg paymentpage">
            <div class="wrap">

                <div class="breadcrumbs">
                    <ul>
                        <li><a href="<?php echo home_url(); ?>"><img src="<?php echo TEMPLATE_URL; ?>/images/homeicon.png"/></a></li>
                        <li>››</li>
                        <li><?php the_title() ?></li>
                    </ul>

                </div>


                <div class="innerpage">
				<h1><?php _e('Your Order','twentythirteen') ?></h1>
                    <div class="innerpage_right">

					<div id="payment-right-side">
						<h1 class="pay1"><?php _e('Orolotto protects your security','twentythirteen') ?></h1>
						<p style="border-bottom: 1px solid #acb8c9; padding: 0px 15px 15px 95px; margin-top: 0px;"><?php _e('Orolotto uses the highest security levels to ensure the safety of our users.','twentythirteen') ?>
						</p>

						<h1 class="pay2"><?php _e('Your privacy is assured!','twentythirteen') ?></h1>
						<p style="border-bottom: 1px solid #acb8c9; padding: 0px 15px 15px 95px; margin-top: 0px;"><?php _e('We use secured servers - EV SSL issued by GeoTrust which affirms and validates the trustworthiness of our site. Your personal data is safe with us and will not be used by any third-party. All payment processing is done via a secure channel. Your Credit Card will be debited with the following Descriptor:<strong> Orolotto +44-20-33182913</strong>','twentythirteen') ?>.</p>
						<p style="padding:15px;"><?php _e('Orolotto.com is certified with a TrueBusinessID ® ensuring your protection and safe browsing.','twentythirteen') ?></p>
					</div>

                    </div>
                    <div class="innerpage_left tested" style="height: 600px;">
                        <img src="<?php echo TEMPLATE_URL ?>/images/loading.gif" class="macloader"/>
                        <iframe id="my-deferred-iframe" src="about:blank" width="700" height="600" style="border:0 none; width: 100%; margin-top: 40px;" scrolling="no"></iframe>

                    </div>
                </div>


            </div>
        </div>
        <?php
    } else {

        $_POST['selno'] = trim($_POST['selno'], "|");
        $_POST['storeselected'] = trim($_POST['storeselected'], "|");

        $otherdata = explode("|", $_POST['otherdata']);


        if (isset($_POST['single_drawop']) && $_POST['single_drawop'] == 1) {
            $draws = $_POST['single_drawop'];
        }
        if (isset($_POST['single_drawop']) && $_POST['single_drawop'] == 2) {
            $draws = $_POST['single_totaldraw'];
        }
        if (isset($_POST['single_drawop']) && $_POST['single_drawop'] == 3) {
            // Per week = 2 Draws
            $draws = $_POST['single_subs'] * 2;
        }

        if (isset($_POST['group_drawop']) && $_POST['group_drawop'] == 1) {
            $draws = $_POST['group_drawop'];
        }
        if (isset($_POST['group_drawop']) && $_POST['group_drawop'] == 2) {
            $draws = $_POST['group_totaldraw'];
        }
        if (isset($_POST['group_drawop']) && $_POST['group_drawop'] == 3) {
            // Per week = 2 Draws
            $draws = $_POST['group_subs'] * 2;
        }

        if (!isset($_POST['lines'])) {
            $isGroup = true;
            $lines = $_POST['quantity'] . " " .__('Shares','twentythirteen');
        } else {
            $isGroup = false;
            $lines = $_POST['lines'] . " ".__('Lines','twentythirteen');
        }
		if ($_POST['lines']==='1'){
		$tickets = $_POST['lines'] . " Ticket";
		}
		else {$tickets = $_POST['lines'] . " Tickets";}
        ?>

        <div id="middle" class="innerbg paymentpage">
            <div class="wrap">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="<?php home_url(); ?>"><img src="<?php echo TEMPLATE_URL; ?>/images/homeicon.png"/></a></li>
                        <li>››</li>
                        <li class="pagename"><?php _e('Registration','twentythirteen') ?></li>
                    </ul>
                </div>
                <div class="innerpage">
				<h1><?php _e('Your Order','twentythirteen') ?></h1>
                    <div class="innerpage_right">

                       <div id="payment-right-side">
						<h1 class="pay1"><?php _e('Orolotto protects your security','twentythirteen') ?></h1>
						<p style="border-bottom: 1px solid #acb8c9; padding: 0px 15px 15px 95px; margin-top: 0px;"><?php _e('Orolotto uses the highest security levels to ensure the safety of our users.','twentythirteen') ?>
						</p>

						<h1 class="pay2"><?php _e('Your privacy is assured!','twentythirteen') ?></h1>
						<p style="border-bottom: 1px solid #acb8c9; padding: 0px 15px 15px 95px; margin-top: 0px;"><?php _e('We use secured servers - EV SSL issued by GeoTrust which affirms and validates the trustworthiness of our site. Your personal data is safe with us and will not be used by any third-party. All payment processing is done via a secure channel. Your Credit Card will be debited with the following Descriptor:<strong> Orolotto +44-20-33182913</strong>','twentythirteen') ?>.</p>
						<p style="padding:15px;"><?php _e('Orolotto.com is certified with a TrueBusinessID ® ensuring your protection and safe browsing.','twentythirteen') ?></p>
					</div>

                    </div>
                    <div class="innerpage_left">
                        <div class="comman">
                            <div class="drawer">
                                <div class="drawer_hadding">
                                    <div class="call_full_dh"><span>1</span><?php _e(' Step One: Review Your Order','twentythirteen') ?></div>
                                </div>
                                <!-- First Item -->
                                <div class="drawer-item">
                                    <div class="drawer-header">
                                        <div class="call1_reg_dd"><img
                                                src="<?php echo TEMPLATE_URL; ?>/images/<?php echo strtolower($otherdata[1]); ?>.png" width="50"
                                                height="50"/></div>
                                        <div class="call2_reg_dd">
                                            <?php
											$paymentnav = "";
											if ($otherdata[1] === "Navidad") {
												$paymentnav = '<strong>Loteria De Navidad 2015 ' . __('Ticket','twentythirteen') . '</strong><br />
												'. $tickets .'<br />1 Draw';

											}else {
											$paymentnav = '<strong>' . $otherdata[1] . ' ' . __('Ticket','twentythirteen') . '</strong><br />
											'. $lines .'<br />
											'. $draws .' '. __('Draws','twentythirteen') . '';

										}?>
										<?php echo $paymentnav; ?>
                                        </div>
                                        <div class="call3_reg_dd">€ <?php echo number_format($_POST['totalprice'] , 2); ?></div>
										<?php if ($otherdata[1] === "Navidad") { ?>
										<div></div>
									<?php } else { ?>
                                        <div class="drawer_arrow_part">
                                            <div class="drawer-header-icon"></div>
                                        </div>
										<?php } ?>
                                    </div>
									<?php if ($otherdata[1] === "Navidad") { ?>
										<div></div>
									<?php } else { ?>
                                    <div class="drawer-content">
                                        <?php
                                        $selno = (isset($_POST['selno']) && $_POST['selno']) != "" ? explode("|", $_POST['selno']) : "";

                                        // if Group selected
                                        if ($selno == "") {
                                            ?>
                                            <div class="drawer-content-left">
                                                <div>
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td width="10%">&nbsp;</td>
                                                            <td width="70%" align="center" class="parantesestext_reg_text">
                                                                <?php echo $lines; ?>
                                                            </td>
                                                            <td width="10%" class="parantesestext_reg_page hidden-xs">{</td>
                                                            <td width="10%" align="center"><img src="<?php echo TEMPLATE_URL; ?>/images/winner.png"></td>
                                                        </tr>

                                                    </table>
                                                </div>

                                            </div>
                                            <div class="drawer-content-right">
                                                <div class="parantesestext_reg_page hidden-xs">}</div>
                                                <div class="parantesestext_reg_text"><?php echo $draws; ?> <?php _e('Draws','twentythirteen') ?></div>
                                            </div>
                                            <?php
                                        } else {
                                            if (is_array($selno) && count($selno) <= 5) {
                                                ?>
                                                <div class="drawer-content-left single">
                                                    <div>
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                            <?php
                                                            $tr = $main = $extra = "";
                                                            $i = 1;
                                                            foreach ($selno as $key => $value) {
                                                                if ($value !== "") {
                                                                    $num = explode("#", $value);
                                                                    $temp1 = explode(",", $num[0]);
                                                                    $temp2 = (strlen($num[1]) > 0) ? explode(",", $num[1]) : "";

                                                                    $main = '<span>' . implode("</span><span>", $temp1) . '</span>';
                                                                    if ($temp2 != "") {
                                                                        $extra = (count($temp2) > 0) ? '<span class="select">' . implode('</span><span class="select">',
                                                                                $temp2) . '</span>' : "";
                                                                    }
                                                                    $tr .= '<tr>
                                                            <td width="30%" align="right">&nbsp;</td>
                                                            <td width="5%" align="left">' . $i . '</td>
                                                            <td width="65%" align="left">
                                                                <div class="lt_numbers_reg">
                                                                    ' . $main . '
                                                                    ' . $extra . '
                                                                </div>
                                                            </td>
                                                        </tr>';
                                                                    $i++;
                                                                }
                                                            }

                                                            echo $tr;
                                                            ?>

                                                        </table>
                                                    </div>

                                                </div>
                                                <div class="drawer-content-right single">
                                                    <div class="parantesestext_reg_page">}</div>
                                                    <div class="parantesestext_reg_text"><?php echo $draws; ?> <?php _e('Draws','twentythirteen') ?></div>
                                                </div>
                                            <?php } else {
                                                ?>
                                                <div class="drawer-content-left double" style="">&nbsp;</div>
                                                <div class="drawer-content-right double" style="">
                                                    <table class="hidden-xs" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                        <tbody>
                                                        <tr>
                                                            <td align="left" width="35%" valign="middle">
                                                                <div class="call1_reg_detail">
                                                                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                                        <?php
                                                                        $tr = $main = $extra = "";
                                                                        $i = 1;
                                                                        foreach ($selno as $key => $value) {
                                                                            if ($key <= 4) {
                                                                                if ($value !== "") {
                                                                                    $num = explode("#", $value);
                                                                                    $temp1 = explode(",", $num[0]);
                                                                                    $temp2 = (strlen($num[1]) > 0) ? explode(",", $num[1]) : "";

                                                                                    $main = '<span>' . implode("</span><span>", $temp1) . '</span>';
                                                                                    if ($temp2 != "") {
                                                                                        $extra = (count($temp2) > 0) ? '<span class="select">' . implode('</span><span class="select">',
                                                                                                $temp2) . '</span>' : "";
                                                                                    }
                                                                                    $tr .= '<tr>
                                                                                        <td align = "left" width = "10%">' . $i . '</td>
                                                                                        <td align = "left" width = "90%">
                                                                                            <div class="lt_numbers_reg">
                                                                                                ' . $main . '
                                                                                                ' . $extra . '
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>';
                                                                                    $i++;
                                                                                }
                                                                            }
                                                                        }

                                                                        echo $tr;
                                                                        ?>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                            <td align="left" width="35%" valign="middle">
                                                                <div class="call1_reg_detail">
                                                                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                                        <?php
                                                                        $tr = $main = $extra = "";
                                                                        $i = 6;
                                                                        foreach ($selno as $key => $value) {
                                                                            if ($key >= 5) {
                                                                                if ($value !== "") {
                                                                                    $num = explode("#", $value);
                                                                                    $temp1 = explode(",", $num[0]);
                                                                                    $temp2 = (strlen($num[1]) > 0) ? explode(",", $num[1]) : "";

                                                                                    $main = '<span>' . implode("</span><span>", $temp1) . '</span>';
                                                                                    if ($temp2 != "") {
                                                                                        $extra = (count($temp2) > 0) ? '<span class="select">' . implode('</span><span class="select">',
                                                                                                $temp2) . '</span>' : "";
                                                                                    }
                                                                                    $tr .= '<tr>
                                                                                        <td align = "left" width = "10%">' . $i . '</td>
                                                                                        <td align = "left" width = "90%">
                                                                                            <div class="lt_numbers_reg">
                                                                                                ' . $main . '
                                                                                                ' . $extra . '
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>';
                                                                                    $i++;
                                                                                }
                                                                            }
                                                                        }

                                                                        echo $tr;
                                                                        ?>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                            <td align="left" width="30%" valign="middle" class="extra-info">
                                                                <div class="call3_reg_detail">
                                                                    <div class="parantesestext_reg_page1">
                                                                        <div class="parantesestext_reg_text1"><?php echo $draws; ?><br><?php _e('Draws','twentythirteen') ?></div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="drawer-content-left single">
                                                    <div>
                                                        <table class="visible-xs" width="100%" border="0" cellspacing="0" cellpadding="0">
                                                            <?php
                                                            $tr = $main = $extra = "";
                                                            $i = 1;
                                                            foreach ($selno as $key => $value) {
                                                                if ($value !== "") {
                                                                    $num = explode("#", $value);
                                                                    $temp1 = explode(",", $num[0]);
                                                                    $temp2 = (strlen($num[1]) > 0) ? explode(",", $num[1]) : "";

                                                                    $main = '<span>' . implode("</span><span>", $temp1) . '</span>';
                                                                    if ($temp2 != "") {
                                                                        $extra = (count($temp2) > 0) ? '<span class="select">' . implode('</span><span class="select">',
                                                                                $temp2) . '</span>' : "";
                                                                    }
                                                                    $tr .= '<tr>
                                                            <td width="20%" align="right">&nbsp;</td>
                                                            <td width="7%" align="left">' . $i . '</td>
                                                            <td width="65%" align="left">
                                                                <div class="lt_numbers_reg">
                                                                    ' . $main . '
                                                                    ' . $extra . '
                                                                </div>
                                                            </td>
                                                        </tr>';
                                                                    $i++;
                                                                }
                                                            }

                                                            echo $tr;
                                                            ?>

                                                        </table>
                                                    </div>

                                                </div>


                                                </div>
                                            <?php }
                                        }
                                        ?>
                                    </div>
									<?php } ?>
                                </div>
                                <!-- Second Item -->
								<div class="drawer-item">
                            <div class="drawer-header">
                                <div class="call1_reg_dd"><img src="<?php echo bloginfo("template_directory"); ?>/images/megamillions.png" width="50" height="50" /></div>
                                <div class="call2_reg_dd">
                                    <strong>Free Group Ticket MegaMillions</strong>
                                    1 Line<br />
                                    1 Draw
                                </div>
                                <div class="call3_reg_dd">free</div>
                                <div class="drawer_arrow_part"><div class="drawer-header-icon"></div></div>
                            </div>
                            <div class="drawer-content">
                                <div class="drawer-content-left">
                                    <div>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="30%" align="right"><img src="<?php echo bloginfo("template_directory"); ?>/images/winner.png"></td>
                                                <td width="5%" align="left">&nbsp;</td>
                                                <td width="65%" align="left">
                                                    <div class="lt_numbers_reg">
                                                        <span>2</span><span>7</span><span>19</span><span>27</span><span>42</span>
                                                        <span class="select">5</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="drawer-content-right">
                                    <div class="parantesestext_reg_page">}</div>
                                    <div class="parantesestext_reg_text">1 Draw</div>
                                </div>
                            </div>
                        </div>
                        <!-- Second Item -->
                            </div>
                        </div>
                        <div class="clear_inner">&nbsp;</div>
                        <div class="comman">
                            <div class="drawer">
                                <div class="drawer_hadding">
                                    <div class="call_full_dh">
                                        <div class="left"><span>2</span><?php _e(' Step Two: Proceed To Checkout','twentythirteen') ?></div>
                                        <div class="right"><?php _e('Total :','twentythirteen') ?> <strong>€ <?php echo $_POST['totalprice']; ?></strong></div>
                                    </div>
                                </div>
                                <div class="register_area">
                                    <div class="login_left">
                                        <h4><?php _e('Already a Member? Sign In Here','twentythirteen') ?></h4>

                                        <form name="selectedData" action="" method="post" id="selectedData">
                                            <?php
                                            if (isset($_POST) && count($_POST) > 0) {
                                                echo $hidden = "";
                                                foreach ($_POST as $key => $value) {
                                                    $hidden .= '<input type="hidden" name="' . $key . '" value="' . $value . '" id="' . $key . '" />';
                                                }
                                                if ($_POST['lines'] > 0) {
                                                    $hidden .= '<input type="hidden" value="card" id="cardselection" />';
                                                } else {
                                                    $hidden .= '<input type="hidden" value="share" id="cardselection" />';
                                                }
                                                echo $hidden;
                                            }
                                            ?>
                                        </form>


                                        <form id="signinform" name="signinform" action="" method="post">
                                            <input type="hidden" id="isGroup" value="<?php echo $isGroup; ?>"/>
											<div class="form">
												<ul>
													<li><input name="email" type="text" placeholder="<?php _e('Email','twentythirteen') ?>" value="" class="u_field" /></li>
													<li><input name="password" type="password" placeholder="<?php _e('Password','twentythirteen') ?>" value="" class="u_field" /></li>
													<li><a href="#" class="link13_grn" id="sigininformForgetPassword">Forget password?</a><input name="singIn" type="button" value="<?php _e('Sign in','twentythirteen') ?>" class="u_button p_signin right" /></li>
													<li><input name="forgotemail" type="text" placeholder="e-mail address" value="" class="u_field" style="display:none" /></li>
													<li><input name="submitForgotPass" type="button" value="Submit" class="u_button" style="display:none" /></li>
													<!-- <li><input name="singIn" type="button" value="Sign In" class="u_button p_signin" /></li> -->
													<li><img src="<?php echo TEMPLATE_URL ?>/images/loading.gif" class="hidesigninloader"/></li>
													<li><span class="signin_error"></span></li>
												</ul>
											</div>
                                        </form>
                                    </div>
                                    <div class="register_right">
                                        <h4><?php _e('Not a Member Yet? Sign Up Now','twentythirteen') ?></h4>

                                        <form id="signupform" name="signupform" action="" method="post">
                                            <div class="form">
                                                <ul>
                                                    <li><input name="firstname" type="text" placeholder="<?php _e('First Name','twentythirteen') ?>" value="" class="u_field" /></li>
                                                    <li><input name="lastname" type="text" placeholder="<?php _e('Last Name','twentythirteen') ?>" value="" class="u_field" /></li>
                                                    <li><input name="phone" type="text" placeholder="<?php _e('Phone','twentythirteen') ?>" value="" class="u_field" /></li>
                                                    <li><input name="email" type="text" placeholder="<?php _e('Email','twentythirteen') ?>" value="" class="u_field" /></li>

                                                    <li><input type="checkbox" name="terms"/> <?php _e('I accept the <u><a href="/terms-and-conditions/">Terms and Conditions</a></u>','twentythirteen') ?> </a></u></li>
                                                    <li><input name="" type="button" value="<?php _e('Sign Up','twentythirteen') ?>" class="u_button p_signup"  /></li>

                                                    <li><img src="<?php echo TEMPLATE_URL ?>/images/loading.gif" class="hidesignuploader"/></li>
                                                    <li><span class="signup_error regerror"></span></li>
                                                </ul>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
}

get_footer();

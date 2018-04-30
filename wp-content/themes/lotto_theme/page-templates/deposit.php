<?php
/**
 * Template Name: Deposit
 *
 */
get_header();
?>
    <div ng-controller="DepositController" ng-init="initDepositPage()">
        <div ng-switch on="section.selectionPaymentTemplate">
            <div ng-switch-when="new">
                <ng-include class="animate-switch" src="'<?php echo CART_PARTIALS_URI ?>deposit/paymentnew.html'"></ng-include>
            </div>
            <div ng-switch-when="exist">
                <ng-include class="animate-switch" src="'<?php echo CART_PARTIALS_URI ?>deposit/paymentexist.html'"></ng-include>
            </div>
            <div ng-switch-when="signup" ng-controller="CartController">
                <ng-include class="animate-switch" src="'<?php echo CART_PARTIALS_URI ?>ngCart/signup.html'"></ng-include>
            </div>
        </div>
    </div>
<?php
get_footer();
/*if (!empty($_SESSION['user_data'])) {
    $url         = BASE_API_URL . '/userinfo/get-credit-card-methods-by-memberid'; // New url
    $data        = array('MemberId' => $_SESSION['user_data']['MemberId'], 'BrandID' => BRAND_ID, 'IP' => $_SERVER['REMOTE_ADDR']);
    $data_string = json_encode($data);
    $ch          = curl_init($url);

    curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Token: ' . TOKEN)
        );

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        $resultData = json_decode(curl_exec($ch));

        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

		if(empty($resultData)) {
			$location = home_url() . "/my-account/";
			echo '<script type="text/javascript">window.location.href = "' . $location . '"</script>';
		}
	?>
        <script type="text/javascript">
	        var listener = function (event) {
                // Ignore messages from other iframes or windows.
                if (event.data.id !== 'cashier') {
                    return;
                }

				if(event.data.isdeposit)
					var datastring = "action=lottery_data&m=userinfo/get-member-money-balance";

					jQuery.ajax({
						type: "POST",
						url: CONFIG.adminURL,
		                data: datastring,
						success: function (resp) {

						}
					});
            }

            // Setup the listener.
            if (window.addEventListener) {
                addEventListener("message", listener, false);
            }
            else {
                attachEvent("onmessage", listener);
            }

            jQuery(document).ready(function () {
                jQuery(".macloader").show();

                isMoble = <?php echo (wp_is_mobile()) ? "true" : "false";?>;

                if (isMoble) {
                    var proxyWindow = $('.logo').width() + 20;
                    console.log(proxyWindow)
                    if ( proxyWindow <= 630 ) {
                        $('#my-deferred-iframe').css("width","100%");
                    }
                }
                loadDeferredIframe();
            });

            function loadDeferredIframe() {
                var iframe = document.getElementById("my-deferred-iframe");
                 iframe.src = "<?php echo CASHIER_URL ?>OpenCashier.aspx?actionType=Deposit&sessionId=<?php echo $_SESSION['user_data']['UserSessionId']; ?>&supporterId=0&lang=<?= ICL_LANGUAGE_CODE ?>&brandid=<?php echo BRAND_ID; ?>"; // here goes your url
                jQuery(".macloader").hide();
            }
        </script>

        <div class="hadding inner-hadding">
            <h1><?php the_title(); ?></h1>
        </div>
        <div class="innerpage_left tested" style="height: 600px;">
            <img src="<?php echo TEMPLATE_URL ?>/images/loading.gif" class="macloader"/>
            <iframe id="my-deferred-iframe" src="about:blank"  width="700px" height="780px" scrolling="no" style="border:0 none;"></iframe>
        <div>
    <?php
} else {
    echo '<script type="text/javascript">window.location.href = "' . home_url() . '"</script>';
}

get_footer();

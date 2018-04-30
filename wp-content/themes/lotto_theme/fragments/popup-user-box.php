<?php if (!empty($_SESSION['user_data'])): ?>
<?php
    $balance = carbon_get_theme_option('currency') . number_format(($_SESSION['user_balance']['AccountBalance'] + $_SESSION['user_balance']['BonusAmount'] + $_SESSION['user_balance']['WinningAmount']), 2);
    $name = wp_trim_words($_SESSION['user_data']['FirstName'], $num_words = 2, $more = null);
?>
<div class="popup-user-box">
    <div class="user-head">
        <i class="avatar avatar3"></i>
        <span class="user-box-name">

	<?php 
	$full_name = $name;	
		echo "Hi, " . $full_name;
	?>
	</span>
        <span class="user-balance small-arrow"><?php echo $balance; ?></span>
    </div>
    <div class="user-short-info">
        <div class="info-head">
            <span class="user-box-name"><?php echo $name; ?></span>
            <a href="<?php echo wp_logout_url(HOME_URL); ?>"><?php _e('Log out', 'twentythirteen'); ?></a>
            <i class="ico-logout"></i>
        </div>

        <div class="info-cta">
            <a href="<?php echo HOME_URL ?>/my-account/"><i class="ico-details2"></i><?php _e('Account Details', 'twentythirteen'); ?></a>
            <span><i class="ico-balance"></i><?php echo $balance; ?></span>
            <a href="<?php echo HOME_URL ?>/my-account/deposit/" class="btn-deposit"><?php _e('Deposit', 'twentythirteen'); ?></a>
        </div>
    </div>
</div>
<?php endif ?>
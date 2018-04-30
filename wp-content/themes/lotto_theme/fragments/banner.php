<?php
global $all_brand_draws;
?>
<?php
if (!empty($all_brand_draws)):
?>
    <?php

    $jackpot = 'PENDING';
	$arrslice = array_slice($all_brand_draws, 0, 1);
    $draw = array_shift($arrslice);
    $link = HOME_URL . '/' . strtolower(ChangeLotteryNameForUrl($draw->LotteryName).'-lottery');
?>

<div onclick="window.open('./megamillions-lottery','_self');" class="home-banner2" style="cursor:pointer;">
    <h2>Playing in a group is more fun and cost less!</h2>
    <a href="https://www.orolotto.com/all-group/" class="banner-buy-btn">Join Now</a>
	<!--    <a href="<?php echo $link . '?group-tab'; ?>" class="banner-buy-btn">Join Now</a> -->

</div>

<?php endif; ?>

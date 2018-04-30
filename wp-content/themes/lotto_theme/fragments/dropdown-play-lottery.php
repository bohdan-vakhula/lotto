<?php
    global $all_brand_draws;

    function secondsToWordsNew($seconds)
    {
        $ret = "";

        /*** get the days ***/
        $days = intval(intval($seconds) / (3600*24));
        if($days> 0)
        {
            $ret .= "$days days ";
        }

        /*** get the hours ***/
        $hours = (intval($seconds) / 3600) % 24;
        if($hours > 0)
        {
            $ret .= "$hours hours ";
        }

        /*** get the minutes ***/
        $minutes = (intval($seconds) / 60) % 60;
        if($minutes > 0)
        {
            if($days <= 0){

                $ret .= "$minutes minutes ";

            }
        }

        /*** get the seconds ***/
        $seconds = intval($seconds) % 60;
        if ($seconds > 0) {
            //$ret .= "$seconds seconds";
        }

        return $ret;
    }

    /*
    if (!empty($all_brand_draws)):
    ?>
    <div class="dropdown-menu playlottary">
    <ul>
    <?php 
    $draw = array_slice($all_brand_draws, 0, 5, true);
    $jackpot = 'PENDING';
    foreach ($draw as $key => $val) :
    $lotteryname = strtolower(ChangeLotteryNameForUrl($val->LotteryName));
    $flag        = TEMPLATE_URL . '/images/flag_' . strtolower($val->CountryName) . '.png';
    $link        = HOME_URL . '/' . $lotteryname . '-lottery/';

    if ($val->Jackpot > 0) {
    $jackpot = $val->LotteryCurrency2 . '' . number_format($val->Jackpot, 0, "", ",");
    } ?>
    <li>
    <div class="dd_col1">
    <img src="<?php echo $flag; ?>" alt="flag" />
    &nbsp;&nbsp;<?php echo convert_country_name($val->CountryName); ?>
    </div>
    <div class="dd_col2">
    <?php echo $val->LotteryName; ?>
    </div>
    <div class="dd_col3">
    <?php echo $jackpot; ?>
    </div>
    <div class="dd_col4">
    <a href="<?php echo $link; ?>" class="dd_play_button">
    <?php _e('Play', 'twentythirteen'); ?>
    </a>
    </div>
    </li>
    <?php
    endforeach;
    ?>
    <a href="<?php echo HOME_URL ?>/lottery/" class="link13"><?php _e('View All Lotteries', 'twentythirteen'); ?></a>
    </ul>
    </div>
<?php endif; */ ?>


<?php if (!empty($all_brand_draws)): ?>
    <div class="playlottary  hidden-xs">

        <div id="navbar-item-lotto-games" class="dropdown-menu">
        
            <div id="lotto-games-container" class="lotto-games-container">

                <div class="lotto-games-content">

                    <ul class="menu-games">

                        <?php 
                            $draw = array_slice($all_brand_draws, 0, 5, true);
                            $jackpot = 'PENDING';
                            foreach ($draw as $key => $val) :
                                $lotteryname = strtolower(ChangeLotteryNameForUrl($val->LotteryName));
                                $flag        = TEMPLATE_URL . '/images/flag_' . strtolower($val->CountryName) . '.png';
                                $link        = HOME_URL . '/' . $lotteryname . '-lottery/';
                                $imgsrcll = '/images/logos/' . $lotteryname . '1.png';

                                if ($val->Jackpot > 0) {
                                    $jackpot = $val->LotteryCurrency2 . '' . number_format($val->Jackpot, 0, "", ",");
                            } ?>

                            <li class="menu-item beton">

                                <div class="item-header">
                                    <div class="brand-logo"><img src="<?php echo TEMPLATE_URL . $imgsrcll;?>" title="Irish Lotto"></div>           
                                    <div class="brand-prize"><h2 class="prize"><?php echo $val->LotteryCurrency2; ?><?php echo number_format($val->Jackpot / 1000000, 2); ?><span class="small-m">M</span></h2></div>
                                    <div class="brand-name"><?php echo $val->LotteryName; ?></div>
                                </div>

                                <div class="item-body">
                                    <div class="brand-command">
                                        <a href="<?php echo $link; ?>" class="play-beton">PLAY</a>
                                    </div>
                                    <div class="timer" data-days="5">
                                        <?php 
                                            //echo date("Y-m-d H:i:s", strtotime($val->DrawDate));
                                            $mytotalSec = (strtotime(date("Y-m-d H:i:s", strtotime($val->DrawDate)))-time());

                                        ?>
                                        <span class="timer-value"><?php echo secondsToWordsNew($mytotalSec); ?> </span>
                                    </div>
                                </div>

                                <div class="item-footer">
                                    <div class="subscription-link">
                                        <a href="<?php echo $link; ?>">Syndicate &gt;</a>
                                    </div>
                                </div>

                            </li>

                            <?php
                                endforeach;
                        ?>

                    </ul>
                </div>
                
            </div>
            
            <div class="lotto-games-footer"><a href="<?php echo HOME_URL ?>/lottery/">See all lotteries</a></div>
        </div>
        
    </div>
    <?php endif;  ?>